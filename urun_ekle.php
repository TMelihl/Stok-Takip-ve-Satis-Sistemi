<?php
include 'baglan.php';
include 'header.php';

if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

if($_POST) {
    $ad = $_POST['urun_adi'];
    $stok = $_POST['stok_miktari'];
    $fiyat = $_POST['fiyat'];

    $sorgu = $db->prepare("INSERT INTO urunler (urun_adi, stok_miktari, fiyat) VALUES (?, ?, ?)");
    if($sorgu->execute([$ad, $stok, $fiyat])) {
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
            <button type="submit" class="btn btn-primary w-100">Sisteme Kaydet</button>
            <a href="urunler.php" class="d-block mt-3 text-center text-decoration-none text-secondary">← Listeye Dön</a>
        </form>
    </div>
</div>

</body>
</html>
