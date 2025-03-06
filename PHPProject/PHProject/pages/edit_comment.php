<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'], $_GET['blog_id'])) {
    $comment_id = $_GET['id'];
    $blog_id = $_GET['blog_id'];

    
    $stmt = $conn->prepare("SELECT comment FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([$comment_id, $_SESSION['user_id']]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$comment) {
        die("Reactie niet gevonden of je hebt geen toestemming om deze te bewerken.");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_comment = $_POST['comment'];

        
        $stmt = $conn->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $stmt->execute([$new_comment, $comment_id]);

        header("Location: view_blog.php?id=$blog_id");
        exit();
    }
} else {
    die("Ongeldige aanvraag.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Reactie</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="write-blog-container">
    <h2>Bewerk je reactie</h2>

    <form action="" method="POST">
        <div class="input-field">
            <label for="comment">Reactie</label>
            <textarea name="comment" id="comment" rows="5" placeholder="Je reactie hier..."><?= htmlspecialchars($comment['comment']) ?></textarea>
        </div>
        
        <button type="submit" class="post-btn">Bewerk reactie</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
