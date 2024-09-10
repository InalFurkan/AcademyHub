<?php

include 'db_connection.php';

$enrollmentID = $_POST['enrollmentID'];

// Fetch the enrollment record
$fetchSql = "SELECT enrollment_id, course_id, midterm_score, final_score FROM enrollments WHERE enrollment_id = ?";
$fetchStmt = $conn->prepare($fetchSql);
$fetchStmt->bind_param("i", $enrollmentID);
$fetchStmt->execute();
$result = $fetchStmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Check if the record already exists in enrollments_to_remove
    $checkSql = "SELECT COUNT(*) FROM enrollments_to_remove WHERE course_id = ? AND enrollment_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $row['course_id'], $row['enrollment_id']);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        // Record already exists, return a message
        echo json_encode(array("success" => false, "message" => "Record already exists in the removal list."));
    } else {
        // Insert the fetched record into enrollments_to_remove table
        $insertSql = "INSERT INTO enrollments_to_remove (enrollment_id, course_id, midterm_score, final_score) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iiid", $row['enrollment_id'], $row['course_id'], $row['midterm_score'], $row['final_score']);

        if ($insertStmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Enrollment added to removal list successfully."));
        } else {
            echo json_encode(array("success" => false, "message" => "Error adding enrollment to removal list."));
        }

        $insertStmt->close();
    }
} else {
    echo json_encode(array("success" => false, "message" => "Enrollment not found."));
}

$fetchStmt->close();
$conn->close();
