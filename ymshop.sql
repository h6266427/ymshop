/*
Navicat MySQL Data Transfer

Source Server         : blog
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ymshop

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-26 11:45:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ym_address
-- ----------------------------
DROP TABLE IF EXISTS `ym_address`;
CREATE TABLE `ym_address` (
  `addr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `area` varchar(100) NOT NULL COMMENT '区域 （省    市     区/县/镇）',
  `address` varchar(255) NOT NULL COMMENT '地址  （XX路XX号XX室）',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `def_addr` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址 ',
  PRIMARY KEY (`addr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_address
-- ----------------------------

-- ----------------------------
-- Table structure for ym_cart
-- ----------------------------
DROP TABLE IF EXISTS `ym_cart`;
CREATE TABLE `ym_cart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `selected` tinyint(4) NOT NULL COMMENT '是否选中 0-1  1选中',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_cart
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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

-- ----------------------------
-- Table structure for ym_goods
-- ----------------------------
DROP TABLE IF EXISTS `ym_goods`;
CREATE TABLE `ym_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0正常 1表示已删除',
  `sell_price` decimal(10,0) NOT NULL,
  `market_price` decimal(10,0) NOT NULL,
  `marketable` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-下架 1-上架',
  `store` int(11) NOT NULL COMMENT '商品库存',
  `freez` int(11) NOT NULL COMMENT '冻结库存，商品显示数量等于库存减冻结库存',
  `create_time` int(10) NOT NULL,
  `last_modify_time` int(10) NOT NULL,
  `last_modify_id` int(11) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `cate_id` int(11) NOT NULL,
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是热销商品，是为1，否为0',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是上新商品，是为1，否为0',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_goods
-- ----------------------------
INSERT INTO `ym_goods` VALUES ('1', '夏威夷果', '0', '88', '99', '1', '999', '11', '1505662517', '1505662517', '1', '坚果', '好吃', '来自夏威夷的夏威夷果', '7', '0', '0');
INSERT INTO `ym_goods` VALUES ('2', '火龙果', '0', '55', '66', '1', '100', '80', '1505662517', '1505662517', '2', '水果', '降火', '哈哈哈哈', '2', '0', '0');

-- ----------------------------
-- Table structure for ym_images
-- ----------------------------
DROP TABLE IF EXISTS `ym_images`;
CREATE TABLE `ym_images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_b_url` varchar(255) NOT NULL,
  `image_m_url` varchar(255) NOT NULL,
  `image_s_url` varchar(255) NOT NULL,
  `is_face` tinyint(4) NOT NULL COMMENT '是否封面',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_images
-- ----------------------------
INSERT INTO `ym_images` VALUES ('1', '1', '/static/index/img/hot5.jpg', '', '', '', '1');

-- ----------------------------
-- Table structure for ym_item
-- ----------------------------
DROP TABLE IF EXISTS `ym_item`;
CREATE TABLE `ym_item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `goods_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_item
-- ----------------------------

-- ----------------------------
-- Table structure for ym_log
-- ----------------------------
DROP TABLE IF EXISTS `ym_log`;
CREATE TABLE `ym_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `content` tinyint(4) NOT NULL COMMENT '生成订单/取消订单',
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_log
-- ----------------------------

-- ----------------------------
-- Table structure for ym_manager
-- ----------------------------
DROP TABLE IF EXISTS `ym_manager`;
CREATE TABLE `ym_manager` (
  `manager_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `manager_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_time` int(10) NOT NULL,
  `login_time` int(10) NOT NULL,
  `manager_ip` varchar(20) NOT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常  1-冻结 ',
  PRIMARY KEY (`manager_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_manager
-- ----------------------------
INSERT INTO `ym_manager` VALUES ('1', 'Admin', '123', '1505662517', '1505662517', '', '0');
INSERT INTO `ym_manager` VALUES ('2', 'aaa', '123', '1505662517', '1505662517', '', '0');

-- ----------------------------
-- Table structure for ym_order
-- ----------------------------
DROP TABLE IF EXISTS `ym_order`;
CREATE TABLE `ym_order` (
  `order_id` bigint(10) unsigned NOT NULL,
  `total_amount` int(11) NOT NULL COMMENT '订单总价',
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL COMMENT 'normal-正常 dead-取消  finish-完成',
  `pay_status` tinyint(4) NOT NULL,
  `pay_method` varchar(20) NOT NULL COMMENT '-- 支付方式  -1 --货到付款  online -- 在线支付  weixin -- 微信支付  alipay--支付宝',
  `create_time` int(10) NOT NULL,
  `last_modify` varchar(255) NOT NULL COMMENT '最后一次修改',
  `ship_name` varchar(20) NOT NULL,
  `ship_mobile` varchar(11) NOT NULL,
  `ship_area` varchar(255) NOT NULL COMMENT '地域',
  `ship_addr` varchar(255) NOT NULL COMMENT '地址',
  `memo` varchar(255) NOT NULL COMMENT '订单附言',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_order
-- ----------------------------

-- ----------------------------
-- Table structure for ym_user
-- ----------------------------
DROP TABLE IF EXISTS `ym_user`;
CREATE TABLE `ym_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reg_time` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `login_count` int(11) NOT NULL,
  `login_time` int(10) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常 1-冻结 2-永久冻结',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_user
-- ----------------------------
INSERT INTO `ym_user` VALUES ('1', '胡雨', '12', '12', '12', '12', '', '0', '0', '', '0');
INSERT INTO `ym_user` VALUES ('2', '迪卡', '', '', '', '0', '', '0', '0', '', '0');
INSERT INTO `ym_user` VALUES ('3', '', 'd41d8cd98f00b204e9800998ecf8427e', '123', '', '0', '', '0', '0', '', '0');
INSERT INTO `ym_user` VALUES ('4', '', 'd41d8cd98f00b204e9800998ecf8427e', '123456', '', '0', '', '0', '0', '', '0');
INSERT INTO `ym_user` VALUES ('5', '新用户啊啊啊', 'd41d8cd98f00b204e9800998ecf8427e', '啊啊啊', '', '0', '', '0', '0', '', '0');
