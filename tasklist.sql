-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2021 at 10:30 AM
-- Server version: 5.6.51
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `description`, `created_at`, `status`) VALUES
(86, 38, 'Изучить JavaScript', '2021-09-17 18:07:56', 0),
(87, 38, 'Изучить Laravel', '2021-09-17 18:07:59', 0),
(88, 38, 'Изучить MySQL', '2021-09-17 18:08:02', 0),
(103, 0, 'Изучить JavaScript', '2021-09-18 06:12:04', 0),
(104, 0, 'Изучить JavaScript', '2021-09-18 06:12:44', 0),
(105, 0, 'Изучить JavaScript', '2021-09-18 06:13:10', 0),
(109, 20, 'Изучить JavaScript', '2021-09-18 07:00:48', 0),
(110, 20, 'Изучить Laravel', '2021-09-18 07:00:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES
(20, 'user1', '$2y$10$1tmOXElFRcF0wyFPCndPW.64HBH4XqlUnyL2s/ZKJ7PIJ7RUnqpe6', '2021-09-15 14:17:20'),
(38, 'user2', '$2y$10$ziLnaD8v29QAz689fxlpiO0f9UI5ahz/FXUdJN5wfQEs7cOdHNdqW', '2021-09-17 18:07:52'),
(39, 'user3', '$2y$10$W2wrfOUm3DfkrbSVyp2u0O.q5o9CnrFTcsOrMohkgDyFsEnIz8w0m', '2021-09-18 05:04:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
