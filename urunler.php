<?php
include 'baglan.php';
include 'header.php';

if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

$urunler = $db->query("SELECT * FROM urunler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <?php if(isset($_GET['islem'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Başarılı!</strong>
            <?php
                if($_GET['islem'] == 'eklendi') echo "Ürün eklendi.";
                if($_GET['islem'] == 'guncellendi') echo "Ürün güncellendi.";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h4>📊 Ürün Listesi</h4>
        <?php if($_SESSION['rol'] != 'musteri'): ?>
        <a href="urun_ekle.php" class="btn btn-primary btn-sm">+ Yeni Ürün Ekle</a>
        <?php endif; ?>
    </div>

    <table class="table table-bordered bg-white shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>Ürün Adı</th>
                <th>Stok Miktarı</th>
                <th>Birim Fiyat</th>
                <th width="150" class="text-center">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($urunler) == 0): ?>
                <tr><td colspan="4" class="text-center text-muted">Ürün bulunamadı.</td></tr>
            <?php endif; ?>
            <?php foreach ($urunler as $urun): ?>
                <tr class="<?= ($urun['stok_miktari'] < 5) ? 'table-danger' : '' ?>">
                    <td><?= htmlspecialchars($urun['urun_adi']) ?></td>
                    <td>
                        <?= $urun['stok_miktari'] ?>
                        <?php if($urun['stok_miktari'] < 5): ?>
                            <span class="badge bg-danger">Kritik!</span>
                        <?php endif; ?>
                    </td>
                    <td><?= number_format($urun['fiyat'], 2) ?> ₺</td>
                    <td class="text-center">
                        <?php if($_SESSION['rol'] != 'musteri'): ?>
                            <a href="urun_duzenle.php?id=<?= $urun['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                            <a href="urun_sil.php?id=<?= $urun['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Emin misiniz?')">Sil</a>
                        <?php else: ?>
                            <a href="siparis_ver.php?id=<?= $urun['id'] ?>" class="btn btn-success btn-sm">🛒 Sipariş Ver</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>