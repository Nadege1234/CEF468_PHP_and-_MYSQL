<?php
require_once 'access_control.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user']['id'];

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);

    // Mark only this user's record as returned
    $stmt = $conn->prepare("UPDATE borrowed_books SET returned = TRUE WHERE user_id = ? AND book_id = ? AND returned = FALSE");
    $stmt->bind_param("ii", $user_id, $book_id);
    $stmt->execute();
}

header("Location: library.php");
exit();
