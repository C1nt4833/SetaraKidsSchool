-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2025 at 10:52 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setara`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `absensi_id` int NOT NULL,
  `anak_id` int NOT NULL,
  `terapis_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','sakit','alpa') NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`absensi_id`, `anak_id`, `terapis_id`, `tanggal`, `status`, `catatan`) VALUES
(1, 1, 1, '2025-09-01', 'hadir', 'Pertemuan pertama'),
(2, 1, 1, '2025-09-03', 'izin', 'Sakit flu'),
(3, 2, 2, '2025-09-02', 'hadir', 'Fokus cukup baik');

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `anak_id` int NOT NULL,
  `orangtua_id` int NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `paket_id` int DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`anak_id`, `orangtua_id`, `nama_anak`, `tanggal_lahir`, `jenis_kelamin`, `paket_id`, `keterangan`) VALUES
(1, 3, 'Ayu', '2018-05-10', NULL, NULL, 'Perlu terapi wicara'),
(2, 4, 'Bima', '2017-11-22', NULL, NULL, 'Terapi okupasi');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_terapi`
--

CREATE TABLE `catatan_terapi` (
  `id` int NOT NULL,
  `anak_id` int NOT NULL,
  `pertemuan_ke` int NOT NULL,
  `tanggal` date NOT NULL,
  `isi_catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `jadwal_id` int NOT NULL,
  `anak_id` int NOT NULL,
  `terapis_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `sesi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `anak_id`, `terapis_id`, `tanggal`, `jam`, `sesi`) VALUES
(1, 1, 1, '2025-09-05', '09:00:00', 'Sesi 1'),
(2, 1, 1, '2025-09-07', '10:00:00', 'Sesi 2'),
(3, 2, 2, '2025-09-06', '13:00:00', 'Sesi 1');

-- --------------------------------------------------------

--
-- Table structure for table `paket_belajar`
--

CREATE TABLE `paket_belajar` (
  `paket_id` int NOT NULL,
  `anak_id` int NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `jumlah_pertemuan` int DEFAULT '20',
  `max_reschedule` int DEFAULT '4',
  `bulan` varchar(20) DEFAULT NULL,
  `tahun` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_belajar`
--

INSERT INTO `paket_belajar` (`paket_id`, `anak_id`, `nama_paket`, `jumlah_pertemuan`, `max_reschedule`, `bulan`, `tahun`) VALUES
(1, 1, '', 20, 4, 'September', 2025);

-- --------------------------------------------------------

--
-- Table structure for table `parent_therapist`
--

CREATE TABLE `parent_therapist` (
  `id` int NOT NULL,
  `orangtua_id` int NOT NULL,
  `terapis_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_therapist`
--

INSERT INTO `parent_therapist` (`id`, `orangtua_id`, `terapis_id`, `created_at`) VALUES
(1, 3, 1, '2025-12-21 09:41:18'),
(2, 4, 2, '2025-12-21 09:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoni_id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rating` tinyint NOT NULL,
  `caption` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` int DEFAULT NULL
) ;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`testimoni_id`, `nama`, `rating`, `caption`, `status`, `ip_address`, `user_agent`, `created_at`, `approved_at`, `approved_by`) VALUES
(1, 'Have Tomven', 5, 'Sangat membantu perkembangan motorik anak saya. Terapisnya profesional dan sabar dalam menangani anak.', 'approved', NULL, NULL, '2025-12-21 09:41:19', '2025-12-21 09:41:19', NULL),
(2, 'Arna Wati', 5, 'Terapisnya handal dan komunikatif, kebersihan terjaga, adminnya ramah.', 'approved', NULL, NULL, '2025-12-21 09:41:19', '2025-12-21 09:41:19', NULL),
(3, 'Wahyu Titis Kholifah', 5, 'Pelayanannya memuaskan, terapis profesional. Recommended!', 'approved', NULL, NULL, '2025-12-21 09:41:19', '2025-12-21 09:41:19', NULL),
(4, 'Ibu Sarah', 4, 'Fasilitas lengkap dan terapis berpengalaman. Anak saya menunjukkan kemajuan yang signifikan.', 'approved', NULL, NULL, '2025-12-21 09:41:19', '2025-12-21 09:41:19', NULL),
(5, 'Pak Andi', 5, 'Layanan terbaik di Kendari untuk terapi anak. Sangat recommended untuk orangtua yang mencari solusi untuk anak berkebutuhan khusus.', 'approved', NULL, NULL, '2025-12-21 09:41:19', '2025-12-21 09:41:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('terapis','orangtua') NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `nama_lengkap`, `alamat`, `no_telp`, `reset_token`, `reset_token_expires`, `created_at`) VALUES
(1, 'T001', 'Oke2222', 'rezkialya0909@gmail.com', 'terapis', 'Budi Terapis', NULL, NULL, NULL, NULL, '2025-12-21 09:41:18'),
(2, 'T002', 'Oke3333', 'terapis2@labirin.com', 'terapis', 'Sinta Terapis', NULL, NULL, NULL, NULL, '2025-12-21 09:41:18'),
(3, 'O001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'orangtua1@labirin.com', 'orangtua', 'Ibu Sari', NULL, NULL, NULL, NULL, '2025-12-21 09:41:18'),
(4, 'O002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'orangtua2@labirin.com', 'orangtua', 'Pak Andi', NULL, NULL, NULL, NULL, '2025-12-21 09:41:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absensi_id`),
  ADD KEY `anak_id` (`anak_id`),
  ADD KEY `terapis_id` (`terapis_id`);

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`anak_id`),
  ADD KEY `orangtua_id` (`orangtua_id`),
  ADD KEY `fk_paket_id` (`paket_id`);

--
-- Indexes for table `catatan_terapi`
--
ALTER TABLE `catatan_terapi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anak_id` (`anak_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `anak_id` (`anak_id`),
  ADD KEY `terapis_id` (`terapis_id`);

--
-- Indexes for table `paket_belajar`
--
ALTER TABLE `paket_belajar`
  ADD PRIMARY KEY (`paket_id`),
  ADD KEY `anak_id` (`anak_id`);

--
-- Indexes for table `parent_therapist`
--
ALTER TABLE `parent_therapist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_parent_therapist` (`orangtua_id`,`terapis_id`),
  ADD KEY `terapis_id` (`terapis_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoni_id`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absensi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `anak_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catatan_terapi`
--
ALTER TABLE `catatan_terapi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paket_belajar`
--
ALTER TABLE `paket_belajar`
  MODIFY `paket_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parent_therapist`
--
ALTER TABLE `parent_therapist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoni_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`anak_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`terapis_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `anak`
--
ALTER TABLE `anak`
  ADD CONSTRAINT `anak_ibfk_1` FOREIGN KEY (`orangtua_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_paket_id` FOREIGN KEY (`paket_id`) REFERENCES `paket_belajar` (`paket_id`) ON DELETE SET NULL;

--
-- Constraints for table `catatan_terapi`
--
ALTER TABLE `catatan_terapi`
  ADD CONSTRAINT `catatan_terapi_ibfk_1` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`anak_id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`anak_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`terapis_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `paket_belajar`
--
ALTER TABLE `paket_belajar`
  ADD CONSTRAINT `paket_belajar_ibfk_1` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`anak_id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_therapist`
--
ALTER TABLE `parent_therapist`
  ADD CONSTRAINT `parent_therapist_ibfk_1` FOREIGN KEY (`orangtua_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_therapist_ibfk_2` FOREIGN KEY (`terapis_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
