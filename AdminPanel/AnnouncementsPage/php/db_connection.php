<?php
$servername = "localhost"; // veya sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "academy-hub"; // İçe aktardığınız veritabanı adı

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Bağlantıyı kapat

?>