<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ana Sayfa</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">Stok Takip Sistemi</span>
        <div class="text-white">
            Merhaba, <b><?= $_SESSION['ad_soyad'] ?></b> 
            <a href="cikis.php" class="btn btn-sm btn-danger ms-2">Çıkış</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h3>📦</h3>
                    <h5>Ürün Ekle</h5>
                    <a href="urun_ekle.php" class="btn btn-outline-primary btn-sm">Git</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h3>📊</h3>
                    <h5>Ürünler</h5>
                    <a href="urunler.php" class="btn btn-outline-success btn-sm">Git</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h3>👤</h3>
                    <h5>Kullanıcılar</h5>
                    <a href="liste.php" class="btn btn-outline-info btn-sm">Git</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>