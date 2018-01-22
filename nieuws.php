<?php

include("includes/config.php");
if ($connected ==1){

 echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';

$page_url ="nieuws.php";

include("includes/inc_head.php");

echo '</HEAD>
<BODY>
<div class="body">';

echo '<div id="top"><div id="header">';
include("includes/inc_banner.php");
echo '</div></div>';

echo '<div id="main">';

echo '<div class="mobmenu"><button class="dropbtn">Menu</button><div class="mobmenu-content">';
include("includes/inc_menu.php");
echo '</div></div>';

echo '<div class="content">';

include("includes/inc_page.php");

include("includes/inc_news.php");

echo '</div>';


echo '</div>';

echo '<div id="bottom"><div id="footer">';


include("includes/inc_bottom.php");

echo '</div></div>';


echo '</div>
</BODY>
</HTML>';
}
?>
