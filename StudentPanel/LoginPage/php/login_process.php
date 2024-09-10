<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // E-posta ile öğrenci bilgilerini sorgulama
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    // Eğer öğrenci bulunursa ve şifre doğruysa
    if ($student && $password === $student['password']) {
        // Başarılı giriş
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['name'] = $student['name'];
        $_SESSION['surname'] = $student['surname'];

        // JSON formatında başarılı yanıt döndür
        echo json_encode(['success' => true]);
    } else {
        // Giriş başarısız, yanlış e-posta veya şifre
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }

    $stmt->close();
    $conn->close();
} else {
    // Yanlış HTTP metodu kullanımı
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>