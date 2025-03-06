<?php
session_start();
include '../includes/db.php';

if (isset($_SESSION['user_id'], $_POST['comment'], $_POST['blog_id'])) {
    $user_id = $_SESSION['user_id'];
    $comment = $_POST['comment'];
    $blog_id = $_POST['blog_id'];

    $stmt = $conn->prepare("INSERT INTO comments (blog_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$blog_id, $user_id, $comment]);

    header("Location: view_blog.php?id=$blog_id");
    exit();
} else {
    die("Er is een fout opgetreden.");
}
?>
