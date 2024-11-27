<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['m_username']);
}

if (!isLoggedIn()) {
    header('Location: mlogin.php');
    exit();
}
?>