<?php
include 'baglanti.php';
session_start();

// Çıkış işlemi
if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Yeni ürün ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $urun_adi = $_POST['urun_adi'];
    $urun_bilgi = $_POST['urun_bilgi'];
    $kategori = $_POST['kategori'];
    $urun_resmi = $_POST['urun_resmi'];

    // Kategoriye göre hedef tablo belirleme
    $target_table = '';
    if ($kategori == 'Çikolatalı Tatlılar') {
        $target_table = 'cikolatali_tatlilar';
    } elseif ($kategori == 'Pratik Tatlılar') {
        $target_table = 'pratik_tatlilar';
    } elseif ($kategori == 'Meyveli Tatlılar') {
        $target_table = 'meyveli_tatlilar';
    } else {
        echo '<div class="alert alert-danger">Geçersiz kategori seçildi!</div>';
        exit();
    }

    // Dinamik tabloya veri ekleme
    $query = $baglanti->prepare("INSERT INTO $target_table (urun_adi, urun_bilgi, urun_resmi) VALUES (?, ?, ?)");
    $query->bind_param("sss", $urun_adi, $urun_bilgi, $urun_resmi);
    $query->execute();

    if ($query->affected_rows > 0) {
        header("Location: admin.php?message=added");
        exit();
    } else {
        echo '<div class="alert alert-danger">Ürün eklenemedi. Lütfen tekrar deneyin.</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Ürün Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Yeni Ürün Ekle</h2>

        <form method="POST" action="ekle.php">
            <div class="mb-3">
                <label for="urun_adi" class="form-label">Ürün Adı</label>
                <input type="text" class="form-control" id="urun_adi" name="urun_adi" required>
            </div>

            <div class="mb-3">
                <label for="urun_bilgi" class="form-label">Ürün Bilgisi</label>
                <textarea class="form-control" id="urun_bilgi" name="urun_bilgi" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="Çikolatalı Tatlılar">Çikolatalı Tatlılar</option>
                    <option value="Pratik Tatlılar">Pratik Tatlılar</option>
                    <option value="Meyveli Tatlılar">Meyveli Tatlılar</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="urun_resmi" class="form-label">Ürün Resmi URL</label>
                <input type="text" class="form-control" id="urun_resmi" name="urun_resmi" required>
            </div>

            <button type="submit" class="btn btn-primary">Ürünü Ekle</button>
            <a href="admin.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>
</html>
