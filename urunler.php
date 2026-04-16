<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$urunler = $db->query("SELECT * FROM urunler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ürün Listesi</title>
</head>
<body class="p-4 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4>📊 Güncel Ürün Listesi</h4>
            <a href="anasayfa.php" class="btn btn-secondary btn-sm">Geri Dön</a>
        </div>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Ürün Adı</th>
                    <th>Stok</th>
                    <th>Fiyat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($urunler as $urun): ?>
                <tr>
                    <td><?= htmlspecialchars($urun['urun_adi']) ?></td>
                    <td><?= $urun['stok_miktari'] ?></td>
                    <td><?= number_format($urun['fiyat'], 2) ?> ₺</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>