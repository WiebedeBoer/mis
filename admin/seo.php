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

echo '<h1>Beheer</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){


/*ONLY UPDATE*/
if (isset($_POST["titel"]) && isset($_POST["describe"]) && isset($_POST["searchterms"])){
$newtitle = $_POST["titel"];
$newtext = $_POST["searchterms"];
$new_destext = $_POST["describe"];

$enttext = str_replace("&"," ",$newtext);
$apotext = str_replace("'"," ",$enttext);
$mod_text = str_replace('"',' ',$apotext);


$ent_destext = str_replace("&"," ",$new_destext);
$apo_destext = str_replace("'"," ",$ent_destext);
$mod_des_text = str_replace('"',' ',$apo_destext);

$ent_title = str_replace("&"," ",$newtitle);
$apo_title = str_replace("'"," ",$ent_title);
$mod_title = str_replace('"',' ',$apo_title);


if (filter_var($mod_text, FILTER_SANITIZE_STRING)){

if (filter_var($mod_des_text, FILTER_SANITIZE_STRING)){

if (filter_var($mod_title, FILTER_SANITIZE_STRING)){

/*
mysql_query("UPDATE Seo SET Zoektermen ='$mod_text', Beschrijving ='$mod_des_text' WHERE ID ='1'");
*/

$upquery = "UPDATE Seo SET Titel = ?, Zoektermen =?, Beschrijving =? WHERE ID ='1'";
$upid = $conn->prepare($upquery);
$upid->bind_param('sss', $mod_title, $mod_text, $mod_des_text);
$upid->execute();
$upid->close();

echo "<P>SEO geupdate</P>";

}
else {

echo "<P class='error'>Titel kwam niet door filter</P>";
}

}
else {

echo "<P class='error'>Beschrijving kwam niet door filter</P>";
}

}
else {

echo "<P class='error'>Zoektermen kwamen niet door filter</P>";
}

}

/*
$resultpho = mysql_query("SELECT * FROM Seo WHERE ID ='1'");
$rowpho = mysql_fetch_array($resultpho);
$describe_text = $rowpho['Beschrijving'];
$searchterms_text = $rowpho['Zoektermen'];
*/

$wquery = "SELECT Titel, Beschrijving, Zoektermen FROM Seo WHERE ID = '1'";
$wid = $conn->prepare($wquery);
$wid->execute();
$wid->bind_result($titel, $describe_text, $searchterms_text);
$wid->fetch();
$wid->close();

echo '<FORM method="post" action="seo.php" id="myform" name="myform">';
echo '
<BR><WRAP><TEXTAREA cols="78" rows="20" name="titel" class="tabel">'.$titel.'</TEXTAREA></WRAP>
<BR><WRAP><TEXTAREA cols="78" rows="20" name="describe" class="tabel">'.$describe_text.'</TEXTAREA></WRAP>
<BR><WRAP><TEXTAREA cols="78" rows="20" name="searchterms" class="tabel">'.$searchterms_text.'</TEXTAREA></WRAP>
<BR><input type="submit" value="update" class="knop">
</FORM>';




}

}

?>
</BODY>
</HTML>
