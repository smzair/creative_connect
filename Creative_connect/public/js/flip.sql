-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 15, 2022 at 08:55 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `flipkart_editing`
--

CREATE TABLE `flipkart_editing` (
  `id` int(10) UNSIGNED NOT NULL,
  `lot_id` int(11) NOT NULL,
  `wrc_id` int(11) NOT NULL,
  `imageCount` int(11) NOT NULL,
  `recivedFilename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sentFilename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flipkart_editing`
--

INSERT INTO `flipkart_editing` (`id`, `lot_id`, `wrc_id`, `imageCount`, `recivedFilename`, `remarks`, `sentFilename`, `created_at`, `updated_at`) VALUES
(21, 137, 156, 900, 'Archive_628cb1ab4713f.zip', 'TGIF', '', '2022-05-24 04:51:31', '2022-05-24 04:51:31'),
(22, 137, 156, 900, 'Archive_628cb30a4d50b.zip', 'TGIF', 'Archive_6294ba7532d7b.zip', '2022-05-24 04:57:22', '2022-05-24 04:57:22'),
(23, 142, 163, 900, 'Archive_628cb3fde239d.zip', 'TGIF', 'Archive_6294bc2a08842.zip', '2022-05-24 05:01:25', '2022-05-30 07:14:28'),
(24, 142, 163, 700, 'Archive_628cb66e06989.zip', 'TGIF', 'Archive_6294bbd15a78f.zip', '2022-05-24 05:11:50', '2022-05-30 07:12:59'),
(25, 142, 163, 900, 'Archive_628cb73678c01.zip', 'ghere', 'Archive_6294ba7532d7b.zip', '2022-05-24 05:15:10', '2022-05-30 07:07:11'),
(26, 142, 163, 900, 'Archive_628cb811b2bca.zip', 'ghere', 'Archive_6294ba7532d7b.ZIP', '2022-05-24 05:18:49', '2022-05-24 05:18:49'),
(27, 142, 164, 900, 'Archive_628cb89a08b57.zip', 'ghere', NULL, '2022-05-24 05:21:06', '2022-05-24 05:21:06'),
(28, 142, 164, 900, 'Archive_628cd92c01982.zip', 'There', 'Archive_6294bb69c0874.zip', '2022-05-24 07:40:04', '2022-05-30 07:11:19'),
(29, 143, 166, 900, 'Archive_629843071583f.zip', 'This about uploading', 'Archive_6298bf05b669d.zip', '2022-06-01 23:26:39', '2022-06-02 08:15:44'),
(30, 143, 166, 800, 'Archive_629843dd9992c.zip', 'this is upload 2', NULL, '2022-06-01 23:30:13', '2022-06-01 23:30:13'),
(31, 143, 166, 900, 'Archive_62988f7f0cc7d.zip', 'Dssdfd', NULL, '2022-06-02 04:52:55', '2022-06-02 04:52:55'),
(32, 143, 166, 900, 'Archive_6298902cb8fbf.zip', 'Dssdfd', NULL, '2022-06-02 04:55:48', '2022-06-02 04:55:48'),
(33, 143, 166, 900, 'Archive_6298a2125ed86.zip', 'fg', NULL, '2022-06-02 06:12:10', '2022-06-02 06:12:10'),
(34, 143, 166, 900, 'Archive_6298a28ed0d43.zip', 'hg', NULL, '2022-06-02 06:14:14', '2022-06-02 06:14:14'),
(35, 143, 166, 900, 'Blog_6298a2d070e8b.jpg', 'hj', NULL, '2022-06-02 06:15:20', '2022-06-02 06:15:20'),
(36, 143, 166, 900, 'Archive_6298a30014c1b.zip', 'sfsfvc', NULL, '2022-06-02 06:16:08', '2022-06-02 06:16:08'),
(37, 143, 166, 900, 'Archive_6298a58a1abc1.zip', 'thrjebr', NULL, '2022-06-02 06:26:58', '2022-06-02 06:26:58'),
(38, 143, 166, 900, 'Archive_6298b10173a36.zip', 'dfjndv dsf', NULL, '2022-06-02 07:15:53', '2022-06-02 07:15:53'),
(39, 143, 166, 900, 'Archive_6298b132af265.zip', 'thewj sdf', NULL, '2022-06-02 07:16:42', '2022-06-02 07:16:42'),
(40, 143, 166, 900, 'Archive_6298b332518a8.zip', 'dsc', NULL, '2022-06-02 07:25:14', '2022-06-02 07:25:14'),
(41, 143, 166, 900, 'Archive_6298b45572b0d.zip', 'dsf sdaf', NULL, '2022-06-02 07:30:05', '2022-06-02 07:30:05'),
(42, 143, 166, 900, 'Archive_6298b4faef5ad.zip', 'dsfasd', NULL, '2022-06-02 07:32:50', '2022-06-02 07:32:50'),
(43, 143, 166, 900, 'Archive_6298b56e6b28e.zip', 'hello', NULL, '2022-06-02 07:34:46', '2022-06-02 07:34:46'),
(44, 143, 166, 900, 'Archive_6298b76466de2.zip', 'sfdv dsfd', NULL, '2022-06-02 07:43:08', '2022-06-02 07:43:08'),
(45, 143, 166, 900, 'Archive_6298b8b91db0c.zip', 'dsf', NULL, '2022-06-02 07:48:49', '2022-06-02 07:48:49'),
(46, 143, 166, 900, 'Archive_6298b8f6d3098.zip', 'jhhbn khb', NULL, '2022-06-02 07:49:50', '2022-06-02 07:49:50'),
(47, 143, 167, 400, 'tech JD_629db18d30ef1.zip', 'there are 400 unique imgs', NULL, '2022-06-06 02:19:33', '2022-06-06 02:19:33'),
(48, 143, 168, 800, 'Latest Deal Banner_62a2ea158f144.zip', 'Editing & Cropping', 'Revised Icon 5 June_62a320761cb57.zip', '2022-06-10 01:22:05', '2022-06-10 05:14:08'),
(49, 143, 169, 700, 'altserver_62a42c45ea631.zip', 'Bg change to white', 'Latest Deal Banner_62a42d738fff9.zip', '2022-06-11 00:16:45', '2022-06-11 00:21:56'),
(50, 143, 170, 1000, 'odndigit_connect (1).sql_62bc212b95bd3.gz', 'editing', 'odndigit_connect (1).sql_62bc243550360.gz', '2022-06-29 04:23:47', '2022-06-29 04:36:50'),
(51, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc50fb5d451.zip', 'Upload checking', NULL, '2022-06-29 07:47:47', '2022-06-29 07:47:47'),
(52, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc51764d3a7.zip', 'upload check', NULL, '2022-06-29 07:49:50', '2022-06-29 07:49:50'),
(53, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc51cc562ac.zip', 'upload', NULL, '2022-06-29 07:51:16', '2022-06-29 07:51:16'),
(54, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc52a5b9b62.zip', 'upLOAD CHECK', NULL, '2022-06-29 07:54:53', '2022-06-29 07:54:53'),
(55, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc5349c5e0b.zip', 'UPLOAD', NULL, '2022-06-29 07:57:37', '2022-06-29 07:57:37'),
(56, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc543e5aab1.zip', 'UPLOAD', NULL, '2022-06-29 08:01:42', '2022-06-29 08:01:42'),
(57, 143, 170, 98, 'PRODUCT IMAGES_62bc545e30c01.zip', 'upload', NULL, '2022-06-29 08:02:14', '2022-06-29 08:02:14'),
(58, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc5595c4bb2.zip', 'upload', NULL, '2022-06-29 08:07:25', '2022-06-29 08:07:25'),
(59, 143, 170, 200, 'odndigit_connect (1).sql_62bc55af0aab4.gz', 'upload', NULL, '2022-06-29 08:07:51', '2022-06-29 08:07:51'),
(60, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc56f423e93.zip', 'up', NULL, '2022-06-29 08:13:16', '2022-06-29 08:13:16'),
(61, 143, 170, 200, 'Archive_62bc578cd74ea.zip', 'ewrty', NULL, '2022-06-29 08:15:48', '2022-06-29 08:15:48'),
(62, 143, 170, 200, 'gsfsd_62bc58d566026.zip', 'upload', NULL, '2022-06-29 08:21:17', '2022-06-29 08:21:17'),
(63, 143, 170, 200, 'ODN22062022-ZIRSES3140_62bc5a02d38ec.zip', 'upload', NULL, '2022-06-29 08:26:18', '2022-06-29 08:26:18'),
(64, 144, 172, 200, 'PRODUCT DETAIL PAGE BANNERS_62d1220df0401.zip', 'yghbd', NULL, '2022-07-15 02:45:09', '2022-07-15 02:45:09'),
(65, 144, 172, 200, 'PRODUCT DETAIL PAGE BANNERS_62d12269946e0.zip', 'ygrrg', NULL, '2022-07-15 02:46:41', '2022-07-15 02:46:41'),
(66, 144, 172, 800, 'PRODUCT DETAIL PAGE BANNERS_62d122c0b1a3e.zip', 'thursday', NULL, '2022-07-15 02:48:08', '2022-07-15 02:48:08'),
(67, 144, 172, 200, 'PRODUCT DETAIL PAGE BANNERS_62d122f251044.zip', 'thjersd', NULL, '2022-07-15 02:48:58', '2022-07-15 02:48:58'),
(68, 144, 172, 98, 'PRODUCT DETAIL PAGE BANNERS_62d123200a538.zip', 'trds', NULL, '2022-07-15 02:49:44', '2022-07-15 02:49:44'),
(69, 144, 172, 98, 'PRODUCT DETAIL PAGE BANNERS_62d12353a48d3.zip', 'the', NULL, '2022-07-15 02:50:35', '2022-07-15 02:50:35'),
(70, 144, 172, 98, 'PRODUCT DETAIL PAGE BANNERS_62d123612454a.zip', 'the', NULL, '2022-07-15 02:50:49', '2022-07-15 02:50:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flipkart_editing`
--
ALTER TABLE `flipkart_editing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flipkart_editing`
--
ALTER TABLE `flipkart_editing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;