<?php
session_start();

function auth_check() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
}
?>
