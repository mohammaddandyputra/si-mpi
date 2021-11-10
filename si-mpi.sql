-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 09:18 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gangguans`
--
ALTER TABLE `gangguans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_gangguans_teras` (`id_teras`),
  ADD KEY `FK_gangguans_komponens` (`kode_komponen`),
  ADD KEY `gangguans_id_perbaikan_foreign` (`id_perbaikan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gangguans`
--
ALTER TABLE `gangguans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
