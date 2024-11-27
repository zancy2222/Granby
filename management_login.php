<?php
session_start();
require_once 'dbcon.php';  // Include your database connection file

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check if username and password match in the database
    $query = "SELECT * FROM m_login WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Validate the password
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            header("Location: Teacher.php");  // Redirect to the dashboard page on successful login
            exit();
        } else {
            $_SESSION['status'] = "Incorrect password!";
        }
    } else {
        $_SESSION['status'] = "Username not found!";
    }
}
?>
