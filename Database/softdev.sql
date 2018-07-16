-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2018 at 12:14 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_advancedmodules`
--

DROP TABLE IF EXISTS `bt8w9_advancedmodules`;
CREATE TABLE IF NOT EXISTS `bt8w9_advancedmodules` (
  `moduleid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mirror_id` int(10) NOT NULL DEFAULT '0',
  `category` varchar(50) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`moduleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_advancedmodules`
--

INSERT INTO `bt8w9_advancedmodules` (`moduleid`, `asset_id`, `mirror_id`, `category`, `params`) VALUES
(98, 77, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(95, 74, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(88, 67, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(17, 51, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(96, 75, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(1, 39, 0, '', '{\"color\":\"none\",\"hideempty\":\"0\",\"mirror_module\":\"0\",\"mirror_moduleid\":\"101\",\"match_method\":\"and\",\"show_assignments\":\"1\",\"assignto_menuitems\":\"0\",\"assignto_menuitems_inc_children\":\"0\",\"assignto_menuitems_inc_noitemid\":\"0\",\"assignto_homepage\":\"0\",\"assignto_date\":\"0\",\"assignto_date_publish_up\":0,\"assignto_date_publish_down\":0,\"assignto_date_recurring\":\"0\",\"assignto_usergrouplevels\":\"0\",\"assignto_usergrouplevels_match_all\":\"0\",\"assignto_usergrouplevels_inc_children\":\"0\",\"assignto_languages\":\"0\",\"assignto_templates\":\"0\",\"assignto_urls\":\"0\",\"assignto_urls_selection\":\"\",\"assignto_urls_regex\":\"0\",\"assignto_devices\":\"0\",\"assignto_os\":\"0\",\"assignto_browsers\":\"0\",\"assignto_components\":\"0\",\"assignto_tags\":\"0\",\"assignto_tags_match_all\":\"0\",\"assignto_tags_inc_children\":\"0\",\"assignto_contentpagetypes\":\"0\",\"assignto_cats\":\"0\",\"assignto_cats_inc_children\":\"0\",\"assignto_cats_inc\":[\"inc_cats\",\"inc_arts\",\"x\"],\"assignto_articles\":\"0\",\"assignto_articles_content_keywords\":\"\",\"assignto_articles_keywords\":\"\",\"notes\":\"\"}'),
(97, 76, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(93, 72, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(91, 70, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(92, 71, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(90, 69, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(16, 50, 0, '', '{\"color\":\"none\",\"hideempty\":\"0\",\"mirror_module\":\"0\",\"mirror_moduleid\":\"98\",\"match_method\":\"and\",\"show_assignments\":\"1\",\"assignto_menuitems\":\"0\",\"assignto_menuitems_inc_children\":\"0\",\"assignto_menuitems_inc_noitemid\":\"0\",\"assignto_homepage\":\"0\",\"assignto_date\":\"0\",\"assignto_date_publish_up\":0,\"assignto_date_publish_down\":0,\"assignto_date_recurring\":\"0\",\"assignto_usergrouplevels\":\"0\",\"assignto_usergrouplevels_match_all\":\"0\",\"assignto_usergrouplevels_inc_children\":\"0\",\"assignto_languages\":\"0\",\"assignto_templates\":\"0\",\"assignto_urls\":\"0\",\"assignto_urls_selection\":\"\",\"assignto_urls_regex\":\"0\",\"assignto_devices\":\"0\",\"assignto_os\":\"0\",\"assignto_browsers\":\"0\",\"assignto_components\":\"0\",\"assignto_tags\":\"0\",\"assignto_tags_match_all\":\"0\",\"assignto_tags_inc_children\":\"0\",\"assignto_contentpagetypes\":\"0\",\"assignto_cats\":\"0\",\"assignto_cats_inc_children\":\"0\",\"assignto_cats_inc\":[\"inc_cats\",\"inc_arts\",\"x\"],\"assignto_articles\":\"0\",\"assignto_articles_content_keywords\":\"\",\"assignto_articles_keywords\":\"\",\"notes\":\"\"}'),
(102, 99, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(104, 101, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}'),
(103, 100, 0, '', '{\"assignto_menuitems_selection\":[],\"assignto_menuitems\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_assets`
--

DROP TABLE IF EXISTS `bt8w9_assets`;
CREATE TABLE IF NOT EXISTS `bt8w9_assets` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) UNSIGNED NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_assets`
--

INSERT INTO `bt8w9_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 0, 197, 0, 'root.1', 'Root Asset', '{\"core.login.site\":{\"6\":1,\"2\":1},\"core.login.admin\":{\"6\":1},\"core.login.offline\":{\"6\":1},\"core.admin\":{\"8\":1},\"core.manage\":{\"7\":1},\"core.create\":{\"6\":1,\"3\":1},\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1},\"core.edit.own\":{\"6\":1,\"3\":1}}'),
(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 3, 6, 1, 'com_banners', 'com_banners', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),
(4, 1, 7, 8, 1, 'com_cache', 'com_cache', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),
(5, 1, 9, 10, 1, 'com_checkin', 'com_checkin', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),
(6, 1, 11, 12, 1, 'com_config', 'com_config', '{}'),
(7, 1, 13, 16, 1, 'com_contact', 'com_contact', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),
(8, 1, 17, 50, 1, 'com_content', 'com_content', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.edit\":{\"4\":1},\"core.edit.state\":{\"5\":1}}'),
(9, 1, 51, 52, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 53, 54, 1, 'com_installer', 'com_installer', '{\"core.manage\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit.state\":{\"7\":0}}'),
(11, 1, 55, 56, 1, 'com_languages', 'com_languages', '{\"core.admin\":{\"7\":1}}'),
(12, 1, 57, 58, 1, 'com_login', 'com_login', '{}'),
(13, 1, 59, 60, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 61, 62, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 63, 64, 1, 'com_media', 'com_media', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.delete\":{\"5\":1}}'),
(16, 1, 65, 72, 1, 'com_menus', 'com_menus', '{\"core.admin\":{\"7\":1}}'),
(17, 1, 73, 74, 1, 'com_messages', 'com_messages', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),
(18, 1, 75, 140, 1, 'com_modules', 'com_modules', '{\"core.admin\":{\"7\":1}}'),
(19, 1, 141, 144, 1, 'com_newsfeeds', 'com_newsfeeds', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),
(20, 1, 145, 146, 1, 'com_plugins', 'com_plugins', '{\"core.admin\":{\"7\":1}}'),
(21, 1, 147, 148, 1, 'com_redirect', 'com_redirect', '{\"core.admin\":{\"7\":1}}'),
(22, 1, 149, 150, 1, 'com_search', 'com_search', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),
(23, 1, 151, 152, 1, 'com_templates', 'com_templates', '{\"core.admin\":{\"7\":1}}'),
(24, 1, 153, 156, 1, 'com_users', 'com_users', '{\"core.admin\":{\"7\":1}}'),
(26, 1, 157, 158, 1, 'com_wrapper', 'com_wrapper', '{}'),
(27, 8, 18, 19, 2, 'com_content.category.2', 'Uncategorised', '{}'),
(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{}'),
(29, 7, 14, 15, 2, 'com_contact.category.4', 'Uncategorised', '{}'),
(30, 19, 142, 143, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{}'),
(32, 24, 154, 155, 2, 'com_users.category.7', 'Uncategorised', '{}'),
(33, 1, 159, 160, 1, 'com_finder', 'com_finder', '{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),
(34, 1, 161, 162, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{}'),
(35, 1, 163, 164, 1, 'com_tags', 'com_tags', '{}'),
(36, 1, 165, 166, 1, 'com_contenthistory', 'com_contenthistory', '{}'),
(37, 1, 167, 168, 1, 'com_ajax', 'com_ajax', '{}'),
(38, 1, 169, 170, 1, 'com_postinstall', 'com_postinstall', '{}'),
(39, 18, 76, 77, 2, 'com_modules.module.1', 'Main Menu', '{}'),
(40, 18, 78, 79, 2, 'com_modules.module.2', 'Login', '{}'),
(41, 18, 80, 81, 2, 'com_modules.module.3', 'Popular Articles', '{}'),
(42, 18, 82, 83, 2, 'com_modules.module.4', 'Recently Added Articles', '{}'),
(43, 18, 84, 85, 2, 'com_modules.module.8', 'Toolbar', '{}'),
(44, 18, 86, 87, 2, 'com_modules.module.9', 'Quick Icons', '{}'),
(45, 18, 88, 89, 2, 'com_modules.module.10', 'Logged-in Users', '{}'),
(46, 18, 90, 91, 2, 'com_modules.module.12', 'Admin Menu', '{}'),
(47, 18, 92, 93, 2, 'com_modules.module.13', 'Admin Submenu', '{}'),
(48, 18, 94, 95, 2, 'com_modules.module.14', 'User Status', '{}'),
(49, 18, 96, 97, 2, 'com_modules.module.15', 'Title', '{}'),
(50, 18, 98, 99, 2, 'com_modules.module.16', 'Login Form', '{}'),
(51, 18, 100, 101, 2, 'com_modules.module.17', 'com_modules.module.17', '{}'),
(52, 18, 102, 103, 2, 'com_modules.module.79', 'Multilanguage status', '{}'),
(53, 18, 104, 105, 2, 'com_modules.module.86', 'Joomla Version', '{}'),
(54, 16, 66, 67, 2, 'com_menus.menu.1', 'Main Menu', '{}'),
(55, 18, 106, 107, 2, 'com_modules.module.87', 'Sample Data', '{}'),
(56, 8, 20, 29, 2, 'com_content.category.8', 'Blog', '{}'),
(57, 8, 30, 35, 2, 'com_content.category.9', 'Help', '{}'),
(58, 57, 31, 32, 3, 'com_content.article.1', 'About', '{}'),
(59, 57, 33, 34, 3, 'com_content.article.2', 'Working on Your Site', '{}'),
(60, 56, 21, 22, 3, 'com_content.article.3', 'Welcome to your blog', '{}'),
(61, 56, 23, 24, 3, 'com_content.article.4', 'About your home page', '{}'),
(62, 56, 25, 26, 3, 'com_content.article.5', 'Your Modules', '{}'),
(63, 56, 27, 28, 3, 'com_content.article.6', 'Your Template', '{}'),
(64, 16, 68, 69, 2, 'com_menus.menu.2', 'Main Menu Blog', '{}'),
(67, 18, 108, 109, 2, 'com_modules.module.88', 'com_modules.module.88', '{}'),
(68, 18, 110, 111, 2, 'com_modules.module.89', 'Author Menu', '{}'),
(69, 18, 112, 113, 2, 'com_modules.module.90', 'com_modules.module.90', '{}'),
(70, 18, 114, 115, 2, 'com_modules.module.91', 'com_modules.module.91', '{}'),
(71, 18, 116, 117, 2, 'com_modules.module.92', 'com_modules.module.92', '{}'),
(72, 18, 118, 119, 2, 'com_modules.module.93', 'com_modules.module.93', '{}'),
(73, 18, 120, 121, 2, 'com_modules.module.94', 'Bottom Menu', '{}'),
(74, 18, 122, 123, 2, 'com_modules.module.95', 'com_modules.module.95', '{}'),
(75, 18, 124, 125, 2, 'com_modules.module.96', 'com_modules.module.96', '{}'),
(76, 18, 126, 127, 2, 'com_modules.module.97', 'com_modules.module.97', '{}'),
(77, 18, 128, 129, 2, 'com_modules.module.98', 'com_modules.module.98', '{}'),
(78, 18, 130, 131, 2, 'com_modules.module.99', 'Site Information', '{}'),
(79, 18, 132, 133, 2, 'com_modules.module.100', 'Release News', '{}'),
(80, 1, 171, 172, 1, 'com_content.article.7', 'About', '{}'),
(81, 1, 173, 174, 1, 'com_content.article.8', 'Contact Us', '{}'),
(82, 1, 175, 176, 1, 'com_content.article.9', 'Home', '{}'),
(83, 1, 177, 178, 1, 'com_content.article.10', 'Register', '{}'),
(84, 8, 36, 37, 2, 'com_content.category.10', 'Home', '{}'),
(85, 8, 38, 39, 2, 'com_content.category.11', 'About us', '{}'),
(86, 8, 40, 41, 2, 'com_content.category.12', 'Contact Us', '{}'),
(87, 8, 42, 43, 2, 'com_content.category.13', 'Register', '{}'),
(88, 1, 179, 180, 1, 'com_advancedmodules', 'com_advancedmodules', '{\"core.admin\":[],\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),
(89, 1, 181, 182, 1, 'com_content.article.11', 'asdadadasd', '{}'),
(90, 1, 183, 184, 1, 'com_content.article.12', 'asdadadasd', '{}'),
(91, 1, 185, 186, 1, 'com_content.article.13', 'asdadadasd', '{}'),
(92, 93, 45, 46, 3, 'com_content.article.14', 'About us', '{}'),
(93, 8, 44, 47, 2, 'com_content.category.14', 'dddd', '{}'),
(94, 18, 134, 135, 2, 'com_modules.module.101', 'Creative Contact Form', '{}'),
(95, 1, 187, 188, 1, 'com_creativecontactform', 'COM_CREATIVECONTACTFORM', '{}'),
(96, 1, 189, 190, 1, 'com_gridbox', 'GRIDBOX', '{}'),
(98, 16, 70, 71, 2, 'com_menus.menu.5', 'Community Builder', '{}'),
(106, 1, 191, 192, 1, 'com_iquix', 'com_iquix', '{}'),
(107, 1, 193, 196, 1, 'com_quix', 'com_quix', '{}'),
(108, 18, 136, 137, 2, 'com_modules.module.109', 'Administrator Quix Menu', '{}'),
(109, 18, 138, 139, 2, 'com_modules.module.110', 'Module - Quix', '{}'),
(110, 107, 194, 195, 2, 'com_quix.page.1', 'com_quix.page.1', '{}'),
(111, 8, 48, 49, 2, 'com_content.category.15', 'Items', '{}');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_associations`
--

DROP TABLE IF EXISTS `bt8w9_associations`;
CREATE TABLE IF NOT EXISTS `bt8w9_associations` (
  `id` int(11) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_banners`
--

DROP TABLE IF EXISTS `bt8w9_banners`;
CREATE TABLE IF NOT EXISTS `bt8w9_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custombannercode` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`(100)),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_banner_clients`
--

DROP TABLE IF EXISTS `bt8w9_banner_clients`;
CREATE TABLE IF NOT EXISTS `bt8w9_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `extrainfo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_banner_tracks`
--

DROP TABLE IF EXISTS `bt8w9_banner_tracks`;
CREATE TABLE IF NOT EXISTS `bt8w9_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) UNSIGNED NOT NULL,
  `banner_id` int(10) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_categories`
--

DROP TABLE IF EXISTS `bt8w9_categories`;
CREATE TABLE IF NOT EXISTS `bt8w9_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `path` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `extension` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`(100)),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`(100)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_categories`
--

INSERT INTO `bt8w9_categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`, `version`) VALUES
(1, 0, 0, 0, 27, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '{}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(2, 27, 1, 1, 2, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(7, 32, 1, 9, 10, 1, 'uncategorised', 'com_users', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:34:12', 0, '0000-00-00 00:00:00', 0, '*', 1),
(8, 56, 1, 11, 12, 1, 'blog', 'com_content', 'Blog', 'blog', '', '', -2, 0, '0000-00-00 00:00:00', 1, '', '', '', '', 857, '2018-07-08 14:41:03', 0, '2018-07-08 14:41:03', 0, '*', 1),
(9, 57, 1, 13, 14, 1, 'help', 'com_content', 'Help', 'help', '', '', -2, 0, '0000-00-00 00:00:00', 1, '', '', '', '', 857, '2018-07-08 14:41:03', 0, '2018-07-08 14:41:03', 0, '*', 1),
(10, 84, 1, 15, 16, 1, 'home', 'com_content', 'Home', 'home', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:59:43', 0, '2018-07-08 14:59:43', 0, '*', 1),
(11, 85, 1, 17, 18, 1, 'about-us', 'com_content', 'About us', 'about-us', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 14:59:50', 0, '2018-07-08 14:59:50', 0, '*', 1),
(12, 86, 1, 19, 20, 1, 'contact-us', 'com_content', 'Contact Us', 'contact-us', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 15:00:02', 0, '2018-07-08 15:00:02', 0, '*', 1),
(13, 87, 1, 21, 22, 1, 'register', 'com_content', 'Register', 'register', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-08 15:00:10', 0, '2018-07-08 15:00:10', 0, '*', 1),
(14, 93, 1, 23, 24, 1, 'dddd', 'com_content', 'dddd', 'dddd', '', '<p>sdasdad</p>', 1, 0, '0000-00-00 00:00:00', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-09 08:22:08', 0, '2018-07-09 08:22:08', 0, '*', 1),
(15, 111, 1, 25, 26, 1, 'items', 'com_content', 'Items', 'items', '', '', 1, 857, '2018-07-11 08:48:48', 1, '{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}', '', '', '{\"author\":\"\",\"robots\":\"\"}', 857, '2018-07-11 08:11:03', 0, '2018-07-11 08:11:03', 0, '*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(150) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `message_last_sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message_number_sent` int(11) NOT NULL DEFAULT '0',
  `avatar` text,
  `avatarapproved` tinyint(4) NOT NULL DEFAULT '1',
  `canvas` text,
  `canvasapproved` tinyint(4) NOT NULL DEFAULT '1',
  `canvasposition` tinyint(4) NOT NULL DEFAULT '50',
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `confirmed` tinyint(4) NOT NULL DEFAULT '1',
  `lastupdatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registeripaddr` varchar(50) NOT NULL DEFAULT '',
  `cbactivation` varchar(50) NOT NULL DEFAULT '',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `banneddate` datetime DEFAULT NULL,
  `unbanneddate` datetime DEFAULT NULL,
  `bannedby` int(11) DEFAULT NULL,
  `unbannedby` int(11) DEFAULT NULL,
  `bannedreason` mediumtext,
  `acceptedterms` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `alias` (`alias`),
  KEY `apprconfbanid` (`approved`,`confirmed`,`banned`,`id`),
  KEY `avatappr_apr_conf_ban_avatar` (`avatarapproved`,`approved`,`confirmed`,`banned`,`avatar`(48)),
  KEY `lastupdatedate` (`lastupdatedate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_comprofiler`
--

INSERT INTO `bt8w9_comprofiler` (`id`, `user_id`, `alias`, `firstname`, `middlename`, `lastname`, `hits`, `message_last_sent`, `message_number_sent`, `avatar`, `avatarapproved`, `canvas`, `canvasapproved`, `canvasposition`, `approved`, `confirmed`, `lastupdatedate`, `registeripaddr`, `cbactivation`, `banned`, `banneddate`, `unbanneddate`, `bannedby`, `unbannedby`, `bannedreason`, `acceptedterms`) VALUES
(857, 857, NULL, NULL, NULL, NULL, 0, '0000-00-00 00:00:00', 0, NULL, 1, NULL, 1, 50, 1, 1, '0000-00-00 00:00:00', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
(858, 858, NULL, NULL, NULL, NULL, 0, '0000-00-00 00:00:00', 0, NULL, 1, NULL, 1, 50, 1, 1, '0000-00-00 00:00:00', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_fields`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_fields`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_fields` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `tablecolumns` text NOT NULL,
  `table` varchar(50) NOT NULL DEFAULT '#__comprofiler',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `maxlength` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `required` tinyint(4) DEFAULT '0',
  `tabid` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `cols` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `default` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `profile` tinyint(1) NOT NULL DEFAULT '1',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `searchable` tinyint(1) NOT NULL DEFAULT '0',
  `calculated` tinyint(1) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `pluginid` int(11) NOT NULL DEFAULT '0',
  `cssclass` varchar(255) DEFAULT NULL,
  `params` mediumtext,
  PRIMARY KEY (`fieldid`),
  KEY `tabid_pub_prof_order` (`tabid`,`published`,`profile`,`ordering`),
  KEY `readonly_published_tabid` (`readonly`,`published`,`tabid`),
  KEY `registration_published_order` (`registration`,`published`,`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_comprofiler_fields`
--

INSERT INTO `bt8w9_comprofiler_fields` (`fieldid`, `name`, `tablecolumns`, `table`, `title`, `description`, `type`, `maxlength`, `size`, `required`, `tabid`, `ordering`, `cols`, `rows`, `value`, `default`, `published`, `registration`, `edit`, `profile`, `readonly`, `searchable`, `calculated`, `sys`, `pluginid`, `cssclass`, `params`) VALUES
(17, 'canvas', 'canvas,canvasapproved,canvasposition', '#__comprofiler', 'USER_CANVAS_IMAGE_TITLE', '', 'image', NULL, NULL, 0, 7, 1, NULL, NULL, NULL, NULL, 1, 0, 1, 4, 0, 0, 1, 1, 1, NULL, NULL),
(24, 'connections', '', '#__comprofiler', '_UE_CONNECTION', '', 'connections', NULL, NULL, 0, 6, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 2, 1, 0, 1, 1, 1, NULL, NULL),
(25, 'hits', 'hits', '#__comprofiler', '_UE_HITS', '_UE_HITS_DESC', 'counter', NULL, NULL, 0, 6, 2, NULL, NULL, NULL, NULL, 1, 0, 0, 2, 1, 0, 1, 1, 1, NULL, NULL),
(26, 'onlinestatus', '', '#__comprofiler', '_UE_ONLINESTATUS', '', 'status', NULL, NULL, 0, 20, 2, NULL, NULL, NULL, NULL, 1, 0, 0, 4, 0, 0, 1, 1, 1, NULL, NULL),
(27, 'lastvisitDate', 'lastvisitDate', '#__users', '_UE_LASTONLINE', '', 'datetime', NULL, NULL, 0, 21, 2, NULL, NULL, NULL, NULL, 1, 0, 0, 2, 1, 0, 1, 1, 1, NULL, 'field_display_by=2'),
(28, 'registerDate', 'registerDate', '#__users', '_UE_MEMBERSINCE', '', 'datetime', NULL, NULL, 0, 21, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 2, 1, 0, 1, 1, 1, NULL, 'field_display_by=6'),
(29, 'avatar', 'avatar,avatarapproved', '#__comprofiler', '_UE_IMAGE', '', 'image', NULL, NULL, 0, 20, 1, NULL, NULL, NULL, NULL, 1, 0, 1, 4, 0, 0, 1, 1, 1, NULL, NULL),
(41, 'name', 'name', '#__users', '_UE_NAME', '_UE_REGWARN_NAME', 'predefined', NULL, NULL, 1, 11, 2, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(42, 'username', 'username', '#__users', '_UE_UNAME', '_UE_VALID_UNAME', 'predefined', NULL, NULL, 1, 11, 6, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(44, 'acceptedterms', 'acceptedterms', '#__comprofiler', 'USER_TERMS_AND_CONDITIONS_TITLE', '', 'terms', NULL, NULL, 0, 11, 12, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 1, 1, 1, NULL, NULL),
(45, 'formatname', '', '#__comprofiler', '_UE_FORMATNAME', '', 'formatname', NULL, NULL, 0, 11, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, NULL),
(46, 'firstname', 'firstname', '#__comprofiler', '_UE_YOUR_FNAME', '_UE_REGWARN_FNAME', 'predefined', NULL, NULL, 1, 11, 3, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(47, 'middlename', 'middlename', '#__comprofiler', '_UE_YOUR_MNAME', '_UE_REGWARN_MNAME', 'predefined', NULL, NULL, 0, 11, 4, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(48, 'lastname', 'lastname', '#__comprofiler', '_UE_YOUR_LNAME', '_UE_REGWARN_LNAME', 'predefined', NULL, NULL, 1, 11, 5, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(49, 'lastupdatedate', 'lastupdatedate', '#__comprofiler', '_UE_LASTUPDATEDON', '', 'datetime', NULL, NULL, 0, 21, 3, NULL, NULL, NULL, NULL, 1, 0, 0, 2, 1, 0, 1, 1, 1, NULL, 'field_display_by=2'),
(50, 'email', 'email', '#__users', '_UE_EMAIL', '_UE_REGWARN_MAIL', 'primaryemailaddress', NULL, NULL, 1, 11, 8, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(51, 'password', 'password', '#__users', '_UE_PASS', '_UE_VALID_PASS', 'password', 50, NULL, 1, 11, 9, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(52, 'params', 'params', '#__users', '_UE_USERPARAMS', '', 'userparams', NULL, NULL, 0, 11, 10, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 0, 1, 1, 1, NULL, NULL),
(53, 'pm', '', '#__comprofiler', '_UE_PM', '', 'pm', NULL, NULL, 0, 11, 11, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 1, 1, 1, NULL, NULL),
(54, 'alias', 'alias', '#__comprofiler', 'YOUR_PROFILE_URL', 'YOUR_PROFILE_URL_DESC', 'predefined', NULL, NULL, 0, 11, 7, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_field_values`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_field_values`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_field_values` (
  `fieldvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) NOT NULL DEFAULT '0',
  `fieldtitle` varchar(255) NOT NULL DEFAULT '',
  `fieldlabel` varchar(255) NOT NULL DEFAULT '',
  `fieldgroup` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldvalueid`),
  KEY `fieldid_ordering` (`fieldid`,`ordering`),
  KEY `fieldtitle_id` (`fieldtitle`,`fieldid`),
  KEY `fieldlabel_id` (`fieldlabel`,`fieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_lists`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_lists`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_lists` (
  `listid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `viewaccesslevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `usergroupids` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` mediumtext,
  PRIMARY KEY (`listid`),
  KEY `pub_ordering` (`published`,`ordering`),
  KEY `default_published` (`default`,`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_members`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_members`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_members` (
  `referenceid` int(11) NOT NULL DEFAULT '0',
  `memberid` int(11) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '1',
  `pending` tinyint(1) NOT NULL DEFAULT '0',
  `membersince` date NOT NULL DEFAULT '0000-00-00',
  `reason` mediumtext,
  `description` varchar(255) DEFAULT NULL,
  `type` mediumtext,
  PRIMARY KEY (`referenceid`,`memberid`),
  KEY `pamr` (`pending`,`accepted`,`memberid`,`referenceid`),
  KEY `aprm` (`accepted`,`pending`,`referenceid`,`memberid`),
  KEY `membrefid` (`memberid`,`referenceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_plugin`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_plugin`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) DEFAULT '',
  `folder` varchar(100) DEFAULT '',
  `viewaccesslevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `backend_menu` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `element` (`element`),
  KEY `folder` (`folder`),
  KEY `idx_folder` (`published`,`client_id`,`viewaccesslevel`,`folder`),
  KEY `type_pub_order` (`type`,`published`,`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_comprofiler_plugin`
--

INSERT INTO `bt8w9_comprofiler_plugin` (`id`, `name`, `element`, `type`, `folder`, `viewaccesslevel`, `backend_menu`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'CB Core', 'cb.core', 'user', 'plug_cbcore', 1, '', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', '{\"name_style\":\"3\",\"name_format\":\"3\",\"date_format\":\"m\\/d\\/Y\",\"time_format\":\"H:i:s\",\"calendar_type\":\"2\",\"allow_email_display\":\"3\",\"allow_email_public\":\"0\",\"allow_email_replyto\":\"1\",\"allow_email\":\"1\",\"allow_website\":\"1\",\"allow_onlinestatus\":\"1\",\"icons_display\":\"3\",\"login_type\":\"0\",\"reg_admin_allowcbregistration\":\"0\",\"emailpass\":\"0\",\"reg_admin_approval\":\"0\",\"reg_confirmation\":\"1\",\"reg_username_checker\":\"0\",\"reg_ipaddress\":\"1\",\"reg_show_login_on_page\":\"0\",\"reg_email_name\":\"REGISTRATION_EMAIL_FROM_NAME\",\"reg_email_from\":\"\",\"reg_email_replyto\":\"\",\"reg_email_html\":\"0\",\"reg_pend_appr_sub\":\"YOUR_REGISTRATION_IS_PENDING_APPROVAL_SUBJECT\",\"reg_pend_appr_msg\":\"YOUR_REGISTRATION_IS_PENDING_APPROVAL_MESSAGE\",\"reg_welcome_sub\":\"YOUR_REGISTRATION_IS_APPROVED_SUBJECT\",\"reg_welcome_msg\":\"YOUR_REGISTRATION_IS_APPROVED_MESSAGE\",\"reg_layout\":\"flat\",\"reg_show_icons_explain\":\"0\",\"reg_title_img\":\"general\",\"reg_intro_msg\":\"REGISTRATION_GREETING\",\"reg_conclusion_msg\":\"REGISTRATION_CONCLUSION\",\"reg_first_visit_url\":\"index.php?option=com_comprofiler&view=userprofile\",\"usernameedit\":\"0\",\"usernamefallback\":\"name\",\"adminrequiredfields\":\"1\",\"profile_viewaccesslevel\":\"2\",\"maxEmailsPerHr\":\"50\",\"profile_recordviews\":\"1\",\"minHitsInterval\":\"60\",\"templatedir\":\"default\",\"use_divs\":\"1\",\"mainLayoutLeftSize\":\"3\",\"mainLayoutMiddleSize\":\"0\",\"mainLayoutRightSize\":\"3\",\"showEmptyTabs\":\"1\",\"showEmptyFields\":\"1\",\"emptyFieldsText\":\"-\",\"frontend_userparams\":\"1\",\"profile_edit_layout\":\"tabbed\",\"profile_edit_show_icons_explain\":\"0\",\"html_filter_allowed_tags\":\"\",\"conversiontype\":\"0\",\"avatarResizeAlways\":\"1\",\"avatarHeight\":\"500\",\"avatarWidth\":\"200\",\"avatarSize\":\"2000\",\"thumbHeight\":\"86\",\"thumbWidth\":\"60\",\"avatarMaintainRatio\":\"1\",\"moderator_viewaccesslevel\":\"3\",\"allowModUserApproval\":\"1\",\"moderatorEmail\":\"1\",\"allowUserReports\":\"1\",\"avatarUploadApproval\":\"1\",\"allowModeratorsUserEdit\":\"0\",\"allowUserBanning\":\"1\",\"allowConnections\":\"1\",\"connectionDisplay\":\"0\",\"connectionPath\":\"1\",\"useMutualConnections\":\"1\",\"conNotifyType\":\"0\",\"autoAddConnections\":\"1\",\"connection_categories\":\"Friend\\r\\nCo Worker\\r\\nFamily\",\"translations_debug\":\"0\",\"enableSpoofCheck\":\"1\",\"noVersionCheck\":\"0\",\"pluginVersionCheck\":\"1\",\"installFromWeb\":\"1\",\"sendemails\":\"1\",\"templateBootstrap4\":\"1\",\"templateFontawesme\":\"1\",\"jsJquery\":\"1\",\"jsJqueryMigrate\":\"1\"}'),
(2, 'CB Connections', 'cb.connections', 'user', 'plug_cbconnections', 1, '', 3, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(7, 'Default', 'default', 'templates', 'default', 1, '', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(13, 'Default language (English)', 'default_language', 'language', 'default_language', 1, '', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(14, 'CB Menu', 'cb.menu', 'user', 'plug_cbmenu', 1, '', 2, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(15, 'Private Message System', 'pms.mypmspro', 'user', 'plug_pms_mypmspro', 1, '', 8, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(17, 'CB Articles', 'cbarticles', 'user', 'plug_cbarticles', 1, '', 8, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(18, 'CB Forums', 'cbforums', 'user', 'plug_cbforums', 1, '', 9, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(19, 'CB Blogs', 'cbblogs', 'user', 'plug_cbblogs', 1, '', 10, 1, 1, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_plugin_blogs`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_plugin_blogs`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_plugin_blogs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `blog_intro` text,
  `blog_full` text,
  `category` varchar(255) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '99999',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `user` (`user`),
  KEY `access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_ratings`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_ratings`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT 'field',
  `item` int(11) NOT NULL DEFAULT '0',
  `target` int(11) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `ip_address` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_sessions`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_sessions`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_sessions` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `userid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ui` tinyint(4) NOT NULL DEFAULT '0',
  `incoming_ip` varchar(39) NOT NULL DEFAULT '',
  `client_ip` varchar(39) NOT NULL DEFAULT '',
  `session_id` varchar(33) NOT NULL DEFAULT '',
  `session_data` mediumtext NOT NULL,
  `expiry_time` int(14) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `expiry_time` (`expiry_time`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_tabs`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_tabs`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_tabs` (
  `tabid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `ordering_edit` int(11) NOT NULL DEFAULT '10',
  `ordering_register` int(11) NOT NULL DEFAULT '10',
  `width` varchar(10) NOT NULL DEFAULT '.5',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `pluginclass` varchar(255) DEFAULT NULL,
  `pluginid` int(11) DEFAULT NULL,
  `fields` tinyint(1) NOT NULL DEFAULT '1',
  `params` mediumtext,
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `displaytype` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `viewaccesslevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `cssclass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tabid`),
  KEY `pluginclass` (`pluginclass`),
  KEY `enabled_position_ordering` (`enabled`,`position`,`ordering`),
  KEY `orderedit_enabled_pos_order` (`enabled`,`ordering_edit`,`position`,`ordering`),
  KEY `orderreg_enabled_pos_order` (`enabled`,`ordering_register`,`position`,`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_comprofiler_tabs`
--

INSERT INTO `bt8w9_comprofiler_tabs` (`tabid`, `title`, `description`, `ordering`, `ordering_edit`, `ordering_register`, `width`, `enabled`, `pluginclass`, `pluginid`, `fields`, `params`, `sys`, `displaytype`, `position`, `viewaccesslevel`, `cssclass`) VALUES
(6, 'USER_STATISTICS_TITLE', '', 1, 10, 10, '.5', 1, 'getStatsTab', 1, 1, NULL, 1, 'html', 'canvas_stats', 1, NULL),
(7, 'USER_CANVAS_TITLE', '', 1, 11, 11, '1', 1, 'getCanvasTab', 1, 1, NULL, 1, 'html', 'canvas_background', 1, NULL),
(8, 'BLOGS_TITLE', '', 3, 10, 10, '1', 1, 'cbblogsTab', 19, 0, NULL, 1, 'menu', 'canvas_main_middle', 1, NULL),
(9, 'FORUMS_TITLE', '', 4, 10, 10, '1', 0, 'cbforumsTab', 18, 0, NULL, 1, 'menu', 'canvas_main_middle', 1, NULL),
(10, 'ARTICLES_TITLE', '', 2, 10, 10, '1', 1, 'cbarticlesTab', 17, 0, NULL, 1, 'menu', 'canvas_main_middle', 1, NULL),
(11, '_UE_CONTACT_INFO_HEADER', '', 1, 10, 10, '1', 1, 'getContactTab', 1, 1, NULL, 1, 'menu', 'canvas_main_middle', 1, NULL),
(15, '_UE_CONNECTION', '', 5, 10, 10, '1', 1, 'getConnectionTab', 2, 0, NULL, 1, 'menunested', 'canvas_main_middle', 1, NULL),
(17, '_UE_MENU', '', 1, 10, 10, '1', 1, 'getMenuTab', 14, 0, NULL, 1, 'html', 'canvas_menu', 1, NULL),
(18, '_UE_CONNECTIONPATHS', '', 1, 10, 10, '1', 1, 'getConnectionPathsTab', 2, 0, NULL, 1, 'html', 'cb_head', 1, NULL),
(19, '_UE_PROFILE_PAGE_TITLE', '', 1, 10, 10, '1', 1, 'getPageTitleTab', 1, 1, NULL, 1, 'html', 'canvas_title', 1, NULL),
(20, '_UE_PORTRAIT', '', 1, 11, 11, '1', 1, 'getPortraitTab', 1, 1, NULL, 1, 'html', 'canvas_photo', 1, NULL),
(21, '_UE_USER_STATUS', '', 1, 10, 10, '.5', 1, 'getStatusTab', 14, 1, NULL, 1, 'html', 'canvas_main_right', 1, NULL),
(22, '_UE_PMSTAB', '', 6, 10, 10, '.5', 0, 'getmypmsproTab', 15, 0, NULL, 1, 'menunested', 'canvas_main_middle', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_userreports`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_userreports`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_userreports` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `reporteduser` int(11) NOT NULL DEFAULT '0',
  `reportedbyuser` int(11) NOT NULL DEFAULT '0',
  `reportedondate` date NOT NULL DEFAULT '0000-00-00',
  `reportexplaination` text NOT NULL,
  `reportedstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reportid`),
  KEY `status_user_date` (`reportedstatus`,`reporteduser`,`reportedondate`),
  KEY `reportedbyuser_ondate` (`reportedbyuser`,`reportedondate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_comprofiler_views`
--

DROP TABLE IF EXISTS `bt8w9_comprofiler_views`;
CREATE TABLE IF NOT EXISTS `bt8w9_comprofiler_views` (
  `viewer_id` int(11) NOT NULL DEFAULT '0',
  `profile_id` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  `lastview` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewscount` int(11) NOT NULL DEFAULT '0',
  `vote` tinyint(3) DEFAULT NULL,
  `lastvote` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`viewer_id`,`profile_id`,`lastip`),
  KEY `lastview` (`lastview`),
  KEY `profile_id_lastview` (`profile_id`,`lastview`,`viewer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_contact_details`
--

DROP TABLE IF EXISTS `bt8w9_contact_details`;
CREATE TABLE IF NOT EXISTS `bt8w9_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `con_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `suburb` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `misc` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_con` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `webpage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sortname1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sortname2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sortname3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Set if contact is featured.',
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_contact_templates`
--

DROP TABLE IF EXISTS `bt8w9_contact_templates`;
CREATE TABLE IF NOT EXISTS `bt8w9_contact_templates` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `created` datetime NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `checked_out` int(10) UNSIGNED NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `access` int(10) UNSIGNED NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL,
  `ordering` int(11) NOT NULL,
  `language` char(7) NOT NULL,
  `styles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_contact_templates`
--

INSERT INTO `bt8w9_contact_templates` (`id`, `name`, `created`, `date_start`, `date_end`, `publish_up`, `publish_down`, `published`, `checked_out`, `checked_out_time`, `access`, `featured`, `ordering`, `language`, `styles`) VALUES
(1, 'White Template 1', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0, 0, 0, '', '587~#111111|588~13|131~Arial, Helvetica, sans-serif|589~1|629~inset-2-dark|630~inset-2-dark|627~1|0~#ffffff|130~#ffffff|517~50|518~50|1~#dedede|2~1|3~solid|4~0|5~0|6~0|7~0|8~#ffffff|9~|10~0|11~0|12~0|13~0|14~#bababa|15~|16~0|17~0|18~7|19~0|600~0|601~#ffffff|602~#ffffff|603~15|604~15|605~15|606~15|607~0|608~solid|609~#ffffff|610~0|611~#ffffff|612~#ffffff|613~5|614~15|615~10|616~15|617~0|618~#ffffff|619~#ffffff|620~0|621~15|622~15|623~15|624~0|625~solid|626~#ffffff|20~#000000|21~28|22~normal|23~normal|24~none|25~left|506~inherit|510~ccf_font_effect_none|27~#ffffff|28~2|29~1|30~2|190~3|191~0|192~82|502~left|193~3|194~1|195~#a8a8a8|196~dotted|197~#000000|198~13|199~normal|200~normal|201~none|202~inherit|511~ccf_font_effect_none|203~#ffffff|204~0|205~0|206~0|215~0|216~0|217~1|218~3|31~#000000|32~13|33~normal|34~normal|35~none|36~left|507~inherit|512~ccf_font_effect_none|37~#ffffff|38~2|39~1|40~1|41~#ff0000|42~20|43~normal|44~normal|509~inherit|46~#ffffff|47~0|48~0|49~0|505~white|508~inherit|132~#ffffff|133~#ffffff|168~60|519~90|520~90|500~left|501~left|134~#cccccc|135~1|136~solid|137~0|138~0|139~0|140~0|141~#f5f5f5|142~|143~0|144~0|145~10|146~0|147~#000000|148~14|149~normal|150~normal|151~none|152~inherit|153~#ffffff|154~0|155~0|156~0|157~#ffffff|158~#ffffff|159~#1c1c1c|160~#ffffff|161~#cccccc|162~#d4d4d4|163~|164~0|165~0|166~10|167~2|513~ccf_font_effect_none|176~#ffdbdd|177~#ffdbdd|178~#ff9999|179~#363636|180~#ffffff|181~0|182~0|183~0|184~#ebaaaa|185~inset|186~0|187~0|188~19|189~0|171~#c70808|514~ccf_font_effect_none|172~#ffffff|173~2|174~1|175~1|169~95|521~90|522~90|170~150|523~130|535~8|536~15|537~9|538~12|539~15|540~15|541~#f4f6f7|542~#f4f6f7|543~1|544~1|545~1|546~1|547~solid|548~#d4d4d4|549~#d4d4d4|550~#d4d4d4|551~#d4d4d4|524~#525252|525~15|526~normal|527~normal|528~none|529~inherit|530~ccf_font_effect_none|531~#e0e0e0|532~0|533~0|534~0|91~#ffffff|50~#e0e0e0|212~right|92~12|93~26|209~95|100~#c2c2c2|101~1|127~solid|102~0|103~0|104~0|105~0|94~#525252|95~|96~0|97~0|98~0|99~0|106~#666666|107~14|108~bold|109~normal|110~none|112~inherit|515~ccf_font_effect_none|113~#ffffff|114~0|115~0|116~3|51~#ffffff|52~#e0e0e0|124~#6b6b6b|516~ccf_font_effect_none|125~#ffffff|126~#cfcfcf|117~#999999|118~|119~0|120~0|121~6|122~0|552~1|553~#3d3d3d|554~14|555~normal|556~normal|596~none|590~0|591~dotted|592~#fafafa|558~#ffffff|559~0|560~0|561~0|563~10|562~1|597~10|598~30|564~#0055cc|565~bold|566~normal|594~none|567~1|568~dotted|569~#ffffff|570~#ffffff|571~0|572~0|573~0|574~#b00023|595~none|575~#b50000|576~#ffffff|577~0|578~0|579~0|580~#008f00|581~normal|582~italic|593~none|583~#ffffff|584~0|585~0|586~0|599~/*Creative Scrollbar***************************************/\n.creative_form_FORM_ID .creative_content_scrollbar {\nbackground-color: #ddd;\ncolor: #333;\nborder-radius: 12px;\n}\n.creative_form_FORM_ID .creative_content_scrollbar hr {\nborder-bottom: 1px solid rgba(255,255,255,0.6);\nborder-top: 1px solid rgba(0,0,0,0.2);\n}\n.creative_form_FORM_ID p.scrollbar_light {\npadding: 5px 10px;\nborder-radius: 6px;\ncolor: #666;\nbackground: #fff;\nbackground: rgba(255,255,255,0.8);\n}|628~');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_content`
--

DROP TABLE IF EXISTS `bt8w9_content`;
CREATE TABLE IF NOT EXISTS `bt8w9_content` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `introtext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fulltext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urls` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribs` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`),
  KEY `idx_alias` (`alias`(191))
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_content`
--

INSERT INTO `bt8w9_content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(1, 58, 'About', 'about', '<p>This tells you a bit about this blog and the person who writes it. </p><p>When you are logged in you will be able to edit this page by selecting the edit icon.</p>', '', -2, 9, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 1, 1, '', '', 1, 5, '{}', 0, '*', ''),
(2, 59, 'Working on Your Site', 'working-on-your-site', '<p>Here are some basic tips for working on your site.</p><ul><li>Joomla! has a \'front end\' that you are looking at now and an \'administrator\' or back end\' which is where you do the more advanced work of creating your site such as setting up the menus and deciding what modules to show. You need to login to the administrator separately using the same user name and password that you used to login to this part of the site.</li><li>One of the first things you will probably want to do is change the site title and tag line and to add a logo. To do this select the Template Settings link in the top menu. To change your site description, browser title, default email and other items, select Site Settings. More advanced configuration options are available in the administrator.</li><li>To totally change the look of your site you will probably want to install a new template. In the Extensions menu select Extensions Manager and then go to the Install tab. There are many free and commercial templates available for Joomla.</li><li>As you have already seen, you can control who can see different parts of you site. When you work with modules, articles or weblinks setting the Access level to Registered will mean that only logged in users can see them</li><li>When you create a new article or other kind of content you also can save it as Published or Unpublished. If it is Unpublished site visitors will not be able to see it but you will.</li><li>You can learn much more about working with Joomla from the <a href=\'https://docs.joomla.org/\'>Joomla documentation site</a> and get help from other users at the <a href=\'https://forum.joomla.org/\'>Joomla forums</a>. In the administrator there are help buttons on every page that provide detailed information about the functions on that page.</li></ul>', '', -2, 9, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 2, 1, '', '', 3, 1, '{}', 0, '*', ''),
(3, 60, 'Welcome to your blog', 'welcome-to-your-blog', '<p>This is a sample blog posting.</p><p>If you log in to the site (the Author Login link is on the very bottom of this page) you will be able to edit it and all of the other existing articles. You will also be able to create a new article and make other changes to the site.</p><p>As you add and modify articles you will see how your site changes and also how you can customise it in various ways.</p><p>Go ahead, you can\'t break it.</p>', '', -2, 8, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 3, 2, '', '', 1, 0, '{}', 0, '*', ''),
(4, 61, 'About your home page', 'about-your-home-page', '<p>Your home page is set to display the four most recent articles from the blog category in a column. Then there are links to the 4 next oldest articles. You can change those numbers by editing the content options settings in the blog tab in your site administrator. There is a link to your site administrator in the top menu.</p><p>If you want to have your blog post broken into two parts, an introduction and then a full length separate page, use the Read More button to insert a break.</p>', '<p>On the full page you will see both the introductory content and the rest of the article. You can change the settings to hide the introduction if you want.</p><p></p><p></p><p></p>', -2, 8, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 4, 3, '', '', 1, 0, '{}', 0, '*', ''),
(5, 62, 'Your Modules', 'your-modules', '<p>Your site has some commonly used modules already preconfigured. These include:</p><ul><li>Image Module which holds the image beneath the menu. This is a Custom module that you can edit to change the image.</li><li>Most Read Posts which lists articles based on the number of times they have been read.</li><li>Older Articles which lists out articles by month.</li><li>Syndicate which allows your readers to read your posts in a news reader.</li><li>Popular Tags, which will appear if you use tagging on your articles. Enter a tag in the Tags field when editing.</li></ul><p>Each of these modules has many options which you can experiment with in the Module Manager in your site Administrator. Moving your mouse over a module and selecting the edit icon will take you to an edit screen for that module. Always be sure to save and close any module you edit.</p><p>Joomla! also includes many other modules you can incorporate in your site. As you develop your site you may want to add more module that you can find at the <a href=\'https://extensions.joomla.org/\'>Joomla Extensions Directory.</a></p>', '', -2, 8, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 5, 1, '', '', 1, 0, '{}', 0, '*', ''),
(6, 63, 'Your Template', 'your-template', '<p>Templates control the look and feel of your website.</p><p>This blog is installed with the Protostar template.</p><p>You can edit the options by selecting the Working on Your Site, Template Settings link in the top menu (visible when you login).</p><p>For example you can change the site background color, highlights color, site title, site description and title font used.</p><p>More options are available in the site administrator. You may also install a new template using the extension manager.</p>', '', -2, 8, '2018-07-08 14:41:03', 857, '', '2018-07-08 14:41:03', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:41:03', '0000-00-00 00:00:00', '', '{}', '{}', 6, 0, '', '', 1, 0, '{}', 0, '*', ''),
(7, 80, 'About', 'about', '', '', -2, 0, '2018-07-08 14:52:44', 857, '', '2018-07-08 14:52:44', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:52:44', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 3, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(8, 81, 'Contact Us', 'contact-us', '', '', -2, 0, '2018-07-08 14:53:05', 857, '', '2018-07-08 14:53:05', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:53:05', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 2, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(9, 82, 'Home', 'home', '', '', -2, 0, '2018-07-08 14:53:19', 857, '', '2018-07-08 14:54:48', 857, 0, '0000-00-00 00:00:00', '2018-07-08 14:53:19', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 2, 1, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(10, 83, 'Register', 'register', '', '', -2, 0, '2018-07-08 14:53:43', 857, '', '2018-07-08 14:53:43', 0, 0, '0000-00-00 00:00:00', '2018-07-08 14:53:43', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 0, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(11, 89, 'asdadadasd', 'asdadadasd', '', '', -2, 0, '2018-07-09 06:39:07', 857, '', '2018-07-09 06:39:07', 0, 857, '2018-07-09 06:39:07', '2018-07-09 06:39:07', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 2, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(12, 90, 'asdadadasd', 'asdadadasd-2', '', '', -2, 0, '2018-07-09 06:39:10', 857, '', '2018-07-09 06:39:10', 0, 857, '2018-07-09 06:39:10', '2018-07-09 06:39:10', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 1, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(13, 91, 'asdadadasd', 'asdadadasd-3', '', '', -2, 0, '2018-07-09 06:39:13', 857, '', '2018-07-09 06:39:13', 0, 0, '0000-00-00 00:00:00', '2018-07-09 06:39:13', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 1, 0, '', '', 1, 1, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
(14, 92, 'About us', 'sdsdsdsd', '<p>ABOUT US</p>', '', 1, 14, '2018-07-09 08:14:14', 857, '', '2018-07-11 03:37:21', 857, 0, '0000-00-00 00:00:00', '2018-07-09 08:14:14', '0000-00-00 00:00:00', '{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"0\",\"show_article_options\":\"0\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}', 5, 0, '', '', 1, 24, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_contentitem_tag_map`
--

DROP TABLE IF EXISTS `bt8w9_contentitem_tag_map`;
CREATE TABLE IF NOT EXISTS `bt8w9_contentitem_tag_map` (
  `type_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_content_id` int(10) UNSIGNED NOT NULL COMMENT 'PK from the core content table',
  `content_item_id` int(11) NOT NULL COMMENT 'PK from the content type table',
  `tag_id` int(10) UNSIGNED NOT NULL COMMENT 'PK from the tag table',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date of most recent save for this tag-item',
  `type_id` mediumint(8) NOT NULL COMMENT 'PK from the content_type table',
  UNIQUE KEY `uc_ItemnameTagid` (`type_id`,`content_item_id`,`tag_id`),
  KEY `idx_tag_type` (`tag_id`,`type_id`),
  KEY `idx_date_id` (`tag_date`,`tag_id`),
  KEY `idx_core_content_id` (`core_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Maps items from content tables to tags';

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_content_frontpage`
--

DROP TABLE IF EXISTS `bt8w9_content_frontpage`;
CREATE TABLE IF NOT EXISTS `bt8w9_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_content_rating`
--

DROP TABLE IF EXISTS `bt8w9_content_rating`;
CREATE TABLE IF NOT EXISTS `bt8w9_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rating_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_content_types`
--

DROP TABLE IF EXISTS `bt8w9_content_types`;
CREATE TABLE IF NOT EXISTS `bt8w9_content_types` (
  `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type_alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rules` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_mappings` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `router` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content_history_options` varchar(5120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'JSON string for com_contenthistory options',
  PRIMARY KEY (`type_id`),
  KEY `idx_alias` (`type_alias`(100))
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_content_types`
--

INSERT INTO `bt8w9_content_types` (`type_id`, `type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `router`, `content_history_options`) VALUES
(1, 'Article', 'com_content.article', '{\"special\":{\"dbtable\":\"#__content\",\"key\":\"id\",\"type\":\"Content\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"state\",\"core_alias\":\"alias\",\"core_created_time\":\"created\",\"core_modified_time\":\"modified\",\"core_body\":\"introtext\", \"core_hits\":\"hits\",\"core_publish_up\":\"publish_up\",\"core_publish_down\":\"publish_down\",\"core_access\":\"access\", \"core_params\":\"attribs\", \"core_featured\":\"featured\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"images\", \"core_urls\":\"urls\", \"core_version\":\"version\", \"core_ordering\":\"ordering\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"catid\", \"core_xreference\":\"xreference\", \"asset_id\":\"asset_id\"}, \"special\":{\"fulltext\":\"fulltext\"}}', 'ContentHelperRoute::getArticleRoute', '{\"formFile\":\"administrator\\/components\\/com_content\\/models\\/forms\\/article.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\"],\"ignoreChanges\":[\"modified_by\", \"modified\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\"],\"convertToInt\":[\"publish_up\", \"publish_down\", \"featured\", \"ordering\"],\"displayLookup\":[{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"created_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"} ]}'),
(2, 'Contact', 'com_contact.contact', '{\"special\":{\"dbtable\":\"#__contact_details\",\"key\":\"id\",\"type\":\"Contact\",\"prefix\":\"ContactTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"name\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created\",\"core_modified_time\":\"modified\",\"core_body\":\"address\", \"core_hits\":\"hits\",\"core_publish_up\":\"publish_up\",\"core_publish_down\":\"publish_down\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"featured\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"image\", \"core_urls\":\"webpage\", \"core_version\":\"version\", \"core_ordering\":\"ordering\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"catid\", \"core_xreference\":\"xreference\", \"asset_id\":\"null\"}, \"special\":{\"con_position\":\"con_position\",\"suburb\":\"suburb\",\"state\":\"state\",\"country\":\"country\",\"postcode\":\"postcode\",\"telephone\":\"telephone\",\"fax\":\"fax\",\"misc\":\"misc\",\"email_to\":\"email_to\",\"default_con\":\"default_con\",\"user_id\":\"user_id\",\"mobile\":\"mobile\",\"sortname1\":\"sortname1\",\"sortname2\":\"sortname2\",\"sortname3\":\"sortname3\"}}', 'ContactHelperRoute::getContactRoute', '{\"formFile\":\"administrator\\/components\\/com_contact\\/models\\/forms\\/contact.xml\",\"hideFields\":[\"default_con\",\"checked_out\",\"checked_out_time\",\"version\",\"xreference\"],\"ignoreChanges\":[\"modified_by\", \"modified\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\"],\"convertToInt\":[\"publish_up\", \"publish_down\", \"featured\", \"ordering\"], \"displayLookup\":[ {\"sourceColumn\":\"created_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"} ] }'),
(3, 'Newsfeed', 'com_newsfeeds.newsfeed', '{\"special\":{\"dbtable\":\"#__newsfeeds\",\"key\":\"id\",\"type\":\"Newsfeed\",\"prefix\":\"NewsfeedsTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"name\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created\",\"core_modified_time\":\"modified\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"publish_up\",\"core_publish_down\":\"publish_down\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"featured\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"images\", \"core_urls\":\"link\", \"core_version\":\"version\", \"core_ordering\":\"ordering\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"catid\", \"core_xreference\":\"xreference\", \"asset_id\":\"null\"}, \"special\":{\"numarticles\":\"numarticles\",\"cache_time\":\"cache_time\",\"rtl\":\"rtl\"}}', 'NewsfeedsHelperRoute::getNewsfeedRoute', '{\"formFile\":\"administrator\\/components\\/com_newsfeeds\\/models\\/forms\\/newsfeed.xml\",\"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\"],\"ignoreChanges\":[\"modified_by\", \"modified\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\"],\"convertToInt\":[\"publish_up\", \"publish_down\", \"featured\", \"ordering\"],\"displayLookup\":[{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"created_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"} ]}'),
(4, 'User', 'com_users.user', '{\"special\":{\"dbtable\":\"#__users\",\"key\":\"id\",\"type\":\"User\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"name\",\"core_state\":\"null\",\"core_alias\":\"username\",\"core_created_time\":\"registerdate\",\"core_modified_time\":\"lastvisitDate\",\"core_body\":\"null\", \"core_hits\":\"null\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"access\":\"null\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"null\", \"core_language\":\"null\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"null\", \"core_ordering\":\"null\", \"core_metakey\":\"null\", \"core_metadesc\":\"null\", \"core_catid\":\"null\", \"core_xreference\":\"null\", \"asset_id\":\"null\"}, \"special\":{}}', 'UsersHelperRoute::getUserRoute', ''),
(5, 'Article Category', 'com_content.category', '{\"special\":{\"dbtable\":\"#__categories\",\"key\":\"id\",\"type\":\"Category\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"parent_id\", \"core_xreference\":\"null\", \"asset_id\":\"asset_id\"}, \"special\":{\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\",\"extension\":\"extension\",\"note\":\"note\"}}', 'ContentHelperRoute::getCategoryRoute', '{\"formFile\":\"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\",\"lft\",\"rgt\",\"level\",\"path\",\"extension\"], \"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"],\"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"parent_id\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}]}'),
(6, 'Contact Category', 'com_contact.category', '{\"special\":{\"dbtable\":\"#__categories\",\"key\":\"id\",\"type\":\"Category\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"parent_id\", \"core_xreference\":\"null\", \"asset_id\":\"asset_id\"}, \"special\":{\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\",\"extension\":\"extension\",\"note\":\"note\"}}', 'ContactHelperRoute::getCategoryRoute', '{\"formFile\":\"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\",\"lft\",\"rgt\",\"level\",\"path\",\"extension\"], \"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"],\"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"parent_id\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}]}'),
(7, 'Newsfeeds Category', 'com_newsfeeds.category', '{\"special\":{\"dbtable\":\"#__categories\",\"key\":\"id\",\"type\":\"Category\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"parent_id\", \"core_xreference\":\"null\", \"asset_id\":\"asset_id\"}, \"special\":{\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\",\"extension\":\"extension\",\"note\":\"note\"}}', 'NewsfeedsHelperRoute::getCategoryRoute', '{\"formFile\":\"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\",\"lft\",\"rgt\",\"level\",\"path\",\"extension\"], \"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"],\"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"parent_id\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}]}'),
(8, 'Tag', 'com_tags.tag', '{\"special\":{\"dbtable\":\"#__tags\",\"key\":\"tag_id\",\"type\":\"Tag\",\"prefix\":\"TagsTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"featured\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"images\", \"core_urls\":\"urls\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"null\", \"core_xreference\":\"null\", \"asset_id\":\"null\"}, \"special\":{\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\"}}', 'TagsHelperRoute::getTagRoute', '{\"formFile\":\"administrator\\/components\\/com_tags\\/models\\/forms\\/tag.xml\", \"hideFields\":[\"checked_out\",\"checked_out_time\",\"version\", \"lft\", \"rgt\", \"level\", \"path\", \"urls\", \"publish_up\", \"publish_down\"],\"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"],\"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}, {\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}, {\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}]}'),
(9, 'Banner', 'com_banners.banner', '{\"special\":{\"dbtable\":\"#__banners\",\"key\":\"id\",\"type\":\"Banner\",\"prefix\":\"BannersTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"name\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created\",\"core_modified_time\":\"modified\",\"core_body\":\"description\", \"core_hits\":\"null\",\"core_publish_up\":\"publish_up\",\"core_publish_down\":\"publish_down\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"images\", \"core_urls\":\"link\", \"core_version\":\"version\", \"core_ordering\":\"ordering\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"catid\", \"core_xreference\":\"null\", \"asset_id\":\"null\"}, \"special\":{\"imptotal\":\"imptotal\", \"impmade\":\"impmade\", \"clicks\":\"clicks\", \"clickurl\":\"clickurl\", \"custombannercode\":\"custombannercode\", \"cid\":\"cid\", \"purchase_type\":\"purchase_type\", \"track_impressions\":\"track_impressions\", \"track_clicks\":\"track_clicks\"}}', '', '{\"formFile\":\"administrator\\/components\\/com_banners\\/models\\/forms\\/banner.xml\", \"hideFields\":[\"checked_out\",\"checked_out_time\",\"version\", \"reset\"],\"ignoreChanges\":[\"modified_by\", \"modified\", \"checked_out\", \"checked_out_time\", \"version\", \"imptotal\", \"impmade\", \"reset\"], \"convertToInt\":[\"publish_up\", \"publish_down\", \"ordering\"], \"displayLookup\":[{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}, {\"sourceColumn\":\"cid\",\"targetTable\":\"#__banner_clients\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}, {\"sourceColumn\":\"created_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"modified_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"} ]}'),
(10, 'Banners Category', 'com_banners.category', '{\"special\":{\"dbtable\":\"#__categories\",\"key\":\"id\",\"type\":\"Category\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"parent_id\", \"core_xreference\":\"null\", \"asset_id\":\"asset_id\"}, \"special\": {\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\",\"extension\":\"extension\",\"note\":\"note\"}}', '', '{\"formFile\":\"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\",\"version\",\"lft\",\"rgt\",\"level\",\"path\",\"extension\"], \"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"], \"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"parent_id\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}]}'),
(11, 'Banner Client', 'com_banners.client', '{\"special\":{\"dbtable\":\"#__banner_clients\",\"key\":\"id\",\"type\":\"Client\",\"prefix\":\"BannersTable\"}}', '', '', '', '{\"formFile\":\"administrator\\/components\\/com_banners\\/models\\/forms\\/client.xml\", \"hideFields\":[\"checked_out\",\"checked_out_time\"], \"ignoreChanges\":[\"checked_out\", \"checked_out_time\"], \"convertToInt\":[], \"displayLookup\":[]}'),
(12, 'User Notes', 'com_users.note', '{\"special\":{\"dbtable\":\"#__user_notes\",\"key\":\"id\",\"type\":\"Note\",\"prefix\":\"UsersTable\"}}', '', '', '', '{\"formFile\":\"administrator\\/components\\/com_users\\/models\\/forms\\/note.xml\", \"hideFields\":[\"checked_out\",\"checked_out_time\", \"publish_up\", \"publish_down\"],\"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\"], \"convertToInt\":[\"publish_up\", \"publish_down\"],\"displayLookup\":[{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}, {\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}, {\"sourceColumn\":\"user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}, {\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}]}'),
(13, 'User Notes Category', 'com_users.category', '{\"special\":{\"dbtable\":\"#__categories\",\"key\":\"id\",\"type\":\"Category\",\"prefix\":\"JTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"published\",\"core_alias\":\"alias\",\"core_created_time\":\"created_time\",\"core_modified_time\":\"modified_time\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_publish_up\":\"null\",\"core_publish_down\":\"null\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_featured\":\"null\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_images\":\"null\", \"core_urls\":\"null\", \"core_version\":\"version\", \"core_ordering\":\"null\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_catid\":\"parent_id\", \"core_xreference\":\"null\", \"asset_id\":\"asset_id\"}, \"special\":{\"parent_id\":\"parent_id\",\"lft\":\"lft\",\"rgt\":\"rgt\",\"level\":\"level\",\"path\":\"path\",\"extension\":\"extension\",\"note\":\"note\"}}', '', '{\"formFile\":\"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml\", \"hideFields\":[\"checked_out\",\"checked_out_time\",\"version\",\"lft\",\"rgt\",\"level\",\"path\",\"extension\"], \"ignoreChanges\":[\"modified_user_id\", \"modified_time\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\", \"path\"], \"convertToInt\":[\"publish_up\", \"publish_down\"], \"displayLookup\":[{\"sourceColumn\":\"created_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"}, {\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_user_id\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"parent_id\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"}]}'),
(10000, 'Quix Page', 'com_quix.page', '{\"special\":{\"dbtable\":\"#__quix\",\"key\":\"id\",\"type\":\"Page\",\"prefix\":\"QuixTable\",\"config\":\"array()\"},\"common\":{\"dbtable\":\"#__ucm_content\",\"key\":\"ucm_id\",\"type\":\"Corecontent\",\"prefix\":\"JTable\",\"config\":\"array()\"}}', '', '{\"common\":{\"core_content_item_id\":\"id\",\"core_title\":\"title\",\"core_state\":\"state\",\"core_body\":\"description\", \"core_hits\":\"hits\",\"core_access\":\"access\", \"core_params\":\"params\", \"core_metadata\":\"metadata\", \"core_language\":\"language\", \"core_ordering\":\"ordering\", \"core_metakey\":\"metakey\", \"core_metadesc\":\"metadesc\", \"core_xreference\":\"xreference\", \"asset_id\":\"null\"}, \"special\":{}}', 'QuixFrontendHelperRoute::getPageRoute', '{\"formFile\":\"administrator\\/components\\/com_quix\\/models\\/forms\\/page.xml\", \"hideFields\":[\"asset_id\",\"checked_out\",\"checked_out_time\"], \"ignoreChanges\":[\"modified_by\", \"modified\", \"checked_out\", \"checked_out_time\", \"version\", \"hits\"], \"convertToInt\":[\"publish_up\", \"publish_down\", \"featured\", \"ordering\"], \"displayLookup\":[{\"sourceColumn\":\"catid\",\"targetTable\":\"#__categories\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"created_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"},{\"sourceColumn\":\"access\",\"targetTable\":\"#__viewlevels\",\"targetColumn\":\"id\",\"displayColumn\":\"title\"},{\"sourceColumn\":\"modified_by\",\"targetTable\":\"#__users\",\"targetColumn\":\"id\",\"displayColumn\":\"name\"} ]}');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_core_log_searches`
--

DROP TABLE IF EXISTS `bt8w9_core_log_searches`;
CREATE TABLE IF NOT EXISTS `bt8w9_core_log_searches` (
  `search_term` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_creative_fields`
--

DROP TABLE IF EXISTS `bt8w9_creative_fields`;
CREATE TABLE IF NOT EXISTS `bt8w9_creative_fields` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_form` mediumint(8) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `tooltip_text` text NOT NULL,
  `id_type` mediumint(8) UNSIGNED NOT NULL,
  `alias` text NOT NULL,
  `created` datetime NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `checked_out` int(10) UNSIGNED NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `access` int(10) UNSIGNED NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL,
  `ordering` int(11) NOT NULL,
  `language` char(7) NOT NULL,
  `required` enum('0','1') NOT NULL DEFAULT '0',
  `width` text NOT NULL,
  `field_margin_top` text NOT NULL,
  `select_show_scroll_after` int(11) NOT NULL DEFAULT '10',
  `select_show_search_after` int(11) NOT NULL DEFAULT '10',
  `message_required` text NOT NULL,
  `message_invalid` text NOT NULL,
  `ordering_field` enum('0','1') NOT NULL DEFAULT '0',
  `show_parent_label` enum('0','1') NOT NULL DEFAULT '1',
  `select_default_text` text NOT NULL,
  `select_no_match_text` text NOT NULL,
  `upload_button_text` text NOT NULL,
  `upload_minfilesize` text NOT NULL,
  `upload_maxfilesize` text NOT NULL,
  `upload_acceptfiletypes` text NOT NULL,
  `upload_minfilesize_message` text NOT NULL,
  `upload_maxfilesize_message` text NOT NULL,
  `upload_acceptfiletypes_message` text NOT NULL,
  `captcha_wrong_message` text NOT NULL,
  `datepicker_date_format` text NOT NULL,
  `datepicker_animation` text NOT NULL,
  `datepicker_style` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `datepicker_icon_style` smallint(6) NOT NULL DEFAULT '1',
  `datepicker_show_icon` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `datepicker_input_readonly` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `datepicker_number_months` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `datepicker_mindate` text NOT NULL,
  `datepicker_maxdate` text NOT NULL,
  `datepicker_changemonths` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `datepicker_changeyears` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `column_type` tinyint(4) NOT NULL,
  `custom_html` text NOT NULL,
  `google_maps` text NOT NULL,
  `heading` text NOT NULL,
  `recaptcha_site_key` text NOT NULL,
  `recaptcha_security_key` text NOT NULL,
  `recaptcha_wrong_message` text NOT NULL,
  `recaptcha_theme` text NOT NULL,
  `recaptcha_type` text NOT NULL,
  `contact_data` text NOT NULL,
  `contact_data_width` smallint(6) NOT NULL DEFAULT '120',
  `creative_popup` text NOT NULL,
  `creative_popup_embed` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_form` (`id_form`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_creative_fields`
--

INSERT INTO `bt8w9_creative_fields` (`id`, `id_user`, `id_form`, `name`, `tooltip_text`, `id_type`, `alias`, `created`, `publish_up`, `publish_down`, `published`, `checked_out`, `checked_out_time`, `access`, `featured`, `ordering`, `language`, `required`, `width`, `field_margin_top`, `select_show_scroll_after`, `select_show_search_after`, `message_required`, `message_invalid`, `ordering_field`, `show_parent_label`, `select_default_text`, `select_no_match_text`, `upload_button_text`, `upload_minfilesize`, `upload_maxfilesize`, `upload_acceptfiletypes`, `upload_minfilesize_message`, `upload_maxfilesize_message`, `upload_acceptfiletypes_message`, `captcha_wrong_message`, `datepicker_date_format`, `datepicker_animation`, `datepicker_style`, `datepicker_icon_style`, `datepicker_show_icon`, `datepicker_input_readonly`, `datepicker_number_months`, `datepicker_mindate`, `datepicker_maxdate`, `datepicker_changemonths`, `datepicker_changeyears`, `column_type`, `custom_html`, `google_maps`, `heading`, `recaptcha_site_key`, `recaptcha_security_key`, `recaptcha_wrong_message`, `recaptcha_theme`, `recaptcha_type`, `contact_data`, `contact_data_width`, `creative_popup`, `creative_popup_embed`) VALUES
(1, 0, 1, 'Name', 'Please enter your name!', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 1, '', '1', '', '', 10, 10, '', '', '0', '1', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 0, 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 120, '', ''),
(2, 0, 1, 'Email', 'Please enter your email!', 4, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 2, '', '1', '', '', 10, 10, '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 0, 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 120, '', ''),
(3, 0, 1, 'Country', '', 9, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 3, '', '1', '', '', 10, 10, '', '', '0', '1', 'Select country', 'No results match', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 1, 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 120, '', ''),
(4, 0, 1, 'How did you find us?', '', 12, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 4, '', '1', '', '', 10, 10, '', '', '0', '1', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 1, 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 120, '', ''),
(5, 0, 1, 'Message', 'Write your message!', 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 5, '', '1', '', '', 10, 10, '', '', '0', '1', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 0, 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 120, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_creative_field_types`
--

DROP TABLE IF EXISTS `bt8w9_creative_field_types`;
CREATE TABLE IF NOT EXISTS `bt8w9_creative_field_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_creative_field_types`
--

INSERT INTO `bt8w9_creative_field_types` (`id`, `name`) VALUES
(1, 'Text Input'),
(2, 'Text Area'),
(3, 'Name'),
(4, 'E-mail'),
(5, 'Address'),
(6, 'Phone'),
(7, 'Number'),
(8, 'Url'),
(9, 'Select'),
(10, 'Multiple Select'),
(11, 'Checkbox'),
(12, 'Radio'),
(13, 'Captcha : PRO feature'),
(14, 'File upload : PRO feature'),
(16, 'Custom Html : PRO feature'),
(15, 'Datepicker : PRO feature'),
(17, 'Heading : PRO feature'),
(18, 'Google Maps : PRO feature'),
(19, 'Google reCAPTCHA : PRO feature'),
(20, 'Contact Data : PRO feature'),
(21, 'Creative Popup : PRO feature'),
(22, 'Multiple Recipients : BUSINESS feature'),
(23, 'Time : BUSINESS feature'),
(24, 'Stars : BUSINESS feature'),
(25, 'E-Signature : BUSINESS feature'),
(26, 'Page Break : BUSINESS feature'),
(27, 'If-Then : BUSINESS feature'),
(28, 'Hidden : BUSINESS feature');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_creative_forms`
--

DROP TABLE IF EXISTS `bt8w9_creative_forms`;
CREATE TABLE IF NOT EXISTS `bt8w9_creative_forms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email_to` text NOT NULL,
  `email_bcc` text NOT NULL,
  `email_subject` text NOT NULL,
  `email_from` text NOT NULL,
  `email_from_name` text NOT NULL,
  `email_replyto` text NOT NULL,
  `email_replyto_name` text NOT NULL,
  `shake_count` mediumint(8) UNSIGNED NOT NULL,
  `shake_distanse` mediumint(8) UNSIGNED NOT NULL,
  `shake_duration` mediumint(8) UNSIGNED NOT NULL,
  `id_template` mediumint(8) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `top_text` text NOT NULL,
  `pre_text` text NOT NULL,
  `thank_you_text` text NOT NULL,
  `send_text` text NOT NULL,
  `send_new_text` text NOT NULL,
  `close_alert_text` text NOT NULL,
  `form_width` text NOT NULL,
  `alias` text NOT NULL,
  `created` datetime NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `checked_out` int(10) UNSIGNED NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `access` int(10) UNSIGNED NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL,
  `ordering` int(11) NOT NULL,
  `language` char(7) NOT NULL,
  `redirect` enum('0','1') NOT NULL DEFAULT '0',
  `redirect_itemid` int(10) UNSIGNED NOT NULL,
  `redirect_url` text NOT NULL,
  `redirect_delay` int(11) NOT NULL,
  `send_copy_enable` enum('0','1') NOT NULL,
  `send_copy_text` text NOT NULL,
  `show_back` enum('0','1') NOT NULL DEFAULT '1',
  `email_info_show_referrer` tinyint(4) NOT NULL DEFAULT '1',
  `email_info_show_ip` tinyint(4) NOT NULL DEFAULT '1',
  `email_info_show_browser` tinyint(4) NOT NULL DEFAULT '1',
  `email_info_show_os` tinyint(4) NOT NULL DEFAULT '1',
  `email_info_show_sc_res` tinyint(4) NOT NULL DEFAULT '1',
  `custom_css` text NOT NULL,
  `render_type` tinyint(3) UNSIGNED NOT NULL,
  `popup_button_text` text NOT NULL,
  `static_button_position` tinyint(3) UNSIGNED NOT NULL,
  `static_button_offset` text NOT NULL,
  `appear_animation_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `check_token` tinyint(3) UNSIGNED NOT NULL,
  `next_button_text` text NOT NULL,
  `prev_button_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_creative_forms`
--

INSERT INTO `bt8w9_creative_forms` (`id`, `email_to`, `email_bcc`, `email_subject`, `email_from`, `email_from_name`, `email_replyto`, `email_replyto_name`, `shake_count`, `shake_distanse`, `shake_duration`, `id_template`, `name`, `top_text`, `pre_text`, `thank_you_text`, `send_text`, `send_new_text`, `close_alert_text`, `form_width`, `alias`, `created`, `publish_up`, `publish_down`, `published`, `checked_out`, `checked_out_time`, `access`, `featured`, `ordering`, `language`, `redirect`, `redirect_itemid`, `redirect_url`, `redirect_delay`, `send_copy_enable`, `send_copy_text`, `show_back`, `email_info_show_referrer`, `email_info_show_ip`, `email_info_show_browser`, `email_info_show_os`, `email_info_show_sc_res`, `custom_css`, `render_type`, `popup_button_text`, `static_button_position`, `static_button_offset`, `appear_animation_type`, `check_token`, `next_button_text`, `prev_button_text`) VALUES
(1, '', '', '', '', '', '', '', 2, 10, 300, 1, 'Basic Contact Form', 'Contact Us', 'Feel free to contact us if you have any questions', 'Message successfully sent', 'Send', 'New email', 'OK', '100%', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 1, 0, 0, '', '0', 101, '', 0, '1', 'Send me a copy', '0', 1, 1, 1, 1, 1, '', 0, 'Contact Us', 0, '15%', 1, 0, 'Next Page', 'Prev Page');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_creative_form_options`
--

DROP TABLE IF EXISTS `bt8w9_creative_form_options`;
CREATE TABLE IF NOT EXISTS `bt8w9_creative_form_options` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `showrow` enum('0','1') NOT NULL DEFAULT '1',
  `selected` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_creative_form_options`
--

INSERT INTO `bt8w9_creative_form_options` (`id`, `id_parent`, `name`, `value`, `ordering`, `showrow`, `selected`) VALUES
(1, 3, 'Afghanistan', 'Afghanistan', 0, '1', '0'),
(2, 3, 'Albania', 'Albania', 1, '1', '0'),
(3, 3, 'Algeria', 'Algeria', 2, '1', '0'),
(4, 3, 'American Samoa', 'American Samoa', 3, '1', '0'),
(5, 3, 'Andorra', 'Andorra', 4, '1', '0'),
(6, 3, 'Angola', 'Angola', 5, '1', '0'),
(7, 3, 'Anguilla', 'Anguilla', 6, '1', '0'),
(8, 3, 'Antarctica', 'Antarctica', 7, '1', '0'),
(9, 3, 'Antigua and Barbuda', 'Antigua and Barbuda', 8, '1', '0'),
(10, 3, 'Argentina', 'Argentina', 9, '1', '0'),
(11, 3, 'Armenia', 'Armenia', 10, '1', '0'),
(12, 3, 'Aruba', 'Aruba', 11, '1', '0'),
(13, 3, 'Australia', 'Australia', 12, '1', '0'),
(14, 3, 'Austria', 'Austria', 13, '1', '0'),
(15, 3, 'Azerbaijan', 'Azerbaijan', 14, '1', '0'),
(16, 3, 'Bahamas', 'Bahamas', 15, '1', '0'),
(17, 3, 'Bahrain', 'Bahrain', 16, '1', '0'),
(18, 3, 'Bangladesh', 'Bangladesh', 17, '1', '0'),
(19, 3, 'Barbados', 'Barbados', 18, '1', '0'),
(20, 3, 'Belarus', 'Belarus', 19, '1', '0'),
(21, 3, 'Belgium', 'Belgium', 20, '1', '0'),
(22, 3, 'Belize', 'Belize', 21, '1', '0'),
(23, 3, 'Benin', 'Benin', 22, '1', '0'),
(24, 3, 'Bermuda', 'Bermuda', 23, '1', '0'),
(25, 3, 'Bhutan', 'Bhutan', 24, '1', '0'),
(26, 3, 'Bolivia', 'Bolivia', 25, '1', '0'),
(27, 3, 'Bosnia and Herzegowina', 'Bosnia and Herzegowina', 26, '1', '0'),
(28, 3, 'Botswana', 'Botswana', 27, '1', '0'),
(29, 3, 'Bouvet Island', 'Bouvet Island', 28, '1', '0'),
(30, 3, 'Brazil', 'Brazil', 29, '1', '0'),
(31, 3, 'British Indian Ocean Territory', 'British Indian Ocean Territory', 30, '1', '0'),
(32, 3, 'Brunei Darussalam', 'Brunei Darussalam', 31, '1', '0'),
(33, 3, 'Bulgaria', 'Bulgaria', 32, '1', '0'),
(34, 3, 'Burkina Faso', 'Burkina Faso', 33, '1', '0'),
(35, 3, 'Burundi', 'Burundi', 34, '1', '0'),
(36, 3, 'Cambodia', 'Cambodia', 35, '1', '0'),
(37, 3, 'Cameroon', 'Cameroon', 36, '1', '0'),
(38, 3, 'Canada', 'Canada', 37, '1', '0'),
(39, 3, 'Cape Verde', 'Cape Verde', 38, '1', '0'),
(40, 3, 'Cayman Islands', 'Cayman Islands', 39, '1', '0'),
(41, 3, 'Central African Republic', 'Central African Republic', 40, '1', '0'),
(42, 3, 'Chad', 'Chad', 41, '1', '0'),
(43, 3, 'Chile', 'Chile', 42, '1', '0'),
(44, 3, 'China', 'China', 43, '1', '0'),
(45, 3, 'Christmas Island', 'Christmas Island', 44, '1', '0'),
(46, 3, 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 45, '1', '0'),
(47, 3, 'Colombia', 'Colombia', 46, '1', '0'),
(48, 3, 'Comoros', 'Comoros', 47, '1', '0'),
(49, 3, 'Congo', 'Congo', 48, '1', '0'),
(50, 3, 'Cook Islands', 'Cook Islands', 49, '1', '0'),
(51, 3, 'Costa Rica', 'Costa Rica', 50, '1', '0'),
(52, 3, 'Cote D', 'Cote D', 51, '1', '0'),
(53, 3, 'Croatia', 'Croatia', 52, '1', '0'),
(54, 3, 'Cuba', 'Cuba', 53, '1', '0'),
(55, 3, 'Cyprus', 'Cyprus', 54, '1', '0'),
(56, 3, 'Czech Republic', 'Czech Republic', 55, '1', '0'),
(57, 3, 'Democratic Republic of Congo', 'Democratic Republic of Congo', 56, '1', '0'),
(58, 3, 'Denmark', 'Denmark', 57, '1', '0'),
(59, 3, 'Djibouti', 'Djibouti', 58, '1', '0'),
(60, 3, 'Dominica', 'Dominica', 59, '1', '0'),
(61, 3, 'Dominican Republic', 'Dominican Republic', 60, '1', '0'),
(62, 3, 'East Timor', 'East Timor', 61, '1', '0'),
(63, 3, 'Ecuador', 'Ecuador', 62, '1', '0'),
(64, 3, 'Egypt', 'Egypt', 63, '1', '0'),
(65, 3, 'El Salvador', 'El Salvador', 64, '1', '0'),
(66, 3, 'Equatorial Guinea', 'Equatorial Guinea', 65, '1', '0'),
(67, 3, 'Eritrea', 'Eritrea', 66, '1', '0'),
(68, 3, 'Estonia', 'Estonia', 67, '1', '0'),
(69, 3, 'Ethiopia', 'Ethiopia', 68, '1', '0'),
(70, 3, 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)', 69, '1', '0'),
(71, 3, 'Faroe Islands', 'Faroe Islands', 70, '1', '0'),
(72, 3, 'Fiji', 'Fiji', 71, '1', '0'),
(73, 3, 'Finland', 'Finland', 72, '1', '0'),
(74, 3, 'France', 'France', 73, '1', '0'),
(75, 3, 'France, Metropolitan', 'France, Metropolitan', 74, '1', '0'),
(76, 3, 'French Guiana', 'French Guiana', 75, '1', '0'),
(77, 3, 'French Polynesia', 'French Polynesia', 76, '1', '0'),
(78, 3, 'French Southern Territories', 'French Southern Territories', 77, '1', '0'),
(79, 3, 'Gabon', 'Gabon', 78, '1', '0'),
(80, 3, 'Gambia', 'Gambia', 79, '1', '0'),
(81, 3, 'Georgia', 'Georgia', 80, '1', '0'),
(82, 3, 'Germany', 'Germany', 81, '1', '0'),
(83, 3, 'Ghana', 'Ghana', 82, '1', '0'),
(84, 3, 'Gibraltar', 'Gibraltar', 83, '1', '0'),
(85, 3, 'Greece', 'Greece', 84, '1', '0'),
(86, 3, 'Greenland', 'Greenland', 85, '1', '0'),
(87, 3, 'Grenada', 'Grenada', 86, '1', '0'),
(88, 3, 'Guadeloupe', 'Guadeloupe', 87, '1', '0'),
(89, 3, 'Guam', 'Guam', 88, '1', '0'),
(90, 3, 'Guatemala', 'Guatemala', 89, '1', '0'),
(91, 3, 'Guinea', 'Guinea', 90, '1', '0'),
(92, 3, 'Guinea-bissau', 'Guinea-bissau', 91, '1', '0'),
(93, 3, 'Guyana', 'Guyana', 92, '1', '0'),
(94, 3, 'Haiti', 'Haiti', 93, '1', '0'),
(95, 3, 'Heard and Mc Donald Islands', 'Heard and Mc Donald Islands', 94, '1', '0'),
(96, 3, 'Honduras', 'Honduras', 95, '1', '0'),
(97, 3, 'Hong Kong', 'Hong Kong', 96, '1', '0'),
(98, 3, 'Hungary', 'Hungary', 97, '1', '0'),
(99, 3, 'Iceland', 'Iceland', 98, '1', '0'),
(100, 3, 'India', 'India', 99, '1', '0'),
(101, 3, 'Indonesia', 'Indonesia', 100, '1', '0'),
(102, 3, 'Iran', 'Iran', 101, '1', '0'),
(103, 3, 'Iraq', 'Iraq', 102, '1', '0'),
(104, 3, 'Ireland', 'Ireland', 103, '1', '0'),
(105, 3, 'Israel', 'Israel', 104, '1', '0'),
(106, 3, 'Italy', 'Italy', 105, '1', '0'),
(107, 3, 'Jamaica', 'Jamaica', 106, '1', '0'),
(108, 3, 'Japan', 'Japan', 107, '1', '0'),
(109, 3, 'Jordan', 'Jordan', 108, '1', '0'),
(110, 3, 'Kazakhstan', 'Kazakhstan', 109, '1', '0'),
(111, 3, 'Kenya', 'Kenya', 110, '1', '0'),
(112, 3, 'Kiribati', 'Kiribati', 111, '1', '0'),
(113, 3, 'Korea', 'Korea', 112, '1', '0'),
(114, 3, 'Kuwait', 'Kuwait', 113, '1', '0'),
(115, 3, 'Kyrgyzstan', 'Kyrgyzstan', 114, '1', '0'),
(116, 3, 'Lao People', 'Lao People', 115, '1', '0'),
(117, 3, 'Latvia', 'Latvia', 116, '1', '0'),
(118, 3, 'Lebanon', 'Lebanon', 117, '1', '0'),
(119, 3, 'Lesotho', 'Lesotho', 118, '1', '0'),
(120, 3, 'Liberia', 'Liberia', 119, '1', '0'),
(121, 3, 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya', 120, '1', '0'),
(122, 3, 'Liechtenstein', 'Liechtenstein', 121, '1', '0'),
(123, 3, 'Lithuania', 'Lithuania', 122, '1', '0'),
(124, 3, 'Luxembourg', 'Luxembourg', 123, '1', '0'),
(125, 3, 'Macau', 'Macau', 124, '1', '0'),
(126, 3, 'Macedonia', 'Macedonia', 125, '1', '0'),
(127, 3, 'Madagascar', 'Madagascar', 126, '1', '0'),
(128, 3, 'Malawi', 'Malawi', 127, '1', '0'),
(129, 3, 'Malaysia', 'Malaysia', 128, '1', '0'),
(130, 3, 'Maldives', 'Maldives', 129, '1', '0'),
(131, 3, 'Mali', 'Mali', 130, '1', '0'),
(132, 3, 'Malta', 'Malta', 131, '1', '0'),
(133, 3, 'Marshall Islands', 'Marshall Islands', 132, '1', '0'),
(134, 3, 'Martinique', 'Martinique', 133, '1', '0'),
(135, 3, 'Mauritania', 'Mauritania', 134, '1', '0'),
(136, 3, 'Mauritius', 'Mauritius', 135, '1', '0'),
(137, 3, 'Mayotte', 'Mayotte', 136, '1', '0'),
(138, 3, 'Mexico', 'Mexico', 137, '1', '0'),
(139, 3, 'Micronesia', 'Micronesia', 138, '1', '0'),
(140, 3, 'Moldova', 'Moldova', 139, '1', '0'),
(141, 3, 'Monaco', 'Monaco', 140, '1', '0'),
(142, 3, 'Mongolia', 'Mongolia', 141, '1', '0'),
(143, 3, 'Montserrat', 'Montserrat', 142, '1', '0'),
(144, 3, 'Morocco', 'Morocco', 143, '1', '0'),
(145, 3, 'Mozambique', 'Mozambique', 144, '1', '0'),
(146, 3, 'Myanmar', 'Myanmar', 145, '1', '0'),
(147, 3, 'Namibia', 'Namibia', 146, '1', '0'),
(148, 3, 'Nauru', 'Nauru', 147, '1', '0'),
(149, 3, 'Nepal', 'Nepal', 148, '1', '0'),
(150, 3, 'Netherlands', 'Netherlands', 149, '1', '0'),
(151, 3, 'Netherlands Antilles', 'Netherlands Antilles', 150, '1', '0'),
(152, 3, 'New Caledonia', 'New Caledonia', 151, '1', '0'),
(153, 3, 'New Zealand', 'New Zealand', 152, '1', '0'),
(154, 3, 'Nicaragua', 'Nicaragua', 153, '1', '0'),
(155, 3, 'Niger', 'Niger', 154, '1', '0'),
(156, 3, 'Nigeria', 'Nigeria', 155, '1', '0'),
(157, 3, 'Niue', 'Niue', 156, '1', '0'),
(158, 3, 'Norfolk Island', 'Norfolk Island', 157, '1', '0'),
(159, 3, 'North Korea', 'North Korea', 158, '1', '0'),
(160, 3, 'Northern Mariana Islands', 'Northern Mariana Islands', 159, '1', '0'),
(161, 3, 'Norway', 'Norway', 160, '1', '0'),
(162, 3, 'Oman', 'Oman', 161, '1', '0'),
(163, 3, 'Pakistan', 'Pakistan', 162, '1', '0'),
(164, 3, 'Palau', 'Palau', 163, '1', '0'),
(165, 3, 'Panama', 'Panama', 164, '1', '0'),
(166, 3, 'Papua New Guinea', 'Papua New Guinea', 165, '1', '0'),
(167, 3, 'Paraguay', 'Paraguay', 166, '1', '0'),
(168, 3, 'Peru', 'Peru', 167, '1', '0'),
(169, 3, 'Philippines', 'Philippines', 168, '1', '0'),
(170, 3, 'Pitcairn', 'Pitcairn', 169, '1', '0'),
(171, 3, 'Poland', 'Poland', 170, '1', '0'),
(172, 3, 'Portugal', 'Portugal', 171, '1', '0'),
(173, 3, 'Puerto Rico', 'Puerto Rico', 172, '1', '0'),
(174, 3, 'Qatar', 'Qatar', 173, '1', '0'),
(175, 3, 'Reunion', 'Reunion', 174, '1', '0'),
(176, 3, 'Romania', 'Romania', 175, '1', '0'),
(177, 3, 'Russian Federation', 'Russian Federation', 176, '1', '0'),
(178, 3, 'Rwanda', 'Rwanda', 177, '1', '0'),
(179, 3, 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 178, '1', '0'),
(180, 3, 'Saint Lucia', 'Saint Lucia', 179, '1', '0'),
(181, 3, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 180, '1', '0'),
(182, 3, 'Samoa', 'Samoa', 181, '1', '0'),
(183, 3, 'San Marino', 'San Marino', 182, '1', '0'),
(184, 3, 'Sao Tome and Principe', 'Sao Tome and Principe', 183, '1', '0'),
(185, 3, 'Saudi Arabia', 'Saudi Arabia', 184, '1', '0'),
(186, 3, 'Senegal', 'Senegal', 185, '1', '0'),
(187, 3, 'Seychelles', 'Seychelles', 186, '1', '0'),
(188, 3, 'Sierra Leone', 'Sierra Leone', 187, '1', '0'),
(189, 3, 'Singapore', 'Singapore', 188, '1', '0'),
(190, 3, 'Slovak Republic', 'Slovak Republic', 189, '1', '0'),
(191, 3, 'Slovenia', 'Slovenia', 190, '1', '0'),
(192, 3, 'Solomon Islands', 'Solomon Islands', 191, '1', '0'),
(193, 3, 'Somalia', 'Somalia', 192, '1', '0'),
(194, 3, 'South Africa', 'South Africa', 193, '1', '0'),
(195, 3, 'South Georgia &amp; South Sandwich Islands', 'South Georgia &amp; South Sandwich Islands', 194, '1', '0'),
(196, 3, 'Spain', 'Spain', 195, '1', '0'),
(197, 3, 'Sri Lanka', 'Sri Lanka', 196, '1', '0'),
(198, 3, 'St. Helena', 'St. Helena', 197, '1', '0'),
(199, 3, 'St. Pierre and Miquelon', 'St. Pierre and Miquelon', 198, '1', '0'),
(200, 3, 'Sudan', 'Sudan', 199, '1', '0'),
(201, 3, 'Suriname', 'Suriname', 200, '1', '0'),
(202, 3, 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', 201, '1', '0'),
(203, 3, 'Swaziland', 'Swaziland', 202, '1', '0'),
(204, 3, 'Sweden', 'Sweden', 203, '1', '0'),
(205, 3, 'Switzerland', 'Switzerland', 204, '1', '0'),
(206, 3, 'Syrian Arab Republic', 'Syrian Arab Republic', 205, '1', '0'),
(207, 3, 'Taiwan', 'Taiwan', 206, '1', '0'),
(208, 3, 'Tajikistan', 'Tajikistan', 207, '1', '0'),
(209, 3, 'Tanzania', 'Tanzania', 208, '1', '0'),
(210, 3, 'Thailand', 'Thailand', 209, '1', '0'),
(211, 3, 'Togo', 'Togo', 210, '1', '0'),
(212, 3, 'Tokelau', 'Tokelau', 211, '1', '0'),
(213, 3, 'Tonga', 'Tonga', 212, '1', '0'),
(214, 3, 'Trinidad and Tobago', 'Trinidad and Tobago', 213, '1', '0'),
(215, 3, 'Tunisia', 'Tunisia', 214, '1', '0'),
(216, 3, 'Turkey', 'Turkey', 215, '1', '0'),
(217, 3, 'Turkmenistan', 'Turkmenistan', 216, '1', '0'),
(218, 3, 'Turks and Caicos Islands', 'Turks and Caicos Islands', 217, '1', '0'),
(219, 3, 'Tuvalu', 'Tuvalu', 218, '1', '0'),
(220, 3, 'Uganda', 'Uganda', 219, '1', '0'),
(221, 3, 'Ukraine', 'Ukraine', 220, '1', '0'),
(222, 3, 'United Arab Emirates', 'United Arab Emirates', 221, '1', '0'),
(223, 3, 'United Kingdom', 'United Kingdom', 222, '1', '0'),
(224, 3, 'United States', 'United States', 223, '1', '0'),
(225, 3, 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 224, '1', '0'),
(226, 3, 'Uruguay', 'Uruguay', 225, '1', '0'),
(227, 3, 'Uzbekistan', 'Uzbekistan', 226, '1', '0'),
(228, 3, 'Vanuatu', 'Vanuatu', 227, '1', '0'),
(229, 3, 'Vatican City State (Holy See)', 'Vatican City State (Holy See)', 228, '1', '0'),
(230, 3, 'Venezuela', 'Venezuela', 229, '1', '0'),
(231, 3, 'Viet Nam', 'Viet Nam', 230, '1', '0'),
(232, 3, 'Virgin Islands (British)', 'Virgin Islands (British)', 231, '1', '0'),
(233, 3, 'Virgin Islands (U.S.)', 'Virgin Islands (U.S.)', 232, '1', '0'),
(234, 3, 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', 233, '1', '0'),
(235, 3, 'Western Sahara', 'Western Sahara', 234, '1', '0'),
(236, 3, 'Yemen', 'Yemen', 235, '1', '0'),
(237, 3, 'Yugoslavia', 'Yugoslavia', 236, '1', '0'),
(238, 3, 'Zambia', 'Zambia', 237, '1', '0'),
(239, 3, 'Zimbabwe', 'Zimbabwe', 238, '1', '0'),
(240, 4, 'Web search', 'Web search', 2, '1', '0'),
(241, 4, 'Social networks', 'Social networks', 1, '1', '0'),
(242, 4, 'Recommended by a friend', 'Recommended by a friend', 3, '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_creative_submissions`
--

DROP TABLE IF EXISTS `bt8w9_creative_submissions`;
CREATE TABLE IF NOT EXISTS `bt8w9_creative_submissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_form` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `ip` text NOT NULL,
  `browser` text NOT NULL,
  `op_s` text NOT NULL,
  `sc_res` text NOT NULL,
  `name` text NOT NULL,
  `viewed` enum('0','1') NOT NULL DEFAULT '0',
  `country` text NOT NULL,
  `city` text NOT NULL,
  `page_title` text NOT NULL,
  `page_url` text NOT NULL,
  `star_index` tinyint(3) UNSIGNED NOT NULL,
  `imp_index` tinyint(3) UNSIGNED NOT NULL,
  `uploads` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_creative_submissions`
--

INSERT INTO `bt8w9_creative_submissions` (`id`, `id_form`, `date`, `email`, `message`, `ip`, `browser`, `op_s`, `sc_res`, `name`, `viewed`, `country`, `city`, `page_title`, `page_url`, `star_index`, `imp_index`, `uploads`) VALUES
(1, 1, '2018-07-09 16:30:40', 'demo1@creative-solutions.net', 'Name: Demo User\r\nEmail: demo@creative-solutions.net\r\nCountry: Armenia\r\nHow did you find us?: Web search\r\nMessage:\nHello,\r\n\r\nThis is test message\r\n\n', '::1', 'Google Chrome 49.0.2623.112', 'Windows 7', '1920X1080', 'Demo User 1', '0', '', '', 'CCF', 'http://localhost/Joomla_3.5.0/index.php/ccf', 1, 1, ''),
(2, 1, '2018-07-09 16:30:40', 'demo2@creative-solutions.net', 'Name: Demo User\r\nEmail: demo@creative-solutions.net\r\nCountry: Armenia\r\nHow did you find us?: Web search\r\nMessage:\nHello,\r\n\r\nThis is test message\r\n\n', '::1', 'Google Chrome 49.0.2623.112', 'Windows 7', '1920X1080', 'Demo User 2', '0', '', '', 'CCF', 'http://localhost/Joomla_3.5.0/index.php/ccf', 2, 2, ''),
(3, 1, '2018-07-09 16:30:40', 'demo3@creative-solutions.net', 'Name: Demo User\r\nEmail: demo@creative-solutions.net\r\nCountry: Armenia\r\nHow did you find us?: Web search\r\nMessage:\nHello,\r\n\r\nThis is test message\r\n\n', '::1', 'Google Chrome 49.0.2623.112', 'Windows 7', '1920X1080', 'Demo User 3', '0', '', '', 'CCF', 'http://localhost/Joomla_3.5.0/index.php/ccf', 3, 0, ''),
(4, 1, '2018-07-09 16:30:40', 'demo4@creative-solutions.net', 'Name: Demo User\r\nEmail: demo@creative-solutions.net\r\nCountry: Armenia\r\nHow did you find us?: Web search\r\nMessage:\nHello,\r\n\r\nThis is test message\r\n\n', '::1', 'Google Chrome 49.0.2623.112', 'Windows 7', '1920X1080', 'Demo User 4', '0', '', '', 'CCF', 'http://localhost/Joomla_3.5.0/index.php/ccf', 4, 1, ''),
(5, 1, '2018-07-09 16:30:40', 'demo5@creative-solutions.net', 'Name: Demo User\r\nEmail: demo@creative-solutions.net\r\nCountry: Armenia\r\nHow did you find us?: Web search\r\nMessage:\nHello,\r\n\r\nThis is test message\r\n\n', '::1', 'Google Chrome 49.0.2623.112', 'Windows 7', '1920X1080', 'Demo User 5', '0', '', '', 'CCF', 'http://localhost/Joomla_3.5.0/index.php/ccf', 5, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_extensions`
--

DROP TABLE IF EXISTS `bt8w9_extensions`;
CREATE TABLE IF NOT EXISTS `bt8w9_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Parent package ID for extensions installed as a package.',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `element` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10035 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_extensions`
--

INSERT INTO `bt8w9_extensions` (`extension_id`, `package_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 0, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{\"name\":\"com_mailto\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_MAILTO_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mailto\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 0, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{\"name\":\"com_wrapper\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_WRAPPER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"wrapper\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 0, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{\"name\":\"com_admin\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_ADMIN_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 0, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{\"name\":\"com_banners\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_BANNERS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"banners\"}', '{\"purchase_type\":\"3\",\"track_impressions\":\"0\",\"track_clicks\":\"0\",\"metakey_prefix\":\"\",\"save_history\":\"1\",\"history_limit\":10}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 0, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{\"name\":\"com_cache\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CACHE_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 0, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{\"name\":\"com_categories\",\"type\":\"component\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 0, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{\"name\":\"com_checkin\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CHECKIN_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 0, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{\"name\":\"com_contact\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CONTACT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contact\"}', '{\"contact_layout\":\"_:default\",\"show_contact_category\":\"hide\",\"save_history\":\"1\",\"history_limit\":10,\"show_contact_list\":\"0\",\"presentation_style\":\"sliders\",\"show_tags\":\"1\",\"show_info\":\"1\",\"show_name\":\"1\",\"show_position\":\"1\",\"show_email\":\"0\",\"show_street_address\":\"1\",\"show_suburb\":\"1\",\"show_state\":\"1\",\"show_postcode\":\"1\",\"show_country\":\"1\",\"show_telephone\":\"1\",\"show_mobile\":\"1\",\"show_fax\":\"1\",\"show_webpage\":\"1\",\"show_image\":\"1\",\"show_misc\":\"1\",\"image\":\"\",\"allow_vcard\":\"0\",\"show_articles\":\"0\",\"articles_display_num\":\"10\",\"show_profile\":\"0\",\"show_user_custom_fields\":[\"-1\"],\"show_links\":\"0\",\"linka_name\":\"\",\"linkb_name\":\"\",\"linkc_name\":\"\",\"linkd_name\":\"\",\"linke_name\":\"\",\"contact_icons\":\"0\",\"icon_address\":\"\",\"icon_email\":\"\",\"icon_telephone\":\"\",\"icon_mobile\":\"\",\"icon_fax\":\"\",\"icon_misc\":\"\",\"category_layout\":\"_:default\",\"show_category_title\":\"1\",\"show_description\":\"1\",\"show_description_image\":\"0\",\"maxLevel\":\"-1\",\"show_subcat_desc\":\"1\",\"show_empty_categories\":\"0\",\"show_cat_items\":\"1\",\"show_cat_tags\":\"1\",\"show_base_description\":\"1\",\"maxLevelcat\":\"-1\",\"show_subcat_desc_cat\":\"1\",\"show_empty_categories_cat\":\"0\",\"show_cat_items_cat\":\"1\",\"filter_field\":\"0\",\"show_pagination_limit\":\"0\",\"show_headings\":\"1\",\"show_image_heading\":\"0\",\"show_position_headings\":\"1\",\"show_email_headings\":\"0\",\"show_telephone_headings\":\"1\",\"show_mobile_headings\":\"0\",\"show_fax_headings\":\"0\",\"show_suburb_headings\":\"1\",\"show_state_headings\":\"1\",\"show_country_headings\":\"1\",\"show_pagination\":\"2\",\"show_pagination_results\":\"1\",\"initial_sort\":\"ordering\",\"captcha\":\"\",\"show_email_form\":\"1\",\"show_email_copy\":\"0\",\"banned_email\":\"\",\"banned_subject\":\"\",\"banned_text\":\"\",\"validate_session\":\"1\",\"custom_reply\":\"0\",\"redirect\":\"\",\"show_feed_link\":\"1\",\"sef_advanced\":0,\"sef_ids\":0,\"custom_fields_enable\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 0, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{\"name\":\"com_cpanel\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CPANEL_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 0, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{\"name\":\"com_installer\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_INSTALLER_XML_DESCRIPTION\",\"group\":\"\"}', '{\"show_jed_info\":\"1\",\"cachetimeout\":\"6\",\"minimum_stability\":\"4\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 0, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{\"name\":\"com_languages\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\"}', '{\"administrator\":\"en-GB\",\"site\":\"en-GB\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 0, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{\"name\":\"com_login\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 0, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{\"name\":\"com_media\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_MEDIA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"media\"}', '{\"upload_extensions\":\"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,TXT,XCF,XLS\",\"upload_maxsize\":\"10\",\"file_path\":\"images\",\"image_path\":\"images\",\"restrict_uploads\":\"1\",\"allowed_media_usergroup\":\"3\",\"check_mime\":\"1\",\"image_extensions\":\"bmp,gif,jpg,png\",\"ignore_extensions\":\"\",\"upload_mime\":\"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip\",\"upload_mime_illegal\":\"text\\/html\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 0, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{\"name\":\"com_menus\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_MENUS_XML_DESCRIPTION\",\"group\":\"\"}', '{\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 0, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{\"name\":\"com_messages\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_MESSAGES_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 0, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{\"name\":\"com_modules\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_MODULES_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 0, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{\"name\":\"com_newsfeeds\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"newsfeeds\"}', '{\"newsfeed_layout\":\"_:default\",\"save_history\":\"1\",\"history_limit\":5,\"show_feed_image\":\"1\",\"show_feed_description\":\"1\",\"show_item_description\":\"1\",\"feed_character_count\":\"0\",\"feed_display_order\":\"des\",\"float_first\":\"right\",\"float_second\":\"right\",\"show_tags\":\"1\",\"category_layout\":\"_:default\",\"show_category_title\":\"1\",\"show_description\":\"1\",\"show_description_image\":\"1\",\"maxLevel\":\"-1\",\"show_empty_categories\":\"0\",\"show_subcat_desc\":\"1\",\"show_cat_items\":\"1\",\"show_cat_tags\":\"1\",\"show_base_description\":\"1\",\"maxLevelcat\":\"-1\",\"show_empty_categories_cat\":\"0\",\"show_subcat_desc_cat\":\"1\",\"show_cat_items_cat\":\"1\",\"filter_field\":\"1\",\"show_pagination_limit\":\"1\",\"show_headings\":\"1\",\"show_articles\":\"0\",\"show_link\":\"1\",\"show_pagination\":\"1\",\"show_pagination_results\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 0, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{\"name\":\"com_plugins\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_PLUGINS_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 0, 'com_search', 'component', 'com_search', '', 1, 1, 1, 0, '{\"name\":\"com_search\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_SEARCH_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"search\"}', '{\"enabled\":\"0\",\"search_phrases\":\"1\",\"search_areas\":\"1\",\"show_date\":\"1\",\"opensearch_name\":\"\",\"opensearch_description\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 0, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{\"name\":\"com_templates\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_TEMPLATES_XML_DESCRIPTION\",\"group\":\"\"}', '{\"template_positions_display\":\"1\",\"upload_limit\":\"10\",\"image_formats\":\"gif,bmp,jpg,jpeg,png\",\"source_formats\":\"txt,less,ini,xml,js,php,css,scss,sass\",\"font_formats\":\"woff,ttf,otf\",\"compressed_formats\":\"zip\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 0, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{\"name\":\"com_content\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CONTENT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"content\"}', '{\"article_layout\":\"_:default\",\"show_title\":\"1\",\"link_titles\":\"1\",\"show_intro\":\"1\",\"show_category\":\"1\",\"link_category\":\"1\",\"show_parent_category\":\"0\",\"link_parent_category\":\"0\",\"show_author\":\"1\",\"link_author\":\"0\",\"show_create_date\":\"0\",\"show_modify_date\":\"0\",\"show_publish_date\":\"1\",\"show_item_navigation\":\"1\",\"show_vote\":\"0\",\"show_readmore\":\"1\",\"show_readmore_title\":\"1\",\"readmore_limit\":\"100\",\"show_icons\":\"1\",\"show_print_icon\":\"1\",\"show_email_icon\":\"0\",\"show_hits\":\"1\",\"show_noauth\":\"0\",\"show_publishing_options\":\"1\",\"show_article_options\":\"1\",\"save_history\":\"1\",\"history_limit\":10,\"show_urls_images_frontend\":\"0\",\"show_urls_images_backend\":\"1\",\"targeta\":0,\"targetb\":0,\"targetc\":0,\"float_intro\":\"left\",\"float_fulltext\":\"left\",\"category_layout\":\"_:blog\",\"show_category_title\":\"0\",\"show_description\":\"0\",\"show_description_image\":\"0\",\"maxLevel\":\"1\",\"show_empty_categories\":\"0\",\"show_no_articles\":\"1\",\"show_subcat_desc\":\"1\",\"show_cat_num_articles\":\"0\",\"show_base_description\":\"1\",\"maxLevelcat\":\"-1\",\"show_empty_categories_cat\":\"0\",\"show_subcat_desc_cat\":\"1\",\"show_cat_num_articles_cat\":\"1\",\"num_leading_articles\":\"1\",\"num_intro_articles\":\"4\",\"num_columns\":\"2\",\"num_links\":\"4\",\"multi_column_order\":\"0\",\"show_subcategory_content\":\"0\",\"show_pagination_limit\":\"1\",\"filter_field\":\"hide\",\"show_headings\":\"1\",\"list_show_date\":\"0\",\"date_format\":\"\",\"list_show_hits\":\"1\",\"list_show_author\":\"1\",\"orderby_pri\":\"order\",\"orderby_sec\":\"rdate\",\"order_date\":\"published\",\"show_pagination\":\"2\",\"show_pagination_results\":\"1\",\"show_feed_link\":\"1\",\"feed_summary\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 0, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{\"name\":\"com_config\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_CONFIG_XML_DESCRIPTION\",\"group\":\"\"}', '{\"filters\":{\"1\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"9\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"6\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"7\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"2\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"3\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"4\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"5\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"8\":{\"filter_type\":\"NONE\",\"filter_tags\":\"\",\"filter_attributes\":\"\"}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 0, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{\"name\":\"com_redirect\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_REDIRECT_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 0, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{\"name\":\"com_users\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_USERS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"users\"}', '{\"allowUserRegistration\":\"1\",\"new_usertype\":\"2\",\"guest_usergroup\":\"9\",\"sendpassword\":\"0\",\"useractivation\":\"2\",\"mail_to_admin\":\"1\",\"captcha\":\"\",\"frontend_userparams\":\"1\",\"site_language\":\"0\",\"change_login_name\":\"0\",\"reset_count\":\"10\",\"reset_time\":\"1\",\"minimum_length\":\"4\",\"minimum_integers\":\"0\",\"minimum_symbols\":\"0\",\"minimum_uppercase\":\"0\",\"save_history\":\"1\",\"history_limit\":5,\"mailSubjectPrefix\":\"\",\"mailBodySuffix\":\"\",\"debugUsers\":\"1\",\"debugGroups\":\"1\",\"sef_advanced\":0,\"custom_fields_enable\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 0, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{\"name\":\"com_finder\",\"type\":\"component\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"COM_FINDER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"finder\"}', '{\"enabled\":\"0\",\"show_description\":\"1\",\"description_length\":255,\"allow_empty_query\":\"0\",\"show_url\":\"1\",\"show_autosuggest\":\"1\",\"show_suggested_query\":\"1\",\"show_explained_query\":\"1\",\"show_advanced\":\"1\",\"show_advanced_tips\":\"1\",\"expand_advanced\":\"0\",\"show_date_filters\":\"0\",\"sort_order\":\"relevance\",\"sort_direction\":\"desc\",\"highlight_terms\":\"1\",\"opensearch_name\":\"\",\"opensearch_description\":\"\",\"batch_size\":\"50\",\"memory_table_limit\":30000,\"title_multiplier\":\"1.7\",\"text_multiplier\":\"0.7\",\"meta_multiplier\":\"1.2\",\"path_multiplier\":\"2.0\",\"misc_multiplier\":\"0.3\",\"stem\":\"1\",\"stemmer\":\"snowball\",\"enable_logging\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 0, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{\"name\":\"com_joomlaupdate\",\"type\":\"component\",\"creationDate\":\"February 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.6.2\",\"description\":\"COM_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\"}', '{\"updatesource\":\"default\",\"customurl\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(29, 0, 'com_tags', 'component', 'com_tags', '', 1, 1, 1, 1, '{\"name\":\"com_tags\",\"type\":\"component\",\"creationDate\":\"December 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.1.0\",\"description\":\"COM_TAGS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"tags\"}', '{\"tag_layout\":\"_:default\",\"save_history\":\"1\",\"history_limit\":5,\"show_tag_title\":\"0\",\"tag_list_show_tag_image\":\"0\",\"tag_list_show_tag_description\":\"0\",\"tag_list_image\":\"\",\"tag_list_orderby\":\"title\",\"tag_list_orderby_direction\":\"ASC\",\"show_headings\":\"0\",\"tag_list_show_date\":\"0\",\"tag_list_show_item_image\":\"0\",\"tag_list_show_item_description\":\"0\",\"tag_list_item_maximum_characters\":0,\"return_any_or_all\":\"1\",\"include_children\":\"0\",\"maximum\":200,\"tag_list_language_filter\":\"all\",\"tags_layout\":\"_:default\",\"all_tags_orderby\":\"title\",\"all_tags_orderby_direction\":\"ASC\",\"all_tags_show_tag_image\":\"0\",\"all_tags_show_tag_descripion\":\"0\",\"all_tags_tag_maximum_characters\":20,\"all_tags_show_tag_hits\":\"0\",\"filter_field\":\"1\",\"show_pagination_limit\":\"1\",\"show_pagination\":\"2\",\"show_pagination_results\":\"1\",\"tag_field_ajax_mode\":\"1\",\"show_feed_link\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(30, 0, 'com_contenthistory', 'component', 'com_contenthistory', '', 1, 1, 1, 0, '{\"name\":\"com_contenthistory\",\"type\":\"component\",\"creationDate\":\"May 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.0\",\"description\":\"COM_CONTENTHISTORY_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contenthistory\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(31, 0, 'com_ajax', 'component', 'com_ajax', '', 1, 1, 1, 1, '{\"name\":\"com_ajax\",\"type\":\"component\",\"creationDate\":\"August 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.0\",\"description\":\"COM_AJAX_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"ajax\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(32, 0, 'com_postinstall', 'component', 'com_postinstall', '', 1, 1, 1, 1, '{\"name\":\"com_postinstall\",\"type\":\"component\",\"creationDate\":\"September 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.0\",\"description\":\"COM_POSTINSTALL_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(33, 0, 'com_fields', 'component', 'com_fields', '', 1, 1, 1, 0, '{\"name\":\"com_fields\",\"type\":\"component\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"COM_FIELDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"fields\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(34, 0, 'com_associations', 'component', 'com_associations', '', 1, 1, 1, 0, '{\"name\":\"com_associations\",\"type\":\"component\",\"creationDate\":\"Januar 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"COM_ASSOCIATIONS_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 0, 'LIB_PHPUTF8', 'library', 'phputf8', '', 0, 1, 1, 1, '{\"name\":\"LIB_PHPUTF8\",\"type\":\"library\",\"creationDate\":\"2006\",\"author\":\"Harry Fuecks\",\"copyright\":\"Copyright various authors\",\"authorEmail\":\"hfuecks@gmail.com\",\"authorUrl\":\"http:\\/\\/sourceforge.net\\/projects\\/phputf8\",\"version\":\"0.5\",\"description\":\"LIB_PHPUTF8_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"phputf8\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 0, 'LIB_JOOMLA', 'library', 'joomla', '', 0, 1, 1, 1, '{\"name\":\"LIB_JOOMLA\",\"type\":\"library\",\"creationDate\":\"2008\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"https:\\/\\/www.joomla.org\",\"version\":\"13.1\",\"description\":\"LIB_JOOMLA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomla\"}', '{\"mediaversion\":\"4c6cfd175e203f62d844001034471c4e\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(104, 0, 'LIB_IDNA', 'library', 'idna_convert', '', 0, 1, 1, 1, '{\"name\":\"LIB_IDNA\",\"type\":\"library\",\"creationDate\":\"2004\",\"author\":\"phlyLabs\",\"copyright\":\"2004-2011 phlyLabs Berlin, http:\\/\\/phlylabs.de\",\"authorEmail\":\"phlymail@phlylabs.de\",\"authorUrl\":\"http:\\/\\/phlylabs.de\",\"version\":\"0.8.0\",\"description\":\"LIB_IDNA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"idna_convert\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(105, 0, 'FOF', 'library', 'fof', '', 0, 1, 1, 1, '{\"name\":\"FOF\",\"type\":\"library\",\"creationDate\":\"2015-04-22 13:15:32\",\"author\":\"Nicholas K. Dionysopoulos \\/ Akeeba Ltd\",\"copyright\":\"(C)2011-2015 Nicholas K. Dionysopoulos\",\"authorEmail\":\"nicholas@akeebabackup.com\",\"authorUrl\":\"https:\\/\\/www.akeebabackup.com\",\"version\":\"2.4.3\",\"description\":\"LIB_FOF_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"fof\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(106, 0, 'LIB_PHPASS', 'library', 'phpass', '', 0, 1, 1, 1, '{\"name\":\"LIB_PHPASS\",\"type\":\"library\",\"creationDate\":\"2004-2006\",\"author\":\"Solar Designer\",\"copyright\":\"\",\"authorEmail\":\"solar@openwall.com\",\"authorUrl\":\"http:\\/\\/www.openwall.com\\/phpass\\/\",\"version\":\"0.3\",\"description\":\"LIB_PHPASS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"phpass\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 0, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_archive\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_archive\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 0, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_LATEST_NEWS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_latest\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 0, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_popular\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_POPULAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_popular\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 0, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{\"name\":\"mod_banners\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_BANNERS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_banners\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 0, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{\"name\":\"mod_breadcrumbs\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_BREADCRUMBS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_breadcrumbs\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 0, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_custom\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 0, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 0, '{\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_feed\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 0, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 0, '{\"name\":\"mod_footer\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_FOOTER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_footer\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 0, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_login\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 0, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_menu\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 0, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_news\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_ARTICLES_NEWS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_news\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 0, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{\"name\":\"mod_random_image\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_RANDOM_IMAGE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_random_image\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 0, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{\"name\":\"mod_related_items\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_RELATED_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_related_items\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 0, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{\"name\":\"mod_search\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_SEARCH_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_search\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 0, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{\"name\":\"mod_stats\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_STATS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_stats\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 0, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{\"name\":\"mod_syndicate\",\"type\":\"module\",\"creationDate\":\"May 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_SYNDICATE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_syndicate\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 0, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 0, '{\"name\":\"mod_users_latest\",\"type\":\"module\",\"creationDate\":\"December 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_USERS_LATEST_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_users_latest\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 0, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{\"name\":\"mod_whosonline\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_WHOSONLINE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_whosonline\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 0, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{\"name\":\"mod_wrapper\",\"type\":\"module\",\"creationDate\":\"October 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_WRAPPER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_wrapper\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 0, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_category\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_category\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 0, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 0, '{\"name\":\"mod_articles_categories\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_articles_categories\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 0, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{\"name\":\"mod_languages\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.5.0\",\"description\":\"MOD_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_languages\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 0, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{\"name\":\"mod_finder\",\"type\":\"module\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_FINDER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_finder\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 0, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_custom\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 0, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_feed\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 0, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{\"name\":\"mod_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_LATEST_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_latest\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 0, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{\"name\":\"mod_logged\",\"type\":\"module\",\"creationDate\":\"January 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_LOGGED_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_logged\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 0, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"March 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_login\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 0, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_menu\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 0, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{\"name\":\"mod_popular\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_POPULAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_popular\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 0, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{\"name\":\"mod_quickicon\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_QUICKICON_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_quickicon\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 0, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{\"name\":\"mod_status\",\"type\":\"module\",\"creationDate\":\"Feb 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_STATUS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_status\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 0, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{\"name\":\"mod_submenu\",\"type\":\"module\",\"creationDate\":\"Feb 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_SUBMENU_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_submenu\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 0, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{\"name\":\"mod_title\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_TITLE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_title\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 0, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{\"name\":\"mod_toolbar\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_TOOLBAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_toolbar\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 0, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{\"name\":\"mod_multilangstatus\",\"type\":\"module\",\"creationDate\":\"September 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_MULTILANGSTATUS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_multilangstatus\"}', '{\"cache\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 0, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{\"name\":\"mod_version\",\"type\":\"module\",\"creationDate\":\"January 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_VERSION_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_version\"}', '{\"format\":\"short\",\"product\":\"1\",\"cache\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(315, 0, 'mod_stats_admin', 'module', 'mod_stats_admin', '', 1, 1, 1, 0, '{\"name\":\"mod_stats_admin\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"MOD_STATS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_stats_admin\"}', '{\"serverinfo\":\"0\",\"siteinfo\":\"0\",\"counter\":\"0\",\"increase\":\"0\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"static\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(316, 0, 'mod_tags_popular', 'module', 'mod_tags_popular', '', 0, 1, 1, 0, '{\"name\":\"mod_tags_popular\",\"type\":\"module\",\"creationDate\":\"January 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.1.0\",\"description\":\"MOD_TAGS_POPULAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_tags_popular\"}', '{\"maximum\":\"5\",\"timeframe\":\"alltime\",\"owncache\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(317, 0, 'mod_tags_similar', 'module', 'mod_tags_similar', '', 0, 1, 1, 0, '{\"name\":\"mod_tags_similar\",\"type\":\"module\",\"creationDate\":\"January 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.1.0\",\"description\":\"MOD_TAGS_SIMILAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_tags_similar\"}', '{\"maximum\":\"5\",\"matchtype\":\"any\",\"owncache\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(318, 0, 'mod_sampledata', 'module', 'mod_sampledata', '', 1, 1, 1, 0, '{\"name\":\"mod_sampledata\",\"type\":\"module\",\"creationDate\":\"July 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.0\",\"description\":\"MOD_SAMPLEDATA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_sampledata\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 0, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{\"name\":\"plg_authentication_gmail\",\"type\":\"plugin\",\"creationDate\":\"February 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_GMAIL_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"gmail\"}', '{\"applysuffix\":\"0\",\"suffix\":\"\",\"verifypeer\":\"1\",\"user_blacklist\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 0, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{\"name\":\"plg_authentication_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_AUTH_JOOMLA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomla\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 0, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{\"name\":\"plg_authentication_ldap\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_LDAP_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"ldap\"}', '{\"host\":\"\",\"port\":\"389\",\"use_ldapV3\":\"0\",\"negotiate_tls\":\"0\",\"no_referrals\":\"0\",\"auth_method\":\"bind\",\"base_dn\":\"\",\"search_string\":\"\",\"users_dn\":\"\",\"username\":\"admin\",\"password\":\"bobby7\",\"ldap_fullname\":\"fullName\",\"ldap_email\":\"mail\",\"ldap_uid\":\"uid\"}', '', '', 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `bt8w9_extensions` (`extension_id`, `package_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(403, 0, 'plg_content_contact', 'plugin', 'contact', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_contact\",\"type\":\"plugin\",\"creationDate\":\"January 2014\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.2\",\"description\":\"PLG_CONTENT_CONTACT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contact\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(404, 0, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_emailcloak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"emailcloak\"}', '{\"mode\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(406, 0, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_loadmodule\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_LOADMODULE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"loadmodule\"}', '{\"style\":\"xhtml\"}', '', '', 0, '2011-09-18 15:22:50', 0, 0),
(407, 0, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"pagebreak\"}', '{\"title\":\"1\",\"multipage_toc\":\"1\",\"showall\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 0, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_pagenavigation\",\"type\":\"plugin\",\"creationDate\":\"January 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_PAGENAVIGATION_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"pagenavigation\"}', '{\"position\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 0, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 0, 1, 0, '{\"name\":\"plg_content_vote\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_VOTE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"vote\"}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 0, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{\"name\":\"plg_editors_codemirror\",\"type\":\"plugin\",\"creationDate\":\"28 March 2011\",\"author\":\"Marijn Haverbeke\",\"copyright\":\"Copyright (C) 2014 - 2017 by Marijn Haverbeke <marijnh@gmail.com> and others\",\"authorEmail\":\"marijnh@gmail.com\",\"authorUrl\":\"http:\\/\\/codemirror.net\\/\",\"version\":\"5.38.0\",\"description\":\"PLG_CODEMIRROR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"codemirror\"}', '{\"lineNumbers\":\"1\",\"lineWrapping\":\"1\",\"matchTags\":\"1\",\"matchBrackets\":\"1\",\"marker-gutter\":\"1\",\"autoCloseTags\":\"1\",\"autoCloseBrackets\":\"1\",\"autoFocus\":\"1\",\"theme\":\"default\",\"tabmode\":\"indent\"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 0, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{\"name\":\"plg_editors_none\",\"type\":\"plugin\",\"creationDate\":\"September 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_NONE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"none\"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 0, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 0, '{\"name\":\"plg_editors_tinymce\",\"type\":\"plugin\",\"creationDate\":\"2005-2017\",\"author\":\"Ephox Corporation\",\"copyright\":\"Ephox Corporation\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"http:\\/\\/www.tinymce.com\",\"version\":\"4.5.8\",\"description\":\"PLG_TINY_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"tinymce\"}', '{\"configuration\":{\"toolbars\":{\"2\":{\"toolbar1\":[\"bold\",\"underline\",\"strikethrough\",\"|\",\"undo\",\"redo\",\"|\",\"bullist\",\"numlist\",\"|\",\"pastetext\"]},\"1\":{\"menu\":[\"edit\",\"insert\",\"view\",\"format\",\"table\",\"tools\"],\"toolbar1\":[\"bold\",\"italic\",\"underline\",\"strikethrough\",\"|\",\"alignleft\",\"aligncenter\",\"alignright\",\"alignjustify\",\"|\",\"formatselect\",\"|\",\"bullist\",\"numlist\",\"|\",\"outdent\",\"indent\",\"|\",\"undo\",\"redo\",\"|\",\"link\",\"unlink\",\"anchor\",\"code\",\"|\",\"hr\",\"table\",\"|\",\"subscript\",\"superscript\",\"|\",\"charmap\",\"pastetext\",\"preview\"]},\"0\":{\"menu\":[\"edit\",\"insert\",\"view\",\"format\",\"table\",\"tools\"],\"toolbar1\":[\"bold\",\"italic\",\"underline\",\"strikethrough\",\"|\",\"alignleft\",\"aligncenter\",\"alignright\",\"alignjustify\",\"|\",\"styleselect\",\"|\",\"formatselect\",\"fontselect\",\"fontsizeselect\",\"|\",\"searchreplace\",\"|\",\"bullist\",\"numlist\",\"|\",\"outdent\",\"indent\",\"|\",\"undo\",\"redo\",\"|\",\"link\",\"unlink\",\"anchor\",\"image\",\"|\",\"code\",\"|\",\"forecolor\",\"backcolor\",\"|\",\"fullscreen\",\"|\",\"table\",\"|\",\"subscript\",\"superscript\",\"|\",\"charmap\",\"emoticons\",\"media\",\"hr\",\"ltr\",\"rtl\",\"|\",\"cut\",\"copy\",\"paste\",\"pastetext\",\"|\",\"visualchars\",\"visualblocks\",\"nonbreaking\",\"blockquote\",\"template\",\"|\",\"print\",\"preview\",\"codesample\",\"insertdatetime\",\"removeformat\"]}},\"setoptions\":{\"2\":{\"access\":[\"1\"],\"skin\":\"0\",\"skin_admin\":\"0\",\"mobile\":\"0\",\"drag_drop\":\"1\",\"path\":\"\",\"entity_encoding\":\"raw\",\"lang_mode\":\"1\",\"text_direction\":\"ltr\",\"content_css\":\"1\",\"content_css_custom\":\"\",\"relative_urls\":\"1\",\"newlines\":\"0\",\"use_config_textfilters\":\"0\",\"invalid_elements\":\"script,applet,iframe\",\"valid_elements\":\"\",\"extended_elements\":\"\",\"resizing\":\"1\",\"resize_horizontal\":\"1\",\"element_path\":\"1\",\"wordcount\":\"1\",\"image_advtab\":\"0\",\"advlist\":\"1\",\"autosave\":\"1\",\"contextmenu\":\"1\",\"custom_plugin\":\"\",\"custom_button\":\"\"},\"1\":{\"access\":[\"6\",\"2\"],\"skin\":\"0\",\"skin_admin\":\"0\",\"mobile\":\"0\",\"drag_drop\":\"1\",\"path\":\"\",\"entity_encoding\":\"raw\",\"lang_mode\":\"1\",\"text_direction\":\"ltr\",\"content_css\":\"1\",\"content_css_custom\":\"\",\"relative_urls\":\"1\",\"newlines\":\"0\",\"use_config_textfilters\":\"0\",\"invalid_elements\":\"script,applet,iframe\",\"valid_elements\":\"\",\"extended_elements\":\"\",\"resizing\":\"1\",\"resize_horizontal\":\"1\",\"element_path\":\"1\",\"wordcount\":\"1\",\"image_advtab\":\"0\",\"advlist\":\"1\",\"autosave\":\"1\",\"contextmenu\":\"1\",\"custom_plugin\":\"\",\"custom_button\":\"\"},\"0\":{\"access\":[\"7\",\"4\",\"8\"],\"skin\":\"0\",\"skin_admin\":\"0\",\"mobile\":\"0\",\"drag_drop\":\"1\",\"path\":\"\",\"entity_encoding\":\"raw\",\"lang_mode\":\"1\",\"text_direction\":\"ltr\",\"content_css\":\"1\",\"content_css_custom\":\"\",\"relative_urls\":\"1\",\"newlines\":\"0\",\"use_config_textfilters\":\"0\",\"invalid_elements\":\"script,applet,iframe\",\"valid_elements\":\"\",\"extended_elements\":\"\",\"resizing\":\"1\",\"resize_horizontal\":\"1\",\"element_path\":\"1\",\"wordcount\":\"1\",\"image_advtab\":\"1\",\"advlist\":\"1\",\"autosave\":\"1\",\"contextmenu\":\"1\",\"custom_plugin\":\"\",\"custom_button\":\"\"}}},\"sets_amount\":3,\"html_height\":\"550\",\"html_width\":\"750\"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 0, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_article\",\"type\":\"plugin\",\"creationDate\":\"October 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_ARTICLE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"article\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 0, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_image\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_IMAGE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"image\"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 0, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"pagebreak\"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 0, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_readmore\",\"type\":\"plugin\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_READMORE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"readmore\"}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 0, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{\"name\":\"plg_search_categories\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"categories\"}', '{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 0, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{\"name\":\"plg_search_contacts\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEARCH_CONTACTS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contacts\"}', '{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 0, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{\"name\":\"plg_search_content\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEARCH_CONTENT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"content\"}', '{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 0, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{\"name\":\"plg_search_newsfeeds\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"newsfeeds\"}', '{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 0, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{\"name\":\"plg_system_languagefilter\",\"type\":\"plugin\",\"creationDate\":\"July 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"languagefilter\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 0, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 0, 1, 0, '{\"name\":\"plg_system_p3p\",\"type\":\"plugin\",\"creationDate\":\"September 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_P3P_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"p3p\"}', '{\"headers\":\"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM\"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 0, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{\"name\":\"plg_system_cache\",\"type\":\"plugin\",\"creationDate\":\"February 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CACHE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"cache\"}', '{\"browsercache\":\"0\",\"cachetime\":\"15\"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 0, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_debug\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_DEBUG_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"debug\"}', '{\"profile\":\"1\",\"queries\":\"1\",\"memory\":\"1\",\"language_files\":\"1\",\"language_strings\":\"1\",\"strip-first\":\"1\",\"strip-prefix\":\"\",\"strip-suffix\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 0, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{\"name\":\"plg_system_log\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_LOG_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"log\"}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(427, 0, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 0, 1, 1, '{\"name\":\"plg_system_redirect\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SYSTEM_REDIRECT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"redirect\"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(428, 0, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{\"name\":\"plg_system_remember\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_REMEMBER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"remember\"}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 0, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_sef\",\"type\":\"plugin\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEF_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"sef\"}', '', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 0, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{\"name\":\"plg_system_logout\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"logout\"}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(431, 0, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 0, '{\"name\":\"plg_user_contactcreator\",\"type\":\"plugin\",\"creationDate\":\"August 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CONTACTCREATOR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contactcreator\"}', '{\"autowebpage\":\"\",\"category\":\"34\",\"autopublish\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 0, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{\"name\":\"plg_user_joomla\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_USER_JOOMLA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomla\"}', '{\"autoregister\":\"1\",\"mail_to_user\":\"1\",\"forceLogout\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 0, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 0, '{\"name\":\"plg_user_profile\",\"type\":\"plugin\",\"creationDate\":\"January 2008\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_USER_PROFILE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"profile\"}', '{\"register-require_address1\":\"1\",\"register-require_address2\":\"1\",\"register-require_city\":\"1\",\"register-require_region\":\"1\",\"register-require_country\":\"1\",\"register-require_postal_code\":\"1\",\"register-require_phone\":\"1\",\"register-require_website\":\"1\",\"register-require_favoritebook\":\"1\",\"register-require_aboutme\":\"1\",\"register-require_tos\":\"1\",\"register-require_dob\":\"1\",\"profile-require_address1\":\"1\",\"profile-require_address2\":\"1\",\"profile-require_city\":\"1\",\"profile-require_region\":\"1\",\"profile-require_country\":\"1\",\"profile-require_postal_code\":\"1\",\"profile-require_phone\":\"1\",\"profile-require_website\":\"1\",\"profile-require_favoritebook\":\"1\",\"profile-require_aboutme\":\"1\",\"profile-require_tos\":\"1\",\"profile-require_dob\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 0, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{\"name\":\"plg_extension_joomla\",\"type\":\"plugin\",\"creationDate\":\"May 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomla\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 0, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CONTENT_JOOMLA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomla\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 0, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{\"name\":\"plg_system_languagecode\",\"type\":\"plugin\",\"creationDate\":\"November 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"languagecode\"}', '', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(437, 0, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{\"name\":\"plg_quickicon_joomlaupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"joomlaupdate\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 0, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{\"name\":\"plg_quickicon_extensionupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"extensionupdate\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 0, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 0, 1, 0, '{\"name\":\"plg_captcha_recaptcha\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.4.0\",\"description\":\"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"recaptcha\"}', '{\"public_key\":\"\",\"private_key\":\"\",\"theme\":\"clean\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 0, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_highlight\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"highlight\"}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(441, 0, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{\"name\":\"plg_content_finder\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_CONTENT_FINDER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"finder\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 0, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{\"name\":\"plg_finder_categories\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_FINDER_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"categories\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 0, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{\"name\":\"plg_finder_contacts\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_FINDER_CONTACTS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contacts\"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 0, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{\"name\":\"plg_finder_content\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_FINDER_CONTENT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"content\"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 0, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{\"name\":\"plg_finder_newsfeeds\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"newsfeeds\"}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(447, 0, 'plg_finder_tags', 'plugin', 'tags', 'finder', 0, 1, 1, 0, '{\"name\":\"plg_finder_tags\",\"type\":\"plugin\",\"creationDate\":\"February 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_FINDER_TAGS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"tags\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(448, 0, 'plg_twofactorauth_totp', 'plugin', 'totp', 'twofactorauth', 0, 0, 1, 0, '{\"name\":\"plg_twofactorauth_totp\",\"type\":\"plugin\",\"creationDate\":\"August 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.0\",\"description\":\"PLG_TWOFACTORAUTH_TOTP_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"totp\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(449, 0, 'plg_authentication_cookie', 'plugin', 'cookie', 'authentication', 0, 1, 1, 0, '{\"name\":\"plg_authentication_cookie\",\"type\":\"plugin\",\"creationDate\":\"July 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_AUTH_COOKIE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"cookie\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(450, 0, 'plg_twofactorauth_yubikey', 'plugin', 'yubikey', 'twofactorauth', 0, 0, 1, 0, '{\"name\":\"plg_twofactorauth_yubikey\",\"type\":\"plugin\",\"creationDate\":\"September 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.2.0\",\"description\":\"PLG_TWOFACTORAUTH_YUBIKEY_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"yubikey\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(451, 0, 'plg_search_tags', 'plugin', 'tags', 'search', 0, 1, 1, 0, '{\"name\":\"plg_search_tags\",\"type\":\"plugin\",\"creationDate\":\"March 2014\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.0.0\",\"description\":\"PLG_SEARCH_TAGS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"tags\"}', '{\"search_limit\":\"50\",\"show_tagged_items\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(452, 0, 'plg_system_updatenotification', 'plugin', 'updatenotification', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_updatenotification\",\"type\":\"plugin\",\"creationDate\":\"May 2015\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.5.0\",\"description\":\"PLG_SYSTEM_UPDATENOTIFICATION_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"updatenotification\"}', '{\"lastrun\":1531732829}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(453, 0, 'plg_editors-xtd_module', 'plugin', 'module', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_module\",\"type\":\"plugin\",\"creationDate\":\"October 2015\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.5.0\",\"description\":\"PLG_MODULE_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"module\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(454, 0, 'plg_system_stats', 'plugin', 'stats', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_stats\",\"type\":\"plugin\",\"creationDate\":\"November 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.5.0\",\"description\":\"PLG_SYSTEM_STATS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"stats\"}', '{\"mode\":1,\"lastrun\":1531732882,\"unique_id\":\"1a081a72a5b9d9b08aedea01ea3f77ccc90cff42\",\"interval\":12}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(455, 0, 'plg_installer_packageinstaller', 'plugin', 'packageinstaller', 'installer', 0, 1, 1, 1, '{\"name\":\"plg_installer_packageinstaller\",\"type\":\"plugin\",\"creationDate\":\"May 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.6.0\",\"description\":\"PLG_INSTALLER_PACKAGEINSTALLER_PLUGIN_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"packageinstaller\"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(456, 0, 'PLG_INSTALLER_FOLDERINSTALLER', 'plugin', 'folderinstaller', 'installer', 0, 1, 1, 1, '{\"name\":\"PLG_INSTALLER_FOLDERINSTALLER\",\"type\":\"plugin\",\"creationDate\":\"May 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.6.0\",\"description\":\"PLG_INSTALLER_FOLDERINSTALLER_PLUGIN_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"folderinstaller\"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(457, 0, 'PLG_INSTALLER_URLINSTALLER', 'plugin', 'urlinstaller', 'installer', 0, 1, 1, 1, '{\"name\":\"PLG_INSTALLER_URLINSTALLER\",\"type\":\"plugin\",\"creationDate\":\"May 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.6.0\",\"description\":\"PLG_INSTALLER_URLINSTALLER_PLUGIN_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"urlinstaller\"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(458, 0, 'plg_quickicon_phpversioncheck', 'plugin', 'phpversioncheck', 'quickicon', 0, 1, 1, 1, '{\"name\":\"plg_quickicon_phpversioncheck\",\"type\":\"plugin\",\"creationDate\":\"August 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_QUICKICON_PHPVERSIONCHECK_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"phpversioncheck\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(459, 0, 'plg_editors-xtd_menu', 'plugin', 'menu', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_menu\",\"type\":\"plugin\",\"creationDate\":\"August 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_EDITORS-XTD_MENU_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"menu\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(460, 0, 'plg_editors-xtd_contact', 'plugin', 'contact', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_contact\",\"type\":\"plugin\",\"creationDate\":\"October 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_EDITORS-XTD_CONTACT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"contact\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(461, 0, 'plg_system_fields', 'plugin', 'fields', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_fields\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_SYSTEM_FIELDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"fields\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(462, 0, 'plg_fields_calendar', 'plugin', 'calendar', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_calendar\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_CALENDAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"calendar\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(463, 0, 'plg_fields_checkboxes', 'plugin', 'checkboxes', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_checkboxes\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_CHECKBOXES_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"checkboxes\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(464, 0, 'plg_fields_color', 'plugin', 'color', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_color\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_COLOR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"color\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(465, 0, 'plg_fields_editor', 'plugin', 'editor', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_editor\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_EDITOR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"editor\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(466, 0, 'plg_fields_imagelist', 'plugin', 'imagelist', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_imagelist\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_IMAGELIST_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"imagelist\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(467, 0, 'plg_fields_integer', 'plugin', 'integer', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_integer\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_INTEGER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"integer\"}', '{\"multiple\":\"0\",\"first\":\"1\",\"last\":\"100\",\"step\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(468, 0, 'plg_fields_list', 'plugin', 'list', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_list\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_LIST_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"list\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(469, 0, 'plg_fields_media', 'plugin', 'media', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_media\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_MEDIA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"media\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(470, 0, 'plg_fields_radio', 'plugin', 'radio', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_radio\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_RADIO_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"radio\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(471, 0, 'plg_fields_sql', 'plugin', 'sql', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_sql\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_SQL_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"sql\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(472, 0, 'plg_fields_text', 'plugin', 'text', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_text\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_TEXT_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"text\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(473, 0, 'plg_fields_textarea', 'plugin', 'textarea', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_textarea\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_TEXTAREA_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"textarea\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(474, 0, 'plg_fields_url', 'plugin', 'url', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_url\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_URL_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"url\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(475, 0, 'plg_fields_user', 'plugin', 'user', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_user\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_USER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"user\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(476, 0, 'plg_fields_usergrouplist', 'plugin', 'usergrouplist', 'fields', 0, 1, 1, 0, '{\"name\":\"plg_fields_usergrouplist\",\"type\":\"plugin\",\"creationDate\":\"March 2016\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_FIELDS_USERGROUPLIST_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"usergrouplist\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(477, 0, 'plg_content_fields', 'plugin', 'fields', 'content', 0, 1, 1, 0, '{\"name\":\"plg_content_fields\",\"type\":\"plugin\",\"creationDate\":\"February 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_CONTENT_FIELDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"fields\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(478, 0, 'plg_editors-xtd_fields', 'plugin', 'fields', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"plg_editors-xtd_fields\",\"type\":\"plugin\",\"creationDate\":\"February 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.7.0\",\"description\":\"PLG_EDITORS-XTD_FIELDS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"fields\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(479, 0, 'plg_sampledata_blog', 'plugin', 'blog', 'sampledata', 0, 1, 1, 0, '{\"name\":\"plg_sampledata_blog\",\"type\":\"plugin\",\"creationDate\":\"July 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.0\",\"description\":\"PLG_SAMPLEDATA_BLOG_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"blog\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(480, 0, 'plg_system_sessiongc', 'plugin', 'sessiongc', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_sessiongc\",\"type\":\"plugin\",\"creationDate\":\"February 2018\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.6\",\"description\":\"PLG_SYSTEM_SESSIONGC_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"sessiongc\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 0, 'beez3', 'template', 'beez3', '', 0, 1, 1, 0, '{\"name\":\"beez3\",\"type\":\"template\",\"creationDate\":\"25 November 2009\",\"author\":\"Angie Radtke\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"a.radtke@derauftritt.de\",\"authorUrl\":\"http:\\/\\/www.der-auftritt.de\",\"version\":\"3.1.0\",\"description\":\"TPL_BEEZ3_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"templatecolor\":\"nature\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 0, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{\"name\":\"hathor\",\"type\":\"template\",\"creationDate\":\"May 2010\",\"author\":\"Andrea Tarr\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"\",\"version\":\"3.0.0\",\"description\":\"TPL_HATHOR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"showSiteName\":\"0\",\"colourChoice\":\"0\",\"boldText\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(506, 0, 'protostar', 'template', 'protostar', '', 0, 1, 1, 0, '{\"name\":\"protostar\",\"type\":\"template\",\"creationDate\":\"4\\/30\\/2012\",\"author\":\"Kyle Ledbetter\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"\",\"version\":\"1.0\",\"description\":\"TPL_PROTOSTAR_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"templateColor\":\"\",\"logoFile\":\"\",\"googleFont\":\"1\",\"googleFontName\":\"Open+Sans\",\"fluidContainer\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(507, 0, 'isis', 'template', 'isis', '', 1, 1, 1, 0, '{\"name\":\"isis\",\"type\":\"template\",\"creationDate\":\"3\\/30\\/2012\",\"author\":\"Kyle Ledbetter\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"\",\"version\":\"1.0\",\"description\":\"TPL_ISIS_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"templateColor\":\"\",\"logoFile\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 802, 'English (en-GB)', 'language', 'en-GB', '', 0, 1, 1, 1, '{\"name\":\"English (en-GB)\",\"type\":\"language\",\"creationDate\":\"June 2018\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.10\",\"description\":\"en-GB site language\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 802, 'English (en-GB)', 'language', 'en-GB', '', 1, 1, 1, 1, '{\"name\":\"English (en-GB)\",\"type\":\"language\",\"creationDate\":\"June 2018\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.10\",\"description\":\"en-GB administrator language\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 0, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{\"name\":\"files_joomla\",\"type\":\"file\",\"creationDate\":\"June 2018\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2018 Open Source Matters. All rights reserved\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.10\",\"description\":\"FILES_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(802, 0, 'English (en-GB) Language Pack', 'package', 'pkg_en-GB', '', 0, 1, 1, 1, '{\"name\":\"English (en-GB) Language Pack\",\"type\":\"package\",\"creationDate\":\"June 2018\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"3.8.10.1\",\"description\":\"en-GB language pack\",\"group\":\"\",\"filename\":\"pkg_en-GB\"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 0, 'plg_installer_webinstaller', 'plugin', 'webinstaller', 'installer', 0, 1, 1, 0, '{\"name\":\"plg_installer_webinstaller\",\"type\":\"plugin\",\"creationDate\":\"28 April 2017\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2013-2017 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"1.1.1\",\"description\":\"PLG_INSTALLER_WEBINSTALLER_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"webinstaller\"}', '{\"tab_position\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `bt8w9_extensions` (`extension_id`, `package_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(10003, 0, 'plg_system_regularlabs', 'plugin', 'regularlabs', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_regularlabs\",\"type\":\"plugin\",\"creationDate\":\"June 2018\",\"author\":\"Regular Labs (Peter van Westen)\",\"copyright\":\"Copyright \\u00a9 2018 Regular Labs - All Rights Reserved\",\"authorEmail\":\"info@regularlabs.com\",\"authorUrl\":\"https:\\/\\/www.regularlabs.com\",\"version\":\"18.6.10771\",\"description\":\"PLG_SYSTEM_REGULARLABS_DESC\",\"group\":\"\",\"filename\":\"regularlabs\"}', '{\"combine_admin_menu\":\"0\",\"show_help_menu\":\"1\",\"max_list_count\":\"5000\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 0, 'com_advancedmodules', 'component', 'com_advancedmodules', '', 1, 1, 0, 0, '{\"name\":\"com_advancedmodules\",\"type\":\"component\",\"creationDate\":\"July 2018\",\"author\":\"Regular Labs (Peter van Westen)\",\"copyright\":\"Copyright \\u00a9 2018 Regular Labs - All Rights Reserved\",\"authorEmail\":\"info@regularlabs.com\",\"authorUrl\":\"https:\\/\\/www.regularlabs.com\",\"version\":\"7.7.0\",\"description\":\"COM_ADVANCEDMODULES_DESC\",\"group\":\"\",\"filename\":\"advancedmodules\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10005, 0, 'plg_system_advancedmodules', 'plugin', 'advancedmodules', 'system', 0, 1, 1, 0, '{\"name\":\"plg_system_advancedmodules\",\"type\":\"plugin\",\"creationDate\":\"July 2018\",\"author\":\"Regular Labs (Peter van Westen)\",\"copyright\":\"Copyright \\u00a9 2018 Regular Labs - All Rights Reserved\",\"authorEmail\":\"info@regularlabs.com\",\"authorUrl\":\"https:\\/\\/www.regularlabs.com\",\"version\":\"7.7.0\",\"description\":\"PLG_SYSTEM_ADVANCEDMODULES_DESC\",\"group\":\"\",\"filename\":\"advancedmodules\"}', '[]', '', '', 0, '0000-00-00 00:00:00', -1, 0),
(10006, 0, 'COM_CREATIVECONTACTFORM', 'component', 'com_creativecontactform', '', 1, 1, 0, 0, '{\"name\":\"COM_CREATIVECONTACTFORM\",\"type\":\"component\",\"creationDate\":\"March 2013\",\"author\":\"Creative Solutions\",\"copyright\":\"Copyright (\\u00a9) 2008-2016 Creative Solutions. All rights reserved.\",\"authorEmail\":\"info@creative-solutions.net\",\"authorUrl\":\"http:\\/\\/creative-solutions.net\",\"version\":\"4.5.0\",\"description\":\"COM_CREATIVECONTACTFORM_DESCRIPTION\",\"group\":\"\",\"filename\":\"creativecontactform\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10007, 0, 'MOD_CREATIVECONTACTFORM_NAME', 'module', 'mod_creativecontactform', '', 0, 1, 0, 0, '{\"name\":\"MOD_CREATIVECONTACTFORM_NAME\",\"type\":\"module\",\"creationDate\":\"March 2013\",\"author\":\"Creative Solutions\",\"copyright\":\"Copyright (\\u00a9) 2008-2016 Creative Solutions. All rights reserved.\",\"authorEmail\":\"info@creative-solutions.net\",\"authorUrl\":\"http:\\/\\/creative-solutions.net\",\"version\":\"4.5.0\",\"description\":\"MOD_CREATIVECONTACTFORM_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_creativecontactform\"}', '{\"form_id\":\"\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10008, 0, 'Creative Contact Form', 'plugin', 'creativecontactform', 'system', 0, 1, 1, 0, '{\"name\":\"Creative Contact Form\",\"type\":\"plugin\",\"creationDate\":\"March 2013\",\"author\":\"Creative Solutions\",\"copyright\":\"Copyright (\\u00a9) 2008-2016 Creative Solutions company. All rights reserved.\",\"authorEmail\":\"info@creative-solutions.net\",\"authorUrl\":\"http:\\/\\/creative-solutions.net\",\"version\":\"4.5.0\",\"description\":\"PLG_CREATIVECONTACTFORM_DESCRIPTION\",\"group\":\"\",\"filename\":\"creativecontactform\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10009, 0, 'OSTraining: Breeze', 'template', 'ostrainingbreeze', '', 0, 1, 1, 0, '{\"name\":\"OSTraining: Breeze\",\"type\":\"template\",\"creationDate\":\"May 2 2018\",\"author\":\"OSTraining\",\"copyright\":\"Copyright (C) 2018 OSTraining.com\",\"authorEmail\":\"info@ostraining.com\",\"authorUrl\":\"https:\\/\\/www.ostraining.com\",\"version\":\"2.4.1\",\"description\":\"<p>OSTraining Breeze. A beautiful and easy-to-use-template from OSTraining<br\\/><img src=\\\"..\\/templates\\/ostrainingbreeze\\/template_thumbnail.png\\\" alt=\\\"OSTraining\\\" \\/><\\/p>\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"logoFile\":\"\",\"googleFont\":\"1\",\"fontAwesome\":\"1\",\"mobileMenu\":\"1\",\"googleFontName\":\"Open+Sans:400,300,300italic,700,600,800\",\"colorScheme\":\"#2184CD\",\"hoverColor\":\"#41A1D6\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10010, 10015, 'GRIDBOX', 'component', 'com_gridbox', '', 1, 1, 0, 0, '{\"name\":\"GRIDBOX\",\"type\":\"component\",\"creationDate\":\"01 May 2017\",\"author\":\"Balbooa\",\"copyright\":\"Balbooa 2017\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"http:\\/\\/balbooa.com\",\"version\":\"2.4.8\",\"description\":\"Gridbox is the easiest way to create a beautiful Joomla page. Creating website should be easy!\",\"group\":\"\",\"filename\":\"gridbox\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10011, 10015, 'Gridbox', 'template', 'gridbox', '', 0, 1, 1, 0, '{\"name\":\"Gridbox\",\"type\":\"template\",\"creationDate\":\"01 May 2017\",\"author\":\"Balbooa\",\"copyright\":\"\\u00a9 2017 Balbooa All Rights Reserved.\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"\",\"version\":\"2.4.8\",\"description\":\"\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10012, 10015, 'Gridbox - Search', 'plugin', 'gridbox', 'search', 0, 1, 1, 0, '{\"name\":\"Gridbox - Search\",\"type\":\"plugin\",\"creationDate\":\"01 May 2017\",\"author\":\"Balbooa\",\"copyright\":\"Balbooa 2017\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"http:\\/\\/balbooa.com\",\"version\":\"2.2.3\",\"description\":\"The plugin extends the default Joomla! search functionality to Gridbox Pages.\",\"group\":\"\",\"filename\":\"gridbox\"}', '{\"search_limit\":\"50\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10013, 10015, 'Gridbox - Smart Search', 'plugin', 'gridbox', 'finder', 0, 1, 1, 0, '{\"name\":\"Gridbox - Smart Search\",\"type\":\"plugin\",\"creationDate\":\"01 May 2017\",\"author\":\"Balbooa\",\"copyright\":\"Balbooa 2017\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"http:\\/\\/balbooa.com\",\"version\":\"2.2.3\",\"description\":\"Smart Search plugin for Gridbox.\",\"group\":\"\",\"filename\":\"gridbox\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10014, 10015, 'Gridbox - System', 'plugin', 'gridbox', 'system', 0, 1, 1, 0, '{\"name\":\"Gridbox - System\",\"type\":\"plugin\",\"creationDate\":\"06 April 2015\",\"author\":\"Balbooa\",\"copyright\":\"Balbooa 2016\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"http:\\/\\/balbooa.com\",\"version\":\"2.4.7\",\"description\":\"System plugin for Gridbox.\",\"group\":\"\",\"filename\":\"gridbox\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10015, 0, 'Gridbox', 'package', 'pkg_Gridbox', '', 0, 1, 1, 0, '{\"name\":\"Gridbox\",\"type\":\"package\",\"creationDate\":\"01 May 2017\",\"author\":\"Balbooa\",\"copyright\":\"Balbooa 2017\",\"authorEmail\":\"support@balbooa.com\",\"authorUrl\":\"http:\\/\\/balbooa.com\",\"version\":\"2.4.8\",\"description\":\"Gridbox is the easiest way to create a beautiful Joomla page. Creating website should be easy!\",\"group\":\"\",\"filename\":\"pkg_Gridbox\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10024, 0, 'com_iquix', 'component', 'com_iquix', '', 1, 1, 0, 0, '{\"name\":\"com_iquix\",\"type\":\"component\",\"creationDate\":\"11th April 2018\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) 2015. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"http:\\/\\/www.themexpert.com\",\"version\":\"1.2.0\",\"description\":\"Page builder for Joomla\",\"group\":\"\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10025, 0, 'com_quix', 'component', 'com_quix', '', 1, 1, 0, 0, '{\"name\":\"com_quix\",\"type\":\"component\",\"creationDate\":\"2017-07-16\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) 2015. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"http:\\/\\/www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"Page builder for Joomla\",\"group\":\"\",\"filename\":\"quix\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10026, 0, 'Quix Builder', 'library', 'quix', '', 0, 1, 1, 0, '{\"name\":\"Quix Builder\",\"type\":\"library\",\"creationDate\":\"2017-07-16\",\"author\":\"ThemeXpert\",\"copyright\":\"(C) 2010 - 2015 ThemeXpert. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"PKG_QUIX_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"quix\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10027, 0, 'mod_quix_menu', 'module', 'mod_quix_menu', '', 1, 1, 2, 0, '{\"name\":\"mod_quix_menu\",\"type\":\"module\",\"creationDate\":\"2015-12-03\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) themexpert. All rights reserved.\",\"authorEmail\":\"admin@themexpert.com\",\"authorUrl\":\"http:\\/\\/www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"MOD_QUIX_MENU_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_quix_menu\"}', '{\"show_quix_menu\":\"1\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10028, 0, 'mod_quix', 'module', 'mod_quix', '', 0, 1, 0, 0, '{\"name\":\"mod_quix\",\"type\":\"module\",\"creationDate\":\"2017-10-16\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) themexpert. All rights reserved.\",\"authorEmail\":\"admin@themexpert.com\",\"authorUrl\":\"http:\\/\\/www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"MOD_QUIX_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"mod_quix\"}', '{\"cache\":\"0\",\"cache_time\":\"0\",\"cachemode\":\"itemid\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10029, 0, 'Editors Button - Quix editors-xtd Plugin', 'plugin', 'quix', 'editors-xtd', 0, 1, 1, 0, '{\"name\":\"Editors Button - Quix editors-xtd Plugin\",\"type\":\"plugin\",\"creationDate\":\"2017-07-16\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) 2013 themexpert.com. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"Thank you for installing Quix editors-xtd Plugin.\",\"group\":\"\",\"filename\":\"quix\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 9999, 0),
(10030, 0, 'System - Quix System Plugin', 'plugin', 'quix', 'system', 0, 1, 1, 0, '{\"name\":\"System - Quix System Plugin\",\"type\":\"plugin\",\"creationDate\":\"2017-07-16\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) 2013 themexpert.com. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"www.themexpert.com\",\"version\":\"2.0.7\",\"description\":\"Thank you for installing Quix System Plugin.\",\"group\":\"\",\"filename\":\"quix\"}', '{\"load_global\":\"0\",\"init_wow\":\"1\",\"gantry_fix_offcanvas\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 9999, 0),
(10031, 0, 'plg_quickicon_quix', 'plugin', 'quix', 'quickicon', 0, 1, 1, 0, '{\"name\":\"plg_quickicon_quix\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"ThemeXpert\",\"copyright\":\"Copyright (C) 2005 - 2018 Open Source Matters. All rights reserved.\",\"authorEmail\":\"info@themexpert.com\",\"authorUrl\":\"www.themexpert.com\",\"version\":\"2.0.0\",\"description\":\"PLG_QUICKICON_QUIX_XML_DESCRIPTION\",\"group\":\"\",\"filename\":\"quix\"}', '{\"context\":\"mod_quickicon\"}', '', '', 0, '0000-00-00 00:00:00', 9999, 0),
(10032, 0, 'tx_morph', 'template', 'tx_morph', '', 0, 1, 1, 0, '{\"name\":\"tx_morph\",\"type\":\"template\",\"creationDate\":\"Nov 15, 2017\",\"author\":\"ThemeXpert.com\",\"copyright\":\"Copyright (C), 2017 ThemeXpert. All Rights Reserved.\",\"authorEmail\":\"support@themexpert.com\",\"authorUrl\":\"http:\\/\\/themexpert.com\\/\",\"version\":\"1.0\",\"description\":\"\\n\\t\\t\\n\\t\\t<div align=\\\"center\\\">\\n\\t\\t\\t<div class=\\\"alert alert-success\\\" style=\\\"background-color:#DFF0D8;border-color:#D6E9C6;color: #468847;padding: 1px 0;\\\">\\n\\t\\t\\t\\t<h3>Tx Morph<\\/h3>\\n\\t\\t\\t\\t<a href=\\\"index.php?option=com_templates\\\"><img src=\\\"http:\\/\\/morph.demo.themexpert.com\\/templates\\/tx_morph\\/template_preview.png\\\" alt=\\\"Joomla Template\\\" width=\\\"300\\\" height=\\\"99\\\"><\\/a>\\n\\t\\t\\t\\t<h4><a href=\\\"https:\\/\\/www.themexpert.com\\/joomla-templates\\/morph\\\" title=\\\"\\\">Home<\\/a> | <a href=\\\"http:\\/\\/demo.themexpert.com\\/joomla\\/morph\\\" title=\\\"\\\">Demo<\\/a> | <a href=\\\"https:\\/\\/www.themexpert.com\\/docs\\/joomla-templates\\/morph\\\" title=\\\"\\\">Documentation<\\/a><\\/h4>\\n\\t\\t\\t\\t<p> <\\/p>\\n\\t\\t\\t\\t<span style=\\\"color:#FF0000\\\">Note: Tx Morph requires T3 plugin to be installed and enabled.<\\/span><p><\\/p>\\n\\t\\t\\t\\t<p>Copyright 2004 - 2017 <a href=\'https:\\/\\/www.themexpert.com\' title=\'Visit ThemeXpert.com!\'>ThemeXpert.com<\\/a>.<\\/p>\\n\\t\\t\\t<\\/div>\\n\\t\\t\\t<style>table.adminform{width: 100%;}<\\/style>\\n\\t\\t<\\/div>\\n\\t\\t\\n\\t\",\"group\":\"\",\"filename\":\"templateDetails\"}', '{\"enable_preloader\":\"1\",\"go_to_top\":\"0\",\"addon_offcanvas_pos\":\"left\",\"fixed_footer\":\"0\",\"header_transparent\":\"0\",\"nav_sticky\":\"1\",\"header_variation\":\"default.php\",\"social_enable\":\"0\",\"box_layout\":\"0\",\"box_image_or_color\":\"bg_img\",\"box_layout_img\":\"\",\"box_layout_bg_color\":\"\",\"box_layout_width\":\"90%\",\"video_bg_enable\":\"0\",\"enable_copyright\":\"1\",\"copyright_text\":\"Copyright \\u00a9 2017 Joomla Template. All Rights Reserved. Design & Developed by <a href=\'https:\\/\\/www.themexpert.com\\/\' title=\'ThemeXpert\'>ThemeXpert<\\/a>\",\"tx_credit\":\"1\",\"custom_error_page\":\"0\",\"custom_comingsoon_page\":\"0\",\"enable_body_font\":\"0\",\"body_font\":\"\",\"enable_h1_font\":\"0\",\"h1_font\":\"\",\"enable_h2_font\":\"0\",\"h2_font\":\"\",\"enable_h3_font\":\"0\",\"h3_font\":\"\",\"enable_h4_font\":\"0\",\"h4_font\":\"\",\"enable_h5_font\":\"0\",\"h5_font\":\"\",\"enable_h6_font\":\"0\",\"h6_font\":\"\",\"enable_navigation_font\":\"0\",\"navigation_font\":\"\",\"show_post_format\":\"0\",\"show_comments\":\"0\",\"commenting_engine\":\"\",\"fb_width\":\"500\",\"fb_cpp\":\"10\",\"disqus_devmode\":\"0\",\"comments_count\":\"0\",\"social_share\":\"0\"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10034, 0, 'Regular Labs Library', 'library', 'regularlabs', '', 0, 1, 1, 0, '{\"name\":\"Regular Labs Library\",\"type\":\"library\",\"creationDate\":\"June 2018\",\"author\":\"Regular Labs (Peter van Westen)\",\"copyright\":\"Copyright \\u00a9 2018 Regular Labs - All Rights Reserved\",\"authorEmail\":\"info@regularlabs.com\",\"authorUrl\":\"https:\\/\\/www.regularlabs.com\",\"version\":\"18.6.10771\",\"description\":\"\",\"group\":\"\",\"filename\":\"regularlabs\"}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_fields`
--

DROP TABLE IF EXISTS `bt8w9_fields`;
CREATE TABLE IF NOT EXISTS `bt8w9_fields` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `context` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `default_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldparams` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_created_user_id` (`created_user_id`),
  KEY `idx_access` (`access`),
  KEY `idx_context` (`context`(191)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_fields_categories`
--

DROP TABLE IF EXISTS `bt8w9_fields_categories`;
CREATE TABLE IF NOT EXISTS `bt8w9_fields_categories` (
  `field_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`field_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_fields_groups`
--

DROP TABLE IF EXISTS `bt8w9_fields_groups`;
CREATE TABLE IF NOT EXISTS `bt8w9_fields_groups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `context` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_access` (`access`),
  KEY `idx_context` (`context`(191)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_fields_values`
--

DROP TABLE IF EXISTS `bt8w9_fields_values`;
CREATE TABLE IF NOT EXISTS `bt8w9_fields_values` (
  `field_id` int(10) UNSIGNED NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Allow references to items which have strings as ids, eg. none db systems.',
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `idx_field_id` (`field_id`),
  KEY `idx_item_id` (`item_id`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_filters`
--

DROP TABLE IF EXISTS `bt8w9_finder_filters`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_filters` (
  `filter_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links`
--

DROP TABLE IF EXISTS `bt8w9_finder_links`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links` (
  `link_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(400) DEFAULT NULL,
  `description` text,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double UNSIGNED NOT NULL DEFAULT '0',
  `sale_price` double UNSIGNED NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`(100)),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms0`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms0`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms0` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms1`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms1`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms1` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms2`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms2`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms2` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms3`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms3`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms3` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms4`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms4`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms4` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms5`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms5`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms5` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms6`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms6`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms6` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms7`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms7`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms7` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms8`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms8`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms8` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_terms9`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_terms9`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_terms9` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termsa`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termsa`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termsa` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termsb`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termsb`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termsb` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termsc`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termsc`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termsc` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termsd`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termsd`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termsd` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termse`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termse`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termse` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_links_termsf`
--

DROP TABLE IF EXISTS `bt8w9_finder_links_termsf`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_links_termsf` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_taxonomy`
--

DROP TABLE IF EXISTS `bt8w9_finder_taxonomy`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_taxonomy` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `access` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bt8w9_finder_taxonomy`
--

INSERT INTO `bt8w9_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_taxonomy_map`
--

DROP TABLE IF EXISTS `bt8w9_finder_taxonomy_map`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_taxonomy_map` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `node_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_terms`
--

DROP TABLE IF EXISTS `bt8w9_finder_terms`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_terms` (
  `term_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `weight` float UNSIGNED NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  `language` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_terms_common`
--

DROP TABLE IF EXISTS `bt8w9_finder_terms_common`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bt8w9_finder_terms_common`
--

INSERT INTO `bt8w9_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('any', 'en'),
('are', 'en'),
('aren\'t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn\'t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_tokens`
--

DROP TABLE IF EXISTS `bt8w9_finder_tokens`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `weight` float UNSIGNED NOT NULL DEFAULT '1',
  `context` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `language` char(3) NOT NULL DEFAULT '',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_tokens_aggregate`
--

DROP TABLE IF EXISTS `bt8w9_finder_tokens_aggregate`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_tokens_aggregate` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `term_weight` float UNSIGNED NOT NULL,
  `context` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `context_weight` float UNSIGNED NOT NULL,
  `total_weight` float UNSIGNED NOT NULL,
  `language` char(3) NOT NULL DEFAULT '',
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_finder_types`
--

DROP TABLE IF EXISTS `bt8w9_finder_types`;
CREATE TABLE IF NOT EXISTS `bt8w9_finder_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_api`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_api`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_api`
--

INSERT INTO `bt8w9_gridbox_api` (`id`, `service`, `key`) VALUES
(1, 'google_maps', ''),
(2, 'library_font', '[]'),
(3, 'user_colors', '{\"0\":\"#eb523c\",\"1\":\"#f65954\",\"2\":\"#ec821a\",\"3\":\"#f5c500\",\"4\":\"#34dca2\",\"5\":\"#20364c\",\"6\":\"#32495f\",\"7\":\"#0075a9\",\"8\":\"#1996dd\",\"9\":\"#6cc6fa\"}'),
(4, 'balbooa', '{}'),
(5, 'sidebar_tour', 'false'),
(6, 'rate_gridbox', '1531527393'),
(7, 'editor_tour', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_app`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_app`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `theme` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `page_layout` mediumtext NOT NULL,
  `page_items` mediumtext NOT NULL,
  `page_fonts` text NOT NULL,
  `app_fonts` text NOT NULL,
  `app_layout` mediumtext NOT NULL,
  `app_items` mediumtext NOT NULL,
  `saved_time` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `access` tinyint(1) NOT NULL DEFAULT '1',
  `language` varchar(255) NOT NULL DEFAULT '*',
  `image` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `order_list` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_app`
--

INSERT INTO `bt8w9_gridbox_app` (`id`, `title`, `alias`, `theme`, `type`, `page_layout`, `page_items`, `page_fonts`, `app_fonts`, `app_layout`, `app_items`, `saved_time`, `published`, `access`, `language`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `order_list`) VALUES
(1, 'TAGS', '', 0, 'tags', '', '', '', '', '', '', '', 1, 1, '*', '', '', '', '', 50);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_categories`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_categories`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `access` tinyint(1) NOT NULL DEFAULT '1',
  `app_id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT '*',
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `order_list` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_filter_state`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_filter_state`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_filter_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_fonts`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_fonts`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_fonts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `font` varchar(255) NOT NULL,
  `styles` varchar(255) NOT NULL,
  `custom_src` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_fonts`
--

INSERT INTO `bt8w9_gridbox_fonts` (`id`, `font`, `styles`, `custom_src`) VALUES
(1, 'Open+Sans', '300', ''),
(2, 'Open+Sans', '400', ''),
(3, 'Open+Sans', '700', ''),
(4, 'Poppins', '300', ''),
(5, 'Poppins', '400', ''),
(6, 'Poppins', '500', ''),
(7, 'Poppins', '600', ''),
(8, 'Poppins', '700', ''),
(9, 'Roboto', '300', ''),
(10, 'Roboto', '400', ''),
(11, 'Roboto', '500', ''),
(12, 'Roboto', '700', ''),
(13, 'Roboto', '900', ''),
(14, 'Lato', '300', ''),
(15, 'Lato', '400', ''),
(16, 'Lato', '700', ''),
(17, 'Slabo+27px', '400', ''),
(18, 'Oswald', '300', ''),
(19, 'Oswald', '400', ''),
(20, 'Oswald', '600', ''),
(21, 'Roboto+Condensed', '300', ''),
(22, 'Roboto+Condensed', '400', ''),
(23, 'Roboto+Condensed', '700', ''),
(24, 'PT+Sans', '400', ''),
(25, 'PT+Sans', '700', ''),
(26, 'Montserrat', '200', ''),
(27, 'Montserrat', '300', ''),
(28, 'Montserrat', '400', ''),
(29, 'Montserrat', '700', ''),
(30, 'Playfair+Display', '400', ''),
(31, 'Playfair+Display', '700', ''),
(32, 'Comfortaa', '300', ''),
(33, 'Comfortaa', '400', ''),
(34, 'Comfortaa', '700', '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_instagram`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_instagram`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_instagram` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` varchar(255) NOT NULL,
  `accessToken` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `images` mediumtext NOT NULL,
  `saved_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_library`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_library`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `item` mediumtext NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'section',
  `global_item` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_pages`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_pages`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `params` mediumtext NOT NULL,
  `style` mediumtext NOT NULL,
  `fonts` text NOT NULL,
  `intro_image` varchar(255) NOT NULL,
  `page_alias` varchar(255) NOT NULL,
  `page_category` varchar(255) NOT NULL,
  `page_access` int(11) NOT NULL DEFAULT '1',
  `intro_text` mediumtext NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_publishing` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `language` varchar(255) NOT NULL DEFAULT '*',
  `app_id` int(11) NOT NULL DEFAULT '0',
  `saved_time` varchar(255) NOT NULL DEFAULT '',
  `order_list` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_pages`
--

INSERT INTO `bt8w9_gridbox_pages` (`id`, `title`, `theme`, `meta_title`, `meta_description`, `meta_keywords`, `published`, `params`, `style`, `fonts`, `intro_image`, `page_alias`, `page_category`, `page_access`, `intro_text`, `image_alt`, `created`, `end_publishing`, `hits`, `language`, `app_id`, `saved_time`, `order_list`) VALUES
(1, 'Home', '10', '', '', '', 1, '<div class=\"ba-wrapper\">\n    <div class=\"ba-section row-fluid\" id=\"item-15313117080\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\" style=\"\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Section                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-plus-circle add-columns\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        New Row                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-globe add-library\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Add to Library                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Section                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"ba-section-items\">\n<div class=\"ba-row-wrapper ba-container\">\n    <div class=\"ba-row row-fluid\" id=\"item-15313117081\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\" style=\"\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Row                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-graphic-eq modify-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Modify Columns</span></span><span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Row                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"column-wrapper\">\n            <div class=\"span4 ba-grid-column-wrapper\" data-span=\"4\">\n                <div class=\"ba-grid-column column-content-align-middle\" id=\"item-15313117082\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\" style=\"\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span><span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-sort-amount-desc add-columns-in-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Nested Row</span></span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"ba-item-button ba-item\" id=\"item-15313122350\">\n	<div class=\"ba-button-wrapper\">\n        <a class=\"ba-btn-transition\" onclick=\"return false;\" href=\"/softdev/\">\n            <span>Accounts</span>\n        <i class=\"zmdi zmdi-account-box-o \"></i></a>\n    </div>\n	<div class=\"ba-edit-item\" style=\"\">\n        <span class=\"ba-edit-wrapper edit-settings\">\n            <i class=\"zmdi zmdi-settings\"></i>\n            <span class=\"ba-tooltip tooltip-delay\">\n                Item            </span>\n        </span>\n        <div class=\"ba-buttons-wrapper\">\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Edit                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-copy copy-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Copy                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-globe add-library\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Add to Library                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-delete delete-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Delete                </span>\n            </span>\n            <span class=\"ba-edit-text\">\n                Item            </span>\n        </div>\n    </div>\n    <div class=\"ba-box-model\">\n        \n    </div>\n</div>\n<div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 4                    </div>\n                </div>\n            </div>\n            <div class=\"ba-column-resizer\">\n                <span>\n                    <i class=\"zmdi zmdi-more-vert\"></i>\n                </span>\n            </div>\n            <div class=\"span4 ba-grid-column-wrapper\" data-span=\"4\">\n                <div class=\"ba-grid-column column-content-align-middle\" id=\"item-15313117083\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\" style=\"\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span><span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-sort-amount-desc add-columns-in-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Nested Row</span></span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"ba-item-button ba-item\" id=\"item-15313122400\">\n	<div class=\"ba-button-wrapper\">\n        <a class=\"ba-btn-transition\" onclick=\"return false;\" href=\"/softdev/\">\n            <span>items</span>\n        <i class=\"fa fa-mobile-phone\"></i></a>\n    </div>\n	<div class=\"ba-edit-item\" style=\"\">\n        <span class=\"ba-edit-wrapper edit-settings\">\n            <i class=\"zmdi zmdi-settings\"></i>\n            <span class=\"ba-tooltip tooltip-delay\">\n                Item            </span>\n        </span>\n        <div class=\"ba-buttons-wrapper\">\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Edit                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-copy copy-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Copy                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-globe add-library\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Add to Library                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-delete delete-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Delete                </span>\n            </span>\n            <span class=\"ba-edit-text\">\n                Item            </span>\n        </div>\n    </div>\n    <div class=\"ba-box-model\">\n        \n    </div>\n</div>\n<div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 4                    </div>\n                </div>\n            </div>\n            <div class=\"ba-column-resizer\">\n                <span>\n                    <i class=\"zmdi zmdi-more-vert\"></i>\n                </span>\n            </div>\n            <div class=\"span4 ba-grid-column-wrapper\" data-span=\"4\">\n                <div class=\"ba-grid-column column-content-align-middle\" id=\"item-15313117084\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\" style=\"\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span><span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-sort-amount-desc add-columns-in-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Nested Row</span></span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"ba-item-button ba-item\" id=\"item-15313122450\">\n	<div class=\"ba-button-wrapper\">\n        <a class=\"ba-btn-transition\" onclick=\"return false;\" href=\"/softdev/\">\n            <span>V-Items</span>\n        <i class=\"fa fa-steam-square\"></i></a>\n    </div>\n	<div class=\"ba-edit-item\" style=\"\">\n        <span class=\"ba-edit-wrapper edit-settings\">\n            <i class=\"zmdi zmdi-settings\"></i>\n            <span class=\"ba-tooltip tooltip-delay\">\n                Item            </span>\n        </span>\n        <div class=\"ba-buttons-wrapper\">\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Edit                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-copy copy-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Copy                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-globe add-library\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Add to Library                </span>\n            </span>\n            <span class=\"ba-edit-wrapper\">\n                <i class=\"zmdi zmdi-delete delete-item\"></i>\n                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                    Delete                </span>\n            </span>\n            <span class=\"ba-edit-text\">\n                Item            </span>\n        </div>\n    </div>\n    <div class=\"ba-box-model\">\n        \n    </div>\n</div>\n<div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 4                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n        </div>\n    </div>\n</div>', '{\"item-15313117080\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"100\",\"left\":\"0\",\"right\":\"0\",\"top\":\"100\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"gradient\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":true},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{\"padding\":{\"bottom\":\"25\",\"left\":\"25\",\"right\":\"25\",\"top\":\"25\"},\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.5,\"type\":\"mousemove\"},\"shape\":{\"type\":\"color\",\"color\":\"#000000\",\"value\":\"50\",\"effect\":\"\",\"image\":{\"attachment\":\"fixed\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"}},\"type\":\"section\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1},\"item-15313117081\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":false},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"view\":{\"gutter\":true},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.3},\"type\":\"row\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{}},\"item-15313117082\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"content\":{\"align\":\"\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1,\"type\":\"mousemove\"},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1},\"item-15313117083\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"content\":{\"align\":\"\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{}},\"item-15313117084\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"content\":{\"align\":\"\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{}},\"item-15313122350\":{\"desktop\":{\"border\":{\"color\":\"@border\",\"radius\":\"50\",\"style\":\"solid\",\"width\":\"0\"},\"typography\":{\"font-family\":\"@default\",\"font-size\":10,\"font-style\":\"normal\",\"font-weight\":\"700\",\"letter-spacing\":4,\"line-height\":26,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"uppercase\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"20\",\"left\":\"80\",\"right\":\"80\",\"top\":\"20\"},\"icons\":{\"size\":24},\"normal\":{\"color\":\"@title-inverse\",\"background-color\":\"@primary\"},\"disable\":\"0\",\"shadow\":{\"value\":\"0\",\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"icon\":{\"icon\":\"\",\"position\":\"\"},\"position\":\"top\",\"link\":{\"link\":\"\",\"target\":\"_self\",\"type\":\"\"},\"hover\":{\"color\":\"@title-inverse\",\"background-color\":\"@hover\"},\"type\":\"button\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1},\"item-15313122400\":{\"desktop\":{\"border\":{\"color\":\"@border\",\"radius\":\"50\",\"style\":\"solid\",\"width\":\"0\"},\"typography\":{\"font-family\":\"@default\",\"font-size\":10,\"font-style\":\"normal\",\"font-weight\":\"700\",\"letter-spacing\":4,\"line-height\":26,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"uppercase\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"20\",\"left\":\"80\",\"right\":\"80\",\"top\":\"20\"},\"icons\":{\"size\":24},\"normal\":{\"color\":\"@title-inverse\",\"background-color\":\"@primary\"},\"disable\":\"0\",\"shadow\":{\"value\":\"0\",\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"icon\":{\"icon\":\"\",\"position\":\"\"},\"position\":\"top\",\"link\":{\"link\":\"\",\"target\":\"_self\",\"type\":\"\"},\"hover\":{\"color\":\"@title-inverse\",\"background-color\":\"@hover\"},\"type\":\"button\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1},\"item-15313122450\":{\"desktop\":{\"border\":{\"color\":\"@border\",\"radius\":\"50\",\"style\":\"solid\",\"width\":\"0\"},\"typography\":{\"font-family\":\"@default\",\"font-size\":10,\"font-style\":\"normal\",\"font-weight\":\"700\",\"letter-spacing\":4,\"line-height\":26,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"uppercase\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"20\",\"left\":\"80\",\"right\":\"80\",\"top\":\"20\"},\"icons\":{\"size\":24},\"normal\":{\"color\":\"@title-inverse\",\"background-color\":\"@primary\"},\"disable\":\"0\",\"shadow\":{\"value\":\"0\",\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"icon\":{\"icon\":\"\",\"position\":\"\"},\"position\":\"top\",\"link\":{\"link\":\"\",\"target\":\"_self\",\"type\":\"\"},\"hover\":{\"color\":\"@title-inverse\",\"background-color\":\"@hover\"},\"type\":\"button\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1}}', '{\"Roboto\":[\"700\"]}', '', 'home', '', 1, '', '', '2018-07-11 00:29:18', '0000-00-00 00:00:00', 49, '*', 0, '13.26.18', 1),
(2, 'About', '10', '', '', '', 0, '<div class=\"ba-wrapper\">\n    <div class=\"ba-section row-fluid\" id=\"item-15312749140\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Section                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-plus-circle add-columns\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        New Row                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-globe add-library\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Add to Library                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Section                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"ba-section-items\">\n<div class=\"ba-row-wrapper ba-container\">\n    <div class=\"ba-row row-fluid\" id=\"item-15312749141\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Row                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Row                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"column-wrapper\">\n            <div class=\"span12 ba-grid-column-wrapper\" data-span=\"12\">\n                <div class=\"ba-grid-column column-content-align-middle\" id=\"item-15312749142\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 12                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n        </div>\n    </div>\n</div>\n', '{\"item-15312749140\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"100\",\"left\":\"0\",\"right\":\"0\",\"top\":\"100\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":true},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"padding\":{\"bottom\":\"25\",\"left\":\"25\",\"right\":\"25\",\"top\":\"25\"},\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.5},\"shape\":{\"type\":\"color\",\"color\":\"#000000\",\"value\":\"50\",\"effect\":\"\",\"image\":{\"attachment\":\"fixed\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"}},\"type\":\"section\",\"access\":1,\"suffix\":\"\"},\"item-15312749141\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":false},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"view\":{\"gutter\":true},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.3},\"type\":\"row\",\"access\":1,\"suffix\":\"\"},\"item-15312749142\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"content\":{\"align\":\"\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\"}}', '[]', '', 'about', 'trashed', 1, '', '', '2018-07-11 02:08:34', '0000-00-00 00:00:00', 0, '*', 0, '02.08.37', 2),
(3, 'About', '10', '', '', '', 0, '<div class=\"ba-wrapper\">\n    <div class=\"ba-section row-fluid\" id=\"item-15312837770\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Section                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-plus-circle add-columns\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        New Row                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-globe add-library\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Add to Library                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Section                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"ba-section-items\">\n<div class=\"ba-row-wrapper ba-container\">\n    <div class=\"ba-row row-fluid\" id=\"item-15312837771\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Row                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Row                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"column-wrapper\">\n            <div class=\"span12 ba-grid-column-wrapper\" data-span=\"12\">\n                <div class=\"ba-grid-column column-content-align-middle\" id=\"item-15312837772\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 12                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n        </div>\n    </div>\n</div>\n', '{\"item-15312837770\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"100\",\"left\":\"0\",\"right\":\"0\",\"top\":\"100\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":true},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"padding\":{\"bottom\":\"25\",\"left\":\"25\",\"right\":\"25\",\"top\":\"25\"},\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.5},\"shape\":{\"type\":\"color\",\"color\":\"#000000\",\"value\":\"50\",\"effect\":\"\",\"image\":{\"attachment\":\"fixed\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"}},\"type\":\"section\",\"access\":1,\"suffix\":\"\"},\"item-15312837771\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false,\"fullwidth\":false},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"view\":{\"gutter\":true},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.3},\"type\":\"row\",\"access\":1,\"suffix\":\"\"},\"item-15312837772\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":50}},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\"},\"image\":{\"image\":\"\"},\"full\":{\"fullscreen\":false},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"content\":{\"align\":\"\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\"}}', '[]', '', 'about-2', 'trashed', 1, '', '', '2018-07-11 04:36:17', '0000-00-00 00:00:00', 0, '*', 0, '04.36.20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_page_blocks`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_page_blocks`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_page_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `item` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_plugins`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_plugins`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `joomla_constant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_plugins`
--

INSERT INTO `bt8w9_gridbox_plugins` (`id`, `title`, `image`, `type`, `joomla_constant`) VALUES
(1, 'ba-image', 'flaticon-picture', 'content', 'IMAGE'),
(2, 'ba-text', 'flaticon-file', 'content', 'TEXT'),
(3, 'ba-button', 'plugins-button', 'content', 'BUTTON'),
(4, 'ba-logo', 'flaticon-diamond', 'navigation', 'LOGO'),
(5, 'ba-menu', 'flaticon-app', 'navigation', 'MENU'),
(6, 'ba-modules', 'plugins-modules', '3rd-party-plugins', 'JOOMLA_MODULES'),
(7, 'ba-forms', 'plugins-forms', '3rd-party-plugins', 'BALBOOA_FORMS'),
(8, 'ba-gallery', 'plugins-gallery', '3rd-party-plugins', 'BALBOOA_GALLERY');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_star_ratings`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_star_ratings`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_star_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` varchar(255) NOT NULL,
  `option` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_star_ratings_users`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_star_ratings_users`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_star_ratings_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` varchar(255) NOT NULL,
  `option` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_system_pages`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_system_pages`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_system_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `html` mediumtext NOT NULL,
  `items` mediumtext NOT NULL,
  `fonts` text NOT NULL,
  `saved_time` varchar(255) NOT NULL DEFAULT '',
  `order_list` int(11) NOT NULL DEFAULT '0',
  `page_options` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_system_pages`
--

INSERT INTO `bt8w9_gridbox_system_pages` (`id`, `title`, `type`, `theme`, `html`, `items`, `fonts`, `saved_time`, `order_list`, `page_options`) VALUES
(1, '404 Error Page', '404', '10', '<div class=\"ba-wrapper\">\n    <div class=\"ba-section row-with-intro-items row-fluid visible\" id=\"item-15289771300\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Section                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-plus-circle add-columns\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        New Row                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-globe add-library\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Add to Library                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Section                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"ba-section-items\">\n<div class=\"ba-row-wrapper ba-container\">\n    <div class=\"ba-row row-with-intro-items row-fluid visible\" id=\"item-15289771301\">\n        <div class=\"ba-overlay\"></div>\n        <div class=\"ba-edit-item\">\n            <span class=\"ba-edit-wrapper edit-settings\">\n                <i class=\"zmdi zmdi-settings\"></i>\n                <span class=\"ba-tooltip tooltip-delay\">\n                    Row                </span>\n            </span>\n            <div class=\"ba-buttons-wrapper\">\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Edit                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-copy copy-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Copy                    </span>\n                </span>\n                <span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-graphic-eq modify-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Modify Columns</span></span><span class=\"ba-edit-wrapper\">\n                    <i class=\"zmdi zmdi-delete delete-item\"></i>\n                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                        Delete                    </span>\n                </span>\n                <span class=\"ba-edit-text\">\n                    Row                </span>\n            </div>\n        </div>\n        <div class=\"ba-box-model\">\n            <div class=\"ba-bm-top\"></div>\n            <div class=\"ba-bm-left\"></div>\n            <div class=\"ba-bm-bottom\"></div>\n            <div class=\"ba-bm-right\"></div>\n        </div>\n        <div class=\"column-wrapper\">\n            <div class=\"span12 ba-grid-column-wrapper\" data-span=\"12\">\n                <div class=\"ba-grid-column column-content-align-middle visible\" id=\"item-15289771302\">\n                    <div class=\"ba-overlay\"></div>\n                    <div class=\"ba-edit-item\">\n                        <div class=\"ba-buttons-wrapper\">\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-plus-circle add-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Add new element                                </span>\n                            </span>\n                            <span class=\"ba-edit-wrapper\">\n                                <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                    Edit                                </span>\n                            </span><span class=\"ba-edit-wrapper\"><i class=\"zmdi zmdi-sort-amount-desc add-columns-in-columns\"></i><span class=\"ba-tooltip tooltip-delay settings-tooltip\">Nested Row</span></span>\n                        </div>\n                    </div>\n                    <div class=\"ba-box-model\">\n                        <div class=\"ba-bm-top\"></div>\n                        <div class=\"ba-bm-left\"></div>\n                        <div class=\"ba-bm-bottom\"></div>\n                        <div class=\"ba-bm-right\"></div>\n                    </div>\n                    <div class=\"ba-item-error-message ba-item\" id=\"item-15289771380\">\n                        <div class=\"error-message-wrapper\">\n                            <h1 class=\"ba-error-code\">404</h1>\n                            <p class=\"ba-error-message\">Page not found</p>\n                        </div>\n                        <div class=\"ba-edit-item\">\n                            <span class=\"ba-edit-wrapper edit-settings\">\n                            <i class=\"zmdi zmdi-settings\"></i>\n                            <span class=\"ba-tooltip tooltip-delay\">\n                                Item            </span>\n                            </span>\n                            <div class=\"ba-buttons-wrapper\">\n                                <span class=\"ba-edit-wrapper\">\n                                    <i class=\"zmdi zmdi-edit edit-item\"></i>\n                                    <span class=\"ba-tooltip tooltip-delay settings-tooltip\">\n                                        Edit                </span>\n                                </span>\n                                <span class=\"ba-edit-text\">\n                                    Item            </span>\n                            </div>\n                        </div>\n                        <div class=\"ba-box-model\">\n                            <div class=\"ba-bm-top\"></div>\n                            <div class=\"ba-bm-left\"></div>\n                            <div class=\"ba-bm-bottom\"></div>\n                            <div class=\"ba-bm-right\"></div>\n                        </div>\n                    </div>\n                    <div class=\"empty-item\">\n                        <span>\n                            <i class=\"zmdi zmdi-layers\"></i>\n                            <span class=\"ba-tooltip add-section-tooltip\">\n                                Add new element                            </span>\n                        </span>\n                    </div>\n                    <div class=\"column-info\">\n                        Span 12                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n        </div>\n    </div>\n</div>', '{\n    \"item-15289771300\":{\n        \"desktop\":{\n            \"animation\":{\n                \"duration\":\"0.9\",\n                \"delay\":\"0\",\n                \"effect\":\"\"\n            },\n            \"border\":{\n                \"bottom\":\"0\",\n                \"color\":\"@border\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"style\":\"solid\",\n                \"radius\":0,\n                \"top\":\"0\",\n                \"width\":\"1\"\n            },\n            \"margin\":{\n                \"bottom\":\"0\",\n                \"top\":\"0\"\n            },\n            \"padding\":{\n                \"bottom\":\"100\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"top\":\"100\"\n            },\n            \"shape\":{\n                \"top\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                },\n                \"bottom\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                }\n            },\n            \"background\":{\n                \"type\":\"color\",\n                \"color\":\"@accent\",\n                \"image\":{\n                    \"attachment\":\"scroll\",\n                    \"image\":\"\",\n                    \"position\":\"center center\",\n                    \"repeat\":\"no-repeat\",\n                    \"size\":\"cover\"\n                },\n                \"video\":{\n                    \"type\":\"youtube\",\n                    \"id\":\"\",\n                    \"mute\":\"1\",\n                    \"start\":\"0\",\n                    \"quality\":\"hd720\",\n                    \"image\":\"\"\n                }\n            },\n            \"image\":{\n                \"image\":\"\"\n            },\n            \"full\":{\n                \"fullscreen\":true,\n                \"fullwidth\":true\n            },\n            \"overlay\":{\n                \"color\":\"rgba(0, 0, 0, 0)\"\n            },\n            \"disable\":\"0\",\n            \"shadow\":{\n                \"value\":0,\n                \"color\":\"@shadow\"\n            }\n        },\n        \"tablet\":{\n            \"padding\":{\n                \"bottom\":\"25\",\n                \"left\":\"25\",\n                \"right\":\"25\",\n                \"top\":\"25\"\n            },\n            \"disable\":\"0\"\n        },\n        \"phone\":{\n            \"disable\":\"0\"\n        },\n        \"parallax\":{\n            \"enable\":false,\n            \"invert\":false,\n            \"offset\":0.5\n        },\n        \"shape\":{\n            \"type\":\"color\",\n            \"color\":\"#000000\",\n            \"value\":\"50\",\n            \"effect\":\"\",\n            \"image\":{\n                \"attachment\":\"fixed\",\n                \"image\":\"\",\n                \"position\":\"center center\",\n                \"repeat\":\"no-repeat\",\n                \"size\":\"cover\"\n            }\n        },\n        \"type\":\"section\",\n        \"access\":1,\n        \"suffix\":\"\",\n        \"presets\":\"\",\n        \"tablet-portrait\":{},\n        \"phone-portrait\":{}\n    },\n    \"item-15289771301\":{\n        \"desktop\":{\n            \"animation\":{\n                \"duration\":\"0.9\",\n                \"delay\":\"0\",\n                \"effect\":\"\"\n            },\n            \"border\":{\n                \"bottom\":\"0\",\n                \"color\":\"@border\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"style\":\"solid\",\n                \"radius\":0,\n                \"top\":\"0\",\n                \"width\":\"1\"\n            },\n            \"margin\":{\n                \"bottom\":\"25\",\n                \"top\":\"25\"\n            },\n            \"padding\":{\n                \"bottom\":\"0\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"top\":\"0\"\n            },\n            \"shape\":{\n                \"top\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                },\n                \"bottom\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                }\n            },\n            \"image\":{\n                \"image\":\"\"\n            },\n            \"full\":{\n                \"fullscreen\":false,\n                \"fullwidth\":false\n            },\n            \"background\":{\n                \"type\":\"none\",\n                \"color\":\"@bg-primary\",\n                \"image\":{\n                    \"attachment\":\"scroll\",\n                    \"image\":\"\",\n                    \"position\":\"center center\",\n                    \"repeat\":\"no-repeat\",\n                    \"size\":\"cover\"\n                },\n                \"video\":{\n                    \"type\":\"youtube\",\n                    \"id\":\"\",\n                    \"mute\":\"1\",\n                    \"start\":\"0\",\n                    \"quality\":\"hd720\",\n                    \"image\":\"\"\n                }\n            },\n            \"overlay\":{\n                \"color\":\"rgba(0, 0, 0, 0)\"\n            },\n            \"view\":{\n                \"gutter\":true\n            },\n            \"disable\":\"0\",\n            \"shadow\":{\n                \"value\":0,\n                \"color\":\"@shadow\"\n            }\n        },\n        \"tablet\":{\n            \"disable\":\"0\"\n        },\n        \"phone\":{\n            \"disable\":\"0\"\n        },\n        \"parallax\":{\n            \"enable\":false,\n            \"invert\":false,\n            \"offset\":0.3\n        },\n        \"type\":\"row\",\n        \"access\":1,\n        \"suffix\":\"\",\n        \"presets\":\"\",\n        \"tablet-portrait\":{},\n        \"phone-portrait\":{}\n    },\n    \"item-15289771302\":{\n        \"desktop\":{\n            \"animation\":{\n                \"duration\":\"0.9\",\n                \"delay\":\"0\",\n                \"effect\":\"\"\n            },\n            \"border\":{\n                \"bottom\":\"0\",\n                \"color\":\"@border\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"style\":\"solid\",\n                \"radius\":0,\n                \"top\":\"0\",\n                \"width\":\"1\"\n            },\n            \"margin\":{\n                \"bottom\":\"0\",\n                \"top\":\"0\"\n            },\n            \"padding\":{\n                \"bottom\":\"0\",\n                \"left\":\"0\",\n                \"right\":\"0\",\n                \"top\":\"0\"\n            },\n            \"shape\":{\n                \"top\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                },\n                \"bottom\":{\n                    \"effect\":\"\",\n                    \"color\":\"@primary\",\n                    \"value\":50\n                }\n            },\n            \"background\":{\n                \"type\":\"none\",\n                \"color\":\"@bg-primary\",\n                \"image\":{\n                    \"attachment\":\"scroll\",\n                    \"image\":\"\",\n                    \"position\":\"center center\",\n                    \"repeat\":\"no-repeat\",\n                    \"size\":\"cover\"\n                },\n                \"video\":{\n                    \"type\":\"youtube\",\n                    \"id\":\"\",\n                    \"mute\":\"1\",\n                    \"start\":\"0\",\n                    \"quality\":\"hd720\",\n                    \"image\":\"\"\n                }\n            },\n            \"overlay\":{\n                \"color\":\"rgba(0, 0, 0, 0)\"\n            },\n            \"image\":{\n                \"image\":\"\"\n            },\n            \"full\":{\n                \"fullscreen\":false\n            },\n            \"disable\":\"0\",\n            \"shadow\":{\n                \"value\":0,\n                \"color\":\"@shadow\"\n            }\n        },\n        \"content\":{\n            \"align\":\"\"\n        },\n        \"tablet\":{\n            \"disable\":\"0\"\n        },\n        \"phone\":{\n            \"disable\":\"0\"\n        },\n        \"parallax\":{\n            \"enable\":false,\n            \"offset\":0.1\n        },\n        \"content_align\":\"column-content-align-middle\",\n        \"type\":\"column\",\n        \"access\":1,\n        \"suffix\":\"\",\n        \"presets\":\"\",\n        \"tablet-portrait\":{},\n        \"phone-portrait\":{}\n    },\n    \"item-15289771380\":{\n        \"desktop\":{\n            \"margin\":{\n                \"bottom\":\"0\",\n                \"top\":\"0\"\n            },\n            \"message\":{\n                \"typography\":{\n                    \"font-family\":\"@default\",\n                    \"font-weight\":\"500\",\n                    \"font-size\":\"14\",\n                    \"text-align\":\"center\",\n                    \"custom\":\"\",\n                    \"color\":\"@title-inverse\",\n                    \"letter-spacing\":\"2\",\n                    \"line-height\":\"18\",\n                    \"text-decoration\":\"none\",\n                    \"text-transform\":\"uppercase\",\n                    \"font-style\":\"normal\"\n                },\n                \"margin\":{\n                    \"bottom\":\"25\",\n                    \"top\":\"25\"\n                }\n            },\n            \"code\":{\n                \"typography\":{\n                    \"font-family\":\"@default\",\n                    \"font-weight\":\"700\",\n                    \"font-size\":\"156\",\n                    \"line-height\":\"156\",\n                    \"letter-spacing\":\"0\",\n                    \"custom\":\"\",\n                    \"color\":\"@title-inverse\",\n                    \"text-decoration\":\"none\",\n                    \"text-transform\":\"none\",\n                    \"font-style\":\"normal\",\n                    \"text-align\":\"center\"\n                },\n                \"margin\":{\n                    \"bottom\":\"25\",\n                    \"top\":\"25\"\n                }\n            },\n            \"view\":{\n                \"code\":true,\n                \"message\":true\n            },\n            \"disable\":\"0\"\n        },\n        \"tablet\":{\n            \"disable\":\"0\"\n        },\n        \"phone\":{\n            \"disable\":\"0\"\n        },\n        \"type\":\"error-message\",\n        \"access\":1,\n        \"suffix\":\"\",\n        \"presets\":\"\",\n        \"tablet-portrait\":{},\n        \"phone-portrait\":{},\n        \"access_view\":1\n    }\n}', '{\"Roboto\":[\"700\",\"500\"]}', '06.45.41', 1, '{\"enable_header\":false}');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_tags`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_tags`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `access` tinyint(1) NOT NULL DEFAULT '1',
  `language` varchar(255) NOT NULL DEFAULT '*',
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `order_list` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_tags_map`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_tags_map`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_tags_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_gridbox_website`
--

DROP TABLE IF EXISTS `bt8w9_gridbox_website`;
CREATE TABLE IF NOT EXISTS `bt8w9_gridbox_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `favicon` varchar(255) NOT NULL,
  `header_code` mediumtext NOT NULL,
  `body_code` mediumtext NOT NULL,
  `enable_autosave` varchar(255) NOT NULL DEFAULT 'false',
  `autosave_delay` varchar(255) NOT NULL DEFAULT '10',
  `breakpoints` text NOT NULL,
  `date_format` varchar(255) NOT NULL DEFAULT 'j F Y',
  `container` varchar(255) NOT NULL DEFAULT '1170',
  `disable_responsive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_gridbox_website`
--

INSERT INTO `bt8w9_gridbox_website` (`id`, `favicon`, `header_code`, `body_code`, `enable_autosave`, `autosave_delay`, `breakpoints`, `date_format`, `container`, `disable_responsive`) VALUES
(1, '', '', '', 'false', '10', '{\"tablet\":1024,\"tablet-portrait\":768,\"phone\":667,\"phone-portrait\":375,\"menuBreakpoint\":768}', 'j F Y', '1170', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_languages`
--

DROP TABLE IF EXISTS `bt8w9_languages`;
CREATE TABLE IF NOT EXISTS `bt8w9_languages` (
  `lang_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lang_code` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_native` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sef` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitename` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_languages`
--

INSERT INTO `bt8w9_languages` (`lang_id`, `asset_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 0, 'en-GB', 'English (en-GB)', 'English (United Kingdom)', 'en', 'en_gb', '', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_menu`
--

DROP TABLE IF EXISTS `bt8w9_menu`;
CREATE TABLE IF NOT EXISTS `bt8w9_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`(100),`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`(100)),
  KEY `idx_path` (`path`(100)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_menu`
--

INSERT INTO `bt8w9_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 103, 0, '*', 0),
(2, 'main', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 1, 1, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1),
(3, 'main', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 1, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1),
(4, 'main', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 1, 2, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1),
(5, 'main', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 1, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1),
(6, 'main', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 1, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1),
(7, 'main', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 1, 1, 1, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 19, 24, 0, '*', 1),
(8, 'main', 'com_contact_contacts', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 1, 7, 2, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 20, 21, 0, '*', 1),
(9, 'main', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 1, 7, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 22, 23, 0, '*', 1),
(10, 'main', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 1, 1, 1, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 25, 28, 0, '*', 1),
(11, 'main', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 1, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 26, 27, 0, '*', 1),
(13, 'main', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 1, 1, 1, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 29, 34, 0, '*', 1),
(14, 'main', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 1, 13, 2, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 30, 31, 0, '*', 1),
(15, 'main', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 1, 13, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 32, 33, 0, '*', 1),
(16, 'main', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 1, 1, 1, 24, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 35, 36, 0, '*', 1),
(17, 'main', 'com_search', 'Basic Search', '', 'Basic Search', 'index.php?option=com_search', 'component', 1, 1, 1, 19, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 37, 38, 0, '*', 1),
(18, 'main', 'com_finder', 'Smart Search', '', 'Smart Search', 'index.php?option=com_finder', 'component', 1, 1, 1, 27, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 39, 40, 0, '*', 1),
(19, 'main', 'com_joomlaupdate', 'Joomla! Update', '', 'Joomla! Update', 'index.php?option=com_joomlaupdate', 'component', 1, 1, 1, 28, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 41, 42, 0, '*', 1),
(20, 'main', 'com_tags', 'Tags', '', 'Tags', 'index.php?option=com_tags', 'component', 1, 1, 1, 29, 0, '0000-00-00 00:00:00', 0, 1, 'class:tags', 0, '', 43, 44, 0, '', 1),
(21, 'main', 'com_postinstall', 'Post-installation messages', '', 'Post-installation messages', 'index.php?option=com_postinstall', 'component', 1, 1, 1, 32, 0, '0000-00-00 00:00:00', 0, 1, 'class:postinstall', 0, '', 45, 46, 0, '*', 1),
(22, 'main', 'com_associations', 'Multilingual Associations', '', 'Multilingual Associations', 'index.php?option=com_associations', 'component', 1, 1, 1, 34, 0, '0000-00-00 00:00:00', 0, 0, 'class:associations', 0, '', 47, 48, 0, '*', 1),
(101, 'mainmenu', 'Home', 'home', '', 'home', 'index.php?option=com_gridbox&view=page&id=1', 'component', 1, 1, 1, 10010, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 11, 12, 1, '*', 0),
(102, '0Main Menu Blog', 'Blog', 'blog', '', 'blog', 'index.php?option=com_content&view=category&layout=blog&id=8', 'component', -2, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"layout_type\":\"blog\",\"show_category_title\":0,\"num_leading_articles\":4,\"num_intro_articles\":0,\"num_columns\":1,\"num_links\":2,\"multi_column_order\":1,\"orderby_sec\":\"rdate\",\"order_date\":\"published\",\"show_pagination\":2,\"show_pagination_results\":1,\"show_category\":0,\"info_bloc_position\":0,\"show_publish_date\":0,\"show_hits\":0,\"show_feed_link\":1,\"menu_text\":1,\"show_page_heading\":0,\"secure\":0}', 49, 50, 0, '*', 0),
(103, '0Main Menu Blog', 'About', 'about', '', 'about', 'index.php?option=com_content&view=article&id=13', 'component', -2, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"0\",\"info_block_show_title\":\"\",\"show_category\":\"0\",\"link_category\":\"0\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"0\",\"link_author\":\"\",\"show_create_date\":\"0\",\"show_modify_date\":\"\",\"show_publish_date\":\"0\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"0\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"0\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 51, 54, 0, '*', 0),
(104, '0Main Menu Blog', 'Register', 'register-sss', '', 'about/register-sss', 'index.php?option=com_users&view=registration', 'component', -2, 103, 2, 25, 857, '2018-07-09 06:38:14', 0, 1, ' ', 0, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"0\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 52, 53, 0, '*', 0),
(113, 'mainmenu', 'Register', 'register', '', 'register', 'index.php?option=com_users&view=login', 'component', -2, 1, 1, 25, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"loginredirectchoice\":\"1\",\"login_redirect_url\":\"\",\"login_redirect_menuitem\":\"\",\"logindescription_show\":\"1\",\"login_description\":\"\",\"login_image\":\"\",\"logoutredirectchoice\":\"1\",\"logout_redirect_url\":\"\",\"logout_redirect_menuitem\":\"\",\"logoutdescription_show\":\"1\",\"logout_description\":\"\",\"logout_image\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 55, 56, 0, '*', 0),
(114, 'mainmenu', 'Register', 'fsdfsd', '', 'fsdfsd', 'index.php?option=com_users&view=registration', 'component', 1, 1, 1, 25, 857, '2018-07-16 12:09:43', 0, 5, ' ', 0, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 17, 18, 0, '*', 0),
(115, 'mainmenu', 'About', 'sgs', '', 'sgs', 'index.php?option=com_quix&view=page&id=1', 'component', 1, 1, 1, 10025, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 13, 14, 0, '*', 0),
(116, 'main', 'COM_CREATIVECONTACTFORM_MENU', 'com-creativecontactform-menu', '', 'com-creativecontactform-menu', 'index.php?option=com_creativecontactform', 'component', 1, 1, 1, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_creativecontactform/assets/images/project_16.png', 0, '{}', 57, 68, 0, '', 1),
(117, 'main', 'COM_CREATIVECONTACTFORM_MENU_OVERVIEW', 'com-creativecontactform-menu-overview', '', 'com-creativecontactform-menu/com-creativecontactform-menu-overview', 'index.php?option=com_creativecontactform', 'component', 1, 116, 2, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 58, 59, 0, '', 1),
(118, 'main', 'COM_CREATIVECONTACTFORM_MENU_SUBMISSIONS', 'com-creativecontactform-menu-submissions', '', 'com-creativecontactform-menu/com-creativecontactform-menu-submissions', 'index.php?option=com_creativecontactform&view=submissions', 'component', 1, 116, 2, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 60, 61, 0, '', 1),
(119, 'main', 'COM_CREATIVECONTACTFORM_MENU_FORMS', 'com-creativecontactform-menu-forms', '', 'com-creativecontactform-menu/com-creativecontactform-menu-forms', 'index.php?option=com_creativecontactform&view=creativeforms', 'component', 1, 116, 2, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 62, 63, 0, '', 1),
(120, 'main', 'COM_CREATIVECONTACTFORM_MENU_FIELDS', 'com-creativecontactform-menu-fields', '', 'com-creativecontactform-menu/com-creativecontactform-menu-fields', 'index.php?option=com_creativecontactform&view=creativefields', 'component', 1, 116, 2, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 64, 65, 0, '', 1),
(121, 'main', 'COM_CREATIVECONTACTFORM_MENU_TEMPLATES', 'com-creativecontactform-menu-templates', '', 'com-creativecontactform-menu/com-creativecontactform-menu-templates', 'index.php?option=com_creativecontactform&view=templates', 'component', 1, 116, 2, 10006, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 66, 67, 0, '', 1),
(122, 'mainmenu', 'Contact Us', 'contact-us', '', 'contact-us', 'index.php?option=com_creativecontactform&view=creativecontactform&form=1', 'component', 1, 1, 1, 10006, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 15, 16, 0, '*', 0),
(123, 'mainmenu', 'Profile', 'profile', '', 'profile', 'index.php?option=com_users&view=profile', 'component', 1, 1, 1, 25, 0, '0000-00-00 00:00:00', 0, 2, ' ', 10, '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 69, 70, 0, '*', 0),
(124, 'main', 'GRIDBOX', 'gridbox', '', 'gridbox', 'index.php?option=com_gridbox', 'component', 1, 1, 1, 10010, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 71, 72, 0, '', 1),
(134, 'communitybuilder', 'CB Profile', 'cb-profile', '', 'cb-profile', 'index.php?option=com_comprofiler&view=userprofile', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 95, 96, 0, '*', 0),
(135, 'communitybuilder', 'CB Profile Edit', 'cb-profile-edit', '', 'cb-profile-edit', 'index.php?option=com_comprofiler&view=userdetails', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 93, 94, 0, '*', 0),
(136, 'communitybuilder', 'CB Registration', 'cb-registration', '', 'cb-registration', 'index.php?option=com_comprofiler&view=registers', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 91, 92, 0, '*', 0),
(137, 'communitybuilder', 'CB Login', 'cb-login', '', 'cb-login', 'index.php?option=com_comprofiler&view=login', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 89, 90, 0, '*', 0),
(138, 'communitybuilder', 'CB Logout', 'cb-logout', '', 'cb-logout', 'index.php?option=com_comprofiler&view=logout', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 87, 88, 0, '*', 0),
(139, 'communitybuilder', 'CB Forgot Login', 'cb-forgot-login', '', 'cb-forgot-login', 'index.php?option=com_comprofiler&view=lostpassword', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 85, 86, 0, '*', 0),
(140, 'communitybuilder', 'CB Userlist', 'cb-userlist', '', 'cb-userlist', 'index.php?option=com_comprofiler&view=userslist', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 83, 84, 0, '*', 0),
(141, 'communitybuilder', 'CB Manage Connections', 'cb-manage-connections', '', 'cb-manage-connections', 'index.php?option=com_comprofiler&view=manageconnections', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 81, 82, 0, '*', 0),
(142, 'communitybuilder', 'CB Moderate Bans', 'cb-moderate-bans', '', 'cb-moderate-bans', 'index.php?option=com_comprofiler&view=moderatebans', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 79, 80, 0, '*', 0),
(143, 'communitybuilder', 'CB Moderate Images', 'cb-moderate-images', '', 'cb-moderate-images', 'index.php?option=com_comprofiler&view=moderateimages', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 77, 78, 0, '*', 0),
(144, 'communitybuilder', 'CB Moderate Reports', 'cb-moderate-reports', '', 'cb-moderate-reports', 'index.php?option=com_comprofiler&view=moderatereports', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 75, 76, 0, '*', 0),
(145, 'communitybuilder', 'CB Moderate User Approvals', 'cb-moderate-user-approvals', '', 'cb-moderate-user-approvals', 'index.php?option=com_comprofiler&view=pendingapprovaluser', 'component', 1, 1, 1, 10018, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{}', 73, 74, 0, '*', 0),
(146, 'main', 'COM_QUIX', 'com-quix', '', 'com-quix', 'index.php?option=com_quix', 'component', 1, 1, 1, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 97, 98, 0, '', 1),
(147, 'mainmenu', 'Logout', 'logout', '', 'logout', 'index.php?option=com_users&view=login&layout=logout&task=user.menulogout', 'component', 1, 1, 1, 25, 857, '2018-07-16 12:10:40', 0, 2, ' ', 0, '{\"logout\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 99, 100, 0, '*', 0),
(148, 'mainmenu', 'Login', 'login', '', 'login', 'index.php?option=com_users&view=login', 'component', 1, 1, 1, 25, 857, '2018-07-16 12:10:41', 0, 5, ' ', 0, '{\"loginredirectchoice\":\"1\",\"login_redirect_url\":\"\",\"login_redirect_menuitem\":\"\",\"logindescription_show\":\"1\",\"login_description\":\"\",\"login_image\":\"\",\"logoutredirectchoice\":\"1\",\"logout_redirect_url\":\"\",\"logout_redirect_menuitem\":\"\",\"logoutdescription_show\":\"1\",\"logout_description\":\"\",\"logout_image\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}', 101, 102, 0, '*', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_menu_types`
--

DROP TABLE IF EXISTS `bt8w9_menu_types`;
CREATE TABLE IF NOT EXISTS `bt8w9_menu_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `menutype` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_menu_types`
--

INSERT INTO `bt8w9_menu_types` (`id`, `asset_id`, `menutype`, `title`, `description`, `client_id`) VALUES
(1, 0, 'mainmenu', 'Main Menu', 'The main menu for the site', 0),
(2, 64, '0Main Menu Blog', 'Main Menu Blog', 'The main menu for the site', 0),
(5, 98, 'communitybuilder', 'Community Builder', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_messages`
--

DROP TABLE IF EXISTS `bt8w9_messages`;
CREATE TABLE IF NOT EXISTS `bt8w9_messages` (
  `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id_to` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_messages_cfg`
--

DROP TABLE IF EXISTS `bt8w9_messages_cfg`;
CREATE TABLE IF NOT EXISTS `bt8w9_messages_cfg` (
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cfg_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_modules`
--

DROP TABLE IF EXISTS `bt8w9_modules`;
CREATE TABLE IF NOT EXISTS `bt8w9_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_modules`
--

INSERT INTO `bt8w9_modules` (`id`, `asset_id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(1, 39, 'Main Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 0, '{\"menutype\":\"mainmenu\",\"base\":\"\",\"startLevel\":\"1\",\"endLevel\":\"0\",\"showAllChildren\":\"1\",\"tag_id\":\"\",\"class_sfx\":\"\",\"window_open\":\"\",\"layout\":\"ostrainingbreeze:mainmenu\",\"moduleclass_sfx\":\"\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"itemid\",\"module_tag\":\"div\",\"bootstrap_size\":\"0\",\"header_tag\":\"h3\",\"header_class\":\"\",\"style\":\"0\"}', 0, '*'),
(2, 40, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 41, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{\"count\":\"5\",\"catid\":\"\",\"user_id\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}', 1, '*'),
(4, 42, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{\"count\":\"5\",\"ordering\":\"c_dsc\",\"catid\":\"\",\"user_id\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}', 1, '*'),
(8, 43, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 44, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 45, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{\"count\":\"5\",\"name\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}', 1, '*'),
(12, 46, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{\"layout\":\"\",\"moduleclass_sfx\":\"\",\"shownew\":\"1\",\"showhelp\":\"1\",\"cache\":\"0\"}', 1, '*'),
(13, 47, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 48, 'User Status', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 49, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(16, 50, 'Login Form', '', '', 7, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{\"pretext\":\"\",\"posttext\":\"\",\"login\":\"101\",\"logout\":\"101\",\"greeting\":\"1\",\"name\":\"0\",\"profilelink\":\"0\",\"usesecure\":\"0\",\"usetext\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"module_tag\":\"div\",\"bootstrap_size\":\"0\",\"header_tag\":\"h3\",\"header_class\":\"\",\"style\":\"0\"}', 0, '*'),
(17, 51, 'Breadcrumbs', '', '', 1, 'position-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 1, 1, '{\"moduleclass_sfx\":\"\",\"showHome\":\"1\",\"homeText\":\"\",\"showComponent\":\"1\",\"separator\":\"\",\"cache\":\"0\",\"cache_time\":\"0\",\"cachemode\":\"itemid\"}', 0, '*'),
(79, 52, 'Multilanguage status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}', 1, '*'),
(86, 53, 'Joomla Version', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{\"format\":\"short\",\"product\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}', 1, '*'),
(87, 55, 'Sample Data', '', '', 0, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_sampledata', 6, 1, '{}', 1, '*'),
(88, 67, 'Main Menu Blog', '', '', 1, 'position-1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 0, '{\"menutype\":\"0Main Menu Blog\",\"startLevel\":1,\"endLevel\":0,\"showAllChildren\":0,\"class_sfx\":\" nav-pills\",\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"itemid\",\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 0, '*'),
(90, 69, 'Syndication', '', '', 6, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_syndicate', 1, 0, '{\"display_text\":1,\"text\":\"My Blog\",\"format\":\"rss\",\"layout\":\"_:default\",\"cache\":0}', 0, '*'),
(91, 70, 'Archived Articles', '', '', 4, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_articles_archive', 1, 1, '{\"count\":10,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"static\"}', 0, '*'),
(92, 71, 'Most Read Posts', '', '', 5, 'position-7', 0, '0000-00-00 00:00:00', '2018-07-09 07:12:48', '0000-00-00 00:00:00', 0, 'mod_articles_popular', 1, 1, '{\"catid\":\"8\",\"count\":5,\"show_front\":1,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"static\"}', 0, '*'),
(93, 72, 'Older Posts', '', '', 2, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_articles_category', 1, 1, '{\"mode\":\"normal\",\"show_on_article_page\":0,\"show_front\":\"show\",\"count\":6,\"category_filtering_type\":1,\"catid\":\"8\",\"show_child_category_articles\":0,\"levels\":1,\"author_filtering_type\":1,\"author_alias_filtering_type\":1,\"date_filtering\":\"off\",\"date_field\":\"a.created\",\"relative_date\":30,\"article_ordering\":\"a.created\",\"article_ordering_direction\":\"DESC\",\"article_grouping\":\"none\",\"article_grouping_direction\":\"krsort\",\"month_year_format\":\"F Y\",\"item_heading\":5,\"link_titles\":1,\"show_date\":0,\"show_date_field\":\"created\",\"show_date_format\":\"Y-m-d H:i\",\"show_category\":0,\"show_hits\":0,\"show_author\":0,\"show_introtext\":0,\"introtext_limit\":100,\"show_readmore\":0,\"show_readmore_title\":1,\"readmore_limit\":15,\"layout\":\"_:default\",\"owncache\":1,\"cache_time\":900,\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 0, '*'),
(95, 74, 'Search', '', '', 1, 'position-0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_search', 1, 1, '{\"width\":20,\"button_pos\":\"right\",\"opensearch\":1,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"itemid\"}', 0, '*'),
(96, 75, 'Image', '', '<p><img src=\"images/headers/raindrops.jpg\" alt=\"\" /></p>', 1, 'position-3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{\"prepare_content\":1,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"static\",\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 0, '*'),
(97, 76, 'Popular Tags', '', '', 1, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_tags_popular', 1, 1, '{\"maximum\":8,\"timeframe\":\"alltime\",\"order_value\":\"count\",\"order_direction\":1,\"display_count\":0,\"no_results_text\":0,\"minsize\":1,\"maxsize\":2,\"layout\":\"_:default\",\"owncache\":1,\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 0, '*'),
(98, 77, 'Similar Items', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_tags_similar', 1, 1, '{\"maximum\":5,\"matchtype\":\"any\",\"layout\":\"_:default\",\"owncache\":1,\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 0, '*'),
(99, 78, 'Site Information', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_stats_admin', 6, 1, '{\"serverinfo\":1,\"siteinfo\":1,\"counter\":0,\"increase\":0,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"cachemode\":\"static\",\"module_tag\":\"div\",\"bootstrap_size\":6,\"header_tag\":\"h3\",\"style\":0}', 1, '*'),
(100, 79, 'Release News', '', '', 1, 'postinstall', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_feed', 1, 1, '{\"rssurl\":\"https:\\/\\/www.joomla.org\\/announcements\\/release-news.feed\",\"rssrtl\":0,\"rsstitle\":1,\"rssdesc\":1,\"rssimage\":1,\"rssitems\":3,\"rssitemdesc\":1,\"word_count\":0,\"layout\":\"_:default\",\"cache\":1,\"cache_time\":900,\"module_tag\":\"div\",\"bootstrap_size\":0,\"header_tag\":\"h3\",\"style\":0}', 1, '*'),
(101, 94, 'Creative Contact Form', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_creativecontactform', 1, 1, '', 0, '*'),
(109, 108, 'Administrator Quix Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quix_menu', 3, 1, '{\"show_quix_menu\":\"0\"}', 1, '*'),
(110, 109, 'Module - Quix', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_quix', 1, 1, '', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_modules_menu`
--

DROP TABLE IF EXISTS `bt8w9_modules_menu`;
CREATE TABLE IF NOT EXISTS `bt8w9_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_modules_menu`
--

INSERT INTO `bt8w9_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(79, 0),
(86, 0),
(87, 0),
(88, 0),
(89, 0),
(90, 0),
(91, 0),
(92, 0),
(93, 0),
(94, 0),
(95, 0),
(96, 0),
(97, 0),
(98, 0),
(99, 0),
(100, 0),
(109, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_newsfeeds`
--

DROP TABLE IF EXISTS `bt8w9_newsfeeds`;
CREATE TABLE IF NOT EXISTS `bt8w9_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `link` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `cache_time` int(10) UNSIGNED NOT NULL DEFAULT '3600',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_overrider`
--

DROP TABLE IF EXISTS `bt8w9_overrider`;
CREATE TABLE IF NOT EXISTS `bt8w9_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `string` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_postinstall_messages`
--

DROP TABLE IF EXISTS `bt8w9_postinstall_messages`;
CREATE TABLE IF NOT EXISTS `bt8w9_postinstall_messages` (
  `postinstall_message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `extension_id` bigint(20) NOT NULL DEFAULT '700' COMMENT 'FK to #__extensions',
  `title_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Lang key for the title',
  `description_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Lang key for description',
  `action_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `language_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'com_postinstall' COMMENT 'Extension holding lang keys',
  `language_client_id` tinyint(3) NOT NULL DEFAULT '1',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link' COMMENT 'Message type - message, link, action',
  `action_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'RAD URI to the PHP file containing action method',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Action method name or URL',
  `condition_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'RAD URI to file holding display condition method',
  `condition_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Display condition method, must return boolean',
  `version_introduced` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3.2.0' COMMENT 'Version when this message was introduced',
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`postinstall_message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_postinstall_messages`
--

INSERT INTO `bt8w9_postinstall_messages` (`postinstall_message_id`, `extension_id`, `title_key`, `description_key`, `action_key`, `language_extension`, `language_client_id`, `type`, `action_file`, `action`, `condition_file`, `condition_method`, `version_introduced`, `enabled`) VALUES
(1, 700, 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_TITLE', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_BODY', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_ACTION', 'plg_twofactorauth_totp', 1, 'action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_condition', '3.2.0', 1),
(2, 700, 'COM_CPANEL_WELCOME_BEGINNERS_TITLE', 'COM_CPANEL_WELCOME_BEGINNERS_MESSAGE', '', 'com_cpanel', 1, 'message', '', '', '', '', '3.2.0', 1),
(3, 700, 'COM_CPANEL_MSG_STATS_COLLECTION_TITLE', 'COM_CPANEL_MSG_STATS_COLLECTION_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/statscollection.php', 'admin_postinstall_statscollection_condition', '3.5.0', 1),
(4, 700, 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME', 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME_BODY', 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME_ACTION', 'plg_system_updatenotification', 1, 'action', 'site://plugins/system/updatenotification/postinstall/updatecachetime.php', 'updatecachetime_postinstall_action', 'site://plugins/system/updatenotification/postinstall/updatecachetime.php', 'updatecachetime_postinstall_condition', '3.6.3', 1),
(5, 700, 'COM_CPANEL_MSG_JOOMLA40_PRE_CHECKS_TITLE', 'COM_CPANEL_MSG_JOOMLA40_PRE_CHECKS_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/joomla40checks.php', 'admin_postinstall_joomla40checks_condition', '3.7.0', 1),
(6, 700, 'TPL_HATHOR_MESSAGE_POSTINSTALL_TITLE', 'TPL_HATHOR_MESSAGE_POSTINSTALL_BODY', 'TPL_HATHOR_MESSAGE_POSTINSTALL_ACTION', 'tpl_hathor', 1, 'action', 'admin://templates/hathor/postinstall/hathormessage.php', 'hathormessage_postinstall_action', 'admin://templates/hathor/postinstall/hathormessage.php', 'hathormessage_postinstall_condition', '3.7.0', 1),
(7, 700, 'PLG_PLG_RECAPTCHA_VERSION_1_POSTINSTALL_TITLE', 'PLG_PLG_RECAPTCHA_VERSION_1_POSTINSTALL_BODY', 'PLG_PLG_RECAPTCHA_VERSION_1_POSTINSTALL_ACTION', 'plg_captcha_recaptcha', 1, 'action', 'site://plugins/captcha/recaptcha/postinstall/actions.php', 'recaptcha_postinstall_action', 'site://plugins/captcha/recaptcha/postinstall/actions.php', 'recaptcha_postinstall_condition', '3.8.6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_quix`
--

DROP TABLE IF EXISTS `bt8w9_quix`;
CREATE TABLE IF NOT EXISTS `bt8w9_quix` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `builder` enum('classic','frontend') NOT NULL DEFAULT 'classic',
  `data` longtext NOT NULL,
  `metadata` longtext NOT NULL,
  `language` varchar(5) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` longtext NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(11) NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_catid` (`catid`),
  KEY `idx_state` (`state`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bt8w9_quix`
--

INSERT INTO `bt8w9_quix` (`id`, `asset_id`, `title`, `catid`, `builder`, `data`, `metadata`, `language`, `ordering`, `state`, `access`, `created`, `created_by`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `params`, `version`, `hits`, `xreference`) VALUES
(1, 110, 'ggg', 0, 'frontend', '[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"section_stretch\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Stretch Section\",\"class\":\"fe-control-switch fe-control-name-section_stretch \",\"type\":\"switch\"},{\"default\":\"boxed\",\"help\":\"Containers provide a means to center and horizontally pad your site’s contents.\",\"advanced\":false,\"depends\":[],\"element_path\":\"C:\\\\wamp64\\\\www\\\\softdev\\\\libraries\\\\quix/app/frontend/nodes\",\"name\":\"container_type\",\"reset\":false,\"multiple\":false,\"value\":\"boxed\",\"placeholder\":null,\"responsive\":false,\"label\":\"Container Type\",\"class\":\"fe-control-select fe-control-name-container_type \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"boxed\",\"label\":\"Boxed\"},{\"value\":\"fluid\",\"label\":\"Full Width\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"C:\\\\wamp64\\\\www\\\\softdev\\\\libraries\\\\quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"full\",\"label\":\"Fit To Screen\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"hidden\":true,\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":{\"height\":[\"full\",\"custom\"]},\"hidden\":true,\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Column Poisition\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-align-items-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-align-items-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-align-items-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"C:\\\\wamp64\\\\www\\\\softdev\\\\libraries\\\\quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":80,\"left\":0,\"bottom\":80,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":false,\"responsive\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":200,\"left\":0,\"bottom\":200,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"required_opacity\":false,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}},\"hover\":{\"required_opacity\":false,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"#da3366\",\"src\":{\"url\":null,\"media\":{\"type\":\"image\",\"image\":\"/middleman.jpg\"}},\"size\":\"cover\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"background_overlay_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"required_opacity\":true,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":false,\"repeat\":\"no-repeat\"}},\"hover\":{\"required_opacity\":true,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":false,\"repeat\":\"no-repeat\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background_overlay\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"required_opacity\":true,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":false,\"repeat\":\"no-repeat\"}},\"hover\":{\"required_opacity\":true,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":false,\"repeat\":\"no-repeat\"}}}},\"placeholder\":null,\"label\":\"Background overlay\",\"class\":\"fe-control-background fe-control-name-background_overlay \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":false,\"repeat\":\"no-repeat\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"divider_top_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"C:\\\\wamp64\\\\www\\\\softdev\\\\libraries\\\\quix/app/frontend/nodes\",\"name\":\"top_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-top_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-top_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"top_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"top_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-top_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"top_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-top_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-top_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-top_divider_front \",\"type\":\"switch\"}],\"divider_bottom_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"C:\\\\wamp64\\\\www\\\\softdev\\\\libraries\\\\quix/app/frontend/nodes\",\"name\":\"bottom_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-bottom_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-bottom_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"bottom_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"bottom_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"bottom_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_front \",\"type\":\"switch\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Section\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-section-332\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"section\",\"children\":[]},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"section_stretch\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Stretch Section\",\"class\":\"fe-control-switch fe-control-name-section_stretch \",\"type\":\"switch\"},{\"default\":\"boxed\",\"help\":\"Containers provide a means to center and horizontally pad your site’s contents.\",\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"container_type\",\"reset\":false,\"multiple\":false,\"value\":\"boxed\",\"placeholder\":null,\"responsive\":false,\"label\":\"Container Type\",\"class\":\"fe-control-select fe-control-name-container_type \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"boxed\",\"label\":\"Boxed\"},{\"value\":\"fluid\",\"label\":\"Full Width\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"full\",\"label\":\"Fit To Screen\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"hidden\":true,\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":{\"height\":[\"full\",\"custom\"]},\"hidden\":true,\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Column Poisition\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-align-items-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-align-items-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-align-items-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":80,\"left\":0,\"bottom\":80,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":false,\"responsive\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":80,\"left\":0,\"bottom\":80,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":false,\"responsive\":true},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"#fff\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"divider_top_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"top_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-top_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-top_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"top_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"top_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-top_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"top_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-top_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-top_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-top_divider_front \",\"type\":\"switch\"}],\"divider_bottom_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"bottom_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-bottom_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-bottom_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"bottom_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"bottom_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"bottom_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_front \",\"type\":\"switch\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Section\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-section-4020\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"section\",\"children\":[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"columns_gap\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Columns Gap\",\"class\":\"fe-control-select fe-control-name-columns_gap \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"no-gutters\",\"label\":\"No Gap\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Content Position\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-row-align-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-row-align-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-row-align-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Row\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-row-2623\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"row\",\"children\":[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"col_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Column Width\",\"class\":\"fe-control-slider fe-control-name-col_width \",\"type\":\"slider\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-column-5525\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"column\",\"children\":[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"heading_fields_group\":[{\"default\":\"Add Your Heading Text Here.\",\"help\":\"You can add HTML also.\",\"advanced\":false,\"depends\":[],\"name\":\"title\",\"reset\":false,\"value\":\"About Us\",\"placeholder\":null,\"label\":\"Title\",\"class\":\"fe-control-textarea fe-control-name-title \",\"type\":\"textarea\"},{\"default\":\"h2\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/libraries/quix/app/elements\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"h2\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"h1\",\"label\":\"H1\"},{\"value\":\"h2\",\"label\":\"H2\"},{\"value\":\"h3\",\"label\":\"H3\"},{\"value\":\"h4\",\"label\":\"H4\"},{\"value\":\"h5\",\"label\":\"H5\"},{\"value\":\"h6\",\"label\":\"H6\"},{\"value\":\"div\",\"label\":\"div\"},{\"value\":\"span\",\"label\":\"span\"},{\"value\":\"p\",\"label\":\"p\"}]},{\"default\":{\"desktop\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"alignment\",\"reset\":false,\"value\":{\"desktop\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\",\"value\":\"center\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"responsive\":true,\"label\":\"Alignment\",\"class\":\"fe-control-choose fe-control-name-alignment \",\"type\":\"choose\",\"options\":{\"left\":{\"label\":\"Left\",\"icon\":\"qxicon-align-left\"},\"center\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\"},\"right\":{\"label\":\"Right\",\"icon\":\"qxicon-align-right\"}}}],\"image_links_fields_group\":[{\"default\":{\"url\":\"\",\"target\":\"\",\"nofollow\":false},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"link\",\"reset\":false,\"value\":{\"url\":\"\",\"target\":\"\",\"nofollow\":false},\"placeholder\":null,\"label\":\"Link Url\",\"class\":\"fe-control-link fe-control-name-link \",\"type\":\"link\"}]},\"styles\":{\"color_fields_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"text_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Text Color\",\"class\":\"fe-control-color fe-control-name-text_color \",\"type\":\"color\"}],\"heading_typo_fields_group\":[{\"default\":{\"family\":\"\",\"weight\":\"\",\"size\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"transform\":\"\",\"style\":\"\",\"decoration\":\"\",\"spacing\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"height\":{\"desktop\":1,\"tablet\":1,\"phone\":1}},\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"font\",\"step\":1,\"reset\":false,\"value\":{\"family\":\"Poppins\",\"weight\":\"700\",\"size\":{\"desktop\":45,\"tablet\":0,\"phone\":0,\"responsive\":true,\"responsive_preview\":true},\"transform\":\"\",\"style\":\"\",\"decoration\":\"\",\"spacing\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"height\":{\"desktop\":1,\"tablet\":1,\"phone\":1}},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Font\",\"class\":\"fe-control-typography fe-control-name-font \",\"type\":\"typography\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-heading-5832\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"heading\",\"children\":[]},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"text_fields_group\":[{\"default\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"content\",\"reset\":false,\"value\":\"We want to have an application that can be a middleman between transactions. To ensure the safety of each party the middleman will not be a person instead it will be automated to prevent scams and fraud.<br>\",\"placeholder\":null,\"label\":\"Content\",\"class\":\"fe-control-editor fe-control-name-content \",\"type\":\"editor\"}]},\"styles\":{\"text_fields_group\":[{\"default\":{\"desktop\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"alignment\",\"reset\":false,\"value\":{\"desktop\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\",\"value\":\"center\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"responsive\":true,\"label\":\"Alignment\",\"class\":\"fe-control-choose fe-control-name-alignment \",\"type\":\"choose\",\"options\":{\"left\":{\"label\":\"Left\",\"icon\":\"qxicon-align-left\"},\"center\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\"},\"right\":{\"label\":\"Right\",\"icon\":\"qxicon-align-right\"}}},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"text_color\",\"reset\":false,\"value\":\"#4c5b6d\",\"placeholder\":null,\"label\":\"Text Color\",\"class\":\"fe-control-color fe-control-name-text_color \",\"type\":\"color\"}],\"typo_fields_group\":[{\"default\":{\"family\":\"\",\"weight\":\"\",\"size\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"transform\":\"\",\"style\":\"\",\"decoration\":\"\",\"spacing\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"height\":{\"desktop\":1,\"tablet\":1,\"phone\":1}},\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"font\",\"step\":1,\"reset\":false,\"value\":{\"family\":\"\",\"weight\":\"\",\"size\":{\"desktop\":16,\"tablet\":0,\"phone\":0,\"responsive\":true,\"responsive_preview\":true},\"transform\":\"\",\"style\":\"\",\"decoration\":\"\",\"spacing\":{\"desktop\":0,\"tablet\":0,\"phone\":0},\"height\":{\"desktop\":1.5,\"tablet\":1,\"phone\":1,\"responsive\":true,\"responsive_preview\":true}},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Font\",\"class\":\"fe-control-typography fe-control-name-font \",\"type\":\"typography\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":150,\"bottom\":null,\"right\":150,\"responsive\":true,\"responsive_preview\":true,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"required_opacity\":false,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}},\"hover\":{\"required_opacity\":false,\"opacity\":0,\"required_transition\":true,\"transition\":0.3,\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"size\":\"cover\",\"color\":\"\",\"src\":\"\",\"parallax_method\":\"css\",\"position\":\"center\",\"blend\":\"normal\",\"parallax\":false,\"required_parallax\":true,\"repeat\":\"no-repeat\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-text-5655\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"text\",\"children\":[]},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"image_fields_group\":[{\"default\":\"libraries/quix/assets/images/placeholder.png\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"image\",\"reset\":false,\"value\":{\"url\":\"https://getquix.net/images/creative-1/logos.jpg\",\"media\":null},\"placeholder\":null,\"label\":\"Image\",\"class\":\"fe-control-media fe-control-name-image \",\"type\":\"media\",\"filters\":[]},{\"default\":\"\",\"help\":\"Google focuses on alt text when trying to understand what an image is about. So it\'s valuable for SEO, in addition to being useful for users.\",\"advanced\":false,\"depends\":{\"image\":\"*\"},\"hidden\":false,\"name\":\"alt_text\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Alt Text\",\"class\":\"fe-control-text fe-control-name-alt_text \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":{\"image\":\"*\"},\"hidden\":false,\"name\":\"caption\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Caption\",\"class\":\"fe-control-text fe-control-name-caption \",\"type\":\"text\"}],\"image_links_fields_group\":[{\"default\":{\"url\":\"\",\"target\":\"\",\"nofollow\":false},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"link\",\"reset\":false,\"value\":{\"url\":\"\",\"target\":\"\",\"nofollow\":false},\"placeholder\":null,\"label\":\"Link Url\",\"class\":\"fe-control-link fe-control-name-link \",\"type\":\"link\"}]},\"styles\":{\"image_fields_group\":[{\"default\":{\"desktop\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"alignment\",\"reset\":false,\"value\":{\"desktop\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\",\"value\":\"center\"},\"tablet\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"phone\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"responsive\":true,\"label\":\"Alignment\",\"class\":\"fe-control-choose fe-control-name-alignment \",\"type\":\"choose\",\"options\":{\"left\":{\"label\":\"Left\",\"icon\":\"qxicon-align-left\"},\"center\":{\"label\":\"Center\",\"icon\":\"qxicon-align-center\"},\"right\":{\"label\":\"Right\",\"icon\":\"qxicon-align-right\"}}},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Width (%)\",\"class\":\"fe-control-slider fe-control-name-width \",\"type\":\"slider\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1,\"depends\":[],\"name\":\"opacity\",\"step\":0.1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Opacity (%)\",\"class\":\"fe-control-slider fe-control-name-opacity \",\"type\":\"slider\"}],\"border_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"img_border_width\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Width\",\"class\":\"fe-control-dimensions fe-control-name-img_border_width \",\"type\":\"dimensions\"},{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/libraries/quix/app/elements\",\"name\":\"img_border_type\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Border Type\",\"class\":\"fe-control-select fe-control-name-img_border_type \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"solid\",\"label\":\"Solid\"},{\"value\":\"double\",\"label\":\"Double\"},{\"value\":\"dotted\",\"label\":\"Dotted\"},{\"value\":\"dashed\",\"label\":\"Dashed\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"img_border_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Border Color\",\"class\":\"fe-control-color fe-control-name-img_border_color \",\"type\":\"color\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"img_border_radius\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Border Radius\",\"class\":\"fe-control-dimensions fe-control-name-img_border_radius \",\"type\":\"dimensions\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-image-13143\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"image\",\"children\":[]}],\"size\":{\"lg\":1,\"md\":1,\"sm\":1,\"xs\":1},\"width\":{\"desktop\":100,\"tablet\":100,\"phone\":100}}]}]},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"section_stretch\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Stretch Section\",\"class\":\"fe-control-switch fe-control-name-section_stretch \",\"type\":\"switch\"},{\"default\":\"boxed\",\"help\":\"Containers provide a means to center and horizontally pad your site’s contents.\",\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"container_type\",\"reset\":false,\"multiple\":false,\"value\":\"fluid\",\"placeholder\":null,\"responsive\":false,\"label\":\"Container Type\",\"class\":\"fe-control-select fe-control-name-container_type \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"boxed\",\"label\":\"Boxed\"},{\"value\":\"fluid\",\"label\":\"Full Width\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"full\",\"label\":\"Fit To Screen\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"hidden\":true,\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":{\"height\":[\"full\",\"custom\"]},\"hidden\":true,\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Column Poisition\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-align-items-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-align-items-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-align-items-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":80,\"left\":0,\"bottom\":80,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":false,\"responsive\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":null,\"left\":0,\"bottom\":null,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"#f5f5f5\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"divider_top_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"top_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-top_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-top_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"top_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"top_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-top_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"top_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-top_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-top_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-top_divider_front \",\"type\":\"switch\"}],\"divider_bottom_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"bottom_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-bottom_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-bottom_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"bottom_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"bottom_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"bottom_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_front \",\"type\":\"switch\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Section\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-section-14233\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"section\",\"children\":[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"columns_gap\",\"reset\":false,\"multiple\":false,\"value\":\"no-gutters\",\"placeholder\":null,\"responsive\":false,\"label\":\"Columns Gap\",\"class\":\"fe-control-select fe-control-name-columns_gap \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"no-gutters\",\"label\":\"No Gap\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"hidden\":true,\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\",\"value\":\"qx-row-align-center\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Content Position\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-row-align-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-row-align-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-row-align-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Row\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-row-98236\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"row\",\"children\":[{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"col_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":50,\"tablet\":50,\"phone\":100},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Column Width\",\"class\":\"fe-control-slider fe-control-name-col_width \",\"type\":\"slider\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-column-72238\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"column\",\"children\":[],\"size\":{\"lg\":0.5,\"md\":0.5,\"sm\":0.5,\"xs\":1},\"width\":{\"desktop\":50,\"tablet\":50,\"phone\":100}},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":100,\"depends\":[],\"name\":\"col_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":50,\"tablet\":50,\"phone\":100},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Column Width\",\"class\":\"fe-control-slider fe-control-name-col_width \",\"type\":\"slider\"}]},\"advanced\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"custom_css_group\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"custom_css\",\"reset\":false,\"value\":{\"code\":\"\",\"mode\":\"css\"},\"placeholder\":null,\"label\":\"Css Code\",\"class\":\"fe-control-code fe-control-name-custom_css \",\"type\":\"code\"}],\"identifier\":[{\"advanced\":false,\"depends\":[],\"default\":\"\",\"reset\":false},{\"default\":\"\",\"help\":\"Add your custom ID WITHOUT the \'#\'. eg - my-id\",\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-column-18240\",\"placeholder\":null,\"label\":\"Css ID\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":\"Add your custom classes WITHOUT the dot and seperate by space. eg - first-class another-class\",\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Css Classs\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"column\",\"children\":[],\"size\":{\"lg\":0.5,\"md\":0.5,\"sm\":0.5,\"xs\":1},\"width\":{\"desktop\":50,\"tablet\":50,\"phone\":100}}]}]},{\"visibility\":{\"lg\":true,\"md\":true,\"sm\":true,\"xs\":true},\"form\":{\"general\":{\"layout_fields_group\":[{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"section_stretch\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Stretch Section\",\"class\":\"fe-control-switch fe-control-name-section_stretch \",\"type\":\"switch\"},{\"default\":\"boxed\",\"help\":\"Containers provide a means to center and horizontally pad your site’s contents.\",\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"container_type\",\"reset\":false,\"multiple\":false,\"value\":\"boxed\",\"placeholder\":null,\"responsive\":false,\"label\":\"Container Type\",\"class\":\"fe-control-select fe-control-name-container_type \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"boxed\",\"label\":\"Boxed\"},{\"value\":\"fluid\",\"label\":\"Full Width\"}]},{\"default\":\"default\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"height\",\"reset\":false,\"multiple\":false,\"value\":\"default\",\"placeholder\":null,\"responsive\":false,\"label\":\"Height\",\"class\":\"fe-control-select fe-control-name-height \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"default\",\"label\":\"Default\"},{\"value\":\"full\",\"label\":\"Fit To Screen\"},{\"value\":\"custom\",\"label\":\"Min Height\"}]},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":1500,\"depends\":{\"height\":\"custom\"},\"hidden\":true,\"name\":\"custom_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":0,\"tablet\":0,\"phone\":0,\"responsive_preview\":true},\"suffix\":\"px\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Minimum Height\",\"class\":\"fe-control-slider fe-control-name-custom_height \",\"type\":\"slider\"},{\"default\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"help\":null,\"advanced\":false,\"depends\":{\"height\":[\"full\",\"custom\"]},\"hidden\":true,\"name\":\"v_align\",\"reset\":false,\"value\":{\"label\":\"\",\"icon\":\"\",\"value\":\"\"},\"placeholder\":null,\"responsive\":false,\"label\":\"Column Poisition\",\"class\":\"fe-control-choose fe-control-name-v_align \",\"type\":\"choose\",\"options\":{\"qx-align-items-start\":{\"label\":\"Top\",\"icon\":\"qxicon-arrow-to-top\"},\"qx-align-items-center\":{\"label\":\"Middle\",\"icon\":\"qxicon-minus\"},\"qx-align-items-end\":{\"label\":\"Bottom\",\"icon\":\"qxicon-arrow-to-bottom\"}}},{\"default\":\"div\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"html_tag\",\"reset\":false,\"multiple\":false,\"value\":\"div\",\"placeholder\":null,\"responsive\":false,\"label\":\"HTML Tag\",\"class\":\"fe-control-select fe-control-name-html_tag \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"section\",\"label\":\"Section\"},{\"value\":\"header\",\"label\":\"Header\"},{\"value\":\"footer\",\"label\":\"Footer\"},{\"value\":\"aside\",\"label\":\"Aside\"},{\"value\":\"article\",\"label\":\"Article\"},{\"value\":\"nav\",\"label\":\"Nav\"},{\"value\":\"div\",\"label\":\"Div\"}]}]},\"styles\":{\"spacing_fields_group\":[{\"default\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"margin\",\"reset\":false,\"value\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\",\"responsive\":true,\"responsive_preview\":false,\"tablet\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"},\"phone\":{\"top\":\"\",\"left\":\"\",\"bottom\":\"\",\"right\":\"\"}},\"placeholder\":null,\"label\":\"Margin\",\"class\":\"fe-control-dimensions fe-control-name-margin \",\"type\":\"dimensions\"},{\"default\":{\"top\":80,\"left\":0,\"bottom\":80,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":false,\"responsive\":true},\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"padding\",\"reset\":false,\"value\":{\"top\":100,\"left\":0,\"bottom\":100,\"right\":0,\"phone\":{\"top\":20,\"bottom\":20,\"left\":0,\"right\":0},\"tablet\":{\"top\":40,\"bottom\":40,\"left\":0,\"right\":0},\"responsive_preview\":true,\"responsive\":true},\"placeholder\":null,\"label\":\"Padding\",\"class\":\"fe-control-dimensions fe-control-name-padding \",\"type\":\"dimensions\"},{\"default\":0,\"help\":null,\"advanced\":false,\"max\":999,\"depends\":[],\"name\":\"zindex\",\"step\":1,\"reset\":false,\"value\":0,\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":false,\"label\":\"Z-Index\",\"class\":\"fe-control-slider fe-control-name-zindex \",\"type\":\"slider\"}],\"background_fields_group\":[{\"schema\":[],\"default\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"help\":null,\"advanced\":false,\"depends\":[],\"supportedTypes\":[\"classic\",\"gradient\",\"video\"],\"name\":\"background\",\"reset\":false,\"value\":{\"state\":{\"normal\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"hover\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}}}},\"placeholder\":null,\"label\":\"Background\",\"class\":\"fe-control-background fe-control-name-background \",\"types\":{\"classic\":{\"type\":\"classic\",\"properties\":{\"color\":\"\",\"src\":\"\",\"size\":\"initial\",\"position\":\"center\",\"repeat\":\"no-repeat\",\"blend\":\"normal\",\"parallax\":false,\"parallax_method\":\"css\"}},\"gradient\":{\"type\":\"gradient\",\"properties\":{\"color_1\":\"\",\"color_2\":\"#f36\",\"type\":\"linear\",\"direction\":180,\"start_position\":0,\"end_position\":100,\"overlay\":false}},\"video\":{\"type\":\"video\",\"properties\":{\"url\":\"\",\"width\":\"320\",\"height\":\"320\",\"pause\":true}}},\"type\":\"background\"}],\"divider_top_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"top_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-top_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-top_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"top_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"top_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-top_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"top_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-top_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-top_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"top_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-top_divider_front \",\"type\":\"switch\"}],\"divider_bottom_fields_group\":[{\"default\":\"none\",\"help\":null,\"advanced\":false,\"depends\":[],\"element_path\":\"/home/greatzby/public_html/getquix.net/libraries/quix/app/frontend/nodes\",\"name\":\"bottom_divider_style\",\"reset\":false,\"multiple\":false,\"value\":\"none\",\"placeholder\":null,\"responsive\":false,\"label\":\"Divider Style\",\"class\":\"fe-control-select fe-control-name-bottom_divider_style \",\"tags\":false,\"type\":\"select\",\"select\":[],\"options\":[{\"value\":\"none\",\"label\":\"None\"},{\"value\":\"qx-tilt-opacity\",\"label\":\"Tilt Opacity\"},{\"value\":\"qx-waves-shake\",\"label\":\"Waves Shake\"},{\"value\":\"qx-triangle-wave\",\"label\":\"Triangle Wave\"},{\"value\":\"qx-triangle-dobule-wave\",\"label\":\"Triangle Dobule Wave\"},{\"value\":\"arrow\",\"label\":\"Arrow\"},{\"value\":\"book\",\"label\":\"Book\"},{\"value\":\"clouds\",\"label\":\"Clouds\"},{\"value\":\"curve-asymmetrical\",\"label\":\"Curve Asymmetrical\"},{\"value\":\"curve\",\"label\":\"Curve\"},{\"value\":\"drops\",\"label\":\"Drops\"},{\"value\":\"mountains\",\"label\":\"Mountains\"},{\"value\":\"opacity-fan\",\"label\":\"Fan Opacity\"},{\"value\":\"opacity-tilt\",\"label\":\"Tilt Opacity\"},{\"value\":\"pyramids\",\"label\":\"Pyramids\"},{\"value\":\"split\",\"label\":\"Split\"},{\"value\":\"tilt\",\"label\":\"Tilt\"},{\"value\":\"triangle-asymmetrical\",\"label\":\"Triangle Asymmetrical\"},{\"value\":\"triangle\",\"label\":\"Triangle\"},{\"value\":\"wave-brush\",\"label\":\"Waves Brush\"},{\"value\":\"waves-pattern\",\"label\":\"Waves Pattern\"},{\"value\":\"waves\",\"label\":\"Waves\"},{\"value\":\"zigzag\",\"label\":\"Zigzag\"}]},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_color\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Color\",\"class\":\"fe-control-color fe-control-name-bottom_divider_color \",\"type\":\"color\"},{\"default\":{\"desktop\":100},\"help\":null,\"advanced\":false,\"max\":500,\"depends\":{\"bottom_divider_style\":[\"qx-tilt-opacity\",\"arrow\",\"book\",\"curve-asymmetrical\",\"curve\",\"mountains\",\"opacity-fan\",\"opacity-tilt\",\"pyramids\",\"split\",\"triangle-asymmetrical\",\"triangle\",\"wave-brush\",\"waves-pattern\",\"waves\",\"zigzag\"]},\"hidden\":true,\"name\":\"bottom_divider_width\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":{\"desktop\":100},\"phone\":{\"desktop\":100},\"responsive_preview\":true},\"suffix\":\"\",\"min\":100,\"placeholder\":null,\"responsive\":true,\"label\":\"Width\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_width \",\"type\":\"slider\"},{\"default\":{\"desktop\":100,\"tablet\":100,\"phone\":100},\"help\":null,\"advanced\":false,\"max\":700,\"depends\":[],\"name\":\"bottom_divider_height\",\"step\":1,\"reset\":false,\"value\":{\"desktop\":100,\"tablet\":100,\"phone\":100,\"responsive_preview\":true},\"suffix\":\"\",\"min\":0,\"placeholder\":null,\"responsive\":true,\"label\":\"Height\",\"class\":\"fe-control-slider fe-control-name-bottom_divider_height \",\"type\":\"slider\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_flip\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Flip\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_flip \",\"type\":\"switch\"},{\"default\":false,\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"bottom_divider_front\",\"reset\":false,\"value\":false,\"placeholder\":null,\"label\":\"Bring to Front\",\"class\":\"fe-control-switch fe-control-name-bottom_divider_front \",\"type\":\"switch\"}]},\"advanced\":{\"identifier\":[{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"label\",\"reset\":false,\"value\":\"Section\",\"placeholder\":null,\"label\":\"Label\",\"class\":\"fe-control-text fe-control-name-label \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"id\",\"reset\":false,\"value\":\"qx-section-242\",\"placeholder\":null,\"label\":\"Id\",\"class\":\"fe-control-text fe-control-name-id \",\"type\":\"text\"},{\"default\":\"\",\"help\":null,\"advanced\":false,\"depends\":[],\"name\":\"class\",\"reset\":false,\"value\":\"\",\"placeholder\":null,\"label\":\"Class\",\"class\":\"fe-control-text fe-control-name-class \",\"type\":\"text\"}]}},\"slug\":\"section\",\"children\":[]}]', '{\"addog\":\"true\",\"addtw\":\"true\",\"title\":\"\",\"image_intro\":\"\",\"desc\":\"\",\"twitter_username\":\"\",\"fb_appid\":\"\"}', 'en-GB', 1, 1, 1, '2018-07-11 06:55:30', 857, '0000-00-00 00:00:00', 857, 0, '0000-00-00 00:00:00', '{\"enable_confetti\":\"0\",\"code\":\"\",\"codecss\":\"\",\"codejs\":\"\"}', 1, 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_quix_collections`
--

DROP TABLE IF EXISTS `bt8w9_quix_collections`;
CREATE TABLE IF NOT EXISTS `bt8w9_quix_collections` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `uid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('layout','section') NOT NULL DEFAULT 'section',
  `catid` int(11) NOT NULL,
  `builder` enum('classic','frontend') NOT NULL DEFAULT 'classic',
  `data` longtext NOT NULL,
  `metadata` longtext NOT NULL,
  `language` varchar(5) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` longtext NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(11) NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_catid` (`catid`),
  KEY `idx_state` (`state`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_quix_collection_map`
--

DROP TABLE IF EXISTS `bt8w9_quix_collection_map`;
CREATE TABLE IF NOT EXISTS `bt8w9_quix_collection_map` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_quix_configs`
--

DROP TABLE IF EXISTS `bt8w9_quix_configs`;
CREATE TABLE IF NOT EXISTS `bt8w9_quix_configs` (
  `name` varchar(255) NOT NULL,
  `params` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='Store any configuration in key => params maps';

--
-- Dumping data for table `bt8w9_quix_configs`
--

INSERT INTO `bt8w9_quix_configs` (`name`, `params`) VALUES
('username', 'acdeleon'),
('key', 'd645792df665c756c6df50ee64b8e595');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_quix_elements`
--

DROP TABLE IF EXISTS `bt8w9_quix_elements`;
CREATE TABLE IF NOT EXISTS `bt8w9_quix_elements` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `params` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_redirect_links`
--

DROP TABLE IF EXISTS `bt8w9_redirect_links`;
CREATE TABLE IF NOT EXISTS `bt8w9_redirect_links` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `old_url` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `header` smallint(3) NOT NULL DEFAULT '301',
  PRIMARY KEY (`id`),
  KEY `idx_old_url` (`old_url`(100)),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_schemas`
--

DROP TABLE IF EXISTS `bt8w9_schemas`;
CREATE TABLE IF NOT EXISTS `bt8w9_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_schemas`
--

INSERT INTO `bt8w9_schemas` (`extension_id`, `version_id`) VALUES
(700, '3.8.9-2018-06-19'),
(10010, '2.4.8'),
(10025, '1.1');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_session`
--

DROP TABLE IF EXISTS `bt8w9_session`;
CREATE TABLE IF NOT EXISTS `bt8w9_session` (
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `guest` tinyint(4) UNSIGNED DEFAULT '1',
  `time` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `data` mediumtext COLLATE utf8mb4_unicode_ci,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_session`
--

INSERT INTO `bt8w9_session` (`session_id`, `client_id`, `guest`, `time`, `data`, `userid`, `username`) VALUES
('3mj859snma21qcp6o6hf2im3m5', 1, 0, '1531743046', 'joomla|s:1824:\"TzoyNDoiSm9vbWxhXFJlZ2lzdHJ5XFJlZ2lzdHJ5IjozOntzOjc6IgAqAGRhdGEiO086ODoic3RkQ2xhc3MiOjE6e3M6OToiX19kZWZhdWx0IjtPOjg6InN0ZENsYXNzIjo0OntzOjc6InNlc3Npb24iO086ODoic3RkQ2xhc3MiOjM6e3M6NzoiY291bnRlciI7aTo2MztzOjU6InRpbWVyIjtPOjg6InN0ZENsYXNzIjozOntzOjU6InN0YXJ0IjtpOjE1MzE3MzI4MjA7czo0OiJsYXN0IjtpOjE1MzE3NDMwNDE7czozOiJub3ciO2k6MTUzMTc0MzA0Mjt9czo1OiJ0b2tlbiI7czozMjoiTU9HaVkxU1EwczhsTWttQUREYjJ6SG5HTVFkUEhMOHoiO31zOjg6InJlZ2lzdHJ5IjtPOjI0OiJKb29tbGFcUmVnaXN0cnlcUmVnaXN0cnkiOjM6e3M6NzoiACoAZGF0YSI7Tzo4OiJzdGRDbGFzcyI6Mzp7czoxMzoiY29tX2luc3RhbGxlciI7Tzo4OiJzdGRDbGFzcyI6Mjp7czo3OiJtZXNzYWdlIjtzOjA6IiI7czoxNzoiZXh0ZW5zaW9uX21lc3NhZ2UiO3M6MDoiIjt9czo4OiJjb21fcXVpeCI7Tzo4OiJzdGRDbGFzcyI6MTp7czo1OiJwYWdlcyI7Tzo4OiJzdGRDbGFzcyI6MTp7czo4OiJvcmRlcmNvbCI7czo0OiJhLmlkIjt9fXM6OToiY29tX21lbnVzIjtPOjg6InN0ZENsYXNzIjoyOntzOjU6Iml0ZW1zIjtPOjg6InN0ZENsYXNzIjo1OntzOjg6Im1lbnV0eXBlIjtzOjg6Im1haW5tZW51IjtzOjQ6Imxpc3QiO2E6NDp7czo5OiJkaXJlY3Rpb24iO3M6MzoiYXNjIjtzOjU6ImxpbWl0IjtzOjI6IjIwIjtzOjg6Im9yZGVyaW5nIjtzOjU6ImEubGZ0IjtzOjU6InN0YXJ0IjtkOjA7fXM6OToiY2xpZW50X2lkIjtpOjA7czoxMDoibGltaXRzdGFydCI7aTowO3M6NToibW9kYWwiO086ODoic3RkQ2xhc3MiOjM6e3M6ODoibWVudXR5cGUiO3M6MDoiIjtzOjk6ImNsaWVudF9pZCI7aTowO3M6NDoibGlzdCI7YTo0OntzOjk6ImRpcmVjdGlvbiI7czozOiJhc2MiO3M6NToibGltaXQiO3M6MjoiMjAiO3M6ODoib3JkZXJpbmciO3M6NToiYS5sZnQiO3M6NToic3RhcnQiO2Q6MDt9fX1zOjQ6ImVkaXQiO086ODoic3RkQ2xhc3MiOjE6e3M6NDoiaXRlbSI7Tzo4OiJzdGRDbGFzcyI6NDp7czo0OiJkYXRhIjtOO3M6NDoidHlwZSI7TjtzOjQ6ImxpbmsiO047czoyOiJpZCI7YTozOntpOjA7aToxMTQ7aToxO2k6MTQ3O2k6MjtpOjE0ODt9fX19fXM6MTQ6IgAqAGluaXRpYWxpemVkIjtiOjA7czo5OiJzZXBhcmF0b3IiO3M6MToiLiI7fXM6NDoidXNlciI7TzoyMDoiSm9vbWxhXENNU1xVc2VyXFVzZXIiOjE6e3M6MjoiaWQiO3M6MzoiODU3Ijt9czoxMToiYXBwbGljYXRpb24iO086ODoic3RkQ2xhc3MiOjE6e3M6NToicXVldWUiO2E6MDp7fX19fXM6MTQ6IgAqAGluaXRpYWxpemVkIjtiOjA7czo5OiJzZXBhcmF0b3IiO3M6MToiLiI7fQ==\";', 857, 'admin'),
('62ju6r29v7keqbkagp0l1bs0g5', 0, 1, '1531737092', 'joomla|s:880:\"TzoyNDoiSm9vbWxhXFJlZ2lzdHJ5XFJlZ2lzdHJ5IjozOntzOjc6IgAqAGRhdGEiO086ODoic3RkQ2xhc3MiOjE6e3M6OToiX19kZWZhdWx0IjtPOjg6InN0ZENsYXNzIjozOntzOjc6InNlc3Npb24iO086ODoic3RkQ2xhc3MiOjM6e3M6NzoiY291bnRlciI7aTozMTtzOjU6InRpbWVyIjtPOjg6InN0ZENsYXNzIjozOntzOjU6InN0YXJ0IjtpOjE1MzE3MzY5OTI7czo0OiJsYXN0IjtpOjE1MzE3MzcwODk7czozOiJub3ciO2k6MTUzMTczNzA5MDt9czo1OiJ0b2tlbiI7czozMjoiWWduRkdFWHNRRUdYenNKUElhWUw1cERKd3dndGFIeG4iO31zOjg6InJlZ2lzdHJ5IjtPOjI0OiJKb29tbGFcUmVnaXN0cnlcUmVnaXN0cnkiOjM6e3M6NzoiACoAZGF0YSI7Tzo4OiJzdGRDbGFzcyI6MTp7czo1OiJ1c2VycyI7Tzo4OiJzdGRDbGFzcyI6MTp7czo1OiJsb2dpbiI7Tzo4OiJzdGRDbGFzcyI6MTp7czo0OiJmb3JtIjtPOjg6InN0ZENsYXNzIjoxOntzOjQ6ImRhdGEiO2E6MDp7fX19fX1zOjE0OiIAKgBpbml0aWFsaXplZCI7YjowO3M6OToic2VwYXJhdG9yIjtzOjE6Ii4iO31zOjQ6InVzZXIiO086MjA6Ikpvb21sYVxDTVNcVXNlclxVc2VyIjoxOntzOjI6ImlkIjtpOjA7fX19czoxNDoiACoAaW5pdGlhbGl6ZWQiO2I6MDtzOjk6InNlcGFyYXRvciI7czoxOiIuIjt9\";', 0, ''),
('opdao2r67jl7uv1eaae8brtel4', 1, 0, '1531657978', 'joomla|s:868:\"TzoyNDoiSm9vbWxhXFJlZ2lzdHJ5XFJlZ2lzdHJ5IjozOntzOjc6IgAqAGRhdGEiO086ODoic3RkQ2xhc3MiOjE6e3M6OToiX19kZWZhdWx0IjtPOjg6InN0ZENsYXNzIjozOntzOjc6InNlc3Npb24iO086ODoic3RkQ2xhc3MiOjM6e3M6NzoiY291bnRlciI7aTo0O3M6NToidGltZXIiO086ODoic3RkQ2xhc3MiOjM6e3M6NToic3RhcnQiO2k6MTUzMTY1NzkwNztzOjQ6Imxhc3QiO2k6MTUzMTY1NzkzMjtzOjM6Im5vdyI7aToxNTMxNjU3OTU4O31zOjU6InRva2VuIjtzOjMyOiJVYXl4V2tHaUFXRE1hekNIUTVhVUh0SmFNcUlyQUtneCI7fXM6ODoicmVnaXN0cnkiO086MjQ6Ikpvb21sYVxSZWdpc3RyeVxSZWdpc3RyeSI6Mzp7czo3OiIAKgBkYXRhIjtPOjg6InN0ZENsYXNzIjoxOntzOjEzOiJjb21faW5zdGFsbGVyIjtPOjg6InN0ZENsYXNzIjoyOntzOjc6Im1lc3NhZ2UiO3M6MDoiIjtzOjE3OiJleHRlbnNpb25fbWVzc2FnZSI7czowOiIiO319czoxNDoiACoAaW5pdGlhbGl6ZWQiO2I6MDtzOjk6InNlcGFyYXRvciI7czoxOiIuIjt9czo0OiJ1c2VyIjtPOjIwOiJKb29tbGFcQ01TXFVzZXJcVXNlciI6MTp7czoyOiJpZCI7czozOiI4NTciO319fXM6MTQ6IgAqAGluaXRpYWxpemVkIjtiOjA7czo5OiJzZXBhcmF0b3IiO3M6MToiLiI7fQ==\";', 857, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_tags`
--

DROP TABLE IF EXISTS `bt8w9_tags`;
CREATE TABLE IF NOT EXISTS `bt8w9_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `path` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urls` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tag_idx` (`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`(100)),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`(100)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_tags`
--

INSERT INTO `bt8w9_tags` (`id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `created_by_alias`, `modified_user_id`, `modified_time`, `images`, `urls`, `hits`, `language`, `version`, `publish_up`, `publish_down`) VALUES
(1, 0, 0, 1, 0, '', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '', '', '', '', 857, '2018-07-08 14:34:12', '', 0, '0000-00-00 00:00:00', '', '', 0, '*', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_template_styles`
--

DROP TABLE IF EXISTS `bt8w9_template_styles`;
CREATE TABLE IF NOT EXISTS `bt8w9_template_styles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `template` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `home` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_template_styles`
--

INSERT INTO `bt8w9_template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(4, 'beez3', 0, '0', 'Beez3 - Default', '{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"logo\":\"images\\/joomla_black.png\",\"sitetitle\":\"Joomla!\",\"sitedescription\":\"Open Source Content Management\",\"navposition\":\"left\",\"templatecolor\":\"personal\",\"html5\":\"0\"}'),
(5, 'hathor', 1, '0', 'Hathor - Default', '{\"showSiteName\":\"0\",\"colourChoice\":\"\",\"boldText\":\"0\"}'),
(7, 'protostar', 0, '0', 'protostar - Default', '{\"templateColor\":\"\",\"logoFile\":\"\",\"googleFont\":\"1\",\"googleFontName\":\"Open+Sans\",\"fluidContainer\":\"0\"}'),
(8, 'isis', 1, '1', 'isis - Default', '{\"templateColor\":\"\",\"logoFile\":\"\"}'),
(9, 'ostrainingbreeze', 0, '0', 'OSTraining: Breeze - Default', '{\"logoFile\":\"\",\"googleFont\":\"1\",\"fontAwesome\":\"1\",\"mobileMenu\":\"1\",\"googleFontName\":\"Open+Sans:400,300,300italic,700,600,800\",\"colorScheme\":\"#2184cd\",\"hoverColor\":\"#41a1d6\"}'),
(10, 'gridbox', 0, '1', 'Gridbox - Default', '{\"params\":{\"desktop\":{\"body\":{\"color\":\"@text\",\"font-family\":\"Roboto\",\"font-size\":21,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":36,\"text-align\":\"left\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"p\":{\"color\":\"@text\",\"font-family\":\"@default\",\"font-size\":21,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":36,\"text-align\":\"left\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h1\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":56,\"font-style\":\"normal\",\"font-weight\":\"700\",\"letter-spacing\":0,\"line-height\":65,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h2\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":40,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":50,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h3\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":32,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":42,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h4\":{\"color\":\"@text\",\"font-family\":\"@default\",\"font-size\":24,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":42,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h5\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":20,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":30,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h6\":{\"color\":\"@subtitle\",\"font-family\":\"@default\",\"font-size\":14,\"font-style\":\"normal\",\"font-weight\":\"500\",\"letter-spacing\":2,\"line-height\":18,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"uppercase\"},\"links\":{\"color\":\"@secondary\",\"hover-color\":\"@hover\"},\"padding\":{\"bottom\":0,\"left\":0,\"right\":0,\"top\":0},\"background\":{\"type\":\"color\",\"color\":\"@bg-primary\",\"image\":{\"image\":\"\",\"attachment\":\"scroll\",\"position\":\"center center\",\"size\":\"cover\",\"repeat\":\"no-repeat\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":1,\"start\":0,\"quality\":\"hd720\",\"image\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":1,\"start\":0,\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{},\"phone\":{},\"presets\":{\"button\":{},\"menu\":{},\"column\":{},\"row\":{},\"section\":{}},\"defaultPresets\":{},\"access\":1,\"suffix\":\"\",\"colorVariables\":{\"@primary\":{\"color\":\"#34dca2\",\"title\":\"Primary\"},\"@secondary\":{\"color\":\"#007df7\",\"title\":\"Secondary\"},\"@accent\":{\"color\":\"#ff735e\",\"title\":\"Accent\"},\"@title\":{\"color\":\"#1b1b1d\",\"title\":\"Title\"},\"@subtitle\":{\"color\":\"rgba(29, 29, 31, 0.4)\",\"title\":\"Subtitle\"},\"@text\":{\"color\":\"#1b1b1d\",\"title\":\"Text\"},\"@icon\":{\"color\":\"#1b1b1d\",\"title\":\"Icon\"},\"@title-inverse\":{\"color\":\"#ffffff\",\"title\":\"Title Inverse\"},\"@text-inverse\":{\"color\":\"rgba(255, 255, 255, 0.4)\",\"title\":\"Text Inverse\"},\"@bg-primary\":{\"color\":\"#ffffff\",\"title\":\"Primary\"},\"@bg-secondary\":{\"color\":\"#f5f8f8\",\"title\":\"Secondary\"},\"@bg-dark\":{\"color\":\"#1e293d\",\"title\":\"Dark\"},\"@bg-dark-accent\":{\"color\":\"#20364c\",\"title\":\"Dark Accent\"},\"@border\":{\"color\":\"#eeeeee\",\"title\":\"Border\"},\"@shadow\":{\"color\":\"rgba(0, 0, 0, 0.15)\",\"title\":\"Shadow\"},\"@overlay\":{\"color\":\"rgba(0, 0, 0, 0.5)\",\"title\":\"Overlay\"},\"@hover\":{\"color\":\"#2f3439\",\"title\":\"Hover\"},\"@color-1\":{\"color\":\"#35404a\",\"title\":\"Color 1\"},\"@color-2\":{\"color\":\"#4f6279\",\"title\":\"Color 2\"},\"@color-3\":{\"color\":\"#0098d8\",\"title\":\"Color 3\"},\"@color-4\":{\"color\":\"#ff4f49\",\"title\":\"Color 4\"},\"@color-5\":{\"color\":\"#ff7a2f\",\"title\":\"Color 5\"},\"@color-6\":{\"color\":\"#ffc700\",\"title\":\"Color 6\"},\"@color-7\":{\"color\":\"#34dca2\",\"title\":\"Color 7\"},\"@color-8\":{\"color\":\"#00ada9\",\"title\":\"Color 8\"}},\"tablet-portrait\":{},\"phone-portrait\":{},\"image\":\"\"},\"header\":{\"items\":{\"item-179497138800\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":1,\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"radial\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"position\":\"relative\",\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"fullscreen\":\"0\",\"disable\":0,\"shadow\":{\"value\":\"0\",\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false,\"fullwidth\":true},\"image\":{\"image\":\"images\\/asdasdasd.jpg\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{\"padding\":{\"left\":\"20\",\"right\":\"20\"},\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.5,\"type\":\"mousemove\"},\"layout\":\"\",\"type\":\"header\",\"max-width\":\"100%\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{\"padding\":{\"right\":\"0\",\"left\":\"0\",\"top\":\"0\",\"bottom\":\"0\"}},\"phone-portrait\":{},\"access_view\":1,\"presets\":\"\"},\"item-14960529410\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"gutter\":\"1\",\"fullscreen\":\"0\",\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false,\"fullwidth\":false},\"image\":{\"image\":\"\"},\"view\":{\"gutter\":true}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.3,\"type\":\"mousemove\"},\"type\":\"row\",\"max-width\":\"1170px\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1,\"presets\":\"\"},\"item-14960529411\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"fullscreen\":\"0\",\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false},\"image\":{\"image\":\"\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1,\"type\":\"mousemove\"},\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1,\"content_align\":\"column-content-align-middle\",\"presets\":\"\"},\"item-14960529412\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"fullscreen\":\"0\",\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false},\"image\":{\"image\":\"\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1,\"type\":\"mousemove\"},\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{\"column-width\":\"10\",\"span\":{\"width\":\"10\"}},\"phone-portrait\":{},\"access_view\":1,\"content_align\":\"column-content-align-middle\",\"presets\":\"\"},\"item-179497138803\":{\"desktop\":{\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"width\":\"50\",\"text-align\":\"center\",\"disable\":\"0\"},\"tablet\":{\"disable\":\"0\",\"text-align\":\"left\"},\"phone\":{\"disable\":\"0\"},\"link\":{\"link\":\"\",\"target\":\"_blank\"},\"image\":\"components\\/com_gridbox\\/assets\\/images\\/gridbox.svg\",\"alt\":\"\",\"type\":\"logo\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{\"text-align\":\"center\"},\"phone-portrait\":{},\"access_view\":1,\"presets\":\"\"},\"item-179497138805\":{\"desktop\":{\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"nav-typography\":{\"font-family\":\"@default\",\"font-size\":12,\"font-style\":\"normal\",\"font-weight\":\"500\",\"letter-spacing\":2,\"line-height\":12,\"text-decoration\":\"none\",\"text-align\":\"right\",\"text-transform\":\"uppercase\"},\"nav\":{\"padding\":{\"bottom\":\"15\",\"left\":\"15\",\"right\":\"15\",\"top\":\"15\"},\"icon\":{\"size\":24},\"margin\":{\"left\":\"5\",\"right\":\"5\"},\"border\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\",\"color\":\"@border\",\"style\":\"solid\",\"radius\":\"0\",\"width\":\"0\"},\"normal\":{\"color\":\"@title\",\"background\":\"rgba(255,255,255,0)\"},\"hover\":{\"color\":\"@primary\",\"background\":\"rgba(255,255,255,0)\"}},\"sub\":{\"padding\":{\"bottom\":\"20\",\"left\":\"20\",\"right\":\"20\",\"top\":\"20\"},\"icon\":{\"size\":24},\"border\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\",\"color\":\"@border\",\"style\":\"solid\",\"radius\":\"0\",\"width\":\"1\"},\"normal\":{\"color\":\"@title\",\"background\":\"rgba(0,0,0,0)\"},\"hover\":{\"color\":\"@title-inverse\",\"background\":\"@primary\"}},\"sub-typography\":{\"font-family\":\"@default\",\"font-size\":12,\"font-style\":\"normal\",\"font-weight\":\"500\",\"letter-spacing\":2,\"line-height\":12,\"text-decoration\":\"none\",\"text-align\":\"left\",\"text-transform\":\"uppercase\"},\"dropdown\":{\"width\":300,\"animation\":{\"effect\":\"fadeInUp\",\"duration\":\"0.4\"},\"padding\":{\"bottom\":\"20\",\"left\":\"20\",\"right\":\"20\",\"top\":\"20\"}},\"background\":{\"color\":\"@bg-secondary\"},\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"}},\"tablet\":{\"disable\":\"0\"},\"tablet-portrait\":{\"nav-typography\":{\"text-align\":\"left\"}},\"phone\":{\"disable\":\"0\"},\"hamburger\":{\"enable\":true,\"collapse\":true,\"open\":\"@icon\",\"open-align\":\"right\",\"close\":\"@icon\",\"close-align\":\"right\",\"position\":\"\",\"background\":\"@bg-primary\"},\"layout\":{\"layout\":\"\"},\"type\":\"menu\",\"access\":1,\"suffix\":\"\",\"integration\":\"1\",\"phone-portrait\":{},\"presets\":\"\"}},\"html\":\"<div class=\\\"ba-wrapper\\\">\\n    <div class=\\\"ba-section row-fluid\\\" id=\\\"item-179497138800\\\">\\n        <div class=\\\"ba-overlay\\\"><\\/div>\\n        <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n            <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n                <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                    Header                <\\/span>\\n            <\\/span>\\n            <div class=\\\"ba-buttons-wrapper\\\">\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-plus-circle add-columns\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        New Row                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Edit                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-text\\\">\\n                    Header                <\\/span>\\n            <\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-box-model\\\">\\n            <div class=\\\"ba-bm-top\\\"><\\/div>\\n            <div class=\\\"ba-bm-left\\\"><\\/div>\\n            <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n            <div class=\\\"ba-bm-right\\\"><\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-section-items\\\">\\n            \\n        <div class=\\\"ba-row-wrapper ba-container\\\">\\n    <div class=\\\"ba-row row-fluid\\\" id=\\\"item-14960529410\\\">\\n        <div class=\\\"ba-overlay\\\"><\\/div>\\n        <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n            <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n                <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                    Row                <\\/span>\\n            <\\/span>\\n            <div class=\\\"ba-buttons-wrapper\\\">\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Edit                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-copy copy-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Copy                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-graphic-eq modify-columns\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">Modify Columns<\\/span><\\/span><span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-delete delete-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Delete                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-text\\\">\\n                    Row                <\\/span>\\n            <\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-box-model\\\">\\n            <div class=\\\"ba-bm-top\\\"><\\/div>\\n            <div class=\\\"ba-bm-left\\\"><\\/div>\\n            <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n            <div class=\\\"ba-bm-right\\\"><\\/div>\\n        <\\/div>\\n        \\n    \\n\\n\\n\\n<div class=\\\"column-wrapper\\\">\\n            <div class=\\\"ba-grid-column-wrapper span2\\\" data-span=\\\"2\\\" style=\\\"\\\">\\n                <div class=\\\"ba-grid-column column-content-align-middle\\\" id=\\\"item-14960529411\\\">\\n                    <div class=\\\"ba-overlay\\\"><\\/div>\\n                    <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n                        <div class=\\\"ba-buttons-wrapper\\\">\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-plus-circle add-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Add new element                                <\\/span>\\n                            <\\/span>\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Edit                                <\\/span>\\n                            <\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-sort-amount-desc add-columns-in-columns\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">Nested Rows<\\/span><\\/span>\\n                        <\\/div>\\n                    <\\/div>\\n                    <div class=\\\"ba-box-model\\\">\\n                        <div class=\\\"ba-bm-top\\\"><\\/div>\\n                        <div class=\\\"ba-bm-left\\\"><\\/div>\\n                        <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n                        <div class=\\\"ba-bm-right\\\"><\\/div>\\n                    <\\/div>\\n                    <div class=\\\"ba-item-logo ba-item\\\" id=\\\"item-179497138803\\\">\\n    <div class=\\\"ba-logo-wrapper\\\">\\n        <a href=\\\"http:\\/\\/localhost\\/softdev\\/\\\">\\n            <img src=\\\"components\\/com_gridbox\\/assets\\/images\\/gridbox.svg\\\" alt=\\\"\\\"><\\/a>\\n    <\\/div>\\n    <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n        <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n            <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n            <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                Item            <\\/span>\\n        <\\/span>\\n        <div class=\\\"ba-buttons-wrapper\\\">\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Edit                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-copy copy-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Copy                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-globe add-library\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Add to Library                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-delete delete-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Delete                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-text\\\">\\n                Item            <\\/span>\\n        <\\/div>\\n    <\\/div>\\n    <div class=\\\"ba-box-model\\\">\\n    <\\/div>\\n<\\/div>\\n<div class=\\\"empty-item\\\">\\n                        <span>\\n                            <i class=\\\"zmdi zmdi-layers\\\"><\\/i>\\n                            <span class=\\\"ba-tooltip add-section-tooltip\\\">\\n                                Add new element                            <\\/span>\\n                        <\\/span>\\n                    <\\/div>\\n                    <div class=\\\"column-info\\\">Span 2<\\/div>\\n                <\\/div>\\n            <\\/div>\\n            <div class=\\\"ba-column-resizer\\\">\\n                <span>\\n                    <i class=\\\"zmdi zmdi-more-vert\\\"><\\/i>\\n                <\\/span>\\n            <\\/div>\\n            <div class=\\\"ba-grid-column-wrapper span10 ba-tb-pt-10\\\" data-span=\\\"10\\\" style=\\\"\\\">\\n                <div class=\\\"ba-grid-column column-content-align-middle\\\" id=\\\"item-14960529412\\\">\\n                    <div class=\\\"ba-overlay\\\"><\\/div>\\n                    <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n                        <div class=\\\"ba-buttons-wrapper\\\">\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-plus-circle add-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Add new element                                <\\/span>\\n                            <\\/span>\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Edit                                <\\/span>\\n                            <\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-sort-amount-desc add-columns-in-columns\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">Nested Rows<\\/span><\\/span>\\n                        <\\/div>\\n                    <\\/div>\\n                    <div class=\\\"ba-box-model\\\">\\n                        <div class=\\\"ba-bm-top\\\"><\\/div>\\n                        <div class=\\\"ba-bm-left\\\"><\\/div>\\n                        <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n                        <div class=\\\"ba-bm-right\\\"><\\/div>\\n                    <\\/div>\\n                    <div class=\\\"ba-item-main-menu ba-item\\\" id=\\\"item-179497138805\\\"><div class=\\\"ba-menu-wrapper ba-hamburger-menu ba-collapse-submenu\\\"><div class=\\\"main-menu\\\"><div class=\\\"close-menu\\\"><i class=\\\"zmdi zmdi-close\\\"><\\/i><\\/div><div class=\\\"integration-wrapper\\\">[main_menu=1]<\\/div><\\/div><div class=\\\"open-menu\\\"><i class=\\\"zmdi zmdi-menu\\\"><\\/i><\\/div><\\/div><div class=\\\"ba-edit-item\\\" style=\\\"\\\"><span class=\\\"ba-edit-wrapper edit-settings\\\"><i class=\\\"zmdi zmdi-settings\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay\\\">                Item<\\/span><\\/span><div class=\\\"ba-buttons-wrapper\\\"><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">                    Edit<\\/span><\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-copy copy-item\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">                    Copy<\\/span><\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-globe add-library\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">                    Add to Library<\\/span><\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-delete delete-item\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">                    Delete<\\/span><\\/span><span class=\\\"ba-edit-text\\\">                Item<\\/span><\\/div><\\/div><div class=\\\"ba-box-model\\\"><\\/div><div class=\\\"ba-menu-backdrop\\\"><\\/div><\\/div>\\n                    <div class=\\\"empty-item\\\">\\n                        <span>\\n                            <i class=\\\"zmdi zmdi-layers\\\"><\\/i>\\n                            <span class=\\\"ba-tooltip add-section-tooltip\\\">\\n                                Add new element                            <\\/span>\\n                        <\\/span>\\n                    <\\/div>\\n                    <div class=\\\"column-info\\\">Span 10<\\/div>\\n                <\\/div>\\n            <\\/div>\\n        <\\/div>\\n<\\/div>\\n<\\/div>\\n<\\/div>\\n    <\\/div>\\n<\\/div>\"},\"footer\":{\"items\":{\"item-1494846679\":{\"desktop\":{\"body\":{\"color\":\"@text\",\"font-family\":\"Roboto\",\"font-size\":21,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":36,\"text-align\":\"left\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"p\":{\"color\":\"@text\",\"font-family\":\"@default\",\"font-size\":21,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":36,\"text-align\":\"left\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h1\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":56,\"font-style\":\"normal\",\"font-weight\":\"700\",\"letter-spacing\":0,\"line-height\":65,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h2\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":40,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":50,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h3\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":32,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":42,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h4\":{\"color\":\"@text\",\"font-family\":\"@default\",\"font-size\":24,\"font-style\":\"normal\",\"font-weight\":\"300\",\"letter-spacing\":0,\"line-height\":42,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h5\":{\"color\":\"@title\",\"font-family\":\"@default\",\"font-size\":20,\"font-style\":\"normal\",\"font-weight\":\"900\",\"letter-spacing\":0,\"line-height\":30,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"none\"},\"h6\":{\"color\":\"@subtitle\",\"font-family\":\"@default\",\"font-size\":14,\"font-style\":\"normal\",\"font-weight\":\"500\",\"letter-spacing\":2,\"line-height\":18,\"text-align\":\"center\",\"text-decoration\":\"none\",\"text-transform\":\"uppercase\"},\"links\":{\"color\":\"@secondary\",\"hover-color\":\"@hover\"},\"animation\":{\"duration\":\"0.9\",\"effect\":\"\",\"delay\":0},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"100\",\"left\":\"0\",\"right\":\"0\",\"top\":\"100\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-secondary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"fullscreen\":\"0\",\"disable\":0,\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false,\"fullwidth\":true},\"image\":{\"image\":\"images\\/asdasdasd.jpg\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{\"disable\":\"0\",\"padding\":{\"right\":\"25\",\"left\":\"25\"}},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.5,\"type\":\"mousemove\"},\"type\":\"footer\",\"max-width\":\"100%\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{\"padding\":{\"right\":\"0\",\"left\":\"0\"}},\"phone-portrait\":{},\"access_view\":1,\"presets\":\"\"},\"item-15204640860\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primary\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"gutter\":\"1\",\"fullscreen\":\"0\",\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"shape\":{\"top\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"},\"bottom\":{\"effect\":\"\",\"color\":\"@primary\",\"value\":\"50\"}},\"full\":{\"fullscreen\":false,\"fullwidth\":false},\"image\":{\"image\":\"\"},\"view\":{\"gutter\":true}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"invert\":false,\"offset\":0.3,\"type\":\"mousemove\"},\"type\":\"row\",\"max-width\":\"1170px\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"access_view\":1,\"presets\":\"\"},\"item-15204640861\":{\"desktop\":{\"animation\":{\"duration\":\"0.9\",\"delay\":\"0\",\"effect\":\"\"},\"border\":{\"bottom\":\"0\",\"color\":\"@border\",\"left\":\"0\",\"right\":\"0\",\"style\":\"solid\",\"radius\":0,\"top\":\"0\",\"width\":\"1\"},\"margin\":{\"bottom\":\"0\",\"top\":\"0\"},\"padding\":{\"bottom\":\"0\",\"left\":\"0\",\"right\":\"0\",\"top\":\"0\"},\"background\":{\"type\":\"none\",\"color\":\"@bg-primay\",\"image\":{\"attachment\":\"scroll\",\"image\":\"\",\"position\":\"center center\",\"repeat\":\"no-repeat\",\"size\":\"cover\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\"},\"gradient\":{\"effect\":\"linear\",\"angle\":\"45\",\"color1\":\"#08aeea\",\"position1\":\"0\",\"color2\":\"#2af598\",\"position2\":\"100\"}},\"overlay\":{\"color\":\"rgba(0, 0, 0, 0)\",\"type\":\"color\",\"gradient\":{\"effect\":\"linear\",\"angle\":\"225\",\"color1\":\"rgba(8, 174, 234, 0.75)\",\"position1\":\"0\",\"color2\":\"rgba(42, 245, 152, 0.75)\",\"position2\":\"100\"}},\"fullscreen\":\"0\",\"disable\":\"0\",\"shadow\":{\"value\":0,\"color\":\"@shadow\"},\"full\":{\"fullscreen\":false},\"image\":{\"image\":\"\"},\"video\":{\"type\":\"youtube\",\"id\":\"\",\"mute\":\"1\",\"start\":\"0\",\"quality\":\"hd720\",\"image\":\"\",\"source\":\"\"}},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"parallax\":{\"enable\":false,\"offset\":0.1,\"type\":\"mousemove\"},\"content_align\":\"column-content-align-middle\",\"type\":\"column\",\"access\":1,\"suffix\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{},\"presets\":\"\",\"access_view\":1},\"item-15312786640\":{\"desktop\":{\"margin\":{\"bottom\":\"25\",\"top\":\"25\"},\"p\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h1\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h2\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h3\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h4\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h5\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"h6\":{\"font-family\":\"@default\",\"font-weight\":\"@default\"},\"links\":{},\"disable\":\"0\"},\"tablet\":{\"disable\":\"0\"},\"phone\":{\"disable\":\"0\"},\"type\":\"text\",\"access\":1,\"suffix\":\"\",\"presets\":\"\",\"tablet-portrait\":{},\"phone-portrait\":{}}},\"html\":\"<div class=\\\"ba-wrapper\\\">\\n    <div class=\\\"ba-section row-fluid\\\" id=\\\"item-1494846679\\\">\\n        <div class=\\\"ba-overlay\\\"><\\/div>\\n        <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n            <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n                <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                    Footer                <\\/span>\\n            <\\/span>\\n            <div class=\\\"ba-buttons-wrapper\\\">\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-plus-circle add-columns\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        New Row                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Edit                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-text\\\">\\n                    Footer                <\\/span>\\n            <\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-box-model\\\">\\n            <div class=\\\"ba-bm-top\\\"><\\/div>\\n            <div class=\\\"ba-bm-left\\\"><\\/div>\\n            <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n            <div class=\\\"ba-bm-right\\\"><\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-section-items\\\">\\n        \\n\\n\\n\\n\\n<div class=\\\"ba-row-wrapper ba-container\\\">\\n    <div class=\\\"ba-row row-fluid\\\" id=\\\"item-15204640860\\\">\\n        <div class=\\\"ba-overlay\\\"><\\/div>\\n        <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n            <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n                <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                    Row                <\\/span>\\n            <\\/span>\\n            <div class=\\\"ba-buttons-wrapper\\\">\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Edit                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-copy copy-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Copy                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-graphic-eq modify-columns\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">Modify Columns<\\/span><\\/span><span class=\\\"ba-edit-wrapper\\\">\\n                    <i class=\\\"zmdi zmdi-delete delete-item\\\"><\\/i>\\n                    <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                        Delete                    <\\/span>\\n                <\\/span>\\n                <span class=\\\"ba-edit-text\\\">\\n                    Row                <\\/span>\\n            <\\/div>\\n        <\\/div>\\n        <div class=\\\"ba-box-model\\\">\\n            <div class=\\\"ba-bm-top\\\"><\\/div>\\n            <div class=\\\"ba-bm-left\\\"><\\/div>\\n            <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n            <div class=\\\"ba-bm-right\\\"><\\/div>\\n        <\\/div>\\n        <div class=\\\"column-wrapper\\\">\\n            <div class=\\\"span12 ba-grid-column-wrapper\\\" data-span=\\\"12\\\">\\n                <div class=\\\"ba-grid-column column-content-align-middle\\\" id=\\\"item-15204640861\\\">\\n                    <div class=\\\"ba-overlay\\\"><\\/div>\\n                    <div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n                        <div class=\\\"ba-buttons-wrapper\\\">\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-plus-circle add-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Add new element                                <\\/span>\\n                            <\\/span>\\n                            <span class=\\\"ba-edit-wrapper\\\">\\n                                <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                                    Edit                                <\\/span>\\n                            <\\/span><span class=\\\"ba-edit-wrapper\\\"><i class=\\\"zmdi zmdi-sort-amount-desc add-columns-in-columns\\\"><\\/i><span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">Nested Row<\\/span><\\/span>\\n                        <\\/div>\\n                    <\\/div>\\n                    <div class=\\\"ba-box-model\\\">\\n                        <div class=\\\"ba-bm-top\\\"><\\/div>\\n                        <div class=\\\"ba-bm-left\\\"><\\/div>\\n                        <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n                        <div class=\\\"ba-bm-right\\\"><\\/div>\\n                    <\\/div>\\n                    \\n\\n\\n\\n\\n\\n<div class=\\\"ba-item-text ba-item\\\" id=\\\"item-15312786640\\\">\\n\\t<div class=\\\"content-text\\\" contenteditable=\\\"true\\\">\\n        <p><br><\\/p>\\n    <\\/div>\\n\\t<div class=\\\"ba-edit-item\\\" style=\\\"\\\">\\n        <span class=\\\"ba-edit-wrapper edit-settings\\\">\\n            <i class=\\\"zmdi zmdi-settings\\\"><\\/i>\\n            <span class=\\\"ba-tooltip tooltip-delay\\\">\\n                Item            <\\/span>\\n        <\\/span>\\n        <div class=\\\"ba-buttons-wrapper\\\">\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-edit edit-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Edit                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-copy copy-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Copy                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-globe add-library\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Add to Library                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-wrapper\\\">\\n                <i class=\\\"zmdi zmdi-delete delete-item\\\"><\\/i>\\n                <span class=\\\"ba-tooltip tooltip-delay settings-tooltip\\\">\\n                    Delete                <\\/span>\\n            <\\/span>\\n            <span class=\\\"ba-edit-text\\\">\\n                Item            <\\/span>\\n        <\\/div>\\n    <\\/div>\\n    <div class=\\\"ba-box-model\\\">\\n        <div class=\\\"ba-bm-top\\\"><\\/div>\\n        <div class=\\\"ba-bm-left\\\"><\\/div>\\n        <div class=\\\"ba-bm-bottom\\\"><\\/div>\\n        <div class=\\\"ba-bm-right\\\"><\\/div>\\n    <\\/div>\\n<\\/div>\\n\\n<div class=\\\"empty-item\\\">\\n                        <span>\\n                            <i class=\\\"zmdi zmdi-layers\\\"><\\/i>\\n                            <span class=\\\"ba-tooltip add-section-tooltip\\\">\\n                                Add new element                            <\\/span>\\n                        <\\/span>\\n                    <\\/div>\\n                    <div class=\\\"column-info\\\">\\n                        Span 12                    <\\/div>\\n                <\\/div>\\n            <\\/div>\\n        <\\/div>\\n<\\/div>\\n<\\/div>\\n\\n<\\/div>\\n    <\\/div>\\n<\\/div>\"},\"layout\":\"\",\"fonts\":\"{\\\"Roboto\\\":[\\\"300\\\",\\\"700\\\",\\\"900\\\",\\\"500\\\"]}\",\"image\":\"\",\"time\":\"13.26.18\"}'),
(11, 'tx_morph', 0, '0', 'tx_morph - Default', '{\"enable_preloader\":\"1\",\"go_to_top\":\"0\",\"addon_offcanvas_pos\":\"left\",\"fixed_footer\":\"0\",\"header_transparent\":\"0\",\"nav_sticky\":\"1\",\"header_variation\":\"default.php\",\"social_enable\":\"0\",\"box_layout\":\"0\",\"box_image_or_color\":\"bg_img\",\"box_layout_img\":\"\",\"box_layout_bg_color\":\"\",\"box_layout_width\":\"90%\",\"video_bg_enable\":\"0\",\"enable_copyright\":\"1\",\"copyright_text\":\"Copyright \\u00a9 2017 Joomla Template. All Rights Reserved. Design & Developed by <a href=\'https:\\/\\/www.themexpert.com\\/\' title=\'ThemeXpert\'>ThemeXpert<\\/a>\",\"tx_credit\":\"1\",\"custom_error_page\":\"0\",\"custom_comingsoon_page\":\"0\",\"enable_body_font\":\"0\",\"body_font\":\"\",\"enable_h1_font\":\"0\",\"h1_font\":\"\",\"enable_h2_font\":\"0\",\"h2_font\":\"\",\"enable_h3_font\":\"0\",\"h3_font\":\"\",\"enable_h4_font\":\"0\",\"h4_font\":\"\",\"enable_h5_font\":\"0\",\"h5_font\":\"\",\"enable_h6_font\":\"0\",\"h6_font\":\"\",\"enable_navigation_font\":\"0\",\"navigation_font\":\"\",\"show_post_format\":\"0\",\"show_comments\":\"0\",\"commenting_engine\":\"\",\"fb_width\":\"500\",\"fb_cpp\":\"10\",\"disqus_devmode\":\"0\",\"comments_count\":\"0\",\"social_share\":\"0\"}');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_ucm_base`
--

DROP TABLE IF EXISTS `bt8w9_ucm_base`;
CREATE TABLE IF NOT EXISTS `bt8w9_ucm_base` (
  `ucm_id` int(10) UNSIGNED NOT NULL,
  `ucm_item_id` int(10) NOT NULL,
  `ucm_type_id` int(11) NOT NULL,
  `ucm_language_id` int(11) NOT NULL,
  PRIMARY KEY (`ucm_id`),
  KEY `idx_ucm_item_id` (`ucm_item_id`),
  KEY `idx_ucm_type_id` (`ucm_type_id`),
  KEY `idx_ucm_language_id` (`ucm_language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_ucm_content`
--

DROP TABLE IF EXISTS `bt8w9_ucm_content`;
CREATE TABLE IF NOT EXISTS `bt8w9_ucm_content` (
  `core_content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `core_type_alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'FK to the content types table',
  `core_title` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `core_body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_state` tinyint(1) NOT NULL DEFAULT '0',
  `core_checked_out_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_checked_out_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_featured` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `core_metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'JSON encoded metadata properties.',
  `core_created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Most recent user that modified',
  `core_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_content_item_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID from the individual type table',
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `core_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_urls` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `core_ordering` int(11) NOT NULL DEFAULT '0',
  `core_metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'A reference to enable linkages to external data sets.',
  `core_type_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`core_content_id`),
  KEY `tag_idx` (`core_state`,`core_access`),
  KEY `idx_access` (`core_access`),
  KEY `idx_alias` (`core_alias`(100)),
  KEY `idx_language` (`core_language`),
  KEY `idx_title` (`core_title`(100)),
  KEY `idx_modified_time` (`core_modified_time`),
  KEY `idx_created_time` (`core_created_time`),
  KEY `idx_content_type` (`core_type_alias`(100)),
  KEY `idx_core_modified_user_id` (`core_modified_user_id`),
  KEY `idx_core_checked_out_user_id` (`core_checked_out_user_id`),
  KEY `idx_core_created_user_id` (`core_created_user_id`),
  KEY `idx_core_type_id` (`core_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contains core content data in name spaced fields';

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_ucm_history`
--

DROP TABLE IF EXISTS `bt8w9_ucm_history`;
CREATE TABLE IF NOT EXISTS `bt8w9_ucm_history` (
  `version_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ucm_item_id` int(10) UNSIGNED NOT NULL,
  `ucm_type_id` int(10) UNSIGNED NOT NULL,
  `version_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Optional version name',
  `save_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `character_count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Number of characters in this version.',
  `sha1_hash` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'SHA1 hash of the version_data column.',
  `version_data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'json-encoded string of version data',
  `keep_forever` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=auto delete; 1=keep',
  PRIMARY KEY (`version_id`),
  KEY `idx_ucm_item_id` (`ucm_type_id`,`ucm_item_id`),
  KEY `idx_save_date` (`save_date`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_ucm_history`
--

INSERT INTO `bt8w9_ucm_history` (`version_id`, `ucm_item_id`, `ucm_type_id`, `version_note`, `save_date`, `editor_user_id`, `character_count`, `sha1_hash`, `version_data`, `keep_forever`) VALUES
(1, 8, 5, '', '2018-07-08 14:41:03', 857, 457, '09d3a7d0a063d2c88e4708c487845ac1bb52e3d1', '{\"id\":8,\"asset_id\":56,\"parent_id\":\"1\",\"lft\":\"11\",\"rgt\":12,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"Blog\",\"alias\":\"blog\",\"note\":null,\"description\":\"\",\"published\":1,\"checked_out\":null,\"checked_out_time\":null,\"access\":1,\"params\":\"\",\"metadesc\":null,\"metakey\":null,\"metadata\":null,\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 14:41:03\",\"modified_user_id\":null,\"modified_time\":\"2018-07-08 14:41:03\",\"hits\":null,\"language\":\"*\",\"version\":null}', 0),
(2, 9, 5, '', '2018-07-08 14:41:03', 857, 464, '8372ad9394a2d7536d371ccc9b016ca18de08755', '{\"id\":9,\"asset_id\":57,\"parent_id\":\"1\",\"lft\":\"13\",\"rgt\":14,\"level\":1,\"path\":\"blog\",\"extension\":\"com_content\",\"title\":\"Help\",\"alias\":\"help\",\"note\":\"\",\"description\":\"\",\"published\":1,\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"access\":1,\"params\":\"\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 14:41:03\",\"modified_user_id\":\"0\",\"modified_time\":\"2018-07-08 14:41:03\",\"hits\":\"0\",\"language\":\"*\",\"version\":\"1\"}', 0),
(3, 1, 1, '', '2018-07-08 14:41:03', 857, 689, '3489df09b6fa1cbab728777b7dfe57fcc920bc20', '{\"id\":1,\"asset_id\":58,\"title\":\"About\",\"alias\":\"about\",\"introtext\":\"<p>This tells you a bit about this blog and the person who writes it. <\\/p><p>When you are logged in you will be able to edit this page by selecting the edit icon.<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"9\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":null,\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":1,\"ordering\":2,\"metakey\":\"\",\"metadesc\":\"\",\"access\":1,\"hits\":null,\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(4, 2, 1, '', '2018-07-08 14:41:03', 857, 2377, 'e3d8f516dd7b391731e488a80061b2a4b5b6addc', '{\"id\":2,\"asset_id\":59,\"title\":\"Working on Your Site\",\"alias\":\"working-on-your-site\",\"introtext\":\"<p>Here are some basic tips for working on your site.<\\/p><ul><li>Joomla! has a \'front end\' that you are looking at now and an \'administrator\' or back end\' which is where you do the more advanced work of creating your site such as setting up the menus and deciding what modules to show. You need to login to the administrator separately using the same user name and password that you used to login to this part of the site.<\\/li><li>One of the first things you will probably want to do is change the site title and tag line and to add a logo. To do this select the Template Settings link in the top menu. To change your site description, browser title, default email and other items, select Site Settings. More advanced configuration options are available in the administrator.<\\/li><li>To totally change the look of your site you will probably want to install a new template. In the Extensions menu select Extensions Manager and then go to the Install tab. There are many free and commercial templates available for Joomla.<\\/li><li>As you have already seen, you can control who can see different parts of you site. When you work with modules, articles or weblinks setting the Access level to Registered will mean that only logged in users can see them<\\/li><li>When you create a new article or other kind of content you also can save it as Published or Unpublished. If it is Unpublished site visitors will not be able to see it but you will.<\\/li><li>You can learn much more about working with Joomla from the <a href=\'https:\\/\\/docs.joomla.org\\/\'>Joomla documentation site<\\/a> and get help from other users at the <a href=\'https:\\/\\/forum.joomla.org\\/\'>Joomla forums<\\/a>. In the administrator there are help buttons on every page that provide detailed information about the functions on that page.<\\/li><\\/ul>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"9\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":\"0\",\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":2,\"ordering\":1,\"metakey\":\"\",\"metadesc\":\"\",\"access\":3,\"hits\":\"0\",\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(5, 3, 1, '', '2018-07-08 14:41:03', 857, 1004, 'ea24f73a0e04fae4f1006ce3640a07162b626180', '{\"id\":3,\"asset_id\":60,\"title\":\"Welcome to your blog\",\"alias\":\"welcome-to-your-blog\",\"introtext\":\"<p>This is a sample blog posting.<\\/p><p>If you log in to the site (the Author Login link is on the very bottom of this page) you will be able to edit it and all of the other existing articles. You will also be able to create a new article and make other changes to the site.<\\/p><p>As you add and modify articles you will see how your site changes and also how you can customise it in various ways.<\\/p><p>Go ahead, you can\'t break it.<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"8\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":\"0\",\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":3,\"ordering\":2,\"metakey\":\"\",\"metadesc\":\"\",\"access\":1,\"hits\":\"0\",\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(6, 4, 1, '', '2018-07-08 14:41:03', 857, 1243, '9685aa000bfccb5d051f002a419adac57f16590c', '{\"id\":4,\"asset_id\":61,\"title\":\"About your home page\",\"alias\":\"about-your-home-page\",\"introtext\":\"<p>Your home page is set to display the four most recent articles from the blog category in a column. Then there are links to the 4 next oldest articles. You can change those numbers by editing the content options settings in the blog tab in your site administrator. There is a link to your site administrator in the top menu.<\\/p><p>If you want to have your blog post broken into two parts, an introduction and then a full length separate page, use the Read More button to insert a break.<\\/p>\",\"fulltext\":\"<p>On the full page you will see both the introductory content and the rest of the article. You can change the settings to hide the introduction if you want.<\\/p><p><\\/p><p><\\/p><p><\\/p>\",\"state\":1,\"catid\":\"8\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":\"0\",\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":4,\"ordering\":1,\"metakey\":\"\",\"metadesc\":\"\",\"access\":1,\"hits\":\"0\",\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(7, 5, 1, '', '2018-07-08 14:41:03', 857, 1658, '08b3bef2a43e375db48255c850aadc965772ca16', '{\"id\":5,\"asset_id\":62,\"title\":\"Your Modules\",\"alias\":\"your-modules\",\"introtext\":\"<p>Your site has some commonly used modules already preconfigured. These include:<\\/p><ul><li>Image Module which holds the image beneath the menu. This is a Custom module that you can edit to change the image.<\\/li><li>Most Read Posts which lists articles based on the number of times they have been read.<\\/li><li>Older Articles which lists out articles by month.<\\/li><li>Syndicate which allows your readers to read your posts in a news reader.<\\/li><li>Popular Tags, which will appear if you use tagging on your articles. Enter a tag in the Tags field when editing.<\\/li><\\/ul><p>Each of these modules has many options which you can experiment with in the Module Manager in your site Administrator. Moving your mouse over a module and selecting the edit icon will take you to an edit screen for that module. Always be sure to save and close any module you edit.<\\/p><p>Joomla! also includes many other modules you can incorporate in your site. As you develop your site you may want to add more module that you can find at the <a href=\'https:\\/\\/extensions.joomla.org\\/\'>Joomla Extensions Directory.<\\/a><\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"8\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":\"0\",\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":5,\"ordering\":0,\"metakey\":\"\",\"metadesc\":\"\",\"access\":1,\"hits\":\"0\",\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(8, 6, 1, '', '2018-07-08 14:41:03', 857, 1059, '066e623122f610f1c4746a4f866ba39abab8efcb', '{\"id\":6,\"asset_id\":63,\"title\":\"Your Template\",\"alias\":\"your-template\",\"introtext\":\"<p>Templates control the look and feel of your website.<\\/p><p>This blog is installed with the Protostar template.<\\/p><p>You can edit the options by selecting the Working on Your Site, Template Settings link in the top menu (visible when you login).<\\/p><p>For example you can change the site background color, highlights color, site title, site description and title font used.<\\/p><p>More options are available in the site administrator. You may also install a new template using the extension manager.<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"8\",\"created\":\"2018-07-08 14:41:03\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:41:03\",\"modified_by\":\"0\",\"checked_out\":\"0\",\"checked_out_time\":\"0000-00-00 00:00:00\",\"publish_up\":\"2018-07-08 14:41:03\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"\",\"urls\":\"{}\",\"attribs\":\"{}\",\"version\":6,\"ordering\":0,\"metakey\":\"\",\"metadesc\":\"\",\"access\":1,\"hits\":\"0\",\"metadata\":\"{}\",\"featured\":0,\"language\":\"*\",\"xreference\":\"\"}', 0),
(9, 7, 1, '', '2018-07-08 14:52:44', 857, 1737, '90faf5d75f968186b19647e7e88e697b38fb031a', '{\"id\":7,\"asset_id\":80,\"title\":\"About\",\"alias\":\"about\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-08 14:52:44\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:52:44\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-08 14:52:44\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(10, 8, 1, '', '2018-07-08 14:53:05', 857, 1747, '1f3783c5d5b447042e8ae6547e5b211735c9a8b8', '{\"id\":8,\"asset_id\":81,\"title\":\"Contact Us\",\"alias\":\"contact-us\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-08 14:53:05\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:53:05\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-08 14:53:05\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(11, 9, 1, '', '2018-07-08 14:53:19', 857, 1735, '599a52dfd0382fa0feaa798916ba4743c85a28e1', '{\"id\":9,\"asset_id\":82,\"title\":\"Home\",\"alias\":\"home\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-08 14:53:19\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:53:19\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-08 14:53:19\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(12, 10, 1, '', '2018-07-08 14:53:43', 857, 1744, '79e7a1448e4f19755d1661c8ad688181f6701646', '{\"id\":10,\"asset_id\":83,\"title\":\"Register\",\"alias\":\"register\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-08 14:53:43\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:53:43\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-08 14:53:43\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(13, 9, 1, '', '2018-07-08 14:54:48', 857, 1753, '0b4092a8a5da4e26f614be55d4f1779667859239', '{\"id\":9,\"asset_id\":\"82\",\"title\":\"Home\",\"alias\":\"home\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":\"0\",\"created\":\"2018-07-08 14:53:19\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-08 14:54:48\",\"modified_by\":\"857\",\"checked_out\":\"857\",\"checked_out_time\":\"2018-07-08 14:54:00\",\"publish_up\":\"2018-07-08 14:53:19\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":2,\"ordering\":\"1\",\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":\"0\",\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(14, 10, 5, '', '2018-07-08 14:59:43', 857, 546, '5491eb00e0626381c65b36d87f9f1a2c30719591', '{\"id\":10,\"asset_id\":84,\"parent_id\":\"1\",\"lft\":\"15\",\"rgt\":16,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"Home\",\"alias\":\"home\",\"note\":\"\",\"description\":\"\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 14:59:43\",\"modified_user_id\":null,\"modified_time\":\"2018-07-08 14:59:43\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0),
(15, 11, 5, '', '2018-07-08 14:59:50', 857, 554, '86f4a46532ffc3cc5d1e0e17c1d4d6443a4fff2c', '{\"id\":11,\"asset_id\":85,\"parent_id\":\"1\",\"lft\":\"17\",\"rgt\":18,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"About us\",\"alias\":\"about-us\",\"note\":\"\",\"description\":\"\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 14:59:50\",\"modified_user_id\":null,\"modified_time\":\"2018-07-08 14:59:50\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0),
(16, 12, 5, '', '2018-07-08 15:00:02', 857, 558, '99c83fbf0d15dbda6bd66c820ad4bb99606a4c2a', '{\"id\":12,\"asset_id\":86,\"parent_id\":\"1\",\"lft\":\"19\",\"rgt\":20,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"Contact Us\",\"alias\":\"contact-us\",\"note\":\"\",\"description\":\"\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 15:00:02\",\"modified_user_id\":null,\"modified_time\":\"2018-07-08 15:00:02\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0),
(17, 13, 5, '', '2018-07-08 15:00:10', 857, 554, '826f70afb725f402575b45db0ee7fa0d68d406c1', '{\"id\":13,\"asset_id\":87,\"parent_id\":\"1\",\"lft\":\"21\",\"rgt\":22,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"Register\",\"alias\":\"register\",\"note\":\"\",\"description\":\"\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-08 15:00:10\",\"modified_user_id\":null,\"modified_time\":\"2018-07-08 15:00:10\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0),
(18, 11, 1, '', '2018-07-09 06:39:07', 857, 1748, 'afb78bffb82980d62d16d956c418664501fc66dc', '{\"id\":11,\"asset_id\":89,\"title\":\"asdadadasd\",\"alias\":\"asdadadasd\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-09 06:39:07\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 06:39:07\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-09 06:39:07\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(19, 12, 1, '', '2018-07-09 06:39:10', 857, 1750, 'f4a3aeadcde8e721fc51028aeb48fa81033c7b89', '{\"id\":12,\"asset_id\":90,\"title\":\"asdadadasd\",\"alias\":\"asdadadasd-2\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-09 06:39:10\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 06:39:10\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-09 06:39:10\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(20, 13, 1, '', '2018-07-09 06:39:13', 857, 1750, '7164c171b99a1cbc719aee0d2adc21b60652673d', '{\"id\":13,\"asset_id\":91,\"title\":\"asdadadasd\",\"alias\":\"asdadadasd-3\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-09 06:39:13\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 06:39:13\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-09 06:39:13\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(21, 14, 1, '', '2018-07-09 08:14:14', 857, 1744, '0482cd0a8c3ba43bb384b0b57e2cd01e0cd95de2', '{\"id\":14,\"asset_id\":92,\"title\":\"SDSDSDSD\",\"alias\":\"sdsdsdsd\",\"introtext\":\"\",\"fulltext\":\"\",\"state\":1,\"catid\":null,\"created\":\"2018-07-09 08:14:14\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 08:14:14\",\"modified_by\":null,\"checked_out\":null,\"checked_out_time\":null,\"publish_up\":\"2018-07-09 08:14:14\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":1,\"ordering\":null,\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":null,\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(22, 14, 1, '', '2018-07-09 08:17:32', 857, 1817, '5040a57b866fbe8b0253f39f9e5099a07b4c767f', '{\"id\":14,\"asset_id\":\"92\",\"title\":\"SDSDSDSD\",\"alias\":\"sdsdsdsd\",\"introtext\":\"<p>awdawdasdasdasdasdasdadasdasdasdasdasdasdasdasd<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"0\",\"created\":\"2018-07-09 08:14:14\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 08:17:32\",\"modified_by\":\"857\",\"checked_out\":\"857\",\"checked_out_time\":\"2018-07-09 08:17:16\",\"publish_up\":\"2018-07-09 08:14:14\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":2,\"ordering\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":\"1\",\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(23, 14, 5, '', '2018-07-09 08:22:08', 857, 561, '9cdff4a8d33e6bc4ffa51e67f362993997ed2627', '{\"id\":14,\"asset_id\":93,\"parent_id\":\"1\",\"lft\":\"23\",\"rgt\":24,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"dddd\",\"alias\":\"dddd\",\"note\":\"\",\"description\":\"<p>sdasdad<\\/p>\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-09 08:22:08\",\"modified_user_id\":null,\"modified_time\":\"2018-07-09 08:22:08\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0),
(24, 14, 1, '', '2018-07-09 08:22:28', 857, 1818, '6266bbcbbd7b01714ca2a817faa0b0bfb6a3efa9', '{\"id\":14,\"asset_id\":\"92\",\"title\":\"SDSDSDSD\",\"alias\":\"sdsdsdsd\",\"introtext\":\"<p>awdawdasdasdasdasdasdadasdasdasdasdasdasdasdasd<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"14\",\"created\":\"2018-07-09 08:14:14\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 08:22:28\",\"modified_by\":\"857\",\"checked_out\":\"857\",\"checked_out_time\":\"2018-07-09 08:22:17\",\"publish_up\":\"2018-07-09 08:14:14\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"\\\",\\\"show_article_options\\\":\\\"\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":3,\"ordering\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":\"5\",\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(25, 14, 1, '', '2018-07-09 08:23:29', 857, 1820, 'aa7d3547efca4c0470abde21b900652cb848d330', '{\"id\":14,\"asset_id\":\"92\",\"title\":\"SDSDSDSD\",\"alias\":\"sdsdsdsd\",\"introtext\":\"<p>awdawdasdasdasdasdasdadasdasdasdasdasdasdasdasd<\\/p>\",\"fulltext\":\"\",\"state\":1,\"catid\":\"14\",\"created\":\"2018-07-09 08:14:14\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-09 08:23:29\",\"modified_by\":\"857\",\"checked_out\":\"857\",\"checked_out_time\":\"2018-07-09 08:23:00\",\"publish_up\":\"2018-07-09 08:14:14\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"0\\\",\\\"show_article_options\\\":\\\"0\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":4,\"ordering\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":\"6\",\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(26, 14, 1, '', '2018-07-11 03:37:21', 857, 1784, '170d4444c1ff965a9631621642e9f53e6599c89e', '{\"id\":14,\"asset_id\":\"92\",\"title\":\"About us\",\"alias\":\"sdsdsdsd\",\"introtext\":\"<p>ABOUT US<\\/p>\",\"fulltext\":\"\",\"state\":\"1\",\"catid\":\"14\",\"created\":\"2018-07-09 08:14:14\",\"created_by\":\"857\",\"created_by_alias\":\"\",\"modified\":\"2018-07-11 03:37:21\",\"modified_by\":\"857\",\"checked_out\":\"857\",\"checked_out_time\":\"2018-07-11 03:37:00\",\"publish_up\":\"2018-07-09 08:14:14\",\"publish_down\":\"0000-00-00 00:00:00\",\"images\":\"{\\\"image_intro\\\":\\\"\\\",\\\"float_intro\\\":\\\"\\\",\\\"image_intro_alt\\\":\\\"\\\",\\\"image_intro_caption\\\":\\\"\\\",\\\"image_fulltext\\\":\\\"\\\",\\\"float_fulltext\\\":\\\"\\\",\\\"image_fulltext_alt\\\":\\\"\\\",\\\"image_fulltext_caption\\\":\\\"\\\"}\",\"urls\":\"{\\\"urla\\\":false,\\\"urlatext\\\":\\\"\\\",\\\"targeta\\\":\\\"\\\",\\\"urlb\\\":false,\\\"urlbtext\\\":\\\"\\\",\\\"targetb\\\":\\\"\\\",\\\"urlc\\\":false,\\\"urlctext\\\":\\\"\\\",\\\"targetc\\\":\\\"\\\"}\",\"attribs\":\"{\\\"article_layout\\\":\\\"\\\",\\\"show_title\\\":\\\"\\\",\\\"link_titles\\\":\\\"\\\",\\\"show_tags\\\":\\\"\\\",\\\"show_intro\\\":\\\"\\\",\\\"info_block_position\\\":\\\"\\\",\\\"info_block_show_title\\\":\\\"\\\",\\\"show_category\\\":\\\"\\\",\\\"link_category\\\":\\\"\\\",\\\"show_parent_category\\\":\\\"\\\",\\\"link_parent_category\\\":\\\"\\\",\\\"show_associations\\\":\\\"\\\",\\\"show_author\\\":\\\"\\\",\\\"link_author\\\":\\\"\\\",\\\"show_create_date\\\":\\\"\\\",\\\"show_modify_date\\\":\\\"\\\",\\\"show_publish_date\\\":\\\"\\\",\\\"show_item_navigation\\\":\\\"\\\",\\\"show_icons\\\":\\\"\\\",\\\"show_print_icon\\\":\\\"\\\",\\\"show_email_icon\\\":\\\"\\\",\\\"show_vote\\\":\\\"\\\",\\\"show_hits\\\":\\\"\\\",\\\"show_noauth\\\":\\\"\\\",\\\"urls_position\\\":\\\"\\\",\\\"alternative_readmore\\\":\\\"\\\",\\\"article_page_title\\\":\\\"\\\",\\\"show_publishing_options\\\":\\\"0\\\",\\\"show_article_options\\\":\\\"0\\\",\\\"show_urls_images_backend\\\":\\\"\\\",\\\"show_urls_images_frontend\\\":\\\"\\\"}\",\"version\":5,\"ordering\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"access\":\"1\",\"hits\":\"21\",\"metadata\":\"{\\\"robots\\\":\\\"\\\",\\\"author\\\":\\\"\\\",\\\"rights\\\":\\\"\\\",\\\"xreference\\\":\\\"\\\"}\",\"featured\":\"0\",\"language\":\"*\",\"xreference\":\"\"}', 0),
(27, 15, 5, '', '2018-07-11 08:11:03', 857, 549, '4453cdcd847268b7bd765d3c2843c7bbec32c252', '{\"id\":15,\"asset_id\":111,\"parent_id\":\"1\",\"lft\":\"25\",\"rgt\":26,\"level\":1,\"path\":null,\"extension\":\"com_content\",\"title\":\"Items\",\"alias\":\"items\",\"note\":\"\",\"description\":\"\",\"published\":\"1\",\"checked_out\":null,\"checked_out_time\":null,\"access\":\"1\",\"params\":\"{\\\"category_layout\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"image_alt\\\":\\\"\\\"}\",\"metadesc\":\"\",\"metakey\":\"\",\"metadata\":\"{\\\"author\\\":\\\"\\\",\\\"robots\\\":\\\"\\\"}\",\"created_user_id\":\"857\",\"created_time\":\"2018-07-11 08:11:03\",\"modified_user_id\":null,\"modified_time\":\"2018-07-11 08:11:03\",\"hits\":\"0\",\"language\":\"*\",\"version\":null}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_updates`
--

DROP TABLE IF EXISTS `bt8w9_updates`;
CREATE TABLE IF NOT EXISTS `bt8w9_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `element` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `folder` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailsurl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `infourl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_query` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Available Updates';

--
-- Dumping data for table `bt8w9_updates`
--

INSERT INTO `bt8w9_updates` (`update_id`, `update_site_id`, `extension_id`, `name`, `description`, `element`, `type`, `folder`, `client_id`, `version`, `data`, `detailsurl`, `infourl`, `extra_query`) VALUES
(1, 2, 0, 'Armenian', '', 'pkg_hy-AM', 'package', '', 0, '3.4.4.1', '', 'https://update.joomla.org/language/details3/hy-AM_details.xml', '', ''),
(2, 2, 0, 'Malay', '', 'pkg_ms-MY', 'package', '', 0, '3.4.1.2', '', 'https://update.joomla.org/language/details3/ms-MY_details.xml', '', ''),
(3, 2, 0, 'Romanian', '', 'pkg_ro-RO', 'package', '', 0, '3.7.3.1', '', 'https://update.joomla.org/language/details3/ro-RO_details.xml', '', ''),
(4, 2, 0, 'Flemish', '', 'pkg_nl-BE', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/nl-BE_details.xml', '', ''),
(5, 2, 0, 'Chinese Traditional', '', 'pkg_zh-TW', 'package', '', 0, '3.8.0.1', '', 'https://update.joomla.org/language/details3/zh-TW_details.xml', '', ''),
(6, 2, 0, 'French', '', 'pkg_fr-FR', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/fr-FR_details.xml', '', ''),
(7, 2, 0, 'Galician', '', 'pkg_gl-ES', 'package', '', 0, '3.3.1.2', '', 'https://update.joomla.org/language/details3/gl-ES_details.xml', '', ''),
(8, 2, 0, 'Georgian', '', 'pkg_ka-GE', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/ka-GE_details.xml', '', ''),
(9, 2, 0, 'Greek', '', 'pkg_el-GR', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/el-GR_details.xml', '', ''),
(10, 2, 0, 'Japanese', '', 'pkg_ja-JP', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/ja-JP_details.xml', '', ''),
(11, 2, 0, 'Hebrew', '', 'pkg_he-IL', 'package', '', 0, '3.1.1.2', '', 'https://update.joomla.org/language/details3/he-IL_details.xml', '', ''),
(12, 2, 0, 'Bengali', '', 'pkg_bn-BD', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/bn-BD_details.xml', '', ''),
(13, 2, 0, 'Hungarian', '', 'pkg_hu-HU', 'package', '', 0, '3.8.7.1', '', 'https://update.joomla.org/language/details3/hu-HU_details.xml', '', ''),
(14, 2, 0, 'Afrikaans', '', 'pkg_af-ZA', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/af-ZA_details.xml', '', ''),
(15, 2, 0, 'Arabic Unitag', '', 'pkg_ar-AA', 'package', '', 0, '3.7.5.1', '', 'https://update.joomla.org/language/details3/ar-AA_details.xml', '', ''),
(16, 2, 0, 'Belarusian', '', 'pkg_be-BY', 'package', '', 0, '3.2.1.2', '', 'https://update.joomla.org/language/details3/be-BY_details.xml', '', ''),
(17, 2, 0, 'Bulgarian', '', 'pkg_bg-BG', 'package', '', 0, '3.6.5.2', '', 'https://update.joomla.org/language/details3/bg-BG_details.xml', '', ''),
(18, 2, 0, 'Catalan', '', 'pkg_ca-ES', 'package', '', 0, '3.8.3.3', '', 'https://update.joomla.org/language/details3/ca-ES_details.xml', '', ''),
(19, 2, 0, 'Chinese Simplified', '', 'pkg_zh-CN', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/zh-CN_details.xml', '', ''),
(20, 2, 0, 'Croatian', '', 'pkg_hr-HR', 'package', '', 0, '3.8.5.1', '', 'https://update.joomla.org/language/details3/hr-HR_details.xml', '', ''),
(21, 2, 0, 'Czech', '', 'pkg_cs-CZ', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/cs-CZ_details.xml', '', ''),
(22, 2, 0, 'Danish', '', 'pkg_da-DK', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/da-DK_details.xml', '', ''),
(23, 2, 0, 'Dutch', '', 'pkg_nl-NL', 'package', '', 0, '3.8.9.1', '', 'https://update.joomla.org/language/details3/nl-NL_details.xml', '', ''),
(24, 2, 0, 'Esperanto', '', 'pkg_eo-XX', 'package', '', 0, '3.8.8.1', '', 'https://update.joomla.org/language/details3/eo-XX_details.xml', '', ''),
(25, 2, 0, 'Estonian', '', 'pkg_et-EE', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/et-EE_details.xml', '', ''),
(26, 2, 0, 'Italian', '', 'pkg_it-IT', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/it-IT_details.xml', '', ''),
(27, 2, 0, 'Khmer', '', 'pkg_km-KH', 'package', '', 0, '3.4.5.1', '', 'https://update.joomla.org/language/details3/km-KH_details.xml', '', ''),
(28, 2, 0, 'Korean', '', 'pkg_ko-KR', 'package', '', 0, '3.8.7.3', '', 'https://update.joomla.org/language/details3/ko-KR_details.xml', '', ''),
(29, 2, 0, 'Latvian', '', 'pkg_lv-LV', 'package', '', 0, '3.7.3.1', '', 'https://update.joomla.org/language/details3/lv-LV_details.xml', '', ''),
(30, 2, 0, 'Macedonian', '', 'pkg_mk-MK', 'package', '', 0, '3.6.5.1', '', 'https://update.joomla.org/language/details3/mk-MK_details.xml', '', ''),
(31, 2, 0, 'Norwegian Bokmal', '', 'pkg_nb-NO', 'package', '', 0, '3.8.9.1', '', 'https://update.joomla.org/language/details3/nb-NO_details.xml', '', ''),
(32, 2, 0, 'Norwegian Nynorsk', '', 'pkg_nn-NO', 'package', '', 0, '3.4.2.1', '', 'https://update.joomla.org/language/details3/nn-NO_details.xml', '', ''),
(33, 2, 0, 'Persian', '', 'pkg_fa-IR', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/fa-IR_details.xml', '', ''),
(34, 2, 0, 'Polish', '', 'pkg_pl-PL', 'package', '', 0, '3.8.8.2', '', 'https://update.joomla.org/language/details3/pl-PL_details.xml', '', ''),
(35, 2, 0, 'Portuguese', '', 'pkg_pt-PT', 'package', '', 0, '3.8.2.1', '', 'https://update.joomla.org/language/details3/pt-PT_details.xml', '', ''),
(36, 2, 0, 'Russian', '', 'pkg_ru-RU', 'package', '', 0, '3.8.2.1', '', 'https://update.joomla.org/language/details3/ru-RU_details.xml', '', ''),
(37, 2, 0, 'English AU', '', 'pkg_en-AU', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/en-AU_details.xml', '', ''),
(38, 2, 0, 'Slovak', '', 'pkg_sk-SK', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/sk-SK_details.xml', '', ''),
(39, 2, 0, 'English US', '', 'pkg_en-US', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/en-US_details.xml', '', ''),
(40, 2, 0, 'Swedish', '', 'pkg_sv-SE', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/sv-SE_details.xml', '', ''),
(41, 2, 0, 'Syriac', '', 'pkg_sy-IQ', 'package', '', 0, '3.4.5.1', '', 'https://update.joomla.org/language/details3/sy-IQ_details.xml', '', ''),
(42, 2, 0, 'Tamil', '', 'pkg_ta-IN', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/ta-IN_details.xml', '', ''),
(43, 2, 0, 'Thai', '', 'pkg_th-TH', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/th-TH_details.xml', '', ''),
(44, 2, 0, 'Turkish', '', 'pkg_tr-TR', 'package', '', 0, '3.8.2.1', '', 'https://update.joomla.org/language/details3/tr-TR_details.xml', '', ''),
(45, 2, 0, 'Ukrainian', '', 'pkg_uk-UA', 'package', '', 0, '3.7.1.1', '', 'https://update.joomla.org/language/details3/uk-UA_details.xml', '', ''),
(46, 2, 0, 'Uyghur', '', 'pkg_ug-CN', 'package', '', 0, '3.7.5.1', '', 'https://update.joomla.org/language/details3/ug-CN_details.xml', '', ''),
(47, 2, 0, 'Albanian', '', 'pkg_sq-AL', 'package', '', 0, '3.1.1.2', '', 'https://update.joomla.org/language/details3/sq-AL_details.xml', '', ''),
(48, 2, 0, 'Basque', '', 'pkg_eu-ES', 'package', '', 0, '3.7.5.1', '', 'https://update.joomla.org/language/details3/eu-ES_details.xml', '', ''),
(49, 2, 0, 'Hindi', '', 'pkg_hi-IN', 'package', '', 0, '3.3.6.2', '', 'https://update.joomla.org/language/details3/hi-IN_details.xml', '', ''),
(50, 2, 0, 'German DE', '', 'pkg_de-DE', 'package', '', 0, '3.8.10.2', '', 'https://update.joomla.org/language/details3/de-DE_details.xml', '', ''),
(51, 2, 0, 'Portuguese Brazil', '', 'pkg_pt-BR', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/pt-BR_details.xml', '', ''),
(52, 2, 0, 'Serbian Latin', '', 'pkg_sr-YU', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/sr-YU_details.xml', '', ''),
(53, 2, 0, 'Spanish', '', 'pkg_es-ES', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/es-ES_details.xml', '', ''),
(54, 2, 0, 'Bosnian', '', 'pkg_bs-BA', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/bs-BA_details.xml', '', ''),
(55, 2, 0, 'Serbian Cyrillic', '', 'pkg_sr-RS', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/sr-RS_details.xml', '', ''),
(56, 2, 0, 'Vietnamese', '', 'pkg_vi-VN', 'package', '', 0, '3.2.1.2', '', 'https://update.joomla.org/language/details3/vi-VN_details.xml', '', ''),
(57, 2, 0, 'Bahasa Indonesia', '', 'pkg_id-ID', 'package', '', 0, '3.6.2.1', '', 'https://update.joomla.org/language/details3/id-ID_details.xml', '', ''),
(58, 2, 0, 'Finnish', '', 'pkg_fi-FI', 'package', '', 0, '3.8.1.1', '', 'https://update.joomla.org/language/details3/fi-FI_details.xml', '', ''),
(59, 2, 0, 'Swahili', '', 'pkg_sw-KE', 'package', '', 0, '3.8.8.1', '', 'https://update.joomla.org/language/details3/sw-KE_details.xml', '', ''),
(60, 2, 0, 'Montenegrin', '', 'pkg_srp-ME', 'package', '', 0, '3.3.1.2', '', 'https://update.joomla.org/language/details3/srp-ME_details.xml', '', ''),
(61, 2, 0, 'English CA', '', 'pkg_en-CA', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/en-CA_details.xml', '', ''),
(62, 2, 0, 'French CA', '', 'pkg_fr-CA', 'package', '', 0, '3.6.5.1', '', 'https://update.joomla.org/language/details3/fr-CA_details.xml', '', ''),
(63, 2, 0, 'Welsh', '', 'pkg_cy-GB', 'package', '', 0, '3.8.5.1', '', 'https://update.joomla.org/language/details3/cy-GB_details.xml', '', ''),
(64, 2, 0, 'Sinhala', '', 'pkg_si-LK', 'package', '', 0, '3.3.1.2', '', 'https://update.joomla.org/language/details3/si-LK_details.xml', '', ''),
(65, 2, 0, 'Dari Persian', '', 'pkg_prs-AF', 'package', '', 0, '3.4.4.2', '', 'https://update.joomla.org/language/details3/prs-AF_details.xml', '', ''),
(66, 2, 0, 'Turkmen', '', 'pkg_tk-TM', 'package', '', 0, '3.5.0.2', '', 'https://update.joomla.org/language/details3/tk-TM_details.xml', '', ''),
(67, 2, 0, 'Irish', '', 'pkg_ga-IE', 'package', '', 0, '3.8.7.1', '', 'https://update.joomla.org/language/details3/ga-IE_details.xml', '', ''),
(68, 2, 0, 'Dzongkha', '', 'pkg_dz-BT', 'package', '', 0, '3.6.2.1', '', 'https://update.joomla.org/language/details3/dz-BT_details.xml', '', ''),
(69, 2, 0, 'Slovenian', '', 'pkg_sl-SI', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/sl-SI_details.xml', '', ''),
(70, 2, 0, 'Spanish CO', '', 'pkg_es-CO', 'package', '', 0, '3.8.6.1', '', 'https://update.joomla.org/language/details3/es-CO_details.xml', '', ''),
(71, 2, 0, 'German CH', '', 'pkg_de-CH', 'package', '', 0, '3.8.10.2', '', 'https://update.joomla.org/language/details3/de-CH_details.xml', '', ''),
(72, 2, 0, 'German AT', '', 'pkg_de-AT', 'package', '', 0, '3.8.10.2', '', 'https://update.joomla.org/language/details3/de-AT_details.xml', '', ''),
(73, 2, 0, 'German LI', '', 'pkg_de-LI', 'package', '', 0, '3.8.10.2', '', 'https://update.joomla.org/language/details3/de-LI_details.xml', '', ''),
(74, 2, 0, 'German LU', '', 'pkg_de-LU', 'package', '', 0, '3.8.10.2', '', 'https://update.joomla.org/language/details3/de-LU_details.xml', '', ''),
(75, 2, 0, 'English NZ', '', 'pkg_en-NZ', 'package', '', 0, '3.8.10.1', '', 'https://update.joomla.org/language/details3/en-NZ_details.xml', '', ''),
(76, 5, 10004, 'Regular Labs - Advanced Module Manager', '', 'com_advancedmodules', 'component', '', 1, '7.7.1FREE', '', 'https://download.regularlabs.com/updates.xml?e=advancedmodulemanager&type=.xml', 'https://www.regularlabs.com/extensions/advancedmodulemanager#download', '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_update_sites`
--

DROP TABLE IF EXISTS `bt8w9_update_sites`;
CREATE TABLE IF NOT EXISTS `bt8w9_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  `extra_query` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Update Sites';

--
-- Dumping data for table `bt8w9_update_sites`
--

INSERT INTO `bt8w9_update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`, `extra_query`) VALUES
(1, 'Joomla! Core', 'collection', 'https://update.joomla.org/core/list.xml', 1, 1531741699, ''),
(2, 'Accredited Joomla! Translations', 'collection', 'https://update.joomla.org/language/translationlist_3.xml', 1, 1531741700, ''),
(3, 'Joomla! Update Component Update Site', 'extension', 'https://update.joomla.org/core/extensions/com_joomlaupdate.xml', 1, 1531741700, ''),
(4, 'WebInstaller Update Site', 'extension', 'https://appscdn.joomla.org/webapps/jedapps/webinstaller.xml', 1, 1531741702, ''),
(5, 'Regular Labs - Advanced Module Manager', 'extension', 'https://download.regularlabs.com/updates.xml?e=advancedmodulemanager&type=.xml', 1, 1531741705, ''),
(6, 'CreativeContactForm', 'extension', 'http://creative-solutions.net/jupdate.php?product=creativecontactform', 1, 1531741706, ''),
(7, 'Breeze Updates', 'extension', 'https://raw.githubusercontent.com/OSTraining/tpl_breeze/master/updates.xml', 1, 1531741706, ''),
(8, 'Gridbox', 'extension', 'https://www.balbooa.com/updates/gridbox/joomla_gridbox_update.xml', 1, 1531741710, ''),
(10, 'iQuix', 'extension', 'https://raw.githubusercontent.com/themexpert/iquix/master/mainfest.xml', 1, 1531741711, ''),
(11, 'Joomla Template Update Site', 'extension', 'https://www.themexpert.com/index.php?option=com_digicom&task=responses&source=release&format=xml&provider=joomla&pid=193', 1, 1531741714, '');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_update_sites_extensions`
--

DROP TABLE IF EXISTS `bt8w9_update_sites_extensions`;
CREATE TABLE IF NOT EXISTS `bt8w9_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Links extensions to update sites';

--
-- Dumping data for table `bt8w9_update_sites_extensions`
--

INSERT INTO `bt8w9_update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 802),
(3, 28),
(4, 10000),
(5, 10004),
(5, 10005),
(6, 10006),
(7, 10009),
(8, 10015),
(10, 10024),
(11, 10032);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_usergroups`
--

DROP TABLE IF EXISTS `bt8w9_usergroups`;
CREATE TABLE IF NOT EXISTS `bt8w9_usergroups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_usergroups`
--

INSERT INTO `bt8w9_usergroups` (`id`, `parent_id`, `lft`, `rgt`, `title`) VALUES
(1, 0, 1, 18, 'Public'),
(2, 1, 8, 15, 'Registered'),
(3, 2, 9, 14, 'Author'),
(4, 3, 10, 13, 'Editor'),
(5, 4, 11, 12, 'Publisher'),
(6, 1, 4, 7, 'Manager'),
(7, 6, 5, 6, 'Administrator'),
(8, 1, 16, 17, 'Super Users'),
(9, 1, 2, 3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_users`
--

DROP TABLE IF EXISTS `bt8w9_users`;
CREATE TABLE IF NOT EXISTS `bt8w9_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  `otpKey` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Two factor authentication encrypted keys',
  `otep` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'One time emergency passwords',
  `requireReset` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Require user to reset password on next login',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`(100)),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=859 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_users`
--

INSERT INTO `bt8w9_users` (`id`, `name`, `username`, `email`, `password`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`, `otpKey`, `otep`, `requireReset`) VALUES
(857, 'Super User', 'admin', 'acdeleon@student.apc.edu.ph', '$2y$10$T6xRumY.NrVfHAohiPMRE.gR2a8pNed/8.qBnn4gfun4JESErvlpy', 0, 1, '2018-07-08 14:34:13', '2018-07-16 10:22:53', '0', '', '0000-00-00 00:00:00', 0, '', '', 0),
(858, 'Aleo De Leon', 'acdeleon', 'jjola@g.com', '$2y$10$aIjXJk2SRHXgQFEwm6JVG.1oigkHKHZXwScTw2CLMHmeQBlaJObMG', 0, 0, '2018-07-09 09:11:18', '2018-07-16 10:29:52', '7de1ee7604c6ba44b2b842695116184f', '{}', '0000-00-00 00:00:00', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_user_keys`
--

DROP TABLE IF EXISTS `bt8w9_user_keys`;
CREATE TABLE IF NOT EXISTS `bt8w9_user_keys` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `series` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL,
  `time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uastring` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `series` (`series`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_user_notes`
--

DROP TABLE IF EXISTS `bt8w9_user_notes`;
CREATE TABLE IF NOT EXISTS `bt8w9_user_notes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) UNSIGNED NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_user_profiles`
--

DROP TABLE IF EXISTS `bt8w9_user_profiles`;
CREATE TABLE IF NOT EXISTS `bt8w9_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_user_usergroup_map`
--

DROP TABLE IF EXISTS `bt8w9_user_usergroup_map`;
CREATE TABLE IF NOT EXISTS `bt8w9_user_usergroup_map` (
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_user_usergroup_map`
--

INSERT INTO `bt8w9_user_usergroup_map` (`user_id`, `group_id`) VALUES
(857, 8),
(858, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_utf8_conversion`
--

DROP TABLE IF EXISTS `bt8w9_utf8_conversion`;
CREATE TABLE IF NOT EXISTS `bt8w9_utf8_conversion` (
  `converted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_utf8_conversion`
--

INSERT INTO `bt8w9_utf8_conversion` (`converted`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `bt8w9_viewlevels`
--

DROP TABLE IF EXISTS `bt8w9_viewlevels`;
CREATE TABLE IF NOT EXISTS `bt8w9_viewlevels` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt8w9_viewlevels`
--

INSERT INTO `bt8w9_viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 0, '[1]'),
(2, 'Registered', 2, '[6,2,8]'),
(3, 'Special', 3, '[6,3,8]'),
(5, 'Guest', 1, '[9]'),
(6, 'Super Users', 4, '[8]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
