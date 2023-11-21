-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2023 pada 18.52
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fullstack_uts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cerita`
--

CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL,
  `judul` varchar(1000) NOT NULL,
  `id_user_pembuat_awal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paragraf`
--

CREATE TABLE `paragraf` (
  `idparagraf` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcerita` int(11) NOT NULL,
  `isiparagraf` mediumtext NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idusers` int(11) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idusers`, `nama`, `password`, `salt`) VALUES
(160418002, 'Dwi Rangga Kusuma', 'ff81c3e9996691658ee74688aecb3f0f9908e106', '9e17d78e54'),
(160718038, 'Hendra Dami', '8b0fd0f9c652e23708a42f5ec26fe177b86d520e', '704277848b');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cerita`
--
ALTER TABLE `cerita`
  ADD PRIMARY KEY (`idcerita`),
  ADD KEY `id_user_pembuat_awal` (`id_user_pembuat_awal`);

--
-- Indeks untuk tabel `paragraf`
--
ALTER TABLE `paragraf`
  ADD PRIMARY KEY (`idparagraf`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idcerita` (`idcerita`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cerita`
--
ALTER TABLE `cerita`
  MODIFY `idcerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `paragraf`
--
ALTER TABLE `paragraf`
  MODIFY `idparagraf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160718039;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cerita`
--
ALTER TABLE `cerita`
  ADD CONSTRAINT `cerita_ibfk_1` FOREIGN KEY (`id_user_pembuat_awal`) REFERENCES `user` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `paragraf`
--
ALTER TABLE `paragraf`
  ADD CONSTRAINT `paragraf_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paragraf_ibfk_2` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
