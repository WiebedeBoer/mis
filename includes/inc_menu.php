<?php

/*
echo '<div class="link_menu">';

echo '<div class="art-bar art-nav">
<div class="art-nav-outer">';
*/

/*
$result_pagf = mysql_query("SELECT * FROM Webcontent");
while ($row_pagf = mysql_fetch_assoc($result_pagf))
  {
$page_cat_id = $row_pagf["ID"];
*/

echo '<ul class="sidenav">';

$mquery = "SELECT * FROM Webcontent";
$result_pagf = $conn->query($mquery);
while ($row_pagf = $result_pagf->fetch_assoc())
  {
$page_cat_id = $row_pagf["ID"];

//main links


if ($row_pagf["URL"] ==$page_url){

echo '
<li><a href="'.$row_pagf["URL"].'" title="'.$row_pagf["Pagina"].'" class="active">
'.$row_pagf["Pagina"].'
</a></li>';

}
else {

echo '
<li><a href="'.$row_pagf["URL"].'" title="'.$row_pagf["Pagina"].'">
'.$row_pagf["Pagina"].'
</a></li>';


}




  }
  
echo '</ul>';

/*
echo '
</div>
</div>';

echo '</div>';
*/








?>
