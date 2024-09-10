<?php
include 'db_connection.php';

$sql = "SELECT announcement_id, title, content, DATE_FORMAT(created_at, '%d.%m.%Y') as created_at FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);

$announcements = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($announcements);
?>