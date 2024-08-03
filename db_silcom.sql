-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_silcom
CREATE DATABASE IF NOT EXISTS `db_silcom` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_silcom`;

-- Dumping structure for table db_silcom.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.categories: ~5 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Beginner', 'Beginner', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(2, 'Intermediate', 'Intermediate', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(3, 'Advanced', 'Advanced', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(4, 'Expert', 'Expert', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(5, 'Professional', 'Professional', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(6, 'Tester', 'Tester Categories', '2024-08-01 06:41:23', '2024-08-01 06:47:07');

-- Dumping structure for table db_silcom.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `duration` int NOT NULL,
  `quota` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `image_poster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_title_unique` (`title`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.courses: ~12 rows (approximately)
DELETE FROM `courses`;
INSERT INTO `courses` (`id`, `category_id`, `title`, `price`, `duration`, `quota`, `description`, `status`, `image_poster`, `image_banner`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Highhway Course', 369, 6, 2, 'Illum ut enim eum. Ipsam occaecati dicta voluptates eveniet. Possimus voluptas minus quo provident quia asperiores.', 'Active', 'data-course/image_poster/highhway course_poster_20240801.jpg', 'data-course/image_banner/highhway course_banner_20240801.jpg', '2024-07-31 18:34:05', '2024-08-01 00:05:32'),
	(3, 4, 'officiis Course', 135, 5, 8, 'Ratione deleniti voluptatem et laborum voluptas. Nesciunt ut unde debitis quibusdam eos rem impedit. Consequuntur quas est nobis culpa qui. Sint suscipit numquam eaque et perferendis qui. Eius dolore sint ut.', 'Active', 'https://via.placeholder.com/640x480.png/000022?text=sports+poster+ut', 'https://via.placeholder.com/1280x720.png/00cc77?text=sports+banner+voluptatem', '2024-07-31 18:34:05', '2024-08-02 19:02:14'),
	(4, 4, 'atque Course', 881, 6, 6, 'Rem expedita dolorem officia. Eum rerum delectus doloremque quas enim ipsa. Asperiores neque consequatur quas repellat rerum.', 'Inactive', 'https://via.placeholder.com/640x480.png/00bbdd?text=sports+poster+natus', 'https://via.placeholder.com/1280x720.png/009922?text=sports+banner+iure', '2024-07-31 18:34:05', '2024-08-02 21:37:15'),
	(5, 3, 'voluptatem Course', 461, 4, 12, 'Eum sed sit et officiis eum iste perspiciatis error. Nihil quidem et itaque nesciunt porro dolor laudantium. Totam ut sunt esse quis non. Dolores aut dolor ratione nemo necessitatibus. Est sed quisquam aspernatur dolorem.', 'Active', 'https://via.placeholder.com/640x480.png/00eecc?text=sports+poster+possimus', 'https://via.placeholder.com/1280x720.png/005522?text=sports+banner+rerum', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(7, 5, 'ad Course', 140, 7, 0, 'Aspernatur voluptas quo id velit voluptas et nisi. Consequatur et sint quaerat ad reiciendis. Provident et quisquam deleniti. Corporis libero repudiandae id dolorum.', 'Active', 'https://via.placeholder.com/640x480.png/00ee33?text=sports+poster+optio', 'https://via.placeholder.com/1280x720.png/007711?text=sports+banner+fugit', '2024-07-31 18:34:05', '2024-08-01 07:20:54'),
	(8, 5, 'ratione Course', 247, 4, 7, 'Eos sed pariatur rerum tempore optio et deleniti. Odit sint incidunt voluptas qui. Corrupti doloremque fuga ipsa vel est aliquid voluptas ut.', 'Active', 'https://via.placeholder.com/640x480.png/003333?text=sports+poster+officia', 'https://via.placeholder.com/1280x720.png/00eedd?text=sports+banner+sed', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(9, 1, 'velit Course', 746, 6, 3, 'Enim laboriosam voluptas dolor sunt soluta. Quidem quaerat voluptatem explicabo est illum a. Non qui voluptas accusamus eveniet et eligendi. Inventore sit modi exercitationem reprehenderit eos nihil.', 'Active', 'https://via.placeholder.com/640x480.png/0055bb?text=sports+poster+quis', 'https://via.placeholder.com/1280x720.png/00dddd?text=sports+banner+ipsum', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(11, 1, 'Basic Driving Course', 99, 7, 11, 'This course covers the basics of driving, including vehicle operation, traffic rules, and basic driving techniques.', 'Active', 'https://example.com/images/basic-driving-course-poster.jpg', 'https://example.com/images/basic-driving-course-banner.jpg', '2024-07-31 18:34:06', '2024-08-02 19:19:24'),
	(12, 3, 'Advanced Driving Course', 143, 11, 12, 'This course is designed for experienced drivers and includes advanced driving techniques, defensive driving, and driving in adverse weather conditions.', 'Active', 'https://example.com/images/advanced-driving-course-poster.jpg', 'https://example.com/images/advanced-driving-course-banner.jpg', '2024-07-31 18:34:06', '2024-07-31 18:34:06'),
	(14, 1, 'Driver Tetst', 23, 3, 2, 'Politics is the art of governance and power.', 'Active', 'data-course/image_poster/driver tetst_poster_20240801.jpg', 'data-course/image_banner/driver tetst_banner_20240801.jpg', '2024-07-31 22:12:03', '2024-07-31 22:12:03'),
	(15, 1, 'Tester Driver', 26, 5, 6, 'Wellness, fitness, and medical advice for optimal health.', 'Active', 'data-course/image_poster/tester driver_poster_20240803.jpg', 'data-course/image_banner/tester driver_banner_20240803.jpg', '2024-08-02 22:12:15', '2024-08-02 22:15:41'),
	(16, 1, 'Tester Silcom', 47, 6, 8, 'Politics is the art of governance and power.', 'Active', 'data-course/image_poster/tester silcom_poster_20240803.jpg', 'data-course/image_banner/tester silcom_banner_20240803.jpg', '2024-08-02 22:38:15', '2024-08-02 22:40:49');

-- Dumping structure for table db_silcom.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table db_silcom.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_07_31_034224_create_permission_tables', 1),
	(6, '2024_08_01_005628_create_categories_table', 1),
	(7, '2024_08_01_010213_create_courses_table', 1),
	(8, '2024_08_02_030205_create_order_payments_table', 2);

-- Dumping structure for table db_silcom.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.model_has_permissions: ~4 rows (approximately)
DELETE FROM `model_has_permissions`;
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(1, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 6);

-- Dumping structure for table db_silcom.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.model_has_roles: ~4 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(2, 'App\\Models\\User', 6);

-- Dumping structure for table db_silcom.order_payments
CREATE TABLE IF NOT EXISTS `order_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_payments_transaction_code_unique` (`transaction_code`),
  KEY `order_payments_course_id_foreign` (`course_id`),
  KEY `order_payments_user_id_foreign` (`user_id`),
  CONSTRAINT `order_payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `order_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.order_payments: ~4 rows (approximately)
DELETE FROM `order_payments`;
INSERT INTO `order_payments` (`id`, `course_id`, `user_id`, `status`, `transaction_code`, `payment_method`, `account_number`, `created_at`, `updated_at`) VALUES
	(3, 3, 2, 'Paid', 'MGKDATFF3C', 'BNI - Credit Card', '48111111-1114', '2024-08-02 18:28:17', '2024-08-02 19:02:14'),
	(4, 11, 2, 'Paid', '6LXCMY741V', 'BNI - Credit Card', '48111111-1114', '2024-08-02 19:11:11', '2024-08-02 19:19:24'),
	(6, 15, 2, 'Paid', 'U06TCHEVCZ', 'BNI - Credit Card', '48111111-1114', '2024-08-02 22:14:57', '2024-08-02 22:15:41'),
	(7, 16, 2, 'Paid', 'FGLSQOP0Q1', 'BNI - Credit Card', '48111111-1114', '2024-08-02 22:40:02', '2024-08-02 22:40:49');

-- Dumping structure for table db_silcom.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table db_silcom.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.permissions: ~2 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Active', 'web', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(2, 'Inactive', 'web', '2024-07-31 18:34:05', '2024-07-31 18:34:05');

-- Dumping structure for table db_silcom.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table db_silcom.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.roles: ~2 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(2, 'Customer', 'web', '2024-07-31 18:34:05', '2024-07-31 18:34:05');

-- Dumping structure for table db_silcom.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.role_has_permissions: ~0 rows (approximately)
DELETE FROM `role_has_permissions`;

-- Dumping structure for table db_silcom.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nik_unique` (`nik`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_silcom.users: ~4 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `nik`, `phone`, `email_verified_at`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'adminsilcom123@gmail.com', '3510160202020003', '081234567891', '2024-07-31 18:34:05', '$2y$10$8h0wPYdpC4Aw7JEONdrk4u55w1.qn1HZdZ6hXfHZX2GR02xCO8//2', 'Jl. Semarang 29, Semarang', NULL, '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(2, 'Ferdian Firmansyah', 'ferdianfir219@gmail.com', '3510160202020004', '081234567892', '2024-07-31 18:34:05', '$2y$10$HikOPOTiRZLMZ/4G2CZbfuhC1eIpbx1/3hZNhCE99M4FtqTI1dbIW', 'Jl. Semarang 19, Semarang', NULL, '2024-07-31 18:34:05', '2024-07-31 18:34:05'),
	(3, 'Yusuf Dian', 'yusufdian@gmail.com', '3510160202020005', '081234567893', '2024-07-31 18:34:05', '$2y$10$hgDTpUhjyIshRTbGsP6kHutTfyLmAJyXO9/9ffUH/jA2urJIO24aW', 'Jl. Semarang 39, Semarang', NULL, '2024-07-31 18:34:05', '2024-08-01 07:53:27'),
	(6, 'Angel Oka', 'angeloka@gmail.com', '3510160402030004', '081337915702', NULL, '$2y$10$FqYFQLSA4Fg8RppfYg4ZzewXrl4lH0Q7UU2HkDtZ6KD3MJYudu0uu', 'JL Bunyu 29 Banyuwangi', NULL, '2024-07-31 20:03:53', '2024-07-31 20:03:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
