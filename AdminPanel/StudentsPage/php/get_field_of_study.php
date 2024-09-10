<?php
include 'db_connection.php';

$sql = "SELECT field_id, field_name FROM fields_of_study";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["field_id"] . "'>" . $row["field_name"] . "</option>";
    }
} else {
    echo "<option value=''>No fields available</option>";
}

$conn->close();
?>
