<?php
include('dbcon.php');

$errors = array(); // Initialize an empty array for error messages

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    if (empty($email) || empty($password)) {
        $errors[] = 'Email and password are required!';
    } else {
        $query = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            header("location: student_info.php");
            exit(); // Important to prevent further execution
        } else {
            $errors[] = 'Invalid email or password';
        }
    }
}
?>
	