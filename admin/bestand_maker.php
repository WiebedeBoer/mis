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

/*
$resultre = mysql_query ("SELECT * FROM Bestanden WHERE ID ='$verwijdersoort'");
$rowre = mysql_fetch_assoc($resultre);
$bestand_loc = $rowre["URL"];
*/

$ccquery = "SELECT URL FROM Bestanden WHERE ID = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('i', $verwijdersoort);
$cid->execute();
$cid->bind_result($bestand_loc);
$cid->close();

$fileurl = $_SERVER["DOCUMENT_ROOT"].$bestand_loc;
unlink($fileurl);

/*
mysql_query("DELETE FROM Bestanden WHERE ID ='$verwijdersoort'");
*/

$dequery = "DELETE FROM Bestanden WHERE ID = ?";
$did = $conn->prepare($dequery);
$did->bind_param('i', $verwijdersoort);
$did->execute();
$did->close();

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



/*
$resultc = mysql_query ("SELECT COUNT(*) soortco FROM Bestanden");
$rowc = mysql_fetch_assoc($resultc);
$soort_check = $rowc["soortco"];
*/

$ccquery = "SELECT COUNT(*) soortcheck FROM Bestanden";
$cid = $conn->prepare($ccquery);
$cid->execute();
$cid->bind_result($soortcheck);
$cid->close();

if ($soortcheck >=1){

echo '<table class="tabel"><th>Bestand URL</th><th>Verwijder</th>';
/*
$result = mysql_query ("SELECT * FROM Bestanden ORDER BY URL");
while ($row = mysql_fetch_assoc($result))
*/
$lquery = "SELECT * FROM Bestanden ORDER BY URL";
$result_pagg = $conn->query($lquery);
while ($row = $result_pagg->fetch_assoc())
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
//mysql_close($con);
}

?>
</BODY>
</HTML>
