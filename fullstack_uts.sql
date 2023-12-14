/*
 Navicat Premium Data Transfer

 Source Server         : PhpMyAdmin
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : fullstack_uts

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 14/12/2023 20:42:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cerita
-- ----------------------------
DROP TABLE IF EXISTS `cerita`;
CREATE TABLE `cerita`  (
  `idcerita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user_pembuat_awal` int NOT NULL,
  PRIMARY KEY (`idcerita`) USING BTREE,
  INDEX `id_user_pembuat_awal`(`id_user_pembuat_awal` ASC) USING BTREE,
  CONSTRAINT `cerita_ibfk_1` FOREIGN KEY (`id_user_pembuat_awal`) REFERENCES `user` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cerita
-- ----------------------------
INSERT INTO `cerita` VALUES (4, 'shalom', 160718039);
INSERT INTO `cerita` VALUES (5, 'CEK SOUND', 160718039);
INSERT INTO `cerita` VALUES (6, 'dami anjaz', 160718039);

-- ----------------------------
-- Table structure for paragraf
-- ----------------------------
DROP TABLE IF EXISTS `paragraf`;
CREATE TABLE `paragraf`  (
  `idparagraf` int NOT NULL AUTO_INCREMENT,
  `iduser` int NOT NULL,
  `idcerita` int NOT NULL,
  `isiparagraf` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idparagraf`) USING BTREE,
  INDEX `iduser`(`iduser` ASC) USING BTREE,
  INDEX `idcerita`(`idcerita` ASC) USING BTREE,
  CONSTRAINT `paragraf_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paragraf_ibfk_2` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paragraf
-- ----------------------------
INSERT INTO `paragraf` VALUES (4, 160718039, 4, 'omswastiastu', '2023-11-21 09:09:22');
INSERT INTO `paragraf` VALUES (5, 160718039, 4, 'A free Bootstrap 4 admin theme built with HTML/CSS and a modern development workflow environment ready to use to build your next dashboard or web application\r\n\r\n', '2023-11-21 09:09:22');
INSERT INTO `paragraf` VALUES (10, 160718039, 4, 'Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.', '2023-11-21 07:41:43');
INSERT INTO `paragraf` VALUES (11, 160718039, 4, 'Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.\r\n\r\n', '2023-11-21 07:43:57');
INSERT INTO `paragraf` VALUES (12, 160718039, 4, 'Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.\r\n\r\n', '2023-11-21 07:45:54');
INSERT INTO `paragraf` VALUES (13, 160718039, 4, 'Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.\r\n\r\n', '2023-11-21 07:47:22');
INSERT INTO `paragraf` VALUES (14, 160718039, 4, 'Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant\r\n\r\n', '2023-11-21 07:47:37');
INSERT INTO `paragraf` VALUES (15, 160718039, 4, 'ASD', '2023-11-23 02:01:50');
INSERT INTO `paragraf` VALUES (16, 160718039, 5, 'AHAY', '2023-11-23 02:02:02');
INSERT INTO `paragraf` VALUES (17, 160718039, 5, 'BABI\r\n', '2023-11-23 02:02:09');
INSERT INTO `paragraf` VALUES (18, 160718039, 4, 'ajaoisdaisojdoaisjdjasoid', '2023-12-14 13:30:08');
INSERT INTO `paragraf` VALUES (19, 160718039, 6, 'tes dami\r\n', '2023-12-14 13:30:23');
INSERT INTO `paragraf` VALUES (20, 160718039, 6, 'dwi barbar', '2023-12-14 13:30:30');
INSERT INTO `paragraf` VALUES (21, 160718039, 6, 'iqbal chobir', '2023-12-14 13:30:36');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `salt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idusers`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 160718040 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (160418002, 'Dwi Rangga Kusuma', 'ff81c3e9996691658ee74688aecb3f0f9908e106', '9e17d78e54');
INSERT INTO `user` VALUES (160718038, 'Hendra Dami', '8b0fd0f9c652e23708a42f5ec26fe177b86d520e', '704277848b');
INSERT INTO `user` VALUES (160718039, 'dani', '209d5fae8b2ba427d30650dd0250942af944a0c9', 'e9b612031d');

SET FOREIGN_KEY_CHECKS = 1;
