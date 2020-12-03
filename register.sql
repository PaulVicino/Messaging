-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 09:10 PM
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
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `Password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `FirstName`, `LastName`, `UserName`, `email`, `Password`) VALUES
(1, 'Paul', 'Vicino', 'PaulVicino', 'p.vicino715@gmail.com', '$2y$10$qMwWtr810JX9nIaOpM5Ew.ogSpwnUizxOymlFGb2acrPqxzgAbSxa'),
(2, '', '', 'PaulAdmin', 'p.vicino715@gmail.co', '$2y$10$T/3nn06IjWKaeq9lC1wXC.8lewIE8e1BvpLricpRyCbiXNqWzF/jq'),
(3, 'TestName', 'TestName', 'TestingUser', 'p.vicino715@gmail.c', '$2y$10$nZMRBOjJWSPQ0yU.MKWndOz3I4zyIWyu.Yk5gCl3Z6bpUtotUUC5e'),
(4, 'Heath', '', 'heathm', 'heathcmilligan@gmail.com', '$2y$10$47ph2vHMzy3c34rWE2v6qOM4QYZU3/.kc9Jc7RevkadPKn101AmZy'),
(5, 'Bob', '', 'BobBuilder', 'p.vicino715@gmail.cim', '$2y$10$c.RqNjKd76KXsmkdfa36jeFaRIg540h6wNEKXxVCacR8fMq7M.nJm'),
(6, 'John', '', 'JohnSnow', 'p.vicino715@gmail.ci', '$2y$10$6Y19yLArlC1qLHyOMmbiTO8IvSDVaq1ZirEigpGmHSJ7mz2EOtLJ2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
