-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2026 at 11:23 AM
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
(3, 'palamsyah120@gmail.com', 'putra alamsyah', 'Gabisa login, username : putra'),
(4, 'palamsyah55@gmail.com', 'peter', 'website tidak berfungsi');

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
  `status` enum('dijadwalkan','selesai','dibatalkan') DEFAULT NULL,
  `notulen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_rapat`
--

INSERT INTO `tb_rapat` (`id_rapat`, `judul`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `status`, `notulen`) VALUES
(11, 'Rapat kegiatan mahasiswa pencinta takwa', 'hadir ya', '2025-12-12', '00:45', 'gu 777', 'selesai', 'nmmnbbn'),
(17, 'Rapat mahasiswa Jurusan Teknik Informatika', 'baju pdh udah jdi', '2026-01-23', '00:43', 'Gedung Utama', 'dijadwalkan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quasi vitae rerum nam! In pariatur qui repudiandae repellendus neque impedit inventore officia soluta porro, distinctio rerum. Veritatis adipisci at ex assumenda soluta ipsum consequuntur minima dignissimos reiciendis neque cumque facilis magni, architecto maiores exercitationem ab explicabo dicta sapiente impedit, aperiam rem vel repellendus, a illo. Quam labore nam dignissimos illum iure sit tenetur sapiente magni similique eligendi quaerat earum in fugit molestiae quasi, esse natus blanditiis libero non unde vitae. Minima quasi totam vero ipsum in architecto debitis dolore dolor facilis. Nisi ex quo fuga totam, error sint quae minus ut labore explicabo architecto, enim provident eos amet magnam, porro dolorem. Ipsum ducimus, amet nesciunt animi et sed eaque quidem molestias expedita eveniet qui eius mollitia ab quibusdam iste, incidunt rerum! Assumenda labore consequatur, rem maiores illo ducimus soluta voluptates adipisci ullam rerum enim voluptas amet molestiae mollitia vel porro! Quod reiciendis vero esse, dolore quam, repudiandae ad facilis, ipsa porro facere illo aliquam. Velit ea laborum optio, dolores nostrum explicabo suscipit nobis earum quod quasi molestias cupiditate minima iusto possimus laboriosam fugiat nesciunt mollitia? Voluptatem ut ipsum alias provident dolor error fugit adipisci deserunt quas similique corrupti veniam mollitia excepturi quidem nisi libero quo vitae, maiores obcaecati ipsa nobis perferendis ea? Quo iure aspernatur maiores dolores dolorem debitis quisquam? Aut vel nesciunt maxime aliquid voluptatem rerum mollitia perspiciatis delectus adipisci illo voluptatum dignissimos eaque error, cumque soluta, sunt fuga beatae autem nihil eveniet perferendis dolorem dicta! Officia, excepturi ullam.'),
(18, 'Rapat mahasiswa Jurusan Teknik Informatika', 'asddsa', '2025-12-29', '00:22', 'Poltek BATAMINDO', 'dijadwalkan', ''),
(19, 'dsaasd', 'asdadsas', '2025-12-29', '00:23', 'adsas', 'dijadwalkan', ''),
(20, 'klanmasnma,', 'laksdaklsjljasd', '2025-12-29', '00:24', 'dasassa', 'dijadwalkan', ''),
(21, 'knmnnm', 'nmnm', '2025-12-29', '00:24', 'Poltek batam center', 'dijadwalkan', ''),
(22, 'nbnmm', 'nnmmn', '2025-12-29', '00:24', ',nnmm', 'selesai', 'sadasdsda'),
(23, 'asdas', 'qasdasd', '2025-12-29', '00:25', 'assa', 'dijadwalkan', ''),
(24, 'asdads', 'asdads', '2025-12-29', '00:25', 'assadsad', 'selesai', 'dasdsadasdsa'),
(25, 'asdads', 'asddas', '2025-12-29', '00:25', 'sadas', 'selesai', 'adsdasdasdsa'),
(27, 'adsads', 'sadasd', '2025-12-29', '00:26', 'adsdas', 'selesai', 'sadasdadsadsdas'),
(28, 'Rapat peter', 'pppoop', '2025-12-29', '17:08', 'Zoom', 'selesai', 'asdads'),
(30, 'Rapat mesin', 'link zoom : asdassadas', '2025-12-30', '02:22', 'Zoom', 'dijadwalkan', NULL),
(31, 'Rapat mesin', 'link zoom : asdassadas', '2025-12-30', '02:22', 'Zoom', 'dijadwalkan', NULL),
(32, 'Rapat Mahasiswa Jurusan Akuntansi Perpajakan Politeknik Negeri Batam', 'Pemaparan Keuangan di Indonesia ', '2026-01-23', '12:00', 'Teams', 'dijadwalkan', ''),
(33, 'Rapat mahasiswa Informatika', 'Rapat terkait masalah dalam teknik informatika', '2026-01-03', '20:55', 'GU 701', 'selesai', 'Hasil dari rapat ini mahasiswa informatika lulus semua');

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
(94, 11, 17, 'belum_dikonfirmasi', NULL),
(95, 17, 17, 'hadir', '2025-12-27 02:41:24'),
(98, 19, 17, 'belum_dikonfirmasi', NULL),
(99, 19, 16, 'belum_dikonfirmasi', NULL),
(102, 28, 16, 'belum_dikonfirmasi', NULL),
(104, 17, 20, 'hadir', '2025-12-29 21:10:40'),
(109, 28, 20, 'belum_dikonfirmasi', NULL),
(110, 28, 17, 'belum_dikonfirmasi', NULL),
(112, 27, 17, 'belum_dikonfirmasi', NULL),
(113, 27, 16, 'belum_dikonfirmasi', NULL),
(114, 27, 20, 'belum_dikonfirmasi', NULL),
(120, 25, 17, 'hadir', '2025-12-30 02:20:38'),
(121, 25, 16, 'hadir', '2025-12-30 02:20:38'),
(122, 25, 20, 'hadir', '2025-12-30 02:20:38'),
(124, 24, 17, 'belum_dikonfirmasi', NULL),
(125, 24, 16, 'belum_dikonfirmasi', NULL),
(126, 24, 20, 'belum_dikonfirmasi', NULL),
(128, 22, 17, 'belum_dikonfirmasi', NULL),
(129, 22, 16, 'belum_dikonfirmasi', NULL),
(130, 22, 20, 'belum_dikonfirmasi', NULL),
(132, 23, 17, 'belum_dikonfirmasi', NULL),
(133, 23, 16, 'belum_dikonfirmasi', NULL),
(134, 23, 20, 'belum_dikonfirmasi', NULL),
(136, 21, 17, 'belum_dikonfirmasi', NULL),
(137, 21, 16, 'belum_dikonfirmasi', NULL),
(138, 21, 20, 'belum_dikonfirmasi', NULL),
(140, 20, 17, 'belum_dikonfirmasi', NULL),
(141, 20, 16, 'belum_dikonfirmasi', NULL),
(142, 20, 20, 'belum_dikonfirmasi', NULL),
(144, 18, 17, 'belum_dikonfirmasi', NULL),
(145, 18, 16, 'belum_dikonfirmasi', NULL),
(146, 18, 20, 'belum_dikonfirmasi', NULL),
(148, 30, 17, 'belum_dikonfirmasi', NULL),
(150, 31, 17, 'belum_dikonfirmasi', NULL),
(152, 17, 16, 'belum_dikonfirmasi', NULL),
(154, 32, 17, 'belum_dikonfirmasi', NULL),
(155, 32, 16, 'belum_dikonfirmasi', NULL),
(156, 32, 20, 'belum_dikonfirmasi', NULL),
(157, 32, 21, 'belum_dikonfirmasi', NULL),
(158, 17, 22, 'belum_dikonfirmasi', NULL),
(159, 32, 22, 'belum_dikonfirmasi', NULL),
(160, 33, 24, 'tidak_hadir', '2026-01-02 20:59:18'),
(161, 33, 25, 'hadir', '2026-01-02 20:59:32'),
(162, 33, 21, 'tidak_hadir', '2026-01-02 20:59:18'),
(163, 33, 17, 'tidak_hadir', '2026-01-02 20:59:18'),
(164, 33, 16, 'tidak_hadir', '2026-01-02 20:59:18'),
(165, 33, 22, 'hadir', '2026-01-02 20:59:18'),
(166, 33, 20, 'hadir', '2026-01-02 20:59:18');

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
  `role` enum('admin','peserta') DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `role`, `foto`) VALUES
(16, 'Rafly', '`peter', 'almirzadagg@gmail.com', '0cfeca41e1bf14cfae765b2edd2786b0', 'peserta', ''),
(17, 'Putra', 'peter', 'palamsyah120@gmail.com', '202cb962ac59075b964b07152d234b70', 'peserta', ''),
(18, 'putra alamsyah', 'putra', 'palamsyah120@gmail.com', '5e0c5a0bf82decdd43b2150b622c66c5', 'admin', '1767015422_sabu sabu.jpg'),
(20, 'userpage', 'userpage', 'user@polibatam.ac.id', 'f6daa6c82718735d10278d78f0ac42e5', 'peserta', ''),
(21, 'dapa', 'dapa', 'dapa@gmail.com', 'e20cb096d34ad69351eec6715f0abf5f', 'peserta', 'user_21_1767192657.png'),
(22, 'Rapli', 'raplii', 'rafflimuhammad32@gmail.com', '202cb962ac59075b964b07152d234b70', 'peserta', 'user_22_1767267572.jpg'),
(23, 'Putra Alamsyah', 'admin', 'admin@pengelolaanrapat.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', ''),
(24, 'Yoda Pratama Putra', 'user', 'palamsyah120@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'peserta', ''),
(25, 'Yoda Pratama Putra', 'yoda', 'palamsyah120@gmail.com', '8280de3ef89855b206c1d74510deb424', 'peserta', '');

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
  ADD PRIMARY KEY (`id_rapat`);

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
  MODIFY `id_contact` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rapat`
--
ALTER TABLE `tb_rapat`
  MODIFY `id_rapat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_undangan`
--
ALTER TABLE `tb_undangan`
  MODIFY `id_undangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

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
