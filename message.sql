-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 09:09 PM
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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message` varchar(10240) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message`, `from_user_id`, `to_user_id`, `timestamp`) VALUES
(1, 'Hello', 1, 2, '2020-11-16 18:50:53'),
(2, 'Hello\n', 2, 1, '2020-11-16 18:51:36'),
(3, 'Hi there', 1, 2, '2020-11-16 18:53:25'),
(4, 'test', 1, 2, '2020-11-16 18:54:21'),
(5, 'test again', 1, 2, '2020-11-16 18:55:29'),
(6, 'Test\n', 1, 2, '2020-11-16 18:59:09'),
(7, 'test', 4, 1, '2020-11-16 19:23:34'),
(8, 'test', 4, 1, '2020-11-16 19:23:38'),
(9, 'test2', 4, 2, '2020-11-16 19:23:50'),
(10, 'Hello\n', 1, 4, '2020-11-16 19:23:58'),
(11, 'This is a very long message. This is a very long message. This is a very long message. This is a very long message. This is a very long message. This is a very long message. This is a very long message.', 1, 2, '2020-11-18 17:27:24'),
(12, 'Testing again after changing something, hope it didnt break', 1, 2, '2020-11-27 02:06:13'),
(13, 'Hello\n', 1, 2, '2020-11-27 14:45:47'),
(14, 'Hi there', 1, 2, '2020-11-27 16:53:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
