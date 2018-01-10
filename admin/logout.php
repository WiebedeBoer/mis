<?php

$userid = $_COOKIE['person'];
$makekey = $_COOKIE['key'];
setcookie("person", $userid, time()-43200);
setcookie("keys", $makekey, time()-43200);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<H1>Beheer Logout</H1>
<P class="beh">U bent uitgelogd.
<BR>Terug naar <A HREF="index.php">Login</A></P>
</BODY>
</HTML>
