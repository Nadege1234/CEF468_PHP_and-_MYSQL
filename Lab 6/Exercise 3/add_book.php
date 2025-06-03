<?php
require 'auth_check.php';
require 'csrf_token.php';
?>

<h2>Add New Book</h2>
<form method="POST" action="process_book.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Genre: <input type="text" name="genre"><br><br>
    Year: <input type="number" name="year"><br><br>
    <input type="submit" value="Add Book">
</form>
<br>
<a href="view_books.php">Back to Book List</a>
