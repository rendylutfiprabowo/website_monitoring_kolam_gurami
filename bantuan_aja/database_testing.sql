-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2024 pada 07.43
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
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_monitoring`
--

CREATE TABLE `riwayat_monitoring` (
  `kode` int(225) NOT NULL,
  `suhu` decimal(65,0) NOT NULL,
  `amonia` decimal(65,0) NOT NULL,
  `tds` decimal(65,0) NOT NULL,
  `ph` decimal(65,0) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_monitoring`
--

INSERT INTO `riwayat_monitoring` (`kode`, `suhu`, `amonia`, `tds`, `ph`, `waktu`) VALUES
(1, -127, -42, 126, 0, '2024-10-19 12:37:15'),
(2, -127, -42, 126, 0, '2024-10-19 17:37:18'),
(3, -127, -42, 126, 0, '2024-10-19 18:37:22'),
(4, -127, -42, 126, 1, '2024-10-19 19:37:25'),
(5, -127, -42, 126, 1, '2024-10-19 20:37:28'),
(6, -127, -42, 126, 1, '2024-10-19 21:37:31'),
(7, -127, -42, 126, 1, '2024-10-19 22:37:35'),
(8, -127, -42, 126, 0, '2024-10-19 23:37:38'),
(9, -127, -42, 126, 0, '2024-10-20 00:37:41'),
(10, -127, -42, 126, 1, '2024-10-20 01:37:44'),
(11, -127, -42, 126, 0, '2024-10-20 02:37:47'),
(12, -127, -42, 126, 0, '2024-10-20 03:37:50'),
(13, -127, -42, 126, 1, '2024-10-20 04:37:53'),
(14, -127, -42, 126, 1, '2024-10-20 05:37:57'),
(15, -127, -42, 126, 0, '2024-10-20 06:38:00'),
(16, -127, -42, 126, 1, '2024-10-20 07:38:03'),
(17, -127, -42, 126, 1, '2024-10-20 08:38:06'),
(18, -127, -42, 126, 0, '2024-10-20 09:38:09'),
(19, -127, -42, 126, 1, '2024-10-20 10:38:12'),
(20, -127, -42, 126, 0, '2024-10-20 11:38:16'),
(21, -127, -42, 126, 0, '2024-10-20 12:38:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `riwayat_monitoring`
--
ALTER TABLE `riwayat_monitoring`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `riwayat_monitoring`
--
ALTER TABLE `riwayat_monitoring`
  MODIFY `kode` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
