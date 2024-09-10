<?php
include 'db_connection.php';

$selectedCourseId = $_GET['course_id'];

// Start a transaction
$conn->begin_transaction();

try {
    // First, delete related records in course_schedule
    $deleteScheduleSql = "DELETE FROM course_schedule WHERE course_id = ?";
    $deleteScheduleStmt = $conn->prepare($deleteScheduleSql);
    $deleteScheduleStmt->bind_param("i", $selectedCourseId);
    $deleteScheduleStmt->execute();

    // Then, delete the course
    $deleteSql = "DELETE FROM courses WHERE course_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $selectedCourseId);
    $deleteStmt->execute();

    // If we get here, both queries were successful
    $conn->commit();
    echo "Course and related schedules successfully deleted.";
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>