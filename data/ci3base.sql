-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2017 at 10:02 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ci3test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('05168cd544a2927475e756bb17eba5a1081f9ef8', '127.0.0.1', 1491903660, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333430373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b),
('13026bd4dd472ce2dbb5e34134ebe34505b1f963', '127.0.0.1', 1491906308, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930363031303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b),
('2998f9f3bba734fe201685af0bbd126bdc131aa0', '127.0.0.1', 1491903356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333036353b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b),
('33f8442aee374773b77b0867d00ad6eac927d360', '127.0.0.1', 1491906467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930363331323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a227a68223b),
('501767844202c21118ba583a12793df51986442d', '127.0.0.1', 1492743965, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439323734333936353b7365745f6c616e67756167657c733a323a227a68223b6964656e746974797c733a31323a227465737440636d732e636f6d223b656d61696c7c733a31323a227465737440636d732e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313439323734323938373b),
('6347ab3361037da756ff6a6b49aaf1945b970f7d', '127.0.0.1', 1491904510, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930343231363b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b),
('b2ee43b0f8f41f8a45b148dcdaf0233c73c4903b', '127.0.0.1', 1491902641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930323433383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b),
('b52aed9dc469a1c47849f8d4719bf98bb81638ff', '127.0.0.1', 1491900897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930303838393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a227a68223b),
('cc0dbee1bcabe812be833f786a55f0f6a38ff31e', '127.0.0.1', 1491903936, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333739303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343930373632343839223b6c6173745f636865636b7c693a313439313838313431303b7365745f6c616e67756167657c733a323a22656e223b6d6573736167657c733a32383a224c616e67756167652075706461746564207375636365737366756c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('f92ec7024bbf2a9974c454954f3a2a9f71dc09ca', '127.0.0.1', 1492743980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439323734333936353b7365745f6c616e67756167657c733a323a227a68223b6964656e746974797c733a31323a227465737440636d732e636f6d223b656d61696c7c733a31323a227465737440636d732e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313439323734323938373b6d6573736167657c733a34343a22596f7520617265206e6f7420616c6c6f77656420746f207669736974207468652047726f7570732070616765223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226e6577223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'member', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `language_directory` varchar(100) NOT NULL,
  `slug` varchar(10) NOT NULL,
  `language_code` varchar(20) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_directory`, `slug`, `language_code`, `default`) VALUES
(1, 'English', 'english', 'en', 'en', 1),
(2, '中文', 'traditional_chinese', 'zh', 'zh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `text`) VALUES
(1, 'title1', 'slug1', 'text1'),
(2, 'title2', 'slug2', 'text2'),
(6, 'title3', 'title3', 'text3'),
(7, 'title3', 'title3', 'text3');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `order` int(4) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `order`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 0, 0, '2017-04-11 08:59:06', NULL, NULL, 1, NULL, NULL),
(2, 0, 0, '2017-04-11 09:00:35', NULL, NULL, 1, NULL, NULL),
(3, 0, 0, '2017-04-11 09:01:14', NULL, NULL, 1, NULL, NULL),
(5, 0, 0, '2017-04-11 09:13:27', '2017-04-11 09:13:46', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `language_slug` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `menu_title` varchar(255) NOT NULL,
  `teaser` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_description` varchar(170) NOT NULL,
  `page_keywords` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `language_slug`, `title`, `menu_title`, `teaser`, `content`, `page_title`, `page_description`, `page_keywords`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 'en', 'page en', 'page en', '0', '', 'page en', '', '', '2017-04-11 08:59:06', NULL, NULL, 1, NULL, NULL),
(2, 2, 'en', 'page en', 'page en', '0', '', 'page en', '', '', '2017-04-11 09:00:35', NULL, NULL, 1, NULL, NULL),
(3, 3, 'en', 'page en', 'page en', '0', '', 'page en', '', '', '2017-04-11 09:01:14', NULL, NULL, 1, NULL, NULL),
(6, 5, 'en', 'en test2', 'en test2', '0', '', 'en test2', '', '', '2017-04-11 09:13:27', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE `slugs` (
  `id` int(11) NOT NULL,
  `content_type` varchar(150) NOT NULL,
  `content_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  `language_slug` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `redirect` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slugs`
--

INSERT INTO `slugs` (`id`, `content_type`, `content_id`, `translation_id`, `language_slug`, `url`, `redirect`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(3, 'page', 5, 6, 'en', 'en-test2', 0, '2017-04-11 09:13:27', NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'H0sTL2Dqrt92X6N7I4Ni1O', 1268889823, 1491881410, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', 'c', '$2y$08$0/9LHcAaSePnPli89FmYsuJdbQ7myVXuzivLchoSHlpQj9o.P99Zi', NULL, '123@abc.com', NULL, NULL, NULL, NULL, 1490765570, NULL, 1, 'a', 'b', NULL, NULL),
(3, '127.0.0.1', 'name1', '$2y$08$ICTctBpT8rQMIS0OrmiUPOFSyvitcWGSqdBp2Ce/jSR/u1U4/hoqS', NULL, 'email1@abc.com', NULL, NULL, NULL, NULL, 1490765631, 1490841227, 1, 'first1', 'last1', NULL, NULL),
(4, '127.0.0.1', 'test', '$2y$08$3YuoPOIm8KLaS7saF7GcQeyQ/V4Ci3Rdvc..2311qUT83Cl8XOoXS', NULL, 'test@cms.com', NULL, NULL, NULL, 'oqrwURv0KemizpC9CnIdvO', 1491883905, 1492742987, 1, 'test', 'test', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(6, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `slugs`
--
ALTER TABLE `slugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
