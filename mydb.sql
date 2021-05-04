-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 04 mai 2021 à 20:38
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `id_avatar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avatars`
--

INSERT INTO `avatars` (`id`, `id_avatar`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Structure de la table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bills`
--

INSERT INTO `bills` (`id`, `date`, `amount`) VALUES
(1, '2020-07-20 21:42:37', 30),
(2, '2020-08-04 14:15:07', 50);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_episode` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alert_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_member`, `id_episode`, `content`, `date`, `alert_status`) VALUES
(1, 1, 6, 'Au top j\'adore !', '2020-07-20 21:41:08', 0),
(2, 1, 7, 'Passionnant !', '2020-07-20 21:41:22', 0),
(3, 2, 1, 'Blurk', '2020-07-20 21:41:38', 1),
(4, 2, 6, 'Merci !', '2020-07-20 21:41:55', 0),
(5, 1, 10, 'Super ton épisode, j\'adore !', '2021-04-25 12:36:59', 0);

-- --------------------------------------------------------

--
-- Structure de la table `covers`
--

CREATE TABLE `covers` (
  `id` int(11) NOT NULL,
  `id_cover` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `covers`
--

INSERT INTO `covers` (`id`, `id_cover`) VALUES
(1, 10),
(2, 11),
(3, 12),
(4, 13),
(5, 14),
(6, 15),
(7, 16),
(8, 17),
(9, 18),
(10, 19),
(11, 20),
(12, 20),
(13, 23),
(14, 23),
(15, 23),
(16, 23),
(17, 23),
(18, 23),
(19, 23),
(20, 23),
(21, 23),
(22, 23),
(23, 23),
(24, 34),
(25, 35),
(26, 36),
(27, 37),
(28, 38),
(29, 39),
(31, 41),
(32, 42),
(33, 43),
(34, 44),
(35, 45),
(36, 46),
(37, 47),
(38, 48),
(39, 49),
(40, 50),
(41, 51),
(42, 52),
(43, 53),
(44, 54),
(45, 55),
(46, 56),
(47, 57),
(48, 58),
(49, 59),
(50, 60),
(51, 61),
(52, 62),
(53, 63),
(54, 64),
(55, 65),
(56, 66),
(57, 67),
(58, 68),
(59, 69),
(60, 70),
(61, 71),
(62, 72),
(63, 73),
(64, 74),
(65, 75),
(66, 76),
(67, 77),
(68, 78),
(69, 79),
(70, 80),
(71, 81),
(72, 82),
(73, 83),
(74, 84),
(75, 85),
(76, 86),
(77, 87),
(78, 88),
(79, 89),
(80, 90),
(81, 91),
(82, 92),
(83, 93),
(84, 94),
(85, 95),
(86, 96),
(87, 97),
(88, 98),
(89, 99),
(90, 100),
(91, 101),
(92, 102),
(93, 103),
(94, 104),
(95, 105),
(96, 106),
(97, 107),
(98, 108),
(99, 109),
(100, 110),
(101, 111),
(102, 112),
(103, 113),
(104, 114),
(105, 115),
(106, 116),
(107, 117),
(108, 118),
(109, 119),
(110, 120),
(111, 121),
(112, 122),
(113, 123),
(114, 124),
(115, 125),
(116, 126),
(117, 127),
(118, 128),
(119, 129),
(120, 130),
(121, 131),
(122, 132),
(123, 133),
(124, 134),
(125, 135),
(126, 136),
(127, 137),
(128, 138),
(129, 139),
(130, 140),
(131, 141),
(132, 142),
(133, 143),
(134, 144),
(135, 145),
(136, 146),
(137, 147),
(138, 148),
(139, 149),
(140, 150),
(141, 151),
(142, 152),
(143, 153),
(144, 154),
(145, 155),
(146, 156),
(147, 157),
(149, 159),
(151, 161),
(152, 162),
(153, 163),
(154, 164),
(155, 165),
(156, 166),
(157, 167),
(158, 167),
(159, 169),
(160, 170),
(161, 170),
(162, 170),
(163, 173),
(164, 174),
(165, 175),
(166, 176),
(167, 177),
(168, 178),
(169, 179),
(170, 180),
(171, 181),
(172, 182),
(174, 184),
(176, 186),
(179, 190),
(181, 192),
(183, 194),
(185, 196),
(187, 198),
(192, 203),
(195, 206),
(196, 207),
(197, 208),
(198, 209),
(199, 210),
(200, 211),
(201, 212),
(202, 213),
(203, 214),
(204, 215),
(205, 216),
(206, 217),
(207, 218),
(208, 219),
(209, 220),
(210, 221),
(211, 222),
(212, 223),
(213, 224),
(214, 225),
(215, 226),
(216, 227),
(217, 228),
(218, 229);

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `publishing_status` enum('published','inprogress','deleted') NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_series` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `likes_number` int(11) NOT NULL DEFAULT '0',
  `alert_status` tinyint(4) NOT NULL DEFAULT '0',
  `promotion` float NOT NULL DEFAULT '0',
  `signs_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `number`, `title`, `content`, `publishing_status`, `date`, `id_series`, `price`, `likes_number`, `alert_status`, `promotion`, `signs_number`) VALUES
(1, 1, 'Premier épisode', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc in augue sit amet augue accumsan finibus. Fusce a pharetra nunc. Pellentesque et sapien dapibus, dignissim ligula in, fermentum lacus. Pellentesque consectetur at sem dignissim auctor. Nam mollis neque sit amet euismod faucibus. Morbi et dolor id lectus dictum accumsan. Cras ut magna vitae erat aliquet lobortis.\r\n\r\nVestibulum dui quam, semper et neque at, tincidunt fermentum quam. Praesent tincidunt fermentum augue, et tincidunt ipsum suscipit sagittis. Integer nec auctor ex. Ut nec cursus quam. Vivamus eu facilisis purus. Donec facilisis, ipsum sit amet egestas pretium, leo nunc ultricies justo, vitae facilisis metus nulla nec nunc. Vestibulum pellentesque libero ligula, ac volutpat orci viverra sed. Suspendisse dictum semper erat. Duis sodales tristique odio sed pellentesque. Donec ut consectetur orci, at luctus lectus. Nulla placerat augue erat, et congue nibh lobortis eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'published', '2020-07-20 21:35:20', 1, 3, 0, 0, 0, 3000),
(2, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:17', 2, 0, 0, 0, 0, 3000),
(3, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:41', 3, 0, 0, 0, 0, 3000),
(4, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:58', 4, 0, 0, 0, 0, 3000),
(5, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:18', 5, 0, 0, 0, 0, 3000),
(6, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:50', 6, 3.25, 0, 0, 0, 3000),
(7, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:07', 7, 3, 0, 0, 0, 3000),
(8, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:24', 8, 3, 0, 0, 0, 3000),
(9, 2, 'Deuxième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:38', 12, 6, 4, 0, 0, 3000),
(10, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:39:02', 12, 3, 2, 0, 0, 3000),
(11, 2, 'Deuxième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:40:01', 1, 0, 0, 0, 0, 3000),
(12, 3, 'Troisième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:40:23', 12, 0, 6, 1, 0, 3000),
(13, 1, 'Premier épisode', 'On essaye', 'inprogress', '2021-04-21 11:56:38', 138, 1, 0, 0, 0, 100),
(14, 1, 'Premier épisode encore', 'Blabla', 'inprogress', '2021-04-21 11:59:11', 138, 0, 0, 0, 0, 100),
(15, 2, 'Premier épisode encore', 'Blabla', 'published', '2021-04-21 12:00:46', 138, 0, 0, 0, 0, 100),
(16, 1, 'Test', 'Encore', 'published', '2021-04-21 12:06:20', 138, 2, 0, 0, 0, 100),
(17, 1, 'Test', 'Encore', 'inprogress', '2021-04-21 12:08:05', 138, 2, 0, 0, 0, 100),
(18, 3, 'Test', 'Encore', 'inprogress', '2021-04-21 12:10:16', 138, 2, 0, 0, 0, 100),
(19, 4, 'Bonjour', 'Blabla', 'inprogress', '2021-04-21 12:15:49', 138, 4, 0, 0, 0, 100),
(20, 1, 'Premier épisode', 'Il était une fois', 'inprogress', '2021-04-21 14:53:50', 143, 5, 0, 0, 0, 100),
(21, 1, 'Premier épisode', 'Il était une fois', 'inprogress', '2021-04-21 15:05:23', 151, 1, 0, 0, 0, 100),
(22, 2, 'hola', 'Ca va ?', 'published', '2021-04-21 15:05:47', 151, 0, 0, 0, 0, 100),
(23, 1, 'Premier épisode', 'he', 'inprogress', '2021-04-21 15:12:33', 151, 1, 0, 0, 0, 100),
(24, 1, 'Premier épisode', 'Blabla', 'inprogress', '2021-04-21 15:30:56', 151, 1, 0, 0, 1, 100),
(25, 1, 'Test promotion', 'Hello', 'inprogress', '2021-04-21 15:32:29', 151, 2, 0, 0, 2, 100),
(26, 1, 'Bonjour', 'Hola', 'inprogress', '2021-04-21 15:36:33', 151, 10, 0, 0, 2, 100),
(27, 1, 'Premier épisode', 'Bonjour', 'inprogress', '2021-04-21 16:54:58', 153, 10, 0, 0, 2, 100),
(28, 1, 'Premier épisode', 'Il était une fois', 'inprogress', '2021-04-28 12:16:01', 154, 5, 0, 0, 0, 100),
(29, 2, 'Premier épisode', 'blqblq', 'published', '2021-04-28 13:39:29', 139, 0.05, 0, 0, 0, 100),
(30, 2, 'Episode 1', 'Blabla', 'published', '2021-04-28 14:16:14', 159, 0, 0, 0, 0, 100),
(31, 1, 'Premier épisode', 'Blabla', 'published', '2021-05-02 11:51:31', 161, 10, 0, 0, 3, 100),
(32, 2, 'Deuxième épisode', 'Blabla', 'published', '2021-05-02 11:52:26', 161, 4, 0, 0, 0, 100),
(33, 3, 'Troisième épisode', 'Blabla', 'inprogress', '2021-05-02 11:53:34', 161, 0, 0, 0, 0, 100),
(34, 3, 'Troisième épisode', 'Blabal', 'published', '2021-05-02 11:54:03', 161, 0, 0, 0, 0, 100),
(35, 4, 'Quatrième épisode', 'Blablabla', 'published', '2021-05-02 13:35:00', 161, 15, 0, 0, 0, 100),
(36, 5, 'Cinquième épisode', 'Blabla', 'published', '2021-05-02 13:36:00', 161, 0, 0, 0, 0, 100),
(37, 6, 'Sixième épisode', 'Blabala', 'published', '2021-05-20 13:37:00', 161, 0, 0, 0, 0, 100),
(38, 7, '7e épisode', 'Blabal', 'inprogress', '2021-05-02 11:38:41', 161, 0, 0, 0, 0, 100),
(39, 1, 'Premier épisode', 'Blabla', 'published', '2021-05-03 22:24:00', 162, 10, 0, 0, 0, 100),
(40, 2, 'Deuxième épisode', 'Blaba', 'published', '2021-05-04 22:27:00', 162, 5, 0, 0, 0, 100);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` enum('avatar','publisher','cover') NOT NULL,
  `alt` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `name`, `type`, `alt`, `url`) VALUES
(1, 'avatar_cat', 'avatar', 'Avatar Chat', './public/images/avatar_cat.png'),
(2, 'avatar_cheriff', 'avatar', 'Avatar Cherif', './public/images/avatar_cheriff.png'),
(3, 'avatar_doctor', 'avatar', 'Avatar Docteur', './public/images/avatar_doctor.png'),
(4, 'avatar_fairy', 'avatar', 'Avatar Fée', './public/images/avatar_fairy.png'),
(5, 'avatar_princess', 'avatar', 'Avatar Princesse', './public/images/avatar_princess.png'),
(6, 'avatar_sherlock', 'avatar', 'Avatar Sherlock', './public/images/avatar_sherlock.png'),
(7, 'avatar_superworman', 'avatar', 'Avatar Superwoman', './public/images/avatar_superwoman.png'),
(8, 'avatar_vampire', 'avatar', 'Avatar Vampire', './public/images/avatar_vampire.png'),
(9, 'publisher_public-domain', 'publisher', 'Domaine Public', './public/images/publisher_public-domain.png'),
(10, 'poster_geek', 'cover', 'Geek', './public/images/poster_geek.png'),
(11, 'poster_prophetia', 'cover', 'Prophetia', './public/images/poster_prophetia.png'),
(12, 'poster_elysee', 'cover', 'Elysée', './public/images/poster_elysee.png'),
(13, 'poster_renaissance', 'cover', 'Renaissance', './public/images/poster_renaissance.png'),
(14, 'poster_newboss', 'cover', 'New Boss', './public/images/poster_newboss.png'),
(15, 'poster_ile-au-tresor', 'cover', 'L\'île au trésor', './public/images/poster_ile-au-tresor'),
(16, 'poster_chien-baskerville', 'cover', 'Le chien des Baskerville', './public/images/poster_chien-baskerville.png'),
(17, 'poster_orgueil-prejuges', 'cover', 'Orgueil et Préjugés', './public/images/poster_orgueil-prejuges.png'),
(18, 'poster_dracula', 'cover', 'Dracula', './public/images/poster_dracula.png'),
(19, 'poster_fantome-opera', 'cover', 'Le fantôme de l\'opéra', './public/images/poster_fantome-opera.png'),
(20, '22bfdc4819a906fff2a31a13bdea450c10f856f4', 'cover', 'Hello', 'public/images/'),
(21, '67be1693bb2d2f10271fb88bc780c30293c9cdb5', 'cover', 'Hello', 'public/images/'),
(22, '88796d605ec607d9a22070f0c6eeec85dc34beb6', 'cover', 'Hello', 'public/images/'),
(23, '899179a4d0a9e9ed539a3c8c8cad1431ccd98c7c', 'cover', 'Test 1', './public/images/899179a4d0a9e9ed539a3c8c8cad1431ccd98c7c'),
(24, '991cb78e2221d80bce34a8609ee9ab5609a06bac', 'cover', 'Try1', './public/images/'),
(25, 'bcfc74f829b41566ff6c205c6ed08b43d934a0c7', 'cover', 'Try2', './public/images/'),
(27, '7ba86a8d2c8661c34672a3905c39bb7e375d6241', 'cover', 'Try3', './public/images/'),
(28, 'edd6a3197bff34b377e503d8bd670fdf6bf35edb', 'cover', 'Try3', './public/images/'),
(29, '0e254943c4c591cfb16e7821b5439acd97c95052', 'cover', 'Try4', './public/images/'),
(30, 'ea219157cb6a37c5ee0f56b8ff963ccde3a8a241', 'cover', 'Try4', './public/images/'),
(31, '299d57187ad66bdd321333c3e66b8789ee10f9fd', 'cover', 'Try4', './public/images/'),
(32, '2733d5118c16b66bdc75cb73c99b73af3887169c', 'cover', 'Try4', './public/images/'),
(33, '2b333c083ecc60e48c89785f3d74eeed06b83905', 'cover', 'Try4', './public/images/'),
(34, 'e5644778d3beba9a9d8eb97868a12518be68240d', 'cover', 'Try5', './public/images/e5644778d3beba9a9d8eb97868a12518be68240d'),
(35, 'e10b95c077e50d5bb62a4dd2b5ffbf8b9960585b', 'cover', 'Essai N°6', './public/images/e10b95c077e50d5bb62a4dd2b5ffbf8b9960585b'),
(36, '98c00c3b82e045d767688ff25330526713874334', 'cover', 'Essai N°7', './public/images/98c00c3b82e045d767688ff25330526713874334'),
(37, '56819a09fcfd9d166e8d6126186018a6dc2f45d6', 'cover', 'Essai N°7', './public/images/56819a09fcfd9d166e8d6126186018a6dc2f45d6'),
(38, '10221b51071eb201c72640fa47c633bbd63f9b48', 'cover', 'Essai N°7', './public/images/10221b51071eb201c72640fa47c633bbd63f9b48'),
(39, '34a8298f83933cea8a9edfec5a0184ea18a4635e', 'cover', 'Essai N°8', './public/images/34a8298f83933cea8a9edfec5a0184ea18a4635e'),
(41, '12b8999fe3db0e2a2d5957b938e36a4bd655323f', 'cover', 'Essai N°8', './public/images/12b8999fe3db0e2a2d5957b938e36a4bd655323f'),
(42, 'badefcb54a6a8d9a7bc8af6d11bd350deb718586', 'cover', 'Essai N°8', './public/images/badefcb54a6a8d9a7bc8af6d11bd350deb718586'),
(43, '526ab58b3bcc094ba30bb4efde9fb9390aa5a508', 'cover', 'Essai', './public/images/526ab58b3bcc094ba30bb4efde9fb9390aa5a508'),
(44, '7f371874f40cc77657bfac8914e4678d883e3fc9', 'cover', 'Essai', './public/images/7f371874f40cc77657bfac8914e4678d883e3fc9'),
(45, '75b18bcfedf869e0d4bf2504c4acc8dcec8ce78c', 'cover', 'Essai', './public/images/75b18bcfedf869e0d4bf2504c4acc8dcec8ce78c'),
(46, 'ed8e59bb43e9a46c9a1f42dc7dccb870ceee03a2', 'cover', 'Essai', './public/images/ed8e59bb43e9a46c9a1f42dc7dccb870ceee03a2'),
(47, '0f51b79bfc540a6beb87a9953de1f54bc5cb3316', 'cover', 'On essaye', './public/images/0f51b79bfc540a6beb87a9953de1f54bc5cb3316'),
(48, '41b6df392d856cecee28d67929c04d25a39d468f', 'cover', 'On essaye', './public/images/41b6df392d856cecee28d67929c04d25a39d468f'),
(49, '5b3529bbbb3429ca150b2eaa222d8391da6c485f', 'cover', 'On essaye', './public/images/5b3529bbbb3429ca150b2eaa222d8391da6c485f'),
(50, 'd1d9cce778c4281e66f6d3575c8a1249ebb7ba6a', 'cover', 'Coucou', './public/images/d1d9cce778c4281e66f6d3575c8a1249ebb7ba6a'),
(51, 'ba7291f4b475233d32484fd767b97b88089e8bc4', 'cover', 'Coucou', './public/images/ba7291f4b475233d32484fd767b97b88089e8bc4'),
(52, '73df7d895951180e40683a5c1023bb282da58995', 'cover', 'Nouveau test', './public/images/73df7d895951180e40683a5c1023bb282da58995'),
(53, '7629e2dcc81557a96e05151066e6a60ea100d86d', 'cover', 'Nouveau test', './public/images/7629e2dcc81557a96e05151066e6a60ea100d86d'),
(54, 'df00c9dc5ebf3adb66554a0a6f1867cc4f9f8bd9', 'cover', 'Nouveau test', './public/images/df00c9dc5ebf3adb66554a0a6f1867cc4f9f8bd9'),
(55, 'ba0c97da76c7ce20c38d71dc8bc9dd9fe05952ea', 'cover', 'Nouveau test', './public/images/ba0c97da76c7ce20c38d71dc8bc9dd9fe05952ea'),
(56, 'f113816a7dbfdaf85cd14a2533036d343021fc74', 'cover', 'Nouveau test', './public/images/f113816a7dbfdaf85cd14a2533036d343021fc74'),
(57, 'f0f67aa2c5562460b9a9fa0f94c336da3a40b8f2', 'cover', 'Nouveau test', './public/images/f0f67aa2c5562460b9a9fa0f94c336da3a40b8f2'),
(58, 'e6f7af933c3f577bfb18f4fae5df19307523458b', 'cover', 'Nouveau test', './public/images/e6f7af933c3f577bfb18f4fae5df19307523458b'),
(59, 'd0e7b593a40096bf3455ce7285767651d0a86391', 'cover', 'Nouveau test', './public/images/d0e7b593a40096bf3455ce7285767651d0a86391'),
(60, 'db9f47a259ea95213e943533d50dd11a0704078e', 'cover', 'Nouveau test', './public/images/db9f47a259ea95213e943533d50dd11a0704078e'),
(61, '41acfc7c8103a6e9a39dee63a5a61cc22e55db5f', 'cover', 'Nouveau test', './public/images/41acfc7c8103a6e9a39dee63a5a61cc22e55db5f'),
(62, '79be782bd28137df6419cea407cbb7b18b708d9b', 'cover', 'Nouveau test', './public/images/79be782bd28137df6419cea407cbb7b18b708d9b'),
(63, 'fa7141874ac7bf63b5595fc79e277fd252609272', 'cover', 'Nouveau test', './public/images/fa7141874ac7bf63b5595fc79e277fd252609272'),
(64, '0f65826c93d1528d9fc6d06fef52fcd2c3e9394a', 'cover', 'Hello', './public/images/0f65826c93d1528d9fc6d06fef52fcd2c3e9394a'),
(65, 'fc32d10eefedef81b6bd1c32a68016820c02249a', 'cover', 'Hello', './public/images/fc32d10eefedef81b6bd1c32a68016820c02249a'),
(66, 'f2e5f3b38ec6f066921531e2a26e9ecd0dd7099b', 'cover', 'Hello', './public/images/f2e5f3b38ec6f066921531e2a26e9ecd0dd7099b'),
(67, '8870e756203f800d2d247ec8b32429a395692480', 'cover', 'Hello', './public/images/8870e756203f800d2d247ec8b32429a395692480'),
(68, 'dbc7d22ad86cd4c768fb4a329c91fd3f663c30e5', 'cover', 'Hello', './public/images/dbc7d22ad86cd4c768fb4a329c91fd3f663c30e5'),
(69, '7e59d6616ee9c5109c438caea511bda151821927', 'cover', 'NewTest', './public/images/7e59d6616ee9c5109c438caea511bda151821927'),
(70, '54f9791d027b2b1e5f5e51d9c438707c779dc9f5', 'cover', 'NewTest', './public/images/54f9791d027b2b1e5f5e51d9c438707c779dc9f5_AdobeStock_206294095_Preview.jpeg'),
(71, '744d19107800dde9ad3d3a3dfd4c7e2a315c1b10', 'cover', 'NewTest', './public/images/744d19107800dde9ad3d3a3dfd4c7e2a315c1b10_AdobeStock_206294095_Preview.jpeg'),
(72, 'cbd5a4cea4b235a3387ae5e5e5c571c71882835b', 'cover', 'NewTest', './public/images/cbd5a4cea4b235a3387ae5e5e5c571c71882835b_AdobeStock_206294095_Preview.jpeg'),
(73, '87cab7536310232d4896bfd77c6699020c5168a6', 'cover', 'NewTest', './public/images/87cab7536310232d4896bfd77c6699020c5168a6_AdobeStock_206294095_Preview.jpeg'),
(74, '3c24ddd21c6ab5cb52cb8b2eccccb6fc6bb773bb', 'cover', 'Nouvelle série', './public/images/3c24ddd21c6ab5cb52cb8b2eccccb6fc6bb773bb_AdobeStock_206294095_Preview.jpeg'),
(75, '78ab87cad60fc38a39e0af34e5f81a1d14fecc0c', 'cover', 'Nouvelle série', './public/images/78ab87cad60fc38a39e0af34e5f81a1d14fecc0c_AdobeStock_206294095_Preview.jpeg'),
(76, 'a82abfd58458343d34a98bf94a0948c7f6610d9b', 'cover', 'Hello', './public/images/a82abfd58458343d34a98bf94a0948c7f6610d9b_AdobeStock_206294095_Preview.jpeg'),
(77, '035d780135e975ad0fc50754a583051d28ad05cf', 'cover', 'Hello', './public/images/035d780135e975ad0fc50754a583051d28ad05cf_AdobeStock_206294095_Preview.jpeg'),
(78, '624a42df6ff03b797222c5e9c19d959782ad19c2', 'cover', 'Hello', './public/images/624a42df6ff03b797222c5e9c19d959782ad19c2_AdobeStock_206294095_Preview.jpeg'),
(79, 'd14d4a59c300cdb175aecc413b2d03a91ee13b5c', 'cover', 'Hello', './public/images/d14d4a59c300cdb175aecc413b2d03a91ee13b5c_AdobeStock_206294095_Preview.jpeg'),
(80, '3e88452db6b03f0854bb4dae3e4579b7e2d2cf14', 'cover', 'Hello', './public/images/3e88452db6b03f0854bb4dae3e4579b7e2d2cf14_AdobeStock_206294095_Preview.jpeg'),
(81, '0a26ac8b958ae4775094c38eb6c103ebe3facaa2', 'cover', 'Hello', './public/images/0a26ac8b958ae4775094c38eb6c103ebe3facaa2_AdobeStock_206294095_Preview.jpeg'),
(82, '40b4a696b24eaac82f3342cef2a45d5b945bc3b5', 'cover', 'Hello', './public/images/40b4a696b24eaac82f3342cef2a45d5b945bc3b5_AdobeStock_206294095_Preview.jpeg'),
(83, '5078798b886308c08da632568e60fd9d23c6a13d', 'cover', 'Hello', './public/images/5078798b886308c08da632568e60fd9d23c6a13d_AdobeStock_206294095_Preview.jpeg'),
(84, 'cc9da0a07848dff11b3047b102702436e432a0c3', 'cover', 'Hello', './public/images/cc9da0a07848dff11b3047b102702436e432a0c3_AdobeStock_206294095_Preview.jpeg'),
(85, '063f29f88bd564a266fb463f0408a4636a1ef27b', 'cover', 'Hello', './public/images/063f29f88bd564a266fb463f0408a4636a1ef27b_AdobeStock_206294095_Preview.jpeg'),
(86, 'bb747ba1f4d7c9f902111cfb84e6b419a3ca8f76', 'cover', 'Hello', './public/images/bb747ba1f4d7c9f902111cfb84e6b419a3ca8f76_AdobeStock_206294095_Preview.jpeg'),
(87, 'dda58829753aeb7df86b1114538fad0539ebe231', 'cover', 'Hello', './public/images/dda58829753aeb7df86b1114538fad0539ebe231_AdobeStock_206294095_Preview.jpeg'),
(88, '2d0e021bd8b742ebc8a107e6123f2e17e66138e4', 'cover', 'Hello', './public/images/2d0e021bd8b742ebc8a107e6123f2e17e66138e4_AdobeStock_206294095_Preview.jpeg'),
(89, '9a64f346223ae1a645c5cc64c06e720a484bc4f6', 'cover', 'Hello', './public/images/9a64f346223ae1a645c5cc64c06e720a484bc4f6_AdobeStock_206294095_Preview.jpeg'),
(90, '87ddc3730814f6b0b939baeab32dd4c863213c49', 'cover', 'Hello', './public/images/87ddc3730814f6b0b939baeab32dd4c863213c49_AdobeStock_206294095_Preview.jpeg'),
(91, '6296c27e67e4002fa5b142d68372975aa265a21c', 'cover', 'Hello', './public/images/6296c27e67e4002fa5b142d68372975aa265a21c_AdobeStock_206294095_Preview.jpeg'),
(92, '71569ae68a21fc6261704e54d4cbc461d3f2c3a9', 'cover', 'Hello', './public/images/71569ae68a21fc6261704e54d4cbc461d3f2c3a9_AdobeStock_206294095_Preview.jpeg'),
(93, '04336fe172281fec136e93b26fc55f46ceac6028', 'cover', 'Hello', './public/images/04336fe172281fec136e93b26fc55f46ceac6028_AdobeStock_206294095_Preview.jpeg'),
(94, '28b2e1660759da62158f671f8115f428855423a4', 'cover', 'Hello', './public/images/28b2e1660759da62158f671f8115f428855423a4_AdobeStock_206294095_Preview.jpeg'),
(95, 'b3f9b9886067ccd91ccff4aacdecb7b988deeb39', 'cover', 'Hello', './public/images/b3f9b9886067ccd91ccff4aacdecb7b988deeb39_AdobeStock_206294095_Preview.jpeg'),
(96, 'beadfbaf7fdac03bd84b404f13df9a19cf2ec79e', 'cover', 'Hello', './public/images/beadfbaf7fdac03bd84b404f13df9a19cf2ec79e_AdobeStock_206294095_Preview.jpeg'),
(97, '6795c5732774a3c5456da602fac795543d0df1e6', 'cover', 'Hello', './public/images/6795c5732774a3c5456da602fac795543d0df1e6_AdobeStock_206294095_Preview.jpeg'),
(98, '33bcb746e2601b853dfaf03591847ae1d709de6a', 'cover', 'Nouveau test', './public/images/33bcb746e2601b853dfaf03591847ae1d709de6a_AdobeStock_206294095_Preview.jpeg'),
(99, '9b8dd3850ae40e1bc303ff59b584ae176a74e2a3', 'cover', 'Nouveau test', './public/images/9b8dd3850ae40e1bc303ff59b584ae176a74e2a3_AdobeStock_206294095_Preview.jpeg'),
(100, 'c7995d8674133b213d7c2603e7782efd9df30f1f', 'cover', 'Nouveau test', './public/images/c7995d8674133b213d7c2603e7782efd9df30f1f_AdobeStock_206294095_Preview.jpeg'),
(101, '768deb9ff3afa6cf0d01234219cd1301f1de2a29', 'cover', 'Nouveau test', './public/images/768deb9ff3afa6cf0d01234219cd1301f1de2a29_AdobeStock_206294095_Preview.jpeg'),
(102, '2233de820d85be81a539d76a0ce9741d2c6cf57e', 'cover', 'Nouveau test', './public/images/2233de820d85be81a539d76a0ce9741d2c6cf57e_AdobeStock_206294095_Preview.jpeg'),
(103, 'a683e2713bd6675e312e7017b2cfa79051f8cc51', 'cover', 'Nouveau test', './public/images/a683e2713bd6675e312e7017b2cfa79051f8cc51_AdobeStock_206294095_Preview.jpeg'),
(104, 'dcfe5f3ed169bf046206b6b14ab74857780b0bb0', 'cover', 'Nouveau test', './public/images/dcfe5f3ed169bf046206b6b14ab74857780b0bb0_AdobeStock_206294095_Preview.jpeg'),
(105, '4056e541cd466307f4afc0254062ebbda6716e9a', 'cover', 'Nouveau test', './public/images/4056e541cd466307f4afc0254062ebbda6716e9a_AdobeStock_206294095_Preview.jpeg'),
(106, '75dbf0fc584785d8eafcd7d4661a3dc75e504a12', 'cover', 'Nouveau test', './public/images/75dbf0fc584785d8eafcd7d4661a3dc75e504a12_AdobeStock_206294095_Preview.jpeg'),
(107, '8d407c9b257a691528c0836bed4cd39d3aeba317', 'cover', 'Nouveau test', './public/images/8d407c9b257a691528c0836bed4cd39d3aeba317_AdobeStock_206294095_Preview.jpeg'),
(108, '8d5e7b65767ac99f5ed7e274435fd7ed8b260c48', 'cover', 'Nouveau test', './public/images/8d5e7b65767ac99f5ed7e274435fd7ed8b260c48_AdobeStock_206294095_Preview.jpeg'),
(109, 'e6c841e1dd82a152387608caff24a11f42768a56', 'cover', 'Nouveau test', './public/images/e6c841e1dd82a152387608caff24a11f42768a56_AdobeStock_206294095_Preview.jpeg'),
(110, 'f911cb398f5e9e8b6f19b262b72ea37c09bfd242', 'cover', 'Nouveau test', './public/images/f911cb398f5e9e8b6f19b262b72ea37c09bfd242_AdobeStock_206294095_Preview.jpeg'),
(111, '0be56291ebfb509523ab2aba41670f99d04bc2ec', 'cover', 'Nouveau test', './public/images/0be56291ebfb509523ab2aba41670f99d04bc2ec_AdobeStock_206294095_Preview.jpeg'),
(112, 'c0efcde812268beb7f08b8fcca8f102829cb8a8e', 'cover', 'Nouveau test', './public/images/c0efcde812268beb7f08b8fcca8f102829cb8a8e_AdobeStock_206294095_Preview.jpeg'),
(113, 'b63a148712828db31b35464dfbe0132234764898', 'cover', 'Nouveau test', './public/images/b63a148712828db31b35464dfbe0132234764898_AdobeStock_206294095_Preview.jpeg'),
(114, '6576bbf0b2efb01586a204d1b52d69571b53b74b', 'cover', 'Nouveau test', './public/images/6576bbf0b2efb01586a204d1b52d69571b53b74b_AdobeStock_206294095_Preview.jpeg'),
(115, '18c145367001f1141febc99e0f6e2e83cc9c7853', 'cover', 'Hello', './public/images/18c145367001f1141febc99e0f6e2e83cc9c7853_AdobeStock_206294095_Preview.jpeg'),
(116, 'bce658db61dc4b43ac8d2f83b43986c1909975dc', 'cover', 'Hello', './public/images/bce658db61dc4b43ac8d2f83b43986c1909975dc_AdobeStock_206294095_Preview.jpeg'),
(117, 'fdd6bb213e88a6fc04befc727ed6b92231e579f1', 'cover', 'Test du soir', './public/images/fdd6bb213e88a6fc04befc727ed6b92231e579f1_AdobeStock_206294095_Preview.jpeg'),
(118, '5a89d611d77c39a874d22faad6740863e2ae3965', 'cover', 'Test du soir', './public/images/5a89d611d77c39a874d22faad6740863e2ae3965_AdobeStock_206294095_Preview.jpeg'),
(119, '2f10554eec4e20db63b582324ff73f1eef01c148', 'cover', 'Test du soir', './public/images/2f10554eec4e20db63b582324ff73f1eef01c148_AdobeStock_206294095_Preview.jpeg'),
(120, 'ec7f99514c700bb5c4480970b9fd6471a8df5d5e', 'cover', 'Test du soir', './public/images/ec7f99514c700bb5c4480970b9fd6471a8df5d5e_AdobeStock_206294095_Preview.jpeg'),
(121, '9a295a7926f9fb12bfd33addc361a7b5b3e0e604', 'cover', 'Test du soir', './public/images/9a295a7926f9fb12bfd33addc361a7b5b3e0e604_AdobeStock_206294095_Preview.jpeg'),
(122, '6c4cada05a537cf674faab81cb1b246de9e81aa9', 'cover', 'Test du soir', './public/images/6c4cada05a537cf674faab81cb1b246de9e81aa9_AdobeStock_206294095_Preview.jpeg'),
(123, 'e752d45b4f7abff5b1fee2b2dae096e358767694', 'cover', 'Test du soir', './public/images/e752d45b4f7abff5b1fee2b2dae096e358767694_AdobeStock_206294095_Preview.jpeg'),
(124, '372469a2744ef222c70b57ae00c3088b4bce0c7d', 'cover', 'Test du soir', './public/images/372469a2744ef222c70b57ae00c3088b4bce0c7d_AdobeStock_206294095_Preview.jpeg'),
(125, '7b3c15db288b984f246934a2f32611bd7eb4a206', 'cover', 'Test du soir n°2', './public/images/7b3c15db288b984f246934a2f32611bd7eb4a206_AdobeStock_206294095_Preview.jpeg'),
(126, '1479e5d1b4a228b4e39fa71b07700bf6b9dac27f', 'cover', 'Test du soir n°2', './public/images/1479e5d1b4a228b4e39fa71b07700bf6b9dac27f_AdobeStock_206294095_Preview.jpeg'),
(127, '81b9aab5510f80f7fab8f714ed27ca3d05104987', 'cover', 'Test du soir n°2', './public/images/81b9aab5510f80f7fab8f714ed27ca3d05104987_AdobeStock_206294095_Preview.jpeg'),
(128, 'a82f9cbed538cddb3b50b67599df1296bdc207aa', 'cover', 'Test du soir n°3', './public/images/a82f9cbed538cddb3b50b67599df1296bdc207aa_AdobeStock_206294095_Preview.jpeg'),
(129, '523b5dddfc0088059dd17e18046539627414e26c', 'cover', 'Test du soir n°4', './public/images/523b5dddfc0088059dd17e18046539627414e26c_AdobeStock_206294095_Preview.jpeg'),
(130, '1051d81578c7b1424c858ed451028b85b7b66958', 'cover', 'Test du soir n°5', './public/images/1051d81578c7b1424c858ed451028b85b7b66958_AdobeStock_206294095_Preview.jpeg'),
(131, 'febac80de27628b8ecc1667311e35cd878c38fca', 'cover', 'Test du soir n°5', './public/images/febac80de27628b8ecc1667311e35cd878c38fca_AdobeStock_206294095_Preview.jpeg'),
(132, 'ab30ad382c4668b3cb1fada9a37bcf49fa4cc32b', 'cover', 'Test du soir n°5', './public/images/ab30ad382c4668b3cb1fada9a37bcf49fa4cc32b_AdobeStock_206294095_Preview.jpeg'),
(133, 'e9e5dc1141473117461b0ffe1b8d0cfabc7383cd', 'cover', 'Test du soir n°5', './public/images/e9e5dc1141473117461b0ffe1b8d0cfabc7383cd_AdobeStock_206294095_Preview.jpeg'),
(134, '354afeef8ab170bf5c278fb716486f9d8104e3c8', 'cover', 'Test du soir n°5', './public/images/354afeef8ab170bf5c278fb716486f9d8104e3c8_AdobeStock_206294095_Preview.jpeg'),
(135, 'abc90a384b8f68642e6ed486f7859539225e70f1', 'cover', 'Test du soir n°5', './public/images/abc90a384b8f68642e6ed486f7859539225e70f1_AdobeStock_206294095_Preview.jpeg'),
(136, '8d9946dc23ef90e3ee3032df2514ed0db269f6cf', 'cover', 'Test du soir n°5', './public/images/8d9946dc23ef90e3ee3032df2514ed0db269f6cf_AdobeStock_206294095_Preview.jpeg'),
(137, '369239e4157a470a53d6f1df20bdaa9d16af60c0', 'cover', 'Test du soir n°5', './public/images/369239e4157a470a53d6f1df20bdaa9d16af60c0_AdobeStock_206294095_Preview.jpeg'),
(138, '44ea195569c758487f12b6ad412385243a0a6d1d', 'cover', 'Test du soir n°5', './public/images/44ea195569c758487f12b6ad412385243a0a6d1d_AdobeStock_206294095_Preview.jpeg'),
(139, 'bb094746f7d4e3bf94927c059a3b1aaf30612f5e', 'cover', 'Test du soir n°5', './public/images/bb094746f7d4e3bf94927c059a3b1aaf30612f5e_AdobeStock_206294095_Preview.jpeg'),
(140, '3ef1d2ff85a3cdc7eab207932c87ac0f9fed521c', 'cover', 'Test du soir n°5', './public/images/3ef1d2ff85a3cdc7eab207932c87ac0f9fed521c_AdobeStock_206294095_Preview.jpeg'),
(141, '8e25526cb4f5da7a0d68a01fe320e7679ddde52b', 'cover', 'Test du soir n°5', './public/images/8e25526cb4f5da7a0d68a01fe320e7679ddde52b_AdobeStock_206294095_Preview.jpeg'),
(142, 'd9e8be4e7e68c96f601bc614762f88d3b5e617c9', 'cover', 'Test du soir n°5', './public/images/d9e8be4e7e68c96f601bc614762f88d3b5e617c9_AdobeStock_206294095_Preview.jpeg'),
(143, '6afb6779d67ede29cb107396a6e97c64e22025bc', 'cover', 'Samedi', './public/images/6afb6779d67ede29cb107396a6e97c64e22025bc_AdobeStock_206294095_Preview.jpeg'),
(144, '00c4709739bed580ab8b5edcd7fc367a6b12803b', 'cover', 'Samedi', './public/images/00c4709739bed580ab8b5edcd7fc367a6b12803b_AdobeStock_206294095_Preview.jpeg'),
(145, '6972e915ab942cfb829ff42e0c2df01231a231fc', 'cover', 'Samedi', './public/images/6972e915ab942cfb829ff42e0c2df01231a231fc_AdobeStock_206294095_Preview.jpeg'),
(146, '3f51932965b217b08a1c3175bb171b9870a10fd7', 'cover', 'Samedi', './public/images/3f51932965b217b08a1c3175bb171b9870a10fd7_AdobeStock_206294095_Preview.jpeg'),
(147, 'b6ea70ddc39aa9e6446dd8677a4a39179c4ebd61', 'cover', 'Samedi', './public/images/b6ea70ddc39aa9e6446dd8677a4a39179c4ebd61_AdobeStock_206294095_Preview.jpeg'),
(148, 'c0c8f17e5fbade2e90f6aad10491bf9693521322', 'cover', 'Samedi', './public/images/c0c8f17e5fbade2e90f6aad10491bf9693521322_AdobeStock_206294095_Preview.jpeg'),
(149, '5c2b013082abac8a993091f87e463f4bebebaba2', 'cover', 'Samedi', './public/images/5c2b013082abac8a993091f87e463f4bebebaba2_AdobeStock_206294095_Preview.jpeg'),
(150, 'd986bb329030fccfa4c6810d1a6bc917fcc96800', 'cover', 'Samedi', './public/images/d986bb329030fccfa4c6810d1a6bc917fcc96800_AdobeStock_206294095_Preview.jpeg'),
(151, '21b94fde1953c9043075429427b4724cf38e3090', 'cover', 'Samedi', './public/images/21b94fde1953c9043075429427b4724cf38e3090_AdobeStock_206294095_Preview.jpeg'),
(152, '89d100001c79ffab9cda17f2917bff548ecdfd81', 'cover', 'Samedi', './public/images/89d100001c79ffab9cda17f2917bff548ecdfd81_AdobeStock_206294095_Preview.jpeg'),
(153, 'e432fb8a76c24d055b6d312007de6f3cc8862a11', 'cover', 'Samedi', './public/images/e432fb8a76c24d055b6d312007de6f3cc8862a11_AdobeStock_206294095_Preview.jpeg'),
(154, 'f2b22296039f6d161954a75023700ffa11bcae67', 'cover', 'Samedi', './public/images/f2b22296039f6d161954a75023700ffa11bcae67_AdobeStock_206294095_Preview.jpeg'),
(155, 'a37e81b9c290d4d1a9b1a4b2e589bf4afa41ab5a', 'cover', 'Samedi', './public/images/a37e81b9c290d4d1a9b1a4b2e589bf4afa41ab5a_AdobeStock_206294095_Preview.jpeg'),
(156, '50845b33301507e172f6c4256d6b74273155682b', 'cover', 'Samedi', './public/images/50845b33301507e172f6c4256d6b74273155682b_AdobeStock_206294095_Preview.jpeg'),
(157, '2419014e1b3fa433dc856d3ea43dc643ee56ec1c', 'cover', 'Samedi', './public/images/2419014e1b3fa433dc856d3ea43dc643ee56ec1c_AdobeStock_206294095_Preview.jpeg'),
(159, '40aa3c29c33a040e4cf0ab9222957769e0587c9c', 'cover', 'Dimanche', './public/images/40aa3c29c33a040e4cf0ab9222957769e0587c9c_AdobeStock_206294095_Preview.jpeg'),
(161, 'e6194b5cd4e050ef7a9e56a9a39ad22e3219e408', 'cover', 'Lundi', './public/images/e6194b5cd4e050ef7a9e56a9a39ad22e3219e408_AdobeStock_206294095_Preview.jpeg'),
(162, 'cb3adcd021708b03c17d9dcbc87052a2aef3dfd4', 'cover', 'Lundi', './public/images/cb3adcd021708b03c17d9dcbc87052a2aef3dfd4_AdobeStock_206294095_Preview.jpeg'),
(163, 'bcbd22d4f4bf37174e1aad85d2f5c85dbf6bb7d8', 'cover', 'Lundi', './public/images/bcbd22d4f4bf37174e1aad85d2f5c85dbf6bb7d8_AdobeStock_206294095_Preview.jpeg'),
(164, '57ffb9b793a03778eb51873f3fedc44b0bd0cb81', 'cover', 'Lundi', './public/images/57ffb9b793a03778eb51873f3fedc44b0bd0cb81_AdobeStock_206294095_Preview.jpeg'),
(165, '55ffb940a3d85dda4bd854c64776967ecdb95ca8', 'cover', 'Lundi', './public/images/55ffb940a3d85dda4bd854c64776967ecdb95ca8_AdobeStock_206294095_Preview.jpeg'),
(166, '2758411dc6ca8bdf5a62d4f9350ab9fe6eb706c8', 'cover', 'Mars', './public/images/2758411dc6ca8bdf5a62d4f9350ab9fe6eb706c8_AdobeStock_206294095_Preview.jpeg'),
(167, '1_Avril_AdobeStock_206294095_Preview.jpeg', 'cover', 'Avril', './public/images/1_Avril_AdobeStock_206294095_Preview.jpeg'),
(168, '1_Avril_AdobeStock_206294095_Preview.jpeg', 'cover', 'Avril', './public/images/1_Avril_AdobeStock_206294095_Preview.jpeg'),
(169, '1_Juin_AdobeStock_206294095_Preview.jpeg', 'cover', 'Juin', './public/images/1_Juin_AdobeStock_206294095_Preview.jpeg'),
(170, '1_Août_AdobeStock_206294095_Preview.jpeg', 'cover', 'Août', './public/images/1_Août_AdobeStock_206294095_Preview.jpeg'),
(171, '1_Août_AdobeStock_206294095_Preview.jpeg', 'cover', 'Août', './public/images/1_Août_AdobeStock_206294095_Preview.jpeg'),
(172, '1_Août_AdobeStock_206294095_Preview.jpeg', 'cover', 'Août', './public/images/1_Août_AdobeStock_206294095_Preview.jpeg'),
(173, '2909aa8173816a3d6b68dfbb937e508610c495da', 'cover', 'Nouveau test', './public/images/2909aa8173816a3d6b68dfbb937e508610c495da'),
(174, 'a02aa34f2946482e4a393c85548c11805d4d6332', 'cover', 'Nouveau test', './public/images/1_a02aa34f2946482e4a393c85548c11805d4d6332_AdobeStock_206294095_Preview copie.jpeg'),
(175, 'a1132f5744435095377b219d643c671357851bb0', 'cover', 'Nouveau test', './public/images/1_a1132f5744435095377b219d643c671357851bb0_AdobeStock_206294095_Preview copie.jpeg'),
(176, '2750e8c130150891b75d22f1e6197042fdd73ba3', 'cover', 'Nouveau test', './public/images/1_2750e8c130150891b75d22f1e6197042fdd73ba3_AdobeStock_206294095_Preview copie.jpeg'),
(177, 'bd2d5758ba8b4dd24fc63c84add3b71e17896c11', 'cover', 'Bonjour', './public/images/1_bd2d5758ba8b4dd24fc63c84add3b71e17896c11_AdobeStock_206294095_Preview copie.jpeg'),
(178, 'c11c0b5a2a8f0565d958b39d5214110843461d2a', 'cover', 'Hola', './public/images/1_c11c0b5a2a8f0565d958b39d5214110843461d2a_numero1.jpeg'),
(179, '2d35e58c5248240729258e3a98711bb3d1223a8d', 'cover', 'Hola', './public/images/1_2d35e58c5248240729258e3a98711bb3d1223a8d_numero1.jpeg'),
(180, '1018de05719a0adba1ff902e33583b7fb4af94bf', 'cover', 'Série du samedi', './public/images/1_1018de05719a0adba1ff902e33583b7fb4af94bf_numero1.jpeg'),
(181, '867f6fe92f6027b96204a0ff4cdac458ce5a4249', 'cover', 'Nouveau test', './public/images/1_867f6fe92f6027b96204a0ff4cdac458ce5a4249_numero1.jpeg'),
(182, '7d6a3197e1b8a2aa1f9971fd7015ebdb562ade3c', 'cover', 'Nouveau test', './public/images/1_7d6a3197e1b8a2aa1f9971fd7015ebdb562ade3c_numero2.png'),
(184, '5d89ce7bb5aaca3bbdd0726693cf1e8de8eba240', 'cover', 'Nouveau test encore', './public/images/1_5d89ce7bb5aaca3bbdd0726693cf1e8de8eba240_numero2.png'),
(186, 'dc837e6e046140076368cd0cdc60ebb442eb7d74', 'cover', 'new', './public/images/1_dc837e6e046140076368cd0cdc60ebb442eb7d74_numero2.png'),
(188, '990c4d1f51c8e31b523094ec6a255418ee24500c', 'cover', 'new', './public/images/1_990c4d1f51c8e31b523094ec6a255418ee24500c_numero2.png'),
(190, '87963544716b71500a09dca555f535fb93f48407', 'cover', 'again', './public/images/1_87963544716b71500a09dca555f535fb93f48407_numero2.png'),
(192, '54705c01ac2e18cbb06660f67562e9f911b7ee58', 'cover', 'Test du matin', './public/images/1_54705c01ac2e18cbb06660f67562e9f911b7ee58_numero1.jpeg'),
(194, 'fdf1be9c26ad66d78fa20a610cb2a2ed75cf4a4b', 'cover', 'Test du matin', './public/images/1_fdf1be9c26ad66d78fa20a610cb2a2ed75cf4a4b_numero1.jpeg'),
(196, 'b76ff3af5be72828f6dce4c47bf524dc38286542', 'cover', 'Bonjour', './public/images/1_b76ff3af5be72828f6dce4c47bf524dc38286542_numero2.png'),
(198, '13ea6d141de52e9c1aae27a9fbe12770b39d1c06', 'cover', 'Nouveau test', './public/images/1_13ea6d141de52e9c1aae27a9fbe12770b39d1c06_numero2.png'),
(203, '8243a7e505f614ddf56f01275e4b1b8e2cd052c1', 'cover', 'Nouveau test du soir', './public/images/1_8243a7e505f614ddf56f01275e4b1b8e2cd052c1_numero1.jpeg'),
(206, 'e14960191e87e73d96bb6a4380830e5891388a97', 'cover', 'Test', './public/images/1_e14960191e87e73d96bb6a4380830e5891388a97_numero1.jpeg'),
(207, '330ffe711e335c58ccd4e93315421e5c8cd4ae51', 'cover', 'Bonjour', './public/images/1_330ffe711e335c58ccd4e93315421e5c8cd4ae51_numero1.jpeg'),
(208, '4015e70c23bb933be754392d3875b14486f6c976', 'cover', 'Ceci est une nouvelle série', './public/images/1_4015e70c23bb933be754392d3875b14486f6c976_numero1.jpeg'),
(209, '56236a0a0b9afa0e05b9f86b9b626eb188af2f70', 'cover', 'Bnojour', './public/images/1_56236a0a0b9afa0e05b9f86b9b626eb188af2f70_numero1.jpeg'),
(210, '3655f8a83510cdb09684ce1e26b647f6ca71ebbc', 'cover', 'Bonjour', './public/images/1_3655f8a83510cdb09684ce1e26b647f6ca71ebbc_numero1.jpeg'),
(211, '81568fb94f71963db12dc5cc35debbb25eddfb70', 'cover', 'Hello', './public/images/1_81568fb94f71963db12dc5cc35debbb25eddfb70_numero1.jpeg'),
(212, '2eba95a1f457ee9a9bfa63def861d583613ccf99', 'cover', 'Test', './public/images/1_2eba95a1f457ee9a9bfa63def861d583613ccf99_numero1.jpeg'),
(213, '5700db725b10f4f831325b3e589aa2b9ed725723', 'cover', 'Test', './public/images/1_5700db725b10f4f831325b3e589aa2b9ed725723_numero1.jpeg'),
(214, '6386c22312476d736acdf1ce3519fb5c462d3a23', 'cover', 'Test', './public/images/1_6386c22312476d736acdf1ce3519fb5c462d3a23_numero1.jpeg'),
(215, '1a2b78fd040f616a7c163fdff0ec996db954ad60', 'cover', 'hé', './public/images/1_1a2b78fd040f616a7c163fdff0ec996db954ad60_numero1.jpeg'),
(216, '51f637f24cc398025b863677ba6bc4489cc8644a', 'cover', 'hé', './public/images/1_51f637f24cc398025b863677ba6bc4489cc8644a_numero1.jpeg'),
(217, 'eeeac1918f51aa7f3c11ad0d6aefdf782e714f33', 'cover', 'You', './public/images/1_eeeac1918f51aa7f3c11ad0d6aefdf782e714f33_numero1.jpeg'),
(218, '4268fa34002240fe37c7509223f6fc6e8bab270e', 'cover', 'You', './public/images/1_4268fa34002240fe37c7509223f6fc6e8bab270e_numero1.jpeg'),
(219, 'a5a28afcae7a36e6b4d5351d9197babe776a04dd', 'cover', 'You', './public/images/1_a5a28afcae7a36e6b4d5351d9197babe776a04dd_numero1.jpeg'),
(220, '59e8f682bd3efc3ddd42a24e29e035e1c21bfe56', 'cover', 'essai', './public/images/1_59e8f682bd3efc3ddd42a24e29e035e1c21bfe56_numero1.jpeg'),
(221, '9f876e9fd353b88b37d6b83f205fd611906ea2d6', 'cover', 'New', './public/images/1_9f876e9fd353b88b37d6b83f205fd611906ea2d6_numero1.jpeg'),
(222, '773d193fdd60b871e6c8c45995cf6163ac73083d', 'cover', 'New series', './public/images/1_773d193fdd60b871e6c8c45995cf6163ac73083d_numero1.jpeg'),
(223, '3cb29bc4f060c8100df6561b1f60c22b85c9beca', 'cover', 'New series', './public/images/1_3cb29bc4f060c8100df6561b1f60c22b85c9beca_numero1.jpeg'),
(224, '273b4771b4691b2a8876e5a4b1422b2500d00256', 'cover', 'Again new seriess', './public/images/1_273b4771b4691b2a8876e5a4b1422b2500d00256_numero1.jpeg'),
(225, 'b134981cbcb0625f694458bd79958d309a49fde3', 'cover', 'yo', './public/images/1_b134981cbcb0625f694458bd79958d309a49fde3_numero1.jpeg'),
(226, 'aa2bf3154bef4f8d5dbd5f3c7edd8fe7e96d8239', 'cover', 'Une nouvelle série', './public/images/1_aa2bf3154bef4f8d5dbd5f3c7edd8fe7e96d8239_numero1.jpeg'),
(227, 'cd28053865247f3cf269f281bbf4d0c70e98b855', 'cover', 'Nouvelle série du mercredi', './public/images/1_cd28053865247f3cf269f281bbf4d0c70e98b855_numero1.jpeg'),
(228, 'cc5d42f15e719abbba4b0f3ba2a02f7cf4e17bee', 'cover', 'La nouvelle série', './public/images/1_cc5d42f15e719abbba4b0f3ba2a02f7cf4e17bee_numero1.jpeg'),
(229, 'fbcd01e66cee01c05f98edfa3c365dc6325edf1d', 'cover', 'La nouvelle série 1', './public/images/1_fbcd01e66cee01c05f98edfa3c365dc6325edf1d_numero1.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `id_logo` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logos`
--

INSERT INTO `logos` (`id`, `id_logo`, `name`) VALUES
(1, 9, 'Domaine Public');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` enum('admin','publisher','user') NOT NULL DEFAULT 'user',
  `date_subscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext,
  `coins_number` int(11) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `address` longtext,
  `zipcode` varchar(20) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `id_avatar` int(11) DEFAULT NULL,
  `id_logo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `email`, `password`, `type`, `date_subscription`, `description`, `coins_number`, `gender`, `surname`, `name`, `company_name`, `address`, `zipcode`, `city`, `country`, `birthdate`, `id_avatar`, `id_logo`) VALUES
(1, 'annefleur', 'af.marchat@gmail.com', 'motdepasse1', 'user', '2020-07-20 19:59:06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia accumsan mauris, a eleifend mauris maximus non. Sed eget sapien vitae turpis auctor rhoncus. Suspendisse sit amet dui ante. Nullam finibus efficitur semper. In accumsan eros in mi pulvinar sodales. Nam non tempus dui, vel luctus nulla. Mauris in consequat quam. Aenean ornare dolor sed leo fringilla lobortis.', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL),
(2, 'fleuranne', 'marchat.af@gmail.com', 'motdepasse2', 'publisher', '2020-07-20 20:33:47', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia accumsan mauris, a eleifend mauris maximus non. Sed eget sapien vitae turpis auctor rhoncus. Suspendisse sit amet dui ante. Nullam finibus efficitur semper. In accumsan eros in mi pulvinar sodales. Nam non tempus dui, vel luctus nulla. Mauris in consequat quam. Aenean ornare dolor sed leo fringilla lobortis.', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'admin_annefleur', 'af.marchat@laposte.net', 'motdepasse3', 'admin', '2020-07-26 13:44:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `members_has_bills`
--

CREATE TABLE `members_has_bills` (
  `id_member` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members_has_bills`
--

INSERT INTO `members_has_bills` (`id_member`, `id_bill`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `packs`
--

CREATE TABLE `packs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `coins_number` int(11) NOT NULL,
  `promotion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `packs`
--

INSERT INTO `packs` (`id`, `name`, `price`, `coins_number`, `promotion`) VALUES
(1, 'Pack Starter', 9.99, 30, NULL),
(2, 'Pack Premium', 19.99, 70, NULL),
(3, 'Pack Privilege', 29.99, 110, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id_member` int(11) NOT NULL,
  `id_episode` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id_member`, `id_episode`, `date`) VALUES
(1, 1, '2020-08-04 20:09:54'),
(1, 6, '2020-07-20 21:44:08'),
(1, 7, '2020-07-20 21:44:18'),
(2, 7, '2020-08-04 16:44:17');

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_member` int(11) NOT NULL,
  `pricing_status` enum('free','paying') NOT NULL,
  `publishing_status` enum('published','inprogress','deleted') NOT NULL DEFAULT 'inprogress',
  `authors_right` enum('public','CC','CC1','CC2','CC3','CC4','CC5','reserved') NOT NULL DEFAULT 'public',
  `id_cover` int(11) NOT NULL DEFAULT '1',
  `publisher_author` varchar(200) DEFAULT NULL,
  `publisher_author_description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `title`, `summary`, `date`, `id_member`, `pricing_status`, `publishing_status`, `authors_right`, `id_cover`, `publisher_author`, `publisher_author_description`) VALUES
(1, 'Geek', 'Sed in diam odio. Phasellus tempus magna commodo suscipit egestas. Morbi quis lacus nec lacus sodales iaculis. Quisque hendrerit sed nulla ut ornare. Sed ullamcorper mi varius leo ultricies tempor. Aliquam at odio tempus, semper felis eu, accumsan risus. Donec eget ante enim. Phasellus ex est, tincidunt ut ullamcorper sit amet, semper quis neque. Aliquam vestibulum arcu at ligula dictum ullamcorper. Sed sit amet eleifend erat, a bibendum dui. Nulla euismod porttitor nulla, et bibendum tortor rutrum tincidunt. Vivamus pulvinar vitae quam sit amet pulvinar.', '2020-07-20 21:00:54', 1, 'free', 'published', 'public', 1, NULL, NULL),
(2, 'Prophetia', 'Phasellus et tortor vel dolor commodo dapibus eu vel lorem. In neque ipsum, elementum at lorem sed, tempor pellentesque lectus. Morbi imperdiet vehicula porttitor. Etiam justo risus, cursus vel quam in, scelerisque hendrerit lorem. Etiam eu dictum metus. Curabitur imperdiet accumsan sagittis. Donec mattis velit tortor, eu posuere arcu luctus eget. Nulla suscipit neque ut metus luctus, ut rhoncus odio sollicitudin. Ut ante arcu, fringilla non ultrices a, tincidunt at eros. Ut sagittis urna cursus convallis vehicula. Vivamus ac mi ornare, porttitor urna ultricies, suscipit massa. Vestibulum id tincidunt leo.', '2020-07-20 21:01:36', 1, 'free', 'published', 'CC', 2, NULL, NULL),
(3, 'Elysée', 'Duis cursus efficitur lacus in fringilla. Duis vehicula varius ultrices. Integer auctor in diam quis gravida. Mauris congue vestibulum erat, sit amet dignissim massa tristique et. Integer tempor risus mauris. Proin eu blandit elit. Donec id orci sodales, interdum nisl ac, dignissim felis. Ut volutpat sed nisl ut porttitor. Ut erat ex, tempor vitae nisi ut, posuere malesuada lectus.', '2020-07-20 21:02:14', 1, 'free', 'published', 'public', 3, NULL, NULL),
(4, 'Renaissance', 'Quisque neque tortor, convallis eu mauris nec, mattis condimentum magna. Suspendisse a massa eu justo placerat bibendum. Vestibulum dictum dignissim lectus, eget tincidunt urna gravida eget. Mauris in eros sit amet urna faucibus commodo in ac turpis. Duis porttitor interdum tellus id ultricies. Morbi orci dui, accumsan sit amet feugiat at, mollis eu lacus. Curabitur fringilla condimentum urna, sit amet dapibus elit volutpat et.', '2020-07-20 21:03:12', 1, 'free', 'published', 'CC', 4, NULL, NULL),
(5, 'New Boss', 'Mauris nec ex convallis, dictum libero a, ultricies metus. Donec risus enim, consequat sit amet turpis ac, aliquet gravida eros. Vestibulum egestas ipsum elementum, aliquet mi eu, elementum massa. Quisque at nulla sodales, dignissim dolor vel, placerat velit. Vestibulum nec metus lacinia, commodo odio id, cursus eros. Nullam mauris nibh, ultrices non mauris sit amet, fermentum laoreet lacus. Suspendisse vel urna a dui cursus sollicitudin sed id sapien. Nunc quis ante ac velit volutpat placerat eget sed erat. Praesent sodales nulla vel sapien commodo, id auctor nisl tristique.', '2020-07-20 21:03:38', 1, 'free', 'published', 'public', 5, NULL, NULL),
(6, 'L\'île au trésor', 'Suspendisse a rutrum sem. Nulla tincidunt mauris et tempus ullamcorper. Phasellus fermentum ornare aliquet. Mauris mollis non purus nec molestie. Suspendisse vel leo tempus, hendrerit ipsum dignissim, iaculis nulla. Duis et nisi dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed venenatis ante quis sem pulvinar posuere. Ut imperdiet dolor ut ante tempor gravida. Quisque lacinia nunc eget diam ultricies, vel commodo orci porta. Vestibulum vel augue ut risus finibus elementum.', '2020-07-20 21:13:31', 2, 'paying', 'published', 'public', 6, 'Robert Louis Stevenson', 'Fusce metus odio, vehicula eu ultrices eget, ultricies quis massa. Ut at felis vitae risus semper interdum et eget nunc. Curabitur blandit aliquam tortor, sed viverra felis laoreet ut. Donec nec dictum ante. In bibendum turpis at eros gravida pellentesque. Vestibulum eu lacus scelerisque, interdum nunc et, hendrerit ex.'),
(7, 'Le chien des Baskerville', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui. Duis gravida metus sed ante tempor lacinia. Phasellus vitae nisl vitae augue interdum fringilla. Praesent mi risus, tincidunt a libero non, ultrices lobortis ipsum. Curabitur congue ex in odio porta, sit amet consectetur neque semper. Morbi rhoncus lacus sed dui pulvinar, non porta sem consectetur.', '2020-07-20 21:20:02', 2, 'paying', 'published', 'public', 7, 'Sir Arthur Conan Doyle', 'Fusce metus odio, vehicula eu ultrices eget, ultricies quis massa. Ut at felis vitae risus semper interdum et eget nunc. Curabitur blandit aliquam tortor, sed viverra felis laoreet ut. Donec nec dictum ante. In bibendum turpis at eros gravida pellentesque. Vestibulum eu lacus scelerisque, interdum nunc et, hendrerit ex. Donec nunc odio, sollicitudin sit amet molestie sit amet, lobortis vel urna. Sed ornare ante eget ex efficitur, in consequat odio ultricies.'),
(8, 'Orgueil et Préjugés', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui. Duis gravida metus sed ante tempor lacinia. Phasellus vitae nisl vitae augue interdum fringilla. Praesent mi risus, tincidunt a libero non, ultrices lobortis ipsum. Curabitur congue ex in odio porta, sit amet consectetur neque semper. Morbi rhoncus lacus sed dui pulvinar, non porta sem consectetur.', '2020-07-20 21:21:01', 2, 'paying', 'published', 'public', 8, 'Jane Austen', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(9, 'Dracula', 'Praesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', '2020-07-20 21:21:53', 2, 'paying', 'published', 'public', 9, 'Bram Stoker', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(10, 'Le fantôme de l\'opéra', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.', '2020-07-20 21:22:52', 2, 'paying', 'published', 'public', 10, 'Gaston Leroux', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui.'),
(11, 'Try1', 'Hola', '2021-03-21 14:35:41', 1, 'paying', 'inprogress', 'public', 13, '', ''),
(12, 'TestNew', 'Hello', '2021-03-22 20:27:21', 1, 'paying', 'inprogress', 'public', 63, NULL, NULL),
(23, 'Hello', 'Hello', '2021-03-24 17:05:23', 1, 'paying', 'inprogress', 'public', 86, '', ''),
(24, 'Hello', 'Hello', '2021-03-24 17:05:51', 1, 'paying', 'inprogress', 'public', 87, '', ''),
(26, 'Nouveau test', 'Hola', '2021-03-24 17:08:43', 1, 'paying', 'inprogress', 'public', 89, '', ''),
(27, 'Nouveau test', 'Hola', '2021-03-24 17:27:55', 1, 'paying', 'inprogress', 'public', 91, '', ''),
(28, 'Nouveau test', 'Hola', '2021-03-24 17:28:09', 1, 'paying', 'inprogress', 'CC4', 92, '', ''),
(29, 'Nouveau test', 'Hola', '2021-03-24 17:28:38', 1, 'paying', 'inprogress', 'CC4', 93, '', ''),
(30, 'Nouveau test', 'Hola', '2021-03-24 20:33:10', 1, 'paying', 'inprogress', 'CC4', 94, '', ''),
(31, 'Nouveau test', 'Hola', '2021-03-24 20:34:44', 1, 'paying', 'inprogress', 'CC4', 95, '', ''),
(32, 'Nouveau test', 'Hola', '2021-03-24 20:38:06', 1, 'paying', 'inprogress', 'CC4', 96, '', ''),
(33, 'Nouveau test', 'Hola', '2021-03-24 20:38:45', 1, 'paying', 'inprogress', 'CC4', 97, '', ''),
(34, 'Nouveau test', 'Hola', '2021-03-24 20:39:30', 1, 'paying', 'inprogress', 'CC4', 98, '', ''),
(35, 'Nouveau test', 'Hola', '2021-03-24 20:40:45', 1, 'paying', 'inprogress', 'CC4', 99, '', ''),
(36, 'Nouveau test', 'Hola', '2021-03-24 20:42:32', 1, 'paying', 'inprogress', 'CC4', 100, '', ''),
(37, 'Nouveau test', 'Hola', '2021-03-24 20:43:22', 1, 'paying', 'inprogress', 'CC4', 101, '', ''),
(38, 'Nouveau test', 'Hola', '2021-03-24 20:44:53', 1, 'paying', 'inprogress', 'CC4', 102, '', ''),
(39, 'Nouveau test', 'Hola', '2021-03-24 20:46:53', 1, 'paying', 'inprogress', 'CC4', 103, '', ''),
(40, 'Nouveau test', 'Hola', '2021-03-24 20:48:38', 1, 'paying', 'inprogress', 'CC4', 104, '', ''),
(41, 'Hello', 'Bonjour', '2021-04-05 20:03:46', 1, 'paying', 'inprogress', 'reserved', 105, '', ''),
(42, 'Hello', 'Bonjour', '2021-04-05 20:13:13', 1, 'paying', 'inprogress', 'reserved', 106, '', ''),
(43, 'Test du soir', 'Hello', '2021-04-05 21:00:35', 1, 'paying', 'inprogress', 'reserved', 107, '', ''),
(44, 'Test du soir', 'Hello', '2021-04-05 21:02:09', 1, 'paying', 'inprogress', 'reserved', 108, '', ''),
(45, 'Test du soir', 'Hello', '2021-04-05 21:03:23', 1, 'paying', 'inprogress', 'reserved', 109, '', ''),
(46, 'Test du soir', 'Hello', '2021-04-05 21:05:08', 1, 'paying', 'inprogress', 'reserved', 110, '', ''),
(47, 'Test du soir', 'Hello', '2021-04-05 21:05:20', 1, 'paying', 'inprogress', 'reserved', 111, '', ''),
(48, 'Test du soir', 'Hello', '2021-04-05 21:05:42', 1, 'paying', 'inprogress', 'reserved', 112, '', ''),
(49, 'Test du soir', 'Hello', '2021-04-05 21:08:53', 1, 'paying', 'inprogress', 'reserved', 113, '', ''),
(50, 'Test du soir', 'Hello', '2021-04-05 21:10:22', 1, 'paying', 'inprogress', 'reserved', 114, '', ''),
(51, 'Test du soir n°2', 'Hello', '2021-04-05 21:13:29', 1, 'paying', 'inprogress', 'reserved', 115, '', ''),
(52, 'Test du soir n°2', 'Hello', '2021-04-05 21:15:25', 1, 'paying', 'inprogress', 'reserved', 116, '', ''),
(53, 'Test du soir n°2', 'Hello', '2021-04-05 21:16:28', 1, 'paying', 'inprogress', 'reserved', 117, '', ''),
(54, 'Test du soir n°3', 'Hello', '2021-04-05 21:17:24', 1, 'paying', 'inprogress', 'reserved', 118, '', ''),
(55, 'Test du soir n°4', 'Hello', '2021-04-05 21:19:26', 1, 'paying', 'inprogress', 'CC3', 119, '', ''),
(56, 'Test du soir n°5', 'Hello', '2021-04-05 21:21:21', 1, 'paying', 'inprogress', 'CC3', 120, '', ''),
(57, 'Test du soir n°5', 'Hello', '2021-04-05 21:22:11', 1, 'paying', 'inprogress', 'CC3', 121, '', ''),
(58, 'Test du soir n°5', 'Hello', '2021-04-05 21:22:58', 1, 'paying', 'inprogress', 'CC3', 122, '', ''),
(59, 'Test du soir n°5', 'Hello', '2021-04-05 21:23:25', 1, 'paying', 'inprogress', 'CC3', 123, '', ''),
(60, 'Test du soir n°5', 'Hello', '2021-04-05 21:23:41', 1, 'paying', 'inprogress', 'CC3', 124, '', ''),
(61, 'Test du soir n°5', 'Hello', '2021-04-05 21:24:05', 1, 'paying', 'inprogress', 'CC3', 125, '', ''),
(62, 'Test du soir n°5', 'Hello', '2021-04-05 21:24:46', 1, 'paying', 'inprogress', 'CC3', 126, '', ''),
(63, 'Test du soir n°5', 'Hello', '2021-04-05 21:25:10', 1, 'paying', 'inprogress', 'CC3', 127, '', ''),
(64, 'Test du soir n°5', 'Hello', '2021-04-05 21:25:45', 1, 'paying', 'inprogress', 'CC3', 128, '', ''),
(65, 'Test du soir n°5', 'Hello', '2021-04-05 21:26:44', 1, 'paying', 'inprogress', 'CC3', 129, '', ''),
(66, 'Test du soir n°5', 'Hello', '2021-04-05 21:29:20', 1, 'paying', 'inprogress', 'CC3', 130, '', ''),
(67, 'Test du soir n°5', 'Hello', '2021-04-05 21:30:01', 1, 'paying', 'inprogress', 'CC3', 131, '', ''),
(68, 'Test du soir n°5', 'Hello', '2021-04-05 21:30:50', 1, 'paying', 'inprogress', 'CC3', 132, '', ''),
(69, 'Samedi', 'bonjour', '2021-04-10 11:15:52', 1, 'paying', 'inprogress', 'CC4', 133, '', ''),
(70, 'Samedi', 'bonjour', '2021-04-10 11:18:46', 1, 'paying', 'inprogress', 'CC4', 134, '', ''),
(71, 'Samedi', 'bonjour', '2021-04-10 11:19:27', 1, 'paying', 'inprogress', 'CC4', 135, '', ''),
(72, 'Samedi', 'bonjour', '2021-04-10 11:28:34', 1, 'paying', 'inprogress', 'CC4', 136, '', ''),
(73, 'Samedi', 'bonjour', '2021-04-10 11:30:20', 1, 'paying', 'inprogress', 'CC4', 137, '', ''),
(74, 'Samedi', 'bonjour', '2021-04-10 11:32:02', 1, 'paying', 'inprogress', 'CC4', 138, '', ''),
(75, 'Samedi', 'bonjour', '2021-04-10 11:32:45', 1, 'paying', 'inprogress', 'CC4', 139, '', ''),
(76, 'Samedi', 'bonjour', '2021-04-10 11:37:20', 1, 'paying', 'inprogress', 'CC4', 140, '', ''),
(77, 'Samedi', 'bonjour', '2021-04-10 11:39:42', 1, 'paying', 'inprogress', 'CC4', 141, '', ''),
(78, 'Samedi', 'bonjour', '2021-04-10 11:40:04', 1, 'paying', 'inprogress', 'CC4', 142, '', ''),
(79, 'Samedi', 'bonjour', '2021-04-10 11:41:15', 1, 'paying', 'inprogress', 'CC4', 143, '', ''),
(80, 'Samedi', 'bonjour', '2021-04-10 11:42:53', 1, 'paying', 'inprogress', 'CC4', 144, '', ''),
(81, 'Samedi', 'bonjour', '2021-04-10 11:43:15', 1, 'paying', 'inprogress', 'CC4', 145, '', ''),
(82, 'Samedi', 'bonjour', '2021-04-10 11:43:41', 1, 'paying', 'inprogress', 'CC4', 146, '', ''),
(83, 'Samedi', 'bonjour', '2021-04-10 11:45:23', 1, 'paying', 'inprogress', 'CC4', 147, '', ''),
(85, 'Dimanche', 'Hola', '2021-04-10 11:46:28', 1, 'paying', 'inprogress', 'CC', 149, '', ''),
(87, 'Lundi', 'Hello', '2021-04-10 13:31:12', 1, 'paying', 'inprogress', 'CC4', 151, '', ''),
(88, 'Lundi', 'Hello', '2021-04-10 13:34:08', 1, 'paying', 'inprogress', 'CC4', 152, '', ''),
(89, 'Lundi', 'Hello', '2021-04-10 13:35:53', 1, 'paying', 'inprogress', 'CC4', 153, '', ''),
(90, 'Lundi', 'Hello', '2021-04-10 13:36:39', 1, 'paying', 'inprogress', 'CC4', 154, '', ''),
(91, 'Lundi', 'Hello', '2021-04-10 13:37:32', 1, 'paying', 'inprogress', 'CC4', 155, '', ''),
(92, 'Mars', 'Hola', '2021-04-10 16:46:01', 1, 'paying', 'inprogress', 'CC3', 156, '', ''),
(93, 'Avril&amp;Mai', 'Hola you', '2021-04-11 14:06:34', 1, 'paying', 'inprogress', 'CC5', 157, '', ''),
(94, 'Avril', 'Hola', '2021-04-11 14:13:49', 1, 'paying', 'inprogress', 'public', 157, '', ''),
(95, 'Juin et Juillet', 'Bonjour mois de juillet', '2021-04-11 14:17:09', 1, 'paying', 'inprogress', 'CC5', 159, '', ''),
(96, 'Août&amp;Septembre&amp;Octobre', 'Bonjour mois de septembre', '2021-04-11 14:23:30', 1, 'paying', 'inprogress', 'reserved', 160, '', ''),
(97, 'Août', 'Bonjour mois d\'août', '2021-04-11 14:23:05', 1, 'paying', 'inprogress', 'public', 160, '', ''),
(98, 'Août', 'Bonjour mois d\'août', '2021-04-11 14:26:01', 1, 'paying', 'inprogress', 'public', 160, '', ''),
(99, 'Nouveau test', 'Hola', '2021-04-13 20:48:01', 1, 'paying', 'inprogress', 'CC3', 163, '', ''),
(100, 'Nouveau test', 'Hola', '2021-04-13 20:51:40', 1, 'paying', 'inprogress', 'CC3', 164, '', ''),
(101, 'Nouveau test', 'Hola', '2021-04-13 21:00:29', 1, 'paying', 'inprogress', 'CC3', 165, '', ''),
(102, 'Nouveau test du soir et du matin', 'Hola you, comment hy', '2021-04-13 21:50:49', 1, 'paying', 'inprogress', 'CC3', 166, '', ''),
(103, 'Bonjour', 'Hola', '2021-04-14 19:35:34', 1, 'paying', 'inprogress', 'CC', 167, '', ''),
(104, 'Hola', 'Hello', '2021-04-14 19:43:55', 1, 'paying', 'inprogress', 'CC2', 168, '', ''),
(105, 'Hola', 'Hello', '2021-04-14 19:44:06', 1, 'paying', 'inprogress', 'CC2', 169, '', ''),
(106, 'Série du samedi soir', 'Super série du samedi soir', '2021-04-17 10:43:16', 1, 'paying', 'inprogress', 'CC', 170, '', ''),
(115, 'Nouveau test du soir', 'Aujourd\'hui à 11h', '2021-04-17 11:40:04', 1, 'paying', 'inprogress', 'CC2', 192, '', ''),
(116, 'Test', 'Hola', '2021-04-17 11:48:23', 1, 'paying', 'inprogress', 'public', 195, '', ''),
(117, 'Test', 'hello', '2021-04-17 11:54:25', 1, 'paying', 'inprogress', 'CC', 10, '', ''),
(118, 'Bonjour', 'Ca va', '2021-04-17 11:55:40', 1, 'paying', 'inprogress', 'reserved', 196, '', ''),
(119, 'Bonjour', 'Tu vas bien', '2021-04-17 11:55:58', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(120, 'Ceci est une nouvelle série', 'Tu vas bien', '2021-04-17 12:12:33', 1, 'paying', 'inprogress', 'reserved', 197, '', ''),
(121, 'Nouveau test', 'hello', '2021-04-17 12:37:36', 1, 'paying', 'inprogress', 'public', 10, '', ''),
(122, 'Nouveau test', 'hello', '2021-04-17 12:38:01', 1, 'paying', 'inprogress', 'public', 10, '', ''),
(123, 'Nouveau test', 'hola', '2021-04-17 12:40:40', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(124, 'Héééééééé', 'hola', '2021-04-17 12:40:51', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(125, 'Nouveau test', 'hello', '2021-04-17 12:42:01', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(126, 'Bnojour', 'hola', '2021-04-17 12:49:35', 1, 'paying', 'inprogress', 'CC3', 198, '', ''),
(127, 'Bonjour', 'hola', '2021-04-20 22:03:36', 1, 'paying', 'inprogress', 'reserved', 199, '', ''),
(128, 'Hello', 'Bonjour', '2021-04-20 22:06:16', 1, 'paying', 'inprogress', 'CC', 200, '', ''),
(129, 'Test', 'Bonjour', '2021-04-20 22:08:08', 1, 'paying', 'inprogress', 'reserved', 201, '', ''),
(130, 'Test', 'Bonjour', '2021-04-20 22:09:07', 1, 'paying', 'inprogress', 'reserved', 202, '', ''),
(131, 'Test', 'Bonjour', '2021-04-20 22:10:52', 1, 'paying', 'inprogress', 'reserved', 203, '', ''),
(132, 'hé', 'yo', '2021-04-20 22:13:39', 1, 'paying', 'inprogress', 'reserved', 204, '', ''),
(133, 'hé', 'yo', '2021-04-20 22:14:18', 1, 'paying', 'inprogress', 'reserved', 205, '', ''),
(134, 'You', 'are', '2021-04-20 22:18:43', 1, 'paying', 'inprogress', 'reserved', 206, '', ''),
(135, 'You', 'are', '2021-04-20 22:19:17', 1, 'paying', 'inprogress', 'reserved', 207, '', ''),
(136, 'You', 'are', '2021-04-20 22:22:50', 1, 'paying', 'inprogress', 'reserved', 208, '', ''),
(137, 'essai', 'nouveau', '2021-04-20 22:26:07', 1, 'paying', 'inprogress', 'reserved', 209, '', ''),
(138, 'New', 'Description', '2021-04-21 11:36:33', 1, 'paying', 'inprogress', 'reserved', 210, '', ''),
(139, 'Nouvelle série', 'Hello', '2021-04-21 13:25:38', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(140, 'New series', 'Hello', '2021-04-21 14:22:29', 1, 'paying', 'inprogress', 'CC1', 211, '', ''),
(141, 'New series', 'Hello', '2021-04-21 14:41:25', 1, 'paying', 'inprogress', 'CC1', 212, '', ''),
(142, 'Hello', 'Blabl', '2021-04-21 14:42:21', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(143, 'Again new series', 'Hello', '2021-04-21 14:48:38', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(144, 'Again new seriess', 'Hello', '2021-04-21 14:55:41', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(145, 'Again new seriess', 'Hello', '2021-04-21 14:57:39', 1, 'paying', 'inprogress', 'reserved', 213, '', ''),
(146, 'Youhouuu', 'hola', '2021-04-21 15:02:24', 1, 'paying', 'inprogress', 'reserved', 10, '', ''),
(147, 'yo', 'héhé', '2021-04-21 15:03:36', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(148, 'yo', 'héhé', '2021-04-21 15:03:47', 1, 'paying', 'inprogress', 'reserved', 214, '', ''),
(149, 'yo', 'héhé', '2021-04-21 15:03:56', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(150, 'Une nouvelle série', 'Encore', '2021-04-21 15:04:40', 1, 'paying', 'inprogress', 'CC1', 215, '', ''),
(151, 'Encore', 'et oui', '2021-04-21 15:04:57', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(152, 'Test', 'Hola', '2021-04-21 16:02:39', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(153, 'Maman', 'Hola', '2021-04-21 16:08:59', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(154, 'Nouvelle série du mercredi', 'Il était une fois', '2021-04-28 12:14:48', 1, 'paying', 'inprogress', 'CC3', 216, '', ''),
(155, 'nouvelle serie', 'blqblq', '2021-04-28 13:36:27', 1, 'paying', 'inprogress', 'CC', 1, '', ''),
(156, 'nouvequ titre', 'blqb', '2021-04-28 13:46:20', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(157, '1111', 'blabla', '2021-04-28 13:49:42', 1, 'paying', 'inprogress', 'reserved', 1, '', ''),
(158, 'La nouvelle série', 'Blabla', '2021-04-28 14:06:25', 1, 'paying', 'inprogress', 'CC1', 217, '', ''),
(159, 'La nouvelle série 1', 'Blabla', '2021-04-28 14:15:52', 1, 'paying', 'inprogress', 'CC1', 218, '', ''),
(160, 'Une nouvelle série se crée', 'Blabla', '2021-04-28 14:32:59', 1, 'paying', 'inprogress', 'CC', 1, '', ''),
(161, 'Nouvelle série en test', 'Blabla', '2021-05-02 11:40:52', 1, 'paying', 'inprogress', 'public', 1, '', ''),
(162, 'Bonjour série', 'Blabla', '2021-05-04 22:24:13', 1, 'paying', 'inprogress', 'reserved', 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `series_has_members_subscription`
--

CREATE TABLE `series_has_members_subscription` (
  `id_series` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `subscription_notifications` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `series_has_members_subscription`
--

INSERT INTO `series_has_members_subscription` (`id_series`, `id_member`, `subscription_notifications`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 3, 0),
(2, 2, 1),
(2, 3, 0),
(3, 2, 0),
(3, 3, 0),
(4, 3, 0),
(5, 3, 0),
(6, 3, 0),
(7, 3, 0),
(8, 3, 0),
(9, 3, 0),
(10, 3, 0),
(12, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `series_has_tags`
--

CREATE TABLE `series_has_tags` (
  `id_tag` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `series_has_tags`
--

INSERT INTO `series_has_tags` (`id_tag`, `id_series`) VALUES
(85, 1),
(2, 2),
(11, 2),
(16, 2),
(15, 3),
(9, 4),
(5, 5),
(6, 5),
(8, 5),
(15, 5),
(11, 6),
(15, 6),
(3, 7),
(2, 8),
(12, 8),
(4, 9),
(3, 10),
(395, 10),
(396, 10),
(15, 12),
(16, 12),
(395, 23),
(396, 23),
(85, 40),
(86, 41),
(87, 41),
(86, 42),
(87, 42),
(90, 43),
(90, 44),
(90, 45),
(90, 46),
(90, 47),
(90, 48),
(90, 49),
(90, 50),
(90, 51),
(90, 52),
(90, 53),
(90, 54),
(90, 55),
(90, 56),
(90, 57),
(90, 58),
(90, 59),
(90, 60),
(125, 60),
(90, 61),
(90, 62),
(90, 63),
(90, 64),
(90, 65),
(90, 66),
(90, 67),
(90, 68),
(126, 69),
(127, 69),
(126, 70),
(127, 70),
(126, 71),
(127, 71),
(126, 72),
(127, 72),
(126, 73),
(127, 73),
(126, 74),
(127, 74),
(126, 75),
(127, 75),
(126, 76),
(127, 76),
(126, 77),
(127, 77),
(126, 78),
(127, 78),
(126, 79),
(127, 79),
(126, 80),
(127, 80),
(126, 81),
(127, 81),
(126, 82),
(127, 82),
(126, 83),
(127, 83),
(156, 85),
(157, 85),
(162, 87),
(163, 87),
(164, 87),
(162, 88),
(163, 88),
(164, 88),
(162, 89),
(163, 89),
(164, 89),
(162, 90),
(163, 90),
(164, 90),
(162, 91),
(163, 91),
(164, 91),
(219, 92),
(220, 92),
(219, 93),
(220, 93),
(226, 95),
(227, 95),
(234, 96),
(235, 96),
(252, 99),
(253, 99),
(252, 100),
(253, 100),
(252, 101),
(253, 101),
(252, 102),
(253, 102),
(274, 102),
(281, 102),
(290, 102),
(291, 102),
(292, 102),
(307, 102),
(322, 102),
(323, 102),
(332, 102),
(335, 102),
(336, 102),
(339, 102),
(340, 102),
(341, 102),
(342, 102),
(343, 102),
(344, 102),
(13, 103),
(76, 103),
(77, 103),
(353, 103),
(353, 104),
(354, 104),
(353, 105),
(354, 105),
(126, 106),
(127, 106),
(395, 115),
(396, 115),
(395, 116),
(396, 116),
(397, 116),
(437, 116),
(395, 118),
(396, 118),
(395, 120),
(396, 120),
(395, 124),
(498, 124),
(395, 126),
(396, 126),
(397, 126),
(509, 132),
(510, 132),
(513, 134),
(513, 137),
(395, 138),
(396, 138),
(395, 139),
(396, 139),
(518, 140),
(519, 140),
(395, 143),
(396, 143),
(397, 143),
(395, 144),
(396, 144),
(395, 146),
(396, 146),
(395, 147),
(396, 147),
(76, 150),
(77, 150),
(395, 151),
(396, 151),
(395, 153),
(396, 153),
(395, 154),
(396, 154),
(395, 156),
(396, 156),
(395, 157),
(396, 157),
(395, 158),
(396, 158),
(395, 159),
(396, 159),
(395, 160),
(396, 160),
(395, 161),
(396, 161),
(397, 161),
(395, 162),
(396, 162),
(397, 162);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(235, ' août2'),
(75, ' fantaisie'),
(13, ' Horreur'),
(230, ' juillet1'),
(227, ' juin2'),
(163, ' lundi2'),
(164, ' lundi3'),
(185, ' lundi4'),
(187, ' mardi 2'),
(190, ' mardi 3'),
(125, ' recommence'),
(215, ' tag2'),
(218, ' tag3'),
(220, ' tagb'),
(223, ' tagc'),
(307, ' tata'),
(234, 'août1'),
(513, 'beautiful'),
(44, 'Bonjour'),
(340, 'bouhhhhh'),
(336, 'bye'),
(339, 'chuttttttt'),
(438, 'cinq'),
(396, 'deux'),
(156, 'dimanche1'),
(157, 'dimanche2'),
(43, 'enfance'),
(498, 'eux'),
(353, 'fantastique'),
(12, 'femme'),
(290, 'gouter'),
(510, 'ha'),
(393, 'haha'),
(335, 'hello'),
(342, 'hey'),
(509, 'hi'),
(394, 'hihi'),
(344, 'hiiii'),
(9, 'histoire'),
(343, 'hoo'),
(354, 'horreur'),
(85, 'jolitag'),
(252, 'jour'),
(226, 'juin1'),
(162, 'lundi1'),
(292, 'maman'),
(186, 'mardi 1'),
(274, 'matin'),
(87, 'mot 2'),
(86, 'mot1'),
(11, 'mystère'),
(251, 'novembre1'),
(253, 'nuit'),
(355, 'numéro1'),
(356, 'numéro2'),
(246, 'octobre1'),
(90, 'on'),
(518, 'one'),
(291, 'papa'),
(17, 'Plusieurs'),
(3, 'policier'),
(7, 'politique'),
(8, 'pouvoir'),
(437, 'quatre'),
(74, 'rêve'),
(2, 'romance'),
(126, 'samedi1'),
(127, 'samedi2'),
(360, 'samedi3'),
(236, 'septembre1'),
(281, 'soir'),
(15, 'Tag N°1'),
(16, 'Tag N°2'),
(76, 'tag1'),
(77, 'tag2'),
(78, 'tag3'),
(79, 'tag4'),
(219, 'taga'),
(18, 'tags'),
(332, 'tata'),
(6, 'technologie'),
(47, 'test'),
(80, 'test1'),
(14, 'Test2'),
(322, 'tonton'),
(341, 'top'),
(5, 'travail'),
(397, 'trois'),
(519, 'two'),
(395, 'un'),
(4, 'vampire'),
(323, 'youhou');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avatars_images1_idx` (`id_avatar`);

--
-- Index pour la table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_members1_idx` (`id_member`),
  ADD KEY `fk_comments_episodes1_idx` (`id_episode`);

--
-- Index pour la table `covers`
--
ALTER TABLE `covers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_covers_images1` (`id_cover`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_episodes_series1_idx` (`id_series`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_publishers_images1_idx` (`id_logo`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_members_avatars1_idx` (`id_avatar`),
  ADD KEY `fk_members_publishers1_idx` (`id_logo`);

--
-- Index pour la table `members_has_bills`
--
ALTER TABLE `members_has_bills`
  ADD PRIMARY KEY (`id_member`,`id_bill`),
  ADD KEY `fk_members_has_bills_bills1_idx` (`id_bill`),
  ADD KEY `fk_members_has_bills_members1_idx` (`id_member`);

--
-- Index pour la table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_member`,`id_episode`),
  ADD KEY `fk_members_has_episodes_episodes1_idx` (`id_episode`),
  ADD KEY `fk_members_has_episodes_members1_idx` (`id_member`);

--
-- Index pour la table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_series_members_idx` (`id_member`),
  ADD KEY `fk_series_images1_idx` (`id_cover`);

--
-- Index pour la table `series_has_members_subscription`
--
ALTER TABLE `series_has_members_subscription`
  ADD PRIMARY KEY (`id_series`,`id_member`),
  ADD KEY `fk_series_has_members_members1_idx` (`id_member`),
  ADD KEY `fk_series_has_members_series1_idx` (`id_series`);

--
-- Index pour la table `series_has_tags`
--
ALTER TABLE `series_has_tags`
  ADD PRIMARY KEY (`id_tag`,`id_series`),
  ADD KEY `fk_tags_has_series_series1_idx` (`id_series`),
  ADD KEY `fk_tags_has_series_tags1_idx` (`id_tag`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `covers`
--
ALTER TABLE `covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT pour la table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `packs`
--
ALTER TABLE `packs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD CONSTRAINT `fk_avatars_images1` FOREIGN KEY (`id_avatar`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_episodes1` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `covers`
--
ALTER TABLE `covers`
  ADD CONSTRAINT `fk_covers_images1` FOREIGN KEY (`id_cover`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `fk_episodes_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `logos`
--
ALTER TABLE `logos`
  ADD CONSTRAINT `fk_publishers_images1` FOREIGN KEY (`id_logo`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_members_avatars1` FOREIGN KEY (`id_avatar`) REFERENCES `avatars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_members_publishers1` FOREIGN KEY (`id_logo`) REFERENCES `logos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `members_has_bills`
--
ALTER TABLE `members_has_bills`
  ADD CONSTRAINT `fk_members_has_bills_bills1` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_members_has_bills_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_members_has_episodes_episodes1` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_members_has_episodes_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_series_covers` FOREIGN KEY (`id_cover`) REFERENCES `covers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_series_members` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`);

--
-- Contraintes pour la table `series_has_members_subscription`
--
ALTER TABLE `series_has_members_subscription`
  ADD CONSTRAINT `fk_series_has_members_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_series_has_members_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `series_has_tags`
--
ALTER TABLE `series_has_tags`
  ADD CONSTRAINT `fk_tags_has_series_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tags_has_series_tags1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
