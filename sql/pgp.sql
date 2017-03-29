-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 29 Mars 2017 à 12:07
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pgp`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `numContrat` varchar(20) NOT NULL,
  `autoriteContractante` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `beneficiaire` varchar(20) NOT NULL,
  `phase` varchar(20) NOT NULL,
  `montant` varchar(25) NOT NULL,
  `dateReceptionDAO` varchar(20) NOT NULL,
  `dateOuverturePlis` varchar(20) NOT NULL,
  `dateRapportEvaluation` varchar(20) NOT NULL,
  `datePublicationAttribution` varchar(20) NOT NULL,
  `projetCeContrat` varchar(20) NOT NULL,
  `approbationAttribuaire` varchar(20) NOT NULL,
  `approbationAC` varchar(20) NOT NULL,
  `approbationACGPMP` varchar(20) NOT NULL,
  `approbationMEF` varchar(20) NOT NULL,
  `totalJour` varchar(10) DEFAULT NULL,
  `inferieur60` varchar(10) NOT NULL,
  `inferieur90` varchar(10) NOT NULL,
  `inferieur120` varchar(10) NOT NULL,
  `superieur120` varchar(10) NOT NULL,
  `commentaire` tinytext NOT NULL,
  `dateInsertion` datetime NOT NULL,
  PRIMARY KEY (`idProjet`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `numContrat`, `autoriteContractante`, `description`, `beneficiaire`, `phase`, `montant`, `dateReceptionDAO`, `dateOuverturePlis`, `dateRapportEvaluation`, `datePublicationAttribution`, `projetCeContrat`, `approbationAttribuaire`, `approbationAC`, `approbationACGPMP`, `approbationMEF`, `totalJour`, `inferieur60`, `inferieur90`, `inferieur120`, `superieur120`, `commentaire`, `dateInsertion`) VALUES
(1, 'C001', 'Dn Tech', 'Computerizing', 'Mef', 'Beginning', '500000000', '10/03/2017', '22/03/2017', '', '', '', '', '', '', '', NULL, '', '', '', '', 'A huge project for IT', '2017-03-28 23:31:24');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nomUser` varchar(60) NOT NULL,
  `prenomUser` varchar(60) NOT NULL,
  `emailUser` varchar(60) NOT NULL,
  `passUser` varchar(75) NOT NULL,
  `telephoneUser` varchar(20) DEFAULT NULL,
  `recevoirEmail` int(2) DEFAULT '0',
  `dateInscription` datetime NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `emailUser`, `passUser`, `telephoneUser`, `recevoirEmail`, `dateInscription`) VALUES
(1, 'Sylla', 'Lansana', 'lansanalsm@gmail.com', 'lansana', '666494787', 1, '2016-12-29 21:57:36'),
(2, 'testeur', 'testeur', 'beta@testeur.test', 'test123', NULL, 1, '2017-03-15 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
