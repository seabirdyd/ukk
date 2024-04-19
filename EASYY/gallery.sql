-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 09 Mar 2024 pada 11.20
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.10

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
-- Struktur dari tabel `gallery_album`
--

CREATE TABLE `gallery_album` (
  `AlbumID` int(11) NOT NULL,
  `NamaAlbum` varchar(255) NOT NULL,
  `Deskripsi` text DEFAULT NULL,
  `TanggalDibuat` date NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_foto`
--

CREATE TABLE `gallery_foto` (
  `FotoID` int(11) NOT NULL,
  `JudulFoto` varchar(255) NOT NULL,
  `DeskripsiFoto` text DEFAULT NULL,
  `TanggalUnggah` date NOT NULL,
  `LokasiFile` varchar(255) NOT NULL,
  `AlbumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_komentarfoto`
--

CREATE TABLE `gallery_komentarfoto` (
  `KomentarID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IsiKomentar` text NOT NULL,
  `TanggalKomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_likefoto`
--

CREATE TABLE `gallery_likefoto` (
  `LikelD` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TanggalLike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_user`
--

CREATE TABLE `gallery_user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD PRIMARY KEY (`FotoID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD PRIMARY KEY (`KomentarID`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD PRIMARY KEY (`LikelD`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `gallery_user`
--
ALTER TABLE `gallery_user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  MODIFY `FotoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  MODIFY `LikelD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_user`
--
ALTER TABLE `gallery_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD CONSTRAINT `gallery_album_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD CONSTRAINT `gallery_foto_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `gallery_album` (`AlbumID`),
  ADD CONSTRAINT `gallery_foto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`),
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD CONSTRAINT `gallery_likefoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`),
  ADD CONSTRAINT `gallery_likefoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
