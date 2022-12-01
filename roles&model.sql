-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2022 at 12:50 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(11, 'App\\Models\\User', 2),
(9, 'App\\user', 2),
(3, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(11, 'App\\Models\\User', 5),
(9, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(11, 'App\\Models\\User', 10),
(9, 'App\\Models\\User', 11),
(8, 'App\\Models\\User', 12),
(7, 'App\\Models\\User', 13),
(6, 'App\\Models\\User', 14),
(14, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(6, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(12, 'App\\Models\\User', 21),
(12, 'App\\Models\\User', 22),
(12, 'App\\Models\\User', 23),
(11, 'App\\Models\\User', 24),
(12, 'App\\Models\\User', 25),
(12, 'App\\Models\\User', 26),
(12, 'App\\Models\\User', 27),
(12, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29),
(1, 'App\\Models\\User', 30),
(1, 'App\\Models\\User', 31),
(1, 'App\\Models\\User', 32),
(1, 'App\\Models\\User', 33),
(1, 'App\\Models\\User', 34),
(1, 'App\\Models\\User', 35),
(1, 'App\\Models\\User', 36),
(1, 'App\\Models\\User', 37),
(1, 'App\\Models\\User', 38),
(1, 'App\\Models\\User', 39),
(1, 'App\\Models\\User', 40),
(1, 'App\\Models\\User', 41),
(1, 'App\\Models\\User', 42),
(1, 'App\\Models\\User', 43),
(1, 'App\\Models\\User', 44),
(1, 'App\\Models\\User', 45),
(1, 'App\\Models\\User', 46),
(1, 'App\\Models\\User', 47),
(6, 'App\\Models\\User', 48),
(1, 'App\\Models\\User', 49),
(12, 'App\\Models\\User', 50),
(12, 'App\\Models\\User', 51),
(1, 'App\\Models\\User', 52),
(2, 'App\\Models\\User', 53),
(3, 'App\\Models\\User', 54),
(5, 'App\\Models\\User', 55),
(6, 'App\\Models\\User', 56),
(8, 'App\\Models\\User', 57),
(9, 'App\\Models\\User', 58),
(14, 'App\\Models\\User', 59),
(2, 'App\\Models\\User', 60),
(12, 'App\\Models\\User', 61),
(12, 'App\\Models\\User', 62),
(12, 'App\\Models\\User', 63),
(12, 'App\\Models\\User', 64),
(12, 'App\\Models\\User', 65),
(11, 'App\\Models\\User', 66),
(3, 'App\\Models\\User', 67),
(3, 'App\\Models\\User', 68),
(12, 'App\\Models\\User', 69),
(12, 'App\\Models\\User', 70),
(12, 'App\\Models\\User', 71),
(9, 'App\\Models\\User', 72),
(8, 'App\\Models\\User', 73),
(8, 'App\\Models\\User', 74),
(12, 'App\\Models\\User', 75),
(11, 'App\\Models\\User', 76),
(12, 'App\\Models\\User', 77),
(12, 'App\\Models\\User', 78);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;


-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(13, 1),
(15, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(13, 3),
(8, 5),
(10, 5),
(11, 5),
(13, 5),
(8, 6),
(10, 6),
(13, 6),
(8, 7),
(10, 7),
(13, 7),
(14, 7),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(7, 9),
(9, 9),
(2, 11),
(3, 11),
(4, 11),
(5, 11),
(6, 11),
(7, 11),
(8, 11),
(9, 11),
(10, 11),
(11, 11),
(12, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(17, 11),
(18, 11),
(19, 11),
(20, 11),
(21, 12),
(22, 12),
(7, 14),
(25, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
