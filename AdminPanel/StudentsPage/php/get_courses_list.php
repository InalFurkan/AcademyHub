<?php
include 'db_connection.php';

$fieldOfStudy = isset($_GET['field_of_study']) ? $_GET['field_of_study'] : '';

if (empty($fieldOfStudy)) {
    echo "<option value=''>Please select a field of study first</option>";
    exit;
}

$sql = "SELECT course_id, course_name FROM courses WHERE field_of_study = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fieldOfStudy);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row["course_id"]) . "'>" . htmlspecialchars($row["course_name"]) . "</option>";
    }
} else {
    echo "<option value=''>No courses available for this field of study</option>";
}

$stmt->close();
$conn->close();

?>