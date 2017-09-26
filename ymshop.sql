/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ymshop

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-26 23:01:07
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_goods
-- ----------------------------
INSERT INTO `ym_goods` VALUES ('1', '海拔3300米小金青苹果 8个', '0', '32', '99', '1', '999', '11', '1505662517', '1506422104', '1', '苹果', '酸脆多汁，野生苹果的味道', '<p><img src=\"https://img.yimishiji.com/v1/img/66d406195d0b668350c6944111410c25.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/ff5f3e73e64c587def615b14731a6ad6.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">川藏高原独特的气候环境给予最自然的味道；<br style=\"box-sizing: border-box;\"/>生产过程不用农药、化肥和除草剂；<br style=\"box-sizing: border-box;\"/>若鲜食不惯，可做做色拉菜或凉拌菜配菜；</p><p><img src=\"https://img.yimishiji.com/v1/img/05b5f375af8aa35702519cd55c1d26d9.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/316ec15bca54ad3c0ffe9cfb590ceb38.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><span style=\"box-sizing: border-box;\">16年无农药，当地藏民的原始苹果</span></p><p><img src=\"https://img.yimishiji.com/v1/img/d0782246087025e7252ac0c40693ecb0.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">坚持不用化肥农药、除草剂，在专业机构的指导下，果园实行精细化施肥，用牦牛、羊粪改良土壤，用草木灰替代化肥的方式种植苹果；<br style=\"box-sizing: border-box;\"/>得天独厚的自然环境，果园里的苹果不除草，甚至不浇水，只有野生严苛状态下生长的作物，才拥有最自然的味道。</p><p><img src=\"https://img.yimishiji.com/v1/img/317121c2c638ec066c235a9dab055dc7.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/bc8570b292e1c3e6eae87be3697aed68.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><br/></p>', '2', '0', '0');
INSERT INTO `ym_goods` VALUES ('2', '上海烧卖「一只宝」 香菇肉丁', '0', '36', '66', '1', '100', '80', '1505662517', '1506422226', '2', '', '一盒6只。无需解冻，冷水入锅，大火蒸12分钟。有机优质选料，咸甜鲜的上海口味。个大皮薄，糯米入口即化，更吃得到颗颗肉丁和大块香菇', '<p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">每只烧卖都比市售的大2-3倍，净重60g/只。无需解冻，冷水入锅，大火蒸12分钟。由于烧卖皮薄，蒸的时候需要垫一块蒸笼布（纱布也可），不然容易烂底。有机优质选料，咸甜鲜的上海口味。烧卖个大皮薄，糯米入口即化，更吃得到颗颗肉丁和大块香菇。不添加任何味精及任何防腐剂和香精。</p><p><img src=\"https://img.yimishiji.com/v1/img/c3a0594809d5698dc5279299a76f7f48.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/3dddf2e64e7237ba3c40f7baf9a2851c.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">一米市集与上海网红烧卖的合作，为你解决每天早上孩子吃什么，怎么吃才健康的问题。保留华阿姨手作烧卖皮薄个大、上海传统的甜咸味道、馅料丰富这三大特点，一米市集通过将近半年的口味调试和馅料搭配，制作了两款烧卖（香菇肉丁与养生紫薯），并命名「一只宝」。既突出烧卖个大馅多，一只就饱的特点；也是延续了华阿姨「妈妈级别」烧卖的美好初衷。</p><p><img src=\"https://img.yimishiji.com/v1/img/4a259ec6e02cfb97ee57adfcb0173175.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「一只宝」的所有原料均经过一米市集的精挑细选，将有机的、天然无毒的、无负面添加的食材，统统包进一只烧卖里面！</p><p><img src=\"https://img.yimishiji.com/v1/img/524d0cedeed829d2c9a53210a9854bc3.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「薄如蝉翼」的烧卖皮：只选用优质小麦粉与纯净水配比，不加碱。如果你对一米市集严选的两款又薄又有嚼劲的水饺皮和馄饨皮印象深刻的话，你也会这薄、透、韧的烧卖皮大为赞赏。</p><p><img src=\"https://img.yimishiji.com/v1/img/28812eaf85f8d0d5b6798a9c4d4b5d0b.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">有机东北糯米：精选东北的有机糯米，独特丰饶的水土，让糯米又香又黏糯；</p><p><img src=\"https://img.yimishiji.com/v1/img/66123135a9443a751d9064f9035a73c7.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">精气神山黑猪猪后腿精肉：去皮去膘的山黑猪纯精肉。每60只烧卖中的肉丁只加3g盐炒熟去腥味。猪肉香味绝对让你眼前一亮。</p><p><img src=\"https://img.yimishiji.com/v1/img/2b768cb23f2f5dd5f9713cb1a8ba6f1f.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">出口级品质的香菇：精选出口日本与欧洲级别的香菇，个头大、均匀，肉质细嫩，味道香浓。</p><p><img src=\"https://img.yimishiji.com/v1/img/7f9801a9be5fbcfba17e2acab5686505.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">遵循自然原酿酱油：选用东北的大米、山东的小麦，用180天酿造一瓶酱油。酱香、酯香浓郁、入味，烧卖的咸鲜味，只靠酱油来体现。</p><p><img src=\"https://img.yimishiji.com/v1/img/6d7e3454a176ab90dcc9a09ab746d43b.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">妈妈在意孩子的健康多过于对于成本的考量，因此一米市集精作的烧卖成本是市售烧卖的六倍，但我们的售价并不是六倍。而且烹饪方便，只需每天早上花上12分钟，早餐2只烧卖一杯牛奶，让孩子吃得健康又营养。</p><p><br/></p>', '3', '0', '0');
INSERT INTO `ym_goods` VALUES ('4', '豆味道 浓豆浆280ml', '0', '15', '15', '1', '99', '0', '1506423769', '0', '1', '', '采用东北敦化非转基因大豆制作，豆香馥郁，质地粘滑浓稠，蛋白质含量高，喝起来就像刚从豆浆锅里打出来的一样，「小时候的豆浆味道」。', '<p><img src=\"https://img.yimishiji.com/v1/img/ff0f686f051217bd09d3ca2bff9f59bc.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「豆味道」浓豆浆，豆香馥郁，质地粘滑浓稠，味道非常新鲜香美。据说，这种浓度的豆浆，已经是可以用来点豆腐的水平了。</p><p><img src=\"https://img.yimishiji.com/v1/img/e636656af1ea34e50916b45366290abd.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">如今，这么浓稠，味道这么纯正的豆浆，市面上真的很少见！当采购开苏将这款豆浆拿到一米市集选品会上给大家品尝时，惊艳了全场。各位见多识广、口味刁钻的「美食家」纷纷表示，这款豆浆喝得出满满的诚意。有的人说，尝起来如同现煮，就像刚从老家的豆浆锅里打出来的一样；还有人说，记忆中小时候喝过的豆浆，就是这种味道！</p><p><img src=\"https://img.yimishiji.com/v1/img/e00dce750a5279c009cdea89e9d83c3b.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「豆味道」的豆浆，有浓豆浆、美豆浆两种。这两款都有浓郁的豆香，馥郁绵缠，久久停留在喉舌之间，丰富的游离态氨基酸在口腔黏膜之上萦绕跳跃，给味蕾多样化、全面的刺激，让人感受到无可抵御的醇厚鲜味。</p><p><img src=\"https://img.yimishiji.com/v1/img/93157609ace311a93476ca3af83e36f8.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">两款的差别在于质地的浓稠程度。美豆浆已经比市面上常见的豆浆更加浓稠了，但还有比较好的流动性；而浓豆浆的质地，已经像泥浆一样，据说可以直接用来点豆腐了。</p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">敦化大豆——好品质从源头抓起<br style=\"box-sizing: border-box;\"/>为了煮出美味的豆浆，「豆味道」特意去东北寻找最好的大豆，最后选中了吉林敦化的非转基因大豆。由于地理位置的缘故，敦化的大豆所含蛋白质较高，且质地稠密，南方的大豆4小时就可以泡开，而北方的豆子要8小时才可以。<br style=\"box-sizing: border-box;\"/>——蛋白质含量越高，我们所能尝到的「鲜味」就越足！</p><p><img src=\"https://img.yimishiji.com/v1/img/42ebf1a72931cc6512af6d1d73728f4c.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">温馨提示：<br style=\"box-sizing: border-box;\"/>1. 这款豆浆营养丰富，不添加任何防腐剂，保质期只有5天。请根据包装上的提示，在10℃以下的冷藏环境中存放。开盖后尽快饮用，避免变质。<br style=\"box-sizing: border-box;\"/>2. 豆浆的浓稠度受温度影响很大，温度越低，质地越浓稠，加热后会变稀。如果想品尝不同口感的豆浆，试试改变它的温度吧！</p><p><span style=\"box-sizing: border-box;\">食物的背后</span></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「豆味道」的经营者张芳说：</p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「豆味道做豆腐，没想它要上市，没想做多少连锁店，豆味道的理念首选永远是做出最好的豆腐给大家。」</p><p><img src=\"https://img.yimishiji.com/v1/img/a7ecc7ddf5b2178cf22e850e61688324.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">「我们主要走小而精的路线，我坚信好的品质就会得到大家的认可……我们想让大家品尝的时候，不仅味觉美好，还要有幸福的感觉，幸福的感觉对现代人来说不就是无价之宝吗？我们会坚持脚踏实地的一步一步来。」</p><p><br/></p>', '4', '0', '0');
INSERT INTO `ym_goods` VALUES ('5', '生态种植蒲江红心猕猴桃 24个', '0', '98', '98', '1', '99', '0', '1506423962', '0', '1', '多汁高甜度，果肉香糯细腻', '', '<p><img src=\"https://img.yimishiji.com/v1/img/cfa1f6662b712fce9140fb6fc13d681c.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">甜度非常高，吃口细嫩<br style=\"box-sizing: border-box;\"/>汁多又香气十足<br style=\"box-sizing: border-box;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/1d13756c92daf6877859a5f0b5a61f03.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><span style=\"box-sizing: border-box;\">世界公认的猕猴桃最佳种植区</span></p><p><img src=\"https://img.yimishiji.com/v1/img/2b5b83481d8e42e2f561853e94382193.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">北纬30度，日照时数超过3000小时&nbsp;<br style=\"box-sizing: border-box;\"/>年均降水量1200mm，春夏足而秋冬短<br style=\"box-sizing: border-box;\"/>更举办了国际猕猴桃高峰论坛</p><p><img src=\"https://img.yimishiji.com/v1/img/98ca951513e92a79b074ca6804ee4529.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/c8397b6c87ac66a37cc2c4755b7fe859.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><span style=\"box-sizing: border-box;\">声名远播的蒲江猕猴桃种植示范基地</span></p><p style=\"box-sizing: border-box; margin-top: 10px; margin-bottom: 10px; color: rgb(71, 81, 92); font-size: 16px; line-height: 28px;\">优势：红心猕猴桃抗病虫害能力强，不施加农药也可稳定生长<br style=\"box-sizing: border-box;\"/>肥料：只用加了水的沼液或者农家肥<br style=\"box-sizing: border-box;\"/>捉虫：套袋，频振灭虫灯，粘虫板等物理方法<br style=\"box-sizing: border-box;\"/>储藏：梯度降温入库法，最大程度保留猕猴桃的风味</p><p><img src=\"https://img.yimishiji.com/v1/img/46c021bebce0a7b74967c6d31629d2b3.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><img src=\"https://img.yimishiji.com/v1/img/134350ae3cea50bb956ccd3ad1615065.jpg\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; transition: all 0.2s ease; width: 650px;\"/></p><p><br/></p>', '2', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_images
-- ----------------------------
INSERT INTO `ym_images` VALUES ('5', '1', '/static/admin/images/uploads/20170926/10396940f52727045f6bf5df5bd55d52.jpg', '/static/admin/images/uploads/20170926/b_10396940f52727045f6bf5df5bd55d52.jpg', '/static/admin/images/uploads/20170926/m_10396940f52727045f6bf5df5bd55d52.jpg', '/static/admin/images/uploads/20170926/s_10396940f52727045f6bf5df5bd55d52.jpg', '0');
INSERT INTO `ym_images` VALUES ('9', '2', '/static/admin/images/uploads/20170926/4e05e9d72d1e519fabe7676077a72777.jpg', '/static/admin/images/uploads/20170926/b_4e05e9d72d1e519fabe7676077a72777.jpg', '/static/admin/images/uploads/20170926/m_4e05e9d72d1e519fabe7676077a72777.jpg', '/static/admin/images/uploads/20170926/s_4e05e9d72d1e519fabe7676077a72777.jpg', '0');
INSERT INTO `ym_images` VALUES ('4', '1', '/static/admin/images/uploads/20170926/2277f0feb3b4787848b28829eff4d9df.jpg', '/static/admin/images/uploads/20170926/b_2277f0feb3b4787848b28829eff4d9df.jpg', '/static/admin/images/uploads/20170926/m_2277f0feb3b4787848b28829eff4d9df.jpg', '/static/admin/images/uploads/20170926/s_2277f0feb3b4787848b28829eff4d9df.jpg', '1');
INSERT INTO `ym_images` VALUES ('6', '1', '/static/admin/images/uploads/20170926/4c9386dfb34ecb29ec17cf174581bfc5.jpg', '/static/admin/images/uploads/20170926/b_4c9386dfb34ecb29ec17cf174581bfc5.jpg', '/static/admin/images/uploads/20170926/m_4c9386dfb34ecb29ec17cf174581bfc5.jpg', '/static/admin/images/uploads/20170926/s_4c9386dfb34ecb29ec17cf174581bfc5.jpg', '0');
INSERT INTO `ym_images` VALUES ('7', '1', '/static/admin/images/uploads/20170926/41c00c2887fa3567f8480b621d9416b3.jpg', '/static/admin/images/uploads/20170926/b_41c00c2887fa3567f8480b621d9416b3.jpg', '/static/admin/images/uploads/20170926/m_41c00c2887fa3567f8480b621d9416b3.jpg', '/static/admin/images/uploads/20170926/s_41c00c2887fa3567f8480b621d9416b3.jpg', '0');
INSERT INTO `ym_images` VALUES ('8', '2', '/static/admin/images/uploads/20170926/41e251b38c6ebee5d55a989209522fdc.jpg', '/static/admin/images/uploads/20170926/b_41e251b38c6ebee5d55a989209522fdc.jpg', '/static/admin/images/uploads/20170926/m_41e251b38c6ebee5d55a989209522fdc.jpg', '/static/admin/images/uploads/20170926/s_41e251b38c6ebee5d55a989209522fdc.jpg', '1');
INSERT INTO `ym_images` VALUES ('10', '2', '/static/admin/images/uploads/20170926/c0742b4bf43bcf842b2ee33bfa1178e7.jpg', '/static/admin/images/uploads/20170926/b_c0742b4bf43bcf842b2ee33bfa1178e7.jpg', '/static/admin/images/uploads/20170926/m_c0742b4bf43bcf842b2ee33bfa1178e7.jpg', '/static/admin/images/uploads/20170926/s_c0742b4bf43bcf842b2ee33bfa1178e7.jpg', '0');
INSERT INTO `ym_images` VALUES ('11', '2', '/static/admin/images/uploads/20170926/cb6e9523c0f9a82c2418b56052700eb7.jpg', '/static/admin/images/uploads/20170926/b_cb6e9523c0f9a82c2418b56052700eb7.jpg', '/static/admin/images/uploads/20170926/m_cb6e9523c0f9a82c2418b56052700eb7.jpg', '/static/admin/images/uploads/20170926/s_cb6e9523c0f9a82c2418b56052700eb7.jpg', '0');
INSERT INTO `ym_images` VALUES ('21', '4', '/static/admin/images/uploads/20170926/f869c361e51060880194740199f4d0c4.jpg', '/static/admin/images/uploads/20170926/b_f869c361e51060880194740199f4d0c4.jpg', '/static/admin/images/uploads/20170926/m_f869c361e51060880194740199f4d0c4.jpg', '/static/admin/images/uploads/20170926/s_f869c361e51060880194740199f4d0c4.jpg', '1');
INSERT INTO `ym_images` VALUES ('13', '4', '/static/admin/images/uploads/20170926/0e27de81e219c805c0c58d777b923897.jpg', '/static/admin/images/uploads/20170926/b_0e27de81e219c805c0c58d777b923897.jpg', '/static/admin/images/uploads/20170926/m_0e27de81e219c805c0c58d777b923897.jpg', '/static/admin/images/uploads/20170926/s_0e27de81e219c805c0c58d777b923897.jpg', '0');
INSERT INTO `ym_images` VALUES ('14', '4', '/static/admin/images/uploads/20170926/c55842a0167f6f7aadf7169fe5b459ec.jpg', '/static/admin/images/uploads/20170926/b_c55842a0167f6f7aadf7169fe5b459ec.jpg', '/static/admin/images/uploads/20170926/m_c55842a0167f6f7aadf7169fe5b459ec.jpg', '/static/admin/images/uploads/20170926/s_c55842a0167f6f7aadf7169fe5b459ec.jpg', '0');
INSERT INTO `ym_images` VALUES ('15', '4', '/static/admin/images/uploads/20170926/8660b911f7087c79701830b5a5bdee4d.jpg', '/static/admin/images/uploads/20170926/b_8660b911f7087c79701830b5a5bdee4d.jpg', '/static/admin/images/uploads/20170926/m_8660b911f7087c79701830b5a5bdee4d.jpg', '/static/admin/images/uploads/20170926/s_8660b911f7087c79701830b5a5bdee4d.jpg', '0');
INSERT INTO `ym_images` VALUES ('20', '5', '/static/admin/images/uploads/20170926/d1bbcc6c55b444462d453eee90005aaf.jpg', '/static/admin/images/uploads/20170926/b_d1bbcc6c55b444462d453eee90005aaf.jpg', '/static/admin/images/uploads/20170926/m_d1bbcc6c55b444462d453eee90005aaf.jpg', '/static/admin/images/uploads/20170926/s_d1bbcc6c55b444462d453eee90005aaf.jpg', '1');
INSERT INTO `ym_images` VALUES ('17', '5', '/static/admin/images/uploads/20170926/8ab276d026a1357ad12a6f21463c76be.jpg', '/static/admin/images/uploads/20170926/b_8ab276d026a1357ad12a6f21463c76be.jpg', '/static/admin/images/uploads/20170926/m_8ab276d026a1357ad12a6f21463c76be.jpg', '/static/admin/images/uploads/20170926/s_8ab276d026a1357ad12a6f21463c76be.jpg', '0');
INSERT INTO `ym_images` VALUES ('18', '5', '/static/admin/images/uploads/20170926/6e62a4589a1a60a942f42e7e8b5f7a24.jpg', '/static/admin/images/uploads/20170926/b_6e62a4589a1a60a942f42e7e8b5f7a24.jpg', '/static/admin/images/uploads/20170926/m_6e62a4589a1a60a942f42e7e8b5f7a24.jpg', '/static/admin/images/uploads/20170926/s_6e62a4589a1a60a942f42e7e8b5f7a24.jpg', '0');
INSERT INTO `ym_images` VALUES ('19', '5', '/static/admin/images/uploads/20170926/0472774cdbe2c24ceb4afb6257c10dc0.jpg', '/static/admin/images/uploads/20170926/b_0472774cdbe2c24ceb4afb6257c10dc0.jpg', '/static/admin/images/uploads/20170926/m_0472774cdbe2c24ceb4afb6257c10dc0.jpg', '/static/admin/images/uploads/20170926/s_0472774cdbe2c24ceb4afb6257c10dc0.jpg', '0');

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
