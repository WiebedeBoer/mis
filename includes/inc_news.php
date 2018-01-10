<?php

//berichten
$resultnco = mysql_query ("SELECT COUNT(*) AS usercount FROM News");
$rownco = mysql_fetch_assoc($resultnco);
$nwcheck = $rownco["usercount"];

if ($nwcheck >=1){

$resultnw = mysql_query ("SELECT * FROM News ORDER BY ID DESC LIMIT 0,20");
while ($rownw = mysql_fetch_assoc($resultnw))
  {
$newsnum = $rownw["ID"];
$newstitle = $rownw["Titel"];
$newdate = $rownw["Datum"];
$page_tekst = $rownw["Tekst"];

include("inc_rep_entity.php");

echo '<div class="nieuws_item"><div class="nieuws_inner">
<h3><b>'.$newstitle.'</b> <i>('.$newdate.')</i></h3>
<p>'.$h3emessage.'</p>
</div></div>';
  }

}
else {

if (isset($_GET['lang'])){
if ($_GET['lang'] =="en"){
echo '<P class="error">No news yet</P>';
}
}
else {
echo '<P class="error">Nog geen nieuws</P>';
}
}

?>
