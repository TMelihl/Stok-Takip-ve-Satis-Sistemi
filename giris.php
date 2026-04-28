<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
session_start();

if ($_POST) {
    $kadi = trim($_POST["kadi"]);
    $sifre = $_POST["sifre"];

    $sorgu = $db->prepare("select * from kullanicilar where kullanici_adi = ?");
    $sorgu->execute([$kadi]);
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($kullanici && password_verify($sifre, $kullanici["sifre"])) {
        $_SESSION["kullanici_adi"] = $kullanici["kullanici_adi"];
        $_SESSION["ad_soyad"] = $kullanici["ad_soyad"];
        $_SESSION["rol"] = $kullanici["rol"];
        
        header("Location: anasayfa.php");
    } else {
        $hata = "Kullanıcı adı veya şifre hatalı";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Giriş Yap</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">
    <form method="POST" class="card p-4 shadow-sm" style="width:300px;">
        <h4 class="text-center mb-3">Sistem Girişi</h4>

        <?php if (isset($hata)): ?>
            <div class="alert alert-danger text-center p-2 mb-3" style="font-size: 14px;">
                Uyarı : <?= $hata ?>
            </div>
        <?php endif; ?>

        <input type="text" name="kadi" class="form-control mb-2" placeholder="Kullanıcı Adı" required>
        <input type="password" name="sifre" class="form-control mb-3" placeholder="Şifre" required>
        <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
    </form>
</body>
</html>
