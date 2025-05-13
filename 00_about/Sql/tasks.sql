-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 May 2025, 16:16:57
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
-- Tablo için tablo yapısı `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` text NOT NULL,
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
-- Tablo döküm verisi `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `created_at`, `created_byId`, `updated_at`, `updated_status`, `updated_byId`, `deleted_at`, `deleted_status`, `deleted_byId`) VALUES
(46, 2, 'sad', 'sadasd', 'Devam Ediliyor', '2025-05-12 12:58:18', 2, '2025-05-12 10:44:54', 1, 2, NULL, 0, NULL),
(47, 2, 'sadsad', 'dsadasd', 'Devam Ediliyor', '2025-05-12 12:58:34', 2, '2025-05-13 06:50:19', 1, 2, NULL, 0, NULL),
(48, 2, 'başlık', 'Açıklama', 'Devam Ediliyor', '2025-05-12 13:01:08', 2, '2025-05-12 14:01:08', 0, 0, NULL, 0, NULL),
(50, 8, 'Başlık Düzenle', 'sadasd', 'Tamamlandı', '2025-05-12 13:16:45', 8, '2025-05-13 11:46:39', 1, 8, NULL, 0, NULL),
(51, 8, 'sadsad', 'sadsad', 'Planlandı', '2025-05-12 13:22:43', 8, '2025-05-12 14:22:43', 0, 0, NULL, 0, NULL),
(54, 8, 'Son', 'Açıklama', 'Devam Ediliyor', '2025-05-13 07:18:48', 8, '2025-05-13 08:18:48', 0, 0, NULL, 0, NULL),
(55, 8, 'Son - Test', 'sadsad', 'Devam Ediliyor', '2025-05-13 09:58:50', 8, '2025-05-13 11:44:58', 1, 2, NULL, 0, NULL),
(56, 3, 'Deneme', 'Açıklama', 'Devam Ediliyor', '2025-05-13 11:59:13', 3, '2025-05-13 12:59:13', 0, 0, NULL, 0, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
