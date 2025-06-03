
<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

// Create Google Client
$client = new Google_Client();
$client->setClientId('991172555741-7ikrhutovhjf22os7pobojlbealddh42.apps.googleusercontent.com'); // Replace991172555741-7ikrhutovhjf22os7pobojlbealddh42.apps.googleusercontent.com with your Client ID
$client->setClientSecret('ABCDefGhIjKLmnOP'); // Replace witABCDefGhIjKLmnOPh your Client Secret
$client->setRedirectUri('http://localhost/Library_auth_project/google_auth.php');
$client->addScope('email');
$client->addScope('profile');

// Generate login URL
$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Google Login</title>
</head>
<body>
    <h2>Login using Google</h2>
    <a href="<?php echo htmlspecialchars($login_url); ?>">
        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Login with Google">
    </a>
</body>
</html>