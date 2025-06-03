<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Library System</h1>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</p>
        <p><a href="library.php">Go to Library</a></p>
        <p><a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a></p>
    <?php endif; ?>
</body>
</html>
