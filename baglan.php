<?php
// HOCA SORARSA: Neden session başlattık?
// Çünkü login olan kullanıcının kimliğini (Adını, Yetkisini) sayfa değiştikçe unutmamak için (Hafızada tutmak için) kullanıyoruz.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // HOCA SORARSA: Neden PDO kullandın? (mysql_query yerine)
    // Cevap: Çünkü PDO (PHP Data Objects) günceldir ve dışarıdan gelebilecek SQL Injection (Hack) saldırılarına karşı hazırlıklı ifadeler (prepare) kullanmamıza imkan tanır.
    // Bu kod PHP projemi, XAMPP içindeki 'stok_takip' adlı veritabanına bağlıyor.
    $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
} catch (PDOException $e) {
    // HOCA SORARSA: try-catch neden var?
    // Veritabanı şifresi değişirse veya çökerse, ekranda çirkin kod satırları çıkmasın, sadece hata mesajı yazsın diye ("Hata: ...")
    echo "Hata: " . $e->getMessage();
    die();
}
?>
