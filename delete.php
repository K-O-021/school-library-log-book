<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $stmt = $conn->prepare("DELETE FROM library_records WHERE id=?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
