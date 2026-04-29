<?php
include 'baglan.php';
include 'header.php';

if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}

$sorguText = "
SELECT 
    s.*, 
    u.urun_adi, 
    m.ad_soyad AS musteri_adi,
    iy.ad_soyad AS islem_yapan_adi,
    iy.rol AS islem_yapan_rol
FROM siparisler s
JOIN urunler u ON s.urun_id = u.id
JOIN kullanicilar m ON s.musteri_id = m.id
LEFT JOIN kullanicilar iy ON s.islem_yapan_id = iy.id
";

if ($_SESSION['rol'] == 'musteri') {
    $sorguText .= " WHERE s.musteri_id = ? ORDER BY s.id DESC";
    $sorgu = $db->prepare($sorguText);
    $sorgu->execute([$_SESSION['kullanici_id']]);
} else {
    $sorguText .= " ORDER BY s.id DESC";
    $sorgu = $db->prepare($sorguText);
    $sorgu->execute();
}
$siparisler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-2">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h4>📦 Sipariş Yönetimi</h4>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Sipariş No</th>
                    <th>Müşteri</th>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Toplam Tutar</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th width="300" class="text-center">Aksiyon / Yetkili</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($siparisler) == 0): ?>
                <tr><td colspan="8" class="text-center text-muted">Hiç sipariş bulunamadı.</td></tr>
                <?php endif; ?>

                <?php foreach ($siparisler as $sip): ?>
                    <tr>
                        <td>#<?= $sip['id'] ?></td>
                        <td><b><?= htmlspecialchars($sip['musteri_adi']) ?></b></td>
                        <td><?= htmlspecialchars($sip['urun_adi']) ?></td>
                        <td><span class="badge bg-secondary"><?= $sip['adet'] ?> Adet</span></td>
                        <td><b class="text-success"><?= number_format($sip['toplam_tutar'], 2) ?> ₺</b></td>
                        <td><small class="text-muted"><?= date('d.m.Y H:i', strtotime($sip['tarih'])) ?></small></td>

                        <!-- Durum Rozetleri -->
                        <td>
                            <?php if ($sip['durum'] == 'Beklemede'): ?>
                                <span class="badge bg-warning text-dark">Beklemede</span>
                            <?php elseif ($sip['durum'] == 'Onaylandı'): ?>
                                <span class="badge bg-success">Onaylandı</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Reddedildi</span>
                            <?php endif; ?>
                        </td>

                        <!-- İşlemler veya Log Kaydı -->
                        <td class="text-center">
                            <?php if ($_SESSION['rol'] != 'musteri' && $sip['durum'] == 'Beklemede'): ?>
                                <a href="siparis_islem.php?id=<?= $sip['id'] ?>&islem=onay" class="btn btn-success btn-sm" onclick="return confirm('Siparişi SİSTEMDEN DÜŞEREK ONAYLIYOR musunuz?')">✅ Onayla</a>
                                <a href="siparis_islem.php?id=<?= $sip['id'] ?>&islem=red" class="btn btn-outline-danger btn-sm" onclick="return confirm('Siparişi reddetmek istediğinize emin misiniz?')">❌ Reddet</a>
                            <?php elseif ($sip['durum'] != 'Beklemede'): ?>
                                <?php 
                                    $renk = $sip['durum'] == 'Onaylandı' ? 'text-success' : 'text-danger';
                                    $turkceRol = ['yonetici'=>'Yönetici', 'personel'=>'Personel'];
                                ?>
                                <span class="small <?= $renk ?> fw-bold">
                                    <?= htmlspecialchars($sip['islem_yapan_adi'] ?? '') ?> 
                                    (<?= $turkceRol[$sip['islem_yapan_rol']] ?? '' ?>)
                                </span>
                            <?php else: ?>
                                <span class="text-muted small">Onay Bekleniyor</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>