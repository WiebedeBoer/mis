<?php

if (isset($_COOKIE["person"]) && isset($_COOKIE["keys"])){
if (filter_var($_COOKIE["person"], FILTER_SANITIZE_STRING)){
if (filter_var($_COOKIE["keys"], FILTER_SANITIZE_STRING)){
$you = $_COOKIE['person'];
$mykey = $_COOKIE['keys'];

//DATABASE CONNECTION VARIABLES
include("../includes/connect.php");

// Create connection
$conn = new mysqli($myserver, $myname, $mypassword, $mydb);

// Check connection
if ($conn->connect_error) {

}
else {


/*SQL CONNECTION*/
/*
$con = mysql_connect("$myserver","$myname","$mypassword");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
echo '<P class="error">Could not connect</P>';

  }
else {

//DATABASE SELECTION
$selector = mysql_select_db($mydb, $con);
if (!$selector)
{
  die('Could not select database: ' . mysql_error());
echo '<P class="error">Could not select database</P>';

}
else {
*/


/*FETCHING KEY*/
/*
$resultkey = mysql_query("SELECT * FROM Users WHERE Username ='$you'");
$rowkey = mysql_fetch_array($resultkey);
$tabkey = $rowkey['Cokey'];
$user_cat = $rowkey['Category'];
*/


//COUNT USER
$cquery = "SELECT COUNT(*) AS usercheck, ID, Cokey, Category FROM Users WHERE Username = ?";
$cid = $conn->prepare($cquery);
$cid->bind_param('s', $you);
$cid->execute();
$cid->bind_result($usercheck, $user_id, $tabkey, $user_cat);
$cid->fetch();
$cid->close();


/*
$resultckey = mysql_query("SELECT COUNT(*) AS usercheck, ID, Password, Cokey FROM Users WHERE Username ='$you'");
$rowckey = mysql_fetch_array($resultckey);
$usercheck = $rowckey['usercheck'];
*/

if ($usercheck ==1){

/*
$resultkey = mysql_query("SELECT * FROM Users WHERE Username ='$you'");
$rowkey = mysql_fetch_array($resultkey);
$tabkey = $rowkey['Cokey'];
$user_cat = $rowkey['Category'];
*/

if ($mykey ==$tabkey){


$connected =1;

//end key check
}
else {
echo '<P class="error">Geen geldige key</P>';
}

//end user check
}
else {
echo '<P class="error">Een dergelijk gebruikersnaam is niet gevonden in de database</P>';
}

/*
}
*/
}

//cookie checks
}
else {
echo '<P class="error">Geen geldige cookie key string</P>';
}

}
else {
echo '<P class="error">Geen geldige cookie user string</P>';
}

}
else {
echo '<P class="error">Geen cookie gevonden<BR><A HREF="index.php">Login</A></P>';
}

?>
