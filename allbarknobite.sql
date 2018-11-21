-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 21 nov. 2018 à 03:59
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `allbarknobite`
--

-- --------------------------------------------------------

--
-- Structure de la table `dogs`
--

CREATE TABLE `dogs` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `owner` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_bin DEFAULT 'dog.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `dogs`
--

INSERT INTO `dogs` (`ID`, `Name`, `Age`, `owner`, `image`) VALUES
(1, 'Ace', 7, 'Aeroceli', 'dog.png'),
(2, 'Apollo', 5, 'Ataviacce', 'dog.png'),
(3, 'Bailey', 1, 'Attrakefa', 'dog.png'),
(4, 'Bandit', 3, 'GigglyPierce', 'dog.png'),
(5, 'Baxter', 11, 'Grantersk', 'dog.png');

-- --------------------------------------------------------

--
-- Structure de la table `playdates`
--

CREATE TABLE `playdates` (
  `dog1` int(11) NOT NULL,
  `dog2` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `playdates`
--

INSERT INTO `playdates` (`dog1`, `dog2`, `date`) VALUES
(1, 2, '2018-12-20'),
(3, 4, '2018-11-15'),
(5, 3, '2019-01-16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('Aeroceli', 'mcnihil@icloud.com', 'AAE79D010ED41E2D5038187157331AD3BD0C3300F5E8E96F0B29E06AEC172882'),
('Ataviacce', 'jgoerzen@live.com', '58443D7291EABD339BE0CE212D586DD8E0866DB7A2FBA979A709DEECC0334644'),
('Attrakefa', 'valdez@gmail.com', '39D0E706DCD5D6949A67B4A3F35C207359FEC555AD29DF5E6C24C643CA3136CB'),
('GigglyPierce', 'matsn@verizon.net', '1C057F698635CA9194271CD675E156C0FB7713A874F3417E5F43DB86B7A25C9F'),
('Grantersk', 'kronvold@outlook.com', '1997AA893245803A028708DFC81A3D067F469B2CF4E54AB4DCAA6302F21095C3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `owner` (`owner`);

--
-- Index pour la table `playdates`
--
ALTER TABLE `playdates`
  ADD KEY `dog1` (`dog1`),
  ADD KEY `dog2` (`dog2`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dogs`
--
ALTER TABLE `dogs`
  ADD CONSTRAINT `dogs_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `playdates`
--
ALTER TABLE `playdates`
  ADD CONSTRAINT `playdates_ibfk_1` FOREIGN KEY (`dog1`) REFERENCES `dogs` (`ID`),
  ADD CONSTRAINT `playdates_ibfk_2` FOREIGN KEY (`dog2`) REFERENCES `dogs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
