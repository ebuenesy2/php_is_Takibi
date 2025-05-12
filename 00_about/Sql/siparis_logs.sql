-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 May 2025, 17:30:54
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
-- Tablo için tablo yapısı `siparis_logs`
--

CREATE TABLE `siparis_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operation` text NOT NULL,
  `before` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `after` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `siparis_logs`
--

INSERT INTO `siparis_logs` (`id`, `user_id`, `operation`, `before`, `after`, `created_at`) VALUES
(1, 880, 'create', 'null', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Çankara\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '2025-05-06 00:00:00'),
(2, 880, 'update', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Çankara\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Kızılay Meydan Yukarısı\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '2025-05-06 00:00:00'),
(3, 880, 'update', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Kızılay Meydan Yukarısı\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Kızılay Meydan Yukarısı\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"Ahmet Yakar\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\",\\\"39\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 06\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '2025-05-06 00:00:00'),
(4, 881, 'delete', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Çankara\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 0,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '{\n  \"bank\": null,\n  \"adres\": \"Ankara / Çankara\",\n  \"email\": \"deneme@deneme.com\",\n  \"taksit\": 0,\n  \"user_id\": null,\n  \"aciklama\": null,\n  \"ad_soyad\": \"denemeAd Soyad\",\n  \"cardType\": null,\n  \"sehir_id\": 9,\n  \"kart_turu\": null,\n  \"paket_ids\": \"[\\\"38\\\"]\",\n  \"created_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"odeme_turu\": null,\n  \"siparis_id\": 45/8,\n  \"telefon_no\": \"0(555) 567 89 01\",\n  \"updated_at\": \"2025-04-09T12:27:07.000000Z\",\n  \"referans_no\": \"097554\",\n  \"merchant_oid\": null,\n  \"toplam_tutar\": null,\n  \"payment_result\": 0,\n  \"siparis_incelendi\": 0,\n  \"siparis_is_delete\": 1,\n  \"siparis_kullanim_süresi\": null,\n  \"siparis_son_kullanim_zamani\": null\n}', '2025-05-06 11:23:19');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `siparis_logs`
--
ALTER TABLE `siparis_logs`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `siparis_logs`
--
ALTER TABLE `siparis_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
