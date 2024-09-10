<?php
// Veritabanı bağlantısını içe aktarın
include 'db_connection.php';

$selectedCourseId = $_POST['course_id'];

// Öğrenci bilgilerini çekmek için SQL sorgusu
$sql = "SELECT cs.schedule_id, cs.course_id, cs.day_id, d.day_name, cs.start_time, cs.end_time
            FROM course_schedule cs
            JOIN days d ON cs.day_id = d.day_id
            WHERE cs.course_id = 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $selectedCourseId);
$stmt->execute();
$result = $stmt->get_result();

// Tablo verilerini HTML formatında oluşturun
if ($result->num_rows > 0) {
    // Her bir satırı tabloya ekle
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='radio' name='selected_class' value='" . $row["schedule_id"] . "'></td>";
        echo "<td>" . $row["day_name"] . "</td>";
        echo "<td>" . $row["start_time"] . "</td>";
        echo "<td>" . $row["end_time"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}

// Bağlantıyı kapat
$stmt->close();


$conn->close();
?>