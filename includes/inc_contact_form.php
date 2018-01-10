<?php

if (isset($_POST["naam"]) && isset($_POST["bericht"]) && isset($_POST["mail"])){

if(!filter_var($_POST["naam"], FILTER_SANITIZE_STRING)){
echo '<P class="error">Naam kwam niet door de filter<BR><A HREF="contact.php">Terug</A></P>';
}
else {

if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
echo '<P class="error">Geen geldig e-mailadres<BR><A HREF="contact.php">Terug</A></P>';
}
else {

$mail_from = $_POST["mail"];
$bericht = $_POST["bericht"];
$naam = $_POST["naam"];

$fullmessage ="Email
Persoon: ".$naam."
E-mail: ".$mail_from."
Bericht:
".$bericht;


$p_mail ="info@romegames.nl";
$mail_to ="info@romegames.nl";
$subject ="contact";
$ccsubject ="contact CC";

mail($p_mail,$subject,$fullmessage,"From: $mail_from");
mail($mail_from,$ccsubject,$fullmessage,"From: $mail_to");

echo '<P>Mail verzonden<BR><A HREF="contact.php">Terug</A></P>';


}
}

}
else {

echo '<FORM method="post" action="contact.php">
<table class="c_tab">
<tr><td>Uw Naam: </td><td><input type="text" size="20" maxlength="80" name="naam" class="veld"></td></tr>
<tr><td>Uw E-mailadres: </td><td><input type="text" size="20" maxlength="80" name="mail" class="veld"></td></tr>
</table>
<WRAP><TEXTAREA cols="60" rows="5" name="bericht" class="tekstveld"></TEXTAREA>
<br><INPUT type="submit" value="verzend" class="knop"></P></FORM>
';

}

?>
