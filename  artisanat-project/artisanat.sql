-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 03 Juillet 2012 à 21:45
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
  `type_demandeur` varchar(1) NOT NULL,
  PRIMARY KEY (`id_demande`),
  UNIQUE KEY `id_demande` (`id_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `etat`, `id_proprietaire`, `commentaire`, `date_creation`, `date_publication`, `derniere_date_modification`, `type_demandeur`) VALUES
(1, 'En cours', 13, 'Ce chantier est en cours', '2012-07-01 00:00:00', '0000-00-00 00:00:00', '2012-07-01 00:00:00', 'u'),
(2, 'Terminé', 12, 'Ce chantier est terminé', '2012-07-01 00:00:00', '0000-00-00 00:00:00', '2012-07-01 00:00:00', 'u');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `devis`
--

INSERT INTO `devis` (`id_devis`, `id_demande`, `id_entreprise`, `prix`, `commentaire`, `date_prevision_debut`, `date_publication`, `derniere_date_modification`, `consulte_par_demandeur`) VALUES
(1, 1, 2, 12000, 'Rien à dire', '2012-07-01 00:00:00', '2012-07-01 00:00:00', '2012-07-01 00:00:00', 0),
(2, 2, 2, 20000, 'Deuxième chantier', '2012-07-01 00:00:00', '2012-07-01 00:00:00', '2012-07-01 00:00:00', 0);

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
  `siret` varchar(14) NOT NULL,
  `site` varchar(250) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `portable` varchar(10) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `mail`, `nom`, `denomination_sociale`, `active`, `date_enregistrement`, `telephone_entreprise`, `adresse`, `cp`, `ville`, `siret`, `site`, `fax`, `portable`) VALUES
(2, 'bouchaud.co@gmail.com', 'Bouchaud And Co', 'EURL', 1, '2012-07-01 15:05:54', '0344501106', '21 Impasse des Roches', '60840', 'Breuil le Sec', '12345678912345', 'http://www.bouchaud-and-com.com', '', '0626730215');

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

--
-- Contenu de la table `lien_utilisateur_entreprise`
--

INSERT INTO `lien_utilisateur_entreprise` (`id_user`, `id_entreprise`, `droit`, `date_debut`, `date_fin`) VALUES
(1, 2, 0, '2012-07-01 15:05:54', '0000-00-00 00:00:00');

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
  `date_enregistrement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_enregistrement` varchar(40) NOT NULL,
  `code_activation` varchar(32) NOT NULL,
  `activation` int(1) NOT NULL,
  `date_activation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `mail`, `password`, `nom`, `prenom`, `date_naissance`, `sexe`, `adresse`, `cp`, `ville`, `telephone_domicile`, `telephone_portable`, `date_enregistrement`, `ip_enregistrement`, `code_activation`, `activation`, `date_activation`) VALUES
(1, 'nrenaudb@hotmail.com', 'ab4f63f9ac65152575886860dde480a1', 'HAYEME', 'Renaud', '2012-07-10', 'm', '28 rue du saulon', 60840, 'Nointel', '0344782552', '0675681618', '2012-07-03 20:55:51', '127.0.0.1', '', 1, '0000-00-00 00:00:00'),
(11, 'renaud.hayeme@gmail.com', '8366133261574bbb6e43c2562339b739', 'blabla', 'coucou', '1997-01-18', 'm', 'rfzeqdsvcx', 60600, 'dfsvgbddvs', '0344521575', '0666666666', '2012-07-03 21:31:05', '127.0.0.1', 'f60e74d20b135d2c5b4de54ac81d25d2', 1, '2012-07-03 21:31:05'),
(13, 'fsf@dfds.fr', 'ab4f63f9ac65152575886860dde480a1', 'zerregh', 'sdfqs', '1995-01-17', 'm', 'sdqfg', 55555, 'fdsfsd', '1111111111', '1111111111', '2012-06-28 10:51:06', '127.0.0.1', 'ba24cc9ba009b8931db0f2940b0d2e4a', 0, '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
