<?php
session_start(); // Her zaman oturum başlatılmalı

if (isset($_SESSION["fullName"])) {
    // Sadece gerekli verileri değil, tüm oturumu kapatmak daha doğru olur
    session_unset();     // Tüm oturum değişkenlerini temizler
    session_destroy();   // Oturumu tamamen yok eder

    // Yeni bir oturum başlatıp mesajı geçici olarak saklayabilirsin
    session_start();
    $_SESSION["message"] = "Başarıyla hesabından çıkış yaptın!";
}

// Ana sayfaya ya da giriş sayfasına yönlendirme
header("Location: ../../kutuphane/index.php");
exit;
?>
