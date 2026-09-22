-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2026 at 11:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miralbeauty`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_duplicator_activity_logs`
--

CREATE TABLE `wp_duplicator_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `sub_type` varchar(100) NOT NULL,
  `severity` int(8) NOT NULL,
  `title` text NOT NULL,
  `data` longtext NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `version` varchar(30) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_duplicator_backups`
--

CREATE TABLE `wp_duplicator_backups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `archive_name` varchar(350) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  `flags` varchar(500) NOT NULL DEFAULT '',
  `package` longtext NOT NULL,
  `version` varchar(30) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_duplicator_entities`
--

CREATE TABLE `wp_duplicator_entities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `value_1` varchar(255) NOT NULL DEFAULT '',
  `value_2` varchar(255) NOT NULL DEFAULT '',
  `value_3` varchar(255) NOT NULL DEFAULT '',
  `value_4` varchar(255) NOT NULL DEFAULT '',
  `value_5` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `version` varchar(30) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_duplicator_entities`
--

INSERT INTO `wp_duplicator_entities` (`id`, `type`, `value_1`, `value_2`, `value_3`, `value_4`, `value_5`, `data`, `version`, `created_at`, `updated_at`) VALUES
(1, 'Global_Entity', '', '', '', '', '', '{\n    \"email_summary_frequency\": \"weekly\",\n    \"email_summary_recipients\": [],\n    \"usageTracking\": false,\n    \"amNotices\": true,\n    \"package_mysqldump\": false,\n    \"package_mysqldump_path\": \"\",\n    \"package_phpdump_mode\": 0,\n    \"package_mysqldump_qrylimit\": 131072,\n    \"packageMysqldumpOptions\": [\n        {\n            \"option\": \"quick\",\n            \"inputGroupPrefix\": \"package_mysqldump_\",\n            \"possibleArguments\": [],\n            \"enabled\": false,\n            \"arguments\": []\n        },\n        {\n            \"option\": \"extended-insert\",\n            \"inputGroupPrefix\": \"package_mysqldump_\",\n            \"possibleArguments\": [],\n            \"enabled\": false,\n            \"arguments\": []\n        },\n        {\n            \"option\": \"routines\",\n            \"inputGroupPrefix\": \"package_mysqldump_\",\n            \"possibleArguments\": [],\n            \"enabled\": true,\n            \"arguments\": []\n        },\n        {\n            \"option\": \"disable-keys\",\n            \"inputGroupPrefix\": \"package_mysqldump_\",\n            \"possibleArguments\": [],\n            \"enabled\": false,\n            \"arguments\": []\n        },\n        {\n            \"option\": \"compact\",\n            \"inputGroupPrefix\": \"package_mysqldump_\",\n            \"possibleArguments\": [],\n            \"enabled\": false,\n            \"arguments\": []\n        }\n    ],\n    \"archive_build_mode\": 3,\n    \"archive_compression\": true,\n    \"ziparchive_validation\": false,\n    \"ziparchive_mode\": 0,\n    \"ziparchive_chunk_size_in_mb\": 64,\n    \"homepath_as_abspath\": false,\n    \"server_load_reduction\": 0,\n    \"max_package_runtime_in_min\": 90,\n    \"max_package_transfer_time_in_min\": 90,\n    \"cleanup_mode\": 0,\n    \"cleanup_email\": \"\",\n    \"auto_cleanup_hours\": 24,\n    \"installer_name_mode\": \"withhash\",\n    \"skip_archive_scan\": false,\n    \"send_email_on_build_mode\": 1,\n    \"notification_email_address\": \"\",\n    \"storage_htaccess_off\": false,\n    \"purgeBackupRecords\": 0,\n    \"manual_mode_storage_ids\": [],\n    \"last_system_check_timestamp\": 0,\n    \"initial_activation_timestamp\": 0,\n    \"ssl_useservercerts\": true,\n    \"ssl_disableverify\": true,\n    \"ipv4_only\": false,\n    \"unhook_third_party_js\": false,\n    \"unhook_third_party_css\": false,\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 1,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": []\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(2, 'Dynamic_Entity', '', '', '', '', '', '{\n    \"data\": \"CBC:9x4yPPu1zAsVlr6f\\/zsuHgHY4pDZ6bT4NaA0Nc7JQ9YYf\\/4Cu\\/7ro9OYhFMbLxir3UdcrjdniarK1RfuOlZ0EQtJ5uuTs8ppYjztFFjRJFv3r1hVgM0\\/kmQzjXyoQ6\\/lLv\\/aa8Isa+uKULKXWNnSQoFG048rEoLVx98qmEUV0ACCeSd8xi7nMQOnLJnd40sVW+tlNlknm10a3gxtiqf2OpkwrODFsWEC\",\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 2,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 21:06:53\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": [\n        \"data\"\n    ]\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:36:53'),
(3, 'Storage_Entity', '', '', '', '', '', '{\n    \"name\": \"Default\",\n    \"notes\": \"The default location for storage on this server.\",\n    \"storage_type\": -2,\n    \"config\": \"CBC:k1Y3jcyzTZx6m7ut4EMj0Wyx\\/dD8bgACVQtZrbSAd2Zhhuoabh5B4M45ncUrbIm18kgYGHMojhH8X0MbLDSH+lfIt+VVNAQCURnV63XaCDZSULEjEfw4NI9wcl7owud6OV19phOmcvNCydr+Sei0QOmLxhqG8ACBj+VzJauHhHUE4gKtLG7qEtBoXDjdbXavUM\\/nnhtrMfpNcDVgQtCsMleW8L4g+Sgry5+X8jKlapc5B9WkzjPTsMa79RTBP7jI\",\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 3,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": [\n        \"config\"\n    ]\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(4, 'EmailSummary', '', '', '', '', '', '{\n    \"manualPackageIds\": [],\n    \"failedPackageIds\": [],\n    \"failedUploads\": [],\n    \"cancelledUploads\": [],\n    \"successfulUploads\": [],\n    \"storageIds\": [\n        5\n    ],\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 4,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\"\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(6, 'Package_Template_Entity', '', '', '', '', '', '{\n    \"name\": \"Default\",\n    \"package_name_format\": \"%year%%month%%day%_%sitetitle%\",\n    \"notes\": \"The default template.\",\n    \"archive_export_onlydb\": false,\n    \"archive_filter_on\": false,\n    \"archive_filter_dirs\": \"\",\n    \"archive_filter_exts\": \"\",\n    \"archive_filter_files\": \"\",\n    \"archive_filter_names\": false,\n    \"components\": [\n        \"package_component_db\",\n        \"package_component_core\",\n        \"package_component_plugins\",\n        \"package_component_themes\",\n        \"package_component_uploads\",\n        \"package_component_other\"\n    ],\n    \"database_filter_on\": false,\n    \"databasePrefixFilter\": false,\n    \"databasePrefixSubFilter\": false,\n    \"database_filter_tables\": \"\",\n    \"database_compatibility_modes\": \"\",\n    \"installer_opts_secure_on\": 0,\n    \"installerPassowrd\": \"CBC:IGH1LXCkEgu\\/B3q4uDB3KaOGJUt7auMpnzEspIaoXBIFK4X0G2He+1VQSI+oS7QfRr4dy1mZELPPvtWNPzf9Jx9\\/QeIkzLkrKn3+Irb+CtA=\",\n    \"installer_opts_skip_scan\": false,\n    \"installer_opts_db_host\": \"\",\n    \"installer_opts_db_name\": \"\",\n    \"installer_opts_db_user\": \"\",\n    \"installer_opts_cpnl_enable\": false,\n    \"installer_opts_cpnl_host\": \"\",\n    \"installer_opts_cpnl_user\": \"\",\n    \"installer_opts_cpnl_pass\": \"\",\n    \"installer_opts_cpnl_db_action\": \"create\",\n    \"installer_opts_cpnl_db_host\": \"\",\n    \"installer_opts_cpnl_db_name\": \"\",\n    \"installer_opts_cpnl_db_user\": \"\",\n    \"extraData\": [],\n    \"is_default\": true,\n    \"is_manual\": false,\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 6,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": [\n        \"installerPassowrd\"\n    ]\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(7, 'Package_Template_Entity', '', '', '', '', '', '{\n    \"name\": \"[Manual Mode]\",\n    \"package_name_format\": \"%year%%month%%day%_%sitetitle%\",\n    \"notes\": \"\",\n    \"archive_export_onlydb\": false,\n    \"archive_filter_on\": false,\n    \"archive_filter_dirs\": \"\",\n    \"archive_filter_exts\": \"\",\n    \"archive_filter_files\": \"\",\n    \"archive_filter_names\": false,\n    \"components\": [\n        \"package_component_db\",\n        \"package_component_core\",\n        \"package_component_plugins\",\n        \"package_component_themes\",\n        \"package_component_uploads\",\n        \"package_component_other\"\n    ],\n    \"database_filter_on\": false,\n    \"databasePrefixFilter\": false,\n    \"databasePrefixSubFilter\": false,\n    \"database_filter_tables\": \"\",\n    \"database_compatibility_modes\": \"\",\n    \"installer_opts_secure_on\": 0,\n    \"installerPassowrd\": \"CBC:\\/ngw+OZ5+SV8VBMLgGZ9Nxvia9VcauYWFdbsIoJBUDCmYrMelK569pqk6gLC89CDQWnXLX2Fg2PJLtNp\\/7nSmQpJzp6lT+4x6vBRhx3eElg=\",\n    \"installer_opts_skip_scan\": false,\n    \"installer_opts_db_host\": \"\",\n    \"installer_opts_db_name\": \"\",\n    \"installer_opts_db_user\": \"\",\n    \"installer_opts_cpnl_enable\": false,\n    \"installer_opts_cpnl_host\": \"\",\n    \"installer_opts_cpnl_user\": \"\",\n    \"installer_opts_cpnl_pass\": \"\",\n    \"installer_opts_cpnl_db_action\": \"create\",\n    \"installer_opts_cpnl_db_host\": \"\",\n    \"installer_opts_cpnl_db_name\": \"\",\n    \"installer_opts_cpnl_db_user\": \"\",\n    \"extraData\": [],\n    \"is_default\": false,\n    \"is_manual\": true,\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 7,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": [\n        \"installerPassowrd\"\n    ]\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(8, 'Fixes_Entity', '', '', '', '', '', '{\n    \"fixes\": [],\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 8,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\",\n    \"decryptPropsErrors\": [],\n    \"__encrypted\": []\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02'),
(9, 'AutoTune_Session_Entity', '', '', '', '', '', '{\n    \"status\": 0,\n    \"settingsSnapshot\": [],\n    \"attempts\": [],\n    \"startingConfig\": [],\n    \"startTelemetryEvent\": [],\n    \"pendingStopStatus\": 0,\n    \"pendingStopReason\": \"\",\n    \"pendingStopMessage\": \"\",\n    \"stopReason\": \"\",\n    \"unavailableValues\": [],\n    \"userExcludedValues\": [],\n    \"startedAt\": 0,\n    \"deadlineAt\": 0,\n    \"endedAt\": 0,\n    \"failureMessage\": \"\",\n    \"value1\": \"\",\n    \"value2\": \"\",\n    \"value3\": \"\",\n    \"value4\": \"\",\n    \"value5\": \"\",\n    \"id\": 9,\n    \"version\": \"5.0.4\",\n    \"created\": \"2026-09-22 20:33:02\",\n    \"updated\": \"2026-09-22 20:33:02\"\n}', '5.0.4', '2026-09-22 17:03:02', '2026-09-22 17:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mirall_bookings`
--

CREATE TABLE `wp_mirall_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(32) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `customer_name` varchar(190) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `model_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `amount` decimal(18,0) NOT NULL DEFAULT 0,
  `payment_status` varchar(30) NOT NULL DEFAULT 'unpaid',
  `payment_ref` varchar(100) NOT NULL DEFAULT '',
  `note` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mirall_otp`
--

CREATE TABLE `wp_mirall_otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `code_hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mirall_sms_logs`
--

CREATE TABLE `wp_mirall_sms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `event` varchar(50) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `response` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mirall_tickets`
--

CREATE TABLE `wp_mirall_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thread_token` varchar(64) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(190) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'new',
  `created_at` datetime NOT NULL,
  `replied_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/MiralBeauty', 'yes'),
(2, 'home', 'http://localhost/MiralBeauty', 'yes'),
(3, 'blogname', 'Mirall Beauty', 'yes'),
(4, 'blogdescription', 'خانه زیبایی شما', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'admin@mirall.local', 'yes'),
(7, 'start_of_week', '6', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'closed', 'yes'),
(20, 'default_ping_status', 'closed', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:263:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:17:\"mirall-service/?$\";s:34:\"index.php?post_type=mirall_service\";s:47:\"mirall-service/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?post_type=mirall_service&feed=$matches[1]\";s:42:\"mirall-service/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?post_type=mirall_service&feed=$matches[1]\";s:34:\"mirall-service/page/([0-9]{1,})/?$\";s:52:\"index.php?post_type=mirall_service&paged=$matches[1]\";s:15:\"mirall-model/?$\";s:32:\"index.php?post_type=mirall_model\";s:45:\"mirall-model/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_model&feed=$matches[1]\";s:40:\"mirall-model/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_model&feed=$matches[1]\";s:32:\"mirall-model/page/([0-9]{1,})/?$\";s:50:\"index.php?post_type=mirall_model&paged=$matches[1]\";s:19:\"mirall-portfolio/?$\";s:36:\"index.php?post_type=mirall_portfolio\";s:49:\"mirall-portfolio/feed/(feed|rdf|rss|rss2|atom)/?$\";s:53:\"index.php?post_type=mirall_portfolio&feed=$matches[1]\";s:44:\"mirall-portfolio/(feed|rdf|rss|rss2|atom)/?$\";s:53:\"index.php?post_type=mirall_portfolio&feed=$matches[1]\";s:36:\"mirall-portfolio/page/([0-9]{1,})/?$\";s:54:\"index.php?post_type=mirall_portfolio&paged=$matches[1]\";s:15:\"mirall-staff/?$\";s:32:\"index.php?post_type=mirall_staff\";s:45:\"mirall-staff/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_staff&feed=$matches[1]\";s:40:\"mirall-staff/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_staff&feed=$matches[1]\";s:32:\"mirall-staff/page/([0-9]{1,})/?$\";s:50:\"index.php?post_type=mirall_staff&paged=$matches[1]\";s:15:\"mirall-video/?$\";s:32:\"index.php?post_type=mirall_video\";s:45:\"mirall-video/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_video&feed=$matches[1]\";s:40:\"mirall-video/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=mirall_video&feed=$matches[1]\";s:32:\"mirall-video/page/([0-9]{1,})/?$\";s:50:\"index.php?post_type=mirall_video&paged=$matches[1]\";s:22:\"mirall-before_after/?$\";s:39:\"index.php?post_type=mirall_before_after\";s:52:\"mirall-before_after/feed/(feed|rdf|rss|rss2|atom)/?$\";s:56:\"index.php?post_type=mirall_before_after&feed=$matches[1]\";s:47:\"mirall-before_after/(feed|rdf|rss|rss2|atom)/?$\";s:56:\"index.php?post_type=mirall_before_after&feed=$matches[1]\";s:39:\"mirall-before_after/page/([0-9]{1,})/?$\";s:57:\"index.php?post_type=mirall_before_after&paged=$matches[1]\";s:16:\"mirall-review/?$\";s:33:\"index.php?post_type=mirall_review\";s:46:\"mirall-review/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_type=mirall_review&feed=$matches[1]\";s:41:\"mirall-review/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_type=mirall_review&feed=$matches[1]\";s:33:\"mirall-review/page/([0-9]{1,})/?$\";s:51:\"index.php?post_type=mirall_review&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:42:\"mirall-service/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:52:\"mirall-service/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:72:\"mirall-service/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"mirall-service/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"mirall-service/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:48:\"mirall-service/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:31:\"mirall-service/([^/]+)/embed/?$\";s:47:\"index.php?mirall_service=$matches[1]&embed=true\";s:35:\"mirall-service/([^/]+)/trackback/?$\";s:41:\"index.php?mirall_service=$matches[1]&tb=1\";s:55:\"mirall-service/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:53:\"index.php?mirall_service=$matches[1]&feed=$matches[2]\";s:50:\"mirall-service/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:53:\"index.php?mirall_service=$matches[1]&feed=$matches[2]\";s:43:\"mirall-service/([^/]+)/page/?([0-9]{1,})/?$\";s:54:\"index.php?mirall_service=$matches[1]&paged=$matches[2]\";s:50:\"mirall-service/([^/]+)/comment-page-([0-9]{1,})/?$\";s:54:\"index.php?mirall_service=$matches[1]&cpage=$matches[2]\";s:39:\"mirall-service/([^/]+)(?:/([0-9]+))?/?$\";s:53:\"index.php?mirall_service=$matches[1]&page=$matches[2]\";s:31:\"mirall-service/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\"mirall-service/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\"mirall-service/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"mirall-service/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"mirall-service/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\"mirall-service/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:40:\"mirall-model/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:50:\"mirall-model/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:70:\"mirall-model/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-model/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-model/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:46:\"mirall-model/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:29:\"mirall-model/([^/]+)/embed/?$\";s:45:\"index.php?mirall_model=$matches[1]&embed=true\";s:33:\"mirall-model/([^/]+)/trackback/?$\";s:39:\"index.php?mirall_model=$matches[1]&tb=1\";s:53:\"mirall-model/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_model=$matches[1]&feed=$matches[2]\";s:48:\"mirall-model/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_model=$matches[1]&feed=$matches[2]\";s:41:\"mirall-model/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?mirall_model=$matches[1]&paged=$matches[2]\";s:48:\"mirall-model/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?mirall_model=$matches[1]&cpage=$matches[2]\";s:37:\"mirall-model/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?mirall_model=$matches[1]&page=$matches[2]\";s:29:\"mirall-model/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:39:\"mirall-model/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:59:\"mirall-model/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-model/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-model/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:35:\"mirall-model/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:44:\"mirall-portfolio/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:54:\"mirall-portfolio/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:74:\"mirall-portfolio/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:69:\"mirall-portfolio/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:69:\"mirall-portfolio/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:50:\"mirall-portfolio/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:33:\"mirall-portfolio/([^/]+)/embed/?$\";s:49:\"index.php?mirall_portfolio=$matches[1]&embed=true\";s:37:\"mirall-portfolio/([^/]+)/trackback/?$\";s:43:\"index.php?mirall_portfolio=$matches[1]&tb=1\";s:57:\"mirall-portfolio/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?mirall_portfolio=$matches[1]&feed=$matches[2]\";s:52:\"mirall-portfolio/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?mirall_portfolio=$matches[1]&feed=$matches[2]\";s:45:\"mirall-portfolio/([^/]+)/page/?([0-9]{1,})/?$\";s:56:\"index.php?mirall_portfolio=$matches[1]&paged=$matches[2]\";s:52:\"mirall-portfolio/([^/]+)/comment-page-([0-9]{1,})/?$\";s:56:\"index.php?mirall_portfolio=$matches[1]&cpage=$matches[2]\";s:41:\"mirall-portfolio/([^/]+)(?:/([0-9]+))?/?$\";s:55:\"index.php?mirall_portfolio=$matches[1]&page=$matches[2]\";s:33:\"mirall-portfolio/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"mirall-portfolio/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"mirall-portfolio/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"mirall-portfolio/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"mirall-portfolio/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"mirall-portfolio/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:40:\"mirall-staff/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:50:\"mirall-staff/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:70:\"mirall-staff/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-staff/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-staff/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:46:\"mirall-staff/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:29:\"mirall-staff/([^/]+)/embed/?$\";s:45:\"index.php?mirall_staff=$matches[1]&embed=true\";s:33:\"mirall-staff/([^/]+)/trackback/?$\";s:39:\"index.php?mirall_staff=$matches[1]&tb=1\";s:53:\"mirall-staff/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_staff=$matches[1]&feed=$matches[2]\";s:48:\"mirall-staff/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_staff=$matches[1]&feed=$matches[2]\";s:41:\"mirall-staff/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?mirall_staff=$matches[1]&paged=$matches[2]\";s:48:\"mirall-staff/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?mirall_staff=$matches[1]&cpage=$matches[2]\";s:37:\"mirall-staff/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?mirall_staff=$matches[1]&page=$matches[2]\";s:29:\"mirall-staff/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:39:\"mirall-staff/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:59:\"mirall-staff/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-staff/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-staff/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:35:\"mirall-staff/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:40:\"mirall-video/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:50:\"mirall-video/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:70:\"mirall-video/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-video/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"mirall-video/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:46:\"mirall-video/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:29:\"mirall-video/([^/]+)/embed/?$\";s:45:\"index.php?mirall_video=$matches[1]&embed=true\";s:33:\"mirall-video/([^/]+)/trackback/?$\";s:39:\"index.php?mirall_video=$matches[1]&tb=1\";s:53:\"mirall-video/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_video=$matches[1]&feed=$matches[2]\";s:48:\"mirall-video/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?mirall_video=$matches[1]&feed=$matches[2]\";s:41:\"mirall-video/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?mirall_video=$matches[1]&paged=$matches[2]\";s:48:\"mirall-video/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?mirall_video=$matches[1]&cpage=$matches[2]\";s:37:\"mirall-video/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?mirall_video=$matches[1]&page=$matches[2]\";s:29:\"mirall-video/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:39:\"mirall-video/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:59:\"mirall-video/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-video/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"mirall-video/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:35:\"mirall-video/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:47:\"mirall-before_after/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:57:\"mirall-before_after/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:77:\"mirall-before_after/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"mirall-before_after/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"mirall-before_after/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:53:\"mirall-before_after/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:36:\"mirall-before_after/([^/]+)/embed/?$\";s:52:\"index.php?mirall_before_after=$matches[1]&embed=true\";s:40:\"mirall-before_after/([^/]+)/trackback/?$\";s:46:\"index.php?mirall_before_after=$matches[1]&tb=1\";s:60:\"mirall-before_after/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?mirall_before_after=$matches[1]&feed=$matches[2]\";s:55:\"mirall-before_after/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?mirall_before_after=$matches[1]&feed=$matches[2]\";s:48:\"mirall-before_after/([^/]+)/page/?([0-9]{1,})/?$\";s:59:\"index.php?mirall_before_after=$matches[1]&paged=$matches[2]\";s:55:\"mirall-before_after/([^/]+)/comment-page-([0-9]{1,})/?$\";s:59:\"index.php?mirall_before_after=$matches[1]&cpage=$matches[2]\";s:44:\"mirall-before_after/([^/]+)(?:/([0-9]+))?/?$\";s:58:\"index.php?mirall_before_after=$matches[1]&page=$matches[2]\";s:36:\"mirall-before_after/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:46:\"mirall-before_after/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:66:\"mirall-before_after/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"mirall-before_after/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"mirall-before_after/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:42:\"mirall-before_after/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:41:\"mirall-review/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:51:\"mirall-review/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:71:\"mirall-review/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:66:\"mirall-review/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:66:\"mirall-review/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:47:\"mirall-review/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:30:\"mirall-review/([^/]+)/embed/?$\";s:46:\"index.php?mirall_review=$matches[1]&embed=true\";s:34:\"mirall-review/([^/]+)/trackback/?$\";s:40:\"index.php?mirall_review=$matches[1]&tb=1\";s:54:\"mirall-review/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?mirall_review=$matches[1]&feed=$matches[2]\";s:49:\"mirall-review/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?mirall_review=$matches[1]&feed=$matches[2]\";s:42:\"mirall-review/([^/]+)/page/?([0-9]{1,})/?$\";s:53:\"index.php?mirall_review=$matches[1]&paged=$matches[2]\";s:49:\"mirall-review/([^/]+)/comment-page-([0-9]{1,})/?$\";s:53:\"index.php?mirall_review=$matches[1]&cpage=$matches[2]\";s:38:\"mirall-review/([^/]+)(?:/([0-9]+))?/?$\";s:52:\"index.php?mirall_review=$matches[1]&page=$matches[2]\";s:30:\"mirall-review/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:40:\"mirall-review/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:60:\"mirall-review/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:55:\"mirall-review/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:55:\"mirall-review/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:36:\"mirall-review/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:57:\"service-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:62:\"index.php?mirall_service_category=$matches[1]&feed=$matches[2]\";s:52:\"service-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:62:\"index.php?mirall_service_category=$matches[1]&feed=$matches[2]\";s:33:\"service-category/([^/]+)/embed/?$\";s:56:\"index.php?mirall_service_category=$matches[1]&embed=true\";s:45:\"service-category/([^/]+)/page/?([0-9]{1,})/?$\";s:63:\"index.php?mirall_service_category=$matches[1]&paged=$matches[2]\";s:27:\"service-category/([^/]+)/?$\";s:45:\"index.php?mirall_service_category=$matches[1]\";s:59:\"portfolio-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?mirall_portfolio_category=$matches[1]&feed=$matches[2]\";s:54:\"portfolio-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?mirall_portfolio_category=$matches[1]&feed=$matches[2]\";s:35:\"portfolio-category/([^/]+)/embed/?$\";s:58:\"index.php?mirall_portfolio_category=$matches[1]&embed=true\";s:47:\"portfolio-category/([^/]+)/page/?([0-9]{1,})/?$\";s:65:\"index.php?mirall_portfolio_category=$matches[1]&paged=$matches[2]\";s:29:\"portfolio-category/([^/]+)/?$\";s:47:\"index.php?mirall_portfolio_category=$matches[1]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:40:\"index.php?&page_id=100&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'yes'),
(33, 'active_plugins', 'a:2:{i:0;s:29:\"mirall-suite/mirall-suite.php\";i:1;s:25:\"duplicator/duplicator.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '3.5', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'yes'),
(40, 'template', 'mirall-luxe', 'yes'),
(41, 'stylesheet', 'mirall-luxe', 'yes'),
(42, 'comment_registration', '0', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '61833', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '0', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'page', 'yes'),
(52, 'tag_base', '', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '300', 'yes'),
(60, 'medium_size_h', '300', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '1024', 'yes'),
(63, 'large_size_h', '1024', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '0', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '0', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(77, 'widget_text', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(78, 'widget_rss', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'yes'),
(80, 'timezone_string', 'Asia/Tehran', 'yes'),
(81, 'page_for_posts', '106', 'yes'),
(82, 'page_on_front', '100', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '768', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '0', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '0', 'yes'),
(92, 'disallowed_keys', '', 'yes'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', '1', 'yes'),
(95, 'auto_update_core_dev', 'enabled', 'yes'),
(96, 'auto_update_core_minor', 'enabled', 'yes'),
(97, 'auto_update_core_major', 'enabled', 'yes'),
(98, 'mirall_suite_version', '1.2.0', 'yes'),
(99, 'mirall_seeded', '1', 'yes'),
(100, 'mirall_demo_installed', '2026-09-21 19:45:00', 'yes'),
(101, 'mirall_account_page', '101', 'yes'),
(102, 'mirall_booking_page', '107', 'yes'),
(103, 'mirall_settings', 'a:7:{s:12:\"sms_provider\";s:4:\"none\";s:13:\"booking_start\";s:5:\"10:00\";s:11:\"booking_end\";s:5:\"20:00\";s:12:\"slot_minutes\";s:3:\"120\";s:8:\"whatsapp\";s:12:\"989125707416\";s:8:\"telegram\";s:0:\"\";s:14:\"support_online\";s:1:\"0\";}', 'yes'),
(104, 'theme_mods_mirall-luxe', 'a:15:{s:18:\"nav_menu_locations\";a:2:{s:7:\"primary\";i:2;s:6:\"footer\";i:2;}s:12:\"mirall_phone\";s:11:\"02122003932\";s:13:\"mirall_mobile\";s:11:\"09125707416\";s:14:\"mirall_address\";s:105:\"تهران، فرشته، مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸\";s:16:\"mirall_instagram\";s:47:\"https://www.instagram.com/mirall_beauty_center/\";s:15:\"mirall_whatsapp\";s:12:\"989125707416\";s:17:\"mirall_hero_title\";s:39:\"زیبایی تو، امضای توست\";s:14:\"mirall_tagline\";s:30:\"خانهٔ زیبایی شما\";s:11:\"mirall_wine\";s:7:\"#a24f61\";s:16:\"mirall_wine_dark\";s:7:\"#642536\";s:12:\"mirall_paper\";s:7:\"#f9f1eb\";s:11:\"mirall_rose\";s:7:\"#d7ac9e\";s:11:\"mirall_gold\";s:7:\"#ca9477\";s:10:\"mirall_ink\";s:7:\"#523a2f\";s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(105, 'cron', 'a:9:{i:1790111882;a:1:{s:32:\"duplicator_backup_storages_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:41:\"duplicator_backup_storages_check_interval\";s:4:\"args\";a:0:{}s:8:\"interval\";i:900;}}}i:1790112720;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1790130782;a:1:{s:32:\"duplicator_failed_backup_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:25:\"duplicator_six_hours_cron\";s:4:\"args\";a:0:{}s:8:\"interval\";i:21600;}}}i:1790152320;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1790195520;a:3:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:41:\"wp_privacy_personal_data_cleanup_requests\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1790195582;a:1:{s:31:\"duplicator_activity_log_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:21:\"duplicator_daily_cron\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1790197620;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1790591400;a:1:{s:29:\"duplicator_email_summary_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:22:\"duplicator_weekly_cron\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}', 'on'),
(106, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(107, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(108, 'widget_archives', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(109, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(110, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(111, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(112, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(113, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(114, 'widget_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(115, 'widget_recent-posts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(116, 'widget_recent-comments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(117, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(118, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(119, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(120, 'widget_block', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'auto'),
(126, 'recovery_keys', 'a:0:{}', 'off'),
(132, 'nonce_key', 'kA=3m])VgcI/8Q2+z{],Q<@Z_S-b/4nQ<xV{Z>GVe*o^{mi9[IsH:D(Xn/5L%OS5', 'off'),
(133, 'nonce_salt', 'KoF-%Ne#gRO.DuM*TwT1PNYuieF?}4;~5Q)m/RjRlIAEH66YYa)1dI!)o>uz_$Ex', 'off'),
(135, 'fresh_site', '0', 'off'),
(137, 'wp_user_roles', 'a:0:{}', 'auto'),
(138, 'dupli_opt_capabilities', 'a:6:{s:16:\"duplicator_basic\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}s:17:\"duplicator_create\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}s:18:\"duplicator_storage\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}s:25:\"duplicator_backup_restore\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}s:17:\"duplicator_export\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}s:19:\"duplicator_settings\";a:2:{s:5:\"roles\";a:1:{i:0;s:13:\"administrator\";}s:5:\"users\";a:0:{}}}', 'auto'),
(140, 'dupli_opt_uninstall_package', '1', 'auto'),
(141, 'dupli_opt_uninstall_settings', '1', 'auto'),
(142, 'dupli_opt_crypt', '1', 'auto'),
(143, 'dupli_opt_trace_log_enabled', '', 'auto'),
(144, 'dupli_opt_version', '5.0.4|LITE', 'on'),
(145, 'dupli_opt_hash', '7b2273223a2237623139222c2272223a5b224c69746542617365225d2c226664223a5b2250726f42617365225d2c2276223a22352e302e34222c226b223a2264626361227d', 'on'),
(146, 'dupli_opt_install_info', 'a:3:{s:7:\"version\";s:5:\"5.0.4\";s:4:\"time\";i:1790109182;s:10:\"updateTime\";i:1790109182;}', 'off'),
(147, 'dupli_opt_addons_status', '{\"AiReadyAddon\":true,\"DupCloudAddon\":true,\"LiteBase\":true,\"LiteLegacyAddon\":true}', 'auto'),
(148, 'dupli_opt_addons_status_fingerprint', '5.0.4|7b2273223a2237623139222c2272223a5b224c69746542617365225d2c226664223a5b2250726f42617365225d2c2276223a22352e302e34222c226b223a2264626361227d', 'auto'),
(149, 'dupli_opt_telemetry_state', '{\n    \"CL_-=_-=\": \"Duplicator\\\\Utils\\\\UsageStatistics\\\\Telemetry\\\\TelemetryState\",\n    \"buildCount\": 0,\n    \"buildLastDate\": 0,\n    \"buildFailedCount\": 0,\n    \"buildFailedLastDate\": 0,\n    \"packagesBuildCompFullCount\": 0,\n    \"packagesBuildCompDbOnlyCount\": 0,\n    \"usedRecoveryCount\": 0,\n    \"siteSizeMB\": 167.69,\n    \"siteNumFiles\": 6714,\n    \"siteDbSizeMB\": 1.33,\n    \"siteDbNumTables\": 19,\n    \"firstSnapshotSentAt\": 0,\n    \"failureStreak\": 0,\n    \"installEventSentAt\": 0\n}', 'off'),
(150, 'dupli_opt_redirect_to_welcome', '1', 'auto'),
(152, 'dupli_opt_encrypted_reset_notice', '1', 'auto'),
(153, 'dupli_opt_expire_dupli_opt_frotend_delay', '{\"expire\":1790111415,\"value\":true}', 'on'),
(154, 'dupli_opt_expire_tmp_cleanup_check', '{\"expire\":1790195582,\"value\":true}', 'on'),
(155, 'dupli_opt_expire_daily_bootstrap_actions', '{\"expire\":1790195582,\"value\":true}', 'on'),
(156, 'dupli_opt_expire_rename_delay', '{\"expire\":1790152382,\"value\":true}', 'on'),
(161, 'dupli_opt_exe_safe_mode', '0', 'yes'),
(162, 'dupli_opt_activate_plugins_after_installation', 'a:0:{}', 'yes'),
(163, 'dupli_opt_first_login_after_install', '1', 'no'),
(164, 'dupli_opt_migration_data', '{\n    \"plugin\": \"dup-pro\",\n    \"installerVersion\": \"5.0.4\",\n    \"installType\": -1,\n    \"installTime\": \"2026-09-22 20:58:35\",\n    \"logicModes\": [\n        \"CLASSIC\"\n    ],\n    \"template\": \"default\",\n    \"restoreBackupMode\": false,\n    \"recoveryMode\": false,\n    \"archivePath\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/20260922_mirallbeauty_ea07bd8ef3c0507d5655_20260922203327_archive.zip\",\n    \"packageId\": 2,\n    \"packageHash\": \"ea07bd8-22203327\",\n    \"installerPath\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/installer.php\",\n    \"installerBootLog\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/dup-installer-bootlog__bd3fc78-22203327.txt\",\n    \"installerLog\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/dup-installer\\/dup-installer-log__bd3fc78-22203327.txt\",\n    \"dupInstallerPath\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/dup-installer\",\n    \"origFileFolderPath\": \"C:\\/xampp\\/htdocs\\/MiralBeauty\\/dup-installer\\/dup_descriptors_ea07bd8-22203327\\/orig_files\",\n    \"safeMode\": 0,\n    \"cleanInstallerFiles\": true,\n    \"licenseType\": 0,\n    \"phpVersion\": \"8.4.24\",\n    \"archiveType\": \"zip\",\n    \"siteSize\": 89289621,\n    \"siteNumFiles\": 6714,\n    \"siteDbSize\": 1392640,\n    \"siteDBNumTables\": 19,\n    \"components\": [\n        \"package_component_db\",\n        \"package_component_core\",\n        \"package_component_plugins\",\n        \"package_component_themes\",\n        \"package_component_uploads\",\n        \"package_component_other\"\n    ],\n    \"ustatIdentifier\": \"\",\n    \"extra\": []\n}', 'no'),
(165, 'logged_in_key', 'C0&GP^;,mZ4r:DhlAhg8Jjfyqf|T i)~046H8J2D_9UDWfHc1G^BuHnrkc/.E[wR', 'off'),
(166, 'logged_in_salt', 'yl*dk@ z5<],voIfH0z(L;JA5F;dL@+j< 8}/Tt04i:#GxoLW&D_,S<;_2zS>cyF', 'off'),
(167, '_site_transient_timeout_wp_theme_files_patterns-0acf2c152d79daa693484c96acbab050', '1790112516', 'off'),
(168, '_site_transient_wp_theme_files_patterns-0acf2c152d79daa693484c96acbab050', 'a:2:{s:7:\"version\";s:5:\"1.2.0\";s:8:\"patterns\";a:0:{}}', 'off'),
(169, '_transient_wp_styles_for_blocks', 'a:2:{s:4:\"hash\";s:32:\"94289267f68ccac1fefa45915ab93347\";s:6:\"blocks\";a:9:{s:32:\"832dc2d864d79097d8b8b493ad93453b\";s:0:\"\";s:32:\"45d3e0c4afcbd8cf25cb1ba51abfb3d7\";s:46:\":root :where(.wp-block-icon svg){width: 24px;}\";s:32:\"feca6e996f694be2d29599793228e0d7\";s:0:\"\";s:32:\"5eef131663eddaf830554df656fc2968\";s:324:\":where(.wp-block-gallery.is-layout-flex){gap: var( --wp--style--gallery-gap-default, var( --gallery-block--gutter-size, var( --wp--style--block-gap, 0.5em ) ) );}:where(.wp-block-gallery.is-layout-grid){gap: var( --wp--style--gallery-gap-default, var( --gallery-block--gutter-size, var( --wp--style--block-gap, 0.5em ) ) );}\";s:32:\"c99c05932c6685777ec5b856698fcc7d\";s:118:\":where(.wp-block-latest-posts.is-layout-flex){gap: 1.25em;}:where(.wp-block-latest-posts.is-layout-grid){gap: 1.25em;}\";s:32:\"dec8d648f30b13caec8e61374591787d\";s:120:\":where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}\";s:32:\"6c35533f7a92cce94808323603db9fc8\";s:120:\":where(.wp-block-term-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-term-template.is-layout-grid){gap: 1.25em;}\";s:32:\"6a0505cd5c78a87ed77570cda43c1132\";s:102:\":where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}\";s:32:\"25a66f156386551185570f72a9f7d44e\";s:69:\":root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}\";}}', 'on'),
(171, 'auth_key', '=F ZYM*~z(Gs &[Bsv[cqe8~3Z^z~*AVq8[GX3~@xGTA0FqAv%uY.ET>DbN{tMpA', 'off'),
(172, 'auth_salt', '3C;(%{G#A:>})VI^p5AUSL+(e<>9^.$Nl(*l>Yw_mLWw:5@-:9P]uvl7SXPV(yK&', 'off'),
(174, 'wp_force_deactivated_plugins', 'a:0:{}', 'on'),
(175, 'wp_attachment_pages_enabled', '0', 'on'),
(176, 'wp_notes_notify', '1', 'on'),
(177, 'initial_db_version', '60717', 'on'),
(178, 'db_upgraded', '', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 102, '_wp_page_template', 'page-about.php'),
(2, 103, '_wp_page_template', 'page-contact.php'),
(3, 104, '_wp_page_template', 'page-services.php'),
(4, 105, '_wp_page_template', 'page-portfolio.php'),
(5, 120, '_mirall_duration', '180'),
(6, 120, '_mirall_price', '0'),
(7, 120, '_mirall_capacity', '1'),
(8, 121, '_mirall_duration', '120'),
(9, 121, '_mirall_price', '0'),
(10, 121, '_mirall_capacity', '1'),
(11, 122, '_mirall_duration', '90'),
(12, 122, '_mirall_price', '0'),
(13, 122, '_mirall_capacity', '1'),
(14, 123, '_mirall_duration', '75'),
(15, 123, '_mirall_price', '0'),
(16, 123, '_mirall_capacity', '1'),
(17, 130, '_mirall_service_id', '120'),
(18, 131, '_mirall_service_id', '120'),
(19, 132, '_mirall_service_id', '120'),
(20, 133, '_mirall_service_id', '121'),
(21, 140, '_menu_item_type', 'post_type'),
(22, 140, '_menu_item_menu_item_parent', '0'),
(23, 140, '_menu_item_object_id', '100'),
(24, 140, '_menu_item_object', 'page'),
(25, 140, '_menu_item_target', ''),
(26, 140, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(27, 140, '_menu_item_xfn', ''),
(28, 140, '_menu_item_url', ''),
(29, 141, '_menu_item_type', 'post_type'),
(30, 141, '_menu_item_menu_item_parent', '0'),
(31, 141, '_menu_item_object_id', '102'),
(32, 141, '_menu_item_object', 'page'),
(33, 141, '_menu_item_target', ''),
(34, 141, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(35, 141, '_menu_item_xfn', ''),
(36, 141, '_menu_item_url', ''),
(37, 142, '_menu_item_type', 'post_type'),
(38, 142, '_menu_item_menu_item_parent', '0'),
(39, 142, '_menu_item_object_id', '104'),
(40, 142, '_menu_item_object', 'page'),
(41, 142, '_menu_item_target', ''),
(42, 142, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(43, 142, '_menu_item_xfn', ''),
(44, 142, '_menu_item_url', ''),
(45, 143, '_menu_item_type', 'post_type'),
(46, 143, '_menu_item_menu_item_parent', '0'),
(47, 143, '_menu_item_object_id', '105'),
(48, 143, '_menu_item_object', 'page'),
(49, 143, '_menu_item_target', ''),
(50, 143, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(51, 143, '_menu_item_xfn', ''),
(52, 143, '_menu_item_url', ''),
(53, 144, '_menu_item_type', 'post_type'),
(54, 144, '_menu_item_menu_item_parent', '0'),
(55, 144, '_menu_item_object_id', '106'),
(56, 144, '_menu_item_object', 'page'),
(57, 144, '_menu_item_target', ''),
(58, 144, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(59, 144, '_menu_item_xfn', ''),
(60, 144, '_menu_item_url', ''),
(61, 145, '_menu_item_type', 'post_type'),
(62, 145, '_menu_item_menu_item_parent', '0'),
(63, 145, '_menu_item_object_id', '103'),
(64, 145, '_menu_item_object', 'page'),
(65, 145, '_menu_item_target', ''),
(66, 145, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(67, 145, '_menu_item_xfn', ''),
(68, 145, '_menu_item_url', ''),
(69, 146, '_wp_page_template', 'page-videos.php'),
(70, 147, '_wp_attached_file', '2026/09/journal-hair-tone.jpg'),
(71, 147, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1200;s:6:\"height\";i:1601;s:4:\"file\";s:29:\"2026/09/journal-hair-tone.jpg\";s:8:\"filesize\";i:397990;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}'),
(72, 147, '_wp_attachment_image_alt', 'نمودار انتخاب تناژ مناسب رنگ مو'),
(73, 110, '_thumbnail_id', '147'),
(74, 148, '_wp_attached_file', '2026/09/journal-hair-care.jpg'),
(75, 148, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1200;s:6:\"height\";i:726;s:4:\"file\";s:29:\"2026/09/journal-hair-care.jpg\";s:8:\"filesize\";i:82893;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}'),
(76, 148, '_wp_attachment_image_alt', 'موی سالم و درخشان پس از مراقبت'),
(77, 111, '_thumbnail_id', '148'),
(78, 149, '_wp_attached_file', '2026/09/journal-makeup-prep.jpg'),
(79, 149, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1200;s:6:\"height\";i:1212;s:4:\"file\";s:31:\"2026/09/journal-makeup-prep.jpg\";s:8:\"filesize\";i:137721;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}'),
(80, 149, '_wp_attachment_image_alt', 'محصولات مراقبت پوست پیش از میکاپ'),
(81, 112, '_thumbnail_id', '149');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(100, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'صفحه اصلی', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=100', 0, 'page', '', 0),
(101, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '[mirall_login][mirall_account]', 'حساب کاربری', '', 'publish', 'closed', 'closed', '', 'account', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=101', 0, 'page', '', 0),
(102, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'در میرال هر انتخاب از مشاوره شروع می‌شود. فرم چهره، تناژ پوست، سبک شخصی و سلامت مو کنار هم دیده می‌شوند تا نتیجه، زیبا و طبیعی باشد.', 'درباره ما', '', 'publish', 'closed', 'closed', '', 'about', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=102', 0, 'page', '', 0),
(103, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'تهران، فرشته، مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸\nتلفن: ۰۲۱۲۲۰۰۳۹۳۲\nرزرو: ۰۹۱۲۵۷۰۷۴۱۶', 'تماس با ما', '', 'publish', 'closed', 'closed', '', 'contact', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=103', 0, 'page', '', 0),
(104, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'خدمات', '', 'publish', 'closed', 'closed', '', 'services', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=104', 0, 'page', '', 0),
(105, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'نمونه کارها', '', 'publish', 'closed', 'closed', '', 'portfolio', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=105', 0, 'page', '', 0),
(106, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'زیبایی‌نامه', '', 'publish', 'closed', 'closed', '', 'beauty-journal', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=106', 0, 'page', '', 0),
(107, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '[mirall_booking]', 'رزرو نوبت', '', 'publish', 'closed', 'closed', '', 'booking', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=107', 0, 'page', '', 0),
(110, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'انتخاب تناژ مو به رنگ پوست، رنگ چشم، پایه فعلی مو و میزان مراقبتی که می‌توانید انجام دهید بستگی دارد. پیش از تغییر رنگ، مشاوره تخصصی کمک می‌کند نتیجه طبیعی‌تر و سالم‌تری داشته باشید.', 'چطور تناژ مناسب پوستمان را انتخاب کنیم؟', '', 'publish', 'closed', 'closed', '', 'hair-color-tone', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=110', 0, 'post', '', 0),
(111, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'شست‌وشوی ملایم، استفاده از ماسک مناسب و محافظ حرارتی به حفظ درخشش و سلامت مو کمک می‌کند. فاصله ترمیم باید بر اساس رشد مو و شرایط ساقه تعیین شود.', 'مراقبت بعد از بالیاژ', '', 'publish', 'closed', 'closed', '', 'balayage-aftercare', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=111', 0, 'post', '', 0),
(112, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'این نوشتهٔ نمونه برای شروع مجله است و از پیشخوان قابل ویرایش یا جایگزینی است.', 'راهنمای آماده‌شدن برای میکاپ مراسم', '', 'publish', 'closed', 'closed', '', 'makeup-preparation', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=112', 0, 'post', '', 0),
(120, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'بالیاژ، آمبره، هایلایت، اصلاح رنگ و انتخاب تناژ متناسب با پوست و سلامت مو.', 'رنگ و لایت', '', 'publish', 'closed', 'closed', '', 'hair-color-light', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=120', 0, 'mirall_service', '', 0),
(121, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'طراحی چهره، میکاپ لایت و مراسم و مشاوره تخصصی عروس.', 'میکاپ و عروس', '', 'publish', 'closed', 'closed', '', 'makeup-bridal', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=121', 0, 'mirall_service', '', 0),
(122, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'کاشت، ژل، لمینت، ترمیم و طراحی ظریف ناخن.', 'خدمات ناخن', '', 'publish', 'closed', 'closed', '', 'nails', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=122', 0, 'mirall_service', '', 0),
(123, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'هیرکات، براشینگ، لیفت و اصلاح ابرو و میکروبلیدینگ.', 'مو و ابرو', '', 'publish', 'closed', 'closed', '', 'hair-brow', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=123', 0, 'mirall_service', '', 0),
(130, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'این مدل هنگام رزرو قابل انتخاب است؛ تصویر شاخص و ارتباط آن با خدمت را از پنل مدیریت تنظیم کنید.', 'بالیاژ گرم و طبیعی', '', 'publish', 'closed', 'closed', '', 'warm-balayage', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=130', 0, 'mirall_model', '', 0),
(131, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'این مدل هنگام رزرو قابل انتخاب است؛ تصویر شاخص و ارتباط آن با خدمت را از پنل مدیریت تنظیم کنید.', 'لایت روشن صدفی', '', 'publish', 'closed', 'closed', '', 'pearl-light', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=131', 0, 'mirall_model', '', 0),
(132, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'این مدل هنگام رزرو قابل انتخاب است؛ تصویر شاخص و ارتباط آن با خدمت را از پنل مدیریت تنظیم کنید.', 'هایلایت کاراملی', '', 'publish', 'closed', 'closed', '', 'caramel-highlight', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=132', 0, 'mirall_model', '', 0),
(133, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', 'این مدل هنگام رزرو قابل انتخاب است؛ تصویر شاخص و ارتباط آن با خدمت را از پنل مدیریت تنظیم کنید.', 'میکاپ لایت و درخشان', '', 'publish', 'closed', 'closed', '', 'soft-makeup', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=133', 0, 'mirall_model', '', 0),
(140, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'صفحه اصلی', '', 'publish', 'closed', 'closed', '', '140', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=140', 1, 'nav_menu_item', '', 0),
(141, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'درباره ما', '', 'publish', 'closed', 'closed', '', '141', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=141', 2, 'nav_menu_item', '', 0),
(142, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'خدمات', '', 'publish', 'closed', 'closed', '', '142', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=142', 3, 'nav_menu_item', '', 0),
(143, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'نمونه‌کارها', '', 'publish', 'closed', 'closed', '', '143', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=143', 4, 'nav_menu_item', '', 0),
(144, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'زیبایی‌نامه', '', 'publish', 'closed', 'closed', '', '144', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=144', 5, 'nav_menu_item', '', 0),
(145, 1, '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 'تماس با ما', '', 'publish', 'closed', 'closed', '', '145', '', '', '2026-09-21 19:45:00', '2026-09-21 16:15:00', '', 0, 'http://localhost/MiralBeauty/?p=145', 6, 'nav_menu_item', '', 0),
(146, 0, '2026-09-23 00:02:01', '2026-09-22 20:32:01', '', 'ویدیوهای میرال', '', 'publish', 'closed', 'closed', '', 'videos', '', '', '2026-09-23 00:02:01', '2026-09-22 20:32:01', '', 0, 'http://localhost/MiralBeauty/videos/', 6, 'page', '', 0),
(147, 0, '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 'چارت تناژ رنگ مو', 'نمودار انتخاب تناژ مناسب رنگ مو', 'inherit', 'closed', 'closed', '', '%da%86%d8%a7%d8%b1%d8%aa-%d8%aa%d9%86%d8%a7%da%98-%d8%b1%d9%86%da%af-%d9%85%d9%88', '', '', '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 110, 'http://localhost/MiralBeauty/hair-color-tone/%da%86%d8%a7%d8%b1%d8%aa-%d8%aa%d9%86%d8%a7%da%98-%d8%b1%d9%86%da%af-%d9%85%d9%88/', 0, 'attachment', 'image/jpeg', 0),
(148, 0, '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 'مراقبت مو بعد از بالیاژ', 'موی سالم و درخشان پس از مراقبت', 'inherit', 'closed', 'closed', '', '%d9%85%d8%b1%d8%a7%d9%82%d8%a8%d8%aa-%d9%85%d9%88-%d8%a8%d8%b9%d8%af-%d8%a7%d8%b2-%d8%a8%d8%a7%d9%84%db%8c%d8%a7%da%98', '', '', '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 111, 'http://localhost/MiralBeauty/balayage-aftercare/%d9%85%d8%b1%d8%a7%d9%82%d8%a8%d8%aa-%d9%85%d9%88-%d8%a8%d8%b9%d8%af-%d8%a7%d8%b2-%d8%a8%d8%a7%d9%84%db%8c%d8%a7%da%98/', 0, 'attachment', 'image/jpeg', 0),
(149, 0, '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 'آماده‌سازی پیش از میکاپ', 'محصولات مراقبت پوست پیش از میکاپ', 'inherit', 'closed', 'closed', '', '%d8%a2%d9%85%d8%a7%d8%af%d9%87%d8%b3%d8%a7%d8%b2%db%8c-%d9%be%db%8c%d8%b4-%d8%a7%d8%b2-%d9%85%db%8c%da%a9%d8%a7%d9%be', '', '', '2026-09-23 00:02:30', '2026-09-22 20:32:30', '', 112, 'http://localhost/MiralBeauty/makeup-preparation/%d8%a2%d9%85%d8%a7%d8%af%d9%87%d8%b3%d8%a7%d8%b2%db%8c-%d9%be%db%8c%d8%b4-%d8%a7%d8%b2-%d9%85%db%8c%da%a9%d8%a7%d9%be/', 0, 'attachment', 'image/jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'دسته‌بندی نشده', 'uncategorized', 0),
(2, 'منوی اصلی میرال', 'mirall-main-menu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(110, 1, 0),
(111, 1, 0),
(112, 1, 0),
(140, 2, 1),
(141, 2, 2),
(142, 2, 3),
(143, 2, 4),
(144, 2, 5),
(145, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 3),
(2, 2, 'nav_menu', '', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(2, 1, 'wp_user_level', '10'),
(3, 1, 'show_admin_bar_front', 'true'),
(4, 1, 'locale', 'fa_IR'),
(5, 1, 'session_tokens', 'a:2:{s:64:\"08ef075f3fab140062b00237490565a5266a61ca955e90f1b651b6907b2be8b5\";a:4:{s:10:\"expiration\";i:1791320327;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36\";s:5:\"login\";i:1790110727;}s:64:\"9f2a8aabe9860b2e5624d05591f3fc50684c1fec08202f375badc51c8526e3cd\";a:4:{s:10:\"expiration\";i:1791320956;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36\";s:5:\"login\";i:1790111356;}}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'mirall_admin', '$wp$2y$10$D.O0JeOE9xOeIPXXB.y4s.Mv7KsbieHjRCES24hLOPcEIW74zAwxe', 'mirall-admin', 'admin@mirall.local', '', '2026-09-21 19:45:00', '', 0, 'Mirall Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_duplicator_activity_logs`
--
ALTER TABLE `wp_duplicator_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_idx` (`type`),
  ADD KEY `sub_type_idx` (`sub_type`),
  ADD KEY `severity_idx` (`severity`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `version` (`version`);

--
-- Indexes for table `wp_duplicator_backups`
--
ALTER TABLE `wp_duplicator_backups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_idx` (`type`),
  ADD KEY `hash` (`hash`),
  ADD KEY `flags` (`flags`),
  ADD KEY `version` (`version`),
  ADD KEY `created` (`created`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `status` (`status`),
  ADD KEY `name` (`name`(191)),
  ADD KEY `archive_name` (`archive_name`(191));

--
-- Indexes for table `wp_duplicator_entities`
--
ALTER TABLE `wp_duplicator_entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_idx` (`type`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `version` (`version`),
  ADD KEY `value_1` (`value_1`(191)),
  ADD KEY `value_2` (`value_2`(191)),
  ADD KEY `value_3` (`value_3`(191)),
  ADD KEY `value_4` (`value_4`(191)),
  ADD KEY `value_5` (`value_5`(191));

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_mirall_bookings`
--
ALTER TABLE `wp_mirall_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_code` (`tracking_code`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `appointment` (`appointment_date`,`appointment_time`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_mirall_otp`
--
ALTER TABLE `wp_mirall_otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `expires_at` (`expires_at`);

--
-- Indexes for table `wp_mirall_sms_logs`
--
ALTER TABLE `wp_mirall_sms_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `event` (`event`);

--
-- Indexes for table `wp_mirall_tickets`
--
ALTER TABLE `wp_mirall_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thread_token` (`thread_token`),
  ADD KEY `status` (`status`),
  ADD KEY `mobile` (`mobile`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`),
  ADD KEY `type_status_author` (`post_type`,`post_status`,`post_author`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_duplicator_activity_logs`
--
ALTER TABLE `wp_duplicator_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wp_duplicator_backups`
--
ALTER TABLE `wp_duplicator_backups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_duplicator_entities`
--
ALTER TABLE `wp_duplicator_entities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_mirall_bookings`
--
ALTER TABLE `wp_mirall_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_mirall_otp`
--
ALTER TABLE `wp_mirall_otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_mirall_sms_logs`
--
ALTER TABLE `wp_mirall_sms_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_mirall_tickets`
--
ALTER TABLE `wp_mirall_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
