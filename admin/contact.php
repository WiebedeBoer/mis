<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Pagina beheer</H1><P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>

<h2>Contactadres</h2>

<?php

include("connect.php");
if ($connected ==1){

if ($user_cat =="superadmin" || $user_cat =="admin"){

//select
$cquery = "SELECT Contact FROM Seo WHERE ID = '1'";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($contactadres);
$cid->fetch();
$cid->close();


}

}

?>
</BODY>
</HTML>
