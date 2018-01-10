<?php

if (filter_var($_GET["cursus"], FILTER_VALIDATE_INT)){
$cnum = $_GET["cursus"];

$resultco = mysql_query ("SELECT COUNT(*) AS usercount FROM Cursus WHERE ID ='$cnum'");
$rowco = mysql_fetch_assoc($resultco);
$usercheck = $rowco["usercount"];

if ($usercheck >=1){

$result = mysql_query ("SELECT * FROM Cursus WHERE ID ='$cnum'");
$row = mysql_fetch_assoc($result);
$cursus_num = $row["ID"];
$titel = $row["Titel"];
$tijd = $row["Tijd"];
$eindtijd = $row["Eindtijd"];
$dag = $row["Dag"];
$maand = $row["Maand"];
$jaar = $row["Jaar"];
$page_tekst = $row["Tekst"];

$tijdbestek = $row["Tijdbestek"];

$kosten = $row["Kosten"];
$inschrijfgeld = $row["Inschrijfgeld"];
$uren = $row["Uren"];
$dagen = $row["Dagen"];
$accreditatie = $row["Accreditatie"];

$aflasting = $row["Aflasting"];

$volgeboekt = $row["Volgeboekt"];
$handout = $row["Handout"];

echo '<h2>'.$titel.'</h2>';

//echo '<h3>'.$dag.'/'.$maand.'/'.$jaar.' van: '.$tijd.' tot: '.$eindtijd.'</h3>';

echo '<h3>'.$tijdbestek.'</h3>';

echo '<h3>Plaats: '.$row["Plaats"].'</h3>';

if (isset($_POST["achternaam"]) && isset($_POST["voornaam"]) && isset($_POST["geboorte"]) && isset($_POST["geslacht"]) && isset($_POST["adres"]) && isset($_POST["postcode"]) && isset($_POST["plaats"]) && isset($_POST["telefoon"]) && isset($_POST["mail"]) && isset($_POST["il"]) && isset($_POST["akkoord"])){

if (filter_var($_POST["achternaam"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["voornaam"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["geboorte"], FILTER_SANITIZE_STRING)){

if ($_POST["geslacht"] =="m" || $_POST["geslacht"] =="f"){

if (filter_var($_POST["adres"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["postcode"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["plaats"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["telefoon"], FILTER_SANITIZE_STRING)){

if (filter_var($_POST["mail"], FILTER_SANITIZE_STRING)){

if ($_POST["il"] ==0 || $_POST["il"] ==1){

$p_achternaam = $_POST["achternaam"];
$p_voornaam = $_POST["voornaam"];
$p_geboorte = $_POST["geboorte"];
$p_geslacht = $_POST["geslacht"];
$p_adres = $_POST["adres"];
$p_post = $_POST["postcode"];
$p_plaats = $_POST["plaats"];
$p_telefoon = $_POST["telefoon"];
$p_mail = $_POST["mail"];
$p_il = $_POST["il"];

$dag = date("d");
$maand = date("m");
$jaar = date("Y");

$datum = $dag."-".$maand."-".$jaar;

mysql_query("INSERT INTO Cursisten (Voornaam, Achternaam, Geboortedatum, Geslacht, Adres, Postcode, Plaats, Telefoon, Mail, Cursus, Registratie, IL)
VALUES ('$p_voornaam', '$p_achternaam', '$p_geboorte', '$p_geslacht', '$p_adres', '$p_post', '$p_plaats', '$p_telefoon', '$p_mail', '$cnum', '$datum', '$p_il')");

$str_titel = str_replace("'"," ",$titel);

$fullmessage ="U heeft zich geregistreerd voor de cursus ".$str_titel." ";
$mail_from ="info@romegames.nl";
$subject =" Bevestiging";


mail($p_mail,$subject,$fullmessage,"From: $mail_from");


echo "<P class='error'>u bent geregistreerd voor deze cursus</P>";

}
else {
echo "<P class='error'>ongeldige waarde voor IL</P>";
}

}
else {
echo "<P class='error'>ongeldig e-mailadres</P>";
}

}
else {
echo "<P class='error'>telefoonnummer kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>plaatsnaam kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>postcode kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>adres kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>ongeldig geslacht</P>";
}

}
else {
echo "<P class='error'>geboortedatum kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>voornaam kwam niet door filter</P>";
}

}
else {
echo "<P class='error'>achternaam kwam niet door filter</P>";
}

}










if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

include("inc_rep_entity.php");
echo $h3emessage;

}
else {

include("inc_rep_entity.php");
echo $h3emessage;


echo '<p>Ga door naar <a href="inschrijving.php?cursus='.$cnum.'">inschrijving</a></p>';


}




}
else {
echo "<P class='error'>Nog geen cursussen</P>";
}


}


?>
