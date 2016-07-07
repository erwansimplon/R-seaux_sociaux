<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/actu-style.css" type="text/css" media="screen"/>
		<!-- appel de ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(function()
			{
			$(".view_comments").click(function()
			{

			var ID = $(this).attr("id");

			$.ajax({
			type: "POST",
			url: "../user/viewajax.php",
			data: "msg_id="+ ID,
			cache: false,
			success: function(html){
			$("#view_comments"+ID).prepend(html);
			$("#view"+ID).remove();
			$("#two_comments"+ID).remove();
			}
			});

			return false;
			});
			});
		</script>
		<!-- du script ajax -->
	</head>

	<body>
		<ol>
			<li>
			<!-- formulaire qui permet a l'utilisateur de poster les message -->
				<form action="../user/savemessage.php" method="post">
					<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
					<input id="POST" name="POST" type="submit" value="POST" />
				</form>
			</li>

<?php
// va cherche le fichier connection 
include("../bdd/conexion_bdd.php");
//séléctionne les message de la page privé pour les afficher 
$msql=mysql_query("select * from msg order by msg_id desc");
while($messagecount=mysql_fetch_array($msql))
{
$id=$messagecount['msg_id'];
$msgcontent=$messagecount['message'];
?>

<li class="comment_envoyer">

	<div class="comment_squelette">
		<h3 class="Message" >
			<?php
			//Si le membre possède une image, on l'affiche
			if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
			echo '<img class="avatar" style="float:left;" alt="avatar" 
			src="../auth-photos/'.$id.$image.'images.jpg"/>';
			}
			?>
			<strong><?php echo $pseudo; ?></strong>
			<p><?php echo $msgcontent; ?></p>

		<div id="message_conteneur">

<?php

$sql=mysql_query("select * from comm where msg_id_fk='$id' order by com_id DESC");
$comment_count=mysql_num_rows($sql);

if($comment_count>2)
{
$second_count=$comment_count-2;
?>

		<div class="comment_ui" id="view<?php echo $id; ?>">
			<div>
				<a href="#" class="view_comments" id="<?php echo $id; ?>">
					Voir les <?php echo $comment_count; ?> autres commentaires</a>
			</div>
		</div>

<?php
}
else
{
$second_count=0;
}
?>

		<div id="view_comments<?php echo $id; ?>"></div>

		<div id="two_comments<?php echo $id; ?>">

<?php
$listsql=mysql_query("select * from comm where msg_id_fk='$id' order by com_id DESC limit $second_count,2 ");
while($rowsmall=mysql_fetch_array($listsql))
{
$c_id=$rowsmall['com_id'];
$comment=$rowsmall['comments'];
?>

		<div class="comment_ui">

		<div class="comment_text">
			<div  class="comment_actual_text">
				<?php
				//Si le membre possède une image, on l'affiche
				if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
				echo '<img class="avatar" style="float:left;" alt="avatar" 
				src="../auth-photos/'.$id.$image.'images.jpg"/>';
				}
				?>
				<div id="comment_post">
					<?php echo $comment; ?>
				</div>
			</div>
		</div>
	</div>

<?php 
}
?>
		<div class="add_comment">
			<div>
				<?php
				//Si le membre possède une image, on l'affiche
				if (file_exists('../auth-photos/'.$id.$image.'images.jpg')){
				echo '<img class="avatarcom" alt="avatar" src="../auth-photos/'.$id.$image.'images.jpg"/>';
				}
				?>
				<form action="../user/savecomment.php" method="post">
					<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
					<input name="mcomment" id="text_comment" type="text" placeholder="..." />
					<input id="Envoyer" name="" type="submit" value="Envoyer" />
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</li>
<?php
}
?>
</ol>

</body>
</html>
