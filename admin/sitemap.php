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

echo '<h1>Beheer</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){

if (isset($_POST["url"]) && isset($_POST["changefreq"])){
$newurl = $_POST["url"];
$newfre = $_POST["changefreq"];


}


echo '<FORM method="post" action="sitemap.php" id="myform" name="myform">';
echo '
<BR>URL <INPUT type="text" name="url" maxlength="80" length="80">
<BR>Change Frequency <SELECT size=1 name="changefreq">
<option value="daily">daily</option>
<option value="weekly">weekly</option>
<option value="monthly">monthly</option>
<option value="yearly">yearly</option>
</SELECT>
<BR><input type="submit" value="add" class="knop">
</FORM>';




}

}

?>
</BODY>
</HTML>
