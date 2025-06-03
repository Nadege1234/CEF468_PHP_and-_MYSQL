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
        <form method="POST" action="delete_book.php" style="display:inline;">
            <?php
            require 'csrf_token.php';
            ?>
            <input type="hidden" name="book_id" value="<?= (int)$row['book_id'] ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
        </form>
    </div>
    <hr>
<?php endwhile;

$conn->close();
?>
