<?php
require 'auth_check.php';

$conn = new mysqli("localhost", "root", "", "liabrary6");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST["book_id"];
    $title   = $_POST["title"];
    $author  = $_POST["author"];
    $price   = $_POST["price"];
    $genre   = $_POST["genre"];
    $year    = $_POST["year"];

    $stmt = $conn->prepare("UPDATE Books SET title=?, author=?, price=?, genre=?, year=? WHERE book_id=?");
    $stmt->bind_param("ssdsii", $title, $author, $price, $genre, $year, $book_id);
    $stmt->execute();

    header("Location: view_books.php");
    exit();
}

// Load current book data
if (isset($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
    $stmt = $conn->prepare("SELECT * FROM Books WHERE book_id=?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
}
?>

<h2>Edit Book</h2>
<form method="POST" action="">
    <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>
    Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>
    Price: <input type="number" step="0.01" name="price" value="<?= $book['price'] ?>" required><br><br>
    Genre: <input type="text" name="genre" value="<?= htmlspecialchars($book['genre'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
    Year: <input type="number" name="year" value="<?= $book['year'] ?>"><br><br>
    <input type="submit" value="Update Book">
</form>
