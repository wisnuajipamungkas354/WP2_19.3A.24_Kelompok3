-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2023 at 03:29 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` varchar(4) NOT NULL,
  `nm_brg` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga_brg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nm_brg`, `stok`, `harga_brg`) VALUES
('B001', 'Oli 1 Liter', 27, 31000),
('B002', 'Busi', 39, 20000),
('B003', 'Rantai TDR', 29, 35000),
('B004', 'Kampas Rem', 25, 25000),
('B005', 'Ban', 29, 147000),
('B006', 'Filter Motor', 42, 200000),
('B007', 'Lampu LED Motor (depan)', 23, 120000),
('B008', 'Kampas Kopling', 37, 424000),
('B009', 'Aki Motor', 50, 125000),
('B010', 'Knalpot', 8, 725000);

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `no_faktur` varchar(5) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `id_pemasok` varchar(4) DEFAULT NULL,
  `id_brg` varchar(4) DEFAULT NULL,
  `harga_brg` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_faktur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`no_faktur`, `tgl`, `id_pemasok`, `id_brg`, `harga_brg`, `jumlah`, `total_faktur`) VALUES
('F0002', '2022-07-09 10:21:52', 'SP02', 'B001', 31000, 20, 620000),
('F0003', '2022-07-26 08:29:15', 'SP01', 'B003', 35000, 30, 1050000),
('F0004', '2022-07-26 08:29:43', 'SP01', 'B001', 31000, 20, 620000),
('F0005', '2022-07-26 08:32:04', 'SP01', 'B004', 25000, 25, 625000),
('F0006', '2022-07-26 08:40:47', 'SP02', 'B005', 147000, 33, 4851000),
('F0007', '2022-07-26 08:47:31', 'SP09', 'B006', 200000, 44, 8800000),
('F0008', '2022-07-26 08:48:55', 'SP06', 'B007', 120000, 24, 2880000),
('F0009', '2022-07-26 08:50:11', 'SP10', 'B008', 424000, 37, 15688000),
('F0010', '2022-07-26 08:51:14', 'SP07', 'B009', 125000, 50, 6250000);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` varchar(5) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `no_nota` varchar(5) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tgl`, `no_nota`, `total`) VALUES
('L0001', '2022-07-10 01:13:36', 'N0001', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(3) NOT NULL,
  `nm_pegawai` varchar(30) DEFAULT NULL,
  `noTlp_pegawai` varchar(15) DEFAULT NULL,
  `jabatan` enum('Admin','Manajer','Mekanik') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `noTlp_pegawai`, `jabatan`) VALUES
('P01', 'Angkara', '089567881456', 'Admin'),
('P02', 'Sanjaya', '081399667000', 'Manajer'),
('P03', 'Sena', '089567881344', 'Mekanik'),
('P04', 'Juna', '081399457045', 'Mekanik'),
('P05', 'Viola', '081399457058', 'Admin'),
('P06', 'Rizkia', '081399454381', 'Admin'),
('P07', 'Rahmat', '081677899123', 'Mekanik'),
('P08', 'Budi', '081665899010', 'Admin'),
('P09', 'Cristoff', '081677899015', 'Mekanik');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(5) NOT NULL,
  `nm_pelanggan` varchar(30) DEFAULT NULL,
  `noTlp_pelanggan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nm_pelanggan`, `noTlp_pelanggan`) VALUES
('C0001', 'Azami', '081327384900'),
('C0002', 'Lunaa', '081677899013'),
('C0003', 'Silva', '081677899012'),
('C0004', 'Vioni', '081677899011');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` varchar(4) NOT NULL,
  `nm_pemasok` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nm_pemasok`) VALUES
('SP01', 'OneLiver Group'),
('SP02', 'MechTech Company'),
('SP03', 'Panca Jaya Equipment'),
('SP04', 'ABP Mandiri'),
('SP05', 'PT. Subur Makmur'),
('SP06', ' PT. Balfiltracs Indonesia'),
('SP07', 'PD. Multipart Jaya Indo'),
('SP08', 'Jaya Utama Bearing'),
('SP09', ' PT. Anugerah Autoparts'),
('SP10', 'Van Java Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_nota` varchar(5) NOT NULL,
  `nm_admin` varchar(30) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `id_servis` varchar(5) DEFAULT NULL,
  `nm_pelanggan` varchar(30) DEFAULT NULL,
  `merk_kendaraan` varchar(30) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `nm_brg` varchar(30) DEFAULT NULL,
  `harga_brg` int(11) DEFAULT NULL,
  `jumlah_brg` int(11) DEFAULT NULL,
  `subtotal_brg` int(11) DEFAULT NULL,
  `nm_mekanik` varchar(30) DEFAULT NULL,
  `harga_jasa` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_nota`, `nm_admin`, `tgl`, `id_servis`, `nm_pelanggan`, `merk_kendaraan`, `keluhan`, `nm_brg`, `harga_brg`, `jumlah_brg`, `subtotal_brg`, `nm_mekanik`, `harga_jasa`, `total`) VALUES
('N0001', 'Angkara', '2022-07-20 03:12:41', 'S0001', 'Azami', 'Yamaha Jupiter Z', 'Mengganti oli', 'Oli 1 Liter', 30000, 1, 30000, 'Sena', 20000, 50000),
('N0002', 'Angkara', '2022-07-29 09:32:13', 'S0002', 'Lunaa', 'Honda Varion', 'Mengganti busi', 'Busi', 20000, 1, 20000, 'Juna', 10000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id_servis` varchar(5) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `id_pelanggan` varchar(5) DEFAULT NULL,
  `nm_pelanggan` varchar(30) DEFAULT NULL,
  `noTlp_pelanggan` varchar(15) DEFAULT NULL,
  `merk_kendaraan` varchar(30) DEFAULT NULL,
  `no_plat` varchar(11) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `nm_mekanik` varchar(30) DEFAULT NULL,
  `id_brg` varchar(4) DEFAULT NULL,
  `nm_brg` varchar(30) DEFAULT NULL,
  `harga_brg` int(11) DEFAULT NULL,
  `jumlah_brg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id_servis`, `tgl`, `id_pelanggan`, `nm_pelanggan`, `noTlp_pelanggan`, `merk_kendaraan`, `no_plat`, `keluhan`, `nm_mekanik`, `id_brg`, `nm_brg`, `harga_brg`, `jumlah_brg`) VALUES
('S0001', '2022-07-26 21:27:09', 'C0001', 'Azami', '081327384900', 'Yamaha Jupiter Z', 'B 1234 VV', 'Mengganti oli', 'Sena', 'B001', 'Oli 1 Liter', 30000, 1),
('S0002', '2022-07-20 03:07:52', 'C0002', 'Lunaa', '081677899013', 'Honda Varion', 'D 3456 B', 'Mengganti busi', 'Juna', 'B002', 'Busi', 20000, 1),
('S0003', '2022-08-07 14:46:49', 'C0003', 'Silva', '081677899012', 'Honda hondaan', 'B 6789 HH', 'Lampu depan motor rusak', 'Sena', 'B007', 'Lampu LED Motor (depan)', 120000, 1),
('S0004', '2022-07-26 20:22:13', 'C0004', 'Vioni', '081677899011', 'Honda Beat', 'B 6789 HY', 'Mengganti busi', 'Juna', 'B002', 'Busi', 20000, 1);

--
-- Triggers `servis`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok_brg` AFTER UPDATE ON `servis` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok - NEW.jumlah_brg
    WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_pegawai` varchar(3) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `status_akun` enum('Aktif','Tidak Aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_pegawai`, `id_role`, `nama_pegawai`, `username`, `password`, `image`, `status_akun`) VALUES
('P01', 1, 'Angkara', 'admin01', '$2y$10$7FKu8ZM/70wK3hU1CwAymOWmh/iYsbebrrXTPDnSoog//EOGkN5XW', 'default.svg', 'Aktif'),
('P02', 2, 'Sanjaya', 'manajer01', '$2y$10$W1BwkeOq0Yx6d9n.KnD06ecJDaixs7IEy8sERQaYofofn7NFP52Pu', 'default.svg', 'Aktif'),
('P05', 1, 'Viola', 'admin02', '$2y$10$miBPI1JE2EErWzs6aMPNcu4N2P2QT3zN3CG5ZAeos8C1Bg3DUTjqy', 'default.svg', 'Aktif'),
('P06', 1, 'Rizkia', 'admin03', '$2y$10$DnDIauAJCtDh2n.smBL90uBS3NW9w2Hc90XB5A4QvtplVWbd5oQPy', 'default.svg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `nm_menu` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `nm_menu`) VALUES
(1, 'Dashboard'),
(2, 'Manajemen Data'),
(3, 'Monitoring Data'),
(4, 'Manajemen Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `nm_role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `nm_role`) VALUES
(1, 'Admin'),
(2, 'Manajer');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

CREATE TABLE `user_submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `url` varchar(30) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id_submenu`, `id_menu`, `title`, `url`, `icon`) VALUES
(1, 1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'),
(2, 2, 'Servis', 'ManajemenData', 'fas fa-fw fa-tools'),
(3, 2, 'Pembayaran', 'ManajemenData/pembayaran', 'fas fa-fw fa-file-invoice-dollar'),
(4, 2, 'Laporan', 'ManajemenData/laporan', 'fas fa-fw fa-file-alt'),
(5, 3, 'Laporan', 'MonitoringData', 'fas fa-fw fa-file-alt'),
(6, 3, 'Barang', 'MonitoringData/barang', 'fas fa-fw fa-box'),
(7, 4, 'Pengguna', 'ManajemenPegawai', 'fas fa-fw fa-user'),
(8, 4, 'Pegawai', 'ManajemenPegawai/pegawai', 'fas fa-fw fa-user-tie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `id_pemasok` (`id_pemasok`),
  ADD KEY `id_brg` (`id_brg`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `no_nota` (`no_nota`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_nota`),
  ADD KEY `id_servis` (`id_servis`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id_servis`),
  ADD KEY `id_brg` (`id_brg`),
  ADD KEY `servis_ibfk_1` (`id_pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_submenu`
--
ALTER TABLE `user_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `faktur_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`),
  ADD CONSTRAINT `faktur_ibfk_2` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`no_nota`) REFERENCES `pembayaran` (`no_nota`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_servis`) REFERENCES `servis` (`id_servis`);

--
-- Constraints for table `servis`
--
ALTER TABLE `servis`
  ADD CONSTRAINT `servis_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `servis_ibfk_2` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD CONSTRAINT `user_submenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
