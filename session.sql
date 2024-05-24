-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour session
CREATE DATABASE IF NOT EXISTS `session` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `session`;

-- Listage de la structure de table session. category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.category : ~5 rows (environ)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Front-end'),
	(2, 'Back-end'),
	(3, 'Gestion de Projet'),
	(4, 'Microsoft Office'),
	(5, 'Marketing');

-- Listage de la structure de table session. course
CREATE TABLE IF NOT EXISTS `course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name_course` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_169E6FB912469DE2` (`category_id`),
  CONSTRAINT `FK_169E6FB912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.course : ~18 rows (environ)
INSERT INTO `course` (`id`, `category_id`, `name_course`) VALUES
	(1, 1, 'HTML5 et CSS3'),
	(2, 1, 'Javascript'),
	(3, 1, 'Framework'),
	(4, 1, 'Accessibilité'),
	(5, 2, 'PHP'),
	(6, 2, 'MySQL'),
	(7, 2, 'Sécurité'),
	(8, 2, 'API'),
	(9, 3, 'Méthodologies Planification'),
	(10, 3, 'Gestion Trello'),
	(11, 3, 'Risques Qualité'),
	(12, 3, 'Communication'),
	(13, 4, 'Word'),
	(14, 4, 'Excel'),
	(15, 4, 'PowerPoint'),
	(16, 5, 'Fondements du marketing'),
	(17, 5, 'Stratégie de communication'),
	(18, 5, 'Marketing des médias sociaux');

-- Listage de la structure de table session. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.formation : ~3 rows (environ)
INSERT INTO `formation` (`id`, `name`) VALUES
	(1, 'Informatique et Technologie'),
	(2, 'Bureautique et Productivité'),
	(3, 'Marketing et Communication');

-- Listage de la structure de table session. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table session. program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `days` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92ED7784613FECDF` (`session_id`),
  KEY `IDX_92ED7784591CC992` (`course_id`),
  CONSTRAINT `FK_92ED7784591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `FK_92ED7784613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.program : ~24 rows (environ)
INSERT INTO `program` (`id`, `session_id`, `course_id`, `days`) VALUES
	(1, 1, 1, 15),
	(2, 1, 2, 10),
	(3, 1, 3, 15),
	(4, 1, 4, 10),
	(5, 1, 5, 15),
	(6, 1, 6, 10),
	(7, 1, 7, 15),
	(8, 1, 8, 10),
	(9, 1, 9, 15),
	(10, 1, 10, 10),
	(11, 1, 11, 15),
	(12, 1, 12, 10),
	(13, 2, 13, 15),
	(14, 2, 14, 10),
	(15, 2, 15, 15),
	(16, 3, 16, 10),
	(17, 3, 18, 15),
	(18, 3, 17, 10),
	(19, 6, 2, 1),
	(20, 9, 1, 10),
	(21, 9, 13, 10),
	(22, 10, 1, 10),
	(23, 10, 3, 10),
	(24, 11, 18, 1);

-- Listage de la structure de table session. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int NOT NULL,
  `max_students` int NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `reservations` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.session : ~11 rows (environ)
INSERT INTO `session` (`id`, `formation_id`, `max_students`, `date_start`, `date_end`, `reservations`) VALUES
	(1, 1, 15, '2024-05-15 06:09:24', '2024-06-15 06:09:33', 0),
	(2, 2, 15, '2024-05-16 18:42:06', '2024-06-16 18:42:10', 0),
	(3, 3, 15, '2024-05-16 19:06:08', '2024-05-16 19:06:12', 0),
	(4, 1, 1, '2024-05-22 00:00:00', '2024-05-23 00:00:00', 0),
	(5, 1, 10, '2024-05-22 00:00:00', '2024-05-31 00:00:00', 10),
	(6, 1, 1, '2024-05-22 00:00:00', '2024-05-23 00:00:00', 1),
	(7, 2, 1, '2024-05-22 00:00:00', '2024-05-24 00:00:00', 1),
	(8, 3, 1, '2024-05-23 00:00:00', '2024-05-23 00:00:00', 1),
	(9, 1, 1, '2024-05-22 00:00:00', '2024-05-23 00:00:00', 1),
	(10, 1, 1, '2024-05-22 00:00:00', '2024-05-22 00:00:00', 1),
	(11, 3, 1, '2024-05-22 00:00:00', '2024-05-22 00:00:00', 1);

-- Listage de la structure de table session. session_student
CREATE TABLE IF NOT EXISTS `session_student` (
  `session_id` int NOT NULL,
  `student_id` int NOT NULL,
  PRIMARY KEY (`session_id`,`student_id`),
  KEY `IDX_A5FB2D69613FECDF` (`session_id`),
  KEY `IDX_A5FB2D69CB944F1A` (`student_id`),
  CONSTRAINT `FK_A5FB2D69613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A5FB2D69CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.session_student : ~0 rows (environ)
INSERT INTO `session_student` (`session_id`, `student_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 3),
	(3, 1),
	(3, 2),
	(3, 3),
	(5, 1),
	(5, 2),
	(6, 1),
	(10, 1),
	(10, 2),
	(11, 2),
	(11, 3);

-- Listage de la structure de table session. student
CREATE TABLE IF NOT EXISTS `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` datetime NOT NULL,
  `zip_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.student : ~7 rows (environ)
INSERT INTO `student` (`id`, `last_name`, `first_name`, `address`, `city`, `phone_number`, `birthday`, `zip_code`) VALUES
	(1, 'Wingard', 'Adam', '185 impasse des canards', 'Marseille', '07.01.69.54.10', '2024-05-13 15:49:19', '13000'),
	(2, 'Pratt', 'Chris', '5 rue de l\'étang', 'Lens', '06.09.15.75.85', '2024-05-13 15:50:10', '62000'),
	(3, 'Larson', 'Brie', '89 rue du Général de Gaule', 'Belfort\r\n', '03.88.10.52.32', '2024-05-13 15:51:12', '90000'),
	(4, 'Lawrence', 'Jennifer', '18 rue de strasbourg', 'Colmar', '03.89.82.86.10', '2024-05-19 08:36:16', '68000'),
	(7, 'Semoun', 'Elie', '26 rue cabourg', 'lille', '0789252488', '2024-05-04 00:00:00', '62000'),
	(8, 'Caen', 'Emilie', '100 rue de bordeaux', 'toulouse', '0600000203', '2024-05-26 00:00:00', '31000'),
	(9, 'MONTMIRAIL', 'ANTHONY', '5 rue de la libération', 'Thann', '0760504566', '2024-05-18 00:00:00', '68800');

-- Listage de la structure de table session. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.user : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
