<?php
include 'add_book.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $book_title = trim($_POST["book_title"]);
    $author_id = $_POST["author_id"];
    $genre = trim($_POST["genre"]);
    $price = $_POST["price"];

    $errors = array();

    if (empty($book_title)) {
        $errors[] = "Book title is required.";
    }
    if (empty($genre)) {
        $errors[] = "Genre is required.";
    }
    if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a valid positive number.";
    }
    //check if author_id exists
    try{
        $checkAuthor = $conn->prepare("SELECT author_id FROM Authors WHERE author_id = :author_id");
        $checkAuthor->bindParam(':author_id', $author_id);
        $checkAuthor->execute();
        if($checkAuthor->rowCount() == 0){
            $errors[] = "Author ID is invalid";
        }

    } catch(PDOException $e){
        $errors[] = "Error checking Author ID";
    }


    if (empty($errors)) {
        // Insert data into the Books table
        try {
            $stmt = $conn->prepare("INSERT INTO Books (title, author_id, isbn, pub_year) VALUES (:title, :author_id, :isbn, :pub_year)");
            //  Removed genre and price.
            $stmt->bindParam(':title', $book_title);
            $stmt->bindParam(':author_id', $author_id);
            $isbn = "N/A";  // Hardcoded ISBN and year.
            $pub_year = 2024;
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':pub_year', $pub_year);

            $stmt->execute();
            //Instead of printing to the screen, redirect back to the add_book.php page and show a success message.
            header("Location: add_book.php?success=true");
            exit();

        } catch (PDOException $e) {
            
            echo "Error inserting book: " . $e->getMessage(); // Keep error message for debugging
        }
    } else {
       
        $errorMessage = implode("<br>", $errors);
        header("Location: add_book.php?error=".urlencode($errorMessage));
        exit();

    }
}
?>