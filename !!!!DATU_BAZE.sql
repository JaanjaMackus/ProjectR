-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2019 at 12:26 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodata`
--

-- --------------------------------------------------------

--
-- Table structure for table `konts`
--

CREATE TABLE `konts` (
  `ID_Konts` int(11) NOT NULL,
  `Vards` varchar(20) COLLATE utf8_latvian_ci NOT NULL,
  `Uzvards` varchar(20) COLLATE utf8_latvian_ci NOT NULL,
  `E_Pasts` varchar(60) COLLATE utf8_latvian_ci NOT NULL,
  `Parole` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `Tiesibas` bit(1) DEFAULT NULL,
  `Piezimes` varchar(255) COLLATE utf8_latvian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `konts`
--

INSERT INTO `konts` (`ID_Konts`, `Vards`, `Uzvards`, `E_Pasts`, `Parole`, `Tiesibas`, `Piezimes`) VALUES
(1, 'Janis', 'Mackus', 'Mackus@inbox.lv', 'Kartupelis12', NULL, NULL),
(2, 'Peteris', 'Cirksis', 'peteris@te.te', '$2y$10$Vm1yxIXfnrixRLIoJywuGuaQvAFo4HsbMj2kGD6Qnu3oO35N1vCdG', b'1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konts`
--
ALTER TABLE `konts`
  ADD PRIMARY KEY (`ID_Konts`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konts`
--
ALTER TABLE `konts`
  MODIFY `ID_Konts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
