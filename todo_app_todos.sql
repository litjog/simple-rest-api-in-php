-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: todo_app
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `todos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `body` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todos`
--

LOCK TABLES `todos` WRITE;
/*!40000 ALTER TABLE `todos` DISABLE KEYS */;
INSERT INTO `todos` VALUES (3,'Something to do',1,'2022-06-24 00:55:02','2022-07-05 17:35:26'),(4,'Forth todo',1,'2022-06-24 00:55:17','2022-07-05 16:59:30'),(5,'Fifth todo',1,'2022-06-24 01:14:23','2022-07-05 14:32:12'),(7,'Something to do',1,'2022-06-24 01:38:03','2022-07-05 17:19:07'),(8,'A new thing to do',1,'2022-06-24 01:39:46','2022-07-05 17:19:08'),(9,'Something to do',1,'2022-06-27 06:58:13','2022-07-05 17:19:09'),(10,'Update todo using PHP',1,'2022-06-27 06:58:15','2022-07-05 17:19:11'),(11,'Another update using PHP',1,'2022-06-27 06:58:17','2022-07-05 17:19:12'),(12,'Something to do',1,'2022-06-27 06:58:17','2022-07-05 17:19:14'),(18,'Frest to do',1,'2022-06-28 17:08:22','2022-07-05 17:19:19'),(21,'Something to do',1,'2022-06-28 14:27:48','2022-07-05 17:19:21'),(22,'Frest to do',1,'2022-06-28 22:40:40','2022-07-05 17:19:22'),(23,'New todo using postman',1,'2022-07-04 21:19:43','2022-07-05 17:19:24'),(26,'Another todo using postman',1,'2022-07-05 16:09:44','2022-07-05 17:19:25'),(27,'New todo using React JS front end application and updated using React JS application as well',1,'2022-07-05 17:05:55','2022-07-05 17:35:28'),(28,'New todo fresh out of the oven',1,'2022-07-05 17:21:29','2022-07-06 08:05:26'),(29,'New todo using Front End',1,'2022-07-06 08:05:20','2022-07-06 08:07:50'),(30,'Another new todo using front end',0,'2022-07-06 08:06:07','2022-07-06 08:06:07');
/*!40000 ALTER TABLE `todos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-06  8:15:20
