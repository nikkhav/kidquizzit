-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 28 2023 г., 19:19
-- Версия сервера: 10.2.43-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kidquizzit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Default Title1', 'Default Subtitlesssssssssssssssssssss', 'Default Description', 'about/PPox8bEUAA6oTapRJBAD0oM0AY359SHpVxJB4KUa.jpg', '2023-10-12 10:01:21', '2023-10-27 12:53:00');

-- --------------------------------------------------------

--
-- Структура таблицы `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `actions`
--

INSERT INTO `actions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tapşırıq əlavə etdi', '2023-06-23 09:48:16', '2023-06-23 09:48:16'),
(2, 'Qoşma əlavə etdi', '2023-06-23 09:48:16', '2023-06-23 09:48:16'),
(3, 'Qoşmanı sildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(4, 'Təhkim edildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(5, 'Təhkimlikdən silindi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(6, 'Statusu dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(7, 'Vaciblik dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(8, 'Şərh əlavə etdi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(9, 'Müştəri dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(10, 'Departament dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(11, 'Başlıq dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(12, 'Açıqlama dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(13, 'Start tarixi dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(14, 'Son möhlət dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(15, 'Çeklist dəyişildi', '2023-06-23 09:48:17', '2023-06-23 09:48:17'),
(16, 'Çeklist əlavə etdi', '2023-06-25 08:33:02', '2023-06-25 11:34:58'),
(17, 'Çeklist silindi', '2023-06-25 08:33:02', '2023-06-25 11:35:01'),
(18, 'Çeklist statusu dəyişildi', '2023-06-25 08:44:01', '2023-06-25 11:44:59');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Quizes', '2023-10-19 10:12:46', '2023-10-19 10:12:46'),
(2, NULL, 'Colourings', '2023-10-19 10:13:01', '2023-10-19 10:13:01'),
(3, NULL, 'Why Questions', '2023-10-19 10:14:22', '2023-10-19 10:14:22'),
(4, NULL, 'Find the difference', '2023-10-19 10:14:47', '2023-10-19 10:14:47'),
(5, 3, 'Animals', '2023-10-19 10:15:23', '2023-10-19 10:15:23'),
(6, 3, 'Human Body', '2023-10-19 10:15:45', '2023-10-19 10:15:45'),
(7, 3, 'Nature', '2023-10-19 10:15:56', '2023-10-19 10:15:56'),
(8, 3, 'Space', '2023-10-19 10:16:04', '2023-10-19 10:16:04'),
(9, 3, 'Mechanics', '2023-10-19 10:16:15', '2023-10-19 10:16:15'),
(10, 3, 'Science', '2023-10-19 10:16:25', '2023-10-19 10:16:25'),
(11, 1, 'Animals', '2023-10-19 10:17:08', '2023-10-19 10:17:08'),
(12, 1, 'Bellowed Characters', '2023-10-19 10:17:29', '2023-10-19 10:17:29'),
(13, 1, 'History', '2023-10-19 10:17:41', '2023-10-19 10:17:41'),
(14, 1, 'Interactive Geography', '2023-10-19 10:18:00', '2023-10-19 10:18:00'),
(15, 1, 'Why the earth is round', '2023-10-19 10:18:35', '2023-10-19 10:18:35'),
(16, 2, 'Animals', '2023-10-19 10:18:46', '2023-10-19 10:18:46'),
(17, 2, 'Cartoons', '2023-10-19 10:18:58', '2023-10-19 10:18:58'),
(18, 2, 'Games', '2023-10-19 10:19:08', '2023-10-19 10:19:08'),
(19, 2, 'Interactive Geography', '2023-10-19 10:19:27', '2023-10-19 10:19:27'),
(20, 2, 'Vehicles', '2023-10-19 10:19:38', '2023-10-19 10:19:38'),
(21, 4, 'Gifts', '2023-10-19 10:24:04', '2023-10-19 10:24:04'),
(33, 20, 'sdadsdasd', '2023-10-28 11:44:45', '2023-10-28 11:44:45');

-- --------------------------------------------------------

--
-- Структура таблицы `colourings`
--

CREATE TABLE `colourings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `colourings`
--

INSERT INTO `colourings` (`id`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 16, 'colouring/948Sm2VZjJP0rhJ3cJTlu10GDa4c6wqnhFCel1zL.jpg', '2023-10-19 13:34:25', '2023-10-22 13:08:34'),
(3, 16, 'colouring/9uYwYKRoFVfPQt8mJiqUxo9Z908BT9UN3yMvxkwH.jpg', '2023-10-19 14:20:05', '2023-10-19 14:20:05'),
(4, 19, 'colouring/cwvyB6Pd18OwTaxfOWiIJ2KrySSd1J1LxQzws3dT.jpg', '2023-10-28 09:57:19', '2023-10-28 09:57:19');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `type_id`, `user_id`, `customer_number`, `fullname`, `voen`, `phone`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '0001', 'musderi 1', '001', '0(536) 840 00 45', 'muderi@aa.com', 1, '2023-02-06 07:32:45', '2023-02-13 09:10:14', '2023-02-13 09:10:14'),
(2, 1, 1, '0001', 'musderi 2', '002', '(+99412) 310-22-60', 'muderi2@cc.com', 1, '2023-02-06 07:33:16', '2023-02-13 09:10:12', '2023-02-13 09:10:12'),
(3, 2, 1, '0002', 'Musderi 3', '0012', '(+99412) 310-22-60', 'musderi3.ab@gmail.com', 1, '2023-02-09 05:06:07', '2023-02-13 09:10:10', '2023-02-13 09:10:10'),
(4, 1, 1, '0003', 'Musderi 41', '00112234', '0553322154', 'muderi4@gmail.com', 1, '2023-02-10 04:51:43', '2023-02-13 09:10:08', '2023-02-13 09:10:08'),
(6, 1, 1, '0005', 'ESRA CLEAN MMC', '1604782171', '+994708235024', 'dessr4gaasah.ab@gmail.com', 1, '2023-02-13 09:14:01', '2023-10-18 09:41:50', '2023-10-18 09:41:50');

-- --------------------------------------------------------

--
-- Структура таблицы `customer_types`
--

CREATE TABLE `customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hüquqi şəxs', '2023-02-06 07:31:09', '2023-02-06 07:31:09', NULL),
(2, 'Fiziki şəxs', '2023-02-06 07:31:38', '2023-02-06 07:31:38', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hüquq', '2022-11-11 06:06:45', '2022-11-11 06:06:45', NULL),
(2, '1 C', '2022-11-11 06:09:59', '2022-11-11 06:09:59', NULL),
(3, 'Mühasibat', '2022-11-11 06:10:16', '2022-11-11 06:10:16', NULL),
(4, 'HR', '2022-11-11 08:34:40', '2022-11-11 08:34:40', NULL),
(5, 'Goweb2', '2023-01-25 04:52:03', '2023-01-25 04:55:36', '2023-01-25 04:55:36'),
(6, 'Audit', '2023-01-25 06:16:54', '2023-01-25 06:16:54', NULL),
(7, 'İdarəetmə', '2023-01-25 08:28:19', '2023-01-25 08:28:19', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `differences`
--

CREATE TABLE `differences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `differences`
--

INSERT INTO `differences` (`id`, `category_id`, `image1`, `image2`, `created_at`, `updated_at`) VALUES
(2, 21, 'difference/1ZfSlWcxanPT7nYSVIvujVM5WnSt9kAvfNKvTsQX.jpg', 'difference/eZxfS4SoqULAWCBdBvPKHQ7yMDkkXfnGykFfunSy.jpg', '2023-10-22 13:03:17', '2023-10-22 13:04:15');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `task_id`, `name`, `path`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Group 3123.png', 'file/Group 3123.png', 'png', '2023-02-06 08:01:15', '2023-02-06 08:01:15', NULL),
(2, 2, 'depozit.xlsx', 'file/depozit.xlsx', 'xlsx', '2023-02-06 11:07:38', '2023-02-06 11:07:38', NULL),
(3, 2, 'group-266png.png', 'file/group-266png.png', 'png', '2023-02-08 10:02:50', '2023-02-08 10:02:50', NULL),
(4, 4, '249900-ami-kawashima-1360x800.jpg', 'file/249900-ami-kawashima-1360x800.jpg', 'jpg', '2023-02-10 04:53:02', '2023-02-10 04:53:02', NULL),
(5, 4, 'ads.jpg', 'file/ads.jpg', 'jpg', '2023-02-10 04:53:02', '2023-02-10 04:53:02', NULL),
(6, 5, '249900-ami-kawashima-1360x800.jpg', 'file/249900-ami-kawashima-1360x800.jpg', 'jpg', '2023-02-10 04:53:40', '2023-02-10 04:53:40', NULL),
(7, 5, 'ads.jpg', 'file/ads.jpg', 'jpg', '2023-02-10 04:53:40', '2023-02-10 04:53:40', NULL),
(8, 6, 'group-266png.png', 'file/group-266png.png', 'png', '2023-02-10 04:54:19', '2023-02-10 04:54:19', NULL),
(9, 1, 'ads.jpg', 'file/ads.jpg', 'jpg', '2023-02-10 21:48:39', '2023-02-10 21:48:39', NULL),
(10, 1, 'group-266png.png', 'file/group-266png.png', 'png', '2023-02-10 21:48:52', '2023-02-10 21:48:52', NULL),
(11, 1, 'noroot-1png', 'file/noroot-1png', '', '2023-02-10 21:48:52', '2023-02-10 21:48:52', NULL),
(12, 1, '005.jpg', 'file/005.jpg', 'jpg', '2023-02-10 21:48:52', '2023-02-10 21:48:52', NULL),
(13, 1, '249900-ami-kawashima-1360x800.jpg', 'file/249900-ami-kawashima-1360x800.jpg', 'jpg', '2023-02-10 21:48:52', '2023-02-10 21:48:52', NULL),
(14, 1, 'ads.jpg', 'file/ads.jpg', 'jpg', '2023-02-10 21:48:52', '2023-02-10 21:48:52', NULL),
(15, 1, '005.jpg', 'file/005.jpg', 'jpg', '2023-02-10 21:49:16', '2023-02-10 21:49:16', NULL),
(16, 1, '249900-ami-kawashima-1360x800.jpg', 'file/249900-ami-kawashima-1360x800.jpg', 'jpg', '2023-02-10 21:49:16', '2023-02-10 21:49:16', NULL),
(17, 1, 'ads.jpg', 'file/ads.jpg', 'jpg', '2023-02-10 21:49:16', '2023-02-10 21:49:16', NULL),
(88, 143, 's-truck-1.png', 'file/s-truck-1.png', 'png', '2023-02-21 06:57:51', '2023-02-21 06:59:21', '2023-02-21 06:59:21'),
(89, 143, 'slider1.png', 'file/slider1.png', 'png', '2023-02-21 06:59:06', '2023-02-21 06:59:06', NULL),
(198, 301, 'test.txt', 'file/5420-test.txt', 'txt', '2023-06-13 05:38:24', '2023-06-13 05:38:24', NULL),
(199, 303, 'test.txt', 'file/9992-test.txt', 'txt', '2023-06-13 05:48:17', '2023-06-13 05:48:17', NULL),
(200, 305, 'test.txt', 'file/1050-test.txt', 'txt', '2023-06-19 08:59:51', '2023-06-19 08:59:51', NULL),
(201, 314, 'test.txt', 'file/7517-test.txt', 'txt', '2023-06-21 09:54:07', '2023-06-22 07:50:04', '2023-06-22 07:50:04'),
(203, 314, 'test.txt', 'file/6741-test.txt', 'txt', '2023-06-22 07:47:21', '2023-06-22 07:47:21', NULL),
(204, 314, 'test_test.txt', 'file/3866-test_test.txt', 'txt', '2023-06-22 07:49:09', '2023-06-22 07:49:09', NULL),
(205, 315, 'test.txt', 'file/6135-test.txt', 'txt', '2023-06-22 08:49:13', '2023-06-22 08:49:13', NULL),
(210, 341, 'Tasks.txt', 'file/3568-Tasks.txt', 'txt', '2023-06-24 09:00:48', '2023-06-24 09:00:48', NULL),
(211, 341, 'web programming.docx', 'file/4517-web programming.docx', 'docx', '2023-06-24 09:00:48', '2023-06-24 09:00:48', NULL),
(212, 342, 'Tasks.txt', 'file/9168-Tasks.txt', 'txt', '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(213, 342, 'web programming.docx', 'file/9131-web programming.docx', 'docx', '2023-06-24 09:02:39', '2023-06-24 10:26:23', '2023-06-24 10:26:23');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_10_11_082859_create_permission_tables', 1),
(5, '2022_10_14_063804_create_departments_table', 1),
(6, '2022_10_14_142530_create_positions_table', 1),
(7, '2022_10_14_142531_create_users_table', 1),
(8, '2022_10_21_131931_create_priorities_table', 1),
(9, '2022_10_21_131931_create_statuses_table', 1),
(10, '2022_10_21_131932_create_tasks_table', 1),
(11, '2022_10_22_111555_create_user_assign_tasks_table', 1),
(12, '2022_11_25_121305_create_files_table', 1),
(13, '2022_12_12_134857_create_comments_table', 1),
(14, '2022_12_13_095845_add_user_to_task', 1),
(15, '2022_12_14_122451_file_deleted_at', 1),
(16, '2023_01_24_125618_create_customer_types_table', 1),
(17, '2023_01_24_125927_create_customers_table', 1),
(19, '2023_02_08_065648_create_checklists_table', 2),
(21, '2023_02_14_062141_add_customer_to_tasks_table', 3),
(22, '2023_02_15_121959_create_notifications_table', 4),
(23, '2023_04_17_062705_personal_aditional_table', 4),
(24, '2023_06_23_121333_create_actions_table', 5),
(28, '2023_01_31_102958_create_task_activities_table', 6),
(30, '2023_10_10_114131_create_abouts_table', 7),
(31, '2023_10_13_142201_create_privacy_and_policies_table', 8),
(32, '2023_10_15_130447_create_terms_and_conditions_table', 9),
(33, '2023_10_15_142659_create_categories_table', 10),
(34, '2023_10_19_132619_create_colourings_table', 11),
(35, '2023_10_22_152239_create_differences_table', 12),
(36, '2023_10_22_162645_create_why_questions_table', 13),
(37, '2023_10_23_143201_create_quizzes_table', 14),
(38, '2023_10_25_103721_create_quiz_questions_table', 15),
(39, '2023_10_25_103752_create_quiz_answers_table', 15),
(40, '2023_10_26_151221_create_contacts_table', 16);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 44);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `receiver_id`, `task_id`, `action`, `read_at`, `created_at`, `updated_at`) VALUES
(14, 1, NULL, 301, 'Sizi təhkim etdi', NULL, '2023-06-13 05:38:22', '2023-06-13 05:38:22'),
(15, 1, NULL, 301, 'Sizi təhkim etdi', NULL, '2023-06-13 05:38:24', '2023-06-13 05:38:24'),
(16, 1, NULL, 301, 'Sizi təhkim etdi', NULL, '2023-06-13 05:38:24', '2023-06-13 05:38:24'),
(17, 1, NULL, 302, 'Sizi təhkim etdi', NULL, '2023-06-13 05:40:36', '2023-06-13 05:40:36'),
(18, 1, NULL, 302, 'Sizi təhkim etdi', NULL, '2023-06-13 05:40:36', '2023-06-13 05:40:36'),
(19, 1, NULL, 302, 'Sizi təhkim etdi', NULL, '2023-06-13 05:40:36', '2023-06-13 05:40:36'),
(20, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:16', '2023-06-13 05:48:16'),
(21, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(22, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(23, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(24, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(25, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(26, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(27, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(28, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(29, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(30, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(31, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(32, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(33, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(34, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(35, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(36, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(37, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(38, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(39, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(40, 1, NULL, 303, 'Sizi təhkim etdi', NULL, '2023-06-13 05:48:17', '2023-06-13 05:48:17'),
(41, 1, 1, 304, 'Sizi təhkim etdi', NULL, '2023-06-13 06:13:12', '2023-06-13 06:13:12'),
(42, 1, NULL, 304, 'Sizi təhkim etdi', NULL, '2023-06-13 06:13:12', '2023-06-13 06:13:12'),
(43, 1, NULL, 305, 'Sizi təhkim etdi', NULL, '2023-06-15 05:14:49', '2023-06-15 05:14:49'),
(44, 1, NULL, 306, 'Sizi təhkim etdi', NULL, '2023-06-20 05:39:39', '2023-06-20 05:39:39'),
(45, 1, NULL, 307, 'Sizi təhkim etdi', NULL, '2023-06-20 05:41:36', '2023-06-20 05:41:36'),
(46, 1, NULL, 307, 'Sizi təhkim etdi', NULL, '2023-06-20 05:41:36', '2023-06-20 05:41:36'),
(47, 1, NULL, 307, 'Sizi təhkim etdi', NULL, '2023-06-20 05:41:36', '2023-06-20 05:41:36'),
(48, 1, NULL, 307, 'Sizi təhkim etdi', NULL, '2023-06-20 05:41:36', '2023-06-20 05:41:36'),
(49, 1, NULL, 308, 'Sizi təhkim etdi', NULL, '2023-06-20 05:43:57', '2023-06-20 05:43:57'),
(50, 1, NULL, 309, 'Sizi təhkim etdi', NULL, '2023-06-20 05:45:48', '2023-06-20 05:45:48'),
(51, 1, NULL, 310, 'Sizi təhkim etdi', NULL, '2023-06-20 08:43:55', '2023-06-20 08:43:55'),
(52, 1, NULL, 311, 'Sizi təhkim etdi', NULL, '2023-06-20 08:44:31', '2023-06-20 08:44:31'),
(55, 1, NULL, 314, 'Sizi təhkim etdi', NULL, '2023-06-21 08:38:48', '2023-06-21 08:38:48'),
(56, 1, NULL, 315, 'Sizi təhkim etdi', NULL, '2023-06-22 08:47:08', '2023-06-22 08:47:08'),
(57, 1, NULL, 316, 'Sizi təhkim etdi', NULL, '2023-06-22 09:06:22', '2023-06-22 09:06:22'),
(58, 1, NULL, 320, 'Sizi təhkim etdi', NULL, '2023-06-23 10:02:07', '2023-06-23 10:02:07'),
(59, 1, NULL, 321, 'Sizi təhkim etdi', NULL, '2023-06-24 04:52:34', '2023-06-24 04:52:34'),
(60, 1, NULL, 330, 'Sizi təhkim etdi', NULL, '2023-06-24 08:00:56', '2023-06-24 08:00:56');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'İcazə siyahı', 'roles.index', 'web', NULL, NULL),
(2, 'İcazə yarat', 'roles.create', 'web', NULL, NULL),
(3, 'İcazə düzəliş', 'roles.edit', 'web', NULL, NULL),
(4, 'İcazə sil', 'roles.destroy', 'web', NULL, NULL),
(5, 'Əsas Səhifə', 'dashbord.index', 'web', NULL, NULL),
(6, 'Əməkdaş siyahı', 'personal.index', 'web', NULL, NULL),
(7, 'Əməkdaş yarat', 'personal.create', 'web', NULL, NULL),
(8, 'Əməkdaş düzəliş', 'personal.edit', 'web', NULL, NULL),
(9, 'Əməkdaş sil', 'personal.destroy', 'web', NULL, NULL),
(10, 'İdarəçi siyahı', 'user.index', 'web', NULL, NULL),
(11, 'İdarəçi yarat', 'user.create', 'web', NULL, NULL),
(12, 'İdarıçi edit', 'user.edit', 'web', NULL, NULL),
(13, 'İdaəçi sil', 'user.destroy', 'web', NULL, NULL),
(14, 'Departament siyahı', 'department.index', 'web', NULL, NULL),
(15, 'Departament yarat', 'department.create', 'web', NULL, NULL),
(16, 'Departaçent düzəliş', 'department.edit', 'web', NULL, NULL),
(17, 'Departament sil', 'department.destroy', 'web', NULL, NULL),
(18, 'Vəzifə siyahı', 'position.index', 'web', NULL, NULL),
(19, 'Vəzifə yarat', 'position.create', 'web', NULL, NULL),
(20, 'Vəzifə düzəliş', 'position.edit', 'web', NULL, NULL),
(21, 'Vəzifə sil', 'position.destroy', 'web', NULL, NULL),
(22, 'Müşdəri siyahı', 'customer.index', 'web', NULL, NULL),
(23, 'Müşdəri yarat', 'customer.create', 'web', NULL, NULL),
(24, 'Müşdəri düzəliş', 'customer.edit', 'web', NULL, NULL),
(25, 'Müşdəri sil', 'customer.destroy', 'web', NULL, NULL),
(26, ' Müşdəri növü siyahı', 'customer_type.index', 'web', NULL, NULL),
(27, 'Müşdəri növü yarat', 'customer_type.create', 'web', NULL, NULL),
(28, 'Müşdəri növü düzəliş', 'customer_type.edit', 'web', NULL, NULL),
(29, 'Müşdəri növü sil', 'customer_type.destroy', 'web', NULL, NULL),
(30, 'Tapşırıq siyahı', 'task.index', 'web', NULL, NULL),
(31, 'Tapşırıq yarat', 'task.create', 'web', NULL, NULL),
(32, 'Tapşırıq düzəliş', 'task.edit', 'web', NULL, NULL),
(33, 'Tapşırıq sil', 'task.destroy', 'web', NULL, NULL),
(34, 'Əməkdaş təhkim et', 'assine.user', 'web', NULL, NULL),
(35, 'Təhkim edilənlərdən çıxar', 'assine.user.remove', 'web', NULL, NULL),
(36, 'Qoşma əlavə et', 'file.create', 'web', NULL, NULL),
(37, 'Qoşma sil', 'file.remove', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Developer', '2022-11-15 06:03:45', '2022-11-15 06:03:45', NULL),
(2, 'Mühasib', '2023-01-11 07:26:35', '2023-01-25 08:07:35', NULL),
(3, 'Audit', '2023-01-25 06:17:23', '2023-01-25 06:17:23', NULL),
(4, 'Direktor müavini', '2023-01-25 08:06:38', '2023-01-25 08:06:38', NULL),
(5, 'Direktor auditor', '2023-01-25 08:23:56', '2023-01-25 08:23:56', NULL),
(6, 'Baş mühasib', '2023-01-25 08:25:03', '2023-01-25 08:25:03', NULL),
(7, 'Mühasib köməkçisi', '2023-01-25 08:25:23', '2023-01-25 08:25:23', NULL),
(8, 'İR üzrə menecer', '2023-01-25 08:25:48', '2023-01-25 08:25:48', NULL),
(9, 'Hüquqşünas', '2023-01-25 08:26:01', '2023-01-25 08:26:01', NULL),
(10, 'Mütəxəssis', '2023-01-25 08:26:11', '2023-01-25 08:26:11', NULL),
(11, 'Kiçik mütəxəssis', '2023-01-25 08:26:25', '2023-01-25 08:26:25', NULL),
(12, 'Hüquqşünas köməkçisi', '2023-01-25 08:26:51', '2023-01-25 08:26:51', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Yüksək', 'danger', '2023-02-06 07:25:36', '2023-02-06 07:25:36'),
(2, 'Orta', 'warning', '2023-02-06 07:25:36', '2023-02-06 07:25:36'),
(3, 'Aşağı', 'success', '2023-02-06 07:25:36', '2023-02-06 07:25:36');

-- --------------------------------------------------------

--
-- Структура таблицы `privacy_and_policies`
--

CREATE TABLE `privacy_and_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `privacy_and_policies`
--

INSERT INTO `privacy_and_policies` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Default Descriptionsaadasdas', '2023-10-15 09:55:27', '2023-10-27 12:57:01');

-- --------------------------------------------------------

--
-- Структура таблицы `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `quizzes`
--

INSERT INTO `quizzes` (`id`, `category_id`, `title`, `created_at`, `updated_at`) VALUES
(3, 12, 'Harry Potter Quiz', '2023-10-26 09:51:32', '2023-10-26 09:51:58'),
(4, 14, 'Geography', '2023-10-26 10:23:13', '2023-10-26 10:23:13');

-- --------------------------------------------------------

--
-- Структура таблицы `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `quiz_question_id`, `answer_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(3, 3, 'sdasdasdasdasdds', 0, '2023-10-26 09:53:25', '2023-10-26 09:53:25');

-- --------------------------------------------------------

--
-- Структура таблицы `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_text`, `created_at`, `updated_at`) VALUES
(3, 3, 'HELLO2', '2023-10-26 09:52:16', '2023-10-26 09:52:29'),
(4, 3, 'Hello1111111', '2023-10-26 09:52:42', '2023-10-26 09:52:47'),
(5, 4, 'Geography quiz question', '2023-10-26 10:25:41', '2023-10-26 10:25:41');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `title`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'web', '2022-05-09 21:47:26', NULL),
(2, 'Admin', 'admin', 'web', '2022-05-10 19:29:02', '2022-05-10 19:29:02'),
(3, 'muhasib', 'muhasib', 'web', '2023-02-06 11:09:41', '2023-02-06 11:09:41');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(37, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Yeni', 'info\n', '2023-02-06 07:25:36', '2023-02-06 07:25:36'),
(2, 'Davam edir', 'secondary\n', '2023-02-06 07:25:36', '2023-02-06 07:25:36'),
(3, 'Gözləmədə', 'warning', '2023-02-06 07:25:36', '2023-02-06 07:25:36'),
(4, 'Tamamlandı', 'primary\n', '2023-02-06 07:25:36', '2023-02-06 07:25:36');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT 1,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `priority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start` datetime NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `customer_id`, `title`, `description`, `status_id`, `department_id`, `priority_id`, `start`, `deadline`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(1, NULL, 'Test1', NULL, 1, 2, 2, '2023-02-23 00:00:00', NULL, '2023-02-06 08:01:15', '2023-02-13 09:10:34', '2023-02-13 09:10:34', 1),
(2, NULL, 'test1', NULL, 4, 2, 1, '2023-02-06 00:00:00', '2023-02-25 00:00:00', '2023-02-06 11:00:25', '2023-02-13 09:10:32', '2023-02-13 09:10:32', 1),
(3, NULL, 'edv beyanname', 'ssss', 4, 3, 3, '2023-02-09 00:00:00', '2023-02-25 00:00:00', '2023-02-06 11:12:58', '2023-02-10 05:57:31', '2023-02-10 05:57:31', 1),
(4, NULL, 'Test tapsiriq3', 'test124', 1, 6, 3, '2023-02-25 00:00:00', '2023-02-26 00:00:00', '2023-02-10 04:53:02', '2023-02-10 04:54:34', '2023-02-10 04:54:34', 1),
(5, NULL, 'Test tapsiriq3', 'test124', 1, 6, 3, '2023-02-25 00:00:00', '2023-02-26 00:00:00', '2023-02-10 04:53:40', '2023-02-10 04:54:37', '2023-02-10 04:54:37', 1),
(6, NULL, 'Test tapsiriq3', 'test124', 1, 6, 3, '2023-02-25 00:00:00', '2023-02-26 00:00:00', '2023-02-10 04:54:19', '2023-02-13 09:10:30', '2023-02-13 09:10:30', 1),
(143, NULL, 'Test', 'Test etmek ucun', 1, 1, 1, '2023-02-21 11:56:00', '2023-02-21 12:00:00', '2023-02-21 06:57:03', '2023-02-21 07:02:09', '2023-02-21 07:02:09', 1),
(301, '43', 'Vero voluptas sed et', 'Recusandae Dolor pr', 1, 6, 2, '2011-04-02 08:39:00', '1974-12-23 03:08:00', '2023-06-13 05:38:21', '2023-06-13 05:38:21', NULL, 1),
(302, '70', 'Possimus vitae elit', 'Aliquip itaque moles', 1, 4, 2, '1978-01-14 12:11:00', '2008-12-17 02:17:00', '2023-06-13 05:40:36', '2023-06-13 05:40:36', NULL, 1),
(303, '7,8,11,12,13,16,17,25,26,29,30,33,34,37,38,42,44,46,48,49,50,53,57,59,62,66,67,68,69,70', 'Obcaecati et quos si', 'Tempora non consecte', 1, 4, 1, '2001-03-22 21:12:00', '2007-05-15 03:19:00', '2023-06-13 05:48:16', '2023-06-13 05:48:16', NULL, 1),
(304, '5', 'sdadsa', 'dasdas', 1, 3, 1, '2023-06-13 13:12:00', '2023-06-13 13:13:00', '2023-06-13 06:13:12', '2023-06-13 06:13:12', NULL, 1),
(305, '8', 'TEST', 'TEST TEST', 1, 4, 2, '2023-06-15 12:14:00', '2023-07-01 12:14:00', '2023-06-15 05:14:49', '2023-06-15 05:14:49', NULL, 1),
(306, '22', 'Quos laborum Magni', 'Praesentium quisquam', 1, 4, 2, '2018-05-20 21:54:00', '1971-05-08 05:48:00', '2023-06-20 05:39:39', '2023-06-20 05:39:39', NULL, 1),
(307, '63', 'Recusandae Optio q', 'Doloribus adipisicin', 1, 7, 2, '2001-10-26 16:20:00', '2021-07-11 11:33:00', '2023-06-20 05:41:36', '2023-06-20 05:41:36', NULL, 1),
(308, '6', 'saddas', NULL, 1, 1, 1, '2023-06-20 12:43:00', '2023-06-20 12:43:00', '2023-06-20 05:43:57', '2023-06-20 05:43:57', NULL, 1),
(309, '6', 'sdasd', 'sdadsd', 1, 1, 1, '2023-06-20 12:45:00', '2023-06-20 12:45:00', '2023-06-20 05:45:48', '2023-06-20 05:45:48', NULL, 1),
(310, '8', 'Necessitatibus sed l', 'Duis quasi eu magnam', 1, 1, 2, '1978-06-17 13:48:00', '2016-04-01 05:07:00', '2023-06-20 08:43:55', '2023-06-20 08:43:55', NULL, 1),
(311, '5', 'sdasdasds', NULL, 1, 1, 1, '2023-06-20 15:44:00', '2023-06-30 15:44:00', '2023-06-20 08:44:31', '2023-06-20 08:44:31', NULL, 1),
(314, '5', 'sadads', 'asdasdas', 2, 1, 1, '2023-06-21 15:38:00', '2023-06-29 15:38:00', '2023-06-21 08:38:48', '2023-06-22 07:51:10', NULL, 1),
(315, '51', 'Ut elit provident', 'Occaecat incidunt v', 2, 1, 1, '2023-06-22 17:51:00', '2023-06-30 01:25:00', '2023-06-22 08:47:08', '2023-06-22 08:58:58', NULL, 1),
(316, '5', 'Telman', 'Telman', 1, 1, 1, '2023-06-22 16:06:00', '2023-06-23 16:06:00', '2023-06-22 09:06:22', '2023-06-22 09:08:54', NULL, 1),
(317, '34', 'Itaque aspernatur ve', 'Magna hic labore nec', 1, 2, 1, '2023-06-23 09:14:00', '2023-06-30 02:29:00', '2023-06-23 09:56:52', '2023-06-23 09:56:52', NULL, 1),
(318, '34', 'Itaque aspernatur ve', 'Magna hic labore nec', 1, 2, 1, '2023-06-23 09:14:00', '2023-06-30 02:29:00', '2023-06-23 09:57:05', '2023-06-23 09:57:05', NULL, 1),
(319, '34', 'Itaque aspernatur ve', 'Magna hic labore nec', 1, 2, 1, '2023-06-23 09:14:00', '2023-06-30 02:29:00', '2023-06-23 09:57:54', '2023-06-23 09:57:54', NULL, 1),
(320, '34', 'Itaque aspernatur ve', 'Magna hic labore nec', 1, 2, 1, '2023-06-23 09:14:00', '2023-06-30 02:29:00', '2023-06-23 10:02:07', '2023-06-24 04:24:06', '2023-06-24 04:24:06', 1),
(321, '49', 'In rerum tenetur et', 'Asperiores cupiditat', 1, 1, 1, '2023-06-24 20:28:00', '2023-07-01 14:26:00', '2023-06-24 04:52:34', '2023-06-24 05:59:46', '2023-06-24 05:59:46', 1),
(322, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:00:17', '2023-06-24 06:00:17', NULL, 1),
(323, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:04:23', '2023-06-24 06:04:23', NULL, 1),
(324, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:07:05', '2023-06-24 06:07:05', NULL, 1),
(325, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:07:27', '2023-06-24 06:07:27', NULL, 1),
(326, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:08:02', '2023-06-24 06:08:02', NULL, 1),
(327, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:08:19', '2023-06-24 06:08:19', NULL, 1),
(328, '43', 'Sapiente dolor neces', 'Quis quia quis non a', 1, 3, 1, '2023-06-24 02:13:00', '2023-07-01 16:15:00', '2023-06-24 06:08:33', '2023-06-24 06:08:33', NULL, 1),
(329, '22', 'Error consequatur P', 'Quibusdam delectus', 1, 1, 1, '2023-06-24 14:14:00', '2023-07-01 08:20:00', '2023-06-24 07:54:32', '2023-06-24 07:54:32', NULL, 1),
(330, '22', 'Error consequatur P', 'Quibusdam delectus', 1, 1, 1, '2023-06-24 14:14:00', '2023-07-01 08:20:00', '2023-06-24 08:00:56', '2023-06-24 08:00:56', NULL, 1),
(331, '22', 'Error consequatur P', 'Quibusdam delectus', 1, 1, 1, '2023-06-24 14:14:00', '2023-07-01 08:20:00', '2023-06-24 08:06:36', '2023-06-24 08:06:36', NULL, 1),
(332, '22', 'Error consequatur P', 'Quibusdam delectus', 1, 1, 1, '2023-06-24 14:14:00', '2023-07-01 08:20:00', '2023-06-24 08:08:25', '2023-06-24 08:08:25', NULL, 1),
(333, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:48:10', '2023-06-24 08:48:10', NULL, 1),
(334, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:50:12', '2023-06-24 08:50:12', NULL, 1),
(335, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:50:38', '2023-06-24 08:50:38', NULL, 1),
(336, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:51:30', '2023-06-24 08:51:30', NULL, 1),
(337, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:52:05', '2023-06-24 08:52:05', NULL, 1),
(338, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:52:25', '2023-06-24 08:52:25', NULL, 1),
(339, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:52:55', '2023-06-24 08:52:55', NULL, 1),
(340, '17', 'Perferendis repellen', 'Qui elit et et sunt', 1, 2, 1, '2023-06-24 12:17:00', '2023-06-30 14:59:00', '2023-06-24 08:56:12', '2023-06-24 08:56:12', NULL, 1),
(341, '52', 'Facere sit ut volupt', 'Qui et aliquid paria', 1, 2, 1, '2023-06-24 23:42:00', '2023-06-30 06:24:00', '2023-06-24 09:00:47', '2023-06-24 09:00:47', NULL, 1),
(342, '27', 'Enim voluptatum sadasdasdasdsasdasdsadasdas', 'Placeat et ducimus', 1, 2, 2, '2023-06-24 05:20:00', '2023-06-30 23:24:00', '2023-06-24 09:02:38', '2023-06-25 10:20:39', NULL, 1),
(343, '52', 'Eaque odio quas ut a', 'In laboris nemo odio', 1, 4, 1, '1974-06-16 18:17:00', '2008-01-17 00:59:00', '2023-09-17 09:50:41', '2023-09-17 09:50:41', NULL, 1),
(344, '38', 'Aliquip nobis et bea', 'Consequatur Consect', 1, 3, 3, '2003-01-07 11:35:00', '2023-09-24 12:56:00', '2023-09-17 09:51:13', '2023-09-17 09:51:13', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `task_activities`
--

CREATE TABLE `task_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `data_id` int(11) DEFAULT NULL,
  `data_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task_activities`
--

INSERT INTO `task_activities` (`id`, `user_id`, `task_id`, `action_id`, `data_id`, `data_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 338, 1, NULL, NULL, '2023-06-24 08:52:25', '2023-06-24 08:52:25', NULL),
(2, 1, 339, 1, NULL, NULL, '2023-06-24 08:52:55', '2023-06-24 08:52:55', NULL),
(3, 1, 340, 1, NULL, NULL, '2023-06-24 08:56:13', '2023-06-24 08:56:13', NULL),
(4, 1, 340, 4, 10, 'App\\Models\\User', '2023-06-24 08:56:13', '2023-06-24 08:56:13', NULL),
(5, 1, 340, 4, 38, 'App\\Models\\User', '2023-06-24 08:56:13', '2023-06-24 08:56:13', NULL),
(6, 1, 341, 1, NULL, NULL, '2023-06-24 09:00:47', '2023-06-24 09:00:47', NULL),
(7, 1, 341, 4, 10, 'App\\Models\\User', '2023-06-24 09:00:47', '2023-06-24 09:00:47', NULL),
(8, 1, 341, 4, 38, 'App\\Models\\User', '2023-06-24 09:00:47', '2023-06-24 09:00:47', NULL),
(9, 1, 341, 2, 211, 'App\\Models\\File', '2023-06-24 09:00:48', '2023-06-24 09:00:48', NULL),
(10, 1, 342, 1, NULL, NULL, '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(11, 1, 342, 4, 10, 'App\\Models\\User', '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(12, 1, 342, 4, 38, 'App\\Models\\User', '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(13, 1, 342, 2, 212, 'App\\Models\\File', '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(14, 1, 342, 2, 213, 'App\\Models\\File', '2023-06-24 09:02:39', '2023-06-24 09:02:39', NULL),
(15, 1, 342, 8, 42, 'App\\Models\\Comment', '2023-06-24 10:11:13', '2023-06-24 10:11:13', NULL),
(16, 1, 342, 6, NULL, NULL, '2023-06-24 10:19:30', '2023-06-24 10:19:30', NULL),
(17, 1, 342, 6, 1, 'App\\Models\\Status', '2023-06-24 10:20:33', '2023-06-24 10:20:33', NULL),
(18, 1, 342, 5, 38, 'App\\Models\\User', '2023-06-24 10:23:39', '2023-06-24 10:23:39', NULL),
(19, 1, 342, 3, 213, 'App\\Models\\File', '2023-06-24 10:26:23', '2023-06-24 10:26:23', NULL),
(20, 1, 342, 6, 2, 'App\\Models\\Status', '2023-06-25 04:00:17', '2023-06-25 04:00:17', NULL),
(21, 1, 342, 6, 1, 'App\\Models\\Status', '2023-06-25 04:00:26', '2023-06-25 04:00:26', NULL),
(22, 1, 342, 6, 1, 'App\\Models\\Status', '2023-06-25 04:04:41', '2023-06-25 04:04:41', NULL),
(23, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:22:18', '2023-06-25 05:22:18', NULL),
(24, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:26:06', '2023-06-25 05:26:06', NULL),
(25, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:34:14', '2023-06-25 05:34:14', NULL),
(26, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:35:33', '2023-06-25 05:35:33', NULL),
(27, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:37:00', '2023-06-25 05:37:00', NULL),
(28, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 05:37:28', '2023-06-25 05:37:28', NULL),
(29, 1, 342, 7, 2, 'App\\Models\\Priority', '2023-06-25 07:46:46', '2023-06-25 07:46:46', NULL),
(30, 1, 342, 11, NULL, 'App\\Models\\Task', '2023-06-25 07:49:43', '2023-06-25 07:49:43', NULL),
(31, 1, 342, 11, 342, 'App\\Models\\Task', '2023-06-25 07:51:09', '2023-06-25 07:51:09', NULL),
(32, 1, 342, 11, NULL, NULL, '2023-06-25 07:53:01', '2023-06-25 07:53:01', NULL),
(33, 1, 342, 11, NULL, NULL, '2023-06-25 07:54:00', '2023-06-25 07:54:00', NULL),
(34, 1, 342, 12, NULL, NULL, '2023-06-25 07:54:00', '2023-06-25 07:54:00', NULL),
(35, 1, 342, 11, NULL, NULL, '2023-06-25 07:55:48', '2023-06-25 07:55:48', NULL),
(36, 1, 342, 4, NULL, NULL, '2023-06-25 07:55:48', '2023-06-25 07:55:48', NULL),
(37, 1, 342, 11, NULL, NULL, '2023-06-25 07:57:20', '2023-06-25 07:57:20', NULL),
(38, 1, 342, 13, NULL, NULL, '2023-06-25 07:57:20', '2023-06-25 07:57:20', NULL),
(39, 1, 342, 14, NULL, NULL, '2023-06-25 07:57:21', '2023-06-25 07:57:21', NULL),
(40, 1, 342, 11, NULL, NULL, '2023-06-25 07:58:03', '2023-06-25 07:58:03', NULL),
(41, 1, 342, 13, NULL, NULL, '2023-06-25 07:58:03', '2023-06-25 07:58:03', NULL),
(42, 1, 342, 14, NULL, NULL, '2023-06-25 07:58:03', '2023-06-25 07:58:03', NULL),
(43, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 07:58:03', '2023-06-25 07:58:03', NULL),
(44, 1, 342, 15, NULL, NULL, '2023-06-25 08:29:32', '2023-06-25 08:29:32', NULL),
(45, 1, 342, 16, NULL, NULL, '2023-06-25 08:35:48', '2023-06-25 08:35:48', NULL),
(46, 1, 342, 15, NULL, NULL, '2023-06-25 08:36:50', '2023-06-25 08:36:50', NULL),
(47, 1, 342, 17, NULL, NULL, '2023-06-25 08:37:31', '2023-06-25 08:37:31', NULL),
(48, 1, 342, 18, NULL, NULL, '2023-06-25 08:46:47', '2023-06-25 08:46:47', NULL),
(49, 1, 342, 11, NULL, NULL, '2023-06-25 08:49:13', '2023-06-25 08:49:13', NULL),
(50, 1, 342, 13, NULL, NULL, '2023-06-25 08:49:14', '2023-06-25 08:49:14', NULL),
(51, 1, 342, 14, NULL, NULL, '2023-06-25 08:49:14', '2023-06-25 08:49:14', NULL),
(52, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 08:49:14', '2023-06-25 08:49:14', NULL),
(53, 1, 342, 10, 1, 'App\\Models\\Department', '2023-06-25 08:49:14', '2023-06-25 08:49:14', NULL),
(54, 1, 342, 11, NULL, NULL, '2023-06-25 08:50:43', '2023-06-25 08:50:43', NULL),
(55, 1, 342, 13, NULL, NULL, '2023-06-25 08:50:43', '2023-06-25 08:50:43', NULL),
(56, 1, 342, 14, NULL, NULL, '2023-06-25 08:50:43', '2023-06-25 08:50:43', NULL),
(57, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 08:50:43', '2023-06-25 08:50:43', NULL),
(58, 1, 342, 11, NULL, NULL, '2023-06-25 08:56:09', '2023-06-25 08:56:09', NULL),
(59, 1, 342, 13, NULL, NULL, '2023-06-25 08:56:09', '2023-06-25 08:56:09', NULL),
(60, 1, 342, 14, NULL, NULL, '2023-06-25 08:56:09', '2023-06-25 08:56:09', NULL),
(61, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 08:56:10', '2023-06-25 08:56:10', NULL),
(62, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 08:56:10', '2023-06-25 08:56:10', NULL),
(63, 1, 342, 11, NULL, NULL, '2023-06-25 08:57:46', '2023-06-25 08:57:46', NULL),
(64, 1, 342, 13, NULL, NULL, '2023-06-25 08:57:46', '2023-06-25 08:57:46', NULL),
(65, 1, 342, 14, NULL, NULL, '2023-06-25 08:57:46', '2023-06-25 08:57:46', NULL),
(66, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 08:57:46', '2023-06-25 08:57:46', NULL),
(67, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 08:57:46', '2023-06-25 08:57:46', NULL),
(68, 1, 342, 11, NULL, NULL, '2023-06-25 09:09:25', '2023-06-25 09:09:25', NULL),
(69, 1, 342, 13, NULL, NULL, '2023-06-25 09:09:25', '2023-06-25 09:09:25', NULL),
(70, 1, 342, 14, NULL, NULL, '2023-06-25 09:09:25', '2023-06-25 09:09:25', NULL),
(71, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:09:25', '2023-06-25 09:09:25', NULL),
(72, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:09:25', '2023-06-25 09:09:25', NULL),
(73, 1, 342, 11, NULL, NULL, '2023-06-25 09:09:32', '2023-06-25 09:09:32', NULL),
(74, 1, 342, 13, NULL, NULL, '2023-06-25 09:09:33', '2023-06-25 09:09:33', NULL),
(75, 1, 342, 14, NULL, NULL, '2023-06-25 09:09:33', '2023-06-25 09:09:33', NULL),
(76, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:09:33', '2023-06-25 09:09:33', NULL),
(77, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:09:33', '2023-06-25 09:09:33', NULL),
(78, 1, 342, 11, NULL, NULL, '2023-06-25 09:10:04', '2023-06-25 09:10:04', NULL),
(79, 1, 342, 13, NULL, NULL, '2023-06-25 09:10:04', '2023-06-25 09:10:04', NULL),
(80, 1, 342, 14, NULL, NULL, '2023-06-25 09:10:04', '2023-06-25 09:10:04', NULL),
(81, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:10:04', '2023-06-25 09:10:04', NULL),
(82, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:10:04', '2023-06-25 09:10:04', NULL),
(83, 1, 342, 11, NULL, NULL, '2023-06-25 09:10:25', '2023-06-25 09:10:25', NULL),
(84, 1, 342, 13, NULL, NULL, '2023-06-25 09:10:25', '2023-06-25 09:10:25', NULL),
(85, 1, 342, 14, NULL, NULL, '2023-06-25 09:10:25', '2023-06-25 09:10:25', NULL),
(86, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:10:25', '2023-06-25 09:10:25', NULL),
(87, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:10:25', '2023-06-25 09:10:25', NULL),
(88, 1, 342, 11, NULL, NULL, '2023-06-25 09:13:48', '2023-06-25 09:13:48', NULL),
(89, 1, 342, 13, NULL, NULL, '2023-06-25 09:13:48', '2023-06-25 09:13:48', NULL),
(90, 1, 342, 14, NULL, NULL, '2023-06-25 09:13:48', '2023-06-25 09:13:48', NULL),
(91, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:13:48', '2023-06-25 09:13:48', NULL),
(92, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:13:48', '2023-06-25 09:13:48', NULL),
(93, 1, 342, 11, NULL, NULL, '2023-06-25 09:15:00', '2023-06-25 09:15:00', NULL),
(94, 1, 342, 13, NULL, NULL, '2023-06-25 09:15:00', '2023-06-25 09:15:00', NULL),
(95, 1, 342, 14, NULL, NULL, '2023-06-25 09:15:00', '2023-06-25 09:15:00', NULL),
(96, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:15:00', '2023-06-25 09:15:00', NULL),
(97, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:15:00', '2023-06-25 09:15:00', NULL),
(98, 1, 342, 11, NULL, NULL, '2023-06-25 09:16:02', '2023-06-25 09:16:02', NULL),
(99, 1, 342, 13, NULL, NULL, '2023-06-25 09:16:03', '2023-06-25 09:16:03', NULL),
(100, 1, 342, 14, NULL, NULL, '2023-06-25 09:16:03', '2023-06-25 09:16:03', NULL),
(101, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:16:03', '2023-06-25 09:16:03', NULL),
(102, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:16:03', '2023-06-25 09:16:03', NULL),
(103, 1, 342, 11, NULL, NULL, '2023-06-25 09:16:33', '2023-06-25 09:16:33', NULL),
(104, 1, 342, 13, NULL, NULL, '2023-06-25 09:16:33', '2023-06-25 09:16:33', NULL),
(105, 1, 342, 14, NULL, NULL, '2023-06-25 09:16:33', '2023-06-25 09:16:33', NULL),
(106, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:16:33', '2023-06-25 09:16:33', NULL),
(107, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:16:33', '2023-06-25 09:16:33', NULL),
(108, 1, 342, 11, NULL, NULL, '2023-06-25 09:17:00', '2023-06-25 09:17:00', NULL),
(109, 1, 342, 13, NULL, NULL, '2023-06-25 09:17:00', '2023-06-25 09:17:00', NULL),
(110, 1, 342, 14, NULL, NULL, '2023-06-25 09:17:00', '2023-06-25 09:17:00', NULL),
(111, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:17:00', '2023-06-25 09:17:00', NULL),
(112, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:17:00', '2023-06-25 09:17:00', NULL),
(113, 1, 342, 11, NULL, NULL, '2023-06-25 09:17:58', '2023-06-25 09:17:58', NULL),
(114, 1, 342, 13, NULL, NULL, '2023-06-25 09:17:58', '2023-06-25 09:17:58', NULL),
(115, 1, 342, 14, NULL, NULL, '2023-06-25 09:17:58', '2023-06-25 09:17:58', NULL),
(116, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 09:17:59', '2023-06-25 09:17:59', NULL),
(117, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 09:17:59', '2023-06-25 09:17:59', NULL),
(118, 1, 342, 11, NULL, NULL, '2023-06-25 10:06:22', '2023-06-25 10:06:22', NULL),
(119, 1, 342, 13, NULL, NULL, '2023-06-25 10:06:22', '2023-06-25 10:06:22', NULL),
(120, 1, 342, 14, NULL, NULL, '2023-06-25 10:06:22', '2023-06-25 10:06:22', NULL),
(121, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:06:22', '2023-06-25 10:06:22', NULL),
(122, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:06:22', '2023-06-25 10:06:22', NULL),
(123, 1, 342, 11, NULL, NULL, '2023-06-25 10:07:43', '2023-06-25 10:07:43', NULL),
(124, 1, 342, 13, NULL, NULL, '2023-06-25 10:07:43', '2023-06-25 10:07:43', NULL),
(125, 1, 342, 14, NULL, NULL, '2023-06-25 10:07:43', '2023-06-25 10:07:43', NULL),
(126, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:07:43', '2023-06-25 10:07:43', NULL),
(127, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:07:43', '2023-06-25 10:07:43', NULL),
(128, 1, 342, 11, NULL, NULL, '2023-06-25 10:08:52', '2023-06-25 10:08:52', NULL),
(129, 1, 342, 13, NULL, NULL, '2023-06-25 10:08:53', '2023-06-25 10:08:53', NULL),
(130, 1, 342, 14, NULL, NULL, '2023-06-25 10:08:53', '2023-06-25 10:08:53', NULL),
(131, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:08:53', '2023-06-25 10:08:53', NULL),
(132, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:08:53', '2023-06-25 10:08:53', NULL),
(133, 1, 342, 11, NULL, NULL, '2023-06-25 10:09:28', '2023-06-25 10:09:28', NULL),
(134, 1, 342, 13, NULL, NULL, '2023-06-25 10:09:28', '2023-06-25 10:09:28', NULL),
(135, 1, 342, 14, NULL, NULL, '2023-06-25 10:09:28', '2023-06-25 10:09:28', NULL),
(136, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:09:28', '2023-06-25 10:09:28', NULL),
(137, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:09:28', '2023-06-25 10:09:28', NULL),
(138, 1, 342, 11, NULL, NULL, '2023-06-25 10:10:05', '2023-06-25 10:10:05', NULL),
(139, 1, 342, 13, NULL, NULL, '2023-06-25 10:10:05', '2023-06-25 10:10:05', NULL),
(140, 1, 342, 14, NULL, NULL, '2023-06-25 10:10:05', '2023-06-25 10:10:05', NULL),
(141, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:10:05', '2023-06-25 10:10:05', NULL),
(142, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:10:05', '2023-06-25 10:10:05', NULL),
(143, 1, 342, 11, NULL, NULL, '2023-06-25 10:10:26', '2023-06-25 10:10:26', NULL),
(144, 1, 342, 13, NULL, NULL, '2023-06-25 10:10:26', '2023-06-25 10:10:26', NULL),
(145, 1, 342, 14, NULL, NULL, '2023-06-25 10:10:26', '2023-06-25 10:10:26', NULL),
(146, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:10:27', '2023-06-25 10:10:27', NULL),
(147, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:10:27', '2023-06-25 10:10:27', NULL),
(148, 1, 342, 11, NULL, NULL, '2023-06-25 10:11:31', '2023-06-25 10:11:31', NULL),
(149, 1, 342, 13, NULL, NULL, '2023-06-25 10:11:31', '2023-06-25 10:11:31', NULL),
(150, 1, 342, 14, NULL, NULL, '2023-06-25 10:11:31', '2023-06-25 10:11:31', NULL),
(151, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:11:31', '2023-06-25 10:11:31', NULL),
(152, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:11:31', '2023-06-25 10:11:31', NULL),
(153, 1, 342, 11, NULL, NULL, '2023-06-25 10:11:53', '2023-06-25 10:11:53', NULL),
(154, 1, 342, 13, NULL, NULL, '2023-06-25 10:11:53', '2023-06-25 10:11:53', NULL),
(155, 1, 342, 14, NULL, NULL, '2023-06-25 10:11:53', '2023-06-25 10:11:53', NULL),
(156, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:11:53', '2023-06-25 10:11:53', NULL),
(157, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:11:53', '2023-06-25 10:11:53', NULL),
(158, 1, 342, 11, NULL, NULL, '2023-06-25 10:12:18', '2023-06-25 10:12:18', NULL),
(159, 1, 342, 13, NULL, NULL, '2023-06-25 10:12:18', '2023-06-25 10:12:18', NULL),
(160, 1, 342, 14, NULL, NULL, '2023-06-25 10:12:18', '2023-06-25 10:12:18', NULL),
(161, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:12:18', '2023-06-25 10:12:18', NULL),
(162, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:12:18', '2023-06-25 10:12:18', NULL),
(163, 1, 342, 11, NULL, NULL, '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(164, 1, 342, 13, NULL, NULL, '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(165, 1, 342, 14, NULL, NULL, '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(166, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(167, 1, 342, 10, 2, 'App\\Models\\Department', '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(168, 1, 342, 4, 10, 'App\\Models\\User', '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(169, 1, 342, 4, 38, 'App\\Models\\User', '2023-06-25 10:12:47', '2023-06-25 10:12:47', NULL),
(170, 1, 342, 11, NULL, NULL, '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(171, 1, 342, 13, NULL, NULL, '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(172, 1, 342, 14, NULL, NULL, '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(173, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(174, 1, 342, 4, 10, 'App\\Models\\User', '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(175, 1, 342, 4, 38, 'App\\Models\\User', '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(176, 1, 342, 4, 43, 'App\\Models\\User', '2023-06-25 10:13:48', '2023-06-25 10:13:48', NULL),
(177, 1, 342, 11, NULL, NULL, '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(178, 1, 342, 13, NULL, NULL, '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(179, 1, 342, 14, NULL, NULL, '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(180, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(181, 1, 342, 4, 10, 'App\\Models\\User', '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(182, 1, 342, 4, 38, 'App\\Models\\User', '2023-06-25 10:17:06', '2023-06-25 10:17:06', NULL),
(183, 1, 342, 11, NULL, NULL, '2023-06-25 10:20:39', '2023-06-25 10:20:39', NULL),
(184, 1, 342, 13, NULL, NULL, '2023-06-25 10:20:39', '2023-06-25 10:20:39', NULL),
(185, 1, 342, 14, NULL, NULL, '2023-06-25 10:20:39', '2023-06-25 10:20:39', NULL),
(186, 1, 342, 9, 27, 'App\\Models\\Customer', '2023-06-25 10:20:39', '2023-06-25 10:20:39', NULL),
(187, 1, 342, 4, 10, 'App\\Models\\User', '2023-06-25 10:20:39', '2023-06-25 10:20:39', NULL),
(188, 1, 343, 1, NULL, NULL, '2023-09-17 09:50:41', '2023-09-17 09:50:41', NULL),
(189, 1, 343, 4, 21, 'App\\Models\\User', '2023-09-17 09:50:41', '2023-09-17 09:50:41', NULL),
(190, 1, 344, 1, NULL, NULL, '2023-09-17 09:51:13', '2023-09-17 09:51:13', NULL),
(191, 1, 344, 4, 9, 'App\\Models\\User', '2023-09-17 09:51:14', '2023-09-17 09:51:14', NULL),
(192, 1, 344, 16, NULL, NULL, '2023-09-17 09:51:24', '2023-09-17 09:51:24', NULL),
(193, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:29', '2023-09-17 09:51:29', NULL),
(194, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:30', '2023-09-17 09:51:30', NULL),
(195, 1, 344, 16, NULL, NULL, '2023-09-17 09:51:36', '2023-09-17 09:51:36', NULL),
(196, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:39', '2023-09-17 09:51:39', NULL),
(197, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:46', '2023-09-17 09:51:46', NULL),
(198, 1, 344, 16, NULL, NULL, '2023-09-17 09:51:49', '2023-09-17 09:51:49', NULL),
(199, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:51', '2023-09-17 09:51:51', NULL),
(200, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:52', '2023-09-17 09:51:52', NULL),
(201, 1, 344, 18, NULL, NULL, '2023-09-17 09:51:56', '2023-09-17 09:51:56', NULL),
(202, 1, 344, 16, NULL, NULL, '2023-09-17 09:52:01', '2023-09-17 09:52:01', NULL),
(203, 1, 344, 16, NULL, NULL, '2023-09-17 09:52:07', '2023-09-17 09:52:07', NULL),
(204, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:24', '2023-09-17 09:52:24', NULL),
(205, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:25', '2023-09-17 09:52:25', NULL),
(206, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:41', '2023-09-17 09:52:41', NULL),
(207, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:41', '2023-09-17 09:52:41', NULL),
(208, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:42', '2023-09-17 09:52:42', NULL),
(209, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:44', '2023-09-17 09:52:44', NULL),
(210, 1, 344, 18, NULL, NULL, '2023-09-17 09:52:44', '2023-09-17 09:52:44', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Default Descriptionasdsasdasdads', '2023-10-15 10:24:27', '2023-10-27 12:58:35');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/images/profile-icon.webp',
  `type` enum('admin','worker') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'worker',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `whatsapp` tinyint(1) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `email_verified_at`, `password`, `image`, `type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `gender`, `address`, `birthday`, `whatsapp`, `phone`) VALUES
(1, 'Denis', 'Admin', 'admin@gmail.com', '2023-02-06 07:25:36', '$2y$10$GpuAjIpZBZVMO0OgUqt9feW0XT2JJp8euh3mp1QbNDp12mEWglgHO', NULL, 'admin', 'Ab8RigAsLoYaZ5L2pqSzMbI3ktnqDXXtl8CzOzlvL4gQ4eepV8zv2sVJkoRo', '2023-02-06 07:25:36', '2023-10-28 11:02:44', NULL, 1, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_assign_tasks`
--

CREATE TABLE `user_assign_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_assign_tasks`
--

INSERT INTO `user_assign_tasks` (`id`, `user_id`, `task_id`, `created_at`, `updated_at`) VALUES
(14, 1, 4, NULL, NULL),
(17, 1, 5, NULL, NULL),
(20, 1, 6, NULL, NULL),
(381, 1, 304, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `why_questions`
--

CREATE TABLE `why_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `why_questions`
--

INSERT INTO `why_questions` (`id`, `category_id`, `image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 'whyquestion/0i2kyD4DC3GNOmeWGQyhGiCGU2AkrV3TDV7BFpID.jpg', 'Title', 'Description', '2023-10-22 13:55:05', '2023-10-22 13:55:05');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Индексы таблицы `colourings`
--
ALTER TABLE `colourings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colourings_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_type_id_foreign` (`type_id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `differences`
--
ALTER TABLE `differences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `differences_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_receiver_id_foreign` (`receiver_id`),
  ADD KEY `notifications_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `privacy_and_policies`
--
ALTER TABLE `privacy_and_policies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_answers_quiz_question_id_foreign` (`quiz_question_id`);

--
-- Индексы таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_questions_quiz_id_foreign` (`quiz_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_status_id_foreign` (`status_id`),
  ADD KEY `tasks_department_id_foreign` (`department_id`),
  ADD KEY `tasks_priority_id_foreign` (`priority_id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `task_activities`
--
ALTER TABLE `task_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_activities_user_id_foreign` (`user_id`),
  ADD KEY `task_activities_task_id_foreign` (`task_id`),
  ADD KEY `task_activities_action_id_foreign` (`action_id`);

--
-- Индексы таблицы `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_assign_tasks`
--
ALTER TABLE `user_assign_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_assign_tasks_user_id_foreign` (`user_id`),
  ADD KEY `user_assign_tasks_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `why_questions`
--
ALTER TABLE `why_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `why_questions_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `colourings`
--
ALTER TABLE `colourings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `differences`
--
ALTER TABLE `differences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `privacy_and_policies`
--
ALTER TABLE `privacy_and_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT для таблицы `task_activities`
--
ALTER TABLE `task_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT для таблицы `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `user_assign_tasks`
--
ALTER TABLE `user_assign_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT для таблицы `why_questions`
--
ALTER TABLE `why_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `colourings`
--
ALTER TABLE `colourings`
  ADD CONSTRAINT `colourings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `customer_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `differences`
--
ALTER TABLE `differences`
  ADD CONSTRAINT `differences_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `quiz_answers_quiz_question_id_foreign` FOREIGN KEY (`quiz_question_id`) REFERENCES `quiz_questions` (`id`);

--
-- Ограничения внешнего ключа таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`),
  ADD CONSTRAINT `tasks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `task_activities`
--
ALTER TABLE `task_activities`
  ADD CONSTRAINT `task_activities_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_activities_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_assign_tasks`
--
ALTER TABLE `user_assign_tasks`
  ADD CONSTRAINT `user_assign_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_assign_tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `why_questions`
--
ALTER TABLE `why_questions`
  ADD CONSTRAINT `why_questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
