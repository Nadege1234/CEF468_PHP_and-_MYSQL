
<?php
require 'auth_check.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    $conn = new mysqli("localhost", "root", "", "liabrary6");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $book_id = $_POST["book_id"];
    $stmt = $conn->prepare("DELETE FROM Books WHERE book_id=?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();

    $conn->close();
}

header("Location: view_books.php");
exit();
?>