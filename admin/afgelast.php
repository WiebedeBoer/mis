<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>
<?php

include("connect.php");
if ($connected ==1){

echo '<h1>Cursus Aflasten</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){



//afgelast bericht
if (isset($_POST["deletion"]) && isset($_POST["bericht"]) && isset($_POST["en_bericht"])) {

if (filter_var($_POST["deletion"], FILTER_VALIDATE_INT)){
$deletor = $_POST["deletion"];

$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Cursus WHERE ID ='$deletor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
if ($catcheck ==1){

$c_result = mysql_query ("SELECT * FROM Cursus WHERE ID ='$deletor'");
$c_row = mysql_fetch_assoc($c_result);
$c_title = $c_row["Titel"];
$c_en_title = $c_row["En_titel"];

mysql_query("UPDATE Cursus SET Aflasting ='1' WHERE ID ='$deletor'");


$resultccu = mysql_query("SELECT COUNT(*) AS curcount FROM Cursisten WHERE Cursus ='$deletor'");
$rowccu = mysql_fetch_array($resultccu);
$cursisten_check = $rowccu["curcount"];

if ($cursisten_check >=1){

$p_mail ="pakua@live.nl";

$subject ="Studiecentrum Pa Kua Cursus Aflasting";
$en_subject ="Study Centre Pa Kua Course Cancellation";

$fullmessage ="(dit is een automatisch bericht) ".$_POST["bericht"];
$en_fullmessage ="(this is an automatic cancellation message) ".$_POST["en_bericht"];


$resultcu = mysql_query("SELECT * FROM Cursisten WHERE Cursus ='$deletor'");
while ($rowcu = mysql_fetch_array($resultcu))
  {
$mail = $rowcu['Mail'];
$nation = $rowcu['Nationaliteit'];
if ($nation =="en"){
mail($mail,$en_subject,$en_fullmessage,"From: $p_mail");}
else {
mail($mail,$subject,$fullmessage,"From: $p_mail");}
  }

echo "<P class='zent'>afgelast en automatische aflasting mailtjes verzonden</P>";

}
else {
echo "<P class='zent'>afgelast</P>";
}


}
else {
echo "<P class='error'>cursus bestaat niet</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}


$resultco = mysql_query ("SELECT COUNT(*) AS usercount FROM Cursus");
$rowco = mysql_fetch_assoc($resultco);
$usercheck = $rowco["usercount"];

if ($usercheck >=1){
echo "<table class='tabel'><tr><th>Titel</th><th>Datum</th></tr>";
$result = mysql_query ("SELECT * FROM Cursus ORDER BY Titel ASC, ID DESC");
while ($row = mysql_fetch_assoc($result))
  {
$newsnum = $row["ID"];
$newstitle = $row["Titel"];
$dag = $row["Dag"];
$maand = $row["Maand"];
$jaar = $row["Jaar"];
$aflasting = $row["Aflasting"];

echo '<tr>';
echo '<td><A HREF="cursus_editor.php?edit='.$newsnum.'">'.$newstitle.'</A></td>
<td>('.$dag.'-'.$maand.'-'.$jaar.')</td>';



echo '</tr>';
  }
echo "</table>";


}
else {
echo "<P class='error'>Nog geen cursussen</P>";
}




echo '<h2>Aflasten</h2>';

echo "<FORM method='post' action='cursus.php'>
<p>Cursus: <select name='deletion'>";
$resultc = mysql_query ("SELECT * FROM Cursus WHERE Aflasting ='0' ORDER BY Titel ASC, ID DESC");
while ($rowc = mysql_fetch_assoc($resultc))
  {
$newsnumc = $rowc["ID"];
$newstitlec = $rowc["Titel"];
echo '<option value="'.$newsnumc.'">'.$newstitlec.'</option>';
 }
echo "</select>";

echo "<br>bericht (nl):
<br><WRAP><TEXTAREA cols='78' rows='20' name='bericht'></TEXTAREA></WRAP>
<br>bericht (en):
<br><WRAP><TEXTAREA cols='78' rows='20' name='en_bericht'></TEXTAREA></WRAP>";

echo "<br><input type='submit' value='aflasten'></p></FORM>";





}



}

?>
</BODY>
</HTML>
