<?php
/*
$result_seo = mysql_query("SELECT * FROM Seo WHERE ID ='1'");
$row_seo = mysql_fetch_array($result_seo);
$describe_text = $row_seo['Beschrijving'];
$searchterms_text = $row_seo['Zoektermen'];
*/

//id
$search_id = 1;
//select terms from page
$wquery = "SELECT Beschrijving, Zoektermen FROM Webcontent WHERE URL = ?";
$wid = $conn->prepare($wquery);
$wid->bind_param('s', $page_url);
$wid->execute();
$wid->bind_result($beschrijving, $zoektermen);
$wid->fetch();
$wid->close();
//select terms from site
$cquery = "SELECT Titel, Beschrijving, Zoektermen, Style FROM Seo WHERE ID = ?";
$cid = $conn->prepare($cquery);
$cid->bind_param('i', $search_id);
$cid->execute();
$cid->bind_result($describe_title, $describe_text, $searchterms_text, $stylesheet);
$cid->fetch();
$cid->close();
if ($beschrijving != "leeg" && $beschrijving != $describe_text){$describe_text = $beschrijving;}
if ($zoektermen != "leeg" && $searchterms_text != $describe_text){$searchterms_text = $zoektermen;}
//close connection
//$conn->close();
//var_dump($stylesheet);
//display head
echo '<title>'.$describe_title.'</title>
<META NAME="description" CONTENT="'.$describe_text.'"/>
<META NAME="keywords" CONTENT="'.$searchterms_text.'">
<META NAME="copyright" CONTENT="2018, Wiebe de Boer">
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<meta http-equive="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="styles/'.$stylesheet.'">
<meta name=viewport content="width=device-width, initial-scale=1">
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>';
?>
