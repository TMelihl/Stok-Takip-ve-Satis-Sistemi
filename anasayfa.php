<?php
include 'baglan.php';
include 'header.php';
if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
$toplamUrun = $db->query("SELECT COUNT(*) FROM urunler")->fetchColumn();
$bekleyenSiparis = $db->query("SELECT COUNT(*) FROM siparisler WHERE durum = 'Beklemede'")->fetchColumn();
?>
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-primary text-white p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Toplam Ürün</h6>
                        <h2 class="mb-0"><?= $toplamUrun ?></h2>
                    </div>
                    <div class="display-6">📦</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-warning text-dark p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Bekleyen Sipariş</h6>
                        <h2 class="mb-0"><?= $bekleyenSiparis ?></h2>
                    </div>
                    <div class="display-6">⏳</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center g-4">
        <?php if($_SESSION['rol'] != 'musteri'): ?>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">📦</div>
                <h5>Ürün Ekle</h5>
                <p class="text-muted small">Yeni stok girişi yapın.</p>
                <a href="urun_ekle.php" class="btn btn-outline-primary btn-sm">Git</a>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">📦</div>
                <h5>Ürünler</h5>
                <p class="text-muted small">Mevcut stokları yönetin.</p>
                <a href="urunler.php" class="btn btn-outline-primary btn-sm">Git</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">🛒</div>
                <h5>Siparişler</h5>
                <p class="text-muted small">Sipariş geçmişi ve onay süreçleri.</p>
                <a href="siparisler.php" class="btn btn-outline-success btn-sm">Git</a>
            </div>
        </div>
        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'yonetici'): ?>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-4 mb-2">👤</div>
                <h5>Kullanıcılar</h5>
                <p class="text-muted small">Sistem yetkilerini yönetin.</p>
                <a href="liste.php" class="btn btn-outline-info btn-sm">Git</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>