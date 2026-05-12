<?php
include "baglan.php";
include "header.php";

if($_SESSION['rol'] != 'yonetici') {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Bu sayfaya erişim yetkiniz yok.</div></div>";
    exit;
}

if($_POST) {
    $ad = $_POST['ad'];
    $kadi = $_POST['kadi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $sorgu = $db->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, rol) VALUES (?, ?, ?, ?)");
    
    if($sorgu->execute([$kadi, $sifre, $ad, $rol])) {
        header("Location: liste.php?islem=basarili");
        exit;
    }
}
?>

<div class="container mt-4">
    <div class="card shadow-sm p-4" style="max-width: 450px; margin:auto; border-radius: 15px;">
        <h4 class="text-center mb-3">👤 Yeni Kullanıcı Kaydı</h4>
        <hr>
        <form method="post">
            <div class="mb-3">
                <label class="form-label small fw-bold">Ad Soyad:</label>
                <input type="text" name="ad" class="form-control" placeholder="Örn: Ahmet Yılmaz" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Kullanıcı Adı:</label>
                <input type="text" name="kadi" class="form-control" placeholder="Giriş için kullanılacak" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Şifre:</label>
                <input type="password" name="sifre" class="form-control" placeholder="••••••" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Yetki Seviyesi:</label>
                <select name="rol" class="form-select">
                    <option value="personel">Personel (Stok Yönetir)</option>
                    <option value="musteri">Müşteri (Sipariş Verir)</option>
                    <option value="yonetici">Yönetici (Tam Yetki)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2 shadow-sm py-2">Kullanıcıyı Kaydet</button>
        </form>
    </div>
</div>
</body>
</html>