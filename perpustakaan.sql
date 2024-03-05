-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 05 Mar 2024 pada 05.22
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `buku`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `perpus_id`, `judul`, `foto`, `penulis`, `penerbit`, `tahun_terbit`, `kategori_id`, `created_at`, `sinopsis`, `pdf`, `stok`) VALUES
(32, 1, 'Sebuah seni untuk bersikap bodo amat', 'buku.jpg', 'Mark manson', 'Harper one', 2016, 8, '2024-03-05 03:56:13', 'Belajar mengabaikan hal-hal yang tidak penting', '65e185b17693d.pdf', 2),
(33, 1, 'Filosofi Teras', 'Filsafat-teras.jpg\r\n', 'Henry Manampiring', 'Kompas Media Nusantara', 2018, 8, '2024-03-05 03:56:36', 'Filosofi Teras, diawali dengan menceritakan tentang sebuah survei kekhawatiran nasional yang semakin masif sekaligus menyajikan tentang sekilas kehidupan si penulis yang dipenuhi oleh emosi negatif yang berlebihan', '65e18a7c9d868.pdf', 9),
(34, 1, 'Tenggelamnya kapal Van Der Wijk', '65e1e016bac8d.jpg', 'Buya Hamka', 'Centrale Courant', 1939, 10, '2024-03-05 02:25:29', 'Pendekar Sutan membunuh Mamaknya (saudara laki-laki ibunya) karena masalah warisan, sehingga ia harus dihukum dengan diasingkan ke luar dari Batipuh, Minangkabau dan dipenjara di Cilacap selama 12 tahun', '65e1e016bac93.pdf', 8),
(35, 1, 'Laskar Pelangi', '65e1fa1fb4af2.jpg', 'Andrea Hirata', 'Bentang pustaka', 2005, 9, '2024-03-05 02:16:23', '  Artikel ini telah tayang di Kompas.com dengan judul \"Sinopsis Novel Laskar Pelangi, Kisah Anak Daerah Dalam Menggapai Impiannya', '65e1fa1fb4af7.pdf', 9),
(36, 1, 'Koala Kumal', '65e1fb1d5bc34.jpg', 'Raditya Dika', 'Gagas media', 2017, 8, '2024-03-05 03:42:50', 'Resensi novel Koala Kumal ini menceritakan anak muda yang bernama Raditya Dika. Dika kecil yang masih usia SD begitu sangat dimanja oleh orang tuanya, dan memiliki hobi bermain video game. Wajar kalau tidak punya teman bermain di luar rumah', '65e1fb1d5bc3a.pdf', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`, `created_at`) VALUES
(1, 'religi', '2024-02-16 06:21:19'),
(8, 'Non fiksi', '2024-03-01 07:37:39'),
(9, 'fiksi', '2024-03-01 07:40:44'),
(10, 'Drama Romantis', '2024-03-01 13:58:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koleksi_pribadi`
--

INSERT INTO `koleksi_pribadi` (`id`, `user`, `buku`, `created_at`) VALUES
(1, 49, 32, '2024-03-05 03:33:12'),
(4, 49, 33, '2024-03-05 03:50:35'),
(5, 49, 34, '2024-03-05 03:50:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user`, `buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `created_at`, `perpus_id`) VALUES
(39, 0, 32, '2024-03-04', '2024-03-04', 'Dikembalikan', '2024-03-04 04:51:54', 1),
(40, 49, 33, '2024-03-04', '2024-03-05', 'Dikembalikan', '2024-03-05 01:46:51', 1),
(41, 49, 32, '2024-03-04', '2024-03-05', 'Dikembalikan', '2024-03-05 02:09:47', 1),
(43, 49, 34, '2024-03-04', '2024-03-05', 'Dikembalikan', '2024-03-05 02:16:07', 1),
(46, 51, 32, '2024-03-04', '2024-03-06', 'Dipinjam', '2024-03-04 07:42:52', 1),
(48, 49, 36, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 03:42:41', 1),
(49, 49, 32, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:25:10', 1),
(50, 49, 34, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:16:07', 1),
(51, 49, 35, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:16:23', 1),
(52, 49, 32, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:25:10', 1),
(53, 49, 33, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:25:33', 1),
(54, 49, 34, '2024-03-05', '2024-03-07', 'Dipinjam', '2024-03-05 02:25:29', 1),
(55, 49, 32, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 02:38:56', 1),
(56, 49, 36, '2024-03-05', '2024-03-07', 'Dipinjam', '2024-03-05 03:42:50', 1),
(57, 49, 32, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 03:56:13', 1),
(58, 49, 33, '2024-03-05', '2024-03-05', 'Dikembalikan', '2024-03-05 03:56:36', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perpustakaan`
--

CREATE TABLE `perpustakaan` (
  `id` int(11) NOT NULL,
  `nama_perpus` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_tlp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perpustakaan`
--

INSERT INTO `perpustakaan` (`id`, `nama_perpus`, `alamat`, `no_tlp`, `created_at`) VALUES
(1, 'Perpustakaan Banjar', 'Depan Terminal', '0999022332', '2024-01-17 02:50:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id`, `user`, `buku`, `ulasan`, `rating`, `created_at`) VALUES
(10, 39, 33, 'best', 5, '2024-03-01 17:06:51'),
(21, 49, 34, 'mantap es', 2, '2024-03-05 02:48:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `perpus_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`, `created_at`) VALUES
(37, 1, 'adam', '$2y$10$/hgiAI5daTGwTWGNg8yd.eaI1V8w1oWJySNjawEBx2EdeBNLNwM/i', 'adam@gmail.com', 'adam', 'pintu singa\r\n', 'peminjam', '2024-02-28 01:20:59'),
(39, 1, 'kiki', '$2y$10$gelagjAFJU6t8g12D9Qpj.srLwMD1PYXxmUdkor25H1JSpB1kWCg.', 'jamal@gmail.com', 'kiki', 'bnjr\r\n', 'peminjam', '2024-02-19 02:01:47'),
(45, 1, 'petugas', '$2y$10$7b7tWefhRV3g1gsSvRyQhOtV4.6.EYU4Yw1X.m78QDPG9ylULQP/G', 'jamal@gmail.com', 'fauzi', 'beber\r\n', 'petugas', '2024-02-19 13:30:10'),
(48, 1, 'fauzi', '$2y$10$bN6uHk/usQrG8i1Ezc3dz.E.riSdzXh0k9uoG8g97bFiaHxU9oNtG', 'fauzidanar25@gmail.com', 'fauzidanarzulfikar', 'cimaragas', 'admin', '2024-02-28 05:10:20'),
(49, 1, 'peminjam', '$2y$10$T6t/48uxfqgmuNlXbvKX9ufMBUeDc4udk.8DukqQslQ7Pe9.bT0UC', 'fauzidanarz@gmail.com', 'udin', 'bebas', 'peminjam', '2024-02-29 07:31:28'),
(51, 1, 'admin', '$2y$10$D9LVjTMBZ8O8xakRT4aXl.O8Ma.uKFPfRfXCe/KrNsLwuFrGFDNLG', 'admin@gmail.com', 'admin', 'Cimaragas', 'admin', '2024-03-03 16:35:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perpustakaan`
--
ALTER TABLE `perpustakaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `perpustakaan`
--
ALTER TABLE `perpustakaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
