<?php
include 'db_connection.php';

header('Content-Type: application/json');

// `student_id`'yi GET parametresinden al
$studentId = $_GET['student_id'] ?? null;

if ($studentId === null) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing student_id']);
    exit;
}

try {
    // Enrollments tablosundan öğrencinin kayıtlarını sil
    $deleteEnrollmentsSql = "DELETE FROM enrollments WHERE student_id = ?";
    $stmtEnrollments = $conn->prepare($deleteEnrollmentsSql);
    $stmtEnrollments->bind_param("i", $studentId);
    $stmtEnrollments->execute();
    $stmtEnrollments->close();

    // Öğrenciyi students tablosundan sil
    $deleteStudentSql = "DELETE FROM students WHERE student_id = ?";
    $stmtStudent = $conn->prepare($deleteStudentSql);
    $stmtStudent->bind_param("i", $studentId);

    if ($stmtStudent->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Student and their enrollments deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete student: ' . $conn->error]);
    }

    $stmtStudent->close();
    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>