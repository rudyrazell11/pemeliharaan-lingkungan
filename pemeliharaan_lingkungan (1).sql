-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2023 at 05:12 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemeliharaan_lingkungan`
--

-- --------------------------------------------------------

--
-- Table structure for table `blok`
--

CREATE TABLE `blok` (
  `id_blok` int NOT NULL,
  `nama_blok` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_komplek` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blok`
--

INSERT INTO `blok` (`id_blok`, `nama_blok`, `id_komplek`) VALUES
(1, 'Blok A1', 1),
(3, 'BLOK C1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_iuran`
--

CREATE TABLE `jenis_iuran` (
  `id_jenis_iuran` int NOT NULL,
  `nama_jenis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_iuran`
--

INSERT INTO `jenis_iuran` (`id_jenis_iuran`, `nama_jenis`) VALUES
(1, 'Bulanan'),
(2, 'Keamanan'),
(10, 'Kebersihan');

-- --------------------------------------------------------

--
-- Table structure for table `komplek`
--

CREATE TABLE `komplek` (
  `id_komplek` int NOT NULL,
  `nama_komplek` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplek`
--

INSERT INTO `komplek` (`id_komplek`, `nama_komplek`) VALUES
(1, 'Komplek A'),
(3, 'Komplek C');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode_pembayaran` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pemilik` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode_pembayaran`, `nama`, `nomor`, `pemilik`) VALUES
(1, 'Bank Mandiri', '1788729310', 'Admin'),
(5, 'Bank BCA', '178312341', 'Admin 2');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `kode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_warga` int NOT NULL,
  `id_periode_iuran` int NOT NULL,
  `id_metode_pembayaran` int DEFAULT NULL,
  `nominal` bigint NOT NULL,
  `status` enum('Sudah Bayar','Belum Bayar','Gagal','Proses') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Bayar',
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pembayaran`, `id_warga`, `id_periode_iuran`, `id_metode_pembayaran`, `nominal`, `status`, `tanggal`) VALUES
(35, '1687903014', 16, 2, 1, 25000, 'Proses', '2023-06-28 04:56:54'),
(36, '168790304914', 14, 2, NULL, 25000, 'Belum Bayar', '2023-06-28 04:57:29'),
(37, '168790304915', 15, 2, NULL, 25000, 'Belum Bayar', '2023-06-28 04:57:29'),
(38, '168790304917', 17, 2, NULL, 25000, 'Belum Bayar', '2023-06-28 04:57:29'),
(39, '168790306314', 14, 8, NULL, 200000, 'Belum Bayar', '2023-06-28 04:57:43'),
(40, '168790306315', 15, 8, NULL, 200000, 'Belum Bayar', '2023-06-28 04:57:43'),
(41, '168790306316', 16, 8, 1, 200000, 'Proses', '2023-06-28 04:57:43'),
(42, '168790306317', 17, 8, NULL, 200000, 'Belum Bayar', '2023-06-28 04:57:43'),
(43, '1687903095', 16, 8, 5, 200000, 'Proses', '2023-06-28 04:58:15'),
(44, '1687903571', 16, 8, 1, 200000, 'Sudah Bayar', '2023-06-28 05:06:11'),
(45, '168790373114', 14, 9, NULL, 50000, 'Belum Bayar', '2023-06-28 05:08:51'),
(46, '168790373115', 15, 9, NULL, 50000, 'Belum Bayar', '2023-06-28 05:08:51'),
(47, '168790373116', 16, 9, NULL, 50000, 'Belum Bayar', '2023-06-28 05:08:51'),
(48, '168790373117', 17, 9, NULL, 50000, 'Belum Bayar', '2023-06-28 05:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `periode_iuran`
--

CREATE TABLE `periode_iuran` (
  `id_periode_iuran` int NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `id_jenis_iuran` int NOT NULL,
  `nominal` bigint NOT NULL,
  `is_schedule` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_iuran`
--

INSERT INTO `periode_iuran` (`id_periode_iuran`, `bulan`, `tahun`, `id_jenis_iuran`, `nominal`, `is_schedule`) VALUES
(2, 1, 2025, 2, 25000, 1),
(8, 1, 2023, 1, 200000, 1),
(9, 2, 2023, 1, 50000, 1),
(10, 3, 2023, 1, 60000, 0),
(11, 4, 2023, 1, 5000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('admin','warga') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `level`) VALUES
(1, 'Admin123', 'admin@gmail.com', '$2y$10$lG2SrI1UJkdsmVmPyHGfTOIWwL/1RNxk25.KUc7G7q/39MXI1wt6i', 'admin'),
(28, 'Agus Setiawan', 'agus@gmail.com', '$2y$10$e7ckHPgGx9CET2FeA0mdY./DvyD0.B2TDrGbQmYQeHZTIQybdKfkS', 'warga'),
(29, 'Ducimus autem modi ', 'cycu@mailinator.com', '$2y$10$gylXbb9FLBUnGeZg2U4bI.cSY3y7Mhs.ymr.a9e5FNQGdmvjjJdJa', 'warga'),
(30, 'Deni Muhammad', 'deni@gmail.com', '$2y$10$/Rcnobizmd8EAr4HIcme5Od2n2yCrG6GGm4vvRN0b.QOx9tHcAZx6', 'warga'),
(32, 'asdfasd123', 'asdfasd@asdgasdg', '$2y$10$B2N9BgjxKfzMbXNlaCUhXuM4EVhxKgmYilkYvXDuQnkKCAysNVpVu', 'warga');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_warga` int NOT NULL,
  `nama_warga` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nomor_telepon` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_whatsapp` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_blok` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id_warga`, `nama_warga`, `jenis_kelamin`, `tanggal_lahir`, `nomor_telepon`, `nomor_whatsapp`, `id_blok`, `id_user`) VALUES
(14, 'Agus Setiawan', 'Laki-laki', '2023-06-13', '089123123121', '089123123121', 3, 28),
(15, 'Ducimus autem modi ', 'Perempuan', '2023-06-22', '08991231231', '08991231231', 3, 29),
(16, 'Deni Muhammad', 'Laki-laki', '2023-06-23', '08989123123', '0898123124', 3, 30),
(17, 'asdfasd123', 'Laki-laki', '2023-06-28', '123123', '12412412', 1, 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blok`
--
ALTER TABLE `blok`
  ADD PRIMARY KEY (`id_blok`),
  ADD KEY `id_komplek` (`id_komplek`);

--
-- Indexes for table `jenis_iuran`
--
ALTER TABLE `jenis_iuran`
  ADD PRIMARY KEY (`id_jenis_iuran`);

--
-- Indexes for table `komplek`
--
ALTER TABLE `komplek`
  ADD PRIMARY KEY (`id_komplek`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `kode_pembayaran` (`kode_pembayaran`),
  ADD KEY `id_warga` (`id_warga`),
  ADD KEY `id_periode_iuran` (`id_periode_iuran`),
  ADD KEY `id_metode_pembayaran` (`id_metode_pembayaran`);

--
-- Indexes for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  ADD PRIMARY KEY (`id_periode_iuran`),
  ADD KEY `id_jenis_iuran` (`id_jenis_iuran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_blok` (`id_blok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blok`
--
ALTER TABLE `blok`
  MODIFY `id_blok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_iuran`
--
ALTER TABLE `jenis_iuran`
  MODIFY `id_jenis_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komplek`
--
ALTER TABLE `komplek`
  MODIFY `id_komplek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  MODIFY `id_periode_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id_warga` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blok`
--
ALTER TABLE `blok`
  ADD CONSTRAINT `blok_ibfk_1` FOREIGN KEY (`id_komplek`) REFERENCES `komplek` (`id_komplek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_metode_pembayaran`) REFERENCES `metode_pembayaran` (`id_metode_pembayaran`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_periode_iuran`) REFERENCES `periode_iuran` (`id_periode_iuran`);

--
-- Constraints for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  ADD CONSTRAINT `periode_iuran_ibfk_1` FOREIGN KEY (`id_jenis_iuran`) REFERENCES `jenis_iuran` (`id_jenis_iuran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warga`
--
ALTER TABLE `warga`
  ADD CONSTRAINT `warga_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warga_ibfk_2` FOREIGN KEY (`id_blok`) REFERENCES `blok` (`id_blok`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;