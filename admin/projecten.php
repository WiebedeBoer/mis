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

echo '<h2>Projecten</h2>';

echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';



if (isset($_POST["num"]) && isset($_POST["kruisje"])){

if(!filter_var($_POST["kruisje"], FILTER_SANITIZE_STRING)){
echo '<P class="error">Check kwam niet door de filter<BR></P>';
}
else {

if(!filter_var($_POST["num"], FILTER_VALIDATE_INT)){
echo '<P class="error">ID kwam niet door de filter<BR></P>';
}
else {
$kruisje = $_POST["kruisje"];
$num = $_POST["num"];

mysql_query("UPDATE Projecten SET Kruis ='$kruisje' WHERE ID ='$num'");

echo '<p>aangepast</p>';
}
}
}







$result_pagc = mysql_query("SELECT COUNT(*) AS proc FROM Projecten");
$row_pagc = mysql_fetch_assoc($result_pagc);
$proj_count = $row_pagc["proc"];

if ($proj_count >=1){

echo '<table><tr><th>Persoon</th><th>E-mailadres</th><th>Onderwerp</th><th>Check</th></tr>';

$result_pagf = mysql_query("SELECT * FROM Projecten");
while ($row_pagf = mysql_fetch_assoc($result_pagf))
  {
$proj_id = $row_pagf["ID"];
$proj_pers = $row_pagf["Persoon"];
$proj_mail = $row_pagf["Email"];
$proj_subj = $row_pagf["Onderwerp"];
$proj_chec = $row_pagf["Kruis"];

$moddedmessage = substr($proj_subj,1,24);

echo '<tr><td>'.$proj_pers.'</td><td>'.$proj_mail.'</td><td>'.$moddedmessage.'...</td><td><form method="post" action="projecten.php"><input type="hidden" name="num" value="'.$proj_id.'"><input type="text" name="kruisje" value="'.$proj_check.'"></form></td></tr>';

  }
echo '</table>';

}

}


}

?>
</BODY>
</HTML>
