-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 02 Novembre 2014 à 20:29
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `thesimsmta`
--

-- --------------------------------------------------------

--
-- Structure de la table `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `money` float NOT NULL DEFAULT '0',
  `health` float NOT NULL DEFAULT '100',
  `energy` float NOT NULL DEFAULT '100',
  `hungry` float NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `statistics`
--

INSERT INTO `statistics` (`id`, `userID`, `money`, `health`, `energy`, `hungry`) VALUES
(1, 1, 0, 100, 100, 100);

-- --------------------------------------------------------

--
-- Structure de la table `towns`
--

CREATE TABLE IF NOT EXISTS `towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `max_player` int(11) NOT NULL DEFAULT '4',
  `map` text NOT NULL,
  `mayorID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `towns`
--

INSERT INTO `towns` (`id`, `name`, `max_player`, `map`, `mayorID`) VALUES
(1, 'Hell', 4, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `posX` float NOT NULL,
  `posY` float NOT NULL,
  `posZ` float NOT NULL,
  `townID` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `banned` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `posX`, `posY`, `posZ`, `townID`, `ip`, `serial`, `register_date`, `active`, `banned`) VALUES
(1, 'Test', 'test@test.com', '6ae41267444b7d05b621a8a7ee429936', 780, -3269, 15, 1, '127.0.0.1', 'xxx', '2014-10-28 21:02:11', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
