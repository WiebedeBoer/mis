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
if (isset($_POST["bannier"]) && isset($_POST["width"]) && isset($_POST["height"])){
$newtext = $_POST["bannier"];
$newwidth = $_POST["width"];
$newheight = $_POST["height"];

//var_dump($newwidth);

$enttext = str_replace("&"," ",$newtext);
$apotext = str_replace("'"," ",$enttext);
$mod_text = str_replace('"',' ',$apotext);

if (filter_var($mod_text, FILTER_SANITIZE_STRING)){
if (filter_var($newwidth, FILTER_VALIDATE_INT)){
if (filter_var($newheight, FILTER_VALIDATE_INT)){
/*
mysql_query("UPDATE Seo SET Bannier ='$mod_text' WHERE ID ='1'");
*/
$upquery = "UPDATE Seo SET Bannier =?, Width =?, Height =? WHERE ID ='1'";
$upid = $conn->prepare($upquery);
$upid->bind_param('sii', $mod_text, $newwidth, $newheight);
$upid->execute();
$upid->close();
/*
$paginanum = 1;
$upquery = "UPDATE Seo SET Bannier =? WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('si', $ugtext, $paginanum);
$upid->execute();
$upid->close();
*/

echo "<P>banner geupdate</P>";

}
else {
echo "<P class='error'>invalid integer</P>";
}

}
else {
echo "<P class='error'>invalid integer</P>";
}

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

        $bquery = "SELECT Bannier, Width, Height FROM Seo WHERE ID ='1'";
        $bid = $conn->prepare($bquery);
        $bid->execute();
        $bid->bind_result($bannier_text, $bannier_width, $bannier_height);
        $bid->fetch();
        $bid->close();


echo '<FORM method="post" action="banner.php" id="myform" name="myform">';
echo '<BR>Banner: <input type="text" name="bannier" value="'.$bannier_text.'">
<BR>Width: <input type="text" name="width" value="'.$bannier_width.'">
<BR>Height: <input type="text" name="height" value="'.$bannier_height.'">
<BR><input type="submit" value="update" class="knop">
</FORM>';



}

}

?>
</BODY>
</HTML>
