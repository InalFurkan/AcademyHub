<?php
// Veritabanı bağlantısını içe aktarın
include 'db_connection.php';

// Öğrenci ID'sini POST ile alın
$student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;

if ($student_id > 0) {
    // Öğrenci ID'sine göre SQL sorgusunu oluşturun
    $sql = "SELECT 
                enrollments.enrollment_id, 
                enrollments.student_id, 
                enrollments.course_id,
                courses.course_name, 
                enrollments.midterm_score, 
                enrollments.final_score, 
                enrollments.average, 
                enrollments.letter_grade
            FROM 
                enrollments
            JOIN 
                courses ON enrollments.course_id = courses.course_id
            WHERE
                enrollments.student_id = ?";

    // Sorgu için hazırlanmış ifade (prepared statement)
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Tablo verilerini HTML formatında oluşturun
    if ($result->num_rows > 0) {
        // Her bir satırı tabloya ekle
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["course_id"] . "</td>";
            echo "<td>" . $row["course_name"] . "</td>";
            echo "<td>" . $row["midterm_score"] . "</td>";
            echo "<td>" . $row["final_score"] . "</td>";
            echo "<td>" . $row["average"] . "</td>";
            echo "<td>" . $row["letter_grade"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }

    // Bağlantıyı kapat
    $stmt->close();
} else {
    echo "<tr><td colspan='6'>Invalid student ID</td></tr>";
}

$conn->close();
?>