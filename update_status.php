<?php
include 'dbcon.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE teacher SET status = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Status updated successfully.")</script>';
        header("Location: Teacher.php");
        exit();
    } else {
        echo "Failed to update status.";
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid request.";
}
?>
