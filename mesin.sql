-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2021 at 09:35 AM
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
  `penerima` varchar(255) NOT NULL,
  `jml_keluar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log_keluar`
--

INSERT INTO `tb_log_keluar` (`id`, `id_mesin`, `penerima`, `jml_keluar`, `keterangan`, `created_at`) VALUES
(1, 6, 'xxxxx', '2', 'xxxx', '2021/06/22'),
(2, 6, 'Nex Colony2', '2', '2nd out', '2021/06/22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_masuk`
--

CREATE TABLE `tb_log_masuk` (
  `id` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `jml_masuk` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log_masuk`
--

INSERT INTO `tb_log_masuk` (`id`, `id_mesin`, `jml_masuk`, `keterangan`, `created_at`) VALUES
(1, 1, '120', 'Untuk Persiapan Panen padi', '22/06/2021'),
(2, 1, '2', 'Restock ulang', '22/06/2021'),
(3, 2, '130', 'Persiapan UNBK', '22/06/2021'),
(4, 5, '99', 'Yes bgt deh', '2021/06/22'),
(5, 5, '100', 'Restok untuk mesin hyundai', '2021/06/22'),
(6, 5, '11', '', '2021/06/22'),
(7, 5, '11', 'Restok lagii hehe', '2021/06/22'),
(8, 5, '1', 'Restok dari stok mesin', '2021/06/22'),
(9, 6, '100', 'Persiapan Genset 2021', '2021/06/22'),
(10, 6, '1', 'tambah 1 aja lagi', '2021/06/22'),
(11, 6, '', '1', '2021/06/22'),
(12, 6, '1', 'cobain 1 dulu', '2021/06/22'),
(13, 6, '1', 'xxx', '2021/06/22'),
(14, 6, '1', 'dari stok mesin', '2021/06/22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_mesin`
--

CREATE TABLE `tb_stok_mesin` (
  `id` int(11) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `merk_mesin` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `deleted_at` varchar(225) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok_mesin`
--

INSERT INTO `tb_stok_mesin` (`id`, `nama_mesin`, `merk_mesin`, `stok`, `harga`, `deskripsi`, `created_at`, `deleted_at`) VALUES
(1, 'Honda MRE320s', 'Hondas', '199', '150000001', '', '', '2021/06/22'),
(2, 'Yamaha GH2MR', 'Yamaha', '199', '12000000', 'Mesin Genset', '', '0'),
(5, 'Hyundai', 'H123', '222', '40000123', 'Oke', '', '0'),
(6, 'Isuzu 2JZsss', 'Isuzusss', '102', '175000000111', '123ss', '2021/06/22', '0');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_log_masuk`
--
ALTER TABLE `tb_log_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_stok_mesin`
--
ALTER TABLE `tb_stok_mesin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
