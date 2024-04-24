-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 12:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery_album`
--

CREATE TABLE `gallery_album` (
  `AlbumID` int(11) NOT NULL,
  `NamaAlbum` varchar(255) NOT NULL,
  `Deskripsi` text DEFAULT NULL,
  `TanggalDibuat` date NOT NULL,
  `UserID` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_album`
--

INSERT INTO `gallery_album` (`AlbumID`, `NamaAlbum`, `Deskripsi`, `TanggalDibuat`, `UserID`) VALUES
(10, 'Binatang', 'Hewan', '2024-03-17', 2),
(11, 'animasi', 'animasion', '2024-03-19', 2),
(12, 'masakan', 'ini tentang makanan', '2024-03-19', 5),
(14, 'pemandangan', 'scc', '2024-04-22', 2),
(16, 'petualangan', 'd', '2024-04-22', 7),
(17, 'makanan2', 'ini', '2024-04-22', 7);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_foto`
--

CREATE TABLE `gallery_foto` (
  `FotoID` int(11) NOT NULL,
  `JudulFoto` varchar(255) NOT NULL,
  `DeskripsiFoto` text DEFAULT NULL,
  `Tanggal` date NOT NULL,
  `NamaFile` varchar(50) NOT NULL,
  `AlbumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_foto`
--

INSERT INTO `gallery_foto` (`FotoID`, `JudulFoto`, `DeskripsiFoto`, `Tanggal`, `NamaFile`, `AlbumID`, `UserID`) VALUES
(23, 'kucing 2', 'ini', '2024-03-19', '7b4c6d9638dd629705791d4f9cbe597b.jpg', 10, 2),
(25, 'domba', 'ini domba', '2024-03-19', '9d5fe3b1895b54faad759cc08edd8646.jpg', 10, 2),
(28, 'bakwan', 'bala bala', '2024-03-19', '493897c94403fe5fc2a7aa8de9dbecd9.jpg', 12, 5),
(29, 'dadan', '12455', '2024-04-22', 'Screenshot 2024-01-27 110225.png', 16, 7),
(30, 'sfsfs', 'sfsf', '2024-04-22', 'Screenshot 2024-04-17 095853.png', 17, 7),
(31, 'dad', 'adad', '2024-04-22', 'Screenshot 2024-01-24 152635.png', 17, 7);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_komentarfoto`
--

CREATE TABLE `gallery_komentarfoto` (
  `KomentarID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IsiKomentar` text NOT NULL,
  `TanggalKomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_komentarfoto`
--

INSERT INTO `gallery_komentarfoto` (`KomentarID`, `FotoID`, `UserID`, `IsiKomentar`, `TanggalKomentar`) VALUES
(6, 28, 5, 'enak', '2024-03-19'),
(12, 25, 2, 'hi', '2024-04-17'),
(16, 29, 7, 'hi', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_likefoto`
--

CREATE TABLE `gallery_likefoto` (
  `LikelD` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TanggalLike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_likefoto`
--

INSERT INTO `gallery_likefoto` (`LikelD`, `FotoID`, `UserID`, `TanggalLike`) VALUES
(17, 28, 5, '2024-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_user`
--

CREATE TABLE `gallery_user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `Role` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_user`
--

INSERT INTO `gallery_user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `Role`) VALUES
(1, 'sani', 'b82ef4c44602c1146244738d9d768dcd', 'padil@gmail.com', 'padilgantenk', 'juahpisan', 'User'),
(2, 'user', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@gmail.com', 'ddn', 'dgfhg', 'User'),
(3, 'dadan', '827ccb0eea8a706c4c34a16891f84e7b', 'dadanjatnika@gmail.com', 'dadan jatnika', 'cpd', 'Admin'),
(4, 'sintia', '827ccb0eea8a706c4c34a16891f84e7b', 'sintia@gmail.com', 'Sintia Ajah', 'barka', 'User'),
(5, 'jatnika', '827ccb0eea8a706c4c34a16891f84e7b', 'kasir2@gmail.com', 'kasir2', 'cisarua', 'User'),
(6, 'frhan', '827ccb0eea8a706c4c34a16891f84e7b', 'satria@gmail.com', 'farhan', 'citsesp', 'User'),
(7, 'yanti', '827ccb0eea8a706c4c34a16891f84e7b', 'rahmaitunisa@gmail.com', 'yanti', 'jambudipa', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD PRIMARY KEY (`FotoID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD PRIMARY KEY (`KomentarID`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD PRIMARY KEY (`LikelD`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_user`
--
ALTER TABLE `gallery_user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  MODIFY `FotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  MODIFY `LikelD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `gallery_user`
--
ALTER TABLE `gallery_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD CONSTRAINT `gallery_album_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Constraints for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD CONSTRAINT `gallery_foto_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `gallery_album` (`AlbumID`),
  ADD CONSTRAINT `gallery_foto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Constraints for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`),
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Constraints for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD CONSTRAINT `gallery_likefoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `gallery_likefoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
