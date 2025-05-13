-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 May 2025, 15:24:18
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `is_takibi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departman`
--

CREATE TABLE `departman` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_byId` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_status` int(11) NOT NULL DEFAULT 0,
  `updated_byId` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_status` int(11) NOT NULL DEFAULT 0,
  `deleted_byId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `departman`
--

INSERT INTO `departman` (`id`, `title`, `created_at`, `created_byId`, `updated_at`, `updated_status`, `updated_byId`, `deleted_at`, `deleted_status`, `deleted_byId`) VALUES
(1, 'DİZGİ-GRAFİK BİRİMİ', '2025-05-13 13:22:10', NULL, '2025-05-13 13:22:10', 0, 0, NULL, 0, NULL),
(2, 'ONLINE & OFFLİNE EĞİTİM', '2025-05-13 13:23:23', NULL, '2025-05-13 13:23:23', 0, 0, NULL, 0, NULL),
(3, 'TEKNİK HİZMETLER', '2025-05-13 13:23:23', NULL, '2025-05-13 13:23:23', 0, 0, NULL, 0, NULL),
(4, 'İLETİŞİM DESTEK', '2025-05-13 13:23:23', NULL, '2025-05-13 13:23:23', 0, 0, NULL, 0, NULL),
(5, 'SOSYAL MEDYA', '2025-05-13 13:23:23', NULL, '2025-05-13 13:23:23', 0, 0, NULL, 0, NULL),
(6, 'DİZGİ-GRAFİK BİRİMİ', '2025-05-13 13:23:23', NULL, '2025-05-13 13:23:23', 0, 0, NULL, 0, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `departman`
--
ALTER TABLE `departman`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `departman`
--
ALTER TABLE `departman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
