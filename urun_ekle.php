<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

if($_POST) {
    $ad = $_POST['urun_adi'];
    $stok = $_POST['stok_miktari'];
    $fiyat = $_POST['fiyat'];

    $db->query("INSERT INTO urunler (urun_adi, stok_miktari, fiyat) VALUES ('$ad', '$stok', '$fiyat')");
    echo "Ürün eklendi";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ürün Ekle</title>
</head>
<body class="p-4">
    <div class="container" style="max-width: 450px;">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">📦 Yeni Ürün Ekle</h4>
            <form method="POST">
                <input type="text" name="urun_adi" class="form-control mb-2" placeholder="Ürün Adı" required>
                <input type="number" name="stok_miktari" class="form-control mb-2" placeholder="Stok Adedi" required>
                <input type="number" name="fiyat" step="0.01" class="form-control mb-3" placeholder="Birim Fiyat" required>
                <button type="submit" class="btn btn-primary w-100">Kaydet</button>
                <a href="anasayfa.php" class="d-block mt-3 text-center text-decoration-none">← Panele Dön</a>
            </form>
        </div>
    </div>
</body>
</html>