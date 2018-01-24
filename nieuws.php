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

echo '<div class="mobmenu"><button class="dropbtn" id="myBtn">Menu</button><div class="mobmenu-content" id="myDropdown">';
include("includes/inc_menu.php");
echo '</div></div>';

echo '<div class="content"><div id="newswrap"><div id="newsfeed">';

include("includes/inc_page.php");

include("includes/inc_news.php");

echo '</div><div id="twitterfeed">';

echo '
<a class="twitter-timeline" href="https://twitter.com/WordPress?ref_src=twsrc%5Etfw" data-tweet-limit="3">Tweets by WordPress</a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
';

echo '</div></div>';


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
