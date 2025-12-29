/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: babutalk2
-- ------------------------------------------------------
-- Server version	10.6.22-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `articleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `subtitle` varchar(1000) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `statusId` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `categoryId` int(10) unsigned DEFAULT NULL,
  `authorId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `img` varchar(500) NOT NULL,
  `active` enum('1','0') DEFAULT '1',
  `topstory` enum('1','0') DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT 0,
  `publishedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`articleId`),
  UNIQUE KEY `articleId` (`articleId`),
  KEY `statusId` (`statusId`),
  KEY `categoryId` (`categoryId`),
  KEY `authorId` (`authorId`),
  KEY `userId` (`userId`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`statusId`) REFERENCES `articlestatus` (`statusId`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`),
  CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`authorId`) REFERENCES `authors` (`authorId`),
  CONSTRAINT `articles_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Hello','welcome','test','&lt;p&gt;Tesing&lt;/p&gt;',3,3,4,NULL,'hello17546036476895207fcc52d.swim.jpg()(1544fe94a95e58ad8c5bf7b335449e36).jpg','1','1',0,'2025-08-08 05:40:00','2025-08-07 21:54:07','2025-08-08 05:23:09'),(2,'Investor Identity Facilitator','Internal Quality Developer','Voluptate porro nemo.','&lt;p&gt;Internal Quality Developer&lt;/p&gt;',3,4,4,NULL,'investor_identity_facilitator1754603682689520a23d7ca.000_dancing-africa.jpg','1','0',0,'2025-08-08 05:40:00','2025-08-07 21:54:42','2025-10-04 07:08:15'),(3,'Designer Lead Identity ','Central Group Architect','Rem','&lt;p&gt;Central Group Architect&lt;/p&gt;',3,2,4,NULL,'designer_lead_identity_175463053568958987a0124.female options.jpg','1','0',0,'2025-08-08 05:51:00','2025-08-07 21:55:14','2025-10-04 07:07:25'),(4,'Regional Usability Coordinator','Global Operations Representative','Dolorem ','&lt;p&gt;Global Operations Representative&lt;/p&gt;',3,1,4,NULL,'regional_usability_coordinator1754604165689522854ed5e.female options.jpg','1','1',0,'2025-08-07 22:32:00','2025-08-07 22:02:45','2025-08-08 05:23:20'),(5,'International Metrics Officer','Investor Division Analyst','Doloremque','&lt;p&gt;Investor Division Analyst&lt;/p&gt;',3,2,4,NULL,'international_metrics_officer175460488968952559cd9ae.swim.jpg()(1544fe94a95e58ad8c5bf7b335449e36).jpg','1','1',0,'2025-08-07 22:43:00','2025-08-07 22:14:49','2025-08-08 05:23:32'),(6,'Corporate Creative Assistant','Dynamic Operations Producer','Corporate','&lt;p&gt;Dynamic Operations Producer&lt;/p&gt;',3,1,4,NULL,'corporate_creative_assistant17546051166895263cae8e5.contemporary-dance-for-beginners.jpeg','1','1',0,'2025-08-07 22:46:00','2025-08-07 22:18:36','2025-08-08 04:59:52'),(7,'The Alchemists Legacy From Ancient Mysticism to Modern Chemistry','For centuries, the figure of the alchemist has captured the human imagination—a mysterious scholar in a cluttered laboratory, surrounded by strange vessels and bubbling concoctions, tirelessly working to turn base metals into gold. While often associated with myth and magic, alchemy was a complex and multifaceted practice that laid the groundwork for modern chemistry.','culture','&lt;p&gt;&lt;strong&gt;The Great Work: Transmutation and Immortality&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;At its core, alchemy was a proto-scientific pursuit with two main goals: the transmutation of metals and the discovery of an elixir of immortality. Alchemists believed that all matter was composed of four basic elements—earth, air, fire, and water—and that by manipulating these elements, they could purify and perfect substances. The ultimate prize was the Philosopher&#039;s Stone, a mythical substance believed to be capable of transmuting lead into gold and creating the elixir of life.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;A Blend of Science, Philosophy, and Mysticism&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Unlike modern chemists who focus solely on empirical evidence, alchemists blended their experiments with philosophical, mystical, and religious beliefs. They sought not only to understand the physical world but also to achieve spiritual enlightenment. This pursuit of personal and material perfection was known as the &quot;Great Work.&quot; Their writings were often cryptic and symbolic, using allegorical language to describe chemical processes, making their knowledge a closely guarded secret.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Alchemy&#039;s Lasting Impact&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Despite its mystical origins, alchemy&#039;s legacy is undeniable. Through their relentless experimentation, alchemists developed many of the fundamental tools and techniques still used in laboratories today, such as distillation, sublimation, and filtration. They also discovered and isolated new substances and compounds. Figures like Robert Boyle, often called the &quot;father of modern chemistry,&quot; built upon the alchemical tradition, stripping away the mystical elements to establish the scientific method as we know it. Ultimately, the alchemist’s quest for gold and immortality may have failed, but their tireless work gave birth to a new science that continues to shape our world.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;',3,3,1,NULL,'the_alchemists_legacy_from_ancient_mysticism_to_modern_chemistry175620251668ad86143b03b.contemporary-dance-for-beginners.jpeg','1','0',0,'2025-08-26 10:31:00','2025-08-26 10:01:56','2025-10-04 07:07:10'),(8,'Product Quality Engineer','Regional Research Architect','Ratione quisquam ea neque cum suscipit maiores facere placeat labore.','&lt;p&gt;Regional Research Architect Regional Research Architect Regional Research Architect Regional Research Architect Regional Research Architect &lt;/p&gt;&lt;p&gt;Regional Research Architect Regional Research Architect&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Regional Research Architect Regional Research Architect Regional Research Architect Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;&lt;/p&gt;&lt;p&gt;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;ArchitectRegional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;&lt;/p&gt;&lt;p&gt;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;ArchitectRegional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;&lt;/p&gt;&lt;p&gt;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;&lt;/p&gt;&lt;p&gt;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&amp;nbsp;Regional&amp;nbsp;Research&amp;nbsp;Architect&lt;/p&gt;',3,1,32,NULL,'product_quality_engineer175955914768e0bdebb12fc.tourist-activities-in-samburu.jpg','1','1',0,'2025-10-04 06:54:00','2025-10-04 06:25:47','2025-10-04 06:26:36'),(9,' Looks like there’s a problem with your internet connection.',' Looks like there’s a problem with your internet connection.  Looks like there’s a problem with your internet connection.','culture','&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;h1&gt;Looks like there’s a problem with your internet connection.&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;',3,4,32,NULL,'_looks_like_there’s_a_problem_with_your_internet_connection.175955937968e0bed3c33b7.vascodagamapillarmalindikenya.jpg','1','0',0,'2025-10-04 06:59:00','2025-10-04 06:29:39','2025-10-04 07:06:52');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articlestatus`
--

DROP TABLE IF EXISTS `articlestatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `articlestatus` (
  `statusId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`statusId`),
  UNIQUE KEY `statusId` (`statusId`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articlestatus`
--

LOCK TABLES `articlestatus` WRITE;
/*!40000 ALTER TABLE `articlestatus` DISABLE KEYS */;
INSERT INTO `articlestatus` VALUES (1,'draft',1,'2025-08-01 14:41:17','2025-08-01 14:41:17'),(2,'submitted',1,'2025-08-01 14:41:17','2025-08-07 21:42:43'),(3,'approved',1,'2025-08-07 21:43:26','2025-08-07 21:43:26'),(4,'rejected',1,'2025-08-07 21:43:26','2025-08-07 21:43:26');
/*!40000 ALTER TABLE `articlestatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `authorId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `passreset` tinyint(4) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `vCode` int(11) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`authorId`),
  UNIQUE KEY `authorId` (`authorId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'msyokar@gmail.com',254715003414,'joshua',NULL,NULL,NULL,'$2y$10$vQNaUk2Mbp6uHHh47Ar55eAnZO6c1lkCBH1XigJR8xGtc0JUT2.TG',980806,1,'2025-08-01 18:24:28','2025-08-01 18:24:28'),(2,'nancy@techxal.com',254741738339,'Nancy',NULL,NULL,NULL,'$2y$10$tt2lyNfnn9F5i39kUvKt1OiAQagH33kaumWcfMJeIzuG6nQ3ZnsFq',161685,1,'2025-08-04 19:48:54','2025-08-04 19:48:54'),(4,'your.email+fakedata36729@gmail.com',254756116116,'Blaise Rippin',NULL,NULL,NULL,'$2y$10$Zu3r1ez4VyxhhmGB8Hq/c.lT3jXArWcdk817TwiEOuBfooC5aCo.e',717332,1,'2025-08-04 20:01:51','2025-08-04 20:01:51'),(32,'joshua@techxal.com',254115242477,'joshua',NULL,1,NULL,'$2y$10$iVEQfiQPF6.EeCjqmRbahOdcGzN.TUhNOR05rHRzfMNlfi6gKArtu',650811,1,'2025-10-03 07:14:56','2025-10-03 07:15:58');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `categoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `descrp` varchar(1000) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`categoryId`),
  UNIQUE KEY `categoryId` (`categoryId`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'sports',NULL,1,'2025-08-01 14:42:29','2025-08-01 14:42:29'),(2,'religion',NULL,1,'2025-08-01 14:42:29','2025-08-01 14:42:29'),(3,'culture',NULL,1,'2025-08-01 14:42:29','2025-08-01 14:42:29'),(4,'marriage',NULL,1,'2025-08-01 14:42:29','2025-08-01 14:42:29');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customerId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `passreset` tinyint(4) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `vCode` int(11) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT 0,
  `userId` int(10) unsigned DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`customerId`),
  UNIQUE KEY `customerId` (`customerId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `userId` (`userId`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (30,NULL,254715003414,NULL,NULL,NULL,1,NULL,NULL,1,NULL,'2025-08-03 13:33:02','2025-08-03 13:33:02'),(31,NULL,254715003415,NULL,NULL,NULL,1,NULL,NULL,1,NULL,'2025-08-03 13:36:27','2025-08-03 13:36:27'),(32,NULL,254715003411,NULL,NULL,NULL,1,'$2y$10$1SzSnVBp27I7SSG7pzuWPO90jdVOJ8A4XBMZsZicMeECxkRdo4cSe',NULL,1,NULL,'2025-08-03 13:42:06','2025-08-03 13:42:06'),(33,NULL,254715003412,NULL,NULL,NULL,1,'$2y$10$O6M4eVS/OafFcdkkVnckmOZPjc0LQEfoC7N1Um7yyvqCsrT0MzG6C',NULL,1,NULL,'2025-08-03 13:43:12','2025-08-03 13:43:12'),(34,'your.email+fakedata72421@gmail.com',NULL,'Chaz Keebler',NULL,NULL,NULL,'$2y$10$RvNfeHOXsrpQYw0F.GUliu4juBwXldBT7z7AbhJ091kSbnKW6OukK',980271,1,NULL,'2025-08-03 14:44:13','2025-08-03 14:44:13'),(35,'your.email+fakedata83875@gmail.com',NULL,'Leora Dare',NULL,NULL,NULL,'$2y$10$7vdEFMQgwp22mUkzplF/Ie421yBzi560uM1C16gm6gShxbZ00dWZy',NULL,1,NULL,'2025-08-03 14:45:23','2025-08-03 14:45:23'),(36,'your.email+fakedata61052@gmail.com',NULL,'Geo Franecki',NULL,NULL,NULL,'$2y$10$LQSExMgSFG7blkdqHGfpYOfhkmRpHO35IidOxyzh0N81zZF/H.C5O',300418,1,NULL,'2025-08-03 14:46:20','2025-08-03 14:46:20'),(37,'your.email+fakedata24371@gmail.com',254716667923,'Roberto Erdman',NULL,NULL,NULL,'$2y$10$n.Y3Yfy705TyL6DEC8lvQOj.irwJSxbxsbJQ/6NxNmKzVPVYpCO7a',709582,1,NULL,'2025-08-04 20:09:14','2025-08-04 20:09:14');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `newletterId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `userId` int(10) unsigned DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`newletterId`),
  UNIQUE KEY `newletterId` (`newletterId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `userId` (`userId`),
  CONSTRAINT `newsletters_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
INSERT INTO `newsletters` VALUES (1,'msyokar@gmail.com',NULL,1,NULL,'2025-08-03 07:30:59','2025-08-03 07:30:59'),(3,'joshua@gmail.com',NULL,1,NULL,'2025-08-03 07:33:11','2025-08-03 07:33:11'),(4,'joshua1@gmail.com',NULL,1,NULL,'2025-08-03 07:34:46','2025-08-03 07:34:46'),(5,'joshua@techxal.com',NULL,1,NULL,'2025-08-03 07:37:22','2025-08-03 07:37:22'),(6,'joshua2@techxal.com',NULL,1,NULL,'2025-08-03 07:37:31','2025-08-03 07:37:31'),(7,NULL,254715003414,1,NULL,'2025-08-03 09:06:26','2025-08-03 09:06:26');
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentmode`
--

DROP TABLE IF EXISTS `paymentmode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `paymentmode` (
  `modeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mode` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`modeId`),
  UNIQUE KEY `modeId` (`modeId`),
  UNIQUE KEY `mode` (`mode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentmode`
--

LOCK TABLES `paymentmode` WRITE;
/*!40000 ALTER TABLE `paymentmode` DISABLE KEYS */;
INSERT INTO `paymentmode` VALUES (1,'mpesa','2025-08-03 10:06:15','2025-08-03 10:06:15');
/*!40000 ALTER TABLE `paymentmode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `paymentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `modeId` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `statusId` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `userId` int(10) unsigned DEFAULT NULL,
  `customerId` int(10) unsigned DEFAULT NULL,
  `subscriptionId` int(10) unsigned DEFAULT NULL,
  `amount` double unsigned NOT NULL DEFAULT 0,
  `phone` varchar(100) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `MerchantRequestID` varchar(255) DEFAULT NULL,
  `CheckoutRequestID` varchar(255) DEFAULT NULL,
  `ResponseCode` varchar(255) DEFAULT NULL,
  `ResponseDescription` varchar(255) DEFAULT NULL,
  `thirdpartyTime` timestamp NULL DEFAULT NULL,
  `descrp` varchar(500) DEFAULT NULL,
  `posted` enum('1','0') DEFAULT '0',
  `posteddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`paymentId`),
  UNIQUE KEY `paymentId` (`paymentId`),
  UNIQUE KEY `modeId` (`modeId`,`reference`),
  KEY `statusId` (`statusId`),
  KEY `subscriptionId` (`subscriptionId`),
  KEY `customerId` (`customerId`),
  KEY `userId` (`userId`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`modeId`) REFERENCES `paymentmode` (`modeId`),
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `paymentstatus` (`statusId`),
  CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`subscriptionId`) REFERENCES `subscriptions` (`id`),
  CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`),
  CONSTRAINT `payments_ibfk_5` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (8,NULL,NULL,NULL,1,2,NULL,33,26,50,'254715003412',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 13:50:34','2025-08-03 13:50:34','2025-08-03 13:50:34'),(9,NULL,NULL,NULL,1,2,NULL,33,27,50,'254715003412',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 13:56:52','2025-08-03 13:56:52','2025-08-03 13:56:52'),(10,NULL,NULL,NULL,1,2,NULL,33,28,50,'254715003412',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:06:27','2025-08-03 14:06:27','2025-08-03 14:06:27'),(11,NULL,NULL,NULL,1,2,NULL,33,29,50,'254715003412',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:07:35','2025-08-03 14:07:35','2025-08-03 14:07:35'),(12,NULL,NULL,NULL,1,2,NULL,30,30,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:07:47','2025-08-03 14:07:47','2025-08-03 14:07:47'),(13,NULL,NULL,NULL,1,2,NULL,30,31,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:08:29','2025-08-03 14:08:29','2025-08-03 14:08:29'),(14,NULL,NULL,NULL,1,2,NULL,30,32,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:09:58','2025-08-03 14:09:58','2025-08-03 14:09:58'),(15,NULL,NULL,NULL,1,2,NULL,30,33,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:10:35','2025-08-03 14:10:35','2025-08-03 14:10:35'),(16,NULL,NULL,NULL,1,2,NULL,30,34,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:11:14','2025-08-03 14:11:14','2025-08-03 14:11:14'),(17,NULL,NULL,NULL,1,2,NULL,30,35,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:13:30','2025-08-03 14:13:30','2025-08-03 14:13:30'),(18,NULL,NULL,NULL,1,2,NULL,30,36,50,'254715003414',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2025-08-03 14:19:37','2025-08-03 14:19:37','2025-08-03 14:19:37'),(19,NULL,NULL,NULL,1,2,NULL,30,37,50,'254715003414',NULL,'f185-48f9-8519-7a79dedfd7412545313','ws_CO_1754230901384715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:21:41','2025-08-03 14:21:41','2025-08-03 14:21:41'),(20,NULL,NULL,NULL,1,2,NULL,30,38,50,'254715003414',NULL,'15f0-4de2-8443-b007f249d8c23856642','ws_CO_1754231149939715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:25:49','2025-08-03 14:25:49','2025-08-03 14:25:50'),(21,NULL,NULL,NULL,1,2,NULL,30,39,20,'254715003414',NULL,'f185-48f9-8519-7a79dedfd7412559996','ws_CO_1754231194266715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:26:34','2025-08-03 14:26:34','2025-08-03 14:26:35'),(22,NULL,NULL,NULL,1,2,NULL,30,40,20,'254715003414',NULL,'7986-42b4-afaa-21a08f7aefcc2445785','ws_CO_1754231476451715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:31:16','2025-08-03 14:31:16','2025-08-03 14:31:16'),(23,NULL,NULL,NULL,1,2,NULL,30,41,50,'254715003414',NULL,'35d9-4bc7-aff6-c0248c80e4c62448798','ws_CO_1754231797877715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:36:37','2025-08-03 14:36:37','2025-08-03 14:36:38'),(24,NULL,NULL,NULL,1,2,NULL,30,42,20,'254715003414',NULL,'35d9-4bc7-aff6-c0248c80e4c62449970','ws_CO_1754231820940715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:37:00','2025-08-03 14:37:00','2025-08-03 14:37:01'),(25,NULL,NULL,NULL,1,2,NULL,30,43,20,'254715003414',NULL,'79f6-4ea4-8830-0888f9cee8665119966','ws_CO_1754231900909715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:38:20','2025-08-03 14:38:20','2025-08-03 14:38:21'),(26,NULL,NULL,NULL,1,2,NULL,30,44,800,'254715003414',NULL,'ea02-43d5-9274-63b6808514265169127','ws_CO_1754231982379715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:39:42','2025-08-03 14:39:42','2025-08-03 14:39:43'),(27,NULL,NULL,NULL,1,2,NULL,30,45,20,'254715003414',NULL,'7986-42b4-afaa-21a08f7aefcc2475278','ws_CO_1754232039947715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:40:39','2025-08-03 14:40:39','2025-08-03 14:40:40'),(28,NULL,NULL,NULL,1,2,NULL,30,46,20,'254715003414',NULL,'9869-4fdb-b8a7-33f322afac118008705','ws_CO_1754232082545715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:41:22','2025-08-03 14:41:22','2025-08-03 14:41:23'),(29,NULL,NULL,NULL,1,2,NULL,30,47,100,'254715003414',NULL,'ea66-4aec-aee2-bf5fce9fd750974134','ws_CO_1754232200530715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:43:20','2025-08-03 14:43:20','2025-08-03 14:43:20'),(30,NULL,NULL,NULL,1,2,NULL,30,48,100,'254715003414',NULL,'ea02-43d5-9274-63b6808514265179249','ws_CO_1754232474019715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:47:53','2025-08-03 14:47:53','2025-08-03 14:47:54'),(31,NULL,NULL,NULL,1,2,NULL,30,49,50,'254715003414',NULL,'7986-42b4-afaa-21a08f7aefcc2500475','ws_CO_1754232513800715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:48:33','2025-08-03 14:48:33','2025-08-03 14:48:34'),(32,NULL,NULL,NULL,1,2,NULL,30,50,50,'254715003414',NULL,'79f6-4ea4-8830-0888f9cee8665134608','ws_CO_1754232612025715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:50:11','2025-08-03 14:50:11','2025-08-03 14:50:12'),(33,NULL,NULL,NULL,1,2,NULL,30,51,20,'254715003414',NULL,'8443-47d8-9afb-702b0a2be12c2564835','ws_CO_1754232710230715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:51:50','2025-08-03 14:51:50','2025-08-03 14:51:50'),(34,NULL,NULL,NULL,1,2,NULL,30,52,20,'254715003414',NULL,'ea02-43d5-9274-63b6808514265184069','ws_CO_1754232712771715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:51:52','2025-08-03 14:51:52','2025-08-03 14:51:53'),(35,NULL,NULL,NULL,1,2,NULL,30,53,20,'254715003414',NULL,'1c11-4565-835b-22f89975f3f41136243','ws_CO_1754232782126715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:53:01','2025-08-03 14:53:01','2025-08-03 14:53:02'),(36,NULL,NULL,NULL,1,2,NULL,30,54,20,'254715003414',NULL,'ea66-4aec-aee2-bf5fce9fd750987386','ws_CO_1754232843821715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:54:03','2025-08-03 14:54:03','2025-08-03 14:54:04'),(37,NULL,NULL,NULL,1,2,NULL,30,55,20,'254715003414',NULL,'4a0a-40ec-ae7e-ce8c11f3256b942711','ws_CO_1754232899738715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:54:59','2025-08-03 14:54:59','2025-08-03 14:55:00'),(38,NULL,NULL,NULL,1,2,NULL,30,56,20,'254715003414',NULL,'1c11-4565-835b-22f89975f3f41141039','ws_CO_1754233015558715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:56:55','2025-08-03 14:56:55','2025-08-03 14:56:55'),(39,NULL,NULL,NULL,1,2,NULL,30,57,20,'254715003414',NULL,'f185-48f9-8519-7a79dedfd7412661087','ws_CO_1754233103146715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 14:58:22','2025-08-03 14:58:22','2025-08-03 14:58:23'),(40,NULL,NULL,NULL,1,2,NULL,30,58,20,'254715003414',NULL,'15f0-4de2-8443-b007f249d8c23908215','ws_CO_1754233620555715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 15:07:00','2025-08-03 15:07:00','2025-08-03 15:07:01'),(41,NULL,NULL,NULL,1,2,NULL,30,59,50,'254715003414',NULL,'7986-42b4-afaa-21a08f7aefcc2568958','ws_CO_1754233781151715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 15:09:41','2025-08-03 15:09:41','2025-08-03 15:09:41'),(42,NULL,NULL,NULL,1,2,NULL,30,60,20,'254715003414',NULL,'59d5-4d06-be2e-1e850e5071fa1011033','ws_CO_1754233820290715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 15:10:20','2025-08-03 15:10:20','2025-08-03 15:10:20'),(43,NULL,NULL,NULL,1,2,NULL,30,61,20,'254715003414',NULL,'f185-48f9-8519-7a79dedfd7412709107','ws_CO_1754233993480715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 15:13:13','2025-08-03 15:13:13','2025-08-03 15:13:13'),(44,NULL,NULL,NULL,1,2,NULL,30,62,800,'254715003414',NULL,'ea66-4aec-aee2-bf5fce9fd7501012621','ws_CO_1754234044092715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-03 15:14:03','2025-08-03 15:14:03','2025-08-03 15:14:04'),(45,NULL,NULL,NULL,1,2,NULL,30,63,20,'254715003414',NULL,'35d9-4bc7-aff6-c0248c80e4c65235541','ws_CO_1754308951441715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-04 12:02:31','2025-08-04 12:02:31','2025-08-04 12:02:31'),(46,NULL,NULL,NULL,1,2,NULL,30,64,100,'254715003414',NULL,'1c11-4565-835b-22f89975f3f43473014','ws_CO_1754348532759715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-04 23:02:12','2025-08-04 23:02:12','2025-08-04 23:02:12'),(47,NULL,NULL,NULL,1,2,NULL,30,65,20,'254715003414',NULL,'6a55-4014-abeb-75b3c2a453946437257','ws_CO_260820251223515715003414',NULL,'Success. Request accepted for processing',NULL,NULL,'0','2025-08-26 09:23:51','2025-08-26 09:23:51','2025-08-26 09:23:52');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentstatus`
--

DROP TABLE IF EXISTS `paymentstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `paymentstatus` (
  `statusId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`statusId`),
  UNIQUE KEY `statusId` (`statusId`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentstatus`
--

LOCK TABLES `paymentstatus` WRITE;
/*!40000 ALTER TABLE `paymentstatus` DISABLE KEYS */;
INSERT INTO `paymentstatus` VALUES (1,'pending','2024-02-22 05:46:25','2024-02-22 05:46:25'),(2,'processing','2024-02-22 05:46:25','2024-02-22 05:46:25'),(3,'approved','2024-02-22 05:46:25','2024-02-22 05:46:25'),(4,'rejected','2024-02-22 05:46:25','2024-02-22 05:46:25'),(5,'cancelled','2024-02-22 05:46:25','2024-02-22 05:46:25'),(6,'insufficient','2024-07-09 08:08:00','2025-02-14 04:23:48');
/*!40000 ALTER TABLE `paymentstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `planId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `plan` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `preferred` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `duration` int(10) unsigned NOT NULL DEFAULT 1,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`planId`),
  UNIQUE KEY `planId` (`planId`),
  UNIQUE KEY `plan` (`plan`),
  UNIQUE KEY `unit` (`unit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'daily','day',0,1,20.00,'2025-08-03 10:02:24','2025-08-03 10:02:24'),(2,'weekly','week',0,7,100.00,'2025-08-03 10:02:24','2025-08-03 10:02:24'),(3,'monthly','month',1,30,50.00,'2025-08-03 10:02:24','2025-08-03 10:02:24'),(4,'annually','year',0,365,800.00,'2025-08-03 10:02:24','2025-08-03 10:02:24');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` int(10) unsigned NOT NULL,
  `statusId` tinyint(3) unsigned NOT NULL,
  `planId` tinyint(3) unsigned NOT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `periodStart` datetime NOT NULL,
  `periodEnd` datetime NOT NULL,
  `cancelledAt` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customerId` (`customerId`),
  KEY `statusId` (`statusId`),
  KEY `planId` (`planId`),
  KEY `userId` (`userId`),
  CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`),
  CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `subscriptionstatus` (`statusId`),
  CONSTRAINT `subscriptions_ibfk_3` FOREIGN KEY (`planId`) REFERENCES `plans` (`planId`),
  CONSTRAINT `subscriptions_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (26,33,1,3,NULL,'2025-08-03 16:50:34','2025-09-02 16:50:34',NULL,'2025-08-03 13:50:34','2025-08-03 13:50:34'),(27,33,1,3,NULL,'2025-08-03 16:56:52','2025-09-02 16:56:52',NULL,'2025-08-03 13:56:52','2025-08-03 13:56:52'),(28,33,1,3,NULL,'2025-08-03 17:06:27','2025-09-02 17:06:27',NULL,'2025-08-03 14:06:27','2025-08-03 14:06:27'),(29,33,1,3,NULL,'2025-08-03 17:07:35','2025-09-02 17:07:35',NULL,'2025-08-03 14:07:35','2025-08-03 14:07:35'),(30,30,1,3,NULL,'2025-08-03 17:07:47','2025-09-02 17:07:47',NULL,'2025-08-03 14:07:47','2025-08-03 14:07:47'),(31,30,1,3,NULL,'2025-08-03 17:08:29','2025-09-02 17:08:29',NULL,'2025-08-03 14:08:29','2025-08-03 14:08:29'),(32,30,1,3,NULL,'2025-08-03 17:09:58','2025-09-02 17:09:58',NULL,'2025-08-03 14:09:58','2025-08-03 14:09:58'),(33,30,1,3,NULL,'2025-08-03 17:10:35','2025-09-02 17:10:35',NULL,'2025-08-03 14:10:35','2025-08-03 14:10:35'),(34,30,1,3,NULL,'2025-08-03 17:11:14','2025-09-02 17:11:14',NULL,'2025-08-03 14:11:14','2025-08-03 14:11:14'),(35,30,1,3,NULL,'2025-08-03 17:13:30','2025-09-02 17:13:30',NULL,'2025-08-03 14:13:30','2025-08-03 14:13:30'),(36,30,1,3,NULL,'2025-08-03 17:19:37','2025-09-02 17:19:37',NULL,'2025-08-03 14:19:37','2025-08-03 14:19:37'),(37,30,1,3,NULL,'2025-08-03 17:21:41','2025-09-02 17:21:41',NULL,'2025-08-03 14:21:41','2025-08-03 14:21:41'),(38,30,1,3,NULL,'2025-08-03 17:25:49','2025-09-02 17:25:49',NULL,'2025-08-03 14:25:49','2025-08-03 14:25:49'),(39,30,1,1,NULL,'2025-08-03 17:26:34','2025-08-04 17:26:34',NULL,'2025-08-03 14:26:34','2025-08-03 14:26:34'),(40,30,1,1,NULL,'2025-08-03 17:31:16','2025-08-04 17:31:16',NULL,'2025-08-03 14:31:16','2025-08-03 14:31:16'),(41,30,1,3,NULL,'2025-08-03 17:36:37','2025-09-02 17:36:37',NULL,'2025-08-03 14:36:37','2025-08-03 14:36:37'),(42,30,1,1,NULL,'2025-08-03 17:37:00','2025-08-04 17:37:00',NULL,'2025-08-03 14:37:00','2025-08-03 14:37:00'),(43,30,1,1,NULL,'2025-08-03 17:38:20','2025-08-04 17:38:20',NULL,'2025-08-03 14:38:20','2025-08-03 14:38:20'),(44,30,1,4,NULL,'2025-08-03 17:39:42','2026-08-03 17:39:42',NULL,'2025-08-03 14:39:42','2025-08-03 14:39:42'),(45,30,1,1,NULL,'2025-08-03 17:40:39','2025-08-04 17:40:39',NULL,'2025-08-03 14:40:39','2025-08-03 14:40:39'),(46,30,1,1,NULL,'2025-08-03 17:41:22','2025-08-04 17:41:22',NULL,'2025-08-03 14:41:22','2025-08-03 14:41:22'),(47,30,1,2,NULL,'2025-08-03 17:43:20','2025-08-10 17:43:20',NULL,'2025-08-03 14:43:20','2025-08-03 14:43:20'),(48,30,1,2,NULL,'2025-08-03 17:47:53','2025-08-10 17:47:53',NULL,'2025-08-03 14:47:53','2025-08-03 14:47:53'),(49,30,1,3,NULL,'2025-08-03 17:48:33','2025-09-02 17:48:33',NULL,'2025-08-03 14:48:33','2025-08-03 14:48:33'),(50,30,1,3,NULL,'2025-08-03 17:50:11','2025-09-02 17:50:11',NULL,'2025-08-03 14:50:11','2025-08-03 14:50:11'),(51,30,1,1,NULL,'2025-08-03 17:51:50','2025-08-04 17:51:50',NULL,'2025-08-03 14:51:50','2025-08-03 14:51:50'),(52,30,1,1,NULL,'2025-08-03 17:51:52','2025-08-04 17:51:52',NULL,'2025-08-03 14:51:52','2025-08-03 14:51:52'),(53,30,1,1,NULL,'2025-08-03 17:53:01','2025-08-04 17:53:01',NULL,'2025-08-03 14:53:01','2025-08-03 14:53:01'),(54,30,1,1,NULL,'2025-08-03 17:54:03','2025-08-04 17:54:03',NULL,'2025-08-03 14:54:03','2025-08-03 14:54:03'),(55,30,1,1,NULL,'2025-08-03 17:54:59','2025-08-04 17:54:59',NULL,'2025-08-03 14:54:59','2025-08-03 14:54:59'),(56,30,1,1,NULL,'2025-08-03 17:56:55','2025-08-04 17:56:55',NULL,'2025-08-03 14:56:55','2025-08-03 14:56:55'),(57,30,1,1,NULL,'2025-08-03 17:58:22','2025-08-04 17:58:22',NULL,'2025-08-03 14:58:22','2025-08-03 14:58:22'),(58,30,1,1,NULL,'2025-08-03 18:07:00','2025-08-04 18:07:00',NULL,'2025-08-03 15:07:00','2025-08-03 15:07:00'),(59,30,1,3,NULL,'2025-08-03 18:09:41','2025-09-02 18:09:41',NULL,'2025-08-03 15:09:41','2025-08-03 15:09:41'),(60,30,1,1,NULL,'2025-08-03 18:10:20','2025-08-04 18:10:20',NULL,'2025-08-03 15:10:20','2025-08-03 15:10:20'),(61,30,1,1,NULL,'2025-08-03 18:13:13','2025-08-04 18:13:13',NULL,'2025-08-03 15:13:13','2025-08-03 15:13:13'),(62,30,1,4,NULL,'2025-08-03 18:14:03','2026-08-03 18:14:03',NULL,'2025-08-03 15:14:03','2025-08-03 15:14:03'),(63,30,1,1,NULL,'2025-08-04 15:02:31','2025-08-05 15:02:31',NULL,'2025-08-04 12:02:31','2025-08-04 12:02:31'),(64,30,1,2,NULL,'2025-08-05 02:02:12','2025-08-12 02:02:12',NULL,'2025-08-04 23:02:12','2025-08-04 23:02:12'),(65,30,1,1,NULL,'2025-08-26 12:23:51','2025-08-27 12:23:51',NULL,'2025-08-26 09:23:51','2025-08-26 09:23:51');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptionstatus`
--

DROP TABLE IF EXISTS `subscriptionstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptionstatus` (
  `statusId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`statusId`),
  UNIQUE KEY `statusId` (`statusId`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptionstatus`
--

LOCK TABLES `subscriptionstatus` WRITE;
/*!40000 ALTER TABLE `subscriptionstatus` DISABLE KEYS */;
INSERT INTO `subscriptionstatus` VALUES (1,'pending','2025-08-03 10:04:30','2025-08-03 13:41:01'),(2,'active','2025-08-03 10:04:30','2025-08-03 10:04:30'),(3,'past due','2025-08-03 10:04:30','2025-08-03 10:04:30'),(4,'cancelled','2025-08-03 10:04:30','2025-08-03 10:04:30'),(5,'expired','2025-08-03 10:04:30','2025-08-03 10:04:30');
/*!40000 ALTER TABLE `subscriptionstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `passreset` tinyint(4) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `vCode` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'joshua@techxal.com',254715003414,'joshua','musyoka',1,NULL,'$2y$10$QhvaU7d7qpW72PDMygMLnu0bd.WKzOG8CPl72XAMziFTVtWo65wUK',NULL,'2025-08-01 08:10:59','2025-08-26 09:18:58'),(2,'msyokar@gmail.com',254115242477,'joshua',NULL,NULL,1,'$2y$10$./vvOdLXvu7XTNPOMSYE0eo67vt.1zIaPk/wNwZsnxBbU1C5El2LK',172478,'2025-08-01 11:10:05','2025-08-08 20:21:03'),(3,'sakongkirui@gmail.com',254722636396,'sakong',NULL,NULL,NULL,'$2y$10$/GjlT9shDTFZx3whWS0D/uZlu5M151I923TZl9Ey8vmRTleWBJVSe',316115,'2025-08-01 11:10:41','2025-08-08 21:17:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'babutalk2'
--

--
-- Dumping routines for database 'babutalk2'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP FUNCTION IF EXISTS `ValidString` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` FUNCTION `ValidString`(input VARCHAR(1000)) RETURNS varchar(1000) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    SQL SECURITY INVOKER
BEGIN
	RETURN CASE WHEN input IN ('0', '', 'null') THEN NULL ELSE input END;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ARTICLE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ARTICLE`( 
	IN inAction INT, 
	IN inArticleId INT,
	IN inAuthorId INT,
	IN inUserId INT,
	IN inCustomerId INT,
	IN inCategoryId INT,
	IN inTitle VARCHAR(1000),
	IN inSubTitle VARCHAR(1000),
	IN inContent LONGTEXT, 
	IN inTags VARCHAR(500),
	IN inImg VARCHAR(500), 
	IN inStatusId INT,
	IN inTopStory INT,
    IN inPublishedAt DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN 

	DECLARE dImg VARCHAR(255) DEFAULT NULL;

	CASE inAction
		-- list of categories
        WHEN 1 THEN
			SELECT categoryId,title FROM categories ORDER BY title LIMIT 20;
			LEAVE PROC;
         
		-- new article
        WHEN 2 THEN
            SET inTitle = ValidString(inTitle);
            SET inSubTitle = ValidString(inSubTitle);
            SET inImg = ValidString(inImg);
            SET inTitle = ValidString(inTitle);
            
            INSERT INTO articles(title,subtitle,tags,content,statusId,topstory,categoryId,authorId,img,publishedAt)
            VALUE(inTitle,inSubTitle,inTags,inContent,inStatusId,cast(inTopStory as char),inCategoryId,inAuthorId,inImg,inPublishedAt);

            SELECT ROW_COUNT() created, LAST_INSERT_ID() articleId;
			LEAVE PROC;
            
		-- list of articles
        WHEN 3 THEN -- select inPublished;
			SELECT a.articleId, a.title, a.subtitle, a.topstory, a.tags, a.img, c.categoryId, c.title category, s.statusId, 
				s.status, a.publishedAt, a.createdAt, au.authorId, au.fname, au.lname
			FROM articles a
			JOIN articlestatus s ON s.statusId = a.statusId
			JOIN categories c ON c.categoryId = a.categoryId
            JOIN authors au ON au.authorId = a.authorId
            WHERE
				case
					when inTopStory = 1 then a.topstory = '1'
					when inTopStory = 0 then a.topstory = '0'
					else 1 = 1
				end
                AND (inCategoryId is null or c.categoryId = inCategoryId)
                AND (inArticleId is null or a.articleId <> inArticleId)
                AND (inAuthorId is null or a.authorId = inAuthorId)
                AND (inStatusId is null or a.statusId = inStatusId)
            ORDER BY
				a.publishedAt DESC, a.articleId
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- article detail
        WHEN 4 THEN
			SELECT a.articleId, a.title, a.subtitle, a.topstory, a.tags, a.img, a.content, c.categoryId, c.title category, s.statusId, 
				s.status, a.publishedAt, a.createdAt, au.authorId, au.fname
			FROM articles a
			JOIN articlestatus s ON s.statusId = a.statusId
			JOIN categories c ON c.categoryId = a.categoryId
            JOIN authors au ON au.authorId = a.authorId
            WHERE
				a.articleId = inArticleId
                AND (inAuthorId is null or a.authorId = inAuthorId)
                AND (inStatusId is null or a.statusId = inStatusId)
			LIMIT 1;
			LEAVE PROC;
            
		-- update article
        WHEN 5 THEN
            SET inTitle = ValidString(inTitle);
            SET inSubTitle = ValidString(inSubTitle);
            SET inImg = ValidString(inImg);
            SET inTitle = ValidString(inTitle);
            
            SELECT img INTO dImg FROM articles WHERE articleId = inArticleId AND authorId = inAuthorId;
            
			UPDATE articles
			SET 
				title = inTitle,
				subtitle = inSubTitle,
				tags = inTags,
				content = inContent,
				statusId = inStatusId,
				topstory = CAST(inTopStory AS CHAR),
				categoryId = inCategoryId,
				img = IF(inImg = '' OR inImg IS NULL, img, inImg),
				publishedAt = inPublishedAt
				-- active = CAST(inPublished AS CHAR)
			WHERE
				articleId = inArticleId
				AND authorId = inAuthorId;
				-- AND active = '0';
                
            SELECT ROW_COUNT() updated, dImg oldImg;
			LEAVE PROC; 
            
		-- approve
        WHEN 6 THEN -- select CAST(inTopStory AS CHAR), inArticleId; leave proc;
			UPDATE articles SET 
				topstory = CAST(inTopStory AS CHAR), 
                statusId = inStatusId
            WHERE 
				articleId = inArticleId;
                -- and statusId = 2;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
        
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `AUTHORS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AUTHORS`(
	IN inAction INT, 
	IN inAuthorId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255), 
	IN inCode INT,
    IN inTypeId INT,
	IN inRoleId INT,
	IN inAdminId INT,
    IN inPassExpire DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dPhone,dEmail,dFname VARCHAR(255) DEFAULT NULL;
	DECLARE dCode,dAuthorId INT DEFAULT NULL;
    -- DECLARE dTime DATETIME DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;     

	CASE inAction
		-- login
        WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
			SELECT authorId, email, phone, fname, active, pass
			FROM authors
			WHERE
				(email = inEmail
				OR phone = inPhone)
                AND verified = 1
			LIMIT 1; 
			LEAVE PROC;
            
		-- register
        WHEN 2 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
			SET inFname = ValidString(inFname);
			SET inLname = ValidString(inLname);
			SET inPass = ValidString(inPass);
            
			INSERT INTO authors(email,phone,fname,lname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inLname,inPass,inCode);      
            
            SELECT ROW_COUNT() created, LAST_INSERT_ID() authorId;
			LEAVE PROC;
            
		-- update author forgotten password
        WHEN 3 THEN
            SET inEmail = ValidString(inEmail);
            SELECT fname INTO inFname FROM authors WHERE email = inEmail;

			UPDATE authors SET passreset = 1, vCode = inCode
            WHERE
				email = inEmail;
			SELECT ROW_COUNT() updated, inFname fname;
			LEAVE PROC;
            
		-- update authors password
        WHEN 4 THEN
            -- SET inCode = ValidString(inCode);      
			UPDATE authors SET passreset = null, vcode = null, pass = inPass
            WHERE
				userId = inUserId
                AND passreset = 1
                AND vcode = inCode;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
		-- authors
        WHEN 5 THEN
			SELECT authorId, email, phone, fname, lname, active, verified, created
            FROM authors
            ORDER BY created DESC
            LIMIT inStart, inLimit;
			LEAVE PROC;
            
		-- verify author
        WHEN 6 THEN
			UPDATE authors SET active = 1, verified = 1 
            WHERE 
				vCode = inCode
                AND phone = inPhone
                AND email = inEmail;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;

		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CUSTOMER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CUSTOMER`(
	IN inAction INT,
	IN inCustomerId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255),
	IN inCode VARCHAR(255),
	IN inUserId INT,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dCustomerId INT DEFAULT NULL;  
    DECLARE dPhone,dEmail VARCHAR(255) DEFAULT NULL;

	CASE inAction
		-- create customer		
		WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
            SELECT customerId INTO dCustomerId FROM customers WHERE phone = inPhone or email = inEmail;
            
			IF NOT ISNULL(dCustomerId) THEN
				SELECT email INTO dEmail FROM customers WHERE email = inEmail;
				SELECT phone INTO dPhone FROM customers WHERE phone = inPhone;
				SELECT 'The customer already exists' message, dPhone phone, dEmail email, 0 created, dCustomerId customerId;
				LEAVE PROC;
            END IF;

            SET inFname = ValidString(inFname);
            SET inPass = ValidString(inPass);

			INSERT INTO customers(email,phone,fname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inPass,inCode);
            
			SELECT LAST_INSERT_ID() customerId, ROW_COUNT() updated;
                
            LEAVE PROC;
            
		-- login
        WHEN 2 THEN
			SELECT customerId, email, phone, fname, pass 
            FROM 
				customers
			WHERE
				(email = ValidString(inEmail)
                OR phone = ValidString(inPhone))
                AND verified = 1
			LIMIT 1;
			LEAVE PROC;
            
		-- new letters
        WHEN 3 THEN
			SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
            /*INSERT INTO newsletters(email,phone) 
            VALUE(inEmail,inPhone)
            ON DUPLICATE KEY UPDATE
				email = VALUES(email),
				phone = VALUES(phone),
				id = id + 0;*/
                
			IF EXISTS (
				SELECT 1 FROM newsletters WHERE email = inEmail OR phone = inPhone
			) THEN
				SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'Duplicate email or phone number';
			ELSE
				INSERT INTO newsletters(email, phone) VALUES (inEmail, inPhone);
                SELECT LAST_INSERT_ID() id, ROW_COUNT() created;
			END IF;
			LEAVE PROC;
            
		-- plans
		WHEN 4 THEN
			SELECT planId,plan,unit,preferred,price FROM plans; 
			LEAVE PROC;
            
		-- customers
        WHEN 5 THEN
			SELECT customerId, email, phone, fname, lname, verified, passreset, created
			FROM customers
            ORDER BY created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- subscriptions
        WHEN 6 THEN
			SELECT s.id, s.periodStart, s.periodEnd, s.created, p.planId, p.plan, p.price, c.customerId, c.fname, c.lname, ss.statusId, ss.status
			FROM subscriptions s
			JOIN plans p ON p.planId = s.planId
			JOIN customers c ON c.customerId = s.customerId
			JOIN subscriptionstatus ss ON ss.statusId = s.statusId
			ORDER BY s.created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- news letters
        WHEN 7 THEN
			SELECT newletterId, email, phone, active, created
			FROM newsletters
            ORDER BY created DESC
            LIMIT inStart,inLimit;
			LEAVE PROC;
            
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PAYMENT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PAYMENT`(
	IN inAction INT,
	IN inPaymentId INT,
	IN inPlanId INT, 
	IN inSubId INT, 
	IN inCustomerId INT,
	IN inUserId INT,
	IN inPhone BIGINT,
	IN inAmount DOUBLE,
	IN inFname VARCHAR(250),
	IN inMname VARCHAR(250),
	IN inLname VARCHAR(250),
	IN inPass VARCHAR(250),
	IN inReference VARCHAR(100),
	IN inMerchantReqId VARCHAR(100),
	IN inCheckoutReqId VARCHAR(100),
	IN inModeId INT,
	IN inStatusId INT,
	IN inPosted TINYINT,
	IN inDescrp VARCHAR(1000),
	IN inThirdpartyDate DATETIME,
	IN inStartDate DATETIME,
	IN inEndDate DATETIME,
	IN inStart INT, 
	IN inLimit INT
)
PROC: BEGIN   

	/*DECLARE dPhone,dEmail,inPhone VARCHAR(255) DEFAULT NULL;
    
	DECLARE dPCode,dUserId,dSaccoId INT DEFAULT NULL;
    DECLARE dECode VARCHAR(255) DEFAULT NULL; 
    DECLARE dTime DATETIME DEFAULT NULL; */
    
    DECLARE dCustomerId, dSubId INT DEFAULT NULL;
    DECLARE dDays, dExists, dAmount INT DEFAULT 0;
    DECLARE dPlan VARCHAR(255) DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;
    
	CASE inAction            
		-- new payment
        WHEN 1 THEN
			SET inFname = ValidString(inFname);
            SET inMname = ValidString(inMname);
            SET inLname = ValidString(inLname);
            SET inReference = ValidString(inReference);
            SET inPass = ValidString(inPass);
            
            -- check if phone number doent exists, create the customer
            if inCustomerId is null then
				select customerId into dCustomerId from customers where phone = inPhone;
                if dCustomerId is null then 
					insert into customers(phone,pass,passreset)
                    value(inPhone,inPass,1);
                    set dCustomerId = last_insert_id(), dExists = 0;
				else
					set dExists = 1;
                end if;
            end if;

            -- create a new subscription from the plan
            select duration, price, plan into dDays, dAmount, dPlan from plans where planId = inPlanId;
            
			START TRANSACTION;
				-- new subscription
				insert into subscriptions(customerId,statusId,planId,periodStart,periodEnd)
				value(dCustomerId,1,inPlanId,now(),DATE_ADD(NOW(),INTERVAL dDays DAY));
				set dSubId = last_insert_id();

				-- create payment
				insert into payments(modeId,statusId,customerId,subscriptionId,amount,phone)
				value(inModeId,inStatusId,dCustomerId,dSubId,dAmount,inPhone);
				set inPaymentId = last_insert_id();
			
			IF dRollBack THEN
				ROLLBACK;
				SELECT 'roll back' message, 0 created;
			ELSE 
				COMMIT;	
				SELECT 1 created, inPaymentId paymentId, dExists cExists, dPlan plan, dAmount amount;
			END IF;
            LEAVE PROC;                
			
        -- update from request callback
        WHEN 2 THEN
            SET inMerchantReqId = ValidString(inMerchantReqId);
            SET inCheckoutReqId = ValidString(inCheckoutReqId);
            SET inDescrp = ValidString(inDescrp);
			
            UPDATE payments SET MerchantRequestID = inMerchantReqId, CheckoutRequestID = inCheckoutReqId, ResponseDescription = inDescrp, statusId = inStatusId
            WHERE
				paymentId = inPaymentId;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
		
        -- update from request callback
        WHEN 3 THEN
			SET inReference = ValidString(inReference);
            SET inMerchantReqId = ValidString(inMerchantReqId);
            SET inCheckoutReqId = ValidString(inCheckoutReqId);
            SET inDescrp = ValidString(inDescrp);
            
            UPDATE payments SET 
				reference = inReference, ResponseDescription = inDescrp, -- statusId = inStatusId, posted = '1', 
                posteddate = NOW(), thirdpartyTime = inThirdpartyDate
            WHERE
				MerchantRequestID = inMerchantReqId
                AND CheckoutRequestID = inCheckoutReqId
                AND ResponseDescription != inDescrp;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
        -- update from registered callback
        WHEN 4 THEN
			SET inReference = ValidString(inReference);
			UPDATE payments SET
				fname = inFname, reference = inReference, -- mname = inMname, lname = inLname,
				statusId = inStatusId, posted = '1', posteddate = NOW(), thirdpartyTime = inThirdpartyDate
			WHERE 
				paymentId = inPaymentId
				-- AND phone = inPhone
				AND statusId = 2
				AND posted = '0';
			LEAVE PROC;
            
		-- list of payment per group
        WHEN 5 THEN
			SET inReference = ValidString(inReference);

			SELECT p.paymentId, p.fname payee, c.fname, c.lname, c.customerId, c.fname, c.lname, s.statusId, s.status, p.amount, pm.modeId, pm.mode, p.phone, p.reference, p.created
			FROM payments p
			JOIN paymentstatus s ON s.statusId = p.statusId
            JOIN paymentmode pm ON pm.modeId = p.modeId
            JOIN customers c ON c.customerId = p.customerId
			WHERE
				if(inpaymentId, p.paymentId = inpaymentId,1)
                AND if(inAmount, p.amount = inAmount,1)
				AND if(inStatusId, p.statusId = inStatusId,1)
				AND if(inModeId, p.modeId = inModeId,1)
                AND if(inStartDate, p.created >= inStartDate,1)
                AND if(inEndDate, p.created <= inEndDate,1) 
                AND if(inReference, p.reference = inReference,1)
			ORDER BY p.created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- payment status
		WHEN 6 THEN
			SELECT s.statusId, s.status, p.amount
			FROM payments p
			JOIN paymentstatus s on s.statusId = p.statusId
			WHERE
				p.paymentId = inPaymentId;
			LEAVE PROC;
            
		ELSE 
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `USERS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `USERS`(
	IN inAction INT, 
	IN inUserId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255), 
	IN inCode INT,
    IN inTypeId INT,
	IN inRoleId INT,
	IN inAdminId INT,
    IN inPassExpire DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dPhone,dEmail,dFname VARCHAR(255) DEFAULT NULL;
	DECLARE dCode,dUserId INT DEFAULT NULL;
    -- DECLARE dTime DATETIME DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;     

	CASE inAction
		-- login
        WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
			SELECT userId, email, phone, fname, active, pass
			FROM users
			WHERE
				(email = inEmail
				OR phone = inPhone)
                AND active = 1
			LIMIT 1;
			LEAVE PROC;
            
		-- register
        WHEN 2 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
			SET inFname = ValidString(inFname);
			SET inLname = ValidString(inLname);
			SET inPass = ValidString(inPass);
            
			INSERT INTO users(email,phone,fname,lname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inLname,inPass,inCode);      
            
            SELECT ROW_COUNT() created, LAST_INSERT_ID() userId;
			LEAVE PROC;
            
		-- update customer forgotten password
        WHEN 3 THEN
            SET inEmail = ValidString(inEmail);
            
            SELECT fname INTO inFname FROM users WHERE email = inEmail;
            
			UPDATE users SET passreset = 1, vCode = inCode
            WHERE
				email = inEmail;
			SELECT ROW_COUNT() updated, inFname fname;
			LEAVE PROC;

		-- update user password
        WHEN 4 THEN
            SET inEmail = ValidString(inEmail);
			UPDATE users SET passreset = null, vCode = null, pass = inPass
            WHERE
				-- userId = inUserId
                email = inEmail
                AND passreset = 1
                AND vCode = inCode;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
		-- list of roles and permissions
		WHEN 5 THEN
			SELECT r.roleId, r.title, p.permissionId, p.permission, g.groupId, g.icon, r.created --  g.title gtitle,
			FROM permissions p
			JOIN permsgroup g ON g.groupId = p.groupId
			JOIN rolepermission rp ON rp.permissionId = p.permissionId
			JOIN roles r on r.roleId = rp.roleId;
			LEAVE PROC;
            
		-- list of users
        WHEN 6 THEN
			SELECT userId, email, phone, fname, lname, active, created
			FROM users
            ORDER BY created DESC
			LIMIT inStart,inLimit;            
			LEAVE PROC;
            
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-04 15:31:04
