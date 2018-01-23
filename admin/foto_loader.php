<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Foto Loader</H1>
<P><A HREF="beheer.php">Terug</A> naar beheer</P>
<P><A HREF="fotos.php">Terug</A> naar fotos</P>

<?php
include("connect.php");
if ($connected ==1){
if (($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/PJPEG") || ($_FILES["file"]["type"] == "image/JPEG") || ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/png")){
 if ($_FILES["file"]["size"] < 10000000){
   if ($_FILES["file"]["error"] > 0)
     {
     echo "<P class='error'>Foutmelding Code: " . $_FILES["file"]["error"] . "<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
     }
   else
     {
       $rfilename = $_FILES["file"]["name"];
       $qfilename = str_replace("'","_",$rfilename);
       $sfilename = str_replace(" ","_",$qfilename);
       $_FILES["file"]["name"] = $sfilename;
     echo "<P>Upload: " . $_FILES["file"]["name"] . "</P>";
     echo "<P>Bestandstype: " . $_FILES["file"]["type"] . "</P>";
     echo "<P>Grootte: " . ($_FILES["file"]["size"] / 1024) . " Kb</P>";
     echo "<P>Temp file: " . $_FILES["file"]["tmp_name"] . "</P>";
    if (file_exists("../pictures/" . $_FILES["file"]["name"]))
       {
       echo "<P class='error'>Het ". $_FILES["file"]["name"] ." bestand bestaat al.<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
       }
     else
       {
       move_uploaded_file($_FILES["file"]["tmp_name"], "../pictures/" . $_FILES["file"]["name"]);
       $tabstoragename = $_FILES["file"]["name"];
       $tabfullname = "../pictures/" . $_FILES["file"]["name"];
       $imgsize = $_FILES["file"]["size"];
       list($width, $height, $type, $attr) = getimagesize($tabfullname);
       /*
       mysql_query("INSERT INTO Photos (Imgurl, Imgname, Width, Height, Photosize)
       VALUES ('$tabfullname','$tabstoragename','$width','$height', '$imgsize')");
       */

        $upquery = "INSERT INTO Photos (ImgURL, Imgname, Width, Height, Photosize) VALUES (?, ?, ?, ?, ?)";
        $upid = $conn->prepare($upquery);
        $upid->bind_param('ssiii', $tabfullname, $tabstoragename, $width, $height, $imgsize);
        $upid->execute();
        $upid->close();

        $cquery = "SELECT Domein FROM SEO WHERE ID ='1'";
        $cid = $conn->prepare($cquery);
        $cid->execute();
        $cid->bind_result($domein);
        $cid->fetch();
        $cid->close();

       echo "<P>Breedte: ".$width.", Hoogte: ".$height.", Grootte (in Bytes): ".$imgsize."</P>";
       echo "<P>Opgeslagen in: " . "../pictures/" . $qfilename ."</P>";
       echo "<P><B>Kopieer de volgende regel en plak deze in de editor waar je het wil hebben!</B></P>";
       echo "<P>[img]http://".$domein."/pictures/".$qfilename."[/img]</P>";
       }
     }   /*copyright wiebe eling de boer*/
}
else {
echo "<P class='error'>Bestand is te groot. Het bestand mag niet groter zijn dan 10 Megabyte.<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
}
}
else {
echo "<P class='error'>Ongeldig bestand type. Bestand moet een van de volgende extensies hebben: gif, png, jpeg, of jpg<BR>Terug naar <A HREF='beheer.php'>beheer</A></P>";
}
//SQL CONNECTIE SLUITEN
//mysql_close($con);
}
?>
</BODY>
</HTML>
