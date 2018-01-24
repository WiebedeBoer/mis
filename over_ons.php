<?php

include("includes/config.php");
if ($connected ==1){

 echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';

$page_url ="over_ons.php";

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

include("includes/inc_page.php");



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
