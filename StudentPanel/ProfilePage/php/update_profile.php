<?php
// update_profile.php

// Veritabanı bağlantı dosyanızı buraya ekleyin
include 'db_connection.php';

header('Content-Type: application/json');

// Kullanıcı oturumunu kontrol et
session_start();
if (!isset($_SESSION['student_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

// POST verilerini al
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['currentPassword'], $data['newPassword'], $data['receiveSms'], $data['receiveEmail'])) {
    echo json_encode(['success' => false, 'error' => 'Incomplete data']);
    exit();
}

$currentPassword = $data['currentPassword'];
$newPassword = $data['newPassword'];
$receiveSms = (int) $data['receiveSms'];
$receiveEmail = (int) $data['receiveEmail'];

// Kullanıcının mevcut şifresini doğrula
$sql = "SELECT password FROM students WHERE student_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Database prepare error']);
    exit();
}
$stmt->bind_param('i', $_SESSION['student_id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($dbPassword);
$stmt->fetch();
$stmt->close();

// Şifreleri doğrudan karşılaştır
if ($currentPassword === $dbPassword) {
    // Şifre güncelle
    if (!empty($newPassword)) {
        $sql = "UPDATE students SET password = ?, receive_sms = ?, receive_email = ? WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'error' => 'Database prepare error']);
            exit();
        }
        $stmt->bind_param('siii', $newPassword, $receiveSms, $receiveEmail, $_SESSION['student_id']);
    } else {
        $sql = "UPDATE students SET receive_sms = ?, receive_email = ? WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'error' => 'Database prepare error']);
            exit();
        }
        $stmt->bind_param('iii', $receiveSms, $receiveEmail, $_SESSION['student_id']);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database execute error']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
}

$conn->close();
?>