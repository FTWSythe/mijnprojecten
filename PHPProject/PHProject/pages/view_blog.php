<?php
session_start();
include '../includes/db.php';


if (!isset($_GET['id'])) {
    die("Ongeldige blog-ID.");
}

$blog_id = $_GET['id'];

$stmt = $conn->prepare("SELECT title, content, created_at FROM blogs WHERE id = ?");
$stmt->execute([$blog_id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$blog) {
    die("Blog niet gevonden.");
}


$comment_message = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id']; 

    if (!empty($comment)) {
        
        $stmt = $conn->prepare("INSERT INTO comments (blog_id, user_id, comment, created_at) VALUES (:blog_id, :user_id, :comment, NOW())");
        $stmt->bindParam(':blog_id', $blog_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
        $comment_message = 'Reactie toegevoegd!';
    } else {
        $comment_message = 'Vul alstublieft een reactie in!';
    }
}


$stmt = $conn->prepare("SELECT comments.id, comments.comment, users.username, comments.created_at, comments.updated_at, comments.user_id FROM comments JOIN users ON comments.user_id = users.id WHERE comments.blog_id = :blog_id ORDER BY comments.created_at DESC");
$stmt->bindParam(':blog_id', $blog_id);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['title']); ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="blog-content">
    <h1><?= htmlspecialchars($blog['title']); ?></h1>
    <p><em>Geplaatst op: <?= date("d M Y H:i:s", strtotime($blog['created_at'])) ?></em></p>
    <p><?= nl2br(htmlspecialchars($blog['content'])); ?></p>
</div>

<div class="comments-section">
    <h3>Reacties</h3>
    <?php foreach ($comments as $comment): ?>
        <div class="comment-box">
            <p><strong><?= htmlspecialchars($comment['username']) ?></strong> zei op <?= date("d M Y H:i:s", strtotime($comment['created_at'])) ?>:</p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php if (isset($_SESSION['user_id']) && ($comment['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin')): ?>
                <a href="edit_comment.php?id=<?= $comment['id'] ?>&blog_id=<?= $blog_id ?>">Bewerk</a> | 
                <a href="delete_comment.php?id=<?= $comment['id'] ?>&blog_id=<?= $blog_id ?>">Verwijder</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <h4>Laat een reactie achter</h4>
        <form method="POST">
            <textarea name="comment" placeholder="Schrijf je reactie hier..." rows="5"></textarea><br>
            <button type="submit">Plaats reactie</button>
        </form>
    <?php else: ?>
        <p>Je moet <a href="login.php">inloggen</a> om een reactie te plaatsen.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
