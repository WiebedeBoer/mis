<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Pagina beheer</H1><P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>

<?php

include("connect.php");
if ($connected ==1){



//PAGINA VERWIJDEREN
if (isset($_POST["deletion"])) {

if (filter_var($_POST["deletion"], FILTER_VALIDATE_INT)){
$deletor = $_POST["deletion"];

$cocatquery = "SELECT COUNT(*) AS catcount, Verwijderbaar FROM Webcontent WHERE ID = ?";
$cocatid = $conn->prepare($cocatquery);
$cocatid->bind_param('i', $deletor);
$cocatid->execute();
$cocatid->bind_result($catcheck, $webdel);
$cocatid->fetch();
$cocatid->close();

/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Webcontent WHERE ID ='$deletor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/
if ($catcheck ==1){
/*
$resultwpc = mysql_query("SELECT * FROM Webcontent WHERE ID ='$deletor'");
$rowwpc = mysql_fetch_array($resultwpc);
$webdel = $rowwpc['Verwijderbaar'];
*/
if ($webdel ==0){
echo "<P class='error'>Deze pagina mag u niet verwijderen</P>";
}

else {
/*
mysql_query("DELETE FROM Webcontent WHERE ID ='$deletor'");
*/

$dquery = "DELETE FROM Webcontent WHERE ID = ?";
$did = $conn->prepare($dquery);
$did->bind_param('i', $deletor);
$did->execute();
$did->close();

echo "<P>pagina is verwijderd</P>";
}


}
else {
echo "<P class='error'>Pagina bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}




//PAGINA AANMAKEN
if (isset($_POST["makepage"])) {

if (!filter_var($_POST["makepage"], FILTER_SANITIZE_STRING)){
echo "<P class='error'>Naam kwam niet door filter</P>";}
else {

$pagename = $_POST["makepage"];
$enpage = $_POST["enpage"];
$taal = $_POST["taal"];



$dmquery = "SELECT MAX(ID) AS maxid FROM Webcontent";
$dmid = $conn->prepare($dmquery);
$dmid->bind_result($maxid);
$dmid->execute();
$dmid->fetch();
$dmid->close();

$newid = $maxid + 1;

$extraurl ="extra.php?extra=".$newid;

/*
mysql_query("INSERT INTO Webcontent (Pagina, Tekst, Verwijderbaar, URL)
VALUES ('$pagename', 'nog geen tekst', '1', '$extraurl')");
*/

$iquery = "INSERT INTO Webcontent (Pagina, URL, Tekst, Verwijderbaar)
VALUES (?, ?, 'nog geen tekst', '1')";
$ires = $conn->prepare($iquery);
$ires->bind_param('ss', $pagename, $extraurl);
$ires->execute();
$ires->close();

echo "<P>Pagina aangemaakt</P>";

}

}




//PAGINA IN of UIT SCHAKELEN
if (isset($_POST["switchoff"])) {

if (filter_var($_POST["switchoff"], FILTER_VALIDATE_INT) || $_POST["switchoff"]==0){
$switchor = $_POST["switchoff"];

/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Webcontent WHERE ID ='$switchor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/

$cocatquery = "SELECT COUNT(*) AS catcount, Zichtbaar, URL FROM Webcontent WHERE ID = ?";
$cocatid = $conn->prepare($cocatquery);
$cocatid->bind_param('i', $switchor);
$cocatid->execute();
$cocatid->bind_result($catcheck, $switchon, $switchurl);
$cocatid->fetch();
$cocatid->close();

if ($catcheck ==1){

/*
$resultwpc = mysql_query("SELECT * FROM Webcontent WHERE ID ='$switchor'");
$rowwpc = mysql_fetch_array($resultwpc);
$switchon = $rowwpc['Zichtbaar'];
$switchurl = $rowwpc['URL'];
*/

if ($switchurl !="index.php"){

if ($switchon ==1){
/*
mysql_query("UPDATE Webcontent SET Zichtbaar ='0' WHERE ID ='$switchor'");
*/
$upquery = "UPDATE Webcontent SET Zichtbaar ='0' WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('i', $switchor);
$upid->execute();
$upid->close();
echo "<P>Pagina uitgeschakeld</P>";
}
else {
/*
mysql_query("UPDATE Webcontent SET Zichtbaar ='1' WHERE ID ='$switchor'");
*/
$upquery = "UPDATE Webcontent SET Zichtbaar ='1' WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('i', $switchor);
$upid->execute();
$upid->close();


echo "<P>Pagina ingeschakeld</P>";
}

}
else {
echo "<P class='error'>U mag deze pagina niet uitschakelen</P>";
}

}
else {
echo "<P class='error'>Pagina bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}









//PAGINA VOLGORDE
if (isset($_POST["moveup"]) && isset($_POST["moveit"])) {

if (filter_var($_POST["moveup"], FILTER_VALIDATE_INT) || $_POST["moveup"] ==0){
$movor = $_POST["moveup"];

if (filter_var($_POST["moveit"], FILTER_VALIDATE_INT)){
$movit = $_POST["moveit"];
/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Webcontent WHERE ID ='$movit'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/

$cocatquery = "SELECT COUNT(*) AS catcheck FROM Webcontent WHERE ID = ?";
$cocatid = $conn->prepare($cocatquery);
$cocatid->bind_param('i', $movit);
$cocatid->execute();
$cocatid->bind_result($catcheck);
$cocatid->fetch();
$cocatid->close();


if ($catcheck ==1){
/*
mysql_query("UPDATE Webcontent SET Volgorde ='$movor' WHERE ID ='$movit'");
*/
$upquery = "UPDATE Webcontent SET Volgorde ='$movor' WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('i', $movit);
$upid->execute();
$upid->close();


echo "<P>Pagina verschoven in menu</P>";

}
else {
echo "<P class='error'>Pagina bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}


















echo '<H3 class="module">Pagina beheer</H3>';

echo '<table class="tabel"><tr><th>Pagina Naam</th><th>Volgorde</th><th>Zichtbaar</th><th>Verwijderbaar</th></tr>';

/*
$resultwpg = mysql_query("SELECT * FROM Webcontent ORDER BY Pagina");
while ($rowwpg = mysql_fetch_array($resultwpg))
  {
*/

$mwquery = "SELECT * FROM Webcontent ORDER BY Pagina";
$result_wpg = $conn->query($mwquery);
while ($rowwpg = $result_wpg->fetch_assoc())
  {
$webid = $rowwpg['ID'];
$weburl = $rowwpg['URL'];
$webname = $rowwpg['Pagina'];
$webverwijder = $rowwpg['Verwijderbaar'];
$webzichtbaar = $rowwpg['Zichtbaar'];
$webord = $rowwpg['Volgorde'];

echo '<tr>';



if ($weburl =="extra.php?extra="){
echo '<td><A HREF="../extra.php?extra='.$webid.'" TARGET="_blank">'.$webname.'</A></td>';
}
else {
echo '<td><A HREF="../'.$weburl.'" TARGET="_blank">'.$webname.'</A></td>';
}


echo '<td><FORM method="post" action="paginabeheer.php"><INPUT type="text" value="'.$webord.'" name="moveup"><INPUT type="hidden" value="'.$webid.'" name="moveit"><INPUT type="submit" value="wijzigen"></FORM></td>';


if ($weburl =="index.php"){
echo '<td>geen schakelaar</td>';
}
else {
if ($webzichtbaar ==1){
echo '<td><FORM method="post" action="paginabeheer.php"><INPUT type="hidden" value="'.$webid.'" name="switchoff"><INPUT type="submit" value="uitschakelen"></FORM></td>';
}
else {
echo '<td><FORM method="post" action="paginabeheer.php"><INPUT type="hidden" value="'.$webid.'" name="switchoff"><INPUT type="submit" value="inschakelen"></FORM></td>';
}
}

if ($webverwijder ==1){
echo '<td><FORM method="post" action="paginabeheer.php"><INPUT type="hidden" value="'.$webid.'" name="deletion"><INPUT type="submit" value="verwijder"></FORM></td>';
}
else {
echo '<td>geen delete</td>';
}

echo '</tr>';
  }
echo "</table>";



echo "<H3 class='module'>Extra Pagina maken</H3>";
echo "<FORM method='post' action='paginabeheer.php'>
<P>Pagina naam (NL): <INPUT type='text' name='makepage' maxlength='45' length='45'>
<BR><INPUT type='submit' value='maak aan'></P></FORM>";



/*
//SQL CONNECTIE SLUITEN
//mysql_close($con);
*/
}

?>
</BODY>
</HTML>
