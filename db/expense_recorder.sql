-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 11:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_recorder`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `chart_data`
-- (See below for the actual view)
--
CREATE TABLE `chart_data` (
`title` varchar(50)
,`exp_date` date
,`amount` int(11)
,`exp_type_id` int(11)
,`uid` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `curdate` date NOT NULL,
  `payee` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `exp_type_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `curdate`, `payee`, `amount`, `exp_type_id`, `uid`) VALUES
(1, '2023-03-31', 'KFC', 399, 1, 1),
(4, '2023-04-03', 'KFC', 299, 5, 2),
(5, '2023-04-04', 'Local Fucka Stall', 40, 5, 2),
(9, '2023-04-11', 'Pizza Hut (Mirpur)', 400, 5, 1),
(10, '2023-04-11', 'Local Fucka Stall', 60, 5, 1),
(12, '2023-04-11', 'Mama Chatpoti', 50, 1, 2),
(16, '2023-04-11', 'Burger King', 230, 5, 1),
(18, '2023-04-13', 'Tuition fee of Rohit', 1400, 3, 3),
(20, '2023-04-13', 'Tuition fee of Reya', 1400, 3, 3),
(22, '2023-04-13', 'Tuition Fee Reshmi', 500, 3, 3),
(23, '2023-04-13', 'Doll for Reshmi', 200, 3, 3),
(24, '2023-04-13', 'Electricity', 749, 6, 3),
(25, '2023-04-13', 'Water Bill (Wasa-03/23)', 220, 6, 3),
(26, '2023-04-13', 'Burger King', 199, 1, 2),
(29, '2023-04-13', 'Bike', 500, 2, 2),
(30, '2023-04-14', 'Electricity', 732, 4, 2),
(31, '2023-04-14', 'Burger King', 249, 1, 2),
(32, '2023-04-14', 'Local Fucka Stall', 70, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exp_type`
--

CREATE TABLE `exp_type` (
  `id` int(11) NOT NULL,
  `curdate` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exp_type`
--

INSERT INTO `exp_type` (`id`, `curdate`, `title`, `uid`) VALUES
(1, '2023-03-31', 'Food', 2),
(2, '2023-04-01', 'Fuel', 2),
(3, '2023-04-03', 'Family', 3),
(4, '2023-04-03', 'Utility', 2),
(5, '2023-04-01', 'Food', 1),
(6, '2023-04-04', 'Utility', 3),
(7, '2023-04-04', 'Fuel', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Super Admin', 'root', 'complex6459asdfagsd23565464!@#$%^&*()553'),
(2, 'Admin', 'admin', '!@#$asefas646'),
(3, 'User', 'user001', '123abc#'),
(4, 'User2', 'user002', '1234'),
(5, 'Manik Mia', 'manik', 'manik684'),
(6, 'MD Nure Alom', 'nure152791', 'A014520a*'),
(7, 'MD Ripon', 'ripon', '12345'),
(8, 'Raju Mia', 'raju45', '11223344'),
(9, 'User003', 'user003', '12345'),
(10, 'User003', 'user004', '12345'),
(11, 'User003', 'abcd', '1234'),
(12, 'MD Nure Alom', 'admin44', 'A014520a*');

-- --------------------------------------------------------

--
-- Structure for view `chart_data`
--
DROP TABLE IF EXISTS `chart_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `chart_data`  AS SELECT `exp_type`.`title` AS `title`, `expenses`.`curdate` AS `exp_date`, `expenses`.`amount` AS `amount`, `expenses`.`exp_type_id` AS `exp_type_id`, `expenses`.`uid` AS `uid` FROM (`expenses` join `exp_type`) WHERE `expenses`.`exp_type_id` = `exp_type`.`id``id`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_type`
--
ALTER TABLE `exp_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `exp_type`
--
ALTER TABLE `exp_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
