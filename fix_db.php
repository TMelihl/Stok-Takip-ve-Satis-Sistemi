<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("DROP TABLE IF EXISTS siparisler");

    $sql = "
    CREATE TABLE siparisler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        urun_id INT,
        musteri_id INT,
        adet INT DEFAULT 1,
        toplam_tutar DECIMAL(10,2),
        durum ENUM('Beklemede', 'Onaylandı', 'Reddedildi') DEFAULT 'Beklemede',
        islem_yapan_id INT NULL,
        islem_tarihi TIMESTAMP NULL,
        tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (urun_id) REFERENCES urunler(id),
        FOREIGN KEY (musteri_id) REFERENCES kullanicilar(id),
        FOREIGN KEY (islem_yapan_id) REFERENCES kullanicilar(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    $db->exec($sql);
    echo "BASARILI";
} catch(PDOException $e) {
    echo "HATA: " . $e->getMessage();
}
?>