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

$cquery = "SELECT Domein FROM SEO WHERE ID ='1'";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($domein);
$cid->fetch();
$cid->close();

$lquery = "INSERT INTO `Sitemap` (`URL`, `Freq`) VALUES (?, ?)";
$lid = $conn->prepare($lquery);
$lid->bind_param('ss', $newurl, $newfre);
$lid->execute();
$lid->close();

$write_txt '&lt;urlset&gt;';

$mwquery = "SELECT * FROM Sitemap ORDER BY ID";
$result_wpg = $conn->query($mwquery);
while ($rowwpg = $result_wpg->fetch_assoc())
  {
$weburl = $rowwpg['URL'];
$webfre = $rowwpg['Freq'];

$write_txt= $write_txt.'&lt;url>
&lt;loc&gt;'.$domein.'/&lt;'.$weburl.'/loc&gt;
&lt;lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H").':'.date("i").':'.date("s").'+00:00&lt;/lastmod&gt;
&lt;changefreq>'.$webfre.'&lt;/changefreq&gt;
&lt;/url&gt;';
   }

$write_txt= $write_txt.'&lt;/urlset&gt;';

$myfile = fopen("../sitemap.xml", "w") or die("Unable to open file!");
fwrite($myfile, $write_txt);
fclose($myfile);


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
