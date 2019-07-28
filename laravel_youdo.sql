-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица laravel_youdo.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) unsigned NOT NULL,
  `to_id` bigint(20) unsigned NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.messages: ~2 rows (приблизительно)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `from_id`, `to_id`, `text`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, '123123123', NULL, NULL),
	(2, 1, 2, 'Test', '2019-07-21 22:31:01', '2019-07-21 22:31:01'),
	(3, 2, 1, 'ASdf', '2019-07-21 22:35:51', '2019-07-21 22:35:51'),
	(4, 1, 2, 'HHH', '2019-07-26 20:34:39', '2019-07-26 20:34:39');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.migrations: ~15 rows (приблизительно)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_07_04_215438_add_new_fields_to_users_table', 2),
	(5, '2019_07_04_221114_add_type_field_to_users_table', 3),
	(9, '2019_07_04_222155_add_tasks_table', 4),
	(15, '2019_07_08_200403_add_legal_fields_to_users_table', 5),
	(16, '2019_07_09_202653_add_fields_to_tasks_table', 6),
	(17, '2019_07_11_150158_create_proposals_table', 7),
	(18, '2019_07_11_152341_add_proposal_id_to_tasks_table', 7),
	(19, '2019_07_11_222915_add_status_field_to_proposals_table', 8),
	(20, '2019_07_16_175055_create_posts_table', 9),
	(21, '2019_07_21_121532_create_messages_table', 10),
	(22, '2019_07_28_082656_add_avatar_column_to_users_table', 11),
	(23, '2019_07_28_082857_add_cover_column_to_posts_table', 12),
	(24, '2019_07_28_123138_add_about_field_to_users_table', 13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.password_resets: ~0 rows (приблизительно)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.posts: ~2 rows (приблизительно)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`, `cover`) VALUES
	(1, 'Тестовый пост', 'Тестовый контент 1234', 1, '2019-07-16 19:13:40', '2019-07-26 15:06:50', 'images/blog/BIoMWXo6iF0B69Z3wpoy9CNVwg6UamerHiXpaImi.jpeg'),
	(4, 'Тест изображения', '12345', 1, '2019-07-28 10:16:54', '2019-07-28 10:16:54', 'images/blog/BIoMWXo6iF0B69Z3wpoy9CNVwg6UamerHiXpaImi.jpeg');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.proposals
DROP TABLE IF EXISTS `proposals`;
CREATE TABLE IF NOT EXISTS `proposals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  `task_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proposals_user_id_foreign` (`user_id`),
  KEY `proposals_task_id_foreign` (`task_id`),
  CONSTRAINT `proposals_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `proposals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.proposals: ~1 rows (приблизительно)
DELETE FROM `proposals`;
/*!40000 ALTER TABLE `proposals` DISABLE KEYS */;
INSERT INTO `proposals` (`id`, `description`, `price`, `user_id`, `task_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Описание предложения', 7500, 2, 3, 1, '2019-07-11 19:20:08', '2019-07-21 12:00:45');
/*!40000 ALTER TABLE `proposals` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.tasks
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `date_end` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `proposal_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_user_id_foreign` (`user_id`),
  KEY `tasks_proposal_id_foreign` (`proposal_id`),
  CONSTRAINT `tasks_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.tasks: ~2 rows (приблизительно)
DELETE FROM `tasks`;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `title`, `description`, `price`, `date_end`, `user_id`, `proposal_id`, `created_at`, `updated_at`) VALUES
	(1, 'Тестовое задание', 'Описание задания', 10000, '2019-07-12 13:00:00', 1, NULL, '2019-07-09 22:24:35', '2019-07-10 21:09:51'),
	(3, 'Тестовое задание1', 'Описание задания1', 10000, '2019-07-30 01:07:00', 1, 1, '2019-07-09 23:24:35', '2019-07-26 16:13:05');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Дамп структуры для таблица laravel_youdo.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `ogrn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы laravel_youdo.users: ~2 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `type`, `about`, `email_verified_at`, `password`, `remember_token`, `is_admin`, `is_verified`, `ogrn`, `phone`, `legal_address`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'User', 'test@mail.ru', NULL, 2, 'Какой-то текст обо мне...', NULL, '$2y$10$XPL/GQKDIXs2FeaUEDCU9eZUb.rqfuPhdMK4J04w2W1513/bNl.Zy', '0fJtW37zY3w8n1E5nkhVOpMXWd4awkjZz7L6LdUOuM0zs2EyzuiLJhWG6jTJ', 1, 0, '12345678', '+79991234567', 'Москва', 'Москва', '2019-07-08 20:50:46', '2019-07-28 16:55:20'),
	(2, 'User2', 'test2@mail.ru', NULL, 1, NULL, NULL, '$2y$10$CQ7NvIFXz3IjgVAZz4VzEO5QLzF2RokLzhTqXrV3x38bs0pjXQ1eu', 'tZ1AyIal99y8kHDWYqoOL9EqEEDxEwyVpBLuB2R6wepFUdLEj1ga8Cgk7iiK', 0, 0, NULL, NULL, NULL, NULL, '2019-07-11 18:59:35', '2019-07-11 18:59:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
