-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 28, 2017 at 04:56 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `livresvoyageurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
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
(1, 'Albert', 'Camus'),
(2, 'Ernest', 'Hemingway'),
(3, 'Alexandre', 'Dumas'),
(4, 'Maurice', 'DRUON'),
(5, 'John', 'Ronald'),
(6, 'Franz', 'Kafka'),
(7, 'Oscar', 'Wilde'),
(8, 'Isaac', 'Asimov'),
(9, 'Eric', 'Worre');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_book` int(8) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title_book` varchar(100) NOT NULL,
  `summary_book` longtext NOT NULL,
  `photo_book` varchar(255) NOT NULL,
  `ISBN_book` int(13) NOT NULL,
  `disponibility_book` tinyint(4) NOT NULL DEFAULT '0',
  `language_book` varchar(60) NOT NULL DEFAULT 'Français',
  `date_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `id_member`, `id_author`, `id_category`, `title_book`, `summary_book`, `photo_book`, `ISBN_book`, `disponibility_book`, `language_book`, `date_book`) VALUES
(21997126, 2, 9, 10, 'Go Pro', 'Over twenty years ago, Worre began focusing on developing the skills to become a network marketing expert.', 'http://books.google.com/books/content?id=iUeNmwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Anglais', '2017-08-28 14:55:27'),
(84115063, 3, 7, 12, 'Le portrait de Dorian Gray', 'Pendant des semaines, il ne montait pas, et il oubliait l&#39;horrible chose peinte en se tournant, le coeur léger et rempli de joies insouciantes, vers les plaisirs de la simple existence.', 'http://books.google.com/books/content?id=2Aw_HAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070384853, 0, 'Français', '2017-08-28 11:02:28'),
(85195737, 2, 2, 1, 'Le vieil homme et la mer', 'On a vu avec raison dans Le vieil homme et la mer un des chefs-d&#39;œuvre de Hemingway.', 'http://books.google.com/books/content?id=ZGJplwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070360075, 0, 'Français', '2017-08-28 10:57:10'),
(85463023, 3, 5, 1, 'La communauté de l\'Anneau', 'Aux temps reculés de ce récit, la Terre est peuplée d&#39;innombrables créatures : les Hobbits, apparentés à l&#39;Homme, les Elfes et les Nains vivent en paix dans la Comté.', 'http://books.google.com/books/content?id=L_iqAAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 11:01:14'),
(85581514, 2, 4, 9, 'Les rois maudits -', 'La célébrissime fresque de Maurice Druon, considérée comme un modèle du roman historique, enfin disponible en numérique !', 'http://books.google.com/books/content?id=Hp4nAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 10:58:37'),
(86178682, 3, 8, 13, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 1, 'Français', '2017-08-28 11:03:37'),
(87069644, 3, 6, 12, 'Le procès', 'Le procès intenté à Joseph K., qui ne connaîtra pas ses juges, ne relève d&#39;aucun code et ne pouvait s&#39;achever ni sur un acquittement ni sur une damnation, puisque Joseph K. n&#39;était coupable que d&#39;exister.', 'http://books.google.com/books/content?id=JTkMPAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070378403, 1, 'Français', '2017-08-28 11:01:48'),
(87603955, 2, 1, 12, 'L\'étranger', 'Quand la sonnerie a encore retenti, que la porte du box s&#39;est ouverte, c&#39;est le silence de la salle qui est monté vers moi, le silence, et cette singulière sensation que j&#39;ai eue lorsque j&#39;ai constaté que le jeune journaliste avait ...', 'http://books.google.com/books/content?id=o1goAQAAIAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070360024, 0, 'Français', '2017-08-28 10:56:20'),
(88045274, 2, 3, 12, 'Le Comte de Monte Cristo', 'Une seule collection de lecture pour tous niveaux !', 'http://books.google.com/books/content?id=KdfFCQAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 2147483647, 1, 'Français', '2017-08-28 10:57:57'),
(89051065, 3, 6, 12, 'Le procès', 'Le procès intenté à Joseph K., qui ne connaîtra pas ses juges, ne relève d&#39;aucun code et ne pouvait s&#39;achever ni sur un acquittement ni sur une damnation, puisque Joseph K. n&#39;était coupable que d&#39;exister.', 'http://books.google.com/books/content?id=JTkMPAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070378403, 0, 'Français', '2017-08-28 11:01:39'),
(89122151, 2, 1, 12, 'L\'étranger', 'Quand la sonnerie a encore retenti, que la porte du box s&#39;est ouverte, c&#39;est le silence de la salle qui est monté vers moi, le silence, et cette singulière sensation que j&#39;ai eue lorsque j&#39;ai constaté que le jeune journaliste avait ...', 'http://books.google.com/books/content?id=o1goAQAAIAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070360024, 0, 'Français', '2017-08-28 10:56:04'),
(89928469, 3, 8, 13, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 1, 'Français', '2017-08-28 11:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `captures`
--

CREATE TABLE `captures` (
  `id_pointer` int(11) NOT NULL,
  `id_member` int(11) NOT NULL DEFAULT '0',
  `comment_capture` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `captures`
--

INSERT INTO `captures` (`id_pointer`, `id_member`, `comment_capture`) VALUES
(1, 3, 'Merci!'),
(2, 3, 'Un grand merci encore!'),
(3, 2, 'Cool!'),
(4, 2, 'Ce livre est génial!'),
(5, 2, 'Retour a l\'envoyeur');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`) VALUES
(1, 'Fiction'),
(2, 'Humour'),
(3, 'Art'),
(4, 'Bande Dessinée'),
(5, 'Cuisine'),
(6, 'Dictionnaire'),
(7, 'Droit'),
(8, 'Esotérisme'),
(9, 'Histoire'),
(10, 'Informatique'),
(11, 'Jeunesse'),
(12, 'Littérature'),
(13, 'Sciences'),
(14, 'Voyages');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
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
-- Table structure for table `friends`
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `pseudo_member` varchar(50) NOT NULL,
  `mail_member` varchar(100) NOT NULL,
  `pass_member` varchar(100) NOT NULL,
  `avatar_member` varchar(250) NOT NULL DEFAULT 'default.png',
  `token_member` varchar(40) NOT NULL,
  `date_member` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_member` varchar(11) NOT NULL,
  `active_member` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `pseudo_member`, `mail_member`, `pass_member`, `avatar_member`, `token_member`, `date_member`, `role_member`, `active_member`) VALUES
(0, 'anonyme', '', '', 'default.png', '', '2017-08-28 10:49:02', '', 0),
(2, 'lola', 'laura_traore@hotmail.fr', '88cacb3050c47cc412f73b2a91caeae620e2dc69', 'default.png', '', '2017-08-28 10:50:04', 'ROLE_MEMBER', 0),
(3, 'luciol', 'lgallay@orange.fr', '94794a9cc06abf4be9f480d227eb0e15b945494a', 'default.png', '', '2017-08-28 10:59:56', 'ROLE_MEMBER', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pointers`
--

CREATE TABLE `pointers` (
  `id_pointer` int(11) NOT NULL,
  `id_book` int(8) NOT NULL,
  `lat_pointer` float NOT NULL,
  `lng_pointer` float NOT NULL,
  `city_pointer` varchar(150) NOT NULL,
  `date_pointer` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pointers`
--

INSERT INTO `pointers` (`id_pointer`, `id_book`, `lat_pointer`, `lng_pointer`, `city_pointer`, `date_pointer`) VALUES
(1, 85195737, 45.855, 4.68051, 'Lozanne', '2017-08-28 12:39:40'),
(2, 89122151, 45.855, 4.68051, 'Lozanne', '2017-08-28 12:40:19'),
(3, 84115063, 45.9915, 4.71882, 'Villefranche-sur-Saone', '2017-08-28 12:41:22'),
(4, 85463023, 45.9915, 4.71882, 'Villefranche-sur-Saone', '2017-08-28 12:41:46'),
(5, 85195737, 45.764, 4.83566, 'Lyon', '2017-08-28 13:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `startpoints`
--

CREATE TABLE `startpoints` (
  `id_book` int(8) NOT NULL,
  `lat_startpoint` float NOT NULL,
  `lng_startpoint` float NOT NULL,
  `city_startpoint` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `startpoints`
--

INSERT INTO `startpoints` (`id_book`, `lat_startpoint`, `lng_startpoint`, `city_startpoint`) VALUES
(87603955, 45.9915, 4.71882, 'Villefranche-sur-Saone'),
(85195737, 45.9915, 4.71882, 'Villefranche-sur-Saone'),
(88045274, 45.9915, 4.71882, 'Villefranche-sur-Saone'),
(85581514, 45.9915, 4.71882, 'Villefranche-sur-Saone'),
(85463023, 45.855, 4.68051, 'Lozanne'),
(87069644, 45.855, 4.68051, 'Lozanne'),
(84115063, 45.855, 4.68051, 'Lozanne'),
(86178682, 45.855, 4.68051, 'Lozanne'),
(21997126, 45.764, 4.83566, 'Lyon');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_books`
-- (See below for the actual view)
--
CREATE TABLE `view_books` (
`id_book` int(8)
,`id_member` int(11)
,`id_author` int(11)
,`id_category` int(11)
,`title_book` varchar(100)
,`summary_book` longtext
,`photo_book` varchar(255)
,`ISBN_book` int(13)
,`disponibility_book` tinyint(4)
,`language_book` varchar(60)
,`date_book` timestamp
,`firstname_author` varchar(80)
,`lastname_author` varchar(80)
,`name_category` varchar(60)
,`pseudo_member` varchar(50)
,`avatar_member` varchar(250)
,`mail_member` varchar(100)
,`lat_startpoint` float
,`lng_startpoint` float
,`city_startpoint` varchar(60)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_friends`
-- (See below for the actual view)
--
CREATE TABLE `view_friends` (
`id_member_1` int(11)
,`id_member_2` int(11)
,`action_friend` int(11)
,`status_friend` tinyint(4)
,`date_friend` timestamp
,`pseudo_member_1` varchar(50)
,`mail_member_1` varchar(100)
,`avatar_member_1` varchar(250)
,`pseudo_member_2` varchar(50)
,`mail_member_2` varchar(100)
,`avatar_member_2` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_story`
-- (See below for the actual view)
--
CREATE TABLE `view_story` (
`id_pointer` int(11)
,`id_book` int(8)
,`lat_pointer` float
,`lng_pointer` float
,`city_pointer` varchar(150)
,`date_pointer` timestamp
,`id_member` int(11)
,`comment_capture` varchar(500)
,`lat_startpoint` float
,`lng_startpoint` float
,`city_startpoint` varchar(60)
,`pseudo_member` varchar(50)
,`avatar_member` varchar(250)
,`title_book` varchar(100)
,`photo_book` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_books`
--
DROP TABLE IF EXISTS `view_books`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_books`  AS  select `b`.`id_book` AS `id_book`,`b`.`id_member` AS `id_member`,`b`.`id_author` AS `id_author`,`b`.`id_category` AS `id_category`,`b`.`title_book` AS `title_book`,`b`.`summary_book` AS `summary_book`,`b`.`photo_book` AS `photo_book`,`b`.`ISBN_book` AS `ISBN_book`,`b`.`disponibility_book` AS `disponibility_book`,`b`.`language_book` AS `language_book`,`b`.`date_book` AS `date_book`,`a`.`firstname_author` AS `firstname_author`,`a`.`lastname_author` AS `lastname_author`,`c`.`name_category` AS `name_category`,`m`.`pseudo_member` AS `pseudo_member`,`m`.`avatar_member` AS `avatar_member`,`m`.`mail_member` AS `mail_member`,`s`.`lat_startpoint` AS `lat_startpoint`,`s`.`lng_startpoint` AS `lng_startpoint`,`s`.`city_startpoint` AS `city_startpoint` from ((((`books` `b` join `authors` `a` on((`b`.`id_author` = `a`.`id_author`))) join `categories` `c` on((`b`.`id_category` = `c`.`id_category`))) join `members` `m` on((`b`.`id_member` = `m`.`id_member`))) join `startpoints` `s` on((`b`.`id_book` = `s`.`id_book`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_friends`
--
DROP TABLE IF EXISTS `view_friends`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_friends`  AS  select `f`.`id_member_1` AS `id_member_1`,`f`.`id_member_2` AS `id_member_2`,`f`.`action_friend` AS `action_friend`,`f`.`status_friend` AS `status_friend`,`f`.`date_friend` AS `date_friend`,`m`.`pseudo_member` AS `pseudo_member_1`,`m`.`mail_member` AS `mail_member_1`,`m`.`avatar_member` AS `avatar_member_1`,`mm`.`pseudo_member` AS `pseudo_member_2`,`mm`.`mail_member` AS `mail_member_2`,`mm`.`avatar_member` AS `avatar_member_2` from ((`friends` `f` join `members` `m` on((`f`.`id_member_1` = `m`.`id_member`))) join `members` `mm` on((`f`.`id_member_2` = `mm`.`id_member`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_story`
--
DROP TABLE IF EXISTS `view_story`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_story`  AS  select `p`.`id_pointer` AS `id_pointer`,`p`.`id_book` AS `id_book`,`p`.`lat_pointer` AS `lat_pointer`,`p`.`lng_pointer` AS `lng_pointer`,`p`.`city_pointer` AS `city_pointer`,`p`.`date_pointer` AS `date_pointer`,`c`.`id_member` AS `id_member`,`c`.`comment_capture` AS `comment_capture`,`s`.`lat_startpoint` AS `lat_startpoint`,`s`.`lng_startpoint` AS `lng_startpoint`,`s`.`city_startpoint` AS `city_startpoint`,`m`.`pseudo_member` AS `pseudo_member`,`m`.`avatar_member` AS `avatar_member`,`b`.`title_book` AS `title_book`,`b`.`photo_book` AS `photo_book` from ((((`pointers` `p` join `captures` `c` on((`p`.`id_pointer` = `c`.`id_pointer`))) join `startpoints` `s` on((`p`.`id_book` = `s`.`id_book`))) join `members` `m` on((`c`.`id_member` = `m`.`id_member`))) join `books` `b` on((`p`.`id_book` = `b`.`id_book`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `captures`
--
ALTER TABLE `captures`
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_pointer` (`id_pointer`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_receiver` (`id_receiver`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD KEY `id_member_1` (`id_member_1`),
  ADD KEY `id_member_2` (`id_member_2`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pointers`
--
ALTER TABLE `pointers`
  ADD PRIMARY KEY (`id_pointer`),
  ADD KEY `id_book` (`id_book`);

--
-- Indexes for table `startpoints`
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
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pointers`
--
ALTER TABLE `pointers`
  MODIFY `id_pointer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
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
