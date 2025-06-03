
<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    // Redirect to login if not authenticated
    header('Location: google_login.php');
    exit();
}
?>