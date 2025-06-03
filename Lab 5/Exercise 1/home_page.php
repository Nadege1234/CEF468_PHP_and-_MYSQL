<?php
require 'auth_check.php';
?>

<!DOCTYPE html>
<html>
<head><title>Home Page</title></head>
<body>
<h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
<p>This is your library dashboard.</p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
