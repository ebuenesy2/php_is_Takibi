-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 May 2025, 16:10:57
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
  `created_byId` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `created_byId`, `created_at`) VALUES
(2, 'admin', 'admin', 'admin@tusdata.com', '$2y$10$CO9NO3J0d57KgcdRQl/zjuZE9cVsJj5I4qyy.DoD92HFwaEMgt26a', 'admin', 1, '2025-05-09 13:28:20'),
(3, 'enes', 'yildirim', 'user@gmail.com', '$2y$10$CO9NO3J0d57KgcdRQl/zjuZE9cVsJj5I4qyy.DoD92HFwaEMgt26a', 'user', 1, '2025-05-09 13:28:21'),
(8, 'Api', 'test', 'api@gmail.com', '$2y$10$BwNfi0tvpXJjb5vpWy2ZsOl/lFZ2uHzt38JwH4KlMLxWRyT8Z2B/q', 'user', NULL, '2025-05-12 06:03:39'),
(10, 'dsad', 'sadsad', 'sadsad@gmail.com', '$2y$10$A.YayL3N.XEK9tL7Gd7HpuYQLLrKvIXVBVCwQOuFpk/8g2d8YjcAK', 'user', NULL, '2025-05-12 13:47:39');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
