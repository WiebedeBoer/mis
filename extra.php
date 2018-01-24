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
<div class="body">';

echo '<div id="top"><div id="header">';
include("includes/inc_banner.php");
echo '</div></div>';

echo '<div id="main">';

echo '<div class="mobmenu"><button class="dropbtn" id="myBtn">Menu</button><div class="mobmenu-content" id="myDropdown">';
include("includes/inc_menu.php");
echo '</div></div>';

echo '<div class="content">';

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
$pid->bind_param('s', $extraurl);
$pid->execute();
$pid->bind_result($page_tekst,$pagnaam);
$pid->fetch();
$pid->close();

echo '<H1 class="main">'.$pagnaam.'</H1>';

include 'includes/inc_rep_entity.php';
echo $h3emessage;
}
}

echo '</div>';
echo '</div>';

echo '<div id="bottom"><div id="footer">';


include("includes/inc_bottom.php");

echo '</div></div>';

echo '</div>
        <script>
        document.getElementById("myBtn").onclick = function() {open()};

        document.getElementById("activebtn").onclick = function() {close()};

        function open() {
                document.getElementById("myDropdown").classList.toggle("show");
        }
        function close() {
                document.getElementById("myDropdown").classList.toggle("show");
                document.getElementById("myDropdown").classList.toggle("hide");

        }
</script>
</BODY>
</HTML>';

}

?>
