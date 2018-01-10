<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<?php

echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';

if (isset($_GET['ding'])) {
if(filter_var($_GET["ding"], FILTER_VALIDATE_INT)){
$item = $_GET["ding"];

include("connect.php");
if ($connected ==1){

echo '<a href="objecten.php?object='.$item.'" title="monument" class="bl">Terug naar Monument</a>';

$resultitco = mysql_query("SELECT COUNT(*) AS coit FROM Monumenten WHERE ID ='$item'");
$rowitco = mysql_fetch_array($resultitco);
$itemcheck = $rowitco['coit'];

if ($itemcheck ==1){

$resultwco = mysql_query ("SELECT COUNT(*) AS dingcount FROM Pictures WHERE Monument ='$item'");
$rowwco = mysql_fetch_assoc($resultwco);
$dir_check = $rowwco['dingcount'];

$resultpicco = mysql_query ("SELECT MAX(ID) AS picmax FROM Pictures");
$rowpicco = mysql_fetch_assoc($resultpicco);
$pic_check = $rowpicco['picmax'];
$max_pic = $pic_check + 1;

//allowed file types
if (($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/PJPEG") || ($_FILES["file"]["type"] == "image/JPEG") || ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/x-png")){
$filetype = $_FILES["file"]["type"];

//under 10 mb
if ($_FILES["file"]["size"] < 10000000){

if ($_FILES["file"]["error"] > 0) {
echo '<P class="error">Foutmelding Code: ' . $_FILES["file"]["error"] . '</P>';
}
else {

$dirpath = $_SERVER['DOCUMENT_ROOT']."/pictures/";

//thumbnail
if ($dir_check ==0){
//temp
$imagesource = $_FILES["file"]["tmp_name"];

if($filetype == "image/gif"){
$image = imagecreatefromgif($imagesource);
}
elseif($filetype == "image/png" || $filetype == "image/x-png"){
$image = imagecreatefrompng($imagesource);
}
else {
$image = imagecreatefromjpeg($imagesource);
}
$imagewidth = imagesx($image);
$imageheight = imagesy($image);
$new_image = imagecreatetruecolor(250, 250);
imagecopyresampled($new_image, $image, 0, 0, 0, 0, 250, 250, $imagewidth, $imageheight);
$image = $new_image;
imagejpeg($image, $_SERVER['DOCUMENT_ROOT']."/thumbs/".$item.".jpg");

//end thumbnail
}

echo "<P>Temp file: ". $_FILES["file"]["tmp_name"] ."</P>";
echo "<P>Bestandstype: ". $_FILES["file"]["type"] ."</P>";
echo "<P>Grootte: ". round(($_FILES["file"]["size"] / 1024),2) ." Kb</P>";


//move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/pictures/".$max_pic.".jpg");
$imgname = $max_pic.".jpg";







/*START auto resize*/
list($lwidth, $lheight, $ftype, $attr) = getimagesize($_FILES["file"]["tmp_name"]);
$limagesource = $_FILES["file"]["tmp_name"];

if($ftype == "image/gif"){
$limage = imagecreatefromgif($limagesource);
}
elseif($ftype == "image/png" || $ftype == "image/x-png"){
$limage = imagecreatefrompng($limagesource);
}
else {
$limage = imagecreatefromjpeg($limagesource);
}

if ($lwidth >1200 || $lheight >1200){
if ($lwidth >1200 && $lheight >1200){
if ($lwidth > $lheight){
$newwidth =1200;
$lwidthperc = 1200 / $lwidth;
$newheight = round($lwidthperc * $lheight);
}
elseif ($lwidth == $lheight){
$newwidth =1200;
$newheight =1200;
}
else {
$lheightperc = 1200 / $lheight;
$newwidth = round($lheightperc * $lwidth);
$newheight =1200;
}
}
elseif ($lwidth >1200 && $lheight <=1200){
$newwidth =1200;
$lwidthperc = 1200 / $lwidth;
$newheight = round($lwidthperc * $lheight);
}
elseif ($lwidth <=1200 && $lheight >1200){
$lheightperc = 1200 / $lheight;
$newwidth = round($lheightperc * $lwidth);
$newheight =1200;
}

$lwidth = imagesx($limage);
$lheight = imagesy($limage);
$new_limage = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($new_limage, $limage, 0, 0, 0, 0, $newwidth, $newheight, $lwidth, $lheight);
$limage = $new_limage;

$lfilename = $_SERVER['DOCUMENT_ROOT']."/pictures/".$max_pic.".jpg";
imagejpeg ($limage, $lfilename, 100);

}
else {
move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/pictures/".$max_pic.".jpg");
}
/*END auto resize*/









//insert into database
mysql_query("INSERT INTO Pictures (ID, Monument, URL, Width, Height) VALUES ('$max_pic', '$item', '$imgname', '$newwidth', '$newheight')");
//display
echo '<br>Foto geupload';

}

}
else {
echo '<P class="error">Bestand is te groot.
<br>Het bestand mag niet groter zijn dan 10 Megabyte.</P>';


}

}
else {
echo '<P class="error">Ongeldig bestand type.
<br>Bestand moet een van de volgende extensies hebben: gif, png, jpeg</P>';


}





}
else {
echo "<P class='error'>Item not found, or you have selected an invalid item number.</P>";
}

//end connection
}

echo '</div>';

}
else {
echo "<P class='error'>Invalid item integer</P>";
}


}
else {
echo "<P class='error'>Invalid item</P>";
}


?>

</body>
</html>
