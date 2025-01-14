-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 14 jan. 2025 à 05:23
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ems`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id`, `idUser`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'aaaaa@gmail.com', '$2y$10$kx9pTbOpzGSknkVP4udLkuKBAwY69EIvyOkQhxMZIfSAD/Flen4Pq', '2025-01-14 00:27:37', '2025-01-14 00:27:37'),
(2, 2, 'bbbbb@gmail.com', '$2y$10$QOrD7Hry7u/a57tmsgTVNuxaewN9LUntGZQ2XTc8bRBZN7H0qG0S.', '2025-01-14 00:31:00', '2025-01-14 00:31:00'),
(3, 3, 'ddddd@gmail.com', '$2y$10$JhZmTzDUCfMnBQYwkDUh7O79GVkmQ.vE.ISZxiJErkwFz9dFr0zue', '2025-01-14 01:54:44', '2025-01-14 01:54:44'),
(4, 4, 'eeeee@gmail.com', '$2y$10$WCmJJjact/pd2wNNEGcTUOaheRX3.dvW4K99KwAipTym3TJ5Jm8FW', '2025-01-14 03:05:47', '2025-01-14 03:05:47');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-12-27-151946', 'App\\Database\\Migrations\\CreateAccountTable', 'default', 'App', 1736814161, 1),
(2, '2024-12-27-161627', 'App\\Database\\Migrations\\CreateRoleTable', 'default', 'App', 1736814161, 1),
(3, '2024-12-27-163754', 'App\\Database\\Migrations\\CreateUserTable', 'default', 'App', 1736814162, 1),
(8, '2025-01-09-010316', 'App\\Database\\Migrations\\CreateNoteTable', 'default', 'App', 1736827558, 2),
(5, '2025-01-09-010417', 'App\\Database\\Migrations\\CreateUserModuleTable', 'default', 'App', 1736814162, 1),
(6, '2025-01-09-100918', 'App\\Database\\Migrations\\CreateSectorTable', 'default', 'App', 1736814162, 1),
(7, '2025-01-09-100931', 'App\\Database\\Migrations\\CreateModuleTable', 'default', 'App', 1736814162, 1);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `idSector` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_idSector_foreign` (`idSector`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nom`, `description`, `idSector`, `created_at`, `updated_at`) VALUES
(1, 'GL Avancée', 'GL Avancée', 1, NULL, NULL),
(2, 'Python', 'Python', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idModule` int NOT NULL,
  `idUserProfessor` int NOT NULL,
  `idUserStudent` int NOT NULL,
  `noteNormal` decimal(5,2) NOT NULL,
  `noteRattrapage` decimal(5,2) NOT NULL,
  `valide` int DEFAULT NULL,
  `archive` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `idModule`, `idUserProfessor`, `idUserStudent`, `noteNormal`, `noteRattrapage`, `valide`, `archive`, `created_at`, `updated_at`) VALUES
(14, 1, 1, 2, 10.00, 20.00, 1, NULL, '2025-01-14 04:55:07', '2025-01-14 04:55:07'),
(13, 1, 1, 3, 3.00, 4.00, 0, NULL, '2025-01-14 04:54:48', '2025-01-14 04:54:48'),
(12, 1, 1, 2, 1.00, 2.00, 0, 1, '2025-01-14 04:54:48', '2025-01-14 04:55:07');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idAccount` int NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `role_name` varchar(191) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `idAccount`, `idUser`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'professor', '2025-01-14 00:27:37', '2025-01-14 00:27:37'),
(2, 2, 0, 'student', '2025-01-14 00:31:00', '2025-01-14 00:31:00'),
(3, 3, 0, 'student', '2025-01-14 01:54:44', '2025-01-14 01:54:44'),
(4, 4, 0, 'professor', '2025-01-14 03:05:47', '2025-01-14 03:05:47');

-- --------------------------------------------------------

--
-- Structure de la table `sector`
--

DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sector`
--

INSERT INTO `sector` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ingénierie Logicielle', 'Ingénierie Logicielle', NULL, NULL),
(2, 'Systèmes Embarqués', 'Systèmes Embarqués', NULL, NULL),
(3, 'Intelligence Artificielle', 'Intelligence Artificielle', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) NOT NULL,
  `prenom` varchar(191) NOT NULL,
  `cne` varchar(20) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `dateNaissance` varchar(191) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `cne`, `cin`, `dateNaissance`, `created_at`, `updated_at`) VALUES
(1, 'aaaaa', 'aaaaa', '', 'aaaaa', '', '2025-01-14 00:27:37', '2025-01-14 00:27:37'),
(2, 'bbbbb', 'bbbbb', 'bbbbb', '', '2001-01-01', '2025-01-14 00:31:00', '2025-01-14 00:31:00'),
(3, 'ddddd', 'ddddd', 'ddddd', '', '2002-01-01', '2025-01-14 01:54:44', '2025-01-14 01:54:44'),
(4, 'eeeee', 'eeeee', '', 'eeeee', '', '2025-01-14 03:05:47', '2025-01-14 03:05:47');

-- --------------------------------------------------------

--
-- Structure de la table `usermodule`
--

DROP TABLE IF EXISTS `usermodule`;
CREATE TABLE IF NOT EXISTS `usermodule` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `idModule` int UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `usermodule`
--

INSERT INTO `usermodule` (`id`, `idUser`, `idModule`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'professor', NULL, NULL),
(2, 2, 1, 'student', NULL, NULL),
(3, 3, 1, 'student', NULL, NULL),
(4, 4, 2, 'professor', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
