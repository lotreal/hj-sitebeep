# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.8 - MySQL Community Server (GPL)
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3956
# Date/time:                    2011-11-01 14:55:40
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for adtracker
DROP DATABASE IF EXISTS `adtracker`;
CREATE DATABASE IF NOT EXISTS `adtracker` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `adtracker`;


# Dumping structure for table adtracker.cdb_channel
DROP TABLE IF EXISTS `cdb_channel`;
CREATE TABLE IF NOT EXISTS `cdb_channel` (
  `cid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `channel` char(15) NOT NULL,
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category` char(15) NOT NULL,
  `pageurl` varchar(100) NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `childer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `describe` varchar(255) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL DEFAULT '100',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `auditor` char(15) NOT NULL,
  `audittime` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_channel: 0 rows
DELETE FROM `cdb_channel`;
/*!40000 ALTER TABLE `cdb_channel` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_channel` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_channel_category
DROP TABLE IF EXISTS `cdb_channel_category`;
CREATE TABLE IF NOT EXISTS `cdb_channel_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category` char(15) NOT NULL,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parent` char(15) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL DEFAULT '100',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `auditor` char(15) NOT NULL,
  `audittime` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_channel_category: 0 rows
DELETE FROM `cdb_channel_category`;
/*!40000 ALTER TABLE `cdb_channel_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_channel_category` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_orders
DROP TABLE IF EXISTS `cdb_orders`;
CREATE TABLE IF NOT EXISTS `cdb_orders` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` char(15) NOT NULL,
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` char(15) NOT NULL,
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL,
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `channel` char(15) NOT NULL,
  `parent` mediumint(9) NOT NULL DEFAULT '0',
  `childer` mediumint(9) NOT NULL DEFAULT '0',
  `signin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_orders: 0 rows
DELETE FROM `cdb_orders`;
/*!40000 ALTER TABLE `cdb_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_orders` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_transform
DROP TABLE IF EXISTS `cdb_transform`;
CREATE TABLE IF NOT EXISTS `cdb_transform` (
  `tid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `transform` char(15) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `auditor` char(15) NOT NULL,
  `audittime` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_transform: 1 rows
DELETE FROM `cdb_transform`;
/*!40000 ALTER TABLE `cdb_transform` DISABLE KEYS */;
INSERT INTO `cdb_transform` (`tid`, `transform`, `describe`, `rank`, `sid`, `number`, `auditor`, `audittime`, `operation`, `dateline`, `status`) VALUES
	(1, '800咨询', '800转化咨询', 100, 1, 0, 'admin', 1320130343, '', 0, 1);
/*!40000 ALTER TABLE `cdb_transform` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_transform_data
DROP TABLE IF EXISTS `cdb_transform_data`;
CREATE TABLE IF NOT EXISTS `cdb_transform_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` char(15) NOT NULL,
  `pin` char(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `is_agent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_mobile` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `terminal` varchar(10) NOT NULL,
  `platform` varchar(30) NOT NULL,
  `ipaddress` char(15) NOT NULL,
  `country` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `isp` varchar(10) NOT NULL,
  `brower` varchar(30) NOT NULL,
  `version` varchar(15) NOT NULL,
  `language` char(5) NOT NULL,
  `screen_w` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screen_h` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screen_c` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `is_flash` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_cookie` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_java` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timezone` tinyint(3) NOT NULL DEFAULT '0',
  `plugin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `referer` varchar(100) NOT NULL,
  `current` varchar(100) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `window_w` smallint(5) unsigned NOT NULL DEFAULT '0',
  `window_h` smallint(5) unsigned NOT NULL DEFAULT '0',
  `page_w` smallint(5) unsigned NOT NULL DEFAULT '0',
  `page_h` smallint(5) unsigned NOT NULL DEFAULT '0',
  `charset` char(8) NOT NULL,
  `click_x` smallint(5) unsigned NOT NULL DEFAULT '0',
  `click_y` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screen_n` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `channel` char(15) NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `childer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `transform` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_transform_data: 0 rows
DELETE FROM `cdb_transform_data`;
/*!40000 ALTER TABLE `cdb_transform_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_transform_data` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_users
DROP TABLE IF EXISTS `cdb_users`;
CREATE TABLE IF NOT EXISTS `cdb_users` (
  `uid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL,
  `password` char(32) NOT NULL,
  `gid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `group` char(15) NOT NULL,
  `job_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `job` char(15) NOT NULL,
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `ipaddress` char(15) NOT NULL,
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` char(15) NOT NULL,
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`),
  KEY `username` (`username`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_users: 1 rows
DELETE FROM `cdb_users`;
/*!40000 ALTER TABLE `cdb_users` DISABLE KEYS */;
INSERT INTO `cdb_users` (`uid`, `username`, `password`, `gid`, `group`, `job_id`, `job`, `regdate`, `ipaddress`, `lastdate`, `lastip`, `operation`, `dateline`, `status`) VALUES
	(1, 'admin', 'f46bdbaf704f698c99bcba1a813c20a0', 0, '', 0, '', 1319794289, '127.0.0.1', 1320130295, '127.0.0.1', '', 0, 1);
/*!40000 ALTER TABLE `cdb_users` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_website
DROP TABLE IF EXISTS `cdb_website`;
CREATE TABLE IF NOT EXISTS `cdb_website` (
  `sid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` char(15) NOT NULL,
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category` char(15) NOT NULL,
  `pageurl` varchar(100) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL DEFAULT '100',
  `auditor` char(15) NOT NULL,
  `audittime` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`sid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_website: 1 rows
DELETE FROM `cdb_website`;
/*!40000 ALTER TABLE `cdb_website` DISABLE KEYS */;
INSERT INTO `cdb_website` (`sid`, `sitename`, `cat_id`, `category`, `pageurl`, `describe`, `rank`, `auditor`, `audittime`, `operation`, `dateline`, `status`) VALUES
	(1, '品酒', 1, '产品站', 'http://www.pinjiu.com/', '买红酒上品酒网', 100, 'admin', 1320130327, '', 0, 1);
/*!40000 ALTER TABLE `cdb_website` ENABLE KEYS */;


# Dumping structure for table adtracker.cdb_website_category
DROP TABLE IF EXISTS `cdb_website_category`;
CREATE TABLE IF NOT EXISTS `cdb_website_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category` char(15) NOT NULL,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parent` char(15) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL DEFAULT '100',
  `auditor` char(15) NOT NULL,
  `audittime` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table adtracker.cdb_website_category: 1 rows
DELETE FROM `cdb_website_category`;
/*!40000 ALTER TABLE `cdb_website_category` DISABLE KEYS */;
INSERT INTO `cdb_website_category` (`cat_id`, `category`, `parent_id`, `parent`, `rank`, `auditor`, `audittime`, `operation`, `dateline`, `status`) VALUES
	(1, '产品站', 0, '', 100, 'admin', 1320130308, '', 0, 1);
/*!40000 ALTER TABLE `cdb_website_category` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
