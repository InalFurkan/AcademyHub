<?php
include 'db_connection.php';

$selectedCourseId = $_GET['course_id'];

$sql = "SELECT cs.schedule_id, cs.course_id, d.day_name, cs.start_time, cs.end_time
            FROM course_schedule cs
            JOIN days d ON cs.day_id = d.day_id
            WHERE cs.course_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $selectedCourseId);
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $schedules[] = $row;
}

echo json_encode($schedules);

$stmt->close();
$conn->close();
