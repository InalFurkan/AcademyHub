<?php
include 'db_connection.php';

$sql = "SELECT d.day_name, sta.start_time, sta.end_time
            FROM schedule_to_add sta
            JOIN days d ON sta.day_id = d.day_id";

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
