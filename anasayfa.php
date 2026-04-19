<?php
include 'baglan.php';
include 'header.php';


if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
?>

<div class="container mt-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">📦</div>
                <h5>Ürün Ekle</h5>
                <p class="text-muted small">Yeni stok girişi yapın.</p>
                <a href="urun_ekle.php" class="btn btn-outline-primary btn-sm">Git</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">📊</div>
                <h5>Ürünler</h5>
                <p class="text-muted small">Stok listesini yönetin.</p>
                <a href="urunler.php" class="btn btn-outline-success btn-sm">Git</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">👤</div>
                <h5>Kullanıcılar</h5>
                <p class="text-muted small">Sistem yetkilerini yönetin.</p>
                <a href="liste.php" class="btn btn-outline-info btn-sm text-white">Git</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
