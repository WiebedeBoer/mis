<!DOCTYPE HTML>
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>
<P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>
<?php

include("connect.php");
if ($connected ==1){

echo '<h1>Gebruikersbeheer</h1>';



/*wachtwoord wijzigen*/
if (isset($_POST["oldpass"]) && isset($_POST["password"]) && isset($_POST["newpass"])){

//CHECK USERNAME
if(filter_has_var(INPUT_POST, "oldpass")){

//CHECK USERTYPE
if(filter_has_var(INPUT_POST, "password")){

//CHECK PASSWORD
if(filter_has_var(INPUT_POST, "newpass")){

if(filter_var($_POST["oldpass"], FILTER_SANITIZE_STRING)){
if(filter_var($_POST["password"], FILTER_SANITIZE_STRING)){
if(filter_var($_POST["newpass"], FILTER_SANITIZE_STRING)){

$old_pass = md5($_POST["oldpass"]);
$new_pass_check = md5($_POST["password"]);
$new_pass = md5($_POST["newpass"]);

if ($new_pass_check =="$new_pass"){

/*
$resultcp = mysql_query("SELECT * FROM Users WHERE Username ='$you'");
$rowcp = mysql_fetch_array($resultcp);
$tab_old_pw = $rowcp['Password'];
*/

$ccquery = "SELECT Password FROM Users WHERE Username = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('s', $you);
$cid->execute();
$cid->bind_result($tab_old_pw);
$cid->fetch();
$cid->close();

if ($tab_old_pw =="$old_pass"){
/*
mysql_query("UPDATE Users SET Password ='$new_pass' WHERE Username ='$you'");
*/
$upquery = "UPDATE Users SET Password = ? WHERE Username = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('ss', $new_pass, $you);
$upid->execute();
$upid->close();

echo "<P>Wachtwoord is gewijzigd</P>";

}
else {
echo "<P class='error'>Oud wachtwoord matched niet</P>";
}

}
else {
echo "<P class='error'>Controle matched niet</P>";
}

}
else {
echo "<P class='error'>Dat is geen geldig wachtwoord</P>";
}

}
else {
echo "<P class='error'>Dat is geen geldige gebruikerstype</P>";
}

}
else {
echo "<P class='error'>Dat is geen geldige gebruikersnaam</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}









if ($user_cat =="superadmin" || $user_cat =="admin"){


/*gebruiker verwijderen*/
if (isset($_POST["deletion"])){
$deletedgroep = $_POST["deletion"];

if(filter_var($deletedgroep, FILTER_VALIDATE_INT)){


$ccquery = "SELECT COUNT(*) AS catcheck FROM Users WHERE ID = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('i', $deletedgroep);
$cid->execute();
$cid->bind_result($catcheck);
$cid->fetch();
$cid->close();

/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Users WHERE ID ='$deletedgroep'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/
if ($catcheck ==1){

/*
$resultco = mysql_query("SELECT * FROM Users WHERE ID ='$deletedgroep'");
$rowco = mysql_fetch_array($resultco);
$d_user = $rowco['Username'];
*/

/*
mysql_query("DELETE FROM Users WHERE ID ='$deletedgroep'");
*/

$dequery = "DELETE FROM Users WHERE ID = ?";
$did = $conn->prepare($dequery);
$did->bind_param('i', $deletedgroep);
$did->execute();
$did->close();


echo "<P>Gebruiker is verwijderd</P>";

}
else {
echo "<P class='error'>Gebruiker bestaat niet of is al verwijderd</P>";
}

}
else {
echo "<P class='error'>Ongeldige Integer</P>";
}

}


/*nieuwe aanmaken*/
if (isset($_POST["username"]) && isset($_POST["usertype"]) && isset($_POST["userpass"])){

//CHECK USERNAME
if(filter_has_var(INPUT_POST, "username")){

//CHECK USERTYPE
if(filter_has_var(INPUT_POST, "usertype")){

//CHECK PASSWORD
if(filter_has_var(INPUT_POST, "userpass")){

if(filter_var($_POST["username"], FILTER_SANITIZE_STRING)){
if(filter_var($_POST["usertype"], FILTER_SANITIZE_STRING)){
if(filter_var($_POST["userpass"], FILTER_SANITIZE_STRING)){

$newuser = $_POST["username"];
$newusertype = $_POST["usertype"];

$newpassword = md5($_POST["userpass"]);

$cquery = "SELECT COUNT(*) AS usernamecheck FROM Users WHERE Username = ?";
$cid = $conn->prepare($cquery);
$cid->bind_param('s', $newuser);
$cid->execute();
$cid->bind_result($usernamecheck);
$cid->fetch();
$cid->close();

if($usernamecheck == 0) {
    


$iquery = "INSERT INTO Users (Username, Password, Category) VALUES (?, ?, ?)";
$iid = $conn->prepare($iquery);
$iid->bind_param('sss', $newuser, $newpassword, $newusertype);
$iid->execute();
$iid->close();
}else {
    echo "Gebruikersnaam is al in gebruik";
}
echo "<P>Gebruiker is toegevoegd</P>";

}
else {
echo "<P class='error'>Dat is geen geldig wachtwoord</P>";
}

}
else {
echo "<P class='error'>Dat is geen geldige gebruikerstype</P>";
}

}
else {
echo "<P class='error'>Dat is geen geldige gebruikersnaam</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}
else {
echo "<P class='error'>Variabele niet opgegeven</P>";
}

}


/*wijzigen*/
if (isset($_POST["user"]) && isset($_POST["group"])){

//CHECK USER
if(filter_has_var(INPUT_POST, "user")){

//CHECK USERTYPE
if(filter_has_var(INPUT_POST, "group")){

if(filter_var($_POST["group"], FILTER_SANITIZE_STRING)){

$newgroup = $_POST["group"];
$usersid = $_POST["user"];

if(filter_var($usersid, FILTER_VALIDATE_INT)){
/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Users WHERE ID ='$usersid'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/
$ccquery = "SELECT COUNT(*) AS catcount FROM Users WHERE ID = ?";
$cid = $conn->prepare($ccquery);
$cid->bind_param('i', $usersid);
$cid->execute();
$cid->bind_result($catcheck);
$cid->fetch();
$cid->close();

if ($catcheck ==1){
/*
mysql_query("UPDATE Users SET Category ='$newgroup' WHERE ID ='$usersid'");
*/
$upquery = "UPDATE Users SET Category = ? WHERE ID = ?";
$upid = $conn->prepare($upquery);
$upid->bind_param('si', $newgroup, $usersid);
$upid->execute();
$upid->close();


echo "<P>Gebruiker is gewijzigd</P>";

}
else {
echo "<P class='error'>Gebruiker bestaat niet</P>";
}

}
else {
echo "<P class='error'>Ongeldige Integer</P>";
}

}
else {
echo "<P class='error'>Ongeldig gebruikerstype</P>";
}

}
}

}










/*gebruiker aanmaken formulier*/
echo "<FORM method='post' action='users.php'>
<P><B>Nieuwe gebruiker toevoegen</B>
<BR>gebruikersnaam: <input type='text' name='username'>
<BR>gebruikerstype:
<SELECT size=1 name='usertype'>
<option value='user'>user</option>
<option value='superuser'>superuser</option>
<option value='admin'>admin</option>
</SELECT>
<BR>wachtwoord: <input type='text' name='userpass'>
<INPUT type='submit' value='nieuw'>
</P>
</form>";


/*gebruiker wijzigen formulier*/

/*
$resultcocat = mysql_query("SELECT COUNT(*) AS catcount FROM Users WHERE Category <>'superadmin'");
$rowcocat = mysql_fetch_array($resultcocat);
$catcheck = $rowcocat['catcount'];
*/

$cocatquery = "SELECT COUNT(*) AS catcheck FROM Users WHERE Category <>'superadmin'";
$cocatid = $conn->prepare($cocatquery);
$cocatid->execute();
$cocatid->bind_result($catcheck);
$cocatid->fetch();
$cocatid->close();


if ($catcheck >=1){
echo "<FORM method='post' action='users.php'>
<P><B>Gebruikerstype wijzigen</B>
<BR>Gebruiker: <select name='user'>";
/*
$resultpho = mysql_query("SELECT * FROM Users WHERE Category <>'superadmin' ORDER BY Username");
while ($rowpho = mysql_fetch_array($resultpho))
*/
$lquery = "SELECT * FROM Users WHERE Category <>'superadmin' ORDER BY Username";
$result_pagg = $conn->query($lquery);
while ($rowpag = $result_pagg->fetch_assoc())
  {
$userid = $rowpag['ID'];
$usernaam = $rowpag['Username'];

echo "<option value='".$userid."'>".$usernaam."</option>";
  }
echo "</select>";

echo "<BR>Gebruikerstype: <SELECT size=1 name='group'>
<option value='user'>user</option>
<option value='superuser'>superuser</option>
<option value='admin'>admin</option>";
echo "</SELECT>";
echo "<input type='submit' value='wijzig'></P></FORM>";
}


$cuquery = "SELECT COUNT(*) AS usercheck FROM Users";
$cuid = $conn->prepare($cuquery);
$cuid->execute();
$cuid->bind_result($usercheck);
$cuid->fetch();
$cuid->close();

/*overzicht*/
if ($usercheck >=1){
echo "<table border='0' class='tabel'>
<tr><th>Gebruikersnaam</th><th>Gebruikerstype</th><th>Verwijderknop</th></tr>";
/*
$resultpho = mysql_query("SELECT * FROM Users ORDER BY Username");
while ($rowpho = mysql_fetch_array($resultpho))
  {
*/

$mquery = "SELECT * FROM Users ORDER BY Username";
$result_pagf = $conn->query($mquery);
while ($rowpho = $result_pagf->fetch_assoc())
 {
$userid = $rowpho['ID'];
$usernaam = $rowpho['Username'];
$usertyp = $rowpho['Category'];

if ($usertyp =="superadmin"){
echo "<tr><td>".$usernaam."</td><td>".$usertyp."</td><td>&nbsp;</td></tr>";
}
/*
elseif ($usertyp =="admin"){
echo "<tr><td>".$usernaam."</td><td>".$usertyp."</td><td><FORM method='post' action='users.php'><input type='hidden' value='".$userid."' name='deletion'><INPUT type='submit' value='delete'></form></td></tr>";
}
*/
else {
echo "<tr><td>".$usernaam."</td><td>".$usertyp."</td><td><FORM method='post' action='users.php'><input type='hidden' value='".$userid."' name='deletion'><INPUT type='submit' value='delete'></form></td></tr>";
}
  }
echo "</table>";
}
else {
echo "<P class='error'>Tabel is nog leeg</P>";
}





}


echo "<FORM method='post' action='users.php'>
<table class='tabel'><tr><th colspan='2'>Wachtwoord Wijzigen</th></tr>
<tr><td>Oud wachtwoord:</td><td><input type='text' name='oldpass' size='20' maxlength='20'></td></tr>
<tr><td>Nieuw wachtwoord:</td><td><input type='text' name='password' size='20' maxlength='20'></td></tr>
<tr><td>Nieuw wachtwoord (controle):</td><td><input type='text' name='newpass' size='20' maxlength='20'></td></tr>
<tr><td>&nbsp;</td><td><INPUT type='submit' value='wijzigen'></td></tr>
</table>
</form>";





}

?>
</BODY>
</HTML>
