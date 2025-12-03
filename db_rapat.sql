-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 12:38 PM
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
-- Database: `db_rapat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact`
--

CREATE TABLE `tb_contact` (
  `id_contact` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keluhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_contact`
--

INSERT INTO `tb_contact` (`id_contact`, `email`, `nama`, `keluhan`) VALUES
(1, 'palamsyah55@gmail.com', 'Putra Alamsyah', 'Website tidak menarik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rapat`
--

CREATE TABLE `tb_rapat` (
  `id_rapat` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  `status` enum('dijadwalkan','selesai','dibatalkan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_rapat`
--

INSERT INTO `tb_rapat` (`id_rapat`, `judul`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `id_admin`, `dibuat_oleh`, `status`) VALUES
(1, 'Rapat seluruh mahasiswa', 'Rapat ini diagendakan untuk seluruh mahasiswa', '2025-10-20', '19.00 WIB', 'Poltek', 1, NULL, 'dijadwalkan'),
(2, 'Rapat mahasiswa Jurusan Teknik Informatika', 'Rapat penting', '2025-10-19', '21.00 WIB', 'Batamindo', 1, NULL, 'dijadwalkan'),
(3, 'Rapat mahasiswa Prodi Rpl', 'RPL HAHA', '2025-10-20', '22.00 WIB', 'Kafe', 1, NULL, 'dijadwalkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_undangan`
--

CREATE TABLE `tb_undangan` (
  `id_undangan` int NOT NULL,
  `id_rapat` int NOT NULL,
  `id_peserta` int DEFAULT NULL,
  `status_kehadiran` enum('belum_dikonfirmasi','hadir','tidak_hadir') DEFAULT 'belum_dikonfirmasi',
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_undangan`
--

INSERT INTO `tb_undangan` (`id_undangan`, `id_rapat`, `id_peserta`, `status_kehadiran`, `waktu_konfirmasi`) VALUES
(50, 1, 6, 'belum_dikonfirmasi', NULL),
(51, 1, 7, 'belum_dikonfirmasi', NULL),
(52, 1, 5, 'belum_dikonfirmasi', NULL),
(53, 1, 8, 'belum_dikonfirmasi', NULL),
(54, 1, 5, 'belum_dikonfirmasi', NULL),
(55, 1, 8, 'belum_dikonfirmasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','peserta') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `role`) VALUES
(1, 'Putra', 'ptr', 'palamsyah120@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(2, 'Zikri', 'zikri', 'zikri@gmail.com', 'zikri123', 'peserta'),
(3, 'Parker', 'putra', 'asasas@gmail.com', '202cb962ac59075b964b07152d234b70', 'peserta'),
(4, 'PTR', 'ptr', 'asdadsa@gmail.com', 'c03a8569863ec5fcb93609df7f87d0b3', 'admin'),
(5, 'PTR', 'ptrparker', 'asdadsa@gmail.com', '4d9ad2b37053671b594b237bd061b3f2', 'peserta'),
(6, 'Putra Alamsyah', 'ptrparka', 'palamsyah120@gmail.com', '21f1256217c52a6cdaa51f34bf1b4131', 'admin'),
(7, 'Putra Alamsyah', 'ptrptr06', 'palamsyah120@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(8, 'ptr', 'goblog', 'ptr@gmail.com', '0a8389b3cda3f89844b70f0528bed50c', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_contact`
--
ALTER TABLE `tb_contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `tb_rapat`
--
ALTER TABLE `tb_rapat`
  ADD PRIMARY KEY (`id_rapat`),
  ADD KEY `id_pembuat` (`id_admin`);

--
-- Indexes for table `tb_undangan`
--
ALTER TABLE `tb_undangan`
  ADD PRIMARY KEY (`id_undangan`),
  ADD KEY `id_rapat` (`id_rapat`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_contact`
--
ALTER TABLE `tb_contact`
  MODIFY `id_contact` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rapat`
--
ALTER TABLE `tb_rapat`
  MODIFY `id_rapat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_undangan`
--
ALTER TABLE `tb_undangan`
  MODIFY `id_undangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rapat`
--
ALTER TABLE `tb_rapat`
  ADD CONSTRAINT `tb_rapat_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_undangan`
--
ALTER TABLE `tb_undangan`
  ADD CONSTRAINT `tb_undangan_ibfk_1` FOREIGN KEY (`id_rapat`) REFERENCES `tb_rapat` (`id_rapat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_undangan_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
