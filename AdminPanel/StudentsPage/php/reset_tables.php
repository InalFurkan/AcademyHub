<?php

include 'db_connection.php';


$sql1 = "DELETE FROM enrollments_to_add";
$result1 = mysqli_query($conn, $sql1);


$sql2 = "DELETE FROM enrollments_to_remove";
$result2 = mysqli_query($conn, $sql2);

if ($result1 && $result2) {
    echo "Reset successful";
} else {
    echo "Error resetting: " . mysqli_error($conn);
}

mysqli_close($conn);

?>