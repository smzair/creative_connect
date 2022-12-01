-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2022 at 12:52 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Commercials', 'web', '2021-01-25 02:48:08', '2021-01-25 02:48:08'),
(2, 'Inwarding', 'web', '2021-01-25 02:48:42', '2021-01-25 02:48:42'),
(3, 'Account Management', 'web', '2021-01-25 02:49:52', '2021-01-25 02:49:52'),
(5, 'Admin', 'web', '2021-01-25 02:53:05', '2021-01-25 02:53:05'),
(6, 'Editor TL', 'web', '2021-01-25 02:54:06', '2021-01-25 02:54:06'),
(7, 'VQC', 'web', '2021-01-25 02:56:11', '2021-01-25 02:56:11'),
(8, 'Qc', 'web', '2021-01-25 02:58:02', '2021-01-25 02:58:02'),
(9, 'Editors', 'web', '2021-01-25 02:59:22', '2021-01-25 02:59:22'),
(11, 'Super Admin', 'web', '2021-01-25 03:02:15', '2021-01-25 03:02:15'),
(12, 'Client', 'web', '2021-01-25 03:08:53', '2021-01-25 03:08:53'),
(14, 'Studio', 'web', '2021-01-28 06:26:34', '2021-01-28 06:26:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
