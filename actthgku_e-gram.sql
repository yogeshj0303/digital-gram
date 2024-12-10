-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2024 at 11:43 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actthgku_e-gram`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_grams`
--

CREATE TABLE `about_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_gram` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_grams`
--

INSERT INTO `about_grams` (`id`, `state`, `district`, `taluka`, `gram`, `about_gram`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '', 'about-gram/Madhya Pradesh/Betul/Ghoradongri/Ranipur/pTrgK4T7GjeViJjYWmMFKndldXPShOhDruGEkLUr.pdf', '2024-11-30 04:06:19', '2024-11-30 04:06:19'),
(2, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 'gghfgfhv', 'about-gram/Madhya Pradesh/Betul/Ghoradongri/Ranipur/hkxQrL6u7vvuDveuHGPZr2FWCTBdZ9DdgrtzqWCg.pdf', '2024-12-05 10:42:40', '2024-12-08 23:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `annual_maintenances`
--

CREATE TABLE `annual_maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_year` int(11) NOT NULL,
  `maintenance_amount` decimal(15,2) NOT NULL,
  `remaining_amount` decimal(15,2) NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `current_population` int(11) DEFAULT NULL,
  `bill_status` enum('pending','complete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annual_maintenances`
--

INSERT INTO `annual_maintenances` (`id`, `state`, `district`, `taluka`, `gram`, `maintenance_year`, `maintenance_amount`, `remaining_amount`, `payment_mode`, `description`, `current_population`, `bill_status`, `created_at`, `updated_at`) VALUES
(3, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 3000, 90000.00, 8000.00, 'RTGS', 'jhjgh', 6888, 'complete', '2024-12-06 03:06:18', '2024-12-06 04:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Gram Population new', '2024-11-28 00:08:27', '2024-12-05 09:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_to_gram_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `register_to_gram_id`, `created_at`, `updated_at`) VALUES
(3, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/dZdJ4ADPDnpqYawQk1tizIbZ5cY7nqe5hCfxK1ti.pdf', 34, '2024-12-03 09:00:32', '2024-12-03 09:00:32'),
(4, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/kSoJL096COTQLuWKwfFf4bjZc3sZCSXcqfRxmUFk.pdf', 34, '2024-12-03 09:00:32', '2024-12-03 09:00:32'),
(5, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/SJBtXX1eoMdrdnXu3q2xZih25UFv3cHMSIKMoc0V.pdf', 34, '2024-12-03 09:00:32', '2024-12-03 09:00:32'),
(6, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/3tY8dOnQHkGPkwjk859A1lvmc25LKEvM5s9BDDRr.pdf', 34, '2024-12-03 09:00:32', '2024-12-03 09:00:32'),
(7, 'uploads/Andhra Pradesh/Anantapur/Testing Taluka/वाकरे/sfMNiRZGLEKenXbtzNX5jup7vstea0cR6ZTthRTl.pdf', 35, '2024-12-03 15:12:48', '2024-12-03 15:12:48'),
(8, 'uploads/Andhra Pradesh/Anantapur/Testing Taluka/वाकरे/SpsPwPBdZ133UTHSjql7fr6kfPKu0QDs5R45APOG.pdf', 35, '2024-12-03 15:12:48', '2024-12-03 15:12:48'),
(9, 'uploads/Andhra Pradesh/Anantapur/Testing Taluka/वाकरे/bfwin2kYX8jgDTahGdUlyg2CWySUUzy8X57IuKtJ.pdf', 35, '2024-12-03 15:12:48', '2024-12-03 15:12:48'),
(10, 'uploads/Andhra Pradesh/Anantapur/Testing Taluka/वाकरे/FjfoUSOhrQK0BkfpGDp6Eijgx2X50TwgCCkcc50T.pdf', 35, '2024-12-03 15:12:48', '2024-12-03 15:12:48'),
(19, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/arT9sqh7hLZVBEZPdvtM9aa2CaQ4uIu0fOVVeAil.pdf', 42, '2024-12-06 07:00:38', '2024-12-06 07:00:38'),
(20, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/XbGUp529qA5PsXJcZUmEuZLSNUU9qZsXgCLdXghm.pdf', 42, '2024-12-06 07:01:21', '2024-12-06 07:01:21'),
(21, 'uploads/Madhya Pradesh/Betul/Ghoradongri/Ranipur/muWF6wMhtWfaMWCiDAZj5HsHXMs5U4tNPYxj79Gy.pdf', 34, '2024-12-08 23:55:01', '2024-12-08 23:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `gharpatti_panipattis`
--

CREATE TABLE `gharpatti_panipattis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('gharpatti','panipatti') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_type` enum('cash','online','rtgs','check') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `paid_date` datetime NOT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `send_bill` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gharpatti_panipattis`
--

INSERT INTO `gharpatti_panipattis` (`id`, `state`, `district`, `taluka`, `gram`, `username`, `type`, `amount_type`, `paid_type`, `paid_amount`, `paid_date`, `remaining_amount`, `send_bill`, `created_at`, `updated_at`) VALUES
(7, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'panipatti', 'cash', 'cash', 124444.00, '2024-12-02 16:14:00', 111222.00, 0, '2024-12-02 05:14:38', '2024-12-02 05:14:38'),
(13, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'panipatti', 'cash', 'cash', 124444.00, '2024-12-02 16:14:00', 111222.00, 0, '2024-12-02 05:14:38', '2024-12-02 05:14:38'),
(16, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'panipatti', '10000.00', 'cash', 2000.00, '2024-12-03 12:01:00', 0.00, 0, '2024-12-03 01:01:50', '2024-12-03 01:01:50'),
(17, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 1000.00, '2024-12-04 02:10:00', 1000.00, 0, '2024-12-03 15:10:30', '2024-12-03 15:10:30'),
(18, 'Andhra Pradesh', 'Anantapur', 'Testing Taluka', 'वाकरे', '4', 'gharpatti', '890.00', 'cash', 0.00, '2024-12-04 02:22:00', 0.00, 0, '2024-12-03 15:22:19', '2024-12-03 15:22:19'),
(19, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:31:00', 0.00, 0, '2024-12-04 23:32:05', '2024-12-04 23:32:05'),
(20, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:33:00', 0.00, 0, '2024-12-04 23:33:52', '2024-12-04 23:33:52'),
(21, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:36:08', '2024-12-04 23:36:08'),
(22, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:37:05', '2024-12-04 23:37:05'),
(23, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:38:41', '2024-12-04 23:38:41'),
(24, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:39:49', '2024-12-04 23:39:49'),
(25, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:40:18', '2024-12-04 23:40:18'),
(26, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:40:43', '2024-12-06 03:25:29'),
(27, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 2000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:41:17', '2024-12-04 23:41:17'),
(29, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '2', 'gharpatti', '2000.00', 'cash', 8000.00, '2024-12-05 10:35:00', 0.00, 1, '2024-12-04 23:42:20', '2024-12-06 01:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `grams`
--

CREATE TABLE `grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gram_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grams`
--

INSERT INTO `grams` (`id`, `gram_name`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `address`, `pin_code`) VALUES
(4, 'Ranipur', '2024-11-29 00:31:59', '2024-12-08 23:53:28', 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipurr', '123215'),
(5, 'वाकरेj', '2024-12-03 15:12:03', '2024-12-05 05:21:46', 'Andhra Pradesh', 'Anantapur', 'Testing Taluka', 'sanglim,', '451386');

-- --------------------------------------------------------

--
-- Table structure for table `gram_bills`
--

CREATE TABLE `gram_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int(10) UNSIGNED NOT NULL,
  `first_time_bill_amount` decimal(10,2) DEFAULT NULL,
  `quatation_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_amount` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_maintenance_date` date DEFAULT NULL,
  `bill_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gram_bills`
--

INSERT INTO `gram_bills` (`id`, `state`, `district`, `taluka`, `gram`, `population`, `first_time_bill_amount`, `quatation_date`, `bill_date`, `reference_number`, `maintenance_amount`, `description`, `payment_mode`, `next_maintenance_date`, `bill_status`, `created_at`, `updated_at`) VALUES
(3, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 20000, 25000.00, '2024-12-02', '2024-12-02', '1212121', 1200.00, 'This gram population are not be intiatekf', 'Cash', '2024-12-02', 'pending', '2024-12-02 03:01:37', '2024-12-06 04:38:47');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_28_051036_create_categories_table', 2),
(6, '2024_11_28_070700_create_grams_table', 3),
(7, '2024_11_28_084944_create_talukas_table', 4),
(8, '2024_11_28_115428_create_gharpatti_panipattis_table', 5),
(9, '2024_11_30_055404_create_register_to_grams_table', 6),
(10, '2024_11_30_063849_create_files_table', 7),
(11, '2024_11_30_091335_create_about_grams_table', 8),
(12, '2024_12_02_060155_create_populations_table', 9),
(13, '2024_12_02_063709_create_gram_bills_table', 10),
(15, '2024_12_02_091231_create_annual_maintenances_table', 11);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `populations`
--

CREATE TABLE `populations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `confirm_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `populations`
--

INSERT INTO `populations` (`id`, `state`, `district`, `taluka`, `gram`, `population`, `year`, `confirm_by`, `created_at`, `updated_at`) VALUES
(1, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 30000, 2024, '', '2024-12-02 00:41:02', '2024-12-02 00:41:02'),
(2, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 3000, 6000, 'Public', '2024-12-06 03:28:49', '2024-12-06 04:24:45'),
(3, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 3000, 3000, 'Public', '2024-12-06 03:29:05', '2024-12-06 03:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `register_to_grams`
--

CREATE TABLE `register_to_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_to_grams`
--

INSERT INTO `register_to_grams` (`id`, `state`, `district`, `taluka`, `gram`, `category`, `created_at`, `updated_at`) VALUES
(34, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 'Gram Population new', '2024-12-03 09:00:32', '2024-12-03 09:00:32'),
(35, 'Andhra Pradesh', 'Anantapur', 'Testing Taluka', 'वाकरे', 'Gram Population new', '2024-12-03 15:12:48', '2024-12-03 15:12:48'),
(42, 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', 'Gram Population new', '2024-12-06 07:00:38', '2024-12-06 07:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `talukas`
--

CREATE TABLE `talukas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `talukas`
--

INSERT INTO `talukas` (`id`, `state`, `district`, `taluka_name`, `created_at`, `updated_at`) VALUES
(6, 'Madhya Pradesh', 'Betul', 'Ghoradongri', '2024-11-29 00:24:27', '2024-12-05 05:14:30'),
(7, 'Andhra Pradesh', 'Anantapur', 'Testing Taluka', '2024-12-03 15:11:07', '2024-12-03 15:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `land_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `farm_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gharpatti_annual` decimal(10,2) DEFAULT NULL,
  `home_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panipatti_annual` decimal(10,2) DEFAULT NULL,
  `user_type` enum('Gram_Sevak','Clark','Sarpanch','Sadsy','Public') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `gram`, `contact_no`, `gate_no`, `profile_pic`, `gender`, `dob`, `age`, `land_area`, `farm_area`, `gharpatti_annual`, `home_type`, `panipatti_annual`, `user_type`, `otp`, `otp_expires_at`) VALUES
(1, 'admin', 'Super Admin', 'admin@themesbrand.com', NULL, '$2y$10$BG51IgX.m4SS4iovwrCXheaCXW1ta8d1bWZ.tHv4s3BELG2J1haWW', 'avatar-1.jpg', NULL, '2024-11-27 03:16:52', '2024-12-07 03:20:54', 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'sabgli', '0000000000', '10', 'profile_pics/v2yYea31mQUpjrevOChdVFdWBoKrlD0i2hAKdBqe.jpg', 'Male', '2024-12-02', 27, '1500', 'flat', 100000.00, 'Plot', 120000.00, 'Gram_Sevak', NULL, NULL),
(2, 'user', 'Yogesh Jharbade', NULL, NULL, NULL, NULL, NULL, '2024-11-29 03:25:36', '2024-12-05 23:48:47', 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '9131323213', 'ssss', 'profile_pics/ndGW531rqYsTrkMlo4XAOWJm1b74oHx0CcsDdH3O.jpg', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'user', 'AIshwarya', NULL, NULL, NULL, NULL, NULL, '2024-11-29 03:37:25', '2024-12-06 00:26:45', 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '987654324', 'new gate', 'profile_pics/riTy5Pj8BhrhcPNxGhOHEffSssbSETDsDaA8By0y.jpg', 'Female', '2024-11-29', 23, 'nak', 'jbjb', 128222.00, 'nah', 111811.00, 'Gram_Sevak', NULL, NULL),
(4, 'user', 'Tushar Suryawanshi', NULL, NULL, NULL, NULL, NULL, '2024-12-03 15:15:58', '2024-12-08 09:51:05', 'Andhra Pradesh', 'Anantapur', 'Testing Taluka', 'वाकरे', '8208102252', '12AB32', 'profile_pics/3xv7YRpASXxZEvILrJh5XWl5lBK7Z8qMJkIpD0uT.png', 'Male', '2024-12-04', 29, '8000SKF', '8200ARK', 890.00, 'flat 3bhk', 900.00, 'Public', NULL, NULL),
(5, 'user', 'yogii', NULL, NULL, NULL, NULL, NULL, '2024-12-04 01:56:24', '2024-12-04 01:57:27', 'Madhya Pradesh', 'Betul', 'Ghoradongri', 'Ranipur', '8602538690', '321', 'profile_pics/bSxpEraJRmxnSxlG30fOsJBCWT2XX1WNdZJJUBJS.jpg', 'Male', '2024-12-05', 23, '232sqr', '432sqw', 10000.00, 'plot', 20000.00, 'Gram_Sevak', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_grams`
--
ALTER TABLE `about_grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annual_maintenances`
--
ALTER TABLE `annual_maintenances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gharpatti_panipattis`
--
ALTER TABLE `gharpatti_panipattis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grams`
--
ALTER TABLE `grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gram_bills`
--
ALTER TABLE `gram_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `populations`
--
ALTER TABLE `populations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_to_grams`
--
ALTER TABLE `register_to_grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talukas`
--
ALTER TABLE `talukas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_grams`
--
ALTER TABLE `about_grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `annual_maintenances`
--
ALTER TABLE `annual_maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gharpatti_panipattis`
--
ALTER TABLE `gharpatti_panipattis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `grams`
--
ALTER TABLE `grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gram_bills`
--
ALTER TABLE `gram_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `populations`
--
ALTER TABLE `populations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `register_to_grams`
--
ALTER TABLE `register_to_grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `talukas`
--
ALTER TABLE `talukas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
