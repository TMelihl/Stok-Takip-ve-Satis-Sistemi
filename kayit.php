<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
$sifre = password_hash("123456", PASSWORD_DEFAULT);
$db->query("INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol)
VALUES ('meliht', '$sifre', 'Melih Topal', 'yonetici')");
echo "İlk yönetici (meliht:123456) başarıyla oluşturuldu.";
?>