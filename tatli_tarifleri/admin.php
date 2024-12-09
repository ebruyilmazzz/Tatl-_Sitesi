<?php
include 'baglanti.php';
session_start(); // Oturum başlatma

// Çıkış işlemi
if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Silme işlemi
if (isset($_GET['sil'])) {
    $urun_id = intval($_GET['sil']);
    
    // Kategoriye göre doğru tabloyu belirleme
    $kategori = isset($_GET['kategori']) ? urldecode($_GET['kategori']) : '';
    $target_table = '';

    // Kategoriyi kontrol et ve tabloyu belirle
    if ($kategori == 'Çikolatalı Tatlılar') {
        $target_table = 'cikolatali_tatlilar';
    } elseif ($kategori == 'Pratik Tatlılar') {
        $target_table = 'pratik_tatlilar';
    } elseif ($kategori == 'Meyveli Tatlılar') {
        $target_table = 'meyveli_tatlilar';
    } else {
        // Kategori yoksa default bir tablo belirle
        $target_table = 'urunler';
    }

    // Doğru tablodan silme işlemi
    $query = $baglanti->prepare("DELETE FROM $target_table WHERE id = ?");
    $query->bind_param("i", $urun_id);
    $query->execute();

    if ($query->affected_rows > 0) {
        header("Location: admin.php?message=success");
        exit();
    } else {
        echo '<div class="alert alert-danger">Ürün silinemedi. ID bulunamadı.</div>';
    }
}

// Ürünleri listele
$kategori = isset($_GET['kategori']) ? urldecode($_GET['kategori']) : ''; // URL'den kategori al
$target_table = ''; // Hedef tablo

// Kategoriye göre doğru tabloyu belirle
if ($kategori == 'Çikolatalı Tatlılar') {
    $target_table = 'cikolatali_tatlilar';
} elseif ($kategori == 'Pratik Tatlılar') {
    $target_table = 'pratik_tatlilar';
} elseif ($kategori == 'Meyveli Tatlılar') {
    $target_table = 'meyveli_tatlilar';
} else {
    // Eğer kategori seçilmemişse, genel tablodan ürünleri al
    $target_table = 'urunler';
}

$query = $baglanti->prepare("SELECT * FROM $target_table");
$query->execute();
$result = $query->get_result();

if (!$result) {
    die("Sorgu çalıştırma hatası: " . $baglanti->error);
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Yönetim Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Ürün Yönetim Sistemi</h2>

        <!-- Mesaj Gösterimi -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?php
                if ($_GET['message'] == 'success') echo "Ürün başarıyla silindi!";
                elseif ($_GET['message'] == 'updated') echo "Ürün başarıyla güncellendi!";
                elseif ($_GET['message'] == 'added') echo "Ürün başarıyla eklendi!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Kategori Seçimi -->
        <div class="mb-3">
            <a href="admin.php" class="btn btn-outline-secondary">Tüm Kategoriler</a>
            <a href="admin.php?kategori=Çikolatalı%20Tatlılar" class="btn btn-outline-dark">Çikolatalı Tatlılar</a>
            <a href="admin.php?kategori=Pratik%20Tatlılar" class="btn btn-outline-dark">Pratik Tatlılar</a>
            <a href="admin.php?kategori=Meyveli%20Tatlılar" class="btn btn-outline-dark">Meyveli Tatlılar</a>
        </div>

        <!-- Yeni Ürün Ekle Butonu -->
        <div class="mb-3">
            <a href="ekle.php" class="btn btn-primary">Yeni Ürün Ekle</a>
            <a href="admin.php?cikis=true" class="btn btn-danger">Çıkış Yap</a>
        </div>

        <!-- Ürün Listesi -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ürün ID</th>
                    <th>Ürün Adı</th>
                    <th>Ürün Bilgisi</th>
                    <th>Ürün Resmi</th>
                    <th>Kategori</th>
                    <th>Sil</th>
                    <th>Güncelle</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($urun = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($urun['id']); ?></td>
                            <td><?= htmlspecialchars($urun['urun_adi']); ?></td>
                            <td><?= htmlspecialchars($urun['urun_bilgi']); ?></td>
                            <td><img src="<?= htmlspecialchars($urun['urun_resmi']); ?>" alt="Ürün Resmi" width="50"></td>
                            <td><?= htmlspecialchars($urun['kategori']); ?></td>
                            <td><a href="admin.php?sil=<?= $urun['id']; ?>&kategori=<?= urlencode($kategori); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?');">Sil</a></td>
                            <td><a href="update.php?id=<?= $urun['id']; ?>" class="btn btn-success btn-sm">Güncelle</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Hiç ürün bulunamadı.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
