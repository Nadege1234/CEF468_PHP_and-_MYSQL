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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $price = $_POST['price'] ?? 0;
    $genre = $_POST['genre'] ?? '';
    $year = $_POST['year'] ?? null;

    $stmt = $conn->prepare("UPDATE Books SET title=?, author=?, price=?, genre=?, year=? WHERE book_id=?");
    $stmt->bind_param("ssdssi", $title, $author, $price, $genre, $year, $id);
    $stmt->execute();

    header("Location: view_books.php");
    exit();
}

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM Books WHERE book_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("Book not found.");
}
?>

<form method="post" action="">
  Title: <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br>
  Author: <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br>
  Price: <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($book['price']); ?>" required><br>
  Genre: <input type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>"><br>
  Year: <input type="number" name="year" min="1900" max="<?php echo date("Y"); ?>" value="<?php echo htmlspecialchars($book['year']); ?>"><br>
  <button type="submit">Update Book</button>
</form>
