<?php

if (isset($_GET["page"])) {
if (filter_var($_GET["page"], FILTER_VALIDATE_INT)){
$page_id = $_GET["page"];

$result_pag_co = mysql_query("SELECT COUNT(*) AS acount FROM Webcontent WHERE ID ='$page_id'");
$row_pag_co = mysql_fetch_assoc($result_pag_co);
$page_check = $row_pag_co["acount"];
if ($page_check ==1){

$result_pag = mysql_query("SELECT * FROM Webcontent WHERE ID ='$page_id'");
$row_pag = mysql_fetch_assoc($result_pag);
$page_naam = $row_pag["Pagina"];
$page_tekst = $row_pag["Tekst"];

echo '<h2>'.$page_naam.'</h2>';

include("inc_rep_entity.php");

echo $h3emessage;

}
else {
echo '<p class="error">Page not found</p>';
}

}
else {
echo '<p class="error">Invalid page number</p>';
}

}
else {
echo '<p class="error">Invalid page handle</p>';
}

?>
