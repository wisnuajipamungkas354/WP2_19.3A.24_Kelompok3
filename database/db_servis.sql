-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 05:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_servis`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_servis`
--

CREATE TABLE `detail_servis` (
  `id` int(4) NOT NULL,
  `id_servis` varchar(5) DEFAULT NULL,
  `id_part` varchar(6) DEFAULT NULL,
  `nm_part` varchar(35) DEFAULT NULL,
  `harga` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_servis`
--

INSERT INTO `detail_servis` (`id`, `id_servis`, `id_part`, `nm_part`, `harga`) VALUES
(9, 'S0002', 'B001', 'SSD SATA III V-gen 128GB', 215000),
(11, 'S0003', 'B002', 'SSD SATA III V-gen 256GB', 335000);

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `no_faktur` varchar(5) NOT NULL,
  `tgl` date DEFAULT NULL,
  `id_supplier` varchar(4) DEFAULT NULL,
  `id_part` varchar(4) DEFAULT NULL,
  `harga_part` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_faktur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`no_faktur`, `tgl`, `id_supplier`, `id_part`, `harga_part`, `jumlah`, `total_faktur`) VALUES
('F0001', '2023-12-12', '1', 'B001', 215000, 5, 1075000),
('F0002', '2023-12-12', '1', 'B002', 335000, 5, 1675000),
('F0003', '2023-12-12', '1', 'B003', 320000, 5, 1600000),
('F0004', '2023-12-12', '1', 'B004', 205000, 5, 1025000),
('F0005', '2023-12-12', '1', 'B001', 215000, 6, 1290000),
('F0006', '2023-12-18', '2', 'B005', 750000, 5, 3750000),
('F0007', '2023-12-19', '2', 'B006', 700000, 5, 3500000),
('F0008', '2023-12-19', '2', 'B007', 1200000, 4, 4800000),
('F0009', '2023-12-19', '2', 'B008', 550000, 10, 5500000),
('F0010', '2023-12-19', '2', 'B009', 500000, 8, 4000000),
('F0011', '2023-12-19', '2', 'B007', 1200000, 4, 4800000),
('F0012', '2023-12-19', '1', 'B010', 35000, 15, 525000),
('F0013', '2023-12-19', '2', 'B011', 25000, 100, 2500000),
('F0014', '2023-12-19', '2', 'B012', 150000, 5, 750000),
('F0015', '2023-12-19', '4', 'B013', 100000, 10, 1000000),
('F0016', '2023-12-19', '4', 'B014', 250000, 6, 1500000),
('F0017', '2023-12-19', '4', 'B015', 350000, 4, 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(3) NOT NULL,
  `nm_karyawan` varchar(35) DEFAULT NULL,
  `noHp_karyawan` varchar(15) DEFAULT NULL,
  `jabatan` enum('Admin','Owner','Teknisi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nm_karyawan`, `noHp_karyawan`, `jabatan`) VALUES
('P01', 'Muhammad Naufal Saputra', '085712345678', 'Teknisi'),
('P02', 'Jodi Ramadhan', '085812345678', 'Admin'),
('P03', 'Wisnu Aji Pamungkas', '085889634432', 'Owner'),
('P04', 'Hilmi', '085812345678', 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` varchar(5) NOT NULL,
  `tgl` date DEFAULT NULL,
  `no_nota` varchar(5) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tgl`, `no_nota`, `total`) VALUES
('L0001', '2023-12-12', 'N0001', 2450000),
('L0002', '2023-12-12', 'N0002', 265000),
('L0003', '2023-12-18', 'N0003', 435000);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id_part` varchar(6) NOT NULL,
  `nm_part` varchar(100) DEFAULT NULL,
  `stok` int(6) DEFAULT NULL,
  `harga_part` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id_part`, `nm_part`, `stok`, `harga_part`) VALUES
('B001', 'SSD SATA III V-gen 128GB', 6, 215000),
('B002', 'SSD SATA III V-gen 256GB', 5, 335000),
('B003', 'SSD SATA III V-gen 240GB', 5, 320000),
('B004', 'SSD SATA III V-gen 120GB', 5, 205000),
('B005', 'LCD 14 Inch Slim 40 Pin', 5, 750000),
('B006', 'LCD 14 Inch Slim 30 Pin', 5, 700000),
('B007', 'LCD fHD 14 Inch Slim 30 Pin', 4, 1200000),
('B008', 'LCD 14 Inch Tebal 40 Pin', 10, 550000),
('B009', 'LCD 14 Inch tebal 30 Pin', 8, 500000),
('B010', 'Caddy For HDD', 15, 35000),
('B011', 'Pasta Processor/VGA', 100, 25000),
('B012', 'RAM DDR3/L 4GB', 5, 150000),
('B013', 'RAM DDR3/L 2GB', 10, 100000),
('B014', 'RAM DDR4 4GB', 6, 250000),
('B015', 'RAM DDR4 8GB', 4, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(5) NOT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nm_pelanggan`, `no_hp`) VALUES
('C0002', 'Zhelitaayu nurul Liza', '085812345678'),
('C0003', 'Jodi Ramadhan', '085889634432'),
('C0004', 'Jodi Ramadhan', '08561234567'),
('C0005', 'Jodi Ramadhan', '085812345678'),
('C0006', 'Jodi Ramadhan', '085889634432');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_nota` varchar(5) NOT NULL,
  `nm_admin` varchar(35) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_servis` varchar(5) DEFAULT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `tipe_laptop` varchar(50) DEFAULT NULL,
  `keluhan_awal` text DEFAULT NULL,
  `nm_teknisi` varchar(35) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `biaya_jasa` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_nota`, `nm_admin`, `tgl`, `id_servis`, `nm_pelanggan`, `tipe_laptop`, `keluhan_awal`, `nm_teknisi`, `total_harga`, `biaya_jasa`, `total`) VALUES
('N0001', 'Wisnu Aji Pamungkas', '2023-12-12', 'S0001', 'Dina Aulia Sabilla', 'Asus X453M', 'Mati', 'Zhelitaayu Nurul Liza', 2350000, 100000, 2450000),
('N0002', 'Jodi Ramadhan', '2023-12-12', 'S0002', 'Zhelitaayu nurul Liza', 'Lenovo IdeaPad 5', 'Upgrade SSD', 'Muhammad Naufal Saputra', 215000, 50000, 265000),
('N0003', 'Jodi Ramadhan', '2023-12-18', 'S0003', 'Jodi Ramadhan', 'Lenovo IdeaPad 14', 'Upgrade SSD', 'Muhammad Naufal Saputra', 335000, 100000, 435000);

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id_servis` varchar(5) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `id_pelanggan` varchar(5) DEFAULT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `tipe_laptop` varchar(50) DEFAULT NULL,
  `keluhan_awal` text DEFAULT NULL,
  `nm_teknisi` varchar(35) DEFAULT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id_servis`, `tgl`, `id_pelanggan`, `nm_pelanggan`, `no_hp`, `tipe_laptop`, `keluhan_awal`, `nm_teknisi`, `total_harga`) VALUES
('S0002', '2023-12-12 16:51:33', 'C0002', 'Zhelitaayu nurul Liza', '085812345678', 'Lenovo IdeaPad 5', 'Upgrade SSD', 'Muhammad Naufal Saputra', 215000),
('S0003', '2023-12-18 16:19:56', 'C0006', 'Jodi Ramadhan', '085889634432', 'Lenovo IdeaPad 14', 'Upgrade SSD', 'Muhammad Naufal Saputra', 335000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(4) NOT NULL,
  `nm_supplier` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nm_supplier`) VALUES
(1, 'Intact Official Store'),
(2, 'Mega Perkasa Computer'),
(3, 'Centro Part'),
(4, 'Full Star Computer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_karyawan` varchar(4) NOT NULL,
  `id_role` int(4) DEFAULT NULL,
  `nm_karyawan` varchar(35) DEFAULT NULL,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status_akun` enum('Aktif','Nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_karyawan`, `id_role`, `nm_karyawan`, `username`, `password`, `image`, `status_akun`) VALUES
('P01', 2, 'Muhammad Naufal Saputra', 'owner1', '$2y$10$LonyBzE3xsxdNcnsFcTfO.H7pM56gX.41CLuhs9SV/RP0J0VX.dOi', 'default.svg', 'Aktif'),
('P02', 1, 'Jodi Ramadhan', 'admin123', '$2y$10$d9bUotgALqfC80aB0xQivewtXQKacaBB4kW4ClLpUb4poAEKH3VQi', 'default.svg', 'Aktif'),
('P03', 2, 'Wisnu Aji Pamungkas', 'owner123', '$2y$10$I0SYmzTJXlLms.As05DSAeMB/ZY4Oen7fwiJ/NOuEpdI4m7b.VLCu', 'default.svg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id_access` int(4) NOT NULL,
  `id_role` int(4) DEFAULT NULL,
  `id_menu` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id_access`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(35) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `title`, `url`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'),
(2, 'Servis', 'ManajemenData', 'fas fa-fw fa-tools'),
(3, 'Pembayaran', 'ManajemenData/pembayaran', 'fas fa-fw fa-file-invoice-dollar'),
(4, 'Laporan', 'ManajemenData/Laporan', 'fas fa-fw fa-file-alt'),
(5, 'Laporan', 'MonitoringData', 'fas fa-fw fa-file-alt'),
(6, 'Komponen & Part', 'MonitoringData/barang', 'fas fa-fw fa-box'),
(7, 'Pengguna', 'ManajemenKaryawan', 'fas fa-fw fa-user'),
(8, 'Karyawan', 'ManajemenKaryawan/karyawan', 'fas fa-fw fa-user-tie');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(4) NOT NULL,
  `nm_role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `nm_role`) VALUES
(1, 'Admin'),
(2, 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_servis`
--
ALTER TABLE `detail_servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`no_faktur`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_nota`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id_servis`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id_access`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_servis`
--
ALTER TABLE `detail_servis`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id_access` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
