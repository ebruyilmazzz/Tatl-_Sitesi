<?php
include("baglanti.php");

if(isset($_POST['guncelle'])) {
    $kullaniciadi = $_POST['kullaniciadi'];
    $yeni_sifre = $_POST['yeni_sifre'];
    
    // Şifreyi hash'le
    $hash = password_hash($yeni_sifre, PASSWORD_DEFAULT);
    
    // Güncelleme sorgusu
    $sql = "UPDATE uyeler SET parola = ? WHERE kullaniciadi = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ss", $hash, $kullaniciadi);
    
    if($stmt->execute()) {
        echo "<div style='color: green; margin: 20px;'>Şifre başarıyla güncellendi!</div>";
    } else {
        echo "<div style='color: red; margin: 20px;'>Hata oluştu: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Güncelle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #ff5252;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Şifre Güncelle</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Kullanıcı Adı:</label>
                <input type="text" name="kullaniciadi" required>
            </div>
            <div class="form-group">
                <label>Yeni Şifre:</label>
                <input type="password" name="yeni_sifre" required>
            </div>
            <button type="submit" name="guncelle" class="btn">Şifreyi Güncelle</button>
        </form>
    </div>
</body>
</html>
