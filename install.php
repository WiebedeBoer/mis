<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>install</title>
</HEAD>
<BODY>
<?php




if (isset($_GET["step"])) {


$install_step = $_GET["step"];
//installatie stap 1
if ($install_step ==1){



if (isset($_POST["server"]) && isset($_POST["dbname"]) && isset($_POST["user"]) && isset($_POST["pass"])) {
if (filter_var($_POST["server"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["dbname"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["user"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["pass"], FILTER_SANTITIZE_STRING)){
$servertype = $_POST['server'];
$dbname = $_POST['dbname'];
$username = $_POST['user'];
$password = $_POST['pass'];

$write_txt = '<?php
//DATABASE CONNECTION VARIABLES
$myserver ="'.$servertype.'";
$myname = "'.$username.'";
$mypassword = "'.$password.'";
$mydb = "'.$dbname.'";
?>';

$myfile = fopen("includes/connect.php", "w") or die("Unable to open file!");
fwrite($myfile, $write_txt);
fclose($myfile);

echo '<p>Proceed to next step.</p>';

echo '<form method="Post" action="install.php?step=2">
<br>Username: <input type="text" size=20 maxlength=20 name="user">
<br>Password: <input type="text" size=20 maxlength=20 name="pass">
<br>Website Domain: <input type="text" size=20 maxlength=20 name="domein">
<br>Contact Emailaddress: <input type="text" size=20 maxlength=20 name="contact">
<INPUT type="Submit" value="create">
</form>';


}
}
}
}

}



}
//installatie stap 2
elseif ($install_step ==2){



if (isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["domein"]) && isset($_POST["contact"])) {
if (filter_var($_POST["user"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["pass"], FILTER_SANTITIZE_STRING)){
if (filter_var($_POST["domein"], FILTER_VALIDATE_URL)){
if (filter_var($_POST["contact"], FILTER_VALIDATE_EMAIL)){
$username = $_POST['user'];
$password = $_POST['pass'];
$domein = $_POST['domein'];
$contactadres = $_POST['contact'];

include("includes/connect.php");

//SQL CONNECTION
$conn = new mysqli($myserver, $myname, $mypassword, $mydb);
if ($conn->connect_error)
  {

echo '<P class="error">Could not select database. Have you forgot to change the database connection? <a href="install.php">return to step 0</a></P>';
  }
else {


$cquery = "SELECT COUNT(*) AS usercheck FROM Users";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($usercheck);
$cid->fetch();
$cid->close();

if ($usercheck <1){

/*

//tabellen installeren
$bquery = "CREATE TABLE `Bestanden` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `URL` varchar(240) NOT NULL)";
$bid = $conn->prepare($bquery);
$bid->execute();
$bid->close();
$cquery = "CREATE TABLE `Brute` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `User` varchar(80) NOT NULL, `time_block` datetime(6) NOT NULL, `tries` int(1) NOT NULL)";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->close();
$rquery = "CREATE TABLE `News` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Titel` varchar(240) NOT NULL, `Datum` varchar(240) NOT NULL, `Tekst` text NOT NULL)";
$rid = $conn->prepare($rquery);
$rid->execute();
$rid->close();
$dquery = "CREATE TABLE `Photos` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Imgurl` varchar(240) NOT NULL, `Imgname` varchar(240) NOT NULL, `Width` int(11) NOT NULL, `Height` int(11) NOT NULL, `Photosize` int(11) NOT NULL)";
$did = $conn->prepare($dquery);
$did->execute();
$did->close();
$equery = "CREATE TABLE `Seo` (`ID` int(1) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID),  `Titel` varchar(80) NOT NULL, `Beschrijving` varchar(200) NOT NULL, `Zoektermen` varchar(240) NOT NULL, `Bannier` varchar(240) NOT NULL, `Contact` varchar(80) NOT NULL, `Style` varchar(240) NOT NULL, `Width` varchar(240) NOT NULL DEFAULT '1', `Height` varchar(240) NOT NULL DEFAULT '1')";
$eid = $conn->prepare($equery);
$eid->execute();
$eid->close();
$oquery = "CREATE TABLE `Sitemap` (`ID` int(1) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID),  `URL` varchar(80) NOT NULL, `Freq` varchar(20) NOT NULL DEFAULT 'monthly')";
$oid = $conn->prepare($oquery);
$oid->execute();
$oid->close();
$fquery = "CREATE TABLE `Users` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Username` varchar(40) NOT NULL, `Password` varchar(20) NOT NULL, `Category` varchar(20) NOT NULL, `Cokey` varchar(20) NOT NULL DEFAULT '0')";
$fid = $conn->prepare($fquery);
$fid->execute();
$fid->close();
$gquery = "CREATE TABLE `Webcontent` (`ID` int(11) NOT NULL AUTO_INCREMENT,  PRIMARY KEY(ID), `Pagina` varchar(80) NOT NULL, `URL` varchar(80) NOT NULL, `Tekst` text NOT NULL, `Verwijderbaar` int(1) NOT NULL DEFAULT '0',  `Zichtbaar` int(1) NOT NULL DEFAULT '1', `Beschrijving` varchar(200) NOT NULL DEFAULT 'geen', `Zoektermen` varchar(240) NOT NULL DEFAULT 'geen')";
$gid = $conn->prepare($gquery);
$gid->execute();
$gid->close();

//data inserteren
$hquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (1, 'Home', 'index.php', 'home', 0, 1)";
$hid = $conn->prepare($hquery);
$hid->execute();
$hid->close();
$jquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (2, 'Contact', 'contact.php', 'contact', 0, 1)";
$jid = $conn->prepare($jquery);
$jid->execute();
$jid->close();
$kquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (3, 'Nieuws', 'nieuws.php', 'leeg ', 0, 1)";
$kid = $conn->prepare($kquery);
$kid->execute();
$kid->close();
$pquery = "INSERT INTO `Webcontent` (`ID`, `Pagina`, `URL`, `Tekst`, `Verwijderbaar`, `Zichtbaar`) VALUES (3, 'Over Ons', 'over_ons.php', 'leeg ', 0, 1)";
$pid = $conn->prepare($pquery);
$pid->execute();
$pid->close();

$lquery = "INSERT INTO `Seo` (`ID`, `Domein`, `Titel`, `Beschrijving`, `Zoektermen`, `Bannier`, `Style`) VALUES (0, ?, 'Test', 'leeg', 'leeg', 'leeg.png', ?, 'styles')";
$lid = $conn->prepare($lquery);
$lid->bind_param('ss', $domein, $conntactadres);
$lid->execute();
$lid->close();

$nquery = "INSERT INTO `Sitemap` (`ID`, `URL`, `Freq`) VALUES ('index.php', 'monthly')";
$nid = $conn->prepare($nquery);
$nid->execute();
$nid->close();

//gebruiker inserteren
$mquery = "INSERT INTO `Users` (`ID`, `Username`, `Password`, `Category`, `Cokey`) VALUES
(1, ?, ?, 'superadmin', '0')";
$mid = $conn->prepare($mquery);
$mid->bind_param('ss', $username, $password);
$mid->execute();
$mid->close();

//xml writer

$write_txt '&lt;urlset&gt;';

$write_txt= $write_txt.'&lt;url>
&lt;loc&gt;'.$domein.'/&lt;/loc&gt;
&lt;lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H").':'.date("i").':'.date("s").'+00:00&lt;/lastmod&gt;
&lt;changefreq>monthly&lt;/changefreq&gt;
&lt;/url&gt;';

$write_txt= $write_txt.'&lt;/urlset&gt;';

$myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
fwrite($myfile, $write_txt);
fclose($myfile);

//finished step display message

echo '<p>data installed. Proceed to <a href="uninstall.php">final step</a>.</p>';

*/

}
else {
echo '<p class="error">already installed</p>';
}

}

}
else {
echo '<p class="error">invalid emailaddress</p>';
}
}
else {
echo '<p class="error">invalid domain</p>';
}
}
else {
echo '<p class="error">invalid password</p>';
}
}
else {
echo '<p class="error">invalid username</p>';
}

}



}
//insstallatie stap 3
elseif ($install_step ==3){

//eventuele derde stap

}
//error
else {
echo '<p class="error">install error</p>';
}

}
//installatie stap  0
else {


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
echo '<p class="error">database connection already set</p>';
}


}
















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





?>
</BODY>
</HTML>
