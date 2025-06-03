
<?php
$host = "localhost";
$user = "root";
$pass = ""; // Default for XAMPP
$dbname = "Auth_check"; // Updated DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>