-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 19 Jul 2022 pada 06.03
-- Versi server: 5.7.34
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p4tk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_keahlian`
--

CREATE TABLE `bidang_keahlian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis` enum('adaptif','produktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'produktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bidang_keahlian`
--

INSERT INTO `bidang_keahlian` (`id`, `nama_bidang_keahlian`, `created_at`, `updated_at`, `jenis`) VALUES
(3, 'Teknologi dan Rekayasa', '2021-12-25 00:02:14', '2021-12-25 00:02:14', 'produktif'),
(4, 'Energi dan Pertambangan', '2021-12-25 00:02:57', '2021-12-25 00:02:57', 'produktif'),
(5, 'Teknologi Informasi dan Komunikasi', '2021-12-25 00:03:43', '2021-12-25 00:03:43', 'produktif'),
(6, 'Kesehatan dan Pekerja Sosial', '2021-12-25 00:04:11', '2021-12-25 00:04:11', 'produktif'),
(7, 'Agribisnis dan Agroteknologi', '2021-12-25 00:05:04', '2021-12-25 00:05:04', 'produktif'),
(8, 'Kemaritiman', '2021-12-25 00:05:44', '2021-12-25 00:05:44', 'produktif'),
(9, 'Bisnis dan Manajemen', '2021-12-25 00:06:21', '2021-12-25 00:06:21', 'produktif'),
(11, 'Pariwisata', '2021-12-25 00:06:53', '2021-12-25 00:06:53', 'produktif'),
(12, 'Seni dan Industri Kreatif', '2021-12-25 00:07:28', '2021-12-25 00:07:28', 'produktif'),
(13, 'Bahasa inggris', '2022-02-05 11:14:22', '2022-02-05 11:14:22', 'adaptif'),
(60, 'Perikanan dan Kelautan', '2022-07-18 09:39:11', '2022-07-18 09:39:11', 'produktif'),
(61, 'Seni, Kerajinan dan Pariwisata', '2022-07-18 09:39:11', '2022-07-18 09:39:11', 'produktif'),
(62, 'Seni Rupa dan Kriya', '2022-07-18 09:39:13', '2022-07-18 09:39:13', 'produktif'),
(63, '', '2022-07-18 09:39:14', '2022-07-18 09:39:14', 'produktif'),
(64, 'Kesehatan', '2022-07-18 09:55:14', '2022-07-18 09:55:14', 'produktif'),
(65, 'Kesehatan dan Pekerjaan Sosial', '2022-07-18 09:55:17', '2022-07-18 09:55:17', 'produktif'),
(66, 'Seni Pertunjukan', '2022-07-18 09:55:40', '2022-07-18 09:55:40', 'produktif'),
(67, 'Bidang', '2022-07-18 10:26:09', '2022-07-18 10:26:09', 'produktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
