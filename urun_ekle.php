<?php
include 'baglan.php';
include 'header.php';

if (!isset($_SESSION['kullanici_adi']) || $_SESSION['rol'] == 'musteri') {
    header("Location: anasayfa.php");
    exit;
}

if ($_POST) {
    // HOCA YENİ BİR ALAN EKLENMESİNİ İSTERSE (Örn: Aciklama veya Kategori):
    // 1. Gelen veriyi buraya çek: $aciklama = $_POST['aciklama'];
    $ad = $_POST['urun_adi'];
    $stok = $_POST['stok_miktari'];
    $fiyat = $_POST['fiyat'];

    // 2. SQL sorgusuna o alanı ekle. Örn: INSERT INTO urunler (urun_adi, stok_miktari, fiyat, aciklama) VALUES (?, ?, ?, ?)
    $sorgu = $db->prepare("INSERT INTO urunler (urun_adi, stok_miktari, fiyat) VALUES (?, ?, ?)");
    
    // 3. execute içindeki diziye değişkeni ekle: execute([$ad, $stok, $fiyat, $aciklama])
    if ($sorgu->execute([$ad, $stok, $fiyat])) {
        echo "<script>alert('Ürün eklendi'); window.location='urunler.php';</script>";
    }
}
?>

<div class="container" style="max-width: 450px;">
    <div class="card p-4 shadow-sm border-0">
        <h4 class="mb-3 text-center">📦 Yeni Ürün Ekle</h4>
        <form method="POST">
            <input type="text" name="urun_adi" class="form-control mb-2" placeholder="Ürün Adı" required>
            <input type="number" name="stok_miktari" class="form-control mb-2" placeholder="Stok Adedi" required>
            <input type="text" name="fiyat" class="form-control mb-3" placeholder="Birim Fiyat (Örn: 15.50)" required>
            
            <!-- HOCA YENİ BİR FORM ALANI (INPUT) İSTERSE ALT SATIRA EKLE: -->
            <!-- <input type="text" name="aciklama" class="form-control mb-3" placeholder="Ürün Açıklaması"> -->
            <button type="submit" class="btn btn-primary w-100">Sisteme Kaydet</button>
            <a href="urunler.php" class="d-block mt-3 text-center text-decoration-none text-secondary">← Listeye Dön</a>
        </form>
    </div>
</div>

</body>

</html>