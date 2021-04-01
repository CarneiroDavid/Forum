-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 mars 2021 à 14:39
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nom`) VALUES
(3, 'Sports'),
(4, 'Jeux'),
(6, 'Cinéma');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `msg` text NOT NULL,
  `idSujet` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `idUser`, `msg`, `idSujet`) VALUES
(12, 1, 'test2', 5),
(13, 1, 'test', 5),
(14, 2, 'test', 5),
(19, 1, 'test', 2),
(34, 18, 'ytgvgtt', 5),
(35, 18, '&lt;div style=&#039;color:red&#039;&gt;Hmmm&lt;/div&gt;', 5);

-- --------------------------------------------------------

--
-- Structure de la table `moderateurs`
--

DROP TABLE IF EXISTS `moderateurs`;
CREATE TABLE IF NOT EXISTS `moderateurs` (
  `idCategorie` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `pseudo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `moderateurs`
--

INSERT INTO `moderateurs` (`idCategorie`, `idUser`, `pseudo`) VALUES
(3, 18, '&lt;h1&gt;Bastioz&lt;/h1&gt;'),
(3, 26, 'User1');

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

DROP TABLE IF EXISTS `statuts`;
CREATE TABLE IF NOT EXISTS `statuts` (
  `idStatut` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatut`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statuts`
--

INSERT INTO `statuts` (`idStatut`, `statut`) VALUES
(1, 'Admin'),
(2, 'Modo'),
(3, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `idSujet` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`idSujet`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`idSujet`, `nom`, `idUser`, `pseudo`, `idCategorie`, `msg`) VALUES
(1, 'Apex Legend', 1, 'SuperAdmin', 4, 'Meilleur Battle Royal'),
(2, 'Foot', 1, 'SuperAdmin', 3, 'Meilleur Sports'),
(5, 'Hmmmm', 18, '&lt;h1&gt;Bastioz&lt;/h1&gt;', 3, '&lt;script&gt;function a(){ for(i=0;i&lt;=3;i++){window.alert(i);}}&lt;/script&gt;&lt;input type=&#039;button&#039; onclick=&#039;a()&#039;&gt;'),
(6, 'fghgfhgfhf', 18, '&lt;h1&gt;Bastioz&lt;/h1&gt;', 5, 'fghfhfhfhgf');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `pdp` varchar(150) DEFAULT NULL,
  `statut` varchar(100) NOT NULL DEFAULT 'membre',
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `identifiant` (`identifiant`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `identifiant`, `email`, `nom`, `prenom`, `pseudo`, `dateNaiss`, `mdp`, `pdp`, `statut`) VALUES
(1, 'carneirod1', 'test@gmail.com', 'David', 'David', 'SuperAdmin', '2000-02-23', '$2y$10$ggW5llHTJPSG1D4ByXmf6.eWq5u.728pj3DV0Y7d4F5W1NvOMIMyO', '../image/melio.jpg', 'Admin'),
(2, 'Carneiro', 'david@gmail.com', 'Carneiro', 'David', 'XxX_Moi_XxX', '2000-02-23', '$2y$10$sCP5Y/Us.8HKkup8UTDSuuCrEU9ur0a0Oal7HNthASJgolyabL882', '../image/téléchargement.png', 'membre'),
(18, 'BLeraut72', 'bastien.leraut@free.fr', '', 'Bastien', '&lt;h1&gt;Bastioz&lt;/h1&gt;', '1999-05-07', '$2y$10$2cFUZrjXF2vlD6hicvz8CuQkBcRbpxEFblKcfe4EyBvhgIvNr/ye2', '../image/téléchargement.png', 'Modo'),
(26, 'User1', 'User.Un@gmail.com', 'Utilisateur', 'Un', 'User1', '2021-03-10', '$2y$10$oY5dESVAp/3KACdapz7wIeu/lE1EaPPEVBepG2N5GrvLbng35vP.i', NULL, 'membre');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
