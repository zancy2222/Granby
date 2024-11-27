<?php
include('dbcon.php');


if (isset($_POST['delete_teacher'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM teacher WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo '<script>alert("Data deleted")</script>';
        header("Location: Teacher.php");
        exit(); 
    } else {
        echo '<script>alert("Data deletion failed")</script>';
        header("Location: Teacher.php");
        exit();
    }
}



