<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$sorgu = $db->query("SELECT * FROM urunler ORDER BY id DESC");
$urunler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📦 Ürün Listesi</h4>
            <a href="urun_ekle.php" class="btn btn-primary">+ Yeni Ürün Ekle</a>
        </div>

        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ürün Adı</th>
                    <th>Stok Miktarı</th>
                    <th>Fiyat (₺)</th>
                    <th>Eklenme Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($urunler as $urun): ?>
                <tr>
                    <td><?php echo $urun['id']; ?></td>
                    <td><?php echo htmlspecialchars($urun['urun_adi']); ?></td>
                    <td><?php echo $urun['stok_miktari']; ?></td>
                    <td><?php echo number_format($urun['fiyat'], 2); ?> ₺</td>
                    <td><?php echo $urun['olusturma_tarihi']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
