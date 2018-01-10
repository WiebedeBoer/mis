<?php


echo '<div class="link_menu">';

echo '<div class="art-bar art-nav">
<div class="art-nav-outer">';

/*
$result_pagf = mysql_query("SELECT * FROM Webcontent");
while ($row_pagf = mysql_fetch_assoc($result_pagf))
  {
$page_cat_id = $row_pagf["ID"];
*/

$mquery = "SELECT * FROM Webcontent";
$result_pagf = $conn->query($mquery);
while ($row_pagf = $result_pagf->fetch_assoc())
  {
$page_cat_id = $row_pagf["ID"];

//main links


if ($row_pagf["URL"] ==$page_url){

echo '<div class="mel_sel">
<a href="'.$row_pagf["URL"].'" title="'.$row_pagf["Pagina"].'" class="s_menu_link">
'.$row_pagf["Pagina"].'
</a></div>';

}
else {

echo '<div class="mel_un">
<a href="'.$row_pagf["URL"].'" title="'.$row_pagf["Pagina"].'" class="menu_link">
'.$row_pagf["Pagina"].'
</a></div>';


}




  }

echo '
</div>
</div>';

echo '</div>';








?>
