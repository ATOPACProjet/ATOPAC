-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 21 fév. 2020 à 16:20
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ermy8377_atopac`
--

-- --------------------------------------------------------

--
-- Structure de la table `Actualites`
--

CREATE TABLE `Actualites` (
  `titre` longtext COLLATE latin1_general_ci NOT NULL,
  `descriptif_fr` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `descriptif_en` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `src` text COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Contacts`
--

CREATE TABLE `Contacts` (
  `nom` char(30) COLLATE latin1_general_ci NOT NULL,
  `prenom` char(30) COLLATE latin1_general_ci NOT NULL,
  `mail` char(30) COLLATE latin1_general_ci NOT NULL,
  `CP/ville` char(30) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ExpoVirtuelle`
--

CREATE TABLE `ExpoVirtuelle` (
  `Titre` varchar(64) DEFAULT NULL,
  `Rang` int(3) DEFAULT NULL,
  `Date` varchar(18) DEFAULT NULL,
  `Technique` varchar(40) DEFAULT NULL,
  `Hauteur` varchar(7) DEFAULT '0',
  `Largeur` varchar(6) DEFAULT '0',
  `Collection` varchar(45) DEFAULT NULL,
  `Crédit_Photographique` varchar(8) DEFAULT NULL,
  `Remarques` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Membres`
--

CREATE TABLE `Membres` (
  `login` char(30) COLLATE latin1_general_ci NOT NULL,
  `passwd` char(100) COLLATE latin1_general_ci NOT NULL DEFAULT 'at0pac',
  `mail` char(30) COLLATE latin1_general_ci DEFAULT NULL,
  `nom` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `Membres`
--

INSERT INTO `Membres` (`login`, `passwd`, `mail`, `nom`, `prenom`) VALUES
('aallo', '$2y$10$.RiqOwFja/MIoNi7XE8N8e3wjtaHq8a115TWQ6JEeD.dEa5U4JKlW', NULL, 'alllloo', 'allo'),
('admin', '$2y$10$tFuZlXLiLTT5DrBEmjvfTOblMANjNwAbszYTV.0GqMxUnRreoQXA.', NULL, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvres`
--

CREATE TABLE `Oeuvres` (
  `id` int(11) NOT NULL,
  `Titre` varchar(64) DEFAULT NULL,
  `Rang` int(3) DEFAULT NULL,
  `Date` varchar(18) DEFAULT NULL,
  `Technique` varchar(40) DEFAULT NULL,
  `Hauteur` varchar(7) DEFAULT '0',
  `Largeur` varchar(6) DEFAULT '0',
  `Collection` varchar(45) DEFAULT NULL,
  `Crédit_Photographique` varchar(8) DEFAULT NULL,
  `Remarques` varchar(126) DEFAULT NULL,
  `NULL` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Oeuvres`
--

INSERT INTO `Oeuvres` (`id`, `Titre`, `Rang`, `Date`, `Technique`, `Hauteur`, `Largeur`, `Collection`, `Crédit_Photographique`, `Remarques`, `NULL`) VALUES
(1, '', 1, '1971', 'huile sur toile', '65', '65', '', '', '', NULL),
(2, 'Pianiste', 2, '1971', 'huile sur panneau', '50', '54', '', '', '', NULL),
(3, 'Homme blessé', 3, '1971', 'huile sur aggloméré', '67', '50', '', '', '', NULL),
(4, '', 4, '1975', 'graphite sur papier', '50', '39.8', '', '', '', NULL),
(5, '', 5, '1975', '', '135', '95', 'collection particulière, Maisons-Alfort', 'H.R.', '', NULL),
(6, 'Statue et homme blessé', 6, '1975', 'huile sur contreplaqué', '80', '120', 'collection particulière, Maisons-Alfort', 'H.R.', '', NULL),
(7, 'Le rêve', 7, '1978', 'huile sur panneau', '50', '20', '', '', '', NULL),
(8, 'Le rêve', 8, '1978', 'huile sur panneau', '100', '40', '', '', '', NULL),
(9, 'La ville abandonnée', 9, '1979', 'huile sur panneau', '25', '35', '', '', '', NULL),
(10, 'Paysage', 10, '1979', 'huile sur panneau', '30', '35', '', '', '', NULL),
(11, 'peintures murales', 11, '1979', 'peinture vinylique sur plaques de plâtre', '476', '692', 'Andelot-en-Montagne (Jura), Salle paroissiale', '', 'Photo prise en mai 2016. Cette œuvre n’est plus visible. Elle est à présent occultée par une cloison murale construite en 2017', NULL),
(12, 'Statue et personnages', 12, '1980', 'huile sur panneau', '20', '25', '', '', '', NULL),
(13, 'La ville abandonnée', 13, '1980', 'huile sur panneau', '80', '100', '', '', '', NULL),
(14, 'Étude pour un personnage devant un oiseau', 14, '1981', 'huile sur contreplaqué', '21', '25', '', '', '', NULL),
(15, 'Deux géants sur une plate-forme', 15, '1982', 'huile sur aggloméré', '102', '122', '', '', '', NULL),
(16, 'Personnage rouge enlevant son masque', 16, '1982', 'huile sur panneau', '135', '82', '', '', '', NULL),
(17, '', 17, '1982 ou 1986', 'huile sur bois', '42.7', '48.5', '', '', '', NULL),
(18, 'Personnage sous les décombres', 18, '1983', '', '0', '0', '', '', '', NULL),
(19, 'Combat de deux personnages', 19, '1984', 'huile sur contreplaqué', '70', '100', '', '', '', NULL),
(20, 'Deux figures', 20, '1983', 'huile sur aggloméré', '44', '31', '', '', '', NULL),
(21, 'Deux figures', 21, '1984', 'huile sur aggloméré', '125', '90', '', '', '', NULL),
(22, 'Homme debout, statue et homme couché', 22, '1984', 'huile sur aggloméré', '140.2', '70', '', '', '', NULL),
(23, '', 23, '1985', 'graphite sur papier', '0', '0', '', '', '', NULL),
(24, 'Personnage vautour réclamant sa proie', 24, '1985', 'huile sur aggloméré', '102.6', '102.6', '', '', '', NULL),
(25, 'Portrait d\'une comédienne dans un théâtre', 25, '1986', 'huile sur contreplaqué', '110', '90', '', '', '', NULL),
(26, 'Deux personnages dans une boîte', 26, '1986', 'huile sur contreplaqué', '80', '80', '', '', '', NULL),
(27, 'Deux personnages dans une boîte', 27, '1986', 'huile sur contreplaqué', '80', '80', '', '', '', NULL),
(28, '', 28, 'vers 1986', 'huile sur contreplaqué', '40', '40', '', '', '', NULL),
(29, 'Études pour un homme couché(et autres personnages non définis)', 29, '1987', 'gouache', '40', '30', '', '', '', NULL),
(30, 'Études pour un personnage couché', 30, '1987', 'gouache', '40', '30', '', '', '', NULL),
(31, 'Personnages tombant (d\'une plate-forme) dans un carré', 31, '1988', 'gouache', '40', '30', '', '', '', NULL),
(32, 'Statue penchée au-dessus d\'un homme couché', 32, '1988', 'graphite et gouache', '0', '0', '', '', '', NULL),
(33, 'Statue penchée', 33, '1988', 'huile sur panneau ovale', '59', '48', '', '', '', NULL),
(34, 'Statue et personnage près d\'une fenêtre N.3', 34, '1988', 'huile sur toile', '116', '89', '', '', '', NULL),
(35, 'Statue et personnage près d\'une fenêtre', 35, '1988', 'huile sur toile', '116', '89', '', '', '', NULL),
(36, 'Chute de personnages', 36, '1989', 'huile sur toile', '100', '100', '', '', '', NULL),
(37, 'Chute de personnages', 37, '1989', 'huile sur toile', '100', '100', '', '', '', NULL),
(38, 'Personnages verticaux sur une demie croix', 38, '1990', 'huile sur aggloméré', '110', '90', '', '', '', NULL),
(39, 'Personnages obliques sur une demie croix', 39, '1990', 'huile sur aggloméré', '110', '90', '', '', '', NULL),
(40, 'Deux personnages sur une demie croix 3', 40, '1990', 'huile sur aggloméré', '89', '90', '', '', '', NULL),
(41, 'Deux personnages sur une demie croix 2', 41, '1990', 'huile sur aggloméré', '89', '90', '', '', '', NULL),
(42, '', 42, '1991', '', '0', '35', 'collection particulière, Maisons-Alfort', 'H.R.', '', NULL),
(43, '', 43, '1991', '', '0', '90', 'collection particulière, Maisons-Alfort', 'H.R.', '', NULL),
(44, 'Dignitaire et tête de statue 1', 44, '1991', 'huile sur contreplaqué', '100', '80', '', '', '', NULL),
(45, 'Dignitaire et tête de statue 2', 45, '1991', 'huile sur contreplaqué', '100', '80', '', '', '', NULL),
(46, 'Dignitaire et tête de statue 3', 46, '1991', 'huile sur contreplaqué', '100', '80', '', '', '', NULL),
(47, 'Dignitaire et tête de statue B', 47, '1991', 'huile sur carton sur contreplaqué', '65', '50', '', '', '', NULL),
(48, '', 48, '1992', 'huile sur contreplaqué', '100', '122', '', '', '', NULL),
(49, 'Bustes de personnages combattant', 49, '1992', 'huile sur contreplaqué', '100', '122', '', '', '', NULL),
(50, 'Bustes de personnages combattant', 50, '1992', 'huile sur contreplaqué', '50', '61', '', '', '', NULL),
(51, '', 51, 'vers 1991', 'huile sur carton', '65', '50', '', '', '', NULL),
(52, '', 52, 'vers 1991', 'huile sur carton', '65', '50', '', '', '', NULL),
(53, '', 53, 'vers 1992', 'huile sur carton', '65', '50', '', '', '', NULL),
(54, 'Combat de deux personnages', 54, '1992', 'huile sur toile', '80', '80', '', '', '', NULL),
(55, '', 55, 'vers 1993', 'huile sur carton', '65', '50', '', '', '', NULL),
(56, '', 56, '1993', 'huile sur carton', '65', '50', '', '', '', NULL),
(57, '', 57, 'vers 1993', 'huile sur carton', '65', '50', '', '', '', NULL),
(58, '', 58, 'vers 1993', 'huile sur contreplaqué', '51', '33', '', '', '', NULL),
(59, '', 59, '1993', 'huile sur contreplaqué', '53', '35', '', '', '', NULL),
(60, '', 60, '1993', 'huile sur panneau', '53', '35', '', '', '', NULL),
(61, 'Triangle', 61, '1994', 'huile sur toile', '61', '46.4', '', '', '', NULL),
(62, '', 62, '1995', 'huile sur panneau', '53', '40', '', '', '', NULL),
(63, '', 63, '1995', 'acrylique sur panneau', '31', '27', '', '', '', NULL),
(64, '', 64, '1995', 'acrylique sur panneau', '31', '27', '', '', '', NULL),
(65, '', 65, '1995', 'huile sur panneau', '31', '27', '', '', '', NULL),
(66, 'Au-delà du carré détruit', 66, '1996', '', '100', '80', 'Collection Musées de Montbéliard', 'P.Guenat', '', ''),
(67, 'Au delà du carré détruit 2', 67, '1995', 'huile sur aggloméré', '100', '80', '', '', '', NULL),
(68, 'Au delà du carré détruit', 68, '1995', 'huile sur aggloméré', '100', '80', '', '', '', NULL),
(69, 'Têtes-cercles', 69, 'vers 1995-1997', 'huile sur toile', '73', '60', '', '', '', NULL),
(70, '', 70, 'vers 1998', 'huile sur carton', '65', '50', '', '', '', NULL),
(71, '', 71, 'vers 1998', 'huile sur carton', '65', '50', '', '', '', NULL),
(72, 'Demi cercle', 72, '1996', 'huile sur aggloméré', '110', '100', '', '', '', NULL),
(73, '', 73, '1998', 'huile sur aggloméré', '110.1', '100', '', '', '', NULL),
(74, 'Carré détruit dans un carré', 74, '1996', 'huile sur panneau de particules', '70', '60', '', '', '', NULL),
(75, '', 75, '1997', 'huile sur aggloméré', '50', '40', '', '', '', NULL),
(76, '', 76, '1997', 'huile sur aggloméré', '50', '40', '', '', '', NULL),
(77, '', 77, '1997', 'huile sur aggloméré', '50', '40', '', '', '', NULL),
(78, '', 78, '1997', 'huile sur aggloméré', '50', '40', '', '', '', NULL),
(79, '', 79, '1998', 'huile sur MDF', '65', '60', '', '', '', NULL),
(80, 'Invasion d\'un triangle', 80, '2000', 'huile sur MDF', '65', '50', '', '', '', NULL),
(81, '', 81, '1999', 'huile sur MDF', '92', '85', '', '', '', NULL),
(82, '', 82, '1999', 'huile ou acrylique sur MDF', '92.4', '85', '', '', '', NULL),
(83, '', 83, 'vers 1999', 'huile sur MDF', '92.5', '85.1', '', '', '', NULL),
(84, '', 84, '1999', 'huile sur contreplaqué', '87', '70', '', '', '', NULL),
(85, '', 85, '1999', 'huile sur papier', '92', '70', '', '', '', NULL),
(86, '', 86, 'vers 2000', 'huile sur isorel', '100.2', '70.5', '', '', '', NULL),
(87, '', 87, 'vers 2000', 'huile sur isorel', '100.2', '70.5', '', '', '', NULL),
(88, '', 88, '2001', 'huile sur isorel', '100.2', '70.4', '', '', '', NULL),
(89, '', 89, 'vers 2000', 'huile sur aggloméré', '60.6', '48', '', '', '', NULL),
(90, 'Mécanique de la lumière sur une tête 1', 90, '2000', 'huile sur MDF', '71', '61', '', '', '', NULL),
(91, 'Mécanique de la lumière sur une tête 2', 91, '2000', 'huile sur MDF', '71', '61', '', '', '', NULL),
(92, 'Mécanique de la lumière sur une tête 3', 92, 'vers 2000', 'huile sur MDF', '71', '61', '', '', '', NULL),
(93, 'La Bataille d\'Hernani', 93, '2002', 'huile sur contreplaqué', '100', '100', '', '', '', NULL),
(94, '', 94, '2003', 'huile sur bois', '77', '40.2', '', '', '', NULL),
(95, '', 95, '2004', 'huile sur contreplaqué', '120', '74', '', '', '', NULL),
(96, '', 96, '2004', 'huile sur toile sur contreplaqué', '120', '73.5', '', '', '', NULL),
(97, 'Carrés', 97, '2004', 'huile sur isorel', '100', '69.8', '', '', '', NULL),
(98, '', 98, 'vers 2005', 'huile sur contreplaqué', '149.5', '71.5', '', '', '', NULL),
(99, '', 99, '2006', 'huile sur MDF', '100', '100', '', '', '', NULL),
(100, '', 100, '2007', 'huile sur contreplaqué', '140', '122', '', '', '', NULL),
(101, 'Flèche 4', 101, 'vers 2007', 'huile sur MDF', '103', '70', '', '', '', NULL),
(102, '', 102, 'vers 2007', 'huile sur MDF', '103', '70', '', '', '', NULL),
(103, 'Flèche 1', 103, '2007', 'huile sur MDF', '103', '70.1', '', '', '', NULL),
(104, 'Flèche 2', 104, '2007', 'huile sur MDF', '103', '69', '', '', '', NULL),
(105, '', 105, 'vers 2007', 'huile sur MDF', '93', '69', '', '', '', NULL),
(106, 'Personnage blessé 2', 106, '2007', 'huile sur MDF', '93', '69', '', '', '', NULL),
(107, 'Ancienne figure', 107, '2008', 'huile sur MDF', '103.1', '73.3', '', '', '', NULL),
(108, '', 108, '2008', 'huile sur MDF', '103', '70.1', '', '', '', NULL),
(109, '', 109, 'vers 2006', 'huile sur panneau', '50', '50', '', '', '', NULL),
(110, '', 110, '2008', 'huile sur MDF', '103.1', '69', '', '', '', NULL),
(111, '', 111, '2009', 'huile sur MDF', '60', '60', '', '', '', NULL),
(112, '', 112, 'vers 2008-2009', 'huile sur MDF', '60', '60', '', '', '', NULL),
(113, 'Carré détruit', 113, '2009', 'huile sur MDF', '60', '60', '', '', '', NULL),
(114, '', 114, 'vers 2008-2009', 'huile sur MDF', '60', '60', '', '', '', NULL),
(115, '', 115, 'années 2000', 'huile sur MDF', '60', '60', '', '', '', NULL),
(116, '', 116, 'années 2000', 'huile sur panneau', '86', '75', '', '', '', NULL),
(117, '', 117, 'vers 2014', 'huile sur panneau', '60', '60', '', '', '', NULL),
(118, '', 118, 'vers 2010-2011', 'huile sur MDF', '60', '60', '', '', '', NULL),
(119, '', 119, 'vers 2010-2011', 'huile sur MDF', '60', '60', '', '', '', NULL),
(120, '', 120, '2013', 'huile sur MDF', '60', '60', '', '', '', NULL),
(121, '', 121, '2014', 'huile sur MDF', '60', '60', '', '', '', NULL),
(122, '', 122, 'vers 2013', 'huile sur MDF', '60', '60', '', '', '', NULL),
(123, '', 123, 'entre 2005 et 2015', 'huile sur MDF', '60', '60', '', '', '', NULL),
(124, '', 124, 'vers 2012', 'huile sur MDF', '103.8', '70', '', '', '', NULL),
(125, '', 125, 'vers 2013', 'huile sur MDF', '60', '60', '', '', '', NULL),
(126, '', 126, 'entre 2000 et 2012', 'huile sur panneau', '58', '30', '', '', '', NULL),
(127, '', 127, '2015', 'huile sur contreplaqué', '244', '94', '', '', '(diptyque)', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Contacts`
--
ALTER TABLE `Contacts`
  ADD PRIMARY KEY (`mail`);

--
-- Index pour la table `Membres`
--
ALTER TABLE `Membres`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `Oeuvres`
--
ALTER TABLE `Oeuvres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Oeuvres`
--
ALTER TABLE `Oeuvres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
