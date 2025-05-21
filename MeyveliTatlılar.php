<?php
include("baglanti.php");

$urunler = [];

// Sorguyu güncelledik (bind_param hatasını düzelttik)
$query = $baglanti->prepare("SELECT urun_adi, urun_bilgi, urun_resmi FROM meyveli_tatlilar");
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $urunler[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meyveli Tatlılar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Meyveli Tatlılar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminlogin.php">Yönetici</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ürünler -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Meyveli Tatlılar</h2>
        <div class="row">
            <?php if (empty($urunler)): ?>
                <p class="text-center w-100">Henüz ürün eklenmemiş.</p>
            <?php else: ?>
                <?php foreach ($urunler as $urun): ?>
                    <div class="col-md-4 py-3">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($urun['urun_resmi']); ?>" alt="Ürün Resmi" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($urun['urun_adi']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($urun['urun_bilgi']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5 bg-light text-center py-4">
        <div class="container">
            <p>© 2024 Şekerli Tarifler</p>
        </div>
    </footer>

</body>
</html>
