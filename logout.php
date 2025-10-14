<?php
require_once 'includes/Auth.php';

$auth = new Auth();
$auth->logout();

// Redirect to login page
header('Location: login.php?message=logged_out');
exit();
?>