
<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

// Create Google Client
$client = new Google_Client();
$client->setClientId('991172555741-7ikrhutovhjf22os7pobojlbealddh42.apps.googleusercontent.com'); // Replace with your Client ID
$client->setClientSecret('ABCDefGhIjKLmnOP'); // Replace with your Client Secret
$client->setRedirectUri('http://localhost/Library_auth_project/google_auth.php');

if (isset($_GET['code'])) {
    // Authenticate and get access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        // Get user profile
        $google_service = new Google_Service_Oauth2($client);
        $user_info = $google_service->userinfo->get();

        // Store user data in session
        $_SESSION['user_name'] = $user_info->name;
        $_SESSION['user_email'] = $user_info->email;
        $_SESSION['user_picture'] = $user_info->picture;

        // Redirect to home page
        header('Location: home.php');
        exit();
    } else {
        echo "Error during authentication: " . htmlspecialchars($token['error']);
    }
} else {
    echo "No authorization code found.";
}