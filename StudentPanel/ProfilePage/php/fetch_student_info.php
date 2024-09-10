<?php

session_start();

// Database connection
include 'db_connection.php';

// Get the student_id from the session or a GET/POST request
$student_id = $_SESSION['student_id']; // Eğer oturumda saklanıyorsa
// $student_id = $_GET['student_id']; // Eğer URL'den geçiyorsa

// Prepare the SQL query
// $sql = "SELECT name, surname, email, phone_number, receive_sms, receive_email, gpa, field_of_study FROM students WHERE student_id = ?";
$sql = "SELECT s.name, s.surname, s.email, s.phone_number, s.receive_sms, s.receive_email, s.password, s.gpa, s.field_of_study, f.field_name 
        FROM students s 
        JOIN fields_of_study f ON f.field_id = s.field_of_study  
        WHERE s.student_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode($student);
    } else {
        echo json_encode(["error" => "No student found"]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Database error"]);
}

$conn->close();
?>