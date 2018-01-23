<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>admin</title>
<META NAME="description" CONTENT="admin"/>
<META NAME="keywords" CONTENT="admin">
<META NAME="author" CONTENT="Wiebe de Boer">
<META NAME="copyright" CONTENT="2017, Wiebe de Boer">
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<meta http-equive="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/png" href="../favicon.png">
<link rel="stylesheet" type="text/css" href="../styles/cms_style3.css">
<style>
a.bl {color:#ff0000 !important;}
a.br {color:#ff0000 !important;}
</style>
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

<H1 class="indexer">Tekst Editor</H1>
<P><A HREF="beheer.php">Terug</A> naar beheer</P>
<P><A HREF="editor.php">Terug</A> naar editor</P>

<?php

include("connect.php");
if ($connected ==1){


if (isset($_GET['pagina'])) {
if (filter_var($_GET["pagina"], FILTER_VALIDATE_INT)){
$paginanum = $_GET["pagina"];

$cocatquery = "SELECT COUNT(*) AS catcount FROM Webcontent WHERE ID = ?";
$cocatid = $conn->prepare($cocatquery);
$cocatid->bind_param('i', $paginanum);
$cocatid->execute();
$cocatid->bind_result($catcheck);
$cocatid->fetch();
$cocatid->close();

/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Webcontent WHERE ID ='$paginanum'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/
if ($catcheck >=1){


/*ONLY UPDATE TEXT*/
if (isset($_POST["messagetext"])){
$newtext = $_POST["messagetext"];

//$enttext = str_replace("&","&amp;",$newtext);
$apotext = str_replace("'","[apo]",$newtext);
$modtext = str_replace('"','[quot]',$apotext);
//$htmtext = htmlentities($modtext,ENT_NOQUOTES,BIG5);

$aatext = str_replace("á",'&eacute;',$modtext);
$autext = str_replace('ä','&euml;',$aatext);
$agtext = str_replace("à",'&egrave;',$autext);

$eatext = str_replace("é",'&eacute;',$agtext);
$eutext = str_replace('ë','&euml;',$eatext);
$egtext = str_replace("è",'&egrave;',$eutext);

$iatext = str_replace("í",'&iacute;',$egtext);
$iutext = str_replace('ï','&iuml;',$iatext);
$igtext = str_replace("ì",'&igrave;',$iutext);

$uatext = str_replace("í",'&iacute;',$igtext);
$uutext = str_replace('ï','&iuml;',$uatext);
$ugtext = str_replace("ì",'&igrave;',$uutext);

if (filter_var($modtext, FILTER_SANITIZE_STRING)){
/*
mysql_query("UPDATE Webcontent SET Tekst ='$ugtext' WHERE ID ='$paginanum'");
*/

$upquery = "UPDATE Webcontent SET Tekst =? WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('si', $ugtext, $paginanum);
$upid->execute();
$upid->close();

echo "<P>Tekst geupdate</P>";

}
else {
echo "<P class='error'>Tekst kwam niet door filter</P>";
}

}



if (isset($_POST["description"]) && isset($_POST["searchterms"]) ){
$new_dexription = $_POST["description"];
$new_searchterms = $_POST["searchterms"];

$upquery = "UPDATE Webcontent SET Beschrijving =?, Zoektermen =? WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('ssi', $new_dexription, $new_searchterms, $paginanum);
$upid->execute();
$upid->close();

echo "<P>SEO geupdate</P>";

}





/*
$resultpho = mysql_query("SELECT * FROM Webcontent WHERE ID ='$paginanum'");
$rowpho = mysql_fetch_array($resultpho);
$pagnaam = $rowpho['Pagina'];
$pagtext = $rowpho['Tekst'];
$pagurl = $rowpho['URL'];
*/

/*fetch*/
$wquery = "SELECT Pagina, Tekst, URL, Beschrijving, Zoektermen FROM Webcontent WHERE ID = ?";
$wid = $conn->prepare($wquery);
$wid->bind_param('i', $paginanum);
$wid->execute();
$wid->bind_result($pagnaam, $pagtext, $pagurl, $beschrijving, $zoektermen);
$wid->fetch();
$wid->close();




/*display*/
if ($pagurl =="extra.php?extra="){
echo "<H3><A HREF='../extra.php?extra=".$paginanum."' TARGET='_blank'>".$pagnaam."</A></H3>";
}
else {
echo "<H3><A HREF='../".$pagurl."' TARGET='_blank'>".$pagnaam."</A></H3>";
}


echo '<h2>Page SEO Editor</h2>';

echo '<FORM method="post" action="paginaeditor.php?pagina='.$paginanum.'">';
echo '<BR><WRAP><TEXTAREA cols="78" rows="3" name="description" class="tabel">'.$beschrijving.'</TEXTAREA></WRAP>
<BR><WRAP><TEXTAREA cols="78" rows="3" name="searchterms" class="tabel">'.$zoektermen.'</TEXTAREA></WRAP>
<BR><input type="submit" value="update" class="knop">
</FORM>';



echo '<h2>Page Text Editor</h2>';


$viewtext = str_replace("[apo]","'",$pagtext);
$showtext = str_replace('[quot]','"',$viewtext);

echo '<table border="0" class="tabel">';

echo '
<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[b][/b]'<?php echo ')"><IMG src="editor/bold.gif" border="0" alt="vetgedrukt" title="vetgedrukt" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[i][/i]'<?php echo ')"><IMG src="editor/italic.gif" border="0" alt="cursief" title="cursief" class="editor"></a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'[u][/u]'<?php echo ')"><IMG src="editor/underline.gif" border="0" alt="onderlijnen" title="onderlijnen" class="editor"></a>
</td><td>
<a href="foto_maker.php" target="_blank"><IMG src="editor/insertimage.gif" border="0" alt="foto" title="foto" class="editor"></a>
</td><td>
<IMG src="editor/createlink.gif" border="0" alt="link" title="link" class="editor"></a>
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




echo '<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;aacute;'<?php echo ')">&aacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;auml;'<?php echo ')">&auml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;agrave;'<?php echo ')">&agrave;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;eacute;'<?php echo ')">&eacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;euml;'<?php echo ')">&euml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;egrave;'<?php echo ')">&egrave;</a>
</td><td>
&nbsp;
</td></tr>';


echo '<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;aacute;'<?php echo ')">&amp;aacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;auml;'<?php echo ')">&amp;auml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;agrave;'<?php echo ')">&amp;agrave;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;eacute;'<?php echo ')">&amp;eacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;euml;'<?php echo ')">&amp;euml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;egrave;'<?php echo ')">&amp;egrave;</a>
</td><td>
&nbsp;
</td></tr>';


echo '<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;iacute;'<?php echo ')">&iacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;iuml;'<?php echo ')">&iuml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;igrave;'<?php echo ')">&igrave;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;uacute;'<?php echo ')">&uacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;uuml;'<?php echo ')">&uuml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;ugrave;'<?php echo ')">&ugrave;</a>
</td><td>
&nbsp;
</td></tr>';


echo '<tr><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;oacute;'<?php echo ')">&amp;oacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;ouml;'<?php echo ')">&amp;ouml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;ograve;'<?php echo ')">&amp;ograve;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;uacute;'<?php echo ')">&amp;uacute;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;uuml;'<?php echo ')">&amp;uuml;</a>
</td><td>
<a href="#" onClick="insertAtCursor(document.myform.messagetext, ';?>'&amp;ugrave;'<?php echo ')">&amp;ugrave;</a>
</td><td>
&nbsp;
</td></tr>';

echo "</table>";




echo '<FORM method="post" action="paginaeditor.php?pagina='.$paginanum.'" id="myform" name="myform">';
echo '<BR><WRAP><TEXTAREA cols="78" rows="20" name="messagetext" id="messagetext" class="tabel">'.htmlspecialchars($showtext).'</TEXTAREA></WRAP>
<BR><input type="submit" value="update" class="knop">
</FORM>';



}
else {
echo "<P class='error'>Pagina niet gevonden</P>";
}

}
else {
echo "<P class='error'>Ongeldige integer</P>";
}

}
else {
echo "<P class='error'>Pagina niet gevonden</P>";
}



}

?>
</BODY>
</HTML>
