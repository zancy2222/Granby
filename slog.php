<?php
include 'db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check teacher credentials
    $query = "SELECT * FROM teacher WHERE Tname = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $teacher = $result->fetch_assoc();
        
        // Verify password if it is hashed in the database
        if (password_verify($password, $teacher['password'])) {
            $_SESSION['teacher_id'] = $teacher['id'];
            $_SESSION['teacher_name'] = $teacher['Tname'];
            $_SESSION['branch'] = $teacher['Branch'];

            // Redirect to TeacherPage.php
            header("Location: TeacherPage.php");
            exit;
        } else {
            $error = "Invalid Username or Password";
        }
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
