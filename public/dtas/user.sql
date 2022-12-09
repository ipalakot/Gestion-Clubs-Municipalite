-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 déc. 2022 à 13:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-clubs-munipal`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noms` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenoms` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `noms`, `prenoms`, `login`, `image_name`) VALUES
(1, 'a.benjamin@mail.com', '[]', '$2y$13$sL0gEjMJoqHa0H31yCtuc.N3B7TD242Of0oFbMg/YbUNTEsLUDW3q', NULL, NULL, NULL, NULL),
(2, 'b.quentin@mail.com', '[]', '$2y$13$KgMMeqVDVCtqKDI.DSDVE.afZFvguT7/2chzS1yXRLDmM7ak8ypTu', NULL, NULL, NULL, NULL),
(3, 'h.kalil@mail.com', '[]', '$2y$13$k2Hy4oxrRL6lOy4wIrjRhuS5H0SZ7O4Mls6u/v84EgrMrEGpC17TC', NULL, NULL, NULL, NULL),
(4, 'l.rudy@mail.com', '[]', '$2y$13$Zr.ZkBbbsGnZ0xGwhxf/juJ6XGCNKgkjkSgZGGU1xgPlD1rk9Y0KC', NULL, NULL, NULL, NULL),
(5, 'smarwan@mail.com', '[]', '$2y$13$vdXjTdvCpu6TmO3pdo2e0e/pBC0HOGOgpcYTjMOere2wPx/zN4Y2m', NULL, NULL, NULL, NULL),
(6, 't.matthieu@mail.com', '[]', '$2y$13$uS2fbgpSQGVH83d.h0JOj.GPbwykGgU.mjMFQfEeAcviFtQKylzhi', NULL, NULL, NULL, NULL),
(7, 'admin@mail.com', '[]', '$2y$13$kV0LCxaApUAW59T1kUKqKeW.ajshHh0tumO/pjQQ4Snhs0P1j8Zqq', NULL, NULL, NULL, NULL),
(8, 'webmaster@mail.com', '[]', '$2y$13$u2cQ7mKUqu623kBnkdvl1OQ6Dqfc09u2HxHYAPONezOZOzstN1vFa', NULL, NULL, NULL, NULL),
(9, 'formateur@mail.com', '[]', '$2y$13$otlcusXr9rt.lnP.4Ih.Deme9459zEHAG6LRXHt9Hgmv1JoWexc8e', NULL, NULL, NULL, NULL),
(10, 'guinot@mail.com', '[]', '$2y$13$sjmzPgNqh4yCILrcXHESUu8BjT/ELKqcW/eFtyeBxSrXijMe743Xi', NULL, NULL, NULL, NULL),
(11, 'mattmatt.thuet@gmail.com', '[]', '$2y$13$WMvF1qdDr3wuxvPjk5iRO./L2Py2LAdwHerQoUIKxnZRd0E4w1MZW', NULL, NULL, NULL, NULL),
(12, 'testsite@mail.com', '[]', '$2y$13$JDmDuvSLpAFksAAqvkKME.29Xoj6J.4s./oqNDW1Z.VzWHz4horRK', NULL, NULL, NULL, NULL),
(13, 'ipalakot@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$yiwZyXayCywKMAYMmX7SO.ddweqVrkFBmuEtWHZSjbaDMwVlzcz9G', NULL, NULL, NULL, NULL),
(14, 'da2@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$lCjOrHnGeorY0s6eQAOdJ.2qlamQvdu4mf0BbMRlYh5X4kxyjdC/y', 'Promotion DA2', 'Stagiaire 2022-23', 'da2@mail.com', 'yoga-6393373a2f42f953987182.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
