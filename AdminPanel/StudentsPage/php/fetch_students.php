<?php
// Veritabanı bağlantısını içe aktarın
include 'db_connection.php';

// Öğrenci bilgilerini çekmek için SQL sorgusu
$sql = "SELECT student_id, name, surname, field_of_study, email, phone_number, receive_sms, receive_email, gpa FROM students";
$result = $conn->query($sql);

// Tablo verilerini HTML formatında oluşturun
if ($result->num_rows > 0) {
    // Her bir satırı tabloya ekle
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='radio' name='selected_student' value='" . $row["student_id"] . "'></td>";
        echo "<td>" . $row["student_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["surname"] . "</td>";
        echo "<td>" . $row["field_of_study"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        echo "<td>" . ($row["receive_sms"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["receive_email"] ? "Yes" : "No") . "</td>";
        echo "<td>" . $row["gpa"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}


// Bağlantıyı kapat
$conn->close();
?>