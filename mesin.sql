-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2021 at 05:20 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mesin`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idmesin` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmesin` int(11) NOT NULL,
  `namamesin` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idmesin` int(11) NOT NULL,
  `namamesin` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_keluar`
--

CREATE TABLE `tb_log_keluar` (
  `id` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `mekanik` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log_keluar`
--

INSERT INTO `tb_log_keluar` (`id`, `id_mesin`, `mekanik`, `keterangan`, `created_at`) VALUES
(1, 9, 'Anas edited ', 'untuk pengembalian line 1 edited', '2021/07/18'),
(2, 10, 'Arif edited', 'mau dipakai di line 1 edited 1', '2021/07/18'),
(3, 11, 'Om Ian Febrian', 'Mau digunakan untuk acara dncc show hehe', '2021/07/18'),
(4, 12, 'Tante Lia-lia', 'buat dipakai itu bth nya hehe', '2021/07/18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_masuk`
--

CREATE TABLE `tb_log_masuk` (
  `id` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `mekanik` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log_masuk`
--

INSERT INTO `tb_log_masuk` (`id`, `id_mesin`, `mekanik`, `keterangan`, `created_at`) VALUES
(1, 8, 'yayas', 'testing input', '2021/07/18'),
(2, 9, 'Anas lagi', 'dibalikin lagi sama anas', '2021/07/18'),
(3, 10, 'Om Johan hehe', 'dibalikin dari line 1 untuk disimpan lagi oke', '2021/07/18'),
(4, 12, 'Tante Lia - ian', 'sudah dikembalikan ya', '2021/07/18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_mesin`
--

CREATE TABLE `tb_stok_mesin` (
  `id` int(11) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `no_id_mesin` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `stock_status` varchar(10) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `deleted_at` varchar(225) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok_mesin`
--

INSERT INTO `tb_stok_mesin` (`id`, `nama_mesin`, `no_id_mesin`, `status`, `stock_status`, `created_at`, `deleted_at`) VALUES
(8, 'sn', 'sn111', 'sewa', '0', '2021/07/18', '2021/07/18'),
(9, 'obras', 'OB1', 'aset', 'keluar', '2021/07/18', '0'),
(10, 'kansai', 'OVRD1kns1', 'sewa', 'stock', '2021/07/18', '0'),
(11, 'dn', 'DNCC1', 'aset', 'keluar', '2021/07/18', '0'),
(12, 'bth', 'BTHBTH111', 'aset', 'stock', '2021/07/18', '2021/07/18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '22/06/2021'),
(2, 'user', 'useruser', '23/06/2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idmesin`);

--
-- Indexes for table `tb_log_keluar`
--
ALTER TABLE `tb_log_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mesin` (`id_mesin`);

--
-- Indexes for table `tb_log_masuk`
--
ALTER TABLE `tb_log_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mesin` (`id_mesin`);

--
-- Indexes for table `tb_stok_mesin`
--
ALTER TABLE `tb_stok_mesin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idmesin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_log_keluar`
--
ALTER TABLE `tb_log_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_log_masuk`
--
ALTER TABLE `tb_log_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_stok_mesin`
--
ALTER TABLE `tb_stok_mesin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_log_keluar`
--
ALTER TABLE `tb_log_keluar`
  ADD CONSTRAINT `tb_log_keluar_ibfk_1` FOREIGN KEY (`id_mesin`) REFERENCES `tb_stok_mesin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_log_masuk`
--
ALTER TABLE `tb_log_masuk`
  ADD CONSTRAINT `tb_log_masuk_ibfk_1` FOREIGN KEY (`id_mesin`) REFERENCES `tb_stok_mesin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
