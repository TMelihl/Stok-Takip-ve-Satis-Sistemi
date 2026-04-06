<?php
session_start();

if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$mesaj = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $urun_adi     = trim($_POST['urun_adi']);
    $stok_miktari = (int) $_POST['stok_miktari'];
    $fiyat        = (float) $_POST['fiyat'];

    $sorgu = $db->prepare("INSERT INTO urunler (urun_adi, stok_miktari, fiyat) VALUES (?, ?, ?)");
    $sorgu->execute([$urun_adi, $stok_miktari, $fiyat]);

    $mesaj = "Ürün başarıyla eklendi!";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="col-md-6">
            <h4 class="mb-3">📦 Yeni Ürün Ekle</h4>

            <?php if ($mesaj): ?>
                <div class="alert alert-success"><?php echo $mesaj; ?></div>
            <?php endif; ?>

            <div class="card p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Ürün Adı</label>
                        <input type="text" name="urun_adi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Miktarı</label>
                        <input type="number" name="stok_miktari" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fiyat (₺)</label>
                        <input type="number" name="fiyat" class="form-control" step="0.01" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kaydet</button>
                </form>
            </div>

            <a href="urunler.php" class="d-block mt-3">← Ürün Listesine Dön</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
