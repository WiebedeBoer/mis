<?php

include("includes/config.php");

if ($connected ==1){

echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';

$page_url ="index.php";

include("includes/inc_head.php");

echo '</HEAD>
<BODY>
<div class="body">';

echo '<div class="top"><div class="header">';
include("includes/inc_banner.php");
echo '</div></div>';

echo '<div class="main">';

echo '<div class="mobmenu">';
include("includes/inc_menu.php");
echo '</div>';

echo '<div class="content">';

include("includes/inc_home.php");

echo '</div>';
echo '</div>';

echo '<div class="bottom"><div id="footer">';

include("includes/inc_bottom.php");

echo '</div></div>';

echo '</div>
</BODY>
</HTML>';

}

?>
