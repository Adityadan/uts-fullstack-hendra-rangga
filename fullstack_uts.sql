-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 01:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `cerita`
--

CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL,
  `judul` varchar(1000) NOT NULL,
  `id_user_pembuat_awal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cerita`
--

INSERT INTO `cerita` (`idcerita`, `judul`, `id_user_pembuat_awal`) VALUES
(1, 'cerita 1 dari user1', 1234),
(2, 'cerita 2 dari user2', 5678),
(3, 'testing judul lagi', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `paragraf`
--

CREATE TABLE `paragraf` (
  `idparagraf` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcerita` int(11) NOT NULL,
  `isiparagraf` text NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paragraf`
--

INSERT INTO `paragraf` (`idparagraf`, `iduser`, `idcerita`, `isiparagraf`, `tgl_buat`) VALUES
(1, 1234, 1, 'cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1', '2023-12-20 07:51:48'),
(2, 1234, 1, 'cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1\r\n\r\ncerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1\r\n\r\ncerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1\r\n\r\ncerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1cerita 1 dari user1\r\n\r\n', '2023-12-20 07:52:07'),
(3, 5678, 2, 'cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2cerita 2 dari user2', '2023-12-20 07:53:20'),
(4, 1234, 3, 'ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ini paragraf ', '2023-12-22 15:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idusers` int(11) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idusers`, `nama`, `password`, `salt`) VALUES
(1234, 'user1', 'bc15375d3a42e2b2a8cde3797a540fa94dbcb581', '5ae0535260'),
(5678, 'user2', '607edfd46935df77c38127255529ddea21acfd4d', 'c23b468ca1'),
(1, 'rangga', '1a51673fe8863959446113fe6ee035e80125152e', 'c36d19b475');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cerita`
--
ALTER TABLE `cerita`
  ADD PRIMARY KEY (`idcerita`),
  ADD KEY `fk_cerita_id_user_pembuat_awal` (`id_user_pembuat_awal`) USING BTREE;

--
-- Indexes for table `paragraf`
--
ALTER TABLE `paragraf`
  ADD PRIMARY KEY (`idparagraf`),
  ADD KEY `fk_paragraf_iduser` (`iduser`),
  ADD KEY `fk_paragraf_idcerita` (`idcerita`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cerita`
--
ALTER TABLE `cerita`
  MODIFY `idcerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paragraf`
--
ALTER TABLE `paragraf`
  MODIFY `idparagraf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5679;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
