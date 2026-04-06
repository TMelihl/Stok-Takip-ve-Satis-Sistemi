<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$sorgu = $db->query("SELECT * FROM kullanicilar");
$kullanicilar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Listesi - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <h4 class="mb-3">👥 Kullanıcı Listesi</h4>

        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>Ad Soyad</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kullanicilar as $kisi): ?>
                <tr>
                    <td><?php echo $kisi['id']; ?></td>
                    <td><?php echo htmlspecialchars($kisi['kullanici_adi']); ?></td>
                    <td><?php echo htmlspecialchars($kisi['ad_soyad']); ?></td>
                    <td><?php echo $kisi['rol']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
