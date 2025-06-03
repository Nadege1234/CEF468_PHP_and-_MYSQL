<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Book ID not specified.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM Books WHERE book_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: view_books.php");
exit();

