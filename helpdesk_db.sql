-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2020 at 01:41 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk_db`
--


-- --------------------------------------------------------

--
-- Table structure for table `mst_member`
--

CREATE TABLE `mst_member` (
  `id_member` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `no_telp` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_member`
--

INSERT INTO `mst_member` (`id_member`, `sess_id`, `no_telp`, `alamat`) VALUES
(1, 21, '08995625604', 'Panjang RT/RW : 01/01'),
(2, 26, '081122334455', 'Barongan rt/rw/05/02'),
(3, 27, '098765212335', 'Panjang RT/RW : 01/01'),
(4, 28, '098765212335', 'Kojan rt 02 rw 01');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(150) NOT NULL,
	`no_telp` text NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `date_created` date NOT NULL,
  `image` varchar(250) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `nama`, `email`, `username`,`no_telp`, `password`, `level`, `date_created`, `image`, `is_active`) VALUES
(9, 'Donny Kurniawan', 'donny12@gmail.com', 'admin','082212481723', '$2y$10$X/CJ0lA8IxifIulrHolXH.l.vHQLr5Lw08RgWZEwbcmUVgXeYh58O', 'Admin', '2019-08-06', 'avatar04.png', 1),
(21, 'Ratna Damayanti', 'ratna22@gmail.com', 'user', '082212481724', '$2y$10$mqXKJp5DnPw1v1hN05ja4OQXXFbZu7orAxIH/mCuuiRHJPIj9p5be', 'User', '2019-10-21', 'avatar3.png', 1),
(29, 'Vincent Nugroho', 'vincent2@gmail.com', 'ata', '082212481725', '$2y$10$afzURR4XoI2JGia63raKMuJd4OgdyKRFE9pDYsUPYpo5VHhAjlmX2', 'User', '2020-01-19', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_komplain`
--

CREATE TABLE `tb_komplain` (
  `id_komplain` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `sess_proses` text NOT NULL,
  `area_keluhan` text NOT NULL,
	`jabatan` text NOT NULL,
  -- `client` text NOT NULL,
  -- `saran` text NOT NULL,
  `date_komplain` date NOT NULL,
  `jam_komplain` time NOT NULL,
  `image_komplain` varchar(250) NOT NULL,
  `tanggapan` text NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `jam_tanggapan` time NOT NULL,
  `image_tanggapan` varchar(250) NOT NULL,
  `status_komplain` int(11) NOT NULL,
  `status_selesai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komplain`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_member`
--
ALTER TABLE `mst_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_komplain`
--
ALTER TABLE `tb_komplain`
  ADD PRIMARY KEY (`id_komplain`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_member`
--
ALTER TABLE `mst_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_komplain`
--
ALTER TABLE `tb_komplain`
  MODIFY `id_komplain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
