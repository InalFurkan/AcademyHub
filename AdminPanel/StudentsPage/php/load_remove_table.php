<?php
include 'db_connection.php';

$sql = "SELECT c.course_name, etr.midterm_score, etr.final_score
        FROM enrollments_to_remove etr
        JOIN courses c ON etr.course_id = c.course_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $schedules[] = $row;
}

echo json_encode($schedules);

$stmt->close();
$conn->close();
