-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 23 Mars 2017 à 10:18
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pgp`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `idProjet` int(11) NOT NULL,
  `numContrat` varchar(20) NOT NULL,
  `autoriteContractante` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `beneficiaire` varchar(20) NOT NULL,
  `phase` varchar(20) NOT NULL,
  `montant` varchar(25) NOT NULL,
  `dateReceptionDAO` datetime NOT NULL,
  `dateOuverturePlis` datetime NOT NULL,
  `dateRapportEvaluation` datetime NOT NULL,
  `datePublicationAttribution` datetime NOT NULL,
  `projetCeContrat` datetime NOT NULL,
  `approbationAttribuaire` datetime NOT NULL,
  `approbationAC` datetime NOT NULL,
  `approbationACGPMP` datetime NOT NULL,
  `approbationMEF` int(11) NOT NULL,
  `totalJour` varchar(10) DEFAULT NULL,
  `inferieur60` varchar(10) NOT NULL,
  `inferieur90` varchar(10) NOT NULL,
  `inferieur120` varchar(10) NOT NULL,
  `superieur120` varchar(10) NOT NULL,
  `commentaire` tinytext NOT NULL,
  `dateInsertion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `numContrat`, `autoriteContractante`, `description`, `beneficiaire`, `phase`, `montant`, `dateReceptionDAO`, `dateOuverturePlis`, `dateRapportEvaluation`, `datePublicationAttribution`, `projetCeContrat`, `approbationAttribuaire`, `approbationAC`, `approbationACGPMP`, `approbationMEF`, `totalJour`, `inferieur60`, `inferieur90`, `inferieur120`, `superieur120`, `commentaire`, `dateInsertion`) VALUES
(1, 'Contrat001', 'Mobitech', 'des bon projet de mobitech', 'lansana', 'pilote', '500000000000', '2017-03-07 00:00:00', '2017-03-16 00:00:00', '2017-03-17 00:00:00', '2017-03-16 00:00:00', '2017-03-19 00:00:00', '2017-03-22 00:00:00', '2017-03-23 00:00:00', '2017-03-24 00:00:00', 545554, '10', '1', '2', '3', '4', 'super cool', '2017-03-21 23:27:46'),
(2, 'RUORUEO', 'UREOU', 'UEORUEOI', '0444-05-04', 'ERERE', '0444-04-04', '0044-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0044-04-04 00:00:00', 44, '0044-04-04', '4RE4R4E', '4E4RE4R4', '4R4E4RE4', '4R4E4RE4', '44RE4R4E4', '2017-03-22 21:58:31'),
(3, 'RUORUEO', 'UREOU', 'UEORUEOI', '0444-05-04', 'ERERE', '0444-04-04', '0044-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0044-04-04 00:00:00', 44, '0044-04-04', '4RE4R4E', '4E4RE4R4', '4R4E4RE4', '4R4E4RE4', '44RE4R4E4', '2017-03-22 21:58:42'),
(4, 'rerererer', 'errerere', 'rererrerer', '0088-08-08', '8er7e8r7e8e', '7878-08-07', '0788-08-08 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0878-08-07 00:00:00', '8877-07-08 00:00:00', '8787-07-08 00:00:00', '0087-08-07 00:00:00', '8778-07-08 00:00:00', 87, '0787-07-08', '78re8re8r', '7r78e8re8', '7r8er7e', '7r8er7e', '8', '2017-03-22 22:00:10'),
(5, 'RUORUEO', 'UREOU', 'UEORUEOI', '0444-05-04', 'ERERE', '0444-04-04', '0044-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0004-04-04 00:00:00', '0044-04-04 00:00:00', '0044-04-04 00:00:00', 44, '0044-04-04', '4RE4R4E', '4E4RE4R4', '4R4E4RE4', '4R4E4RE4', '44RE4R4E4', '2017-03-22 22:01:08'),
(6, 'CTR001', 'lansana', 'lansana', 'lansana', 'lansana', '10000', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', '2017-03-24 00:00:00', 2017, '10', '1', '2', '3', '3', 'c''est trop', '2017-03-22 23:49:17'),
(7, 'rerererer', 'errerere', 'rererrerer', '0088-08-08', '8er7e8r7e8e', '7878-08-07', '0788-08-08 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0878-08-07 00:00:00', '8877-07-08 00:00:00', '8787-07-08 00:00:00', '0087-08-07 00:00:00', '8778-07-08 00:00:00', 87, '0787-07-08', '78re8re8r', '7r78e8re8', '7r8er7e', '7r8er7e', '8', '2017-03-22 23:55:02'),
(8, 'rerererer', 'errerere', 'rererrerer', '0088-08-08', '8er7e8r7e8e', '7878-08-07', '0788-08-08 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0878-08-07 00:00:00', '8877-07-08 00:00:00', '8787-07-08 00:00:00', '0087-08-07 00:00:00', '8778-07-08 00:00:00', 87, '0787-07-08', '78re8re8r', '7r78e8re8', '7r8er7e', '7r8er7e', '8', '2017-03-22 23:55:19');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nomUser` varchar(60) NOT NULL,
  `prenomUser` varchar(60) NOT NULL,
  `emailUser` varchar(60) NOT NULL,
  `passUser` varchar(75) NOT NULL,
  `telephoneUser` varchar(20) DEFAULT NULL,
  `dateInscription` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `emailUser`, `passUser`, `telephoneUser`, `dateInscription`) VALUES
(1, 'Sylla', 'Lansana', 'lansanalsm@gmail.com', 'lansana', '666494787', '2016-12-29 21:57:36'),
(2, 'testeur', 'testeur', 'beta@testeur.test', 'test123', NULL, '2017-03-15 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
