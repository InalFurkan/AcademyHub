<?php
include 'db_connection.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $stmt = $conn->prepare("SELECT * FROM courses WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Course not found.']);
    }
    $stmt->close();
} else {
    // echo json_encode(['error' => 'No course ID provided.']);
}

$conn->close();
?>