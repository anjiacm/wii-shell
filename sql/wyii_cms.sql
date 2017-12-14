/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : wyii_cms

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-12-14 15:26:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for w_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `w_auth_assignment`;
CREATE TABLE `w_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `w_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `w_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for w_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `w_auth_item`;
CREATE TABLE `w_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `w_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `w_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for w_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `w_auth_item_child`;
CREATE TABLE `w_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `w_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `w_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `w_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `w_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for w_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `w_auth_rule`;
CREATE TABLE `w_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for w_ip_log
-- ----------------------------
DROP TABLE IF EXISTS `w_ip_log`;
CREATE TABLE `w_ip_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_all` varchar(255) DEFAULT NULL COMMENT 'ip段',
  `ip_res` varchar(255) DEFAULT NULL COMMENT '当前ip',
  `dodate` varchar(255) DEFAULT NULL COMMENT '操作日期',
  `errsum` int(11) DEFAULT '0' COMMENT '错误次数',
  `usercard` varchar(255) DEFAULT NULL COMMENT '登录账号',
  `userpwd` varchar(255) DEFAULT NULL COMMENT '登录密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for w_menu
-- ----------------------------
DROP TABLE IF EXISTS `w_menu`;
CREATE TABLE `w_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `w_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `w_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for w_session
-- ----------------------------
DROP TABLE IF EXISTS `w_session`;
CREATE TABLE `w_session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for w_user_backend
-- ----------------------------
DROP TABLE IF EXISTS `w_user_backend`;
CREATE TABLE `w_user_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT '' COMMENT '用户名',
  `usercard` varchar(255) DEFAULT '' COMMENT '用户账号',
  `password` varchar(255) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL COMMENT '更新时间',
  `do_date` int(11) DEFAULT NULL COMMENT '注册时间',
  `powerres` int(11) DEFAULT NULL COMMENT '状态',
  `line_date` int(11) DEFAULT NULL COMMENT '上次登录时间',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `auth_key` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT '0' COMMENT '管理类型（针对男人影院后台设置）',
  `lmid` int(11) DEFAULT '0' COMMENT '联盟id',
  `cpashow` int(11) DEFAULT '0' COMMENT '0不显示 1显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
