<?php
session_start();
$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);
while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
	$_SESSION['id']=$msg['id'];

}

$ids=$_SESSION['id'];
$idLog=$msg['idLog'];
?>
 <?php
 // va chercher mon fichier bdd
include("../bdd/db.php");

if(isset($_POST['msg_id']))
{
$id=$_POST['msg_id'];

$com=mysql_query("SELECT DISTINCT * from comments where msg_id_fk='$id' order by com_id DESC");
while($r=mysql_fetch_array($com))
{
$c_id=$r['com_id'];
$comment=$r['comments'];
?>
<?php
$idLog=$msg['idLog'];
$pseudo=$msg['pseudo'];
?>

<div class="comment_ui" >
	<div class="comment_text">
		<div  class="comment_actual_text">
			<img class="avatar" src="../auth-photos/<?php print $ids; ?>images.jpg" />
			<div id="comment_post"><?php echo $comment; ?>
			</div>
		</div>
	</div>
</div>


<?php
}
}
?>
<div class="add_comment">
	<div>
		<img src="../auth-photos/<?php print $ids; ?>images.jpg" id="profil_img" />

		<form action="../actu/savecomment.php" method="post">
			<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
			<input name="mcomment" type="text" placeholder="..." id="largeur_input_comment" />
			<input id="Envoyer" name="" type="submit" value="Envoyer" />
		</form>
	</div>
</div>
