-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 12:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pesanan` varchar(100) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tgl` varchar(50) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `uuid` varchar(225) NOT NULL,
  `id_konsumen` varchar(225) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `alamat_penerima` varchar(225) NOT NULL,
  `hp_penerima` varchar(50) NOT NULL,
  `kg` varchar(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `tgl_pemesanan` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `tgl_bayar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`uuid`, `id_konsumen`, `nama_penerima`, `alamat_penerima`, `hp_penerima`, `kg`, `total`, `tgl_pemesanan`, `status`, `gambar`, `tgl_bayar`) VALUES
('61ed93ab9d11b7.81619895', '61ed939a4b4bf8.23131617', 'zzjd', 'zhsiisk', '4646', '10', '200000', '24-Jan-2022', 'Dikirim', '10e74d33ba84a2b4.jpg', '24-Jan-2022'),
('61eebf1a0f2520.50277317', '61ed8fee2ff2d1.54766020', 'saya', 'pku', '09823740', '50', '1000000', '24-Jan-2022', 'Sampai', NULL, NULL),
('61f15a121dfda8.70035170', '61ed8fee2ff2d1.54766020', 'inda lirta', 'pekanbaru', '081277967050', '58', '1160000', '26-Jan-2022', 'Sampai', NULL, NULL),
('61f51d1e5f20e5.86199000', '61ed8fee2ff2d1.54766020', 'lirta', 'paus', '12345689', '50', '300000', '29-Jan-2022', 'order', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`) VALUES
(1, 'pakan ikan organik', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uuid` varchar(225) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hp` varchar(30) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `rules` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uuid`, `nama`, `hp`, `alamat`, `email`, `gambar`, `password`, `rules`) VALUES
('61e2248f3ffed4.07894909', 'Rudi Susanto', '0987865432', 'paus', 'rudisusanto@gmail.com', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '2'),
('61ebdf71689d00.88608775', 'admin', '1234567890', 'oekanbaru', 'admin@gmail.com', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '3'),
('61ed8fee2ff2d1.54766020', 'lirta', '12345689', 'paus', 'indalirta@gmail.com', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '1'),
('61ed939a4b4bf8.23131617', 'ojan', '9284883992', 'jdkcm', 'alpauzan.12@gmail.com', 'defult.jpg', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', '1'),
('61ee6639d243f1.62162993', 'admin 2', '1234567890', 'pekanbaru', 'admin2@gmail.com', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '3'),
('61eeb62f587674.69110086', 'inda lirta', '08800297', 'paus', 'indalirtal@gmail.com', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '1'),
('61f509ab1ef785.05272226', 'inda', '123456', 'paus', 'asd@df', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '1'),
('61f50b5155fe82.58655588', 'dddddd', '22222222', 'gggggg', 'gggg@ffff', 'defult.jpg', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', '1'),
('61f50cdc2c9862.17539879', 'ghhjj', '455667', 'gggg@fgggggh', 'ddddd@dddddd', 'defult.jpg', 'sbN3OgXA7QF2eHpPFXT/AHX3Uh4=', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
