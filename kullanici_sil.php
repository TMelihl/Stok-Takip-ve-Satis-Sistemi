<?php
include "baglan.php";


if(!isset($_SESSION["kullanici_adi"]) || $_SESSION["rol"] != "yonetici") {
    header("Location: anasayfa.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sil = $db->prepare("DELETE FROM kullanicilar WHERE id = ?");
    $sil->execute([$id]);
}

header("Location: liste.php");
exit;
?>