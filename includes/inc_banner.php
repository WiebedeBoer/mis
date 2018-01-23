<?php

/*
$result_bannier = mysql_query("SELECT * FROM Seo WHERE ID ='1'");
$row_bannier = mysql_fetch_array($result_bannier);
$bannier_text = $row_bannier['Bannier'];
*/

//select
$bquery = "SELECT Bannier, Width, Height FROM Seo WHERE ID = ?";
$bid = $conn->prepare($bquery);
$bid->bind_param('i', $search_id);
$bid->execute();
$bid->bind_result($bannier_text, $bannier_width, $bannier_height);
$bid->fetch();
$bid->close();

echo '<img src="pictures/'.$bannier_text.'" class="bannerimage" alt="banner" width="'.$bannier_width.'" height="'.$bannier_height.'">';
?>


