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
    <title>Stok Takip Sistemi</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="anasayfa.php">📦 StokTakip</a>

            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">
                    Merhaba, <b><?= $_SESSION['ad_soyad'] ?? 'Kullanıcı' ?></b>
                </span>
                <a href="cikis.php" class="btn btn-outline-danger btn-sm">Çıkış Yap</a>
            </div>
        </div>
    </nav>