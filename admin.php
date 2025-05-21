<?php
include 'baglanti.php';
session_start();

// Admin girişi kontrolü
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

// Çıkış işlemi
if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


if (isset($_GET['sil'])) {
    $urun_id = intval($_GET['sil']);
    
    $kategori = isset($_GET['kategori']) ? urldecode($_GET['kategori']) : '';
    $target_table = '';

    if ($kategori == 'Çikolatalı Tatlılar') {
        $target_table = 'desserts';
    } elseif ($kategori == 'Pratik Tatlılar') {
        $target_table = 'pratik_tatlilar';
    } elseif ($kategori == 'Meyveli Tatlılar') {
        $target_table = 'meyveli_tatlilar';
    }
    

    if ($target_table) {
        $sql = "DELETE FROM $target_table WHERE id = ?";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("i", $urun_id);
        
        if ($stmt->execute()) {
            header("Location: admin.php?mesaj=silindi");
        } else {
            header("Location: admin.php?mesaj=hata");
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Tatlı Tarifleri</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .recipe-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .recipe-table th, .recipe-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .recipe-table th {
            background-color: #f5f5f5;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn-ekle {
            background-color: #4CAF50;
        }
        .btn-duzenle {
            background-color: #2196F3;
        }
        .btn-sil {
            background-color: #f44336;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .message.success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .message.error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Tatlı Tarifleri Yönetim Paneli</h1>
            <div class="action-buttons">
                <a href="ekle.php" class="btn btn-ekle">Yeni Tarif Ekle</a>
                <a href="admin.php?cikis=1" class="btn btn-sil">Çıkış Yap</a>
            </div>
        </div>

        <?php if(isset($_GET['mesaj'])): ?>
            <?php if($_GET['mesaj'] == 'silindi'): ?>
                <div class="message success">Tarif başarıyla silindi.</div>
            <?php elseif($_GET['mesaj'] == 'hata'): ?>
                <div class="message error">İşlem sırasında bir hata oluştu.</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="recipes-section">
            <h2>Çikolatalı Tatlılar</h2>
            <table class="recipe-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM desserts ORDER BY id DESC";
                    $result = $baglanti->query($sql);
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo substr($row['product_info'], 0, 100) . '...'; ?></td>
                        <td class="action-buttons">
                            <a href="update.php?id=<?php echo $row['id']; ?>&kategori=Çikolatalı Tatlılar" class="btn btn-duzenle">Düzenle</a>
                            <a href="admin.php?sil=<?php echo $row['id']; ?>&kategori=Çikolatalı Tatlılar" class="btn btn-sil" onclick="return confirm('Bu tarifi silmek istediğinizden emin misiniz?')">Sil</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>          
        </div>
    </div>
</body>
</html>
