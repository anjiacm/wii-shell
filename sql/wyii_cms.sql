/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : wyii_cms

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-08 12:00:57
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
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1510727840');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1510727846');
INSERT INTO `migration` VALUES ('m140602_111327_create_menu_table', '1510731192');
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', '1510727847');

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
-- Records of w_auth_assignment
-- ----------------------------
INSERT INTO `w_auth_assignment` VALUES ('角色-联盟管理员', '3', '1511504350');
INSERT INTO `w_auth_assignment` VALUES ('角色-超级管理员', '1', '1511341450');
INSERT INTO `w_auth_assignment` VALUES ('角色-超级管理员', '2', '1510909923');

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
-- Records of w_auth_item
-- ----------------------------
INSERT INTO `w_auth_item` VALUES ('/*', '2', null, null, null, '1511406960', '1511406960');
INSERT INTO `w_auth_item` VALUES ('/blog/*', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/create', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/delete', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/index', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/list', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/update', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/upload', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/blog/view', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/debug/*', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/user/*', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/user/reset-identity', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/debug/user/set-identity', '2', null, null, null, '1511406957', '1511406957');
INSERT INTO `w_auth_item` VALUES ('/gii/*', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1511406958', '1511406958');
INSERT INTO `w_auth_item` VALUES ('/lm/*', '2', null, null, null, '1512205678', '1512205678');
INSERT INTO `w_auth_item` VALUES ('/lm/index', '2', null, null, null, '1512205678', '1512205678');
INSERT INTO `w_auth_item` VALUES ('/lm/qdlist', '2', null, null, null, '1512205678', '1512205678');
INSERT INTO `w_auth_item` VALUES ('/rbac/*', '2', null, null, null, '1511430224', '1511430224');
INSERT INTO `w_auth_item` VALUES ('/rbac/assignment/*', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/assignment/assign', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/assignment/index', '2', null, null, null, '1511430217', '1511430217');
INSERT INTO `w_auth_item` VALUES ('/rbac/assignment/revoke', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/assignment/view', '2', null, null, null, '1511430217', '1511430217');
INSERT INTO `w_auth_item` VALUES ('/rbac/default/*', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/default/index', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/*', '2', null, null, null, '1511430219', '1511430219');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/create', '2', null, null, null, '1511430219', '1511430219');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/delete', '2', null, null, null, '1511430219', '1511430219');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/index', '2', null, null, null, '1511430218', '1511430218');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/update', '2', null, null, null, '1511430219', '1511430219');
INSERT INTO `w_auth_item` VALUES ('/rbac/menu/view', '2', null, null, null, '1511430219', '1511430219');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/*', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/assign', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/create', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/delete', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/index', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/remove', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/update', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/permission/view', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/*', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/assign', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/create', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/delete', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/index', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/remove', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/update', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/role/view', '2', null, null, null, '1511430220', '1511430220');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/*', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/assign', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/create', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/index', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/refresh', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/route/remove', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/*', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/create', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/delete', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/index', '2', null, null, null, '1511430221', '1511430221');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/update', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/rule/view', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/*', '2', null, null, null, '1511430224', '1511430224');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/activate', '2', null, null, null, '1511430224', '1511430224');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/change-password', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/delete', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/index', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/login', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/logout', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/request-password-reset', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/reset-password', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/signup', '2', null, null, null, '1511430223', '1511430223');
INSERT INTO `w_auth_item` VALUES ('/rbac/user/view', '2', null, null, null, '1511430222', '1511430222');
INSERT INTO `w_auth_item` VALUES ('/site/*', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/site/error', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/site/index', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/site/login', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/site/logout', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/*', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/create', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/delete', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/index', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/update', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/validate-form', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/test/view', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/user-backend/*', '2', null, null, null, '1511406960', '1511406960');
INSERT INTO `w_auth_item` VALUES ('/user-backend/create', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/user-backend/delete', '2', null, null, null, '1511406960', '1511406960');
INSERT INTO `w_auth_item` VALUES ('/user-backend/index', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/user-backend/password', '2', null, null, null, '1513931540', '1513931540');
INSERT INTO `w_auth_item` VALUES ('/user-backend/signup', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('/user-backend/update', '2', null, null, null, '1511406960', '1511406960');
INSERT INTO `w_auth_item` VALUES ('/user-backend/view', '2', null, null, null, '1511406959', '1511406959');
INSERT INTO `w_auth_item` VALUES ('联盟管理员权限', '2', '管理对应联盟的数据', null, null, '1512205722', '1512376488');
INSERT INTO `w_auth_item` VALUES ('角色-联盟管理员', '1', '用于联盟管理的角色   每个联盟管理所属的联盟数据', null, null, '1511408731', '1512376512');
INSERT INTO `w_auth_item` VALUES ('角色-超级管理员', '1', '超级管理员，拥有整个后台的最高处理权限。', null, null, '1510730923', '1512376524');
INSERT INTO `w_auth_item` VALUES ('超级管理员权限', '2', '访问所有页面', null, null, '1510735121', '1511763521');

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
-- Records of w_auth_item_child
-- ----------------------------
INSERT INTO `w_auth_item_child` VALUES ('联盟管理员权限', '/lm/*');
INSERT INTO `w_auth_item_child` VALUES ('联盟管理员权限', '/site/*');
INSERT INTO `w_auth_item_child` VALUES ('角色-联盟管理员', '联盟管理员权限');
INSERT INTO `w_auth_item_child` VALUES ('角色-超级管理员', '超级管理员权限');
INSERT INTO `w_auth_item_child` VALUES ('超级管理员权限', '/*');

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
-- Records of w_auth_rule
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_ip_log
-- ----------------------------
INSERT INTO `w_ip_log` VALUES ('1', '127.0.0', '127.0.0.1', '2017-12-22 16:51:29', '1', 'admin', '123456');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_menu
-- ----------------------------
INSERT INTO `w_menu` VALUES ('6', '管理员中心', null, null, null, 0x207B2269636F6E223A20227374726565742D76696577222C202276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('7', '菜单管理', '6', '/rbac/menu/index', '2', 0x7B2269636F6E223A20226C697374222C202276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('8', '权限管理', '6', '/rbac/route/index', '1', 0x7B2269636F6E223A20226F757464656E74222C202276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('9', '权限设置', '8', '/rbac/permission/index', '2', 0x7B2269636F6E223A2022636861696E222C202276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('10', '管理员列表', '6', '/user-backend/index', '1', 0x7B2269636F6E223A202275736572222C202276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('14', '路由分配', '8', '/rbac/route/index', '1', 0x7B2269636F6E223A2273656E64222C2276697369626C65223A20747275657D);
INSERT INTO `w_menu` VALUES ('15', '角色管理', '8', '/rbac/role/index', '3', null);
INSERT INTO `w_menu` VALUES ('17', '用户权限分配', '8', '/rbac/assignment/index', '3', 0x7B2269636F6E223A2022746167222C202276697369626C65223A20747275657D);

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
-- Records of w_session
-- ----------------------------
INSERT INTO `w_session` VALUES ('05fsldkna9sfpqssnn3snfc4d7', '1513136721', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('21qeokcdnv7at9dmkbunqjb957', '1513145394', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('27pobqvu7usma56ic36tf1ne16', '1513158530', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('2rvvb8mbh2mtdibb2kps1v5vh4', '1513158686', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31393A222F696E6465782E7068703F723D77696964626D223B5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('30tm5n069c8u9pv95fanh8ii51', '1513233737', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A34323A222F696E6465782E7068703F723D746725324671646C6973742671643D3826736F72743D61646475736572223B5F5F69647C693A323B);
INSERT INTO `w_session` VALUES ('4alg85ctottdsniv3q4nk91ec1', '1513154073', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('5ds3i9f92gnag527ceg6fruqu7', '1513215694', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('5n47bcpaac6bvm22c1m34eua16', '1513157312', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A313A222F223B);
INSERT INTO `w_session` VALUES ('6c2c9g42tlpleah90fk7hogdk2', '1513145342', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('7bv6qd2568068b32tbnru36de0', '1513145428', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('7g0mg5p6ulv0u0rq6jic041ok4', '1513136722', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('7pv8l4aalsda7uh2jb8m9teum4', '1513151359', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('92ecqn8nh1v35t7f4fnk0v93u4', '1513158090', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32353A222F696E6465782E7068703F723D746A7164253246696E646578223B);
INSERT INTO `w_session` VALUES ('9b2a1qqjh672id7jsj5vlcutf2', '1513133909', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B5F5F69647C693A31373B);
INSERT INTO `w_session` VALUES ('9r6o0dnvqh55bat581vqg2orj1', '1513133878', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('a524u7b1pka36q6u3orq789bg6', '1513136719', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('ahhfvahq2r7hh9tcoknlu67id1', '1513220745', 0x5F5F666C6173687C613A303A7B7D);
INSERT INTO `w_session` VALUES ('aimajib2ttpegmtqtgnihv2c76', '1513158119', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33313A222F696E6465782E7068703F723D77752D63706173697465253246696E646578223B);
INSERT INTO `w_session` VALUES ('alksft97vnokr9rulgubqv1id7', '1513145184', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('ce680p32old1lsddkivsijfje6', '1513225434', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A31373B);
INSERT INTO `w_session` VALUES ('cjtsm0aroukhi3rv5d8nlra746', '1513154169', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('ctcdpdfto4e3m46p11df0oibu3', '1513175898', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('dbr29e3to4sple4vdkufkr70n7', '1513228961', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32353A222F696E6465782E7068703F723D746A7164253266696E646578223B);
INSERT INTO `w_session` VALUES ('e0814k1nit9kv1i28k1avqsbj6', '1513154401', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32333A222F696E6465782E7068703F723D7467253246696E646578223B5F5F69647C693A323B);
INSERT INTO `w_session` VALUES ('edo86o3ept1oorihj95c4mmjv1', '1513224082', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('eikf700bg2fchileud57s7evb4', '1513154127', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('er538at2jp7n6en0em14bokdn3', '1513217574', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A313A222F223B);
INSERT INTO `w_session` VALUES ('freft19et39ethkk8lsobi9p50', '1513135693', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A313B);
INSERT INTO `w_session` VALUES ('g48d5penfquso2jgnbhqflaq31', '1513154095', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('ggvt7tllgrosl2ncn3i2oj1r43', '1513218578', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('gu10nuhr9l91dg7dv9fq3hnav1', '1513158123', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33333A222F696E6465782E7068703F723D757365722D6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('jjscujuoo1uomf33sq5sgused4', '1513163038', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B5F5F69647C693A31373B);
INSERT INTO `w_session` VALUES ('kcehgip5l7fmajao3ekb0lcad0', '1513228944', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32353A222F696E6465782E7068703F723D746A7164253246696E646578223B5F5F69647C693A31373B);
INSERT INTO `w_session` VALUES ('lf69rj8t5e86ih6cs9s6tsne94', '1513154072', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('mbr4kjhhu30e5pqqn25fso4ef4', '1513163056', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32353A222F696E6465782E7068703F723D746A7164253246696E646578223B);
INSERT INTO `w_session` VALUES ('me28dn21d4ibknc63la9a2bqk7', '1513160304', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('nc0uj8c622q0godu66rvd30nq3', '1513225884', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('nege5e79q6oei2nir7e1g9qpf0', '1513135887', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32353A222F696E6465782E7068703F723D746A7164253246696E646578223B);
INSERT INTO `w_session` VALUES ('o3tupi8d7gv1lu8kc9dakn3540', '1513153718', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('p7t363f4e0aadrket10qmpdvi3', '1513155073', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A313B);
INSERT INTO `w_session` VALUES ('s5fujpiesjnsp3e5sjj6j4g4l6', '1513133887', 0x5F5F666C6173687C613A303A7B7D);
INSERT INTO `w_session` VALUES ('sf21lbi1s1pe00od40h52qc843', '1513145339', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('tvsc9uf7ptat6vkrps4c5attv7', '1513136727', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253266696E646578223B);
INSERT INTO `w_session` VALUES ('uj6v5111p23sv6uk28g77pqv61', '1513154079', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A33303A222F696E6465782E7068703F723D746A6261636B656E64253246696E646578223B);
INSERT INTO `w_session` VALUES ('ust5t2afp42hdokamoi0al9sd5', '1513145292', 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A333B);
INSERT INTO `w_session` VALUES ('v05adlje0bql3c6emfc2pein01', '1513145361', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);
INSERT INTO `w_session` VALUES ('vfttu2ff0eipirfl16bbp28bl3', '1513145338', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F696E6465782E706870223B);

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

-- ----------------------------
-- Records of w_user_backend
-- ----------------------------
INSERT INTO `w_user_backend` VALUES ('1', 'admin', 'admin', '$2y$13$BMWeuCFxJSXvrwvbfOH.WORwNxEEWzkBTNUmzMlN7zM0Cq/uRM37S', '1510725500', '1510725500', '1', '1511750144', '123456@qq.com', '8wQDSdJYoF2G8VcgHl_WPUOEUwhduowN', '角色-超级管理员', '0', '0');
INSERT INTO `w_user_backend` VALUES ('2', 'ceshis', 'ceshis', '$2y$13$vWvQ89lrIb/fvpzUlxX6LO9wG6uf8x5XFmtCsDMGbl32mU7Vfnk1K', '1511753789', '1511753789', null, '1511753789', '546167337@qq.com', '', '角色-超级管理员', '0', '0');
INSERT INTO `w_user_backend` VALUES ('3', '吴广安', 'lmadmin', '$2y$13$Rh8UC70VPSIakxy3LzOMLungsa8gP.MG4qIDp.QSEZYqJiWVrZV4W', '1511753714', '1511492208', '1', '1511492208', '123123123@QQ.COM', 'zkYh6LeokKD3moH1BwFPuVNBqmdUx3xW', '角色-联盟管理员', '1', '1');
