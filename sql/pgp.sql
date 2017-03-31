-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 31 Mars 2017 à 10:05
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `alert`
--

INSERT INTO `alert` (`idAlert`, `dateAlert`, `typeAlert`, `idProjet`, `messageAlert`) VALUES
(1, '2017-03-30', 2, 2, 'le delai permis pour la date d''approbation AC de contrat est depassÃ©'),
(2, '2017-03-30', 2, 3, 'le delai permis pour la date d''approbation ACGPMP de contrat est depassÃ©'),
(3, '2017-03-30', 2, 4, 'le delai permis pour la date d''approbation MEF de contrat est depassÃ©'),
(4, '2017-03-30', 1, 1, 'la date d''ouverture de ce projet n''a pas encore Ã©tÃ© fournie alors que le delai approche '),
(5, '2017-03-30', 2, 2, 'le delai permis pour la date d''approbation AC de contrat est depassÃ©'),
(6, '2017-03-30', 2, 3, 'le delai permis pour la date d''approbation ACGPMP de contrat est depassÃ©'),
(7, '2017-03-30', 2, 4, 'le delai permis pour la date d''approbation MEF de contrat est depassÃ©'),
(8, '2017-03-30', 1, 1, 'la date d''ouverture de ce projet n''a pas encore Ã©tÃ© fournie alors que le delai approche ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `numContrat`, `autoriteContractante`, `description`, `beneficiaire`, `phase`, `montant`, `dateReceptionDAO`, `dateOuverturePlis`, `dateRapportEvaluation`, `datePublicationAttribution`, `projetCeContrat`, `approbationAttribuaire`, `approbationAC`, `approbationACGPMP`, `approbationMEF`, `totalJour`, `inferieur60`, `inferieur90`, `inferieur120`, `superieur120`, `commentaire`, `dateInsertion`) VALUES
(1, 'C001', 'Dn Tech', 'Computerizing', 'Mef', 'Beginning', '500000000', '24/03/2017', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 'A huge project for IT', '2017-03-28 23:31:24'),
(2, 'C001', 'Dn Tech', 'Computerizing', 'Mef', 'Beginning', '500000000', '10/03/2017', '17/03/2017', '25/03/2017', '03/04/2017', '12/04/2017', '20/04/2017', '', '', '', NULL, '', '', '', '', 'A huge project for IT', '2017-03-30 20:06:26'),
(3, 'C002', 'Areeba GN', 'Cellphone', 'Governement', 'Advanced', '6000000000', '20/06/2002', '20/06/2002', '20/06/2002', '20/06/2002', '20/06/2002', '20/06/2002', '20/06/2002', '', '', NULL, '', '', '', '', 'Super', '2017-03-30 20:06:26'),
(4, 'C003', 'Dn Tech', 'IT Company', 'Mef', 'Final', '200000000', '12/01/2017', '12/01/2017', '05/04/1837', '12/01/2017', '05/04/1996', '06/04/1938', '31/03/1965', '07/03/1965', '', NULL, '', '', '', '', 'Great', '2017-03-30 20:06:26');

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
