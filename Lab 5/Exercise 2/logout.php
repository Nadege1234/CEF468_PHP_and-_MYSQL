<?php
session_start();
session_unset();
session_destroy();
header("Location: google_login.php");
exit;
