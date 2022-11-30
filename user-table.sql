-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 30, 2022 at 07:55 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `client_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `am_email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_term` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_short` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Gst_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifyToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_status` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `client_id`, `name`, `email`, `am_email`, `active_status`, `dark_mode`, `messenger_color`, `avatar`, `email_verified_at`, `password`, `payment_term`, `phone`, `Address`, `Company`, `c_short`, `Gst_number`, `verifyToken`, `verification_status`, `status`, `photo`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '', 'Super Sm', 'syedzair96@gmail.com', NULL, 0, 0, '#673AB7', '0278f50f-1627-49d6-88c5-9d6c76019a50.jpg', NULL, '$2y$10$Xx9ML2HO49YUsgx6vD.iNuW3r/BEEcJ1MVGQFk9LG0KpN5oSOK9T2', NULL, '7838563793', 'J-3/17murti wali gali royal apartment', 'Odn Digital | innovative content Creators', 'ON', '6324dgvjxcsart45 fcuk', NULL, 1, 1, '1615383375.jpg', 'GbhXmXjNB6iTl7uTYYqgfPLb4T4wWKzPK0PmKw6Uszci9yHUAuuoAsIAp9TB', '2021-01-25 03:14:45', '2021-08-31 08:20:54', NULL),
(3, '', 'Ayan', 'ayan.a@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$Eq1uwtWuMnCTxRRGDXbG6.u.7tjq66cdjKF0l7Q47yLXGI/..6mG6', NULL, '9910456957', 'Heritage Max', 'ODN Digital', 'ON1', 'None', NULL, 1, 1, 'avatar.jpg', NULL, '2021-01-25 03:21:32', '2021-01-25 07:57:37', NULL),
(5, '', 'Nishant', 'nishant.kumar@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$n0l2Ow9V0saRgvJ89J2OQ.tODUaHK2f2.o1GttYcl9aKCQvTn8Dr6', NULL, '098765432', 'ASJKH', 'odn', 'NOD', 'ASKJ098JHBNAS', NULL, 1, 1, '1611819934.jpg', NULL, '2021-01-27 01:38:39', '2021-02-22 03:53:04', NULL),
(6, '', 'Hussnain', 'hasnain.b@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$HxUqERR2b1EDkVQ4sBRj5uEsFVWZhfF1EnPnw2XjyHgmIRhCrwRPq', NULL, '0987654321', 'NONE', 'ODN', 'MD', 'NONE', 'j1mhkkAoGAntwLsGTeiyg6lTQLmoHf1CXcfog7Ib', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 00:24:44', '2021-02-22 03:52:58', NULL),
(7, '', 'Neetu Bansal', 'accounts@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$aZAnI0w8dPvepRqyWmAXde48ieYxy0awBiajB0D4MeUD2BeRkxj/K', NULL, '0987654321', 'None', 'NONE', 'HD', 'none', 'FtKna5SxkfopKDCyDGhpw31PoFisNF1kpDVM7y3B', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:13:07', '2021-02-22 03:49:17', NULL),
(9, '', 'Kumar Udaar', 'kumar.udaar@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$GahO6S71v2yEgj58ll4IS.tbgyyzEHyuTB59SHpSE9uX4dbt227oi', NULL, '0987654321', 'None', 'ODN', 'TH', 'None', NULL, 1, 1, 'avatar.jpg', NULL, '2021-01-28 06:17:05', '2021-02-22 03:49:07', NULL),
(10, '', 'Nr Mahajan', 'narinder.mahajan@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$z7B/hpHXtUSCZj7hZGIIO.aR/aTGUPR3zBwmla37zDR1hkxSsj2bS', NULL, '0912987762', 'None', 'ODN', 'WG', 'None', NULL, 1, 1, 'avatar.jpg', NULL, '2021-01-28 06:22:11', '2021-02-22 03:48:38', NULL),
(11, '', 'narendra kumar', 'narendrakumarodndigital@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$C3ibWriZ6JMtg0JC6X8OJ.lSGdpzhCbPm1OgIIeay5pCVwkNeYAVm', NULL, '0865654232', 'NONE', 'ODN', 'MJ', 'NONE', 'MWCSVGotx98LjXtIz5hCFFx5TZgwc6vcjB6hr4vh', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:34:44', '2021-02-22 03:48:21', NULL),
(12, '', 'Vanjul', 'vanjul.a@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ShX5iYtPIqEzFvEk1uUCEuHnQfX.B6ROIa9K.WaxhpQXiwQzPZEN.', NULL, '0987543271', 'NONE', 'ODN', 'TFG', 'NONE', '7kyiwhKsPETOoBwT6pt4SDh4ei24uEmx8h18P3zm', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:36:32', '2021-02-09 02:38:30', '2021-02-09 02:38:30'),
(13, '', 'Vanjul', 'vanjul.avqc@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$h56c8EBxQTU35KFILcueVuLcuj3anH5CuLnbP91TCB4xz7KM8XXSO', NULL, '0982673232', 'NONE', 'ODN', 'RGK', 'NONE', 'yTUjiUEJ15x6BgT8VNaHkrAy7PHPunbBElvAoZF9', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:37:54', '2021-02-22 01:50:08', NULL),
(14, '', 'Sandeep', 'sandeep.n@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$fU/KFCpfM3z8R/vvJxn50.asui1kdsLsB/pp5lPyvSvxkR4EtJAnW', NULL, '098963234', 'NONE', 'ODN', 'YH', 'NONE', 'nhJR7OnqfWJ2u5i4M058xqsP1ffYsRsGL25RtejR', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:39:28', '2021-01-28 06:39:28', NULL),
(15, '', 'Keshav', 'studio@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$YxUHH/Rtme7ylcgtQmkPx.hLC9k0LOcr3Umt4NG0v3X6CalDul.dy', NULL, '9072786324', 'NONE', 'ODN', 'JN', 'NONE', 'DFeXn8zupTbegBAxySC3Me9snIq1yoOiOGaXJe96', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:43:46', '2021-01-28 06:43:46', NULL),
(16, '', 'Astha', 'aastha.m@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$fnQuWaP9qWqKPYuKYxXMpuT.qEaR1q/WBScKQ0qzRDuq5Zf.K2GpO', NULL, '873257898', 'NONE', 'ODN', 'KL', 'NONE', 'IhJrT3w5tCwX0cm0tOxVsImaFhXeUAf7VapIgSxm', NULL, 1, 'avatar.jpg', NULL, '2021-01-28 06:55:32', '2021-02-21 02:36:27', NULL),
(17, '', 'hina', 'hina.n@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ML8kjq6lY7WsgHw3.ubGeev70eC4Ihu8VOAkNcFCc/h1nQO0sR/P6', NULL, '987238646', 'NONE', 'odn digital', 'YH', 'NONE', '6NalWeAn6gU8cIMJEZjZtXzOqaIp7SWk91dx5qgM', NULL, 1, 'avatar.jpg', NULL, '2021-02-09 02:48:05', '2021-02-12 01:25:39', '2021-02-12 01:25:39'),
(18, '', 'Kamkshi', 'kamakshi.a@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$UCQS78GcPv1m7xJahQLhOulkPOqzGvPv.LoaWBSNOJi7Jh4O0u1a2', NULL, '0897233284', 'NOne', 'odn Digital', 'RG', 'None', NULL, 1, 1, 'avatar.jpg', NULL, '2021-02-22 06:05:48', '2021-02-23 09:15:22', NULL),
(20, '', 'Zuhair', 'Zuhair@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$.G/T.CoXUtX4sBDLZGNdBuI.sucLBr8R1ksCjkG8BUET1HqKsxfLW', NULL, '7838563793', 'asj', 'odn', NULL, 'None', 'iPKoBvUqXn6TIDF1eCv4Za1yU9HICCm3idUJx1Kk', NULL, 1, 'avatar.jpg', NULL, '2021-02-25 04:32:42', '2021-02-25 04:32:42', NULL),
(21, '', 'ZAIRRQW', 'smzair123@gmail.com', NULL, 1, 1, '#2196F3', 'fa64c976-4c87-40de-96ff-e8938a82fb49.jpg', NULL, '$2y$10$b3yUJT80IqYYBn2EpBEYLO114GiffXdxY5zUGe2rHD.doRppKDm7K', NULL, 'NOne', 'j-3/17 murti wali gali', 'NOne', NULL, 'None', 'eogGB7zREbBIcnI8JlutCA5BXkIYI5SzadcyA1Bi', NULL, 1, 'avatar.jpg', NULL, '2021-02-25 04:35:28', '2021-05-05 00:06:27', NULL),
(22, '', 'SDGB', 'sdvd@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$jE//5d8/PsFWwQ/lixMcsOOrm6Sw/TUvf0Uh2VkkwSsMnIDnJrYPe', NULL, 'none', 'J-3hehd', 'none', NULL, 'none', 'sJYRpn4zAFfXWfZ8PLBgiC1pmsFXbYzqkoNvfnfq', NULL, 1, 'avatar.jpg', NULL, '2021-02-25 04:45:15', '2021-02-25 04:45:15', NULL),
(23, '', 'Prerit', 'prerit@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$70GqzSdmSCPQFTQR.nDqH./7a.CdhliLMrmjCokszR6tbKrZEdXua', NULL, '0987654322', 'None', 'Misree', 'MS', 'None', 'Aslt8acsXYTkmkfcI8MKaIdufQWijgpHdBR6u4CI', NULL, 1, 'avatar.jpg', NULL, '2021-02-26 00:09:53', '2021-02-26 00:35:58', NULL),
(26, '', 'sahil', 'sahilmohammad91@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, 'd6fb7a49346575eb27073943df60f492', NULL, '7838563793', 'None', 'wEBp', 'WP', 'nONE', 'VgKXQ1dQnj1lqnnFMAhnMO3982BfTxuAx88CkpnA', NULL, 1, 'avatar.jpg', NULL, '2021-02-27 06:26:38', '2021-02-27 06:26:38', NULL),
(29, '', 'Prerit', 'prrtsingh1@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, 'qxVp6OHm', NULL, '987654321', 'None', 'Amazon', 'AZ', 'None', 'BAsxSMDi4CZNtOyDPBOY4yiHEmAuhu3BCfzX5Oqb', NULL, 1, 'avatar.jpg', NULL, '2021-03-02 07:00:05', '2021-03-02 07:00:05', NULL),
(49, '', 'Fthrq', 'treesthe01@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, 'eyJpdiI6IlJSMXJoR20yZC9obzBZYU1tdFdNcVE9PSIsInZhbHVlIjoiSTRXR0duMElzQmhkaE5qTXdDcXg5QT09IiwibWFjIjoiNjRmYmRkNjViOTU5OTYxODhiMWMxMjI4M2Q2ZWE0Y2U0NGJmNGM2YjAzZmI2MGMxODFiYzJkYTZkM2M3ZGRkNiJ9', NULL, '8763224378', 'NONE', 'TEEQ', 'THF', 'NONE', '8BDvBtLqo5LY366vxoY479D0o0weOWWK4HFwZH7V', NULL, 1, 'avatar.jpg', NULL, '2021-03-30 03:08:42', '2021-03-30 03:08:42', NULL),
(50, '', 'Demo', 'demo@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$qud/xLbfl2T9T3F7h41BneP/n2O7.EfizXqrQqUSevPrgQSw/3YkS', NULL, '987612532', 'demo', 'Demo', 'DEMO', 'demo', 'rZJJ3iRNLVn4qYQcMoUO2wbAUfbHFFzaHrgLxKSA', NULL, 1, 'avatar.jpg', NULL, '2021-07-07 06:03:54', '2021-07-07 06:03:54', NULL),
(51, '', 'Demo1', 'Demo1@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$9mhanWNTT2CJwbuwWpchSOe860EyDAqEKd/3OWruz2Yb.wtlxM3pi', NULL, '07838563793', 'Demo1', 'Demo1', 'DEMO1', 'Demo1', 'L5Bq0ogEXiOkul93yyHw8uUwv6aW4wOX51sooLMe', NULL, 1, 'avatar.jpg', NULL, '2021-07-09 00:50:08', '2021-07-09 00:50:08', NULL),
(52, '', 'commercial', 'commercial@odndigital.com', NULL, 1, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$oiFGBxLbhfqYMlIsdDTyLOlQFdCaYT193eKjstnv0.2SgsVmIKqhi', NULL, '0987654321', 'none', 'ODN', 'ONM', 'none', 'fz94JZgmnAJliuCyJfdvPL4KCVgTRIcFMm0OliO4', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:43:50', '2021-08-06 06:08:05', NULL),
(53, '', 'inwarding', 'inward@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ZrOxs7dkXkd5vqsNOK5n2O2ZZmlr1Hg75OUheL/QwyrsH1wkBwA6K', NULL, '0987654321', 'none', 'none', 'ODNM', 'none', 'pW6V6HPoz3sySMWRhy6fF90W8GVjpwSEy2iTENtE', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:46:07', '2021-07-27 00:46:07', NULL),
(54, '', 'AM', 'am@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$wtvkNHsv292xqUGUPvvUeemY6vdxpq1sJQbvEDfvUjdixkVAMbgd.', NULL, '0987654321', 'NONE', 'NONE', 'OFFN', 'NONE', 'cNJ2TNdZdkWuFiQZH8Oyv9B25r5Td9R26Jwtmb0t', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:46:49', '2021-07-27 00:46:49', NULL),
(55, '', 'Admin', 'admin@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$P.Wu1jLSPVyPqNwtO8Wm3eL0SovFRNR7xaRzjE1weNYegWgacsSuq', NULL, '0987654321', 'NONE', 'NOne', 'odnmf', 'none', 'CsjuiyFkekFENAs8dxiz2wKNm549tao73lu628YJ', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:47:48', '2021-07-27 00:47:48', NULL),
(56, '', 'editor', 'editortl@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$Fdaz5a1QBKE.03Ihw4Nog.eWLYrwS4OR0Dc.X1HtOSUqNOOJ.DbP.', NULL, '0987654321', 'NONE', 'NONE', 'DONJD', 'NONE', 'qUSmN2s14bdGVmNclfsV9OZSHS9Sg6T4JMkiYdd0', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:48:47', '2021-07-27 00:48:47', NULL),
(57, '', 'QC', 'qc@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ss6RhdzK9VHjQhy.51Aw0OzXPz.rSZkgRWNUAFFRKJBPszfmkOxWW', NULL, '0987654321', 'NONE', 'NONE', 'ODNE', 'NONE', 'w7cLBRAxgNR36vb8Xk8WJmBRKVsIJa95xZOrvBLs', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:50:13', '2021-07-27 00:50:13', NULL),
(58, '', 'Editor', 'editor@odndigigtal.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$lR2oxYnRbQny.MXBXVxmw.IU0OdMK.VZCz73zZWJ8pE.g14j5ORTO', NULL, '098764321', 'NONE', 'NONE', 'OKHB', 'NONE', 'SraxH9pNuCXsHUjuYm4EXECMJcb5t1Ma5HjTMuVH', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:50:57', '2021-07-27 00:50:57', NULL),
(59, '', 'STUDIO', 'studioupload@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$IPbHcAifVeE8oTBY/CJ9KeItgnGuukWjhh0HlN3wp6HPObGAGu82e', NULL, '0987654321', 'none', 'none', 'NDIHF', 'none', '5p2DO1DjlYJfW74QERaOzncYOWbDmZixTuUiepXA', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 00:52:10', '2021-07-27 00:52:10', NULL),
(60, '', 'syed', 'sye@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ZKs6ijk6KnthYrNwt6bHNetBCrk/FKZtaaMd7A4VUrIb5fHdAZGZS', NULL, '0987651243', NULL, 'odn', 'ODN', NULL, 'ge32IFiOShIQHyxfNiNtKE49yVw8aGkgU5IbbUae', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 10:42:32', '2021-07-27 10:42:32', NULL),
(61, '', 'jn', 'Sfb@GMAIL.COM', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$3kCQYSjN.QfS8gSKpmMTu.YcoX5sOmOR6pSeMdsX7Mb7d5Gv6JKWO', NULL, '9823R724', NULL, 'ADBSB', 'SDBUSDF', NULL, '9fiqcmvzrRPDfqq9IlpgPCPrfi5itK45qYgzH4OB', NULL, 1, 'avatar.jpg', NULL, '2021-07-27 10:48:53', '2021-07-27 10:48:53', NULL),
(62, '', 'jhgv', 'nn@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$G6Tmz7ntgTPEVBJQW3ZjMeAyTdMJtc4IB2hnw873RObJlCpWW2dUy', 'Monthly Payments - No Advance', '0908786543421', NULL, NULL, 'hn', NULL, 'rS8k9fkoxWQ70xtFqocWYFVugATlsztO3xesqV5O', NULL, 1, 'avatar.jpg', NULL, '2021-08-05 12:16:20', '2021-10-18 08:15:58', NULL),
(63, '', 'HELLO', 'smzair@gmail.com', 'Astha', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$dtwgVBNKK73uH7BlLRrEluHhAuLO7CcrDwDRnoH2qCjjcOgngQZPq', 'Monthly Payments - No Advance', '9876543210', 'no address23', 'hllo', 'UHEIHD', '987654wfghjbn', 'HZsGhCiwmWVbvkHeDJlzmE1DWuLFbYS4XUpsKeM6', NULL, 1, 'avatar.jpg', NULL, '2021-08-09 04:13:51', '2021-10-19 02:52:11', NULL),
(64, '', 'UEHIF', 'CS@gmail.com', 'am@odndigital.com', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$Tj7vTy1n9iDXcol4gHA8D.fXWTDuHYL1iiCcoqbH1E.vU2r3Tq3ie', NULL, '0987654321', 'shcxui892', 'oF', 'NDV', '09u8y7ghbjkvg', '1mJ2jkJ5cDkTMslDkbX0pzb41d80jrZaaVBs2wHu', NULL, 1, 'avatar.jpg', NULL, '2021-08-09 04:15:39', '2021-08-09 04:17:20', '2021-08-09 04:17:20'),
(65, '', 'Vishal', 'vishal@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$rImEiXfhzJYZgdPl2n0ale0NTiq6RPko5MLHupMZq1MpFeQQ/Zkki', '100% Advance Before Bulk Submission', '0987654321', NULL, NULL, 'OP', NULL, 'tmAMXwN6mHvU5CGtMl9XJOIwltWatH7MR1KWBa27', NULL, 1, 'avatar.jpg', NULL, '2021-08-25 01:41:44', '2021-10-18 08:13:31', NULL),
(66, 'ODN983498', 'bbnh', 'nh@gmail.com', 'kamakshi.a@odndigital.com', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$M8QnEksuDOPAogHxXDh0h.saK30cn4rWH40zreKIHvzRBJ7kY7xv.', NULL, '0987865123', 'wdbajs', NULL, 'SD', NULL, 'MFqKuIWWeE6oKgH7LpfP6jLzaRMglqtgsl5TFGrk', NULL, 1, 'avatar.jpg', NULL, '2021-08-28 08:29:31', '2021-10-18 02:51:32', NULL),
(67, 'ODN98345', 'Zair', 'dfj@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$ScY77aUAF4zx5hSqUc0R5uV41dvJOgL00xzgGFzZjByVU88oXlwva', NULL, '0987654321', 'none', NULL, NULL, NULL, 'OaAmpJvNeHxdaMNNErdDUZ6NQbk5ssc4f44jh0LE', NULL, 1, 'avatar.jpg', NULL, '2021-09-10 06:20:04', '2021-10-18 02:51:15', NULL),
(68, '2345675', 'dn', 'dn@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$Q6Xbga93S.9MPd7TFL92Le2OGgHwGEv2Q25XEtvDAyvokp0umfVnm', NULL, '0987654321', 'none', NULL, NULL, NULL, 'jmqb97DETzWPDvqp48HUQLDnqcj2abk9gMup2RKd', NULL, 1, 'avatar.jpg', NULL, '2021-09-10 06:52:36', '2021-10-14 05:13:37', NULL),
(69, '', 'syed mohd zair', 'h@gmail.com', 'Astha', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$IHBJ7p9v4hfmCaMuDFRg/uBTfESvVXGyOiSp0tlfWKqAgtTO2CBRq', '50% Advance Remaining After 15 days of Invoice', '7838563792', 'jhohed e', 'ODN Digital', 'O3j', 'uyt56465fg45fg4', '9vt7ZnAinlRiSlxUVHMBpMo32xyZuEXOtGGujNWE', NULL, 1, 'avatar.jpg', NULL, '2021-09-19 05:55:39', '2021-10-19 02:52:37', NULL),
(70, '', 'jnd', 'hm@gmail.com', 'Ayan', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$10rQTUMmd7oti/9u.fjeJOsA0Hj4UP3TppAcGvp94yyAVw38M5OMS', '50% Advance Remaining After 15 days of Invoice', '0987654321', 'jhsdnsdsf', 'jkhn', 'mk', '987632ghj12893d', 'XFZpVVQh1zj5MGkwAqbjiTiRsCwzvJWxWcOSFasy', NULL, 1, 'avatar.jpg', NULL, '2021-09-19 06:08:01', '2021-10-19 02:53:01', NULL),
(71, 'ODN9834890', 'syed mohd zair', 'hsnd@gmail.com', 'aastha.m@odndigital.com', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$7icX.7c.VeKi2FceEb0tPu68YA.BEiEomiQ4XjbA3tKKvwlvmXBkO', '50 % Advance & Remaining Before Bulk Submission', '7838563792', 'no address3r j3', 'hllo', 'ONDH', '987654wfghjbn', 'TFL4uxqjD0I8IJMLBYVdDXLbSLawm4XMQ3iqMMUj', NULL, 1, 'avatar.jpg', NULL, '2021-09-20 04:01:09', '2021-10-19 04:58:30', NULL),
(72, '987hjb', 'idsn f', 'ij@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$f.sRa/3dMphZ1gbBQFB4Yu9cO4ueKW4wzXCsypgUfS0hOWJOAOj8u', NULL, '9876543214', 'uhvghd8bhj iubh h', NULL, NULL, NULL, 'ukTQcN3OWhTQI4oogjp5fnMF97mZki2KzUpiv47f', NULL, 1, 'avatar.jpg', NULL, '2021-09-21 01:24:17', '2021-09-21 01:24:17', NULL),
(73, '897yhjnb', 'yhg', 'iuhj@gmail.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$YQTPyqrLYth3n0HIwz1B1.nkKF.eoTli5Bjc.2L9Lg9kkmjmwKn9O', NULL, '9876543211', 'ijhg gvhf', NULL, NULL, NULL, 'z3A9Y8OyuSTYpEMxb3SOvMQBVY2om5n4h0rzrqHZ', NULL, 1, 'avatar.jpg', NULL, '2021-09-21 01:26:23', '2021-09-21 01:26:23', NULL),
(74, 'ODN9834', 'vipan', 'test@odn.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$51XdYqd.geEFSksFmHyOIuEycA1E.EnQFH3Ac78/UwTEUunFxITMe', NULL, '9876543211', 'no address3r j3', NULL, NULL, NULL, 'qT8tH3GNYGA68PAwLIbhLD18IBBhWRbBR0bWGkeL', NULL, 1, 'avatar.jpg', NULL, '2021-10-04 01:55:45', '2021-10-19 00:55:21', NULL),
(75, 'ODN0007', 'Zair', 'zair.s@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$XPMtDwrEvfcvV.B5bLOZ1e0FTLeyP/0lpRduYHkDTvPA.nOPN0wO.', NULL, '9876543211', 'NOEN', NULL, NULL, NULL, 'r4UDkurgtZLD637vOqcnnJESdkzRR7c6Gsf9gbtc', NULL, 1, 'avatar.jpg', NULL, '2021-10-22 03:54:16', '2021-10-22 03:54:16', NULL),
(76, 'ODN09808', 'zair', 'zair.v@odndigital.com', NULL, 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$w51nL9nmXR/FWCp6ge/IjOeANImzzSRs0wMhhTfwlVX4FfcpR/CtS', NULL, '0987654321', 'None', NULL, NULL, NULL, 'hb039mmarvzyT8CTrDYKN0BljPkN6IskM6Kih4jT', NULL, 1, 'avatar.jpg', NULL, '2021-10-22 03:57:24', '2021-10-22 03:57:24', NULL),
(77, '9832jdsn', 'Dnsb', 'syedzair@gmail.com', 'aastha.m@odndigital.com', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$o84YXPIYtwO8ftAe9rv3wOXgp.n4pn7Qh71.ZnOuqXwooAXHLAY8.', '50 % Advance & Remaining Before Bulk Submission', '9876543211', 'Hijhns 9832 120', 'OND', 'NDO', '89yh23uhb271999', 'qBx5jLqV5PB47Qo0RuE1lmwXAA3nEMsi6JnvrAAx', NULL, 1, 'avatar.jpg', NULL, '2021-10-22 05:08:13', '2021-10-22 05:08:13', NULL),
(78, 'ODN9834989', 'Zair', 'jm@gmail.com', 'kamakshi.a@odndigital.com', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$IJjADjXA.WhzH.89WxuBQuIcWDCQNpwkaAIDtPY3kCwP.TsCjs76i', '50% Advance Remaining After 15 days of Invoice', '9876543212', 'NOne 8SNSB', 'OND', 'NDO5', '89yh23uhb271IJM', 'dVvvt7Bs4quRy0LXUNLSed9xuw7b9IUZqKpI5hpq', NULL, 1, 'avatar.jpg', NULL, '2021-10-22 05:27:07', '2021-10-22 05:27:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
