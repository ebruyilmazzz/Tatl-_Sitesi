<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lezzetli Tatlılar</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">Lezzetli Tatlılar</a>
                <div class="nav-links">
                    <a href="index.php">Ana Sayfa</a>
                    <a href="Login.php">Giriş Yap</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero fade-in">
        <div class="hero-content">
            <h1>En Lezzetli Tatlı Tarifleri</h1>
            <p>Ev yapımı tatlıların tadını çıkarın</p>
            <a href="#recipes" class="btn">Tarifleri Keşfet</a>
        </div>
    </section>

    <main class="container">
        <section id="recipes" class="recipes-grid">
            <?php
            include("baglanti.php");
            
            
            $table_check = "DESCRIBE desserts";
            $result = $baglanti->query($table_check);
            if ($result) {
                echo "<!-- Tablo yapısı: -->";
                while($row = $result->fetch_assoc()) {
                    echo "<!-- " . $row['Field'] . " - " . $row['Type'] . " -->";
                }
            }
            
            $sec = "SELECT d.*, c.category_name 
                FROM desserts d
                JOIN category c ON d.category_id = c.id
                ORDER BY d.id DESC
                LIMIT 6";
            $sonuc = $baglanti->query($sec);
            
            if ($sonuc->num_rows > 0) {
                while ($cek = $sonuc->fetch_assoc()) {
                    
                    echo '<div class="recipe-card fade-in">';
                    
                    $resim_yolu = $cek['product_img'];
            
                    echo '<div class="recipe-content">';
                    echo '<h3 class="recipe-title">' . $cek['product_name'] . '</h3>';
                    echo '<p class="recipe-description">' . substr($cek['product_info'], 0, 100) . '...</p>';
                    echo '</div>';
            
                    echo '</div>';
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2024 Tatlı Tarifleri. Tüm hakları saklıdır.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
