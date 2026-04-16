<?php
include "baglan.php";
include "header.php";

// Admin emmi görür
if($_SESSION['rol'] != 'yonetici') {
    echo "Bu sayfaya yetkiniz yok!";
    exit;
}

if($_POST) {
    $ad = $_POST['ad'];
    $kadi = $_POST['kadi'];
    $sifre = $_POST['sifre']; 
    $rol = $_POST['rol'];
    
    
    $sql = "INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol) VALUES ('$kadi', '$sifre', '$ad', '$rol')";
    
    if($db->query($sql)) {
        echo "<script>alert('Kullanıcı eklendi');</script>";
    }
}
?>

<div class="container mt-4">
    <div class="card p-3" style="max-width: 400px; margin:auto;">
        <h4>Yeni Kullanıcı Ekle</h4>
        <hr>
        <form method="post">
             Kullanıcı Adı: <br>
            <input type="text" name="kadi" class="form-control" required>
            
            Şifre: <br>
            <input type="password" name="sifre" class="form-control" required>
            
            Ad Soyad: <br>
            <input type="text" name="ad" class="form-control" required>
            
            Yetki: <br>
            <select name="rol" class="form-select">
                <option value="personel">Personel</option>
                <option value="yonetici">Yönetici</option>
                <option value="musteri">Müşteri</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary w-100">Kaydet</button>
        </form>
    </div>
</div>
