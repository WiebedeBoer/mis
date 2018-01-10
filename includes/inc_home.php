<?php



//COUNT USER
$pcquery = "SELECT COUNT(*) AS pcount FROM Webcontent WHERE URL = ?";
$pcid = $conn->prepare($pcquery);
$pcid->bind_param('s', $page_url);
$pcid->execute();
$pcid->bind_result($pcount);
$pcid->fetch();
$pcid->close();

/*
$result_pag_co = mysql_query("SELECT COUNT(*) AS acount FROM Webcontent WHERE URL ='$page_url'");
$row_pag_co = mysql_fetch_assoc($result_pag_co);
$page_check = $row_pag_co["acount"];
if ($page_check ==1){

$result_pag = mysql_query("SELECT * FROM Webcontent WHERE URL ='$page_url'");
$row_pag = mysql_fetch_assoc($result_pag);
$page_tekst = $row_pag["Tekst"];
$page_naam = $row_pag["Pagina"];
*/




if ($pcount ==1){

$pquery = "SELECT Tekst, Pagina FROM Webcontent WHERE URL = ?";
$pid = $conn->prepare($pquery);
$pid->bind_param('s', $page_url);
$pid->execute();
$pid->bind_result($page_tekst,$page_naam);
$pid->fetch();
$pid->close();

include("inc_rep_entity.php");

echo $h3emessage;

}
else {
echo '<p class="error">Page not found</p>';
}


?>
