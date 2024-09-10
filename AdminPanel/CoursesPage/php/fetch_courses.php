<?php
// Veritabanı bağlantısını içe aktarın
include 'db_connection.php';

// Öğrenci bilgilerini çekmek için SQL sorgusu
$sql = "SELECT c.course_id, c.course_name, f.field_name 
        FROM courses c
        JOIN fields_of_study f ON c.field_of_study = f.field_id";
$result = $conn->query($sql);

// JavaScript değişkeni tanımla
echo "<script>var selectedCourseId = '';</script>";

// Tablo verilerini HTML formatında oluşturun
if ($result->num_rows > 0) {
    // Her bir satırı tabloya ekle

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='radio' name='selected_course' value='" . $row["course_id"] . "' onclick='editCourseInfo(this.value)'></td>";
        echo "<td>" . $row["course_id"] . "</td>";
        echo "<td>" . $row["course_name"] . "</td>";
        echo "<td>" . $row["field_name"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}

// Bağlantıyı kapat
$conn->close();
?>