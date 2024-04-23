-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 02:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Password`) VALUES
(223322, 'ily123'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e'),
(0, 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `fName` varchar(256) DEFAULT NULL,
  `lName` varchar(256) DEFAULT NULL,
  `role` varchar(256) DEFAULT NULL,
  `Password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `fName`, `lName`, `role`, `Password`) VALUES
(9, 'Joery ', 'Trayfalgar', 'Lead Developer', 'huhuhu'),
(10, 'Chrisleo ', 'Despojo', 'Lead Designer', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `ID` int(11) NOT NULL,
  `engine_status` varchar(255) DEFAULT NULL,
  `filtration_status` varchar(255) DEFAULT NULL,
  `ph_level` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`ID`, `engine_status`, `filtration_status`, `ph_level`, `reason`, `date`) VALUES
(1, 'On', 'On', 7, 'test', '2024-03-07'),
(2, 'Off', 'Off', 8, 'Day is finished', '2024-03-08'),
(3, 'On', 'On', 7, 'Start of day', '2024-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `user_update`
--

CREATE TABLE `user_update` (
  `fName` varchar(256) DEFAULT NULL,
  `lName` varchar(256) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_update`
--

INSERT INTO `user_update` (`fName`, `lName`, `ID`) VALUES
('Joery ', 'Trayfalgar', 1),
('Chrisleo', 'Despojo', 2),
('Joery', 'Trayfalgar', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_update`
--
ALTER TABLE `user_update`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_update`
--
ALTER TABLE `user_update`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
