<?php
header("Content-Type: text/html; charset=utf-8");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Stok Takip ve Satış Sistemi</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 px-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="anasayfa.php">📦 Stok Takip ve Satış</a>
            
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3 small">
                    Merhaba, <b><?= $_SESSION['ad_soyad'] ?? 'Kullanıcı' ?></b> 
                    <span class="badge bg-secondary ms-1"><?= ucfirst($_SESSION['rol'] ?? '') ?></span>
                </span>
                
                <a href="profil.php" class="text-white me-3 text-decoration-none small border-end pe-3">Profilim</a>
                <a href="cikis.php" class="btn btn-outline-danger btn-sm">Çıkış Yap</a>
            </div>
        </div>
    </nav>