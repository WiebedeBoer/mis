-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 24 jan 2018 om 11:42
-- Serverversie: 5.5.56-MariaDB
-- PHP-versie: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_nl`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Bestanden`
--

CREATE TABLE `Bestanden` (
  `ID` int(11) NOT NULL,
  `URL` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Brute`
--

CREATE TABLE `Brute` (
  `ID` int(11) NOT NULL,
  `User` varchar(80) NOT NULL,
  `block_time` datetime(6) NOT NULL,
  `tries` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Brute`
--

INSERT INTO `Brute` (`ID`, `User`, `block_time`, `tries`) VALUES
(1, 'Wiebe', '2018-01-24 09:38:25.000000', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Meldingen`
--

CREATE TABLE `Meldingen` (
  `ID` int(11) NOT NULL,
  `Persoon` varchar(80) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Onderwerp` text NOT NULL,
  `Kruis` varchar(20) NOT NULL DEFAULT 'ongecontroleerd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `News`
--

CREATE TABLE `News` (
  `ID` int(11) NOT NULL,
  `Titel` varchar(240) NOT NULL,
  `Datum` varchar(240) NOT NULL,
  `Tekst` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `News`
--

INSERT INTO `News` (`ID`, `Titel`, `Datum`, `Tekst`) VALUES
(6, 'Test bericht', '22-01-2018', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu laoreet orci. Fusce at ligula vel erat faucibus cursus. Suspendisse potenti. Pellentesque rhoncus ac justo in cursus. Mauris vestibulum egestas purus, nec cursus leo mollis in. Pellentesque condimentum ante ut justo vehicula, non varius massa aliquam. Proin porta maximus pulvinar. In id facilisis sem, euismod varius lectus. Fusce aliquet leo eu tellus tincidunt convallis. Duis arcu eros, maximus sit amet lobortis eu, semper sed justo. Cras semper mi vel mauris varius, in ornare arcu porta. Donec non velit a sapien malesuada elementum quis eu felis. Aliquam erat volutpat. Aliquam luctus quis augue eget vehicula. Ut nunc massa, finibus at sagittis in, condimentum quis justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. '),
(7, 'bericht 2', '22-01-2018', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu laoreet orci. Fusce at ligula vel erat faucibus cursus. Suspendisse potenti. Pellentesque rhoncus ac justo in cursus. Mauris vestibulum egestas purus, nec cursus leo mollis in. Pellentesque condimentum ante ut justo vehicula, non varius massa aliquam. Proin porta maximus pulvinar. In id facilisis sem, euismod varius lectus. Fusce aliquet leo eu tellus tincidunt convallis. Duis arcu eros, maximus sit amet lobortis eu, semper sed justo. Cras semper mi vel mauris varius, in ornare arcu porta. Donec non velit a sapien malesuada elementum quis eu felis. Aliquam erat volutpat. Aliquam luctus quis augue eget vehicula. Ut nunc massa, finibus at sagittis in, condimentum quis justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. '),
(8, 'bericht 3', '22-01-2018', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu laoreet orci. Fusce at ligula vel erat faucibus cursus. Suspendisse potenti. Pellentesque rhoncus ac justo in cursus. Mauris vestibulum egestas purus, nec cursus leo mollis in. Pellentesque condimentum ante ut justo vehicula, non varius massa aliquam. Proin porta maximus pulvinar. In id facilisis sem, euismod varius lectus. Fusce aliquet leo eu tellus tincidunt convallis. Duis arcu eros, maximus sit amet lobortis eu, semper sed justo. Cras semper mi vel mauris varius, in ornare arcu porta. Donec non velit a sapien malesuada elementum quis eu felis. Aliquam erat volutpat. Aliquam luctus quis augue eget vehicula. Ut nunc massa, finibus at sagittis in, condimentum quis justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Photos`
--

CREATE TABLE `Photos` (
  `ID` int(11) NOT NULL,
  `Imgurl` varchar(240) NOT NULL,
  `Imgname` varchar(240) NOT NULL,
  `Width` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `Photosize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Photos`
--

INSERT INTO `Photos` (`ID`, `Imgurl`, `Imgname`, `Width`, `Height`, `Photosize`) VALUES
(4, '../pictures/fryslan.jpg', 'fryslan.jpg', 448, 173, 18858),
(5, '../pictures/source.gif', 'source.gif', 570, 363, 664470),
(6, '../pictures/dancing-banana.gif', 'dancing-banana.gif', 365, 360, 71759),
(7, '../pictures/it.gif', 'it.gif', 243, 339, 805318),
(8, '../pictures/1417514182930.png', '1417514182930.png', 1920, 1080, 312577);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Seo`
--

CREATE TABLE `Seo` (
  `ID` int(1) NOT NULL,
  `Titel` varchar(80) NOT NULL,
  `Beschrijving` varchar(200) NOT NULL,
  `Zoektermen` varchar(240) NOT NULL,
  `Bannier` varchar(240) NOT NULL,
  `Domein` varchar(240) NOT NULL,
  `Contact` varchar(80) NOT NULL,
  `Style` varchar(240) NOT NULL,
  `Width` int(4) NOT NULL DEFAULT '1',
  `Height` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Seo`
--

INSERT INTO `Seo` (`ID`, `Titel`, `Beschrijving`, `Zoektermen`, `Bannier`, `Domein`, `Contact`, `Style`, `Width`, `Height`) VALUES
(1, 'Test', 'leeg', 'leeg', 'fryslan.jpg', 'recentnieuws.nl', 'info@romegames.nl', 'styles.css', 450, 150);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Sitemap`
--

CREATE TABLE `Sitemap` (
  `ID` int(11) NOT NULL,
  `URL` varchar(80) NOT NULL,
  `Freq` varchar(20) NOT NULL DEFAULT 'monthly'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Sitemap`
--

INSERT INTO `Sitemap` (`ID`, `URL`, `Freq`) VALUES
(1, 'index.php', 'monthly');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(240) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Cokey` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`ID`, `Username`, `Password`, `Category`, `Cokey`) VALUES
(1, 'Wiebe', 'a8be90b1dc1e70cda81eaec61e37bcdb', 'superadmin', '4KrSbc2UvbtW'),
(2, 'Sil', '6763f4ab8a7128b2ffe89f11adec4cf3', 'superadmin', 'TZMMpyTZs67g'),
(3, 'Juriaan', '7fac999098589384807e2d09128771a5', 'superadmin', '5CxXkSP9A5sP'),
(4, 'Chris', 'c6e337507a221671688153abc7138586', 'superadmin', '0ZasRrSwczdM'),
(5, 'henk', 'e8689ada578f5551f3f2720009e53f8e', 'user', 'wJYyCyON8zro');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Webcontent`
--

CREATE TABLE `Webcontent` (
  `ID` int(11) NOT NULL,
  `Pagina` varchar(80) NOT NULL,
  `URL` varchar(80) NOT NULL,
  `Tekst` text NOT NULL,
  `Verwijderbaar` int(1) NOT NULL DEFAULT '0',
  `Zichtbaar` int(1) NOT NULL DEFAULT '1',
  `Volgorde` int(4) NOT NULL DEFAULT '1',
  `Beschrijving` varchar(200) NOT NULL DEFAULT 'geen',
  `Zoektermen` varchar(240) NOT NULL DEFAULT 'geen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Webcontent`
--

INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`, `Volgorde`, `Beschrijving`, `Zoektermen`) VALUES
(1, 'Home', 'index.php', 'Welkom op mijn home pagina!', 0, 1, 4, 'geen', 'geen'),
(2, 'Contact', 'contact.php', 'Neem [b]hier[/b] contact met ons op', 0, 1, 2, 'geen te', 'geen'),
(3, 'Nieuws', 'nieuws.php', 'leeg ', 0, 1, 3, 'geen', 'geen'),
(4, 'Over Ons', 'over_ons.php', 'leeg', 0, 1, 1, 'geen', 'geen'),
(5, 'extra', 'extra.php?extra=5', 'nog geen tekst', 0, 1, 9, 'geen', 'geen'),
(6, 'lolol', 'extra.php?extra=6', 'nog geen tekst', 0, 1, 1, 'geen', 'geen');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Bestanden`
--
ALTER TABLE `Bestanden`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `Brute`
--
ALTER TABLE `Brute`
  ADD UNIQUE KEY `unique` (`ID`),
  ADD UNIQUE KEY `User` (`User`);

--
-- Indexen voor tabel `Meldingen`
--
ALTER TABLE `Meldingen`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- Indexen voor tabel `News`
--
ALTER TABLE `News`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- Indexen voor tabel `Photos`
--
ALTER TABLE `Photos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `Seo`
--
ALTER TABLE `Seo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `Sitemap`
--
ALTER TABLE `Sitemap`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- Indexen voor tabel `Webcontent`
--
ALTER TABLE `Webcontent`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Bestanden`
--
ALTER TABLE `Bestanden`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `Brute`
--
ALTER TABLE `Brute`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `Meldingen`
--
ALTER TABLE `Meldingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `News`
--
ALTER TABLE `News`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `Photos`
--
ALTER TABLE `Photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `Sitemap`
--
ALTER TABLE `Sitemap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `Webcontent`
--
ALTER TABLE `Webcontent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
