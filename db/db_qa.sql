-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 09:58 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE IF NOT EXISTS `bagian` (
  `kd_bagian` char(4) NOT NULL,
  `nm_bagian` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`kd_bagian`, `nm_bagian`) VALUES
('0100', 'HRD'),
('0110', 'Penerimaan & Pembinaan Karyawan'),
('0120', 'Kantin');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE IF NOT EXISTS `dokumen` (
  `kd_dokumen` varchar(13) NOT NULL,
  `nama_dokumen` varchar(50) NOT NULL,
  `tgl_pengesahan` date NOT NULL,
  `file` text NOT NULL,
  `status_dokumen` enum('0','1') NOT NULL,
  `status_revisi` int(2) NOT NULL,
  `kd_memo` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `dokumen`
--
DELIMITER $$
CREATE TRIGGER `ganti_status` AFTER INSERT ON `dokumen`
 FOR EACH ROW update memo set status_memo='selesai' where kd_memo= new.kd_memo
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE IF NOT EXISTS `jenis_dokumen` (
  `kd_jenis` varchar(3) NOT NULL,
  `nm_dokumen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_dokumen`
--

INSERT INTO `jenis_dokumen` (`kd_jenis`, `nm_dokumen`) VALUES
('IK ', 'Instruksi Kerja'),
('KP ', 'Kebijakan Perusahaan'),
('MI ', 'Manual Integrasi'),
('PI ', 'Prosedur Integrasi'),
('RM ', 'Rancangan Mutu');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_bagian`
--

CREATE TABLE IF NOT EXISTS `kepala_bagian` (
  `kd_kabag` char(5) NOT NULL,
  `nm_kabag` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `kd_bagian` char(4) NOT NULL,
  `kd_staff` char(6) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepala_bagian`
--

INSERT INTO `kepala_bagian` (`kd_kabag`, `nm_kabag`, `alamat`, `no_telp`, `password`, `kd_bagian`, `kd_staff`) VALUES
('01001', 'Donny', 'Jakarta', '08101010101', 'test', '0100', '023000'),
('01101', 'Arch', 'Tangerang', '08111110000', 'test', '0110', '023000'),
('01201', 'Lina', 'Jakarta', '089810101010', 'test', '0120', '023000');

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE IF NOT EXISTS `memo` (
  `kd_memo` char(7) NOT NULL,
  `tgl_memo` date NOT NULL,
  `status_pengajuan` enum('baru','revisi','hapus') NOT NULL,
  `isi_memo` text NOT NULL,
  `status_memo` enum('tunggu','proses','selesai') NOT NULL,
  `kd_staff` char(6) NOT NULL DEFAULT '',
  `kd_kabag` char(5) NOT NULL DEFAULT '',
  `kd_jenis` varchar(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `kd_staff` char(6) NOT NULL,
  `nm_staff` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`kd_staff`, `nm_staff`, `password`, `level`) VALUES
('023000', 'Anonymous', 'test', '0'),
('023001', 'Killua', 'test', '1'),
('023002', 'Gon', 'test', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`kd_bagian`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`kd_dokumen`,`kd_memo`),
  ADD KEY `kd_memo` (`kd_memo`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`kd_jenis`);

--
-- Indexes for table `kepala_bagian`
--
ALTER TABLE `kepala_bagian`
  ADD PRIMARY KEY (`kd_kabag`,`kd_bagian`,`kd_staff`),
  ADD KEY `kd_unit` (`kd_bagian`),
  ADD KEY `kd_qa` (`kd_staff`);

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`kd_memo`,`kd_staff`,`kd_kabag`,`kd_jenis`),
  ADD KEY `kd_pegawai` (`kd_kabag`),
  ADD KEY `kd_qa` (`kd_staff`),
  ADD KEY `kd_jenis` (`kd_jenis`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`kd_staff`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`kd_memo`) REFERENCES `memo` (`kd_memo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kepala_bagian`
--
ALTER TABLE `kepala_bagian`
  ADD CONSTRAINT `kepala_bagian_ibfk_3` FOREIGN KEY (`kd_bagian`) REFERENCES `bagian` (`kd_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kepala_bagian_ibfk_4` FOREIGN KEY (`kd_staff`) REFERENCES `staff` (`kd_staff`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `memo`
--
ALTER TABLE `memo`
  ADD CONSTRAINT `memo_ibfk_4` FOREIGN KEY (`kd_staff`) REFERENCES `staff` (`kd_staff`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memo_ibfk_5` FOREIGN KEY (`kd_kabag`) REFERENCES `kepala_bagian` (`kd_kabag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memo_ibfk_6` FOREIGN KEY (`kd_jenis`) REFERENCES `jenis_dokumen` (`kd_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
