<?php
include 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$courseId = $_POST['courseId'] ?? null;
$midtermScore = $_POST['midtermScore'] ?? null;
$finalScore = $_POST['finalScore'] ?? null;

if (!$courseId || !$midtermScore || !$finalScore) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Check if the course_id already exists in enrollments_to_add
$checkSql = "SELECT COUNT(*) as count FROM enrollments_to_add WHERE course_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $courseId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$checkRow = $checkResult->fetch_assoc();

if ($checkRow['count'] > 0) {
    // Course already exists, so just notify the user without changing status code
    echo json_encode(['status' => 'warning', 'message' => 'Course ID already exists']);
    $checkStmt->close();
    $conn->close();
    exit;
}

$checkStmt->close();

// Insert the data into enrollments_to_add table
$insertSql = "INSERT INTO enrollments_to_add (course_id, midterm_score, final_score) VALUES (?, ?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("idd", $courseId, $midtermScore, $finalScore);

if ($insertStmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Enrollment added successfully']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to add enrollment: ' . $conn->error]);
}

$insertStmt->close();
$conn->close();
?>