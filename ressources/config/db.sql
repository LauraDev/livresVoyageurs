-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 23, 2017 at 04:58 PM
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
  `language_book` varchar(60) NOT NULL DEFAULT 'Français'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `captures`
--

CREATE TABLE `captures` (
  `id_capture` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_book` int(8) NOT NULL,
  `comment_capture` varchar(500) NOT NULL,
  `date_capture` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status_friend` tinyint(4) NOT NULL
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
  `avatar_member` varchar(250) NOT NULL,
  `token_member` varchar(40) NOT NULL,
  `date_member` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_member` varchar(11) NOT NULL,
  `active_member` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pointers`
--

CREATE TABLE `pointers` (
  `id_pointer` int(11) NOT NULL,
  `id_book` int(8) NOT NULL,
  `lat_pointer` float NOT NULL,
  `lng_pointer` float NOT NULL,
  `city_pointer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`id_capture`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_book` (`id_book`);

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
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `books` (`id_author`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `startpoints` (`id_book`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `books` (`id_category`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `chats` (`id_sender`);
