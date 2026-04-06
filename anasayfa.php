<?php
session_start();

if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: giris.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - Stok Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .content-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: white;
            padding: 2.5rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="anasayfa.php">Stok Takip Sistemi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            Merhaba, <?php echo htmlspecialchars($_SESSION['ad_soyad']); ?> 
                            <small class="text-info">(<?php echo htmlspecialchars($_SESSION['rol']); ?>)</small>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-bold ms-3" href="cikis.php">Çıkış Yap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="content-card text-center">
                    
                    <h2 class="mb-4">Yönetim Paneline Hoşgeldiniz!</h2>
                    <p class="lead text-muted mb-5">
                        Stok takip sisteminizin ana sayfasına başarıyla giriş yaptınız. 
                        Aşağıdaki hızlı erişim menülerini kullanarak işlemlere başlayabilirsiniz.
                    </p>
                    
                    <div class="row g-4 mt-2">
                        <div class="col-md-4">
                            <div class="card h-100 text-bg-primary border-0 shadow-sm">
                                <div class="card-body py-4">
                                    <h4 class="card-title mb-3">📦 Ürün Ekle</h4>
                                    <p class="card-text">Sisteme yeni ürünler tanımlayın ve stok girişi yapın.</p>
                                    <a href="#" class="btn btn-light mt-3 px-4">Git</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100 text-bg-success border-0 shadow-sm">
                                <div class="card-body py-4">
                                    <h4 class="card-title mb-3">📊 Stok Durumu</h4> 
                                    <p class="card-text">Mevcut stoklarınızı detaylı olarak listeleyin ve kontrol edin.</p>
                                    <a href="#" class="btn btn-light mt-3 px-4">Git</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100 text-bg-warning border-0 shadow-sm">
                                <div class="card-body py-4">
                                    <h4 class="card-title mb-3 text-dark">🛒 Satış Yap</h4>
                                    <p class="card-text text-dark">Stoktan ürün düşün ve hızlıca satış işlemlerini gerçekleştirin.</p>
                                    <a href="#" class="btn btn-dark mt-3 px-4">Git</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>