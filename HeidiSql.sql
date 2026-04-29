-- Kullanıcı Tablosu
CREATE TABLE IF NOT EXISTS kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(100) NOT NULL UNIQUE,
    sifre VARCHAR(255) NOT NULL,
    ad_soyad VARCHAR(255) NOT NULL,
    rol ENUM('yonetici', 'personel', 'musteri') NOT NULL DEFAULT 'personel',
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ürün Tablosu
CREATE TABLE IF NOT EXISTS urunler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    urun_adi VARCHAR(255) NOT NULL,
    stok_miktari INT DEFAULT 0,
    fiyat DECIMAL(10,2) DEFAULT 0.00,
    kategori VARCHAR(100),
    guncelleme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sipariş Tablosu
CREATE TABLE IF NOT EXISTS siparisler (
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