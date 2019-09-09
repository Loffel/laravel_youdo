/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) unsigned NOT NULL,
  `to_id` bigint(20) unsigned NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `from_id`, `to_id`, `text`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, '123123123', NULL, NULL),
	(2, 1, 2, 'Test', '2019-07-21 22:31:01', '2019-07-21 22:31:01'),
	(3, 2, 1, 'ASdf', '2019-07-21 22:35:51', '2019-07-21 22:35:51'),
	(4, 1, 2, 'HHH', '2019-07-26 20:34:39', '2019-07-26 20:34:39');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
	(24, '2019_07_28_123138_add_about_field_to_users_table', 13),
	(31, '2019_09_05_061804_create_reviews_table', 14),
	(32, '2019_09_09_133845_create_notifications_table', 15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('a0a30d5d-f628-4f6b-883e-ffba0079c846', 'App\\Notifications\\UserSelected', 'App\\User', 1, '{"task_id":1,"task_title":"\\u0422\\u0435\\u0441\\u0442\\u043e\\u0432\\u043e\\u0435 \\u0437\\u0430\\u0434\\u0430\\u043d\\u0438\\u0435"}', NULL, '2019-09-09 14:17:25', '2019-09-09 15:28:03'),
	('ecffa252-d093-450c-9f20-e8baf06dd11a', 'App\\Notifications\\NewProposal', 'App\\User', 2, '{"user_name":"User","user_id":1,"task_id":4,"task_title":"\\u0417\\u0430\\u0434\\u0430\\u043d\\u0438\\u0435 \\u0434\\u043b\\u044f \\u0442\\u0435\\u0441\\u0442\\u0430"}', NULL, '2019-09-09 16:24:40', '2019-09-09 16:24:40');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

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

DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`, `cover`) VALUES
	(1, 'Тестовый пост', 'Тестовый контент 1234', 1, '2019-07-16 19:13:40', '2019-08-09 11:02:45', 'images/blog/D5goi2Qfz2YpSEKPjd8KHw6NoqcCiL8zOiLsw4om.jpeg'),
	(4, 'Тест изображения', '12345', 1, '2019-07-28 10:16:54', '2019-07-28 10:16:54', 'images/blog/BIoMWXo6iF0B69Z3wpoy9CNVwg6UamerHiXpaImi.jpeg');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `proposals`;
/*!40000 ALTER TABLE `proposals` DISABLE KEYS */;
INSERT INTO `proposals` (`id`, `description`, `price`, `user_id`, `task_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Описание предложения.', 8000, 1, 3, 4, '2019-07-11 19:20:08', '2019-09-08 11:01:46'),
	(5, 'Проверяем уведомления', 10000, 1, 4, 0, '2019-09-09 16:24:37', '2019-09-09 16:24:37');
/*!40000 ALTER TABLE `proposals` ENABLE KEYS */;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proposal_id` bigint(20) unsigned DEFAULT NULL,
  `task_id` bigint(20) unsigned DEFAULT NULL,
  `courtesy` tinyint(4) NOT NULL,
  `punctuality` tinyint(4) NOT NULL,
  `adequacy` tinyint(4) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_proposal_id_foreign` (`proposal_id`),
  KEY `reviews_task_id_foreign` (`task_id`),
  CONSTRAINT `reviews_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `reviews`;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `proposal_id`, `task_id`, `courtesy`, `punctuality`, `adequacy`, `comment`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 5, 5, 3, 'Отзыв 1', '2019-09-07 16:29:09', '2019-09-08 10:58:15'),
	(2, NULL, 3, 5, 2, 3, 'Test2', '2019-09-08 04:07:41', '2019-09-08 04:07:41');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tasks`;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `title`, `description`, `price`, `date_end`, `user_id`, `proposal_id`, `created_at`, `updated_at`) VALUES
	(3, 'Тестовое задание1', 'Описание задания1', 10000, '2019-07-30 01:07:00', 2, 1, '2019-07-09 23:24:35', '2019-07-26 16:13:05'),
	(4, 'Задание для теста', 'Задание для теста', 50000, '2019-10-01 12:50:00', 2, NULL, '2019-09-09 16:19:51', '2019-09-09 16:19:51');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

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

DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `type`, `about`, `email_verified_at`, `password`, `remember_token`, `is_admin`, `is_verified`, `ogrn`, `phone`, `legal_address`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'User', 'test@mail.ru', NULL, 2, 'Какой-то текст обо мне...', NULL, '$2y$10$XPL/GQKDIXs2FeaUEDCU9eZUb.rqfuPhdMK4J04w2W1513/bNl.Zy', '0fJtW37zY3w8n1E5nkhVOpMXWd4awkjZz7L6LdUOuM0zs2EyzuiLJhWG6jTJ', 1, 0, '12345678', '+79991234567', 'Москва', 'Москва', '2019-07-08 20:50:46', '2019-07-28 16:55:20'),
	(2, 'User2', 'test2@mail.ru', NULL, 1, NULL, NULL, '$2y$10$CQ7NvIFXz3IjgVAZz4VzEO5QLzF2RokLzhTqXrV3x38bs0pjXQ1eu', 'tZ1AyIal99y8kHDWYqoOL9EqEEDxEwyVpBLuB2R6wepFUdLEj1ga8Cgk7iiK', 0, 0, NULL, NULL, NULL, NULL, '2019-07-11 18:59:35', '2019-07-11 18:59:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
