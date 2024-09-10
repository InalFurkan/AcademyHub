<?php
header('Content-Type: application/json');

include 'db_connection.php';

$query = "SELECT * FROM announcements";
$result = mysqli_query($conn, $query);

$announcements = array();
while ($row = mysqli_fetch_assoc($result)) {
    $announcements[] = $row;
}

echo json_encode($announcements);
?>