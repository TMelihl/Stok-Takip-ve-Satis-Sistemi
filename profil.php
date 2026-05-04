<?php
include 'baglan.php';
include 'header.php';
if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
if ($_POST) {
    $yeni_sifre = $_POST['sifre'];
    $sifre_onay = $_POST['sifre_onay'];
    if ($yeni_sifre !== $sifre_onay) {
        $hata = "Şifreler birbiriyle uyuşmuyor!";
    } elseif (strlen($yeni_sifre) < 4) {
        $hata = "Şifre en az 4 karakter olmalıdır!";
    } else {
        $hashed_password = password_hash($yeni_sifre, PASSWORD_DEFAULT);
        $sorgu = $db->prepare("UPDATE kullanicilar SET sifre = ? WHERE id = ?");
        if ($sorgu->execute([$hashed_password, $_SESSION['kullanici_id']])) {
            $mesaj = "Şifreniz başarıyla güncellendi!";
        } else {
            $hata = "Bir hata oluştu, lütfen tekrar deneyin.";
        }
    }
}
?>
<div class="container" style="max-width: 450px;">
    <div class="card p-4 shadow-sm border-0 mt-5">
        <h4 class="text-center mb-4">👤 Profil Ayarları</h4>
        <p class="text-center text-muted small">Buradan giriş şifrenizi güncelleyebilirsiniz.</p>
        <hr>
        <?php if (isset($hata)): ?>
            <div class="alert alert-danger text-center p-2 mb-3" style="font-size: 14px;">
                ⚠️ <?= $hata ?>
            </div>
        <?php endif; ?>
        <?php if (isset($mesaj)): ?>
            <div class="alert alert-success text-center p-2 mb-3" style="font-size: 14px;">
                ✅ <?= $mesaj ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label small">Yeni Şifre:</label>
                <input type="password" name="sifre" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label small">Şifre Tekrar:</label>
                <input type="password" name="sifre_onay" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Şifremi Güncelle</button>
            <a href="anasayfa.php" class="d-block mt-3 text-center text-decoration-none text-secondary small">← Vazgeç</a>
        </form>
    </div>
</div>
</body>
</html>