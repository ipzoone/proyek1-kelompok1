-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2025 at 08:57 AM
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
-- Database: `pamayahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(5, 'admin1', '$2y$10$Z1Bx69zcMZvnLpWSFSgx7.aq5RWE1mA2.Cya73ZSwg3M3BapOqivC'),
(9, 'lukman', '$2y$10$fXf5E0g89gFTe0mdHPXwpu6IBZnv6dVTKTE2lPANaVjZCYxymYIXC'),
(10, 'saif', '$2y$10$OC6L9jAXzLckCqSeQeSjMe.OL5kvKZ6pnQqebw0CDNdMnA1HUAu02'),
(11, 'azhar', '$2y$10$P.4C8XnYnTT7ge/OAohJ5.XCOS9f8/.6II.xr411T17W5voxdTjn.'),
(17, 'ali', '$2y$10$NzU56b74ZX3E3o2Mp9l/De0EEBv.T3hYjcmjy2H7ybiJ7rRvXJMgi'),
(18, 'ali', '$2y$10$2XT8otDpbjG4KMmn5/RJM.6.jdpDk9NLvsbmxMsuVIaAj01y087g.'),
(19, 'saif', '$2y$10$M8GB4WNlHsOMmV.Dh8rbcOehswg/E2oeiY9RPxhkDEDl4uzrXZFRW');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `status` enum('Aktif','Selesai') DEFAULT 'Aktif',
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `diubah_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `tanggal`, `waktu`, `tempat`, `status`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'agenda posyandu', 'poyandu gratis', '2025-04-18', '09:00:00', 'kantor desa pamayahan', 'Selesai', '2025-04-15 14:16:33', '2025-05-08 16:08:30'),
(2, 'gotong royong ', 'agenda gotong royong masayarakat pamayahan', '2025-05-07', '09:00:00', 'kantor desa pamayahan', 'Selesai', '2025-04-16 04:27:06', '2025-05-08 16:08:23'),
(3, 'azhar lahiran', 'azhar lahiran ning pinggir kali', '2024-04-03', '09:00:00', 'pinggir kali', 'Selesai', '2025-04-22 06:58:52', '2025-05-08 16:08:35'),
(4, 'Konvoi Persib Juara back to back ', 'persib juara dsjkhdjfjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2025-06-19', '20:00:00', 'gedung sate', 'Aktif', '2025-04-24 04:26:23', '2025-05-09 03:00:05'),
(5, 'azhar debus', 'penampilan azhar debus memakan beling ', '2025-05-07', '09:30:00', 'jatibarang', 'Selesai', '2025-05-06 04:19:14', '2025-05-07 07:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `gambar`, `dibuat_pada`, `penulis`) VALUES
(6, 'desa tenggelam', 'desa yang tenggelam membuat dsfjhdsjkhfksdbfsdjbfdshhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '1744721554_parrots.jpg', '2025-04-15 12:52:34', 'prof.saif ali mushaddiq'),
(8, 'manchester city trebel winner', 'dsadjskdjsajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjdsaknfasnfjdsmfmndsbfndsmbgdsdishfjdksnfmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmndsjfksdfbdsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '1744725747_mobil.jpg', '2025-04-15 14:02:27', 'kevin dari bandung'),
(9, 'IPZONEX resmi menjadi perusahaan dibidang Teknologi', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', '1745300862_Screenshot 2025-01-28 194804.png', '2025-04-22 05:47:42', 'saif ali mushaddiq'),
(15, 'Konvoi Persib Juara B2B', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1745989616_20240601-persib-juara-liga-indonesia.jpg', '2025-04-30 05:06:56', 'kevin dari bandung');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Surat Keterangan Domisili', 'Surat keterangan tempat tinggal'),
(2, 'Surat Keterangan Tidak Mampu', 'Surat keterangan untuk keluarga tidak mampu'),
(3, 'Surat Pengantar KTP', 'Surat pengantar untuk pembuatan KTP'),
(4, 'Surat Pengantar KK', 'Surat pengantar untuk pembuatan Kartu Keluarga'),
(5, 'Surat Keterangan Usaha', 'Surat keterangan untuk usaha'),
(6, 'Surat Keterangan Kelahiran', 'Surat keterangan untuk kelahiran'),
(7, 'Surat Keterangan Kematian', 'Surat keterangan untuk kematian'),
(8, 'Lainnya', 'Jenis surat lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_laporan`
--

CREATE TABLE `kategori_laporan` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_laporan`
--

INSERT INTO `kategori_laporan` (`id`, `nama`, `deskripsi`, `icon`) VALUES
(1, 'Infrastruktur', 'Laporan terkait jalan, jembatan, drainase, dll', 'bi-tools'),
(2, 'Lingkungan', 'Laporan terkait sampah, polusi, penebangan liar, dll', 'bi-tree'),
(3, 'Keamanan', 'Laporan terkait keamanan dan ketertiban masyarakat', 'bi-shield'),
(4, 'Kesehatan', 'Laporan terkait masalah kesehatan dan sanitasi', 'bi-heart-pulse'),
(5, 'Administrasi', 'Laporan terkait pelayanan administrasi desa', 'bi-file-earmark-text'),
(6, 'Lainnya', 'Laporan lainnya yang tidak termasuk kategori di atas', 'bi-three-dots');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_warga`
--

CREATE TABLE `laporan_warga` (
  `id` int NOT NULL,
  `masyarakat_id` int DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Diterima','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Diterima',
  `tanggal_laporan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime DEFAULT NULL,
  `tanggapan_admin` text,
  `prioritas` enum('Rendah','Sedang','Tinggi') NOT NULL DEFAULT 'Sedang',
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_warga`
--

INSERT INTO `laporan_warga` (`id`, `masyarakat_id`, `nik`, `kategori`, `judul`, `isi`, `lokasi`, `foto`, `status`, `tanggal_laporan`, `tanggal_update`, `tanggapan_admin`, `prioritas`, `is_read`) VALUES
(3, 16, NULL, 'Infrastruktur', 'saip', 'ali', 'mushaddiq', '', 'Diterima', '2025-05-12 13:27:02', NULL, NULL, 'Sedang', 0),
(4, 16, NULL, 'Infrastruktur', 'saip', 'ali', 'mushaddiq', '', 'Diterima', '2025-05-12 13:29:23', '2025-05-12 08:30:28', 'oke meluncur', 'Sedang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` varchar(16) NOT NULL,
  `pin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nama`, `nik`, `pin`) VALUES
(11, 'saip', '3275091234567898', '$2y$10$nf5iz.ZGyYST6XMR6BvHVOsBQ2e.QTDLh4e7CsGxlXGzKN7z87U0u'),
(13, 'lukman', '43254356465767', '$2y$10$pQrM7ea3XgGZQu3BSRtFp.0BdfhQGTSxlAO5q8pBATCUlwN9R220u'),
(14, 'hapiz', '43254356465765', '$2y$10$bebnitkD7l4tWIiSI8L95OTkZ2KbGy1NnfotpmUsf1xH7itdaIJxy'),
(15, 'ido', '3275091234567870', '$2y$10$Ae8UBUzaImgofn0id01rIuQfpBnETOzc6IECYpowe0tGfmlTPTkdu'),
(16, 'saif', '4325435777777', '$2y$10$ALmfbc0AiBp0bIUyUvxN0.GVfVVS6gyAz1FWr3xGnjHlzmruxRmYK');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int NOT NULL,
  `masyarakat_id` int NOT NULL,
  `jenis_surat_id` int NOT NULL,
  `keterangan` text NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `catatan_admin` text,
  `tanggal_pengajuan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai` datetime DEFAULT NULL,
  `keperluan` text,
  `status` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `masyarakat_id`, `jenis_surat_id`, `keterangan`, `dokumen`, `status_id`, `catatan_admin`, `tanggal_pengajuan`, `tanggal_selesai`, `keperluan`, `status`, `is_read`) VALUES
(7, 16, 6, 'k', '1747030158_IMG_20200304_173525.jpg', 1, NULL, '2025-05-12 13:09:18', NULL, 'untuk melamar kerja', 'Menunggu', 0),
(8, 16, 1, '', '1747030220_Screenshot 2025-02-25 112218.png', 1, NULL, '2025-05-12 13:10:20', NULL, 'pindah rumah', 'Menunggu', 0),
(9, 16, 1, 'mbuh', '', 1, NULL, '2025-05-12 13:25:17', NULL, 'untuk melamar kerja', 'Menunggu', 0),
(10, 16, 1, 'xx', '', 1, NULL, '2025-05-12 13:29:48', NULL, 'coba jenis surat', 'Menunggu', 0),
(11, 16, 1, 'xx', '', 1, NULL, '2025-05-12 13:33:05', NULL, 'coba jenis surat', 'Menunggu', 0),
(12, 16, 1, 'xx', '', 1, NULL, '2025-05-12 13:36:53', NULL, 'coba jenis surat', 'Menunggu', 0),
(13, 16, 2, 'uhuyy', '', 1, '', '2025-05-12 13:37:17', NULL, 'pindah rumah', 'Diproses', 0),
(14, 16, 2, 'uhuyy', '', 1, '', '2025-05-12 13:47:44', NULL, 'pindah rumah', 'Ditolak', 0),
(15, 16, 5, 'mau dagang', '', 1, 'ini udah selesai', '2025-05-12 13:48:20', '2025-05-12 07:19:59', 'mau buat usaha cireng', 'Selesai', 1),
(16, 16, 5, 'mau dagang', '', 1, '', '2025-05-12 13:48:57', NULL, 'mau buat usaha cireng', 'Diproses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id`, `nama`) VALUES
(4, 'cia lucu mau '),
(3, 'kevin dari bandung'),
(1, 'prof.saif ali mushaddiq'),
(2, 'saif ali mushaddiq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_warga`
--
ALTER TABLE `laporan_warga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jenis_surat` (`jenis_surat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `laporan_warga`
--
ALTER TABLE `laporan_warga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `fk_jenis_surat` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
