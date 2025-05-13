-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 May 2025, 17:30:50
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
-- Tablo için tablo yapısı `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operation` text NOT NULL,
  `before` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`before`)),
  `after` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`after`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `operation`, `before`, `after`, `created_at`) VALUES
(1, 880, 'create', 'null', '{\n  \"email\": null,\n  \"user_id\": 880,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 45\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 00:00:00'),
(2, 880, 'update', '{\n  \"email\": null,\n  \"user_id\": 880,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 45\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 880,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 00:00:00'),
(3, 880, 'delete', '{\n  \"email\": null,\n  \"user_id\": 880,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 880,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 0,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 00:00:00'),
(4, 881, 'create', 'null', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Dündar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 11:23:19'),
(5, 881, 'update', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Dündar\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 11:23:25'),
(6, 881, 'update', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 46\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 78\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 11:23:25'),
(7, 881, 'update', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 78\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes x\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 81\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 11:23:25'),
(8, 881, 'delete', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes x\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 1,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 81\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '{\n  \"email\": null,\n  \"user_id\": 881,\n  \"ad_soyad\": \"Ayşe Mukkaddes x\",\n  \"password\": \"$2y$12$wsuGfiCRU/FNgV5XyiOg5uzl5QgfoN4U1GpBLyFD0J740MYoL/RYS\",\n  \"sehir_id\": null,\n  \"is_active\": 0,\n  \"created_at\": \"2024-12-06T14:55:24.000000Z\",\n  \"last_login\": \"NULL\",\n  \"updated_at\": \"2025-04-29T20:59:06.000000Z\",\n  \"uyelik_bitis\": \"2025-04-22 14:57:29\",\n  \"remember_token\": \"4IfiqspOy3fhdo4yHQE0GxfCRIpj5GqQqf5fr8VpohJMrsI3TNe2WxxxQsUW\",\n  \"uyelik_baslama\": \"2024-04-22 14:57:29\",\n  \"telefon_numarasi\": \"0(534) 331 09 81\",\n  \"email_verified_at\": null,\n  \"aktif_oturum_sayisi\": null\n}', '2025-05-06 11:23:25');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
