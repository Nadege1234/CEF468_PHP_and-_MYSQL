<?php

// Database connection 
$dbHost = "localhost"; 
$dbUser = "root"; 
$dbPass = ""; 
$dbName = "webappdb";

// Create connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPass , $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store form data and errors
$name = $email = $age = "";
$errors = [];

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $errors["name"] = "Name is required";
    } else {
        $name = sanitize_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $errors["name"] = "Only letters and white space allowed in name";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $errors["email"] = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format";
        }
    }

    // Validate Age
    if (empty($_POST["age"])) {
        $errors["age"] = "Age is required";
    } else {
        $age = sanitize_input($_POST["age"]);
        if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 150) {
            $errors["age"] = "Invalid age";
        }
    }

    // If there are no errors, insert data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO Users (name, email, age) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $age);

        if ($stmt->execute()) {
            echo "<p style='color: green; text-align: center;'>User data inserted successfully!</p>";
            echo "<p style='text-align: center;'><a href='view_users.php'>View Users</a></p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Error inserting record: " . $conn->error . "</p>";
        }

        $stmt->close();
    } else {
        // Display validation errors
        echo "<div style='color: red; text-align: center;'>";
        echo "<h3>Validation Errors:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "<p><a href='user_form.php'>Go back to the form</a></p>";
        echo "</div>";
    }
}

$conn->close();

?>