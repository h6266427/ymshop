/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ymshop

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-20 22:29:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ym_cate
-- ----------------------------
DROP TABLE IF EXISTS `ym_cate`;
CREATE TABLE `ym_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(20) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_cate
-- ----------------------------
INSERT INTO `ym_cate` VALUES ('1', '四时果蔬', '0', '1', '0');
INSERT INTO `ym_cate` VALUES ('2', '安全水果', '0', '2', '0');
INSERT INTO `ym_cate` VALUES ('3', '肉禽蛋类', '0', '3', '0');
INSERT INTO `ym_cate` VALUES ('4', '乳制品类', '0', '4', '0');
INSERT INTO `ym_cate` VALUES ('5', '水中鲜物', '0', '5', '0');
INSERT INTO `ym_cate` VALUES ('6', '早餐&面点', '0', '6', '0');
INSERT INTO `ym_cate` VALUES ('7', '吃吃零嘴', '0', '7', '0');
INSERT INTO `ym_cate` VALUES ('8', '饮料酒水', '0', '8', '0');
INSERT INTO `ym_cate` VALUES ('9', '粮油酱醋', '0', '9', '0');
INSERT INTO `ym_cate` VALUES ('10', '环保生活', '0', '10', '0');
INSERT INTO `ym_cate` VALUES ('11', '根茎类', '1', '1,11', '1');
INSERT INTO `ym_cate` VALUES ('12', '青菜', '11', '1,11,12', '2');
