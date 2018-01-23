<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
include("head.php");
?>
</HEAD>
<BODY>

<H1 class="indexer">Pagina beheer</H1><P style="color:#0000ff"><A HREF="beheer.php" class="bl">Terug</A> naar beheer</P>

<h2>Styling</h2>

<?php
include("connect.php");
if ($connected ==1){
if ($user_cat =="superadmin" || $user_cat =="admin"){
if (isset($_POST["style"]) && filter_var($_POST["style"], FILTER_SANITIZE_STRING)){
        $style = $_POST["style"];
        $query = "UPDATE SEO SET style=?";
        $qstyle = $conn->prepare($query);
        $qstyle->bind_param('s', $style);
        $qstyle->execute();
        $qstyle->close();
        echo 'Stylesheer successvol geupdate na > '.$style;
    }

//select
$cquery = "SELECT Style FROM Seo WHERE ID = '1'";
$cid = $conn->prepare($cquery);
$cid->execute();
$cid->bind_result($stylesheet);
$cid->fetch();
$cid->close();
if ($stylesheet == "") {
    echo '<p style="color:red">GEEN STYLESHEET IS GEDEFINEERD, VERANDER DIT SNEL</p>';
    echo '<br/>';
}
$files = glob('../styles/*.css');
$files = str_replace('../styles/','', $files);
echo '<form action="styling.php" method="post">';
echo '<select name="style">';
    echo '<option value="'.$stylesheet.'" selected>'.$stylesheet.'</option>';
    foreach($files as $value){
        if ($stylesheet != $value){
            echo'<option value="'.$value.'">'.$value.'</option>';
        }
    }
echo '</select>';
echo '<br/>';
echo '<button>save</button>';
}else {
    echo 'jij mag hier niet zijn. wegwezen';
}
}else {
    echo 'Dikke error. zoek contact met uw syteem beheerder.';
}
?>
</BODY>
</HTML>
