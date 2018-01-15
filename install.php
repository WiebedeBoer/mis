<?php


if (isset($_GET["step"])) {
$install_step = $_GET["step"];
//installatie stap 1
if ($install_step ==1){

}
//installatie stap 2
elseif ($install_step ==2){

}
//insstallatie stap 3
elseif ($install_step ==3){

}
//error
else {

}
}
//installatie stap  0
else {
}












include("includes/connect.php");

$length_check = strlen($myserver);

if ($length_check <1){

echo '<form method="Post" action="install.php?step=1">
Server Connection: <input type="text" size=20 maxlength=20 name="server" value="localhost">
Database name: <input type="text" size=20 maxlength=20 name="dbname">
Database Username: <input type="text" size=20 maxlength=20 name="user">
Database Password: <input type="text" size=20 maxlength=20 name="pass">
<INPUT type="Submit" value="create">
</form>';

}
else {

/*SQL CONNECTION*/
$conn = new mysqli($myserver, $myname, $mypassword, $mydb);
if ($conn->connect_error)
  {

echo "
<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>error</title>
</HEAD>
<BODY>
<P class='error'>Could not select database. Have you forgot to change the database connection?</P>
</BODY>
</HTML>";
  }
else {



if (isset($_POST["user"]) && isset($_POST["pass"])) {
if (filter_var($_POST["user"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["pass"], FILTER_SANTITIZE_STRING)){
$username = $_POST['user'];
$password = md5($_POST['pass']);

echo '<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>installer</title>
</HEAD>
<BODY>'




$bquery = "CREATE TABLE `Bestanden` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `URL` varchar(240) NOT NULL)";
$bid = $conn->prepare($bquery);
$bid->execute();
$bid->close();
$cquery = "CREATE TABLE `Brute` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `User` varchar(80) NOT NULL, `Timer` int(11) NOT NULL)";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->close();
$dquery = "CREATE TABLE `Photos` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Imgurl` varchar(240) NOT NULL, `Imgname` varchar(240) NOT NULL, `Width` int(11) NOT NULL, `Height` int(11) NOT NULL, `Photosize` int(11) NOT NULL)";
$did = $conn->prepare($dquery);
$did->execute();
$did->close();
$equery = "CREATE TABLE `Seo` (`ID` int(1) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID),  `Titel` varchar(80) NOT NULL, `Beschrijving` varchar(200) NOT NULL, `Zoektermen` varchar(240) NOT NULL, `Bannier` varchar(240) NOT NULL)";
$eid = $conn->prepare($equery);
$eid->execute();
$eid->close();
$fquery = "CREATE TABLE `Users` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Username` varchar(40) NOT NULL, `Password` varchar(20) NOT NULL, `Category` varchar(20) NOT NULL, `Cokey` varchar(20) NOT NULL DEFAULT '0')";
$fid = $conn->prepare($fquery);
$fid->execute();
$fid->close();
$gquery = "CREATE TABLE `Webcontent` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Pagina` varchar(80) NOT NULL, `URL` varchar(80) NOT NULL, `Tekst` text NOT NULL, `Verwijderbaar` int(1) NOT NULL DEFAULT '0',  `Zichtbaar` int(1) NOT NULL DEFAULT '1')";
$gid = $conn->prepare($gquery);
$gid->execute();
$gid->close();

/*
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
*/

$hquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (1, 'Home', 'index.php', 'home', 0, 1)";
$hid = $conn->prepare($hquery);
$hid->execute();
$hid->close();
$jquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (2, 'Contact', 'contact.php', 'contact', 0, 1)";
$jid = $conn->prepare($jquery);
$jid->execute();
$jid->close();
$kquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (3, 'Test', 'korte_projecten.php', 'leeg ', 0, 1)";
$kid = $conn->prepare($kquery);
$kid->execute();
$kid->close();

$lquery = "INSERT INTO `Seo` (`ID`, `Titel`, `Beschrijving`, `Zoektermen`, `Bannier`) VALUES (0, 'Test', 'leeg', 'leeg', 'leeg')";
$lid = $conn->prepare($lquery);
$lid->execute();
$lid->close();

$mquery = "INSERT INTO `Users` (`ID`, `Username`, `Password`, `Category`, `Cokey`) VALUES
(1, ?, ?, 'superadmin', '0')";
$mid = $conn->prepare($mquery);
$mid->bind_param('ss', $username, $password);
$mid->execute();
$mid->close();

}
else {
echo '<p class="error">invalid password</p>';
}
}
else {
echo '<p class="error">invalid username</p>';
}
}
else {

$cquery = "SELECT COUNT(*) AS usercheck FROM Users";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($usercheck);
$cid->fetch();
$cid->close();

if ($usercheck <1){

echo '<form method="Post" action="install.php">
Username: <input type="text" size=20 maxlength=20 name="user">
Password: <input type="text" size=20 maxlength=20 name="pass">
<INPUT type="Submit" value="create">
</form>';

}
else {
echo '<p class="error">already installed</p>';
}

}


echo '</BODY>
</HTML>';

}

}

?>
