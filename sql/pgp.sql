-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 07 Avril 2017 à 17:01
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
-- Structure de la table `alert`
--

CREATE TABLE IF NOT EXISTS `alert` (
  `idAlert` int(11) NOT NULL AUTO_INCREMENT,
  `dateAlert` date NOT NULL,
  `typeAlert` int(2) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `messageAlert` varchar(250) NOT NULL,
  PRIMARY KEY (`idAlert`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `alert`
--

INSERT INTO `alert` (`idAlert`, `dateAlert`, `typeAlert`, `idProjet`, `messageAlert`) VALUES
(9, '2017-04-03', 1, 1, 'la date d''ouverture de ce projet n''a pas encore Ã©tÃ© fournie alors que le delai approche '),
(10, '2017-04-03', 2, 1, 'le delai permis pour la date d''ouverture est depassÃ©'),
(11, '2017-04-03', 2, 1, 'le delai permis pour la date d''ouverture est depassÃ©'),
(12, '2017-04-03', 1, 1, 'la date d''evaluation de ce projet n''a pas encore Ã©tÃ© fournie alors que le delai approche '),
(13, '2017-04-03', 2, 1, 'le delai permis pour la date d''approbation AC de contrat est depassÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `autoriteContractante` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `sourceFinancement` varchar(60) NOT NULL,
  `typeProcedure` varchar(20) NOT NULL,
  `dateReceptionDAO` varchar(20) NOT NULL,
  `dateAnoSurDAO` varchar(20) NOT NULL,
  `datePublicationDAO` varchar(20) NOT NULL,
  `dateOuverturePlis` varchar(20) NOT NULL,
  `dateRapportEvaluation` varchar(20) NOT NULL,
  `dateAnoSurRapEval` varchar(20) NOT NULL,
  `dateNotifProvisoir` varchar(20) NOT NULL,
  `projetNegoContrat` varchar(20) NOT NULL,
  `dateAnoProjetContrat` varchar(20) NOT NULL,
  `attribuaire` varchar(20) NOT NULL,
  `approbationAttribuaire` varchar(20) DEFAULT NULL,
  `montant` varchar(25) NOT NULL,
  `approbationAC` varchar(20) NOT NULL,
  `approbationACGPMP` varchar(20) NOT NULL,
  `approbationMEF` varchar(20) NOT NULL,
  `enregistrementImpots` varchar(20) NOT NULL,
  `immatriculation` varchar(20) NOT NULL,
  `totalJour` varchar(10) DEFAULT NULL,
  `inferieur60` varchar(10) NOT NULL,
  `inferieur90` varchar(10) NOT NULL,
  `inferieur120` varchar(10) NOT NULL,
  `superieur120` varchar(10) NOT NULL,
  `commentaire` tinytext NOT NULL,
  `dateInsertion` datetime NOT NULL,
  PRIMARY KEY (`idProjet`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

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
