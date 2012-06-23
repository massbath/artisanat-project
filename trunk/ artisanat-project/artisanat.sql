-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 20 Mai 2012 à 14:39
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `artisanat`
--

-- --------------------------------------------------------

--
-- Structure de la table `corps_metier`
--

CREATE TABLE IF NOT EXISTS `corps_metier` (
  `id_corps_metier` int(8) NOT NULL AUTO_INCREMENT,
  `label` varchar(30) NOT NULL,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`id_corps_metier`),
  UNIQUE KEY `id_corps_metier` (`id_corps_metier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int(8) NOT NULL AUTO_INCREMENT,
  `etat` varchar(30) NOT NULL,
  `id_proprietaire` int(8) NOT NULL,
  `commentaire` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_publication` datetime NOT NULL,
  `derniere_date_modification` datetime NOT NULL,
  PRIMARY KEY (`id_demande`),
  UNIQUE KEY `id_demande` (`id_demande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE IF NOT EXISTS `devis` (
  `id_devis` int(8) NOT NULL AUTO_INCREMENT,
  `id_demande` int(8) NOT NULL,
  `id_entreprise` int(8) NOT NULL,
  `prix` float NOT NULL,
  `commentaire` text NOT NULL,
  `date_prevision_debut` datetime NOT NULL,
  `date_publication` datetime NOT NULL,
  `derniere_date_modification` datetime NOT NULL,
  `consulte_par_demandeur` int(11) NOT NULL,
  PRIMARY KEY (`id_devis`),
  UNIQUE KEY `id_devis` (`id_devis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int(8) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `denomination_sociale` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `telephone_entreprise` varchar(10) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lien_demande_corps_metier`
--

CREATE TABLE IF NOT EXISTS `lien_demande_corps_metier` (
  `id_demande` int(8) NOT NULL,
  `id_corps_metier` int(8) NOT NULL,
  `niveau_importance` int(2) NOT NULL,
  PRIMARY KEY (`id_demande`,`id_corps_metier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lien_entreprise_corps_metier`
--

CREATE TABLE IF NOT EXISTS `lien_entreprise_corps_metier` (
  `id_entreprise` int(8) NOT NULL,
  `id_corps_metier` int(8) NOT NULL,
  `niveau_importance` int(2) NOT NULL,
  PRIMARY KEY (`id_entreprise`,`id_corps_metier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lien_utilisateur_entreprise`
--

CREATE TABLE IF NOT EXISTS `lien_utilisateur_entreprise` (
  `id_user` int(8) NOT NULL,
  `id_entreprise` int(8) NOT NULL,
  `droit` int(3) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id_user`,`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(8) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `cp` int(6) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `telephone_domicile` varchar(10) NOT NULL,
  `telephone_portable` varchar(10) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
