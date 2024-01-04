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

 Date: 20/12/2023 13:56:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cerita
-- ----------------------------
DROP TABLE IF EXISTS `cerita`;
CREATE TABLE `cerita`  (
  `idcerita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user_pembuat_awal` int NOT NULL,
  PRIMARY KEY (`idcerita`) USING BTREE,
  INDEX `id_user_pembuat_awal`(`id_user_pembuat_awal` ASC) USING BTREE,
  CONSTRAINT `cerita_ibfk_1` FOREIGN KEY (`id_user_pembuat_awal`) REFERENCES `user` (`idusers`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for paragraf
-- ----------------------------
DROP TABLE IF EXISTS `paragraf`;
CREATE TABLE `paragraf`  (
  `idparagraf` int NOT NULL AUTO_INCREMENT,
  `iduser` int NOT NULL,
  `idcerita` int NOT NULL,
  `isiparagraf` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idparagraf`) USING BTREE,
  INDEX `iduser`(`iduser` ASC) USING BTREE,
  INDEX `idcerita`(`idcerita` ASC) USING BTREE,
  CONSTRAINT `paragraf_ibfk_2` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paragraf_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`idusers`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `idusers` int NOT NULL,
  `nama` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idusers`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 160718046 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
