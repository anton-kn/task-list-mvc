-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 16, 2021 at 10:21 PM
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
(24, 24, 'Изучить CSS', '2021-09-15 16:11:17', 0),
(25, 25, 'Изучить Laravel', '2021-09-15 16:12:44', 1),
(26, 25, 'Изучить PHP', '2021-09-15 16:12:46', 1),
(27, 25, 'Изучить MySQL', '2021-09-15 16:12:50', 1),
(39, 20, 'Изучить HTML', '2021-09-16 19:01:27', 1),
(40, 20, 'Изучить Laravel', '2021-09-16 19:01:29', 1),
(42, 20, 'Изучить JavaScript', '2021-09-16 19:15:09', 0);

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
(24, 'user2', '$2y$10$ZVXRvwFHVBI0xjDBtJ4w7ean8gNOdJNs0R.CBrkuk.8aMv37mie8K', '2021-09-15 14:30:04'),
(25, 'user3', '$2y$10$8WEIbGRpHmv/HQVi3o.DEe2Ou6czdvT4NDnCQqMKoENLKq6.UiK4C', '2021-09-15 15:42:37'),
(26, 'user4', '$2y$10$zDjHtWKOAuiJjlABng78j.N0mW39gxykiFQW7DLKhV1/fWtKxsOA.', '2021-09-15 15:44:10');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
