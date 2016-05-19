-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2016 at 02:54 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.6.21-1+donate.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `robot`
--

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commands_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id`, `name`, `data`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'product', '[{"text":"industrial product"},{"image":"b5bbcc9183f5506d8ae166a456a841c5.png"}]', '2016-05-12 00:58:32', '2016-05-12 00:58:32', 1),
(2, 'command1', '[{"text":"text1"},{"image":"8edd50743ef5620afdd22958a32e282d.jpg"}]', '2016-05-12 02:36:47', '2016-05-12 02:36:47', 1),
(3, 'aboutus', '[{"text":"aboutus text"}]', '2016-05-12 04:01:01', '2016-05-12 04:01:01', 1),
(5, 'contactus', '[{"text":"09122012160"}]', '2016-05-12 05:38:25', '2016-05-12 05:38:25', 1),
(6, 'news', '[{"text":"news 1"}]', '2016-05-12 10:15:16', '2016-05-12 05:45:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keyboards`
--

CREATE TABLE IF NOT EXISTS `keyboards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `row` int(11) DEFAULT NULL,
  `column` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `command_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `keyboards_user_id_foreign` (`user_id`),
  KEY `keyboards_parent_id_foreign` (`parent_id`),
  KEY `keyboards_command_id_foreign` (`command_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `keyboards`
--

INSERT INTO `keyboards` (`id`, `name`, `data`, `row`, `column`, `created_at`, `updated_at`, `user_id`, `parent_id`, `command_id`) VALUES
(6, 'keyboard1', '[["command1","aboutus"]]', 1, 2, '2016-05-12 10:07:59', '2016-05-12 05:37:59', 1, NULL, 2),
(8, 'aboutus                           ', '[["aboutus","command1","product"],["command1","aboutus","product"],["aboutus","command1","product"],["command1","aboutus","product"]]', 4, 3, '2016-05-12 10:07:38', '2016-05-12 05:37:38', 1, NULL, 3),
(12, 'contactus', '[["aboutus","contactus","command1"],["command1","product","command1"],["contactus","product","aboutus"]]', 3, 3, '2016-05-12 05:39:11', '2016-05-12 05:39:11', 1, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_25_111324_create_contents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `robotkey` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_robotkey_unique` (`robotkey`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `robotkey`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MohammmadrezaJafari', 'mreza', '', 'mohammadreza1431@yahoo.com', '$2y$10$C8quaojjX6DN1s8k8rdywe4gPIeI1NPlxj15bH2Gz4v1g2DrAzPpy', NULL, '2016-05-12 10:24:19', '2016-05-12 00:56:35');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `commands_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keyboards`
--
ALTER TABLE `keyboards`
  ADD CONSTRAINT `keyboards_command_id_foreign` FOREIGN KEY (`command_id`) REFERENCES `commands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keyboards_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `keyboards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keyboards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
