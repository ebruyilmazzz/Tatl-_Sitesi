<?php
include 'baglanti.php'; // Veritabanı bağlantısı

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Güvenlik için ID'yi integer'a çeviriyoruz

    // Veritabanı sorgusu için mysqli kullanıyoruz
    $stmt = $baglanti->prepare("DELETE FROM urunler WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id); // ID parametresini bağlıyoruz
        $stmt->execute(); // Sorguyu çalıştırıyoruz

        if ($stmt->affected_rows > 0) {
            // Silme işlemi başarılı
            header("Location: admin.php?message=success");
            exit();
        } else {
            die("Ürün bulunamadı veya silinemedi.");
        }

        $stmt->close(); // Hazırlanan sorguyu kapatıyoruz
    } else {
        die("Sorgu hazırlanırken hata oluştu.");
    }
} else {
    die("Geçersiz işlem.");
}
