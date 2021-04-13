/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : crk

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-04-13 14:51:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for crk_account
-- ----------------------------
DROP TABLE IF EXISTS `crk_account`;
CREATE TABLE `crk_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) unsigned NOT NULL COMMENT '编码',
  `price` int(11) NOT NULL COMMENT '单价',
  `validity` datetime DEFAULT NULL COMMENT '有效期至',
  `num` int(11) NOT NULL COMMENT '出入库数量',
  `man` char(255) NOT NULL COMMENT '操作人',
  `time` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '操作时间',
  `incode` int(10) unsigned NOT NULL COMMENT '入库批号',
  `iotype` char(255) NOT NULL COMMENT '出库或入库',
  `iocode` int(11) NOT NULL COMMENT '1入库,-1出库',
  `remains` int(11) DEFAULT NULL COMMENT '剩余',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for crk_in
-- ----------------------------
DROP TABLE IF EXISTS `crk_in`;
CREATE TABLE `crk_in` (
  `code` int(11) unsigned NOT NULL COMMENT '编码',
  `price` int(11) NOT NULL COMMENT '单价',
  `validity` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '有效期至',
  `innum` int(11) NOT NULL COMMENT '数量',
  `inman` char(255) NOT NULL COMMENT '操作人',
  `intime` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '操作时间',
  `incode` int(10) unsigned NOT NULL COMMENT '入库批号',
  PRIMARY KEY (`intime`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for crk_out
-- ----------------------------
DROP TABLE IF EXISTS `crk_out`;
CREATE TABLE `crk_out` (
  `code` int(11) unsigned NOT NULL COMMENT '编码',
  `price` int(11) NOT NULL COMMENT '单价',
  `outnum` int(11) NOT NULL COMMENT '出库数量',
  `outman` char(255) NOT NULL COMMENT '操作人',
  `outtime` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '操作时间',
  PRIMARY KEY (`outtime`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for crk_product
-- ----------------------------
DROP TABLE IF EXISTS `crk_product`;
CREATE TABLE `crk_product` (
  `code` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编码',
  `name` char(255) NOT NULL COMMENT '名称',
  `type` varchar(255) NOT NULL DEFAULT '' COMMENT '规格',
  `unit` char(255) NOT NULL COMMENT '单位',
  `price` int(11) unsigned NOT NULL COMMENT '单价',
  `sup` varchar(255) NOT NULL COMMENT '供应商',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;
