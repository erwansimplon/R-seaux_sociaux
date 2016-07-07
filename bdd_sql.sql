
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 07 Juillet 2016 à 12:02
-- Version du serveur: 10.0.20-MariaDB
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `u539698594_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE IF NOT EXISTS `amis` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdLog` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IdLog` (`IdLog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comm`
--

CREATE TABLE IF NOT EXISTS `comm` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text,
  `msg_id_fk` int(11) DEFAULT NULL,
  `IdLog` int(11) NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `msg_id_fk` (`msg_id_fk`),
  KEY `IdLog` (`IdLog`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text,
  `msg_id_fk` int(11) DEFAULT NULL,
  `IdLog` int(11) NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `msg_id_fk` (`msg_id_fk`),
  KEY `IdLog` (`IdLog`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Structure de la table `LOGIN`
--

CREATE TABLE IF NOT EXISTS `LOGIN` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pass` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `valide` enum('0','1','2') COLLATE latin1_general_ci NOT NULL,
  `statut` enum('0','1') COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=34 ;

--
-- Contenu de la table `LOGIN`
--

INSERT INTO `LOGIN` (`id`, `pseudo`, `pass`, `email`, `valide`, `statut`, `date`) VALUES
(6, 'erwan', 'erwan14', 'guilleterwan@gmail.com', '1', '1', '2016-06-02'),
(31, 'steph', 'steph07', 'minf.steph@wanadoo.fr', '0', '0', '2016-06-15'),
(8, 'abbadix', 'abbadimehdi', 'abbadimehdi@hotmail.fr', '1', '0', '2016-06-09'),
(16, 'maxim', 'Maison24', 'adzetko@me.com', '0', '0', '2016-06-10'),
(26, 'enzo', 'enzo', 'enzomuhlinghaus@hotmail.fr', '1', '0', '2016-06-13'),
(30, 'krevar', 'justine7', 'thomas.naxx@hotmail.fr', '1', '1', '2016-06-14'),
(32, 'Laura.Larcher', 'lauralarcher24', 'laura.larcher24@gmail.com', '1', '0', '2016-06-17'),
(33, 'test', 'test', 'azerty@azido.com', '1', '0', '2016-07-05');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `IdLog` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

--
-- Structure de la table `minichat`
--

CREATE TABLE IF NOT EXISTS `minichat` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3057 ;

-- --------------------------------------------------------

--
-- Structure de la table `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `jointure` int(11) NOT NULL,
  `IdLog` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `IdLog` (`IdLog`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
