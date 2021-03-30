-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 30 mars 2021 à 19:43
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
(4, 2, 6, 'Merci !', '2020-07-20 21:41:55', 0);

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
(30, 40),
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
(104, 114);

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
  `price` float DEFAULT NULL,
  `likes_number` int(11) DEFAULT NULL,
  `alert_status` tinyint(4) NOT NULL DEFAULT '0',
  `promotion` float DEFAULT NULL,
  `words_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `number`, `title`, `content`, `publishing_status`, `date`, `id_series`, `price`, `likes_number`, `alert_status`, `promotion`, `words_number`) VALUES
(1, 1, 'Premier épisode', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc in augue sit amet augue accumsan finibus. Fusce a pharetra nunc. Pellentesque et sapien dapibus, dignissim ligula in, fermentum lacus. Pellentesque consectetur at sem dignissim auctor. Nam mollis neque sit amet euismod faucibus. Morbi et dolor id lectus dictum accumsan. Cras ut magna vitae erat aliquet lobortis.\r\n\r\nVestibulum dui quam, semper et neque at, tincidunt fermentum quam. Praesent tincidunt fermentum augue, et tincidunt ipsum suscipit sagittis. Integer nec auctor ex. Ut nec cursus quam. Vivamus eu facilisis purus. Donec facilisis, ipsum sit amet egestas pretium, leo nunc ultricies justo, vitae facilisis metus nulla nec nunc. Vestibulum pellentesque libero ligula, ac volutpat orci viverra sed. Suspendisse dictum semper erat. Duis sodales tristique odio sed pellentesque. Donec ut consectetur orci, at luctus lectus. Nulla placerat augue erat, et congue nibh lobortis eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'published', '2020-07-20 21:35:20', 1, 3, NULL, 0, NULL, 3000),
(2, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:17', 2, NULL, NULL, 0, NULL, 3000),
(3, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:41', 3, NULL, NULL, 0, NULL, 3000),
(4, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:58', 4, NULL, NULL, 0, NULL, 3000),
(5, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:18', 5, NULL, NULL, 0, NULL, 3000),
(6, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:50', 6, 3.25, NULL, 0, NULL, 3000),
(7, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:07', 7, 3, NULL, 0, NULL, 3000),
(8, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:24', 8, 3, NULL, 0, NULL, 3000),
(9, 2, 'Deuxième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:38', 12, 6, NULL, 0, NULL, 3000),
(10, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:39:02', 12, 3, NULL, 0, NULL, 3000),
(11, 2, 'Deuxième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:40:01', 1, NULL, NULL, 0, NULL, 3000),
(12, 3, 'Troisième épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:40:23', 1, NULL, NULL, 1, NULL, 3000);

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
(26, '0b0cbf0a0de91d8f8f1e4ab14aa33186023ff3c0', 'cover', 'Try3', './public/images/'),
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
(40, '1d9f71ee4685bcee941b3e36d6072b3a3bb2e593', 'cover', 'Essai N°8', './public/images/1d9f71ee4685bcee941b3e36d6072b3a3bb2e593'),
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
(114, '6576bbf0b2efb01586a204d1b52d69571b53b74b', 'cover', 'Nouveau test', './public/images/6576bbf0b2efb01586a204d1b52d69571b53b74b_AdobeStock_206294095_Preview.jpeg');

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
  `id_cover` int(11) NOT NULL,
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
(15, 'Hello', 'Bonjour', '2021-03-24 16:29:48', 1, 'free', 'inprogress', 'public', 30, NULL, NULL),
(16, 'Hello', 'Bonjour', '2021-03-24 16:59:29', 1, 'free', 'inprogress', 'public', 30, '', ''),
(17, 'Hello', 'Bonjour', '2021-03-24 17:00:09', 1, 'free', 'inprogress', 'public', 30, '', ''),
(18, 'Hello', 'Hello', '2021-03-24 17:00:40', 1, 'free', 'inprogress', 'public', 30, '', ''),
(19, 'Hello', 'Hello', '2021-03-24 17:01:23', 1, 'paying', 'inprogress', 'public', 30, '', ''),
(20, 'Hello', 'Hello', '2021-03-24 17:02:00', 1, 'paying', 'inprogress', 'public', 30, '', ''),
(21, 'Hello', 'Hello', '2021-03-24 17:04:26', 1, 'paying', 'inprogress', 'public', 30, '', ''),
(22, 'Hello', 'Hello', '2021-03-24 17:04:53', 1, 'paying', 'inprogress', 'public', 30, '', ''),
(23, 'Hello', 'Hello', '2021-03-24 17:05:23', 1, 'paying', 'inprogress', 'public', 86, '', ''),
(24, 'Hello', 'Hello', '2021-03-24 17:05:51', 1, 'paying', 'inprogress', 'public', 87, '', ''),
(25, 'Nouveau test', 'Hola', '2021-03-24 17:06:32', 1, 'paying', 'inprogress', 'public', 88, '', ''),
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
(40, 'Nouveau test', 'Hola', '2021-03-24 20:48:38', 1, 'paying', 'inprogress', 'CC4', 104, '', '');

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
(10, 3, 0);

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
(1, 9),
(4, 9),
(3, 10),
(15, 12),
(16, 12),
(85, 40);

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
(75, ' fantaisie'),
(13, ' Horreur'),
(10, 'aventure'),
(44, 'Bonjour'),
(43, 'enfance'),
(1, 'fantastique'),
(12, 'femme'),
(9, 'histoire'),
(85, 'jolitag'),
(11, 'mystère'),
(17, 'Plusieurs'),
(3, 'policier'),
(7, 'politique'),
(8, 'pouvoir'),
(74, 'rêve'),
(2, 'romance'),
(15, 'Tag N°1'),
(16, 'Tag N°2'),
(76, 'tag1'),
(77, 'tag2'),
(78, 'tag3'),
(79, 'tag4'),
(18, 'tags'),
(6, 'technologie'),
(47, 'test'),
(80, 'test1'),
(14, 'Test2'),
(5, 'travail'),
(4, 'vampire');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `covers`
--
ALTER TABLE `covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

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
  ADD CONSTRAINT `fk_covers_images1` FOREIGN KEY (`id_cover`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_series_members` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`id_cover`) REFERENCES `covers` (`id`);

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
  ADD CONSTRAINT `fk_tags_has_series_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tags_has_series_tags1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
