-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2017 at 03:28 PM
-- Server version: 10.0.24-MariaDB-7
-- PHP Version: 7.1.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timino`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) UNSIGNED NOT NULL COMMENT 'user identifier',
  `Email` varchar(255) NOT NULL COMMENT 'user email',
  `Passwd` varchar(255) NOT NULL COMMENT 'user password',
  `Gender` varchar(1) NOT NULL COMMENT 'gender'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Email`, `Passwd`, `Gender`) VALUES
(1, 'lotfio@gomail.com', '$2y$12$El.rNE8CxZ.Oihg.mmfTVuM7YfNJmCpn6ouu1hkB4a4SyIc7jJcnO', 'M'),
(2, 'admin@gmail.com', '$2y$12$ocTTbaMtuZBxjJfcFZRju.bzmuswd8ozzFsJ/vAu2PTqxyWQzRvAW', 'M'),
(3, 'blak_star2@hotmail.fr', '$2y$12$4cCr2olmwhJeaJtihN4qi.JGOXLBxhB7KbcxUAWzyXJFwfANlPvIe', 'M'),
(4, 'lina@gmail.com', '$2y$12$wKj4sis4Oic.84oXP2dcz.S2xonf2PTEYh83UVmmp7TjbJ8CB/ysK', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'user identifier', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
