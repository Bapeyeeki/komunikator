# ************************************************************
# Sequel Ace SQL dump
# Version 20093
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: v.je (MySQL 11.7.2-MariaDB-ubu2404)
# Database: komunikator
# Generation Time: 2025-05-08 09:10:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `channel` varchar(100) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;

INSERT INTO `messages` (`id`, `username`, `message`, `created_at`, `channel`)
VALUES
	(29,'Robert','Czesc','2025-05-08 10:33:15','general'),
	(30,'Robert','Co tam?','2025-05-08 10:33:19','general'),
	(31,'Robert','ds','2025-05-08 10:39:44','general'),
	(32,'Robert','dd','2025-05-08 10:50:59','general'),
	(33,'Robert','l','2025-05-08 10:51:56','Projekty'),
	(34,'Robert','dsds','2025-05-08 11:02:48','general'),
	(35,'Anka','asdasdads','2025-05-08 11:07:21','general'),
	(36,'Anka','asdasdasd','2025-05-08 11:07:42','general'),
	(37,'Piotrek','dddd','2025-05-08 11:07:50','general'),
	(38,'Anka','test','2025-05-08 11:08:17','general'),
	(39,'ktos','test','2025-05-08 11:08:48','general'),
	(40,'Anka','test','2025-05-08 11:08:56','general');

/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table received_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `received_messages`;

CREATE TABLE `received_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_username` varchar(50) NOT NULL,
  `recipient_username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `channel` varchar(100) NOT NULL DEFAULT 'general',
  `is_read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `received_messages` WRITE;
/*!40000 ALTER TABLE `received_messages` DISABLE KEYS */;

INSERT INTO `received_messages` (`id`, `sender_username`, `recipient_username`, `message`, `created_at`, `channel`, `is_read`)
VALUES
	(1,'sigma','Robert','ewewew','2025-05-08 11:02:56','general',0),
	(2,'sigma','Robert','dsdsd','2025-05-08 11:07:08','general',0),
	(3,'ktos','Anka','sdsds','2025-05-08 11:08:37','general',0);

/*!40000 ALTER TABLE `received_messages` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
