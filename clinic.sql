-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 05:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `d_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `medical_history` text NOT NULL,
  `notes` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `p_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`d_id`, `p_name`, `age`, `phone`, `gender`, `medical_history`, `notes`, `reg_date`, `p_image`) VALUES
(1, 'sami', 23, '112233445', 'ذكر', '10:22', 'مرض', '2025-12-27 19:00:47', ''),
(5, 'shahed', 20, '11111111', 'أنثى', '11:12', 'فرغه', '2025-12-27 19:08:17', ''),
(7, 'سلا', 23, '1122333333', 'أنثى', '11', 'ننننننننننننننننننننننننننننن', '2026-01-05 18:47:32', '1767638852_doctors.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `d_image` varchar(255) NOT NULL,
  `d_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `d_name`, `spec_id`, `phone`, `d_image`, `d_description`) VALUES
(1, 'Ali', 0, '777788888', '', ''),
(2, 'Ahmed', 0, '778899006', '', ''),
(5, 'Sarah', 0, '776655551', '', ''),
(6, 'Osama', 0, '771122334', '', ''),
(7, 'Elyas', 0, '111122233', '', ''),
(8, 'سسسسس', 0, '12234567', '', ''),
(9, 'عليا', 2, '33333322222', '1767641105_doctors.jpeg', 'طبيب'),
(10, 'عليا', 2, '33333322222', '1767641118_doctors.jpeg', 'طبيب');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `p_id` int(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `med_history` text NOT NULL,
  `complaint` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `p_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`p_id`, `p_name`, `phone`, `age`, `gender`, `med_history`, `complaint`, `created_at`, `p_image`) VALUES
(1, 'ali', '45678', 26, 'Male', '', '', '0000-00-00 00:00:00', ''),
(2, 'ahmed', '1232321', 22, 'Male', '', '', '0000-00-00 00:00:00', ''),
(3, 'sara', '22333444', 13, 'Female', '', '', '0000-00-00 00:00:00', ''),
(9, 'salah', '23456789', 19, 'Male', '', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `spec_id` int(11) NOT NULL,
  `spec_name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`spec_id`, `spec_name`, `description`) VALUES
(1, 'دكتور اسنان', ''),
(2, 'قلب', ''),
(3, 'اطفال', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `CURRENT_TIMESTAMP` (`reg_date`),
  ADD UNIQUE KEY `Foreign` (`d_id`),
  ADD KEY `p_id` (`p_name`,`age`),
  ADD KEY `p_id_2` (`p_name`,`age`),
  ADD KEY `p_id_3` (`p_name`,`age`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `p_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
