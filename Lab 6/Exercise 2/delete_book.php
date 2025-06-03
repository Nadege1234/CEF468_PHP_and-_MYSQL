<?php
require 'auth_check.php';

$conn = new mysqli("localhost", "root", "", "liabrary6");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
    $stmt = $conn->prepare("DELETE FROM Books WHERE book_id=?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
}

header("Location: view_books.php");
exit();
?>
