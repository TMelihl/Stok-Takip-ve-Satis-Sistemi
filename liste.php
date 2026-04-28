<?php
include "baglan.php";
include "header.php";

if(!isset($_SESSION["kullanici_adi"]) || $_SESSION["rol"] != "yonetici") {
    header("Location: anasayfa.php");
    exit;
}

$kullanicilar = $db->query("SELECT * FROM kullanicilar")->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">👥 Sistemdeki Kullanıcılar</h5>
                <a href="form.php" class="btn btn-info btn-sm text-white">+ Yeni Kayıt</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Ad Soyad</th>
                            <th>Kullanıcı Adı</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Durum</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($kullanicilar as $k): ?>
                        <tr>
                            <td><?= htmlspecialchars($k['ad_soyad']) ?></td>
                            <td><?= htmlspecialchars($k['kullanici_adi']) ?></td>
                            <td class="text-center">
                                <?php 
                                    $turkceRoller = ['yonetici' => 'Yönetici', 'personel' => 'Personel', 'musteri' => 'Müşteri'];
                                ?>
                                <span class="badge bg-secondary"><?= $turkceRoller[$k['rol']] ?? ucfirst($k['rol']) ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($k['aktif']): ?>
                                    <span class="badge bg-success small">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger small">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <!-- Güvenlik: Kullanıcı kendi kendini silemesin ve sadece yöneticiler silsin -->
                                <?php if($_SESSION['rol'] == 'yonetici' && $k['kullanici_adi'] != $_SESSION['kullanici_adi']): ?>
                                <a href="kullanici_sil.php?id=<?= $k['id'] ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">
                                   🗑️ Sil
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>