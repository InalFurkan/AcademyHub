<?php
session_start();
include 'db_connection.php';  // Include your database connection file

$student_id = $_SESSION['student_id'];  // Assuming you've stored student_id in session

// Fetching courses and grades
$sql = "SELECT c.course_name, e.midterm_score, e.final_score, e.letter_grade 
        FROM enrollments e 
        JOIN courses c ON e.course_id = c.course_id 
        WHERE e.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$courses = array();
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

// Fetching student's GPA
$sql_gpa = "SELECT gpa FROM students WHERE student_id = ?";
$stmt_gpa = $conn->prepare($sql_gpa);
$stmt_gpa->bind_param("i", $student_id);
$stmt_gpa->execute();
$result_gpa = $stmt_gpa->get_result();
$gpa = $result_gpa->fetch_assoc();

// Close statements and connection
$stmt->close();
$stmt_gpa->close();
$conn->close();

// Add GPA to the response
$response = array(
    'courses' => $courses,
    'gpa' => $gpa['gpa']
);

echo json_encode($response);  // Return the data as JSON
?>