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

echo '<h1>Bestanden</h1>';

echo '<p style="color:#0000ff"><a href="beheer.php" title="Beheer" class="bl">Terug</a> naar Beheer</p>';

//verwijder
if (isset($_POST["verwijdersoort"])){
if (filter_var($_POST["verwijdersoort"], FILTER_VALIDATE_INT)){
$verwijdersoort = $_POST["verwijdersoort"];

$resultre = mysql_query ("SELECT * FROM Bestanden WHERE ID ='$verwijdersoort'");
$rowre = mysql_fetch_assoc($resultre);
$bestand_loc = $rowre["URL"];

$fileurl = $_SERVER["DOCUMENT_ROOT"].$bestand_loc;
unlink($fileurl);

mysql_query("DELETE FROM Bestanden WHERE ID ='$verwijdersoort'");

echo "<p>bestand verwijderd</p>";
}
else {
echo "<p class='error'>ID kwam niet door filter</p>";
}
}


//upload
echo "<form action='bestand_loader.php' method='post' enctype='multipart/form-data'> <label for='file'>Bestand:</label>
<input type='file' name='file' id='file' />  <input type='submit' name='submit' value='upload' />
</form>";




$resultc = mysql_query ("SELECT COUNT(*) soortco FROM Bestanden");
$rowc = mysql_fetch_assoc($resultc);
$soort_check = $rowc["soortco"];
if ($soort_check >=1){

echo '<table class="tabel"><th>Bestand URL</th><th>Verwijder</th>';
$result = mysql_query ("SELECT * FROM Bestanden ORDER BY URL");
while ($row = mysql_fetch_assoc($result))
  {
$idnummer = $row["ID"];
$bestand_url = $row["URL"];

echo '<tr><td><a href="http://pakua.nl'.$bestand_url.'">'.$bestand_url.'</a></td><td class="dis"><form method="POST" action="bestand_maker.php"><input type="hidden" value="'.$idnummer.'" name="verwijdersoort"><input type="submit" value="verwijder" class="rem" /></form></td></tr>';

  }
echo '</table>';

}
else {
echo '<P class="error">nog geen bestanden geupload</P>';
}



//SQL CONNECTIE SLUITEN
mysql_close($con);
}

?>
</BODY>
</HTML>
