<?php
include 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$dayId = $_POST['dayId'] ?? null;
$startTime = $_POST['startTime'] ?? null;
$finishTime = $_POST['finishTime'] ?? null;

if (!$dayId || !$startTime || !$finishTime) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$sql = "INSERT INTO schedule_to_add (day_id, start_time, end_time) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $dayId, $startTime, $finishTime);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Schedule added successfully']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to add schedule: ' . $conn->error]);
}

$stmt->close();
$conn->close();
