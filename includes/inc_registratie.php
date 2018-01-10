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

$kosten = $row["Kosten"];
$inschrijfgeld = $row["Inschrijfgeld"];
$uren = $row["Uren"];
$dagen = $row["Dagen"];
$accreditatie = $row["Accreditatie"];

$aflasting = $row["Aflasting"];

$volgeboekt = $row["Volgeboekt"];
$handout = $row["Handout"];

echo '<h2>'.$titel.'</h2>';

echo '<h3>'.$dag.'/'.$maand.'/'.$jaar.' van: '.$tijd.' tot: '.$eindtijd.'</h3>';

echo '<h3>Plaats: '.$row["Plaats"].'</h3>';

if (isset($_POST["achternaam"]) && isset($_POST["voornaam"]) && isset($_POST["geboorte"]) && isset($_POST["geslacht"]) && isset($_POST["adres"]) && isset($_POST["postcode"]) && isset($_POST["plaats"]) && isset($_POST["telefoon"]) && isset($_POST["mail"]) && isset($_POST["il"]) && isset($_POST["akkoord"])){



if (filter_var($_POST["achternaam"], FILTER_SANITIZE_STRING)){
$achternaam_error =0;
}
else {
$achternaam_error =1;
echo "<P class='error'>achternaam kwam niet door filter</P>";
}


if (filter_var($_POST["voornaam"], FILTER_SANITIZE_STRING)){
$voornaam_error =0;
}
else {
$voornaam_error =1;
echo "<P class='error'>voornaam kwam niet door filter</P>";
}


if (filter_var($_POST["geboorte"], FILTER_SANITIZE_STRING)){
$geboorte_error =0;
}
else {
$geboorte_error =1;
echo "<P class='error'>geboortedatum kwam niet door filter</P>";
}


if ($_POST["geslacht"] =="m" || $_POST["geslacht"] =="f"){
$geslacht_error =0;
}
else {
$geslacht_error =1;
echo "<P class='error'>ongeldig geslacht</P>";
}


if (filter_var($_POST["adres"], FILTER_SANITIZE_STRING)){
$adres_error =0;
}
else {
$adres_error =1;
echo "<P class='error'>adres kwam niet door filter</P>";
}

if (filter_var($_POST["postcode"], FILTER_SANITIZE_STRING)){
$postcode_error =0;
}
else {
$postcode_error =1;
echo "<P class='error'>postcode kwam niet door filter</P>";
}


if (filter_var($_POST["plaats"], FILTER_SANITIZE_STRING)){
$plaats_error =0;
}
else {
echo "<P class='error'>plaatsnaam kwam niet door filter</P>";
$plaats_error =1;
}


if (filter_var($_POST["telefoon"], FILTER_SANITIZE_STRING)){
$telephone_error =0;
}
else {
echo "<P class='error'>telefoonnummer kwam niet door filter</P>";
$telephone_error =1;
}


if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
$mail_error =0;
}
else {
echo "<P class='error'>ongeldig e-mailadres</P>";
$mail_error =1;
}


if ($_POST["il"] ==0 || $_POST["il"] ==1){
$il_error =0;
}
else {
echo "<P class='error'>ongeldige waarde voor IL</P>";
$il_error =1;
}

$all_errors = $achternaam_error + $voornaam_error + $geboorte_error + $geslacht_error + $adres_error + $postcode_error + $plaats_error + $telephone_error + $mail_error + $il_error;

//references
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

//registratie
if ($all_errors ==0){

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
//end registratie


//<div style="border-style:solid;border-width:1px;border-color:#ff0000;"></div>



//display
if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

}
else {

echo '<h2>Inschrijfformulier / Contract</h2>';

echo '<form method="post" action="inschrijving.php?cursus='.$cnum.'"><table><tr><th colspan="2">Ondergetekende / Cursist</th></tr>';




if ($achternaam_error ==1){
echo '<tr><td>Achternaam:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="achternaam" value="'.$p_achternaam.'" maxlength="45" size="45" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Achternaam:</td><td><input type="text" name="achternaam" value="'.$p_achternaam.'" maxlength="45" size="45" class="veld"></td></tr>';
}

if ($voornaam_error ==1){
echo '<tr><td>Voornaam (en voorletters):</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="voornaam" value="'.$p_voornaam.'" maxlength="45" size="45" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Voornaam (en voorletters):</td><td><input type="text" name="voornaam" value="'.$p_voornaam.'" maxlength="45" size="45" class="veld"></td></tr>';
}

if ($geboorte_error ==1){
echo '<tr><td>Geboortedatum:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="geboorte" maxlength="10" size="10" value="'.$p_geboorte.'" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Geboortedatum:</td><td><input type="text" name="geboorte" maxlength="10" size="10" value="'.$p_geboorte.'" class="veld"></td></tr>';
}

if ($p_geslacht =="m"){
echo '<tr><td>Geslacht:</td><td>m <input type="radio" name="geslacht" value="m" checked> / v <input type="radio" name="geslacht" value="f"></td></tr>';
}
elseif ($p_geslacht =="f"){
echo '<tr><td>Geslacht:</td><td>m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f" checked></td></tr>';
}
else {
echo '<tr><td>Geslacht:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;">m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f"></div></td></tr>';
}

if ($adres_error ==1){
echo '<tr><td>Adres:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="adres" value="'.$p_adres.'" maxlength="80" size="45" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Adres:</td><td><input type="text" name="adres" value="'.$p_adres.'" maxlength="80" size="45" class="veld"></td></tr>';
}

if ($postcode_error ==1){
echo '<tr><td>Postcode:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="postcode" value="'.$p_post.'" maxlength="12" size="10" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Postcode:</td><td><input type="text" name="postcode" value="'.$p_post.'" maxlength="12" size="10" class="veld"></td></tr>';
}

if ($plaats_error ==1){
echo '<tr><td>Plaatsnaam:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="plaats" value="'.$p_plaats.'" maxlength="80" size="45" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Plaatsnaam:</td><td><input type="text" name="plaats" value="'.$p_plaats.'" maxlength="80" size="45" class="veld"></td></tr>';
}

if ($telephone_error ==1){
echo '<tr><td>Telefoonnummer:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="telefoon" value="'.$p_telefoon.'" maxlength="20" size="20" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>Telefoonnummer:</td><td><input type="text" name="telefoon" value="'.$p_telefoon.'" maxlength="20" size="20" class="veld"></td></tr>';
}

if ($mail_error ==1){
echo '<tr><td>E-Mailadres:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="text" name="mail" value="'.$p_mail.'" maxlength="80" size="45" class="veld"></div></td></tr>';
}
else {
echo '<tr><td>E-Mailadres:</td><td><input type="text" name="mail" value="'.$p_mail.'" maxlength="80" size="45" class="veld"></td></tr>';
}

//echo '<tr><td>Bent u hier via International Lectures?</td><td>nee <input type="radio" name="il" value="0"> / ja <input type="radio" name="il" value="1"></td></tr>';
echo '<input type="hidden" name="il" value="0">';

echo '</table>

<p>
De totale kosten van de cursus bedragen  € '.$kosten.'.- ';

if ($handout ==1){
echo 'inclusief hand-out,';}
else {
echo 'exclusief hand-out,';}


}
//end display

}




























}
//forgot radio
elseif (isset($_POST["achternaam"]) && isset($_POST["voornaam"]) && isset($_POST["geboorte"]) && isset($_POST["adres"]) && isset($_POST["postcode"]) && isset($_POST["plaats"]) && isset($_POST["telefoon"]) && isset($_POST["mail"]) && isset($_POST["il"])){

echo '<P class="error">aanvinken vergeten</P>';


$p_achternaam = $_POST["achternaam"];
$p_voornaam = $_POST["voornaam"];
$p_geboorte = $_POST["geboorte"];
$p_adres = $_POST["adres"];
$p_post = $_POST["postcode"];
$p_plaats = $_POST["plaats"];
$p_telefoon = $_POST["telefoon"];
$p_mail = $_POST["mail"];
$p_il = $_POST["il"];

//display
if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

}
else {

echo '<h2>Inschrijfformulier / Contract</h2>';

echo '<form method="post" action="inschrijving.php?cursus='.$cnum.'"><table><tr><th colspan="2">Ondergetekende / Cursist</th></tr>
<tr><td>Achternaam:</td><td><input type="text" name="achternaam" value="'.$p_achternaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Voornaam (en voorletters):</td><td><input type="text" name="voornaam" value="'.$p_voornaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Geboortedatum:</td><td><input type="text" name="geboorte" maxlength="10" size="10" value="'.$p_geboorte.'" class="veld"></td></tr>';

echo '<tr><td>Geslacht:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;">m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f"></div></td></tr>';

echo '<tr><td>Adres:</td><td><input type="text" name="adres" value="'.$p_adres.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Postcode:</td><td><input type="text" name="postcode" value="'.$p_post.'" maxlength="12" size="10" class="veld"></td></tr>
<tr><td>Plaatsnaam:</td><td><input type="text" name="plaats" value="'.$p_plaats.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Telefoonnummer:</td><td><input type="text" name="telefoon" value="'.$p_telefoon.'" maxlength="20" size="20" class="veld"></td></tr>
<tr><td>E-Mailadres:</td><td><input type="text" name="mail" value="'.$p_mail.'" maxlength="80" size="45" class="veld"></td></tr>';

//echo '<tr><td>Bent u hier via International Lectures?</td><td>nee <input type="radio" name="il" value="0"> / ja <input type="radio" name="il" value="1"></td></tr>';
echo '<input type="hidden" name="il" value="0">';

echo '</table>

<p>
De totale kosten van de cursus bedragen  € '.$kosten.'.- ';

if ($handout ==1){
echo 'inclusief hand-out,';}
else {
echo 'exclusief hand-out,';}

echo ' lunch en koffie-thee-water.
<br>De totale duur van de cursus bedraagt '.$uren.' uren per dag en '.$dagen.' dagen.
<br>Er is accreditatie aangevraagd en verleend door de volgende beroepsverenigingen :
<br>'.$accreditatie.'
</p>

<p>
De inschrijving dient bevestigd te worden door betaling van het inschrijfgeld ad € '.$inschrijfgeld.'.-
<br>op rekening   584336063   t.n.v.  Stichting Studiecentrum Pa Kua te Grou.
<br>IBAN : NL52ABNA 058 433 6063
<br>(vermeldt a.u.b. bij het overboeken uw persoonsnaam en de titel van de cursus)
</p>

<p>
Dit inschrijfgeld zal in mindering worden gebracht op het cursusgeld van bovenvermelde cursus / bijscholing.
<br>De betalingstermijnen staan vermeld onder de Voorwaarden onder kopje Betalingen
<br>Aan het eind van de cursus ontvangt u een certificaat met vermelding van de gevolgde cursus , de naam van de docent en het aantal cursus-uren
</p>

<p>Ondergetekende heeft de <a href="files/20160217_Algemene_betalings_voorwaarden.doc" target="_blank">algemene voorwaarden</a> gelezen en verklaart d.m.v. het aanvinken mee akkoord. <div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="checkbox" name="akkoord" id="akkoord" class="akkoord"></div>
<br><input type="submit" value="schrijf in"></form>
</p>

<p>Na uw inschrijving ontvangt u een bevestiging van de inschrijving.
</p>

';
}
//end display

}
elseif (isset($_POST["achternaam"]) && isset($_POST["voornaam"]) && isset($_POST["geboorte"]) && isset($_POST["geslacht"]) && isset($_POST["adres"]) && isset($_POST["postcode"]) && isset($_POST["plaats"]) && isset($_POST["telefoon"]) && isset($_POST["mail"]) && isset($_POST["il"])){

echo '<P class="error">aanvinken vergeten</P>';

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


//display
if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

}
else {

echo '<h2>Inschrijfformulier / Contract</h2>';

echo '<form method="post" action="inschrijving.php?cursus='.$cnum.'"><table><tr><th colspan="2">Ondergetekende / Cursist</th></tr>
<tr><td>Achternaam:</td><td><input type="text" name="achternaam" value="'.$p_achternaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Voornaam (en voorletters):</td><td><input type="text" name="voornaam" value="'.$p_voornaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Geboortedatum:</td><td><input type="text" name="geboorte" maxlength="10" size="10" value="'.$p_geboorte.'" class="veld"></td></tr>';

if ($p_geslacht =="m"){
echo '<tr><td>Geslacht:</td><td>m <input type="radio" name="geslacht" value="m" checked> / v <input type="radio" name="geslacht" value="f"></td></tr>';
}
elseif ($p_geslacht =="f"){
echo '<tr><td>Geslacht:</td><td>m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f" checked></td></tr>';
}
else {
echo '<tr><td>Geslacht:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;">m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f"></div></td></tr>';
}

echo '<tr><td>Adres:</td><td><input type="text" name="adres" value="'.$p_adres.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Postcode:</td><td><input type="text" name="postcode" value="'.$p_post.'" maxlength="12" size="10" class="veld"></td></tr>
<tr><td>Plaatsnaam:</td><td><input type="text" name="plaats" value="'.$p_plaats.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Telefoonnummer:</td><td><input type="text" name="telefoon" value="'.$p_telefoon.'" maxlength="20" size="20" class="veld"></td></tr>
<tr><td>E-Mailadres:</td><td><input type="text" name="mail" value="'.$p_mail.'" maxlength="80" size="45" class="veld"></td></tr>';

//echo '<tr><td>Bent u hier via International Lectures?</td><td>nee <input type="radio" name="il" value="0"> / ja <input type="radio" name="il" value="1"></td></tr>';
echo '<input type="hidden" name="il" value="0">';

echo '</table>

<p>
De totale kosten van de cursus bedragen  € '.$kosten.'.- ';

if ($handout ==1){
echo 'inclusief hand-out,';}
else {
echo 'exclusief hand-out,';}

echo ' lunch en koffie-thee-water.
<br>De totale duur van de cursus bedraagt '.$uren.' uren per dag en '.$dagen.' dagen.
<br>Er is accreditatie aangevraagd en verleend door de volgende beroepsverenigingen :
<br>'.$accreditatie.'
</p>

<p>
De inschrijving dient bevestigd te worden door betaling van het inschrijfgeld ad € '.$inschrijfgeld.'.-
<br>op rekening   584336063   t.n.v.  Stichting Studiecentrum Pa Kua te Grou.
<br>IBAN : NL52ABNA 058 433 6063
<br>(vermeldt a.u.b. bij het overboeken uw persoonsnaam en de titel van de cursus)
</p>

<p>
Dit inschrijfgeld zal in mindering worden gebracht op het cursusgeld van bovenvermelde cursus / bijscholing.
<br>De betalingstermijnen staan vermeld onder de Voorwaarden onder kopje Betalingen
<br>Aan het eind van de cursus ontvangt u een certificaat met vermelding van de gevolgde cursus , de naam van de docent en het aantal cursus-uren
</p>

<p>Ondergetekende heeft de <a href="files/20160217_Algemene_betalings_voorwaarden.doc" target="_blank">algemene voorwaarden</a> gelezen en verklaart d.m.v. het aanvinken mee akkoord. <div style="border-style:solid;border-width:1px;border-color:#ff0000;"><input type="checkbox" name="akkoord" id="akkoord" class="akkoord"></div>
<br><input type="submit" value="schrijf in"></form>
</p>

<p>Na uw inschrijving ontvangt u een bevestiging van de inschrijving.
</p>

';
}
//end display



}
elseif (isset($_POST["achternaam"]) && isset($_POST["voornaam"]) && isset($_POST["geboorte"]) && isset($_POST["adres"]) && isset($_POST["postcode"]) && isset($_POST["plaats"]) && isset($_POST["telefoon"]) && isset($_POST["mail"]) && isset($_POST["il"]) && isset($_POST["akkoord"])){

echo '<P class="error">aanvinken vergeten</P>';

$p_achternaam = $_POST["achternaam"];
$p_voornaam = $_POST["voornaam"];
$p_geboorte = $_POST["geboorte"];
$p_adres = $_POST["adres"];
$p_post = $_POST["postcode"];
$p_plaats = $_POST["plaats"];
$p_telefoon = $_POST["telefoon"];
$p_mail = $_POST["mail"];
$p_il = $_POST["il"];


//display
if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

}
else {

echo '<h2>Inschrijfformulier / Contract</h2>';

echo '<form method="post" action="inschrijving.php?cursus='.$cnum.'"><table><tr><th colspan="2">Ondergetekende / Cursist</th></tr>
<tr><td>Achternaam:</td><td><input type="text" name="achternaam" value="'.$p_achternaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Voornaam (en voorletters):</td><td><input type="text" name="voornaam" value="'.$p_voornaam.'" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Geboortedatum:</td><td><input type="text" name="geboorte" maxlength="10" size="10" value="'.$p_geboorte.'" class="veld"></td></tr>';

echo '<tr><td>Geslacht:</td><td><div style="border-style:solid;border-width:1px;border-color:#ff0000;">m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f"></div></td></tr>';

echo '<tr><td>Adres:</td><td><input type="text" name="adres" value="'.$p_adres.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Postcode:</td><td><input type="text" name="postcode" value="'.$p_post.'" maxlength="12" size="10" class="veld"></td></tr>
<tr><td>Plaatsnaam:</td><td><input type="text" name="plaats" value="'.$p_plaats.'" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Telefoonnummer:</td><td><input type="text" name="telefoon" value="'.$p_telefoon.'" maxlength="20" size="20" class="veld"></td></tr>
<tr><td>E-Mailadres:</td><td><input type="text" name="mail" value="'.$p_mail.'" maxlength="80" size="45" class="veld"></td></tr>';

//echo '<tr><td>Bent u hier via International Lectures?</td><td>nee <input type="radio" name="il" value="0"> / ja <input type="radio" name="il" value="1"></td></tr>';
echo '<input type="hidden" name="il" value="0">';


echo '</table>

<p>
De totale kosten van de cursus bedragen  € '.$kosten.'.- ';

if ($handout ==1){
echo 'inclusief hand-out,';}
else {
echo 'exclusief hand-out,';}

echo ' lunch en koffie-thee-water.
<br>De totale duur van de cursus bedraagt '.$uren.' uren per dag en '.$dagen.' dagen.
<br>Er is accreditatie aangevraagd en verleend door de volgende beroepsverenigingen :
<br>'.$accreditatie.'
</p>

<p>
De inschrijving dient bevestigd te worden door betaling van het inschrijfgeld ad € '.$inschrijfgeld.'.-
<br>op rekening   584336063   t.n.v.  Stichting Studiecentrum Pa Kua te Grou.
<br>IBAN : NL52ABNA 058 433 6063
<br>(vermeldt a.u.b. bij het overboeken uw persoonsnaam en de titel van de cursus)
</p>



<p>
Dit inschrijfgeld zal in mindering worden gebracht op het cursusgeld van bovenvermelde cursus / bijscholing.
<br>De betalingstermijnen staan vermeld onder de Voorwaarden onder kopje Betalingen
<br>Aan het eind van de cursus ontvangt u een certificaat met vermelding van de gevolgde cursus , de naam van de docent en het aantal cursus-uren
</p>

<p>Ondergetekende heeft de <a href="files/20160217_Algemene_betalings_voorwaarden.doc" target="_blank">algemene voorwaarden</a> gelezen en verklaart d.m.v. het aanvinken mee akkoord. <input type="checkbox" name="akkoord" id="akkoord" class="akkoord" checked>
<br><input type="submit" value="schrijf in"></form>
</p>

<p>Na uw inschrijving ontvangt u een bevestiging van de inschrijving.
</p>

';
}
//end display









//default
}
else {









if ($aflasting ==1){
echo '<p>deze cursus is afgelast</p>';
}
elseif ($volgeboekt ==1){
echo '<p><b>deze cursus is volgeboekt</b></p>';

}
else {

echo '<h2>Inschrijfformulier / Contract</h2>';

echo '<form method="post" action="inschrijving.php?cursus='.$cnum.'"><table><tr><th colspan="2">Ondergetekende / Cursist</th></tr>
<tr><td>Achternaam:</td><td><input type="text" name="achternaam" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Voornaam (en voorletters):</td><td><input type="text" name="voornaam" maxlength="45" size="45" class="veld"></td></tr>
<tr><td>Geboortedatum:</td><td><input type="text" name="geboorte" maxlength="10" size="10" value="dd-mm-jjjj" class="veld"></td></tr>
<tr><td>Geslacht:</td><td>m <input type="radio" name="geslacht" value="m"> / v <input type="radio" name="geslacht" value="f"></td></tr>
<tr><td>Adres:</td><td><input type="text" name="adres" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Postcode:</td><td><input type="text" name="postcode" maxlength="12" size="10" class="veld"></td></tr>
<tr><td>Plaatsnaam:</td><td><input type="text" name="plaats" maxlength="80" size="45" class="veld"></td></tr>
<tr><td>Telefoonnummer:</td><td><input type="text" name="telefoon" maxlength="20" size="20" class="veld"></td></tr>
<tr><td>E-Mailadres:</td><td><input type="text" name="mail" maxlength="80" size="45" class="veld"></td></tr>';

//echo '<tr><td>Bent u hier via International Lectures?</td><td>nee <input type="radio" name="il" value="0"> / ja <input type="radio" name="il" value="1"></td></tr>';
echo '<input type="hidden" name="il" value="0">';


echo '</table>

<p>
De totale kosten van de cursus bedragen  € '.$kosten.'.- ';

if ($handout ==1){
echo 'inclusief hand-out,';}
else {
echo 'exclusief hand-out,';}

echo ' lunch en koffie-thee-water.
<br>De totale duur van de cursus bedraagt '.$uren.' uren per dag en '.$dagen.' dagen.
<br>Er is accreditatie aangevraagd en verleend door de volgende beroepsverenigingen :
<br>'.$accreditatie.'
</p>

<p>
De inschrijving dient bevestigd te worden door betaling van het inschrijfgeld ad € '.$inschrijfgeld.'.-
<br>op rekening   584336063   t.n.v.  Stichting Studiecentrum Pa Kua te Grou.
<br>IBAN : NL52ABNA 058 433 6063
<br>(vermeldt a.u.b. bij het overboeken uw persoonsnaam en de titel van de cursus)
</p>



<p>
Dit inschrijfgeld zal in mindering worden gebracht op het cursusgeld van bovenvermelde cursus / bijscholing.
<br>De betalingstermijnen staan vermeld onder de Voorwaarden onder kopje Betalingen
<br>Aan het eind van de cursus ontvangt u een certificaat met vermelding van de gevolgde cursus , de naam van de docent en het aantal cursus-uren
</p>

<p>Ondergetekende heeft de <a href="files/20160217_Algemene_betalings_voorwaarden.doc" target="_blank">algemene voorwaarden</a> gelezen en verklaart d.m.v. het aanvinken mee akkoord. <div style="border-style:solid;border-width:1px;border-color:#0000ff;"><input type="checkbox" name="akkoord" id="akkoord" class="akkoord"></div>
<br><input type="submit" value="schrijf in"></form>
</p>

<p>Na uw inschrijving ontvangt u een bevestiging van de inschrijving.
</p>

';
}



//end default
}




//cursuscheck
}
else {
echo "<P class='error'>Nog geen cursussen</P>";
}


}


?>
