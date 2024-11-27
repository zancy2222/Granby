<?php
include('db.php'); // Make sure to connect to the database

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the updated values from the form
    $id_student = mysqli_real_escape_string($con, $_POST['id_student']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $mname = mysqli_real_escape_string($con, $_POST['mname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
    $branch = mysqli_real_escape_string($con, $_POST['branch']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $section = mysqli_real_escape_string($con, $_POST['section']);

    // Update the user profile in the database
    $query = "UPDATE slogin SET Fname='$fname', Mname='$mname', Lname='$lname', Suffix='$suffix', Branch='$branch', Course='$course', Section='$section' WHERE id_student='$id_student'";

    if (mysqli_query($con, $query)) {
        // Redirect to profile page or display success message
        header('Location: StudentProfile.php');
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
}
?>
