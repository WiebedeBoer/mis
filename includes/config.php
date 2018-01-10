<?php

//DATABASE CONNECTION VARIABLES
include("connect.php");

/*SQL CONNECTION*/
$conn = new mysqli($myserver, $myname, $mypassword, $mydb);
if ($conn->connect_error)
  {

echo "
<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>error</title>
</HEAD>
<BODY>
<P class='error'>Could not select database</P>
</BODY>
</HTML>";
$connected = 0;
  }
else {

/*
//DATABASE SELECTION
$selector = mysql_select_db($mydb, $con);
if (!$selector)
{
  die('Could not select database: ' . mysql_error());
echo "
<!DOCTYPE HTML>
<HTML>
<HEAD>
<title>error</title>
</HEAD>
<BODY>
<P class='error'>Could not select database</P>
</BODY>
</HTML>";
$connected = 0;
}
else {
*/

$connected = 1;

/*
}
*/
}

?>


