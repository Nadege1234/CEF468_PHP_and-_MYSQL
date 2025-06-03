<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connect.php'; // your DB connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $price = $_POST['price'] ?? 0;
    $genre = $_POST['genre'] ?? '';
    $year = $_POST['year'] ?? null;

    // Validate inputs here...

    $stmt = $conn->prepare("INSERT INTO Books (title, author, price, genre, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $title, $author, $price, $genre, $year);
    $stmt->execute();

    header("Location: view_books.php");
    exit();
}
?>

<form method="post" action="">
  Title: <input type="text" name="title" required><br>
  Author: <input type="text" name="author" required><br>
  Price: <input type="number" step="0.01" name="price" required><br>
  Genre: <input type="text" name="genre"><br>
  Year: <input type="number" name="year" min="1900" max="<?php echo date("Y"); ?>"><br>
  <button type="submit">Add Book</button>
</form>
