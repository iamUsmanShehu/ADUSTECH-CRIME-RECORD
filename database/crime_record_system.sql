-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 03:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crime_record_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `case_date` date NOT NULL,
  `staff_officer` varchar(30) NOT NULL,
  `complainer_sex` varchar(6) NOT NULL,
  `complainer_name` varchar(30) NOT NULL,
  `complainer_reg` varchar(20) NOT NULL,
  `complainer_level` varchar(20) NOT NULL,
  `complainer_picture` text NOT NULL,
  `complainer_department` varchar(20) NOT NULL,
  `complainer_faculty` varchar(30) NOT NULL,
  `complainer_phone` varchar(12) NOT NULL,
  `complainer_address` text NOT NULL,
  `complainant_sex` varchar(6) NOT NULL,
  `complainant_name` varchar(30) NOT NULL,
  `compalinant_reg` varchar(20) NOT NULL,
  `complainant_level` varchar(20) NOT NULL,
  `complainant_picture` text NOT NULL,
  `complainant_department` varchar(20) NOT NULL,
  `complainant_faculty` varchar(30) NOT NULL,
  `complainant_phone` varchar(12) NOT NULL,
  `complainant_address` text NOT NULL,
  `case_type` varchar(20) NOT NULL,
  `statement` text NOT NULL,
  `status` int(1) NOT NULL,
  `case_time` varchar(20) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `case_date`, `staff_officer`, `complainer_sex`, `complainer_name`, `complainer_reg`, `complainer_level`, `complainer_picture`, `complainer_department`, `complainer_faculty`, `complainer_phone`, `complainer_address`, `complainant_sex`, `complainant_name`, `compalinant_reg`, `complainant_level`, `complainant_picture`, `complainant_department`, `complainant_faculty`, `complainant_phone`, `complainant_address`, `case_type`, `statement`, `status`, `case_time`, `account_id`) VALUES
(1, '2024-08-13', 'KUST-101', 'Female', 'Murjanatu Shuaibu', 'UG18/ICTC/1013', '300', 'murja (2).jpg', 'Comp', 'Test', '09160163113', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU JIGAWA', 'Male', 'Dalha Tsakuwa', 'UG18/ICTC/3333', '300', 'School ID.jpg', 'Comp', 'Test', '09160163113', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU JIGAWA', 'Stealing', 'Steal from ...', 0, '10:51 PM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `casetype` varchar(30) NOT NULL,
  `case_address` text NOT NULL,
  `case_description` text NOT NULL,
  `picture` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `fullname`, `email`, `gender`, `phone`, `address`, `casetype`, `case_address`, `case_description`, `picture`, `date`, `status`) VALUES
(1, 'Usman Shehu', 'iamUsmanShehu@gmail.com', 'Other', '09160163113', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU JIGAWA', 'Other', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU JIGAWA', 'ckacnjakfnaekfzdkafhkafhka', 'pic.jpg', '2024-09-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `id` varchar(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `rank` varchar(11) NOT NULL,
  `security_id` varchar(20) NOT NULL,
  `role` int(1) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `finger` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` int(1) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `department` varchar(50) NOT NULL,
  `picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `surname`, `username`, `password`, `role`, `staff_id`, `email`, `phone`, `address`, `department`, `picture`) VALUES
(1, 'Usman', 'Shehu', 'iamusman', '12345', 1, 'STAFF-001', 'iamusmanshehu@gmail.com', '09040306788', 'Block YC 5, Gida-Dubu, Dutse, Jigawa State', 'Patrol', 'pic.jpg'),
(2, 'Usman', 'Shehu', 'murjanatu', '1234', 2, '', '', '09160163113', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU KANO', '', 'murja (2).jpg'),
(4, 'Usman', 'Shehu', '', '', 0, 'KUST-101', 'iamUsmanShehu@gmail.com', '09160163113', 'YC5, HAKIMI STR MASALLACIN ,KES QTRS GIDA DUDU JIGAWA', 'Computer Science', 'pic.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
