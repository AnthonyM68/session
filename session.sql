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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.category : ~14 rows (environ)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Développement Web'),
	(2, 'Développement d\'applications mobiles'),
	(3, 'Microsoft Office'),
	(4, 'Gestion de projet'),
	(5, 'Design graphique'),
	(6, 'Design d\'interface utilisateur (UIUX)'),
	(7, 'Marketing digital'),
	(8, 'Réseaux sociaux'),
	(9, 'Gestion d\'entreprise'),
	(10, 'Comptabilité'),
	(11, 'Anglais'),
	(12, 'Français'),
	(13, 'Nutrition'),
	(14, 'Fitness');

-- Listage de la structure de table session. course
CREATE TABLE IF NOT EXISTS `course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_category` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.course : ~1 rows (environ)
INSERT INTO `course` (`id`, `id_category`) VALUES
	(1, 1);

-- Listage de la structure de table session. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table session.doctrine_migration_versions : ~0 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240513123739', '2024-05-13 12:39:12', 227);

-- Listage de la structure de table session. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.formation : ~8 rows (environ)
INSERT INTO `formation` (`id`, `name`) VALUES
	(1, 'Informatique et Technologie'),
	(2, 'Bureautique et Productivité'),
	(3, 'Design et Créativité '),
	(4, 'Marketing et Communication :'),
	(5, 'Gestion et Finance'),
	(6, 'Langues et Communication '),
	(7, 'Santé et Bien-être'),
	(8, 'Divers');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.program : ~1 rows (environ)
INSERT INTO `program` (`id`, `session_id`, `course_id`, `days`) VALUES
	(1, 1, 1, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.session : ~1 rows (environ)
INSERT INTO `session` (`id`, `formation_id`, `max_students`, `date_start`, `date_end`, `reservations`) VALUES
	(1, 1, 15, '2024-05-15 06:09:24', '2024-06-15 06:09:33', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.student : ~3 rows (environ)
INSERT INTO `student` (`id`, `last_name`, `first_name`, `address`, `city`, `phone_number`, `birthday`, `zip_code`) VALUES
	(1, 'Avery', 'Adam', '185 impasse des canards', 'Marseille', '07.01.69.54.10', '2024-05-13 15:49:19', '13000'),
	(2, 'Rampling', 'Jason	', '5 rue de l\'étang', 'Lens', '06.09.15.75.85', '2024-05-13 15:50:10', '62000'),
	(3, 'Mills', 'Jessica	', '89 rue du Général de Gaule', 'Belfort\r\n', '03.88.10.52.32', '2024-05-13 15:51:12', '90000');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
