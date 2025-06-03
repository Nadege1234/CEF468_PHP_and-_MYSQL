
<?php
require_once 'access_control.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user']['id'];

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);

    // Check if the book is already borrowed by someone
    $check = $conn->query("SELECT * FROM borrowed_books WHERE book_id = $book_id AND returned = FALSE");

    if ($check->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $book_id);
        $stmt->execute();
    }
}

header("Location: library.php");
exit();