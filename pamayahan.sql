-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2025 at 07:37 AM
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
(1, 'SIM Keliling Gratis', 'Pembuatan SIM keliling gratis', '2025-04-18', '09:00:00', 'kantor desa pamayahan', 'Selesai', '2025-04-15 14:16:33', '2025-05-14 04:19:08'),
(2, 'gotong royong ', 'Gotong Royong di RW 05', '2025-05-07', '09:00:00', 'RW 05', 'Selesai', '2025-04-16 04:27:06', '2025-05-14 04:18:15'),
(3, 'Lomba 17 Agustus', 'Perayaan HUT RI Desa Pamayahan', '2024-08-17', '08:00:00', 'Kantor Desa Pamayahan', 'Selesai', '2025-04-22 06:58:52', '2025-05-14 04:21:13'),
(4, 'Jalan Santai', 'Jalan Santai Bareng Bapak Kapolres Indramayu', '2025-06-29', '08:00:00', 'Kantor Desa Pamayahan', 'Aktif', '2025-04-24 04:26:23', '2025-05-14 04:23:12'),
(7, 'Posyandu', 'Posyandu di Kantor Desa, besok siang', '2025-05-15', '09:00:00', 'Kantor Desa Pamayahan', 'Aktif', '2025-05-14 04:17:19', '2025-05-14 04:17:19');

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
(6, 'Desa Pamayahan Bekerja Sama dengan Kelompok 1 Proyek POLINDRA dalam Membuat Website Desa', 'Pamayahan – Dalam rangka meningkatkan pelayanan publik dan transparansi informasi, Pemerintah Desa Pamayahan menjalin kerja sama dengan Kelompok 1 Proyek Mahasiswa Politeknik Negeri Indramayu (POLINDRA) yang terdiri dari Saif Ali Mushaddiq(2403068), Fasido(2403107),\r\ndan Siskiyah Okta Rimadan(2403108) untuk mengembangkan website resmi desa. Kerja sama ini menjadi langkah strategis dalam mewujudkan desa digital yang mampu mengikuti perkembangan teknologi informasi.\r\n\r\nPembuatan website desa ini merupakan bagian dari proyek akhir mata kuliah yang diampu oleh mahasiswa semester akhir di POLINDRA. Dengan semangat pengabdian kepada masyarakat, para mahasiswa berinisiatif untuk membantu desa-desa dalam membangun sistem informasi berbasis web yang sederhana, efisien, dan bermanfaat bagi warga.\r\n\r\nWebsite desa ini dirancang untuk memuat berbagai informasi penting seperti profil desa, berita terkini, agenda kegiatan, data layanan, hingga fitur layanan mandiri yang memungkinkan warga mengajukan permohonan surat secara online. Hal ini diharapkan dapat mempermudah warga dalam mengakses informasi dan mempercepat proses pelayanan administrasi.\r\n\r\nKepala Desa Pamayahan, Bapak H. Komarudin, menyampaikan apresiasi dan rasa terima kasihnya kepada para mahasiswa. “Kami sangat terbantu dengan adanya website ini. Sekarang informasi desa bisa diakses dengan mudah oleh masyarakat, bahkan dari rumah,” ungkapnya.\r\n\r\nKetua Kelompok 1, Aditya Pratama, mengatakan bahwa website ini dibangun dengan memperhatikan kebutuhan nyata desa dan tetap mengedepankan keamanan serta kemudahan pengguna. “Kami menggunakan teknologi yang ringan namun fungsional agar bisa dijalankan meskipun dengan infrastruktur desa yang terbatas,” jelasnya.\r\n\r\nSelama proses pengembangan, tim mahasiswa juga melakukan pendataan ulang struktur organisasi desa, menggali kebutuhan informasi dari masyarakat, serta memberikan pelatihan singkat kepada perangkat desa agar dapat mengelola konten website secara mandiri ke depannya.\r\n\r\nDengan adanya kolaborasi ini, Desa Pamayahan kini selangkah lebih maju dalam mewujudkan tata kelola pemerintahan yang transparan dan berbasis teknologi. Diharapkan, website desa ini bisa terus dikembangkan serta menjadi contoh bagi desa-desa lain di Kabupaten Indramayu.', 'kerja_sama_dengan_kelompok1.jpg', '2025-04-15 12:52:34', 'Siskiyah Okta Rimadan'),
(8, 'Penerimaan Bantuan bagi Pemilik KKS', 'Pamayahan – Pemerintah Desa Pamayahan kembali menyalurkan bantuan sosial kepada warga yang terdaftar sebagai pemilik Kartu Keluarga Sejahtera (KKS). Kegiatan ini berlangsung pada hari Senin, 13 Mei 2025, bertempat di Balai Desa Pamayahan dan berjalan dengan tertib serta sesuai prosedur yang telah ditetapkan.\r\n\r\nPenyaluran bantuan ini merupakan bagian dari program bantuan pemerintah pusat yang disalurkan melalui Kementerian Sosial untuk mendukung masyarakat yang tergolong kurang mampu. Dengan adanya bantuan ini, diharapkan kebutuhan pokok warga penerima manfaat dapat terbantu, terutama dalam menghadapi fluktuasi harga bahan pokok dan kebutuhan hidup sehari-hari.\r\n\r\nKepala Desa Pamayahan, Bapak H. Komarudin, menyampaikan bahwa bantuan ini bersifat langsung dan tidak dipungut biaya apapun. “Kami memastikan proses penyaluran berjalan secara transparan dan adil. Bagi warga yang memiliki KKS dan terdaftar sebagai penerima, bantuan akan langsung diserahkan tanpa perantara,” jelasnya.\r\n\r\nDalam kegiatan tersebut, setiap penerima bantuan diwajibkan membawa KKS, KTP, serta undangan resmi dari desa. Proses verifikasi dilakukan oleh perangkat desa dan pendamping PKH untuk memastikan data penerima sesuai dan tidak ada penyalahgunaan bantuan.\r\n\r\nIbu Suminah, salah satu warga penerima bantuan, mengungkapkan rasa syukurnya. “Alhamdulillah, bantuan ini sangat bermanfaat bagi kami. Setidaknya bisa membantu membeli beras dan kebutuhan dapur lainnya,” ujarnya sambil tersenyum.\r\n\r\nPemerintah Desa Pamayahan juga mengimbau kepada warga yang belum memiliki KKS namun merasa memenuhi syarat, agar segera mengajukan permohonan melalui RT/RW setempat. Pihak desa akan membantu memverifikasi dan mengusulkan ke dinas terkait.\r\n\r\nDengan adanya program bantuan ini, diharapkan dapat meringankan beban ekonomi masyarakat dan meningkatkan kesejahteraan warga Desa Pamayahan secara berkelanjutan.', 'PIP.jpg', '2025-04-15 14:02:27', 'Saif Ali Mushaddiq'),
(9, 'Sosialisasi Polsek Lohbener Menyampaikan Bahaya Pergaulan Bebas Anak', 'Pamayahan – Dalam rangka meningkatkan kesadaran masyarakat terhadap pentingnya pengawasan terhadap anak dan remaja, Polsek Lohbener mengadakan kegiatan sosialisasi di Balai Desa Pamayahan pada hari Selasa, 14 Mei 2025. Acara ini dihadiri oleh para perangkat desa, tokoh masyarakat, guru, dan orang tua siswa, serta para pelajar tingkat SMP dan SMA yang berdomisili di Desa Pamayahan.\r\n\r\nKapolsek Lohbener, IPTU Suryana, menyampaikan bahwa maraknya pergaulan bebas di kalangan remaja saat ini menjadi perhatian serius pihak kepolisian. Ia menjelaskan bahwa pergaulan bebas dapat membuka peluang terjadinya berbagai bentuk penyimpangan, seperti penggunaan narkoba, seks bebas, hingga kekerasan antar kelompok remaja. Hal-hal tersebut tidak hanya merusak masa depan generasi muda, tetapi juga dapat memicu gangguan ketertiban di lingkungan masyarakat.\r\n\r\nDalam pemaparannya, pihak kepolisian juga menekankan pentingnya peran keluarga dan lingkungan sekitar dalam membentuk karakter dan perilaku anak. Orang tua diminta untuk lebih aktif dalam mendampingi tumbuh kembang anak-anak mereka, memberikan edukasi mengenai batasan sosial yang sehat, serta menciptakan komunikasi yang terbuka agar anak merasa nyaman untuk bercerita.\r\n\r\nSelain itu, kegiatan ini juga diisi dengan sesi tanya jawab, di mana warga dan para remaja diberi kesempatan untuk berdialog langsung dengan pihak kepolisian. Beberapa pertanyaan yang muncul seputar pengawasan anak di media sosial, upaya pencegahan kekerasan seksual, hingga cara menghindari pergaulan negatif di sekolah.\r\n\r\nKepala Desa Pamayahan, Bapak H. Komarudin, mengapresiasi inisiatif dari Polsek Lohbener dan berharap kegiatan serupa dapat dilaksanakan secara rutin. “Ini adalah bentuk kepedulian terhadap masa depan anak-anak kita. Semoga warga Pamayahan semakin peduli dan terlibat aktif dalam menjaga generasi muda dari bahaya pergaulan bebas,” ujarnya.\r\n\r\nDengan adanya kegiatan ini, diharapkan kesadaran masyarakat Desa Pamayahan akan pentingnya pengawasan dan pembinaan terhadap anak-anak dan remaja semakin meningkat. Kegiatan sosialisasi semacam ini menjadi langkah awal untuk menciptakan lingkungan desa yang aman, sehat, dan penuh perhatian terhadap generasi penerus bangsa.', 'kapolres.jpg', '2025-04-22 05:47:42', 'Saif Ali Mushaddiq'),
(16, 'Perbaikan Jalan di RT 02 RW 03', 'Pamayahan – Pemerintah Desa Pamayahan kembali menunjukkan komitmennya dalam meningkatkan infrastruktur desa melalui kegiatan perbaikan jalan lingkungan di RT 02 RW 03. Jalan yang sebelumnya mengalami kerusakan cukup parah kini mulai diperbaiki agar dapat kembali digunakan secara aman dan nyaman oleh warga.\r\n\r\nKondisi jalan di wilayah tersebut sebelumnya sering dikeluhkan warga karena berlubang dan tergenang air saat hujan. Hal ini tentu menyulitkan aktivitas masyarakat, terutama para pelajar dan warga yang bekerja setiap hari. Menanggapi keluhan tersebut, pemerintah desa segera mengalokasikan anggaran melalui Dana Desa untuk melakukan penimbunan dan pengecoran jalan.\r\n\r\nPekerjaan perbaikan dimulai pada awal bulan Mei dan dikerjakan secara gotong royong oleh warga setempat bersama para pekerja dari desa. Material seperti batu split, semen, dan pasir telah disiapkan sejak beberapa hari sebelumnya, dan antusiasme masyarakat sangat tinggi dalam mendukung kegiatan ini.\r\n\r\nKetua RT 02, Bapak Supriyadi, menyampaikan rasa syukur dan terima kasih kepada pemerintah desa atas perhatian yang diberikan. “Kami sudah lama menunggu perbaikan ini. Alhamdulillah sekarang sudah mulai dikerjakan, dan semoga hasilnya bisa tahan lama,” ujarnya.\r\n\r\nSementara itu, Kepala Desa Pamayahan menegaskan bahwa perbaikan infrastruktur jalan merupakan salah satu prioritas utama dalam pembangunan desa tahun ini. “Kami akan terus melakukan perbaikan secara bertahap, terutama di wilayah yang paling membutuhkan,” jelasnya.\r\n\r\nDengan adanya perbaikan ini, warga RT 02 RW 03 berharap kondisi jalan menjadi lebih baik dan dapat menunjang mobilitas serta kegiatan ekonomi warga. Selain itu, perbaikan ini juga diharapkan dapat mengurangi risiko kecelakaan, terutama bagi anak-anak dan lansia.\r\n\r\n', '1747198570_jalan.jpg', '2025-05-14 04:56:10', 'Fasido');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `jenis_surat_id` int NOT NULL,
  `nama_surat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`jenis_surat_id`, `nama_surat`, `deskripsi`) VALUES
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
  `kategori_id` int NOT NULL,
  `nama_laporan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` text,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_laporan`
--

INSERT INTO `kategori_laporan` (`kategori_id`, `nama_laporan`, `deskripsi`, `icon`) VALUES
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
  `kategori_id` int DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Diterima','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Diterima',
  `tanggal_laporan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime DEFAULT NULL,
  `tanggapan_admin` text,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_warga`
--

INSERT INTO `laporan_warga` (`id`, `masyarakat_id`, `kategori_id`, `judul`, `isi`, `lokasi`, `foto`, `status`, `tanggal_laporan`, `tanggal_update`, `tanggapan_admin`, `is_read`) VALUES
(3, 16, 1, 'saip', 'ali', 'mushaddiq', '', 'Diterima', '2025-05-12 13:27:02', NULL, NULL, 0),
(4, 16, 1, 'saip', 'ali', 'mushaddiq', '', 'Diproses', '2025-05-12 13:29:23', '2025-05-13 13:29:20', 'oke meluncur jos', 1),
(5, 16, 4, 'bpjs', 'tolong bpjs saya mati', 'rumah', '', 'Diterima', '2025-05-13 11:10:08', NULL, NULL, 0),
(7, 16, 3, 'kebongkang kejlengkang ning tanah abang', 'contoh img', 'di jalan situ', '1747153874_Screenshot 2025-02-07 164035.png', 'Diterima', '2025-05-13 23:31:14', NULL, NULL, 0),
(8, 16, 3, 'kebongkang kejlengkang ning tanah abang', 'contoh img', 'di jalan situ', '1747153949_Screenshot 2025-02-07 164035.png', 'Diproses', '2025-05-13 23:32:29', '2025-05-13 16:33:06', 'makasih', 1),
(29, 16, 2, 'kebakaran', 'tolong kebakaran di Rt 04', 'Rt 04 Rw 05 blok sanggar', '', 'Selesai', '2025-05-14 11:06:03', '2025-05-14 04:13:44', 'selesai nih bos dateng aja ke kantor kuwu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `masyarakat_id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` varchar(16) NOT NULL,
  `pin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`masyarakat_id`, `nama`, `nik`, `pin`) VALUES
(14, 'hapiz', '43254356465765', '$2y$10$bebnitkD7l4tWIiSI8L95OTkZ2KbGy1NnfotpmUsf1xH7itdaIJxy'),
(15, 'lukman', '3275091234567870', '$2y$10$Ae8UBUzaImgofn0id01rIuQfpBnETOzc6IECYpowe0tGfmlTPTkdu'),
(16, 'saif', '4325435777777', '$2y$10$fM365tPLi4LesTvm7E9WSOMdUbokdUgPTxJSiq6vKt8iFYF6iTYkq'),
(18, 'ido', '43254356465768', '$2y$10$5owJhsTWUUEolFQslfrA0exW59nH6Ud/bqS4I/ooEt1dewj.fT1lm'),
(19, 'apip', '3275091234567879', '$2y$10$85jIeYrsQFjvmhzr2LinDOMcgZrOToo8tHw3T5yB.qSRXEj12iqHu');

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
(14, 16, 2, 'uhuyy', '', 1, '', '2025-05-12 13:47:44', NULL, 'pindah rumah', 'Ditolak', 1),
(15, 16, 5, 'mau dagang', '', 1, 'ini udah selesai', '2025-05-12 13:48:20', '2025-05-12 07:19:59', 'mau buat usaha cireng', 'Selesai', 1),
(16, 16, 5, 'mau dagang', '', 1, '', '2025-05-12 13:48:57', NULL, 'mau buat usaha cireng', 'Diproses', 1),
(18, 16, 1, 'contoh img', '1747152880_Screenshot 2025-01-16 163758.png', 1, NULL, '2025-05-13 23:14:40', NULL, 'untuk melamar kerja', 'Menunggu', 0);

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
  ADD PRIMARY KEY (`jenis_surat_id`);

--
-- Indexes for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `laporan_warga`
--
ALTER TABLE `laporan_warga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_masyarakat` (`masyarakat_id`),
  ADD KEY `fk_laporan_kategori` (`kategori_id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`masyarakat_id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jenis_surat` (`jenis_surat_id`),
  ADD KEY `fk_masyarakat_id` (`masyarakat_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `laporan_warga`
--
ALTER TABLE `laporan_warga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `masyarakat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_warga`
--
ALTER TABLE `laporan_warga`
  ADD CONSTRAINT `fk_laporan_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_laporan` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_laporan_masyarakat` FOREIGN KEY (`masyarakat_id`) REFERENCES `masyarakat` (`masyarakat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `fk_jenis_surat` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`jenis_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_masyarakat_id` FOREIGN KEY (`masyarakat_id`) REFERENCES `masyarakat` (`masyarakat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
