<?php
include "baglan.php";
include "header.php";
if (!isset($_SESSION['kullanici_adi']) || $_SESSION['rol'] != 'musteri') {
    header("Location: anasayfa.php");
    exit;
}
if (!isset($_GET['id'])) {
    header("Location: urunler.php");
    exit;
}
$urun_id = $_GET['id'];
$sorgu = $db->prepare("SELECT * FROM urunler WHERE id = ?");
$sorgu->execute([$urun_id]);
$urun = $sorgu->fetch(PDO::FETCH_ASSOC);
if (!$urun) {
    echo "Ürün bulunamadı.";
    exit;
}
if ($_POST) {
    if(!isset($_SESSION['kullanici_id'])){
        echo "<script>alert('Oturum süreniz dolmuş veya ID bulunamadı. Lütfen tekrar giriş yapın.'); window.location='cikis.php';</script>";
        exit;
    }
    $adet = (int)$_POST['adet'];
    if ($adet > $urun['stok_miktari']) {
        $hata = "Maalesef stoklarımızda sadece " . $urun['stok_miktari'] . " adet bulunmaktadır.";
    } elseif ($adet <= 0) {
        $hata = "Geçerli bir adet giriniz.";
    } else {
        $toplam_tutar = $adet * $urun['fiyat'];
        $musteri_id = $_SESSION['kullanici_id'];
        $siparis = $db->prepare("INSERT INTO siparisler (urun_id, musteri_id, adet, toplam_tutar) VALUES (?, ?, ?, ?)");
        if ($siparis->execute([$urun_id, $musteri_id, $adet, $toplam_tutar])) {
            echo "<script>alert('Siparişiniz başarıyla alındı! Yönetici onayı bekliyor.'); window.location='siparisler.php';</script>";
            exit;
        }
    }
}
?>
<div class="container" style="max-width: 500px;">
    <div class="card p-4 shadow-sm border-0">
        <h4 class="text-center">🛒 Sipariş Ver</h4>
        <hr>
        <?php if (isset($hata)): ?>
            <div class="alert alert-danger text-center p-2 mb-3" style="font-size: 14px;">
                ⚠️ <?= $hata ?>
            </div>
        <?php endif; ?>
        <div class="mb-3 text-center">
            <h5>Ürün: <span class="text-primary"><?= htmlspecialchars($urun['urun_adi']) ?></span></h5>
            <p class="mb-0 text-muted">Birim Fiyat: <b><?= number_format($urun['fiyat'], 2) ?> ₺</b></p>
            <p class="small text-muted">Mevcut Stok: <?= $urun['stok_miktari'] ?> adet</p>
        </div>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Kaç Adet İstiyorsunuz?</label>
                <input type="number" name="adet" class="form-control form-control-lg text-center" value="1" min="1" max="<?= $urun['stok_miktari'] ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">Siparişi Tamamla</button>
                <a href="urunler.php" class="btn btn-outline-secondary">İptal Et</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>