<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Pagina beheer</H1><P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>

<h2>Contactadres</h2>

<?php

include("connect.php");
if ($connected ==1){

if ($user_cat =="superadmin" || $user_cat =="admin"){


/*ONLY UPDATE*/
if (isset($_POST["bannier"])){
$newtext = $_POST["bannier"];

$enttext = str_replace("&"," ",$newtext);
$apotext = str_replace("'"," ",$enttext);
$mod_text = str_replace('"',' ',$apotext);

if (filter_var($mod_text, FILTER_SANITIZE_STRING)){
/*
mysql_query("UPDATE Seo SET Bannier ='$mod_text' WHERE ID ='1'");
*/
$upquery = "UPDATE Seo SET Contact =? WHERE ID ='1'";
$upid = $conn->prepare($upquery);
$upid->bind_param('s', $modtext);
$upid->execute();
$upid->close();

echo "<P>SEO geupdate</P>";

}
else {
echo "<P class='error'>Banner kwam niet door filter</P>";
}

}

//select
$cquery = "SELECT Contact FROM Seo WHERE ID = '1'";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($contactadres);
$cid->fetch();
$cid->close();

echo '<FORM method="post" action="contact.php" id="myform" name="myform">';
echo '<BR><input type="text" name="bannier" value="'.$contactadres.'">
<BR><input type="submit" value="update" class="knop">
</FORM>';


}

}

?>
</BODY>
</HTML>
