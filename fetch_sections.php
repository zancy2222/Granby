<?php
// fetch_sections.php
header('Content-Type: application/json');

// Include your database connection and configuration files here
require_once 'config.php';

$branch = $_GET['branch'] ?? '';
$course = $_GET['course'] ?? '';
$sections = array();

if ($branch && $course) {
    // Fetch sections for the selected branch and course from your database
    // Replace this with your actual database query
    $query = "SELECT DISTINCT section FROM sections WHERE branch = ? AND course = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $branch, $course);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $sections[] = $row['section'];
    }
}

echo json_encode(['sections' => $sections]);