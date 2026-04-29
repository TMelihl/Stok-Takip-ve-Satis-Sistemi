<?php
include "baglan.php";

if(!isset($_SESSION['kullanici_adi']) || $_SESSION['rol'] == 'musteri') {
    header("Location: urunler.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sil = $db->prepare("DELETE FROM urunler WHERE id = ?");
    $sil->execute([$id]);
}

header("Location: urunler.php");
exit;   
?>