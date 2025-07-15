-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 06:02 PM
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
-- Database: `school`
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
('laravel_cache_student@student.com|127.0.0.1', 'i:1;', 1751841126),
('laravel_cache_student@student.com|127.0.0.1:timer', 'i:1751841126;', 1751841126),
('laravel_cache_superadmin@gmail.com|127.0.0.1', 'i:1;', 1751841219),
('laravel_cache_superadmin@gmail.com|127.0.0.1:timer', 'i:1751841219;', 1751841219);

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
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('MCQ','CQ') NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `type`, `date`, `start_time`, `end_time`, `class`, `section`, `created_at`, `updated_at`) VALUES
(1, 'test exam', 'MCQ', '2025-07-06', '05:42:00', '09:42:00', '8', 'B', '2025-07-05 14:43:55', '2025-07-05 14:43:55'),
(2, 'first cq', 'CQ', '2025-07-06', '07:42:00', '17:59:00', '9', 'A', '2025-07-05 15:05:50', '2025-07-05 15:05:50'),
(3, 'test', 'MCQ', '2025-07-09', '01:01:00', '01:03:00', '5', 'B', '2025-07-08 11:01:20', '2025-07-08 11:01:20'),
(4, 'SQL cheack', 'CQ', '2025-07-09', '23:11:00', '23:14:00', '1', 'b', '2025-07-08 11:08:39', '2025-07-08 11:08:39'),
(5, 'text exam', 'CQ', '2025-07-10', '00:10:00', '00:13:00', '5', 'A', '2025-07-09 12:09:09', '2025-07-09 12:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `question_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `student_id`, `exam_id`, `score`, `answers`, `created_at`, `updated_at`, `attachment`, `question_id`) VALUES
(56, 3, 4, 2, '\"checking answer\"', '2025-07-09 06:43:33', '2025-07-09 06:44:45', 'answers/1752065013_.png', '9'),
(58, 3, 4, 50, '\"sd\"', '2025-07-09 11:03:09', '2025-07-09 11:04:18', 'answers/1752080589_student_3_question_10.png', '10'),
(59, 3, 3, 1, '\"a\"', '2025-07-09 11:58:02', '2025-07-09 11:58:02', NULL, '7'),
(60, 3, 3, 1, '\"a\"', '2025-07-09 11:58:05', '2025-07-09 11:58:05', NULL, '8'),
(61, 3, 5, 5, '\"1st answer\"', '2025-07-09 12:11:43', '2025-07-09 12:15:11', 'answers/1752084703_student_3_question_11.png', '11'),
(62, 3, 5, 0, '\"2nd\"', '2025-07-09 12:11:57', '2025-07-09 12:16:28', 'answers/1752084717_student_3_question_12.png', '12'),
(63, 3, 5, 10, '\"3rd\"', '2025-07-09 12:12:09', '2025-07-09 12:18:48', 'answers/1752084729_student_3_question_13.png', '13');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `mcq_questions`
--

CREATE TABLE `mcq_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` enum('a','b','c','d') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_questions`
--

INSERT INTO `mcq_questions` (`id`, `exam_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `created_at`, `updated_at`) VALUES
(2, 1, '<span style=\"background-color: rgb(255, 255, 0);\"><b>Cupidatat est ipsa, .</b></span>', 'Nam laborum ullam il', 'Tenetur nihil obcaec', 'In quod aliquip amet', 'Ab sit cum earum te', 'c', '2025-07-05 14:47:00', '2025-07-05 14:47:00'),
(3, 1, 'Debitis <span style=\"background-color: rgb(255, 255, 0);\"><b>inventore</b></span> ut.', 'Nisi tempora qui qua', 'Est vel aut sint ull', 'Consectetur sapiente', 'Esse exercitationem', 'b', '2025-07-05 14:47:17', '2025-07-05 14:47:17'),
(4, 1, 'Officia sint <b>dolores</b>.', 'Sequi consequatur ma', 'Quis ut culpa sit c', 'Natus commodo facili', 'Sit nisi commodi au', 'd', '2025-07-05 14:48:21', '2025-07-05 14:48:21'),
(5, 1, 'Distinctio. <b>Voluptat</b>.', 'Ab nulla iure suscip', 'Unde duis minim omni', 'Veritatis aliquam mo', 'Cum perferendis saep', 'c', '2025-07-05 14:48:37', '2025-07-05 14:48:37'),
(6, 1, 'Optio, <b>duis</b> fugiat d.', 'Et consequatur Expe', 'Aut dolore iusto ab', 'Molestias ducimus s', 'Ut pariatur Volupta', 'c', '2025-07-05 14:48:52', '2025-07-05 14:48:52'),
(7, 3, 'Beatae rerum ducimus.&nbsp;', 'Sint veniam repudia', 'Vel ut rerum minima', 'Maxime consectetur e', 'Exercitationem ex ni', 'a', '2025-07-08 11:02:16', '2025-07-08 11:02:16'),
(8, 3, 'Eu molestiae obcaeca.&nbsp;', 'Nemo quibusdam conse', 'Voluptates in magnam', 'Sequi quos nihil nul', 'Consectetur et persp', 'a', '2025-07-08 11:02:32', '2025-07-08 11:02:32');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_03_183438_create_permission_tables', 1),
(6, '2025_07_04_201834_create_exams_table', 1),
(7, '2025_07_04_201910_create_questions_table', 1),
(8, '2025_07_04_201941_create_exam_results_table', 1),
(9, '2025_07_04_202051_create_expenses_table', 1),
(10, '2025_07_04_202118_create_payments_table', 1),
(11, '2025_07_04_202150_create_study_materials_table', 1),
(12, '2025_07_04_202332_create_notifications_table', 1),
(13, '2025_07_04_212123_create_mcq_questions_table', 1),
(14, '2025_07_04_201746_create_students_table', 2),
(15, '2025_07_11_184141_add_phone_to_users_table', 3),
(16, '2025_07_15_100908_add_columns_to_students_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'student', 'web', '2025-07-06 13:49:27', '2025-07-06 13:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question_text`, `attachment`, `created_at`, `updated_at`) VALUES
(8, 2, '<p>cheack</p>', NULL, '2025-07-06 02:57:39', '2025-07-06 02:57:39'),
(9, 4, '<p>lskdv lskd&nbsp;</p>', 'attachments/1751994545_4.png', '2025-07-08 11:09:05', '2025-07-08 11:09:05'),
(10, 4, 'Ut ut quidem<span style=\"background-color: rgb(255, 255, 0);\"> </span>non sit.', 'attachments/1752000049_4.png', '2025-07-08 12:40:49', '2025-07-08 12:40:49'),
(11, 5, '<p>first q..........</p>', 'attachments/1752084586_5.png', '2025-07-09 12:09:46', '2025-07-09 12:09:46'),
(12, 5, '<p>2nd q.......</p>', 'attachments/1752084604_5.png', '2025-07-09 12:10:04', '2025-07-09 12:10:04'),
(13, 5, '<p>3rd</p>', 'attachments/1752084620_5.png', '2025-07-09 12:10:20', '2025-07-09 12:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'student', 'web', '2025-07-06 13:49:44', '2025-07-06 13:49:44'),
(2, 'teacher', 'web', '2025-07-08 09:36:05', '2025-07-08 09:36:05'),
(3, 'admin', 'web', '2025-07-08 09:36:13', '2025-07-08 09:36:13');

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
(1, 1);

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
('Q2BESn4rDN4WlnNYFRd1oIkGIlEHZ45yrC9IyT6b', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXAyQWw0UFJsSk1mWFZldUt4OHIxUmg1U2hSZDFuMDB6a3ZEbWFURiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752578010);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'pending',
  `joining_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guardian_number` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_id`, `name`, `class`, `section`, `phone`, `address`, `dob`, `photo`, `status`, `joining_date`, `created_at`, `updated_at`, `guardian_number`, `father_name`, `mother_name`) VALUES
(1, 10, '202510', 'Keaton Molina', 'Consequatur tempora', NULL, '+1 (745) 718-6653', 'Vel accusantium dese', '1989-03-07', NULL, 'pending', NULL, '2025-07-11 12:43:35', '2025-07-11 12:43:35', NULL, NULL, NULL),
(2, 11, '202511', 'Veda Watson', 'In lorem rem et dele', NULL, '+1 (365) 981-8448', 'Dolor sint sint exer', '1998-06-16', NULL, 'pending', NULL, '2025-07-11 21:55:46', '2025-07-11 21:55:46', NULL, NULL, NULL),
(3, 12, '202512', 'Geraldine Hahn', '6', NULL, '+1 (249) 437-2477', 'Natus sunt nostrud', '2025-04-02', NULL, 'pending', NULL, '2025-07-12 05:26:30', '2025-07-12 05:26:30', NULL, NULL, NULL),
(6, 15, '202515', 'MD Ashik', '5', NULL, '', 'Dhaka\r\nthis is test adress shipping', '2025-07-15', NULL, 'active', NULL, '2025-07-14 13:20:51', '2025-07-14 13:23:39', NULL, NULL, NULL),
(7, 16, '202516', 'MD Ashik', '5', NULL, '881795864799', 'Dhaka\r\nthis is test adress shipping', '2025-07-04', NULL, 'active', NULL, '2025-07-15 05:13:30', '2025-07-15 05:13:30', '881649107215', 'test father', 'test mother');

-- --------------------------------------------------------

--
-- Table structure for table `study_materials`
--

CREATE TABLE `study_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, NULL, '$2y$12$avoNDKAY5F7mOQvqCxg68e1dS.VIAMP83sTsbNkB.VPnw29u5AQqW', NULL, '2025-07-05 14:42:29', '2025-07-05 14:42:29'),
(7, 'student', 'student@student.com', NULL, NULL, '$2y$12$y2Z7uQYn3sWy73GeKsBRleOnxb3b1IPP0poIxrXNe2/yqJceY5tM.', NULL, '2025-07-06 14:07:24', '2025-07-06 14:07:24'),
(8, 'student', 'student@gmail.com', NULL, NULL, '$2y$12$avoNDKAY5F7mOQvqCxg68e1dS.VIAMP83sTsbNkB.VPnw29u5AQqW', NULL, '2025-07-06 16:32:13', '2025-07-06 16:32:13'),
(9, 'teacher', 'teacher@teacher.com', NULL, NULL, '$2y$12$HrycRPuL4L7VPlg2oO0arOe/5XFjP6oTxrqzxcYWUNsN1vz4oPTcW', NULL, '2025-07-08 10:42:17', '2025-07-08 10:42:17'),
(10, 'Keaton Molina', 'ryno@mailinator.com', NULL, NULL, '$2y$12$nNAc16EHkAu/xKMGD5Bh1O6fnTvcBf.xCh06lDt57BDWNIYjAG..u', NULL, '2025-07-11 12:43:35', '2025-07-11 12:43:35'),
(11, 'Veda Watson', 'ryxuh@mailinator.com', NULL, NULL, '$2y$12$BSfXDrw.tm6qwKsKNicUH.fUzGD9zqECfpTTeFiimm42cWYl2bBg.', NULL, '2025-07-11 21:55:46', '2025-07-11 21:55:46'),
(12, 'Geraldine Hahn', 'gaha@mailinator.com', NULL, NULL, '$2y$12$zOSDrkAaf0d0rsnpRb5KV.xThnYjIRCKWD/Ry8vluFaYxWok.zdQa', NULL, '2025-07-12 05:26:29', '2025-07-12 05:26:29'),
(15, 'MD Ashik', 'mdashik.design.laptop@gmail.com', NULL, NULL, '$2y$12$c5gZ792Y/AR9pnzksl59GOWVWnsO09QgRdjyVmPqOeBc/gA3rFM8O', NULL, '2025-07-14 13:20:51', '2025-07-14 13:23:39'),
(16, 'MD Ashik', 'mdashik.official.mail@gmail.com', '881649107215', NULL, '$2y$12$aUAQx7oQ0q0viXBW0JWmUOawRsvP6KNadAFIBYvOIy3v2SLC9ruYS', NULL, '2025-07-15 05:13:29', '2025-07-15 05:13:29');

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
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_student_id_foreign` (`student_id`),
  ADD KEY `exam_results_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mcq_questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_student_id_foreign` (`student_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_student_id_foreign` (`student_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_id_unique` (`student_id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `study_materials`
--
ALTER TABLE `study_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD CONSTRAINT `mcq_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
