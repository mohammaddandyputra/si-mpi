-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2021 at 03:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-mpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gangguans`
--

CREATE TABLE `gangguans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_komponen` int(11) UNSIGNED DEFAULT NULL,
  `id_teras` bigint(20) DEFAULT NULL,
  `tanggal_gangguan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perbaikan` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('SELESAI','TIDAK') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gangguans`
--

INSERT INTO `gangguans` (`id`, `kode_komponen`, `id_teras`, `tanggal_gangguan`, `created_at`, `updated_at`, `desc`, `id_perbaikan`, `status`) VALUES
(76, 64, 8, '2012-03-02', '2021-09-15 09:55:41', '2021-10-25 08:16:05', '-', 52, 'SELESAI'),
(78, 64, 21, '2014-03-19', '2021-09-15 08:30:54', '2021-09-15 09:57:55', '-', 54, 'SELESAI'),
(79, 64, 31, '2019-05-13', '2021-09-15 08:32:58', '2021-09-15 09:58:08', '-', 55, 'SELESAI'),
(80, 64, 32, '2019-09-05', '2021-09-15 08:33:32', '2021-09-15 09:58:23', '-', 56, 'SELESAI'),
(81, 67, 14, '2012-04-11', '2021-09-15 08:39:18', '2021-09-15 09:58:36', '-', 57, 'SELESAI'),
(82, 67, 15, '2012-06-18', '2021-09-15 08:40:56', '2021-09-15 09:58:57', '-', 58, 'SELESAI'),
(83, 67, 21, '2014-04-28', '2021-09-15 08:45:37', '2021-09-15 10:00:12', '-', 59, 'SELESAI'),
(84, 67, 22, '2015-08-27', '2021-09-15 08:46:05', '2021-09-15 10:00:36', '-', 60, 'SELESAI'),
(85, 81, 15, '2012-06-12', '2021-09-15 08:48:16', '2021-09-15 10:00:52', '-', 61, 'SELESAI'),
(87, 81, 22, '2015-08-27', '2021-09-15 08:48:56', '2021-09-15 10:01:45', '-', 63, 'SELESAI'),
(88, 81, 22, '2015-10-05', '2021-09-15 08:50:52', '2021-09-15 10:02:00', '-', 64, 'SELESAI'),
(89, 81, 26, '2017-05-21', '2021-09-15 08:51:25', '2021-09-15 10:02:14', '-', 65, 'SELESAI'),
(90, 82, 18, '2013-04-30', '2021-09-15 08:52:37', '2021-10-30 01:34:51', '-', 66, 'SELESAI'),
(91, 82, 6, '2015-01-05', '2021-09-15 08:53:02', '2021-09-15 10:06:13', '-', 67, 'SELESAI'),
(92, 82, 22, '2015-10-27', '2021-09-15 08:53:23', '2021-09-15 10:06:23', '-', 68, 'SELESAI'),
(93, 82, 24, '2016-07-25', '2021-09-15 08:53:54', '2021-09-15 10:06:45', '-', 69, 'SELESAI'),
(94, 83, 18, '2013-04-30', '2021-09-15 08:54:38', '2021-09-15 10:07:05', '-', 70, 'SELESAI'),
(95, 83, 5, '2014-09-09', '2021-09-15 08:57:23', '2021-09-15 10:07:18', '-', 71, 'SELESAI'),
(96, 83, 24, '2016-05-07', '2021-09-15 08:57:42', '2021-09-15 10:07:38', '-', 72, 'SELESAI'),
(97, 83, 25, '2017-03-08', '2021-09-15 08:58:16', '2021-09-15 10:08:25', '-', 73, 'SELESAI'),
(98, 84, 17, '2013-01-26', '2021-09-15 09:00:29', '2021-09-15 10:08:49', '-', 74, 'SELESAI'),
(99, 84, 18, '2013-04-30', '2021-09-15 09:00:59', '2021-09-15 10:09:08', '-', 75, 'SELESAI'),
(100, 84, 21, '2014-02-05', '2021-09-15 09:01:16', '2021-10-06 07:50:12', '-', 76, 'SELESAI'),
(101, 84, 5, '2014-06-19', '2021-09-15 09:01:35', '2021-09-15 10:11:25', '-', 77, 'SELESAI'),
(102, 146, 14, '2012-04-25', '2021-09-15 09:05:21', '2021-09-15 10:15:06', '-', 78, 'SELESAI'),
(103, 146, 14, '2012-04-30', '2021-09-15 09:05:33', '2021-09-15 10:15:27', '-', 79, 'SELESAI'),
(104, 146, 17, '2013-02-08', '2021-09-15 09:05:52', '2021-09-15 10:15:38', '-', 80, 'SELESAI'),
(105, 146, 21, '2014-03-20', '2021-09-15 09:06:15', '2021-09-15 10:16:01', '-', 81, 'SELESAI'),
(106, 146, 5, '2014-07-15', '2021-09-15 09:06:44', '2021-09-15 10:16:14', '-', 82, 'SELESAI'),
(107, 146, 5, '2014-08-12', '2021-09-15 09:07:02', '2021-09-15 10:17:24', '-', 83, 'SELESAI'),
(108, 146, 22, '2015-10-30', '2021-09-15 09:07:35', '2021-09-15 10:17:43', '-', 84, 'SELESAI'),
(109, 146, 22, '2015-11-02', '2021-09-15 09:07:54', '2021-09-15 10:17:58', '-', 85, 'SELESAI'),
(110, 146, 22, '2015-12-05', '2021-09-15 09:08:10', '2021-10-06 08:17:19', '-', 86, 'SELESAI'),
(111, 146, 23, '2016-02-05', '2021-09-15 09:08:28', '2021-09-15 10:18:23', '-', 87, 'SELESAI'),
(112, 146, 24, '2016-05-15', '2021-09-15 09:08:49', '2021-09-15 10:18:44', '-', 88, 'SELESAI'),
(113, 146, 27, '2017-12-01', '2021-09-15 09:09:07', '2021-10-06 08:10:00', '-', 89, 'SELESAI'),
(114, 146, 28, '2018-03-07', '2021-09-15 09:09:24', '2021-09-15 10:19:11', '-', 90, 'SELESAI'),
(115, 146, 32, '2019-05-28', '2021-09-15 09:09:46', '2021-09-15 10:19:27', '-', 91, 'SELESAI'),
(116, 147, 21, '2014-02-05', '2021-09-15 09:11:26', '2021-09-15 10:19:40', '-', 92, 'SELESAI'),
(117, 147, 5, '2014-06-19', '2021-09-15 09:13:40', '2021-09-15 10:19:57', '-', 93, 'SELESAI'),
(118, 147, 23, '2016-01-07', '2021-09-15 09:13:58', '2021-09-15 10:20:08', '-', 94, 'SELESAI'),
(119, 147, 31, '2018-10-16', '2021-09-15 09:14:30', '2021-09-15 10:20:22', '-', 95, 'SELESAI'),
(120, 64, 14, '2012-06-04', '2021-09-17 02:39:58', '2021-09-17 02:40:43', '-', 96, 'SELESAI'),
(138, 81, 5, '2014-09-09', NULL, '2021-10-26 04:10:29', '-', 160, 'SELESAI');

-- --------------------------------------------------------

--
-- Table structure for table `komponens`
--

CREATE TABLE `komponens` (
  `kode_komponen` int(11) UNSIGNED NOT NULL,
  `nama_komponen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komponens`
--

INSERT INTO `komponens` (`kode_komponen`, `nama_komponen`, `created_at`, `updated_at`) VALUES
(64, 'JDA01', '2021-08-27 03:10:41', '2021-10-12 07:00:56'),
(67, 'JDA02', '2021-08-27 03:11:40', '2021-08-31 16:56:29'),
(81, 'JDA03', '2021-08-31 18:13:38', '2021-08-31 18:13:38'),
(82, 'JDA04', '2021-08-31 18:13:58', '2021-08-31 18:13:58'),
(83, 'JDA05', '2021-08-31 18:14:16', '2021-08-31 18:14:16'),
(84, 'JDA06', '2021-08-31 18:15:00', '2021-08-31 18:15:00'),
(146, 'JDA07', '2021-09-02 04:14:16', '2021-09-02 04:14:16'),
(147, 'JDA08', '2021-09-14 10:13:45', '2021-09-14 10:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_19_143635_create_komponens_table', 1),
(5, '2021_05_19_143732_create_perbaikans_table', 1),
(6, '2021_05_19_143733_create_gangguans_table', 1),
(7, '2021_05_20_091712_create_perawatans_table', 1),
(8, '2021_06_15_041645_create_teras_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikans`
--

CREATE TABLE `perbaikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_perbaikan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tindakan` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikans`
--

INSERT INTO `perbaikans` (`id`, `tanggal_perbaikan`, `created_at`, `updated_at`, `tindakan`) VALUES
(52, '2012-03-06', '2021-09-15 09:56:29', '2021-10-30 01:35:39', '-'),
(54, '2014-03-24', '2021-09-15 09:57:55', '2021-10-27 04:19:00', '-'),
(55, '2019-05-16', '2021-09-15 09:58:08', '2021-09-15 09:58:08', '-'),
(56, '2019-09-10', '2021-09-15 09:58:23', '2021-09-15 09:58:23', '-'),
(57, '2012-04-18', '2021-09-15 09:58:36', '2021-09-15 09:58:36', '-'),
(58, '2012-06-29', '2021-09-15 09:58:57', '2021-09-15 09:58:57', '-'),
(59, '2014-05-07', '2021-09-15 10:00:12', '2021-09-15 10:00:12', '-'),
(60, '2015-09-04', '2021-09-15 10:00:36', '2021-09-15 10:00:36', '-'),
(61, '2012-06-18', '2021-09-15 10:00:52', '2021-10-30 01:56:28', '-'),
(63, '2015-09-04', '2021-09-15 10:01:45', '2021-09-15 10:01:45', '-'),
(64, '2015-10-05', '2021-09-15 10:02:00', '2021-09-15 10:02:00', '-'),
(65, '2017-05-21', '2021-09-15 10:02:14', '2021-09-15 10:02:14', '-'),
(66, '2013-05-02', '2021-09-15 10:05:53', '2021-09-15 10:05:53', '-'),
(67, '2015-01-07', '2021-09-15 10:06:13', '2021-09-15 10:06:13', '-'),
(68, '2015-10-27', '2021-09-15 10:06:23', '2021-09-15 10:06:23', '-'),
(69, '2016-08-22', '2021-09-15 10:06:45', '2021-09-15 10:06:45', '-'),
(70, '2013-05-02', '2021-09-15 10:07:05', '2021-09-15 10:07:05', '-'),
(71, '2014-09-22', '2021-09-15 10:07:18', '2021-09-15 10:07:18', '-'),
(72, '2016-05-07', '2021-09-15 10:07:38', '2021-09-15 10:07:38', '-'),
(73, '2017-03-08', '2021-09-15 10:08:25', '2021-09-15 10:08:25', '-'),
(74, '2013-01-27', '2021-09-15 10:08:49', '2021-09-15 10:08:49', '-'),
(75, '2013-05-02', '2021-09-15 10:09:08', '2021-09-15 10:09:08', '-'),
(76, '2014-02-10', '2021-09-15 10:09:18', '2021-09-15 10:09:18', '-'),
(77, '2014-06-24', '2021-09-15 10:11:25', '2021-09-15 10:11:25', '-'),
(78, '2012-04-25', '2021-09-15 10:15:06', '2021-09-15 10:15:06', '-'),
(79, '2012-05-10', '2021-09-15 10:15:27', '2021-09-15 10:15:27', '-'),
(80, '2013-02-08', '2021-09-15 10:15:38', '2021-09-15 10:15:38', '-'),
(81, '2014-03-26', '2021-09-15 10:16:01', '2021-09-15 10:16:01', '-'),
(82, '2014-07-25', '2021-09-15 10:16:14', '2021-09-15 10:16:14', '-'),
(83, '2014-08-26', '2021-09-15 10:17:24', '2021-09-15 10:17:24', '-'),
(84, '2015-10-30', '2021-09-15 10:17:43', '2021-09-15 10:17:43', '-'),
(85, '2015-11-27', '2021-09-15 10:17:58', '2021-09-15 10:17:58', '-'),
(86, '2015-12-05', '2021-09-15 10:18:14', '2021-09-15 10:18:14', '-'),
(87, '2016-02-05', '2021-09-15 10:18:23', '2021-09-15 10:18:23', '-'),
(88, '2016-05-15', '2021-09-15 10:18:44', '2021-09-15 10:18:44', '-'),
(89, '2017-12-06', '2021-09-15 10:18:57', '2021-09-15 10:18:57', '-'),
(90, '2018-03-13', '2021-09-15 10:19:11', '2021-09-15 10:19:11', '-'),
(91, '2019-05-31', '2021-09-15 10:19:27', '2021-09-15 10:19:27', '-'),
(92, '2014-02-10', '2021-09-15 10:19:40', '2021-09-15 10:19:40', '-'),
(93, '2014-06-24', '2021-09-15 10:19:57', '2021-09-15 10:19:57', '-'),
(94, '2016-01-08', '2021-09-15 10:20:08', '2021-09-15 10:20:08', '-'),
(95, '2018-10-17', '2021-09-15 10:20:22', '2021-09-15 10:20:22', '-'),
(96, '2012-06-04', '2021-09-17 02:40:43', '2021-09-17 02:40:43', '-'),
(160, '2014-09-22', '2021-10-26 04:10:29', '2021-10-26 04:10:29', '-');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_komponen`
--

CREATE TABLE `relasi_komponen` (
  `id` int(11) NOT NULL,
  `komponen` int(11) UNSIGNED NOT NULL,
  `relasi` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relasi_komponen`
--

INSERT INTO `relasi_komponen` (`id`, `komponen`, `relasi`) VALUES
(1, 146, 64),
(2, 146, 67),
(3, 146, 81),
(4, 146, 82),
(5, 146, 83),
(6, 146, 84),
(7, 146, 146),
(8, 146, 147),
(9, 64, 64),
(10, 64, 67),
(11, 64, 81),
(12, 67, 64),
(13, 81, 64),
(14, 82, 64),
(15, 83, 64),
(16, 84, 64),
(17, 147, 64),
(18, 64, 82),
(19, 64, 83),
(20, 64, 84),
(21, 64, 146),
(22, 64, 147),
(23, 67, 67),
(24, 67, 81),
(25, 67, 82),
(26, 67, 83),
(27, 67, 84),
(28, 67, 146),
(29, 67, 147),
(30, 81, 67),
(31, 81, 83),
(32, 81, 81),
(33, 81, 82),
(34, 81, 84),
(35, 81, 146),
(36, 81, 147),
(37, 82, 67),
(38, 82, 81),
(39, 82, 82),
(40, 82, 83),
(41, 82, 84),
(42, 82, 146),
(43, 82, 147),
(44, 83, 67),
(45, 83, 81),
(46, 83, 82),
(47, 83, 83),
(48, 83, 84),
(49, 83, 146),
(50, 83, 147),
(51, 84, 67),
(52, 84, 81),
(53, 84, 82),
(54, 84, 83),
(55, 84, 84),
(56, 84, 146),
(57, 84, 147),
(58, 147, 67),
(59, 147, 81),
(60, 147, 82),
(61, 147, 83),
(62, 147, 84),
(63, 147, 146),
(64, 147, 147);

-- --------------------------------------------------------

--
-- Table structure for table `scr`
--

CREATE TABLE `scr` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_komponen` int(11) UNSIGNED DEFAULT NULL,
  `sc` int(11) DEFAULT NULL,
  `qc` int(11) DEFAULT NULL,
  `pt` int(11) DEFAULT NULL,
  `oc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scr`
--

INSERT INTO `scr` (`id`, `kode_komponen`, `sc`, `qc`, `pt`, `oc`) VALUES
(53, 64, 3, 3, 4, 8500000),
(54, 67, 3, 3, 4, 8500000),
(55, 81, 3, 3, 4, 8500000),
(56, 82, 3, 3, 4, 8500000),
(57, 83, 3, 3, 4, 8500000),
(58, 84, 3, 3, 4, 8500000),
(59, 146, 3, 3, 8, 11000000),
(60, 147, 3, 3, 4, 8500000);

-- --------------------------------------------------------

--
-- Table structure for table `teras`
--

CREATE TABLE `teras` (
  `id` bigint(20) NOT NULL,
  `nama_teras` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teras`
--

INSERT INTO `teras` (`id`, `nama_teras`, `created_at`, `updated_at`) VALUES
(5, 'Teras 86', '2021-08-27 03:12:45', '2021-10-06 02:05:07'),
(6, 'Teras 87', '2021-09-09 15:22:18', '2021-09-09 15:22:19'),
(7, 'Teras 88', '2021-09-09 15:22:24', '2021-09-09 15:22:25'),
(8, 'Teras 76', '2021-09-14 16:12:21', '2021-09-14 16:12:21'),
(13, 'Teras 77', '2021-09-14 16:14:40', '2021-09-14 16:14:40'),
(14, 'Teras 78', '2021-09-14 16:14:47', '2021-09-14 16:14:47'),
(15, 'Teras 79', '2021-09-14 16:14:53', '2021-09-14 16:14:53'),
(16, 'Teras 80', '2021-09-14 16:15:05', '2021-09-14 16:15:05'),
(17, 'Teras 81', '2021-09-14 16:15:53', '2021-09-14 16:15:53'),
(18, 'Teras 82', '2021-09-14 16:16:00', '2021-09-14 16:16:00'),
(19, 'Teras 83', '2021-09-14 16:16:04', '2021-09-14 16:16:04'),
(20, 'Teras 84', '2021-09-14 16:16:13', '2021-09-14 16:16:13'),
(21, 'Teras 85', '2021-09-14 16:16:17', '2021-09-14 16:16:17'),
(22, 'Teras 89', '2021-09-14 16:16:26', '2021-09-14 16:16:26'),
(23, 'Teras 90', '2021-09-14 16:16:31', '2021-09-14 16:16:31'),
(24, 'Teras 91', '2021-09-14 16:16:34', '2021-09-14 16:16:34'),
(25, 'Teras 92', '2021-09-14 16:16:39', '2021-09-14 16:16:39'),
(26, 'Teras 93', '2021-09-14 16:16:42', '2021-09-14 16:16:42'),
(27, 'Teras 94', '2021-09-14 16:16:47', '2021-09-14 16:16:47'),
(28, 'Teras 95', '2021-09-14 16:16:51', '2021-09-14 16:16:51'),
(29, 'Teras 96', '2021-09-14 16:16:56', '2021-09-14 16:16:56'),
(30, 'Teras 97', '2021-09-14 16:17:01', '2021-09-14 16:17:01'),
(31, 'Teras 98', '2021-09-14 16:17:04', '2021-09-14 16:18:05'),
(32, 'Teras 99', '2021-09-14 16:17:08', '2021-09-14 16:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@si-mpi.com', '2021-06-20 03:52:03', '$2y$10$KCFXEeMmnrlwcVOhjzyW5.nENpZdgtD0eCra.Y/e5pD4ezFcVu1HK', NULL, '2021-06-20 03:52:03', '2021-06-20 03:52:03'),
(2, 'User', 'user@si-mpi.com', '2021-06-20 03:52:03', '$2y$10$DUG.Gzs8TBDtlmpzcowmC.s3fC3Q4.QNFZH6uj3tj8qUlfxm0K6Hq', NULL, '2021-06-20 03:52:03', '2021-06-20 03:52:03'),
(3, 'tes', 'tes@gmail.com', NULL, '$2y$10$LOR37oK7WDtTZ5AAClHoa.1QzrQ3u4Oy0qtXCFGgjDqnxMzuhav86', NULL, '2021-10-22 04:18:07', '2021-10-22 04:18:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gangguans`
--
ALTER TABLE `gangguans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_gangguans_teras` (`id_teras`),
  ADD KEY `FK_gangguans_komponens` (`kode_komponen`),
  ADD KEY `gangguans_id_perbaikan_foreign` (`id_perbaikan`);

--
-- Indexes for table `komponens`
--
ALTER TABLE `komponens`
  ADD PRIMARY KEY (`kode_komponen`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perbaikans`
--
ALTER TABLE `perbaikans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relasi_komponen`
--
ALTER TABLE `relasi_komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_relasi_komponen_komponens` (`komponen`),
  ADD KEY `FK_relasi_komponen_komponens_2` (`relasi`);

--
-- Indexes for table `scr`
--
ALTER TABLE `scr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_komponen` (`kode_komponen`);

--
-- Indexes for table `teras`
--
ALTER TABLE `teras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gangguans`
--
ALTER TABLE `gangguans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `komponens`
--
ALTER TABLE `komponens`
  MODIFY `kode_komponen` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perbaikans`
--
ALTER TABLE `perbaikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `scr`
--
ALTER TABLE `scr`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `teras`
--
ALTER TABLE `teras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gangguans`
--
ALTER TABLE `gangguans`
  ADD CONSTRAINT `FK_gangguans_komponens` FOREIGN KEY (`kode_komponen`) REFERENCES `komponens` (`kode_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_gangguans_teras` FOREIGN KEY (`id_teras`) REFERENCES `teras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gangguans_id_perbaikan_foreign` FOREIGN KEY (`id_perbaikan`) REFERENCES `perbaikans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relasi_komponen`
--
ALTER TABLE `relasi_komponen`
  ADD CONSTRAINT `FK_relasi_komponen_komponens` FOREIGN KEY (`komponen`) REFERENCES `komponens` (`kode_komponen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_relasi_komponen_komponens_2` FOREIGN KEY (`relasi`) REFERENCES `komponens` (`kode_komponen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scr`
--
ALTER TABLE `scr`
  ADD CONSTRAINT `FK_scr_komponens` FOREIGN KEY (`kode_komponen`) REFERENCES `komponens` (`kode_komponen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
