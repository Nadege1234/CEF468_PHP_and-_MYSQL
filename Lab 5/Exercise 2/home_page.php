<?php
require_once 'auth_check.php'; ?>
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: google_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Home</title>
</head>
<body>
    <h1>Welcome to the Library System</h1>
    <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
