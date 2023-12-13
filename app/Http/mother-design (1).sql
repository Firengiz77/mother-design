-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 09:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mother-design`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(2, 'uploads/about/1785059422330964.jpg', '{\"en\":\"Title 1\"}', '2023-12-12 03:15:24', '2023-12-12 03:15:24'),
(3, 'uploads/about/1785059465172718.jpg', '{\"en\":\"Title 2\"}', '2023-12-12 03:16:05', '2023-12-12 03:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` text NOT NULL,
  `email_1` text DEFAULT NULL,
  `email_2` text DEFAULT NULL,
  `email_3` text DEFAULT NULL,
  `email_4` text DEFAULT NULL,
  `address` text NOT NULL,
  `title` text NOT NULL,
  `map` text NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `email_1`, `email_2`, `email_3`, `email_4`, `address`, `title`, `map`, `image`, `created_at`, `updated_at`) VALUES
(1, '+994 70 201 15 42', 'narmin@agillinagillar.com', 'ilham@agillinagillar.com', 'agilli@agillinagillar.com', 'gunay@agillinagillar.com', '{\"az\":\"Kovkeb Safaraliyeva 16E Time Business Center Nizami district\",\"ru\":\"\\u0410\\u0437\\u0435\\u0440\\u0431\\u0430\\u0439\\u0434\\u0436\\u0430\\u043d, \\u0411\\u0430\\u043a\\u0443. \\u041d\\u0430\\u0440\\u0438\\u043c\\u0430\\u043d\\u043e\\u0432\\u0441\\u043a\\u0438\\u0439 \\u0440-\\u043d, \\u043f\\u0440-\\u0442 \\u0424\\u0430\\u0442\\u0430\\u043b\\u0438 \\u0425\\u0430\\u043d \\u0425\\u043e\\u0439\\u0441\\u043a\\u0438\\u0439 144\",\"en\":\"Kovkeb Safaraliyeva 16E Time Business Center Nizami district\"}', '{\"az\":\"Baku, Azerbaijan\",\"en\":\"Baku azerbaijan\"}', 'https://maps.app.goo.gl/QJb7x83k9Ktp5d6t7', 'uploads/contact/1785060085740753.png', NULL, '2023-12-12 03:25:57');

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
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `profession` text NOT NULL,
  `image` text NOT NULL,
  `instagram` text NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`id`, `name`, `profession`, `image`, `instagram`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"az\":\"Bill Gates\"}', '{\"az\":\"Teacher\"}', 'uploads/family/1785021759085794.png', 'instagram.com', '{\"az\":\"<p>google.comgoogle.comgoogle.comgoogle.comgoogle.com<\\/p>\\r\\n\\r\\n<p>google.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.comgoogle.com<\\/p>\"}', '2023-12-11 17:16:45', '2023-12-11 17:16:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Azerbaijan', 'az', '2022-11-01 02:25:07', '2023-11-10 17:18:03', NULL),
(2, 'English', 'en', '2022-11-01 02:34:47', '2023-11-10 18:00:21', '2023-11-10 18:00:21'),
(4, 'Rus', 'ru', '2023-11-09 15:11:11', '2023-11-10 17:17:50', '2023-11-10 17:17:50'),
(5, 'German', 'ge', '2023-11-09 15:12:06', '2023-11-10 17:17:47', '2023-11-10 17:17:47'),
(6, 'France', 'fr', '2023-11-09 15:12:19', '2023-11-10 16:07:00', '2023-11-10 16:07:00'),
(7, 'Italiya', 'it', '2023-11-09 15:12:50', '2023-11-10 16:05:21', '2023-11-10 16:05:21'),
(8, 'test1', 't1', '2023-11-09 15:13:05', '2023-11-10 16:02:28', '2023-11-10 16:02:28'),
(9, 'test2', 't2', '2023-11-09 15:13:15', '2023-11-10 16:00:45', '2023-11-10 16:00:45'),
(10, 'test3', 't3', '2023-11-09 15:13:24', '2023-11-10 15:59:10', '2023-11-10 15:59:10'),
(11, 'test4', 't4', '2023-11-09 15:13:37', '2023-11-10 15:58:34', '2023-11-10 15:58:34'),
(12, 'germm', 'grr', '2023-11-10 15:10:48', '2023-11-10 15:58:38', '2023-11-10 15:58:38'),
(13, 'English', 'en', '2023-11-10 17:18:45', '2023-12-12 03:41:51', '2023-12-12 03:41:51'),
(14, 'Russian', 'ru', '2023-11-10 18:22:18', '2023-12-12 03:41:49', '2023-12-12 03:41:49'),
(15, 'es', 'res', '2023-11-11 17:19:16', '2023-11-11 17:19:20', '2023-11-11 17:19:20');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_11_140437_create_permission_tables', 2),
(6, '2023_11_11_215351_create_abouts_table', 3),
(7, '2023_11_11_215413_create_contacts_table', 3),
(8, '2023_11_11_215431_create_site_settings_table', 3),
(9, '2023_11_11_215752_create_social_links_table', 3),
(10, '2023_11_13_192907_create_banners_table', 4),
(11, '2023_11_14_193232_create_categories_table', 5),
(12, '2023_11_14_193846_create_innovations_table', 6),
(16, '2023_11_15_195956_create_types_table', 7),
(17, '2023_11_16_184753_create_sliders_table', 7),
(18, '2023_11_19_133143_create_products_table', 7),
(19, '2023_11_24_191721_create_services_table', 8),
(20, '2023_11_24_195002_create_attributes_table', 9),
(21, '2023_11_27_115522_create_options_table', 10),
(22, '2023_11_28_192641_create_carts_table', 11),
(23, '2023_12_04_195508_create_messages_table', 12),
(24, '2023_12_11_202556_create_families_table', 13),
(25, '2023_12_12_074404_create_words_table', 14),
(26, '2023_12_13_182931_create_works_table', 15),
(27, '2023_12_13_194357_create_work_attributes_table', 16);

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
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 47);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
(1, 'language-create', 'web', '2023-11-11 12:33:56', '2023-11-11 12:33:56'),
(2, 'language-update', 'web', '2023-11-11 12:34:03', '2023-11-11 17:19:42'),
(3, 'language-delete', 'web', '2023-11-11 12:34:11', '2023-11-11 12:34:11'),
(10, 'blog-list', 'web', '2023-11-11 12:39:22', '2023-11-11 12:39:22'),
(11, 'language-list', 'web', '2023-11-11 12:39:29', '2023-11-11 12:39:29'),
(14, 'role-list', 'web', '2023-11-11 12:44:00', '2023-11-11 17:05:50'),
(15, 'permission-list', 'web', '2023-11-11 12:44:08', '2023-11-11 12:44:08'),
(16, 'role-create', 'web', '2023-11-11 12:44:15', '2023-11-11 17:05:57'),
(17, 'role-update', 'web', '2023-11-11 12:44:21', '2023-11-11 17:06:10'),
(18, 'role-delete', 'web', '2023-11-11 12:44:54', '2023-11-11 17:06:04'),
(19, 'admin-list', 'web', '2023-11-11 16:44:19', '2023-11-11 16:44:19'),
(20, 'admin-create', 'web', '2023-11-11 16:45:15', '2023-11-11 16:45:15'),
(21, 'admin-update', 'web', '2023-11-11 16:45:21', '2023-11-11 16:45:21'),
(22, 'admin-delete', 'web', '2023-11-11 16:45:26', '2023-11-11 16:45:26'),
(23, 'permission-create', 'web', '2023-11-11 16:46:54', '2023-11-11 16:46:54'),
(24, 'permission-update', 'web', '2023-11-11 16:47:00', '2023-11-11 16:47:00'),
(25, 'permission-delete', 'web', '2023-11-11 16:47:06', '2023-11-11 16:47:06'),
(30, 'about-list', 'web', '2023-11-11 18:27:52', '2023-11-11 18:27:52'),
(32, 'contact-list', 'web', '2023-11-11 18:28:06', '2023-11-11 18:28:06'),
(33, 'socialLink-list', 'web', '2023-11-11 18:28:24', '2023-11-11 18:28:24'),
(34, 'socialLink-update', 'web', '2023-11-11 19:17:37', '2023-11-11 19:17:37'),
(35, 'socialLink-delete', 'web', '2023-11-11 19:17:41', '2023-11-11 19:17:41'),
(36, 'socialLink-create', 'web', '2023-11-11 19:17:46', '2023-11-11 19:17:46'),
(54, 'slider-list', 'web', '2023-11-19 09:04:20', '2023-11-19 09:04:39'),
(55, 'slider-create', 'web', '2023-11-19 09:04:29', '2023-11-19 09:04:29'),
(56, 'slider-update', 'web', '2023-11-19 09:04:45', '2023-11-19 09:04:45'),
(57, 'slider-status', 'web', '2023-11-19 09:04:51', '2023-12-11 03:39:58'),
(77, 'family-list', 'web', '2023-12-11 16:38:09', '2023-12-11 16:38:09'),
(78, 'family-create', 'web', '2023-12-11 16:38:13', '2023-12-11 16:38:39'),
(79, 'family-delete', 'web', '2023-12-11 16:38:22', '2023-12-11 16:38:22'),
(80, 'family-update', 'web', '2023-12-11 16:38:44', '2023-12-11 16:38:44'),
(81, 'about-delete', 'web', '2023-12-12 03:09:29', '2023-12-12 03:09:29'),
(82, 'about-update', 'web', '2023-12-12 03:09:40', '2023-12-12 03:09:40'),
(83, 'about-create', 'web', '2023-12-12 03:09:47', '2023-12-12 03:09:47'),
(84, 'word-list', 'web', '2023-12-12 03:50:29', '2023-12-12 03:50:29'),
(85, 'word-create', 'web', '2023-12-12 03:50:37', '2023-12-12 03:50:37'),
(86, 'word-update', 'web', '2023-12-12 03:50:44', '2023-12-12 03:50:44'),
(87, 'word-delete', 'web', '2023-12-12 03:50:54', '2023-12-12 03:50:54'),
(88, 'work-create', 'web', '2023-12-13 15:14:18', '2023-12-13 15:14:18'),
(89, 'work-list', 'web', '2023-12-13 15:14:25', '2023-12-13 15:14:25'),
(90, 'work-update', 'web', '2023-12-13 15:14:32', '2023-12-13 15:14:32'),
(91, 'work-delete', 'web', '2023-12-13 15:14:39', '2023-12-13 15:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Root', 'web', '2023-11-11 12:50:00', '2023-11-11 12:50:00'),
(4, 'Test', 'web', '2023-11-11 15:10:33', '2023-11-11 15:10:33'),
(5, 'User', 'web', '2023-12-02 07:15:53', '2023-12-02 07:15:53');

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
(1, 1),
(2, 1),
(3, 1),
(10, 1),
(10, 5),
(11, 1),
(14, 1),
(14, 4),
(15, 1),
(16, 1),
(17, 1),
(17, 4),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(30, 1),
(30, 5),
(32, 1),
(32, 5),
(33, 1),
(33, 5),
(34, 1),
(34, 5),
(35, 1),
(35, 5),
(36, 1),
(36, 5),
(54, 1),
(54, 5),
(55, 1),
(55, 5),
(56, 1),
(56, 5),
(57, 1),
(57, 5),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_logo` text NOT NULL,
  `logo_1` text NOT NULL,
  `thumb_logo_1` text DEFAULT NULL,
  `logo_2` text NOT NULL,
  `thumb_logo_2` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `main_logo`, `logo_1`, `thumb_logo_1`, `logo_2`, `thumb_logo_2`, `created_at`, `updated_at`) VALUES
(1, 'uploads/setting/1784376092440326.png', 'uploads/setting/1785017790976269.svg', 'uploads/setting/6571a806d073267.png', 'uploads/setting/1785017790992327.svg', 'uploads/setting/6571a806dc3f793.jpg', NULL, '2023-12-11 16:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` text DEFAULT NULL,
  `link` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` int(11) NOT NULL COMMENT '1-image,2 - video/gif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `file`, `link`, `status`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/slider/1785014104513564.png', '{\"az\":\"https:\\/\\/test.gloriaflowers.az\\/category\\/17\",\"en\":\"test\"}', 1, 1, '2023-11-23 15:04:45', '2023-12-13 16:02:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `icon` text NOT NULL,
  `link` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `title`, `icon`, `link`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"az\":\"Instagram\",\"ru\":\"Instagram\"}', 'fab fa-instagram', 'https://www.instagram.com/gloriagarden.az/', 0, '2023-11-11 19:17:02', '2023-12-11 16:25:03', NULL),
(2, '{\"az\":\"Telegram\"}', 'fab fa-facebook', 'https://www.instagram.com/gloriaflowers_az/', 0, '2023-11-11 19:20:02', '2023-12-11 16:25:05', NULL),
(3, '{\"az\":\"Linkedin\"}', 'uploads/socialLinks/1784061475961737.jpg', '#', 1, '2023-12-01 06:53:28', '2023-12-02 08:29:18', '2023-12-02 08:29:18'),
(4, '{\"az\":\"Instagram\"}', 'fab fa-instagram', 'https://www.instagram.com/gloriaflowers_az/', 1, '2023-12-02 08:30:09', '2023-12-02 08:30:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `opassword` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthdate` text DEFAULT NULL,
  `client_code` varchar(255) DEFAULT NULL,
  `admin_status` int(11) DEFAULT 1,
  `superadmin` int(11) DEFAULT NULL,
  `clientCode` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `image`, `address`, `email_verified_at`, `password`, `opassword`, `remember_token`, `created_at`, `updated_at`, `gender`, `phone`, `birthdate`, `client_code`, `admin_status`, `superadmin`, `clientCode`) VALUES
(1, 'Firengiz', 'Sariyeva', 'firengizsariyeva77@gmail.com', '2023111118492.png', NULL, NULL, '$2a$12$gKjL.AsbsCMJ06CnDDGd5uC23K7l3Ff.7sC01v.MEaDRkyP7.4e8e', 'Firengiz78', NULL, '2022-08-17 04:53:45', '2023-11-28 13:42:04', NULL, NULL, NULL, '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Salam\"}', '2023-12-12 03:51:13', '2023-12-12 03:51:13'),
(2, '{\"en\":\"Necesiz\"}', '2023-12-12 03:51:17', '2023-12-12 03:51:17'),
(3, '{\"en\":\"Hello 2\"}', '2023-12-12 03:51:21', '2023-12-12 03:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `title` text NOT NULL,
  `file` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-image,2-video',
  `desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `name`, `title`, `file`, `type`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"en\":\"Name 1 e e\"}', '{\"en\":\"title 1e\"}', 'uploads/work/1785196492691492.gif', 1, '{\"en\":\"<p>Name 1<\\/p>\\r\\n\\r\\n<p>Name 1<\\/p>\"}', '2023-12-13 15:21:36', '2023-12-13 16:05:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_attributes`
--

CREATE TABLE `work_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_id` text NOT NULL,
  `file_1` text NOT NULL,
  `file_2` text DEFAULT NULL,
  `file_3` text DEFAULT NULL,
  `type_1` text NOT NULL,
  `type_2` text DEFAULT NULL,
  `type_3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_attributes`
--
ALTER TABLE `work_attributes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_attributes`
--
ALTER TABLE `work_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
