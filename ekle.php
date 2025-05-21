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
    $product_name = $_POST['product_name'];
    $product_info = $_POST['product_info'];
    $category_id = $_POST['category_id'];
    $product_img = $_POST['product_img'];

    // Kategoriye göre hedef tablo belirleme
    $target_table = '';
    if ($category_id == 1) {
        $target_table = 'desserts';
    } elseif ($category_id == 2) {
        $target_table = 'pratik_tatlilar';
    } elseif ($category_id == 3) {
        $target_table = 'meyveli_tatlilar';
    } else {
        echo '<div class="alert alert-danger">Geçersiz kategori seçildi!</div>';
        exit();
    }


    $query = $baglanti->prepare("INSERT INTO desserts (product_name, product_info, product_img, category_id) VALUES (?, ?, ?,?)");
    $query->bind_param("sssi", $product_name, $product_info, $product_img,$category_id);    
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
                <label for="product_name" class="form-label">Ürün Adı</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>

            <div class="mb-3">
                <label for="product_info" class="form-label">Ürün Bilgisi</label>
                <textarea class="form-control" id="product_info" name="product_info" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" id="category_id" name="category_id" required>
                <option value="1">Çikolatalı Tatlılar</option>
                <option value="2">Pratik Tatlılar</option>
                <option value="3">Meyveli Tatlılar</option>
            </select>

            </div>

            <div class="mb-3">
                <label for="product_img" class="form-label">Ürün Resmi URL</label>
                <input type="text" class="form-control" id="product_img" name="product_img" required>
            </div>

            <button type="submit" class="btn btn-primary">Ürünü Ekle</button>
            <a href="admin.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>
</html>
