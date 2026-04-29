<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
session_start();
if ($_POST) {
    // 1. ADIM: Formdan gelen kullanıcı adı ve şifreyi PHP değişkenine aldık.
    $kadi = trim($_POST["kadi"]);
    $sifre = $_POST["sifre"];

    // 2. ADIM: "kullanicilar" tablosuna gidip, formdan gelen "kadi" ile eşleşen biri var mı diye soruyoruz. (KİM NEREDEN ÇEKİYOR?)
    $sorgu = $db->prepare("select * from kullanicilar where kullanici_adi = ?");
    $sorgu->execute([$kadi]);
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC); // Eşleşen satırı Dizi (Array) olarak $kullanici değişkenine çektik.

    // 3. ADIM: Eğer böyle birisi varsa (-> kadi doğruysa) VE girdiği şifre veritabanındaki kriptolu şifre ile aynıysa
    // HOCA SORARSA: password_verify ne işe yarar?
    // Cevap: Biz şifreleri veritabanında 1234 diye tutmuyoruz (hashliyoruz). Kullanıcının girdiği 1234 şifresiyle, db'deki karmaşık yazıyı karşılaştırıp doğruluyor.
    if ($kullanici && password_verify($sifre, $kullanici["sifre"])) {

        // 4. ADIM: Doğrulama başarılı! Giriş izni verdik ve kullanıcının adını "Session" isimli cüzdana(hafızaya) koyduk. 
        // Böylece diğer sayfalardaki (anasayfa, urunler) "izinsiz girenleri atma" algoritmalarından geçebilecek.
        $_SESSION["kullanici_id"] = $kullanici["id"];
        $_SESSION["kullanici_adi"] = $kullanici["kullanici_adi"];
        $_SESSION["ad_soyad"] = $kullanici["ad_soyad"];
        $_SESSION["rol"] = $kullanici["rol"]; // MÜŞTERİ, YÖNETİCİ VEYA PERSONEL OLDUĞUNU KAYDET

        // Giriş başarılı olunca kullanıcıyı Yönetim Paneline (anasayfa.php) yolluyoruz.
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
    // --- KUTU BÜYÜTME/ESNETME REHBERİ (Hoca sorarsa) ---
    // 
    // 1) Kutuyu sağa/sola ENİNE GENİŞLETMEK İÇİN hemen aşağıdaki form satırını şu şekilde değiştir:
    // <form method="POST" class="card p-5 shadow-sm border-0" style="width:100%; max-width:600px; border-radius:12px;">
    //
    // 2) Kutuyu yukarı/aşağı DİKEY BOYDA UZATMAK İÇİN hemen aşağıdaki form satırını şu şekilde değiştir (sona eklenen koda dikkat):
    // <form method="POST" class="card p-5 shadow-sm border-0" style="width:100%; max-width:450px; border-radius:12px; min-height:500px;">
    ?>
    <form method="POST" class="card p-5 shadow-sm border-0" style="width:100%; max-width:450px; border-radius:12px;">
        <h3 class="text-center mb-4">Sistem Girişi</h3>

        <?php if (isset($hata)): ?>
            <?php
            // HOCA "HATA MESAJINI NEDEN EKRANIN TEPESİNE DEĞİL DE BURAYA KUTU İÇİNE YAZDIRDIN?" DERSE:
            // Cevap: Kullanıcı deneyimi (UX) gereği alınan hata mesajları sayfanın tepesinde boşlukta durmak yerine formun merkezinde, Bootstrap'in alert-danger uyarı kutusu içerisinde çıkmalıdır. Bu profesyonel kodlama standartı'dır.
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