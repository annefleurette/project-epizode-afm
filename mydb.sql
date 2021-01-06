-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 04 août 2020 à 15:01
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
(10, 19);

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
  `promotion` int(11) DEFAULT NULL,
  `words_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `number`, `title`, `content`, `publishing_status`, `date`, `id_series`, `price`, `likes_number`, `alert_status`, `promotion`, `words_number`) VALUES
(1, 1, 'Premier épisode', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc in augue sit amet augue accumsan finibus. Fusce a pharetra nunc. Pellentesque et sapien dapibus, dignissim ligula in, fermentum lacus. Pellentesque consectetur at sem dignissim auctor. Nam mollis neque sit amet euismod faucibus. Morbi et dolor id lectus dictum accumsan. Cras ut magna vitae erat aliquet lobortis.\r\n\r\nVestibulum dui quam, semper et neque at, tincidunt fermentum quam. Praesent tincidunt fermentum augue, et tincidunt ipsum suscipit sagittis. Integer nec auctor ex. Ut nec cursus quam. Vivamus eu facilisis purus. Donec facilisis, ipsum sit amet egestas pretium, leo nunc ultricies justo, vitae facilisis metus nulla nec nunc. Vestibulum pellentesque libero ligula, ac volutpat orci viverra sed. Suspendisse dictum semper erat. Duis sodales tristique odio sed pellentesque. Donec ut consectetur orci, at luctus lectus. Nulla placerat augue erat, et congue nibh lobortis eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'published', '2020-07-20 21:35:20', 1, NULL, NULL, 0, NULL, 3000),
(2, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:17', 2, NULL, NULL, 0, NULL, 3000),
(3, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:41', 3, NULL, NULL, 0, NULL, 3000),
(4, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:36:58', 4, NULL, NULL, 0, NULL, 3000),
(5, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:18', 5, NULL, NULL, 0, NULL, 3000),
(6, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:37:50', 6, 3.25, NULL, 0, NULL, 3000),
(7, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:07', 7, 3, NULL, 0, NULL, 3000),
(8, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:24', 8, 3, NULL, 0, NULL, 3000),
(9, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:38:38', 9, 3, NULL, 0, NULL, 3000),
(10, 1, 'Premier épisode', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.\r\n\r\nPraesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', 'published', '2020-07-20 21:39:02', 10, 3, NULL, 0, NULL, 3000),
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
(19, 'poster_fantome-opera', 'cover', 'Le fantôme de l\'opéra', './public/images/poster_fantome-opera.png');

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
  `authors_right` enum('public','CC','CC_NoCommercial','CC_NoCommercial_NoUpdate','CC_NoCommercial_Share','CC_NoUpdate') NOT NULL DEFAULT 'public',
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
(3, 'Elysée', 'Duis cursus efficitur lacus in fringilla. Duis vehicula varius ultrices. Integer auctor in diam quis gravida. Mauris congue vestibulum erat, sit amet dignissim massa tristique et. Integer tempor risus mauris. Proin eu blandit elit. Donec id orci sodales, interdum nisl ac, dignissim felis. Ut volutpat sed nisl ut porttitor. Ut erat ex, tempor vitae nisi ut, posuere malesuada lectus.', '2020-07-20 21:02:14', 1, 'free', 'published', 'CC_NoCommercial_NoUpdate', 3, NULL, NULL),
(4, 'Renaissance', 'Quisque neque tortor, convallis eu mauris nec, mattis condimentum magna. Suspendisse a massa eu justo placerat bibendum. Vestibulum dictum dignissim lectus, eget tincidunt urna gravida eget. Mauris in eros sit amet urna faucibus commodo in ac turpis. Duis porttitor interdum tellus id ultricies. Morbi orci dui, accumsan sit amet feugiat at, mollis eu lacus. Curabitur fringilla condimentum urna, sit amet dapibus elit volutpat et.', '2020-07-20 21:03:12', 1, 'free', 'published', 'CC_NoCommercial_Share', 4, NULL, NULL),
(5, 'New Boss', 'Mauris nec ex convallis, dictum libero a, ultricies metus. Donec risus enim, consequat sit amet turpis ac, aliquet gravida eros. Vestibulum egestas ipsum elementum, aliquet mi eu, elementum massa. Quisque at nulla sodales, dignissim dolor vel, placerat velit. Vestibulum nec metus lacinia, commodo odio id, cursus eros. Nullam mauris nibh, ultrices non mauris sit amet, fermentum laoreet lacus. Suspendisse vel urna a dui cursus sollicitudin sed id sapien. Nunc quis ante ac velit volutpat placerat eget sed erat. Praesent sodales nulla vel sapien commodo, id auctor nisl tristique.', '2020-07-20 21:03:38', 1, 'free', 'published', 'public', 5, NULL, NULL),
(6, 'L\'île au trésor', 'Suspendisse a rutrum sem. Nulla tincidunt mauris et tempus ullamcorper. Phasellus fermentum ornare aliquet. Mauris mollis non purus nec molestie. Suspendisse vel leo tempus, hendrerit ipsum dignissim, iaculis nulla. Duis et nisi dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed venenatis ante quis sem pulvinar posuere. Ut imperdiet dolor ut ante tempor gravida. Quisque lacinia nunc eget diam ultricies, vel commodo orci porta. Vestibulum vel augue ut risus finibus elementum.', '2020-07-20 21:13:31', 2, 'paying', 'published', 'public', 6, 'Robert Louis Stevenson', 'Fusce metus odio, vehicula eu ultrices eget, ultricies quis massa. Ut at felis vitae risus semper interdum et eget nunc. Curabitur blandit aliquam tortor, sed viverra felis laoreet ut. Donec nec dictum ante. In bibendum turpis at eros gravida pellentesque. Vestibulum eu lacus scelerisque, interdum nunc et, hendrerit ex.'),
(7, 'Le chien des Baskerville', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui. Duis gravida metus sed ante tempor lacinia. Phasellus vitae nisl vitae augue interdum fringilla. Praesent mi risus, tincidunt a libero non, ultrices lobortis ipsum. Curabitur congue ex in odio porta, sit amet consectetur neque semper. Morbi rhoncus lacus sed dui pulvinar, non porta sem consectetur.', '2020-07-20 21:20:02', 2, 'paying', 'published', 'public', 7, 'Sir Arthur Conan Doyle', 'Fusce metus odio, vehicula eu ultrices eget, ultricies quis massa. Ut at felis vitae risus semper interdum et eget nunc. Curabitur blandit aliquam tortor, sed viverra felis laoreet ut. Donec nec dictum ante. In bibendum turpis at eros gravida pellentesque. Vestibulum eu lacus scelerisque, interdum nunc et, hendrerit ex. Donec nunc odio, sollicitudin sit amet molestie sit amet, lobortis vel urna. Sed ornare ante eget ex efficitur, in consequat odio ultricies.'),
(8, 'Orgueil et Préjugés', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui. Duis gravida metus sed ante tempor lacinia. Phasellus vitae nisl vitae augue interdum fringilla. Praesent mi risus, tincidunt a libero non, ultrices lobortis ipsum. Curabitur congue ex in odio porta, sit amet consectetur neque semper. Morbi rhoncus lacus sed dui pulvinar, non porta sem consectetur.', '2020-07-20 21:21:01', 2, 'paying', 'published', 'public', 8, 'Jane Austen', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(9, 'Dracula', 'Praesent venenatis elit sed nunc varius, vel interdum sem euismod. Suspendisse eu neque vel sem congue accumsan. Maecenas aliquam felis velit, sed posuere risus dignissim ac. Donec dictum venenatis urna vel consequat. Aliquam volutpat libero ut lobortis tincidunt. Pellentesque condimentum turpis rhoncus felis fermentum, nec malesuada augue pellentesque. Nulla laoreet quis dolor ut ornare. Etiam mollis leo quis ipsum ultrices, in maximus diam molestie. Proin dapibus nulla vel nisi sodales molestie. Morbi mattis, velit a blandit bibendum, lacus lorem eleifend est, vitae commodo enim metus et ligula.', '2020-07-20 21:21:53', 2, 'paying', 'published', 'public', 9, 'Bram Stoker', 'Proin id pulvinar urna. Donec vel enim erat. Morbi lacinia, augue in sodales commodo, quam mauris porta nisl, non maximus mauris lectus sit amet magna. Etiam ut suscipit enim, sit amet feugiat velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(10, 'Le fantôme de l\'opéra', 'Duis diam sapien, varius sit amet tempor quis, dictum eu nulla. Mauris id quam maximus, gravida quam eu, faucibus mauris. Etiam tristique tempor augue. Morbi erat quam, tempor in dignissim in, viverra bibendum metus. Suspendisse sodales quis mi eu convallis. Pellentesque risus neque, suscipit sed lacinia ut, egestas non nisl. Vestibulum ultrices mauris a vulputate dignissim. Nunc lorem nunc, placerat vel neque sit amet, scelerisque rutrum dui. Cras finibus fringilla ante id porttitor. Sed eu efficitur purus.', '2020-07-20 21:22:52', 2, 'paying', 'published', 'public', 10, 'Gaston Leroux', 'Cras at scelerisque mauris. Nulla semper ante vel erat porta, auctor posuere dolor gravida. Mauris nunc neque, lacinia sed condimentum ac, semper tincidunt ex. Suspendisse pretium, nulla nec aliquam sollicitudin, mauris nisl interdum tellus, feugiat maximus erat augue nec dui.');

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
(1, 2),
(2, 2),
(11, 2),
(7, 3),
(9, 4),
(2, 5),
(5, 5),
(6, 5),
(8, 5),
(10, 6),
(11, 6),
(3, 7),
(2, 8),
(12, 8),
(1, 9),
(4, 9),
(3, 10);

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
(10, 'aventure'),
(1, 'fantastique'),
(12, 'femme'),
(9, 'histoire'),
(11, 'mystère'),
(3, 'policier'),
(7, 'politique'),
(8, 'pouvoir'),
(2, 'romance'),
(6, 'technologie'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `fk_series_members` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
