-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2019 pada 08.27
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
-- Database: `pelaporan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `status` enum('Belum Dikerjakan','Sedang Dikerjakan','Selesai Dikerjakan','Laporan Selesai') NOT NULL DEFAULT 'Belum Dikerjakan',
  `id_karyawan` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `nama_teknisi` varchar(255) DEFAULT NULL,
  `detail` text NOT NULL,
  `tgl_activity` datetime NOT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `activity`
--

INSERT INTO `activity` (`id_activity`, `id_barang`, `status`, `id_karyawan`, `id_user`, `nama_teknisi`, `detail`, `tgl_activity`, `tgl_selesai`, `keterangan`) VALUES
(254, 3, 'Laporan Selesai', 13, 13, 'Sibromulis Nanda', 'sdc', '2019-08-15 10:12:07', '2019-08-15 10:12:57', 'selesai'),
(255, 4, 'Sedang Dikerjakan', 11, 11, 'Primus Teknisi', 'zxc', '2019-08-15 10:14:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(20) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori_barang` enum('Hardware','Software','Jaringan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kategori_barang`) VALUES
(1, 'Monitor', 'Hardware'),
(2, 'Windows', 'Software'),
(3, 'Router', 'Jaringan'),
(4, 'Mouse', 'Hardware'),
(5, 'Office', 'Software');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_activity` int(20) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('Belum Dikerjakan','Sedang Dikerjakan','Selesai Dikerjakan','Laporan Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id_history`, `id_activity`, `waktu`, `status`) VALUES
(132, 254, '2019-08-15 10:12:07', 'Belum Dikerjakan'),
(133, 254, '2019-08-15 10:12:43', 'Sedang Dikerjakan'),
(134, 254, '2019-08-15 10:12:57', 'Selesai Dikerjakan'),
(135, 254, '2019-08-15 10:13:32', 'Laporan Selesai'),
(136, 255, '2019-08-15 10:14:39', 'Belum Dikerjakan'),
(137, 255, '2019-08-15 10:23:21', 'Sedang Dikerjakan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `nama_teknisi` (`nama_teknisi`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_activity` (`id_activity`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_3` FOREIGN KEY (`id_karyawan`) REFERENCES `master_republika`.`karyawan` (`id_karyawan`),
  ADD CONSTRAINT `activity_ibfk_4` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `activity_ibfk_5` FOREIGN KEY (`nama_teknisi`) REFERENCES `master_republika`.`karyawan` (`nama`);

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id_activity`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
