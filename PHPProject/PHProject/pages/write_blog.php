<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");  
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = $_POST['title'];
    $content = $_POST['content'];


    $stmt = $conn->prepare("INSERT INTO blogs (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $_SESSION['user_id']]);

   
    header("Location: blogs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Schrijven</title>
    <link rel="stylesheet" href="../css/write-blogs.css">
</head>
<body>


<nav class="navbar">
    <div class="nav-links">
        <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
        <a href="blogs.php" class="<?= $current_page == 'blogs.php' ? 'active' : '' ?>">Blogs</a>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="write_blog.php" class="active">Blog Schrijven</a>
        <?php endif; ?>
    </div>

    <div class="nav-auth">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welkom, <?= $_SESSION['username']; ?>!</span>
            <a href="logout.php">Uitloggen</a>
        <?php else: ?>
            <a href="register.php">Registreren</a>
            <a href="login.php">Inloggen</a>
        <?php endif; ?>
    </div>
</nav>


<div class="write-blog-container">
    <h2>Blog Schrijven</h2>
    
    <form method="post">
        <div class="input-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" placeholder="Voer de titel van je blog in" required>
        </div>
        
        <div class="input-field">
            <label for="content">Inhoud</label>
            <textarea name="content" id="content" rows="10" placeholder="Schrijf je blog hier..." required></textarea>
        </div>

        <button type="submit" class="post-btn">Plaats Blog</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
