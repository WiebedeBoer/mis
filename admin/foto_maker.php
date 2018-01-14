<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Tekst Editor</H1><P><A HREF="beheer.php">Terug</A> naar beheer</P>

<?php

include("connect.php");
if ($connected ==1){





echo "<form action='foto_loader.php' method='post' enctype='multipart/form-data'> <label for='file'>Bestand:</label>
<input type='file' name='file' id='file' />  <input type='submit' name='submit' value='upload' />
</form>";



//SQL CONNECTIE SLUITEN
//mysql_close($con);
}

?>
</BODY>
</HTML>
