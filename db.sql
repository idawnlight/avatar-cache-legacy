-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

SET NAMES utf8mb4;

CREATE DATABASE `avatar` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `avatar`;

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `raw_url` varchar(255) DEFAULT NULL,
  `raw_id` int(11) DEFAULT NULL,
  `last_modified` varchar(255) DEFAULT NULL,
  `last_update` varchar(255) DEFAULT NULL,
  `gr_options` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `mime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2019-10-03 15:14:12
