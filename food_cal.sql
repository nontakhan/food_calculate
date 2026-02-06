/*
 Navicat Premium Data Transfer

 Source Server         : web
 Source Server Type    : MySQL
 Source Server Version : 100119
 Source Host           : 192.168.203.6:3306
 Source Schema         : food_cal

 Target Server Type    : MySQL
 Target Server Version : 100119
 File Encoding         : 65001

 Date: 06/02/2026 22:49:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for factor
-- ----------------------------
DROP TABLE IF EXISTS `factor`;
CREATE TABLE `factor`  (
  `factor_id` int NOT NULL AUTO_INCREMENT,
  `factor_value` double(5, 2) NOT NULL,
  `menu_type_id` int NULL DEFAULT NULL,
  `staple_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`factor_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 369 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of factor
-- ----------------------------
INSERT INTO `factor` VALUES (4, 1.60, 1, 'กุ้ง');
INSERT INTO `factor` VALUES (5, 1.09, 1, 'แตงกวา');
INSERT INTO `factor` VALUES (6, 1.08, 1, 'สับปะรด');
INSERT INTO `factor` VALUES (7, 0.99, 1, 'หอมใหญ่');
INSERT INTO `factor` VALUES (8, 1.24, 1, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (9, 1.17, 2, 'ผักกาดขาว');
INSERT INTO `factor` VALUES (10, 1.01, 2, 'แครอท');
INSERT INTO `factor` VALUES (11, 0.85, 2, 'เห็ดหูหนู');
INSERT INTO `factor` VALUES (12, 1.11, 2, 'เต้าหู้อ่อน');
INSERT INTO `factor` VALUES (13, 1.28, 2, 'ไก่บด');
INSERT INTO `factor` VALUES (14, 1.89, 2, 'กุ้ง');
INSERT INTO `factor` VALUES (15, 1.89, 3, 'กุ้ง');
INSERT INTO `factor` VALUES (16, 1.15, 1, 'ผักกาดขาว');
INSERT INTO `factor` VALUES (17, 1.40, 2, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (18, 1.08, 3, 'สับปะรด');
INSERT INTO `factor` VALUES (19, 1.08, 2, 'สับปะรด');
INSERT INTO `factor` VALUES (21, 0.96, 2, 'หอมใหญ่');
INSERT INTO `factor` VALUES (22, 0.96, 3, 'หอมใหญ่');
INSERT INTO `factor` VALUES (23, 1.01, 1, 'เห็ดหูหนู');
INSERT INTO `factor` VALUES (25, 1.04, 1, 'แครอท');
INSERT INTO `factor` VALUES (26, 1.39, 1, 'เห็ดนางฟ้า');
INSERT INTO `factor` VALUES (27, 1.38, 2, 'เห็ดนางฟ้า');
INSERT INTO `factor` VALUES (28, 1.38, 3, 'เห็ดนางฟ้า');
INSERT INTO `factor` VALUES (30, 1.24, 1, 'เต้าหู้');
INSERT INTO `factor` VALUES (31, 1.24, 3, 'เต้าหู้');
INSERT INTO `factor` VALUES (32, 1.17, 2, 'เต้าหู้');
INSERT INTO `factor` VALUES (33, 1.60, 1, 'ไก่ชิ้น');
INSERT INTO `factor` VALUES (34, 1.89, 2, 'ไก่ชิ้น');
INSERT INTO `factor` VALUES (35, 1.89, 3, 'ไก่ชิ้น');
INSERT INTO `factor` VALUES (36, 0.91, 2, 'ฟักเขียว');
INSERT INTO `factor` VALUES (37, 0.91, 3, 'ฟักเขียว');
INSERT INTO `factor` VALUES (38, 1.00, 4, 'มะม่วงดิบ');
INSERT INTO `factor` VALUES (40, 1.08, 1, 'คะน้า');
INSERT INTO `factor` VALUES (41, 0.99, 2, 'ข้าวโพดอ่อน');
INSERT INTO `factor` VALUES (43, 1.32, 2, 'บวบ');
INSERT INTO `factor` VALUES (44, 1.32, 3, 'บวบ');
INSERT INTO `factor` VALUES (45, 0.95, 1, 'ข้าวโพดอ่อน');
INSERT INTO `factor` VALUES (46, 1.32, 1, 'บวบ');
INSERT INTO `factor` VALUES (47, 1.04, 2, 'ฟักทอง');
INSERT INTO `factor` VALUES (48, 1.04, 3, 'ฟักทอง');
INSERT INTO `factor` VALUES (49, 1.04, 1, 'ฟักทอง');
INSERT INTO `factor` VALUES (50, 0.97, 3, 'ถั่วฝักยาว');
INSERT INTO `factor` VALUES (51, 0.97, 2, 'ถั่วฝักยาว');
INSERT INTO `factor` VALUES (53, 1.08, 2, 'กะหล่ำปลี');
INSERT INTO `factor` VALUES (54, 1.08, 3, 'กะหล่ำปลี');
INSERT INTO `factor` VALUES (56, 0.91, 1, 'ลูกชิ้นปลา');
INSERT INTO `factor` VALUES (57, 0.90, 2, 'ลูกชิ้นปลา');
INSERT INTO `factor` VALUES (58, 0.90, 3, 'ลูกชิ้นปลา');
INSERT INTO `factor` VALUES (61, 1.17, 2, 'ถั่วงอก');
INSERT INTO `factor` VALUES (62, 1.13, 2, 'หัวไชเท้า');
INSERT INTO `factor` VALUES (63, 1.13, 3, 'หัวไชเท้า');
INSERT INTO `factor` VALUES (68, 0.84, 2, 'บล็อกโคลี');
INSERT INTO `factor` VALUES (69, 0.84, 3, 'บล็อกโคลี');
INSERT INTO `factor` VALUES (70, 0.95, 1, 'บล็อกโคลี');
INSERT INTO `factor` VALUES (73, 0.88, 2, 'ผักบุ้ง');
INSERT INTO `factor` VALUES (74, 0.88, 3, 'ผักบุ้ง');
INSERT INTO `factor` VALUES (76, 0.85, 1, 'ผักบุ้ง');
INSERT INTO `factor` VALUES (77, 0.84, 2, 'มะเขือกลม');
INSERT INTO `factor` VALUES (78, 0.84, 3, 'มะเขือกลม');
INSERT INTO `factor` VALUES (82, 1.03, 2, 'มันฝรั่ง');
INSERT INTO `factor` VALUES (83, 1.03, 3, 'มันฝรั่ง');
INSERT INTO `factor` VALUES (84, 1.04, 2, 'มันเทศ');
INSERT INTO `factor` VALUES (85, 1.04, 3, 'มันเทศ');
INSERT INTO `factor` VALUES (92, 0.76, 2, 'วุ้นเส้น');
INSERT INTO `factor` VALUES (93, 0.76, 3, 'วุ้นเส้น');
INSERT INTO `factor` VALUES (94, 0.80, 1, 'วุ้นเส้น');
INSERT INTO `factor` VALUES (99, 1.34, 1, 'เห็ดน่องไก่');
INSERT INTO `factor` VALUES (100, 1.35, 2, 'เห็ดน่องไก่');
INSERT INTO `factor` VALUES (101, 1.35, 3, 'เห็ดน่องไก่');
INSERT INTO `factor` VALUES (102, 0.98, 2, 'ใบชะมวง');
INSERT INTO `factor` VALUES (103, 0.98, 3, 'ใบชะมวง');
INSERT INTO `factor` VALUES (104, 1.00, 4, 'ปลากรอบ');
INSERT INTO `factor` VALUES (105, 0.83, 2, 'เต้าหู้ปลา');
INSERT INTO `factor` VALUES (106, 0.83, 3, 'เต้าหู้ปลา');
INSERT INTO `factor` VALUES (108, 0.85, 1, 'เต้าหู้ปลา');
INSERT INTO `factor` VALUES (109, 1.38, 2, 'ไก่แล่');
INSERT INTO `factor` VALUES (110, 1.38, 3, 'ไก่แล่');
INSERT INTO `factor` VALUES (111, 1.50, 1, 'ไก่แล่');
INSERT INTO `factor` VALUES (112, 1.00, 1, 'ไข่');
INSERT INTO `factor` VALUES (113, 1.06, 2, 'ตำลึง');
INSERT INTO `factor` VALUES (114, 1.06, 3, 'ตำลึง');
INSERT INTO `factor` VALUES (115, 1.06, 1, 'ถั่วลันเตา');
INSERT INTO `factor` VALUES (116, 1.03, 2, 'ปลา');
INSERT INTO `factor` VALUES (117, 1.03, 3, 'ปลา');
INSERT INTO `factor` VALUES (119, 1.03, 2, 'ปลาทู');
INSERT INTO `factor` VALUES (120, 1.03, 3, 'ปลาทู');
INSERT INTO `factor` VALUES (122, 1.60, 1, 'น่องไก่');
INSERT INTO `factor` VALUES (123, 1.89, 2, 'น่องไก่');
INSERT INTO `factor` VALUES (124, 1.89, 3, 'น่องไก่');
INSERT INTO `factor` VALUES (126, 1.01, 1, 'ปลาแผ่น');
INSERT INTO `factor` VALUES (128, 1.04, 2, 'มะละกอ ');
INSERT INTO `factor` VALUES (129, 1.04, 3, 'มะละกอ ');
INSERT INTO `factor` VALUES (130, 0.84, 1, 'มะเขือกลม');
INSERT INTO `factor` VALUES (131, 1.30, 1, 'ไก่บด');
INSERT INTO `factor` VALUES (132, 1.00, 2, 'ไข่');
INSERT INTO `factor` VALUES (133, 1.03, 1, 'ปลา');
INSERT INTO `factor` VALUES (134, 1.09, 2, 'แตงกวา');
INSERT INTO `factor` VALUES (137, 1.00, 2, 'เห็ดหอม');
INSERT INTO `factor` VALUES (139, 1.15, 1, 'กวางตุ้ง');
INSERT INTO `factor` VALUES (140, 1.00, 1, 'แป้งข้าวโพด');
INSERT INTO `factor` VALUES (144, 1.00, 4, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (145, 0.92, 4, 'แครอท');
INSERT INTO `factor` VALUES (147, 1.00, 1, 'เส้นก๋วยเตี๋ยว');
INSERT INTO `factor` VALUES (148, 0.76, 4, 'วุ้นเส้น');
INSERT INTO `factor` VALUES (151, 0.90, 4, 'ลูกชิ้นปลา');
INSERT INTO `factor` VALUES (153, 0.96, 4, 'หอมใหญ่');
INSERT INTO `factor` VALUES (156, 1.00, 4, 'มะนาว');
INSERT INTO `factor` VALUES (157, 1.00, 4, 'มะขามเปียก');
INSERT INTO `factor` VALUES (158, 1.00, 5, 'ไข่');
INSERT INTO `factor` VALUES (159, 0.99, 5, 'หอมใหญ่');
INSERT INTO `factor` VALUES (160, 1.24, 5, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (163, 1.00, 5, 'มะขามเปียก');
INSERT INTO `factor` VALUES (165, 1.80, 2, 'ไก่ฉีก');
INSERT INTO `factor` VALUES (168, 1.00, 2, 'ขิงซอย');
INSERT INTO `factor` VALUES (169, 0.97, 1, 'ถั่วฝักยาว');
INSERT INTO `factor` VALUES (170, 1.28, 5, 'ไก่บด');
INSERT INTO `factor` VALUES (174, 0.98, 2, 'ดอกกะหล่ำ');
INSERT INTO `factor` VALUES (175, 0.98, 3, 'ดอกกะหล่ำ');
INSERT INTO `factor` VALUES (176, 1.06, 1, 'ดอกกะหล่ำ');
INSERT INTO `factor` VALUES (177, 1.52, 2, 'กวางตุ้ง');
INSERT INTO `factor` VALUES (178, 1.11, 3, 'เต้าหู้อ่อน');
INSERT INTO `factor` VALUES (179, 0.85, 3, 'เห็ดหูหนู');
INSERT INTO `factor` VALUES (180, 1.17, 3, 'ผักกาดขาว');
INSERT INTO `factor` VALUES (181, 1.01, 3, 'แครอท');
INSERT INTO `factor` VALUES (182, 1.00, 4, 'ไข่');
INSERT INTO `factor` VALUES (187, 1.00, 1, 'เครื่องแกง');
INSERT INTO `factor` VALUES (188, 1.00, 2, 'เครื่องแกง');
INSERT INTO `factor` VALUES (189, 1.00, 3, 'เครื่องแกง');
INSERT INTO `factor` VALUES (190, 1.00, 5, 'เครื่องแกง');
INSERT INTO `factor` VALUES (191, 1.00, 2, 'เครื่องแกงกะทิ');
INSERT INTO `factor` VALUES (192, 1.00, 3, 'เครื่องแกงกะทิ');
INSERT INTO `factor` VALUES (194, 1.00, 3, 'เครื่องแกงส้ม');
INSERT INTO `factor` VALUES (195, 1.00, 2, 'เครื่องแกงส้ม');
INSERT INTO `factor` VALUES (196, 1.00, 3, 'เครื่องแกงเขียวหวาน');
INSERT INTO `factor` VALUES (207, 0.90, 3, 'ลูกชิ้น');
INSERT INTO `factor` VALUES (212, 1.00, 3, 'กะปิ');
INSERT INTO `factor` VALUES (213, 1.00, 3, 'มะนาว');
INSERT INTO `factor` VALUES (214, 1.00, 3, 'มะขามเปียก');
INSERT INTO `factor` VALUES (216, 1.00, 4, 'พริกสด');
INSERT INTO `factor` VALUES (219, 1.00, 2, 'ตะไคร้');
INSERT INTO `factor` VALUES (220, 1.00, 2, 'ขมิ้น');
INSERT INTO `factor` VALUES (221, 1.00, 2, 'หอมแดง');
INSERT INTO `factor` VALUES (222, 1.00, 2, 'มะขามเปียก');
INSERT INTO `factor` VALUES (224, 1.89, 4, 'กุ้ง');
INSERT INTO `factor` VALUES (225, 0.80, 4, 'เห็ดหูหนูขาว');
INSERT INTO `factor` VALUES (226, 0.90, 4, 'ลูกชิ้น');
INSERT INTO `factor` VALUES (229, 1.01, 4, 'ผักกาดหอม');
INSERT INTO `factor` VALUES (233, 1.00, 5, 'หอมแดง');
INSERT INTO `factor` VALUES (234, 1.00, 5, 'พริกแห้ง');
INSERT INTO `factor` VALUES (237, 1.00, 5, 'ข้าวโพด');
INSERT INTO `factor` VALUES (239, 1.00, 5, 'แป้งทอดกรอบ');
INSERT INTO `factor` VALUES (242, 1.00, 4, 'เต้าหู้อ่อน');
INSERT INTO `factor` VALUES (243, 1.15, 1, 'กะหล่ำปลี');
INSERT INTO `factor` VALUES (247, 1.16, 1, 'ขิงซอย');
INSERT INTO `factor` VALUES (254, 1.34, 1, 'เห็ดออรินจิ');
INSERT INTO `factor` VALUES (256, 1.00, 1, 'เครื่องแกงผัดเผ็ด');
INSERT INTO `factor` VALUES (257, 1.00, 1, 'พริกชี้ฟ้าแดง');
INSERT INTO `factor` VALUES (258, 1.00, 1, 'พริกชี้ฟ้าเขียว');
INSERT INTO `factor` VALUES (259, 0.40, 1, 'โหรพา');
INSERT INTO `factor` VALUES (261, 0.74, 6, 'เส้นก๋วยเตี๋ยว');
INSERT INTO `factor` VALUES (262, 1.47, 6, 'กุ้ง');
INSERT INTO `factor` VALUES (263, 0.95, 6, 'ปลาเส้น');
INSERT INTO `factor` VALUES (264, 0.87, 6, 'เห็ดออรินจิ');
INSERT INTO `factor` VALUES (265, 0.86, 6, 'ข้าวโพดอ่อน');
INSERT INTO `factor` VALUES (266, 1.25, 6, 'แครอท');
INSERT INTO `factor` VALUES (267, 1.36, 6, 'คะน้า');
INSERT INTO `factor` VALUES (268, 1.00, 6, 'แป้งข้าวโพด');
INSERT INTO `factor` VALUES (270, 1.24, 6, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (271, 0.99, 6, 'หอมใหญ่');
INSERT INTO `factor` VALUES (272, 1.00, 6, 'แตงกวา');
INSERT INTO `factor` VALUES (277, 1.28, 3, 'ไก่บด');
INSERT INTO `factor` VALUES (281, 1.00, 2, 'มะนาว');
INSERT INTO `factor` VALUES (282, 1.00, 2, 'ข่า');
INSERT INTO `factor` VALUES (283, 1.00, 2, 'พริกสด');
INSERT INTO `factor` VALUES (285, 1.00, 1, 'ข่า');
INSERT INTO `factor` VALUES (286, 1.00, 1, 'กะปิ');
INSERT INTO `factor` VALUES (294, 0.99, 3, 'ข้าวโพดอ่อน');
INSERT INTO `factor` VALUES (299, 1.00, 3, 'พริกชี้ฟ้าแดง');
INSERT INTO `factor` VALUES (302, 1.00, 3, 'กะทิ');
INSERT INTO `factor` VALUES (305, 1.40, 3, 'มะเขือเทศ');
INSERT INTO `factor` VALUES (306, 1.00, 3, 'ข่า');
INSERT INTO `factor` VALUES (307, 1.00, 3, 'ตะไคร้');
INSERT INTO `factor` VALUES (311, 0.57, 3, 'โหรพา');
INSERT INTO `factor` VALUES (314, 1.00, 3, 'พริกชี้ฟ้าเขียว');
INSERT INTO `factor` VALUES (315, 1.00, 3, 'เครื่องแกงผัดเผ็ด');
INSERT INTO `factor` VALUES (318, 1.00, 2, 'พริกชี้ฟ้าแดง');
INSERT INTO `factor` VALUES (320, 1.22, 1, 'มะระ');
INSERT INTO `factor` VALUES (322, 1.00, 4, 'มะม่วง');
INSERT INTO `factor` VALUES (323, 1.38, 4, 'เห็ดนางฟ้า');
INSERT INTO `factor` VALUES (324, 0.85, 4, 'เห็ดหูหนู');
INSERT INTO `factor` VALUES (325, 1.35, 4, 'เห็ดน่องไก่');
INSERT INTO `factor` VALUES (326, 1.00, 1, 'ผงกระหรี่');
INSERT INTO `factor` VALUES (328, 1.21, 1, 'ถั่วงอก');
INSERT INTO `factor` VALUES (332, 1.00, 2, 'เครื่องไม้พะโล้');
INSERT INTO `factor` VALUES (336, 1.00, 1, 'กระชาย');
INSERT INTO `factor` VALUES (350, 1.00, 2, 'พริกไทยดำ');
INSERT INTO `factor` VALUES (352, 0.40, 1, 'ใบกระเพรา');
INSERT INTO `factor` VALUES (353, 1.00, 1, 'พริกสด');
INSERT INTO `factor` VALUES (357, 0.75, 2, 'เผือก');
INSERT INTO `factor` VALUES (358, 1.38, 5, 'ปลาทู');
INSERT INTO `factor` VALUES (359, 1.00, 5, 'พริกสด');
INSERT INTO `factor` VALUES (360, 1.60, 5, 'ไก่ชิ้น');
INSERT INTO `factor` VALUES (361, 1.50, 5, 'ไก่แล่');
INSERT INTO `factor` VALUES (362, 1.32, 5, 'ปลาทับทิม');
INSERT INTO `factor` VALUES (364, 1.00, 6, 'ไข่');
INSERT INTO `factor` VALUES (365, 1.50, 1, 'ใบมะกรูด');
INSERT INTO `factor` VALUES (366, 0.75, 2, 'ใบมะกรูด');
INSERT INTO `factor` VALUES (367, 0.71, 3, 'กระเทียม');
INSERT INTO `factor` VALUES (368, 0.75, 1, 'ยอดข้าวโพดอ่อน');

-- ----------------------------
-- Table structure for garnish
-- ----------------------------
DROP TABLE IF EXISTS `garnish`;
CREATE TABLE `garnish`  (
  `garnish_id` int NOT NULL AUTO_INCREMENT,
  `garnish_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `garnish_value` double(5, 2) NULL DEFAULT NULL,
  `menu_id` int NOT NULL,
  PRIMARY KEY (`garnish_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 193 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of garnish
-- ----------------------------
INSERT INTO `garnish` VALUES (6, 'ขึ้นฉ่าย', 100.00, 8);
INSERT INTO `garnish` VALUES (7, 'ขึ้นฉ่าย', 300.00, 33);
INSERT INTO `garnish` VALUES (9, 'ต้นหอม', 100.00, 11);
INSERT INTO `garnish` VALUES (11, 'กระเทียม', 100.00, 11);
INSERT INTO `garnish` VALUES (12, 'ผักชี', 100.00, 11);
INSERT INTO `garnish` VALUES (20, 'กระเทียม', 100.00, 14);
INSERT INTO `garnish` VALUES (25, 'กระเทียม', 100.00, 17);
INSERT INTO `garnish` VALUES (27, 'ขึ้นฉ่าย', 100.00, 18);
INSERT INTO `garnish` VALUES (29, 'กระเทียม', 100.00, 19);
INSERT INTO `garnish` VALUES (30, 'ขึ้นฉ่าย', 100.00, 19);
INSERT INTO `garnish` VALUES (31, 'หอมแดง', 200.00, 19);
INSERT INTO `garnish` VALUES (32, 'กระเทียม', 100.00, 20);
INSERT INTO `garnish` VALUES (39, 'กระเทียม', 100.00, 23);
INSERT INTO `garnish` VALUES (40, 'ต้นหอม', 100.00, 24);
INSERT INTO `garnish` VALUES (41, 'ผักชี', 100.00, 24);
INSERT INTO `garnish` VALUES (49, 'ผักชี', 100.00, 28);
INSERT INTO `garnish` VALUES (51, 'หอมแดง', 200.00, 28);
INSERT INTO `garnish` VALUES (52, 'ขึ้นฉ่าย', 100.00, 28);
INSERT INTO `garnish` VALUES (53, 'กระเทียม', 100.00, 29);
INSERT INTO `garnish` VALUES (59, 'ขึ้นฉ่าย', 100.00, 31);
INSERT INTO `garnish` VALUES (60, 'ต้นหอม', 100.00, 32);
INSERT INTO `garnish` VALUES (61, 'ผักชี', 100.00, 32);
INSERT INTO `garnish` VALUES (64, 'ต้นหอม', 100.00, 34);
INSERT INTO `garnish` VALUES (65, 'กระเทียม', 50.00, 35);
INSERT INTO `garnish` VALUES (66, 'ต้นหอม', 100.00, 35);
INSERT INTO `garnish` VALUES (67, 'ผักชี', 100.00, 35);
INSERT INTO `garnish` VALUES (69, 'กระเทียม', 50.00, 38);
INSERT INTO `garnish` VALUES (73, 'ผักชี', 100.00, 40);
INSERT INTO `garnish` VALUES (75, 'กระเทียม', 200.00, 42);
INSERT INTO `garnish` VALUES (76, 'ขึ้นฉ่าย', 100.00, 42);
INSERT INTO `garnish` VALUES (77, 'กระเทียม', 200.00, 43);
INSERT INTO `garnish` VALUES (78, 'ผักชี', 100.00, 43);
INSERT INTO `garnish` VALUES (82, 'ใบมะกรูด', 100.00, 12);
INSERT INTO `garnish` VALUES (84, 'ใบมะกรูด', 100.00, 18);
INSERT INTO `garnish` VALUES (86, 'ใบรา', 100.00, 22);
INSERT INTO `garnish` VALUES (87, 'ใบมะกรูด', 100.00, 24);
INSERT INTO `garnish` VALUES (94, 'พริกไทยดำ', 50.00, 36);
INSERT INTO `garnish` VALUES (95, 'กระเทียม', 100.00, 37);
INSERT INTO `garnish` VALUES (107, 'ใบมะกรูด', 100.00, 28);
INSERT INTO `garnish` VALUES (112, 'ใบมะกรูด', 100.00, 39);
INSERT INTO `garnish` VALUES (115, 'ใบมะกรูด', 100.00, 44);
INSERT INTO `garnish` VALUES (116, 'ใบมะกรูด', 100.00, 45);
INSERT INTO `garnish` VALUES (120, 'ใบมะกรูด', 100.00, 46);
INSERT INTO `garnish` VALUES (124, 'ผักชี', 100.00, 46);
INSERT INTO `garnish` VALUES (126, 'กระเทียม', 100.00, 47);
INSERT INTO `garnish` VALUES (128, 'กระเทียม', 100.00, 48);
INSERT INTO `garnish` VALUES (130, 'ต้นหอม', 100.00, 48);
INSERT INTO `garnish` VALUES (131, 'ผักชี', 100.00, 48);
INSERT INTO `garnish` VALUES (136, 'กระเทียม', 50.00, 50);
INSERT INTO `garnish` VALUES (139, 'กระเทียม', 50.00, 52);
INSERT INTO `garnish` VALUES (142, 'กระเทียม', 100.00, 53);
INSERT INTO `garnish` VALUES (147, 'ขึ้นฉ่าย', 100.00, 41);
INSERT INTO `garnish` VALUES (148, 'กระเทียม', 500.00, 54);
INSERT INTO `garnish` VALUES (149, 'หอมแดง', 200.00, 54);
INSERT INTO `garnish` VALUES (158, 'ผักชี', 100.00, 62);
INSERT INTO `garnish` VALUES (159, 'ผักชี', 100.00, 63);
INSERT INTO `garnish` VALUES (160, 'ผักชี', 100.00, 65);
INSERT INTO `garnish` VALUES (162, 'ผักชี', 100.00, 70);
INSERT INTO `garnish` VALUES (164, 'ผักชี', 100.00, 72);
INSERT INTO `garnish` VALUES (165, 'ต้มหอม', 100.00, 84);
INSERT INTO `garnish` VALUES (166, 'ผักชี', 100.00, 84);
INSERT INTO `garnish` VALUES (167, 'ต้มหอม', 100.00, 83);
INSERT INTO `garnish` VALUES (168, 'ผักชี', 100.00, 83);
INSERT INTO `garnish` VALUES (169, 'ต้มหอม', 100.00, 81);
INSERT INTO `garnish` VALUES (170, 'ผักชี', 100.00, 81);
INSERT INTO `garnish` VALUES (171, 'ต้มหอม', 100.00, 80);
INSERT INTO `garnish` VALUES (172, 'ผักชี', 100.00, 80);
INSERT INTO `garnish` VALUES (173, 'ผักชี', 100.00, 86);
INSERT INTO `garnish` VALUES (174, 'กระเทียม', 100.00, 86);
INSERT INTO `garnish` VALUES (182, 'ผักชี', 100.00, 89);
INSERT INTO `garnish` VALUES (185, 'กระเทียม', 50.00, 89);
INSERT INTO `garnish` VALUES (192, 'ใบมะกรูด', 200.00, 71);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `menu_type_id` int NOT NULL,
  PRIMARY KEY (`menu_id`, `menu_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 111 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (7, 'ผัดเปรี้ยวหวาน', 1);
INSERT INTO `menu` VALUES (8, 'แกงจืดเต้าหู้อ่อน', 2);
INSERT INTO `menu` VALUES (9, 'เต้าหู้ผัดเห็ดนางฟ้า', 1);
INSERT INTO `menu` VALUES (10, 'ผัดผักกาดขาวกุ้ง', 1);
INSERT INTO `menu` VALUES (11, 'ต้มแซ่บไก่', 2);
INSERT INTO `menu` VALUES (12, 'คั่วกลิ้งไก่', 1);
INSERT INTO `menu` VALUES (13, 'แกงส้มกุ้งมะล', 3);
INSERT INTO `menu` VALUES (15, 'แกงเลียงกุ้งสด', 2);
INSERT INTO `menu` VALUES (16, 'แกงคั่วสับปะรด', 3);
INSERT INTO `menu` VALUES (17, 'คะน้าผัดกุ้ง', 1);
INSERT INTO `menu` VALUES (18, 'ต้มข่าไก่', 2);
INSERT INTO `menu` VALUES (19, 'ยำวุ้นเส้นไก่สับ', 2);
INSERT INTO `menu` VALUES (20, 'ผัดดอกกะหล่ำกุ้ง', 1);
INSERT INTO `menu` VALUES (21, 'แกงเขียวหวานไก่', 3);
INSERT INTO `menu` VALUES (22, 'แกงป่าปลา', 3);
INSERT INTO `menu` VALUES (23, 'กุ้งผัดบล็อกโคลี', 1);
INSERT INTO `menu` VALUES (24, 'ต้มแซ่บปลาทู', 2);
INSERT INTO `menu` VALUES (25, 'ไก่ผัดพริก', 1);
INSERT INTO `menu` VALUES (27, 'ไก่ผัดขิง', 1);
INSERT INTO `menu` VALUES (28, 'ไก่ต้มขมิ้น', 2);
INSERT INTO `menu` VALUES (29, 'มะระผัดไข่', 1);
INSERT INTO `menu` VALUES (30, 'ยำมะม่วงปลากรอบ', 4);
INSERT INTO `menu` VALUES (31, 'ยำเห็ดรวม', 2);
INSERT INTO `menu` VALUES (32, 'ต้มฟักไก่', 2);
INSERT INTO `menu` VALUES (33, 'ไก่ผัดผงกะหรี่', 1);
INSERT INTO `menu` VALUES (34, 'ผัดถั่วงอกปลาแผ่น', 1);
INSERT INTO `menu` VALUES (35, 'ไข่ระเบิด', 1);
INSERT INTO `menu` VALUES (36, 'ไข่พะโล้', 2);
INSERT INTO `menu` VALUES (37, 'ผัดวุ้นเส้น', 1);
INSERT INTO `menu` VALUES (38, 'ผัดผักรวมกุ้ง', 1);
INSERT INTO `menu` VALUES (39, 'ต้มยำไก่', 2);
INSERT INTO `menu` VALUES (40, 'ไก่น้ำแดง', 3);
INSERT INTO `menu` VALUES (41, 'ปลาผัดฉ่า', 1);
INSERT INTO `menu` VALUES (42, 'ซุปไก่มันฝรั่ง', 2);
INSERT INTO `menu` VALUES (43, 'แกงจืดแตงกวายัดไส้', 2);
INSERT INTO `menu` VALUES (44, 'ผัดเผ็ดไก่', 1);
INSERT INTO `menu` VALUES (45, 'ฉู่ฉี่ปลาทู', 3);
INSERT INTO `menu` VALUES (46, 'ต้มยำกุ้ง', 2);
INSERT INTO `menu` VALUES (47, 'คะน้าผัดไก่', 1);
INSERT INTO `menu` VALUES (48, 'ซุปไก่ถั่วงอก', 2);
INSERT INTO `menu` VALUES (49, 'แกงส้มกุ้งผักรวม', 3);
INSERT INTO `menu` VALUES (50, 'กะหล่ำปลีผัดกุ้ง', 1);
INSERT INTO `menu` VALUES (51, 'ฟักทองผัดไข่', 1);
INSERT INTO `menu` VALUES (52, 'ถั่วลันเตาผัดกุ้ง', 1);
INSERT INTO `menu` VALUES (53, 'เต้าหู้ผัดพริก', 1);
INSERT INTO `menu` VALUES (54, 'ไก่ต้มใบชะมวง', 2);
INSERT INTO `menu` VALUES (55, 'เต้าหู้ผัดขิง', 1);
INSERT INTO `menu` VALUES (56, 'ผัดกระเพราไก่', 1);
INSERT INTO `menu` VALUES (57, 'ผัดเผ็ดปลา', 1);
INSERT INTO `menu` VALUES (61, 'ต้มจับฉ่ายไก่', 2);
INSERT INTO `menu` VALUES (62, 'ไก่ต้มเห็ดหอมฟักเขียว', 2);
INSERT INTO `menu` VALUES (63, 'ปลาผัดขิง', 1);
INSERT INTO `menu` VALUES (64, 'แตงกวาผัดไข่', 1);
INSERT INTO `menu` VALUES (65, 'ไข่ดาวราดซอส', 4);
INSERT INTO `menu` VALUES (66, 'กวางตุ้งผัดไข่', 1);
INSERT INTO `menu` VALUES (67, 'แกงจืดเต้าหู้อ่อนลูกชิ้นปลา', 3);
INSERT INTO `menu` VALUES (68, 'ทอดมันข้าวโพด', 5);
INSERT INTO `menu` VALUES (69, 'ราดหน้าทะเล', 1);
INSERT INTO `menu` VALUES (70, 'ต้มส้มปลาทู', 2);
INSERT INTO `menu` VALUES (71, 'ผัดเผ็ดกุ้งถั่วฝักยาว', 1);
INSERT INTO `menu` VALUES (72, 'ยำวุ้นเส้นกุ้ง', 4);
INSERT INTO `menu` VALUES (73, 'ผัดผักบุ้งไฟแดง', 1);
INSERT INTO `menu` VALUES (74, 'ไข่เจียวทรงเครื่อง', 5);
INSERT INTO `menu` VALUES (75, 'ไข่ดาว', 5);
INSERT INTO `menu` VALUES (76, 'ไข่ลูกเขย', 5);
INSERT INTO `menu` VALUES (77, 'ข้าวต้มไก่ฉีกแครอท', 2);
INSERT INTO `menu` VALUES (78, 'ข้าวต้มไก่ฉีกเห็ดหอมขิงซอย', 2);
INSERT INTO `menu` VALUES (79, 'ถั่วฝักยาวผัดไข่', 1);
INSERT INTO `menu` VALUES (80, 'ข้าวต้มกุ้งเห็ดหอมขิงซอย', 2);
INSERT INTO `menu` VALUES (81, 'ข้าวต้มไก่บดฟักทองแครอท', 2);
INSERT INTO `menu` VALUES (83, 'ข้าวต้มไก่ฉีกฟักทองแครอท', 2);
INSERT INTO `menu` VALUES (84, 'ข้าวต้มกุ้งแครอทฟักทอง', 2);
INSERT INTO `menu` VALUES (85, 'ข้าวต้มกุ้งเผือก', 2);
INSERT INTO `menu` VALUES (86, 'น่องไก่ตุ๋นพริกไทยดำ', 2);
INSERT INTO `menu` VALUES (89, 'ยำไข่ต้ม', 4);
INSERT INTO `menu` VALUES (90, 'ปลาทอดกระเทียม', 5);
INSERT INTO `menu` VALUES (91, 'ผัดผักกาดขาวไข่', 1);
INSERT INTO `menu` VALUES (92, 'กะหล่ำปลีผัดไข่', 1);
INSERT INTO `menu` VALUES (93, 'บวบผัดไข่', 1);
INSERT INTO `menu` VALUES (94, 'กุ้งผัดเห็ดออรินจิ', 1);
INSERT INTO `menu` VALUES (95, 'ไก่แล่ผัดหวาน', 1);
INSERT INTO `menu` VALUES (96, 'ข้าวผัดรวมมิตร', 6);
INSERT INTO `menu` VALUES (97, 'ไก่ต้มมันฝรั่ง', 2);
INSERT INTO `menu` VALUES (98, 'ก๋วยเตี๋ยวผัดไก่ไข่', 1);
INSERT INTO `menu` VALUES (99, 'ปลาทับทิมทอด', 5);
INSERT INTO `menu` VALUES (100, 'ไก่แล่ทอดกระเทียม', 5);
INSERT INTO `menu` VALUES (101, 'ไก่ทอดกระเทียม', 5);
INSERT INTO `menu` VALUES (102, 'ปลาราดพริก', 5);
INSERT INTO `menu` VALUES (103, 'ข้าวต้มไก่บดเห็ดหอมขิงซอย', 2);
INSERT INTO `menu` VALUES (104, 'กุ้งผัดบร็อกโคลี', 1);
INSERT INTO `menu` VALUES (105, 'แกงส้มมะละกอผักบุ้ง', 3);
INSERT INTO `menu` VALUES (106, 'เต้าหู้ไข่ราดซอส', 4);
INSERT INTO `menu` VALUES (107, 'แกงส้มปลาสับปะรด', 3);
INSERT INTO `menu` VALUES (108, 'Test', 2);
INSERT INTO `menu` VALUES (109, 'กุ้งผัดเห็ดน่องไก่แครอท', 1);
INSERT INTO `menu` VALUES (110, 'ข้าวต้มไก่ฉีก (ฟักทอง+แครอท)', 2);

-- ----------------------------
-- Table structure for menu_type
-- ----------------------------
DROP TABLE IF EXISTS `menu_type`;
CREATE TABLE `menu_type`  (
  `menu_type_id` int NOT NULL AUTO_INCREMENT,
  `menu_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`menu_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu_type
-- ----------------------------
INSERT INTO `menu_type` VALUES (1, 'ผัด');
INSERT INTO `menu_type` VALUES (2, 'ต้ม');
INSERT INTO `menu_type` VALUES (3, 'แกง');
INSERT INTO `menu_type` VALUES (4, 'ยำ');
INSERT INTO `menu_type` VALUES (5, 'ทอด');
INSERT INTO `menu_type` VALUES (6, 'อาหารจานเดียว');
INSERT INTO `menu_type` VALUES (7, 'แกงจืดตำลึงไก่ปั้นก้อน');

-- ----------------------------
-- Table structure for staple
-- ----------------------------
DROP TABLE IF EXISTS `staple`;
CREATE TABLE `staple`  (
  `staple_id` int NOT NULL AUTO_INCREMENT,
  `staple_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staple_serve` double(5, 1) NOT NULL,
  `staple_yield` double(5, 1) NOT NULL,
  `is_fish` int NULL DEFAULT NULL,
  `menu_id` int NOT NULL,
  `staple_type_id` int NOT NULL,
  PRIMARY KEY (`staple_id`, `menu_id`, `staple_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 440 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of staple
-- ----------------------------
INSERT INTO `staple` VALUES (4, 'กุ้ง', 17.0, 57.7, 0, 7, 2);
INSERT INTO `staple` VALUES (5, 'แตงกวา', 33.0, 79.3, 0, 7, 1);
INSERT INTO `staple` VALUES (6, 'สับปะรด', 21.0, 44.5, 0, 7, 1);
INSERT INTO `staple` VALUES (7, 'หอมใหญ่', 20.0, 92.1, 0, 7, 1);
INSERT INTO `staple` VALUES (8, 'มะเขือเทศ', 10.0, 97.9, 0, 7, 1);
INSERT INTO `staple` VALUES (9, 'ผักกาดขาว', 37.0, 88.9, 0, 8, 1);
INSERT INTO `staple` VALUES (10, 'แครอท', 7.4, 77.0, 0, 8, 1);
INSERT INTO `staple` VALUES (11, 'เห็ดหูหนู', 3.0, 89.6, 0, 8, 1);
INSERT INTO `staple` VALUES (12, 'เต้าหู้อ่อน', 22.0, 100.0, 0, 8, 1);
INSERT INTO `staple` VALUES (13, 'ไก่บด', 22.0, 100.0, 0, 8, 2);
INSERT INTO `staple` VALUES (14, 'เต้าหู้', 40.0, 100.0, 0, 9, 1);
INSERT INTO `staple` VALUES (15, 'เห็ดนางฟ้า', 22.0, 91.7, 0, 9, 1);
INSERT INTO `staple` VALUES (16, 'กุ้ง', 18.0, 57.7, 0, 9, 2);
INSERT INTO `staple` VALUES (17, 'ถั่วฝักยาว', 16.0, 95.9, 0, 9, 1);
INSERT INTO `staple` VALUES (18, 'ผักกาดขาว', 83.0, 88.9, 0, 10, 1);
INSERT INTO `staple` VALUES (20, 'แครอท', 4.5, 77.0, 0, 10, 1);
INSERT INTO `staple` VALUES (21, 'เห็ดหูหนู', 5.0, 89.6, 0, 10, 1);
INSERT INTO `staple` VALUES (22, 'กุ้ง', 18.0, 57.7, 0, 10, 2);
INSERT INTO `staple` VALUES (23, 'ไก่ชิ้น', 54.0, 100.0, 0, 11, 2);
INSERT INTO `staple` VALUES (24, 'มะเขือเทศ', 10.0, 97.9, 0, 11, 1);
INSERT INTO `staple` VALUES (25, 'หอมใหญ่', 12.0, 92.1, 0, 11, 1);
INSERT INTO `staple` VALUES (27, 'เห็ดนางฟ้า', 17.0, 91.7, 0, 11, 1);
INSERT INTO `staple` VALUES (28, 'ไก่บด', 78.0, 100.0, 0, 12, 2);
INSERT INTO `staple` VALUES (29, 'กุ้ง', 21.0, 57.7, 0, 13, 2);
INSERT INTO `staple` VALUES (30, 'มะละกอ ', 29.0, 69.5, 0, 13, 1);
INSERT INTO `staple` VALUES (31, 'ผักบุ้ง', 41.0, 100.0, 0, 13, 1);
INSERT INTO `staple` VALUES (38, 'ฟักทอง', 12.0, 83.0, 0, 15, 1);
INSERT INTO `staple` VALUES (44, 'บวบ', 19.0, 65.7, 0, 15, 1);
INSERT INTO `staple` VALUES (45, 'ไก่ชิ้น', 54.8, 100.0, 0, 16, 2);
INSERT INTO `staple` VALUES (46, 'สับปะรด', 42.0, 44.5, 0, 16, 1);
INSERT INTO `staple` VALUES (47, 'กุ้ง', 18.0, 57.7, 0, 17, 2);
INSERT INTO `staple` VALUES (48, 'คะน้า', 55.4, 80.8, 0, 17, 1);
INSERT INTO `staple` VALUES (49, 'แครอท', 2.4, 77.0, 0, 17, 1);
INSERT INTO `staple` VALUES (51, 'ไก่ชิ้น', 45.0, 100.0, 0, 18, 2);
INSERT INTO `staple` VALUES (52, 'หอมใหญ่', 3.0, 92.1, 0, 18, 1);
INSERT INTO `staple` VALUES (53, 'มะเขือเทศ', 18.0, 97.9, 0, 18, 1);
INSERT INTO `staple` VALUES (54, 'ฟักเขียว', 35.0, 65.8, 0, 18, 1);
INSERT INTO `staple` VALUES (55, 'ลูกชิ้นปลา', 26.0, 100.0, 0, 19, 2);
INSERT INTO `staple` VALUES (56, 'มะเขือเทศ', 12.0, 97.9, 0, 19, 1);
INSERT INTO `staple` VALUES (58, 'หอมใหญ่', 9.0, 92.1, 0, 19, 1);
INSERT INTO `staple` VALUES (59, 'วุ้นเส้น', 30.0, 100.0, 0, 19, 1);
INSERT INTO `staple` VALUES (60, 'ไก่บด', 23.0, 100.0, 0, 19, 2);
INSERT INTO `staple` VALUES (61, 'กุ้ง', 22.0, 57.7, 0, 20, 2);
INSERT INTO `staple` VALUES (62, 'ดอกกะหล่ำ', 59.0, 53.0, 0, 20, 1);
INSERT INTO `staple` VALUES (63, 'แครอท', 11.0, 77.0, 0, 20, 1);
INSERT INTO `staple` VALUES (64, 'ไก่ชิ้น', 45.5, 100.0, 0, 21, 2);
INSERT INTO `staple` VALUES (65, 'ฟักเขียว', 20.0, 65.8, 0, 21, 1);
INSERT INTO `staple` VALUES (66, 'มะเขือกลม', 30.0, 89.4, 0, 22, 1);
INSERT INTO `staple` VALUES (67, 'ปลา', 72.0, 71.4, 1, 22, 2);
INSERT INTO `staple` VALUES (68, 'ถั่วฝักยาว', 11.4, 95.9, 0, 22, 1);
INSERT INTO `staple` VALUES (69, 'บล็อกโคลี', 64.0, 83.3, 0, 23, 1);
INSERT INTO `staple` VALUES (70, 'กุ้ง', 22.0, 57.7, 0, 23, 2);
INSERT INTO `staple` VALUES (71, 'เห็ดน่องไก่', 20.0, 90.2, 0, 23, 1);
INSERT INTO `staple` VALUES (72, 'แครอท', 16.0, 77.0, 0, 23, 1);
INSERT INTO `staple` VALUES (73, 'ปลาทู', 40.0, 71.4, 1, 24, 2);
INSERT INTO `staple` VALUES (74, 'มะเขือเทศ', 15.0, 97.9, 0, 24, 1);
INSERT INTO `staple` VALUES (75, 'หอมใหญ่', 10.0, 92.1, 0, 24, 1);
INSERT INTO `staple` VALUES (76, 'ไก่ชิ้น', 55.0, 100.0, 0, 25, 2);
INSERT INTO `staple` VALUES (77, 'หอมใหญ่', 24.6, 92.1, 0, 25, 1);
INSERT INTO `staple` VALUES (78, 'ถั่วฝักยาว', 16.4, 95.9, 0, 25, 1);
INSERT INTO `staple` VALUES (79, 'ไก่แล่', 30.4, 100.0, 0, 27, 2);
INSERT INTO `staple` VALUES (80, 'ขิงซอย', 41.0, 100.0, 0, 27, 1);
INSERT INTO `staple` VALUES (81, 'เห็ดหูหนู', 15.3, 89.6, 0, 27, 1);
INSERT INTO `staple` VALUES (82, 'หอมใหญ่', 7.9, 92.1, 0, 27, 1);
INSERT INTO `staple` VALUES (83, 'ไก่ชิ้น', 55.0, 100.0, 0, 28, 2);
INSERT INTO `staple` VALUES (84, 'ฟักเขียว', 45.0, 65.8, 0, 28, 1);
INSERT INTO `staple` VALUES (85, 'แครอท', 7.0, 77.0, 0, 28, 1);
INSERT INTO `staple` VALUES (86, 'มะระ', 49.0, 83.3, 0, 29, 1);
INSERT INTO `staple` VALUES (87, 'ไข่', 29.0, 100.0, 0, 29, 2);
INSERT INTO `staple` VALUES (89, 'มะม่วงดิบ', 32.0, 66.4, 0, 30, 1);
INSERT INTO `staple` VALUES (90, 'เห็ดนางฟ้า', 11.5, 91.7, 0, 31, 1);
INSERT INTO `staple` VALUES (91, 'เห็ดหูหนู', 11.6, 89.6, 0, 31, 1);
INSERT INTO `staple` VALUES (92, 'เห็ดน่องไก่', 15.4, 90.2, 0, 31, 1);
INSERT INTO `staple` VALUES (93, 'ลูกชิ้นปลา', 44.4, 100.0, 0, 31, 1);
INSERT INTO `staple` VALUES (94, 'มะเขือเทศ', 16.4, 97.9, 0, 31, 1);
INSERT INTO `staple` VALUES (95, 'หอมใหญ่', 13.0, 92.1, 0, 31, 1);
INSERT INTO `staple` VALUES (96, 'แครอท', 7.0, 77.0, 0, 32, 1);
INSERT INTO `staple` VALUES (97, 'หัวไชเท้า', 11.0, 86.5, 0, 32, 1);
INSERT INTO `staple` VALUES (98, 'ฟักเขียว', 49.0, 65.8, 0, 32, 1);
INSERT INTO `staple` VALUES (99, 'ไก่ชิ้น', 68.0, 100.0, 0, 32, 2);
INSERT INTO `staple` VALUES (100, 'หอมใหญ่', 12.6, 92.1, 0, 33, 1);
INSERT INTO `staple` VALUES (101, 'ไก่แล่', 45.6, 100.0, 0, 33, 2);
INSERT INTO `staple` VALUES (103, 'ปลาแผ่น', 30.0, 100.0, 0, 34, 2);
INSERT INTO `staple` VALUES (104, 'แครอท', 8.0, 77.0, 0, 34, 1);
INSERT INTO `staple` VALUES (105, 'ถั่วงอก', 47.0, 100.0, 0, 34, 1);
INSERT INTO `staple` VALUES (106, 'เห็ดหูหนู', 20.0, 89.6, 0, 34, 1);
INSERT INTO `staple` VALUES (107, 'หอมใหญ่', 22.0, 92.1, 0, 35, 1);
INSERT INTO `staple` VALUES (108, 'มะเขือเทศ', 28.0, 97.9, 0, 35, 1);
INSERT INTO `staple` VALUES (109, 'ไข่', 51.0, 100.0, 0, 35, 2);
INSERT INTO `staple` VALUES (110, 'ไข่', 31.9, 100.0, 0, 36, 2);
INSERT INTO `staple` VALUES (111, 'เต้าหู้', 24.0, 100.0, 0, 36, 1);
INSERT INTO `staple` VALUES (112, 'วุ้นเส้น', 34.4, 100.0, 0, 37, 1);
INSERT INTO `staple` VALUES (113, 'กะหล่ำปลี', 28.3, 87.9, 0, 37, 1);
INSERT INTO `staple` VALUES (114, 'แครอท', 6.4, 77.0, 0, 37, 1);
INSERT INTO `staple` VALUES (115, 'เห็ดหูหนู', 6.0, 89.6, 0, 37, 1);
INSERT INTO `staple` VALUES (116, 'ไข่', 17.0, 100.0, 0, 37, 2);
INSERT INTO `staple` VALUES (117, 'กุ้ง', 18.0, 57.7, 0, 37, 2);
INSERT INTO `staple` VALUES (118, 'มะเขือเทศ', 3.0, 97.9, 0, 37, 1);
INSERT INTO `staple` VALUES (120, 'กุ้ง', 18.0, 57.7, 0, 38, 2);
INSERT INTO `staple` VALUES (121, 'บล็อกโคลี', 31.0, 83.3, 0, 38, 1);
INSERT INTO `staple` VALUES (122, 'ดอกกะหล่ำ', 25.4, 53.0, 0, 38, 1);
INSERT INTO `staple` VALUES (123, 'แครอท', 8.0, 77.0, 0, 38, 1);
INSERT INTO `staple` VALUES (124, 'ข้าวโพดอ่อน', 9.0, 52.9, 0, 38, 1);
INSERT INTO `staple` VALUES (125, 'เห็ดน่องไก่', 11.0, 90.2, 0, 38, 1);
INSERT INTO `staple` VALUES (126, 'ไก่ชิ้น', 56.0, 100.0, 0, 39, 2);
INSERT INTO `staple` VALUES (127, 'เห็ดนางฟ้า', 37.0, 91.7, 0, 39, 1);
INSERT INTO `staple` VALUES (128, 'หอมใหญ่', 9.9, 92.1, 0, 39, 1);
INSERT INTO `staple` VALUES (129, 'มะเขือเทศ', 25.0, 97.9, 0, 39, 1);
INSERT INTO `staple` VALUES (130, 'น่องไก่', 75.0, 100.0, 0, 40, 2);
INSERT INTO `staple` VALUES (131, 'ปลา', 60.0, 71.4, 1, 41, 2);
INSERT INTO `staple` VALUES (132, 'น่องไก่', 71.0, 100.0, 0, 42, 2);
INSERT INTO `staple` VALUES (133, 'มันฝรั่ง', 26.0, 85.0, 0, 42, 1);
INSERT INTO `staple` VALUES (134, 'แครอท', 4.6, 77.0, 0, 42, 1);
INSERT INTO `staple` VALUES (135, 'ไก่บด', 30.0, 100.0, 0, 43, 2);
INSERT INTO `staple` VALUES (136, 'แตงกวา', 43.0, 79.3, 0, 43, 1);
INSERT INTO `staple` VALUES (137, 'แครอท', 16.0, 77.0, 0, 43, 1);
INSERT INTO `staple` VALUES (138, 'ไก่ชิ้น', 45.5, 100.0, 0, 44, 2);
INSERT INTO `staple` VALUES (139, 'ถั่วฝักยาว', 17.4, 95.9, 0, 44, 1);
INSERT INTO `staple` VALUES (140, 'ปลาทู', 69.0, 71.4, 1, 45, 2);
INSERT INTO `staple` VALUES (141, 'กุ้ง', 19.0, 57.7, 0, 46, 2);
INSERT INTO `staple` VALUES (142, 'เห็ดนางฟ้า', 17.9, 91.7, 0, 46, 1);
INSERT INTO `staple` VALUES (143, 'มะเขือเทศ', 15.0, 97.9, 0, 46, 1);
INSERT INTO `staple` VALUES (144, 'หอมใหญ่', 43.0, 92.1, 0, 46, 1);
INSERT INTO `staple` VALUES (145, 'คะน้า', 59.0, 80.8, 0, 47, 1);
INSERT INTO `staple` VALUES (146, 'ไก่แล่', 28.3, 100.0, 0, 47, 2);
INSERT INTO `staple` VALUES (147, 'ไก่ชิ้น', 40.0, 100.0, 0, 48, 2);
INSERT INTO `staple` VALUES (148, 'ถั่วงอก', 20.0, 100.0, 0, 48, 1);
INSERT INTO `staple` VALUES (149, 'หอมใหญ่', 16.0, 92.1, 0, 48, 1);
INSERT INTO `staple` VALUES (150, 'มะเขือเทศ', 15.0, 97.9, 0, 48, 1);
INSERT INTO `staple` VALUES (151, 'กุ้ง', 19.0, 57.7, 0, 49, 2);
INSERT INTO `staple` VALUES (152, 'ดอกกะหล่ำ', 8.0, 53.0, 0, 49, 1);
INSERT INTO `staple` VALUES (153, 'มันเทศ', 16.0, 84.7, 0, 49, 1);
INSERT INTO `staple` VALUES (154, 'มะเขือกลม', 9.0, 89.4, 0, 49, 1);
INSERT INTO `staple` VALUES (155, 'สับปะรด', 13.0, 44.5, 0, 49, 1);
INSERT INTO `staple` VALUES (156, 'กะหล่ำปลี', 9.5, 87.9, 0, 49, 1);
INSERT INTO `staple` VALUES (157, 'ผักบุ้ง', 25.0, 100.0, 0, 49, 1);
INSERT INTO `staple` VALUES (158, 'กุ้ง', 18.0, 57.7, 0, 50, 2);
INSERT INTO `staple` VALUES (159, 'กะหล่ำปลี', 53.0, 87.9, 0, 50, 1);
INSERT INTO `staple` VALUES (160, 'แครอท', 6.6, 77.0, 0, 50, 1);
INSERT INTO `staple` VALUES (161, 'เห็ดหูหนู', 12.0, 89.6, 0, 50, 1);
INSERT INTO `staple` VALUES (162, 'ฟักทอง', 63.4, 83.0, 0, 51, 1);
INSERT INTO `staple` VALUES (163, 'ไข่', 35.6, 100.0, 0, 51, 2);
INSERT INTO `staple` VALUES (164, 'ถั่วลันเตา', 60.0, 97.0, 0, 52, 1);
INSERT INTO `staple` VALUES (165, 'กุ้ง', 22.0, 57.7, 0, 52, 2);
INSERT INTO `staple` VALUES (166, 'เต้าหู้ปลา', 51.0, 100.0, 0, 53, 1);
INSERT INTO `staple` VALUES (167, 'หอมใหญ่', 26.0, 92.1, 0, 53, 1);
INSERT INTO `staple` VALUES (168, 'ไก่ชิ้น', 61.0, 96.6, 0, 62, 2);
INSERT INTO `staple` VALUES (169, 'ใบชะมวง', 20.0, 96.6, 0, 54, 1);
INSERT INTO `staple` VALUES (170, 'เต้าหู้ปลา', 39.0, 100.0, 0, 55, 1);
INSERT INTO `staple` VALUES (171, 'เห็ดหูหนู', 13.0, 89.6, 0, 55, 1);
INSERT INTO `staple` VALUES (172, 'หอมใหญ่', 21.0, 92.1, 0, 55, 1);
INSERT INTO `staple` VALUES (173, 'ขิงซอย', 40.0, 100.0, 0, 55, 1);
INSERT INTO `staple` VALUES (174, 'ไก่บด', 60.0, 100.0, 0, 56, 2);
INSERT INTO `staple` VALUES (175, 'ปลา', 48.6, 71.4, 1, 57, 2);
INSERT INTO `staple` VALUES (176, 'ถั่วฝักยาว', 5.0, 95.9, 0, 57, 1);
INSERT INTO `staple` VALUES (177, 'กุ้ง', 18.0, 57.7, 0, 15, 2);
INSERT INTO `staple` VALUES (180, 'มะเขือกลม', 22.0, 89.4, 0, 21, 1);
INSERT INTO `staple` VALUES (181, 'มะเขือกลม', 29.0, 89.4, 0, 44, 1);
INSERT INTO `staple` VALUES (182, 'ปลากรอบ', 21.0, 100.0, 0, 30, 2);
INSERT INTO `staple` VALUES (184, 'ไก่ชิ้น', 45.5, 100.0, 0, 61, 2);
INSERT INTO `staple` VALUES (185, 'กวางตุ้ง', 40.0, 89.1, 0, 61, 1);
INSERT INTO `staple` VALUES (186, 'หัวไชเท้า', 17.0, 86.2, 0, 61, 1);
INSERT INTO `staple` VALUES (187, 'แครอท', 20.0, 77.0, 0, 61, 1);
INSERT INTO `staple` VALUES (189, 'ฟักเขียว', 55.0, 65.8, 0, 62, 1);
INSERT INTO `staple` VALUES (190, 'แครอท', 19.0, 77.0, 0, 62, 1);
INSERT INTO `staple` VALUES (191, 'เห็ดหอม', 16.0, 85.7, 0, 62, 1);
INSERT INTO `staple` VALUES (192, 'ปลา', 38.0, 71.4, 1, 63, 2);
INSERT INTO `staple` VALUES (193, 'หอมใหญ่', 23.0, 92.1, 0, 63, 1);
INSERT INTO `staple` VALUES (194, 'เห็ดหูหนู', 16.0, 89.6, 0, 63, 1);
INSERT INTO `staple` VALUES (195, 'ขิงซอย', 10.0, 100.0, 0, 63, 1);
INSERT INTO `staple` VALUES (196, 'แตงกวา', 55.0, 79.3, 0, 64, 1);
INSERT INTO `staple` VALUES (197, 'ไข่', 31.9, 100.0, 0, 64, 2);
INSERT INTO `staple` VALUES (198, 'ไข่', 31.9, 100.0, 0, 65, 2);
INSERT INTO `staple` VALUES (201, 'หอมใหญ่', 15.0, 92.1, 0, 65, 1);
INSERT INTO `staple` VALUES (202, 'กวางตุ้ง', 81.0, 89.1, 0, 66, 1);
INSERT INTO `staple` VALUES (203, 'ไข่', 31.9, 100.0, 0, 66, 2);
INSERT INTO `staple` VALUES (204, 'ผักกาดขาว', 69.0, 88.9, 0, 67, 1);
INSERT INTO `staple` VALUES (205, 'ลูกชิ้นปลา', 31.0, 100.0, 0, 67, 2);
INSERT INTO `staple` VALUES (206, 'เต้าหู้อ่อน', 60.0, 100.0, 0, 67, 1);
INSERT INTO `staple` VALUES (207, 'แครอท', 11.0, 77.0, 0, 67, 1);
INSERT INTO `staple` VALUES (208, 'เห็ดหูหนู', 19.0, 89.6, 0, 67, 1);
INSERT INTO `staple` VALUES (209, 'ไก่บด', 57.0, 100.0, 0, 68, 2);
INSERT INTO `staple` VALUES (211, 'กุ้ง', 19.0, 57.7, 0, 69, 2);
INSERT INTO `staple` VALUES (212, 'ปลาแผ่น', 22.0, 100.0, 0, 69, 2);
INSERT INTO `staple` VALUES (213, 'เห็ดออรินจิ', 16.0, 91.7, 0, 69, 1);
INSERT INTO `staple` VALUES (214, 'ยอดข้าวโพดอ่อน', 6.0, 52.5, 0, 69, 1);
INSERT INTO `staple` VALUES (215, 'แครอท', 8.0, 77.0, 0, 69, 1);
INSERT INTO `staple` VALUES (216, 'คะน้า', 22.0, 80.8, 0, 69, 1);
INSERT INTO `staple` VALUES (217, 'แป้งข้าวโพด', 6.0, 100.0, 0, 69, 1);
INSERT INTO `staple` VALUES (218, 'แครอท', 12.0, 77.0, 0, 65, 1);
INSERT INTO `staple` VALUES (220, 'มะเขือเทศ', 12.0, 97.9, 0, 65, 1);
INSERT INTO `staple` VALUES (221, 'ปลา', 76.0, 71.4, 1, 70, 2);
INSERT INTO `staple` VALUES (226, 'ถั่วฝักยาว', 35.0, 95.9, 0, 71, 1);
INSERT INTO `staple` VALUES (227, 'พริกชี้ฟ้าแดง', 8.0, 87.7, 0, 71, 1);
INSERT INTO `staple` VALUES (230, 'เครื่องแกงผัดเผ็ด', 9.0, 100.0, 0, 71, 2);
INSERT INTO `staple` VALUES (232, 'วุ้นเส้น', 29.0, 100.0, 0, 72, 1);
INSERT INTO `staple` VALUES (233, 'กุ้ง', 17.0, 57.7, 0, 72, 2);
INSERT INTO `staple` VALUES (234, 'เห็ดหูหนูขาว', 36.0, 100.0, 0, 72, 1);
INSERT INTO `staple` VALUES (235, 'ลูกชิ้นปลา', 14.0, 100.0, 0, 72, 2);
INSERT INTO `staple` VALUES (236, 'มะเขือเทศ', 18.0, 97.9, 0, 72, 1);
INSERT INTO `staple` VALUES (237, 'หอมใหญ่', 17.0, 92.1, 0, 72, 1);
INSERT INTO `staple` VALUES (238, 'ผักกาดหอม', 7.0, 100.0, 0, 72, 1);
INSERT INTO `staple` VALUES (242, 'ไข่', 38.3, 100.0, 0, 74, 2);
INSERT INTO `staple` VALUES (243, 'หอมใหญ่', 4.0, 92.1, 0, 74, 1);
INSERT INTO `staple` VALUES (244, 'มะเขือเทศ', 3.5, 97.9, 0, 74, 1);
INSERT INTO `staple` VALUES (245, 'ไข่', 31.9, 100.0, 0, 75, 2);
INSERT INTO `staple` VALUES (246, 'ไข่', 31.9, 100.0, 0, 76, 2);
INSERT INTO `staple` VALUES (249, 'ไก่ฉีก', 15.0, 100.0, 0, 77, 2);
INSERT INTO `staple` VALUES (250, 'แครอท', 9.0, 77.0, 0, 77, 1);
INSERT INTO `staple` VALUES (251, 'ไก่ฉีก', 15.0, 100.0, 0, 78, 2);
INSERT INTO `staple` VALUES (252, 'ขิงซอย', 4.0, 100.0, 0, 78, 1);
INSERT INTO `staple` VALUES (253, 'ถั่วฝักยาว', 35.0, 95.9, 0, 79, 1);
INSERT INTO `staple` VALUES (254, 'ไข่', 31.9, 100.0, 0, 79, 2);
INSERT INTO `staple` VALUES (255, 'กุ้ง', 15.0, 57.7, 0, 80, 2);
INSERT INTO `staple` VALUES (256, 'ไก่บด', 30.0, 100.0, 0, 81, 2);
INSERT INTO `staple` VALUES (257, 'ฟักทอง', 8.0, 83.0, 0, 81, 1);
INSERT INTO `staple` VALUES (258, 'แครอท', 9.0, 77.0, 0, 81, 1);
INSERT INTO `staple` VALUES (259, 'เส้นก๋วยเตี๋ยว', 130.0, 100.0, 0, 82, 1);
INSERT INTO `staple` VALUES (262, 'ไก่ฉีก', 15.0, 100.0, 0, 83, 2);
INSERT INTO `staple` VALUES (263, 'ฟักทอง', 8.0, 83.0, 0, 83, 1);
INSERT INTO `staple` VALUES (264, 'แครอท', 9.0, 77.0, 0, 83, 1);
INSERT INTO `staple` VALUES (265, 'กุ้ง', 15.0, 57.7, 0, 84, 2);
INSERT INTO `staple` VALUES (266, 'ฟักทอง', 8.0, 83.0, 0, 84, 1);
INSERT INTO `staple` VALUES (267, 'แครอท', 9.0, 77.0, 0, 84, 1);
INSERT INTO `staple` VALUES (268, 'กุ้ง', 15.0, 57.7, 0, 85, 2);
INSERT INTO `staple` VALUES (269, 'น่องไก่', 75.0, 100.0, 0, 86, 2);
INSERT INTO `staple` VALUES (274, 'ไข่', 31.9, 100.0, 0, 89, 2);
INSERT INTO `staple` VALUES (275, 'ปลา', 60.0, 100.0, 1, 90, 2);
INSERT INTO `staple` VALUES (276, 'ไข่', 31.9, 100.0, 0, 73, 2);
INSERT INTO `staple` VALUES (277, 'พริกชี้ฟ้าเขียว', 8.0, 89.9, 0, 71, 1);
INSERT INTO `staple` VALUES (278, 'ไข่', 31.9, 100.0, 0, 91, 2);
INSERT INTO `staple` VALUES (279, 'ผักกาดขาว', 67.0, 88.9, 0, 91, 1);
INSERT INTO `staple` VALUES (280, 'ไข่', 31.9, 100.0, 0, 92, 2);
INSERT INTO `staple` VALUES (281, 'กะหล่ำปลี', 42.0, 87.9, 0, 92, 1);
INSERT INTO `staple` VALUES (282, 'ไข่', 31.9, 100.0, 0, 93, 2);
INSERT INTO `staple` VALUES (283, 'บวบ', 57.0, 65.7, 0, 93, 1);
INSERT INTO `staple` VALUES (284, 'กุ้ง', 19.0, 57.7, 0, 94, 2);
INSERT INTO `staple` VALUES (285, 'เห็ดออรินจิ', 50.0, 90.2, 0, 94, 1);
INSERT INTO `staple` VALUES (287, 'ไก่แล่', 48.0, 100.0, 0, 95, 2);
INSERT INTO `staple` VALUES (288, 'หอมใหญ่', 32.0, 92.1, 0, 95, 1);
INSERT INTO `staple` VALUES (289, 'กุ้ง', 20.0, 57.7, 0, 96, 2);
INSERT INTO `staple` VALUES (290, 'คะน้า', 19.0, 80.8, 0, 96, 1);
INSERT INTO `staple` VALUES (291, 'มะเขือเทศ', 9.0, 97.9, 0, 96, 1);
INSERT INTO `staple` VALUES (292, 'หอมใหญ่', 3.0, 92.1, 0, 96, 1);
INSERT INTO `staple` VALUES (293, 'ไก่ชิ้น', 65.0, 100.0, 0, 97, 2);
INSERT INTO `staple` VALUES (294, 'มันฝรั่ง', 52.0, 83.3, 0, 97, 1);
INSERT INTO `staple` VALUES (295, 'มะเขือเทศ', 9.0, 97.9, 0, 97, 1);
INSERT INTO `staple` VALUES (296, 'หอมใหญ่', 5.0, 92.1, 0, 97, 1);
INSERT INTO `staple` VALUES (297, 'แครอท', 12.0, 77.0, 0, 97, 1);
INSERT INTO `staple` VALUES (298, 'เครื่องแกงส้ม', 4.6, 100.0, 0, 107, 2);
INSERT INTO `staple` VALUES (299, 'กะปิ', 0.5, 100.0, 0, 107, 1);
INSERT INTO `staple` VALUES (300, 'มะนาว', 10.0, 45.5, 0, 107, 1);
INSERT INTO `staple` VALUES (301, 'มะขามเปียก', 2.0, 100.0, 0, 107, 1);
INSERT INTO `staple` VALUES (302, 'พริกสด', 1.2, 86.9, 0, 89, 1);
INSERT INTO `staple` VALUES (303, 'มะนาว', 10.0, 45.5, 0, 89, 1);
INSERT INTO `staple` VALUES (304, 'ตะไคร้', 1.0, 59.3, 0, 70, 1);
INSERT INTO `staple` VALUES (305, 'ขมิ้น', 1.1, 100.0, 0, 70, 1);
INSERT INTO `staple` VALUES (306, 'หอมแดง', 1.0, 100.0, 0, 70, 1);
INSERT INTO `staple` VALUES (307, 'มะขามเปียก', 0.6, 100.0, 0, 70, 1);
INSERT INTO `staple` VALUES (310, 'พริกสด', 1.3, 86.9, 0, 72, 1);
INSERT INTO `staple` VALUES (311, 'มะนาว', 10.0, 45.5, 0, 72, 1);
INSERT INTO `staple` VALUES (312, 'มะขามเปียก', 0.6, 100.0, 0, 72, 1);
INSERT INTO `staple` VALUES (313, 'มะขามเปียก', 3.0, 100.0, 0, 76, 1);
INSERT INTO `staple` VALUES (314, 'หอมแดง', 2.3, 100.0, 0, 76, 1);
INSERT INTO `staple` VALUES (315, 'พริกแห้ง', 1.7, 100.0, 0, 76, 1);
INSERT INTO `staple` VALUES (316, 'ข้าวโพด', 32.0, 55.9, 0, 68, 1);
INSERT INTO `staple` VALUES (317, 'เครื่องแกง', 1.7, 100.0, 0, 68, 2);
INSERT INTO `staple` VALUES (318, 'แป้งทอดกรอบ', 9.0, 100.0, 0, 68, 1);
INSERT INTO `staple` VALUES (319, 'เต้าหู้อ่อน', 82.0, 100.0, 0, 106, 1);
INSERT INTO `staple` VALUES (320, 'แครอท', 12.0, 77.0, 0, 106, 1);
INSERT INTO `staple` VALUES (321, 'หอมใหญ่', 17.0, 92.1, 0, 106, 1);
INSERT INTO `staple` VALUES (322, 'มะเขือเทศ', 12.0, 97.9, 0, 106, 1);
INSERT INTO `staple` VALUES (325, 'แครอท', 16.4, 77.0, 0, 94, 1);
INSERT INTO `staple` VALUES (326, 'กุ้ง', 22.0, 57.7, 0, 71, 2);
INSERT INTO `staple` VALUES (327, 'โหรพา', 2.4, 66.6, 0, 71, 1);
INSERT INTO `staple` VALUES (328, 'แตงกวา', 18.0, 79.3, 0, 96, 1);
INSERT INTO `staple` VALUES (329, 'มะนาว', 10.0, 45.5, 0, 11, 1);
INSERT INTO `staple` VALUES (330, 'ตะไคร้', 1.0, 59.3, 0, 11, 1);
INSERT INTO `staple` VALUES (331, 'ข่า', 2.5, 73.5, 0, 11, 1);
INSERT INTO `staple` VALUES (332, 'พริกสด', 2.0, 86.9, 0, 11, 1);
INSERT INTO `staple` VALUES (333, 'ข่า', 2.5, 73.5, 0, 12, 1);
INSERT INTO `staple` VALUES (334, 'พริกชี้ฟ้าแดง', 5.0, 87.7, 0, 12, 1);
INSERT INTO `staple` VALUES (335, 'กะปิ', 0.4, 100.0, 0, 12, 1);
INSERT INTO `staple` VALUES (336, 'เครื่องแกง', 12.0, 100.0, 0, 12, 2);
INSERT INTO `staple` VALUES (337, 'เครื่องแกงส้ม', 5.0, 100.0, 0, 105, 2);
INSERT INTO `staple` VALUES (338, 'มะนาว', 10.0, 45.5, 0, 105, 1);
INSERT INTO `staple` VALUES (340, 'มันเทศ', 19.0, 84.7, 0, 15, 1);
INSERT INTO `staple` VALUES (341, 'เห็ดนางฟ้า', 20.0, 91.7, 0, 15, 1);
INSERT INTO `staple` VALUES (342, 'ตำลึง', 25.0, 49.1, 0, 15, 1);
INSERT INTO `staple` VALUES (343, 'ข้าวโพดอ่อน', 5.0, 52.9, 0, 15, 1);
INSERT INTO `staple` VALUES (344, 'ฟักเขียว', 53.0, 65.8, 0, 15, 1);
INSERT INTO `staple` VALUES (347, 'พริกชี้ฟ้าแดง', 4.0, 87.7, 0, 16, 1);
INSERT INTO `staple` VALUES (348, 'โหรพา', 2.0, 66.6, 0, 16, 1);
INSERT INTO `staple` VALUES (349, 'เครื่องแกงกะทิ', 7.5, 100.0, 0, 16, 1);
INSERT INTO `staple` VALUES (350, 'กะปิ', 3.2, 100.0, 0, 16, 1);
INSERT INTO `staple` VALUES (351, 'กะทิ', 50.0, 100.0, 0, 16, 2);
INSERT INTO `staple` VALUES (352, 'ข่า', 4.0, 73.5, 0, 18, 1);
INSERT INTO `staple` VALUES (353, 'ตะไคร้', 2.5, 59.3, 0, 18, 1);
INSERT INTO `staple` VALUES (354, 'กะทิ', 50.0, 100.0, 0, 18, 2);
INSERT INTO `staple` VALUES (355, 'พริกสด', 1.6, 86.9, 0, 19, 1);
INSERT INTO `staple` VALUES (356, 'มะนาว', 10.0, 45.5, 0, 19, 1);
INSERT INTO `staple` VALUES (357, 'พริกชี้ฟ้าแดง', 5.0, 87.7, 0, 21, 1);
INSERT INTO `staple` VALUES (358, 'โหรพา', 3.0, 66.6, 0, 21, 1);
INSERT INTO `staple` VALUES (359, 'เครื่องแกงเขียวหวาน', 7.5, 100.0, 0, 21, 2);
INSERT INTO `staple` VALUES (360, 'กะทิ', 22.0, 100.0, 0, 21, 2);
INSERT INTO `staple` VALUES (361, 'โหรพา', 4.0, 78.0, 0, 22, 1);
INSERT INTO `staple` VALUES (362, 'พริกชี้ฟ้าเขียว', 6.0, 89.9, 0, 22, 1);
INSERT INTO `staple` VALUES (363, 'พริกชี้ฟ้าแดง', 6.0, 87.7, 0, 22, 1);
INSERT INTO `staple` VALUES (364, 'เครื่องแกงเผ็ด', 7.5, 100.0, 0, 22, 2);
INSERT INTO `staple` VALUES (365, 'ข่า', 2.5, 73.5, 0, 24, 1);
INSERT INTO `staple` VALUES (366, 'ตะไคร้', 1.0, 59.3, 0, 24, 1);
INSERT INTO `staple` VALUES (367, 'มะนาว', 10.0, 45.5, 0, 24, 1);
INSERT INTO `staple` VALUES (368, 'พริกขี้หนู', 2.0, 86.9, 0, 24, 1);
INSERT INTO `staple` VALUES (369, 'ขมิ้น', 1.4, 100.0, 0, 28, 1);
INSERT INTO `staple` VALUES (370, 'พริกสด', 1.5, 86.9, 0, 30, 1);
INSERT INTO `staple` VALUES (371, 'หอมแดง', 1.5, 98.0, 0, 30, 1);
INSERT INTO `staple` VALUES (372, 'มะนาว', 10.0, 45.5, 0, 30, 1);
INSERT INTO `staple` VALUES (373, 'หอมแดง', 2.0, 100.0, 0, 31, 1);
INSERT INTO `staple` VALUES (374, 'พริกสด', 1.3, 86.9, 0, 31, 1);
INSERT INTO `staple` VALUES (375, 'ผักกาดหอม', 7.0, 62.0, 0, 31, 1);
INSERT INTO `staple` VALUES (376, 'พริกชี้ฟ้าแดง', 8.0, 87.7, 0, 33, 1);
INSERT INTO `staple` VALUES (377, 'ผงกระหรี่', 3.0, 100.0, 0, 33, 1);
INSERT INTO `staple` VALUES (378, 'เครื่องไม้พะโล้', 0.6, 100.0, 0, 36, 1);
INSERT INTO `staple` VALUES (379, 'มะนาว', 10.0, 45.5, 0, 39, 1);
INSERT INTO `staple` VALUES (380, 'พริกสด', 2.0, 86.9, 0, 39, 1);
INSERT INTO `staple` VALUES (381, 'ข่า', 6.0, 73.5, 0, 39, 1);
INSERT INTO `staple` VALUES (382, 'ตะไคร้', 1.0, 59.3, 0, 39, 1);
INSERT INTO `staple` VALUES (383, 'กระชาย', 1.1, 100.0, 0, 41, 1);
INSERT INTO `staple` VALUES (384, 'โหรพา', 3.8, 66.6, 0, 41, 1);
INSERT INTO `staple` VALUES (385, 'พริกชี้ฟ้าแดง', 2.7, 87.7, 0, 44, 1);
INSERT INTO `staple` VALUES (386, 'เครื่องแกงผัดเผ็ด', 9.0, 100.0, 0, 44, 2);
INSERT INTO `staple` VALUES (387, 'กะทิ', 16.0, 100.0, 0, 45, 2);
INSERT INTO `staple` VALUES (388, 'เครื่องแกง', 8.3, 100.0, 0, 45, 2);
INSERT INTO `staple` VALUES (389, 'ข่า', 6.0, 73.5, 0, 46, 1);
INSERT INTO `staple` VALUES (390, 'ตะไคร้', 1.0, 59.3, 0, 46, 1);
INSERT INTO `staple` VALUES (391, 'พริกสด', 2.0, 86.9, 0, 46, 1);
INSERT INTO `staple` VALUES (392, 'มะนาว', 10.0, 45.5, 0, 46, 1);
INSERT INTO `staple` VALUES (393, 'มะนาว', 10.0, 45.5, 0, 48, 1);
INSERT INTO `staple` VALUES (394, 'ข่า', 1.2, 73.5, 0, 48, 1);
INSERT INTO `staple` VALUES (395, 'ตะไคร้', 1.6, 59.3, 0, 48, 1);
INSERT INTO `staple` VALUES (396, 'พริก', 1.6, 86.9, 0, 48, 1);
INSERT INTO `staple` VALUES (397, 'เครื่องแกงส้ม', 6.0, 100.0, 0, 49, 2);
INSERT INTO `staple` VALUES (398, 'มะขามเปียก', 8.0, 100.0, 0, 49, 1);
INSERT INTO `staple` VALUES (399, 'พริกชี้ฟ้าเขียว', 7.0, 89.9, 0, 53, 1);
INSERT INTO `staple` VALUES (400, 'พริกชี้ฟ้าแดง', 7.0, 87.7, 0, 53, 1);
INSERT INTO `staple` VALUES (401, 'ตะไคร้', 0.6, 59.3, 0, 54, 1);
INSERT INTO `staple` VALUES (402, 'ข่า', 0.5, 73.5, 0, 54, 1);
INSERT INTO `staple` VALUES (403, 'พริก', 1.2, 86.9, 0, 54, 1);
INSERT INTO `staple` VALUES (404, 'เห็ดหอม', 2.0, 85.7, 0, 80, 1);
INSERT INTO `staple` VALUES (405, 'ขิงซอย', 4.0, 100.0, 0, 80, 1);
INSERT INTO `staple` VALUES (406, 'ไก่บด', 15.0, 100.0, 0, 103, 2);
INSERT INTO `staple` VALUES (407, 'เห็ดหอม', 2.0, 85.7, 0, 103, 1);
INSERT INTO `staple` VALUES (408, 'เผือก', 6.0, 89.0, 0, 85, 1);
INSERT INTO `staple` VALUES (409, 'ปลาทู', 38.0, 71.4, 1, 102, 2);
INSERT INTO `staple` VALUES (410, 'พริกสด', 0.8, 86.9, 0, 102, 1);
INSERT INTO `staple` VALUES (411, 'ไก่ชิ้น', 48.0, 100.0, 0, 101, 2);
INSERT INTO `staple` VALUES (412, 'ไก่แล่', 56.0, 100.0, 0, 100, 2);
INSERT INTO `staple` VALUES (413, 'ปลาทับทิม', 84.4, 100.0, 0, 99, 2);
INSERT INTO `staple` VALUES (414, 'ปลาเส้น', 16.0, 100.0, 0, 98, 1);
INSERT INTO `staple` VALUES (415, 'ลูกชิ้นปลา', 28.0, 100.0, 0, 98, 1);
INSERT INTO `staple` VALUES (416, 'ไก่แล่', 16.5, 100.0, 0, 98, 2);
INSERT INTO `staple` VALUES (417, 'คะน้า', 32.0, 80.8, 0, 98, 1);
INSERT INTO `staple` VALUES (418, 'ไข่', 16.0, 100.0, 0, 98, 2);
INSERT INTO `staple` VALUES (419, 'เส้นก๋วยเตี๋ยว', 94.0, 100.0, 0, 98, 1);
INSERT INTO `staple` VALUES (420, 'ถั่วงอก', 16.0, 100.0, 0, 98, 1);
INSERT INTO `staple` VALUES (421, 'ไก่ชิ้น', 61.0, 100.0, 0, 54, 2);
INSERT INTO `staple` VALUES (422, 'เครื่องไม้พะโล้', 0.6, 100.0, 0, 61, 1);
INSERT INTO `staple` VALUES (423, 'ถั่วฝักยาว', 13.0, 95.9, 0, 56, 1);
INSERT INTO `staple` VALUES (424, 'ใบกระเพรา', 5.0, 70.0, 0, 56, 1);
INSERT INTO `staple` VALUES (425, 'พริกสด', 0.8, 86.9, 0, 41, 1);
INSERT INTO `staple` VALUES (426, 'ใบมะกรูด', 3.0, 70.0, 0, 41, 1);
INSERT INTO `staple` VALUES (427, 'ใบมะกรูด', 3.0, 70.0, 0, 48, 1);
INSERT INTO `staple` VALUES (428, 'ใบมะกรูด', 3.0, 70.0, 0, 11, 1);
INSERT INTO `staple` VALUES (429, 'ใบมะกรูด', 3.0, 70.0, 0, 24, 1);
INSERT INTO `staple` VALUES (430, 'เครื่องซุป', 0.7, 100.0, 0, 48, 1);
INSERT INTO `staple` VALUES (431, 'สับปะรด', 30.0, 50.0, 0, 107, 1);
INSERT INTO `staple` VALUES (432, 'หอมใหญ่', 19.0, 92.1, 0, 40, 1);
INSERT INTO `staple` VALUES (433, 'มะเขือเทศ', 18.0, 97.9, 0, 40, 1);
INSERT INTO `staple` VALUES (434, 'กระเทียม', 5.0, 91.8, 0, 40, 1);
INSERT INTO `staple` VALUES (435, 'ต้มหอม', 0.5, 87.0, 0, 40, 1);
INSERT INTO `staple` VALUES (436, 'ปลาทู', 45.0, 71.4, 1, 107, 2);
INSERT INTO `staple` VALUES (437, 'พริกชี้ฟ้าแดง', 3.0, 87.7, 0, 45, 1);
INSERT INTO `staple` VALUES (438, 'พริกไทยดำ', 1.0, 100.0, 0, 15, 1);
INSERT INTO `staple` VALUES (439, 'เส้นก๋วยเตี๋ยว', 140.0, 100.0, 0, 69, 1);

-- ----------------------------
-- Table structure for staple_original
-- ----------------------------
DROP TABLE IF EXISTS `staple_original`;
CREATE TABLE `staple_original`  (
  `staple_id` int NOT NULL AUTO_INCREMENT,
  `staple_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staple_serve` double(5, 1) NOT NULL,
  `staple_yield` double(5, 1) NOT NULL,
  `is_fish` int NULL DEFAULT NULL,
  `menu_id` int NOT NULL,
  `staple_type_id` int NOT NULL,
  PRIMARY KEY (`staple_id`, `menu_id`, `staple_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 298 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of staple_original
-- ----------------------------
INSERT INTO `staple_original` VALUES (4, 'กุ้ง', 17.0, 57.7, 0, 7, 2);
INSERT INTO `staple_original` VALUES (5, 'แตงกวา', 33.0, 79.3, 0, 7, 1);
INSERT INTO `staple_original` VALUES (6, 'สับปะรด', 21.0, 44.5, 0, 7, 1);
INSERT INTO `staple_original` VALUES (7, 'หอมใหญ่', 20.0, 92.1, 0, 7, 1);
INSERT INTO `staple_original` VALUES (8, 'มะเขือเทศ', 10.0, 97.9, 0, 7, 1);
INSERT INTO `staple_original` VALUES (9, 'ผักกาดขาว', 37.0, 88.9, 0, 8, 1);
INSERT INTO `staple_original` VALUES (10, 'แครอท', 7.4, 77.0, 0, 8, 1);
INSERT INTO `staple_original` VALUES (11, 'เห็ดหูหนู', 3.0, 89.6, 0, 8, 1);
INSERT INTO `staple_original` VALUES (12, 'เต้าหู้อ่อน', 22.0, 100.0, 0, 8, 1);
INSERT INTO `staple_original` VALUES (13, 'ไก่บด', 22.0, 100.0, 0, 8, 2);
INSERT INTO `staple_original` VALUES (14, 'เต้าหู้', 40.0, 100.0, 0, 9, 1);
INSERT INTO `staple_original` VALUES (15, 'เห็ดนางฟ้า', 22.0, 91.7, 0, 9, 1);
INSERT INTO `staple_original` VALUES (16, 'กุ้ง', 18.0, 57.7, 0, 9, 2);
INSERT INTO `staple_original` VALUES (17, 'ถั่วฝักยาว', 16.0, 95.9, 0, 9, 1);
INSERT INTO `staple_original` VALUES (18, 'ผักกาดขาว', 83.0, 88.9, 0, 10, 1);
INSERT INTO `staple_original` VALUES (20, 'แครอท', 4.5, 77.0, 0, 10, 1);
INSERT INTO `staple_original` VALUES (21, 'เห็ดหูหนู', 5.0, 89.6, 0, 10, 1);
INSERT INTO `staple_original` VALUES (22, 'กุ้ง', 18.0, 57.7, 0, 10, 2);
INSERT INTO `staple_original` VALUES (23, 'ไก่ชิ้น', 54.0, 100.0, 0, 11, 2);
INSERT INTO `staple_original` VALUES (24, 'มะเขือเทศ', 10.0, 97.9, 0, 11, 1);
INSERT INTO `staple_original` VALUES (25, 'หอมใหญ่', 12.0, 92.1, 0, 11, 1);
INSERT INTO `staple_original` VALUES (27, 'เห็ดนางฟ้า', 17.0, 91.7, 0, 11, 1);
INSERT INTO `staple_original` VALUES (28, 'ไก่บด', 78.0, 100.0, 0, 12, 2);
INSERT INTO `staple_original` VALUES (29, 'กุ้ง', 21.0, 57.7, 0, 13, 2);
INSERT INTO `staple_original` VALUES (30, 'มะละกอ ', 29.0, 69.5, 0, 13, 1);
INSERT INTO `staple_original` VALUES (31, 'ผักบุ้ง', 41.0, 100.0, 0, 13, 1);
INSERT INTO `staple_original` VALUES (38, 'ฟักทอง', 12.0, 83.0, 0, 15, 1);
INSERT INTO `staple_original` VALUES (39, 'มันเทศ', 19.0, 84.7, 0, 15, 1);
INSERT INTO `staple_original` VALUES (40, 'เห็ดนางฟ้า', 20.0, 91.7, 0, 15, 1);
INSERT INTO `staple_original` VALUES (41, 'ตำลึง', 25.0, 49.1, 0, 15, 1);
INSERT INTO `staple_original` VALUES (42, 'ยอดข้าวโพด', 5.0, 52.9, 0, 15, 1);
INSERT INTO `staple_original` VALUES (43, 'ฟักเขียว', 53.0, 65.8, 0, 15, 1);
INSERT INTO `staple_original` VALUES (44, 'บวบ', 19.0, 65.7, 0, 15, 1);
INSERT INTO `staple_original` VALUES (45, 'ไก่ชิ้น', 54.8, 100.0, 0, 16, 2);
INSERT INTO `staple_original` VALUES (46, 'สับปะรด', 42.0, 44.5, 0, 16, 1);
INSERT INTO `staple_original` VALUES (47, 'กุ้ง', 18.0, 57.7, 0, 17, 2);
INSERT INTO `staple_original` VALUES (48, 'คะน้า', 55.4, 80.8, 0, 17, 1);
INSERT INTO `staple_original` VALUES (49, 'แครอท', 2.4, 77.0, 0, 17, 1);
INSERT INTO `staple_original` VALUES (51, 'ไก่ชิ้น', 45.0, 100.0, 0, 18, 2);
INSERT INTO `staple_original` VALUES (52, 'หอมใหญ่', 3.0, 92.1, 0, 18, 1);
INSERT INTO `staple_original` VALUES (53, 'มะเขือเทศ', 18.0, 97.9, 0, 18, 1);
INSERT INTO `staple_original` VALUES (54, 'ฟักเขียว', 35.0, 65.8, 0, 18, 1);
INSERT INTO `staple_original` VALUES (55, 'ลูกชิ้นปลา', 26.0, 100.0, 0, 19, 2);
INSERT INTO `staple_original` VALUES (56, 'มะเขือเทศ', 12.0, 97.9, 0, 19, 1);
INSERT INTO `staple_original` VALUES (58, 'หอมใหญ่', 9.0, 92.1, 0, 19, 1);
INSERT INTO `staple_original` VALUES (59, 'วุ้นเส้น', 30.0, 100.0, 0, 19, 1);
INSERT INTO `staple_original` VALUES (60, 'ไก่บด', 23.0, 100.0, 0, 19, 2);
INSERT INTO `staple_original` VALUES (61, 'กุ้ง', 22.0, 57.7, 0, 20, 2);
INSERT INTO `staple_original` VALUES (62, 'ดอกกะหล่ำ', 59.0, 53.0, 0, 20, 1);
INSERT INTO `staple_original` VALUES (63, 'แครอท', 11.0, 77.0, 0, 20, 1);
INSERT INTO `staple_original` VALUES (64, 'ไก่ชิ้น', 62.0, 100.0, 0, 21, 2);
INSERT INTO `staple_original` VALUES (65, 'ฟักเขียว', 20.0, 65.8, 0, 21, 1);
INSERT INTO `staple_original` VALUES (66, 'มะเขือกลม', 30.0, 89.4, 0, 22, 1);
INSERT INTO `staple_original` VALUES (67, 'ปลา', 72.0, 71.4, 1, 22, 2);
INSERT INTO `staple_original` VALUES (68, 'ถั่วฝักยาว', 11.4, 95.9, 0, 22, 1);
INSERT INTO `staple_original` VALUES (69, 'บล็อกโคลี', 64.0, 83.3, 0, 23, 1);
INSERT INTO `staple_original` VALUES (70, 'กุ้ง', 22.0, 57.7, 0, 23, 2);
INSERT INTO `staple_original` VALUES (71, 'เห็ดน่องไก่', 20.0, 90.2, 0, 23, 1);
INSERT INTO `staple_original` VALUES (72, 'แครอท', 16.0, 77.0, 0, 23, 1);
INSERT INTO `staple_original` VALUES (73, 'ปลาทู', 40.0, 71.4, 1, 24, 2);
INSERT INTO `staple_original` VALUES (74, 'มะเขือเทศ', 15.0, 97.9, 0, 24, 1);
INSERT INTO `staple_original` VALUES (75, 'หอมใหญ่', 10.0, 92.1, 0, 24, 1);
INSERT INTO `staple_original` VALUES (76, 'ไก่ชิ้น', 55.0, 100.0, 0, 25, 2);
INSERT INTO `staple_original` VALUES (77, 'หอมใหญ่', 24.6, 92.1, 0, 25, 1);
INSERT INTO `staple_original` VALUES (78, 'ถั่วฝักยาว', 16.4, 95.9, 0, 25, 1);
INSERT INTO `staple_original` VALUES (79, 'ไก่แล่', 30.4, 100.0, 0, 27, 2);
INSERT INTO `staple_original` VALUES (80, 'ขิงซอย', 41.0, 100.0, 0, 27, 1);
INSERT INTO `staple_original` VALUES (81, 'เห็ดหูหนู', 15.3, 89.6, 0, 27, 1);
INSERT INTO `staple_original` VALUES (82, 'หอมใหญ่', 7.9, 92.1, 0, 27, 1);
INSERT INTO `staple_original` VALUES (83, 'ไก่ชิ้น', 55.0, 100.0, 0, 28, 2);
INSERT INTO `staple_original` VALUES (84, 'ฟักเขียว', 45.0, 65.8, 0, 28, 1);
INSERT INTO `staple_original` VALUES (85, 'แครอท', 7.0, 77.0, 0, 28, 1);
INSERT INTO `staple_original` VALUES (86, 'มะระ', 49.0, 83.3, 0, 29, 1);
INSERT INTO `staple_original` VALUES (87, 'ไข่', 29.0, 100.0, 0, 29, 2);
INSERT INTO `staple_original` VALUES (89, 'มะม่วงดิบ', 32.0, 66.4, 0, 30, 1);
INSERT INTO `staple_original` VALUES (90, 'เห็ดนางฟ้า', 11.5, 91.7, 0, 31, 1);
INSERT INTO `staple_original` VALUES (91, 'เห็ดหูหนู', 11.6, 89.6, 0, 31, 1);
INSERT INTO `staple_original` VALUES (92, 'เห็ดน่องไก่', 15.4, 90.2, 0, 31, 1);
INSERT INTO `staple_original` VALUES (93, 'ลูกชิ้นปลา', 44.4, 100.0, 0, 31, 1);
INSERT INTO `staple_original` VALUES (94, 'มะเขือเทศ', 16.4, 97.9, 0, 31, 1);
INSERT INTO `staple_original` VALUES (95, 'หอมใหญ่', 13.0, 92.1, 0, 31, 1);
INSERT INTO `staple_original` VALUES (96, 'แครอท', 7.0, 77.0, 0, 32, 1);
INSERT INTO `staple_original` VALUES (97, 'หัวไชเท้า', 11.0, 86.5, 0, 32, 1);
INSERT INTO `staple_original` VALUES (98, 'ฟักเขียว', 49.0, 65.8, 0, 32, 1);
INSERT INTO `staple_original` VALUES (99, 'ไก่ชิ้น', 68.0, 100.0, 0, 32, 2);
INSERT INTO `staple_original` VALUES (100, 'หอมใหญ่', 12.6, 92.1, 0, 33, 1);
INSERT INTO `staple_original` VALUES (101, 'ไก่แล่', 45.6, 100.0, 0, 33, 2);
INSERT INTO `staple_original` VALUES (103, 'ปลาแผ่น', 30.0, 100.0, 0, 34, 2);
INSERT INTO `staple_original` VALUES (104, 'แครอท', 8.0, 77.0, 0, 34, 1);
INSERT INTO `staple_original` VALUES (105, 'ถั่วงอก', 47.0, 100.0, 0, 34, 1);
INSERT INTO `staple_original` VALUES (106, 'เห็ดหูหนู', 20.0, 89.6, 0, 34, 1);
INSERT INTO `staple_original` VALUES (107, 'หอมใหญ่', 22.0, 92.1, 0, 35, 1);
INSERT INTO `staple_original` VALUES (108, 'มะเขือเทศ', 28.0, 97.9, 0, 35, 1);
INSERT INTO `staple_original` VALUES (109, 'ไข่', 51.0, 100.0, 0, 35, 2);
INSERT INTO `staple_original` VALUES (110, 'ไข่', 31.9, 100.0, 0, 36, 2);
INSERT INTO `staple_original` VALUES (111, 'เต้าหู้', 24.0, 100.0, 0, 36, 1);
INSERT INTO `staple_original` VALUES (112, 'วุ้นเส้น', 34.4, 100.0, 0, 37, 1);
INSERT INTO `staple_original` VALUES (113, 'กะหล่ำปลี', 28.3, 87.9, 0, 37, 1);
INSERT INTO `staple_original` VALUES (114, 'แครอท', 6.4, 77.0, 0, 37, 1);
INSERT INTO `staple_original` VALUES (115, 'เห็ดหูหนู', 6.0, 89.6, 0, 37, 1);
INSERT INTO `staple_original` VALUES (116, 'ไข่', 17.0, 100.0, 0, 37, 2);
INSERT INTO `staple_original` VALUES (117, 'กุ้ง', 18.0, 57.7, 0, 37, 2);
INSERT INTO `staple_original` VALUES (118, 'มะเขือเทศ', 3.0, 97.9, 0, 37, 1);
INSERT INTO `staple_original` VALUES (120, 'กุ้ง', 18.0, 57.7, 0, 38, 2);
INSERT INTO `staple_original` VALUES (121, 'บล็อกโคลี', 31.0, 83.3, 0, 38, 1);
INSERT INTO `staple_original` VALUES (122, 'ดอกกะหล่ำ', 25.4, 53.0, 0, 38, 1);
INSERT INTO `staple_original` VALUES (123, 'แครอท', 8.0, 77.0, 0, 38, 1);
INSERT INTO `staple_original` VALUES (124, 'ข้าวโพดอ่อน', 9.0, 52.9, 0, 38, 1);
INSERT INTO `staple_original` VALUES (125, 'เห็ดน่องไก่', 11.0, 90.2, 0, 38, 1);
INSERT INTO `staple_original` VALUES (126, 'ไก่ชิ้น', 56.0, 100.0, 0, 39, 2);
INSERT INTO `staple_original` VALUES (127, 'เห็ดนางฟ้า', 37.0, 91.7, 0, 39, 1);
INSERT INTO `staple_original` VALUES (128, 'หอมใหญ่', 9.9, 92.1, 0, 39, 1);
INSERT INTO `staple_original` VALUES (129, 'มะเขือเทศ', 25.0, 97.9, 0, 39, 1);
INSERT INTO `staple_original` VALUES (130, 'น่องไก่', 75.0, 100.0, 0, 40, 2);
INSERT INTO `staple_original` VALUES (131, 'ปลา', 60.0, 71.4, 1, 41, 2);
INSERT INTO `staple_original` VALUES (132, 'น่องไก่', 71.0, 100.0, 0, 42, 2);
INSERT INTO `staple_original` VALUES (133, 'มันฝรั่ง', 26.0, 85.0, 0, 42, 1);
INSERT INTO `staple_original` VALUES (134, 'แครอท', 4.6, 77.0, 0, 42, 1);
INSERT INTO `staple_original` VALUES (135, 'ไก่บด', 30.0, 100.0, 0, 43, 2);
INSERT INTO `staple_original` VALUES (136, 'แตงกวา', 43.0, 79.3, 0, 43, 1);
INSERT INTO `staple_original` VALUES (137, 'แครอท', 16.0, 77.0, 0, 43, 1);
INSERT INTO `staple_original` VALUES (138, 'ไก่ชิ้น', 56.0, 100.0, 0, 44, 2);
INSERT INTO `staple_original` VALUES (139, 'ถั่วฝักยาว', 17.4, 95.9, 0, 44, 1);
INSERT INTO `staple_original` VALUES (140, 'ปลาทู', 69.0, 71.4, 1, 45, 2);
INSERT INTO `staple_original` VALUES (141, 'กุ้ง', 19.0, 57.7, 0, 46, 2);
INSERT INTO `staple_original` VALUES (142, 'เห็ดนางฟ้า', 17.9, 91.7, 0, 46, 1);
INSERT INTO `staple_original` VALUES (143, 'มะเขือเทศ', 15.0, 97.9, 0, 46, 1);
INSERT INTO `staple_original` VALUES (144, 'หอมใหญ่', 43.0, 92.1, 0, 46, 1);
INSERT INTO `staple_original` VALUES (145, 'คะน้า', 59.0, 80.8, 0, 47, 1);
INSERT INTO `staple_original` VALUES (146, 'ไก่แล่', 28.3, 100.0, 0, 47, 2);
INSERT INTO `staple_original` VALUES (147, 'ไก่ชิ้น', 40.0, 100.0, 0, 48, 2);
INSERT INTO `staple_original` VALUES (148, 'ถั่วงอก', 20.0, 100.0, 0, 48, 1);
INSERT INTO `staple_original` VALUES (149, 'หอมใหญ่', 16.0, 92.1, 0, 48, 1);
INSERT INTO `staple_original` VALUES (150, 'มะเขือเทศ', 15.0, 97.9, 0, 48, 1);
INSERT INTO `staple_original` VALUES (151, 'กุ้ง', 19.0, 57.7, 0, 49, 2);
INSERT INTO `staple_original` VALUES (152, 'ดอกกะหล่ำ', 8.0, 53.0, 0, 49, 1);
INSERT INTO `staple_original` VALUES (153, 'มันเทศ', 16.0, 84.7, 0, 49, 1);
INSERT INTO `staple_original` VALUES (154, 'มะเขือกลม', 9.0, 89.4, 0, 49, 1);
INSERT INTO `staple_original` VALUES (155, 'สับปะรด', 13.0, 44.5, 0, 49, 1);
INSERT INTO `staple_original` VALUES (156, 'กะหล่ำปลี', 9.5, 87.9, 0, 49, 1);
INSERT INTO `staple_original` VALUES (157, 'ผักบุ้ง', 25.0, 100.0, 0, 49, 1);
INSERT INTO `staple_original` VALUES (158, 'กุ้ง', 18.0, 57.7, 0, 50, 2);
INSERT INTO `staple_original` VALUES (159, 'กะหล่ำปลี', 53.0, 87.9, 0, 50, 1);
INSERT INTO `staple_original` VALUES (160, 'แครอท', 6.6, 77.0, 0, 50, 1);
INSERT INTO `staple_original` VALUES (161, 'เห็ดหูหนู', 12.0, 89.6, 0, 50, 1);
INSERT INTO `staple_original` VALUES (162, 'ฟักทอง', 63.4, 83.0, 0, 51, 1);
INSERT INTO `staple_original` VALUES (163, 'ไข่', 35.6, 100.0, 0, 51, 2);
INSERT INTO `staple_original` VALUES (164, 'ถั่วลันเตา', 60.0, 97.0, 0, 52, 1);
INSERT INTO `staple_original` VALUES (165, 'กุ้ง', 22.0, 57.7, 0, 52, 2);
INSERT INTO `staple_original` VALUES (166, 'เต้าหู้ปลา', 51.0, 100.0, 0, 53, 1);
INSERT INTO `staple_original` VALUES (167, 'หอมใหญ่', 26.0, 92.1, 0, 53, 1);
INSERT INTO `staple_original` VALUES (168, 'ไก่ชิ้น', 61.0, 96.6, 0, 62, 2);
INSERT INTO `staple_original` VALUES (169, 'ใบชะมวง', 20.0, 96.6, 0, 54, 1);
INSERT INTO `staple_original` VALUES (170, 'เต้าหู้ปลา', 39.0, 100.0, 0, 55, 1);
INSERT INTO `staple_original` VALUES (171, 'เห็ดหูหนู', 13.0, 89.6, 0, 55, 1);
INSERT INTO `staple_original` VALUES (172, 'หอมใหญ่', 21.0, 92.1, 0, 55, 1);
INSERT INTO `staple_original` VALUES (173, 'ขิงซอย', 40.0, 100.0, 0, 55, 1);
INSERT INTO `staple_original` VALUES (174, 'ไก่บด', 60.0, 100.0, 0, 56, 2);
INSERT INTO `staple_original` VALUES (175, 'ปลา', 48.6, 71.4, 1, 57, 2);
INSERT INTO `staple_original` VALUES (176, 'ถั่วฝักยาว', 5.0, 95.9, 0, 57, 1);
INSERT INTO `staple_original` VALUES (177, 'กุ้ง', 18.0, 57.7, 0, 15, 2);
INSERT INTO `staple_original` VALUES (180, 'มะเขือกลม', 22.0, 89.4, 0, 21, 1);
INSERT INTO `staple_original` VALUES (181, 'มะเขือกลม', 29.0, 89.4, 0, 44, 1);
INSERT INTO `staple_original` VALUES (182, 'ปลากรอบ', 21.0, 100.0, 0, 30, 2);
INSERT INTO `staple_original` VALUES (184, 'ไก่ชิ้น', 66.0, 100.0, 0, 61, 2);
INSERT INTO `staple_original` VALUES (185, 'กวางตุ้ง', 46.0, 89.1, 0, 61, 1);
INSERT INTO `staple_original` VALUES (186, 'หัวไชเท้า', 17.0, 86.2, 0, 61, 1);
INSERT INTO `staple_original` VALUES (187, 'แครอท', 20.0, 77.0, 0, 61, 1);
INSERT INTO `staple_original` VALUES (189, 'ฟักเขียว', 55.0, 65.8, 0, 62, 1);
INSERT INTO `staple_original` VALUES (190, 'แครอท', 19.0, 77.0, 0, 62, 1);
INSERT INTO `staple_original` VALUES (191, 'เห็ดหอม', 16.0, 85.7, 0, 62, 1);
INSERT INTO `staple_original` VALUES (192, 'ปลา', 38.0, 71.4, 1, 63, 2);
INSERT INTO `staple_original` VALUES (193, 'หอมใหญ่', 23.0, 92.1, 0, 63, 1);
INSERT INTO `staple_original` VALUES (194, 'เห็ดหูหนู', 16.0, 89.6, 0, 63, 1);
INSERT INTO `staple_original` VALUES (195, 'ขิงซอย', 10.0, 100.0, 0, 63, 1);
INSERT INTO `staple_original` VALUES (196, 'แตงกวา', 55.0, 79.3, 0, 64, 1);
INSERT INTO `staple_original` VALUES (197, 'ไข่', 31.9, 100.0, 0, 64, 2);
INSERT INTO `staple_original` VALUES (198, 'ไข่', 31.9, 100.0, 0, 65, 2);
INSERT INTO `staple_original` VALUES (201, 'หอมใหญ่', 15.0, 92.1, 0, 65, 1);
INSERT INTO `staple_original` VALUES (202, 'กวางตุ้ง', 81.0, 89.1, 0, 66, 1);
INSERT INTO `staple_original` VALUES (203, 'ไข่', 31.9, 100.0, 0, 66, 2);
INSERT INTO `staple_original` VALUES (204, 'ผักกาดขาว', 69.0, 88.9, 0, 67, 1);
INSERT INTO `staple_original` VALUES (205, 'ลูกชิ้นปลา', 31.0, 100.0, 0, 67, 2);
INSERT INTO `staple_original` VALUES (206, 'เต้าหู้อ่อน', 60.0, 100.0, 0, 67, 1);
INSERT INTO `staple_original` VALUES (207, 'แครอท', 11.0, 77.0, 0, 67, 1);
INSERT INTO `staple_original` VALUES (208, 'เห็ดหูหนู', 19.0, 89.6, 0, 67, 1);
INSERT INTO `staple_original` VALUES (209, 'ไก่บด', 57.0, 100.0, 0, 68, 2);
INSERT INTO `staple_original` VALUES (210, 'เส้นก๋วยเตี๋ยว', 90.0, 100.0, 0, 69, 1);
INSERT INTO `staple_original` VALUES (211, 'กุ้ง', 19.0, 57.7, 0, 69, 2);
INSERT INTO `staple_original` VALUES (212, 'ปลาแผ่น', 22.0, 100.0, 0, 69, 2);
INSERT INTO `staple_original` VALUES (213, 'เห็ดออรินจิ', 16.0, 91.7, 0, 69, 1);
INSERT INTO `staple_original` VALUES (214, 'ยอดข้าวโพดอ่อน', 6.0, 52.5, 0, 69, 1);
INSERT INTO `staple_original` VALUES (215, 'แครอท', 8.0, 77.0, 0, 69, 1);
INSERT INTO `staple_original` VALUES (216, 'คะน้า', 22.0, 80.8, 0, 69, 1);
INSERT INTO `staple_original` VALUES (217, 'แป้งข้าวโพด', 6.0, 100.0, 0, 69, 1);
INSERT INTO `staple_original` VALUES (218, 'แครอท', 12.0, 77.0, 0, 65, 1);
INSERT INTO `staple_original` VALUES (220, 'มะเขือเทศ', 12.0, 97.9, 0, 65, 1);
INSERT INTO `staple_original` VALUES (221, 'ปลา', 76.0, 71.4, 1, 70, 2);
INSERT INTO `staple_original` VALUES (225, 'กุ้ง', 32.0, 57.7, 0, 71, 2);
INSERT INTO `staple_original` VALUES (226, 'ถั่วฝักยาว', 35.0, 95.9, 0, 71, 1);
INSERT INTO `staple_original` VALUES (227, 'พริกชี้ฟ้าแดง', 9.0, 87.7, 0, 71, 1);
INSERT INTO `staple_original` VALUES (230, 'เครื่องแกงผัดเผ็ด', 9.0, 100.0, 0, 71, 2);
INSERT INTO `staple_original` VALUES (232, 'วุ้นเส้น', 29.0, 100.0, 0, 72, 1);
INSERT INTO `staple_original` VALUES (233, 'กุ้ง', 17.0, 57.7, 0, 72, 2);
INSERT INTO `staple_original` VALUES (234, 'เห็ดหูหนูขาว', 36.0, 100.0, 0, 72, 1);
INSERT INTO `staple_original` VALUES (235, 'ลูกชิ้นปลา', 14.0, 100.0, 0, 72, 2);
INSERT INTO `staple_original` VALUES (236, 'มะเขือเทศ', 18.0, 97.9, 0, 72, 1);
INSERT INTO `staple_original` VALUES (237, 'หอมใหญ่', 17.0, 92.1, 0, 72, 1);
INSERT INTO `staple_original` VALUES (238, 'ผักกาดหอม', 7.0, 100.0, 0, 72, 1);
INSERT INTO `staple_original` VALUES (242, 'ไข่', 38.3, 100.0, 0, 74, 2);
INSERT INTO `staple_original` VALUES (243, 'หอมใหญ่', 4.0, 92.1, 0, 74, 1);
INSERT INTO `staple_original` VALUES (244, 'มะเขือเทศ', 3.5, 97.9, 0, 74, 1);
INSERT INTO `staple_original` VALUES (245, 'ไข่', 31.9, 100.0, 0, 75, 2);
INSERT INTO `staple_original` VALUES (246, 'ไข่', 31.9, 100.0, 0, 76, 2);
INSERT INTO `staple_original` VALUES (249, 'ไก่ฉีก', 15.0, 100.0, 0, 77, 2);
INSERT INTO `staple_original` VALUES (250, 'แครอท', 9.0, 77.0, 0, 77, 1);
INSERT INTO `staple_original` VALUES (251, 'ไก่ฉีก', 15.0, 100.0, 0, 78, 2);
INSERT INTO `staple_original` VALUES (252, 'ขิงซอย', 4.0, 100.0, 0, 78, 1);
INSERT INTO `staple_original` VALUES (253, 'ถั่วฝักยาว', 35.0, 95.9, 0, 79, 1);
INSERT INTO `staple_original` VALUES (254, 'ไข่', 31.9, 100.0, 0, 79, 2);
INSERT INTO `staple_original` VALUES (255, 'กุ้ง', 15.0, 57.7, 0, 80, 2);
INSERT INTO `staple_original` VALUES (256, 'ไก่บด', 30.0, 100.0, 0, 81, 2);
INSERT INTO `staple_original` VALUES (257, 'ฟักทอง', 8.0, 83.0, 0, 81, 1);
INSERT INTO `staple_original` VALUES (258, 'แครอท', 9.0, 77.0, 0, 81, 1);
INSERT INTO `staple_original` VALUES (259, 'เส้นก๋วยเตี๋ยว', 90.0, 100.0, 0, 82, 1);
INSERT INTO `staple_original` VALUES (260, 'กุ้ง', 19.0, 57.7, 0, 82, 2);
INSERT INTO `staple_original` VALUES (261, 'ปลาเส้น', 22.0, 100.0, 0, 82, 2);
INSERT INTO `staple_original` VALUES (262, 'ไก่ฉีก', 15.0, 100.0, 0, 83, 2);
INSERT INTO `staple_original` VALUES (263, 'ฟักทอง', 8.0, 83.0, 0, 83, 1);
INSERT INTO `staple_original` VALUES (264, 'แครอท', 9.0, 77.0, 0, 83, 1);
INSERT INTO `staple_original` VALUES (265, 'กุ้ง', 15.0, 57.7, 0, 84, 2);
INSERT INTO `staple_original` VALUES (266, 'ฟักทอง', 8.0, 83.0, 0, 84, 1);
INSERT INTO `staple_original` VALUES (267, 'แครอท', 9.0, 77.0, 0, 84, 1);
INSERT INTO `staple_original` VALUES (268, 'กุ้ง', 15.0, 57.7, 0, 85, 2);
INSERT INTO `staple_original` VALUES (269, 'น่องไก่', 75.0, 100.0, 0, 86, 2);
INSERT INTO `staple_original` VALUES (270, 'ไข่', 31.9, 100.0, 0, 87, 2);
INSERT INTO `staple_original` VALUES (271, 'เต้าหู้', 40.0, 100.0, 0, 87, 2);
INSERT INTO `staple_original` VALUES (272, 'ปลา', 38.0, 71.4, 1, 88, 2);
INSERT INTO `staple_original` VALUES (273, 'สับปะรด', 32.0, 44.5, 0, 88, 1);
INSERT INTO `staple_original` VALUES (274, 'ไข่', 31.9, 100.0, 0, 89, 2);
INSERT INTO `staple_original` VALUES (275, 'ปลา', 60.0, 100.0, 1, 90, 2);
INSERT INTO `staple_original` VALUES (276, 'ไข่', 31.9, 100.0, 0, 73, 2);
INSERT INTO `staple_original` VALUES (277, 'พริกชี้ฟ้าเขียว', 9.0, 89.9, 0, 71, 1);
INSERT INTO `staple_original` VALUES (278, 'ไข่', 31.9, 100.0, 0, 91, 2);
INSERT INTO `staple_original` VALUES (279, 'ผักกาดขาว', 67.0, 88.9, 0, 91, 1);
INSERT INTO `staple_original` VALUES (280, 'ไข่', 31.9, 100.0, 0, 92, 2);
INSERT INTO `staple_original` VALUES (281, 'กะหล่ำปลี', 42.0, 87.9, 0, 92, 1);
INSERT INTO `staple_original` VALUES (282, 'ไข่', 31.9, 100.0, 0, 93, 2);
INSERT INTO `staple_original` VALUES (283, 'บวบ', 57.0, 65.7, 0, 93, 1);
INSERT INTO `staple_original` VALUES (284, 'กุ้ง', 19.0, 57.7, 0, 94, 2);
INSERT INTO `staple_original` VALUES (285, 'เห็ดออรินจิ', 50.0, 90.2, 0, 94, 1);
INSERT INTO `staple_original` VALUES (286, 'แครอท', 16.4, 77.0, 0, 94, 1);
INSERT INTO `staple_original` VALUES (287, 'ไก่แล่', 48.0, 100.0, 0, 95, 2);
INSERT INTO `staple_original` VALUES (288, 'หอมใหญ่', 32.0, 92.1, 0, 95, 1);
INSERT INTO `staple_original` VALUES (289, 'กุ้ง', 20.0, 57.7, 0, 96, 2);
INSERT INTO `staple_original` VALUES (290, 'คะน้า', 19.0, 80.8, 0, 96, 1);
INSERT INTO `staple_original` VALUES (291, 'มะเขือเทศ', 9.0, 97.9, 0, 96, 1);
INSERT INTO `staple_original` VALUES (292, 'หอมใหญ่', 3.0, 92.1, 0, 96, 1);
INSERT INTO `staple_original` VALUES (293, 'ไก่ชิ้น', 65.0, 100.0, 0, 97, 2);
INSERT INTO `staple_original` VALUES (294, 'มันฝรั่ง', 52.0, 83.3, 0, 97, 1);
INSERT INTO `staple_original` VALUES (295, 'มะเขือเทศ', 9.0, 97.9, 0, 97, 1);
INSERT INTO `staple_original` VALUES (296, 'หอมใหญ่', 5.0, 92.1, 0, 97, 1);
INSERT INTO `staple_original` VALUES (297, 'แครอท', 12.0, 77.0, 0, 97, 1);

-- ----------------------------
-- Table structure for staple_type
-- ----------------------------
DROP TABLE IF EXISTS `staple_type`;
CREATE TABLE `staple_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `staple_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of staple_type
-- ----------------------------
INSERT INTO `staple_type` VALUES (1, 'ผัก');
INSERT INTO `staple_type` VALUES (2, 'เนื้อสัตว์');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nameuser` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '_Computer0', 'แอดมิน', 'Y', 'admin');
INSERT INTO `user` VALUES (2, 'thepha', '11390', 'โรงพยาบาลเทพา', 'Y', 'user');
INSERT INTO `user` VALUES (3, 'asleena', 'asleena', 'อัสลีนา กาเร็ง', 'Y', 'user');
INSERT INTO `user` VALUES (4, 'siriyapon', 'siriyapon', 'สิริยาพร  รองเดช', 'Y', 'user');

-- ----------------------------
-- Table structure for version
-- ----------------------------
DROP TABLE IF EXISTS `version`;
CREATE TABLE `version`  (
  `version_id` int NOT NULL AUTO_INCREMENT,
  `version_build` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `version_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`version_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of version
-- ----------------------------
INSERT INTO `version` VALUES (1, '64.3.0', '<li>พัฒนาระบบตาม requirement ที่ได้รับ</li>');
INSERT INTO `version` VALUES (2, '64.3.1', '<li>ปรับปรุงหน้าเว็บไซต์ในส่วนของการแสดงผล</li>');
INSERT INTO `version` VALUES (3, '64.4.0', '<li>แก้ไขหน้าต่างการคำนวณให้สามารถเลือกเมนูได้มากกว่า 1 เมนู</li><li>เพิ่มเมนูพิมพ์เอกสารแยกตามเมนูและรวมรายการวัตถุดิบ</li>');
INSERT INTO `version` VALUES (4, '64.4.2', '<li>เพิ่มข้อมูลรายการคำนวณที่เป็น kg</li>');
INSERT INTO `version` VALUES (5, '64.4.3', '<li>เพิ่มหน้าต่างการจัดการวัตถุดิบโรยหน้า</li>');
INSERT INTO `version` VALUES (6, '64.4.4', '<li>เปลี่ยนข้อความจากค้นหา เป็นคำนวณในหน้าคำนวณสูตรอาหาร</li>');
INSERT INTO `version` VALUES (7, '65.3.1', '<li>เพิ่มการคำนวณห้องพิเศษ</li>');
INSERT INTO `version` VALUES (8, '65.3.2', '<li>เพิ่มการแสดงสีแยกประเภทอาหาร</li>');
INSERT INTO `version` VALUES (9, '65.4.1', '<li>เปลี่ยนชื่อระบบเป็น Raw material-thepha</li>');
INSERT INTO `version` VALUES (10, '65.4.2', '<li>แสดงทศนิยมกรัมเป็น 1 หลัก</li><li>ยกเลิกการแสดงกรัม/คน</li>');

SET FOREIGN_KEY_CHECKS = 1;
