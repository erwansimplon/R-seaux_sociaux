<?php
connexion_bd();
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
$url_id = $_GET['id'];
$url_pseudo = $_GET['pseudo'];
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
			var id_session = <?php echo $id; ?>;
			var url_id = <?php echo $url_id; ?>;
			if(id_session != url_id){
				var url_pseud = <?php echo chr(39).$url_pseudo.chr(39); ?>;
			}
			else if(id_session == url_id){
				var url = "id="+url_id+"&msg_id="+ ID;
			}
			else{
				var url = "id="+url_id+"&pseudo="+url_pseud+"&msg_id="+ ID;
			}
			$.ajax({
			type: "POST",
			url: "../actu-page-user/viewajax.php",
			data: url,
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
			<?php if($id == $idLog){ ?>
				<li class="li_user_msg">
				<!-- formulaire qui permet a l'utilisateur de poster les message -->
					<form action="../actu-page-user/savemessage.php?idlog=<?php echo $url_id;?>" method="post">
						<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
						<input id="POST" name="POST" type="submit" value="Publier" />
					</form>
				</li>
			<?php }
			else{
			?>
			<li class="li_user_msg">
			<!-- formulaire qui permet a l'utilisateur de poster les message -->
				<form action="../actu-page-user/savemessage.php?idlog=<?php echo $url_id;?>&pseudo=<?php echo $url_pseudo; ?>" method="post">
					<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
					<input id="POST" name="POST" type="submit" value="Publier" />
				</form>
			</li>

<?php
}
// va cherche le fichier connection

//séléctionne les message de la page privé pour les afficher
// jointure qui relie l'utilisateurs a c'est message
$req="SELECT DISTINCT l.pseudo, m.msg_id, m.jointure, m.message, m.idLog FROM LOGIN AS l INNER JOIN msg AS m ON l.id = m.IdLog WHERE m.jointure = $url_id order by m.msg_id DESC";
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
			if($id == $url_id){
				if($id == $idLog){ ?>
					<a href="../actu-page-user/delete_msg_user.php?msg_id=<?php echo $id_msg; ?>&id=<?php echo $url_id; ?>"><h3 class="suppr_msg">X</h3></a>
			<?php
				}
			}

			elseif ($id != $url_id){
				if($id == $idLog){ ?>
					<a href="../actu-page-user/delete_msg_user.php?msg_id=<?php echo $id_msg; ?>&pseudo=<?php echo $url_pseudo; ?>&id=<?php echo $url_id; ?>"><h3 class="suppr_msg">X</h3></a>
			<?php
				}
			}
		?>

			<a href="<?php $hachage = $idLog;
					$URL_NEWS = "../page-user/page-user.php?id=".$hachage."&pseudo=".$idm;
					print $URL_NEWS;?>"><?php print '<p><strong>'.$idm.'</strong></p></a>';
			echo '<br>'.$msgcontent; //affiche le message
			?>
		<div id="message_conteneur">

<?php

$sql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN comm AS c ON l.id = c.idLog where c.msg_id_fk='$id_msg' order by c.com_id ASC");
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
$listsql=mysql_query("SELECT DISTINCT l.pseudo, c.com_id, c.comments, c.msg_id_fk, c.idlog FROM LOGIN AS l INNER JOIN comm AS c ON l.id = c.idLog where c.msg_id_fk='$id_msg' order by c.com_id ASC limit $second_count,2 ");
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
			<?php
				if($id == $url_id){
					if($id == $idLog_com){ ?>
				<a href="../actu-page-user/delete_comment_user.php?com_id=<?php echo $c_id; ?>&id=<?php echo $url_id; ?>"><h3 class="suppr_msg">X</h3></a>
				<?php
					}
				}
				elseif ($id != $url_id){
					if($id == $idLog_com){ ?>
						<a href="../actu-page-user/delete_comment_user.php?com_id=<?php echo $c_id; ?>&pseudo=<?php echo $url_pseudo; ?>&id=<?php echo $url_id; ?>"><h3 class="suppr_msg">X</h3></a>
				<?php
					}
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
				echo '<img class="avatar" alt="avatar" src="../photos/miniature/'.$id.$image.'images.jpg"/>';
				}
				else {
				echo '<img class="avatar" style="float:left;" alt="avatar" src="../photos/miniature/'.$image.'images.jpg"/>';
			}

				if($id==$url_id){?>
				<form action="../actu-page-user/savecomment.php?idlog=<?php echo $url_id;?>" method="post">
					<input name="mesgid" type="hidden" value="<?php echo $id_msg ?>" />
					<input name="mcomment" id="text_comment" type="text" placeholder="..." />
					<input id="Envoyer" class="envoyer-color" name="" type="submit" value="Envoyer" />
				</form>
				<?php }
				else{ ?>
					<form action="../actu-page-user/savecomment.php?idlog=<?php echo $url_id;?>&pseudo=<?php echo $url_pseudo; ?>" method="post">
						<input name="mesgid" type="hidden" value="<?php echo $id_msg ?>" />
						<input name="mcomment" id="text_comment" type="text" placeholder="..." />
						<input id="Envoyer" class="envoyer-color" name="" type="submit" value="Envoyer" />
					</form>
			<?php	}?>
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
