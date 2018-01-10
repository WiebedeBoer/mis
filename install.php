<?php


$uquery = "UPDATE Users SET Cokey ='$makekey' WHERE Username = ?";
$uid = $conn->prepare($uquery);
$uid->bind_param('s', $username);
$uid->execute();
$uid->close();


$bquery = "CREATE TABLE `Bestanden` (`ID` int(11) NOT NULL, `URL` varchar(240) NOT NULL)";
$bid = $conn->prepare($bquery);
$bid->execute();
$bid->close();


$cquery = "CREATE TABLE `Brute` (`ID` int(11) NOT NULL, `User` varchar(80) NOT NULL, `Timer` int(11) NOT NULL)";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->close();


$dquery = "CREATE TABLE `Photos` (`ID` int(11) NOT NULL, `Imgurl` varchar(240) NOT NULL, `Imgname` varchar(240) NOT NULL, `Width` int(11) NOT NULL, `Height` int(11) NOT NULL, `Photosize` int(11) NOT NULL)";
$did = $conn->prepare($dquery);
$did->execute();
$did->close();

$equery = "CREATE TABLE `Seo` (`ID` int(1) NOT NULL,  `Titel` varchar(80) NOT NULL, `Beschrijving` varchar(200) NOT NULL, `Zoektermen` varchar(240) NOT NULL, `Bannier` varchar(240) NOT NULL)";
$eid = $conn->prepare($equery);
$eid->execute();
$eid->close();

$fquery = "CREATE TABLE `Users` (`ID` int(11) NOT NULL, `Username` varchar(40) NOT NULL, `Password` varchar(20) NOT NULL, `Category` varchar(20) NOT NULL, `Cokey` varchar(20) NOT NULL DEFAULT '0')";
$fid = $conn->prepare($fquery);
$fid->execute();
$fid->close();

$gquery = "CREATE TABLE `Webcontent` (`ID` int(11) NOT NULL, `Pagina` varchar(80) NOT NULL, `URL` varchar(80) NOT NULL, `Tekst` text NOT NULL, `Verwijderbaar` int(1) NOT NULL DEFAULT '0',  `Zichtbaar` int(1) NOT NULL DEFAULT '1')";
$gid = $conn->prepare($gquery);
$gid->execute();
$gid->close();

ALTER TABLE `Bestanden` ADD PRIMARY KEY (`ID`);

ALTER TABLE `Brute` ADD UNIQUE KEY `unique` (`ID`);

ALTER TABLE `Meldingen` ADD UNIQUE KEY `unique` (`ID`);

ALTER TABLE `Photos` ADD PRIMARY KEY (`ID`);

ALTER TABLE `Projecten` ADD UNIQUE KEY `unique` (`ID`);

ALTER TABLE `Seo` ADD PRIMARY KEY (`ID`);

ALTER TABLE `Users`  ADD UNIQUE KEY `unique` (`ID`);

ALTER TABLE `Webcontent` ADD UNIQUE KEY `unique` (`ID`);

ALTER TABLE `Bestanden` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Brute` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (1, 'Home', 'index.php', 'home', 0, 1);
INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (2, 'Contact', 'contact.php', 'contact', 0, 1);
INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (3, 'Test', 'korte_projecten.php', 'leeg ', 0, 1);


?>
