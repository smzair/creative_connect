-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2022 at 12:56 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'create Lots & Wrcs', 'web', '2021-01-25 02:26:13', '2021-01-25 02:26:13'),
(3, 'Raise GRN', 'web', '2021-01-25 02:26:45', '2021-01-25 02:26:45'),
(4, 'Upload SKU\'s', 'web', '2021-01-25 02:27:04', '2021-01-25 02:27:04'),
(5, 'CS/BG/MA', 'web', '2021-01-25 02:30:04', '2021-01-25 02:30:04'),
(6, 'Submissions', 'web', '2021-01-25 02:30:37', '2021-01-25 02:30:37'),
(7, 'Raw Images', 'web', '2021-01-25 02:32:35', '2021-01-25 02:32:35'),
(8, 'Allocation', 'web', '2021-01-25 02:32:56', '2021-01-25 02:32:56'),
(9, 'Edit Images', 'web', '2021-01-25 02:33:10', '2021-01-25 02:33:10'),
(10, 'All Images', 'web', '2021-01-25 02:33:48', '2021-01-25 02:33:48'),
(11, 'Comments', 'web', '2021-01-25 02:33:57', '2021-01-25 02:33:57'),
(12, 'Approval/Rework/Reject', 'web', '2021-01-25 02:34:49', '2021-01-25 02:34:49'),
(13, 'View Lot\'s & Wrc\'s', 'web', '2021-01-25 02:35:39', '2021-01-25 02:35:39'),
(14, 'Quality Check', 'web', '2021-01-25 02:36:45', '2021-01-25 02:36:45'),
(15, 'Create & Edit Clients', 'web', '2021-01-25 02:40:00', '2021-01-25 02:40:00'),
(16, 'Logs', 'web', '2021-01-25 02:40:35', '2021-01-25 02:40:35'),
(17, 'Create, Edit, Delete All Users', 'web', '2021-01-25 02:41:22', '2021-01-25 02:41:22'),
(18, 'Edit Lot\'s & Wrc\'s', 'web', '2021-01-25 02:42:22', '2021-01-25 02:42:22'),
(19, 'Payments', 'web', '2021-01-25 03:00:03', '2021-01-25 03:00:03'),
(20, 'Everything', 'web', '2021-01-25 03:00:46', '2021-01-25 03:00:46'),
(21, 'View Only', 'web', '2021-01-25 03:07:42', '2021-01-25 03:07:42'),
(22, 'Read only', 'web', '2021-01-25 03:08:27', '2021-01-25 03:08:27'),
(25, 'Upload Raw images', 'web', '2021-01-28 06:26:03', '2021-01-28 06:26:03'),
(26, 'Payments1', 'web', '2021-07-09 00:46:58', '2021-07-09 00:46:58'),
(27, 'Report', 'web', '2021-08-25 04:19:28', '2021-08-25 04:19:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
