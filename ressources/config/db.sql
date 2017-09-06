

-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 06, 2017 at 02:36 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

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
(9, 'Eric', 'Worre'),
(10, 'Kyle', 'Gray'),
(11, 'Charles', 'Duhigg'),
(12, 'Robin', 'Hobb'),
(13, 'Jean-Philippe', 'Jaworski');

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
  `ISBN_book` bigint(20) NOT NULL,
  `disponibility_book` tinyint(4) NOT NULL DEFAULT '0',
  `language_book` varchar(60) NOT NULL DEFAULT 'Français',
  `date_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo_capture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `id_member`, `id_author`, `id_category`, `title_book`, `summary_book`, `photo_book`, `ISBN_book`, `disponibility_book`, `language_book`, `date_book`, `pseudo_capture`) VALUES
(12389869, 8, 12, 1, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 9782756406053, 1, 'Français', '2017-09-05 13:28:13', 'lola'),
(23877124, 2, 12, 3, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 1, 'Français', '2017-09-04 08:13:49', 'anonyme'),
(29474524, 2, 4, 1, 'Les rois maudits -', 'La célébrissime fresque de Maurice Druon, considérée comme un modèle du roman historique, enfin disponible en numérique !', 'http://books.google.com/books/content?id=Hp4nAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 9782259223355, 1, 'Français', '2017-09-04 08:10:24', 'anonyme'),
(36349569, 2, 12, 1, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 0, 'Français', '2017-09-04 08:17:09', 'anonyme'),
(36471846, 8, 13, 6, 'Janua Vera', 'Entre rêves vaporeux et froide réalité, un moment de lecture unique. Janua vera a été récompensé par le prix du Cafard Cosmique 2008.', 'http://books.google.com/books/content?id=L-3xPgAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 9782070355709, 0, 'Français', '2017-09-06 08:14:48', 'lola'),
(37312796, 2, 12, 1, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 9782756406053, 0, 'Français', '2017-09-04 08:30:03', 'anonyme'),
(39373419, 5, 7, 2, 'Le portrait de Dorian Gray', 'Pendant des semaines, il ne montait pas, et il oubliait l&#39;horrible chose peinte en se tournant, le coeur léger et rempli de joies insouciantes, vers les plaisirs de la simple existence.', 'http://books.google.com/books/content?id=2Aw_HAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 207, 1, 'Français', '2017-08-29 14:35:59', 'anonyme'),
(39493599, 2, 12, 6, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 0, 'Français', '2017-09-04 08:13:24', 'anonyme'),
(44125526, 2, 8, 3, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Français', '2017-09-04 07:42:41', 'anonyme'),
(45682786, 2, 12, 1, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 0, 'Français', '2017-09-04 08:19:29', 'anonyme'),
(54281662, 2, 10, 1, 'Angels', 'Angels: How to See, Hear and Feel Your Angels is a beautiful introductory guide that will show you how to start working with these angelic beings, allowing their light to heal and support you.', 'http://books.google.com/books/content?id=0ZZKnwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Anglais', '2017-08-30 08:18:48', 'lola'),
(55860054, 2, 9, 5, 'Go Pro', 'Over twenty years ago, Worre began focusing on developing the skills to become a network marketing expert.', 'http://books.google.com/books/content?id=iUeNmwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 9780988667907, 0, 'Anglais', '2017-08-31 12:12:14', 'anonyme'),
(66255587, 2, 11, 5, 'The Power of Habit', 'In The Power of Habit, award-winning New York Times business reporter Charles Duhigg takes us to the thrilling edge of scientific discoveries that explain why habits exist and how they can be changed.', 'http://books.google.com/books/content?id=3IWKOZM-8isC&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Anglais', '2017-09-02 17:31:28', 'anonyme'),
(70515656, 2, 9, 1, 'Go Pro', 'Over twenty years ago, Worre began focusing on developing the skills to become a network marketing expert.', 'http://books.google.com/books/content?id=iUeNmwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 0, 'Anglais', '2017-08-31 15:16:56', 'anonyme'),
(81787612, 2, 12, 4, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 9782756406053, 1, 'Français', '2017-09-05 10:19:05', 'anonyme'),
(84115063, 3, 7, 12, 'Le portrait de Dorian Gray', 'Pendant des semaines, il ne montait pas, et il oubliait l&#39;horrible chose peinte en se tournant, le coeur léger et rempli de joies insouciantes, vers les plaisirs de la simple existence.', 'http://books.google.com/books/content?id=2Aw_HAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070384853, 1, 'Français', '2017-08-28 11:02:28', 'none'),
(85195737, 2, 2, 1, 'Le vieil homme et la mer', 'On a vu avec raison dans Le vieil homme et la mer un des chefs-d&#39;œuvre de Hemingway.', 'http://books.google.com/books/content?id=ZGJplwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070360075, 0, 'Français', '2017-08-28 10:57:10', 'loli'),
(85463023, 3, 5, 1, 'La communauté de l\'Anneau', 'Aux temps reculés de ce récit, la Terre est peuplée d&#39;innombrables créatures : les Hobbits, apparentés à l&#39;Homme, les Elfes et les Nains vivent en paix dans la Comté.', 'http://books.google.com/books/content?id=L_iqAAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 11:01:14', 'none'),
(85581514, 2, 4, 9, 'Les rois maudits -', 'La célébrissime fresque de Maurice Druon, considérée comme un modèle du roman historique, enfin disponible en numérique !', 'http://books.google.com/books/content?id=Hp4nAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 10:58:37', 'none'),
(86178682, 3, 8, 13, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 11:03:37', 'none'),
(86956636, 2, 8, 2, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Français', '2017-09-04 07:42:03', 'anonyme'),
(87069644, 3, 6, 12, 'Le procès', 'Le procès intenté à Joseph K., qui ne connaîtra pas ses juges, ne relève d&#39;aucun code et ne pouvait s&#39;achever ni sur un acquittement ni sur une damnation, puisque Joseph K. n&#39;était coupable que d&#39;exister.', 'http://books.google.com/books/content?id=JTkMPAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070378403, 1, 'Français', '2017-08-28 11:01:48', 'none'),
(87603955, 2, 1, 12, 'L\'étranger', 'Quand la sonnerie a encore retenti, que la porte du box s&#39;est ouverte, c&#39;est le silence de la salle qui est monté vers moi, le silence, et cette singulière sensation que j&#39;ai eue lorsque j&#39;ai constaté que le jeune journaliste avait ...', 'http://books.google.com/books/content?id=o1goAQAAIAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070360024, 0, 'Français', '2017-08-28 10:56:20', 'none'),
(88021618, 2, 9, 10, 'Go Pro', 'Over twenty years ago, Worre began focusing on developing the skills to become a network marketing expert.', 'http://books.google.com/books/content?id=iUeNmwEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 978, 1, 'Anglais', '2017-08-30 15:55:19', 'anonyme'),
(88045274, 2, 3, 12, 'Le Comte de Monte Cristo', 'Une seule collection de lecture pour tous niveaux !', 'http://books.google.com/books/content?id=KdfFCQAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 2147483647, 1, 'Français', '2017-08-28 10:57:57', 'none'),
(89051065, 3, 6, 12, 'Le procès', 'Le procès intenté à Joseph K., qui ne connaîtra pas ses juges, ne relève d&#39;aucun code et ne pouvait s&#39;achever ni sur un acquittement ni sur une damnation, puisque Joseph K. n&#39;était coupable que d&#39;exister.', 'http://books.google.com/books/content?id=JTkMPAAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2070378403, 0, 'Français', '2017-08-28 11:01:39', 'none'),
(89549641, 2, 4, 3, 'Les rois maudits -', 'La célébrissime fresque de Maurice Druon, considérée comme un modèle du roman historique, enfin disponible en numérique !', 'http://books.google.com/books/content?id=Hp4nAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 0, 'Français', '2017-09-04 08:11:24', 'anonyme'),
(89928469, 3, 8, 13, 'Fondation', 'Récompensé par le prix Hugo de la &quot;meilleure série de science-fiction de tous les temps Le cycle de Fondation est l&#39;œuvre socle de la S-F moderne, celle que tous les amateurs du genre ont lue ou liront un jour.', 'http://books.google.com/books/content?id=TWKQPwAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 2147483647, 0, 'Français', '2017-08-28 11:03:25', 'anonyme'),
(96287193, 2, 12, 1, 'L\'Assassin royal (Tome 1) - L\'Apprenti assassin', 'Depuis toujours, les Loinvoyant règnent sur le royaume des Six-Duchés, battu par le vents, utilisant une force mystérieuse pour contenir l&#39;intrusion des Pirates rouges qui ravagent les côtes et laissent dans leur sillage de morts ...', 'http://books.google.com/books/content?id=sgc9Kzpa0XYC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 978, 0, 'Français', '2017-09-04 08:22:11', 'anonyme');

-- --------------------------------------------------------

--
-- Table structure for table `captures`
--

CREATE TABLE `captures` (
  `id_pointer` int(11) NOT NULL,
  `id_member` int(11) NOT NULL DEFAULT '0',
  `comment_capture` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `captures`
--

INSERT INTO `captures` (`id_pointer`, `id_member`, `comment_capture`) VALUES
(1, 3, 'Merci!'),
(2, 3, 'Un grand merci encore!'),
(3, 2, 'Cool!'),
(4, 2, 'Ce livre est génial!'),
(5, 2, 'Retour a l\'envoyeur'),
(6, 1, 'Merci!'),
(8, 2, 'Vraiment bien'),
(9, 2, 'Vraiment bien'),
(10, 2, 'Sympa!'),
(11, 6, 'Great..'),
(13, 2, NULL),
(14, 2, NULL),
(15, 2, NULL),
(16, 2, NULL),
(17, 1, NULL),
(18, 2, NULL),
(19, 8, 'Super'),
(20, 8, 'cg');

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
(16, 'Voyages');

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
  `id_friend` int(11) NOT NULL,
  `id_member_1` int(11) NOT NULL,
  `id_member_2` int(11) NOT NULL,
  `action_friend` int(11) NOT NULL,
  `status_friend` tinyint(4) NOT NULL,
  `date_friend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id_friend`, `id_member_1`, `id_member_2`, `action_friend`, `status_friend`, `date_friend`) VALUES
(1, 2, 3, 3, 0, '2017-08-29 10:03:16'),
(2, 2, 5, 5, 3, '2017-08-29 12:39:35');

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
(0, 'none', '', '', 'default.png', '', '2017-08-29 09:48:59', '', 0),
(1, 'anonyme', '', '', 'default.png', '', '2017-08-28 10:49:02', '', 0),
(2, 'anonyme', '', '', 'default.png', '', '2017-08-28 10:50:04', '', 0),
(3, 'luciol', 'lgallay@orange.fr', '94794a9cc06abf4be9f480d227eb0e15b945494a', 'default.png', '', '2017-08-28 10:59:56', 'ROLE_ADMIN', 0),
(5, 'hugo', 'wf3@hl-media.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'default.png', '', '2017-08-29 14:30:11', 'ROLE_MEMBER', 0),
(6, 'loli', 'loli@hotmail.fr', '4b9f836522388e0bdad930ecc008b5984c905692', 'default.png', '', '2017-08-31 16:52:41', 'ROLE_MEMBER', 0),
(7, 'jo', 'jo@hotmail.fr', 'ade5bf7f23ab45a1ed70bb150c39a45144f6c525', 'default.png', '', '2017-09-02 16:24:38', 'ROLE_MEMBER', 0),
(8, 'lola', 'lola@gmail.com', '34819c3a20d194cca761cc20873a14e92e37c633', 'default.png', '', '2017-09-05 13:13:18', 'ROLE_MEMBER', 0);

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
(5, 85195737, 45.764, 4.83566, 'Lyon', '2017-08-28 13:34:25'),
(6, 88021618, 40.7128, -74.0059, 'New York', '2017-08-30 20:59:25'),
(7, 12345678, 51.5074, -0.127758, 'London', '2017-08-31 16:02:17'),
(8, 12345678, 51.5074, -0.127758, 'London', '2017-08-31 16:02:50'),
(9, 12345678, 51.5074, -0.127758, 'London', '2017-08-31 16:07:43'),
(10, 89928469, 45.9364, 4.71873, 'Anse', '2017-08-31 16:11:17'),
(11, 85195737, -21.3328, 55.4718, 'Saint Pierre', '2017-08-31 16:54:52'),
(12, 897, 51.5074, -0.127758, 'London', '2017-09-02 09:35:32'),
(13, 897, 51.5074, -0.127758, 'London', '2017-09-02 09:36:31'),
(14, 3937, 51.5074, -0.127758, 'London', '2017-09-02 09:45:55'),
(15, 39373419, 51.5074, -0.127758, 'London', '2017-09-02 09:54:34'),
(16, 39373419, 25.7617, -80.1918, 'Miami', '2017-09-02 09:55:30'),
(17, 39373419, 21.1702, 72.8311, 'Surat', '2017-09-02 09:59:47'),
(18, 12456987, 41.8781, -87.6298, 'Chicago', '2017-09-02 10:54:43'),
(19, 54281662, 36.1699, -115.14, 'Las Vegas', '2017-09-06 10:36:36'),
(20, 54281662, 43.8367, 4.36005, 'Nimes', '2017-09-06 10:39:29');

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
(21997126, 45.764, 4.83566, 'Lyon'),
(39373419, 14.5825, -60.9656, 'Ducos'),
(54281662, 45.764, 4.83566, 'Lyon'),
(88021618, 45.764, 4.83566, 'Lyon'),
(55860054, 51.5074, -0.127758, 'London'),
(70515656, 46.2044, 6.14316, 'Geneva'),
(66255587, 48.8566, 2.35222, 'Paris'),
(44125526, 50.6292, 3.05726, 'Lille'),
(29474524, 27.0238, 74.2179, 'Rajasthan'),
(89549641, 51.5074, -0.127758, 'London'),
(23877124, 50.1109, 8.68213, 'Frankfurt'),
(36349569, 47.6062, -122.332, 'Seattle'),
(45682786, 51.4556, 7.01156, 'Essen'),
(96287193, 42.6064, -83.1498, 'Troy'),
(37312796, 37.7397, -121.425, 'Tracy'),
(81787612, 50.6292, 3.05726, 'Lille'),
(12389869, 45.764, 4.83566, 'Lyon'),
(36471846, 51.5074, -0.127758, 'London');

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
,`ISBN_book` bigint(20)
,`disponibility_book` tinyint(4)
,`language_book` varchar(60)
,`date_book` timestamp
,`pseudo_capture` varchar(50)
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
`id_book` int(8)
,`title_book` varchar(100)
,`date_book` timestamp
,`avatar_member` varchar(250)
,`pseudo_member` varchar(50)
,`lat_startpoint` float
,`lng_startpoint` float
,`city_startpoint` varchar(60)
,`lat_pointer` float
,`lng_pointer` float
,`city_pointer` varchar(150)
,`date_pointer` timestamp
,`pseudo_captures` varchar(50)
,`avatar_captures` varchar(250)
);

-- --------------------------------------------------------

--
-- Structure for view `view_books`
--
DROP TABLE IF EXISTS `view_books`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_books`  AS  select `b`.`id_book` AS `id_book`,`b`.`id_member` AS `id_member`,`b`.`id_author` AS `id_author`,`b`.`id_category` AS `id_category`,`b`.`title_book` AS `title_book`,`b`.`summary_book` AS `summary_book`,`b`.`photo_book` AS `photo_book`,`b`.`ISBN_book` AS `ISBN_book`,`b`.`disponibility_book` AS `disponibility_book`,`b`.`language_book` AS `language_book`,`b`.`date_book` AS `date_book`,`b`.`pseudo_capture` AS `pseudo_capture`,`a`.`firstname_author` AS `firstname_author`,`a`.`lastname_author` AS `lastname_author`,`c`.`name_category` AS `name_category`,`m`.`pseudo_member` AS `pseudo_member`,`m`.`avatar_member` AS `avatar_member`,`m`.`mail_member` AS `mail_member`,`s`.`lat_startpoint` AS `lat_startpoint`,`s`.`lng_startpoint` AS `lng_startpoint`,`s`.`city_startpoint` AS `city_startpoint` from ((((`books` `b` join `authors` `a` on((`b`.`id_author` = `a`.`id_author`))) join `categories` `c` on((`b`.`id_category` = `c`.`id_category`))) join `members` `m` on((`b`.`id_member` = `m`.`id_member`))) join `startpoints` `s` on((`b`.`id_book` = `s`.`id_book`))) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_story`  AS  select `b`.`id_book` AS `id_book`,`b`.`title_book` AS `title_book`,`b`.`date_book` AS `date_book`,`m`.`avatar_member` AS `avatar_member`,`m`.`pseudo_member` AS `pseudo_member`,`s`.`lat_startpoint` AS `lat_startpoint`,`s`.`lng_startpoint` AS `lng_startpoint`,`s`.`city_startpoint` AS `city_startpoint`,`p`.`lat_pointer` AS `lat_pointer`,`p`.`lng_pointer` AS `lng_pointer`,`p`.`city_pointer` AS `city_pointer`,`p`.`date_pointer` AS `date_pointer`,`mm`.`pseudo_member` AS `pseudo_captures`,`mm`.`avatar_member` AS `avatar_captures` from (((((`books` `b` join `members` `m` on((`b`.`id_member` = `m`.`id_member`))) join `startpoints` `s` on((`b`.`id_book` = `s`.`id_book`))) left join `pointers` `p` on((`b`.`id_book` = `p`.`id_book`))) left join `captures` `c` on((`p`.`id_pointer` = `c`.`id_pointer`))) left join `members` `mm` on((`c`.`id_member` = `mm`.`id_member`))) ;

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
  ADD KEY `id_category` (`id_category`),
  ADD KEY `pseudo_capture` (`pseudo_capture`);

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
  ADD PRIMARY KEY (`id_friend`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `pseudo_member` (`pseudo_member`);

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
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id_friend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pointers`
--
ALTER TABLE `pointers`
  MODIFY `id_pointer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_4` FOREIGN KEY (`pseudo_capture`) REFERENCES `members` (`pseudo_member`) ON UPDATE CASCADE;

--
-- Constraints for table `captures`
--
ALTER TABLE `captures`
  ADD CONSTRAINT `captures_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `captures_ibfk_2` FOREIGN KEY (`id_pointer`) REFERENCES `pointers` (`id_pointer`);

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE;
