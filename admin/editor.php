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

echo '<h1>Pagina Tekst Editor</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){



echo "<H3 class='module'>Teksteditor</H3>";


$cocatquery = "SELECT COUNT(*) AS catcount FROM Webcontent";
$cocatid = $conn->prepare($cocatquery);
$cocatid->execute();
$cocatid->bind_result($catcount);
$cocatid->fetch();
$cocatid->close();

//paginas editor
/*
$resultcopag = mysql_query("SELECT COUNT(*) AS catcount FROM Webcontent");
$rowcopag = mysql_fetch_array($resultcopag);
$pagcheck = $rowcopag['catcount'];
*/
if ($catcount >=1){
echo '<table class="tabel"><tr><th>Pagina</th></tr>';
/*
$resultpho = mysql_query("SELECT * FROM Webcontent ORDER BY Pagina");
while ($rowpho = mysql_fetch_array($resultpho))
  {
*/
$mwquery = "SELECT * FROM Webcontent ORDER BY Pagina";
$result_wpg = $conn->query($mwquery);
while ($rowpho = $result_wpg->fetch_assoc())
  {
$pagina_id = $rowpho['ID'];
$pagina_naam = $rowpho['Pagina'];
//$pagina_engels = $rowpho['En_titel'];
echo '<tr>
<td><A HREF="paginaeditor.php?pagina='.$pagina_id.'" title="'.$pagina_naam.'">'.$pagina_naam.'</A></td>
</tr>';

//<td><A HREF="paginaeditor.php?pagina='.$pagina_id.'&lang=en" title="'.$pagina_engels.'">'.$pagina_engels.'</A></td>

  }
echo '</table>';
}
else {
echo '<P class="centmarg"><B>Pagina Teksteditor</B><BR>Tabel is nog leeg</P>';
}







}




}

?>
</BODY>
</HTML>
