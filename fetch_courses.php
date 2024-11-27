<?php
// fetch_courses.php
header('Content-Type: application/json');

// Include your database connection and configuration files here
require_once 'config.php';

$branch = $_GET['branch'] ?? '';
$courses = array();

if ($branch) {
    // Fetch courses for the selected branch from your database
    // Replace this with your actual database query
    $query = "SELECT DISTINCT course FROM courses WHERE branch = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $branch);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['course'];
    }
}

echo json_encode(['courses' => $courses]);