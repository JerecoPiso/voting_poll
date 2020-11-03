-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2020 at 02:18 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(70) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `bdate` varchar(20) DEFAULT NULL,
  `contact_no` int(12) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `hint`, `bdate`, `contact_no`, `photo`) VALUES
(15, 'Jereco James Piso', '$2y$10$LVZ6wb9uaDIthJ0UpfYc.uhl6VxnicXA8.A1qPN1.Y6ytM8NNXz9u', 'dfsdf', 'July 18, 1999', 2147483647, 'Screenshot_from_2019-12-09_11-11-21.png'),
(16, 'jj', '$2y$10$c9xpGM3io9SSUrj.8lSVLujTOfaSOxHUn78/nbdl4UF/jcO/N/eWm', 'hahaha', 'gdfg', 345, 'Screenshot_from_2019-12-09_11-11-213.png');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position_id` varchar(100) NOT NULL,
  `votes` int(100) NOT NULL,
  `poll_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `position_id`, `votes`, `poll_id`) VALUES
(87, '657', 'President', 0, 16),
(89, 'rt', '12', 1, 16),
(94, 'dsfsdf', '18', 11, 16),
(95, 'jj', '21', 0, 17),
(99, 'dasd', '15', 25, 16),
(109, 'sdf', '14', 1, 12),
(125, 'gdfg', '12', 1, 12),
(126, 'dfsdf', '12', 0, 12),
(127, 'dfgdfg', '14', 0, 12),
(133, 'Digong', '23', 3, 36),
(134, 'sdfsdfsd', '23', 0, 36),
(135, 'sdfsdf', '24', 1, 36),
(136, 'sdfsdf', '25', 0, 36),
(137, 'sdfsdfsdf', '26', 3, 36),
(138, 'sdfsdf', '26', 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `poll_name` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `poll_name`, `status`) VALUES
(36, 'CLASS ROOM OFFICER', 'used'),
(37, 'SSG', 'unused');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `winner` int(10) NOT NULL,
  `poll_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`, `winner`, `poll_id`) VALUES
(12, 'President', 1, 12),
(13, 'Vice-President', 1, 12),
(14, 'Secretary', 1, 12),
(15, 'Treasurer', 1, 16),
(18, 'President', 1, 16),
(19, 'Secretary', 1, 16),
(20, 'President', 1, 0),
(21, 'President', 1, 17),
(23, 'President', 1, 36),
(24, 'Vice-President', 1, 36),
(25, 'Secretary', 1, 36),
(26, 'Treasurer', 1, 36),
(27, 'sdfsdf', 4, 37);

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `id` int(11) NOT NULL,
  `voters_id` int(100) NOT NULL,
  `poll_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `username`, `password`) VALUES
(9, 'Jereco James Piso', '$2y$10$Vml3hjBsbVuaMMPuCNpC7uPEQ0SBYYAMnIHWIClIXLm6Fau8a0lUe'),
(10, 'jdfjhsdgfjhfgjhdfgfdgdfgdfgdfg', '$2y$10$AL8W2/cJwILzRyCMUrn1L.sOBsMRv33wpHvIEvYVfL507Qy3be0FC'),
(11, 'fghfghfghfghfgh', '$2y$10$hPugPAoosA4ecnaydoNfcunT1ntLs4Z0xVdx6DvQfploINaSFaoqi'),
(12, 'dfghdhjghjghj', '$2y$10$w/1y19o3zxfn/X.T/amTfuIl0jXdyTu0/SFPZgtOqxs6oJ5W0DuWy'),
(13, 'DGHJGHJGHJGHJGHJ', '$2y$10$TjOEfOq5CrxBiqyrzKq28OaxSdTt94fn0Ich62dxNls.xIFGbo4Va'),
(14, 'fghfghfghfgh', '$2y$10$bdLKR6mRvEPVnTbXfQBwH.MGOR/QEOnyjF17V8K/RqEwjzezWn9by'),
(15, 'sdasdsadasd', '$2y$10$xC6cJEtsBVv3KDmxbzxjkuBdamaFoNLrORpoPTX/0AtJhYRYrMcu6'),
(16, 'jjjjjjjj', '$2y$10$K6xP3BXtNlzx4FUqrktLQeYYIybaBSc8HQnj43kabyK6pXrhgFEli'),
(17, 'aaaaaaaa', '$2y$10$gIuIMVsFwlBpfEw.niK8d.PxZ1q0ypmSx0LEQ6G4Cpvb0.HmEvLcu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voted`
--
ALTER TABLE `voted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `voted`
--
ALTER TABLE `voted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
