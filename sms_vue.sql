-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2022 at 04:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_vue`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` varchar(222) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `organisation_id`, `class_name`, `created_at`, `updated_at`) VALUES
(1, '2', 'Class 1', '2022-08-03 03:58:42', '2022-08-03 03:58:42'),
(2, '2', 'Class 2', '2022-08-03 03:58:47', '2022-08-03 03:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `class_routines`
--

CREATE TABLE `class_routines` (
  `id` int(25) NOT NULL,
  `organisation_id` int(25) NOT NULL,
  `department_id` int(25) DEFAULT NULL,
  `class_name` varchar(222) DEFAULT NULL,
  `section_name` varchar(222) DEFAULT NULL,
  `subject_name` varchar(222) DEFAULT NULL,
  `teacher_name` varchar(222) DEFAULT NULL,
  `start_time` varchar(222) DEFAULT NULL,
  `end_time` varchar(222) DEFAULT NULL,
  `date` varchar(222) DEFAULT NULL,
  `monday` varchar(222) DEFAULT NULL,
  `tuesday` varchar(222) DEFAULT NULL,
  `wednesday` varchar(222) DEFAULT NULL,
  `thursday` varchar(222) DEFAULT NULL,
  `friday` varchar(222) DEFAULT NULL,
  `saturday` varchar(222) DEFAULT NULL,
  `attendance` int(25) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_routines`
--

INSERT INTO `class_routines` (`id`, `organisation_id`, `department_id`, `class_name`, `section_name`, `subject_name`, `teacher_name`, `start_time`, `end_time`, `date`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `attendance`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '1', '1', '1', '97', '09:30', '10:30', NULL, '1', '1', '1', '1', '1', '1', 1, '2022-08-03 10:15:47', '2022-08-03 10:15:47'),
(3, 2, 1, '1', '1', '2', '97', '10:30', '11:30', '2022-08-04', '1', '1', '1', '1', '1', NULL, 1, '2022-08-03 10:22:40', '2022-08-03 10:23:22'),
(4, 2, 1, '1', '1', '3', '97', '11:30', '12:30', NULL, '1', '1', '1', '1', '1', '1', 0, '2022-08-03 10:30:07', '2022-08-03 10:30:07'),
(5, 2, NULL, '1', '1', '4', NULL, '12:30', '13:30', NULL, '1', '1', '1', '1', '1', '1', 0, '2022-08-03 10:54:02', '2022-08-03 10:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `class_teachers`
--

CREATE TABLE `class_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(222) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_teachers`
--

INSERT INTO `class_teachers` (`id`, `organisation_id`, `teacher_id`, `class_id`, `section_id`, `department_id`, `created_at`, `updated_at`, `subject_id`) VALUES
(1, '2', '97', '1', '1', '1', '2022-08-03 09:52:55', '2022-08-03 09:52:55', '1'),
(2, '2', '97', '1', '1', '1', '2022-08-07 02:21:00', '2022-08-07 02:21:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `organisation_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, '2', 'Science', '2022-08-03 04:14:26', '2022-08-03 04:14:26'),
(2, '2', 'Art', '2022-08-03 04:14:34', '2022-08-03 04:14:34');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees_submition_date` date NOT NULL,
  `fee_deposit_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addmission_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tution_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sports_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hostel_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transpotation_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_class_fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fee` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_01_05_124937_create_sessions_table', 1),
(7, '2022_01_15_115716_create_classes_table', 1),
(8, '2022_02_12_054301_create_sections_table', 1),
(11, '2022_07_14_220929_create_fees_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher` int(20) DEFAULT NULL,
  `student` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `organisation_id` int(20) NOT NULL,
  `sub_admin` int(20) NOT NULL DEFAULT 1,
  `parent` int(20) NOT NULL DEFAULT 1,
  `subject` int(20) NOT NULL DEFAULT 1,
  `department` int(25) NOT NULL DEFAULT 1,
  `notice` int(20) NOT NULL DEFAULT 1,
  `section` int(25) NOT NULL DEFAULT 1,
  `student` int(20) NOT NULL DEFAULT 1,
  `account` int(20) NOT NULL DEFAULT 1,
  `class_routine` int(20) NOT NULL DEFAULT 1,
  `teacher` int(20) NOT NULL DEFAULT 1,
  `class` int(20) NOT NULL DEFAULT 1,
  `attendance` int(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `user_id`, `organisation_id`, `sub_admin`, `parent`, `subject`, `department`, `notice`, `section`, `student`, `account`, `class_routine`, `teacher`, `class`, `attendance`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2022-06-16 23:44:50', '2022-06-28 00:57:37'),
(13, 77, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, '2022-08-03 10:29:15', '2022-08-03 07:23:23');

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `organisation_id`, `section_name`, `created_at`, `updated_at`) VALUES
(1, '2', 'Section A', '2022-08-03 04:08:32', '2022-08-03 04:08:32'),
(2, '2', 'Section B', '2022-08-03 10:20:40', '2022-08-03 10:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Pmms1yZPsiFvd97ldAsi03Tjxv9wVUP0x7ci2d80', NULL, '127.0.0.1', 'PostmanRuntime/7.29.2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVNUY1prQlJqS3U4SmE4dzRRcFhPaVVpbEtINEJtS3lLeVkzc0RaNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1660902378),
('TTNwXix03qCVQYHmk5nlV6uMIeNnMiyJhZB4Uv7J', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3pjeFZCSWhzMHBVcUNtdjEyaWZxRUVaTkdLVHB2SzRrNkFDQnZZNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1660902293);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(20) NOT NULL,
  `organisation_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `unique_id` varchar(222) NOT NULL,
  `gender` varchar(222) DEFAULT NULL,
  `dob` varchar(222) DEFAULT NULL,
  `roll` varchar(222) DEFAULT NULL,
  `blood_group` varchar(222) DEFAULT NULL,
  `religion` varchar(222) DEFAULT NULL,
  `class` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `admission` varchar(222) NOT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(222) NOT NULL,
  `address` varchar(222) NOT NULL,
  `city` varchar(222) NOT NULL,
  `state` varchar(222) NOT NULL,
  `country` varchar(222) NOT NULL,
  `pincode` varchar(222) DEFAULT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `father_occupation` varchar(222) DEFAULT NULL,
  `photo` varchar(222) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `organisation_id`, `user_id`, `unique_id`, `gender`, `dob`, `roll`, `blood_group`, `religion`, `class`, `section`, `admission`, `description`, `phone`, `address`, `city`, `state`, `country`, `pincode`, `father_name`, `mother_name`, `father_occupation`, `photo`, `created_at`, `updated_at`) VALUES
(1, 2, 102, '343243', 'Male', '44/44/4', '3635328', 'B-', 'Christianity', '1', '1', '34343', NULL, '34343', '43434', '3243', '43243', '4324', '434324324', 'father', 'mother', NULL, '', '2022-08-07 03:28:59', '2022-08-07 03:28:59'),
(2, 2, 104, '34234', 'Male', '343434', 'erer', 'AB-', 'Buddhism', '1', '1', '324334', NULL, '3434', '34324', '4343', '4343', '432', '34343', 'jjj', 'dfdf', NULL, '', '2022-08-09 02:08:28', '2022-08-09 02:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `organisation_id`, `teacher_id`, `class_id`, `section_id`, `subject_id`, `department_id`, `student_id`, `current_date`, `created_at`, `updated_at`) VALUES
(1, '2', '97', '1', '1', '1', '1', '1', '2022-08-01 00:00:00', '2022-08-07 03:31:34', '2022-08-07 03:31:34'),
(5, '2', '97', '1', '1', '1', '1', '1', '2022-08-02 00:00:00', '2022-08-07 04:25:12', '2022-08-07 04:25:12'),
(6, '2', '97', '1', '1', '2', '1', '1', '2022-08-03 00:00:00', '2022-08-08 05:13:25', '2022-08-08 05:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` int(25) NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `organisation_id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Math', '2022-08-03 04:10:10', '2022-08-03 04:10:10'),
(2, 2, 'English', '2022-08-03 04:10:16', '2022-08-03 04:10:16'),
(3, 2, 'Hindi', '2022-08-03 04:10:20', '2022-08-03 04:10:20'),
(4, 2, 'Free', '2022-08-03 04:10:26', '2022-08-03 04:10:26'),
(5, 2, 'Break', '2022-08-03 04:10:35', '2022-08-03 04:10:35'),
(6, 2, 'Physical Education', '2022-08-03 04:10:45', '2022-08-03 04:10:45'),
(7, 2, 'Science', '2022-08-03 04:10:50', '2022-08-03 04:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(20) NOT NULL,
  `organisation_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `spouse_name` varchar(222) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `gender` varchar(222) NOT NULL,
  `dob` varchar(222) NOT NULL,
  `blood_group` varchar(222) NOT NULL,
  `religion` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `address` varchar(222) NOT NULL,
  `city` varchar(222) NOT NULL,
  `state` varchar(222) NOT NULL,
  `country` varchar(222) NOT NULL,
  `pincode` varchar(222) NOT NULL,
  `photo` varchar(222) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `organisation_id`, `user_id`, `department_id`, `father_name`, `mother_name`, `spouse_name`, `description`, `gender`, `dob`, `blood_group`, `religion`, `phone`, `address`, `city`, `state`, `country`, `pincode`, `photo`, `created_at`, `updated_at`) VALUES
(1, 2, 97, '1', 'kulwinder', 'daljeet', 'harmeet', 'yes description', 'Female', '1111111', 'A-', 'Sikhism', '11111', '121', 'ambala', 'haryana', 'india', '124322', '', '2022-08-03 09:23:21', '2022-08-03 09:23:21'),
(4, 2, 101, '1', 'ddd', 'ddd', 'ddd', '44334', 'Male', '343434', 'B+', 'Buddhism', '4434', '4343', '434', '343', '43434', '34343', '', '2022-08-03 10:13:25', '2022-08-03 10:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisation_id` int(20) DEFAULT NULL,
  `user_type` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Super Admin = 0\r\nAdmin = 1\r\nStudent = 2\r\nParents = 3\r\nTeachers = 4\r\nSub Admin=5',
  `child_id` int(25) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_name` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `organisation_id`, `user_type`, `child_id`, `first_name`, `last_name`, `school_name`, `college_name`, `logo`, `email`, `email_verified_at`, `password`, `address`, `city`, `state`, `country`, `phone`, `pincode`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 0, '0', NULL, 'Harmeet', 'Singh', 'Virk International School', NULL, NULL, 'superadmin@gmail.com', NULL, '$2y$10$.kmb2nkZ4MoPaxE.k.0tbeheawEpU9XTEOec3W615CCKuxtN6daly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-11 02:22:52', '2021-12-11 02:22:52'),
(2, 2, '1', NULL, 'Admin', 'Admin', 'Arora International School', NULL, NULL, 'harmeet@gmail.com', NULL, '$2y$10$feaOeO8Oq.ISaaOiukDgi.6tuda0WHs.bQxr/8buBz5UdIGHS0XEu', 'Jalalabad', 'Jalalabad City', 'Punjab', 'India', '100', '125543', NULL, NULL, NULL, NULL, NULL, '2021-12-11 02:50:52', '2021-12-11 02:50:52'),
(77, 2, '5', NULL, 'Amritpal', 'Singh', NULL, NULL, NULL, 'amrit@gmail.com', NULL, '$2y$10$CV8xH6uWS6rcRtqz5OtRBuxTsnqakQDV0nQ1Ado/uioLe36zuVWTe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 04:21:18', '2022-08-03 04:21:18'),
(97, 2, '4', NULL, 'balpreet', 'kaur', NULL, NULL, NULL, 'balpreet@gmail.com', NULL, '$2y$10$7TNhsyFW48LHbrIAj4sr5e8GEvC9r/10dPz6TFzjU0wUWibIuAHdi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 09:23:21', '2022-08-03 09:23:21'),
(101, 2, '4', NULL, 'Lakho', 'kaur', NULL, NULL, NULL, 'lakho@gmail.com', NULL, '$2y$10$7hN9kpyMbtmqKQhdhDQw0eOa1iUxOctBFpHD4XqgRJGfrcrBftl7.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 10:13:25', '2022-08-03 10:13:25'),
(102, 2, '2', NULL, 'student', 'singh', NULL, NULL, NULL, 'student@gmail.com', NULL, '$2y$10$q.EjY2F46Z/URYuIv5QJYeeZd8EYB4BUDDEXtq8Wme.RiQECz2zhG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-07 03:28:59', '2022-08-07 03:28:59'),
(103, 2, '3', 102, 'father', NULL, NULL, NULL, NULL, 'studentfather@gmail.com', NULL, '$2y$10$o1k9kVvfhscioJPKVIog9eYnMe6Yss7H2mc2qS/LQJ2pjewmNTLZe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-07 03:28:59', '2022-08-07 03:28:59'),
(104, 2, '2', NULL, 'New student', 'singh', NULL, NULL, NULL, 'new@gmail.com', NULL, '$2y$10$noCVqv4b8Ajp5u0CK9/KbOzI/.fIYS5464kkdWOurQRTe6H68GnFC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-09 02:08:28', '2022-08-09 02:08:28'),
(105, 2, '3', 104, 'jjj', NULL, NULL, NULL, NULL, 'jj@gmail.com', NULL, '$2y$10$nSr64e8pIBEW.yGP7m68W.ZzoYmZkLPz9tW8syQUpU90Vd64Yyume', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-09 02:08:28', '2022-08-09 02:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_teachers`
--
ALTER TABLE `class_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_teachers`
--
ALTER TABLE `class_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
