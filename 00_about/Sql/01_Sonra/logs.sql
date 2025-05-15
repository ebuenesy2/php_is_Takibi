-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 May 2025, 17:30:08
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
-- Veritabanı: `test_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `serviceName` text NOT NULL,
  `serviceDb` text NOT NULL,
  `serviceDb_Id` text NOT NULL,
  `serviceCode` text NOT NULL,
  `status` text NOT NULL,
  `decription` text NOT NULL,
  `created_byId` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`id`, `serviceName`, `serviceDb`, `serviceDb_Id`, `serviceCode`, `status`, `decription`, `created_byId`, `created_at`) VALUES
(2, 'Kullanıcı', 'users', '10', 'login', 'success', 'Giriş Yapıldı', '1', '2025-05-08 11:56:41'),
(3, 'Kullanıcı', 'users', '10', 'logout', 'success', 'Çıkış Yapıldı', '1', '2025-05-08 12:56:42'),
(4, 'Kullanıcı', 'users', '1', 'delete', 'success', 'Kullanıcı Silindi', '1', '2025-05-08 11:56:42'),
(6, 'Kullanıcı', 'users', '1', 'login', 'success', 'Giriş Yapıldı', '1', '2025-05-08 12:30:26'),
(7, 'Kullanıcı', 'users', '1', 'add', 'archived', 'Arşivlendi', '1', '2025-05-08 12:30:35'),
(9, 'Test', 'test', '1', 'logout', 'success', 'Çıkış Yapıldı', '1', '2025-05-08 12:30:36'),
(10, 'Test', 'test', '1', 'delete', 'success', 'Test Silindi', '1', '2025-05-08 12:31:09'),
(11, 'Kullanıcı', 'users', '10', 'login', 'success', 'Giriş Yapıldı', '1', '2025-05-08 13:53:35');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
