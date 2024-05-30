-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2024 at 09:21 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_perpustakaan`
--
CREATE DATABASE IF NOT EXISTS `si_perpustakaan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `si_perpustakaan`;

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `ID` int NOT NULL,
  `ID_ACCESS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`ID`, `ID_ACCESS`) VALUES
(1000, 'admin'),
(1013, 'pustakawan'),
(1014, 'pustakawan'),
(1015, 'pustakawan'),
(1016, 'pustakawan');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `ISBN` char(18) NOT NULL,
  `NAMA` varchar(30) DEFAULT NULL,
  `ID_PENULIS` int DEFAULT NULL,
  `PENERBIT` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `TAHUN` year DEFAULT NULL,
  `DESKRIPSI` text,
  `FOTO` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`ISBN`, `NAMA`, `ID_PENULIS`, `PENERBIT`, `TAHUN`, `DESKRIPSI`, `FOTO`) VALUES
('978-0-143-14307-5', 'The Lord of the Rings', 2005, 'Houghton Mifflin Harcourt', '1954', 'A hobbit named Frodo sets out to destroy the One Ring and defeat the Dark Lord Sauron.', NULL),
('978-0-316-06947-1', 'To Kill a Mockingbird', 2004, 'HarperCollins', '1960', 'A lawyer defends a black man accused of raping a white woman in the Deep South during the 1930s.', NULL),
('978-0-316-24867-2', 'The Silent Patient', 2012, 'Crown Publishing Group', '2019', 'A therapist tries to uncover the truth from a patient who has been silent for six years.', NULL),
('978-0-316-24868-9', 'The Girl on the Train', 2010, 'Riverhead Books', '2015', 'A woman becomes obsessed with a couple she sees from her train window and believes she witnesses a crime.', NULL),
('978-0-316-24869-6', 'All the Light We Cannot See', 2015, 'Little, Brown and Company', '2014', 'A blind girl and a boy who can see become friends and help each other survive in Nazi-occupied France.', NULL),
('978-0-316-25355-3', 'Becoming', 2018, 'Crown Publishing Group', '2018', 'A memoir by former First Lady Michelle Obama.', NULL),
('978-0-316-33261-2', 'Project Hail Mary', 2020, 'Crown Publishing Group', '2021', 'An amnesiac astronaut wakes up on a spaceship with no memory of his mission.', NULL),
('978-0-385-34927-3', 'Fifty Shades of Grey', 2008, 'Vintage Books', '2011', 'A college student enters into a relationship with a young business magnate.', NULL),
('978-0-525-61999-9', 'Circe', 2019, 'Doubleday', '2018', 'A retelling of the Greek myth of the sorceress Circe.', NULL),
('978-0-547-72578-5', 'Gone Girl', 2009, 'Crown Publishing Group', '2012', 'A man\'s wife disappears and he becomes the prime suspect in her murder.', NULL),
('978-0-593-35338-7', 'The Midnight Library', 2021, 'Scribner', '2022', 'A woman on the brink of suicide gets a chance to experience different versions of her life.', NULL),
('978-0-7432-7356-5', 'The Harry Potter Series', 2006, 'Bloomsbury Publishing', '1997', 'A young wizard named Harry Potter attends Hogwarts School of Witchcraft and Wizardry.', NULL),
('978-1-4399-7870-4', 'The Hunger Games', 2007, 'Scholastic Press', '2008', 'A young woman volunteers to take her younger sister place in a deadly televised event.', NULL),
('978-1-4399-7871-1', 'The Book Thief', 2014, 'Knopf Doubleday Publishing Group', '2005', 'A young girl living in Nazi Germany steals books and shares them with others.', NULL),
('978-1-4399-7872-8', 'Station Eleven', 2016, 'Doubleday', '2014', 'A group of survivors travel across a post-apocalyptic world after a flu pandemic kills most of humanity.', NULL),
('978-1-4516-1128-9', 'The Hate U Give', 2017, 'Balzer + Bray', '2017', 'A sixteen-year-old witness to a police shooting must testify in court.', NULL),
('978-1-59439-002-7', 'The Martian', 2003, 'Crown Publishing Group', '2011', 'An American astronaut becomes stranded on Mars after his crewmates believe him dead and leave him behind.', NULL),
('978-1-59448-287-7', 'Where the Crawdads Sing', 2011, 'Delacorte Press', '2018', 'A young woman raised in the marshes of North Carolina is accused of murder.', NULL),
('978-1-59461-038-8', 'The Handmaid\'s Tale', 2013, 'Houghton Mifflin Harcourt', '1985', 'In a dystopian future, women are forced into servitude as handmaids.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_access`
--

CREATE TABLE `master_access` (
  `ID_ACCESS` varchar(10) NOT NULL,
  `NAMA` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_access`
--

INSERT INTO `master_access` (`ID_ACCESS`, `NAMA`) VALUES
('admin', 'admin'),
('pustakawan', 'pustakawan');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `ID` int NOT NULL,
  `TANGGAL_PINJAM` datetime DEFAULT CURRENT_TIMESTAMP,
  `ISBN` char(18) DEFAULT NULL,
  `ID_PEMINJAM` int DEFAULT NULL,
  `TANGGAL_KEMBALI` datetime DEFAULT NULL,
  `STATUS` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`ID`, `TANGGAL_PINJAM`, `ISBN`, `ID_PEMINJAM`, `TANGGAL_KEMBALI`, `STATUS`) VALUES
(5010, '2024-05-19 06:31:21', '978-0-316-06947-1', 1013, '2024-06-18 06:31:21', 2),
(5012, '2024-05-19 06:34:41', '978-0-143-14307-5', 1013, '2024-06-18 06:34:41', 2),
(5013, '2024-05-19 06:44:35', '978-0-316-24867-2', 1013, '2024-06-18 06:44:35', 2),
(5026, '2024-05-19 07:15:01', '978-0-316-24868-9', 1013, '2024-06-18 07:15:01', 1),
(5027, '2024-05-19 12:46:51', '978-0-385-34927-3', 1013, '2024-06-18 12:46:51', 1),
(5028, '2024-05-19 13:30:14', '978-0-143-14307-5', 1016, '2024-06-18 13:30:14', 2),
(5029, '2024-05-19 14:44:04', '978-0-316-24867-2', 1016, '2024-06-18 14:44:04', 2),
(5037, '2024-05-19 15:55:53', '978-0-316-24868-9', 1016, '2024-06-18 15:55:53', 2);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `INSERT_PENGEMBALIAN` AFTER INSERT ON `peminjaman` FOR EACH ROW INSERT INTO pengembalian (pengembalian.ID_PINJAM, pengembalian.TENGGAT_KEMBALI) VALUES (new.ID, new.TANGGAL_KEMBALI)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `ID` int NOT NULL,
  `ID_PINJAM` int DEFAULT NULL,
  `TENGGAT_KEMBALI` datetime DEFAULT NULL,
  `TANGGAL_KEMBALI` datetime DEFAULT NULL,
  `DENDA` double DEFAULT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`ID`, `ID_PINJAM`, `TENGGAT_KEMBALI`, `TANGGAL_KEMBALI`, `DENDA`, `STATUS`) VALUES
(8, 5010, '2024-06-18 06:31:21', '2024-05-19 00:00:00', 0, 1),
(10, 5012, '2024-06-18 06:34:41', '2024-05-19 00:00:00', 0, 1),
(11, 5013, '2024-06-18 06:44:35', '2024-05-19 00:00:00', 0, 1),
(24, 5026, '2024-06-18 07:15:01', '2024-05-19 00:00:00', 0, 1),
(25, 5027, '2024-06-18 12:46:51', '2024-05-19 00:00:00', 0, 1),
(26, 5028, '2024-06-18 13:30:14', '2024-05-19 00:00:00', 0, 1),
(27, 5029, '2024-06-18 14:44:04', '2024-05-19 00:00:00', 0, 1),
(35, 5037, '2024-06-18 15:55:53', '2024-05-19 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `ID` int NOT NULL,
  `NAMA` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`ID`, `NAMA`, `EMAIL`) VALUES
(2003, 'Budi Sanjaya', 'budi@ax.com'),
(2004, 'Ayu', 'ayu@example.com'),
(2005, 'Budi', 'budi@example.com'),
(2006, 'Cici', 'cici@example.com'),
(2007, 'Dedi', 'dedi@example.com'),
(2008, 'Eka', 'eka@example.com'),
(2009, 'Fani', 'fani@example.com'),
(2010, 'Gita', 'gita@example.com'),
(2011, 'Hadi', 'hadi@example.com'),
(2012, 'Ika', 'ika@example.com'),
(2013, 'Joni', 'joni@example.com'),
(2014, 'Kiki', 'kiki@example.com'),
(2015, 'Lulu', 'lulu@example.com'),
(2016, 'Maman', 'maman@example.com'),
(2017, 'Nani', 'nani@example.com'),
(2018, 'Oki', 'oki@example.com'),
(2019, 'Putra', 'putra@example.com'),
(2020, 'Qori', 'qori@example.com'),
(2021, 'Rani', 'rani@example.com'),
(2022, 'Siska', 'siska@example.com'),
(2023, 'Tino', 'tino@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `pustakawan`
--

CREATE TABLE `pustakawan` (
  `ID` int NOT NULL,
  `NAMA` varchar(20) DEFAULT NULL,
  `ALAMAT` varchar(20) DEFAULT NULL,
  `FOTO` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pustakawan`
--

INSERT INTO `pustakawan` (`ID`, `NAMA`, `ALAMAT`, `FOTO`) VALUES
(1013, 'Adzka Fahmi', 'Palembang', NULL),
(1014, 'Aldi', 'Palembang', NULL),
(1015, 'Budi', 'Jakarta', NULL),
(1016, 'Zaki', 'Bandung', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `USERNAME` varchar(25) DEFAULT NULL,
  `PASSWORD` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(1000, 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
(1013, '123', '202cb962ac59075b964b07152d234b70'),
(1014, 'aldioke', '827ccb0eea8a706c4c34a16891f84e7b'),
(1015, 'budisantoso', '827ccb0eea8a706c4c34a16891f84e7b'),
(1016, 'zaki123', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `ACCESS` AFTER INSERT ON `user` FOR EACH ROW INSERT INTO access VALUES (new.ID, 'pustakawan')
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD KEY `ID_ACCESS` (`ID_ACCESS`),
  ADD KEY `access_ibfk_1` (`ID`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `buku_ibfk_1` (`ID_PENULIS`);

--
-- Indexes for table `master_access`
--
ALTER TABLE `master_access`
  ADD PRIMARY KEY (`ID_ACCESS`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PEMINJAM` (`ID_PEMINJAM`),
  ADD KEY `peminjaman_ibfk_2` (`ISBN`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pengembalian_ibfk_1` (`ID_PINJAM`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `pustakawan`
--
ALTER TABLE `pustakawan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5038;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024;

--
-- AUTO_INCREMENT for table `pustakawan`
--
ALTER TABLE `pustakawan`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `access_ibfk_2` FOREIGN KEY (`ID_ACCESS`) REFERENCES `master_access` (`ID_ACCESS`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`ID_PENULIS`) REFERENCES `penulis` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`ID_PEMINJAM`) REFERENCES `pustakawan` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `buku` (`ISBN`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`ID_PINJAM`) REFERENCES `peminjaman` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
