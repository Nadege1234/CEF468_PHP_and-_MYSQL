<?php
$public_pages = ['home.php', 'login.php', 'register.php'];

$current_page = basename($_SERVER['PHP_SELF']);

if (!in_array($current_page, $public_pages)) {
    require_once 'auth_check.php';
    auth_check();
}
?>
