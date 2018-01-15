<?php

include("includes/config.php");
if ($connected ==1){

echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';

$page_url ="aanmelden.php";

include("includes/inc_head.php");

echo '</HEAD>
<BODY>
<div class="page_full">';

echo '<div class="container_top">';
include("includes/inc_banner.php");
echo '</div>';

echo '<div class="container_menu">';
include("includes/inc_menu.php");
echo '</div>';

echo '<div class="container_main">';

if (isset($_GET["extra"])){
if (filter_var($_GET["extra"], FILTER_VALIDATE_INT)){
$paginanum = $_GET["extra"];

$extraurl ="extra.php?extra=".$paginanum;

/*
$resultpho = mysql_query("SELECT * FROM Webcontent WHERE PageURL ='$extraurl' AND Categorie ='extra'");
$rowpho = mysql_fetch_array($resultpho);
$pagnaam = $rowpho['Contentname'];
$rawpagetext = $rowpho['Content'];
*/

$pquery = "SELECT Tekst, Pagina FROM Webcontent WHERE URL = ?";
$pid = $conn->prepare($pquery);
$pid->bind_param('s', $page_url);
$pid->execute();
$pid->bind_result($rawpagetext,$pagnaam);
$pid->fetch();
$pid->close();

echo '<H1 class="main">'.$pagnaam.'</H1>';

include 'includes/inc_rep_entity.php';
echo $riemessage;
}
}

echo '</div>';

echo '<div class="container_bottom">';


include("includes/inc_bottom.php");

echo '</div>';

echo '</div>
</BODY>
</HTML>';

}

?>
