-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 May 2025, 17:17:39
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
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` text DEFAULT NULL,
  `departman` int(11) DEFAULT 0,
  `created_byId` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_status` int(11) DEFAULT 0,
  `updated_byId` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_status` int(11) NOT NULL DEFAULT 0,
  `deleted_byId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `departman`, `created_byId`, `created_at`, `updated_at`, `updated_status`, `updated_byId`, `deleted_at`, `deleted_status`, `deleted_byId`) VALUES
(1, 'Admin', 'Soyad', 'admin@admin.com', '$2y$10$CO9NO3J0d57KgcdRQl/zjuZE9cVsJj5I4qyy.DoD92HFwaEMgt26a', 'admin', 1, 1, '2025-05-09 13:28:20', '2025-05-14 13:03:17', 1, 1, NULL, 0, NULL),
(2, 'DİZGİ-GRAFİK BİRİMİ - 1', 'Soyad', 'dizi@admin.com', '$2y$10$u4ToOAq0CkLSbHd3ZdmlmuNaTf.TAyRSjj8XKUpqC.lMw70rQ7KaS', 'user', 1, NULL, '2025-05-14 09:01:31', '2025-05-14 09:01:38', 1, 2, NULL, 0, NULL),
(3, 'DİZGİ-GRAFİK BİRİMİ - 2', 'Soyad', 'dizi2@admin.com', '$2y$10$vNwBcCy34as10zw.v4NBP.vviOe3X0tU2cN6wF8wkYtwxh6tVz4tS', 'user', 1, NULL, '2025-05-14 09:15:19', '2025-05-14 09:15:34', 1, 2, NULL, 0, NULL),
(4, 'ONLINE & OFFLİNE EĞİTİM - 1', 'Soyad', 'online@admin.com', '$2y$10$ni5yTVtQQsS8F5WQTUnc.OFzspXRbotDD7GBqIGa/1orb5XopMdkK', 'user', 2, NULL, '2025-05-14 09:05:09', '2025-05-14 09:05:09', 0, 0, NULL, 0, NULL),
(5, 'ONLINE & OFFLİNE EĞİTİM - 2', 'Soyad', 'online2@admin.com', '$2y$10$flWsuR5iVLqCjoaC7ESXMeOaNnIgZ.sEoVoNO/gWcV/n.lLq9aek6', 'user', 2, NULL, '2025-05-14 09:16:44', '2025-05-14 09:16:44', 0, 0, NULL, 0, NULL),
(6, 'TEKNİK HİZMETLER - 1', 'Soyad', 'teknik@admin.com', '$2y$10$hW4sJj0nmXC.FZlukVxv7.N7.s4OCJ/sn33simpyjeX8JtKNsJtlW', 'user', 3, NULL, '2025-05-14 09:06:01', '2025-05-14 09:06:01', 0, 0, NULL, 0, NULL),
(7, 'TEKNİK HİZMETLER - 2', 'Soyad', 'teknik2@admin.com', '$2y$10$ZLgZ83bjHozcgemDbJKhEueRODvQvAPTwOTxxW2OHx9uyvRvmTkXu', 'user', 3, NULL, '2025-05-14 09:19:13', '2025-05-14 09:19:13', 0, 0, NULL, 0, NULL),
(8, 'İLETİŞİM DESTEK - 1', 'Soyad', 'iletisim@admin.com', '$2y$10$CgdN0E4q2VTP6.b8pxtrMuSEy6i34cxKNcwJdmhuyin6/0nRS9rhC', 'user', 4, NULL, '2025-05-14 09:10:08', '2025-05-14 09:10:08', 0, 0, NULL, 0, NULL),
(9, 'İLETİŞİM DESTEK - 2', 'Soyad', 'iletisim2@admin.com', '$2y$10$.l5HZLaxIMjlDz4MIjGxe.FqRP4Tyc802JXQwOieZwogVHKTni5U.', 'user', 4, NULL, '2025-05-14 09:19:50', '2025-05-14 09:19:50', 0, 0, NULL, 0, NULL),
(10, 'SOSYAL MEDYA - 1', 'Soyad', 'sosyal_medya@admin.com', '$2y$10$6/t0lp9wdmWZlVsu.V/DB.WmCIKbIaBRCmS5LxDWSjKUPmBld2BIS', 'user', 5, NULL, '2025-05-14 09:02:52', '2025-05-14 09:02:52', 0, 0, NULL, 0, NULL),
(11, 'SOSYAL MEDYA - 2', 'Soyad', 'sosyal_medya2@admin.com', '$2y$10$0j6iIQ0DOTnChDeWv2H9I.a5iqKp52Zf4VBamHHGbYPNNkb8DQmgC', 'user', 5, NULL, '2025-05-14 09:20:45', '2025-05-14 09:20:45', 0, 0, NULL, 0, NULL),
(12, 'İNTERNET HİZMETLER - 1', 'Soyad', 'internet@admin.com', '$2y$10$f13DgW1aIvSE9Kp7xpCbK..WA5U.OiK9sNZeAGsIrR8uv.Glupjyu', 'user', 0, NULL, '2025-05-14 09:02:12', '2025-05-14 13:03:27', 1, 12, NULL, 0, NULL),
(13, 'İNTERNET HİZMETLER - 2', 'Soyad', 'internet2@admin.com', '$2y$10$ZMHW65C3sESfI8OhjtA9mebvJxh7WfUR0KQ23Ygmikn7CedJVsUCK', 'user', 6, NULL, '2025-05-14 09:21:33', '2025-05-14 09:21:33', 0, 0, NULL, 0, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
