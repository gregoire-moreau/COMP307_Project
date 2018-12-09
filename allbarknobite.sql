SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `allbarknobite` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `allbarknobite`;

DROP TABLE IF EXISTS `dogs`;
CREATE TABLE IF NOT EXISTS `dogs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `owner` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_bin DEFAULT 'dog.png',
  `breed` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `dogs` (`ID`, `Name`, `Age`, `owner`, `image`, `breed`) VALUES
(1, 'Ace', 7, 'Aeroceli', 'dog.png', NULL),
(2, 'Apollo', 5, 'Ataviacce', 'dog.png', NULL),
(3, 'Bailey', 1, 'Attrakefa', 'dog.png', NULL),
(4, 'Bandit', 3, 'GigglyPierce', 'dog.png', NULL),
(5, 'Baxter', 11, 'Grantersk', 'dog.png', NULL),
(11, 'dsdfs', 2, 'sd', 'dog.png', 'dfsdf'),
(12, 'dsq', 2, 'qsd', 'dog.png', 'sqd');

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dog1` int(11) DEFAULT NULL,
  `dog2` int(11) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dog1` (`dog1`),
  KEY `dog2` (`dog2`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `friends` (`id`, `dog1`, `dog2`, `accepted`) VALUES
(1, 2, 1, 0),
(2, 3, 1, 1),
(3, 1, 4, 1);

DROP TABLE IF EXISTS `playdates`;
CREATE TABLE IF NOT EXISTS `playdates` (
  `dog1` int(11) NOT NULL,
  `dog2` int(11) NOT NULL,
  `date` date NOT NULL,
  KEY `dog1` (`dog1`),
  KEY `dog2` (`dog2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `playdates` (`dog1`, `dog2`, `date`) VALUES
(1, 2, '2018-12-20'),
(3, 4, '2018-11-15'),
(5, 3, '2019-01-16');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionID` varchar(10) COLLATE utf8_bin NOT NULL,
  `uname` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`sessionID`),
  KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `firstName` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `lastName` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `lastName`, `location`) VALUES
('Aeroceli', 'mcnihil@icloud.com', 'AAE79D010ED41E2D5038187157331AD3BD0C3300F5E8E96F0B29E06AEC172882', NULL, NULL, NULL),
('Ataviacce', 'jgoerzen@live.com', '58443D7291EABD339BE0CE212D586DD8E0866DB7A2FBA979A709DEECC0334644', NULL, NULL, NULL),
('Attrakefa', 'valdez@gmail.com', '39D0E706DCD5D6949A67B4A3F35C207359FEC555AD29DF5E6C24C643CA3136CB', NULL, NULL, NULL),
('GigglyPierce', 'matsn@verizon.net', '1C057F698635CA9194271CD675E156C0FB7713A874F3417E5F43DB86B7A25C9F', NULL, NULL, NULL),
('Grantersk', 'kronvold@outlook.com', '1997AA893245803A028708DFC81A3D067F469B2CF4E54AB4DCAA6302F21095C3', NULL, NULL, NULL),
('qsd', 'qsd', 'sd', 'sa', 'sd', 'Plateau'),
('sd', 'sd', 'dqsddqsd', '', '', 'Downtown'),
('sqfqsf', 'qsffqsf', '>>::>>J:', 'sd', 'sqdf', 'Downtown');


ALTER TABLE `dogs`
  ADD CONSTRAINT `dogs_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`dog1`) REFERENCES `dogs` (`ID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`dog2`) REFERENCES `dogs` (`ID`);

ALTER TABLE `playdates`
  ADD CONSTRAINT `playdates_ibfk_1` FOREIGN KEY (`dog1`) REFERENCES `dogs` (`ID`),
  ADD CONSTRAINT `playdates_ibfk_2` FOREIGN KEY (`dog2`) REFERENCES `dogs` (`ID`);

ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `users` (`username`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
