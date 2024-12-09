<?php
include("baglanti.php");

$urunler = [];
if ($baglanti->connect_error) {
    die('Veritabanı bağlantısı başarısız: ' . $baglanti->connect_error);
}

$sql = "SELECT urun_adi, urun_adres, urun_resmi FROM urunler";
$result = $baglanti->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $urunler[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🧁🍭 Şekerli Tarifler 🧁🍭</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Navbar Section -->
    <div class="container">
        <div class="navbar-top">
            <div class="logo">
                <h2>🧁🍭 Şekerli Tarifler 🧁🍭</h2>
            </div>
            <nav class="navbar navbar-expand-md" id="navbar-color">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">ANA SAYFA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminlogin.php">Yönetici</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kayit.php">Kayıt Ol</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="tatlilarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                TATLILAR
                            </a>
                            <div class="dropdown-menu" aria-labelledby="tatlilarDropdown">
                                <a class="dropdown-item" href="çikolatalıTatlılar.php">Çikolatalı Tatlılar</a>
                                <a class="dropdown-item" href="PratikTatlılar.php">Pratik Tatlılar</a>
                                <a class="dropdown-item" href="MeyveliTatlılar.php">Meyveli Tatlılar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Slider -->
        <div id="carouselExample" class="carousel slide" data-ride="carousel" style="margin-top: 20px;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/s2.jpg" class="d-block w-100" alt="Slider Image 1">
                </div>
                <div class="carousel-item">
                    <img src="./img/s3.jpg" class="d-block w-100" alt="Slider Image 2">
                </div>
                <div class="carousel-item">
                    <img src="./img/s1.jpg" class="d-block w-100" alt="Slider Image 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Önceki</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Sonraki</span>
            </a>
        </div>

        <!-- Products Section -->
        <section id="products" class="mt-5">
            <h2 class="text-center">Ürünlerimiz</h2>
            <div class="row">
                <?php foreach ($urunler as $urun):?>
                    <div class="col-md-4 py-3">
                        <div class="card">
                            <!-- Resim Kısmı -->
                            <img src="<?php echo htmlspecialchars($urun['urun_resmi']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($urun['urun_bilgi']); ?>">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <a href="<?php echo htmlspecialchars($urun['urun_adres']); ?>"><?php echo htmlspecialchars($urun['urun_adi']); ?></a>
                                </h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <h1>🍭🧁 Şekerli Hayaller 🧁🍭</h1>
            <p>İLETİŞİM<br> 0850 308 1552<br> sekerhayelleri@.com</p>
            <div class="copyright">
                &copy; Telif Hakkı <strong><span>🍭🧁 Şekerli Hayaller 🧁🍭</span></strong> tarafından saklıdır
            </div>
            <div class="credite">
                Tasarım E.Y Tarafından yapılmıştır.
            </div>
        </div>
    </footer>
</body>

</html>
