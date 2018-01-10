<?php

include("includes/config.php");
if ($connected ==1){

 echo '<!DOCTYPE HTML>
<HTML>
<HEAD>';

$page_url ="contact.php";

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

include("includes/inc_page.php");

echo '</div>';

echo '<div class="container_contact">';

include("includes/inc_contact_form.php");

echo '</div>';

echo '<div class="container_bottom">';


include("includes/inc_bottom.php");

echo '</div>';


echo '</div>
</BODY>
</HTML>';

}

?>
