-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 06:16 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saif_complain`
--

-- --------------------------------------------------------

--
-- Table structure for table `complain_asigned`
--

CREATE TABLE `complain_asigned` (
  `id` int(11) NOT NULL,
  `complian_id` int(11) NOT NULL,
  `eng_id` int(11) NOT NULL,
  `asign_date` datetime NOT NULL,
  `current_status` text COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_details`
--

CREATE TABLE `complain_details` (
  `id` int(11) NOT NULL,
  `complainer_code` varchar(400) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `complain_type_id` int(11) NOT NULL,
  `complainer` varchar(100) NOT NULL,
  `complain_details` longtext NOT NULL,
  `feedback_details` text,
  `issued_date` datetime NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `complain_status` varchar(100) NOT NULL,
  `priority_id` int(11) NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain_details`
--

INSERT INTO `complain_details` (`id`, `complainer_code`, `category_id`, `complain_type_id`, `complainer`, `complain_details`, `feedback_details`, `issued_date`, `division_id`, `department_id`, `user_id`, `assign_to`, `complain_status`, `priority_id`, `created_at`, `updated_at`) VALUES
(9, 'COM2019080700000001', 1, 8, '01716600843', 'Test Complain', 'It is almost done', '2019-08-07 00:00:00', 5, 2, 1, 3, '3', 3, '2019-08-07 11:12:29', '2019-08-08 00:25:06'),
(10, 'COM2019080800000002', 1, 6, '01716600987', 'Brand New Problem', NULL, '2019-08-08 00:00:00', 5, 2, 1, 3, '1', 3, '2019-08-08 00:37:21', '2019-08-08 00:37:21'),
(11, 'COM2019082200000003', 1, 6, '01345698', 'test', 'Processing on first time', '2019-08-22 00:00:00', 5, 2, 1, 3, '3', 1, '2019-08-22 02:41:49', '2019-09-02 03:29:39'),
(12, 'COM2019091900000001', 1, 8, '01716600843', 'check 12.....', NULL, '2019-09-19 00:00:00', 5, 2, 5, 3, '1', 3, '2019-09-19 08:23:40', '2019-09-19 08:23:40'),
(13, 'COM2019091900000002', 1, 7, '01676545520', 'Test By Forazii', NULL, '2019-09-19 00:00:00', 5, 2, 5, 4, '1', 2, '2019-09-19 10:48:51', '2019-09-19 10:48:51'),
(14, 'COM2019091900000003', 1, 6, '01716600843', 'Large Problem', 'Processing', '2019-09-19 00:00:00', 5, 2, 5, 3, '2', 1, '2019-09-19 11:06:55', '2019-09-19 11:38:13'),
(15, 'COM2019091900000004', 1, 6, '01716600843', 'Yahoo Message', 'Solved Successfully', '2019-09-19 00:00:00', 5, 2, 5, 3, '2', 1, '2019-09-19 11:23:42', '2019-09-19 11:35:45'),
(16, 'COM2019091900000005', 1, 6, '01787686742', 'Test Complain', 'Solved', '2019-09-19 00:00:00', 5, 2, 5, 3, '2', 1, '2019-09-19 11:57:10', '2019-09-19 11:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `complain_details_history`
--

CREATE TABLE `complain_details_history` (
  `id` int(11) NOT NULL,
  `complain_id` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `current_status` int(11) NOT NULL,
  `is_sms_send` tinyint(1) NOT NULL DEFAULT '0',
  `sms_response` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain_details_history`
--

INSERT INTO `complain_details_history` (`id`, `complain_id`, `descriptions`, `created_by`, `assign_to`, `updated_by`, `current_status`, `is_sms_send`, `sms_response`, `created_at`, `updated_at`) VALUES
(11, 9, 'Test Complain', 1, 3, 1, 1, 0, NULL, '2019-08-06 23:12:29', NULL),
(12, 9, 'I am working on it', NULL, 3, 3, 3, 0, NULL, '2019-08-06 23:12:56', '2019-08-06 23:12:56'),
(13, 9, 'It is almost done', NULL, 3, 3, 3, 0, NULL, '2019-08-07 03:13:46', '2019-08-07 03:13:46'),
(14, 9, 'Test Complain', NULL, 3, 1, 3, 0, NULL, '2019-08-08 00:25:07', '2019-08-08 00:25:07'),
(15, 10, 'Brand New Problem', 1, 3, 1, 1, 0, NULL, '2019-08-08 00:37:21', NULL),
(16, 11, 'test', 1, 3, 1, 1, 0, NULL, '2019-08-22 02:41:49', NULL),
(17, 11, 'Processing on first time', NULL, 3, 3, 3, 0, NULL, '2019-08-22 02:43:15', '2019-08-22 02:43:15'),
(18, 11, 'test', NULL, 3, 1, 3, 0, NULL, '2019-09-02 03:29:39', '2019-09-02 03:29:39'),
(19, 12, 'check 12.....', 5, 3, 5, 1, 0, NULL, '2019-09-19 08:23:40', NULL),
(20, 13, 'Test By Forazii', 5, 4, 5, 1, 0, NULL, '2019-09-19 10:48:51', NULL),
(21, 14, 'Large Problem', 5, 3, 5, 1, 0, NULL, '2019-09-19 11:06:55', NULL),
(22, 15, 'Yahoo Message', 5, 3, 5, 1, 1, 'SMS SUBMITTED: ID - C20042245d83659eceec6', '2019-09-19 11:23:44', NULL),
(23, 15, 'Processing', NULL, 3, 3, 3, 0, NULL, '2019-09-19 11:35:02', '2019-09-19 11:35:02'),
(24, 15, 'Solved Successfully', NULL, 3, 3, 2, 1, 'SMS SUBMITTED: ID - C20042245d83687547e39', '2019-09-19 11:35:50', '2019-09-19 11:35:45'),
(25, 14, 'Processing', NULL, 3, 3, 3, 0, NULL, '2019-09-19 11:37:57', '2019-09-19 11:37:57'),
(26, 14, 'Processing', NULL, 3, 3, 2, 1, 'SMS SUBMITTED: ID - C20042245d8369067477f', '2019-09-19 11:38:16', '2019-09-19 11:38:13'),
(27, 16, 'Test Complain', 5, 3, 5, 1, 1, 'SMS SUBMITTED: ID - C20042245d836d76de1f6', '2019-09-19 11:57:12', NULL),
(28, 16, 'Solved', NULL, 3, 3, 2, 1, 'SMS SUBMITTED: ID - C20042245d836dc2c7ba6', '2019-09-19 11:58:31', '2019-09-19 11:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `complain_feedbacks`
--

CREATE TABLE `complain_feedbacks` (
  `id` int(11) NOT NULL,
  `complain_id` int(11) NOT NULL,
  `eng_feedback` longtext NOT NULL,
  `customer_feedback` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain_feedbacks`
--

INSERT INTO `complain_feedbacks` (`id`, `complain_id`, `eng_feedback`, `customer_feedback`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 'Solved', 'Well Done', 1, '2019-05-18 23:49:18', '2019-05-19 02:38:06'),
(3, 1, 'Problem Solved', 'Nice Job', 1, '2019-05-19 02:00:32', '2019-05-19 02:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `complain_priorites`
--

CREATE TABLE `complain_priorites` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain_priorites`
--

INSERT INTO `complain_priorites` (`id`, `name`) VALUES
(1, 'High Priority'),
(2, 'Medium Priority'),
(3, 'Low Priority');

-- --------------------------------------------------------

--
-- Table structure for table `complain_statuses`
--

CREATE TABLE `complain_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf32_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `complain_statuses`
--

INSERT INTO `complain_statuses` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, 1, '2019-05-05 04:28:15', '2019-05-14 23:06:41'),
(2, 'Solved', 1, 1, '2019-05-05 04:59:33', '2019-05-05 04:59:49'),
(3, 'Processing', 1, 1, '2019-08-07 06:17:24', '2019-08-07 06:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `complain_types`
--

CREATE TABLE `complain_types` (
  `id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf32_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `div_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `complain_types`
--

INSERT INTO `complain_types` (`id`, `name`, `dept_id`, `div_id`, `category_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'During charging of the battery grassing is observed significant', 5, 2, 1, 1, 1, '2019-05-24 22:27:51', '2019-08-08 00:36:21'),
(7, 'Charging completed of the battery is enough time', 5, 2, 1, 1, 1, '2019-05-24 22:27:51', '2019-08-08 00:36:30'),
(8, 'Battery is very hot during charging', 5, 2, 1, 1, 1, '2019-08-07 23:31:06', '2019-08-07 23:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `complain_type_categories`
--

CREATE TABLE `complain_type_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `div_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain_type_categories`
--

INSERT INTO `complain_type_categories` (`id`, `name`, `dept_id`, `div_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Charging', 5, 2, 1, 1, '2019-08-07 23:24:20', '2019-08-25 10:37:57'),
(2, 'Battery Category Test', 5, 2, 1, 1, '2019-08-25 16:53:37', '2019-08-25 17:13:38');

-- --------------------------------------------------------

--
-- Stand-in structure for view `complain_type_report`
-- (See below for the actual view)
--
CREATE TABLE `complain_type_report` (
`name` varchar(70)
);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Solar', 1, 1, '2019-04-27 00:05:52', '2019-04-27 00:05:52'),
(6, 'Battery', 1, 1, '2019-04-27 00:05:58', '2019-05-04 23:54:49'),
(7, 'LED', 1, 1, '2019-04-27 00:22:29', '2019-04-27 00:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `dept_id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 5, 'Solar Sales', 1, 1, '2019-04-27 23:23:49', '2019-08-25 11:19:05'),
(4, 6, 'Battery Sales', 1, 1, '2019-04-28 00:32:30', '2019-08-25 11:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Department', 1, 1, '2019-06-10 22:49:35', '2019-06-10 22:59:52'),
(3, 'Division', 1, 1, '2019-06-11 00:14:01', '2019-06-11 00:14:01'),
(4, 'Complain Type', 1, 1, '2019-06-11 01:57:48', '2019-06-11 01:57:48'),
(5, 'Complain Status', 1, 1, '2019-06-11 01:58:01', '2019-06-11 01:58:01'),
(6, 'Complain details', 1, 1, '2019-06-11 01:58:11', '2019-06-11 01:58:11'),
(7, 'Settings', 1, 1, '2019-08-05 04:39:47', '2019-08-05 04:39:47'),
(8, 'Users', 1, 1, '2019-08-06 03:29:26', '2019-08-06 03:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `isallpermission` tinyint(1) NOT NULL DEFAULT '1',
  `module` varchar(100) NOT NULL,
  `isallmodulepermission` tinyint(1) NOT NULL DEFAULT '1',
  `addaccess` tinyint(1) NOT NULL DEFAULT '1',
  `editaccess` tinyint(1) NOT NULL DEFAULT '1',
  `listaccess` tinyint(1) NOT NULL DEFAULT '1',
  `deleteaccess` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_type`, `isallpermission`, `module`, `isallmodulepermission`, `addaccess`, `editaccess`, `listaccess`, `deleteaccess`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 1, 'all', 1, 1, 1, 1, 1, 1, '2019-06-15 22:43:42', '2019-06-15 22:43:42'),
(10, 'Engineer', 0, 'Department', 1, 0, 0, 0, 0, 1, '2019-06-15 23:59:44', '2019-06-18 04:44:24'),
(11, 'Technician', 0, 'Complain details', 0, 0, 1, 1, 0, 1, '2019-08-05 04:27:26', '2019-08-05 04:27:26'),
(14, 'Moderator', 0, 'Complain details', 1, 0, 0, 0, 0, 1, '2019-08-25 08:28:59', '2019-08-25 08:28:59'),
(15, 'Agent', 0, 'Complain details', 1, 0, 0, 0, 0, 1, '2019-08-25 08:57:23', '2019-08-25 08:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf32_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 1, '2019-05-20 22:52:33', '2019-06-10 21:23:34'),
(3, 'Agent', 1, 1, '2019-06-10 21:23:57', '2019-08-25 08:29:41'),
(4, 'Technician', 1, 1, '2019-06-10 21:24:11', '2019-08-04 22:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_type` varchar(100) DEFAULT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(100) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_type`, `setting_key`, `setting_value`, `from_date`, `to_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'send_sms', '1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `division_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Tanveer Qureshee', 'tanveerqureshee@hotmail.com', NULL, '$2y$10$Vau6vW1eJDO55kR666BpbeAKS/JRMbv4jDT1MGwkY83d/eCrabqEG', NULL, 0, 0, '2019-03-26 16:36:21', '2019-08-25 06:19:05'),
(3, 'Atiqur Bhuiyan', 'atiq@admin.com', NULL, '$2y$10$8ymeqr0eR9WnWwNpQDHcLO7CRIZm0Ky1wPyg7wkCNDS5pN82KK86m', NULL, 5, 2, '2019-08-05 00:17:32', '2019-09-18 23:34:27'),
(4, 'Injamam ul Haque', 'injamam@cms.com', NULL, '$2y$10$HlHUgW0ll83I.qzfd5qBoObHnjyFEEo9mXrKgSNfMjnL8v5A6.MKy', NULL, 5, 2, '2019-08-07 04:22:16', '2019-08-07 04:22:16'),
(5, 'Farajee', 'farajee@cms.com', NULL, '$2y$10$RaApxtwmwsGdN2s84VvrmeRCNOf4CFGdXz9X7QLEq0lcFl2A.NXqO', NULL, 0, 0, '2019-08-24 20:59:13', '2019-09-18 20:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-08-04 00:42:52', '2019-08-25 06:19:05'),
(3, 3, 4, '2019-08-05 00:17:32', '2019-09-18 23:34:27'),
(4, 4, 4, '2019-08-07 04:22:16', '2019-08-07 04:22:16'),
(5, 5, 3, '2019-08-24 20:59:13', '2019-09-18 20:22:49');

-- --------------------------------------------------------

--
-- Structure for view `complain_type_report`
--
DROP TABLE IF EXISTS `complain_type_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `complain_type_report`  AS  select `complain_types`.`name` AS `name` from `complain_types` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complain_details`
--
ALTER TABLE `complain_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_details_history`
--
ALTER TABLE `complain_details_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_feedbacks`
--
ALTER TABLE `complain_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_priorites`
--
ALTER TABLE `complain_priorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_statuses`
--
ALTER TABLE `complain_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_types`
--
ALTER TABLE `complain_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_type_categories`
--
ALTER TABLE `complain_type_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complain_details`
--
ALTER TABLE `complain_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `complain_details_history`
--
ALTER TABLE `complain_details_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `complain_feedbacks`
--
ALTER TABLE `complain_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complain_priorites`
--
ALTER TABLE `complain_priorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complain_statuses`
--
ALTER TABLE `complain_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complain_types`
--
ALTER TABLE `complain_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `complain_type_categories`
--
ALTER TABLE `complain_type_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
