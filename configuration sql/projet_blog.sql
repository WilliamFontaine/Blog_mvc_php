-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 19 déc. 2021 à 19:33
-- Version du serveur : 10.5.4-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAuteur` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idAuteur` (`idAuteur`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `idAuteur`, `titre`, `contenu`, `date`) VALUES
(1, 3, 'Patron Observateur', '                                                                                                                                                \r\n<div>\r\n    <h4>Type :	 Co  (Comportemental)</h4>\r\n    <h5>Intention :</h5>\r\n<br>	\r\n    <p>Définit une interdépendance de type un à plusieurs, de telle façon que quand un objet change d\'état, tous ceux qui en dépendent en soient notifiés et automatiquement mis à jour.</p>\r\n<br>\r\n    <h5>Applicabilité :</h5>\r\n<br>\r\n    <p>Utilisez l\'Observateur dans les situations suivantes :      \r\n<br>\r\n<br>\r\n    - Quand un concept a deux représentations, l\'une dépendant de l\'autre. Encapsuler ces deux représentations dans des objets distincts permet de les réutiliser et de les modifier indépendamment.\r\n<br>\r\n    - Quand la modification d\'un objet nécessite de modifier les autres, et que l\'on ne sait pas combien sont ces autres.\r\n<br>\r\n    - Quand un objet doit être capable de faire une notification à d\'autres objets sans faire d\'hypothèses sur la nature de ces objets. En d\'autres termes, quand ces objets ne doivent pas être trop fortement couplés.</p>\r\n    <h4>Participants au patron :</h4>\r\n<br>\r\n    <h5>Sujet</h5>\r\n<br>\r\n    <p>Connaît ses observateurs. Un nombre quelconque d\'observateurs peut observer un sujet.\r\n        Fournit une interface pour attacher et détacher les objets observateurs.</p>\r\n    <h5>Observateur</h5>\r\n    <p>Définit une interface de mise à jour pour les objets qui doivent être notifiés de changements dans un sujet.</p>\r\n    <h5>SujetConcret</h5>\r\n<br>\r\n    <p>Mémorise les états qui intéressent les objets ObservateurConcret.\r\n        Envoie une notification à ses observateurs lorsqu\'il change d\'état.</p>\r\n    <h5>ObservateurConcret</h5>\r\n<br>\r\n    <p>Gère une référence sur un objet SujetConcret.\r\n    Mémorise l\'état qui doit rester pertinent pour le sujet.\r\n<br>\r\n        Fait l\'implémentation de l\'interface de mise à jour de l\'Observateur pour conserver la cohérence de son état avec le sujet.</p>\r\n</div>\r\n                                                                                                                                                                ', '2021-12-04'),
(22, 25, 'Patron Composite', '                                                                                                               \r\n<h3>Type :	 St  (Structurel)</h3>\r\n<br>\r\n<p>Intention :	Compose des objets en des structures arborescentes pour représenter des hiérarchies composant/composé.\r\nPermet au client de traiter d’une unique façon les objets et les combinaisons d’objets.</P>\r\n<h4>Applicabilité :	Utilisez le Composite lorsque :</h4>\r\n<p>- Vous souhaitez représenter des hiérarchies de l\'individu.</p>\r\n<p>- Vous souhaitez que le client n\'ait pas à se préoccuper de la différence entre \"combinaisons d\'objets\" et \"objets individuels\". Les clients pourront traiter de façon uniforme tous les objets de la structure composite.</p>\r\n<h4>Points forts :</h4>\r\n<p>1. Découplage et extensibilité</p>\r\n<p>1.1 Factorisation maximale de la composition</p> \r\n<p>1.2 L\'ajout ou la suppression d\'une feuille n\'implique pas de modification de code</p>\r\n<p>1.3 L\'ajout ou la suppression d\'un composite ne n\'implique pas de modification de code</p>\r\n<p>2. Protocole uniforme</p>\r\n<p>2.1 Protocole uniforme sur les opérations des objets composés</p>\r\n<p>2.2 Protocole uniforme sur la gestion de la composition</p>\r\n<p>2.3 Point d\'accès unique pour la classe client</p>\r\n<h4>Participants au patron :</h4>\r\n<h5>Composant</h5>\r\n<p>Déclare l\'interface des objets entrant dans la composition.<br>\r\nImplémente le comportement par défaut qui convient pour l\'interface commune à toutes les classes.<br>\r\nDéclare une interface pour accéder à ses composants enfants et les gérer.<br>\r\nEventuellement, il définit une interface pour accéder à un parent du composant dans une structure récursive, et l\'implémente si besoin est.</p>\r\n<h5>Feuille</h5>\r\n<p>Représente des objets feuille dans la composition. Une feuille n\'a pas d\'enfants.<br>\r\nDéfinit le comportement d\'objets primitifs dans la composition.</p>\r\n<h5>Composite</h5>\r\n<p>Définit le comportement des composants dotés d\'enfants.<br>\r\nIl stocke les composants enfants.<br>\r\nIl implémente les opérations liées aux enfants dans l\'interface Composant.</p>\r\n<h5>Client</h5>\r\n<p>Manipule les objets de la composition à l\'aide de l\'interface Composant..</p>                                                           ', '2021-12-15');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoAuteur` varchar(100) NOT NULL,
  `typeAuteur` varchar(15) NOT NULL DEFAULT 'visiteur',
  `idArticle` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idArticle` (`idArticle`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `pseudoAuteur`, `typeAuteur`, `idArticle`, `comment`, `date`) VALUES
(37, 'super-admin', 'super-admin', 1, 'Super patron de conception !', '2021-12-12'),
(51, 'anonyme', 'visiteur', 1, 'Super !', '2021-12-13');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(400) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'user',
  `inscription` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `motDePasse`, `type`, `inscription`) VALUES
(3, 'super-admin', 'super-admin@super-admin.super-admin', '$2y$10$a4Siw2.zYjwDj29HdXx7Qu043CADpgRMSpe4lHGfb6rcZa5JAiyam', 'super-admin', '2021-12-04'),
(24, 'admin', 'admin@admin.admin', '$2y$10$4bzOMT9fOeHvfp3048jO1OHSRLBSil6LMFMsBZbL13aDfjVjQnMUm', 'admin', '2021-12-12'),
(25, 'ecrivain', 'ecrivain@ecrivain.ecrivain', '$2y$10$HGNMPCemHLU3kbrmxZTnxOnfe4H5I0yI5ENwQHaFQC5Zuj27/PLM6', 'ecrivain', '2021-12-12'),
(26, 'user', 'user@user.user', '$2y$10$.3wA2B1VujuhSosfoywtbuWshxwdiUJAGZ.C9UqJvFTPO3.EVjGD.', 'user', '2021-12-12'),
(30, 'william', 'w@w.w', '$2y$10$OgwWZFGJtjL6w9QwfiTBKu9BHDW7EJzsOuNvpD6NCdhyoyYcmPS1K', 'super-admin', '2021-12-15');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`idAuteur`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
