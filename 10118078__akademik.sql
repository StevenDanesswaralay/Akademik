-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 04:06 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `10118078__akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_dosen`
--

CREATE TABLE `t_dosen` (
  `nip` char(11) NOT NULL,
  `nama_dosen` varchar(30) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_dosen`
--

INSERT INTO `t_dosen` (`nip`, `nama_dosen`, `jk`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
('19560701123', 'Rurid handi', 'L', '1956-07-01', '083824123456', 'Bandung'),
('19560701125', 'Sukoenta M', 'L', '2020-08-12', '08539781568', 'Buah Batu'),
('19560701128', 'Nining Andianing', 'P', '1986-09-04', '08783124579', 'Lembang');

-- --------------------------------------------------------

--
-- Table structure for table `t_jurusan`
--

CREATE TABLE `t_jurusan` (
  `kode_jurusan` char(8) NOT NULL,
  `nama_jurusan` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jurusan`
--

INSERT INTO `t_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
('IF 001', 'Teknik Informatika'),
('IK01', 'Ilmu Komunikasi');

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa`
--

CREATE TABLE `t_mahasiswa` (
  `nim` char(8) NOT NULL,
  `nama_mhs` varchar(35) DEFAULT NULL,
  `jk` char(1) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` char(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_jurusan` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_mahasiswa`
--

INSERT INTO `t_mahasiswa` (`nim`, `nama_mhs`, `jk`, `tgl_lahir`, `no_telp`, `alamat`, `kode_jurusan`) VALUES
('10118078', 'Steven Danesswaralay', 'L', '2000-09-04', '085311853108', 'Bandung', 'IF 001'),
('10118081', 'Andre Tugansih', 'L', '2000-04-15', '087828826848', 'Lembang', 'IF 001'),
('10118664', 'Siti Anisa', 'P', '1997-09-12', '0853217896', 'Buah Batu', 'IF 001');

-- --------------------------------------------------------

--
-- Table structure for table `t_matkul`
--

CREATE TABLE `t_matkul` (
  `kode_mk` char(8) NOT NULL,
  `nama_mk` varchar(30) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_matkul`
--

INSERT INTO `t_matkul` (`kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
('BD2', 'Basdat II', 3, 4),
('Met01', 'Metnum ', 3, 4),
('SI01', 'Sistem Informasi ', 2, 4),
('SO02', 'SO', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_perkuliahan`
--

CREATE TABLE `t_perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL,
  `nim` char(8) NOT NULL,
  `kode_mk` char(8) NOT NULL,
  `nip` char(11) NOT NULL,
  `nilai` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_perkuliahan`
--

INSERT INTO `t_perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nip`, `nilai`) VALUES
(1, '10118078', 'BD2', '19560701123', 'A'),
(2, '10118081', 'Met01', '19560701125', 'B'),
(3, '10118664', 'SO02', '19560701128', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` enum('akademik','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(4, 'Steven', 'user', 'user', 'akademik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_dosen`
--
ALTER TABLE `t_dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `t_jurusan`
--
ALTER TABLE `t_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `t_matkul`
--
ALTER TABLE `t_matkul`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `t_perkuliahan`
--
ALTER TABLE `t_perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_mk` (`kode_mk`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_perkuliahan`
--
ALTER TABLE `t_perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  ADD CONSTRAINT `t_mahasiswa_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `t_jurusan` (`kode_jurusan`);

--
-- Constraints for table `t_perkuliahan`
--
ALTER TABLE `t_perkuliahan`
  ADD CONSTRAINT `t_perkuliahan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `t_mahasiswa` (`nim`),
  ADD CONSTRAINT `t_perkuliahan_ibfk_2` FOREIGN KEY (`kode_mk`) REFERENCES `t_matkul` (`kode_mk`),
  ADD CONSTRAINT `t_perkuliahan_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `t_dosen` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
