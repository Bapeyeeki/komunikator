# ************************************************************
# Sequel Ace SQL dump
# Version 20093
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: v.je (MySQL 11.7.2-MariaDB-ubu2404)
# Database: komunikator
# Generation Time: 2025-05-07 10:34:18 +0000
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;

INSERT INTO `messages` (`id`, `username`, `message`, `created_at`)
VALUES
	(1,'sdsd','dsds','2025-05-07 08:31:57'),
	(2,'Andrzej','siemka','2025-05-07 08:32:05'),
	(3,'Andrzej','co tam slychac u ciebie','2025-05-07 08:32:15'),
	(4,'sdsdsd','sdsdsdsdsdsds','2025-05-07 08:32:47'),
	(5,'sdsdsd','😊','2025-05-07 08:37:49'),
	(6,'sdsd','dsds','2025-05-07 08:39:57'),
	(7,'tomek','witaj😍','2025-05-07 08:59:19'),
	(8,'andrzej','czesc tomek','2025-05-07 08:59:30'),
	(9,'tomek','co tam slychac','2025-05-07 09:00:04'),
	(10,'andrzej','programuje sobie','2025-05-07 09:00:12'),
	(11,'tomek','dsdsdsdsd','2025-05-07 09:00:38'),
	(12,'andrzej','dsdsdsdfretrtrtrrtrtr','2025-05-07 09:00:45'),
	(13,'sdsd','dsdsd','2025-05-07 10:25:41'),
	(14,'dsdsd','dsdsds','2025-05-07 10:32:30'),
	(15,'dsdsdsdsd','dsdsds','2025-05-07 10:32:54'),
	(16,'sdsds','dsdsdsd','2025-05-07 10:33:23');

/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
