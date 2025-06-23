<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE library_records SET name=?, course=?, email=?, phone=?, genre=?, author=?, title=?, borrow_date=?, return_date=? WHERE id=?");
    $stmt->bind_param("sssssssssi", $_POST['name'], $_POST['course'], $_POST['email'], $_POST['phone'], $_POST['genre'], $_POST['author'], $_POST['title'], $_POST['borrow_date'], $_POST['return_date'], $_POST['id']);
    $stmt->execute();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
