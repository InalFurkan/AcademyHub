<?php

include 'db_connection.php';

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
} else {
    echo json_encode(array('error' => 'No student ID provided.'));
    exit;
}

// Fetch student information
$sql_student = "SELECT student_id, name, surname, email, phone_number, receive_sms, receive_email, gpa, field_of_study FROM students WHERE student_id = ?";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bind_param("i", $student_id);
$stmt_student->execute();
$result_student = $stmt_student->get_result();


if ($result_student->num_rows > 0) {
    $student_data = $result_student->fetch_assoc();

    // Fetch enrolled courses
    $sql_courses = "SELECT e.enrollment_id, e.student_id, c.course_name, e.midterm_score, e.final_score, e.average, e.letter_grade 
                        FROM enrollments e 
                        JOIN courses c ON e.course_id = c.course_id 
                        WHERE e.student_id = ?";

    $stmt_courses = $conn->prepare($sql_courses);
    $stmt_courses->bind_param("i", $student_id);
    $stmt_courses->execute();
    $result_courses = $stmt_courses->get_result();

    $enrolled_courses = array();
    while ($row = $result_courses->fetch_assoc()) {
        $enrolled_courses[] = $row;
    }

    // Combine student data and enrolled courses
    $response = array(
        'student' => $student_data,
        'enrolled_courses' => $enrolled_courses
    );

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Student not found.'));
}


$stmt_student->close();
if ($stmt_courses !== null) {
    $stmt_courses->close();
}
$conn->close();
?>