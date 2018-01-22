<?php

if (isset($_POST["naam"]) && isset($_POST["bericht"]) && isset($_POST["mail"]) && isset($_POST["randpic"]) && isset($_POST["randcheck"])){

if(!filter_var($_POST["naam"], FILTER_SANITIZE_STRING)){
echo '<P class="error">Naam kwam niet door de filter<BR><A HREF="contact.php">Terug</A></P>';
}
else {

if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
echo '<P class="error">Geen geldig e-mailadres<BR><A HREF="contact.php">Terug</A></P>';
}
else {

if(!filter_var($_POST["randpic"], FILTER_VALIDATE_INT)){
echo "<P class='error'>Geen geldige captcha<BR><A HREF='contact.php'>Terug</A></P>";
}
else {

if(!filter_var($_POST["randcheck"], FILTER_SANITIZE_STRING)){
echo "<P class='error'>Geen geldige captcha<BR><A HREF='contact.php'>Terug</A></P>";
}
else {

//VALIDATE CAPTCHA
$randomnumber = $_POST["randpic"];
$randomchecker = $_POST["randcheck"];

//CHECKING CAPTCHA
switch ($randomnumber){
case 1:
$randomchar ="spiders";
break;
case 2:
$randomchar ="spambot";
break;
case 3:
$randomchar ="crawler";
break;
case 4:
$randomchar ="scraper";
break;
case 5:
$randomchar ="cracker";
break;
case 6:
$randomchar ="botcaps";
break;
case 7:
$randomchar ="serials";
break;
case 8:
$randomchar ="archive";
break;
default:
$randomchar ="charset";
}

//CHECKING CAPTCHA
if ($randomchar != $randomchecker){
echo '<P class="error">Captcha is niet juist<br><A HREF="contact.php">Terug</A></P>';}
else {

$mail_from = $_POST["mail"];
$bericht = $_POST["bericht"];
$naam = $_POST["naam"];

$fullmessage ="Email
Persoon: ".$naam."
E-mail: ".$mail_from."
Bericht:
".$bericht;

        $cquery = "SELECT Contact FROM SEO WHERE ID ='1'";
        $cid = $conn->prepare($cquery);
        $cid->execute();
        $cid->bind_result($contact_adres);
        $cid->fetch();
        $cid->close();

$p_mail =$contact_adres;
$mail_to =$contact_adres;
$subject ="contact";
$ccsubject ="contact CC";

mail($p_mail,$subject,$fullmessage,"From: $mail_from");
mail($mail_from,$ccsubject,$fullmessage,"From: $mail_to");

echo '<P>Mail verzonden<BR><A HREF="contact.php">Terug</A></P>';

}
}

}
}

}

}
else {
/*
echo '<FORM method="post" action="contact.php">
<table class="c_tab">
<tr><td>Uw Naam: </td><td><label for="naam">Naam</label><input type="text" size="20" maxlength="80" id="naam" name="naam" class="veld"></td></tr>
<tr><td>Uw E-mailadres: </td><td><label for="mail">E-mailadres</label><input type="text" size="20" maxlength="80" id="mail" name="mail" class="veld"></td></tr>
</table>
<label for="ow">Uw bericht</label>
<WRAP><TEXTAREA cols="60" rows="5" name="bericht" class="tekstveld" id="ow" style="height:200px"></TEXTAREA>
<br><INPUT type="submit" value="verzenden" class="knop"></P></FORM>
';
*/

echo '<FORM method="post" action="contact.php">
<label for="naam">Naam</label><input type="text" size="20" maxlength="80" id="naam" name="naam" class="veld" placeholder="Naam...">
<label for="mail">E-mailadres</label><input type="text" size="20" maxlength="80" id="mail" name="mail" class="veld" placeholder="E-mailadres...">
<label for="ow">Uw bericht</label>
<WRAP><TEXTAREA cols="60" rows="5" name="bericht" class="tekstveld" id="ow" style="height:200px" placeholder="Voer hier uw bericht in..."></TEXTAREA>';

$picturenum = (rand(1,9));
switch ($picturenum){
case 1:
echo '<IMG SRC="captcha/random1.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 2:
echo '<IMG SRC="captcha/random2.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 3:
echo '<IMG SRC="captcha/random3.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 4:
echo '<IMG SRC="captcha/random4.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 5:
echo '<IMG SRC="captcha/random5.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 6:
echo '<IMG SRC="captcha/random6.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 7:
echo '<IMG SRC="captcha/random7.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
case 8:
echo '<IMG SRC="captcha/random8.gif" WIDTH=100 HEIGHT=50 class="captcha">';
break;
default:
echo '<IMG SRC="captcha/random9.gif" WIDTH=100 HEIGHT=50 class="captcha">';
}
echo '</br><label for="captcha">Captcha</label>';
echo '<input type="text" name="randcheck" id="captcha" class="veld" placeholder="Captcha...">';
echo '<input type="hidden" name="randpic" value="'.$picturenum.'" id="picturenum">';

echo '<br><INPUT type="submit" value="verzenden" class="knop"></FORM>';

}

?>
