-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 123.207.214.55    Database: work_record
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

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
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `number` varchar(18) NOT NULL COMMENT '统一社会信用代码',
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (3,'南京航空航天大学','13322222223','8888888@qq.com','南京江宁','91320102716209711G','12345678'),(4,'q\'we','qew','qwe@qq.com','qwe','qwe','qwe'),(5,'4444','4444','4444','4444','4444','4444');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) DEFAULT NULL,
  `work_id` int(10) DEFAULT NULL,
  `num` int(5) DEFAULT NULL,
  `date` varchar(11) DEFAULT NULL,
  `add_time` varchar(15) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (1,1,1,1,'20180601','1526129396','0x95afc67b544b7d9f9cb0863bd34b3d1d'),(2,1,1,1,'20180601','1526129460','0x633c1f764ecf9d37de744986e91fc9f5');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `house` varchar(20) NOT NULL,
  `welfare` varchar(100) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (2,'南京','13222222','板房','高温补贴','',0),(3,'南京','13222222','板房','高温补贴','',0),(4,'南京','13222222','板房','高温补贴','',0),(5,'南京','13222222','板房','高温补贴','',0);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_wages`
--

DROP TABLE IF EXISTS `task_wages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_wages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `field` varchar(10) NOT NULL,
  `wage` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_wages`
--

LOCK TABLES `task_wages` WRITE;
/*!40000 ALTER TABLE `task_wages` DISABLE KEYS */;
INSERT INTO `task_wages` VALUES (3,2,'家装主材安装',100),(4,2,'电器安装维修',110),(5,3,'家装主材安装',100),(6,3,'电器安装维修',110),(7,4,'家装主材安装',100),(8,4,'电器安装维修',110),(9,5,'家装主材安装',100),(10,5,'电器安装维修',110);
/*!40000 ALTER TABLE `task_wages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tokenName` varchar(32) NOT NULL,
  `userid` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (6,'6795f260df180eee8516ac25c2727aab',3,1528037550,0),(7,'e439da735890ab542100cb29cd56fed6',2,1526039332,1),(8,'e695689b96bdf97c95071221c9fabdda',3,1526039380,1),(9,'7f63582717d9e84bd2a79a151d9fa9cc',4,1526039450,1),(27,'e13ec4fe4e53546e2560805d6b9cc8e0',5,1526142487,1),(28,'73e3ec9ad27ac60ec1dad002cf8e1b62',4,1527870553,0),(26,'df0e193f68c5b3cd8e8147685c3028e9',5,1526043622,0);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker`
--

DROP TABLE IF EXISTS `worker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker`
--

LOCK TABLES `worker` WRITE;
/*!40000 ALTER TABLE `worker` DISABLE KEYS */;
INSERT INTO `worker` VALUES (2,'123123',30,'123123','1111111'),(3,'112',30,'112','1111111'),(4,'1111',30,'1111','1111111'),(5,'3333',30,'3333','3333');
/*!40000 ALTER TABLE `worker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker_experience`
--

DROP TABLE IF EXISTS `worker_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker_experience` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `field` varchar(10) NOT NULL,
  `year` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker_experience`
--

LOCK TABLES `worker_experience` WRITE;
/*!40000 ALTER TABLE `worker_experience` DISABLE KEYS */;
INSERT INTO `worker_experience` VALUES (4,2,'装修施工',2),(5,2,'家装主材安装',2),(6,3,'装修施工',2),(7,3,'门窗玻璃安装',2),(8,4,'建筑施工',2),(9,5,'家装主材安装',2),(10,5,'家装主材安装',2),(11,5,'门窗玻璃安装',2);
/*!40000 ALTER TABLE `worker_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'work_record'
--

--
-- Dumping routines for database 'work_record'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-13 15:38:14
