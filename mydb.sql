-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 27 juin 2020 à 21:46
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `fich`
--

DROP TABLE IF EXISTS `fich`;
CREATE TABLE IF NOT EXISTS `fich` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `resume` varchar(50) NOT NULL,
  `np` int(100) NOT NULL,
  `confirm` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fich`
--

INSERT INTO `fich` (`id`, `titre`, `genre`, `name`, `dest`, `resume`, `np`, `confirm`, `user_id`) VALUES
(49, '11', '11', 'ex4-java-td.pdf', 'files/ex4-java-td.pdf', '11', 12, 1, 8),
(50, '12', '12', 'mbox.txt', 'files/mbox.txt', '12', 12, 1, 8),
(48, 'cv', 'cv', 'cv-eng.pdf', 'files/cv-eng.pdf', 'cv', 1, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `logins`
--

DROP TABLE IF EXISTS `logins`;
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `liste` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logins`
--

INSERT INTO `logins` (`id`, `nom`, `prenom`, `pseudo`, `mdp`, `liste`) VALUES
(8, 'ena', 'ena', 'ena', '1234', '<br>CR joker.ai<br>CR joker.ai<br>materiel challenge.txt<br>CR joker.ai<br>CR joker.ai<br>materiel challenge.txt<br>CR joker.ai<br>materiel challenge.txt<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>materiel challenge.txt<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>CR joker.ai<br>plank-challenge-intro.jpg<br>CR joker.ai<br>cv-eng.pdf'),
(10, 'hh', 'adnen', 'hh', '1234', '<br>CR joker.ai');

-- --------------------------------------------------------

--
-- Structure de la table `reclam`
--

DROP TABLE IF EXISTS `reclam`;
CREATE TABLE IF NOT EXISTS `reclam` (
  `msg` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomf` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
