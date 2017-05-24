-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: yii2advanced
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bn_banners`
--

DROP TABLE IF EXISTS `bn_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bn_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '页面名称',
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `content_id` int(11) NOT NULL COMMENT '确认跳转链接',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bn_banners`
--

LOCK TABLES `bn_banners` WRITE;
/*!40000 ALTER TABLE `bn_banners` DISABLE KEYS */;
INSERT INTO `bn_banners` VALUES (1,'59256ff11405c.png','http://localhost:8001/upload/admin/59256ff11405c.png',1),(2,'59256ff968edb.png','http://localhost:8001/upload/admin/59256ff968edb.png',1),(3,'59256fffd5489.png','http://localhost:8001/upload/admin/59256fffd5489.png',1);
/*!40000 ALTER TABLE `bn_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bn_contents`
--

DROP TABLE IF EXISTS `bn_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bn_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '页面名称',
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `link` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '确认跳转链接',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bn_contents`
--

LOCK TABLES `bn_contents` WRITE;
/*!40000 ALTER TABLE `bn_contents` DISABLE KEYS */;
INSERT INTO `bn_contents` VALUES (1,'birdy','123','http://www.baidu.com');
/*!40000 ALTER TABLE `bn_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bn_loans`
--

DROP TABLE IF EXISTS `bn_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bn_loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `tel` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号码',
  `loan_amount` decimal(10,2) NOT NULL COMMENT '贷款金额',
  `occupation` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '职业',
  `income` decimal(10,2) NOT NULL COMMENT '家庭收入',
  `id_card_front` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '身份证正面',
  `id_card_back` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '身份证背面',
  `bank_pic` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '银行卡照片',
  `loan_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '贷款状态',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '删除状态。0：已删除，1：正常',
  `updated_at` int(11) NOT NULL COMMENT '修改时间',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bn_loans`
--

LOCK TABLES `bn_loans` WRITE;
/*!40000 ALTER TABLE `bn_loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bn_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_users`
--

DROP TABLE IF EXISTS `bs_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'session登录验证字段',
  `password_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码重置token',
  `email` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '电子邮箱',
  `tel` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号码',
  `access_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'restful登录验证字段',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '删除状态。0：已删除，1：正常',
  `updated_by` int(11) NOT NULL COMMENT '修改人',
  `updated_at` int(11) NOT NULL COMMENT '修改时间',
  `created_by` int(11) NOT NULL COMMENT '创建人',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_users`
--

LOCK TABLES `bs_users` WRITE;
/*!40000 ALTER TABLE `bs_users` DISABLE KEYS */;
INSERT INTO `bs_users` VALUES (1,'test4',NULL,'$2y$13$Tr9NTi//Q59HTgKX.jsExONiuRuaGt1L06Q9YADma/jtDTYnaA8Yq',NULL,'sunzh235@126.com','18353699236','abc123_',1,1,1493430924,1,1493430924);
/*!40000 ALTER TABLE `bs_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1492916137),('m130524_201442_create_bs_users',1492916139),('m170422_140441_create_bs_channels',1492956830),('m170423_120309_create_bs_menus',1492956830),('m170423_123837_create_bs_fans',1492956830),('m170504_140806_create_bs_materials',1494514203),('m170511_121525_create_bs_roles',1494514203),('m170511_123840_create_bs_user_role',1494514203),('m170511_125627_create_bs_teams',1494514203),('m170511_132206_create_bs_role_authority',1494514203),('m170511_142301_create_bs_modules',1494514203),('m170517_122403_create_bn_contents',1495625514),('m170517_122924_create_bn_banners',1495625514),('m170517_123537_create_bn_loans',1495625514);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-24 19:43:42
