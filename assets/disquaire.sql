-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 26 oct. 2020 à 04:00
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `disquaire`
--
CREATE DATABASE IF NOT EXISTS `disquaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `disquaire`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `cat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `cat`) VALUES
(1, 'variete francaise'),
(2, 'rap'),
(3, 'pop'),
(4, 'rock'),
(5, 'disco'),
(6, 'classique');

-- --------------------------------------------------------

--
-- Structure de la table `compersonnalise`
--

CREATE TABLE `compersonnalise` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datecom` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etoile` int(11) NOT NULL,
  `album` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compersonnalise`
--

INSERT INTO `compersonnalise` (`id`, `nom`, `commentaire`, `datecom`, `etoile`, `album`) VALUES
(1, 'cédric', 'top la classe', '2020-10-25 07:25:35', 5, 4),
(2, 'cedric', 'c\'est genial', '2020-10-25 07:25:35', 4, 5),
(21, 'Amo', 'Mon préféré !!', '2020-10-25 03:23:54', 5, 4),
(22, 'Amo', 'vraiment bon :)', '2020-10-06 02:24:47', 4, 22),
(23, 'Amo', 'Un grand classic', '2020-10-21 23:25:03', 4, 2),
(24, 'Amo', 'un morceau qui mérite d\'être écouter ', '2020-09-26 02:25:41', 5, 21),
(25, 'Ced', 'By the way ;)', '2020-10-26 03:26:34', 5, 16),
(26, 'Ced', 'Une légende !', '2020-10-21 02:26:47', 4, 13),
(27, 'Ced', 'Ha ce Renée... Toujours le mot pour rire ', '2020-10-26 03:27:14', 3, 3),
(28, 'Ced', 'Un gars formidable !!', '2020-10-21 02:27:40', 5, 9),
(29, 'Cos', 'All Stars .', '2020-10-11 02:19:43', 5, 7),
(30, 'Cos', 'Mais ... Allons-y !!  \r\n;)', '2020-10-26 03:30:48', 5, 16),
(31, 'Cos', 'Un mec sympa au premier abord ^^', '2019-10-26 02:31:17', 4, 19),
(32, 'Cos', 'Un grand classic !! \r\nOn ne s\'en passe pas ...', '2020-10-26 03:31:43', 4, 11),
(33, 'Cos', 'Vivement le prochain concert', '2020-10-26 03:32:01', 4, 23),
(34, 'Cos', 'Legendary\r\n', '2020-10-23 09:12:05', 5, 6),
(35, 'Cos', 'Plein d\'autres à écouter !', '2020-10-26 03:32:40', 4, 4),
(36, 'Cos', 'Hooooooo ca c\'est sympa ^^', '2020-10-16 02:33:02', 5, 1),
(37, 'Will', 'Le son pour me mettre en forme tous les matins :)', '2020-10-26 03:34:20', 4, 18),
(38, 'Will', 'Il en a fait des meilleures...', '2020-10-26 03:34:47', 2, 7),
(39, 'Will', 'Tu es parti trop tot mais tu resteras à jamais dans nos coeurs', '2019-11-26 03:35:08', 4, 13),
(40, 'Will', '5etoiles .', '2020-10-25 23:35:30', 5, 20),
(41, 'Will', 'Bob 4 ever', '2020-10-26 03:35:45', 4, 6),
(42, 'Will', 'Joli photo ^^', '2020-10-15 03:36:01', 3, 2),
(43, 'Will', ';)', '2020-10-26 03:36:13', 4, 5),
(44, 'Will', 'Je t\'aime Reney', '2020-10-20 02:36:31', 4, 3),
(45, 'Will', 'Tout à fait mon son !', '2020-10-26 03:36:48', 4, 21),
(46, 'Sarah', 'A samedi au makumba night pour danser sur du BonneyM', '2020-10-26 03:38:07', 3, 18),
(47, 'Sarah', 'yeahhh\r\n KillMe plz mdrrrr ', '2020-10-26 03:38:46', 4, 19),
(48, 'Sarah', 'moins 2 étoiles pour la photo qui a mal vieillie', '2020-10-21 12:39:15', 2, 20),
(49, 'Sarah', 'Grand morceau', '2020-10-26 03:39:26', 4, 1),
(50, 'Sarah', 'Chacun de ces sons est une bénédiction', '2020-10-26 03:39:57', 3, 6),
(51, 'Sarah', 'Iron mannnnnn !!', '2020-10-26 03:40:24', 4, 16),
(52, 'Sarah', 'Ma préférée :)', '2020-10-26 03:40:46', 3, 4),
(53, 'Sarah', 'Hummmm sexy ce jeune ;)', '2020-10-26 03:41:05', 4, 9),
(54, 'Echo', 'Je les adore mais ils ne sortent pas vraiment de nouveaux tubes. Ils se reposent sur leurs lauriers ...\r\nDommage', '2020-10-26 03:42:28', 3, 15),
(55, 'Echo', 'divide divide divide !!', '2020-10-26 03:42:59', 2, 12),
(56, 'Echo', 'mon fils est fan ', '2020-10-26 03:43:30', 4, 3),
(57, 'Echo', 'On en fait plus des comme toi \r\n\r\n1love', '2020-10-26 03:44:04', 4, 6),
(58, 'Echo', 'une éternité que je ne l\'ai pas écoutée', '2020-10-26 03:44:29', 4, 4),
(59, 'Alvin', 'j\'adore... C\'est génial', '2020-10-26 03:46:11', 4, 9),
(60, 'Alvin', 'RAS toujours au top', '2020-10-26 03:46:25', 4, 21),
(61, 'Alvin', 'un bon muse des famille', '2020-10-26 03:46:41', 4, 23),
(62, 'Alvin', 'Un grand classic que je joue a la guitare. \r\nJe me produis tous les jeudi soir à Belleville au bistrot comptoir\r\nVenez nombreux !!!', '2020-10-26 03:48:05', 5, 1),
(63, 'Alvin', 'Papa !', '2020-10-26 03:48:27', 5, 22);

-- --------------------------------------------------------

--
-- Structure de la table `etagere`
--

CREATE TABLE `etagere` (
  `id` int(11) NOT NULL,
  `pochette` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` int(11) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etagere`
--

INSERT INTO `etagere` (`id`, `pochette`, `titre`, `artiste`, `categorie`, `prix`) VALUES
(1, 'police.jpg', 'Roxanne', 'The Police', 4, 3),
(2, 'cabrel.jpg', 'Je l\'aime à mourrir', 'Francis Cabrel', 1, 2),
(3, 'rene.jpg', 'mignon', 'Renée la Taupe', 1, 1),
(4, 'dragon.jpg', 'Origins', 'Imagine Dragons', 3, 4),
(5, 'shaka.jpg', 'Black Pixel Ape', 'Shaka Ponk', 4, 5),
(6, 'marley.jpg', 'Uprising', 'Bob Marley', 2, 5),
(7, 'kravitz.jpg', 'American Woman', 'Lenny Kravitz', 4, 4),
(8, 'michael.jpg', 'Ladies & Gentlemen', 'Georges Michael', 3, 3),
(9, 'ritchy.jpg', 'say you say me', 'Lionel Ritchie', 3, 2),
(11, 'nirvana.jpg', 'Nevermind', 'Nirvana', 3, 4),
(12, 'sheran.jpg', 'Divide', 'Ed Sheran', 3, 5),
(13, 'johnny.jpg', 'Je te promets', 'Johnny Halliday', 4, 2),
(15, 'abba.jpg', 'Gimme Gimme Gimme', 'Abba', 5, 3),
(16, 'acdc.jpg', 'Highway To Hell', 'ACDC', 4, 4),
(17, 'clerc.jpg', 'Melissa', 'Julien Clerc', 1, 3),
(18, 'daddy.jpg', 'Daddy Cool', 'Bonney M', 5, 2),
(19, 'killforme.jpg', 'kill for me', 'Marilyn Manson', 4, 4),
(20, 'laisse.jpg', 'Laisse Béton', 'Renaud', 1, 4),
(21, 'rolling.jpg', 'Some Girls', 'Rolling Stones', 4, 5),
(22, 'zeppelin.jpg', 'mothership', 'Led Zeppelin', 4, 3),
(23, 'simu.jpg', 'Simulation Theorie', 'Muse', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `prix` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='listing des prix';

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `prix`) VALUES
(1, '9.99'),
(2, '12.99'),
(3, '14.99'),
(4, '16.69'),
(5, '19.99');

-- --------------------------------------------------------

--
-- Structure de la table `resa`
--

CREATE TABLE `resa` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `resa`
--

INSERT INTO `resa` (`id`, `client`, `produit`) VALUES
(1, 8, 18),
(2, 8, 16),
(3, 8, 20),
(6, 10, 5),
(7, 10, 20),
(8, 8, 6),
(9, 10, 5),
(10, 10, 12),
(11, 10, 4),
(12, 8, 16),
(13, 9, 7),
(14, 11, 5),
(15, 11, 18),
(16, 11, 20),
(17, 11, 5),
(18, 12, 18),
(19, 12, 22),
(20, 12, 11),
(21, 12, 8),
(22, 12, 3),
(23, 12, 18),
(24, 12, 19),
(25, 13, 5),
(26, 13, 15),
(27, 13, 12),
(28, 13, 6),
(29, 13, 4),
(30, 14, 5),
(31, 14, 7),
(32, 14, 18),
(33, 14, 13),
(34, 14, 8),
(35, 14, 11),
(36, 14, 9),
(37, 14, 23),
(38, 14, 1),
(39, 14, 22);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `date`, `login`, `password`) VALUES
(7, '2001-07-21 19:07:01', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(8, '2020-10-23 19:03:30', 'ced', '159ba4a89132f47014da2c413f2ad52a'),
(9, '2020-10-23 19:03:43', 'cos', '4d00d79b6733c9cc066584a02ed03410'),
(10, '2020-10-23 19:04:17', 'amo', '3d5390642ff7a7fd9b7ab8bac4ec3ec5'),
(11, '2020-10-16 02:33:47', 'Will', '9dd4e461268c8034f5c8564e155c67a6'),
(12, '2020-01-26 03:57:02', 'Sarah', '9dd4e461268c8034f5c8564e155c67a6'),
(13, '2020-07-26 07:21:33', 'echo', '9dd4e461268c8034f5c8564e155c67a6'),
(14, '2019-10-16 12:45:15', 'alvin', '9dd4e461268c8034f5c8564e155c67a6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compersonnalise`
--
ALTER TABLE `compersonnalise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album` (`album`);

--
-- Index pour la table `etagere`
--
ALTER TABLE `etagere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_cat` (`categorie`),
  ADD KEY `IX_prix` (`prix`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `resa`
--
ALTER TABLE `resa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_client` (`client`),
  ADD KEY `IX_produit` (`produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `compersonnalise`
--
ALTER TABLE `compersonnalise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `etagere`
--
ALTER TABLE `etagere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `resa`
--
ALTER TABLE `resa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compersonnalise`
--
ALTER TABLE `compersonnalise`
  ADD CONSTRAINT `fk_album` FOREIGN KEY (`album`) REFERENCES `etagere` (`id`);

--
-- Contraintes pour la table `etagere`
--
ALTER TABLE `etagere`
  ADD CONSTRAINT `etagere_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `etagere_ibfk_2` FOREIGN KEY (`prix`) REFERENCES `prix` (`id`);

--
-- Contraintes pour la table `resa`
--
ALTER TABLE `resa`
  ADD CONSTRAINT `resa_ibfk_1` FOREIGN KEY (`client`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `resa_ibfk_2` FOREIGN KEY (`produit`) REFERENCES `etagere` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
