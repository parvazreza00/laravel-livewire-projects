-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2026 at 02:02 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livewire_crud_one`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1786106598;', 1786106598),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1786106598);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `joining_date` date DEFAULT NULL,
  `salary` decimal(10,2) NOT NULL,
  `gender` tinyint NOT NULL DEFAULT '1' COMMENT '1=>male,2=>female,3=>other',
  `department` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `name`, `email`, `phone`, `joining_date`, `salary`, `gender`, `department`, `designation`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(2, 'EMP-00001', 'parvaz rezas', 'parvazreza00@gmail.com', '01738920277', '2026-08-01', 78000.00, 1, 'ITs', 'Software Developer', 'uploads/employees//1786081124.jpg', 1, '2026-08-06 23:38:44', '2026-08-07 05:11:13'),
(3, 'EMP-00002', 'Robin', 'robin@gmail.com', '01738920200', '2026-06-01', 50000.00, 1, 'Marketting', 'Marketting manager', 'uploads/employees//1786082635.jpg', 1, '2026-08-07 00:03:55', '2026-08-07 00:03:55'),
(4, 'EMP-00003', 'Tomal', 'tomal@gmail.com', '01838920290', '2026-06-12', 40000.00, 1, 'Sales', 'Sales Executive', 'uploads/employees//1786083607.jpg', 1, '2026-08-07 00:20:07', '2026-08-07 00:20:07'),
(10, 'EMP-00007', 'demo1', 'demo@gmail.com', '01738920276', '2026-08-05', 56645.00, 3, 'IT', 'Software Developer', 'uploads/employees//1786106540.jpg', 1, '2026-08-07 06:12:28', '2026-08-07 06:42:20'),
(6, 'EMP-00005', 'Hasan', 'hasan@gmail.com', '01938020277', '2026-08-05', 40000.00, 1, 'Marketing', 'Field Marketer', 'uploads/employees//1786083843.jpg', 1, '2026-08-07 00:24:03', '2026-08-07 00:24:03'),
(7, 'EMP-00006', 'Soykot Hassan', 'soykat@gmail.com', '01338920287', '2026-07-12', 24000.00, 1, 'Marchant', 'Field marchander', 'uploads/employees//1786083908.jpg', 1, '2026-08-07 00:25:08', '2026-08-07 00:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb3_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000000_create_users_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '0001_01_01_000002_create_jobs_table', 1),
(8, '2026_07_31_164113_create_posts_table', 1),
(9, '2026_08_03_174203_create_employees_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb3_unicode_ci,
  `featrued_image` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `featrued_image`, `created_at`, `updated_at`) VALUES
(1, 'FIrst Post', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863094.jpg', '2026-08-04 11:04:54', '2026-08-04 11:04:54'),
(2, 'Second Post', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863115.jpg', '2026-08-04 11:05:15', '2026-08-04 11:05:15'),
(3, 'Third Post', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863129.jpg', '2026-08-04 11:05:29', '2026-08-04 11:05:29'),
(4, 'Fourth Posst', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863145.jpg', '2026-08-04 11:05:45', '2026-08-04 11:05:45'),
(5, 'Fifth Post ', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863165.jpg', '2026-08-04 11:06:05', '2026-08-04 11:06:05'),
(6, 'Sixth Post ', 'This will recreate the database tables with the corrected schema.', 'uploads/1785863181.jpg', '2026-08-04 11:06:21', '2026-08-04 11:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb3_unicode_ci,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6W2rBAzOrut3FisVo3030pHmsjX1inhMII2dCqBL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJDeXVFSU9VdWRIdGlQaVBWZkJVdnk2QlVzSUpUWnhFdTNHakRnS1lVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZGQtZW1wbG95ZWUiLCJyb3V0ZSI6ImFkZC5lbXBsb3llZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1786111314),
('FGsTmhLmtvmFvzfd9EXlWQsnniwJPWP9DSux6Bxa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIweU9vd0tzQTZOaTROZDFxT1hON1JYalFLaE55WldOZmdxQUpBYnRYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJwb3N0cyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1786111311);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
