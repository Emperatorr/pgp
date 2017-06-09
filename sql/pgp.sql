-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Juin 2017 à 20:55
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
(13, '2017-04-03', 2, 1, 'le delai permis pour la date d\'approbation AC de contrat est depassÃ©'),
(14, '2017-06-17', 2, 18, 'le delai permis pour la date d\'immatriculation du contrat est depassÃ©'),
(15, '2017-06-16', 1, 18, 'la date d\'immatriculation de ce projet n\'a pas encore Ã©tÃ© fournie alors que le delai approche '),
(16, '2017-06-06', 2, 20, 'le delai permis pour la date de rapport d\'evaluation des contrats est depassÃ©'),
(17, '2017-06-07', 2, 20, 'le delai permis pour la date de rapport d\'evaluation des contrats est depassÃ©'),
(18, '2017-06-07', 1, 21, 'la date d\'annonce du rapport d\'evaluation de ce projet n\'a pas encore Ã©tÃ© fournie alors que le delai approche '),
(19, '2017-06-07', 2, 20, 'le delai permis pour la date de rapport d\'evaluation des contrats est depassÃ©'),
(20, '2017-06-07', 1, 21, 'la date d\'annonce du rapport d\'evaluation de ce projet n\'a pas encore Ã©tÃ© fournie alors que le delai approche ');

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
(29, NULL, 'MEF', 'last trial', 'BND', 'AOI', '2017-06-01', '2017-06-02', '2017-06-01', '2017-06-04', '2017-06-06', '2017-06-09', '2017-06-10', '2017-06-11', '2017-06-13', '123456789', '2017-06-14', '987654321', '2017-06-16', '2017-06-16', '2017-06-16', '2017-06-17', '2017-06-10', '16', 'OUI', 'OUI', 'OUI', 'OUI', 'important', '2017-06-08 00:54:22'),
(30, NULL, 'MEF', 'sup 5milliard', 'BND', 'AOI', '2017-06-01', '2017-06-08', '', '', '', '', '', '', '', '6000000000', '', '', '', '', '', '', '', '7', 'OUI', 'OUI', 'OUI', 'OUI', '', '2017-06-08 02:10:26'),
(31, NULL, 'MEPUE-A', 'Marche de fournitures  cahiers', 'BND', 'AAO', '2017-06-01', '2017-06-02', '2017-06-03', '2017-06-04', '2017-06-05', '2017-06-06', '2017-06-07', '2017-06-08', '2017-06-09', '1234567', '2017-06-10', '9876543', '2017-06-12', '', '2017-06-14', '2017-06-15', '2017-06-17', '14', 'OUI', 'OUI', 'OUI', 'OUI', '', '2017-06-08 10:55:15'),
(35, NULL, 'MEPUE-A', 'titre de financement', 'FINEX', 'ED', '2017-06-03', '', '', '', '', '', '', '', '', '40000000000', '', '40000000000', '', '', '', '', '', '10', 'OUI', 'OUI', 'OUI', 'OUI', '', '2017-06-09 12:48:04'),
(36, NULL, 'MEF', 'essai drop', 'BND', 'AAO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'OUI', 'OUI', 'OUI', 'OUI', '', '2017-06-09 14:58:07'),
(37, NULL, 'MEPUE-A', 'ess', 'BND', 'ED', '2017-06-07', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'NON', 'NON', 'NON', 'NON', '', '2017-06-09 15:29:35'),
(38, NULL, 'MEF', 'notic', 'BND', 'AAO', '2017-06-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'NON', 'NON', 'NON', 'NON', '', '2017-06-09 15:41:31'),
(39, NULL, 'MEF', 'att', 'BND', 'AAO', '2017-06-15', '2017-06-21', '', '', '', '', '', '', '', '300000', '', '300000', '', '', '', '', '', '6', 'OUI', 'OUI', 'OUI', 'OUI', '', '2017-06-09 15:54:45'),
(40, NULL, 'MEF', 'cook', 'BND', 'AAO', '2017-06-09', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'NON', 'NON', 'NON', 'NON', '', '2017-06-09 18:26:43');

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
(2, 'testeur', 'testeur', 'beta@testeur.test', 'test123', NULL, 7, 1, '2017-03-15 00:00:00'),
(3, 'SOMPARE', 'Amara', 'amara@sompare.com', 'amara1234', '00000000', 2, 0, '2017-06-05 00:00:00'),
(4, 'Bangoura', 'Fatoumata', 'fatoumata@bangoura.com', 'fatoumata123', '000000000', 1, 0, '2017-06-05 00:00:00'),
(6, 'Prmp', 'Prenom prmp', 'prmp@prmp.com', 'prmp123', '000000000', 4, 0, '2017-06-05 00:00:00'),
(7, 'BOUQUET', 'Monique', 'monique@bouquet.com', 'monique123', '000000000', 5, 0, '2017-06-05 00:00:00'),
(8, 'Camara ', 'Lamine Minos', 'lamine.minos@camara.com', 'minos123', '000000000', 2, 0, '2017-06-05 00:00:00'),
(9, 'KEITA', 'Elhadj Soriba ', 'elhadj.soriba@keita.com ', 'soriba123', '000000000', 3, 0, '2017-06-06 00:00:00');

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
  MODIFY `idAlert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
