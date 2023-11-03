-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2021 at 01:00 PM
-- Server version: 8.0.25-0ubuntu0.20.04.1
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
-- Database: `goi`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka_name` int DEFAULT NULL,
  `district_name` int DEFAULT NULL,
  `state` int DEFAULT NULL,
  `pincode` int DEFAULT NULL,
  `preferred_lang` int DEFAULT NULL,
  `favourite_schemes_list` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `newuser` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `village_name`, `taluka_name`, `district_name`, `state`, `pincode`, `preferred_lang`, `favourite_schemes_list`, `photo`, `otp`, `verified`, `newuser`, `created_at`, `updated_at`, `deleted_at`) VALUES
(263, 'Yogesh', '', 'male', 'ynirmal2@gmail.com', '918898750624', 'Vile parle', 19, 5, 5, 400056, 5, NULL, '', 2012, 1, 0, '2021-06-05 12:22:07', '2021-06-08 06:42:58', '2021-06-08 06:42:58'),
(279, 'Chandrashekhar', 'Chaudhari', 'male', 'shekhar_chaudhari@hotmail.com', '919220001496', '', 23, 6, 5, 404004, 5, NULL, '', 7326, 1, 0, '2021-06-07 07:01:30', '2021-06-07 17:13:50', '2021-06-07 17:13:50'),
(281, 'a', 'G', 'F', 'a@gmail.com', '09999999999', 'P', 16, 3, 5, 6989, 3, NULL, '', NULL, NULL, NULL, '2021-06-08 06:44:17', '2021-06-08 06:44:30', '2021-06-08 06:44:30'),
(283, '', '', NULL, NULL, '918928230587', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8659, 1, 0, '2021-06-09 01:30:14', NULL, NULL),
(284, '', '', NULL, NULL, '918169902822', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1521, 1, 0, '2021-06-09 03:35:33', NULL, NULL),
(302, 'Sharayu', 'cmai', 'male', '', '917264095636', 'Kamp', 16, 3, 5, 441001, 5, NULL, NULL, 3845, 1, 0, '2021-06-10 06:21:17', NULL, NULL),
(303, NULL, NULL, NULL, NULL, '918652841510', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1480, 1, 0, '2021-06-10 06:25:24', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_preferred_lang_9db7c6f7` (`preferred_lang`),
  ADD KEY `users_state_6dd6b3dc` (`state`),
  ADD KEY `users_taluka_name_76f24cb5` (`taluka_name`),
  ADD KEY `users_district_name_27bea623` (`district_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_district_name_27bea623_fk_district_district_id` FOREIGN KEY (`district_name`) REFERENCES `district` (`district_id`),
  ADD CONSTRAINT `users_preferred_lang_9db7c6f7_fk_language_id` FOREIGN KEY (`preferred_lang`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `users_state_6dd6b3dc_fk_state_state_id` FOREIGN KEY (`state`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `users_taluka_name_76f24cb5_fk_cities_cities_id` FOREIGN KEY (`taluka_name`) REFERENCES `cities` (`cities_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
