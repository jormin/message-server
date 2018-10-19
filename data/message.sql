/*
 Navicat Premium Data Transfer

 Source Server         : homestead
 Source Server Type    : MariaDB
 Source Server Version : 100206
 Source Host           : 127.0.0.1
 Source Database       : message

 Target Server Type    : MariaDB
 Target Server Version : 100206
 File Encoding         : utf-8

 Date: 10/19/2018 12:28:35 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `xieqiaomin_admin`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_admin`;
CREATE TABLE `xieqiaomin_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(10) NOT NULL COMMENT '用户名',
  `password` char(64) NOT NULL COMMENT '密码',
  `salt` char(10) NOT NULL COMMENT '加密盐',
  `created_at` int(11) NOT NULL COMMENT '注册时间戳',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT '登录Token',
  `token_expiretime` int(11) NOT NULL DEFAULT 0 COMMENT '登录Token过期时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_username` (`username`),
  KEY `index_token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
--  Records of `xieqiaomin_admin`
-- ----------------------------
BEGIN;
INSERT INTO `xieqiaomin_admin` VALUES ('1', 'admin', '$2y$10$NQwzfomRVtZ7rbpu8tWkl.RCuFTHbouaoRK/FWyJbtM1PysgTPxXW', 'GSJPbtzb0s', '1539826571', '$2y$10$lBUDnk27HCFbCMQrgiMj4u4t0McTV2yJx68sRH0SfIUpXkPubmGeu', '1539917425');
COMMIT;

-- ----------------------------
--  Table structure for `xieqiaomin_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_attachment`;
CREATE TABLE `xieqiaomin_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '文件存储路径',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `index_created_at` (`created_at`),
  CONSTRAINT `xieqiaomin_attachment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
--  Table structure for `xieqiaomin_email_code`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_email_code`;
CREATE TABLE `xieqiaomin_email_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) NOT NULL COMMENT '验证码类型 0:注册',
  `email` varchar(35) NOT NULL COMMENT '邮箱',
  `code` varchar(32) NOT NULL DEFAULT '' COMMENT '验证码',
  `expiretime` int(11) NOT NULL COMMENT '过期时间戳',
  `validated_at` int(11) NOT NULL DEFAULT 0 COMMENT '验证时间戳',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  PRIMARY KEY (`id`),
  KEY `index_type_code` (`type`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邮箱验证表';

-- ----------------------------
--  Table structure for `xieqiaomin_message`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_message`;
CREATE TABLE `xieqiaomin_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '留言用户',
  `receiver_id` int(11) unsigned DEFAULT NULL COMMENT '关联用户',
  `title` varchar(80) NOT NULL COMMENT '标题',
  `content` varchar(500) NOT NULL COMMENT '留言内容',
  `ip` varchar(15) NOT NULL COMMENT 'IP',
  `ip_address` varchar(50) NOT NULL COMMENT 'IP对应地区',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  `deleted_at` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间戳',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `index_created_at` (`created_at`),
  FULLTEXT KEY `index_title` (`title`),
  CONSTRAINT `xieqiaomin_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`),
  CONSTRAINT `xieqiaomin_message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `xieqiaomin_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
--  Table structure for `xieqiaomin_message_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_message_attachment`;
CREATE TABLE `xieqiaomin_message_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `message_id` int(11) unsigned NOT NULL COMMENT '留言ID',
  `attachment_id` int(11) unsigned NOT NULL COMMENT '附件ID',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `message_id` (`message_id`),
  KEY `attachment_id` (`attachment_id`),
  CONSTRAINT `xieqiaomin_message_attachment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`),
  CONSTRAINT `xieqiaomin_message_attachment_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `xieqiaomin_message` (`id`),
  CONSTRAINT `xieqiaomin_message_attachment_ibfk_3` FOREIGN KEY (`attachment_id`) REFERENCES `xieqiaomin_attachment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言附件表';

-- ----------------------------
--  Table structure for `xieqiaomin_message_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_message_comment`;
CREATE TABLE `xieqiaomin_message_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `message_id` int(11) unsigned NOT NULL COMMENT '留言ID',
  `comment` varchar(140) NOT NULL COMMENT '评论内容',
  `ip` varchar(15) NOT NULL COMMENT 'IP',
  `ip_address` varchar(50) NOT NULL COMMENT 'IP对应地区',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  `deleted_at` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间戳',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `message_id` (`message_id`),
  KEY `index_created_at` (`created_at`),
  CONSTRAINT `xieqiaomin_message_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`),
  CONSTRAINT `xieqiaomin_message_comment_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `xieqiaomin_message` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言评论表';

-- ----------------------------
--  Table structure for `xieqiaomin_notice`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_notice`;
CREATE TABLE `xieqiaomin_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `type` tinyint(1) NOT NULL COMMENT '类型 1新留言 2新评论',
  `content` varchar(140) NOT NULL COMMENT '通知内容',
  `extension_id` int(11) NOT NULL COMMENT '扩展ID',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `index_extension_id` (`extension_id`),
  CONSTRAINT `xieqiaomin_notice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言评论表';

-- ----------------------------
--  Table structure for `xieqiaomin_phone_code`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_phone_code`;
CREATE TABLE `xieqiaomin_phone_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) NOT NULL COMMENT '验证码类型 0:注册',
  `phone` varchar(35) NOT NULL COMMENT '手机号',
  `code` char(6) NOT NULL COMMENT '验证码',
  `expiretime` int(11) NOT NULL COMMENT '过期时间戳',
  `validated_at` int(11) NOT NULL DEFAULT 0 COMMENT '验证时间戳',
  `created_at` int(11) NOT NULL COMMENT '创建时间戳',
  PRIMARY KEY (`id`),
  KEY `index_type_phone_code` (`type`,`phone`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手机验证表';

-- ----------------------------
--  Table structure for `xieqiaomin_user`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_user`;
CREATE TABLE `xieqiaomin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(15) NOT NULL COMMENT '姓名',
  `gender` tinyint(1) NOT NULL COMMENT '性别 1:男 2:女',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `email` varchar(35) NOT NULL COMMENT '邮箱',
  `password` char(255) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(10) NOT NULL COMMENT '加密盐',
  `email_verify` tinyint(1) NOT NULL DEFAULT 0 COMMENT '邮箱验证状态 0:未验证 1:已验证',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 1:启用 -1:禁用',
  `ip` varchar(15) NOT NULL COMMENT '注册IP',
  `ip_address` varchar(50) NOT NULL COMMENT 'IP所在地区',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT '登录Token',
  `token_expiretime` int(11) NOT NULL DEFAULT 0 COMMENT '登录Token过期时间',
  `created_at` int(11) NOT NULL COMMENT '注册时间戳',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_phone` (`phone`),
  KEY `index_created_at` (`created_at`),
  KEY `index_email` (`email`),
  KEY `index_token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
--  Table structure for `xieqiaomin_user_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `xieqiaomin_user_login_log`;
CREATE TABLE `xieqiaomin_user_login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `login_time` int(11) NOT NULL COMMENT '登录时间戳',
  `ip` varchar(15) NOT NULL COMMENT '登录IP',
  `ip_address` varchar(50) NOT NULL COMMENT 'IP所在地区',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `index_login_time` (`login_time`),
  CONSTRAINT `xieqiaomin_user_login_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `xieqiaomin_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户登录日志表';

SET FOREIGN_KEY_CHECKS = 1;
