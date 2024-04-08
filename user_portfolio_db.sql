-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 05:14 AM
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
-- Database: `user_portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details_tbl`
--

CREATE TABLE `account_details_tbl` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `blk_lot` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `phase_subdivision` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `city_municipality` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_details_tbl`
--

INSERT INTO `account_details_tbl` (`id`, `lastname`, `firstname`, `email`, `password`, `blk_lot`, `street`, `phase_subdivision`, `barangay`, `city_municipality`, `province`, `country`, `contact_no`) VALUES
(1, 'qwe', 'qwe', 'qwe@gmail.com', '$2y$10$oVn0ayuWUjJfoLlCetCObOSFeu4PoLHyRc6rAKmoxNnDYsSZbWSku', 'qwe', 'qwe', 'qwe', 'qwe', 'undefined', '13', 'JP', '+639198633035');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details_tbl`
--

CREATE TABLE `contact_details_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details_tbl`
--
ALTER TABLE `account_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details_tbl`
--
ALTER TABLE `contact_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details_tbl`
--
ALTER TABLE `account_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_details_tbl`
--
ALTER TABLE `contact_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
