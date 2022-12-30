-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 03:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creative_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `marketplaces`
--

CREATE TABLE `marketplaces` (
  `id` int(11) NOT NULL,
  `marketPlace_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketplaces`
--

INSERT INTO `marketplaces` (`id`, `marketPlace_name`, `link`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Myntra', '', '', '', '2022-12-30 12:11:36', '2022-12-30 12:11:36'),
(2, 'Amazon', '', '', '', '2022-12-30 12:11:36', '2022-12-30 12:11:36'),
(3, 'Flipkart', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(4, 'Shopify', '', '', '', '2022-12-30 14:38:43', '2022-12-30 12:16:01'),
(5, 'Ajio', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(6, 'Nykaa', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(7, 'Tata Cliq', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(8, 'First Cry', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(9, 'Brand Site', '', '', '', '2022-12-30 12:13:09', '2022-12-30 12:13:09'),
(10, 'Any Other Website', '', '', '', '2022-12-30 12:15:46', '2022-12-30 12:15:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marketplaces`
--
ALTER TABLE `marketplaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketPlace` (`marketPlace_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marketplaces`
--
ALTER TABLE `marketplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
