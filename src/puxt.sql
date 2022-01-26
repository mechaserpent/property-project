-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: raymond
-- ------------------------------------------------------
-- Server version	5.7.29-log

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
-- Table structure for table `ACL`
--

DROP TABLE IF EXISTS `ACL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACL` (
  `acl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `usergroup_id` int(10) unsigned DEFAULT NULL,
  `value` enum('allow','deny') NOT NULL,
  `special_user` int(10) unsigned DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `remark` text,
  `code` text,
  `path` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acl_id`),
  KEY `user_id` (`user_id`),
  KEY `usergroup_id` (`usergroup_id`),
  KEY `value` (`value`),
  KEY `special_user` (`special_user`),
  KEY `field` (`field`),
  CONSTRAINT `FK_ACL_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ACL_2` FOREIGN KEY (`usergroup_id`) REFERENCES `UserGroup` (`usergroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACL`
--

LOCK TABLES `ACL` WRITE;
/*!40000 ALTER TABLE `ACL` DISABLE KEYS */;
/*!40000 ALTER TABLE `ACL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthLock`
--

DROP TABLE IF EXISTS `AuthLock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthLock` (
  `authlock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`authlock_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthLock`
--

LOCK TABLES `AuthLock` WRITE;
/*!40000 ALTER TABLE `AuthLock` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthLock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Config`
--

DROP TABLE IF EXISTS `Config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Config` (
  `config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Config`
--

LOCK TABLES `Config` WRITE;
/*!40000 ALTER TABLE `Config` DISABLE KEYS */;
INSERT INTO `Config` VALUES (1,'company','HostLink',0,1,NULL,NULL),(2,'company_logo','/cms/images/logo/logo.png',0,1,NULL,NULL),(3,'company_url','https://www.hostlink.com.hk',0,1,NULL,NULL),(4,'copyright_name','HostLink',0,1,NULL,NULL),(5,'copyright_year','2021',0,1,NULL,NULL),(6,'copyright_url','https://www.hostlink.com.hk',0,1,NULL,NULL),(7,'login_version','v1',0,1,NULL,NULL),(8,'two_step_verification','0',0,1,NULL,NULL),(9,'biometric_authentication','0',0,1,NULL,NULL),(10,'vx_url',NULL,0,1,NULL,NULL);
/*!40000 ALTER TABLE `Config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventLog`
--

DROP TABLE IF EXISTS `EventLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventLog` (
  `eventlog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(64) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL,
  `action` varchar(64) DEFAULT NULL,
  `source` json DEFAULT NULL,
  `target` json DEFAULT NULL,
  `remark` text,
  `user_id` int(10) unsigned NOT NULL,
  `created_time` datetime NOT NULL,
  `status` int(10) unsigned DEFAULT '0',
  `different` json DEFAULT NULL,
  PRIMARY KEY (`eventlog_id`),
  KEY `class` (`class`),
  KEY `user_id` (`user_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventLog`
--

LOCK TABLES `EventLog` WRITE;
/*!40000 ALTER TABLE `EventLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `EventLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MailLog`
--

DROP TABLE IF EXISTS `MailLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MailLog` (
  `maillog_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_time` datetime DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `body` text,
  `subject` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `altbody` text,
  `host` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`maillog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MailLog`
--

LOCK TABLES `MailLog` WRITE;
/*!40000 ALTER TABLE `MailLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `MailLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MyFavorite`
--

DROP TABLE IF EXISTS `MyFavorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MyFavorite` (
  `my_favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(1000) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`my_favorite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MyFavorite`
--

LOCK TABLES `MyFavorite` WRITE;
/*!40000 ALTER TABLE `MyFavorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `MyFavorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SystemValue`
--

DROP TABLE IF EXISTS `SystemValue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SystemValue` (
  `systemvalue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `value` text,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `language` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`systemvalue_id`),
  KEY `language` (`language`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SystemValue`
--

LOCK TABLES `SystemValue` WRITE;
/*!40000 ALTER TABLE `SystemValue` DISABLE KEYS */;
INSERT INTO `SystemValue` VALUES (3,'UserStatus','0|Active1\r\n1|Inactive',0,1,'en'),(4,'UserStatus','0|有效\r\n1|無效',0,1,'zh-hk');
/*!40000 ALTER TABLE `SystemValue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Translate`
--

DROP TABLE IF EXISTS `Translate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Translate` (
  `translate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`translate_id`),
  KEY `language` (`language`),
  KEY `name` (`name`),
  KEY `action` (`action`),
  KEY `module` (`module`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Translate`
--

LOCK TABLES `Translate` WRITE;
/*!40000 ALTER TABLE `Translate` DISABLE KEYS */;
/*!40000 ALTER TABLE `Translate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `addr3` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `language` varchar(5) DEFAULT NULL,
  `default_page` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `join_date` date NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `openid` tinyint(1) NOT NULL DEFAULT '0',
  `secret` varchar(16) DEFAULT NULL,
  `style` json DEFAULT NULL,
  `setting` text,
  `bs_theme` varchar(255) DEFAULT NULL,
  `skin` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `credential` json DEFAULT NULL,
  `last_online` datetime DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `photo` blob,
  `credential_creation_options` json DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `inactive` (`inactive`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'admin','$2y$10$Yrwsfl6948/1LMQZabVwXup2O3Wfh0l6qXvQZ2.fTLrQ1sSnM8BIW','admin','admin','raymond@hostlink.com.hk','93465221','cupertino','12','2','3',0,0,0,'zh-hk','User',NULL,'2015-11-04',0,0,NULL,'{\"body\": [\"text-sm\"], \"color\": \"bg-warning\", \"layout\": \"semi-dark-layout\", \"language\": \"zh-hk\", \"bootstrap\": {\"@body-bg\": \"#ffffff\", \"@navbar-height\": \"35px\", \"@font-size-base\": \"14px\", \"@nav-link-padding\": \"7px 10px\", \"@table-condensed-cell-padding\": \"4px\"}, \"form_size\": \"medium \", \"input_size\": \"medium \", \"table_size\": \"medium \", \"collapsible\": false, \"footer_type\": \"static\", \"navbar_type\": \"static\", \"rtable_size\": \"medium \", \"navbar_color\": \"bg-primary\", \"table_border\": false, \"rtable_table_size\": true, \"rtable_small_table\": false}','{\"2step ip white list\":null,\"2step_ip_white_list\":[\"115.160.172.18\\r\",\"115.160.172.18\"],\"2-step_ip_white_list\":[\"115.160.172.18\"],\"sidebar-collapse\":\"0\"}',NULL,'skin-blue',NULL,'null',NULL,NULL,NULL,'{\"rp\": {\"name\": \"localhost:8001\"}, \"user\": {\"id\": \"MQ==\", \"name\": \"admin\", \"displayName\": \"admin admin\"}, \"timeout\": 60000, \"challenge\": \"0zIgvqxHX7foIvDOIKRAW1k10kLeqpcDjWmvQOL_pbE\", \"attestation\": \"none\", \"pubKeyCredParams\": [{\"alg\": -257, \"type\": \"public-key\"}, {\"alg\": -259, \"type\": \"public-key\"}, {\"alg\": -37, \"type\": \"public-key\"}, {\"alg\": -39, \"type\": \"public-key\"}, {\"alg\": -7, \"type\": \"public-key\"}, {\"alg\": -36, \"type\": \"public-key\"}, {\"alg\": -8, \"type\": \"public-key\"}], \"authenticatorSelection\": {\"userVerification\": \"preferred\", \"requireResidentKey\": false}}'),(2,'guest','','guest','guest',NULL,'abc2',NULL,NULL,NULL,NULL,0,0,0,'zh-hk',NULL,NULL,'2012-01-01',0,0,NULL,'{\"color\": \"bg-primary\", \"navbar_color\": \"bg-secondary\"}',NULL,NULL,NULL,NULL,'null',NULL,NULL,NULL,'null'),(3,'system','','system','system',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'en',NULL,NULL,'2012-01-02',0,0,NULL,'null',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'raymond','$2y$10$hvFKlFKBhjspGpA3fpEKMege1b8kaxI7gdIRQ350H0uteV2ShJhgK','Raymond','Chong','raymond@hostlink.com.hk','1213','blitzer','a','b','c',0,0,1,'zh-hk','',NULL,'2013-08-05',0,0,NULL,'null','{\"sidebar-collapse\":\"0\",\"layout\":\"sidebar\",\"fixed\":\"0\"}',NULL,'skin-green',NULL,'null','2021-06-10 15:10:00',NULL,NULL,'null'),(11,'power','','power','power','power1@hostlink.com.hk','123','clear','x','y','z',0,0,1,'zh-hk','',NULL,'2020-11-18',0,0,NULL,'null',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserGroup`
--

DROP TABLE IF EXISTS `UserGroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserGroup` (
  `usergroup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `readonly` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `remark` text,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `inactive` (`inactive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserGroup`
--

LOCK TABLES `UserGroup` WRITE;
/*!40000 ALTER TABLE `UserGroup` DISABLE KEYS */;
INSERT INTO `UserGroup` VALUES (1,'Administrators',1,0,NULL,NULL,NULL),(2,'Power Users',1,0,NULL,NULL,NULL),(3,'Users',1,0,NULL,NULL,NULL),(4,'Guests',1,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `UserGroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserList`
--

DROP TABLE IF EXISTS `UserList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserList` (
  `userlist_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `usergroup_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`userlist_id`),
  KEY `FK_UserList_1` (`user_id`),
  KEY `FK_UserList_2` (`usergroup_id`),
  CONSTRAINT `FK_UserList_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_UserList_2` FOREIGN KEY (`usergroup_id`) REFERENCES `UserGroup` (`usergroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserList`
--

LOCK TABLES `UserList` WRITE;
/*!40000 ALTER TABLE `UserList` DISABLE KEYS */;
INSERT INTO `UserList` VALUES (74,1,1),(75,2,4),(76,3,1),(78,6,3),(85,11,2);
/*!40000 ALTER TABLE `UserList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserLog`
--

DROP TABLE IF EXISTS `UserLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserLog` (
  `userlog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `login_dt` datetime NOT NULL,
  `logout_dt` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `result` enum('SUCCESS','FAIL') NOT NULL,
  `user_agent` text,
  PRIMARY KEY (`userlog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_UserLog_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserLog`
--

LOCK TABLES `UserLog` WRITE;
/*!40000 ALTER TABLE `UserLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserLog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-30 15:39:08
