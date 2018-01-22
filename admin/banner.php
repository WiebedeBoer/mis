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
if (isset($_POST["bannier"])){
$newtext = $_POST["bannier"];

$enttext = str_replace("&"," ",$newtext);
$apotext = str_replace("'"," ",$enttext);
$mod_text = str_replace('"',' ',$apotext);

if (filter_var($mod_text, FILTER_SANITIZE_STRING)){
/*
mysql_query("UPDATE Seo SET Bannier ='$mod_text' WHERE ID ='1'");
*/
$upquery = "UPDATE Seo SET Bannier =? WHERE ID ='1'";
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

/*
$resultpho = mysql_query("SELECT * FROM Seo WHERE ID ='1'");
$rowpho = mysql_fetch_array($resultpho);
$bannier_text = $rowpho['Bannier'];
*/

        $bquery = "SELECT Bannier FROM Seo WHERE ID ='1'";
        $bid = $conn->prepare($bquery);
        $bid->execute();
        $bid->bind_result($bannier_text);
        $bid->fetch();
        $bid->close();


echo '<FORM method="post" action="banner.php" id="myform" name="myform">';
echo '<BR><input type="text" name="bannier" value="'.$bannier_text.'">
<BR><input type="submit" value="update" class="knop">
</FORM>';



}

}

?>
</BODY>
</HTML>
