<?php
// Veritabanı bağlantı bilgileri
$host = 'localhost';     // Veritabanı sunucusu
$kullanici = 'root';     // Veritabanı kullanıcı adı
$sifre = '';             // Veritabanı şifresi
$veritabani = 'sweet_recipes';  // Veritabanı adı

// Veritabanı bağlantısını oluşturma
$baglanti = new mysqli($host, $kullanici, $sifre, $veritabani);

// Bağlantıyı kontrol et
if ($baglanti->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $baglanti->connect_error);
}

// UTF-8 karakter seti desteği sağla
$baglanti->set_charset("utf8");
?>
