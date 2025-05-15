-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 May 2025, 08:35:53
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
-- Tablo için tablo yapısı `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `name` text DEFAULT NULL,
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
-- Tablo döküm verisi `test`
--

INSERT INTO `test` (`id`, `title`, `name`, `created_at`, `created_byId`, `updated_at`, `updated_status`, `updated_byId`, `deleted_at`, `deleted_status`, `deleted_byId`) VALUES
(47, 'title güncelle', 'name', '2025-05-12 12:58:34', 2, '2025-05-13 07:47:44', 1, 1, NULL, 1, NULL),
(48, 'başlık', 'name', '2025-05-12 13:01:08', 2, '2025-05-12 14:01:08', 0, 0, NULL, 0, NULL),
(49, 'sadsad --  Test', 'name', '2025-05-12 13:13:34', 2, '2025-05-12 14:28:33', 1, 2, NULL, 0, NULL),
(50, 'Başlık Düzenle', 'name', '2025-05-12 13:16:45', 8, '2025-05-13 07:23:58', 1, 8, NULL, 0, NULL),
(51, 'sadsad', 'name', '2025-05-12 13:22:43', 8, '2025-05-12 14:22:43', 0, 0, NULL, 0, NULL),
(53, 'Arşivle cxxx', 'name', '2025-05-12 13:24:05', 8, '2025-05-13 06:24:12', 1, 8, NULL, 0, NULL),
(54, 'Son', 'name', '2025-05-13 07:18:48', 8, '2025-05-13 08:18:48', 0, 0, NULL, 0, NULL),
(55, 'title add', 'name', '2025-05-13 07:41:11', 1, '2025-05-13 08:41:11', 0, 0, NULL, 0, NULL),
(56, 'title add', 'name', '2025-05-13 09:51:57', 1, '2025-05-13 10:51:57', 0, 0, NULL, 0, NULL),
(57, 'title add', 'name', '2025-05-14 10:15:28', 1, '2025-05-14 11:15:28', 0, 0, NULL, 0, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
