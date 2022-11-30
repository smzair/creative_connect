-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 30, 2022 at 07:59 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Google', 'GO', '2021-02-19 07:36:29', '2021-02-19 07:36:29'),
(2, 'Facebook', 'FB', '2021-02-19 07:36:40', '2021-02-19 07:36:40'),
(3, 'levis', 'LV', '2021-02-19 07:37:03', '2021-02-19 07:37:03'),
(4, 'Mnz', 'MN', '2021-02-21 05:57:35', '2021-02-21 05:57:35'),
(5, 'Odn', 'ON', '2021-02-22 03:46:58', '2021-02-22 03:46:58'),
(6, 'Pepe', 'PE', '2021-02-22 03:47:05', '2021-02-22 03:47:05'),
(8, 'Nike', 'NK', '2021-02-22 03:47:34', '2021-02-22 03:47:34'),
(9, 'Titan', 'TI', '2021-02-22 03:47:44', '2021-02-22 03:47:44'),
(10, 'bata', 'BA', '2021-02-22 03:47:47', '2021-02-22 03:47:47'),
(11, 'TATA', 'TA', '2021-02-22 03:47:56', '2021-02-22 03:47:56'),
(14, 'Twitter', 'Tw', '2021-02-26 08:08:03', '2021-02-26 08:08:03'),
(15, 'BLUE', 'BU', '2021-03-01 04:51:23', '2021-03-01 04:51:23'),
(16, 'Demo', 'DM', '2021-07-09 00:50:58', '2021-07-09 00:50:58'),
(18, 'sahil', 'SHA', '2021-08-09 05:37:12', '2021-08-09 05:37:12'),
(19, 'OpenDN', 'opdn', '2021-08-25 01:43:00', '2021-08-25 01:43:00'),
(20, 'Connect', 'hmhkh', '2021-11-23 05:03:03', '2021-11-23 05:03:03'),
(21, 'helliouji', 'wadjh', '2021-11-25 01:53:05', '2021-11-25 01:53:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
