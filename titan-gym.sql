/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : localhost:3310
 Source Schema         : titan-gym

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : 65001

 Date: 21/11/2017 16:57:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `published` tinyint(3) UNSIGNED NOT NULL,
  `date` datetime(0) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (1, 'Виктор', 'x-_man@mail.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores culpa dignissimos enim expedita, maxime nisi porro quas quibusdam voluptate voluptatum?', 1, '2017-11-21 16:23:29', 7);
INSERT INTO `comment` VALUES (2, 'Виктор', 'x-_man@mail.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores culpa dignissimos enim expedita, maxime nisi porro quas quibusdam voluptate voluptatum?', 1, '2017-11-21 16:23:29', 14);
INSERT INTO `comment` VALUES (3, 'Виктор', 'x-_man@mail.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores culpa dignissimos enim expedita, maxime nisi porro quas quibusdam voluptate voluptatum?', 1, '2017-11-21 16:23:29', 0);

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES (1, 'onetime_training', 'Разовая тренировка: <strong>40 грн, 30 грн, 30 грн</strong> для взрослых, школьников и студентов\r\n                соотведственно.');

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price_adult` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price_students` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price_schools` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES (1, '1 Месяц', '350 грн.', '300 грн.', '250 грн.');
INSERT INTO `plan` VALUES (2, '3 Месяца', '750 грн.', '700 грн.', ' 650 грн.');
INSERT INTO `plan` VALUES (3, 'Пол года', '1300 грн.', '1200 грн.', '1100 грн.');
INSERT INTO `plan` VALUES (4, 'Год', '2400 грн.', '2300 грн.', '2200 грн.');

SET FOREIGN_KEY_CHECKS = 1;
