<?php
require 'auth_check.php';

$conn = new mysqli("localhost", "root", "", "liabrary6");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Books");
?>

<h2>Book List</h2>
<a href="add_book.php">Add New Book</a><br><br>

<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <strong><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') ?></strong>
        by <?= htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') ?> (<?= (int)$row['year'] ?>)<br>

        Price: $<?= htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') ?> |
        Genre: <?= htmlspecialchars($row['genre'], ENT_QUOTES, 'UTF-8') ?><br>

        <a href="edit_book.php?book_id=<?= (int)$row['book_id'] ?>">Edit</a> |
        <a href="delete_book.php?book_id=<?= (int)$row['book_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
    <hr>
<?php endwhile;

$conn->close();
?>
