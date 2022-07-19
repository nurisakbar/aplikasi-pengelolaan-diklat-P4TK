-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 19 Jul 2022 pada 06.04
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
-- Struktur dari tabel `program_keahlian`
--

CREATE TABLE `program_keahlian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_program_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_keahlian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_keahlian`
--

INSERT INTO `program_keahlian` (`id`, `nama_program_keahlian`, `bidang_keahlian_id`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi Konstruksi dan Properti', 3, '2021-12-25 00:09:23', '2021-12-25 00:09:23'),
(2, 'Teknik Geomatika dan Geospasial', 3, '2021-12-25 00:12:12', '2021-12-25 00:12:12'),
(3, 'Teknik Ketenagalistrikan', 3, '2021-12-25 00:13:06', '2021-12-25 00:13:06'),
(4, 'Teknik Mesin', 3, '2021-12-25 00:13:32', '2021-12-25 00:13:32'),
(5, 'Teknologi Pesawat Udara', 3, '2021-12-25 00:14:11', '2021-12-25 00:14:11'),
(6, 'Teknik Grafika', 3, '2021-12-25 00:14:41', '2021-12-25 03:25:39'),
(7, 'Teknik Instrumentasi Industri', 3, '2021-12-25 00:15:24', '2021-12-25 00:15:24'),
(8, 'Teknik Industri', 3, '2021-12-25 00:15:56', '2021-12-25 00:16:20'),
(9, 'Teknologi Tekstil', 3, '2021-12-25 00:16:49', '2021-12-25 00:16:49'),
(10, 'Teknik Kimia', 3, '2021-12-25 00:17:20', '2021-12-25 00:17:20'),
(11, 'Teknik Otomotif', 3, '2021-12-25 00:17:49', '2021-12-25 00:18:15'),
(12, 'Teknik Perkapalan', 3, '2021-12-25 00:18:41', '2021-12-25 00:18:41'),
(13, 'Teknik Elektronika', 3, '2021-12-25 00:19:39', '2021-12-25 01:40:11'),
(14, 'Teknik Perminyakan', 4, '2021-12-25 00:20:07', '2021-12-25 00:20:07'),
(15, 'Geologi Pertambangan', 4, '2021-12-25 00:20:44', '2021-12-25 00:20:44'),
(16, 'Teknik Energi Terbarukan', 4, '2021-12-25 00:21:27', '2021-12-25 00:21:27'),
(17, 'Teknik Komputer dan Informatika', 5, '2021-12-25 00:22:04', '2021-12-25 00:22:04'),
(18, 'Teknik Telekomunikasi', 5, '2021-12-25 00:22:30', '2021-12-25 00:22:30'),
(19, 'Keperawatan', 6, '2021-12-25 00:22:57', '2021-12-25 00:22:57'),
(20, 'Kesehatan Gigi', 6, '2021-12-25 00:23:22', '2021-12-25 00:23:22'),
(21, 'Teknik Laboratorium medik', 6, '2021-12-25 00:24:07', '2021-12-25 02:02:19'),
(22, 'Parmasi', 6, '2021-12-25 00:24:28', '2021-12-25 00:24:28'),
(23, 'Pekerjaan Sosial', 6, '2021-12-25 00:24:54', '2021-12-25 00:24:54'),
(24, 'Argibisnis Tanaman', 7, '2021-12-25 00:25:49', '2021-12-25 00:25:49'),
(25, 'Argibisnis Pengolahan Hasil Pertanian', 7, '2021-12-25 00:37:40', '2021-12-25 00:37:40'),
(26, 'Teknik Pertanian', 7, '2021-12-25 00:38:09', '2021-12-25 00:38:09'),
(27, 'Kehutanan', 7, '2021-12-25 00:38:30', '2021-12-25 00:38:30'),
(28, 'Pelayaran Kapal Penangkapan Ikan', 8, '2021-12-25 00:39:18', '2021-12-25 00:39:18'),
(29, 'Pelayaran Kapal Niaga', 8, '2021-12-25 00:39:42', '2021-12-25 00:39:42'),
(30, 'Perikanan', 8, '2021-12-25 00:40:05', '2021-12-25 00:40:05'),
(31, 'Pengolahan Hasil Perikanan', 8, '2021-12-25 00:40:38', '2021-12-25 00:40:38'),
(32, 'Bisnis dan Pemasaran', 9, '2021-12-25 00:41:26', '2021-12-25 00:41:26'),
(33, 'Manajemen Perkantoran', 9, '2021-12-25 00:42:01', '2021-12-25 00:42:01'),
(34, 'Akutansi dan Keuangan', 9, '2021-12-25 00:42:24', '2021-12-25 00:42:24'),
(35, 'Logistik', 9, '2021-12-25 00:42:46', '2021-12-25 00:42:46'),
(36, 'Perhotelan dan Jasa Parawisata', 11, '2021-12-25 00:43:19', '2021-12-25 00:43:19'),
(37, 'Kuliner', 11, '2021-12-25 00:43:36', '2021-12-25 00:43:36'),
(38, 'Tata Kecantikan', 11, '2021-12-25 00:43:58', '2021-12-25 00:43:58'),
(39, 'Tata Busana', 11, '2021-12-25 00:44:18', '2021-12-25 00:44:18'),
(40, 'Seni Rupa', 12, '2021-12-25 00:44:40', '2021-12-25 00:44:40'),
(41, 'Desain dan Produk Kreatif Kriya', 12, '2021-12-25 00:45:21', '2021-12-25 00:45:21'),
(42, 'Seni Musik', 12, '2021-12-25 00:45:36', '2021-12-25 00:45:36'),
(43, 'Seni Tari', 12, '2021-12-25 00:45:53', '2021-12-25 00:45:53'),
(44, 'Seni Karawitan', 12, '2021-12-25 00:46:11', '2021-12-25 00:46:11'),
(45, 'Seni Pedalangan', 12, '2021-12-25 00:46:37', '2021-12-25 00:46:37'),
(46, 'Seni Teater', 12, '2021-12-25 00:46:52', '2021-12-25 00:46:52'),
(47, 'Seni Broadcasting dan Film', 12, '2021-12-25 00:47:25', '2021-12-25 00:47:25'),
(49, 'Agribisnis Ternak', 7, '2021-12-25 02:10:19', '2021-12-25 02:10:19'),
(50, 'Kesehatan Hewan', 7, '2021-12-25 02:10:47', '2021-12-25 02:10:47'),
(51, 'Produkti', 14, '2022-03-06 00:59:55', '2022-03-06 00:59:55'),
(52, 'produktif', 14, '2022-03-06 01:00:07', '2022-03-06 01:14:23'),
(53, 'Teknik Geospasial', 15, '2022-04-18 10:18:16', '2022-04-18 10:18:16'),
(54, 'Teknik Pemesinan', 3, '2022-04-18 13:29:43', '2022-04-18 13:29:43'),
(55, 'Perhotelan dan Jasa Pariwisata', 11, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(56, 'Teknik Pesawat Udara', 3, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(57, 'Agribisnis Produksi Tanaman', 7, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(58, 'Administrasi', 9, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(59, 'Akuntansi dan Keuangan', 9, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(60, 'Keuangan', 9, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(61, 'Tata Niaga', 9, '2022-07-18 09:29:46', '2022-07-18 09:29:46'),
(62, 'Agribisnis Pengolahan Hasil Pertanian', 7, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(63, 'Agribisnis Pengolahan Hasil Pertanian dan Perikanan', 7, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(64, 'Agribisnis Produksi Sumberdaya Perairan', 7, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(65, 'Teknologi dan Produksi Perikanan Budidaya', 16, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(66, 'Tata Busana', 17, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(67, 'Agribisnis Produksi Ternak', 7, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(68, 'Teknik Bangunan', 3, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(69, 'Teknik Furnitur', 3, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(70, 'Kepariwisataan', 11, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(71, 'Tata Boga', 11, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(72, 'Geologi Pertambangan', 3, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(73, 'Geomatika', 3, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(74, 'Teknik Survey dan Pemetaan', 3, '2022-07-18 09:29:47', '2022-07-18 09:29:47'),
(75, 'Desain dan Produksi Kriya', 18, '2022-07-18 09:29:48', '2022-07-18 09:29:48'),
(76, 'Agribisnis Tanaman', 7, '2022-07-18 09:29:48', '2022-07-18 09:29:48'),
(77, '', 19, '2022-07-18 09:29:49', '2022-07-18 09:29:49'),
(78, 'Pelayaran Kapal Penangkap Ikan', 8, '2022-07-18 09:29:49', '2022-07-18 09:29:49'),
(79, 'Teknologi Penangkapan Ikan', 16, '2022-07-18 09:29:49', '2022-07-18 09:29:49'),
(80, 'Tata Boga', 20, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(81, 'Perhotelan', 21, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(82, 'Airframe Power Plant', 22, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(83, 'Agribisnis Tanaman Pangan dan Hortikultura', 23, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(84, 'Agribisnis Tanaman Perkebunan', 23, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(85, 'Administrasi Perkantoran', 24, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(86, 'Akuntansi dan Keuangan Lembaga', 25, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(87, 'Bisnis Daring dan Pemasaran', 26, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(88, 'Akuntansi', 27, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(89, 'Otomatisasi dan Tata Kelola Perkantoran', 28, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(90, 'Pemasaran', 29, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(91, 'Teknik Komputer dan Jaringan', 30, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(92, 'Agribisnis Pengolahan Hasil Pertanian', 31, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(93, 'Teknologi Pengolahan Hasil Pertanian', 32, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(94, 'Agribisnis Perikanan', 33, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(95, 'Agribisnis Perikanan Air Tawar', 34, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(96, 'Budidaya Perikanan', 35, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(97, 'Agribisnis Perikanan Air Payau dan Laut', 34, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(98, 'Tata Busana', 36, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(99, 'Busana Butik', 36, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(100, 'Teknik Otomotif Sepeda Motor', 37, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(101, 'Teknik Sepeda Motor', 37, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(102, 'Agribisnis Ternak Unggas', 38, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(103, 'Teknik Gambar Bangunan', 39, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(104, 'Teknik Konstruksi Kayu', 39, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(105, 'Teknik Audio Video', 40, '2022-07-18 09:33:55', '2022-07-18 09:33:55'),
(106, 'Teknik Furnitur', 41, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(107, 'Teknik Instalasi Pemanfaatan Tenaga Listrik', 42, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(108, 'Teknik Instalasi Tenaga Listrik', 42, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(109, 'Teknik Pengelasan', 43, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(110, 'Teknik Alat Berat', 37, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(111, 'Teknik Kendaraan Ringan', 37, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(112, 'Bisnis Konstruksi dan Properti', 44, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(113, 'Desain Pemodelan dan Informasi Bangunan', 44, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(114, 'Akomodasi Perhotelan', 45, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(115, 'Jasa Boga', 46, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(116, 'Patiseri', 46, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(117, 'Tata Kecantikan Kulit dan Rambut', 47, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(118, 'Tata Kecantikan Rambut', 47, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(119, 'Geologi Pertambangan', 48, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(120, 'Geomatika', 49, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(121, 'Teknik Geomatika', 50, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(122, 'Teknik Survei dan Pemetaan', 51, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(123, 'Multimedia', 30, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(124, 'Teknologi Pengolahan Hasil Perikanan', 32, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(125, 'Agribisnis Ternak Ruminansia', 38, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(126, 'Rekayasa Perangkat Lunak', 30, '2022-07-18 09:33:56', '2022-07-18 09:33:56'),
(127, 'Teknik Otomotif Kendaraan Ringan', 37, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(128, 'Kriya Kreatif Batik dan Tekstil', 52, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(129, 'Kriya Kreatif Kayu dan Rotan', 52, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(130, 'Kriya Kreatif Logam dan Perhiasan', 52, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(131, 'Desain dan Produksi Kriya Kayu', 53, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(132, 'Desain dan Produksi Kriya Logam', 53, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(133, 'Desain dan Produksi Kriya Tekstil', 53, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(134, 'Airframe dan Powerplant', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(135, 'Electrical Avionics', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(136, 'Elektronika Pesawat Udara (Aviation Electronis)', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(137, 'Pemeliharaan & Perbaikan Instrumen Elektronika Pesawat Udara', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(138, 'Pemeliharaan dan Perbaikan Motor dan Rangka Pesawat Udara', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(139, 'Pemesinan Pesawat Udara', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(140, 'Pemesinan Pesawat Udara (Aircraft Machining)', 22, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(141, 'Desain Grafika', 54, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(142, 'Persiapan Grafika', 54, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(143, 'Pemuliaan dan Perbenihan Tanaman', 55, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(144, 'Teknik Ototronik', 40, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(145, 'Teknik Jaringan Akses', 56, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(146, 'Teknik Jaringan Akses Telekomunikasi', 56, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(147, 'Teknik Konstruksi Batu dan Beton', 39, '2022-07-18 09:33:57', '2022-07-18 09:33:57'),
(148, 'Nautika Kapal Penangkap Ikan', 57, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(149, 'Teknika Kapal Penangkap Ikan', 57, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(150, ' Agribisnis Pengolahan Hasil Perikanan', 58, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(151, 'Nautika Kapal Penangkap Ikan', 59, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(152, 'Teknika Kapal Penangkap Ikan', 59, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(153, 'Perbankan dan Keuangan Mikro', 25, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(154, 'Perbankan', 27, '2022-07-18 09:33:58', '2022-07-18 09:33:58'),
(155, 'Teknik Otomotif Alat Berat', 37, '2022-07-18 09:33:59', '2022-07-18 09:33:59'),
(156, 'Sistem Informatika, Jaringan dan Aplikasi', 30, '2022-07-18 09:33:59', '2022-07-18 09:33:59'),
(157, 'Produksi dan Pengelolaan Perkebunan', 55, '2022-07-18 09:33:59', '2022-07-18 09:33:59'),
(158, 'Teknologi dan Produksi Perikanan Budidaya', 60, '2022-07-18 09:39:11', '2022-07-18 09:39:11'),
(159, 'Tata Busana', 61, '2022-07-18 09:39:11', '2022-07-18 09:39:11'),
(160, 'Desain dan Produksi Kriya', 62, '2022-07-18 09:39:13', '2022-07-18 09:39:13'),
(161, '', 63, '2022-07-18 09:39:14', '2022-07-18 09:39:14'),
(162, 'Teknologi Penangkapan Ikan', 60, '2022-07-18 09:39:14', '2022-07-18 09:39:14'),
(163, 'Mekanisasi Pertanian', 7, '2022-07-18 09:55:13', '2022-07-18 09:55:13'),
(164, 'Kesehatan', 64, '2022-07-18 09:55:14', '2022-07-18 09:55:14'),
(165, 'Tata Kecantikan', 61, '2022-07-18 09:55:16', '2022-07-18 09:55:16'),
(166, 'Pekerjaan Sosial', 64, '2022-07-18 09:55:17', '2022-07-18 09:55:17'),
(167, 'Farmasi', 65, '2022-07-18 09:55:17', '2022-07-18 09:55:17'),
(168, 'Keperawatan', 65, '2022-07-18 09:55:17', '2022-07-18 09:55:17'),
(169, 'Teknik Energi Terbarukan', 3, '2022-07-18 09:55:18', '2022-07-18 09:55:18'),
(170, 'Teknik Perminyakan', 3, '2022-07-18 09:55:18', '2022-07-18 09:55:18'),
(171, 'Pelayaran', 60, '2022-07-18 09:55:18', '2022-07-18 09:55:18'),
(172, 'Teknologi Laboratorium Medik', 65, '2022-07-18 09:55:19', '2022-07-18 09:55:19'),
(173, 'Pekerjaan Sosial', 65, '2022-07-18 09:55:22', '2022-07-18 09:55:22'),
(174, 'Teknik Plambing dan Sanitasi', 3, '2022-07-18 09:55:31', '2022-07-18 09:55:31'),
(175, 'Seni Rupa', 62, '2022-07-18 09:55:33', '2022-07-18 09:55:33'),
(176, 'Seni Karawitan', 66, '2022-07-18 09:55:40', '2022-07-18 09:55:40'),
(177, 'Seni Pedalangan', 66, '2022-07-18 09:55:40', '2022-07-18 09:55:40'),
(178, 'Seni Tari', 66, '2022-07-18 09:55:40', '2022-07-18 09:55:40'),
(179, 'Seni Musik', 66, '2022-07-18 09:55:47', '2022-07-18 09:55:47'),
(180, 'Seni Teater', 66, '2022-07-18 09:56:03', '2022-07-18 09:56:03'),
(181, 'Teknik Broadcasting', 5, '2022-07-18 09:56:07', '2022-07-18 09:56:07'),
(182, 'Penyuluhan Pertanian', 7, '2022-07-18 09:56:37', '2022-07-18 09:56:37'),
(183, 'Teknik Pendinginan dan Tata Udara', 3, '2022-07-18 09:56:44', '2022-07-18 09:56:44'),
(184, 'Kesehatan Gigi', 65, '2022-07-18 10:02:14', '2022-07-18 10:02:14'),
(185, 'Perawatan Sosial', 64, '2022-07-18 10:02:16', '2022-07-18 10:02:16'),
(186, 'Seni Rupa', 61, '2022-07-18 10:21:26', '2022-07-18 10:21:26'),
(187, 'Program', 67, '2022-07-18 10:26:09', '2022-07-18 10:26:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `program_keahlian`
--
ALTER TABLE `program_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `program_keahlian`
--
ALTER TABLE `program_keahlian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
