-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 02:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project01`
--

-- --------------------------------------------------------

--
-- Table structure for table `academies`
--

CREATE TABLE `academies` (
  `academyName` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academies`
--

INSERT INTO `academies` (`academyName`, `ID`) VALUES
('Студенти од маркетинг', 1),
('Студенти од програмирање', 2),
('Студенти од data-science', 3),
('Студенти од дизајн', 4);

-- --------------------------------------------------------

--
-- Table structure for table `form-info`
--

CREATE TABLE `form-info` (
  `name` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `studentType` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form-info`
--

INSERT INTO `form-info` (`name`, `companyName`, `email`, `tel`, `studentType`, `ID`) VALUES
('Kristijan Kacurovski', 'Kompanija', 'kristijankacurovski@gmail.com', '1213123', 'Студенти од програмирање', 129),
('Crash Kristijan', 'werwerwer', 'kristijankacurovski@gmail.com', '23423432', 'Студенти од програмирање', 130),
('Crash Ftw', 'Plafondzijata', 'kristijankacurovski@gmail.com', '5435345', 'Студенти од програмирање', 131),
('Crash Ftw', 'Kompanija', 'kristijankacurovski@gmail.com', '45345324132423', 'Студенти од програмирање', 132),
('Crash Ftw', 'Plafondzijata', 'kristijankacurovski@gmail.com', '45345324132423', 'Студенти од програмирање', 133),
('Crash Ftw', 'Kompanija', 'kristijankacurovski@gmail.com', '45345324132423', 'Студенти од програмирање', 134),
('Crash Ftw', 'Kompanija', 'kristijankacurovski@gmail.com', '5435345', 'Студенти од маркетинг', 135),
('Crash Ftw', 'fdfdfd', 'kristijankacurovski@gmail.com', '23423432', 'Студенти од маркетинг', 136),
('mator', 'matorci', 'kristijankacurovski@gmail.com', '45345324132423', 'Студенти од маркетинг', 137),
('kristijan kacurovski', 'Kompanija', 'kristijankacurovski@gmail.com', '45345324132423', 'Студенти од програмирање', 138),
('Crash Ftw', 'Kompanija', 'kristijankacurovski@gmail.com', '64666', 'Студенти од маркетинг', 139),
('Testttt', 'Test', 'TEst@test.com', '7011204545', 'Студенти од data-science', 140);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `form-info`
--
ALTER TABLE `form-info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academies`
--
ALTER TABLE `academies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form-info`
--
ALTER TABLE `form-info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
