<?php
include 'db_connection.php';

header('Content-Type: application/json');

// Fetch the enrollments along with course names
$sql = "
    SELECT c.course_name, eta.midterm_score, eta.final_score
    FROM enrollments_to_add eta
    JOIN courses c ON eta.course_id = c.course_id
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$enrollments = array();
while ($row = $result->fetch_assoc()) {
    $enrollments[] = $row;
}

echo json_encode($enrollments);

$stmt->close();
$conn->close();
?>