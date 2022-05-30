-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Apr 2022 pada 12.01
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `IdMhsw` int(11) NOT NULL,
  `Nama` varchar(150) DEFAULT NULL,
  `JenisKelamin` varchar(20) DEFAULT NULL,
  `Alamat` text DEFAULT NULL,
  `Agama` varchar(30) DEFAULT NULL,
  `NoHp` varchar(15) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`IdMhsw`, `Nama`, `JenisKelamin`, `Alamat`, `Agama`, `NoHp`, `Email`) VALUES
(2, 'Agus Firmansyah', 'Perempuan', 'Permata CImahi Blok A1 No.10', 'Islam', '0898889990009', 'Agus@gmail.com'),
(3, 'Adi Setyawan', 'Laki-laki', 'Cikalong Wetan', 'Islam', '08889922290', 'Ady@gmail.com'),
(4, 'Athifatul Khadijah Setyawan', 'Perempuan', 'Komplek Permata CImahi Blok A1 No 6', 'Islam', '089989898978', 'athifa@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`IdMhsw`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `IdMhsw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
