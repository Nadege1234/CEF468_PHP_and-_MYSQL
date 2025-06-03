<?php
require 'auth_check.php';
session_start();

// Check CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed.");
}

$conn = new mysqli("localhost", "root", "", "liabrary6");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and validate input
$title  = $_POST["title"];
$author = $_POST["author"];
$price  = $_POST["price"];
$genre  = $_POST["genre"];
$year   = $_POST["year"];

$stmt = $conn->prepare("INSERT INTO Books (title, author, price, genre, year) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssdi", $title, $author, $price, $genre, $year);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Book added successfully.</p>";
} else {
    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>
<br>
<a href="view_books.php">Back to Book List</a>
