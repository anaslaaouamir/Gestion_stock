-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 07 jan. 2023 à 12:54
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_commerciale`
--

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `numclient` int(11) DEFAULT NULL,
  `numcommande` int(11) DEFAULT NULL,
  `refproduit` int(11) DEFAULT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `qtecommandee` int(11) DEFAULT NULL,
  `Nomclient` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `archive`
--

INSERT INTO `archive` (`numclient`, `numcommande`, `refproduit`, `prix_unitaire`, `qtecommandee`, `Nomclient`) VALUES
(26, 31, 10, 3100, 1, 'Walid regragui'),
(26, 31, 21, 100, 1, 'Walid regragui'),
(26, 31, 17, 50, 1, 'Walid regragui'),
(26, 33, 17, 50, 2, 'Walid regragui'),
(26, 33, 21, 100, 2, 'Walid regragui'),
(24, 34, 7, 3100, 1, 'Anas Laaouamir'),
(24, 34, 22, 100, 1, 'Anas Laaouamir');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `numclient` int(11) NOT NULL,
  `nomclient` varchar(64) NOT NULL,
  `raisonsocial` varchar(64) NOT NULL,
  `adresseclient` text NOT NULL,
  `villeclient` varchar(64) NOT NULL,
  `pays` varchar(64) NOT NULL,
  `telephone` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numclient`, `nomclient`, `raisonsocial`, `adresseclient`, `villeclient`, `pays`, `telephone`) VALUES
(24, 'Anas Laaouamir', 'Mr', 'hay chafaa', 'sale', 'Maroc', '0642900756'),
(25, 'Ayman Msimar', 'MR', 'sidi moussa', 'sale', 'Maroc', '0642564543'),
(27, 'Mohommed Laaouamir', 'Mr', 'hay chafaa', 'sale', 'Maroc', '0642900756');

--
-- Déclencheurs `client`
--
DELIMITER $$
CREATE TRIGGER `delte_cmd_cascade` BEFORE DELETE ON `client` FOR EACH ROW delete from commande where numclient=old.numclient
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `numcommande` int(11) NOT NULL,
  `numclient` int(11) NOT NULL,
  `datecommande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`numcommande`, `numclient`, `datecommande`) VALUES
(29, 24, '2023-01-07'),
(30, 25, '2023-01-07'),
(32, 27, '2023-01-07'),
(35, 24, '2023-01-07');

--
-- Déclencheurs `commande`
--
DELIMITER $$
CREATE TRIGGER `delete_lc_cascade` BEFORE DELETE ON `commande` FOR EACH ROW delete from ligne_commande where numcommande=old.numcommande
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `numcommande` int(11) NOT NULL,
  `REFproduit` int(11) NOT NULL,
  `qtecommandee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`numcommande`, `REFproduit`, `qtecommandee`) VALUES
(29, 7, 1),
(29, 17, 1),
(30, 10, 1),
(30, 21, 7),
(32, 21, 15),
(32, 17, 17),
(35, 22, 50),
(35, 21, 20),
(35, 17, 10);

--
-- Déclencheurs `ligne_commande`
--
DELIMITER $$
CREATE TRIGGER `qtestockee` AFTER DELETE ON `ligne_commande` FOR EACH ROW UPDATE produit set qtestockee=qtestockee+old.qtecommandee where refproduit=old.refproduit
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `qtestockeeup` AFTER UPDATE ON `ligne_commande` FOR EACH ROW update produit set qtestockee=qtestockee-(new.qtecommandee-old.qtecommandee) where REFproduit=new.refproduit
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `refproduit` int(11) NOT NULL,
  `nomproduit` varchar(64) NOT NULL,
  `prixunitaire` int(11) NOT NULL,
  `qtestockee` int(11) NOT NULL,
  `indisponible` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`refproduit`, `nomproduit`, `prixunitaire`, `qtestockee`, `indisponible`) VALUES
(7, 'lENOVO THINKPAD 3455', 3100, 21, '0'),
(10, 'HP elitebook 3430', 3100, 7, '0'),
(17, 'Clavier Hp', 50, 67, '0'),
(21, 'Souris HP', 100, 58, '0'),
(22, 'USB 16gb', 100, 150, '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numclient`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numcommande`),
  ADD KEY `numclient` (`numclient`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`refproduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `numclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `numcommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `refproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`numclient`) REFERENCES `client` (`numclient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
