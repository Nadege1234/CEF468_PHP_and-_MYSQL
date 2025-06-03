
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header('Location: google_login.php'); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    
    <?php if (isset($_SESSION['user_picture'])): ?>
        <p><img src="<?php echo htmlspecialchars($_SESSION['user_picture']); ?>" alt="User Picture" width="100"></p>
    <?php endif; ?>
    
    <p><a href="home.php">Home</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>