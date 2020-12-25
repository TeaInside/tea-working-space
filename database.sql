-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ugroups`;
CREATE TABLE `ugroups` (
  `ugroup_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ugroup_id`),
  UNIQUE KEY `username` (`username`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `name` (`name`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `ugroups_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `ugroup_admins`;
CREATE TABLE `ugroup_admins` (
  `ugroup_admin_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ugroup_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ugroup_admin_id`),
  KEY `created_at` (`created_at`),
  KEY `user_id` (`user_id`),
  KEY `ugroup_id` (`ugroup_id`),
  CONSTRAINT `ugroup_admins_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ugroup_admins_ibfk_4` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`ugroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ugroup_channels`;
CREATE TABLE `ugroup_channels` (
  `ugroup_channel_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ugroup_id` bigint(20) unsigned NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ugroup_channel_id`),
  KEY `description` (`description`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `ugroup_id` (`ugroup_id`),
  KEY `channel_name` (`name`),
  FULLTEXT KEY `description_fulltext` (`description`),
  CONSTRAINT `ugroup_channels_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ugroup_channels_ibfk_4` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`ugroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `ugroup_channel_msg`;
CREATE TABLE `ugroup_channel_msg` (
  `ugroup_channel_msg_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ugroup_channel_msg_id`),
  KEY `sender_id` (`sender_id`),
  KEY `created_at` (`created_at`),
  FULLTEXT KEY `content` (`content`),
  CONSTRAINT `ugroup_channel_msg_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `ugroup_members`;
CREATE TABLE `ugroup_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ugroup_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ugroup_id` (`ugroup_id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `ugroup_members_ibfk_3` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`ugroup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ugroup_members_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `ugroup_posts`;
CREATE TABLE `ugroup_posts` (
  `ugroup_post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ugroup_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ugroup_post_id`),
  KEY `ugroup_id` (`ugroup_id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`),
  FULLTEXT KEY `content` (`content`),
  CONSTRAINT `ugroup_posts_ibfk_5` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`ugroup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ugroup_posts_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `username` varchar(72) CHARACTER SET utf32 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf32 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `primary_email` (`email`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


-- 2020-12-25 12:59:05
