-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2016 at 06:08 AM
-- Server version: 5.5.52-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `GMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `google_domains`
--

DROP TABLE IF EXISTS `google_domains` ;
CREATE TABLE IF NOT EXISTS `google_domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=103 ;

--
-- Dumping data for table `google_domains`
--

INSERT INTO `google_domains` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(103, 'dumasschools.net', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
-- (101, 'dumasisd.org', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
-- (102, 'disd.me', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings` ;
CREATE TABLE IF NOT EXISTS `settings` (
  `SET_id` int(11) NOT NULL AUTO_INCREMENT,
  `SET_name` varchar(50) NOT NULL,
  `SET_value` varchar(50) NOT NULL,
  PRIMARY KEY (`SET_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SET_id`, `SET_name`, `SET_value`) VALUES
(1, 'Google_API_key', 'Google API key here'),
(2, 'Google_API_pass', 'api password or secret here');

-- --------------------------------------------------------

--
-- Table structure for table `smart_groups`
--

DROP TABLE IF EXISTS `smart_groups` ;
CREATE TABLE IF NOT EXISTS `smart_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_group_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smart` tinyint(1) NOT NULL DEFAULT '0',
  `google_domain_id` int(10) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `pattern_condition` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `smart_groups`
--

INSERT INTO `smart_groups` (`id`, `name`, `email`, `google_group_id`, `description`, `smart`, `google_domain_id`, `type`, `pattern_condition`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2028', '2028@disd.me', '00vx122716m7wcw', 'class of 2028', 1, 102, 1, '{"condition":"AND","rules":[{"id":"email_value","field":"email_value","type":"string","input":"text","operator":"begins_with","value":"28"},{"id":"email_value","field":"email_value","type":"string","input":"text","operator":"ends_with","value":"@disd.me"}]}', NULL, NULL, NULL),
(2, 'cost center', 'CC101@dumasisd.org', '00qsh70q165wgph', 'cost ce', 1, 101, 1, '{"condition":"AND","rules":[{"id":"costcenter","field":"costcenter","type":"string","input":"text","operator":"equal","value":"CC101"}]}', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users` ;
CREATE TABLE IF NOT EXISTS `users` (
  `USR_id` bigint(240) NOT NULL AUTO_INCREMENT,
  `USR_username` varchar(100) NOT NULL,
  `USR_fname` varchar(100) NOT NULL,
  `USR_lname` varchar(100) NOT NULL,
  `USR_pass` varchar(100) NOT NULL DEFAULT 'nopass',
  PRIMARY KEY (`USR_id`),
  UNIQUE KEY `USR_username` (`USR_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `users` default demo password is 1234
--

-- where 11111 is the login_seed in the config.ini file

INSERT INTO `users` (`USR_id`, `USR_username`, `USR_fname`, `USR_lname`, `USR_pass`) VALUES
(1, 'demo', 'keough', 'account',sha1('admin11111')), 
(2, 'admin', 'admin', 'admin', sha1('admin11111'));
