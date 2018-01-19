<?php

/*
$result_seo = mysql_query("SELECT * FROM Seo WHERE ID ='1'");
$row_seo = mysql_fetch_array($result_seo);
$describe_text = $row_seo['Beschrijving'];
$searchterms_text = $row_seo['Zoektermen'];
*/

//id
$search_id = 1;

//select
$cquery = "SELECT Titel, Beschrijving, Zoektermen, Style FROM Seo WHERE ID = ?";
$cid = $conn->prepare($cquery);
$cid->bind_param('i', $search_id);
$cid->execute();
$cid->bind_result($describe_title, $describe_text, $searchterms_text, $stylesheet);
$cid->fetch();
$cid->close();
//close connection
//$conn->close();

//display head
echo '<title>'.$describe_title.'</title>
<META NAME="description" CONTENT="'.$describe_text.'"/>
<META NAME="keywords" CONTENT="'.$searchterms_text.'">
<META NAME="copyright" CONTENT="2015, Wiebe de Boer">
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<meta http-equive="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/png" href="favicon.png">
<link rel="stylesheet" type="text/css" href="styles/'.$stylesheet.'.css">
<meta name=viewport content="width=device-width, initial-scale=1">
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>';

?>

