<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<?php

if (isset($_GET["obj"])) {
if(filter_var($_GET["obj"], FILTER_VALIDATE_INT)){
$ding = $_GET["obj"];



if (isset($_COOKIE["person"]) && isset($_COOKIE["key"])){
echo '<p class="beh"><a href="beheer.php">Ga door</a> naar object</p>';

}
else {

echo '<h1>Administratief</h1>
<form method="POST" action="portal.php">
<table class="inlog">
<tr><td class="inl">Gebruikersnaam: </td><td class="inl"><input type="text" size="20" maxlength="20" name="username" /></td></tr>
<tr><td class="inl">Wachtwoord: </td><td class="inl"><input type="password" size="20" maxlength="20" name="password" /></td></tr>
<tr><td class="inl">&nbsp;</td><td class="inl"><input type="submit" value="login" /></td></tr>
</table>
</form>';



}



}
}

?>
</BODY>
</HTML>
