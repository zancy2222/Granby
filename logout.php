<?php
session_start();
include('dbcon.php');

// Delete remember me token if exists
if (isset($_COOKIE['remember_token'])) {
    $token = mysqli_real_escape_string($con, $_COOKIE['remember_token']);
    mysqli_query($con, "DELETE FROM remember_tokens WHERE token = '$token'");
    setcookie('remember_token', '', time() - 3600, '/');
}

// Clear session
session_unset();
session_destroy();

// Redirect to login page
header('Location: userpage.php');
exit();
?>