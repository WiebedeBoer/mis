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

echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';

echo '<h2>Nieuws Editor</h2>';

if (isset($_GET["edit"])) {
if (filter_var($_GET["edit"], FILTER_VALIDATE_INT)){
$editor = $_GET["edit"];

$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM News WHERE ID ='$editor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
if ($catcheck ==1){


//edit bericht
if (isset($_POST["bericht"])) {

$newtext = $_POST["bericht"];
$enttext = str_replace("&","&amp;",$newtext);
$apotext = str_replace("'","[apo]",$enttext);
$modtext = str_replace('"','[quot]',$apotext);

if (filter_var($modtext, FILTER_SANITIZE_STRING)){
/*
mysql_query("UPDATE News SET Tekst ='$modtext' WHERE ID ='$editor'");
*/

$upquery = "UPDATE News SET Tekst = ? WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('si', $modtext, $editor);
$upid->execute();
$upid->close();

echo "<P class='zent'>Bericht is aangepast</P>";

}
else {
echo "<P class='error'>Bericht kwam niet door filter</P>";
}

}


//bericht formulier
/*
$result = mysql_query ("SELECT * FROM News WHERE ID ='$editor'");
$row = mysql_fetch_array($result);
$eventtitle = $row["Titel"];
$evenement = $row["Tekst"];
*/

$ccquery = "SELECT Titel, Tekst FROM News WHERE ID = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('i', $editor);
$cid->execute();
$cid->bind_result($eventtitle,$evenement);
$cid->close();

echo "<FORM method='post' action='newseditor.php?edit=".$editor."'>";
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

$viewevenement = str_replace("[apo]","'",$evenement);
$showevenement = str_replace('[quot]','"',$viewevenement);

echo "</table>";
echo "<P>".$eventtitle."
<BR><WRAP><TEXTAREA cols='78' rows='20' name='bericht'>".$showevenement."</TEXTAREA></WRAP>
<BR><input type='submit' value='edit'></P>
</FORM>";




}
else {
echo "<P class='error'>Bericht bestaat niet of is al verwijderd</P>";
}


}
else {
echo "<P class='error'>Geen geldig bericht</P>";
}

}
else {
echo "<P class='error'>Geen geldig bericht</P>";
}


}

?>
</BODY>
</HTML>
