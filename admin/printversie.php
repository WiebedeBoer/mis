<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<P style="color:#0000ff"><A HREF="beheer.php">Terug</A> naar beheer</P>
<?php

include("connect.php");
if ($connected ==1){

echo '<h1>Cursisten en Betalingen</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){


if (isset($_GET['edit'])) {

echo '<P><A HREF="inschrijving.php">Terug</A> naar overzicht</P>';


if (filter_var($_GET["edit"], FILTER_VALIDATE_INT)){
$paginanum = $_GET["edit"];

$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Cursus WHERE ID ='$paginanum'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
if ($catcheck >=1){



$result = mysql_query ("SELECT * FROM Cursus WHERE ID ='$paginanum'");
$row = mysql_fetch_array($result);
$eventtitle = $row["Titel"];

echo '<h2>'.$eventtitle.'</h2>';


















$resultcocu = mysql_query("SELECT COUNT(*) AS catcount FROM Cursisten WHERE Cursus ='$paginanum'");
$rowcocu = mysql_fetch_array($resultcocu);
$cursistcheck = $rowcocu['catcount'];
if ($cursistcheck >=1){




echo '<button onclick="myFunction()">Print deze pagina</button>

<script>
function myFunction() {
    window.print();
}
</script>';



echo '<table><tr><th colspan="2">Naam</th><th>Taal</th><th>IL</th><th colspan="2">Overig</th></tr>';
$resultcc = mysql_query("SELECT * FROM Cursisten WHERE Cursus ='$paginanum' ORDER BY Achternaam");
while ($rowcc = mysql_fetch_array($resultcc))
  {
$cid = $rowcc['ID'];
$voornaam = $rowcc['Voornaam'];
$achternaam = $rowcc['Achternaam'];
$rekening = $rowcc['Rekening'];
$betaling = $rowcc['Betaling'];
$r_datum = $rowcc['Registratie'];


$r_land = $rowcc['Landcode'];
$r_il = $rowcc['IL'];

if ($r_il ==0){
$il_code ="no";}
else {
$il_code ="yes";}

echo '<tr><td>'.$voornaam.'</td><td>'.$achternaam.'</td><td>'.$r_land.'</td><td>'.$il_code.'</td><td>'.$rekening.'</td><td>'.$betaling.'</td></tr>';
  }
echo '</table>';
}
else {
echo "<P class='error'>Nog geen cursisten</P>";
}



}
else {
echo "<P class='error'>geen cursus</P>";
}

}
else {
echo "<P class='error'>ongeldig cursus id nummer</P>";
}

}
else {

//cursussen
$resultco = mysql_query ("SELECT COUNT(*) AS usercount FROM Cursus");
$rowco = mysql_fetch_assoc($resultco);
$usercheck = $rowco["usercount"];

if ($usercheck >=1){
echo "<table class='tabel'><tr><th>Titel</th><th>Datum</th><th>Cursisten</th></tr>";
$result = mysql_query ("SELECT * FROM Cursus ORDER BY Titel ASC, ID DESC");
while ($row = mysql_fetch_assoc($result))
  {
$newsnum = $row["ID"];
$newstitle = $row["Titel"];
$n_dag = $row["Dag"];
$n_maand = $row["Maand"];
$n_jaar = $row["Jaar"];

echo "<tr><td><A HREF='inschrijving.php?edit=".$newsnum."'>".$newstitle."</A></td>
<td>(".$n_dag."-".$n_maand."-".$n_jaar.")</td>";

$resultcocu = mysql_query("SELECT COUNT(*) AS catcount FROM Cursisten WHERE Cursus ='$newsnum'");
$rowcocu = mysql_fetch_array($resultcocu);
$cursistcheck = $rowcocu['catcount'];

echo "<td class='dis'>".$cursistcheck."</td></tr>";
  }
echo "</table>";
}
else {
echo "<P class='error'>Nog geen cursussen</P>";

}


}








}



}

?>
</BODY>
</HTML>
