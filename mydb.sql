-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 12 oct. 2021 à 21:25
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
(8, 8),
(9, 258);

-- --------------------------------------------------------

--
-- Structure de la table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(240, 11),
(241, 12),
(242, 13),
(243, 14),
(247, 15),
(248, 16),
(249, 17),
(250, 18),
(251, 19),
(239, 261),
(244, 267);

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `publishing_status` enum('published','inprogress','deleted','banned') NOT NULL,
  `date_publication` datetime DEFAULT NULL,
  `date_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_series` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `alert_status` tinyint(4) NOT NULL DEFAULT '0',
  `promotion` float NOT NULL DEFAULT '0',
  `signs_number` int(11) NOT NULL,
  `meta_description` varchar(160) NOT NULL DEFAULT '''Découvrez le contenu de votre épisode en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `episode_has_members_likers`
--

CREATE TABLE `episode_has_members_likers` (
  `id_episode` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'avatar_cat', 'avatar', 'Avatar Féline', './public/images/avatar_cat.png'),
(2, 'avatar_cheriff', 'avatar', 'Avatar Shérif', './public/images/avatar_cheriff.png'),
(3, 'avatar_doctor', 'avatar', 'Avatar Docteur', './public/images/avatar_doctor.png'),
(4, 'avatar_fairy', 'avatar', 'Avatar Fée', './public/images/avatar_fairy.png'),
(5, 'avatar_princess', 'avatar', 'Avatar Princesse', './public/images/avatar_princess.png'),
(6, 'avatar_sherlock', 'avatar', 'Avatar Détective', './public/images/avatar_sherlock.png'),
(7, 'avatar_superwoman', 'avatar', 'Avatar Super-Héroïne', './public/images/avatar_superwoman.png'),
(8, 'avatar_vampire', 'avatar', 'Avatar Vampire', './public/images/avatar_vampire.png'),
(9, 'publisher_public-domain', 'publisher', 'Domaine Public', './public/images/publisher_public-domain.png'),
(11, 'poster_prophetia', 'cover', 'Prophetia', './public/images/poster_prophetia.png'),
(12, 'poster_elysee', 'cover', 'Elysée', './public/images/poster_elysee.png'),
(13, 'poster_renaissance', 'cover', 'Renaissance', './public/images/poster_renaissance.png'),
(14, 'poster_newboss', 'cover', 'New Boss', './public/images/poster_newboss.png'),
(15, 'poster_ile-au-tresor', 'cover', 'L\'île au trésor', './public/images/poster_ile-au-tresor.png'),
(16, 'poster_chien-baskerville', 'cover', 'Le chien des Baskerville', './public/images/poster_chien-baskerville.png'),
(17, 'poster_orgueil-prejuges', 'cover', 'Orgueil et Préjugés', './public/images/poster_orgueil-prejuges.png'),
(18, 'poster_dracula', 'cover', 'Dracula', './public/images/poster_dracula.png'),
(19, 'poster_fantome-opera', 'cover', 'Le fantôme de l\'opéra', './public/images/poster_fantome-opera.png'),
(258, 'avatar_admin', 'avatar', 'Avatar Admin', './public/images/avatar_admin.png'),
(259, 'avatar_default', 'avatar', 'Avatar Générique', './public/images/avatar_default.png'),
(260, 'logo_default', 'publisher', 'Logo Générique', './public/images/logo_default.png'),
(261, 'poster_default', 'cover', 'Cover Générique', './public/images/cover_default.png'),
(262, 'logo_edition1', 'publisher', 'Edition du Chêne', './public/images/logo_chene.png'),
(263, 'logo_edition2', 'publisher', 'Edition du Bouleau', './public/images/logo_bouleau.png'),
(264, 'logo_edition3', 'publisher', 'Edition du Peuplier', './public/images/logo_peuplier.png'),
(265, 'logo_edition4', 'publisher', 'Edition du Pommier', './public/images/logo_pommier.png'),
(266, 'logo_edition5', 'publisher', 'Edition du Saule', './public/images/logo_saule.png'),
(267, 'poster_geek', 'cover', 'Geek', './public/images/poster_geek.png');

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
(9, 260, 'Domaine Public'),
(10, 262, 'Editions du Chêne'),
(11, 263, 'Editions du Bouleau'),
(12, 264, 'Editions du Peuplier'),
(13, 265, 'Editions du Pommier'),
(14, 266, 'Editions du Saule');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
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
  `id_avatar` int(11) DEFAULT '9',
  `id_logo` int(11) DEFAULT '9',
  `confirmation` enum('waiting','confirmed') NOT NULL DEFAULT 'confirmed',
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `email`, `password`, `type`, `date_subscription`, `description`, `coins_number`, `gender`, `surname`, `name`, `company_name`, `address`, `zipcode`, `city`, `country`, `birthdate`, `id_avatar`, `id_logo`, `confirmation`, `token`) VALUES
(18, 'admin', 'admin@epizode.fr', '$2y$10$rT0I/wWS4r3l.adBYhP8eePYFaSx2y7kGlywuUOMTeYfw5anwn8aq', 'admin', '2021-10-10 18:37:33', 'Je suis l\'administrateur d\'Epizode : c\'est moi qui contrôle tout ce que vous publiez. Je peux modérer le contenu, supprimer des séries, des épisodes et des commentaires !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, 'confirmed', '6165d14c7cdcf'),
(24, 'julie', 'julie@epizode.fr', '$2y$10$yAW1XdfAf.VJfU4kN1gV9OrfVfKNsSqlJ1tPEqE0J5ksp13HWqBGm', 'user', '2021-10-12 20:11:41', 'Je m\'appelle Julie et je suis une grande amatrice de romans avec des superhéros. Pendant mon temps libre les week-ends, j\'aime aller au cinéma et regarder des séries !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 9, 'confirmed', NULL),
(25, 'emilie', 'emilie@epizode.fr', '$2y$10$PORHZk4hYoW5rloT4qpbTef7pUKx56N45KRxr1myONpI7eUs3hG.i', 'user', '2021-10-12 20:13:01', 'Je m\'appelle Emilie et je suis une grande amatrice de romans fantastiques et historiques. Pendant mon temps libre les week-ends, j\'aime visiter les châteaux !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 9, 'confirmed', NULL),
(26, 'anne', 'anne@epizode.fr', '$2y$10$eyhmldRqJHSuH9S4XiUuOeajHa08raOyDjUd/Bqw8MElmZiyfzkem', 'user', '2021-10-12 20:13:55', 'Je m\'appelle Anne et je suis une grande amatrice de romans policiers et d\'aventure. Pendant mon temps libre les week-ends, j\'aime faire des escape games !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 9, 'confirmed', NULL),
(27, 'marie', 'marie@epizode.fr', '$2y$10$x3Fykmwsxs11.CVXcjxsLeMhyknVOvd0SZkHE2ElcFdZQPAOnx54C', 'user', '2021-10-12 20:14:52', 'Je m\'appelle Marie et je suis une grande amatrice de romans d\'horreur et de science-fiction. Pendant mon temps libre les week-ends, j\'aime aller organiser des murder parties avec mes amis !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 9, 'confirmed', NULL),
(28, 'jeanne', 'jeanne@epizode.fr', '$2y$10$TnDQIxtHXCzfn57djsKVzOtbhFjiF/nzNbAaMxh2Z/mwPY3CmLtfC', 'user', '2021-10-12 20:15:53', 'Je m\'appelle Jeanne et je suis une grande amatrice de romans médicaux. Pendant mon temps libre les week-ends, j\'aime aller au musée de la science !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 9, 'confirmed', NULL),
(29, 'editions_chene', 'chene@epizode.fr', '$2y$10$fFDO3DDRtZH.WXBmnYCkVO6WienJT9g7BuQFCP7954rEzbqL85bfK', 'publisher', '2021-10-12 20:31:41', 'Nous sommes les éditions du Chêne et nous publions des romans fantastiques et historiques pour les enfants et les adultes !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 10, 'confirmed', NULL),
(30, 'editions_bouleau', 'bouleau@epizode.fr', '$2y$10$3t84XjxaYU2P/XXzfcbA8uSJu.2BB28AxxjypbkQFuMrxug3zKPGa', 'publisher', '2021-10-12 20:31:56', 'Nous sommes les éditions du Bouleau et nous publions des romans policiers et des polars pour les adultes !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 11, 'confirmed', NULL),
(31, 'editions_peuplier', 'peuplier@epizode.fr', '$2y$10$sxgIp4Bpu.dYWDY2xdPDCu5nHsufNFRVSeq4sHC/FczBkiXkmtyOa', 'publisher', '2021-10-12 20:32:12', 'Nous sommes les éditions du Peuplier et nous publions des romans d\'aventure pour les enfants et les adolescents !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 12, 'confirmed', NULL),
(32, 'editions_pommier', 'pommier@epizode.fr', '$2y$10$bmSL5k3f/AGxeKeBjxhc8e4dU.oNsdLSPfewqynym4PhU/f1uJv2i', 'publisher', '2021-10-12 20:32:48', 'Nous sommes les éditions du Pommier et nous publions des romances et des romans de vie à l\'adresse d\'un lectorat plutôt féminin !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 13, 'confirmed', NULL),
(33, 'editions_saule', 'saule@epizode.fr', '$2y$10$SQ6Jmd.q.7y5qt.Itju4N.e0/Q3e462FhxqTLt/0Lvu2yGcJkNh1O', 'publisher', '2021-10-12 20:33:04', 'Nous sommes les éditions du Saule et nous publions des romans de voyage, d\'aventure et d\'horreur à l\'adresse des enfants et des adultes !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 14, 'confirmed', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `members_has_bills`
--

CREATE TABLE `members_has_bills` (
  `id_member` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coins_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` longtext NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_member` int(11) NOT NULL,
  `pricing_status` enum('free','paying') NOT NULL,
  `publishing_status` enum('published','inprogress','deleted','banned') NOT NULL DEFAULT 'inprogress',
  `authors_right` enum('public','CC','CC1','CC2','CC3','CC4','CC5','reserved') NOT NULL DEFAULT 'public',
  `id_cover` int(11) DEFAULT '239',
  `publisher_author` varchar(200) DEFAULT NULL,
  `publisher_author_description` longtext,
  `meta_description` varchar(160) NOT NULL DEFAULT '''Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `title`, `summary`, `date_publication`, `date_modification`, `id_member`, `pricing_status`, `publishing_status`, `authors_right`, `id_cover`, `publisher_author`, `publisher_author_description`, `meta_description`) VALUES
(1, 'Prophetia', 'Lorsque Laura, chercheuse en archéologie, découvre les vestiges d\'une tombe égyptienne antique recherchée, elle est loin de se douter qu\'elle a réveillé le mystérieux pouvoir du pharaon. Une prophétie dit même que le réveil d\'Imhotep VI pourrait bien conduire à la fin du monde. Le temps presse, Laura doit résoudre l\'énigme des pyramides pour empêcher l\'inévitable !', '2021-10-12 21:12:39', '2021-10-12 21:12:39', 24, 'free', 'published', 'CC1', 240, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(2, 'Renaissance', 'Il était une fois François Ier, roi emblématique de la Renaissance. A la fois stratège militaire, et homme des arts et des lettres, François Ier est aussi un séducteur reconnu. Plongez dans les intrigues de la cour et revivez la transition entre le Moyen-Âge et les Temps Modernes !', '2021-10-12 21:51:32', '2021-10-12 21:51:32', 25, 'free', 'published', 'CC2', 242, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(3, 'Mission Elysée', '2022 : année d\'élections présidentielles en France ! Qui rejoindra l\'Elysée pour 5 ans ? Partis politiques, coups bas entre candidats, scandales financiers, orientation des votes : le chemin est long avant d\'espérer accéder à la fonction suprême !', '2021-10-12 21:55:50', '2021-10-12 21:55:50', 26, 'free', 'published', 'public', 241, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(4, 'Geek', 'Un groupe de jeunes participe à un challenge informatique qui tourne mal ! Les voilà pris en otage par des hackers qui menacent leurs familles et amis. Il n\'y a qu\'une solution : déjouer le code informatique pour les sauver tous !', '2021-10-12 22:07:42', '2021-10-12 22:07:42', 27, 'free', 'published', 'CC3', 244, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(5, 'New Boss', 'Marc Newton, le nouveau chirurgien de l\'hôpital de Miami est à peine arrivé qu\'il fait déjà battre tous les coeurs. Mais derrière son apparence de gentleman, Marc cache un dangereux passé de criminel !', '2021-10-12 22:15:38', '2021-10-12 22:15:38', 28, 'free', 'published', 'CC4', 243, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(6, 'Police', 'Immergez-vous au coeur d\'un commissariat de police de Marseille : la vie de quartier, les affaires, la hiérarchie interne. Un 360° avec les forces de l\'ordre qui vous fera tourner la tête !', '2021-10-12 22:25:48', '2021-10-12 22:25:48', 26, 'free', 'inprogress', 'CC5', 239, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(7, 'Galaxie', '3, 2, 1... Zéro ! Quand John décolle pour une mission spatiale sur Mars, il est loin de se douter qu\'il va découvrir une nouvelle forme de vie extraterrestre...', '2021-10-12 22:25:48', '2021-10-12 22:25:48', 24, 'free', 'inprogress', 'CC5', 239, NULL, NULL, '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(8, 'L\'île au trésor', 'Le jeune Jim Hawkins est le héros de ce roman, ainsi que le terrible John Silver, l\'homme à la jambe de bois. L\'Hispanolia débarque sur l\'île au Trésor. Dès lors, une lutte implacable se déroule pour retrouver le trésor amassé par Flint, redoutable pirate mort sans avoir livré son secret.', '2021-10-12 22:36:29', '2021-10-12 22:36:29', 31, 'paying', 'published', 'reserved', 247, 'Robert Louis Stevenson', 'Robert Louis Stevenson est un écrivain britannique né le 13 novembre 1850 à Édimbourg et décédé le 3 décembre 1894 dans l’archipel des Samoa. Disposant d’une santé fragile, il effectue de nombreux voyages, dont il saura s’inspirer lors de l’élaboration de ses récits comme Voyage avec un Âne dans les Cévennes (1879). Dans l’Angleterre victorienne, il devient rapidement l’un des nouvellistes et romanciers les plus réputés, notamment après l’édition de L’Île au Trésor (1883) et L’Étrange Cas du Docteur Jekyll et de M. Hyde (1886).', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(9, 'Le chien des Baskerville', 'Des cris lugubres résonnent sur la lande... Et voici que la légende prend corps. Un chien énorme, créature fantomatique et infernale, serait à l\'origine de la mort de sir Charles Baskerville. Maudit soit Hugo, l\'ancêtre impie et athée, qui provoqua, en son temps, les forces du mal !\r\nMais Sherlock Holmes ne peut croire à de telles sornettes. Aussi, lorsqu\'il dépêche le fidèle Watson auprès de sir Henry, l\'héritier nouvellement débarqué d\'Amérique, il ne doute pas de mettre rapidement fin à ces spéculations. Pourtant, la mort a frappé plusieurs fois sur la lande. Et le manoir est le théâtre de phénomènes bien étranges... Se peut-il que la malédiction des Baskerville pèse encore ?', '2021-10-12 22:36:29', '2021-10-12 22:36:29', 30, 'paying', 'published', 'reserved', 248, 'Sir Arthur Conan Doyle', 'Conan Doyle est un grand romancier né à Édimbourg en Écosse le 22 mai 1859 et décédé à Crowborough le 7 juillet 1930. Il s’est illustré dans plusieurs registres, de la science-fiction au roman historique en passant par la poésie. Il est surtout connu pour être le créateur du détective Sherlock Holmes qui est le personnage principal de nombreux romans et nouvelles de l’auteur. Ses histoires ont inspiré de nombreuses adaptations cinématographiques et télévisuelles.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(10, 'Orgueil & Préjugés', 'Pour les Anglaises du XIXe siècle, hors du mariage, point de salut ! Romanesques en diable, les démêlés de la caustique Elizabeth Bennett et du vaniteux Mr Darcy n\'ont pas pris une ride ! Mais, il faut parfois savoir renoncer à son orgueil. Et accepter la tombée des masques pour voir clair dans la nuit. Un classique universel, drôle et émouvant.', '2021-10-12 22:36:29', '2021-10-12 22:36:29', 32, 'paying', 'published', 'reserved', 249, 'Jane Austen', 'Née le 16 décembre 1775 à Stevenson et décédée le 18 juillet 1817 à Winchester, Jane Austen est l’une des plus grandes figures de la littérature anglaise du XVIIIe siècle. Peu célébrée de son vivant, elle est aujourd’hui connue à travers le monde, notamment pour Orgueil et Préjugés, son roman le plus populaire.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(11, 'Dracula', 'Jonathan Harker, jeune et brillant clerc de notaire, se rend pour affaires dans les Carpates, où réside son client, le comte Dracula. Celui-ci se révèle un hôte chaleureux et prévenant, mais la curiosité incite Jonathan à pousser son exploration de l\'immense château toujours un peu plus loin. À travers les lettres qu\'il lui envoie presque chaque jour, Mina, sa jeune épouse restée à Londres, découvre qu\'une effroyable réalité se tapit dans l\'ombre de la légende...', '2021-10-12 22:36:29', '2021-10-12 22:36:29', 33, 'paying', 'published', 'reserved', 250, 'Bram Stoker', 'Abraham Stoker est né à Clontarf, près de Dublin, le 8 novembre 1847, dans une famille modeste de sept enfants. De santé fragile, il passe son plus jeune âge auprès de sa mère qui le familiarise avec les légendes irlandaises et les romans gothiques. À 16 ans, il rentre au Trinity College et, devient à vingt ans chroniqueur dramatique au Dublin Mail.\r\nEn 1875, Bram Stoker écrit The primerose path, un feuilleton publié dans la revue Shamrock et, en 1879, paraît Au-delà du crépuscule, un livre de contes pour enfants dédié à son fils Noël. À partir de 1887, il publie des nouvelles devenues des classiques du genre fantastique comme La maison du juge ou La squaw, tout en parachevant durant dix ans ce qu\'Oscar Wilde saluera comme « le beau roman du siècle », Dracula. Ce récit épistolaire, paru en mai 1897, connaît le succès dès sa parution et Bram Stoker fera lui-même l\'adaptation théâtrale de ce qui deviendra une source d\'inspiration majeure pour le cinéma.\r\nPar la suite, Bram Stoker, publiera d\'autres romans d\'aventures fantastiques tels que Le joyau des sept étoiles et Le repaire du ver blanc, un récit inspiré des légendes celtiques.\r\nPrécurseur de la littérature de terreur moderne, Bram Stoker, qui a également ouvert la voie à Lovecraft, est mort le 21 avril 1912.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(12, 'Le fantôme de l\'opéra', '«Le fantôme de l’Opéra a existé. J’avais été frappé dès l’abord que je commençai à compulser les archives de l’Académie nationale de musique par la coïncidence surprenante des phénomènes attribués au fantôme et du plus mystérieux, du plus fantastique des drames, et je devais bientôt être conduit à cette idée que l’on pourrait peut-être rationnellement expliquer celui-ci par celui-là.»\r\nAvec l’art de l’intrigue parfaitement nouée et l’inspiration diabolique qui ont fait le succès de Gaston Leroux, le père de Rouletabille, Le Fantôme de l’Opéra nous entraîne dans une extraordinaire aventure qui nous tient en haleine de la première à la dernière ligne.', '2021-10-12 23:00:07', '2021-10-12 23:00:07', 29, 'paying', 'published', 'public', 251, 'Gaston Leroux', 'Gaston Leroux naît en 1868. Après des études de droit, il travaille comme avocat puis comme chroniqueur judiciaire avant de devenir grand reporter. Parallèlement, il écrit de nombreux romans policiers teintés de fantastique, tous devenus très populaires, tels Le Mystère de la chambre jaune et Le Parfum de la dame en noir.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(13, 'Cinq semaines en ballon', 'Tenter de traverser l\'Afrique d\'est en ouest par la voie des airs, prétendre survoler dans sa plus grande largeur le dangereux continent noir à bord d\'une fragile nacelle livrée à tous les caprices des vents, c\'était, au temps de Jules Verne, une entreprise d\'une audace incroyable. Comme on peut s\'y attendre, les cinq semaines qu\'il faudra au docteur Fergusson et à ses deux compagnons pour y parvenir seront pleines d\'imprévu et de péripéties.', '2021-10-12 23:06:39', '2021-10-12 23:06:39', 31, 'paying', 'inprogress', 'reserved', 239, 'Jules Verne', 'Jules Verne, né le 8 février 1828 à Nantes et mort le 24 mars 1905 à Amiens, est un écrivain français, dont une grande partie de l\'ouvre est consacrée à des romans d\'aventures et d\'anticipation.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\''),
(14, 'Le tour du monde en 80 jours', 'Phileas Fogg a parié qu\'il accomplirait le tour du monde en 80 jours. Malgré toutes les embûches rencontrées, gagnera-t-il son pari ?\r\nUn roman d\'aventures au suspense haletant et un document instructif sur le monde à la fin du XIXe siècle.', '2021-10-12 23:06:39', '2021-10-12 23:06:39', 31, 'paying', 'inprogress', 'reserved', 239, 'Jules Verne', 'Jules Verne, né le 8 février 1828 à Nantes et mort le 24 mars 1905 à Amiens, est un écrivain français, dont une grande partie de l\'ouvre est consacrée à des romans d\'aventures et d\'anticipation.', '\'Découvrez le contenu de votre série en exclusivité sur Episode ! Des séries originales et passionnantes à lire partout, à tout moment !\'');

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
(1, 25, 1),
(1, 26, 1),
(1, 27, 1),
(1, 28, 1),
(1, 29, 1),
(1, 31, 1),
(1, 33, 1),
(2, 24, 1),
(2, 28, 1),
(3, 27, 1),
(3, 30, 1),
(4, 24, 1),
(4, 28, 1),
(5, 24, 1),
(5, 25, 1),
(5, 26, 1),
(5, 30, 1),
(5, 32, 1),
(8, 24, 1),
(8, 27, 1),
(9, 26, 1),
(10, 28, 1),
(11, 26, 1),
(12, 27, 1);

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
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(2, 3),
(8, 3),
(10, 4),
(11, 4),
(12, 5),
(13, 5),
(14, 5),
(14, 6),
(15, 7),
(3, 8),
(16, 8),
(2, 9),
(17, 9),
(5, 10),
(2, 11),
(18, 11),
(2, 12),
(19, 12),
(3, 13),
(20, 13),
(3, 14),
(20, 14);

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
(1, 'antiquité'),
(7, 'arts'),
(3, 'aventure'),
(17, 'détective'),
(13, 'docteur'),
(15, 'espace'),
(11, 'étudiants'),
(19, 'fantôme'),
(6, 'guerre'),
(10, 'informatique'),
(12, 'médical'),
(2, 'mystère'),
(16, 'pirate'),
(14, 'policier'),
(8, 'politique'),
(4, 'roi'),
(5, 'romance'),
(18, 'vampire'),
(20, 'voyage');

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
-- Index pour la table `episode_has_members_likers`
--
ALTER TABLE `episode_has_members_likers`
  ADD PRIMARY KEY (`id_episode`,`id_member`),
  ADD KEY `fk_episode_has_members_members1` (`id_member`);

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
  ADD UNIQUE KEY `token` (`token`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `covers`
--
ALTER TABLE `covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT pour la table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `packs`
--
ALTER TABLE `packs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `fk_comments_episodes1` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `covers`
--
ALTER TABLE `covers`
  ADD CONSTRAINT `fk_covers_images1` FOREIGN KEY (`id_cover`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `fk_episodes_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `episode_has_members_likers`
--
ALTER TABLE `episode_has_members_likers`
  ADD CONSTRAINT `fk_episode_has_members_episodes1` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_episode_has_members_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `logos`
--
ALTER TABLE `logos`
  ADD CONSTRAINT `fk_publishers_images1` FOREIGN KEY (`id_logo`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_members_avatars1` FOREIGN KEY (`id_avatar`) REFERENCES `avatars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_members_publishers1` FOREIGN KEY (`id_logo`) REFERENCES `logos` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `members_has_bills`
--
ALTER TABLE `members_has_bills`
  ADD CONSTRAINT `fk_members_had_bill_bill` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_members_has_bills_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_members_has_episodes_episodes1` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_members_has_episodes_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_series_covers` FOREIGN KEY (`id_cover`) REFERENCES `covers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_series_members` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `series_has_members_subscription`
--
ALTER TABLE `series_has_members_subscription`
  ADD CONSTRAINT `fk_series_has_members_members1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_series_has_members_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `series_has_tags`
--
ALTER TABLE `series_has_tags`
  ADD CONSTRAINT `fk_tags_has_series_series1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tags_has_series_tags1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
