-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2025 at 10:22 AM
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
  `status` enum('dijadwalkan','selesai','dibatalkan') DEFAULT NULL,
  `notulen` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_rapat`
--

INSERT INTO `tb_rapat` (`id_rapat`, `judul`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `id_admin`, `dibuat_oleh`, `status`, `notulen`) VALUES
(3, 'Rapat Terkait Jurusan IF', 'lokljkjkjjkhkjkjjjkjk', '2025-12-23', '01:50', 'gu 770', 1, NULL, 'selesai', 'rapat jlek'),
(4, 'Rapat MAHASISWA JURUSAN MESIN', 'SOLID SOLID SOLID', '2025-12-08', '21:45', 'RUANG HMM', 1, NULL, 'selesai', 'gd'),
(6, 'Rapat Terkait Jurusan mb', 'Rapat Terkait Jurusan mb', '2025-12-23', '21:52', 'gu 770', 1, NULL, 'selesai', 'Terbaik memang'),
(8, 'Rapat terkait baju PDH IF YANG TIDAK JADI JADI', 'DIDUGA PAKDENYA LAMA KALI KERJA', '2025-12-10', '22:13', 'Poltek BATAMINDO', 1, NULL, 'selesai', 'hahahaha'),
(9, 'Rapat MAHASISWA JURUSAN MESIN', 'MESIN JAYA JAYA JAYA', '2025-12-27', '23:08', 'ZOOM', 1, NULL, 'dijadwalkan', ''),
(10, 'Rapat kegiatan mahasiswa pencinta alam', 'Diharapkan hadir semua nya!', '2025-12-14', '17:00', 'Gedung Utama 701', NULL, NULL, 'dijadwalkan', ''),
(11, 'Rapat kegiatan mahasiswa pencinta takwa', 'hadir ya', '2025-12-12', '00:45', 'gu 777', NULL, NULL, 'dijadwalkan', ''),
(12, 'Wajib Militer Poltek', 'Harus ikut semua mahasiswa', '2025-12-12', '10:10', 'kormil', NULL, NULL, 'dijadwalkan', 'parkah'),
(13, 'Rapat terkait Putra Ganteng', 'kok bisa putra seganteng itu? makanya harus di bincang ini', '2025-12-14', '01:00', 'Tanjung Uma', NULL, NULL, 'dijadwalkan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_undangan`
--

CREATE TABLE `tb_undangan` (
  `id_undangan` int NOT NULL,
  `id_rapat` int DEFAULT NULL,
  `id_peserta` int DEFAULT NULL,
  `status_kehadiran` enum('belum_dikonfirmasi','hadir','tidak_hadir') DEFAULT 'belum_dikonfirmasi',
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_undangan`
--

INSERT INTO `tb_undangan` (`id_undangan`, `id_rapat`, `id_peserta`, `status_kehadiran`, `waktu_konfirmasi`) VALUES
(34, 4, 5, 'hadir', '2025-12-08 22:48:21'),
(35, 4, 9, 'hadir', '2025-12-08 22:48:21'),
(39, 3, 9, 'hadir', '2025-12-09 21:50:44'),
(50, 8, 9, 'hadir', '2025-12-10 23:44:30'),
(51, 8, 5, 'tidak_hadir', '2025-12-10 23:44:30'),
(52, 8, 10, 'hadir', '2025-12-10 23:44:40'),
(55, 9, 10, 'belum_dikonfirmasi', NULL),
(60, 6, 10, 'hadir', '2025-12-10 23:43:07'),
(61, 6, 9, 'belum_dikonfirmasi', NULL),
(65, 10, 5, 'belum_dikonfirmasi', NULL),
(66, 10, 10, 'belum_dikonfirmasi', NULL),
(67, 10, 9, 'belum_dikonfirmasi', NULL),
(68, 11, 10, 'belum_dikonfirmasi', NULL),
(69, 11, 9, 'belum_dikonfirmasi', NULL),
(70, 12, 10, 'belum_dikonfirmasi', NULL),
(73, 13, 9, 'belum_dikonfirmasi', NULL),
(74, 13, 11, 'belum_dikonfirmasi', NULL),
(77, 12, 9, 'belum_dikonfirmasi', NULL),
(78, 12, 11, 'belum_dikonfirmasi', NULL);

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
(1, 'Putra Alamsyah', 'peterparker', 'palamsyah120@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(3, 'PeterParker', '3312511128', 'asasas@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(4, 'PTR', 'ptr', 'asdadsa@gmail.com', 'c03a8569863ec5fcb93609df7f87d0b3', 'admin'),
(5, 'PTR', 'ptrparker', 'asdadsa@gmail.com', '4d9ad2b37053671b594b237bd061b3f2', 'peserta'),
(6, 'Putra Alamsyah', 'ptrparka', 'palamsyah120@gmail.com', '21f1256217c52a6cdaa51f34bf1b4131', 'admin'),
(8, 'ptr', 'goblog', 'ptr@gmail.com', '0a8389b3cda3f89844b70f0528bed50c', 'admin'),
(9, 'Peter P', '3312511127', 'palamsyah120@gmail.com', '32791dfdfd48eea8c6ef24ef683c94b5', 'peserta'),
(10, 'OM Yoda Pratama Putra ', '3312511126', 'palamsyah2006@gmail.com', '149e4b4d2b802e07faea933f168fd877', 'peserta'),
(11, 'Yoda Pratama Putra', '3312511120', 'twittergw30@gmail.com', '310d4975a80a40fe066ef330d2a1254f', 'peserta'),
(12, 'Admin', 'admin', 'admin@polibatam.ac.id', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(13, 'User', 'user', 'user@polibatam.ac.id', 'ee11cbb19052e40b07aac0ca060c23ee', 'peserta');

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
  ADD KEY `id_rapat` (`id_rapat`,`id_peserta`),
  ADD KEY `fk_undangan_peserta` (`id_peserta`);

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
  MODIFY `id_rapat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_undangan`
--
ALTER TABLE `tb_undangan`
  MODIFY `id_undangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `fk_undangan_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_undangan_rapat` FOREIGN KEY (`id_rapat`) REFERENCES `tb_rapat` (`id_rapat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
