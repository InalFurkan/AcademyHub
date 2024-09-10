<?php
session_start();
include 'db_connection.php';  // Include your database connection file

// Öğrenci ID'sini oturumdan al
$student_id = $_SESSION['student_id'];

// SQL sorgusunu öğrenci ID'sine göre düzenle
$sql = "SELECT c.course_name, cs.day_id, cs.start_time, cs.end_time 
        FROM course_schedule cs 
        JOIN courses c ON cs.course_id = c.course_id 
        WHERE cs.course_id IN (
            SELECT course_id 
            FROM enrollments 
            WHERE student_id = ?
        )";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $schedules[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($schedules);  // Return the data as JSON
?>