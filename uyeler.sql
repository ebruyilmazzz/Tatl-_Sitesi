-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Ara 2024, 12:00:57
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `uyeler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adminler`
--

CREATE TABLE `adminler` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `parola` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cikolatali_tatlilar`
--

CREATE TABLE `cikolatali_tatlilar` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_bilgi` text,
  `urun_resmi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `cikolatali_tatlilar`
--

INSERT INTO `cikolatali_tatlilar` (`id`, `urun_adi`, `urun_bilgi`, `urun_resmi`) VALUES
(2, 'Brownie', 'Brownie', 'uploads/brownie.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `meyveli_tatlilar`
--

CREATE TABLE `meyveli_tatlilar` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_bilgi` text,
  `urun_resmi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `meyveli_tatlilar`
--

INSERT INTO `meyveli_tatlilar` (`id`, `urun_adi`, `urun_bilgi`, `urun_resmi`) VALUES
(3, 'Çilek Çikolata', 'Çilek Çikolata', 'uploads/meyve.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pratik_tatlilar`
--

CREATE TABLE `pratik_tatlilar` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_bilgi` text,
  `urun_resmi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `pratik_tatlilar`
--

INSERT INTO `pratik_tatlilar` (`id`, `urun_adi`, `urun_bilgi`, `urun_resmi`) VALUES
(5, 'Magnolia', 'Magnolia', 'uploads/p1.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(65) NOT NULL,
  `urun_adres` varchar(65) NOT NULL,
  `urun_resmi` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_adi`, `urun_adres`, `urun_resmi`, `kategori`) VALUES
(11, 'Meyveli Tatlilar', 'PratikTatlılar.php', 'uploads/3.jpg', NULL),
(12, 'Pratik Tatlilar', 'MeyveliTatlılar.php', 'uploads/1.jpg', NULL),
(19, 'Cikolatali Tatlilar', 'çikolatalıTatlılar.php', 'uploads/2.jpg', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(65) NOT NULL,
  `kayit_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kullaniciadi`, `email`, `parola`, `kayit_tarihi`, `is_admin`) VALUES
(132, 'beyza', 'sabeyoy575@kazvi.com', '$2y$10$OW6lyf8kvv9gporIy/RFMOsYly2mK2tCaB0vpv4tFZJDlYAO9TcSy', '2024-11-21 22:51:11', b'0'),
(133, 'admin', 'ebruylmaazz0505@gmail.com', '$2y$10$MkdOdbD.Ftjc.9AUbB8kD.MsCgCUE2JiZR2SNh/4JCzB70dRPPptu', '2024-11-21 22:53:09', b'0'),
(134, 'melike', 'ebruylmaazz0505@gmail.com', '$2y$10$bICn3Rf164TWnIy/WcQxfOp8Iv/F/cK.cv64E4dAVF8xt7wESWCbS', '2024-11-21 23:01:04', b'0'),
(137, 'ebrus', 'ebruylmaazz0505@gmail.com', '$2y$10$muUqFMIsGGvazXReWPZil.wYm8AyBxAtPe4obt/rOWzvp/HyNWXQS', '2024-11-22 14:21:17', b'1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adminler`
--
ALTER TABLE `adminler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cikolatali_tatlilar`
--
ALTER TABLE `cikolatali_tatlilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `meyveli_tatlilar`
--
ALTER TABLE `meyveli_tatlilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pratik_tatlilar`
--
ALTER TABLE `pratik_tatlilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullaniciadi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adminler`
--
ALTER TABLE `adminler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `cikolatali_tatlilar`
--
ALTER TABLE `cikolatali_tatlilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `meyveli_tatlilar`
--
ALTER TABLE `meyveli_tatlilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `pratik_tatlilar`
--
ALTER TABLE `pratik_tatlilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
