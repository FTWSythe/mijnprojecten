<?php
session_start();
include '../includes/db.php';
include_once "../includes/header.php";


if (!isset($_GET['id'])) {
    echo "Geen blog geselecteerd.";
    exit();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ($row) {
    
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
    echo "<p>Geschreven op " . htmlspecialchars($row['created_at']) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
} else {
    echo "Deze blog bestaat niet.";
}

include '../includes/footer.php';
?>
