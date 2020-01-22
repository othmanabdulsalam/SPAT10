CREATE DATABASE  IF NOT EXISTS `hackcamp10_spatdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hackcamp10_spatdb`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: poseidon.salford.ac.uk    Database: hackcamp10_spatdb
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `AnswerComments`
--

DROP TABLE IF EXISTS `AnswerComments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `AnswerComments` (
  `questionID` int(10) unsigned NOT NULL,
  `auditID` int(10) unsigned NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`questionID`,`auditID`),
  KEY `AnswerCommentsAuditID_idx` (`auditID`),
  CONSTRAINT `AnswerCommentsAuditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `AnswerCommentsQuestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AnswerComments`
--

LOCK TABLES `AnswerComments` WRITE;
/*!40000 ALTER TABLE `AnswerComments` DISABLE KEYS */;
INSERT INTO `AnswerComments` VALUES (1,2,'Sample comment'),(1,14,'herdrhd'),(2,3,'yeah this answer seems legit ngl'),(3,2,'Sample comment'),(3,3,'nah bro this guy\'s full of it innit'),(4,14,'hsfsfa'),(5,2,'Sample comment'),(5,4,'`iyyfiyf'),(6,4,'iyfiyf'),(7,2,'Sample comment'),(7,4,'ugi'),(9,2,'Sample comment'),(11,4,'yguyf'),(12,4,'uyfu');
/*!40000 ALTER TABLE `AnswerComments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Answers`
--

DROP TABLE IF EXISTS `Answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Answers` (
  `questionID` int(10) unsigned NOT NULL,
  `auditID` int(10) unsigned NOT NULL,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`questionID`,`auditID`),
  KEY `AauditID_idx` (`auditID`),
  CONSTRAINT `AauditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `AquestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Answers`
--

LOCK TABLES `Answers` WRITE;
/*!40000 ALTER TABLE `Answers` DISABLE KEYS */;
INSERT INTO `Answers` VALUES (1,1,'he said he didnt have the document'),(1,2,'Sample answer'),(1,3,'answering text to do an answer'),(1,14,'ftddjk'),(2,1,'pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus'),(2,2,'Sample answer'),(2,3,'answering text to do an answer for question 2'),(2,14,'hedgrg'),(3,1,'ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus'),(3,2,'Sample answer'),(3,3,'this is the answer to question number three'),(3,4,'huyg'),(3,14,'jgdfs'),(4,1,'eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare'),(4,2,'Sample answer'),(4,4,'ouuiug'),(4,14,'hsdwee'),(5,1,'ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at'),(5,2,'Sample answer'),(5,4,'yfif'),(5,14,'ug'),(6,1,'platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent'),(6,2,'Sample answer'),(6,4,'iyfif'),(7,1,'pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes'),(7,2,'Sample answer'),(7,4,'iyfuyf'),(8,1,'lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et'),(8,2,'Sample answer'),(8,4,'ugui'),(9,1,'libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus'),(9,2,'Sample answer'),(9,4,'uigiu'),(10,1,'cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede'),(10,2,'Sample answer'),(10,4,'uigiu'),(11,1,'justo eu massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo'),(11,4,'ugiug'),(11,6,'stock'),(12,1,'ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper'),(12,4,'iugiu'),(12,6,'stock'),(13,1,'quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia'),(13,6,'stock'),(14,1,'nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum'),(14,6,'stovk'),(15,1,'eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin'),(15,6,'stock'),(16,1,'euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet'),(16,6,'stock'),(17,1,'diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae'),(17,6,'stock'),(18,1,'vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque'),(18,6,'stock'),(19,1,'est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris'),(19,6,'stock'),(20,1,'justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue'),(20,6,'stock'),(21,1,'pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien'),(22,1,'quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus'),(23,1,'metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in'),(24,1,'neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi non quam nec dui'),(25,1,'auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit'),(26,1,'luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante'),(27,1,'montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et'),(28,1,'dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus'),(29,1,'vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum'),(30,1,'penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit'),(31,1,'blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa'),(32,1,'mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor'),(33,1,'curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet'),(34,1,'vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus'),(35,1,'mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum'),(36,1,'mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros');
/*!40000 ALTER TABLE `Answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Audit`
--

DROP TABLE IF EXISTS `Audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Audit` (
  `auditID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `completed` tinyint(4) DEFAULT '0',
  `clientID` int(10) unsigned NOT NULL,
  `location` varchar(45) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`auditID`),
  UNIQUE KEY `AuditID_UNIQUE` (`auditID`),
  KEY `clientID_idx` (`clientID`),
  CONSTRAINT `clientID` FOREIGN KEY (`clientID`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Audit`
--

LOCK TABLES `Audit` WRITE;
/*!40000 ALTER TABLE `Audit` DISABLE KEYS */;
INSERT INTO `Audit` VALUES (1,1,4,'bigg Stiggs oil rigg','2019-05-01 00:00:00'),(2,1,4,'Deep Water Petrolium Rig','2019-04-28 00:00:00'),(3,0,4,'South China Sea oil rig','2019-05-02 00:00:00'),(4,1,4,'PrimoVigoria HQ','2020-01-13 00:00:00'),(5,0,4,'SecondoVigoria HQ','2020-01-13 00:00:00'),(6,1,4,'trezoVigoriaHQ','2020-02-13 00:00:00'),(14,1,4,'far far away','2020-01-16 10:16:57'),(15,0,4,'The place with lots of oil','2020-01-16 10:21:31');
/*!40000 ALTER TABLE `Audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuditQuestions`
--

DROP TABLE IF EXISTS `AuditQuestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuditQuestions` (
  `auditID` int(10) unsigned NOT NULL,
  `questionID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`auditID`,`questionID`),
  KEY `AQquestionID_idx` (`questionID`),
  CONSTRAINT `AQauditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `AQquestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuditQuestions`
--

LOCK TABLES `AuditQuestions` WRITE;
/*!40000 ALTER TABLE `AuditQuestions` DISABLE KEYS */;
INSERT INTO `AuditQuestions` VALUES (1,1),(2,1),(3,1),(5,1),(14,1),(15,1),(1,2),(2,2),(3,2),(5,2),(14,2),(15,2),(1,3),(2,3),(3,3),(4,3),(5,3),(14,3),(15,3),(1,4),(2,4),(4,4),(14,4),(15,4),(1,5),(2,5),(4,5),(5,5),(14,5),(15,5),(1,6),(2,6),(4,6),(1,7),(2,7),(4,7),(5,7),(1,8),(2,8),(4,8),(5,8),(1,9),(2,9),(4,9),(1,10),(2,10),(4,10),(1,11),(4,11),(6,11),(1,12),(4,12),(6,12),(1,13),(6,13),(1,14),(6,14),(1,15),(5,15),(6,15),(1,16),(5,16),(6,16),(1,17),(6,17),(1,18),(6,18),(1,19),(5,19),(6,19),(1,20),(5,20),(6,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36);
/*!40000 ALTER TABLE `AuditQuestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categories` (
  `catID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catCode` varchar(45) NOT NULL,
  `catDescription` text NOT NULL,
  PRIMARY KEY (`catID`),
  UNIQUE KEY `catID_UNIQUE` (`catID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES (1,'PL','Plant'),(2,'PP','People'),(3,'PROC','Process'),(4,'PROD','Production'),(5,'TC','testCategory');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evidence`
--

DROP TABLE IF EXISTS `Evidence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Evidence` (
  `evidenceID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questionID` int(10) unsigned NOT NULL,
  `auditID` int(10) unsigned NOT NULL,
  `type` varchar(45) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`evidenceID`),
  UNIQUE KEY `evidenceID_UNIQUE` (`evidenceID`),
  KEY `EquestionID_idx` (`questionID`),
  KEY `EauditID_idx` (`auditID`),
  CONSTRAINT `EauditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evidence`
--

LOCK TABLES `Evidence` WRITE;
/*!40000 ALTER TABLE `Evidence` DISABLE KEYS */;
INSERT INTO `Evidence` VALUES (1,1,2,'image','/evidence/maxresdefault.jpg'),(2,2,2,'image','/evidence/distillation_tower.jpg'),(3,3,2,'audio','/evidence/audio1.wav'),(4,4,2,'audio','/evidence/audio2.wav'),(6,4,2,'video','/evidence/windmillfactory.mp4'),(7,5,2,'doc','/evidence/tempdoc1.docx'),(8,2,2,'doc','/evidence/tempdoc2.docx');
/*!40000 ALTER TABLE `Evidence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LegalFlags`
--

DROP TABLE IF EXISTS `LegalFlags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LegalFlags` (
  `flagID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  PRIMARY KEY (`flagID`),
  UNIQUE KEY `flagID_UNIQUE` (`flagID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LegalFlags`
--

LOCK TABLES `LegalFlags` WRITE;
/*!40000 ALTER TABLE `LegalFlags` DISABLE KEYS */;
INSERT INTO `LegalFlags` VALUES (1,'Scottish workers safety act (1997) section 4'),(2,'British building safety standards act (2005)'),(3,'British health and safety act (2011)'),(4,'British oil and gas act (2019) addendum C5');
/*!40000 ALTER TABLE `LegalFlags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Percentiles`
--

DROP TABLE IF EXISTS `Percentiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Percentiles` (
  `percentileID` int(10) unsigned NOT NULL,
  `percentage` varchar(45) NOT NULL,
  `bracketDescription` varchar(45) NOT NULL,
  `complianceBand` varchar(45) NOT NULL,
  PRIMARY KEY (`percentileID`),
  UNIQUE KEY `percentileID_UNIQUE` (`percentileID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Percentiles`
--

LOCK TABLES `Percentiles` WRITE;
/*!40000 ALTER TABLE `Percentiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `Percentiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QuestionFlags`
--

DROP TABLE IF EXISTS `QuestionFlags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `QuestionFlags` (
  `auditID` int(10) unsigned NOT NULL,
  `questionID` int(10) unsigned NOT NULL,
  `flagID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`auditID`,`questionID`,`flagID`),
  KEY `QFquestionID_idx` (`questionID`),
  KEY `QFflagID_idx` (`flagID`),
  CONSTRAINT `QFauditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `QFflagID` FOREIGN KEY (`flagID`) REFERENCES `LegalFlags` (`flagID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `QFquestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QuestionFlags`
--

LOCK TABLES `QuestionFlags` WRITE;
/*!40000 ALTER TABLE `QuestionFlags` DISABLE KEYS */;
INSERT INTO `QuestionFlags` VALUES (1,1,1),(2,1,1),(5,1,1),(4,3,1),(3,4,2),(6,4,3),(2,5,1),(4,5,1),(1,7,1),(6,12,1);
/*!40000 ALTER TABLE `QuestionFlags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Questions`
--

DROP TABLE IF EXISTS `Questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Questions` (
  `questionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questionContent` text NOT NULL,
  `subCatID` int(10) unsigned NOT NULL,
  `oneMark` text NOT NULL,
  `twoMark` text NOT NULL,
  `threeMark` text NOT NULL,
  `fourMark` text NOT NULL,
  `fiveMark` text NOT NULL,
  PRIMARY KEY (`questionID`),
  UNIQUE KEY `questionID_UNIQUE` (`questionID`),
  KEY `subCatID_idx` (`subCatID`),
  CONSTRAINT `subCatID` FOREIGN KEY (`subCatID`) REFERENCES `SubCategories` (`subCatID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Questions`
--

LOCK TABLES `Questions` WRITE;
/*!40000 ALTER TABLE `Questions` DISABLE KEYS */;
INSERT INTO `Questions` VALUES (1,'Do you have CBM Policy/Strategy',1,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(2,'Do you have Downtime reports',1,'Not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(3,'Do you have CBM Procedures ',1,'Not in place','Document in place, content quality and update frequency could be improved','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(4,'Do you have Asset Reference Plan',2,'Not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(5,'Do you a Budget setting procedure document',2,'Not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership'),(6,'Do you record Annual Actual Spend by Eqiupment  type',2,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(7,'Do you EIT Charter Document',3,'Document not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(8,'Do you have EIT Storyboards',3,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(9,'Do you have Single poit lesson plans',3,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(10,'Do you have a Suggestion scheme ',4,'Document not in place','Document in place, content quality and update frequency could be improved','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(11,'Do you measure Percentage of Practices Worth Replicating Implemented',4,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(12,'Do you measure the Number of suggestions per person per year',4,'Document not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(13,'Do you have a Communication plan',5,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(14,'Do you measure Annual Communication plan actual versus schedule.',5,'Document not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(15,'Do you record Meeting attendance Compliance for Leadership, Implementation and Tactical Teams',5,'Document not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(16,'Do you have Individual development plans',6,'Not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(17,'Do you measure % roles with competence standards',6,'Not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(18,'Do you measure % of people achieving competence standards',6,'Not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(19,'Do you have CMMS user guide',7,'Not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(20,'Do you have CMMS Training plans',7,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(21,'Do you complete Asset Register Audits',7,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(22,'Do you have a MT IAP document',8,'Not in place','Document in place, content quality and update frequency could be improved','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(23,'Do you have a ST IAP document',8,'Not in place','Document in place, content quality and update frequency could be improved','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(24,'Do you have a Shutdown Rundown Plan document',8,'Not in place','Document in place, content quality and update frequency could be improved','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(25,'Do you have Group HSSE Standards',9,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(26,'Do you have Guide to Procurement & Logistics Management',9,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership'),(27,'Do you have SAI standards for Aviation',9,'Not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(28,'Do you have Hierarchy of forecasts',10,'Not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(29,'Do you measure Production actuals',10,'Document not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(30,'Do you measure/ Analyse of actual vs forecast production',10,'Not in place','In place, formula not understood or clear','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(31,'Working  days to issue approved MRPW',11,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(32,'Do you record Customer target report dates met',11,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, circulated, clear ownership, updated regularly and effective','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(33,'How often are Re-issue monthly reports to regulators',11,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(34,'Do you have Monthly reporting of producing wells/injection wells (MRPW/MRIW)',12,'Document not in place','Document in place, content quality and update frequency could be improved','Document in place, circulated, clear ownership, content quality good','In place, circulated, clear ownership, updated regularly and effective','In place, circulated, clear ownership, updated regularly in accordance with the Company Standard'),(35,'Well models (WINGlue, Fieldware, IPM)',12,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(36,'Do you have Short-term forecast/schedule',12,'Document not in place','In place, formula not understood or clear','In place, formula aligned to company standard, with clear ownership','In place, formula aligned to company standard, with clear ownership, tracking industry average','In place, formula aligned to company standard, with clear ownership, tracking to top quartile'),(37,'Is the site cost efficient?',2,'Abysmal','Poor','OK','Good','Very Good'),(38,'Is this a test question?',13,'No way','Could be','I think so','Yes it might be','Yes it is');
/*!40000 ALTER TABLE `Questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ScoredAudits`
--

DROP TABLE IF EXISTS `ScoredAudits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ScoredAudits` (
  `auditID` int(10) unsigned NOT NULL,
  `dateScored` datetime NOT NULL,
  PRIMARY KEY (`auditID`),
  UNIQUE KEY `auditID_UNIQUE` (`auditID`),
  CONSTRAINT `ScoredAuditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ScoredAudits`
--

LOCK TABLES `ScoredAudits` WRITE;
/*!40000 ALTER TABLE `ScoredAudits` DISABLE KEYS */;
INSERT INTO `ScoredAudits` VALUES (1,'2019-05-07 00:00:00'),(2,'2020-01-15 17:51:35'),(3,'2019-05-08 00:00:00'),(14,'2020-01-16 11:28:48');
/*!40000 ALTER TABLE `ScoredAudits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Scores`
--

DROP TABLE IF EXISTS `Scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Scores` (
  `questionID` int(10) unsigned NOT NULL,
  `auditID` int(10) unsigned NOT NULL,
  `score` int(8) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`questionID`,`auditID`),
  KEY `ScoresAuditID_idx` (`auditID`),
  KEY `ScoresQuestionID_idx` (`questionID`),
  CONSTRAINT `ScoresAuditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScoresQuestionID` FOREIGN KEY (`questionID`) REFERENCES `Questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Scores`
--

LOCK TABLES `Scores` WRITE;
/*!40000 ALTER TABLE `Scores` DISABLE KEYS */;
INSERT INTO `Scores` VALUES (1,1,5,'answer was perfect'),(1,2,5,'Sure'),(1,14,2,'gssgg'),(2,1,3,'proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur'),(2,2,5,'sure'),(2,14,1,'gadada'),(3,1,5,'semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh'),(3,2,5,'sure'),(3,14,3,'waagag'),(4,1,2,'ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi'),(4,2,5,'sure'),(4,14,1,'raeadda'),(5,1,1,'hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur'),(5,2,5,'sure'),(5,14,2,'fafagag'),(6,1,1,'mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci'),(6,2,5,'sure'),(7,1,3,'adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy'),(7,2,5,'sure'),(8,1,5,'elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros'),(8,2,5,'be happy'),(9,1,4,'lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt'),(9,2,5,'hi'),(10,1,3,'mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas'),(10,2,1,'Hi'),(11,1,4,'cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing'),(12,1,3,'volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti'),(13,1,1,'suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed'),(14,1,3,'luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae'),(15,1,4,'nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non'),(16,1,4,'urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in'),(17,1,3,'suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum'),(18,1,5,'integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus'),(19,1,3,'felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque'),(20,1,5,'pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing'),(21,1,5,'luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna'),(22,1,2,'convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo'),(23,1,5,'molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam'),(24,1,3,'vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis'),(25,1,5,'felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel'),(26,1,3,'ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet'),(27,1,1,'nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet'),(28,1,5,'vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh'),(29,1,1,'lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem'),(30,1,1,'felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum in hac'),(31,1,4,'convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien'),(32,1,2,'eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis'),(33,1,5,'lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed'),(34,1,4,'cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices'),(35,1,1,'ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit'),(36,1,3,'pede ullamcorper augue a suscipit nulla elit ac nulla sed vel');
/*!40000 ALTER TABLE `Scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SubCatComment`
--

DROP TABLE IF EXISTS `SubCatComment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SubCatComment` (
  `auditID` int(10) unsigned NOT NULL,
  `subCatID` int(10) unsigned NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`auditID`,`subCatID`),
  KEY `SCCsubCatID_idx` (`subCatID`),
  CONSTRAINT `SCCauditID` FOREIGN KEY (`auditID`) REFERENCES `Audit` (`auditID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SCCsubCatID` FOREIGN KEY (`subCatID`) REFERENCES `SubCategories` (`subCatID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SubCatComment`
--

LOCK TABLES `SubCatComment` WRITE;
/*!40000 ALTER TABLE `SubCatComment` DISABLE KEYS */;
/*!40000 ALTER TABLE `SubCatComment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SubCategories`
--

DROP TABLE IF EXISTS `SubCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SubCategories` (
  `subCatID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subCatCode` varchar(45) NOT NULL,
  `subCatDescription` text,
  `catID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`subCatID`),
  UNIQUE KEY `subCatID_UNIQUE` (`subCatID`),
  KEY `catID_idx` (`catID`),
  CONSTRAINT `catID` FOREIGN KEY (`catID`) REFERENCES `Categories` (`catID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SubCategories`
--

LOCK TABLES `SubCategories` WRITE;
/*!40000 ALTER TABLE `SubCategories` DISABLE KEYS */;
INSERT INTO `SubCategories` VALUES (1,'CBM','Condition Based Maintanece',1),(2,'COO','Cost of Ownership',1),(3,'OEC','Overall Equip.Conditon',1),(4,'CI','Continous Improvent',2),(5,'COM','Comunication',2),(6,'CS','Competency & Skills',2),(7,'DM','Document Management',3),(8,'IAP','Integrated Act. Planning',3),(9,'LOG','Logistics',3),(10,'FOR','Forcasting',4),(11,'HM','Hydrocarbon Management',4),(12,'PP','Product Programming',4),(13,'TSC','testSubCategory',5);
/*!40000 ALTER TABLE `SubCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `passwordHash` varchar(200) NOT NULL,
  `email` varchar(45) NOT NULL,
  `accessLevel` char(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID_UNIQUE` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.com','A'),(2,'questioner','12fde2601353e97da9d86285eea367d8','questioner@questioner.com','Q'),(3,'scorer','f5f2c5905e5564d026b82cbe8ee79a24','scorer@scorer.com','S'),(4,'client','62608e08adc29a8d6dbc9754e659f125','client@client.com','C'),(5,'TestClient','examplePassWordHash','TestClient@example.com','C'),(6,'test','098f6bcd4621d373cade4e832627b4f6','test@test.com','C'),(7,'testClient','ae2b1fca515949e5d54fb22b8ed95575','testclient@test.com','C'),(8,'kunoot','ff919a68bac5879660d087a2e11e2d1c','kunoot@client.com','C');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-22 11:11:39
