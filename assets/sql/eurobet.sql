-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : dim. 11 juil. 2021 à 16:15
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210618142153', '2021-06-18 16:23:52', 84),
('DoctrineMigrations\\Version20210708200409', '2021-07-08 22:04:19', 89),
('DoctrineMigrations\\Version20210708211922', '2021-07-08 23:19:32', 82),
('DoctrineMigrations\\Version20210711123850', '2021-07-11 14:39:01', 253);

-- --------------------------------------------------------

--
-- Structure de la table `pronostic`
--

CREATE TABLE `pronostic` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `matchid` int(11) NOT NULL,
  `domicile_bet` int(11) NOT NULL,
  `exterieur_bet` int(11) NOT NULL,
  `score_bet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pronostic`
--

INSERT INTO `pronostic` (`id`, `userid`, `matchid`, `domicile_bet`, `exterieur_bet`, `score_bet`) VALUES
(1, 1, 3, 4, 3, 3),
(3, 1, 3, 2, 1, 1),
(4, 1, 4, 5, 3, -1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `score`) VALUES
(1, 'admin@admin.fr', '[\"ROLE_USER\"]', '$2y$13$02nhwQqSSmQl/mOMJPhwCeMBUWXQiRSeRY1.ntyZiAR12i1Uaea8O', 4),
(2, 'bonsoir@bonsoir.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$xL9/tQFM0m7MFeNJw88s9Q$+5Ov+sQTlutIGj5xWDU37qLuPStt8kEMA0HJt7Xucyw', 123),
(3, 'monemail@ndd.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$WiCRh+l+W7zvayCEa6bwQw$oKjwa833UYzO12QGbMH1IsafFNR/Uzi5MF19IDXtJTA', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `pronostic`
--
ALTER TABLE `pronostic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pronostic`
--
ALTER TABLE `pronostic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
