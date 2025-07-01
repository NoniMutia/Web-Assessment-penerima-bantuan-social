-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 10:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_survei`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_22_020349_create_tm_machines_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7oDxvRg6kLbbnOtk1MFeHApM1pdubNlWayTtIVLH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbmlsYWlhbi9leHBvcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoid2Zsc3RmZWZRTmxrSlNPYnRWbURxdUtxTFFTUUdWNFFLZGtHTVdNeCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1751353380);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepemilikan_kendaraan`
--

CREATE TABLE `tb_kepemilikan_kendaraan` (
  `nik` varchar(20) NOT NULL,
  `jenis_kendaran` enum('motor','mobil','tidak ada') DEFAULT NULL,
  `kendaraan_lain` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jenis_kendaraan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kepemilikan_kendaraan`
--

INSERT INTO `tb_kepemilikan_kendaraan` (`nik`, `jenis_kendaran`, `kendaraan_lain`, `jumlah`, `jenis_kendaraan`) VALUES
('33021302920002', NULL, NULL, 0, 'Tidak Ada'),
('330219230002', NULL, NULL, 1, 'Motor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepemilikan_rumah`
--

CREATE TABLE `tb_kepemilikan_rumah` (
  `nik` varchar(20) NOT NULL,
  `status_rumah` enum('Milik Sendiri','Sewa','Menumpang') DEFAULT NULL,
  `status_tanah` enum('Milik','Tidak Milik') DEFAULT NULL,
  `luas_tanah` int(11) DEFAULT NULL,
  `luas_bangunan` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kepemilikan_rumah`
--

INSERT INTO `tb_kepemilikan_rumah` (`nik`, `status_rumah`, `status_tanah`, `luas_tanah`, `luas_bangunan`, `updated_at`, `created_at`) VALUES
('33021302920002', 'Menumpang', 'Tidak Milik', 10, 8, '2025-06-30 22:45:57', '2025-06-30 22:45:57'),
('330219230002', 'Sewa', 'Tidak Milik', 10, 8, '2025-06-30 22:55:25', '2025-06-30 22:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan_penghasilan`
--

CREATE TABLE `tb_pekerjaan_penghasilan` (
  `nik` varchar(20) NOT NULL,
  `jenis_pekerjaan` varchar(100) DEFAULT NULL,
  `tempat_pekerjaan` varchar(100) DEFAULT NULL,
  `lama_bekerja` int(11) DEFAULT NULL,
  `jumlah_penghasilan` decimal(12,2) DEFAULT NULL,
  `sumber_penghasilan` varchar(100) DEFAULT NULL,
  `status_pekerjaan` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pekerjaan_penghasilan`
--

INSERT INTO `tb_pekerjaan_penghasilan` (`nik`, `jenis_pekerjaan`, `tempat_pekerjaan`, `lama_bekerja`, `jumlah_penghasilan`, `sumber_penghasilan`, `status_pekerjaan`, `updated_at`, `created_at`) VALUES
('330219230002', 'petani', 'padimas', 1, 700000.00, 'gaji', 'tetap', '2025-06-30 22:54:43', '2025-06-30 22:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerima_bantuan`
--

CREATE TABLE `tb_penerima_bantuan` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `tanggal_survei` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penerima_bantuan`
--

INSERT INTO `tb_penerima_bantuan` (`nik`, `nama`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `tanggal_survei`, `created_at`, `updated_at`) VALUES
('33021302920002', 'mamas', 'jakarta', '1977-03-01', 'Laki-laki', '089765432123', NULL, '2025-07-01 05:44:21', '2025-07-01 05:44:21'),
('330219230002', 'caca', 'purwokerto', '2000-07-01', 'Perempuan', '089765432123', NULL, '2025-07-01 05:52:36', '2025-07-01 05:52:53'),
('33029872092002', 'noni', 'purwokerto', '2002-10-30', 'Perempuan', '089765432567', NULL, '2025-06-30 12:42:33', '2025-06-30 12:42:33'),
('3302987560090', 'andi', 'pbg', '2015-02-01', 'Laki-laki', '089765432123', NULL, '2025-07-01 04:57:07', '2025-07-01 04:57:23'),
('33029876543002', 'ane', 'purwokerto', '2012-07-01', 'Perempuan', '089765432456', NULL, '2025-07-01 04:23:52', '2025-07-01 04:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `nik` varchar(20) NOT NULL,
  `skor_penghasilan` int(11) NOT NULL,
  `skor_tanggungan` int(11) NOT NULL,
  `skor_rumah` int(11) NOT NULL,
  `tanggal_penilaian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayat_bantuan`
--

CREATE TABLE `tb_riwayat_bantuan` (
  `nik` varchar(20) NOT NULL,
  `jenis_bantuan` varchar(50) DEFAULT NULL,
  `tahun_bantuan` year(4) DEFAULT NULL,
  `sumber_bantuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_riwayat_bantuan`
--

INSERT INTO `tb_riwayat_bantuan` (`nik`, `jenis_bantuan`, `tahun_bantuan`, `sumber_bantuan`) VALUES
('33021302920002', 'pkh', '2010', 'pemerintah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggungan_anak`
--

CREATE TABLE `tb_tanggungan_anak` (
  `nik` varchar(20) NOT NULL,
  `jumlah_anak` int(11) NOT NULL DEFAULT 0,
  `jumlah_lansia` int(11) NOT NULL DEFAULT 0,
  `usia_anak` int(11) DEFAULT NULL,
  `status_pendidikan_anak` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tanggungan_anak`
--

INSERT INTO `tb_tanggungan_anak` (`nik`, `jumlah_anak`, `jumlah_lansia`, `usia_anak`, `status_pendidikan_anak`, `updated_at`, `created_at`) VALUES
('33021302920002', 2, 1, 12, 'SMP', '2025-06-30 22:56:35', '2025-06-30 22:46:12'),
('330219230002', 2, 0, 23, 'Kuliah', '2025-06-30 22:55:58', '2025-06-30 22:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'nonimutia03@gmail.com', NULL, '$2y$12$UZ95cVXYmIb4DHsIzUtnAu4XzWa5NpYwAAS3oqGBgBPe8osEP5zbS', NULL, '2025-06-27 03:30:56', '2025-06-27 03:30:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_kepemilikan_kendaraan`
--
ALTER TABLE `tb_kepemilikan_kendaraan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_kepemilikan_rumah`
--
ALTER TABLE `tb_kepemilikan_rumah`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_pekerjaan_penghasilan`
--
ALTER TABLE `tb_pekerjaan_penghasilan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_penerima_bantuan`
--
ALTER TABLE `tb_penerima_bantuan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_riwayat_bantuan`
--
ALTER TABLE `tb_riwayat_bantuan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_tanggungan_anak`
--
ALTER TABLE `tb_tanggungan_anak`
  ADD PRIMARY KEY (`nik`);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kepemilikan_kendaraan`
--
ALTER TABLE `tb_kepemilikan_kendaraan`
  ADD CONSTRAINT `tb_kepemilikan_kendaraan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);

--
-- Constraints for table `tb_kepemilikan_rumah`
--
ALTER TABLE `tb_kepemilikan_rumah`
  ADD CONSTRAINT `tb_kepemilikan_rumah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);

--
-- Constraints for table `tb_pekerjaan_penghasilan`
--
ALTER TABLE `tb_pekerjaan_penghasilan`
  ADD CONSTRAINT `tb_pekerjaan_penghasilan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);

--
-- Constraints for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD CONSTRAINT `tb_penilaian_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);

--
-- Constraints for table `tb_riwayat_bantuan`
--
ALTER TABLE `tb_riwayat_bantuan`
  ADD CONSTRAINT `tb_riwayat_bantuan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);

--
-- Constraints for table `tb_tanggungan_anak`
--
ALTER TABLE `tb_tanggungan_anak`
  ADD CONSTRAINT `tb_tanggungan_anak_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_penerima_bantuan` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
