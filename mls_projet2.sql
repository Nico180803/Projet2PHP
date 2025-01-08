-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 05 jan. 2025 à 16:18
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mls_projet2`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id_auteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `ref_pays` int(11) DEFAULT '11',
  PRIMARY KEY (`id_auteur`),
  KEY `fk_auteur_pays` (`ref_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom`, `prenom`, `date_naissance`, `ref_pays`) VALUES
(2, 'Hugo', 'Victor', '1802-02-18', 1),
(3, 'Sartre', 'Jean-Paul', '1905-06-18', 1),
(6, 'Zola', 'Emile', '0001-01-01', 2),
(7, 'Verne', 'Jules', '1905-03-24', 1),
(8, 'De Maupassant', 'Guy', '1850-08-05', 1),
(13, 'Anonyme', '', '0001-01-01', 11);

-- --------------------------------------------------------

--
-- Structure de la table `ecrire`
--

DROP TABLE IF EXISTS `ecrire`;
CREATE TABLE IF NOT EXISTS `ecrire` (
  `ref_livre` int(11) NOT NULL,
  `ref_auteur` int(11) NOT NULL DEFAULT '13',
  PRIMARY KEY (`ref_livre`,`ref_auteur`),
  KEY `fk_ecrire_auteur` (`ref_auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecrire`
--

INSERT INTO `ecrire` (`ref_livre`, `ref_auteur`) VALUES
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `edition`
--

DROP TABLE IF EXISTS `edition`;
CREATE TABLE IF NOT EXISTS `edition` (
  `id_edition` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_edition`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `edition`
--

INSERT INTO `edition` (`id_edition`, `nom`) VALUES
(1, 'Lemoine'),
(2, 'Pocket'),
(3, 'Le Livre de poche jeunesse'),
(4, 'Folio classique'),
(5, 'Le Livre de poche'),
(6, 'Gallimard');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id_emprunt` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `delais` int(3) NOT NULL,
  `ref_exemplaire` int(11) NOT NULL,
  `ref_inscrit` int(11) NOT NULL,
  PRIMARY KEY (`id_emprunt`),
  KEY `fk_emprunt_exemplaire` (`ref_exemplaire`),
  KEY `fk_emprunt_inscrit` (`ref_inscrit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `date`, `delais`, `ref_exemplaire`, `ref_inscrit`) VALUES
(1, '2021-01-01', 365, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `id_exemplaire` int(11) NOT NULL AUTO_INCREMENT,
  `ref_livre` int(11) NOT NULL,
  `ref_edition` int(11) NOT NULL,
  PRIMARY KEY (`id_exemplaire`),
  KEY `fk_exemplaire_edition` (`ref_edition`),
  KEY `fk_exemplaire_livre` (`ref_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`id_exemplaire`, `ref_livre`, `ref_edition`) VALUES
(1, 6, 1),
(2, 1, 2),
(3, 1, 2),
(4, 2, 3),
(5, 2, 3),
(6, 2, 4),
(7, 3, 5),
(8, 4, 6),
(9, 6, 1),
(10, 6, 1),
(11, 6, 1),
(12, 6, 1),
(13, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `id_inscrit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel_fixe` varchar(15) NOT NULL,
  `tel_portable` varchar(15) NOT NULL,
  `rue` varchar(80) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id_inscrit`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inscrit`
--

INSERT INTO `inscrit` (`id_inscrit`, `nom`, `prenom`, `email`, `tel_fixe`, `tel_portable`, `rue`, `cp`, `ville`, `mdp`) VALUES
(1, 'Lemoine', 'Sébastien', 's.lemoine@lprs.fr', '0', '33675574985', '5', '93440', 'Dugny', '1'),
(17, 'A', 'A', 'A@A.fr', '0', '0', '0', '0', '0', '9876543210');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id_livre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `resume` text NOT NULL,
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `titre`, `annee`, `resume`) VALUES
(1, 'Le Dernier Jour d\'un condamné', '1832', 'Ce roman se présente comme le journal d\'un condamné à mort écrit durant les vingt-quatre dernières heures de son existence dans lequel il raconte ce qu\'il a vécu depuis le début de son procès jusqu\'au moment de son exécution, soit environ cinq semaines de sa vie. [...]'),
(2, 'Notre-Dame de Paris', '1831', 'L\'intrigue se déroule à Paris en 1482. Les deux premiers livres (I et II) du roman suivent Pierre Gringoire, poète sans le sou. Gringoire est l\'auteur d\'un mystère qui doit être représenté le 6 janvier 1482 au Palais de justice en l\'honneur d\'une ambassade flamande. [...]'),
(3, 'Les Misérables', '1862', 'L\'action se déroule en France au cours du premier tiers du XIXe siècle, entre la bataille de Waterloo (1815) et les émeutes de juin 1832. On y suit, sur cinq tomes3, la vie de Jean Valjean, de sa sortie du bagne jusqu\'à sa mort. [...]'),
(4, 'L\'Être et le Néant', '1943', 'L\'être ne saurait engendrer que l\'être et, l\'homme étant englobé dans un processus générationnel, il ne sortira de lui que de « l\'être ».[...]'),
(5, 'L\'existentialisme est un humanisme', '1946', 'Sartre y présente son existentialisme et répond aux critiques faites par des penseurs chrétiens ou marxistes, et en particulier par les communistes - dont il souhaite se rapprocher. Ce texte constitue une sorte d\'introduction à l\'existentialisme. Toutefois sa simplicité a par la suite conduit Sartre à le renier. [...]'),
(6, 'Le dieu de la programmation', '2005', 'En fait, je suis trop fort'),
(23, 'AA', '1900', 'AA');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom_pays`) VALUES
(1, 'France'),
(2, 'Espagne'),
(3, 'Portugal'),
(4, 'Amerique'),
(5, 'Belgique'),
(6, 'Allemagne'),
(7, 'Italie'),
(8, 'Suisse'),
(9, 'Grèce'),
(11, 'Aucun');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD CONSTRAINT `fk_auteur_pays` FOREIGN KEY (`ref_pays`) REFERENCES `pays` (`id_pays`) ON DELETE SET NULL;

--
-- Contraintes pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD CONSTRAINT `fk_ecrire_auteur` FOREIGN KEY (`ref_auteur`) REFERENCES `auteur` (`id_auteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ecrire_livre` FOREIGN KEY (`ref_livre`) REFERENCES `livre` (`id_livre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `fk_emprunt_exemplaire` FOREIGN KEY (`ref_exemplaire`) REFERENCES `exemplaire` (`id_exemplaire`),
  ADD CONSTRAINT `fk_emprunt_inscrit` FOREIGN KEY (`ref_inscrit`) REFERENCES `inscrit` (`id_inscrit`);

--
-- Contraintes pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `fk_exemplaire_edition` FOREIGN KEY (`ref_edition`) REFERENCES `edition` (`id_edition`),
  ADD CONSTRAINT `fk_exemplaire_livre` FOREIGN KEY (`ref_livre`) REFERENCES `livre` (`id_livre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
