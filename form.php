<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$mesaj = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = $_POST['kullanici_adi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $ad = $_POST['ad_soyad'];
    $rol = $_POST['rol'];

    $sorgu = $db->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol) VALUES (?, ?, ?, ?)");
    $sorgu->execute([$kadi, $sifre, $ad, $rol]);

    $mesaj = "Kullanıcı başarıyla eklendi!";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Ekle - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="col-md-5">
            <h4 class="mb-3">👤 Yeni Kullanıcı Ekle</h4>

            <?php if ($mesaj): ?>
                <div class="alert alert-success"><?php echo $mesaj; ?></div>
            <?php endif; ?>

            <div class="card p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Kullanıcı Adı</label>
                        <input type="text" name="kullanici_adi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="sifre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ad Soyad</label>
                        <input type="text" name="ad_soyad" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                            <option value="personel">Personel</option>
                            <option value="yonetici">Yönetici</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>