<?php
require_once 'access_control.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user']['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
</head>
<body>
    <h1>Library</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</p>

    <h2>Available Books</h2>

    <?php
    $result = $conn->query("SELECT * FROM books");

    if ($result->num_rows > 0): ?>
        <ul>
        <?php while ($book = $result->fetch_assoc()): ?>
            <?php
            // Check if the current user has borrowed this book and not returned it
            $book_id = $book['id'];
            $check = $conn->query("SELECT * FROM borrowed_books WHERE user_id = $user_id AND book_id = $book_id AND returned = FALSE");

            if ($check->num_rows > 0) {
                $status = "You borrowed this";
                $action = "<a href='return.php?id=$book_id'>Return</a>";
            } else {
                // Check if someone else has borrowed it
                $anyone = $conn->query("SELECT * FROM borrowed_books WHERE book_id = $book_id AND returned = FALSE");
                if ($anyone->num_rows > 0) {
                    $status = "Not available";
                    $action = "";
                } else {
                    $status = "Available";
                    $action = "<a href='borrow.php?id=$book_id'>Borrow</a>";
                }
            }
            ?>
            <li>
                <strong><?php echo htmlspecialchars($book['title']); ?></strong> by <?php echo htmlspecialchars($book['author']); ?>
                - <?= $status ?> <?= $action ?>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>

    <p><a href="home.php">Back to Home</a></p>
</body>
</html>
