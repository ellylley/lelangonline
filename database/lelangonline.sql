-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2024 pada 02.59
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lelangonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id`, `id_user`, `activity`, `timestamp`) VALUES
(110, 1, 'Mengakses halaman user', '2024-11-13 12:47:51'),
(111, 1, 'Mengakses halaman dashboard', '2024-11-13 12:49:09'),
(112, 1, 'Mengakses halaman user', '2024-11-13 12:49:14'),
(113, 1, 'Mengakses halaman user', '2024-11-13 12:49:56'),
(114, 1, 'Menambah user', '2024-11-13 12:50:08'),
(115, 1, 'Mengakses halaman user', '2024-11-13 12:50:09'),
(116, 1, 'Mengubah data user', '2024-11-13 12:50:15'),
(117, 1, 'Mengakses halaman user', '2024-11-13 12:50:16'),
(118, 1, 'Mengakses halaman barang', '2024-11-13 12:50:25'),
(119, 1, 'Mengakses halaman barang', '2024-11-13 12:50:41'),
(120, 1, 'Menambah data barang', '2024-11-13 12:51:06'),
(121, 1, 'Mengakses halaman barang', '2024-11-13 12:51:06'),
(122, 1, 'Menambah data barang', '2024-11-13 12:51:24'),
(123, 1, 'Mengakses halaman barang', '2024-11-13 12:51:25'),
(124, 1, 'Mengubah data barang', '2024-11-13 12:51:35'),
(125, 1, 'Mengakses halaman barang', '2024-11-13 12:51:36'),
(126, 1, 'Mengakses halaman barang lelang', '2024-11-13 12:51:46'),
(127, 1, 'Menambah data barang lelang', '2024-11-13 12:51:52'),
(128, 1, 'Mengakses halaman barang lelang', '2024-11-13 12:51:53'),
(129, 1, 'Menambah data barang lelang', '2024-11-13 12:52:03'),
(130, 1, 'Mengakses halaman barang lelang', '2024-11-13 12:52:03'),
(131, 1, 'Mengakses halaman history lelang', '2024-11-13 12:52:08'),
(132, 1, 'Mengakses halaman history lelang', '2024-11-13 12:52:20'),
(133, 1, 'Mengakses halaman laporan', '2024-11-13 12:52:27'),
(134, 1, 'Mengakses halaman laporan', '2024-11-13 12:52:44'),
(135, 1, 'Mengakses halaman setting', '2024-11-13 12:52:49'),
(136, 1, 'Mengakses halaman log aktivitas', '2024-11-13 12:52:53'),
(137, 1, 'Mengakses halaman restore user', '2024-11-13 12:52:59'),
(138, 1, 'Mengakses halaman restore barang', '2024-11-13 12:53:05'),
(139, 1, 'Mengakses halaman restore barang lelang', '2024-11-13 12:53:09'),
(140, 1, 'Mengakses halaman restore barang lelang', '2024-11-13 12:53:28'),
(141, 3, 'Mengakses halaman dashboard', '2024-11-13 12:53:47'),
(142, 3, 'Mengakses halaman lelang', '2024-11-13 12:53:52'),
(143, 2, 'Mengakses halaman dashboard', '2024-11-13 12:54:14'),
(144, 2, 'Mengakses halaman barang', '2024-11-13 12:54:17'),
(145, 2, 'Mengakses halaman barang lelang', '2024-11-13 12:54:23'),
(146, 2, 'Menambah data barang lelang', '2024-11-13 12:54:39'),
(147, 2, 'Mengakses halaman barang lelang', '2024-11-13 12:54:39'),
(148, 2, 'Mengakses halaman history lelang', '2024-11-13 12:55:09'),
(149, 2, 'Mengakses halaman laporan', '2024-11-13 12:55:12'),
(150, 2, 'Mengakses halaman barang lelang', '2024-11-13 12:55:33'),
(151, 2, 'Mengakses halaman barang lelang', '2024-11-13 12:55:39'),
(152, 3, 'Mengakses halaman dashboard', '2024-11-13 12:56:02'),
(153, 3, 'Mengakses halaman lelang', '2024-11-13 12:56:06'),
(154, 3, 'Mengakses halaman lelang', '2024-11-13 12:56:36'),
(155, 3, 'Mengakses halaman lelang', '2024-11-13 12:56:57'),
(156, 3, 'Mengakses halaman lelang', '2024-11-13 12:58:55'),
(157, 3, 'Mengakses halaman lelang', '2024-11-13 12:59:29'),
(158, 3, 'Mengakses halaman lelang', '2024-11-13 12:59:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int(11) NOT NULL,
  `id_lelang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `penawaran_harga` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_barang`, `id_user`, `penawaran_harga`, `created_by`, `created_at`) VALUES
(14, 8, 6, 3, 400000, 3, '2024-11-13 19:56:31'),
(15, 8, 6, 3, 400000, 3, '2024-11-13 19:56:32'),
(16, 8, 6, 3, 500000, 3, '2024-11-13 19:56:47'),
(17, 8, 6, 3, 600000, 3, '2024-11-13 19:59:29'),
(18, 8, 6, 3, 700000, 3, '2024-11-13 19:59:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_web` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_web`, `logo_web`, `updated_at`, `updated_by`) VALUES
(1, 'LELANG ONLINE', '1731488937_178c8bfba00f8c4faebb.png', '2024-11-13 09:58:14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(25) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `harga_awal` int(11) DEFAULT NULL,
  `deskripsi_barang` varchar(100) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `tgl`, `harga_awal`, `deskripsi_barang`, `isdelete`, `foto`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(5, 'jam tangan rolex', '2024-11-13', 500000, 'bagus', 0, 'default.png', '2024-11-13 19:51:06', 1, NULL, NULL, NULL, NULL),
(6, 'jam tangan casio', '2024-11-13', 300000, 'bagus', 0, 'default.png', '2024-11-13 19:51:24', 1, '2024-11-13 19:51:35', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `harga_akhir` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_lelang`
--

INSERT INTO `tb_lelang` (`id_lelang`, `id_barang`, `tgl_lelang`, `harga_akhir`, `id_user`, `id_petugas`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `isdelete`) VALUES
(8, 6, '2024-11-13', 700000, 3, 2, 'Dibuka', '2024-11-13 19:54:39', 2, '2024-11-13 19:59:38', 3, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'administrator'),
(2, 'petugas'),
(3, 'masyarakat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  `id_level` int(11) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `telp`, `id_level`, `isdelete`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'admin', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '6281111', 1, 0, NULL, NULL, '2024-11-13 10:12:14', 1, '2024-11-13 03:11:35', 1),
(2, 'petugas', 'petugas', 'c4ca4238a0b923820dcc509a6f75849b', '6282222', 2, 0, NULL, NULL, '2024-11-12 23:48:50', 1, NULL, NULL),
(3, 'masyarakat', 'masyarakat', 'c4ca4238a0b923820dcc509a6f75849b', '6283333', 3, 0, '2024-11-13 10:20:51', NULL, NULL, NULL, NULL, NULL),
(4, 'tes', 'tes', NULL, 'tes', 2, 0, '2024-11-13 19:50:08', 1, '2024-11-13 19:50:15', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT untuk tabel `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
