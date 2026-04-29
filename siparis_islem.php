<?php
include "baglan.php";
if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Sadece yönetici ve personeller siparişe işlem yapabilir
if (!isset($_SESSION['kullanici_adi']) || $_SESSION['rol'] == 'musteri') {
    exit;
}

if (isset($_GET['id']) && isset($_GET['islem'])) {
    $siparis_id = $_GET['id'];
    $islem = $_GET['islem'];
    $islem_yapan_id = $_SESSION['kullanici_id'];
    
    // Siparişi ve ilgili ürünü getir
    $sorgu = $db->prepare("SELECT * FROM siparisler WHERE id = ?");
    $sorgu->execute([$siparis_id]);
    $siparis = $sorgu->fetch(PDO::FETCH_ASSOC);
    
    if ($siparis && $siparis['durum'] == 'Beklemede') {
        
        if ($islem == 'onay') {
            // 1. Stoktan düş
            $stokGuncelle = $db->prepare("UPDATE urunler SET stok_miktari = (stok_miktari - ?) WHERE id = ?");
            $stokGuncelle->execute([$siparis['adet'], $siparis['urun_id']]);
            
            // 2. Siparişi Onaylandı yap ve onaylayan kişiyi kaydet
            $onayla = $db->prepare("UPDATE siparisler SET durum = 'Onaylandı', islem_yapan_id = ?, islem_tarihi = NOW() WHERE id = ?");
            $onayla->execute([$islem_yapan_id, $siparis_id]);
            
        } elseif ($islem == 'red') {
            // Siparişi iptal et (Stok değişmez)
            $reddet = $db->prepare("UPDATE siparisler SET durum = 'Reddedildi', islem_yapan_id = ?, islem_tarihi = NOW() WHERE id = ?");
            $reddet->execute([$islem_yapan_id, $siparis_id]);
        }
    }
}

header("Location: siparisler.php");
exit;
?>
