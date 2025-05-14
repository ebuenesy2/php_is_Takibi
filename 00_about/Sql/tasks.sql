-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 May 2025, 11:32:04
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
(57, 2, 'Dizi 1', 'Görev -  DİZGİ-GRAFİK BİRİMİ - 1', 'Tamamlandı', '2025-05-14 08:23:10', 2, '2025-05-14 09:31:42', 1, 1, NULL, 0, NULL),
(58, 3, 'Dizi 2', 'Görev -  DİZGİ-GRAFİK BİRİMİ - 2', 'Planlandı', '2025-05-14 08:23:26', 2, '2025-05-14 09:23:26', 0, 0, NULL, 0, NULL),
(59, 4, 'ONLINE & OFFLİNE EĞİTİM - 1', 'Görev -  ONLINE & OFFLİNE EĞİTİM - 1', 'Devam Ediliyor', '2025-05-14 08:26:38', 2, '2025-05-14 09:31:36', 1, 1, NULL, 0, NULL),
(60, 5, 'ONLINE & OFFLİNE EĞİTİM - 2', 'Görev -  ONLINE & OFFLİNE EĞİTİM - 2', 'Planlandı', '2025-05-14 08:26:48', 2, '2025-05-14 09:26:48', 0, 0, NULL, 0, NULL),
(61, 6, 'TEKNİK HİZMETLER - 1', 'Görev -  TEKNİK HİZMETLER - 1', 'Tamamlandı', '2025-05-14 08:27:11', 2, '2025-05-14 09:31:31', 1, 1, NULL, 0, NULL),
(62, 7, 'TEKNİK HİZMETLER - 2', 'Görev -  TEKNİK HİZMETLER - 2', 'Planlandı', '2025-05-14 08:27:28', 2, '2025-05-14 09:27:28', 0, 0, NULL, 0, NULL),
(63, 12, 'İLETİŞİM DESTEK - 1', 'Görev -  İLETİŞİM DESTEK - 1', 'Tamamlandı', '2025-05-14 08:28:18', 2, '2025-05-14 09:31:25', 1, 1, NULL, 0, NULL),
(64, 9, 'İLETİŞİM DESTEK - 2', 'Görev -  İLETİŞİM DESTEK - 2', 'Planlandı', '2025-05-14 08:28:32', 2, '2025-05-14 09:28:32', 0, 0, NULL, 0, NULL),
(65, 10, 'SOSYAL MEDYA - 1 ', 'Görev -  SOSYAL MEDYA - 1 ', 'Devam Ediliyor', '2025-05-14 08:28:49', 2, '2025-05-14 09:31:03', 1, 1, NULL, 0, NULL),
(66, 11, 'SOSYAL MEDYA - 2', 'Görev -  SOSYAL MEDYA - 2', 'Planlandı', '2025-05-14 08:29:02', 2, '2025-05-14 09:29:02', 0, 0, NULL, 0, NULL),
(67, 12, 'İNTERNET HİZMETLER - 1', 'Görev -  İNTERNET HİZMETLER - 1', 'Devam Ediliyor', '2025-05-14 08:29:18', 2, '2025-05-14 09:31:00', 1, 1, NULL, 0, NULL),
(68, 13, 'İNTERNET HİZMETLER - 2', 'Görev -  İNTERNET HİZMETLER - 2', 'Planlandı', '2025-05-14 08:29:48', 2, '2025-05-14 09:29:48', 0, 0, NULL, 0, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
