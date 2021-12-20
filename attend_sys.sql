-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: attendsys
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `att_id` int NOT NULL AUTO_INCREMENT,
  `att_datetime` date DEFAULT NULL,
  `att_status` varchar(45) DEFAULT NULL,
  `att_remarks` varchar(45) DEFAULT NULL,
  `sv_id` int DEFAULT NULL,
  `gs_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`att_id`),
  KEY `sv_id_idx` (`sv_id`),
  KEY `gs_id_idx` (`gs_id`),
  CONSTRAINT `gs_id` FOREIGN KEY (`gs_id`) REFERENCES `group_staff` (`gs_id`),
  CONSTRAINT `sv_id` FOREIGN KEY (`sv_id`) REFERENCES `group_sv` (`sv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'2021-12-19','/',' ',1,1,'2021-12-20 11:10:46',NULL),(2,'2021-12-19','X',' sick leave',1,2,'2021-12-20 11:10:46',NULL),(3,'2021-12-19','/',' ',1,3,'2021-12-20 11:10:46',NULL),(4,'2021-12-19','H',' a week',1,4,'2021-12-20 11:10:46',NULL),(5,'2021-12-19','/',' ',1,5,'2021-12-20 11:10:46',NULL),(6,'2021-12-19','/',' ',1,6,'2021-12-20 11:10:46',NULL),(7,'2021-12-20','/',' ',1,1,'2021-12-20 12:27:50',NULL),(8,'2021-12-20','X',' Sick Leave',1,2,'2021-12-20 12:27:50',NULL),(9,'2021-12-20','/',' ',1,3,'2021-12-20 12:27:50',NULL),(10,'2021-12-20','/',' ',1,4,'2021-12-20 12:27:50',NULL),(11,'2021-12-20','H','Annual leave for a week',1,5,'2021-12-20 12:27:50',NULL),(12,'2021-12-20','/',' ',1,6,'2021-12-20 12:27:50',NULL);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch` (
  `br_id` int NOT NULL,
  `br_code` varchar(45) DEFAULT NULL,
  `br_name` varchar(250) DEFAULT NULL,
  `br_address` varchar(255) DEFAULT NULL,
  `br_phone` varchar(20) DEFAULT NULL,
  `cpy_code` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`br_id`),
  KEY `cpy_code_idx` (`cpy_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'B01','Kedai Emas ABC Jewellery Bangi','Bangi, Selangor','0352621124','C01','2021-12-19 11:35:00',NULL),(2,'B02','Kedai Emas ABC Jewellery Shah Alam','Seksyen 7, Shah Alam, Selangor','0351213344','C01','2021-12-19 11:36:00',NULL),(3,'B03','Kedai Emas ABC Jewellery Senawang','Senawang, Negeri Sembilan','065214854','C01','2021-12-19 11:37:00',NULL);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `cpy_id` int NOT NULL AUTO_INCREMENT,
  `cpy_code` varchar(45) DEFAULT NULL,
  `cpy_name` varchar(255) DEFAULT NULL,
  `cpy_address` varchar(255) DEFAULT NULL,
  `cpy_email` varchar(100) DEFAULT NULL,
  `cpy_phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cpy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'C01','Kedai Emas ABC Jewellery Sdn Bhd','Bangi, Selangor','enquiry@abc.com','0352621124','2021-12-19 11:34:00',NULL);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `emp_id` int NOT NULL,
  `emp_code` varchar(45) DEFAULT NULL,
  `emp_fullname` varchar(255) DEFAULT NULL,
  `emp_preferredName` varchar(45) DEFAULT NULL,
  `emp_address` varchar(255) DEFAULT NULL,
  `emp_phone` varchar(20) DEFAULT NULL,
  `emp_dob` date DEFAULT NULL,
  `emp_doj` datetime DEFAULT NULL,
  `emp_status` varchar(20) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `usr_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'ABC0001','Awang Bin Ahmad','Awang','Kajang, Selangor','0122625588','1969-08-23','2010-10-01 09:00:00','active',4,'2021-12-19 11:42:00',NULL),(2,'ABC019','Ali Bin Razali','Ali','Puchong, Selangor','0145585214','1982-10-23','2015-05-02 09:00:00','active',1,'2021-12-19 11:44:00',NULL),(3,'ABC13','Abu Bin Kasim','Abu','Kajang, Selangor','0166558454','1992-01-01','2019-02-02 09:00:00','active',2,'2021-12-19 11:46:00',NULL),(4,'ABC931','Sarah Binti Rizal','Sarah','Kajang, Selangor','0196895541','1985-08-22','2017-01-15 09:00:00','active',3,'2021-12-19 11:48:00',NULL),(5,'ABC0002','Akif Bin Ali','Akif','Seremban, Negeri Sembilan','0122945585','1990-01-12','2016-01-02 09:00:00','active',5,'2021-12-19 11:50:00',NULL),(6,'ABC951','Nurul Binti Khairol','Nurul','Senawang, Negeri Sembilan','0168547852','1990-10-24','2016-01-20 09:00:00','active',6,'2021-12-19 11:54:00',NULL),(7,'ABC14','Nina Binti Alias','Nina','Kuala Pilah, Negeri Sembilan','0122655891','1986-03-23','2012-07-25 09:00:00','inactive',7,'2021-12-19 11:57:00',NULL),(8,'ABC012','Alisha Binti Akif','Alisha','Sendayan, Negeri Sembilan','0175549925','1995-07-07','2020-10-25 09:00:00','active',8,'2021-12-19 11:58:00',NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group` (
  `gr_id` int NOT NULL,
  `gr_code` varchar(45) DEFAULT NULL,
  `gr_name` varchar(45) DEFAULT NULL,
  `br_code` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`gr_id`),
  KEY `br_code_idx` (`br_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'G01','Sales','B01','2021-12-19 11:37:00',NULL),(2,'G02','Jewelry associate','B01','2021-12-19 11:37:00',NULL),(3,'G03','Quality assurance technician','B01','2021-12-19 11:37:00',NULL),(4,'G04','Sales','B02','2021-12-19 11:37:00',NULL),(5,'G05','Jewelry associate','B02','2021-12-19 11:37:00',NULL),(6,'G06','Quality assurance technician','B02','2021-12-19 11:37:00',NULL),(7,'G07','Sales','B03','2021-12-19 11:38:00',NULL),(8,'G08','Jewelry associate','B03','2021-12-19 11:38:00',NULL),(9,'G09','Quality assurance technician','B03','2021-12-19 11:38:00',NULL);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_staff`
--

DROP TABLE IF EXISTS `group_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_staff` (
  `gs_id` int NOT NULL,
  `emp_code` varchar(45) DEFAULT NULL,
  `gr_code` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`gs_id`),
  KEY `emp_id_idx` (`emp_code`),
  KEY `gr_code_idx` (`gr_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_staff`
--

LOCK TABLES `group_staff` WRITE;
/*!40000 ALTER TABLE `group_staff` DISABLE KEYS */;
INSERT INTO `group_staff` VALUES (1,'ABC019','G01','2021-12-19 11:54:00',NULL),(2,'ABC13','G01','2021-12-19 11:54:00',NULL),(3,'ABC931','G01','2021-12-19 11:54:00',NULL),(4,'ABC951','G07','2021-12-19 12:05:07',NULL),(5,'ABC14','G07','2021-12-19 12:05:10',NULL),(6,'ABC012','G07','2021-12-19 12:05:15',NULL);
/*!40000 ALTER TABLE `group_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_sv`
--

DROP TABLE IF EXISTS `group_sv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_sv` (
  `sv_id` int NOT NULL,
  `emp_code` varchar(45) DEFAULT NULL,
  `gr_code` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sv_id`),
  KEY `emp_id_idx` (`emp_code`),
  KEY `gr_code_idx` (`gr_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_sv`
--

LOCK TABLES `group_sv` WRITE;
/*!40000 ALTER TABLE `group_sv` DISABLE KEYS */;
INSERT INTO `group_sv` VALUES (1,'ABC0001','G01','2021-12-19 11:52:00',NULL),(2,'ABC0002','G07','2021-12-19 11:52:00',NULL);
/*!40000 ALTER TABLE `group_sv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_running_no`
--

DROP TABLE IF EXISTS `master_running_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_running_no` (
  `run_id` int NOT NULL,
  `run_prefix` varchar(20) DEFAULT NULL,
  `run_currentNo` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`run_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_running_no`
--

LOCK TABLES `master_running_no` WRITE;
/*!40000 ALTER TABLE `master_running_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_running_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_role` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ali@abc.com','ali123','staff','2021-12-19 11:40:00',NULL),(2,'abu@abc.com','abu123','staff','2021-12-19 11:40:00',NULL),(3,'sarah@abc.com','sarah123','staff','2021-12-19 11:40:00',NULL),(4,'awang@abc','awang123','supervisor','2021-12-19 11:41:00',NULL),(5,'akif@abc','akif123','supervisor','2021-12-19 11:50:00',NULL);
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

-- Dump completed on 2021-12-20 16:45:07
