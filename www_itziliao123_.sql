/*
 Navicat Premium Data Transfer

 Source Server         : 本地mysql
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : www_itziliao123_

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 17/04/2021 12:36:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rights` int(11) NULL DEFAULT NULL COMMENT '1.超级管理员 2.普通管理员',
  `loginTime` int(11) NULL DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES (1, 'admin', '1', 1, NULL, NULL);
INSERT INTO `admin_user` VALUES (10, 'a', 'a', 2, NULL, '');
INSERT INTO `admin_user` VALUES (11, 'a456', '12', 1, 1615002846, '39.128.151.115');
INSERT INTO `admin_user` VALUES (12, 'admin1', 'admin1', 2, 1618468445, '192.168.58.1');

-- ----------------------------
-- Table structure for adminlog
-- ----------------------------
DROP TABLE IF EXISTS `adminlog`;
CREATE TABLE `adminlog`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addtime` int(11) NULL DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登陆状态:1.正常登陆 2:用户不存在 -2：密码错误',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 256 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adminlog
-- ----------------------------
INSERT INTO `adminlog` VALUES (1, 'admin', 'admin', 1614438750, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (4, 'admin', 'admin', 1614470248, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (5, 'admin', 'admin', 1614470827, '39.128.151.48', '2');
INSERT INTO `adminlog` VALUES (6, 'admin', 'admin', 1614511280, '39.128.151.48', '2');
INSERT INTO `adminlog` VALUES (7, 'admin', 'admin', 1614511288, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (8, 'admin', 'admin', 1614520924, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (10, 'admin', 'admin', 1614528608, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (11, 'admin', 'admin', 1614528608, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (14, 'admin', 'admin', 1614641795, '39.128.151.48', '1');
INSERT INTO `adminlog` VALUES (15, 'admin', 'admin', 1614687528, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (16, 'admin', 'admin', 1614875208, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (17, 'admin', 'admin', 1614876353, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (18, '456', '456', 1614876413, '183.225.146.120', '-2');
INSERT INTO `adminlog` VALUES (19, '456', '456', 1614876464, '183.225.146.120', '-2');
INSERT INTO `adminlog` VALUES (20, 'admin', 'admin', 1614876476, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (21, 'admin', 'admin', 1614876516, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (22, 'admin', 'admin', 1614876551, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (23, 'admin', 'admin', 1614876730, '183.225.146.120', '2');
INSERT INTO `adminlog` VALUES (24, 'admin', 'admin', 1614876738, '183.225.146.120', '2');
INSERT INTO `adminlog` VALUES (25, 'admin', 'admin', 1614876769, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (26, 'admin', 'admin', 1614876827, '183.225.146.120', '2');
INSERT INTO `adminlog` VALUES (27, 'admin', 'admin', 1614877346, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (28, 'admin', 'admin', 1614877362, '183.225.146.120', '2');
INSERT INTO `adminlog` VALUES (29, 'admin', 'admin', 1614877395, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (30, 'admin', 'admin', 1614878104, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (31, 'admin', 'admin', 1614878135, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (32, 'admin', 'admin', 1614906932, '183.225.146.120', '2');
INSERT INTO `adminlog` VALUES (33, 'admin', 'admin', 1614906936, '183.225.146.120', '1');
INSERT INTO `adminlog` VALUES (34, 'admin', 'admin', 1614959332, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (35, 'a', 'a', 1614960285, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (36, 'admin', 'admin', 1614960623, '39.128.151.115', '2');
INSERT INTO `adminlog` VALUES (37, 'admin', 'admin', 1614960629, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (38, 'admin', 'admin', 1614991788, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (39, 'admin', 'admin', 1614995560, '39.128.151.115', '2');
INSERT INTO `adminlog` VALUES (40, 'admin', 'admin', 1614995564, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (41, 'a', 'a', 1614995687, '39.128.151.115', '2');
INSERT INTO `adminlog` VALUES (43, 'admin', 'admin', 1615002327, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (44, 'admin', 'admin', 1615002350, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (45, 'a', 'a', 1615002427, '39.128.151.115', '-2');
INSERT INTO `adminlog` VALUES (46, 'a', 'a', 1615002495, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (47, 'admin', 'admin', 1615032700, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (48, 'admin', 'admin', 1615033377, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (49, 'admin', 'admin', 1615033431, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (50, 'admin', 'admin', 1615033438, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (51, 'admin', 'admin', 1615035757, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (52, 'admin', 'admin', 1615036593, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (53, 'admin', 'admin', 1615036927, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (54, 'admin', 'admin', 1615042799, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (55, 'admin', 'admin', 1615045793, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (56, 'admin', 'admin', 1615045857, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (57, 'admin', 'admin', 1615075841, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (58, 'a', 'a', 1615076641, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (59, '', '', 1615076702, '61.151.178.177', '-2');
INSERT INTO `adminlog` VALUES (60, 'admin', 'admin', 1615081224, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (61, 'admin', 'admin', 1615081245, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (62, 'admin', 'admin', 1615081291, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (63, 'admin', 'admin', 1615084816, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (64, 'admin', 'admin', 1615084839, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (65, 'admin', 'admin', 1615084873, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (66, 'admin', 'admin', 1615089933, '39.128.151.115', '1');
INSERT INTO `adminlog` VALUES (67, 'admin', 'admin', 1615103487, '39.128.151.56', '1');
INSERT INTO `adminlog` VALUES (68, 'admin', 'admin', 1615164260, '39.128.151.56', '1');
INSERT INTO `adminlog` VALUES (69, 'admin', 'admin', 1615170064, '39.128.151.56', '1');
INSERT INTO `adminlog` VALUES (70, 'admin', 'admin', 1615187923, '14.204.0.166', '1');
INSERT INTO `adminlog` VALUES (71, 'admin', 'admin', 1615214837, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (72, 'admin', 'admin', 1615246658, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (73, 'admin', 'admin', 1615263717, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (74, 'admin', 'admin', 1615282301, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (75, 'admin', 'admin', 1615340037, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (76, 'admin', 'admin', 1615375333, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (77, 'admin', 'admin', 1615521631, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (78, 'admin', 'admin', 1615553032, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (79, 'admin', 'admin', 1615600904, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (80, 'admin', 'admin', 1615722870, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (81, 'admin', 'admin', 1615807087, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (82, 'admin', 'admin', 1615852071, '180.130.2.233', '1');
INSERT INTO `adminlog` VALUES (83, 'admin', 'admin', 1615857066, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (84, 'admin', 'admin', 1615869530, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (85, 'admin', 'admin', 1615874667, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (86, 'admin', 'admin', 1615878141, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (87, 'admin', 'admin', 1615879194, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (88, 'admin', 'admin', 1615888749, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (89, 'admin', 'admin', 1615888861, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (90, 'admin', 'admin', 1615888928, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (91, 'admin', 'admin', 1615895559, '180.130.2.181', '1');
INSERT INTO `adminlog` VALUES (92, 'admin', 'admin', 1615898032, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (93, 'a', 'a', 1615898150, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (94, 'admin', 'admin', 1615898617, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (95, 'admin', 'admin', 1615935812, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (96, 'admin', 'admin', 1615935953, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (97, 'admin', 'admin', 1615937700, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (98, 'admin', 'admin', 1615937783, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (99, 'admin', 'admin', 1615937949, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (100, 'admin', 'admin', 1615951158, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (101, 'admin', 'admin', 1615952697, '117.136.85.172', '1');
INSERT INTO `adminlog` VALUES (102, '', '', 1615953790, '180.163.220.3', '-2');
INSERT INTO `adminlog` VALUES (103, '', '', 1615953792, '180.163.220.3', '-2');
INSERT INTO `adminlog` VALUES (104, '风筝有风', '风筝有风', 1615954113, '106.61.28.4', '-2');
INSERT INTO `adminlog` VALUES (105, '', '', 1615954113, '59.36.119.226', '-2');
INSERT INTO `adminlog` VALUES (106, '', '', 1615954180, '61.151.207.141', '-2');
INSERT INTO `adminlog` VALUES (107, 'admin', 'admin', 1615954482, '180.130.10.192', '1');
INSERT INTO `adminlog` VALUES (108, 'admin', 'admin', 1615955515, '222.219.232.184', '2');
INSERT INTO `adminlog` VALUES (109, 'admin', 'admin', 1615955526, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (110, 'admin', 'admin', 1615960492, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (111, 'admin', 'admin', 1615983218, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (112, 'admin', 'admin', 1615985374, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (113, 'admin', 'admin', 1615988863, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (114, 'admin', 'admin', 1615990723, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (115, 'admin', 'admin', 1616021846, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (116, 'admin', 'admin', 1616022145, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (117, 'admin', 'admin', 1616022197, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (118, 'admin', 'admin', 1616037052, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (119, 'admin', 'admin', 1616050233, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (120, 'admin', 'admin', 1616110066, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (121, 'admin', 'admin', 1616282648, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (122, 'admin', 'admin', 1616282678, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (123, 'admin', 'admin', 1616282728, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (124, 'admin', 'admin', 1616374097, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (125, 'admin', 'admin', 1616389515, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (126, 'admin', 'admin', 1616389535, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (127, 'admin', 'admin', 1616424883, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (128, 'admin', 'admin', 1616463302, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (129, 'admin', 'admin', 1616463585, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (130, 'admin', 'admin', 1616720456, '106.58.238.19', '2');
INSERT INTO `adminlog` VALUES (131, 'admin', 'admin', 1616720463, '106.58.238.19', '2');
INSERT INTO `adminlog` VALUES (132, 'admin', 'admin', 1616826998, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (133, 'admin', 'admin', 1616827176, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (134, 'admin', 'admin', 1616827423, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (135, 'admin', 'admin', 1616828750, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (136, 'admin', 'admin', 1616836199, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (137, 'admin', 'admin', 1616912467, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (138, 'admin', 'admin', 1616922851, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (139, 'admin', 'admin', 1616931082, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (140, 'admin', 'admin', 1616963472, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (141, 'admin', 'admin', 1616976171, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (142, 'admin', 'admin', 1617058825, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (143, 'admin', 'admin', 1617070968, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (144, 'admin', 'admin', 1617082892, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (145, 'admin', 'admin', 1617145371, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (146, 'admin', 'admin', 1617182355, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (147, 'admin', 'admin', 1617182383, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (148, 'admin', 'admin', 1617230949, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (149, 'admin', 'admin', 1617230975, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (150, 'admin', 'admin', 1617243234, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (151, 'admin', 'admin', 1617243555, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (152, 'admin', 'admin', 1617243684, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (153, 'admin', 'admin', 1617243718, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (154, 'admin', 'admin', 1617243723, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (155, 'admin', 'admin', 1617243954, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (156, 'admin', 'admin', 1617286127, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (157, 'admin', 'admin', 1617318762, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (158, 'admin', 'admin', 1617318985, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (159, 'admin', 'admin', 1617319054, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (160, 'admin', 'admin', 1617319086, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (161, 'admin', 'admin', 1617319224, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (162, 'admin', 'admin', 1617319336, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (163, 'admin', 'admin', 1617319371, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (164, 'admin', 'admin', 1617320564, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (165, '1531153813@qq.com', '1531153813@qq.com', 1617338316, '192.168.58.1', '-2');
INSERT INTO `adminlog` VALUES (166, 'admin', 'admin', 1617338321, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (167, 'admin', 'admin', 1617338829, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (168, 'admin', 'admin', 1617338894, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (169, 'admin', 'admin', 1617347029, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (170, 'admin', 'admin', 1617351640, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (171, 'admin', 'admin', 1617428343, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (172, '', '', 1617428403, '180.97.118.219', '-2');
INSERT INTO `adminlog` VALUES (173, 'admin', 'admin', 1617545511, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (174, 'admin', 'admin', 1617548979, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (175, 'admin', 'admin', 1617549751, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (176, 'admin', 'admin', 1617610808, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (177, 'admin', 'admin', 1617610814, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (178, '', '', 1617610853, '192.168.58.1', '-2');
INSERT INTO `adminlog` VALUES (179, 'admin', 'admin', 1617610859, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (180, 'admin', 'admin', 1617611025, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (181, 'admin', 'admin', 1617612095, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (182, 'admin', 'admin', 1617612917, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (183, 'admin', 'admin', 1617613942, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (184, 'admin', 'admin', 1617624404, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (185, 'admin', 'admin', 1617624835, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (186, 'admin', 'admin', 1617624908, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (187, 'admin', 'admin', 1617624929, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (188, 'admin', 'admin', 1617625267, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (189, 'admin', 'admin', 1617700548, '222.219.232.184', '1');
INSERT INTO `adminlog` VALUES (190, '1531153813@qq.com', '1531153813@qq.com', 1617700787, '192.168.58.1', '-2');
INSERT INTO `adminlog` VALUES (191, 'admin', 'admin', 1617700796, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (192, 'admin', 'admin', 1617700842, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (193, 'admin', 'admin', 1617716042, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (194, 'admin', 'admin', 1617754824, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (195, 'admin', 'admin', 1617755872, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (196, 'admin', 'admin', 1617762058, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (197, 'admin', 'admin', 1617769886, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (198, 'admin', 'admin', 1617777585, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (199, 'admin', 'admin', 1617784198, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (200, 'admin', 'admin', 1617784948, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (201, 'admin', 'admin', 1617798698, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (202, 'admin', 'admin', 1617843165, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (203, 'admin', 'admin', 1617843498, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (204, 'admin', 'admin', 1617843758, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (205, 'admin', 'admin', 1617888636, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (206, 'admin', 'admin', 1617957535, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (207, '1531153813@qq.com', '1531153813@qq.com', 1617957654, '192.168.58.1', '-2');
INSERT INTO `adminlog` VALUES (208, 'admin', 'admin', 1617957657, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (209, 'admin', 'admin', 1618037148, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (210, 'admin', 'admin', 1618095414, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (211, '1531153813@qq.com', '1531153813@qq.com', 1618107115, '192.168.58.1', '-2');
INSERT INTO `adminlog` VALUES (212, 'admin', 'admin', 1618107118, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (213, 'admin', 'admin', 1618137070, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (214, 'admin', 'admin', 1618183438, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (215, 'admin', 'admin', 1618210391, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (216, 'admin', 'admin', 1618273189, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (217, 'admin', 'admin', 1618286557, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (218, 'admin', 'admin', 1618301126, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (219, 'admin', 'admin', 1618315666, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (220, 'admin', 'admin', 1618317644, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (221, 'admin', 'admin', 1618360360, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (222, 'admin', 'admin', 1618366183, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (223, 'admin', 'admin', 1618395262, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (224, 'admin', 'admin', 1618440627, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (225, 'admin', 'admin', 1618447661, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (226, 'admin', 'admin', 1618462890, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (227, 'admin', 'admin', 1618463627, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (228, 'admin', 'admin', 1618463807, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (229, 'admin', 'admin', 1618468395, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (230, 'admin', 'admin', 1618468975, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (231, 'admin', 'admin', 1618478452, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (232, 'admin', 'admin', 1618490589, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (233, 'admin', 'admin', 1618490817, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (234, 'admin', 'admin', 1618531762, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (235, 'admin', 'admin', 1618531762, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (236, 'admin', 'admin', 1618556203, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (237, 'admin', 'admin', 1618556240, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (238, 'admin', 'admin', 1618556307, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (239, 'admin', 'admin', 1618614108, '192.168.58.1', '1');
INSERT INTO `adminlog` VALUES (240, 'admin', 'admin', 1618616768, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (241, 'admin', 'admin', 1618616780, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (242, 'admin', 'admin', 1618616810, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (243, 'admin', 'admin', 1618617510, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (244, 'admin', 'admin', 1618617531, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (245, 'admin', 'admin', 1618617562, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (246, 'admin', 'admin', 1618617570, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (247, 'admin', 'admin', 1618617592, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (248, 'admin', 'admin', 1618617687, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (249, 'admin', 'admin', 1618617703, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (250, 'admin', 'admin', 1618625196, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (251, 'admin', 'admin', 1618625350, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (252, 'admin', 'admin', 1618625366, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (253, 'admin', 'admin', 1618625383, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (254, 'admin', 'admin', 1618630979, '127.0.0.1', '1');
INSERT INTO `adminlog` VALUES (255, 'admin', 'admin', 1618630994, '127.0.0.1', '1');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `typeid` int(11) NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `com` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hits` int(11) NOT NULL COMMENT '浏览量',
  `inputer` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `issh` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES (1, '我是快报--测试', 19, '管理员', '原创', 123473, 'admin', 1617086289, '&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 16px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify;&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;【环球时报记者 邵一佳】&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;耐克被&lt;/span&gt;“碰瓷”了。据美国有线电视新闻网29日报道，美国说唱歌手利尔·纳斯·X和街头潮流品牌MSCHF合作，推出了一款“撒旦鞋”，鞋里含有人血。这款鞋由耐克Air Max 97运动鞋改造而成，29日限量发售666双，每双1018美元。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 16px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify;&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;报道称，每双“撒旦鞋”的气垫中注入了60毫升的红墨水和一滴人血。鞋子上除了原有的耐克标志清晰可见外，还标有1/666和《圣经》中讲述撒旦从天堂坠落的经文。鞋带上挂有象征撒旦的五芒星金属装饰物，鞋盒上画有骷髅。这款鞋一经推出，立即引发愤怒和批评。&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;福音教派牧师批评这款鞋“邪恶”“属于宗教异端”，南达科他州州长克里斯蒂·诺姆29日批评称，这样的鞋子会误导年轻人。在争议下，一些网民开始向耐克要说法。&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 16px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify;&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;耐克公司急忙澄清，表示与利尔·纳斯·X和MSCHF没有合作关系，没有参与鞋的设计、发售，也不支持这款鞋。MSCHF发言人称，被改造的耐克原型鞋是公司从市场独立采购的，耐克没有参与，制造鞋子所用的人血来自愿意为艺术献身的公司成员。利尔·纳斯·X虽然发布了一则标题写着“道歉”的视频作为回应，但内容却主要是他的新歌MV，视频中他为恶魔跳色情舞蹈。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 16px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify;&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;美国全国广播公司29日报道称，MSCHF 2019年推出过一款同样是以耐克Air Max 97运动鞋为原型的鞋子，名叫“耶稣鞋”，声称鞋的气垫里含有从约旦河里取来的“圣水”。MSCHF还宣传称，鞋子都有牧师的祝福加持，每双要价1450美元，开卖后很快售罄，网上二手倒卖价曾高达每双4000美元。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210330/1617086285193709.jpg&quot; title=&quot;1617086285193709.jpg&quot; alt=&quot;1.jpg&quot;/&gt;&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (3, '西部数据移动硬盘，办公室工作、家里游戏的好帮手', 20, '管理员', '原创', 33, 'admin', 1617146105, '本人在公司从事行政工作，需要整理公司大大小小的文件和数据，并备案保存。之前买的优盘太小了，不满足工作需要了。在网上看了很久，也问了公司的IT同事，推荐了西部数据，有两款西部数据移动硬盘都还挺不错的，我买了两个，一个办公室用，另外一个在家玩游戏用。用了一段时间非常不错，传播速度都非常快，体积很小，方便携带，现在工作再也不担心容量不够了，玩游戏也不卡了。\r\n西部数据固态移动硬盘，金属材质，手感非常好，外形小巧，别致高级，很薄很轻，方便携带，外出时放在口袋或包包里都行。买的是容量1TB，买来之后我就把我电脑里，优盘里的数据和资料都拷贝到了硬盘里备案。传播速度超级快，速度高达540MB/s，比我同事他们买的硬盘要快很多，非常节省时间。硬盘内设有密码保护功能，因为都是公司机密文件，特意看到这功能买的，文件存进去即使不小心丢失了也非常安全放心。这个硬盘支持同时与多个设备连接，并且支持OTG功能，兼容性非常好。外壳有防摔保护，当不小心滑落，也不会轻易损坏文件。总体来说，这款西部数据固态移动硬盘非常不错，适合办公室使用。', 1);
INSERT INTO `article` VALUES (6, '教育部公示首届全国教材建设奖全国教材建设先进集体和先进个人拟推荐名单', 19, '管理员', '转载', 16, 'admin', 1618316172, '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: &amp;quot;Microsoft Yahei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, STHeiti, &amp;quot;WenQuanYi Micro Hei&amp;quot;, &amp;quot;Droid Sans Fallback&amp;quot;, SimSun, sans-serif;&quot;&gt;日前，根据《国家教材委员会关于开展首届全国教材建设奖评选工作的通知》(国教材〔2020〕4号)和《教育部办公厅关于做好全国教材建设先进集体和先进个人申报工作的通知》(教材厅函〔2020〕8号)要求，经专家评审、评委会评议并报教育部党组批准，教育部对拟推荐参加国家评审的首届全国教材建设奖全国教材建设先进集体和先进个人予以公示。公示期为2021年4月13日至4月22日。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: &amp;quot;Microsoft Yahei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, STHeiti, &amp;quot;WenQuanYi Micro Hei&amp;quot;, &amp;quot;Droid Sans Fallback&amp;quot;, SimSun, sans-serif;&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (7, '收「清仓！全新未激活...」 全新未拆封，有的小伙伴们求私发 宝贝，带价最好谢谢', 21, 'test3@qq.com', '原创', 7, 'test3@qq.com', 1618580167, '&lt;p&gt;收「清仓！全新未激活...」 全新未拆封，有的小伙伴们求私发 宝贝，带价最好谢谢&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;联系qq:123456789&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618580059285913.png&quot; title=&quot;1618580059285913.png&quot; alt=&quot;1331388076313971.png&quot;/&gt;&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (8, '【求购】-有出售电脑 桌的联系我', 21, 'jhkfd@qq.com', '原创', 7, 'jhkfd@qq.com', 1618582138, '&lt;p&gt;联系qq:6591212454&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (9, '【求购】-电脑显示器', 21, 'test@qq.com', '原创', 6, 'test@qq.com', 1618582342, '&lt;p&gt;联系qq:123456722,&lt;/p&gt;&lt;p&gt;价格好商量&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (10, '【租】西装', 21, 'test1@qq.com', '原创', 8, 'test1@qq.com', 1618582745, '&lt;p&gt;有男士西装的联系下呗：QQ:&lt;span style=&quot;color: rgb(0, 176, 80);&quot;&gt;123456789&lt;/span&gt;&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (11, '我校四位教师获得2019-2020年度上海市成人高校 优秀教师、优秀管理工作者称号', 19, '管理员', '转载', 15, 'admin', 1618582875, '&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-indent: 0.3in;&quot;&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;为建设全民学习、终身学习的学习型社会，进一步提高上海市成人高等教育的教学质量，表彰在本市成人高等教育领域做出杰出贡献的成人教育工作者，鼓励广大教师和管理人员积极开展成人教育的教学研究和教学改革，全面提升教学、管理和学习支持与服务能力，提高人才培养质量，推动上海市成人教育事业的持续发展，根据《关于开展&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: serif; font-size: 16px;&quot;&gt;2019-2020&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;年度上海市成人高校优秀教师等三项优秀评选活动的通知》（沪成协（院校）&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: serif; font-size: 16px;&quot;&gt;[2020]&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;第&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: serif; font-size: 16px;&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;号）的精神，经上海市成人教育协会评审决定，护理学院陈利群、外国语言文学学院应明荣获&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: serif; font-size: 16px;&quot;&gt;2019-2020&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;年度上海市成人高校“优秀教师”称号，护理学院葛丽萍以及继续教育学院姜为荣获&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: serif; font-size: 16px;&quot;&gt;2019-2020&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;年度上海市成人高校“优秀管理工作者”称号。四位教师爱岗敬业、关爱学生，学术品行优良，师德高尚，为成人高等教育事业的改革与发展做出了贡献。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-indent: 0.33in;&quot;&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;陈利群，护理学院副教授。自&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: 宋体, serif; font-size: 16px;&quot;&gt;2004&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;年起，她长期担任继续教育学院护理专升本、高起本学生的《社区护理学》、《健康评估》等课程的教学任务，每年理论授课、操作示教平均在&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: 宋体, serif; font-size: 16px;&quot;&gt;90&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;学时左右。在授课时，注意分清不同层次学生的教学侧重点，熟练讲解相关内容，并通过大量生动有趣的实例帮助学生加强记忆。她不仅有着严肃认真的治学态度，更加有着科研上的敏感性，关注社区热点问题，在授课过程中，会和学生分享研究结果，激发学生对社区护理科研的兴趣。每年她平均带教&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: 宋体, serif; font-size: 16px;&quot;&gt;5&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;位专升本、高起本学生撰写毕业论文，秉持“授人以渔”的原则，教会学生文献检索和整理、论文框架建立思路，综述或个案撰写等，为学生今后临床科研打下较好的基础，受到学生的广泛好评。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-indent: 0.33in;&quot;&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 6px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 1.6; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-align: center;&quot;&gt;&lt;img width=&quot;554&quot; height=&quot;415&quot; src=&quot;/ueditor/php/upload/image/20210416/1618582865111560.jpg&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-indent: 0.33in;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0in; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 21px; font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); text-indent: 0.33in;&quot;&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;应明，外国语言文学学院老师，中共党员，已任教&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: 宋体, serif; font-size: 16px;&quot;&gt;10&lt;/span&gt;&lt;span style=&quot;padding: 0px; margin: 0px; font-family: simsun; font-size: 16px;&quot;&gt;年。她先后承担了专升本《高级英语》、《英美社会与文化》与高起本《中级英语》、《英美概况》、《英语写作》等课程的讲授。每学期开课前，她都会提前做好授课计划，潜心钻研教材，本着“让每一名学生喜欢”的初衷，认真备课，查阅相关的背景知识，做好笔记。课上善于旁征博引，注重与学生互动，使课堂妙趣横生。认真回答学生提出的每一个问题，确保学生学懂弄通。课后，她购买和订阅了大量教学刊物，广泛汲取营养，及时进行思考，捕捉新的教学信息，勇于探索教育规律，大胆采用新的教学手段，不断提升自己的教学能力和业务水平。在今后的教学工作中，她将一如既往，深耕于继续教育学院这片田园里，“勤”字&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 1);
INSERT INTO `article` VALUES (12, '在线扶贫培训 助力扶贫攻坚', 19, '管理员', '转载', 7, 'admin', 1618582935, '&lt;p style=&quot;padding: 0px;margin-top: 0.08in;margin-bottom: 6px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;根据教育部&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;2020&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;年下达的定点扶贫任务通知，为深入推进脱贫攻坚和乡村振兴工作，受疫情影响，要求在线开展培训，培训永平县基层干部&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;500&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;人，乡村医生&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;300&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;人。按照学校扶贫工作会议的安排，由继续教育学院负责在线扶贫培训工作，协调相关职能部门限期完成任务。&lt;span style=&quot;padding: 0px&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0.08in;margin-bottom: 6px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;a style=&quot;padding: 0px;color: rgb(102, 102, 102);outline: none&quot;&gt;&lt;/a&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;我院协调对外合作办、党委党校办、医院管理处和永平县委一起通力合作，克服诸多困难，首次开启远程“互联网&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;+&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;培训”的扶贫教育新模式。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0.08in;margin-bottom: 6px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0px;margin-bottom: 6px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 1.6;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255);text-align: center&quot;&gt;&lt;img width=&quot;587&quot; height=&quot;355&quot; src=&quot;/ueditor/php/upload/image/20210416/1618582934180409.jpg&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0px;margin-bottom: 0in;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;&lt;strong style=&quot;padding: 0px&quot;&gt;&lt;br/&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0px;margin-bottom: 0in;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;&lt;strong style=&quot;padding: 0px&quot;&gt;1.&lt;/strong&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: simsun&quot;&gt;&lt;span style=&quot;padding: 0px&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;&lt;strong style=&quot;padding: 0px&quot;&gt;助力干部学深悟透，增强决战扶贫攻坚能力&lt;/strong&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;。根据要求，向基层干部在线培训提供&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;40&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;门课程，供学员选学，每个学员至少选学&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;10&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;门课程。为此，党委党校办协调老师在很短的时间，录制了&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;40&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;门在线视频课程。我院协调华为公司免费提供在线空间，并安排张愚老师进行在线日常管理，永平县委组织所有科级以上的干部在线参加学习。基层干部课程围绕习近平新时代中国特色社会主义思想学深、悟透，全面进行讲解；针对疫情情况，设置了系列的战“疫”课程，解读国家政治、经济、公共卫生、社会治理等方面的政策、知识和治理经验，提升在疫情下经济贫困地区干部素质能力。在线学习平台，向所有永平科级以上干部开放学习，总共有&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;712&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;名干部在一个月内完成在线培训要求的课程学习，干部学习人数超过教育部要求的&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;500&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;人。学员们对习近平新时代中国特色社会主义思想有了更深入地、系统地学习，在学深悟透上进一步增强，尤其面对疫情，脱贫攻坚在应对经济发展和社会治理方面的挑战有了理论与实践的指导。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0px;margin-bottom: 0in;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px;margin-top: 0px;margin-bottom: 0in;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 14px;line-height: 28px;font-family: u5b8bu4f53, Tahoma, Geneva, sans-serif;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255);text-indent: 0.39in&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;&lt;strong style=&quot;padding: 0px&quot;&gt;2.&lt;/strong&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: simsun&quot;&gt;&lt;span style=&quot;padding: 0px&quot;&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;&lt;strong style=&quot;padding: 0px&quot;&gt;助力乡村医疗管理，提升公共卫生治理水平&lt;/strong&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;。根据要求，向永平县所有医生提供在线远程课程。医院管理处协调相关老师，录制了&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;4&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;讲在线视频课程：传染病防控体系、传染病信息传报、传染病应急处置、上海市新冠肺炎疫情防控。针对新冠疫情突发方面，如何提高公共卫生的治理能力进行了详细讲解，并提供了上海范例。我院负责在线乡村医生学习管理，时间将持续一年。（&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;2020&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;年&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;9&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;月&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体, serif;font-size: 18px&quot;&gt;7&lt;/span&gt;&lt;span style=&quot;padding: 0px;font-family: 宋体;font-size: 18px&quot;&gt;日稿）&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 1);

-- ----------------------------
-- Table structure for articletype
-- ----------------------------
DROP TABLE IF EXISTS `articletype`;
CREATE TABLE `articletype`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `typename` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL,
  `leixing` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = gb2312 COLLATE = gb2312_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articletype
-- ----------------------------
INSERT INTO `articletype` VALUES (19, '校园快报', '校园快报');
INSERT INTO `articletype` VALUES (20, '热门活动', '热门活动');
INSERT INTO `articletype` VALUES (21, '校园帖子', '校园帖子');

-- ----------------------------
-- Table structure for assess
-- ----------------------------
DROP TABLE IF EXISTS `assess`;
CREATE TABLE `assess`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品关联id',
  `issh` int(11) NOT NULL COMMENT '信息状态 0,1',
  `istop` int(11) NOT NULL COMMENT '置顶状态0,1',
  `recommend` int(11) NOT NULL COMMENT '推荐状态 0，1',
  `pinglun` int(11) NOT NULL COMMENT '评论等级',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论内容',
  `usernameshow` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '显示用户名',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ip,可以看虚拟的，还是真实有效的',
  `inputer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '提交者',
  `OrderId` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assess
-- ----------------------------
INSERT INTO `assess` VALUES (8, '1618288102462000', 1, 0, 0, 5, '真棒', 'test@qq.com', 1618290231, '192.168.58.1', 'test@qq.com', '1618289873146');
INSERT INTO `assess` VALUES (9, '1615990209440000', 1, 0, 0, 2, '真好，太棒了，下次还来', 'test@qq.com', 1618290514, '192.168.58.1', 'test@qq.com', '1618290460982');
INSERT INTO `assess` VALUES (10, '1615990209440000', 1, 1, 0, 4, '真好，下次还来', 'test1@qq.com', 1618290826, '192.168.58.1', 'test1@qq.com', '1618290627467');
INSERT INTO `assess` VALUES (11, '1617187742507000', 1, 0, 0, 4, '真好，下次还来,祝老板生意兴隆', 'test3@qq.com', 1618406399, '192.168.58.1', 'test3@qq.com', '1618402763400');
INSERT INTO `assess` VALUES (12, '1615990209440000', 1, 0, 0, 3, 'sdfs', 'test3@qq.com', 1618406855, '192.168.58.1', 'test3@qq.com', '1618404367663');
INSERT INTO `assess` VALUES (13, '1617785443532000', 1, 0, 0, 4, '货到了，没有破损，感谢商家', 'test3@qq.com', 1618406888, '192.168.58.1', 'test3@qq.com', '1618405993886');
INSERT INTO `assess` VALUES (14, '1615990209440000', 1, 0, 0, 5, '单车很不错', 'jhkfd@qq.com', 1618441372, '192.168.58.1', 'jhkfd@qq.com', '1618443953875');
INSERT INTO `assess` VALUES (15, '1618366250480000', 1, 0, 0, 4, '硬盘棒棒哒', 'jhkfd@qq.com', 1618441397, '192.168.58.1', 'jhkfd@qq.com', '1618441000141');
INSERT INTO `assess` VALUES (16, '1618288157386000', 1, 1, 0, 4, '这风扇真棒！下次还来', 'jhkfd@qq.com', 1618445038, '192.168.58.1', 'jhkfd@qq.com', '1618444974461');
INSERT INTO `assess` VALUES (17, '1617187742507000', 1, 0, 0, 5, '便宜又好用，真好，良心商家', 'jhkfd@qq.com', 1618446462, '192.168.58.1', 'jhkfd@qq.com', '1618445915701');
INSERT INTO `assess` VALUES (18, '1617785443532000', 1, 0, 0, 5, '书质很好，下次还来', 'test4@qq.com', 1618448860, '192.168.58.1', 'test4@qq.com', '');
INSERT INTO `assess` VALUES (19, '1617785443532000', 1, 0, 0, 5, '下次还来,书的质量很好', 'test3@qq.com', 1618576407, '192.168.58.1', 'test3@qq.com', '1618123237530');
INSERT INTO `assess` VALUES (20, '1618573124340000', 1, 0, 0, 4, '货到了，很新，像没穿过一样，真棒', 'test3@qq.com', 1618580549, '192.168.58.1', 'test3@qq.com', '1618580197160');
INSERT INTO `assess` VALUES (21, '1618289549544000', 1, 0, 0, 2, '鞋子小了，差评', 'test1@qq.com', 1618582660, '192.168.58.1', 'test1@qq.com', '1618582443546');
INSERT INTO `assess` VALUES (23, '1618573124340000', 1, 0, 0, 4, '衣服起毛了，差评', 'asdhg@qq.com', 1618619387, '127.0.0.1', 'asdhg@qq.com', '1618619328514');
INSERT INTO `assess` VALUES (24, '1618288102462000', 1, 0, 0, 4, '质量很好，打印很清晰', 'asdhg@qq.com', 1618620010, '127.0.0.1', 'asdhg@qq.com', '1618619920110');
INSERT INTO `assess` VALUES (25, '1618582000364000', 1, 0, 0, 4, '货收到了，物美价林123', 'asdhg@qq.com', 1618632199, '管理员', 'asdhg@qq.com', '1618632121750');
INSERT INTO `assess` VALUES (26, '1618582000364000', 0, 0, 0, 4, '很好，第二买了', 'asdhg@qq.com', 1618632289, '127.0.0.1', 'asdhg@qq.com', '1618632231681');

-- ----------------------------
-- Table structure for favorites
-- ----------------------------
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopid` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品id',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收藏 人',
  `addtime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收藏时间',
  `picurl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `hits` int(11) NULL DEFAULT NULL,
  `state` int(11) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of favorites
-- ----------------------------
INSERT INTO `favorites` VALUES (19, '1615990209440000', '1531153813@qq.com', '1618562872', '16171846775206344000.jpg!q70.jpg', '单车', 320.00, 218, NULL);
INSERT INTO `favorites` VALUES (20, '1617187742507000', 'test3@qq.com', '1618581687', '1617187888440168654000.jpg', 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待', 4150.00, 85, NULL);
INSERT INTO `favorites` VALUES (21, '1618288157386000', 'test3@qq.com', '1618581693', '16182882021107591169000.png', '9.9成新风扇，箱说全 感兴趣的话给我留言吧！', 9.90, 89, NULL);
INSERT INTO `favorites` VALUES (22, '1617785443532000', 'test3@qq.com', '1618581697', '1617785321769765347000.jpeg', '书', 111.00, 108, NULL);
INSERT INTO `favorites` VALUES (23, '1618582000364000', 'test@qq.com', '1618582283', '1618582069567622392000.jpg', '硬盘，有用过，需要的带走', 86.00, 0, NULL);
INSERT INTO `favorites` VALUES (24, '1618573200382000', 'test@qq.com', '1618582287', '16185732432077572173000.jpg', '可爱的帽子', 12.00, 3, NULL);

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `issh` int(11) NOT NULL,
  `ishf` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usernameshow` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `inputer` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qq` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wangwang` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of feedback
-- ----------------------------
INSERT INTO `feedback` VALUES (1, 2, 0, 0, '李厚霖压力', '李厚霖压力', '123', '管理员', 1616394682, 'admin', NULL, NULL, NULL, NULL);
INSERT INTO `feedback` VALUES (2, 2, 1, 0, '我是测试留言', '我是测试回复', '我是测试者', '管理员', 1616378862, 'admin', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for feedbacktype
-- ----------------------------
DROP TABLE IF EXISTS `feedbacktype`;
CREATE TABLE `feedbacktype`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `typename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '留言分类名称',
  `typeorder` int(11) NOT NULL COMMENT '留言分类排序 ',
  `typezt` int(11) NOT NULL COMMENT '显示状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of feedbacktype
-- ----------------------------
INSERT INTO `feedbacktype` VALUES (2, '热门', 10, 1);

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `webname` varchar(30) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL COMMENT '链接地址',
  `weburl` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL COMMENT '网址',
  `styleid` int(11) NOT NULL COMMENT '链接类型 1.LOGO链接2.文本连接',
  `logourl` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL COMMENT 'logo地址',
  `addtime` int(11) NOT NULL COMMENT '加入时间',
  `intro` text CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL COMMENT '介绍 ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = gb2312 COLLATE = gb2312_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES (9, '163网站', 'www.163.com', 1, 'upload/131548903326030000.jpg', 1615103504, '网易门户');
INSERT INTO `links` VALUES (10, '大两朵略图', 'www.ssss22.com', 2, 'upload/u=4098406085,4049411217&fm=26&gp=0.jpg', 1615103392, '图图');
INSERT INTO `links` VALUES (11, '校园二手市场1', 'www.itziliao123.cn', 1, 'upload/QQ图片20210218150932.jpg', 1615103605, '随着大学生消费能力的日益增强，一些东西被购回后由于相对用处不大而闲置在寝室里成为鸡肋。但对其他同学来说，这些物品也许有相当大的使用价值。甚至，一些还有使用价值的物品被同学们随意丢弃，不仅造成了资源浪费，还加剧了环境污染。目前，各大校园都已建立自己的校园网，而部分高校也已完成“校园一卡通”工程的建设。鉴于此，我们觉得一方面用宣传板的形式不定期公布同学的旧物品信息，一方面定期的在校园开展类似于“集市”的现实交易平台，帮一些平时不能经常上网或物品没有及时出手的同学搭建平台，出售自己的物品。基于Internet技术的发展，时机成熟时在网上构建校园二手交易平台，方便在校学生集中处理对自己利用率不高的物品，让大家可以通过一个安全规范的平台交换或低价出售、购买自己的物品。目前，保护生态环境是我国面临的一项十分艰巨的任务，大学生是社会的中坚力量，树立正确的生态环境道德和环境保护意识是社会发展的必然要求，也是公民道德建设的重要内容。在环境保护的践行者之中，大学生是最有积极性和执行力的群体，有效地利用好这个群体，将有力推动环境保护的发展，倡导节约新风尚。');
INSERT INTO `links` VALUES (12, '163网站11', '11', 2, '文本链接', 1615104475, '11');
INSERT INTO `links` VALUES (14, '校园二手市场321', 'www.itziliao123.cn', 1, 'upload/60448d0d348ef.jpg', 1615105293, 'asdasda');

-- ----------------------------
-- Table structure for orderlist
-- ----------------------------
DROP TABLE IF EXISTS `orderlist`;
CREATE TABLE `orderlist`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderID` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `shopid` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paymentState` int(11) NULL DEFAULT NULL,
  `Price` decimal(10, 2) NOT NULL,
  `total` int(11) NOT NULL,
  `picurl` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `shr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderState` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orderlist
-- ----------------------------
INSERT INTO `orderlist` VALUES (7, '1617427159943', '1617187742507000', 3, 4896.00, 1, '1617187888440168654000.jpg', '1617427186', '1531153813@qq.com', '小杨同学1', 4, 'iphone');
INSERT INTO `orderlist` VALUES (9, '1617694242494', '1615941500454012', 2, 23.00, 2, '1617184507832450961000.jpg', '1617694259', '1531153813@qq.com', '小杨同学1', 3, '物理科技课本123');
INSERT INTO `orderlist` VALUES (10, '1618121343572', '1615990209440000', 3, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618121353', '1531153813@qq.com', '小杨同学1', 2, '单车');
INSERT INTO `orderlist` VALUES (11, '1618123237530', '1617785443532000', 2, 111.00, 1, '1617785321769765347000.jpeg', '1618123244', '1531153813@qq.com', '小杨同学1', 2, '书');
INSERT INTO `orderlist` VALUES (12, '1618289873146', '1618288102462000', 2, 999.00, 1, '1618288127776305316000.png', '1618289893', 'test@qq.com', 'dfs', 3, '在线打印');
INSERT INTO `orderlist` VALUES (13, '1618290460982', '1615990209440000', 2, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618290474', 'test@qq.com', 'dfs', 3, '单车');
INSERT INTO `orderlist` VALUES (14, '1618290627467', '1615990209440000', 2, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618290635', 'test1@qq.com', 'dfs12', 3, '单车');
INSERT INTO `orderlist` VALUES (15, '1618402763400', '1617187742507000', 1, 12.00, 1, '1617187888440168654000.jpg', '1618402772', 'test3@qq.com', '测试人1', 3, 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待');
INSERT INTO `orderlist` VALUES (16, '1618404367663', '1615990209440000', 4, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618404381', 'test3@qq.com', '测试人1', 3, '单车');
INSERT INTO `orderlist` VALUES (17, '1618405993886', '1617785443532000', 2, 111.00, 1, '1617785321769765347000.jpeg', '1618406000', 'test3@qq.com', '测试人1', 3, '书');
INSERT INTO `orderlist` VALUES (18, '1618441000141', '1618366250480000', 2, 1200.00, 2, '16183663421920518449000.jpg', '1618441010', 'jhkfd@qq.com', 'sadsad', 3, '测试');
INSERT INTO `orderlist` VALUES (19, '1618441182845', '1615990209440000', 4, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618441192', 'jhkfd@qq.com', 'sadsad', 3, '单车');
INSERT INTO `orderlist` VALUES (20, '1618443953875', '1615990209440000', 2, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618443966', 'jhkfd@qq.com', 'sadsad', 3, '单车');
INSERT INTO `orderlist` VALUES (21, '1618444974461', '1618288157386000', 2, 9.90, 1, '16182882021107591169000.png', '1618444984', 'jhkfd@qq.com', 'sadsad', 3, '9.9成新风扇，箱说全 感兴趣的话给我留言吧！');
INSERT INTO `orderlist` VALUES (22, '1618445915701', '1617187742507000', 2, 12.00, 1, '1617187888440168654000.jpg', '1618445920', 'jhkfd@qq.com', 'sadsad', 3, 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待');
INSERT INTO `orderlist` VALUES (23, '1618448792648', '1617785443532000', 2, 111.00, 1, '1617785321769765347000.jpeg', '1618448803', 'test4@qq.com', '测试人4', 3, '书');
INSERT INTO `orderlist` VALUES (24, '1618491175101', '1618286798424000', 1, 68.00, 1, '16182868651622831443000.png', '1618491236', '1531153813@qq.com', '小杨同学1', 2, '全新的的衣服');
INSERT INTO `orderlist` VALUES (25, '1618561797902', '1615990209440000', 2, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618562424', '1531153813@qq.com', '小杨同学1', 1, '单车');
INSERT INTO `orderlist` VALUES (26, '1618563716910', '1615990209440000', 2, 320.00, 2, '16171846775206344000.jpg!q70.jpg', '1618563738', '1531153813@qq.com', '小杨同学1', 1, '单车');
INSERT INTO `orderlist` VALUES (27, '1618580197160', '1618573124340000', 2, 23.00, 1, '16185731651728688079000.jpg', '1618580204', 'test3@qq.com', '测试人1', 3, '全新衣服');
INSERT INTO `orderlist` VALUES (28, '1618582443546', '1618289549544000', 1, 18.50, 1, '1618289605602981021000.jpg', '1618582451', 'test1@qq.com', 'dfs12', 3, '女款小白鞋');
INSERT INTO `orderlist` VALUES (30, '1618619328514', '1618573124340000', 1, 23.00, 1, '16185731651728688079000.jpg', '1618619335', 'asdhg@qq.com', '工具人', 3, '全新衣服');
INSERT INTO `orderlist` VALUES (31, '1618619920110', '1618288102462000', 1, 999.00, 1, '1618288127776305316000.png', '1618619949', 'asdhg@qq.com', '工具人1', 3, '在线打印');
INSERT INTO `orderlist` VALUES (32, '1618632121750', '1618582000364000', 1, 86.00, 1, '1618582069567622392000.jpg', '1618632128', 'asdhg@qq.com', '工具人1', 3, '硬盘，有用过，需要的带走');
INSERT INTO `orderlist` VALUES (33, '1618632231681', '1618582000364000', 2, 86.00, 1, '1618582069567622392000.jpg', '1618632237', 'asdhg@qq.com', '工具人1', 3, '硬盘，有用过，需要的带走');
INSERT INTO `orderlist` VALUES (34, '1618632370785', '1615990209440000', 2, 320.00, 1, '16171846775206344000.jpg!q70.jpg', '1618632381', 'asdhg@qq.com', '工具人1', 1, '单车');
INSERT INTO `orderlist` VALUES (35, '1618633960845', '1618582000364000', 2, 86.00, 1, '1618582069567622392000.jpg', '1618633970', 'test4@qq.com', '测试人4', 1, '硬盘，有用过，需要的带走');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numbers` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品编号（不确定是数字还是英文字母）',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `typeid` int(11) NOT NULL COMMENT '分类id',
  `youfei` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '邮费 ',
  `hot` int(11) NOT NULL COMMENT '热销',
  `drops` int(11) NOT NULL COMMENT '降价',
  `recommend` int(11) NOT NULL COMMENT '推荐',
  `kucun` int(11) NOT NULL COMMENT '库存 ',
  `hits` int(11) NOT NULL COMMENT '浏览量',
  `picurl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品图片',
  `picurls` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品介绍 ',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `inputer` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `yprice` decimal(10, 2) NOT NULL COMMENT '原价格',
  `youhui` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '优惠',
  `shelves` int(11) NULL DEFAULT NULL COMMENT '商品状态',
  `issh` int(11) NULL DEFAULT NULL COMMENT '置顶',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (3, '1615990209440000', '单车', 52, 0.00, 1, 1, 0, 13, 241, '16171846775206344000.jpg!q70.jpg', '', '&lt;p&gt;我是单车&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;联系qq:123456879&lt;/span&gt;&lt;/p&gt;', 1618573481, 'admin', 320.00, 645.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (4, '1617156380407000', 'G-force 可折叠 减震电动车', 53, 0.00, 1, 0, 1, 18, 66, '161718771658166723000.png', '', '&lt;p&gt;&lt;a href=&quot;https://fxhh.jd.com/detail.html?id=237821106&quot; target=&quot;_blank&quot; title=&quot;G-force 可折叠 减震电动车&quot; style=&quot;margin: 0px; padding: 0px; color: rgb(243, 2, 19); text-decoration-line: none; transition: color 0.25s ease 0s; font-family: &amp;quot;Microsoft YaHei&amp;quot;; font-size: 12px; white-space: normal;&quot;&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; height: 144px; line-height: 24px; font-size: 14px; color: rgb(71, 151, 160); overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical;&quot;&gt;&lt;a href=&quot;https://fxhh.jd.com/detail.html?id=237821106&quot; target=&quot;_blank&quot; title=&quot;G-force 可折叠 减震电动车&quot; style=&quot;margin: 0px; padding: 0px; color: rgb(243, 2, 19); text-decoration-line: none; transition: color 0.25s ease 0s; font-family: &amp;quot;Microsoft YaHei&amp;quot;; font-size: 12px; white-space: normal;&quot;&gt;七重减震系统，可折叠设计。配置七重减震系统，在行车过程中可以大幅度缓解车身前后颠簸硬撞，有效延长车体使用寿命，可折叠的设计，节省空间资源之余，又方便于移动。&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 1617757756, 'admin', 200.00, 1980.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (5, '1617187742507000', 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待', 6, 0.00, 1, 0, 0, 3, 97, '1617187888440168654000.jpg', '', '&lt;p&gt;&lt;span style=&quot;color: rgb(192, 80, 77);&quot;&gt;外形外观延用了苹果手&lt;/span&gt;机的一惯外形和材质，拿在手里很有质感和重量，紫色比较小女人，去实体门店看过了，紫色经常断货，没想到京东有，就果断拍下了！苹果11紫色外观时尚惊艳，超级耐看，LCD高清显示屏色彩显示均匀，A13处理器性能强，日常使用运行流畅，反应速度快，玩游戏无卡顿，后置双摄像头聚焦快拍照清晰，图像处理色彩很均匀，电池续航比较长，使用一天没问题，外观好看漂亮，外形设计精美大气上档次，而且特别简洁。屏幕清晰明亮，音效效果非常棒，不管是看电影还是听音乐都非常有感觉，拍照效果显得特别真实，夜景拍出来很漂亮，苹果产品的运行速度从来没有让人失望过。我觉得紫色的iphone 11是有史以来最漂亮的iphone，颜色清新脱俗，不艳丽，很适合女生用，屏幕虽然是LCD的，相较于三星amoled ，分辨率显得较低，颜色也没有三星手机靓丽，但好在没有频闪，看久了很是舒服啊。京东可以做12期的免息分期，可以缓解一下压力啊，最重要的是这次活动力度大，居然还赠送我3万京东豆，哈哈，京东豆当钱花，买买买，停不下来的节奏啊！京东送货隔日达，完美啊！去实体门店看过了，除了贴膜送非原装手机后壳就没了其他福利了，所以毫不&amp;lt;/span&amp;gt;&amp;lt;/p&amp;gt;&lt;/p&gt;', 1618573355, 'admin', 4150.00, 4689.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (6, '1617785443532000', '书', 54, 0.00, 1, 0, 0, 8, 120, '1617785321769765347000.jpeg', NULL, '&lt;p&gt;dfdfghf123&lt;/p&gt;', 1618283578, 'admin', 111.00, 456.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (16, '1618288102462000', '在线打印', 59, 0.00, 1, 0, 0, 997, 25, '1618288127776305316000.png', NULL, '&lt;p&gt;在线打印，我们有最优势的价格，最放心的技术，最诚挚的服务，绝对物超所值，超出想象&lt;br/&gt;价格，6分一面，（除海南，新疆，西藏外）满10元包邮，&lt;br/&gt;免费订装，因为美观好看，所以&lt;br/&gt;速度，省内的，当天4点之前的，第二天基本都到。&lt;br/&gt;感谢，各路好汉纷至沓来&lt;/p&gt;', 1618288135, 'test@qq.com', 999.00, 999.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (17, '1618288157386000', '9.9成新风扇，箱说全 感兴趣的话给我留言吧！', 49, 0.00, 1, 0, 0, 9, 98, '16182882021107591169000.png', NULL, '&lt;p&gt;9.9成新风扇，箱说全&lt;br/&gt;感兴趣的话给我留言吧！&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210413/1618288218519559.png&quot; title=&quot;1618288218519559.png&quot; alt=&quot;6.png&quot;/&gt;&lt;/p&gt;', 1618446639, 'admin', 9.90, 25.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (18, '1618289549544000', '女款小白鞋', 49, 0.00, 0, 1, 1, 9, 26, '1618289605602981021000.jpg', NULL, '&lt;p&gt;2020年女士小白鞋春秋牛筋底女鞋软底防滑耐磨懒人鞋女士圆头&amp;nbsp;2021年新款女士豆豆鞋乐福鞋潮女士休闲鞋一脚蹬女鞋休闲鞋女平底鞋小白鞋女鞋平底鞋女学生休闲鞋女士初中女生小白鞋时尚休闲鞋白搭休闲鞋美女鞋&lt;br/&gt;码子35--41码&lt;br/&gt;白色，黑色可以选择&lt;br/&gt;颜色;白色&amp;nbsp;黑色&amp;nbsp;可选&lt;br/&gt;支持自助下单，告诉码子和颜色&lt;br/&gt;付款后24小时内发货&lt;br/&gt;本交易仅支持自提、当面交易、邮寄&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210413/1618289634923878.jpg&quot; title=&quot;1618289634923878.jpg&quot; alt=&quot;31213010171603414.jpg&quot;/&gt;&lt;/p&gt;', 1618572918, 'admin', 18.50, 36.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (31, '1618573124340000', '全新衣服', 49, 0.00, 1, 0, 0, 8, 19, '16185731651728688079000.jpg', NULL, '&lt;p&gt;全新衣服，需要的带走！&lt;/p&gt;&lt;p&gt;联系qq:123456789&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618573194810938.jpg&quot; title=&quot;1618573194810938.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618573194248917.jpg&quot; title=&quot;1618573194248917.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 1618581634, 'test3@qq.com', 23.00, 58.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (32, '1618573200382000', '可爱的帽子', 49, 0.00, 1, 0, 0, 2, 10, '16185732432077572173000.jpg', NULL, '&lt;p&gt;帽子，还没用过，有需要的带走！&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;联系qq:12378946452&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618573289471070.jpg&quot; title=&quot;1618573289471070.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618573289522334.png&quot; title=&quot;1618573289522334.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;br/&gt;&lt;/p&gt;', 1618573292, 'test3@qq.com', 12.00, 26.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (33, '1618582000364000', '硬盘，有用过，需要的带走', 6, 0.00, 1, 0, 1, 2, 6, '1618582069567622392000.jpg', NULL, '&lt;p&gt;硬盘，有用过，需要的带走&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(0, 176, 240);&quot;&gt;联系qq:456789411&lt;/span&gt;&lt;/p&gt;', 1618582088, 'jhkfd@qq.com', 86.00, 120.00, 0.00, 1, 1);
INSERT INTO `product` VALUES (34, '1618582997403000', '九九成新、高品质面料西服外套、亮片袖、真丝内里，时尚潮品、高端大气', 49, 0.00, 1, 1, 1, 3, 6, '1618583090391389505000.png', NULL, '&lt;p&gt;九九成新、高品质面料西服外套、亮片袖、真丝内里，时尚潮品、高端大气&lt;/p&gt;&lt;p&gt;联系&lt;span style=&quot;color: rgb(146, 208, 80);&quot;&gt;qq:123455678&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(146, 208, 80);&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618583117966496.png&quot; title=&quot;1618583117966496.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20210416/1618583117982556.png&quot; title=&quot;1618583117982556.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(146, 208, 80);&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;br/&gt;&lt;/p&gt;', 1618583120, 'test1@qq.com', 120.00, 150.00, 0.00, 1, 1);

-- ----------------------------
-- Table structure for productlist
-- ----------------------------
DROP TABLE IF EXISTS `productlist`;
CREATE TABLE `productlist`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '父级',
  `tid` int(11) NOT NULL COMMENT '子级',
  `typename` varchar(30) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL COMMENT '分类名称',
  `sd` int(11) NOT NULL COMMENT '深度',
  `idpath` varchar(200) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = gb2312 COLLATE = gb2312_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productlist
-- ----------------------------
INSERT INTO `productlist` VALUES (6, 0, '数码产品', 1, '0');
INSERT INTO `productlist` VALUES (49, 0, '生活百货', 1, '0');
INSERT INTO `productlist` VALUES (50, 0, '书籍教材', 1, '0');
INSERT INTO `productlist` VALUES (51, 0, '交通工具', 1, '0');
INSERT INTO `productlist` VALUES (52, 51, '单车', 2, '0_51');
INSERT INTO `productlist` VALUES (53, 51, '电动车', 2, '0_51');
INSERT INTO `productlist` VALUES (54, 50, 'it书籍', 2, '0_50');
INSERT INTO `productlist` VALUES (58, 0, '技能服务', 1, '0');
INSERT INTO `productlist` VALUES (59, 58, '打印', 2, '0_58');

-- ----------------------------
-- Table structure for productorder
-- ----------------------------
DROP TABLE IF EXISTS `productorder`;
CREATE TABLE `productorder`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paymentState` int(11) NOT NULL COMMENT '支付状态1.待支付2.已支付3.待退款4.已退款',
  `orderState` int(11) NOT NULL COMMENT '订单状态：1.待处理2.已发货3.已收货4.已取消5.交易完完成',
  `kuaidi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '快递编号',
  `yunfei` decimal(10, 2) NOT NULL COMMENT '运费',
  `youhui` decimal(10, 2) NOT NULL COMMENT '优惠',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付方式:',
  `songhu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '送货方式:',
  `feedback` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '留言',
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '下单ip',
  `addtime` int(11) NOT NULL COMMENT '订单增加时间',
  `username` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `receive_id` int(11) NULL DEFAULT NULL COMMENT '关联收货地址表id',
  `shopid` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品id',
  `total` int(11) NULL DEFAULT NULL COMMENT '商品个数',
  `picurl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '封面',
  `fahuodi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发货地',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品标题',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productorder
-- ----------------------------
INSERT INTO `productorder` VALUES (2, '1617427159943', 3, 4, '1617427186550', 0.00, 0.00, 4896.00, '1', '2', '好', '192.168.58.1', 1617427186, '1531153813@qq.com', 2, '1617187742507000', 1, '1617187888440168654000.jpg', NULL, 'iphone');
INSERT INTO `productorder` VALUES (4, '1617694242494', 2, 3, '1617694259513', 0.00, 0.00, 23.00, '1', '1', '123', '192.168.58.1', 1617694259, '1531153813@qq.com', 2, '1615941500454012', 2, '1617184507832450961000.jpg', NULL, '物理科技课本123');
INSERT INTO `productorder` VALUES (5, '1618121343572', 3, 1, '1618121353400', 0.00, 0.00, 320.00, '2', '2', '', '192.168.58.1', 1618121353, '1531153813@qq.com', 2, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (6, '1618123237530', 2, 2, '1618123244913', 0.00, 0.00, 111.00, '1', '1', '', '192.168.58.1', 1618123244, '1531153813@qq.com', 2, '1617785443532000', 1, '1617785321769765347000.jpeg', NULL, '书');
INSERT INTO `productorder` VALUES (7, '1618289873146', 2, 3, '1618289893628', 0.00, 0.00, 999.00, '2', '2', '我要打印3份', '192.168.58.1', 1618289893, 'test@qq.com', 3, '1618288102462000', 1, '1618288127776305316000.png', NULL, '在线打印');
INSERT INTO `productorder` VALUES (8, '1618290460982', 2, 3, '1618290474693', 0.00, 0.00, 320.00, '3', '2', '123456', '192.168.58.1', 1618290474, 'test@qq.com', 3, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (9, '1618290627467', 2, 3, '1618290635160', 0.00, 0.00, 320.00, '1', '1', '123', '192.168.58.1', 1618290635, 'test1@qq.com', 4, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (10, '1618402763400', 1, 3, '1618402772589', 0.00, 0.00, 12.00, '1', '1', '123457/', '192.168.58.1', 1618402772, 'test3@qq.com', 5, '1617187742507000', 1, '1617187888440168654000.jpg', NULL, 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待');
INSERT INTO `productorder` VALUES (11, '1618404367663', 4, 3, '1618404381373', 0.00, 0.00, 320.00, '1', '1', 's测试订单', '192.168.58.1', 1618404381, 'test3@qq.com', 5, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (12, '1618405993886', 2, 3, '1618406000835', 0.00, 0.00, 111.00, '1', '1', '大概需要f', '192.168.58.1', 1618406000, 'test3@qq.com', 5, '1617785443532000', 1, '1617785321769765347000.jpeg', NULL, '书');
INSERT INTO `productorder` VALUES (13, '1618441000141', 2, 3, '1618441010614', 0.00, 0.00, 1200.00, '1', '1', '132456', '192.168.58.1', 1618441010, 'jhkfd@qq.com', 6, '1618366250480000', 2, '16183663421920518449000.jpg', NULL, '测试');
INSERT INTO `productorder` VALUES (14, '1618441182845', 4, 3, '1618441192699', 0.00, 0.00, 320.00, '3', '2', '', '192.168.58.1', 1618441192, 'jhkfd@qq.com', 6, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (15, '1618443953875', 2, 3, '1618443966629', 0.00, 0.00, 320.00, '3', '2', 'sdsas', '192.168.58.1', 1618443966, 'jhkfd@qq.com', 6, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (16, '1618444974461', 2, 3, '1618444984155', 0.00, 0.00, 9.90, '2', '1', 'sdgg', '192.168.58.1', 1618444984, 'jhkfd@qq.com', 6, '1618288157386000', 1, '16182882021107591169000.png', NULL, '9.9成新风扇，箱说全 感兴趣的话给我留言吧！');
INSERT INTO `productorder` VALUES (17, '1618445915701', 2, 3, '1618445920426', 0.00, 0.00, 12.00, '3', '2', '', '192.168.58.1', 1618445920, 'jhkfd@qq.com', 6, '1617187742507000', 1, '1617187888440168654000.jpg', NULL, 'Apple iPhone 11 (A2223) 128GB 黑色 移动联通电信4G手机 双卡双待');
INSERT INTO `productorder` VALUES (18, '1618448792648', 2, 3, '1618448803653', 0.00, 0.00, 111.00, '3', '2', '', '192.168.58.1', 1618448803, 'test4@qq.com', 7, '1617785443532000', 1, '1617785321769765347000.jpeg', NULL, '书');
INSERT INTO `productorder` VALUES (19, '1618491175101', 1, 2, '1618491236960', 0.00, 0.00, 68.00, '1', '1', '3224254767', '192.168.58.1', 1618491236, '1531153813@qq.com', 2, '1618286798424000', 1, '16182868651622831443000.png', NULL, '全新的的衣服');
INSERT INTO `productorder` VALUES (20, '1618561797902', 2, 1, '1618562424783', 0.00, 0.00, 320.00, '1', '1', 'sad', '192.168.58.1', 1618562424, '1531153813@qq.com', 2, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (21, '1618563716910', 2, 1, '1618563738476', 0.00, 0.00, 320.00, '1', '1', '我是留言', '192.168.58.1', 1618563738, '1531153813@qq.com', 2, '1615990209440000', 2, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (22, '1618580197160', 2, 3, '1618580204407', 0.00, 0.00, 23.00, '1', '1', '', '192.168.58.1', 1618580204, 'test3@qq.com', 5, '1618573124340000', 1, '16185731651728688079000.jpg', NULL, '全新衣服');
INSERT INTO `productorder` VALUES (23, '1618582443546', 1, 3, '1618582451570', 0.00, 0.00, 18.50, '1', '2', '', '192.168.58.1', 1618582451, 'test1@qq.com', 4, '1618289549544000', 1, '1618289605602981021000.jpg', NULL, '女款小白鞋');
INSERT INTO `productorder` VALUES (25, '1618619328514', 1, 3, '1618619335912', 0.00, 0.00, 23.00, '1', '1', '', '127.0.0.1', 1618619335, 'asdhg@qq.com', 8, '1618573124340000', 1, '16185731651728688079000.jpg', NULL, '全新衣服');
INSERT INTO `productorder` VALUES (26, '1618619920110', 1, 3, '1618619949443', 0.00, 0.00, 999.00, '1', '1', '', '127.0.0.1', 1618619949, 'asdhg@qq.com', 8, '1618288102462000', 1, '1618288127776305316000.png', NULL, '在线打印');
INSERT INTO `productorder` VALUES (27, '1618632121750', 1, 3, '1618632129595', 0.00, 0.00, 86.00, '1', '2', '', '127.0.0.1', 1618632129, 'asdhg@qq.com', 8, '1618582000364000', 1, '1618582069567622392000.jpg', NULL, '硬盘，有用过，需要的带走');
INSERT INTO `productorder` VALUES (28, '1618632231681', 2, 3, '1618632238610', 0.00, 0.00, 86.00, '3', '2', '', '127.0.0.1', 1618632238, 'asdhg@qq.com', 8, '1618582000364000', 1, '1618582069567622392000.jpg', NULL, '硬盘，有用过，需要的带走');
INSERT INTO `productorder` VALUES (29, '1618632370785', 2, 1, '1618632381612', 0.00, 0.00, 320.00, '3', '1', '', '127.0.0.1', 1618632381, 'asdhg@qq.com', 8, '1615990209440000', 1, '16171846775206344000.jpg!q70.jpg', NULL, '单车');
INSERT INTO `productorder` VALUES (30, '1618633960845', 2, 1, '1618633970474', 0.00, 0.00, 86.00, '3', '1', '', '127.0.0.1', 1618633970, 'test4@qq.com', 7, '1618582000364000', 1, '1618582069567622392000.jpg', NULL, '硬盘，有用过，需要的带走');

-- ----------------------------
-- Table structure for receive
-- ----------------------------
DROP TABLE IF EXISTS `receive`;
CREATE TABLE `receive`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shren` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人',
  `shdizhi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货地址',
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电话',
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '当前用户',
  `youbian` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮编',
  `is_mr` int(11) NULL DEFAULT NULL COMMENT '是否默认',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of receive
-- ----------------------------
INSERT INTO `receive` VALUES (1, '123', '云南省文山市 文山学院', '123456789', '123456789', '1531153813@qq.com', '663000', 0);
INSERT INTO `receive` VALUES (2, '小杨同学1', '云南省昆明市123', '', '123456789', '1531153813@qq.com', '231456', 1);
INSERT INTO `receive` VALUES (3, 'dfs', '文山学院', '121456789', '489789741', 'test@qq.com', '663000', 1);
INSERT INTO `receive` VALUES (4, 'dfs12', '文山学院456', '12345', '789456', 'test1@qq.com', '663000', 1);
INSERT INTO `receive` VALUES (5, '测试人1', '测试地址', '1245789', '1284842', 'test3@qq.com', '662130', 1);
INSERT INTO `receive` VALUES (6, 'sadsad', '在估左右大本营阿松大', '123457/9', '987945', 'jhkfd@qq.com', '1234567', 1);
INSERT INTO `receive` VALUES (7, '测试人4', '测试地址', '1245789', '1284842', 'test4@qq.com', '662130', 1);
INSERT INTO `receive` VALUES (8, '工具人1', '在估左右大本营阿松大', '123457/9', '987945', 'asdhg@qq.com', '1234567', 1);
INSERT INTO `receive` VALUES (9, '我是收货人', '文山学院456', '123457/9', '987945', 'ys@qq.com', '663000', 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tiwen` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `huida` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zt` int(11) NOT NULL COMMENT '审核，1.待审核 2.正常 3.锁定',
  `xingming` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addtime` int(11) NULL DEFAULT NULL COMMENT '时间',
  `photot` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '1531153813@qq.com', '1', '1531153813@qq.com', 'f', 'f', 2, 'fff', '1', '123456789', 1616057771, NULL);
INSERT INTO `user` VALUES (2, 'test123', '1', 'test123@qq.com', '我是测试', '我是测试', 3, 'test', '', '123456', 1617613253, NULL);
INSERT INTO `user` VALUES (4, '123456@qq.com', '1', '123456@qq.com', '', '', 2, '', '', '', 1617613117, NULL);
INSERT INTO `user` VALUES (5, 'test@qq.com', '1', 'test@qq.com', '', '', 2, '', '', '', 1618287229, NULL);
INSERT INTO `user` VALUES (6, 'test1@qq.com', '1', 'test1@qq.com', '', '', 2, '', '', '', 1618290566, NULL);
INSERT INTO `user` VALUES (7, 'test2@qq.com', '1', 'test2@qq.com', NULL, NULL, 2, NULL, NULL, NULL, 1618401531, NULL);
INSERT INTO `user` VALUES (8, '码卡吧卡123', '1', 'test3@qq.com', NULL, NULL, 2, '小杨', '0', '123456', 1618409998, NULL);
INSERT INTO `user` VALUES (9, 'test4@qq.com', '1', 'test4@qq.com', NULL, NULL, 2, NULL, NULL, NULL, 1618401573, NULL);
INSERT INTO `user` VALUES (10, 'test5@qq.com', '1', 'test5@qq.com', NULL, NULL, 2, NULL, NULL, NULL, 1618401580, NULL);
INSERT INTO `user` VALUES (11, 'test6@qq.com', '1', 'test6@qq.com', NULL, NULL, 2, NULL, NULL, NULL, 1618401589, NULL);
INSERT INTO `user` VALUES (12, '我一个蜘蛛虾', '1', 'jhkfd@qq.com', '', '', 2, '小杨测试', '0', '123456', 1618447504, NULL);
INSERT INTO `user` VALUES (13, 'asdhg@qq.com', '1', 'asdhg@qq.com', '', '', 2, '', '', '', 1618618054, NULL);
INSERT INTO `user` VALUES (14, 'ys@qq.com', '1', 'ys@qq.com', '', '', 2, '', '', '', 1618631207, NULL);

-- ----------------------------
-- Table structure for user_main
-- ----------------------------
DROP TABLE IF EXISTS `user_main`;
CREATE TABLE `user_main`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `daiZhifu` int(11) NULL DEFAULT 0,
  `yifahuo` int(11) NULL DEFAULT 0,
  `daipjia` int(11) NULL DEFAULT 0,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_main
-- ----------------------------
INSERT INTO `user_main` VALUES (4, 4, -2, 0, '1531153813@qq.com');
INSERT INTO `user_main` VALUES (5, 0, 4, 0, '');
INSERT INTO `user_main` VALUES (6, 0, 2, 0, 'test@qq.com');
INSERT INTO `user_main` VALUES (7, 2, 0, 0, 'test1@qq.com');
INSERT INTO `user_main` VALUES (8, 4, -1, 0, 'test3@qq.com');
INSERT INTO `user_main` VALUES (9, 1, 6, 0, 'jhkfd@qq.com');
INSERT INTO `user_main` VALUES (10, 4, 5, 0, 'asdhg@qq.com');

-- ----------------------------
-- Table structure for usercart
-- ----------------------------
DROP TABLE IF EXISTS `usercart`;
CREATE TABLE `usercart`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numbers` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` decimal(10, 2) NULL DEFAULT NULL COMMENT '单价',
  `picurl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `yPrice` decimal(10, 2) NOT NULL,
  `youfei` decimal(10, 2) NOT NULL,
  `youhui` decimal(10, 2) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `CartTotal` int(11) NOT NULL COMMENT '商品数量 ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usercart
-- ----------------------------
INSERT INTO `usercart` VALUES (11, '1615990209440000', '单车', 320.00, '16171846775206344000.jpg!q70.jpg', 645.00, 0.00, 0.00, '1531153813@qq.com', 2);

-- ----------------------------
-- Table structure for webconfig
-- ----------------------------
DROP TABLE IF EXISTS `webconfig`;
CREATE TABLE `webconfig`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `webUrl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `register` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `copyright` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '版权',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of webconfig
-- ----------------------------
INSERT INTO `webconfig` VALUES (1, '校园闲置物品交易市场', 'www.itziliao123.cn', 1, 1618631939, '校园闲置物品交易市场，版本所有');

SET FOREIGN_KEY_CHECKS = 1;
