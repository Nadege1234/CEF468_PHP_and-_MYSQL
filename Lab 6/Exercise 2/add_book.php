<?php
require 'auth_check.php';

$conn = new mysqli("localhost", "root", "", "liabrary6");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle book addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
}
?>

<h2>Add New Book</h2>
<form method="POST" action="">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Genre: <input type="text" name="genre"><br><br>
    Year: <input type="number" name="year"><br><br>
    <input type="submit" value="Add Book">
</form>
<br>
<a href="view_books.php">Back to Book List</a>
