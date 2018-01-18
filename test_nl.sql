-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 18 jan 2018 om 12:59
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
  `Contact` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Seo`
--

INSERT INTO `Seo` (`ID`, `Titel`, `Beschrijving`, `Zoektermen`, `Bannier`, `Domein`, `Contact`) VALUES
(1, 'Test', 'leeg', 'leeg', 'leeg', 'recentnieuws.nl', 'info@romegames.nl');

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
(1, 'Wiebe', 'a8be90b1dc1e70cda81eaec61e37bcdb', 'superadmin', '5d7QkLch5O6R'),
(2, 'Sil', '6763f4ab8a7128b2ffe89f11adec4cf3', 'superadmin', 'eapbBZ5NNBhk'),
(3, 'Juriaan', '7fac999098589384807e2d09128771a5', 'superadmin', '0'),
(4, 'Chris', 'c6e337507a221671688153abc7138586', 'superadmin', '0');

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
  `Beschrijving` varchar(200) NOT NULL DEFAULT 'geen',
  `Zoektermen` varchar(240) NOT NULL DEFAULT 'geen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Webcontent`
--

INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`, `Beschrijving`, `Zoektermen`) VALUES
(1, 'Home', 'index.php', 'home', 0, 1, 'geen', 'geen'),
(2, 'Contact', 'contact.php', 'contact', 0, 1, 'geen', 'geen'),
(3, 'Nieuws', 'nieuws.php', 'leeg ', 0, 1, 'geen', 'geen'),
(4, 'Over Ons', 'over_ons.php', 'leeg', 0, 1, 'geen', 'geen');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `Meldingen`
--
ALTER TABLE `Meldingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `Photos`
--
ALTER TABLE `Photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `Sitemap`
--
ALTER TABLE `Sitemap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `Webcontent`
--
ALTER TABLE `Webcontent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
