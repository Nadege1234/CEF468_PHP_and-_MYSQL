
<?php
require 'auth_check.php'; // Only allow logged-in users

$conn = new mysqli("localhost", "root", "", "LibraryDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form submitted, insert book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];

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

<!-- HTML Form -->
<h2>Add New Book</h2>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre"><br><br>

    <label>Year:</label><br>
    <input type="number" name="year"><br><br>

    <input type="submit" value="Add Book">
</form>

<br>
<a href="view_books.php">Back to Book List</a>