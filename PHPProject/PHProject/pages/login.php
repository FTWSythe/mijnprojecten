<?php
session_start();
include '../includes/db.php';
$current_page = basename($_SERVER['PHP_SELF']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bindValue(1, $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

      
        $_SESSION['login_message'] = 'Succesvol ingelogd!';

        
        header("Location: index.php");
        exit();
    } else {
        
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-links">
        <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
        <a href="blogs.php" class="<?= $current_page == 'blogs.php' ? 'active' : '' ?>">Blogs</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="write_blog.php" class="<?= $current_page == 'write_blog.php' ? 'active' : '' ?>">Schrijf Blog</a>
        <?php endif; ?>
    </div>

    <div class="nav-auth">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welkom, <?= $_SESSION['username']; ?>!</span>
            <a href="logout.php">Uitloggen</a>
        <?php else: ?>
            <a href="register.php" class="<?= $current_page == 'register.php' ? 'active' : '' ?>">Registreren</a>
            <a href="login.php" class="<?= $current_page == 'login.php' ? 'active' : '' ?>">Inloggen</a>
        <?php endif; ?>
    </div>
</nav>


<div class="login-container">
    <h2>Inloggen</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Inloggen</button>
    </form>

   
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>

   
    
</div>
</body>
</html>
