<?php
session_start(); 

try {
    $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

$hata_mesaji = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = isset($_POST['kullanici_adi']) ? trim($_POST['kullanici_adi']) : '';
    $girilen_sifre = isset($_POST['sifre']) ? $_POST['sifre'] : '';

    if (empty($kadi) || empty($girilen_sifre)) {
        $hata_mesaji = "Kullanıcı adı ve şifre boş bırakılamaz!";
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
                $hata_mesaji = "Şifre yanlış!";
            }
        } else {
            $hata_mesaji = "Böyle bir kullanıcı bulunamadı!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisteme Giriş - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: white;
        }
        .login-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="login-title">Stok Takip Sistemi</h3>
        
        <?php if (!empty($hata_mesaji)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata_mesaji; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="kullanici_adi" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required autofocus placeholder="Kullanıcı adınızı girin">
            </div>
            
            <div class="mb-4">
                <label for="sifre" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="sifre" name="sifre" required placeholder="Şifrenizi girin">
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Giriş Yap</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>