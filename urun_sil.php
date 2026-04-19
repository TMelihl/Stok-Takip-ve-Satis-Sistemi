<?php
include "baglan.php";

if(!isset($_SESSION['kullanici_adi'])) {
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