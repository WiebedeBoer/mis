<?php

$moddedmessage = nl2br($page_tekst);
$apomessage = str_replace("[apo]","'",$moddedmessage);
$quotmessage = str_replace('[quot]','"',$apomessage);

$boldmessage = str_replace("[b]","<b>",$quotmessage);
$boldendmessage = str_replace("[/b]","</b>",$boldmessage);
$italicmessage = str_replace("[i]","<i>",$boldendmessage);
$italicendmessage = str_replace("[/i]","</i>",$italicmessage);
$undermessage = str_replace("[u]","<u>",$italicendmessage);
$underendmessage = str_replace("[/u]","</u>",$undermessage);

$centermessage = str_replace("[center]","<p class='central'>",$underendmessage);
$centerendmessage = str_replace("[/center]","</p>",$centermessage);
$rightmessage = str_replace("[right]","<p class='rights'>",$centerendmessage);
$rightendmessage = str_replace("[/right]","</p>",$rightmessage);

$oanchormessage = str_replace("[url ='","<a href='",$rightendmessage);
$canchormessage = str_replace("']","'>",$oanchormessage);
$urlmessage = str_replace("[/url]","</a>",$canchormessage);

$imgmessage = str_replace("[img]","<IMG border='0' src='",$urlmessage);
$imgendmessage = str_replace("[/img]","' />",$imgmessage);

$ulmessage = str_replace("[ul]","<ul>",$imgendmessage);
$ulendmessage = str_replace("[/ul]","</ul>",$ulmessage);
$limessage = str_replace("[li]","<li>",$ulendmessage);
$liendmessage = str_replace("[/li]","</li>",$limessage);

$tabmessage = str_replace("[table]","<table border='0'>",$liendmessage);
$tabemessage = str_replace("[/table]","</table>",$tabmessage);
$trmessage = str_replace("[tr]","<tr>",$tabemessage);
$tremessage = str_replace("[/tr]","</tr>",$trmessage);
$tdmessage = str_replace("[td]","<td>",$tremessage);
$tdemessage = str_replace("[/td]","</td>",$tdmessage);

$h1message = str_replace("[h1]","<h1>",$tdemessage);
$h1emessage = str_replace("[/h1]","</h1>",$h1message);

$h2message = str_replace("[h2]","<h2>",$h1emessage);
$h2emessage = str_replace("[/h2]","</h2>",$h2message);

$eacute = str_replace("Ã©","&eacute;",$h2emessage);

//$eacute = html_entity_decode($h2emessage, ENT_NOQUOTES, 'UTF-8');

$h3message = str_replace("[h3]","<h3>",$eacute);
$h3emessage = str_replace("[/h3]","</h3>",$h3message);






?>
