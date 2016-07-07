<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="script.js"></script>
  </head>
  <body>

  <div class="chat_box">
	<div class="chat_head">Channel</div>
		<div class="chat_body">
			<div class="user">  
			<?php
            			$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=6");
        			while($liste = mysql_fetch_array($membre)){

              			echo $liste['pseudo'].'<br />';

          			}

          		?>
        	</div>
        </div>

	<div class="chat_body1">
		<div class="user1">  
		<?php
    			$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=16");
    			while($liste = mysql_fetch_array($membre)){

        		echo $liste['pseudo'].'<br />';

         		}

        	?>
        	</div>
        </div>

	<div class="chat_body2">
		<div class="user2">  
		<?php
      			$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=8");
      			while($liste = mysql_fetch_array($membre)){

          		echo $liste['pseudo'].'<br />';

                	}

                ?>
                </div>

	</div>
</div>


<div class="msg_box">
	<div class="msg_head">
    		<div class="close">x</div>
    		<?php
              		$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=6");
          		while($liste = mysql_fetch_array($membre)){

        		echo $liste['pseudo'].'<br />';

          		}

          	?>
          	</div>
          	
        	<div class="msg_body">

            	<?php

            	header("Content-Type: text/html; charset=utf-8");
            	mysql_connect("localhost","u539698594_root","erwan01250");
            	mysql_select_db("u539698594_test");
            	if (isset($_POST['message']));
            	{
                	if (empty($_POST['message']));
                	{
                    		$message = mysql_real_escape_string(utf8_decode($_POST['message']));
                		 mysql_query("INSERT INTO minichat(message,timestamp)
                    		VALUES('$message', '".time()."')");
                	}
            	}
            	
            	$reponse = mysql_query("SELECT * FROM minichat");
            	while($val = mysql_fetch_array($reponse))
            	{
            	echo '<p class ="msg_a">
            	à '.date('H\:i',$val['timestamp']).' : '. htmlentities(stripslashes($val['message'])) .'</p>';
            	}
            	
            	?>

            	<div class="msg_footer" id="message">

                	<form action="user.php" method="post">

                    	<p>

                    		<label class ="message_P" for="message">Message :</label>
                    		<textarea class="msg_input" rows="4" type="text" name="message" id="message_P"></textarea>
                    		<input type="submit" value="Envoyer" />

                	</p>

              		</form>
            	</div>
          	</div>
</div>

<div class="msg_box1">
	<div class="msg_head1">
		<div class="close1">x</div>
			<?php
              			$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=16");
          			while($liste = mysql_fetch_array($membre)){

                		echo $liste['pseudo'].'<br />';

            			}

           		?>
        </div>
           	<div class="msg_body1">


             	<?php

             	header("Content-Type: text/html; charset=utf-8");
             	mysql_connect("localhost","u539698594_root","erwan01250");
             	mysql_select_db("u539698594_test");
             	if (isset($_POST['message']));
             	{
                	if (empty($_POST['message']));
                	{
                     	$message = mysql_real_escape_string(utf8_decode($_POST['message']));
                     	mysql_query("INSERT INTO minichat(message,timestamp)
                     	VALUES('$message', '".time()."')");
                 	}
             	}
             	$reponse = mysql_query("SELECT * FROM minichat");
             	while($val = mysql_fetch_array($reponse))
             	{
             		echo '<p class ="msg_a">
             		à '.date('H\:i',$val['timestamp']).' : '. htmlentities(stripslashes($val['message'])) .'</p>';
             	}
             	
             	?>

             	<div class="msg_footer" id="message">

                 	<form action="user.php" method="post">

                     	<p>

                     		<label class ="message_P" for="message">Message :</label>
                     		<textarea class="msg_input" rows="4" type="text" name="message" id="message_P"></textarea>
                     		<input type="submit" value="Envoyer" />

                 	</p>

               		</form>
             	</div>
           	</div>
</div>

<div class="msg_box2">
  	<div class="msg_head2">
      		<div class="close2">x</div>
      			<?php
               		$membre = mysql_query("SELECT `id`,`pseudo` FROM `LOGIN` WHERE id=8");
           		while($liste = mysql_fetch_array($membre)){

                 	echo $liste['pseudo'].'<br />';

                       	}

                      	?>

	</div>
	
	<div class="msg_body2">


		<?php

		header("Content-Type: text/html; charset=utf-8");
		mysql_connect("localhost","u539698594_root","erwan01250");
		mysql_select_db("u539698594_test");

		if (isset($_POST['message']));
		{
    			if (empty($_POST['message']));
    			{
        		$message = mysql_real_escape_string(utf8_decode($_POST['message']));
        		mysql_query("INSERT INTO minichat(message,timestamp)
        		VALUES('$message', '".time()."')");
    			}
		}
		$reponse = mysql_query("SELECT * FROM minichat");
		while($val = mysql_fetch_array($reponse))
		{
  			echo '<p class ="msg_a">
  			à '.date('H\:i',$val['timestamp']).' : '. htmlentities(stripslashes($val['message'])) .'</p>';
		}
		
		?>

	<div class="msg_footer" id="message">

    		<form action="user.php" method="post">

        	<p>

        		<label class ="message_P" for="message">Message :</label>
        		<textarea class="msg_input" rows="4" type="text" name="message" id="message_P"></textarea>
        		<input type="submit" value="Envoyer" />

    		</p>

  		</form>
	</div>
</div>
</div>
</body>
</html>
