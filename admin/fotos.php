<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<?php

include("connect.php");
if ($connected ==1){

echo '<h1>Beheer</h1>';

echo '<h2>Foto Overzicht</h2>';

echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';

if (isset($_POST["deletion"])){

if (filter_var($_POST["deletion"], FILTER_VALIDATE_INT)){
$deletor = $_POST["deletion"];

$resultcod = mysql_query("SELECT COUNT(*) AS delcount FROM Photos WHERE ID ='$deletor'");
$rowcod = mysql_fetch_array($resultcod);
$delcheck = $rowcod['delcount'];

if ($delcheck ==1){

$resultph = mysql_query("SELECT * FROM Photos WHERE ID ='$deletor'");
$rowph = mysql_fetch_array($resultph);
$phid = $rowph['PhotoID'];

$phname = $rowph['Imgname'];

$phurl = $_SERVER["DOCUMENT_ROOT"]."/pictures/".$phname;


$durl = str_replace(" ","%20",$phurl);
$redurl = str_replace("[quot]","'",$durl);

if (!unlink($redurl)){
echo "<P class='error'>Error bij verwijderen van: ".$redurl."</P>";
}
else {
mysql_query("DELETE FROM Photos WHERE PhotoID ='$deletor'");
echo "<P>Foto ".$redurl." is verwijderd</P>";
}



}
else {
echo "<P class='error'>Foto bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}



echo "<p><form action='foto_loader.php' method='post' enctype='multipart/form-data'> <label for='file'>Bestand:</label>
<input type='file' name='file' id='file' />  <input type='submit' name='submit' value='upload' />
</form></p>";


//display
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Photos");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
if ($catcheck >=1){



$resultsum = mysql_query ("SELECT SUM(Photosize) AS totalsize FROM Photos");
$rowsum = mysql_fetch_assoc($resultsum);
$totalsize = $rowsum['totalsize'];

echo "<table border='0'><tr><td colspan='2'><B>Draaitabel</B></td></tr>
<tr><td>Totaal ruimte gebruik van afbeeldingen</td><td>".$totalsize." bytes</td></tr>
<tr><td>Totaal aantal afbeeldingen</td><td>".$catcheck." afbeeldingen</td></tr>
</table>";




if (isset($_GET["sort"])){

if ($_GET["sort"] =="lastloaded"){

echo "<P><A HREF='fotos.php'>Sorteer op Alfabetische Volgorde</A> | <B><A HREF='fotos.php?sort=lastloaded'>Sorteer op laatst geupload</A></B></P>";


echo "<table border='0'>
<tr><td>URL</td><td>Naam</td><td>Breedte (in pixels)</td><td>Hoogte (in pixels)</td><td>Grootte (in Bytes)</td><td>Verwijderknop</td></tr>";

$resultpho = mysql_query("SELECT * FROM Photos ORDER BY PhotoID DESC");
while ($rowpho = mysql_fetch_array($resultpho))
  {
$photoid = $rowpho['ID'];
$photourl = $rowpho['Imgurl'];
$photoname = $rowpho['Imgname'];
$showname = str_replace("[quot]","'",$photoname);
$photowidth = $rowpho['Width'];
$photoheight = $rowpho['Height'];
$photosize = $rowpho['Photosize'];
$modurl = str_replace("../","http://sociaalgoud.nl/",$photourl);
$rerurl = str_replace(" ","%20",$modurl);
$reurl = str_replace("[quot]","'",$rerurl);

echo "<tr><td class='nowr'>".$reurl."</td><td class='nowr'><A HREF='../pictures/".$showname."' target='_blank' class='notext'>".$showname."</A></td><td class='nowr'>".$photowidth."</td><td class='nowr'>".$photoheight."</td><td class='nowr'>".$photosize."</td><td><FORM method='POST' action='fotos.php'><INPUT type='hidden' value='".$photoid."' name='deletion'><INPUT type='submit' value='verwijder'></FORM></td></tr>";
  }

echo "</table>";

}

}
else {

echo "<P><B><A HREF='fotos.php'>Sorteer op Alfabetische Volgorde</A></B> | <A HREF='fotos.php?sort=lastloaded'>Sorteer op laatst geupload</A></P>";


echo "<table border='0'>
<tr><td>URL</td><td>Naam</td><td>Breedte (in pixels)</td><td>Hoogte (in pixels)</td><td>Grootte (in Bytes)</td><td>Verwijderknop</td></tr>";

$resultpho = mysql_query("SELECT * FROM Photos ORDER BY Imgname");
while ($rowpho = mysql_fetch_array($resultpho))
  {
$photoid = $rowpho['ID'];
$photourl = $rowpho['Imgurl'];
$photoname = $rowpho['Imgname'];
$showname = str_replace("[quot]","'",$photoname);
$photowidth = $rowpho['Width'];
$photoheight = $rowpho['Height'];
$photosize = $rowpho['Photosize'];
$modurl = str_replace("../","http://sociaalgoud.nl/",$photourl);
$rerurl = str_replace(" ","%20",$modurl);
$reurl = str_replace("[quot]","'",$rerurl);

echo "<tr><td class='nowr'>".$reurl."</td><td class='nowr'><A HREF='../pictures/".$showname."' target='_blank' class='notext'>".$showname."</A></td><td class='nowr'>".$photowidth."</td><td class='nowr'>".$photoheight."</td><td class='nowr'>".$photosize."</td><td><FORM method='POST' action='fotos.php'><INPUT type='hidden' value='".$photoid."' name='deletion'><INPUT type='submit' value='verwijder'></FORM></td></tr>";
  }

echo "</table>";

}



}
else {
echo "<P class='error'>Nog geen foto geupload</P>";
}

















}

?>
</BODY>
</HTML>
