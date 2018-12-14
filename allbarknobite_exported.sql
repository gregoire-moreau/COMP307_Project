-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 09:47 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allbarknobite`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `owner` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_bin DEFAULT 'dog.png',
  `breed` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `activity1` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `activity2` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `activity3` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`ID`, `Name`, `Age`, `owner`, `image`, `breed`, `activity1`, `activity2`, `activity3`) VALUES
(1, 'Ace', 7, 'Aeroceli', 'dog.png', NULL, NULL, NULL, NULL),
(2, 'Apollo', 5, 'Ataviacce', 'dog.png', NULL, NULL, NULL, NULL),
(3, 'Bailey', 1, 'Attrakefa', 'dog.png', NULL, NULL, NULL, NULL),
(4, 'Bandit', 3, 'GigglyPierce', 'dog.png', NULL, NULL, NULL, NULL),
(5, 'Baxter', 11, 'Grantersk', 'dog.png', NULL, NULL, NULL, NULL),
(6, 'Remi', 9, 'jenga', 'wzzy9ikw8k.jpg', 'Golden Retriever', 'Playing with toys', 'Cuddling', 'Chase'),
(7, 'Toni', 3, 'HappyTrees', 'g487f30k5g.jpg', 'Jack Russell Terrier', 'Hiking', 'Running', 'Cuddling'),
(8, 'Fifi', 3, 'rachgreen', 'vyanevcaxq.jpg', 'Toy Poodle', 'Cuddling', 'Playing with toys', 'Playing with other dogs'),
(11, 'Charky', 12, 'kaatjeod', 'ddmbraq2nb.jpg', 'Lab', 'Fetch', 'Running', 'Walks'),
(13, 'Mo', 6, 'gill_steve', 'nt9mamzt5c.jpg', 'Rottweiler Mix', 'Wrestling', 'Chase', 'Fetch'),
(14, 'Kipper', 2, 'jsmith', 'j07fcncrmt.jpg', 'Australian cattle dog', 'Frisbee', 'Running', 'Chase'),
(15, 'Bo', 7, 'bobama', '0gk0nour7d.png', 'Portuguese Water Dog', 'Chase', 'Playing with toys', 'Cuddling'),
(16, 'Chloe', 3, 'chloerae', 'oss4s6qnrc.jpg', 'Greyhound', 'Playing with toys', 'Playing with other dogs', 'Running'),
(17, 'Newt', 4, 'ryanadams', '4drg29uujc.jpg', 'Mutt', 'Chase', 'Frisbee', 'Walks'),
(18, 'Maddie', 3, 'cassross', '68fk05a596.jpg', 'Cockapoo', 'Fetch', 'Playing with toys', 'Cuddling'),
(19, 'Skipper', 11, 'meekydubs', '74ggor1oqm.png', 'Dachshund', 'Frisbee', 'Running', 'Chase'),
(20, 'Daisy', 2, 'sammysmith', 'ju6kvpcasf.jpg', 'Westie', 'Playing with toys', 'Walks', 'Playing with other dogs'),
(21, 'Sophia', 3, 'dmorgan', 'aukdqtdvyk.png', 'Pomeranian', 'Walks', 'Playing with toys', 'Cuddling'),
(22, 'Lily', 6, 'joestymest', '8tox951hrb.png', 'German Shepherd', 'Playing with toys', 'Cuddling', 'Chase'),
(23, 'Venti', 10, 'fastpaws', 'm5ca4oena3.jpg', 'Greyhound', 'Running', 'Fetch', 'Walks'),
(24, 'Sadie', 4, 'jtory', '7vw5xl9fb6.jpg', 'NS Duck Tolling Retriever', 'Fetch', 'Running', 'Chase'),
(25, 'Cookie', 5, 'chocchipcookie', 'ry6ysl1srh.png', 'Golden Retriever Mix', 'Wrestling', 'Playing with toys', 'Cuddling'),
(26, 'Lola', 0, 'carter_nick', 'rav0cpw5at.jpg', 'Boxer', 'Running', 'Playing with toys', 'Playing with other dogs'),
(27, 'Dutch', 7, 'dfuller', 'e26tjzpphm.jpg', 'Chow mix', 'Wrestling', 'Chase', 'Walks'),
(28, 'Chewy', 5, 'b_choi', 'g608e8517h.jpg', 'Labradoodle', 'Running', 'Playing with toys', 'Playing with other dogs'),
(29, 'Gordon', 8, 'ddmouth', '14hdrdkswg.jpg', 'Mixed breed', 'Playing with other dogs', 'Running', 'Chase'),
(30, 'fdsf', 8, 'faz', 'dog.png', 'fsdfs', 'Cuddling', 'Wrestling', 'Cuddling');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `dog1` int(11) DEFAULT NULL,
  `dog2` int(11) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `dog1`, `dog2`, `accepted`) VALUES
(1, 2, 1, 0),
(2, 3, 1, 1),
(4, 6, 11, 1),
(5, 6, 13, 1),
(7, 11, 13, 1),
(8, 16, 6, 1),
(9, 17, 6, 1),
(10, 18, 6, 1),
(11, 17, 15, 0),
(12, 18, 17, 0),
(13, 13, 17, 0),
(14, 16, 17, 0),
(15, 15, 6, 0),
(18, 24, 6, 1),
(19, 25, 6, 1),
(20, 27, 6, 0),
(21, 6, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `playdates`
--

CREATE TABLE `playdates` (
  `dog1` int(11) NOT NULL,
  `dog2` int(11) NOT NULL,
  `date` date NOT NULL,
  `message` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `playdates`
--

INSERT INTO `playdates` (`dog1`, `dog2`, `date`, `message`, `accepted`) VALUES
(1, 2, '2018-12-20', NULL, NULL),
(3, 4, '2018-11-15', NULL, NULL),
(5, 3, '2019-01-16', NULL, NULL),
(6, 16, '2018-12-15', 'Wanna go for a walk up Mont Royal around 2pm? Meet at the gazebo in Jeanne-Mance!', 1),
(11, 6, '2018-12-20', 'We\'re going to the doggy cafe with some others and we\'d love for you and Remi to join! 3 pm :)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sessionID` varchar(10) COLLATE utf8_bin NOT NULL,
  `uname` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `firstName` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `lastName` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `lastName`, `location`) VALUES
('Aeroceli', 'mcnihil@icloud.com', 'AAE79D010ED41E2D5038187157331AD3BD0C3300F5E8E96F0B29E06AEC172882', NULL, NULL, NULL),
('Ataviacce', 'jgoerzen@live.com', '58443D7291EABD339BE0CE212D586DD8E0866DB7A2FBA979A709DEECC0334644', NULL, NULL, NULL),
('Attrakefa', 'valdez@gmail.com', '39D0E706DCD5D6949A67B4A3F35C207359FEC555AD29DF5E6C24C643CA3136CB', NULL, NULL, NULL),
('GigglyPierce', 'matsn@verizon.net', '1C057F698635CA9194271CD675E156C0FB7713A874F3417E5F43DB86B7A25C9F', NULL, NULL, NULL),
('Grantersk', 'kronvold@outlook.com', '1997AA893245803A028708DFC81A3D067F469B2CF4E54AB4DCAA6302F21095C3', NULL, NULL, NULL),
('HappyTrees', 'paintman@chill.ca', ',-s,]-E5', 'Bob', 'Ross', 'Westmount'),
('b_choi', 'bchoi@mail.com', ':#k.AK,U', 'Ben', 'Choi', 'Downtown'),
('bobama', 'obama@usa.com', '-4}4}w.-', 'Barrack', 'Obama', 'Downtown'),
('carter_nick', 'nickc@gmail.com', ':#k.AK,U', 'Nick', 'Carter', 'Downtown'),
('cassross', 'cr@gmail.com', '5}}}}C=-', 'Cassie', 'Rossow', 'Downtown'),
('chloerae', 'lc@gmail.com', ':#k.AK,U', 'Lauren', 'Chaykin', 'Downtown'),
('chocchipcookie', 'cc@mailco.uk', ':#k.AK,U', 'Chip', 'Conrad', 'Downtown'),
('ddmouth', 'dd@edu.com', ':#k.AK,U', 'Daniel', 'Dartmouth', 'Downtown'),
('dfuller', 'df@gmail.com', ':#k.AK,U', 'Diane', 'Fuller', 'Downtown'),
('dmorgan', 'dm@gmail.com', ':#k.AK,U', 'Danielle', 'Morgan', 'Downtown'),
('fastpaws', 'moira@gpi.com', ':#k.AK,U', 'Moira', 'Corrigan', 'Downtown'),
('faz', 'fsadfgsgs', '5=m-#-U;', 'faz', 'faz', 'Downtown'),
('gill_steve', 'SHG@gmail.com', '-weI{-&U', 'Stephen', 'Gill', 'Downtown'),
('jenga', 'jenga@gmail.com', '5C}C}C}-', 'Jen', 'Gahrns', 'Downtown'),
('joestymest', 'joesty@gmail.com', '-G-G8-4}', 'Joe', 'Stymest', 'Downtown'),
('jsmith', 'joesmith@gmail.com', ':#k.AK,U', 'Joe', 'Smith', 'Plateau'),
('jtory', 'jtory@gmail.com', ':#k.AK,U', 'Janet', 'Tory', 'Downtown'),
('kaatjeod', 'kaatjeod@gmail.com', '65:---05', 'Kat', 'O\'Donnell', 'Downtown'),
('meekydubs', 'mw@gmail.com', '5-E-5]Ea', 'Mika', 'Weissenberger', 'Downtown'),
('rachgreen', 'rach@centralperk.ny', '5[6[--sa', 'Rachel', 'Green', 'Plateau'),
('ryanadams', 'ra@gmail.com', ':#k.AK,U', 'Ryan', 'Adams', 'Downtown'),
('sammysmith', 'ss@gmail.com', ':#k.AK,U', 'Sam', 'Smith', 'Downtown');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dog1` (`dog1`),
  ADD KEY `dog2` (`dog2`);

--
-- Indexes for table `playdates`
--
ALTER TABLE `playdates`
  ADD KEY `dog1` (`dog1`),
  ADD KEY `dog2` (`dog2`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionID`),
  ADD UNIQUE KEY `uname_2` (`uname`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogs`
--
ALTER TABLE `dogs`
  ADD CONSTRAINT `dogs_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`dog1`) REFERENCES `dogs` (`ID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`dog2`) REFERENCES `dogs` (`ID`);

--
-- Constraints for table `playdates`
--
ALTER TABLE `playdates`
  ADD CONSTRAINT `playdates_ibfk_1` FOREIGN KEY (`dog1`) REFERENCES `dogs` (`ID`),
  ADD CONSTRAINT `playdates_ibfk_2` FOREIGN KEY (`dog2`) REFERENCES `dogs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
