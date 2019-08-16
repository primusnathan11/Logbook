-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2019 pada 08.28
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master_republika`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `id_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `email`, `password`, `nama`, `jenis_kelamin`, `no_telepon`, `id_level`) VALUES
(9, 'karyawan@smktelkom-mlg.sch.id', 'b4a9205c35e6ba1b125e9e6cf1fe281f971ff5dd', 'Primus Nathan', 'Laki-laki', '0827181289', 1),
(10, 'teknisi@smktelkom-mlg.sch.id', '1cc1fbe5c05a9ff3c58d964eb3f64291bf201f52', 'Sibromulis Nanda', 'Laki-laki', '083834590978', 2),
(11, 'manajer@smktelkom-mlg.sch.id', '33e2fc82e80b764f4316989537710b6d07593a8e', 'Budi', 'Laki-laki', '087635728167', 3),
(12, 'nathan.primus77@gmail.com', '1cc1fbe5c05a9ff3c58d964eb3f64291bf201f52', 'Primus Teknisi', 'Laki-laki', '081235280', 2),
(13, 'primus_nathan_26rpl@student.smktelkom-mlg.sch.id', 'b4a9205c35e6ba1b125e9e6cf1fe281f971ff5dd', 'Primus Karyawan', 'Laki-laki', '0873717181827', 1),
(14, 'sibromulisnandakarima@gmail.com', '1cc1fbe5c05a9ff3c58d964eb3f64291bf201f52', 'Sibro Teknisi', 'Laki-laki', '081334577675', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Karyawan'),
(2, 'Teknisi'),
(3, 'Manajer IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link_relasi` varchar(50) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `link_relasi`, `id_aplikasi`) VALUES
(1, '<i class=\"fas fa-flag\"></i>Komplain', 'Komplain/index', 1),
(2, '<i class=\"fas fa-clipboard\"></i>Laporan', 'laporan/index/', 1),
(4, '<i class=\"fas fa-home\"></i>Dashboard', 'Dashboard/index', 1),
(5, '<i class=\"fas fa-clipboard\"></i>Laporan', 'laporan_karyawan/index', 1),
(6, '<i class=\"fas fa-tasks\"></i>Tugas Anda', 'laporan_teknisi/index', 1),
(7, '<i class=\"fas fa-users\"></i>User', 'User/index', 1),
(8, '<i class=\"fas fa-boxes\"></i>Barang', 'Barang/index', 1),
(9, '<i class=\"fas fa-history\"></i> History', 'History/index', 1),
(10, '<i class=\"fas fa-history\"></i> History', 'History_karyawan/index', 1),
(11, '<i class=\"fas fa-history\"></i> History', 'History_teknisi/index', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relasi`
--

INSERT INTO `relasi` (`id_relasi`, `id_level`, `id_menu`) VALUES
(3, 3, 4),
(4, 3, 7),
(5, 3, 8),
(8, 2, 4),
(9, 2, 2),
(10, 2, 6),
(12, 1, 4),
(13, 1, 1),
(14, 1, 5),
(15, 3, 1),
(17, 3, 2),
(18, 3, 9),
(19, 1, 10),
(20, 2, 11);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `jenis_kelamin` (`jenis_kelamin`),
  ADD KEY `no_telepon` (`no_telepon`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
