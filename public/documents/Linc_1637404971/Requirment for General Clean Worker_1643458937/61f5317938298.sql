-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2022 at 10:33 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskovro`
--

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int UNSIGNED NOT NULL,
  `country_id` int NOT NULL DEFAULT '0',
  `state_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state_status` tinyint(1) NOT NULL DEFAULT '1',
  `sequence` tinyint NOT NULL DEFAULT '0',
  `added_date` date DEFAULT NULL,
  `added_by` tinyint(1) NOT NULL DEFAULT '0',
  `updated_date` date DEFAULT NULL,
  `updated_by` tinyint(1) NOT NULL DEFAULT '0',
  `vendor_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_status`, `sequence`, `added_date`, `added_by`, `updated_date`, `updated_by`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chandigarh', 0, 0, '2021-04-13', 1, '2021-04-13', 1, 0, '2021-04-21 16:57:00', '2021-04-21 16:57:00'),
(2, 1, 'New Delhi', 0, 0, '2021-04-14', 1, '2021-04-14', 1, 0, '2022-04-21 16:57:00', '2022-04-21 16:57:00'),
(3, 1, 'Gujarat', 0, 0, '2021-04-15', 1, '2021-04-15', 1, 0, '2023-04-21 16:57:00', '2023-04-21 16:57:00'),
(4, 1, 'Karnataka', 0, 0, '2021-04-16', 1, '2021-04-16', 1, 0, '2024-04-21 16:57:00', '2024-04-21 16:57:00'),
(5, 1, 'Maharashtra', 0, 0, '2021-04-17', 1, '2021-04-17', 1, 0, '2025-04-21 16:57:00', '2025-04-21 16:57:00'),
(6, 1, 'Rajasthan', 0, 0, '2021-04-18', 1, '2021-04-18', 1, 0, '2026-04-21 16:57:00', '2026-04-21 16:57:00'),
(7, 1, 'Tamil Nadu', 0, 0, '2021-04-19', 1, '2021-04-19', 1, 0, '2027-04-21 16:57:00', '2027-04-21 16:57:00'),
(8, 1, 'Telangana', 0, 0, '2021-04-20', 1, '2021-04-20', 1, 0, '2028-04-21 16:57:00', '2028-04-21 16:57:00'),
(9, 1, 'West Bengal', 0, 0, '2021-04-21', 1, '2021-04-21', 1, 0, '2029-04-21 16:57:00', '2029-04-21 16:57:00'),
(10, 0, 'Maharastra', 1, 1, NULL, 0, NULL, 0, 0, '2021-05-07 13:12:24', '2021-05-07 13:12:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD UNIQUE KEY `state_name` (`state_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
