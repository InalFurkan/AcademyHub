<?php

include 'db_connection.php';

// Delete all records from schedule_to_delete table
$sql1 = "DELETE FROM schedule_to_delete";
$result1 = mysqli_query($conn, $sql1);

// Delete all records from schedule_to_add table
$sql2 = "DELETE FROM schedule_to_add";
$result2 = mysqli_query($conn, $sql2);

if ($result1 && $result2) {
    echo json_encode(['status' => 'success', 'message' => 'Reset successful']);

} else {
    echo "Error resetting: " . mysqli_error($conn);
}

mysqli_close($conn);

?>