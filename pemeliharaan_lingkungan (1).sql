-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2023 at 05:40 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2a$12$7iBDJoXDKVK18iQOF1x.DOUY9ZMzg/E9laJu/UPQvJin0OeJD0UEu');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_iuran`
--

CREATE TABLE `jenis_iuran` (
  `id_jenis_iuran` int NOT NULL,
  `nama_jenis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nominal` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_iuran`
--

INSERT INTO `jenis_iuran` (`id_jenis_iuran`, `nama_jenis`, `nominal`) VALUES
(1, 'Bulanan Iuran', 20000),
(2, 'Iuran Kemerdekaan', 10000),
(5, 'sdfadsf', 60000),
(8, 'IURAN !', 100000);

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
-- Table structure for table `periode_iuran`
--

CREATE TABLE `periode_iuran` (
  `id_periode_iuran` int NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `id_jenis_iuran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_iuran`
--

INSERT INTO `periode_iuran` (`id_periode_iuran`, `bulan`, `tahun`, `id_jenis_iuran`) VALUES
(1, 1, 2023, 8),
(2, 3, 2025, 2),
(3, 2, 2023, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `jenis_iuran`
--
ALTER TABLE `jenis_iuran`
  ADD PRIMARY KEY (`id_jenis_iuran`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indexes for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  ADD PRIMARY KEY (`id_periode_iuran`),
  ADD KEY `id_jenis_iuran` (`id_jenis_iuran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_iuran`
--
ALTER TABLE `jenis_iuran`
  MODIFY `id_jenis_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  MODIFY `id_periode_iuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `periode_iuran`
--
ALTER TABLE `periode_iuran`
  ADD CONSTRAINT `periode_iuran_ibfk_1` FOREIGN KEY (`id_jenis_iuran`) REFERENCES `jenis_iuran` (`id_jenis_iuran`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
