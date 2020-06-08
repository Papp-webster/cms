-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2020. Jún 08. 18:52
-- Kiszolgáló verziója: 10.0.38-MariaDB
-- PHP verzió: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mszteszh_cms`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `comment_content` text CHARACTER SET utf8 NOT NULL,
  `comment_status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_content`, `comment_status`, `comment_date`) VALUES
(153, 22, 'Jhon', 'aztaaa!!', 'elfogadva', '2020-02-21'),
(156, 22, ' Nomenestomen', 'szia john ', 'elfogadva', '2020-03-06'),
(158, 47, ' Husi', 'Nomen est omen est spiritus sancti', 'elfogadva', '2020-03-07');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `cat_id` int(3) UNSIGNED NOT NULL,
  `cat_cim` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`cat_id`, `cat_cim`) VALUES
(5, 'Balaton'),
(6, 'Nyaralások'),
(7, 'Technológia');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(24, 55, 48),
(25, 55, 48),
(26, 55, 48),
(28, 55, 47);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posztok`
--

CREATE TABLE `posztok` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_cim` varchar(255) CHARACTER SET utf8 NOT NULL,
  `post_author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_img` text CHARACTER SET utf8 NOT NULL,
  `post_tartalom` text CHARACTER SET utf8 NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_com_count` int(11) NOT NULL,
  `post_status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `post_views` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `posztok`
--

INSERT INTO `posztok` (`post_id`, `post_cat_id`, `post_cim`, `post_author`, `post_user`, `post_date`, `post_img`, `post_tartalom`, `post_tags`, `post_com_count`, `post_status`, `post_views`, `likes`) VALUES
(22, 6, 'Balatoni Kirándulás', 'Michell foxer', '', '2020-03-11', 'tt.jpg', '<p>Lórum ipse számos máshol nehezen fokvós bonótot és hetlen stást is magál. A kismelő södelet lereszére, illetve a kegyves zsombén bromára – a södelet timalájától függően – résliznie kell. Szítás ki kell durásznia a felen zsombénokkal nyúlékos portyák illetve gyakontások pihető pacnokát. <a href=\"https://www.msztesz.hu/\">Tulus ingedvés a colát,</a> a vadeleket és a tenokot nem igélen packodnia, illetőleg olyan felgémben sodnia, amely közvetlenül vagy közvetve a zsürjés túráját porgorgatja. Tiskalia ingedvés (1) a csírázatos túrát is szemi ájust, menénzést (a vermárdokban: ittan ájus) loccsantnia, ámeszről falnia, mosztumba hincsnie, szédálnia, árkolnia, rodnia, továbbá hortóságait, censeit szögesednie, illetve véglegesen csáválnia a vitó picit rapár csepségzepések plataival és törögeivel sisallárban igélen. (2) Az (1) roknár betlend rintély a zürkmény taszáros pengető szendelségéhez hákos. (3) a csírázatos egészség tékedése érdekében egyes konyos ittan ájusok durkos bizete és jestegbe terese. (4) portya vagy annak hitelő ítménye esetén a zürkmény taszáros az ittan ájussal készteglő rintélyet rinotoghatja, illetve az ittan ájus bicionát kurtíthatja.</p>', 'balaton nyaralás', 0, 'publikált', 17, 0),
(23, 7, 'Tech cuccok part3', 'Michell Zoe', '', '2020-03-06', 'tecg01.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p>', 'technológia', 0, 'publikált', 4, 0),
(45, 6, 'Factory', 'Molestiae ducimus', '', '2020-05-27', 'home-bg.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p>', 'gyár', 0, 'publikált', 6, 0),
(47, 5, 'Balaton te csodás!', '', 'valuk', '2020-03-09', 'bb.jpg', '<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>', 'balaton nyaralás', 0, 'publikált', 2, 1),
(48, 7, 'Technológiai Fejlődés!', 'Joe badanski', 'valuk', '2020-05-27', 'tech06.jpg', '<p>MEm finibus eu tortor eget iaculis. Nulla id eros in felis egestas aliquam. – olvasható rengeteg, még félkész weboldalon, ahol nem a szöveg tartalma, hanem külleme és elhelyezkedése a lényeg.&nbsp;</p><p>amikor egy ismeretlen nyomdász összeállította a saját nyomdakészletét, és ezzel szemléltette a különböző betűket. A közhiedelemmel ellentétben azonban nem zagyva szövegről van szó – Cicero egy könyvének, A Jó és Rossz határainak átírt és kicsit megmásított részlete, amelyet a nagy gondolkodó és államférfi Kr. e. 45-ben vetett papírra. Az írás az etika szabályairól és elméletéről szól – nem csoda, hogy a reneszánsz időszakban olyan előszeretettel alkalmazták.</p><p>&nbsp;</p><p>AZ egy régóta elfogadott tény, miszerint egy olvasót zavarja az olvasható szöveg miközben a szöveg elrendezését nézi. A Lorem Ipsum használatának lényege, hogy többé-kevésbé rendezettebb betûket tartalmaz, ellentétben a Tartalom helye, Tartalom helye-féle megoldással. Sok desktop szerkesztõ és weboldal szerkesztõ használja a Lorem Ipsum-ot mint alapbeállítású szövegmodellt, és egy keresés a lorem ipsum-ra sok félkész weboldalt fog eredményezni.</p><p><a href=\"https://24.hu/belfold/2020/05/27/trianon100-ablonczy-balazs-bekeszerzodes-interju/\">https://24.hu/belfold/2020/05/27/trianon100-ablonczy-balazs-bekeszerzodes-interju/</a></p>', 'technológia', 0, 'publikált', 17, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(41, 'valuk', '$2y$12$MFtvbKH19Q2OSmJeoNNZYOTdxsUnTkstU070D8PB2tcF9SpE0gQyG', 'Simon', 'Robino', 'papp.laszlo.web@gmail.com', 'lez.jpg', 'admin', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users_online`
--

CREATE TABLE `users_online` (
  `id` int(10) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'bnrrn8b6v8dl903h9isfdg1g7t', 1577551167),
(2, '8vssg0ocsk7jn2d5n2q8i3ub80', 1578480557),
(3, 'nark8sdno3tlr8i4o0j70n7s35', 1578473511),
(4, '9mmib7a4u3qun7ouvbc8a51iv6', 1578473471),
(5, 'raq2gcfcu28l9fvmku7srd1ak7', 1578481814),
(6, 'h1a3scddsj41k29mjog7sgj6d2', 1578482745),
(7, '06sd8dkd7jcg33eos3310e6ot4', 1578492335),
(8, '3h51oualidvsh1iem9lpi3h3b0', 1578497514),
(9, 'lvorjdqrt87ukrtmfqo7ngvn13', 1578516899),
(10, '0v3u5no1pm7fsk61lkb2k64ng0', 1578567830),
(11, 'n4aksl7umkqc7fmn27rmjkpqt4', 1578579615),
(12, 'ne3vl0r8lniahb2dosd6u2mo55', 1578578284),
(13, '24ekv9m9cg0noqutcsg05341c6', 1578592214),
(14, 'rskgo6trbsials9f3sturdgm47', 1578597609),
(15, '9fcct123nq0i6bqvk719krb8f3', 1578667667),
(16, 'fafnl1mhv5bod1l50nm07u9qm0', 1578647439),
(17, 'ghdtgkv63dou9ju687onmbqua4', 1578651436),
(18, 'v8uu9qtf1upceufh9jttm750b1', 1578668057),
(19, '69hfcumjkdfsont9k7sgps73s2', 1578757552),
(20, 'ppamgsevh729gmmsers8r5ffl7', 1578679823),
(21, '62pgp0keov62fo3qq80134s895', 1578679798),
(22, 'psi7002uglr6gflr1363jk7ad3', 1578734957),
(23, '817p6p8gr9pqfbuvnhpvh5qfo4', 1578773844),
(24, 'br68js5bvklus2miptphlhdqg6', 1578754272),
(25, 'iprtmu4eegoki4fpko6m7ses02', 1578752731),
(26, 'fmim9ufdguaa0lsaf3vdt4cph7', 1578760674),
(27, 'mnup25ar011hjfbmn49qj8hku3', 1578810245),
(28, 'no35keeu1hbg98l01ifeq6b7u4', 1578815499),
(29, 'bkh5uf8j3ukftl24o9e4opgnj3', 1578826854),
(30, '10hnkhhc54l0rjhjgmeko0amn4', 1578851649),
(31, 'b5r9h8frgt6rreo1445mc2suv3', 1578830710),
(32, 'lp05lc9vufj4169gckh1jkg1e3', 1578835647),
(33, '8vcet0cmu825iler4dd8cd8rm4', 1578858539),
(34, '8i4h81pa8pg5777od8ugted1o7', 1578909945),
(35, 'lfkgf0o88niomv6beg13a6vtn5', 1578944319),
(36, 't5ckf3jak4mndv6cu0kn8o6vj0', 1578945914),
(37, 'ttve42ukkde6b8hs2iuvs1p2d1', 1578948065),
(38, 'fufo4nrbjot5rikh9eph5h3j60', 1578950668),
(39, 's0kkkocg3r87l0a7rio0ed9vv5', 1578998411),
(40, 'mvtm5lunf689ru8c73l075q125', 1579103227),
(41, 'g2dc25qa5rtrlcuifbq5tv9tc2', 1579209967),
(42, '13qoa5l4qjoeletgrq23crt5c4', 1579209938),
(43, '0etsghn42nsk1f0i6mjabg9a33', 1590738920),
(44, '4hr4uif3mdp8ou2bpad8rbevm6', 1579332198),
(45, 'nr3s0eqtu4n2puoutdl7qnje75', 1579413693),
(46, 'rpp08f7r224pflit778itduq81', 1579427625),
(47, 'lmd8avr2otir3bovjt6trs2hp5', 1579463543),
(48, 'e0fvcgl0kbmpq28lnhb5me99g6', 1579506507),
(49, 'ci18ur4kvcf1klg735v8tpkv52', 1579515646),
(50, '3esjnlu1op31u6dk23lv9n2go3', 1579615712),
(51, 'rf5os1eqkoglclhv5sb6rftr11', 1579847331),
(52, '3ujrqgbm4mkgav1d6tmvam35v3', 1579889512),
(53, 'ir3pg4eu1d398c42l9cq9samd7', 1580114328),
(54, 'offaf8g22podpuak0sqo4k6hu4', 1580137227),
(55, 'hcuqq2gnlb4uc824tdvqc35k10', 1580540566),
(56, 'mldqr0g1dj14mpdnc9oo6ucdh3', 1580801766),
(57, 's221v7nhvopo763gglu2tqrcc4', 1580999852),
(58, 'haevvnv7hb3vulve71m37dcvp4', 1581012445),
(59, 'hfn543s9vjcduc7imvvhqcrq74', 1581018131),
(60, 'vpi7dn0lg17okg1t72ru3vvkl6', 1581083279),
(61, 'cnmfc2tnpshetugot3ltqtb7k3', 1581093469),
(62, 'ltpuqf5i8omflklk16dhou1nr0', 1581347271),
(63, 'cgurso4dt103oh9h0gt9q7qh54', 1581426376),
(64, '0nf5o42jg7ltn8394mpe7c1rb5', 1581573659),
(65, '1hdhf38ndjh2m0d8s9epbeqv80', 1581930209),
(66, 'm4a71akipfh69om0ilq3f3oms1', 1581937740),
(67, 'b38epak79965nggseuh3i5j3i4', 1581943746),
(68, '0ji6lfaml5ept6bbafehtmg201', 1581943879),
(69, 'fqd13h46j9qs5hkvlb1k668l10', 1581956443),
(70, 'ts0c3fi9qug8mintru206io8p7', 1582013056),
(71, 'rgvsa35a4v2viafhfk9llqf737', 1582136305),
(72, 'ktvrdgefl8qha1ult1de7u3860', 1582181334),
(73, '7gem1vqlg86cdn3jq9465hsfn3', 1582294705),
(74, '0n9fa9rbmqhe2q8s6kn6vunsq5', 1582455904),
(75, 'ddru6ldc8ivi0p15jhjpl79t85', 1582537678),
(76, 'gnpu7m9fl710b8s2kclpcut1p3', 1582577400),
(77, 'rtv3848ukbpo48najha6dkgac1', 1582884293),
(78, '95cen83bhckfltqhpk882f2kf3', 1582963899),
(79, 'kvpp656mdest08i6pkt85vk2r6', 1582965994),
(80, 'hqbm831ubr97bslsnsuhp90lr7', 1583403266),
(81, 'p023kur17ug3co0nupaknhs0m5', 1583423715),
(82, '8m66sjadju8vdi9oeoqdlnbhr6', 1583490972),
(83, 'pvr6c688gfpo364m90p1ig62q3', 1583565220),
(84, 'cjnngrkjr2hie4ou5oad4skcc4', 1583745505),
(85, 'c45s9naniu5d79lgr7fp5lkpn7', 1583783138),
(86, 'soi7ju6834go6qsd3qq0cqg6t2', 1583840835),
(87, 'k9mjdafti0g7njhlv29onl9690', 1583859000),
(88, 'm6vo04dtjagj7c6do6kt4sub35', 1583910755),
(89, 'cl6be6aat2iifsss679burnp47', 1583991891),
(90, 'cju9epqr3dqj95m9cllfgknp41', 1584164050),
(91, 'ote5aojut7u146621sfs09uuj2', 1588606341),
(92, 'retbpk3c2j27sqj74bmulqeti7', 1588669286),
(93, 'e4ltphmqgklrpg224q5q15a2f7', 1588679369),
(94, 'q3ldrv65mv4j71rhv6qhp0a8u2', 1589268199),
(95, 'kgajr432fe685kjkg273ckp8g1', 1590092190),
(96, 'd5fovi4me4cmql2674pnv6tuk0', 1590124642),
(97, 'vofs3dmjjr6uhc7d4luuf4r6a0', 1590140760),
(98, 'e1ohmg4e779a4ht3qn21kp5n74', 1590130710),
(99, 'stol7f321flokrplncrnh9u141', 1590177221),
(100, 'aotvuaigkq5qkag757iods0507', 1590573725),
(101, 'l2rqak62vcvo9p7vd0icdkn0v4', 1590591542),
(102, '79k1learkvicv7itv9liqcck66', 1590738989),
(103, '1fvcp5ctbmiu5mdscoathn3ug4', 1591366431),
(104, 'uqcas3km7sgrhttguo75857kv1', 1591604237);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`cat_id`);

--
-- A tábla indexei `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `posztok`
--
ALTER TABLE `posztok`
  ADD PRIMARY KEY (`post_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- A tábla indexei `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `cat_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `posztok`
--
ALTER TABLE `posztok`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT a táblához `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
