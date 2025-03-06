<?php 
include_once "../includes/header.php"; 
include_once "../includes/db.php"; 

$current_page = basename($_SERVER['PHP_SELF']); 


$sql = "SELECT id, title, content, created_at FROM blogs ORDER BY created_at DESC LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);


$login_message = isset($_SESSION['login_message']) ? $_SESSION['login_message'] : '';

if ($login_message) {
    unset($_SESSION['login_message']);
}
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

    
    <?php if ($login_message): ?>
        <div class="notification success" id="login-message"><?= htmlspecialchars($login_message); ?></div>
    <?php endif; ?>

    <div class="main-container">
        <h1 class="blog-title">Mijn blogsite</h1>

        <div class="blog-container">
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-box">
                    <h2><a href="view_blog.php?id=<?= $blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2>
                    <p>Geschreven op <?= date("d M Y \o\m H:i:s", strtotime($blog['created_at'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once "../includes/footer.php"; ?>

    <script>
      
        window.onload = function() {
           
            const loginMessage = document.getElementById('login-message');

            if (loginMessage) {
                loginMessage.style.display = 'block'; 
                setTimeout(function() {
                    loginMessage.style.display = 'none'; 
                }, 3000);
            }
        }
    </script>
</body>
</html>
