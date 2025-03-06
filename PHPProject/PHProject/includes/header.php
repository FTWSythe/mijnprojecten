<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>

<?php

$current_page = basename($_SERVER['PHP_SELF']); 
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Blogsite</title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>

<nav class="navbar">
    <div class="nav-links">
        <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
        <a href="blogs.php" class="<?= $current_page == 'blogs.php' ? 'active' : '' ?>">Blogs</a>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="write_blog.php" class="<?= $current_page == 'write_blog.php' ? 'active' : '' ?>">Blog schrijven</a>
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



