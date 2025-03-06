<?php
session_start();
include '../includes/db.php';
$current_page = basename($_SERVER['PHP_SELF']);
$stmt = $conn->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
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




<div class="blogs-container">
    <h2>Blogs</h2>

    <?php foreach ($blogs as $blog): ?>
        <div class="blog-post">
            <h3><?= htmlspecialchars($blog['title']); ?></h3>
            <p><em>Geplaatst op: <?= $blog['created_at']; ?></em></p>
            <p><?= nl2br(htmlspecialchars(substr($blog['content'], 0, 200))); ?>...</p>
            <a href="view_blog.php?id=<?= $blog['id']; ?>" class="read-more">Lees meer</a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
