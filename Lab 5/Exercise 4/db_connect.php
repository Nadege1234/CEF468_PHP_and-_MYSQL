<?php
$host = "localhost";
$username = "root";       // Default XAMPP MySQL username
$password = "";           // Default XAMPP MySQL password (leave blank)
$database = "librarymanagementdb";  // Your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
