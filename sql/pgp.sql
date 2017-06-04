-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 04 Juin 2017 à 23:01
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

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
-- Structure de la table `alert`
--

CREATE TABLE `alert` (
  `idAlert` int(11) NOT NULL,
  `dateAlert` date NOT NULL,
  `typeAlert` int(2) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `messageAlert` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `alert`
--

INSERT INTO `alert` (`idAlert`, `dateAlert`, `typeAlert`, `idProjet`, `messageAlert`) VALUES
(9, '2017-04-03', 1, 1, 'la date d\'ouverture de ce projet n\'a pas encore Ã©tÃ© fournie alors que le delai approche '),
(10, '2017-04-03', 2, 1, 'le delai permis pour la date d\'ouverture est depassÃ©'),
(11, '2017-04-03', 2, 1, 'le delai permis pour la date d\'ouverture est depassÃ©'),
(12, '2017-04-03', 1, 1, 'la date d\'evaluation de ce projet n\'a pas encore Ã©tÃ© fournie alors que le delai approche '),
(13, '2017-04-03', 2, 1, 'le delai permis pour la date d\'approbation AC de contrat est depassÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `idProjet` int(11) NOT NULL,
  `idImport` varchar(20) DEFAULT NULL,
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
  `approbationAttribuaire` varchar(20) NOT NULL,
  `montant` varchar(25) NOT NULL,
  `approbationAC` varchar(20) NOT NULL,
  `approbationACGPMP` varchar(20) NOT NULL,
  `approbationMEF` varchar(20) NOT NULL,
  `enregistrementImpots` varchar(20) NOT NULL,
  `immatriculation` varchar(20) NOT NULL,
  `totalJour` varchar(10) NOT NULL,
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

INSERT INTO `projet` (`idProjet`, `idImport`, `autoriteContractante`, `description`, `sourceFinancement`, `typeProcedure`, `dateReceptionDAO`, `dateAnoSurDAO`, `datePublicationDAO`, `dateOuverturePlis`, `dateRapportEvaluation`, `dateAnoSurRapEval`, `dateNotifProvisoir`, `projetNegoContrat`, `dateAnoProjetContrat`, `attribuaire`, `approbationAttribuaire`, `montant`, `approbationAC`, `approbationACGPMP`, `approbationMEF`, `enregistrementImpots`, `immatriculation`, `totalJour`, `inferieur60`, `inferieur90`, `inferieur120`, `superieur120`, `commentaire`, `dateInsertion`) VALUES
(1, '1', 'Etat', 'Pret de 100000000000000000 a l etat ', 'BICICI', 'AOI', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '2017-05-30', '5555000000', '2017-05-30', '2017-05-30', '2017-05-30', '2017-06-01', '2017-06-02', '2', 'OUI', 'OUI', 'OUI', 'NON', 'Super', '2017-05-30 00:00:00'),
(10, NULL, 'TEST edited', 'tatarata edited', 'BND', 'AON', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '455555', '2017-06-12', '2017-06-13', '2017-06-14', '2017-06-15', '2017-06-16', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'Huge !!!!!!!!!!!!', '2017-06-04 12:17:40'),
(11, NULL, 'TEST edited', 'test edited', 'test edited', 'test lansana', '2017-06-10', '2017-06-10', '2017-06-04', '2017-06-04', '2017-06-10', '2017-06-04', '2017-06-10', '2017-06-18', '2017-06-04', '2017-06-18', '2017-06-04', '50000000', '2017-06-16', '2017-06-23', '2017-06-24', '2017-06-17', '2017-06-17', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'un bon projet', '2017-06-04 16:47:38'),
(12, NULL, 'test lansana edited', 'test lansana edited', 'test lansana edited', 'test lansana', '2017-06-10', '2017-06-17', '2017-06-18', '2017-06-19', '2017-06-20', '2017-06-21', '2017-06-22', '2017-06-23', '2017-06-24', '2017-06-25', '2017-06-26', '500000', '2017-06-27', '2017-06-28', '2017-06-29', '2017-06-30', '2017-07-01', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'test lansana', '2017-06-04 16:49:53'),
(13, NULL, 'test', 'test', 'test', 'test', '2017-06-10', '2017-06-10', '2017-06-04', '2017-06-04', '2017-06-10', '2017-06-04', '2017-06-10', '2017-06-18', '2017-06-04', '2017-06-18', '2017-06-04', '50000000', '2017-06-16', '2017-06-23', '2017-06-24', '2017-06-17', '2017-06-17', '0', 'NON', 'NON', 'NON', 'NON', 'un bon projet', '2017-06-04 17:29:43'),
(14, NULL, 'TEST edited', 'tatarata edited', 'BND', 'AON', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '455555', '2017-06-12', '2017-06-13', '2017-06-14', '2017-06-15', '2017-06-16', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'Huge !!!!!!!!!!!!', '2017-06-04 18:13:40'),
(15, NULL, 'TEST edited', 'tatarata edited', 'BND', 'AON', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '455555', '2017-06-12', '2017-06-13', '2017-06-14', '2017-06-15', '2017-06-16', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'Huge !!!!!!!!!!!!', '2017-06-04 18:13:52'),
(16, NULL, 'TEST edited', 'tatarata edited', 'BND', 'AON', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '455555', '2017-06-12', '2017-06-13', '2017-06-14', '2017-06-15', '2017-06-16', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'Huge !!!!!!!!!!!!', '2017-06-04 18:14:01'),
(17, NULL, 'TEST edited', 'tatarata edited', 'BND', 'AON', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '455555', '2017-06-12', '2017-06-13', '2017-06-14', '2017-06-15', '2017-06-16', '0', 'OUI', 'OUI', 'OUI', 'OUI', 'Huge !!!!!!!!!!!!', '2017-06-04 18:14:22'),
(18, NULL, 'dernier test', 'dernier test', 'dernier test', 'dernier test', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '2017-06-10', '2017-06-11', '2017-06-12', '2017-06-13', '2017-06-14', '6000000', '2017-06-16', '2017-06-17', '2017-06-18', '2017-06-19', '2017-06-20', '0', 'NON', 'NON', 'NON', 'NON', 'jeuduejdue', '2017-06-04 18:32:48'),
(19, NULL, 'oupreoiure', 'oupreoiure', 'oupreoiure', 'oupreoiure', '2017-06-17', '2017-06-10', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-16', '2017-06-04', '2017-06-04', '2017-06-04', '2017-06-04', '2017-06-10', '88989898', '2017-06-10', '2017-06-09', '2017-06-04', '2017-06-04', '2017-06-03', '0', 'NON', 'NON', 'NON', 'NON', 'reoiprepoi[re', '2017-06-04 18:42:04');

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
  `levelUser` int(2) NOT NULL DEFAULT '1',
  `recevoirEmail` int(2) DEFAULT '0',
  `dateInscription` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `emailUser`, `passUser`, `telephoneUser`, `levelUser`, `recevoirEmail`, `dateInscription`) VALUES
(1, 'Sylla', 'Lansana', 'lansanalsm@gmail.com', 'lansana', '666494787', 1, 1, '2016-12-29 21:57:36'),
(2, 'testeur', 'testeur', 'beta@testeur.test', 'test123', NULL, 1, 1, '2017-03-15 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`idAlert`);

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
-- AUTO_INCREMENT pour la table `alert`
--
ALTER TABLE `alert`
  MODIFY `idAlert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
