-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 24, 2017 at 12:13 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livresvoyageurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `firstname_author` varchar(80) NOT NULL,
  `lastname_author` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id_author`, `firstname_author`, `lastname_author`) VALUES
(1, 'laura', 'traore'),
(2, 'loic', 'gallay');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id_book` int(8) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title_book` varchar(100) NOT NULL,
  `summary_book` longtext NOT NULL,
  `photo_book` varchar(255) NOT NULL,
  `ISBN_book` int(11) NOT NULL,
  `disponibility_book` tinyint(4) NOT NULL DEFAULT '0',
  `language_book` varchar(60) NOT NULL DEFAULT 'Français',
  `date_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `id_member`, `id_author`, `id_category`, `title_book`, `summary_book`, `photo_book`, `ISBN_book`, `disponibility_book`, `language_book`, `date_book`) VALUES
(12345678, 1, 2, 1, 'La science fiction', 'La fiction bla als bla lorem ipsum', '', 123456, 0, 'Français', '2017-08-23 20:01:28');

-- --------------------------------------------------------

--
-- Structure de la table `captures`
--

CREATE TABLE `captures` (
  `id_pointer` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `comment_capture` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`) VALUES
(1, 'fiction'),
(2, 'comique');

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

CREATE TABLE `chats` (
  `id_chat` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `message_chat` varchar(150) NOT NULL,
  `date_chat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id_member_1` int(11) NOT NULL,
  `id_member_2` int(11) NOT NULL,
  `action_friend` int(11) NOT NULL,
  `status_friend` tinyint(4) NOT NULL,
  `date_friend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `pseudo_member` varchar(50) NOT NULL,
  `mail_member` varchar(100) NOT NULL,
  `pass_member` varchar(100) NOT NULL,
  `avatar_member` varchar(250) NOT NULL,
  `token_member` varchar(40) NOT NULL,
  `date_member` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_member` varchar(11) NOT NULL,
  `active_member` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `pseudo_member`, `mail_member`, `pass_member`, `avatar_member`, `token_member`, `date_member`, `role_member`, `active_member`) VALUES
(1, 'loles34', 'loles34_4@hotmail.com', 'loles34', '', '', '2017-08-23 19:57:29', 'ROLE_ADMIN', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pointers`
--

CREATE TABLE `pointers` (
  `id_pointer` int(11) NOT NULL,
  `id_book` int(8) NOT NULL,
  `lat_pointer` float NOT NULL,
  `lng_pointer` float NOT NULL,
  `city_pointer` int(11) NOT NULL,
  `date_pointer` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `startpoints`
--

CREATE TABLE `startpoints` (
  `id_book` int(8) NOT NULL,
  `lat_startpoint` float NOT NULL,
  `lng_startpoint` float NOT NULL,
  `city_startpoint` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_book`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_book` (
`id_book` int(8)
,`id_member` int(11)
,`id_author` int(11)
,`id_category` int(11)
,`title_book` varchar(100)
,`summary_book` longtext
,`photo_book` varchar(255)
,`ISBN_book` int(11)
,`disponibility_book` tinyint(4)
,`language_book` varchar(60)
,`firstname_author` varchar(80)
,`lastname_author` varchar(80)
,`name_category` varchar(60)
,`lat_startpoint` float
,`lng_startpoint` float
,`city_startpoint` varchar(60)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_story`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_story` (
`id_book` int(8)
,`title_book` varchar(100)
,`lat_startpoint` float
,`lng_startpoint` float
,`city_startpoint` varchar(60)
,`lat_pointer` float
,`lng_pointer` float
,`city_pointer` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_book`
--
DROP TABLE IF EXISTS `view_book`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book`  AS  select `b`.`id_book` AS `id_book`,`b`.`id_member` AS `id_member`,`b`.`id_author` AS `id_author`,`b`.`id_category` AS `id_category`,`b`.`title_book` AS `title_book`,`b`.`summary_book` AS `summary_book`,`b`.`photo_book` AS `photo_book`,`b`.`ISBN_book` AS `ISBN_book`,`b`.`disponibility_book` AS `disponibility_book`,`b`.`language_book` AS `language_book`,`a`.`firstname_author` AS `firstname_author`,`a`.`lastname_author` AS `lastname_author`,`c`.`name_category` AS `name_category`,`s`.`lat_startpoint` AS `lat_startpoint`,`s`.`lng_startpoint` AS `lng_startpoint`,`s`.`city_startpoint` AS `city_startpoint` from (((`books` `b` join `authors` `a` on((`a`.`id_author` = `b`.`id_author`))) join `categories` `c` on((`c`.`id_category` = `b`.`id_category`))) join `startpoints` `s` on((`s`.`id_book` = `b`.`id_book`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_story`
--
DROP TABLE IF EXISTS `view_story`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_story`  AS  select `vb`.`id_book` AS `id_book`,`vb`.`title_book` AS `title_book`,`vb`.`lat_startpoint` AS `lat_startpoint`,`vb`.`lng_startpoint` AS `lng_startpoint`,`vb`.`city_startpoint` AS `city_startpoint`,`p`.`lat_pointer` AS `lat_pointer`,`p`.`lng_pointer` AS `lng_pointer`,`p`.`city_pointer` AS `city_pointer` from (`view_book` `vb` join `pointers` `p` on((`p`.`id_book` = `vb`.`id_book`))) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `captures`
--
ALTER TABLE `captures`
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_pointer` (`id_pointer`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_receiver` (`id_receiver`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD KEY `id_member_1` (`id_member_1`),
  ADD KEY `id_member_2` (`id_member_2`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Index pour la table `pointers`
--
ALTER TABLE `pointers`
  ADD PRIMARY KEY (`id_pointer`),
  ADD KEY `id_book` (`id_book`);

--
-- Index pour la table `startpoints`
--
ALTER TABLE `startpoints`
  ADD KEY `id_book` (`id_book`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pointers`
--
ALTER TABLE `pointers`
  MODIFY `id_pointer` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Constraints for table `captures`
--
ALTER TABLE `captures`
  ADD CONSTRAINT `captures_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `captures_ibfk_2` FOREIGN KEY (`id_pointer`) REFERENCES `pointers` (`id_pointer`);

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `members` (`id_member`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`id_member_1`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`id_member_2`) REFERENCES `members` (`id_member`);

--
-- Constraints for table `pointers`
--
ALTER TABLE `pointers`
  ADD CONSTRAINT `pointers_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);

--
-- Constraints for table `startpoints`
--
ALTER TABLE `startpoints`
  ADD CONSTRAINT `startpoints_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);
