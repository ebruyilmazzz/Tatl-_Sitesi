<?php
include 'baglanti.php';

// Güncellenecek ürün bilgilerini getir
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = $baglanti->prepare("SELECT * FROM urunler WHERE id = ?");
    if ($query) {
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $urun = $result->fetch_assoc();

        if (!$urun) {
            die("Ürün bulunamadı.");
        }
    } else {
        die("Sorgu hazırlanırken hata oluştu: " . $baglanti->error);
    }
} else {
    die("Geçersiz işlem.");
}

// Form gönderildiğinde güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $urun_adi = $_POST['urun_adi'];
    $urun_bilgi = $_POST['urun_bilgi'];
    $urun_resmi = $_POST['urun_resmi'];

    $query = $baglanti->prepare("UPDATE urunler SET urun_adi = ?, urun_bilgi = ?, urun_resmi = ? WHERE id = ?");
    if ($query) {
        $query->bind_param("sssi", $urun_adi, $urun_bilgi, $urun_resmi, $id);
        $query->execute();

        if ($query->affected_rows >= 0) {
            header("Location: admin.php?message=updated");
            exit();
        } else {
            echo '<div class="alert alert-warning">Ürün güncellenirken bir sorun oluştu veya değişiklik yapılmadı.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Sorgu hazırlanırken hata oluştu: ' . $baglanti->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Güncelle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Ürün Güncelle</h2>
        
        <?php if ($urun): ?>
            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($urun['id']); ?>">
                <div class="mb-3">
                    <label for="urun_adi" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="urun_adi" name="urun_adi" value="<?= htmlspecialchars($urun['urun_adi']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="urun_bilgi" class="form-label">Ürün Bilgisi</label>
                    <input type="text" class="form-control" id="urun_bilgi" name="urun_bilgi" value="<?= htmlspecialchars($urun['urun_bilgi']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="urun_resmi" class="form-label">Ürün Resmi</label>
                    <input type="text" class="form-control" id="urun_resmi" name="urun_resmi" value="<?= htmlspecialchars($urun['urun_resmi']); ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Güncelle</button>
                <a href="admin.php" class="btn btn-secondary">İptal</a>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">Geçersiz ürün ID.</div>
        <?php endif; ?>
    </div>
</body>
</html>
