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

if ($user_cat =="superadmin" || $user_cat =="admin"){

echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';

echo '<a href="cursus.php" title="Cursus" class="bl">Terug naar Cursussen</a>';

echo '<h2>Cursus Editor</h2>';

if (isset($_GET["edit"])) {
if (filter_var($_GET["edit"], FILTER_VALIDATE_INT)){
$editor = $_GET["edit"];

$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Cursus WHERE ID ='$editor'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
if ($catcheck ==1){








if (($_FILES["file"]["type"] == "application/doc") || ($_FILES["file"]["type"] == "application/docx") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "application/rtf")){
 if ($_FILES["file"]["size"] < 10000000){
   if ($_FILES["file"]["error"] > 0)
     {
     echo "<P class='error'>Foutmelding Code: " . $_FILES["file"]["error"] . "<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
     }
   else
     {
$rfilename = $_FILES["file"]["name"];
$qfilename = str_replace("'","_",$rfilename);
$_FILES["file"]["name"] = $qfilename;

     echo "<P>Upload: " . $_FILES["file"]["name"] . "</P>";
     echo "<P>Bestandstype: " . $_FILES["file"]["type"] . "</P>";
     echo "<P>Grootte: " . ($_FILES["file"]["size"] / 1024) . " Kb</P>";
     echo "<P>Temp file: " . $_FILES["file"]["tmp_name"] . "</P>";

    if (file_exists("../files/" . $_FILES["file"]["name"]))
       {
       echo "<P class='error'>Het ". $_FILES["file"]["name"] ." bestand bestaat al.<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
       }
     else
       {
       move_uploaded_file($_FILES["file"]["tmp_name"], "../files/" . $_FILES["file"]["name"]);
       $tabstoragename = $_FILES["file"]["name"];
       $tabfullname = "../files/" . $_FILES["file"]["name"];
       $imgsize = $_FILES["file"]["size"];

       mysql_query("INSERT INTO Opematte (Newstitle, Newsdate, Newsbrief)
       VALUES ('0', '0', '$tabfullname')");
       echo "<P>Grootte (in Bytes): ".$imgsize."</P>";
       echo "<P>Opgeslagen in: " . "../files/" . $_FILES["file"]["name"] ."</P>";
       echo "<P>Terug naar <A HREF='briefmaker.php'>nieuwsbrief</A></P>";
       }
     }   /*copyright wiebe eling de boer*/

}
else {
echo "<P class='error'>Bestand is te groot. Het bestand mag niet groter zijn dan 10 Megabyte.<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
}

}
else {
echo "<P class='error'>Ongeldig bestand type. Bestand moet een van de volgende extensies hebben: doc, docx, pdf, rtf<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
}









}
else {
echo "<P class='error'>Bericht bestaat niet of is al verwijderd</P>";
}


}
else {
echo "<P class='error'>Geen geldig bericht</P>";
}

}
else {
echo "<P class='error'>Geen geldig bericht</P>";
}

}

}

?>
</BODY>
</HTML>
