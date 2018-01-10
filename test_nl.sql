-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 10 jan 2018 om 10:16
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
  `Timer` int(11) NOT NULL
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

--
-- Gegevens worden geëxporteerd voor tabel `Photos`
--

INSERT INTO `Photos` (`ID`, `Imgurl`, `Imgname`, `Width`, `Height`, `Photosize`) VALUES
(1, '../pictures/met-groep-300x200.jpg', 'met-groep-300x200.jpg', 0, 0, 19090);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Projecten`
--

CREATE TABLE `Projecten` (
  `ID` int(11) NOT NULL,
  `Persoon` varchar(240) NOT NULL,
  `Onderwerp` text NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Kruis` varchar(40) NOT NULL DEFAULT 'ongecontroleerd'
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
  `Bannier` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Seo`
--

INSERT INTO `Seo` (`ID`, `Titel`, `Beschrijving`, `Zoektermen`, `Bannier`) VALUES
(1, 'Test', 'leeg', 'leeg', 'leeg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Cokey` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`ID`, `Username`, `Password`, `Category`, `Cokey`) VALUES
(1, 'Wiebe', 'eling17', 'superadmin', '5d7QkLch5O6R'),
(2, 'Sil', 'sil18', 'superadmin', 'x9Mk9yghYQuP'),
(3, 'Juriaan', 'juriaan19', 'superadmin', '0'),
(4, 'Chris', 'chris20', 'superadmin', '0');

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
  `Zichtbaar` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Webcontent`
--

INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES
(1, 'Home', 'index.php', 'home', 0, 1),
(2, 'Contact', 'contact.php', 'contact', 0, 1),
(3, 'Test', 'korte_projecten.php', 'leeg ', 0, 1);

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
  ADD UNIQUE KEY `unique` (`ID`);

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
-- Indexen voor tabel `Projecten`
--
ALTER TABLE `Projecten`
  ADD UNIQUE KEY `unique` (`ID`);

--
-- Indexen voor tabel `Seo`
--
ALTER TABLE `Seo`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `Projecten`
--
ALTER TABLE `Projecten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `Webcontent`
--
ALTER TABLE `Webcontent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
