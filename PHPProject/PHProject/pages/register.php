<?php
session_start();
include '../includes/db.php';
$current_page = basename($_SERVER['PHP_SELF']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
   
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bindValue(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $error = "Deze gebruikersnaam is al in gebruik.";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $username, PDO::PARAM_STR);
        $stmt->bindValue(2, $email, PDO::PARAM_STR);
        $stmt->bindValue(3, $password, PDO::PARAM_STR);
        $stmt->execute();

        
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>


<nav class="navbar">
    <ul class="nav-links-left">
        <li><a href="index.php" class="<?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a></li>
        <li><a href="blogs.php" class="<?php echo ($current_page == 'blogs') ? 'active' : ''; ?>">Blogs</a></li>
    </ul>

    <ul class="nav-links-right">
        <li><a href="register.php" class="<?php echo ($current_page == 'register') ? 'active' : ''; ?>">Registreren</a></li>
        <li><a href="login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>">Inloggen</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Registreren</h2>
    <form action="register.php" method="post">
        <label for="username">Gebruikersnaam</label>
        <input type="text" id="username" name="username" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn">Registreren</button>

       
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    </form>
    
    
   
</div>

</body>
</html>
