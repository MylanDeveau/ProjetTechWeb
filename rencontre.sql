-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 03 jan. 2021 à 15:17
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rencontre`
--

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `depart` int(11) NOT NULL,
  `mail` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `depart`, `mail`) VALUES
(1, 'Dupont', 'Henry', 1, 'dupont@gmail.com'),
(2, 'Martin', 'Matin', 24, 'martmat@gmail.com'),
(3, 'Lance', 'Pierre', 87, 'reboot@gmail.com'),
(4, 'Devo', 'Milane', 75, 'trenderz@orange.fr'),
(5, 'Marzolf', 'Thom', 62, 'martzolftom@gmail.com'),
(6, 'Rose', 'Marie', 27, 'rose@aol.fr'),
(7, 'Brochet', 'Jacques', 3, 'jacques@gmail.com'),
(8, 'Chafiq', 'Marion', 8, 'chafiq@gmail.com'),
(9, 'pat', 'patrick', 87, 'patrick@mail.fr'),
(10, 'Rousselet', 'Marion', 87, 'rousseletMarion@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `pratique`
--

DROP TABLE IF EXISTS `pratique`;
CREATE TABLE IF NOT EXISTS `pratique` (
  `id_personne` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `niveau` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_personne`,`id_sport`) USING BTREE,
  KEY `id_sport` (`id_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pratique`
--

INSERT INTO `pratique` (`id_personne`, `id_sport`, `niveau`) VALUES
(1, 1, 'débutant'),
(1, 2, 'pro'),
(1, 4, 'confirme'),
(2, 3, 'supporter'),
(2, 4, 'confirme'),
(2, 7, 'débutant'),
(3, 1, 'pro'),
(3, 4, 'supporter'),
(3, 5, 'confirme'),
(4, 4, 'supporter'),
(5, 6, 'confirme'),
(6, 1, 'débutant'),
(6, 5, 'confirme'),
(7, 1, 'supporter'),
(7, 2, 'confirme'),
(7, 4, 'supporter'),
(8, 5, 'confirme'),
(9, 2, 'pro'),
(9, 5, 'confirme'),
(10, 3, 'débutant'),
(10, 5, 'confirme');

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `id_sport` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_sport`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id_sport`, `nom`) VALUES
(1, 'football'),
(2, 'handball'),
(3, 'cyclisme'),
(4, 'natation'),
(5, 'judo'),
(6, 'badminton'),
(7, 'water-polo'),
(8, 'escrime'),
(9, 'equitation');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pratique`
--
ALTER TABLE `pratique`
  ADD CONSTRAINT `pratique_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `pratique_ibfk_2` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
