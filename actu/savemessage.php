
<?php
include("../bdd/db.php");
session_start();

$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";


print "recup session = $req";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);
while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
$_SESSION['id']=$msg['id'];
$_SESSION['pseudo']=$msg['pseudo'];
$_SESSION['pass']=$msg['pass'];
}

$id=$_SESSION['id'];

$msgcon=$_POST['message'];
$req="INSERT INTO messages (message, idLog) VALUES ('$msgcon', '$id')";
print $req;
print "<br>pseudo = ".$_SESSION['pseudo'];
print "<br>id = ".$id;

mysql_query($req);
header("location: ../general/user.php");
?>
