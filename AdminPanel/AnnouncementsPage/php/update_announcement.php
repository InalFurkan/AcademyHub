<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST verilerini al
    $announcement_id = $_POST['announcement_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $current_time = date('Y-m-d H:i:s'); // Şu anki zamanı al

    if ($announcement_id == -1) {
        // Yeni duyuru oluştur
        $sql = "INSERT INTO announcements (title, content) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ss', $title, $content);

            if ($stmt->execute()) {
                echo 'New announcement created successfully.';
            } else {
                echo 'Error creating announcement: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Error preparing statement: ' . $conn->error;
        }
    } else {
        // Var olan duyuruyu güncelle
        $sql = "UPDATE announcements SET title = ?, content = ?, updated_at = ? WHERE announcement_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('sssi', $title, $content, $current_time, $announcement_id);

            if ($stmt->execute()) {
                echo 'Announcement updated successfully.';
            } else {
                echo 'Error updating announcement: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Error preparing statement: ' . $conn->error;
        }
    }

    $conn->close();
} else {
    echo 'Invalid request method.';
}
