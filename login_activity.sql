-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 09:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messaging_systems`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`login_details_id`, `user_id`, `last_activity`) VALUES
(1, 1, '2020-11-16 17:50:27'),
(2, 1, '2020-11-16 18:31:52'),
(3, 1, '2020-11-16 18:32:59'),
(4, 1, '2020-11-16 18:35:06'),
(5, 1, '2020-11-16 18:37:35'),
(6, 1, '2020-11-16 18:39:50'),
(7, 1, '2020-11-16 18:46:05'),
(8, 1, '2020-11-16 18:51:11'),
(9, 2, '2020-11-16 18:53:00'),
(10, 1, '2020-11-16 18:56:18'),
(11, 1, '2020-11-16 18:58:48'),
(12, 1, '2020-11-16 19:01:27'),
(13, 1, '2020-11-16 19:07:23'),
(14, 4, '2020-11-16 19:23:48'),
(15, 1, '2020-11-16 19:26:01'),
(16, 1, '2020-11-16 21:29:27'),
(17, 1, '2020-11-16 22:03:05'),
(18, 1, '2020-11-16 22:08:48'),
(19, 1, '2020-11-16 22:24:09'),
(20, 1, '2020-11-16 23:13:32'),
(21, 1, '2020-11-16 23:14:50'),
(22, 1, '2020-11-16 23:16:25'),
(23, 1, '2020-11-16 23:30:57'),
(24, 1, '2020-11-17 00:29:35'),
(25, 1, '2020-11-17 21:24:01'),
(26, 1, '2020-11-18 17:36:53'),
(27, 1, '2020-11-27 02:01:27'),
(28, 1, '2020-11-27 02:07:07'),
(29, 1, '2020-11-27 14:57:22'),
(30, 1, '2020-11-27 14:57:33'),
(31, 1, '2020-11-27 15:11:47'),
(32, 1, '2020-11-27 16:53:37'),
(33, 2, '2020-11-27 16:57:31'),
(34, 6, '2020-11-27 17:03:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`login_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
