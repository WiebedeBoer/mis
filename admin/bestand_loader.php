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
echo '<h1>Bestanden</h1>';
echo '<a href="beheer.php" title="Beheer" class="bl">Terug naar Beheer</a>';
if (($_FILES["file"]["type"] == "application/doc") || ($_FILES["file"]["type"] == "application/docx") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "application/rtf") || $_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
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
       $tabfullname = "/files/" . $_FILES["file"]["name"];
       $imgsize = $_FILES["file"]["size"];
       /*
       mysql_query("INSERT INTO Bestanden (URL)
       VALUES ('$tabfullname')");
       */
        $iquery = "INSERT INTO Bestanden (URL) VALUES (?)";
        $iid = $conn->prepare($iquery);
        $iid->bind_param('s', $tabfullname);
        $iid->execute();
        $iid->close();

       echo "<P>Grootte (in Bytes): ".$imgsize."</P>";
       echo "<P>Opgeslagen in: " . "../files/" . $_FILES["file"]["name"] ."</P>";
       echo "<P><b>Vervang het woord link in de onderste regel met woorden die je wilt hebben!</b></P>";
       echo "<P><b>Kopieer de volgende regel en plak deze in de editor waar je het wil hebben!</b></P>";
       echo "<P>[url ='../files/" . $_FILES["file"]["name"] ."']link[/url]</P>";
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
//SQL CONNECTIE SLUITEN
//mysql_close($con);
}
?>
</BODY>
</HTML>
