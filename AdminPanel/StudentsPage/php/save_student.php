<?php
include 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$studentID = $_POST['studentID'] ?? null;
$studentName = $_POST['studentName'] ?? null;
$studentSurname = $_POST['studentSurname'] ?? null;
$fieldOfStudy = $_POST['fieldOfStudy'] ?? null;
$emailAddress = $_POST['email'] ?? null;
$phoneNumber = $_POST['phoneNumber'] ?? null;
$receiveSMS = $_POST['receiveSMS'] ?? null;
$receiveEmail = $_POST['receiveEmail'] ?? null;
$gpa = $_POST['gpa'] ?? null;

// Validate inputs
if (!$studentName || !$studentSurname || !$fieldOfStudy || !$emailAddress || !$phoneNumber || !$receiveSMS || !$receiveEmail || !$gpa) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Determine if it's an update or insert
if ($studentID == -1) {
    // Insert new student
    $insertSql = "INSERT INTO students (name, surname, field_of_study, email, phone_number, receive_sms, receive_email, gpa, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'student')";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssssssis", $studentName, $studentSurname, $fieldOfStudy, $emailAddress, $phoneNumber, $receiveSMS, $receiveEmail, $gpa);
} else {
    // Update existing student
    $updateSql = "UPDATE students SET name = ?, surname = ?, field_of_study = ?, email = ?, phone_number = ?, receive_sms = ?, receive_email = ?, gpa = ? WHERE student_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssssisi", $studentName, $studentSurname, $fieldOfStudy, $emailAddress, $phoneNumber, $receiveSMS, $receiveEmail, $gpa, $studentID);
}

if ($stmt->execute()) {
    // Process enrollments_to_add
    $addSql = "INSERT INTO enrollments (student_id, course_id, midterm_score, final_score)
               SELECT $studentID, course_id, midterm_score, final_score FROM enrollments_to_add";
    $conn->query($addSql);

    // Retrieve and store enrollment_ids from enrollments_to_remove
    $enrollmentIDs = [];
    $result = $conn->query("SELECT enrollment_id FROM enrollments_to_remove");
    while ($row = $result->fetch_assoc()) {
        $enrollmentIDs[] = $row['enrollment_id'];
    }

    // Clear the enrollments_to_remove table
    $conn->query("TRUNCATE TABLE enrollments_to_remove");

    // Delete from enrollments based on stored enrollment_ids
    if (!empty($enrollmentIDs)) {
        $placeholders = implode(',', array_fill(0, count($enrollmentIDs), '?'));
        $deleteSql = "DELETE FROM enrollments WHERE enrollment_id IN ($placeholders)";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param(str_repeat('i', count($enrollmentIDs)), ...$enrollmentIDs);
        $stmt->execute();
    }
    echo json_encode(['status' => 'success', 'message' => 'Student data saved successfully']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save student data: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>