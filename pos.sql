-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 03:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('gggggg@gmil.com|127.0.0.1', 'i:2;', 1745394104),
('gggggg@gmil.com|127.0.0.1:timer', 'i:1745394104;', 1745394104);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_billing`
--

CREATE TABLE `goods_billing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode_number` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(8,2) NOT NULL,
  `purchase_price` decimal(8,2) NOT NULL,
  `supermarket_purchase_price` decimal(8,2) NOT NULL,
  `highest_range` int(11) NOT NULL,
  `lowest_range` int(11) NOT NULL,
  `loyalty_value` decimal(8,2) NOT NULL,
  `barcode_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `quantity`, `selling_price`, `purchase_price`, `supermarket_purchase_price`, `highest_range`, `lowest_range`, `loyalty_value`, `barcode_number`, `created_at`, `updated_at`) VALUES
(1, '50g biscutte', 0, 21.00, 200.00, 250.00, 5000, 500, 0.70, '1234567891234', '2025-04-01 04:52:55', '2025-04-01 04:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '0001_01_01_000001_create_cache_table', 1),
(14, '0001_01_01_000002_create_jobs_table', 1),
(15, 'xxxx_xx_xx_create_users_table', 2),
(16, '2023_10_10_000000_create_goods_billing_table', 3),
(17, '2023_10_10_000000_create_items_table', 3),
(18, '2023_10_10_000000_create_supermaket_stock_table', 3),
(19, '2023_10_10_000000_create_suppliers_table', 3),
(20, '2023_10_01_000000_create_supermarket_stock_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('19ExQywVW6VNvHrcgbsyFTVJ41jvqSRKcwFb0ZDV', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRE12eXQ5cjV5djdpNGFTWE16RFMxcXMzT2dSUDNuOGxudGJrbUxOMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlcm1hcmtldC9zYWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1745502226),
('PQF21tSbqKRcE7N3l4rGJljzPA5DgaahoT7k2cEl', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoialE1RFJJdzRhSGxJS2ZVaFFwZkZSVWdZRjB4cEVMRWlqZzk1T1pUeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYW5hZ2VyL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1745401547);

-- --------------------------------------------------------

--
-- Table structure for table `supermarket_stock`
--

CREATE TABLE `supermarket_stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode_number` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `supermarket_purchase_price` decimal(8,2) DEFAULT NULL,
  `loyalty_value` decimal(8,2) DEFAULT NULL,
  `highest_range` decimal(8,2) DEFAULT NULL,
  `lowest_range` decimal(8,2) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supermarket_stock`
--

INSERT INTO `supermarket_stock` (`id`, `barcode_number`, `item_name`, `quantity`, `date`, `time`, `supermarket_purchase_price`, `loyalty_value`, `highest_range`, `lowest_range`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, NULL, '50g biscutte', 250, NULL, NULL, 250.00, 0.70, NULL, NULL, 8, '2025-04-24 08:09:19', '2025-04-24 08:09:19'),
(2, NULL, '50g biscutte', 250, NULL, NULL, 250.00, 0.70, NULL, NULL, 8, '2025-04-24 08:09:19', '2025-04-24 08:09:19'),
(3, NULL, '50g biscutte', 250, NULL, NULL, 250.00, 0.70, NULL, NULL, 8, '2025-04-24 08:09:29', '2025-04-24 08:09:29'),
(4, NULL, '50g biscutte', 250, NULL, NULL, 250.00, 0.70, NULL, NULL, 8, '2025-04-24 08:09:29', '2025-04-24 08:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `phone_number`, `email`, `company`, `item`, `created_at`, `updated_at`) VALUES
(1, 'oshan', '0766720869', '0766720869@gamil.com', 'munchi', '1234567891234', '2025-04-01 03:15:44', '2025-04-01 03:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position`, `position_id`, `full_name`, `email`, `address`, `user_name`, `phone_number`, `gender`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Manager', '1', 'gggggg', 'gggggg@gmil.com', 'gggggg@gmil,.com', 'gggggg@gmil,.com', '0766720869', 'Male', '$2y$12$gBqVS4XgvaClqnQXliTC3O60PZKTsnR/UXANSRWXccGTAXr2k71v.', NULL, NULL, '2025-03-20 03:41:34', '2025-03-20 03:41:34'),
(6, 'Stock Keeper', '2', 'gggggg1@gmil.com', 'gggggg1@gmil.com', 'gggggg1@gmil.com', 'gggggg1@gmil.com', '0766720869', 'Male', '$2y$12$jU.e45G6QeXT6Y9Sq4.3eufcD6u9v0KQ0x/Sfy5HLcplG1ZLh23SO', NULL, NULL, '2025-04-01 02:39:55', '2025-04-01 02:39:55'),
(7, 'Stock Keeper', '2', 'gggggg2@gmil.com', 'gggggg2@gmil.com', 'gggggg2@gmil.com', 'gggggg2@gmil.com', '0766720869', 'Male', '$2y$12$3jDaKsNsmKWNWGS9NI/8Y.XnEezOvj0GLMxUZEhRpFBfTDO0zauqS', NULL, NULL, '2025-04-01 02:42:14', '2025-04-01 02:42:14'),
(8, 'Supermarket', '3', 'gggggg3@gmil.com', 'gggggg3@gmil.com', 'gggggg3@gmil.com', 'gggggg3@gmil.com', '0766720869', 'Male', '$2y$12$cvBOHhVIYbHyZIihXgwSQOw86TXDXHWHOZpJHs/Hn0yHxfIscKeWK', NULL, NULL, '2025-04-01 02:52:02', '2025-04-01 02:52:02'),
(9, 'Manager', '1', 'piyumika dulanjali dharmakeerthi', 'piumikad678@gmail.com', 'andawala', 'piumikad678@gmail.com', '0766873456', 'Female', '$2y$12$FD2/Vcl4jalerTbtVaaCOu46fE0vcwvIV9Uk5XuYJeDPbxJ3ijiF6', NULL, NULL, '2025-04-23 02:13:34', '2025-04-23 02:13:34'),
(10, 'Stock Keeper', '2', 'amaraaaaaaaa', 'amara@gmail.com', 'andawala', 'amara@gmail.com', '0766873456', 'Female', '$2y$12$4oezMaJb4TmHXhZ0jfpRBeEBvIrUJrDvyQVJtSROp3L.h2mSExkwu', NULL, NULL, '2025-04-24 07:45:56', '2025-04-24 07:45:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goods_billing`
--
ALTER TABLE `goods_billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_billing_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supermarket_stock`
--
ALTER TABLE `supermarket_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_billing`
--
ALTER TABLE `goods_billing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `supermarket_stock`
--
ALTER TABLE `supermarket_stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goods_billing`
--
ALTER TABLE `goods_billing`
  ADD CONSTRAINT `goods_billing_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
