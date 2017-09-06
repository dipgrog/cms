CREATE DATABASE  IF NOT EXISTS `cms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cms`;
-- MySQL dump 10.13  Distrib 5.7.19, for Linux (i686)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'  JavaScript'),(2,'  BootStrap'),(3,'PHP'),(4,' CSS +');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(3) DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  `comment_author` varchar(255) DEFAULT NULL,
  `comment_content` text,
  `comment_status` varchar(25) DEFAULT NULL,
  `comment_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,'2017-08-30','John','Текст комментария','approved','dipgrog@gmail.com'),(3,3,'2017-08-30','JavaScript Name','Комментарий к третьему посту','approved','js@js.com'),(4,2,'2017-08-31','Сандра','Все хорошо!','approved','sandra@sandra.com'),(9,8,'2017-08-31','2 Check','Проверка инкремента','unapproved','check@check.com'),(10,10,'2017-09-01','Новичок','Комментарий к очередному посту часть 2','approved','new@guy.com'),(11,2,'2017-09-01','Wonder','This is text of my comment','unapproved','wonder@honey.com');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(3) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `post_content` text,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_comment_count` int(11) DEFAULT NULL,
  `post_status` varchar(45) DEFAULT 'draft',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (2,1,'Веб разработка !!!','Драгун Евгений','2017-09-03','image_5.jpg','<p>Текст второго поста про <span style=\"text-decoration: underline;\"><strong>веб</strong></span>-разработку</p>','веб, web',2,'published'),(3,1,'JavaScript','Драгун Евгений','2017-09-03','code_infographics_information__1280x800_miscellaneoushi.com.jpg','<p><strong>update</strong> Текст <em>сообщения</em> про JavaScript</p>','333 javascript update',1,'published'),(10,1,'Очередной пост Часть 2','Драгун Евгений','2017-09-03','Диагностические-работы-900х300.jpg','<p>Текст очередного поста часть вторая</p>','CSS +',0,'published'),(12,3,'Очередной пост Часть 3','Драгун Евгений','2017-09-03','','<p>Проверочный текст</p>','ывфыв',0,'draft');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_date` date DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `user_salt` varchar(255) DEFAULT '$2y$10$iusesomecrazystrings22',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (23,'u1','$1$d1/ioHUv$IqXL959cf7fAxlGxc7K9Y.',NULL,NULL,'test@test.com',NULL,NULL,'admin',''),(24,'u2','$2y$10$iusesomecrazystrings2ujW9YAJQJd3wDyapiH8/QiF3bZaEARZG',NULL,NULL,'test@test.com',NULL,NULL,'subscriber','$2y$10$iusesomecrazystrings22'),(25,'u3','$1$HYcyTt1Z$9OoygZnWMEBdsaMKSspZm1',NULL,NULL,'test@test.com',NULL,NULL,'subscriber','$2y$10$iusesomecrazystrings22'),(26,'u4','$1$zcbJImcA$5YRdQ6hudpcfnIJKYglqi1',NULL,NULL,'test@test.com',NULL,NULL,'subscriber','$2y$10$iusesomecrazystrings22'),(27,'u5','$1$sAU78NYi$UmqhTrxVV1E4LPSsiVMkO0',NULL,NULL,'test@test.com',NULL,NULL,'subscriber','$2y$10$iusesomecrazystrings22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-06 16:12:23
