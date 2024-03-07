-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 07:00 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `perpus_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sinopsis` text NOT NULL,
  `pdf` varchar(225) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `perpus_id`, `judul`, `foto`, `penulis`, `penerbit`, `tahun_terbit`, `kategori_id`, `created_at`, `sinopsis`, `pdf`, `stok`) VALUES
(32, 1, 'Sebuah seni untuk bersikap bodo amat', 'buku.jpg', 'Mark manson', 'Harper one', 2016, 8, '2024-03-07 01:39:50', 'Meski judulnya terkesan nyeleneh atau tidak serius, siapa sangka bahwa ceritanya mengandung banyak hikmah yang bisa dipetik.Buku ini cocok untuk yang ingin belajar lebih menerima setiap kesulitan yang datang', 'sebuah seni untuk bersikap bodo amat.pdf', 5),
(35, 1, 'Laskar Pelangi', '65e1fa1fb4af2.jpg', 'Andrea Hirata', 'Bentang pustaka', 2005, 9, '2024-03-06 02:30:42', '  Artikel ini telah tayang di Kompas.com dengan judul \"Sinopsis Novel Laskar Pelangi, Kisah Anak Daerah Dalam Menggapai Impiannya', '65e1fa1fb4af7.pdf', 7),
(36, 1, 'Koala Kumal', 'radityadika.jpg', 'Raditya Dika', 'Gagas media', 2017, 9, '2024-03-07 01:02:05', '\"Koala Kumal\" adalah kumpulan cerita humor yang ditulis oleh Raditya Dika, seorang penulis dan komedian terkenal asal Indonesia. Buku ini mengisahkan kisah-kisah lucu dan menghibur yang diambil dari pengalaman pribadi penulis dalam menjalani kehidupan sehari-hari.  Melalui gaya bahasa yang khas dan humor yang segar, Raditya Dika membagikan berbagai cerita yang menggelitik hati pembaca. Mulai dari cerita lucu tentang percintaan, persahabatan, pekerjaan, hingga kehidupan sehari-hari, setiap cerita dalam buku ini mengundang tawa pembaca dengan cara yang unik dan menghibur.', 'Koala_Kumal.PDF', 5),
(44, 1, 'Bisnis Digital', '65e718575032c.png', 'Rosdiana Sijabat, S.E., M.Si., Ph.D', 'MEDIA SAINS INDONESIA', 2022, 9, '2024-03-06 02:14:58', 'Bisnis di Era Revolusi Industri 4.0, Inovasi Bisnis, Sumber Daya Manusia dalam Bisnis, Mengelola Keuangan Bisnis, Etika dan Tanggungjawab Sosial dalam Bisnis, Kecerdasan Buatan dalam Bisnis, Tantangan dan Peluang Bisnis Digital Era Industri 4.0, Strategi Digital Marketing, E-Commerce, Search Engine Optimization, serta bab terakhir yaitu mengenai Search Engine Marketing dan Tantangan Ekonomi Digital Indonesia', '65e7185750332.pdf', 6),
(45, 1, 'Belajar pemrograman', '65e7d151c410f.png', 'muhamad taufik dwi putra', 'widina media putra', 2023, 1, '2024-03-06 02:24:55', 'berbagai pokok bahasan dengan  mempertimbangkan tingkat kemampuan pembaca yang masih belum  memiliki pengetahuan mengenai pemrograman agar dapat lebih dimengerti  oleh masyarakat umum', '65e7d151c4112.pdf', 7),
(47, 1, 'Belajar pemrograman Web Dasar', '65e7f4ed995a1.png', 'Dendi Kurniawan', 'Yayasan Prima Agus Teknik', 2021, 1, '2024-03-06 06:45:38', 'Aplikasi web di buat dengan menggunakan tag HTML. Pada sesi BAB ini akan di bahas beberapa hal mendasar atau istilah yang berkaitan dnegan pemrograman web, sampai membuat file web beserta penulisan awal atau struktur dasar dari web tersebut yang sudah memuat Tag, element serta atribut.', '65e7f4ed995a5.pdf', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`, `created_at`) VALUES
(1, 'pemrograman', '2024-03-05 12:37:09'),
(8, 'Non fiksi', '2024-03-01 07:37:39'),
(9, 'fiksi', '2024-03-01 07:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `koleksi_pribadi`
--

INSERT INTO `koleksi_pribadi` (`id`, `user`, `buku`, `created_at`) VALUES
(7, 53, 32, '2024-03-06 00:16:26'),
(8, 53, 34, '2024-03-06 00:16:28'),
(10, 49, 45, '2024-03-06 02:17:03'),
(13, 49, 36, '2024-03-07 01:02:32'),
(14, 49, 44, '2024-03-07 01:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_peminjaman` enum('Dipinjam','Dikembalikan','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `perpus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user`, `buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `created_at`, `perpus_id`) VALUES
(65, 49, 32, '2024-03-05', '2024-03-06', 'Dikembalikan', '2024-03-05 23:45:35', 1),
(66, 49, 44, '2024-03-05', '2024-03-06', 'Dikembalikan', '2024-03-06 02:14:58', 1),
(72, 49, 45, '2024-03-06', '2024-03-06', 'Dikembalikan', '2024-03-06 02:16:04', 1),
(73, 49, 45, '2024-03-06', '2024-03-08', 'Dipinjam', '2024-03-06 02:16:09', 1),
(74, 53, 45, '2024-03-06', '2024-03-08', 'Dipinjam', '2024-03-06 02:24:55', 1),
(75, 53, 35, '2024-03-06', '2024-03-08', 'Dipinjam', '2024-03-06 02:24:57', 1),
(76, 49, 35, '2024-03-06', '2024-03-08', 'Dipinjam', '2024-03-06 02:30:42', 1),
(83, 53, 47, '2024-03-06', '2024-03-06', 'Dikembalikan', '2024-03-06 06:45:38', 1),
(85, 49, 36, '2024-03-06', '2024-03-07', 'Dikembalikan', '2024-03-07 01:01:59', 1),
(86, 49, 36, '2024-03-07', '2024-03-07', 'Dikembalikan', '2024-03-07 01:01:59', 1),
(87, 49, 36, '2024-03-07', '2024-03-09', 'Dipinjam', '2024-03-07 01:02:05', 1),
(88, 49, 32, '2024-03-07', '2024-03-07', 'Dikembalikan', '2024-03-07 01:39:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perpustakaan`
--

CREATE TABLE `perpustakaan` (
  `id` int(11) NOT NULL,
  `nama_perpus` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_tlp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perpustakaan`
--

INSERT INTO `perpustakaan` (`id`, `nama_perpus`, `alamat`, `no_tlp`, `created_at`) VALUES
(1, 'Perpustakaan Banjar', 'Depan Terminal', '0999022332', '2024-01-17 02:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id`, `user`, `buku`, `ulasan`, `rating`, `created_at`) VALUES
(23, 53, 44, 'bukunya mudah difahami', 3, '2024-03-06 00:48:35'),
(24, 49, 45, 'Buku nya sangat bermanfaat untuk saya yang sedang belajar coding', 4, '2024-03-06 02:43:22'),
(29, 49, 32, 'Dalam buku ini mengajak kita untuk bersikap lebih santai dan tak peduli terhadap hal-hal yang tidak benar-benar penting.', 3, '2024-03-07 01:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `perpus_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('admin','petugas','peminjam','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `perpus_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`, `created_at`) VALUES
(45, 1, 'petugas', '$2y$10$7b7tWefhRV3g1gsSvRyQhOtV4.6.EYU4Yw1X.m78QDPG9ylULQP/G', 'jamal@gmail.com', 'fauzi', 'beber\r\n', 'petugas', '2024-02-19 13:30:10'),
(48, 1, 'fauzi', '$2y$10$bN6uHk/usQrG8i1Ezc3dz.E.riSdzXh0k9uoG8g97bFiaHxU9oNtG', 'fauzidanar25@gmail.com', 'fauzidanarzulfikar', 'cimaragas', 'admin', '2024-02-28 05:10:20'),
(49, 1, 'danar', '$2y$10$mfQPtCFAU9P6T2vjr5hJwuQg4CT5jvl3ccwqMVIGEE.gC0b6u/Nem', 'fauzidanarz@gmail.com', 'danar', 'Banjar', 'peminjam', '2024-03-07 02:38:41'),
(51, 1, 'admin', '$2y$10$D9LVjTMBZ8O8xakRT4aXl.O8Ma.uKFPfRfXCe/KrNsLwuFrGFDNLG', 'admin@gmail.com', 'admin', 'Cimaragas', 'admin', '2024-03-03 16:35:41'),
(53, 1, 'gilang', '$2y$10$zD/B0fF2uwYh89EGkgYJAuE78ph/qiki5bHkI0kfMh0dSH4LoKyYy', 'gilang@gmail.com', 'gilang', 'Dobo', 'peminjam', '2024-03-07 02:38:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perpustakaan`
--
ALTER TABLE `perpustakaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `perpustakaan`
--
ALTER TABLE `perpustakaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
