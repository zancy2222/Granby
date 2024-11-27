<?php
$con = mysqli_connect("localhost", "root", "", "4502397_demo");





// Check connection
if (!$con) {
    error_log("Failed to connect to MySQL: " . mysqli_connect_error());
    // You might want to redirect to an error page here
    header("Location: error.php");
    exit();
}

// Don't close the PHP tag