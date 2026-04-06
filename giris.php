<?php
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

$hata = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = trim($_POST['kullanici_adi']);
    $girilen_sifre = $_POST['sifre'];

    if (empty($kadi) || empty($girilen_sifre)) {
        $hata = "Kullanıcı adı ve şifre boş bırakılamaz!";
    } else {
        $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ?");
        $sorgu->execute([$kadi]);
        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            if (password_verify($girilen_sifre, $kullanici['sifre'])) {
                $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];
                $_SESSION['rol'] = $kullanici['rol'];
                $_SESSION['ad_soyad'] = $kullanici['ad_soyad'];
                header("Location: anasayfa.php");
                exit;
            } else {
                $hata = "Şifre yanlış!";
            }
        } else {
            $hata = "Böyle bir kullanıcı bulunamadı!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-card { width: 100%; max-width: 400px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card shadow-sm p-4">
            <h4 class="text-center mb-4 fw-bold">Stok Takip Sistemi</h4>

            <?php if ($hata): ?>
                <div class="alert alert-danger"><?php echo $hata; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="sifre" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Giriş Yap</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>