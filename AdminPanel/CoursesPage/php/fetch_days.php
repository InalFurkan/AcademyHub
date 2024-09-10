<?php
// Veritabanı bağlantısını içe aktarın
include 'db_connection.php';

// Günleri çekmek için SQL sorgusu
$sql = "SELECT day_id, day_name FROM days";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["day_id"] . "'>" . $row["day_name"] . "</option>";
    }
} else {
    echo "<option value=''>Days could not be fetched</option>";
}


// Bağlantıyı kapat
$conn->close();
?>