<?php
// HOCA SORARSA: Neden session başlattık?
// Çünkü login olan kullanıcının kimliğini (Adını, Yetkisini) sayfa değiştikçe unutmamak için (Hafızada tutmak için) kullanıyoruz.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
    die();
}

?>