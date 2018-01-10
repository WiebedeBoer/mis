<?php

/*op monument*/
if (isset($_GET["monument"])) {
if (filter_var($_GET["monument"], FILTER_VALIDATE_INT)){
$s_nummer = $_GET["monument"];

echo '<div class="container_activity">';

echo "Hier vindt u een overzicht van de georganiseerde activiteiten voor dit monument.";

echo '</div>';

echo '<div class="container_nieuws">';

//berichten
$resultnco = mysql_query ("SELECT COUNT(*) AS usercount FROM Activities WHERE Monument ='$s_nummer'");
$rownco = mysql_fetch_assoc($resultnco);
$nwcheck = $rownco["usercount"];

if ($nwcheck >=1){

$resultnw = mysql_query ("SELECT * FROM Activities WHERE Monument ='$s_nummer' ORDER BY ID DESC");
while ($rownw = mysql_fetch_assoc($resultnw))
  {
$newsnum = $rownw["ID"];
$newstitle = $rownw["Titel"];
$newdate = $rownw["Datum"];
$monument_id = $rownw["Monument"];
$page_tekst = $rownw["Tekst"];
$act_foto = $rownw["Foto"];
$width = $rownw["Width"];
$height = $rownw["Height"];

$result_monu = mysql_query("SELECT * FROM Monumenten WHERE ID ='$monument_id'");
$row_monu = mysql_fetch_assoc($result_monu);
$fetch_monument = $row_monu["Monument"];

$monument_naam = str_replace("[apo]","'",$fetch_monument);

include("inc_rep_entity.php");

/*
echo '<div class="activity_item"><div class="activity_inner">
<h3><b>'.$newstitle.'</b> <i>('.$newdate.')</i></h3>
<p><a href="objecten.php?object='.$monument_id.'">'.$monument_naam.'</a></p>
<p>'.$h3emessage.'</p>';
*/

echo '<div class="activity_item"><div class="activity_inner">
<h3><b>'.$newstitle.'</b></h3>
<p><a href="objecten.php?object='.$monument_id.'">'.$monument_naam.'</a></p>
<p>'.$h3emessage.'</p>';

if ($act_foto ==1){
echo '<img src="activity/'.$newsnum.'.jpg" class="activity_thb" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px;height:'.$height.'px;">';}
echo '</div></div>';
  }

}
else {
echo '<P class="error">Nog geen activiteiten</P>';
}





}
else {
echo "<P class='error'>Geen geldig ID nummer</P>";
}


echo '</div>';

}
/*op soort*/
elseif (isset($_GET["soort"])) {
if (filter_var($_GET["soort"], FILTER_VALIDATE_INT)){
$s_nummer = $_GET["soort"];

echo '<div class="container_activity">';

echo "Hier vindt u een overzicht van de georganiseerde activiteiten van dit soort.";

echo '</div>';

//filters
include("includes/inc_soort_filters.php");

echo '<div class="container_nieuws">';

//berichten
$resultnco = mysql_query ("SELECT COUNT(*) AS usercount FROM Activities WHERE Soort ='$s_nummer'");
$rownco = mysql_fetch_assoc($resultnco);
$nwcheck = $rownco["usercount"];

if ($nwcheck >=1){

$resultnw = mysql_query ("SELECT * FROM Activities WHERE Soort ='$s_nummer' ORDER BY ID DESC");
while ($rownw = mysql_fetch_assoc($resultnw))
  {
$newsnum = $rownw["ID"];
$newstitle = $rownw["Titel"];
$newdate = $rownw["Datum"];
$monument_id = $rownw["Monument"];
$page_tekst = $rownw["Tekst"];
$act_foto = $rownw["Foto"];
$width = $rownw["Width"];
$height = $rownw["Height"];

$result_monu = mysql_query("SELECT * FROM Monumenten WHERE ID ='$monument_id'");
$row_monu = mysql_fetch_assoc($result_monu);
$fetch_monument = $row_monu["Monument"];

$monument_naam = str_replace("[apo]","'",$fetch_monument);

include("inc_rep_entity.php");

echo '<div class="activity_item"><div class="activity_inner">
<h3><b>'.$newstitle.'</b> </h3>
<p><a href="objecten.php?object='.$monument_id.'">'.$monument_naam.'</a></p>
<p>'.$h3emessage.'</p>';
if ($act_foto ==1){
echo '<img src="activity/'.$newsnum.'.jpg" class="activity_thb" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px;height:'.$height.'px;">';}
echo '</div></div>';
  }

}
else {
echo '<P class="error">Nog geen activiteiten</P>';
}





}
else {
echo "<P class='error'>Geen geldig ID nummer</P>";
}


echo '</div>';

}
/*op plaats*/
elseif (isset($_GET["plaats"])) {
if (filter_var($_GET["plaats"], FILTER_VALIDATE_INT)){
$s_nummer = $_GET["plaats"];

echo '<div class="container_activity">';

echo "Hier vindt u een overzicht van de georganiseerde activiteiten van deze plaats.";

echo '</div>';

//filters
include("includes/inc_soort_filters.php");

echo '<div class="container_nieuws">';

//berichten
$resultnco = mysql_query ("SELECT COUNT(*) AS usercount FROM Activities WHERE Plaats ='$s_nummer'");
$rownco = mysql_fetch_assoc($resultnco);
$nwcheck = $rownco["usercount"];

if ($nwcheck >=1){

$resultnw = mysql_query ("SELECT * FROM Activities WHERE Plaats ='$s_nummer' ORDER BY ID DESC");
while ($rownw = mysql_fetch_assoc($resultnw))
  {
$newsnum = $rownw["ID"];
$newstitle = $rownw["Titel"];
$newdate = $rownw["Datum"];
$monument_id = $rownw["Monument"];
$page_tekst = $rownw["Tekst"];
$act_foto = $rownw["Foto"];
$width = $rownw["Width"];
$height = $rownw["Height"];

$result_monu = mysql_query("SELECT * FROM Monumenten WHERE ID ='$monument_id'");
$row_monu = mysql_fetch_assoc($result_monu);
$fetch_monument = $row_monu["Monument"];

$monument_naam = str_replace("[apo]","'",$fetch_monument);

include("inc_rep_entity.php");

echo '<div class="activity_item"><div class="activity_inner">
<h3><b>'.$newstitle.'</b> </h3>
<p><a href="objecten.php?object='.$monument_id.'">'.$monument_naam.'</a></p>
<p>'.$h3emessage.'</p>';
if ($act_foto ==1){
echo '<img src="activity/'.$newsnum.'.jpg" class="activity_thb" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px;height:'.$height.'px;">';}
echo '</div></div>';
  }

}
else {
echo '<P class="error">Nog geen activiteiten</P>';
}





}
else {
echo "<P class='error'>Geen geldig ID nummer</P>";
}


echo '</div>';

}
/*default*/
else {

echo '<div class="container_activity">';
$page_url ="activiteiten.php";
include("includes/inc_page.php");
echo '</div>';

//filters
include("includes/inc_soort_filters.php");


echo '<div class="container_nieuws">';

//berichten
$resultnco = mysql_query ("SELECT COUNT(*) AS usercount FROM Activities");
$rownco = mysql_fetch_assoc($resultnco);
$nwcheck = $rownco["usercount"];

if ($nwcheck >=1){

$resultnw = mysql_query ("SELECT * FROM Activities WHERE Sticky ='1' ORDER BY ID DESC");
while ($rownw = mysql_fetch_assoc($resultnw))
  {
$newsnum = $rownw["ID"];
$newstitle = $rownw["Titel"];
$newdate = $rownw["Datum"];
$monument_id = $rownw["Monument"];
$page_tekst = $rownw["Tekst"];
$act_foto = $rownw["Foto"];
$width = $rownw["Width"];
$height = $rownw["Height"];

$result_monu = mysql_query("SELECT * FROM Monumenten WHERE ID ='$monument_id'");
$row_monu = mysql_fetch_assoc($result_monu);
$fetch_monument = $row_monu["Monument"];

$monument_naam = str_replace("[apo]","'",$fetch_monument);

include("inc_rep_entity.php");

echo '<div class="activity_item"><div class="activity_inner">
<h3><b>'.$newstitle.'</b> </h3>
<p><a href="objecten.php?object='.$monument_id.'">'.$monument_naam.'</a></p>
<p>'.$h3emessage.'</p>';
if ($act_foto ==1){
echo '<img src="activity/'.$newsnum.'.jpg" class="activity_thb" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px;height:'.$height.'px;">';}
echo '</div></div>';
  }

}
else {
echo '<P class="error">Nog geen activiteiten</P>';
}

echo '</div>';

}

?>
