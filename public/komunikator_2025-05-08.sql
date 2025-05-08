# ************************************************************
# Sequel Ace SQL dump
# Version 20093
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: v.je (MySQL 11.7.2-MariaDB-ubu2404)
# Database: komunikator
# Generation Time: 2025-05-08 07:10:13 +0000
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
	(1,'dsds','dsdsdsd','2025-05-07 12:55:27','general'),
	(2,'dfdfd','fdfdfdfdf','2025-05-07 12:56:23','general'),
	(3,'dfdf','dfdfdfdfdfdf','2025-05-07 12:57:07','general'),
	(4,'dffd','dfdfdfdf','2025-05-07 12:58:26','general'),
	(5,'sdasd','asdasdasdasd','2025-05-07 13:01:36','general'),
	(6,'fdgdfgdfg','fgdfgdgdgfdfgdfgdgdfg','2025-05-07 13:01:45','general'),
	(7,'Robert','Czesc','2025-05-08 08:59:31','general'),
	(8,'Robert','<b>Test</b>','2025-05-08 08:59:39','general'),
	(9,'Robert','<b><u>Test😁</u></b>','2025-05-08 09:00:01','general'),
	(10,'wda','as<b>asdasdasd</b>','2025-05-08 09:00:29','general');

/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
