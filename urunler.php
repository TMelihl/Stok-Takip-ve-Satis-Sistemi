<?php
include 'baglan.php';
include 'header.php';

if(!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

$urunler = $db->query("SELECT * FROM urunler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h4>📊 Güncel Ürün Listesi</h4>
        <a href="urun_ekle.php" class="btn btn-primary btn-sm">+ Yeni Ürün</a>
    </div>
    
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Ürün Adı</th>
                <th>Stok</th>
                <th>Fiyat</th>
                <th width="150" class="text-center">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($urunler as $urun): ?>
            <tr>
                <td><?= htmlspecialchars($urun['urun_adi']) ?></td>
                <td><?= $urun['stok_miktari'] ?></td>
                <td><?= number_format($urun['fiyat'], 2) ?> ₺</td>
                <td class="text-center">
                    <a href="urun_duzenle.php?id=<?= $urun['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                    <a href="urun_sil.php?id=<?= $urun['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
