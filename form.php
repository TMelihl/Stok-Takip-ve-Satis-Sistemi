<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = $_POST['kullanici_adi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $ad = $_POST['ad_soyad'];
    $rol = $_POST['rol'];

    $sorgu = $db->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol) VALUES (?, ?, ?, ?)");
    $sorgu->execute([$kadi, $sifre, $ad, $rol]);

    echo "<h3 style='color:green;'>Sisteme yeni kişi başarıyla eklendi!</h3>";
}
?>

<h2>Yeni Kullanıcı Ekle</h2>
<form method="POST">
    Kullanıcı Adı: <br>
    <input type="text" name="kullanici_adi" required><br><br>
    
    Şifre: <br>
    <input type="password" name="sifre" required><br><br>
    
    Ad Soyad: <br>
    <input type="text" name="ad_soyad" required><br><br>
    
    Rol: <br>
    <select name="rol">
        <option value="personel">Personel</option>
        <option value="yonetici">Yönetici</option>
    </select><br><br>
    
    <button type="submit">Kaydet</button>
</form>