<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'], $_GET['blog_id'])) {
    $comment_id = $_GET['id'];
    $blog_id = $_GET['blog_id'];

    
    $stmt = $conn->prepare("SELECT user_id FROM comments WHERE id = ?");
    $stmt->execute([$comment_id]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($comment && ($comment['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin')) {
        
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$comment_id]);

        header("Location: view_blog.php?id=$blog_id");
        exit();
    } else {
        die("Ongeldige aanvraag.");
    }
} else {
    die("Ongeldige aanvraag.");
}
?>
