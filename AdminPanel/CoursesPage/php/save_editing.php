<?php

include 'db_connection.php';

$courseId = $_POST['courseId'];
$courseName = $_POST['courseName'];
$courseField = $_POST['courseField'];

// Query 1: Update courses table

if ($courseId == -1) {
    // Insert new course
    $insertCourseQuery = "INSERT INTO courses (course_name, field_of_study) VALUES (?, ?)";
    $stmtInsertCourse = $conn->prepare($insertCourseQuery);
    $stmtInsertCourse->bind_param("ss", $courseName, $courseField);
    $stmtInsertCourse->execute();
    $courseId = $conn->insert_id; // Get the newly inserted course_id
} else {
    // Update existing course
    $updateCourseQuery = "UPDATE courses SET course_name = ?, field_of_study = ? WHERE course_id = ?";
    $stmtUpdateCourse = $conn->prepare($updateCourseQuery);
    $stmtUpdateCourse->bind_param("ssi", $courseName, $courseField, $courseId);
    $stmtUpdateCourse->execute();
}

// Query 2: Insert into course_schedule from schedule_to_add
$insertScheduleQuery = "INSERT INTO course_schedule (course_id, day_id, start_time, end_time)
                        SELECT ?, day_id, start_time, end_time
                        FROM schedule_to_add";
$stmtInsertSchedule = $conn->prepare($insertScheduleQuery);
$stmtInsertSchedule->bind_param("i", $courseId);
$stmtInsertSchedule->execute();

// Query 3: Delete from schedule_to_delete
$deleteScheduleQuery = "DELETE FROM course_schedule
                        WHERE schedule_id IN (SELECT schedule_id FROM schedule_to_delete)";
$stmtDeleteSchedule = $conn->prepare($deleteScheduleQuery);
$stmtDeleteSchedule->execute();

// Check if all queries were successful
if ($stmtUpdateCourse->affected_rows > 0 || $stmtInsertSchedule->affected_rows > 0 || $stmtDeleteSchedule->affected_rows > 0) {
    echo "Changes saved successfully";
} else {
    echo "No changes were made or an error occurred";
}

$stmtUpdateCourse->close();
$stmtInsertSchedule->close();
$stmtDeleteSchedule->close();
$conn->close();

?>