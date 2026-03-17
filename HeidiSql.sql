CREATE TABLE IF NOT EXISTS kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(100) NOT NULL UNIQUE COMMENT 'Kullanıcı adı',
    sifre VARCHAR(255) NOT NULL COMMENT 'Şifrelenmiş parola',
    ad_soyad VARCHAR(255) NOT NULL COMMENT 'Ad Soyad',
    rol ENUM('yonetici', 'personel') NOT NULL DEFAULT 'personel' COMMENT 'Kullanıcı rolü',
    aktif TINYINT(1) DEFAULT 1 COMMENT '1=Aktif, 0=Pasif',
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;