<?php
// Veritabanı bağlantısını dahil edin
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcement_id'])) {
    $announcementId = $_POST['announcement_id'];

    // SQL sorgusu ile duyuruyu sil
    $sql = "DELETE FROM announcements WHERE announcement_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $announcementId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>