<?php
// Database connection details (assuming these are in the same scope or included)
$dbHost = "localhost"; 
$dbUser = "root"; 
$dbPass = ""; 
$dbName = "LibrarySystemDB";

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage()); // Stop execution on connection error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <style>
        form {
            margin: 20px auto;
            width: 400px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }
        form h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            height: 34px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 0.9em;
        }
        .success-message {
            color: green;
            margin-top: 10px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <form action="process_book.php" method="post">
        <h2>Add New Book</h2>
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title" required>

        <label for="author_id">Author:</label>
        <select id="author_id" name="author_id" required>
            <?php
            // Fetch authors from the database
            try {
                $stmt = $conn->query("SELECT author_id, author_name FROM Authors");
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row['author_id'] . "'>" . $row['author_name'] . "</option>";
                }
            } catch (PDOException $e) {
                echo "<option value=''>Error fetching authors</option>"; // Add an error option
            }
            ?>
        </select>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0" step="0.01" required>

        <button type="submit">Add Book</button>
    </form>
</body>
</html>
