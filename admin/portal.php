<?php
if (isset($_POST["username"]) && isset($_POST["password"])){
/*FILTERS*/
//CHECK USERNAME
if(filter_has_var(INPUT_POST, "username")){
//CHECK PASSWORD
if(filter_has_var(INPUT_POST, "password")){
if (filter_var($_POST["username"], FILTER_SANITIZE_STRING)){
if (filter_var($_POST["password"], FILTER_SANITIZE_STRING)){
$username = $_POST["username"];
$password = md5($_POST["password"]);
//DATABASE CONNECTION VARIABLES
include("../includes/connect.php");
// Create connection
$conn = new mysqli($myserver, $myname, $mypassword, $mydb);
// Check connection
if ($conn->connect_error) {
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
//die('Could not connect: ' . mysql_error());
die("Connection failed: " . $conn->connect_error);
echo "<P class='error'>Could not connect</P>";
  }
else {
/*
//DATABASE SELECTION
$selector = mysql_select_db($mydb, $con);
if (!$selector)
{
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
die('Could not select database: ' . mysql_error());
echo "<P class='error'>Could not select database</P>";
echo '</BODY>
</HTML>';
}
else {
*/
/*
$resultco = mysql_query ("SELECT COUNT(*) AS usercount FROM Users WHERE Username ='$username'");
$rowco = mysql_fetch_assoc($resultco);
$usercheck = $rowco["usercount"];
*/
//bruteforce protection
$brutequery = "SELECT tries FROM Brute WHERE User = ? AND DATE_ADD(block_time, INTERVAL 30 MINUTE) >= NOW()";
$brute = $conn->prepare($brutequery);
$brute->bind_param('s', $username);
$brute->execute();
$brute->bind_result($tries);
$brute->fetch();
$brute->close();
// blockeer inloggen als gebruiker 5x heeft geprobeert in te loggen.
if ($tries < 5){
//COUNT USER
$cquery = "SELECT COUNT(*) AS usercheck, ID, Password, Cokey FROM Users WHERE Username = ?";
$cid = $conn->prepare($cquery);
$cid->bind_param('s', $username);
$cid->execute();
$cid->bind_result($usercheck, $user_id, $gpass, $makekey);
$cid->fetch();
$cid->close();
if ($usercheck ==1){
/*
$result = mysql_query ("SELECT * FROM Users WHERE Username ='$username'");
$row = mysql_fetch_assoc($result);
$tabpass = $row["Password"];
if ($password == $tabpass){
*/
if ($password == $gpass){
/*COOKIE RANDOM KEY*/
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$ra = (rand(1,62)) - 1;
$rancha = substr($chars,$ra,1);
$rb = (rand(1,62)) - 1;
$ranchb = substr($chars,$rb,1);
$rc = (rand(1,62)) - 1;
$ranchc = substr($chars,$rc,1);
$rd = (rand(1,62)) - 1;
$ranchd = substr($chars,$rd,1);
$re = (rand(1,62)) - 1;
$ranche = substr($chars,$re,1);
$rf = (rand(1,62)) - 1;
$ranchf = substr($chars,$rf,1);
$rg = (rand(1,62)) - 1;
$ranchg = substr($chars,$rg,1);
$rh = (rand(1,62)) - 1;
$ranchh = substr($chars,$rh,1);
$ri = (rand(1,62)) - 1;
$ranchi = substr($chars,$ri,1);
$rj = (rand(1,62)) - 1;
$ranchj = substr($chars,$rj,1);
$rk = (rand(1,62)) - 1;
$ranchk = substr($chars,$rk,1);
$rl = (rand(1,62)) - 1;
$ranchl = substr($chars,$rl,1);
$makekey = $rancha.$ranchb.$ranchc.$ranchd.$ranche.$ranchf.$ranchg.$ranchh.$ranchi.$ranchj.$ranchk.$ranchl;
setcookie("person", $username, time()+43200);
setcookie("keys", $makekey, time()+43200);
//UPDATING USER KEY
//mysql_query("UPDATE Users SET Cokey ='$makekey' WHERE Username ='$username'");
$uquery = "UPDATE Users SET Cokey ='$makekey' WHERE Username = ?";
$uid = $conn->prepare($uquery);
$uid->bind_param('s', $username);
$uid->execute();
$uid->close();
$Allowlogin = 11;
}
else {
    //Brutecheck
    $cbquery = "SELECT COUNT(*) AS usernamecount FROM Brute WHERE User = ?";
    $cbch = $conn->prepare($cbquery);
    $cbch->bind_param('s', $username);
    $cbch->bind_result($usernamecount);
    $cbch->execute();
    $cbch->fetch();
    $cbch->close();
    if($usernamecount ==0){
        $bquery = "INSERT INTO Brute (User, block_time) VALUES (?, NOW())";
        $bch = $conn->prepare($bquery);
        $bch->bind_param('s', $username);
        $bch->execute();
        $bch->close();
    }else {
            //als laatste foute login later is dan die daarvoor word de tries counter ge-reset.
            $buquery = "UPDATE Brute SET tries=tries+1, block_time=NOW()  WHERE User = ? AND DATE_ADD(block_time, INTERVAL 30 MINUTE) >= NOW()";
            $buch = $conn->prepare($buquery);
            $buch->bind_param('s', $username);
            $buch->execute();
            $buch->close();
            $buuuery = "UPDATE Brute SET tries = 1, block_time=NOW() WHERE User = ? AND DATE_ADD(block_time, INTERVAL 30 MINUTE) < NOW()";
            $buu = $conn->prepare($buuuery);
            $buu->bind_param('s', $username);
            $buu->execute();
            $buu->close();
        }
$Allowlogin = 10;
}
}
else {
$Allowlogin = 9;
}
}
else {
$Allowlogin = 2;
}
/*
}
*/
}
}
else {
$Allowlogin = 8;
}
}
else {
$Allowlogin = 7;
}
}
else {
$Allowlogin = 6;
}
}
else {
$Allowlogin = 5;
}
}
else {
$Allowlogin = 4;
}
if ($Allowlogin ==1){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Foutmelding<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==2){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>U heeft meer dan 5 keer op een rij het wachtwoord fout. U moet minstens een halfuur wachten.<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==3){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Ongeldig IP adres<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==4){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Geen gebruikersnaam en wachtwoord opgegeven<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==5){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Geen gebruikersnaam opgegeven<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==6){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Geen wachtwoord opgegeven<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==7){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Ongeldige karakters in gebruikersnaam<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==8){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Ongeldige karakters in wachtwoord<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==9){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Een dergelijk gebruikersnaam is niet gevonden in de database<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==10){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Onjuist wachtwoord<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
elseif ($Allowlogin ==11){
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='beh'>Welkom ".$username."<BR>Ga door naar <A HREF='beheer.php'>administratieve</A> sectie.</P>";
echo '</BODY>
</HTML>';
}
else {
echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';
include("head.php");
echo '</HEAD>
<BODY>
<H1>Portal</H1>';
echo "<P class='error'>Foutmelding<BR><A HREF='index.php'>terug</A></P>";
echo '</BODY>
</HTML>';
}
?>
