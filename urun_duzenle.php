<?php
include "header.php";
include "baglan.php";
if (!isset($_SESSION['kullanici_adi']) || $_SESSION['rol'] == 'musteri') {
    header("Location: anasayfa.php");
    exit;
}
$id = $_GET['id'];
$sorgu = $db->prepare("SELECT * FROM urunler WHERE id = ?");
$sorgu->execute([$id]);
$urun = $sorgu->fetch(PDO::FETCH_ASSOC);
if($_POST) {
    $ad = $_POST['urun_adi'];
    $stok = $_POST['stok_miktari'];
    $fiyat = $_POST['fiyat'];
    $guncelle = $db->prepare("UPDATE urunler SET urun_adi = ?, stok_miktari = ?, fiyat = ? WHERE id = ?");
    if($guncelle->execute([$ad, $stok, $fiyat, $id])) {
        header("Location: urunler.php?islem=guncellendi");
        exit;
    }
}
?>
<div class="container" style="max-width: 500px;">
    <div class="card p-4 shadow-sm border-0">
        <h4 class="text-center">✏️ Ürün Düzenle</h4>
        <hr>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Ürün Adı:</label>
                <input type="text" name="urun_adi" class="form-control"
                    value="<?= htmlspecialchars($urun['urun_adi']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok Miktarı:</label>
                <input type="number" name="stok_miktari" class="form-control" value="<?= $urun['stok_miktari'] ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Birim Fiyat (₺):</label>
                <input type="text" name="fiyat" class="form-control" value="<?= $urun['fiyat'] ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                <a href="urunler.php" class="btn btn-outline-secondary">İptal Et</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>