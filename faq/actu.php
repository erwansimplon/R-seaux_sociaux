<?php
$req="SELECT * FROM LOGIN WHERE pseudo='".mysql_real_escape_string(stripcslashes($_SESSION['pseudo']))."'
AND pass='".mysql_real_escape_string($_SESSION['pass'])."'
AND valide='".mysql_real_escape_string(1)."'";

$affiche = mysql_query($req);
//$result = mysql_fetch_assoc($affiche);
while($msg=mysql_fetch_array($affiche, MYSQL_ASSOC))
{
$_SESSION['id']=$msg['id'];

}

$id=$_SESSION['id'];

html();
?>
	<head>
		<?php head_actu_style(); ?>
		<script type="text/javascript">
			$(function()
			{
			$(".view_comments").click(function()
			{

			var ID = $(this).attr("id");

			$.ajax({
			type: "POST",
			url: "viewajax.php",
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
			<li class="li_user_msg">
			<!-- formulaire qui permet a l'utilisateur de poster les message -->
				<form action="savemessage.php" method="post">
					<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
					<input id="POST" name="POST" type="submit" value="Publier" />
				</form>
			</li>

<?php
// va cherche le fichier connection
connexion_bd();

//séléctionne les message de la page privé pour les afficher
// jointure qui relie l'utilisateurs a c'est message
$req="SELECT DISTINCT l.pseudo, m.msg_id, m.message, m.idLog FROM LOGIN AS l INNER JOIN faq AS m ON l.id = m.idLog order by m.msg_id DESC";
// $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";

$msql=mysql_query($req);


//bug a corrigé les 2 boucles while on un confli
while($msg=mysql_fetch_array($msql, MYSQL_ASSOC))
{
	$id_msg=$msg['msg_id'];
	$msgcontent=strip_tags($msg['message']);

?>

<li class="comment_envoyer">

	<div class="comment_squelette">
		<h3 class="Message" >
			<?php
			$idLog=$msg['idLog'];
			$pseudo=$msg['pseudo'];
			//Si le membre possède une image, on l'affiche

			if (file_exists('../photos/miniature/'.$idLog.$image.'images.jpg')){
			echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$idLog.$image.'images.jpg"/>';
			}
			else {
			echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
		}
			$idm=$msg['pseudo'];
			if ($id == $idLog){?>
			<a href="delete_msg_faq.php?msg_id=<?php echo $id_msg; ?>"><h3 class="suppr_msg">X</h3></a>
			<?php } ?>
			<a href="<?php $hachage = $idLog;
					$URL_NEWS = "../page-user/page-user.php?id=".$hachage."&pseudo=".$idm;
					print $URL_NEWS;?>"><?php print '<p><strong>'.$idm.'</strong></p></a>';
			echo '<br>'.$msgcontent; //affiche le message
			?>
		<div id="message_conteneur">

<?php

$sql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN faq_comm AS c ON l.id = c.idLog where c.msg_id_fk='$id_msg' order by c.com_id ASC");
$comment_count=mysql_num_rows($sql);

if($comment_count>2)
{
$second_count=$comment_count-2;
?>

		<div class="comment_ui" id="view<?php echo $id_msg; ?>">
			<div>
				<a href="#" class="view_comments" id="<?php echo $id_msg; ?>"><p>
					Voir les <?php echo $comment_count; ?> autres commentaires</p></a>
			</div>
		</div>

<?php
}
else
{
$second_count=0;
}
?>

		<div id="view_comments<?php echo $id_msg; ?>"></div>

		<div id="two_comments<?php echo $id_msg; ?>">

<?php
$listsql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN faq_comm AS c ON l.id = c.idLog where c.msg_id_fk='$id_msg' order by c.com_id ASC limit $second_count,2 ");
while($rowsmall=mysql_fetch_array($listsql))
{
$c_id=$rowsmall['com_id'];
$comment=strip_tags($rowsmall['comments']);
$idLog_com=$rowsmall['idlog'];
$ps=$rowsmall['pseudo'];
?>

		<div class="comment_ui">

		<div class="comment_text">
			<div  class="comment_actual_text">
				<?php if ($id == $idLog_com){ ?>
				<a href="delete_comment_faq.php?com_id=<?php echo $c_id; ?>"><h3 class="suppr_msg">X</h3></a>
				<?php
				}
				//Si le membre possède une image, on l'affiche
				if (file_exists('../photos/miniature/'.$idLog_com.$image.'images.jpg')){
				echo '<img class="avatar" style="float:left;" alt="avatar"
				src="../photos/miniature/'.$idLog_com.$image.'images.jpg"/>';
				}
				else {
				echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
			}
				?>
				<div id="comment_post"><b><?php echo $ps.'</b><br>'.$comment; ?></div>
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
				if (file_exists('../photos/miniature/'.$id.$image.'images.jpg')){
					echo '<img class="avatar" style="float:left;" alt="avatar"
					src="../photos/miniature/'.$id.$image.'images.jpg"/>';
				}
				else {
				echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
			}
				?>
				<form action="savecomment.php" method="post">
					<input name="mesgid" type="hidden" value="<?php echo $id_msg ?>" />
					<input name="mcomment" id="text_comment" type="text" placeholder="..." />
					<input id="Envoyer" class="envoyer-color" name="" type="submit" value="Envoyer" />
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
