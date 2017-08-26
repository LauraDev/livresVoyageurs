-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 26, 2017 at 03:10 PM
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
(1, 'laura', 'traore'),
(2, 'loic', 'gallay');

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
  `ISBN_book` int(11) NOT NULL,
  `disponibility_book` tinyint(4) NOT NULL DEFAULT '0',
  `language_book` varchar(60) NOT NULL DEFAULT 'Français',
  `date_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `id_member`, `id_author`, `id_category`, `title_book`, `summary_book`, `photo_book`, `ISBN_book`, `disponibility_book`, `language_book`, `date_book`) VALUES
(0, 1, 2, 1, 'iutiuyg', 'iugo87 fg98ghv', '', 123456, 0, 'Français', '2017-08-24 08:04:40'),
(12345678, 1, 2, 1, 'La science fiction', 'La fiction bla als bla lorem ipsum', '', 123456, 0, 'Français', '2017-08-23 20:01:28'),
(121345678, 1, 2, 1, 'iuyiuo', 'iugouy', '', 123456, 0, 'Français', '2017-08-24 08:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `captures`
--

CREATE TABLE `captures` (
  `id_pointer` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `comment_capture` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `captures`
--

INSERT INTO `captures` (`id_pointer`, `id_member`, `comment_capture`) VALUES
(1, 2, 'Super!');

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
(1, 'fiction'),
(2, 'comique');

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

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id_member_1`, `id_member_2`, `action_friend`, `status_friend`, `date_friend`) VALUES
(1, 2, 2, 1, '2017-08-24 10:13:38');

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
(1, 'loles34', 'loles34_4@hotmail.com', 'loles34', '/Applications/MAMP/tmp/php/phpRLlPui', '', '2017-08-23 19:57:29', 'ROLE_ADMIN', 0),
(2, 'Loic', 'iuyiu@sof.vf', '123456', '', '', '2017-08-24 09:36:07', 'role_admin', 0),
(6, 'loles343434', 'zsfoijdgoiiofgihoeoigvhso@dfgpjhpotyhjpoty.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '/Applications/MAMP/tmp/php/phpZT2Aos', '', '2017-08-24 14:29:51', 'ROLE_MEMBER', 0),
(9, 'lola', 'laura_traore@hotmail.fr', '88cacb3050c47cc412f73b2a91caeae620e2dc69', '/Applications/MAMP/tmp/php/phpnp9S7j', 'c5b1e12363abfff8cdaa82b28dde12f5', '2017-08-25 05:52:49', 'ROLE_MEMBER', 0);

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
(1, 12345678, 12.3698, 5.2145, 'Rome', '2017-08-24 09:34:15'),
(2, 121345678, 45.258, 1.23658, 'Miami', '2017-08-24 09:34:15');

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
(121345678, 12.256, 15.36, 'london'),
(12345678, 654.69, 546.58, 'paris');

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
,`ISBN_book` int(11)
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
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pointers`
--
ALTER TABLE `pointers`
  MODIFY `id_pointer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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