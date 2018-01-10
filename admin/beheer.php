<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<?php

include("connect.php");
if ($connected ==1){

echo '<h1>Beheer</h1>';


if ($user_cat =="superadmin" || $user_cat =="admin"){

echo '<h2>Pagina Beheer</h2>';

echo '<p class="beh"><a href="paginabeheer.php" title="Pagina Beheer" class="bl">Pagina Beheer</a></p>';

echo '<p class="beh"><a href="editor.php" title="Pagina Tekst Editor" class="bl">Pagina Tekst Editor</a></p>';

echo '<h2>Overig</h2>';

echo '<p class="beh"><a href="projecten.php" title="Projecten" class="bl">Projecten</a></p>';

echo '<p class="beh"><a href="deelnemers.php" title="Deelnemers" class="bl">Deelnemers</a></p>';

echo '<p class="beh"><a href="banner.php" title="Banner" class="bl">Banner</a></p>';

echo '<p class="beh"><a href="seo.php" title="SEO" class="bl">SEO</a></p>';

echo '<h2>Nieuws</h2>';

echo '<p class="beh"><a href="nieuws.php" title="Nieuws" class="bl">Nieuws</a></p>';

echo '<h2>Bestanden</h2>';

echo '<p class="beh"><a href="bestand_maker.php" title="Bestanden" class="bl">Bestanden (b.v. voorwaarden)</a></p>';

echo '<h2>Foto Bestanden</h2>';

echo '<p class="beh"><a href="fotos.php" title="Foto Bestanden" class="bl">Foto Bestanden</a></p>';

echo '<h2>Gebruikers</h2>';

echo '<p class="beh"><a href="users.php" title="Gebruikers" class="bl">Gebruikers</a></p>';

echo '<h2>Account</h2>';

echo '<p class="beh"><a href="logout.php" title="Logout" class="bl">Logout</a></p>';

}
elseif($user_cat =="superuser"){


echo '<h2>Nieuws</h2>';

echo '<p class="beh"><a href="nieuws.php" title="Nieuws" class="bl">Nieuws</a></p>';

echo '<h2>Gebruikers</h2>';

echo '<p class="beh"><a href="users.php" title="Gebruikers" class="bl">Gebruikers</a></p>';

echo '<h2>Account</h2>';

echo '<p class="beh"><a href="logout.php" title="Logout" class="bl">Logout</a></p>';

}
else {


echo '<h2>Gebruikers</h2>';

echo '<p class="beh"><a href="users.php" title="Gebruikers" class="bl">Gebruikers</a></p>';

echo '<h2>Account</h2>';

echo '<p class="beh"><a href="logout.php" title="Logout" class="bl">Logout</a></p>';

}


echo '<h2>Help</h2>';

echo '<p class="beh"><a href="https://www.youtube.com/watch?v=FsaKtVIG2cg" target="_blank" title="help" class="bl">Tutorial Video</a></p>';

}
else {
echo 'unconnected';
}

?>
</BODY>
</HTML>
