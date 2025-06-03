<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connect.php';

$result = $conn->query("SELECT * FROM Books");

echo "<h1>Books List</h1>";
echo "<a href='add_book.php'>Add New Book</a><br><br>";

echo "<table border='1'>
<tr><th>ID</th><th>Title</th><th>Author</th><th>Price</th><th>Genre</th><th>Year</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['book_id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
    echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
    echo "<td>
        <a href='edit_book.php?id=" . $row['book_id'] . "'>Edit</a> | 
        <a href='delete_book.php?id=" . $row['book_id'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>
    </td>";
    echo "</tr>";
}
echo "</table>";
