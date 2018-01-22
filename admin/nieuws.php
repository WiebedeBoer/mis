<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
<script>
function insertAtCursor(myField, myValue) {
    //IE support
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    //MOZILLA and others
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
            + myValue
            + myField.value.substring(endPos, myField.value.length);
    } else {
        myField.value += myValue;
    }
}
</script>
</HEAD>
<BODY>
<?php

include("connect.php");
if ($connected ==1){

echo '<p style="color:#0000ff"><a href="beheer.php" title="Beheer" class="bl">Terug</a> naar Beheer</p>';

echo '<h2>Nieuws</h2>';

//maak bericht
if (isset($_POST["nieuwstitel"]) && isset($_POST["bericht"])) {

if (filter_var($_POST["nieuwstitel"], FILTER_SANITIZE_STRING)){

$newtext = $_POST["bericht"];
$enttext = str_replace("&","&amp;",$newtext);
$apotext = str_replace("'","[apo]",$enttext);
$modtext = str_replace('"','[quot]',$apotext);

if (filter_var($modtext, FILTER_SANITIZE_STRING)){

$rawtitle = $_POST["nieuwstitel"];


$checknamelength = strlen("$rawtitle");
if ($checknamelength <81){



$dag = date("d");
$maand = date("m");
$jaar = date("Y");

$datum = $dag."-".$maand."-".$jaar;
/*
mysql_query("INSERT INTO News (Titel, Datum, Tekst)
VALUES ('$rawtitle', '$datum', '$modtext')");
*/

        $iquery = "INSERT INTO News (Titel, Datum, Tekst) VALUES (?, ?, ?)";
        $iid = $conn->prepare($iquery);
        $iid->bind_param('sss', $rawtitle, $datum, $modtext);
        $iid->execute();
        $iid->fetch();
        $iid->close();

echo "<P class='zent'>Bericht gemaakt</P>";

}
else {
echo "<P class='error'>Titel is te lang</P>";
}

}
else {
echo "<P class='error'>Bericht kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>Titel kwam niet door filter</P>";
}



}


//verwijder bericht
if (isset($_POST["deletion"])) {

if (filter_var($_POST["deletion"], FILTER_VALIDATE_INT)){
$deletor = $_POST["deletion"];
/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM News WHERE ID ='$deletor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/
$ccquery = "SELECT COUNT(*) AS catcheck FROM News WHERE ID = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('i', $deletor);
$cid->execute();
$cid->bind_result($catcheck);
$cid->fetch();
$cid->close();
if ($catcheck ==1){
/*
mysql_query("DELETE FROM News WHERE ID ='$deletor'");
*/
$dequery = "DELETE FROM News WHERE ID = ?";
$did = $conn->prepare($dequery);
$did->bind_param('i', $deletor);
$did->execute();
$did->fetch();
$did->close();

echo "<P class='zent'>Nieuwsbericht is verwijderd</P>";
}
else {
echo "<P class='error'>Nieuwsbericht bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}

//bericht formulier
echo "<FORM method='post' action='nieuws.php'>";
echo '<table border="0" class="tabel">';

echo '
<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[b][/b]'<?php echo ')"><IMG src="editor/bold.gif" border="0" alt="vetgedrukt" title="vetgedrukt" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[i][/i]'<?php echo ')"><IMG src="editor/italic.gif" border="0" alt="cursief" title="cursief" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[u][/u]'<?php echo ')"><IMG src="editor/underline.gif" border="0" alt="onderlijnen" title="onderlijnen" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[img][/img]'<?php echo ')"><IMG src="editor/insertimage.gif" border="0" alt="foto" title="foto" class="editor"></a>
</td><td>
<IMG src="editor/createlink.gif" border="0" alt="link" title="link" class="editor">
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[ul][li][/li][/ul]'<?php echo ')"><IMG src="editor/unorderedlist.gif" border="0" alt="lijst" title="lijst" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[table][tr][td][/td][/tr][/table]'<?php echo ')"><IMG src="editor/table.gif" border="0" alt="tabel" title="tabel" class="editor"></a>
</td></tr>';

echo "<tr><td>
[b][/b]
</td><td>
[i][/i]
</td><td>
[u][/u]
</td><td>
[img][/img]
</td><td>
[url =''][/url]
</td><td>
[ul][li][/li][/ul]
</td><td>
[table][tr][td][/td][/tr][/table]
</td></tr>";


echo '
<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[h1][/h1]'<?php echo ')">Kopje 1</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[h2][/h2]'<?php echo ')">Kopje 2</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[h3][/h3]'<?php echo ')">Kopje 3</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[h4][/h4]'<?php echo ')">Kopje 4</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[h5][/h5]'<?php echo ')">Kopje 5</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[right][/right]'<?php echo ')">Rechts</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[center][/center]'<?php echo ')">Centreren</a>
</td></tr>';

echo "<tr><td>
[h1][/h1]
</td><td>
[h2][/h2]
</td><td>
[h3][/h3]
</td><td>
[h4][/h4]
</td><td>
[h5][/h5]
</td><td>
[right][/right]
</td><td>
[center][/center]
</td></tr>";

echo "</table>";

echo "<P>Titel: <INPUT type='text' name='nieuwstitel'>
<BR>Bericht: <WRAP><TEXTAREA cols='78' rows='20' name='bericht'></TEXTAREA></WRAP>
<BR><input type='submit' value='maak bericht'>
</P></FORM>";

//berichten
/*
$resultco = mysql_query ("SELECT COUNT(*) AS usercount FROM News");
$rowco = mysql_fetch_assoc($resultco);
$usercheck = $rowco["usercount"];
*/

$cocatquery = "SELECT COUNT(*) AS usercheck FROM News";
$cocatid = $conn->prepare($cocatquery);
$cocatid->execute();
$cocatid->bind_result($usercheck);
$cocatid->fetch();
$cocatid->close();

if ($usercheck >=1){
echo "<table class='tabel'>";
/*
$result = mysql_query ("SELECT * FROM News ORDER BY ID DESC LIMIT 0,50");
while ($row = mysql_fetch_assoc($result))
*/
$lquery = "SELECT * FROM News ORDER BY ID DESC LIMIT 0,50";
$result_pagg = $conn->query($lquery);
while ($row = $result_pagg->fetch_assoc())
  {
$newsnum = $row["ID"];
$newstitle = $row["Titel"];
$newdate = $row["Datum"];
echo "<tr><td><A HREF='newseditor.php?edit=".$newsnum."'>".$newstitle."</A> (".$newdate.")</td>
<td class='dis'><FORM method='post' action='nieuws.php'>
<input type='hidden' value='".$newsnum."' name='deletion'>
<input type='submit' value='delete'></FORM></td></tr>";
  }
echo "</table>";
}
else {
echo "<P class='error'>Nog geen nieuws</P>";
}










}

?>
</BODY>
</HTML>
