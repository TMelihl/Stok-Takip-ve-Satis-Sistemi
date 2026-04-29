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

        $_SESSION["kullanici_id"] = $kullanici["id"];
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

    <?php
    ?>
    <form method="POST" class="card p-5 shadow-sm border-0" style="width:100%; max-width:450px; border-radius:12px;">
        <h3 class="text-center mb-4">Sistem Girişi</h3>

        <?php if (isset($hata)): ?>
            <?php
            ?>
            <div class="alert alert-danger text-center p-2 mb-4" style="font-size: 15px;">
                Uyarı : <?= $hata ?>
            </div>
        <?php endif; ?>

        <input type="text" name="kadi" class="form-control form-control-lg mb-3" placeholder="Kullanıcı Adı" required>
        <input type="password" name="sifre" class="form-control form-control-lg mb-4" placeholder="Şifre" required>
        <button type="submit" class="btn btn-primary btn-lg w-100">Giriş Yap</button>
    </form>
</body>

</html>