-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2023 at 03:16 PM
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
(1, 'BLOK A1', 1),
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
(1, 'Bulanan Iuran'),
(2, 'Iuran Kemerdekaan');

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
(1, 'Cashddf123', 'df123', 'dfdf123'),
(5, 'asdfasdf', '12312', 'asdfasdg'),
(8, 'asdfa', 'sdfasdf', 'asdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `kode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_warga` int NOT NULL,
  `id_periode_iuran` int NOT NULL,
  `id_metode_pembayaran` int NOT NULL,
  `nominal` bigint NOT NULL,
  `status` enum('Sudah Bayar','Belum Bayar','Gagal') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Bayar',
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pembayaran`, `id_warga`, `id_periode_iuran`, `id_metode_pembayaran`, `nominal`, `status`, `tanggal`) VALUES
(2, 'asadfa', 14, 2, 5, 100000, 'Sudah Bayar', '2023-06-23 09:14:53'),
(3, '1687487332', 14, 8, 5, 200000, 'Sudah Bayar', '2023-06-23 09:28:52'),
(5, '1687491470', 15, 2, 1, 25000, 'Sudah Bayar', '2023-06-23 10:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `periode_iuran`
--

CREATE TABLE `periode_iuran` (
  `id_periode_iuran` int NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `id_jenis_iuran` int NOT NULL,
  `nominal` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_iuran`
--

INSERT INTO `periode_iuran` (`id_periode_iuran`, `bulan`, `tahun`, `id_jenis_iuran`, `nominal`) VALUES
(2, 3, 2025, 2, 25000),
(8, 2, 2023, 1, 200000);

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
(1, 'Admin', 'admin@gmail.com', '$2a$12$7iBDJoXDKVK18iQOF1x.DOUY9ZMzg/E9laJu/UPQvJin0OeJD0UEu', 'admin'),
(28, 'Incididunt accusamus', 'warga@gmail.com', '$2y$10$ZAFcdmAhg8LbQaot6CzVtuHyisOMgvkzPC2Atzr/Giu.hm6at.PnK', 'warga'),
(29, 'Ducimus autem modi ', 'cycu@mailinator.com', '$2y$10$uAsJrzop7lr6obKdmFWS9uxIvPwl9dWGubceIIsrfFryD6tr8rObG', 'warga');

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
(14, 'Incididunt accusamus', 'Laki-laki', '2023-06-13', '089123123121', '089123123121', 3, 28),
(15, 'Ducimus autem modi ', 'Perempuan', '2023-06-22', '089123123121', '412312412412', 3, 29);

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
  MODIFY `id_blok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_iuran`
--
ALTER TABLE `jenis_iuran`
  MODIFY `id_jenis_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `komplek`
--
ALTER TABLE `komplek`
  MODIFY `id_komplek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  MODIFY `id_periode_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id_warga` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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