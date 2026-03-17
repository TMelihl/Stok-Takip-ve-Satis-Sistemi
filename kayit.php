<?php
$db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");

$guvenli_sifre = password_hash("123456", PASSWORD_DEFAULT);

$sorgu = $db->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol) VALUES (?, ?, ?, ?)");
$sorgu->execute(['meliht', $guvenli_sifre, 'Melih Topal', 'yonetici']);

echo "İlk yönetici kaydı başarıyla eklendi!";
?>