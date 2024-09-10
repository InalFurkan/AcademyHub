<?php
include 'db_connection.php';

$scheduleId = $_GET['schedule_id'];

// First, select the data from course_schedule
$selectSql = "SELECT schedule_id, day_id, start_time, end_time 
              FROM course_schedule 
              WHERE schedule_id = ?";

$selectStmt = $conn->prepare($selectSql);
$selectStmt->bind_param("i", $scheduleId);
$selectStmt->execute();
$result = $selectStmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Now, insert the data into schedule_to_delete
    $insertSql = "INSERT INTO schedule_to_delete (schedule_id, day_id, start_time, end_time) 
                  VALUES (?, ?, ?, ?)";

    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iiss", $row['schedule_id'], $row['day_id'], $row['start_time'], $row['end_time']);

    if ($insertStmt->execute()) {
        echo "Schedule successfully moved to delete table.";
    } else {
        echo "Error moving schedule: " . $conn->error;
    }

    $insertStmt->close();
} else {
    echo "No schedule found with the given ID.";
}

$selectStmt->close();
$conn->close();
?>