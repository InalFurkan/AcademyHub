<?php
// logout.php

session_start();
session_unset(); // Tüm oturum değişkenlerini temizler
session_destroy(); // Oturumu yok eder

// JSON formatında yanıt gönder
echo json_encode(['success' => true]);
?>