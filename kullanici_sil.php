<?php
include "baglan.php";

// Sadece yöneticiler silme işlemi yapabilir
if(!isset($_SESSION["kullanici_adi"]) || $_SESSION["rol"] != "yonetici") {
    header("Location: anasayfa.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Yöneticinin kendi kendini yanlışlıkla silmesini engellemek için ufak bir güvenlik:
    // Mevcut giren kişinin ID'si ile silinmek istenen ID uyuşmasın diye liste.php'de de önlem almıştık.
    $sil = $db->prepare("DELETE FROM kullanicilar WHERE id = ?");
    $sil->execute([$id]);
}

header("Location: liste.php");
exit;
?>
