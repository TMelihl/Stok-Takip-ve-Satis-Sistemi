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
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="anasayfa.php">📦 StokTakip</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="urunler.php">Ürünler</a></li>
                    
                    <?php if($_SESSION['rol'] == 'yonetici' || $_SESSION['rol'] == 'personel'): ?>
                        <li class="nav-item"><a class="nav-link" href="urun_ekle.php">Ürün Ekle</a></li>
                        <li class="nav-item"><a class="nav-link" href="siparis_listesi.php">Sipariş Listesi</a></li>
                    <?php endif; ?>
                    
                    <?php if($_SESSION['rol'] == 'musteri'): ?>
                        <li class="nav-item"><a class="nav-link" href="magazam.php">Mağazam</a></li>
                    <?php endif; ?>

                    <?php 
                    
                    if($_SESSION['rol'] == 'yonetici'): ?>
                        <li class="nav-item"><a class="nav-link" href="liste.php">Kullanıcılar</a></li>
                        <li class="nav-item"><a class="nav-link" href="form.php">Yeni Kullanıcı</a></li>
                    <?php endif; ?>
                </ul>
                <div class="text-white">
                    
                    Merhaba, <b>
                        <?= $_SESSION['ad_soyad'] ?? 'Misafir' ?>
                    </b>
                    <a href="cikis.php" class="btn btn-sm btn-danger ms-3">Çıkış Yap</a>
                </div>
            </div>
        </div>
    </nav>