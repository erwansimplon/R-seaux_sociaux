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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/actu-style.css" type="text/css" media="screen"/>
		<!-- ajax pour les messages et commentaires envoyer par l'utilisateur -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(function()
			{
			$(".view_comments").click(function()
			{

			var ID = $(this).attr("id");

			$.ajax({
			type: "POST",
			url: "../actu/viewajax.php",
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
		<!-- fin ajax -->
	</head>

	<body>

	<ol>
	<!-- formulaire pour que l'utilisateur puisse taper son message et l'envoyer -->
		<li class="li_msg">
			<form action="../actu/savemessage.php" method="post">
				<textarea class="editbox" cols="23" rows="3" name="message"></textarea><br />
				<input id="POST" name="POST" type="submit" value="POST" />
			</form>
		</li>
	<!-- fin -->
				<?php
				// recupération du fichier connection
				include("../bdd/db.php");
					// jointure qui relie l'utilisateurs a c'est message
					$req="SELECT DISTINCT l.pseudo, m.msg_id, m.message, m.idLog FROM LOGIN AS l INNER JOIN messages AS m ON l.id = m.idLog order by m.msg_id DESC";
					// $req ="insert into messages (message, IdLog) VALUES ('Mon message','$id')";

					$msql=mysql_query($req);


					//bug a corrigé les 2 boucles while on un confli
						while($msg=mysql_fetch_array($msql, MYSQL_ASSOC))
						{
							$id_msg=$msg['msg_id'];
							$msgcontent=$msg['message'];
				?>
						<!-- structure des message poster par l'utilisateur -->
						<li class="comment_envoyer">

							<div class="comment_squelette">
								<!-- contenu du message poster -->
								<h3 class="Message" >

									<?php
									$idLog=$msg['idLog'];
									$pseudo=$msg['pseudo'];
									//Si le membre possède une image, on l'affiche

									if (file_exists('../auth-photos/'.$idLog.$image.'images.jpg')){
										echo '<img class="avatar" style="float:left;" alt="avatar" src="../auth-photos/'.$idLog.$image.'images.jpg"/>';
									}


									$idm=$msg['pseudo'];
									print '<strong>'.$idm.'</strong>';//affiche le pseudo en gras
									echo '<br>'.$msgcontent; //affiche le message
									?>

									<div id="message_conteneur">

										<?php
										// affiche les commentaires dessous du message correspondant
										$sql=mysql_query("SELECT DISTINCT * from comments where msg_id_fk='$id_msg' order by com_id");
										$comment_count=mysql_num_rows($sql);


										/* permet de voir que 2 commentaires sous les messsage et on doit cliquer sur la div class="comment_ui"
										pour afficher tous les commentaires */

										if($comment_count>2)
										{
											$second_count=$comment_count-2;
										?>

											<div class="comment_ui" id="view<?php echo $id_msg; ?>">
												<div>
													<a href="#" class="view_comments" id="<?php echo $id_msg; ?>">
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

											<div id="view_comments<?php echo $id_msg; ?>"></div>

											<div id="two_comments<?php echo $id_msg; ?>">

												<?php
													$listsql=mysql_query("SELECT DISTINCT * from comments where msg_id_fk='$id_msg' order by com_id limit $second_count,2 ");

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

																if (file_exists('../auth-photos/'.$idLog.$image.'images.jpg')){
																	echo '<img class="avatar" style="float:left;" alt="avatar"
																	src="../auth-photos/'.$idLog.$image.'images.jpg"/>';
																}

															?>
															<div id="comment_post"><?php echo $comment; ?></div>
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

														if (file_exists('../auth-photos/'.$idLog.$image.'images.jpg')){
															echo '<img class="avatar" style="float:left;" alt="avatar"
															src="../auth-photos/'.$idLog.$image.'images.jpg"/>';
														}

														?>
														<!-- formulaire qui permet a l'utilisateur d'écrire un commentaire -->

														<form action="../actu/savecomment.php" method="post">
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
