
$(document).ready(function() {

	//$('.color-button').hide();
	$('.button_1').hide();
	$('.button_2').hide();
	$('.button_3').hide();
	$('.button_4').hide();
	$('.button_couleur').click(function(){
		//$('.color-button').slideToggle('slow');
		$('.button_1').slideToggle('slow');
		$('.button_2').slideToggle('slow');
		$('.button_3').slideToggle('slow');
		$('.button_4').slideToggle('slow');
	});

	$('.button_1').click(function(){
	    $('.rech').addClass("recherche_pink");
			$('.rech').removeClass("recherche_red");
			$('.rech').removeClass("recherche_green");
			$('.menu_perso').addClass("recherche_pink");
			$('.menu_perso').removeClass("recherche_red");
			$('.menu_perso').removeClass("recherche_green");
			$('.pagemenu a').addClass("recherche_pink");
			$('.pagemenu a').removeClass("recherche_red");
			$('.pagemenu a').removeClass("recherche_green");
			$('.rubrique').addClass("menu_color_pink");
			$('.rubrique').removeClass("menu_color_red");
			$('.rubrique').removeClass("menu_color_green");
			$('.pagemenu a').addClass("menu_color_pink");
			$('.pagemenu a').removeClass("menu_color_red");
			$('.pagemenu a').removeClass("menu_color_green");
			$('.sousmenu a').addClass("menu_color_pink");
			$('.sousmenu a').removeClass("menu_color_red");
			$('.sousmenu a').removeClass("menu_color_green");
			$('.menu li').addClass("menu_color_pink");
			$('.menu li').removeClass("menu_color_red");
			$('.menu li').removeClass("menu_color_green");
			$('.env_msg').addClass("recherche_pink");
			$('.env_msg').removeClass("recherche_red");
			$('.env_msg').removeClass("recherche_green");
			$('#POST').addClass("recherche_pink");
			$('#POST').removeClass("recherche_red");
			$('#POST').removeClass("recherche_green");
			$('.envoyer-color').addClass("recherche_pink");
			$('.envoyer-color').removeClass("recherche_red");
			$('.envoyer-color').removeClass("recherche_green");
			$('.chat_head').addClass("recherche_pink");
			$('.chat_head').removeClass("recherche_red");
			$('.chat_head').removeClass("recherche_green");
			var u = "0";
			while ( u <= 500 ){
				u++;
				var w = '.msg_head' + u;
				$(w).addClass("recherche_pink");
				$(w).removeClass("recherche_red");
				$(w).removeClass("recherche_green");
			}
			$('.image_loupe').attr('src','../photos/recherche/d.png');
			$('.body').addClass("body_pink");
			$('.body').removeClass("body_red");
			$('.body').removeClass("body_green");
	});
	$('.button_2').click(function(){
			$('.rech').addClass("recherche_red");
			$('.rech').removeClass("recherche_pink");
			$('.rech').removeClass("recherche_green");
			$('.menu_perso').addClass("recherche_red");
			$('.menu_perso').removeClass("recherche_pink");
			$('.menu_perso').removeClass("recherche_green");
			$('.pagemenu a').addClass("recherche_red");
			$('.pagemenu a').removeClass("recherche_pink");
			$('.pagemenu a').removeClass("recherche_green");
			$('.rubrique').addClass("menu_color_red");
			$('.rubrique').removeClass("menu_color_pink");
			$('.rubrique').removeClass("menu_color_green");
			$('.pagemenu a').addClass("menu_color_red");
			$('.pagemenu a').removeClass("menu_color_pink");
			$('.pagemenu a').removeClass("menu_color_green");
			$('.sousmenu a').addClass("menu_color_red");
			$('.sousmenu a').removeClass("menu_color_pink");
			$('.sousmenu a').removeClass("menu_color_green");
			$('.menu li').addClass("menu_color_red");
			$('.menu li').removeClass("menu_color_pink");
			$('.menu li').removeClass("menu_color_green");
			$('.env_msg').addClass("recherche_red");
			$('.env_msg').removeClass("recherche_pink");
			$('.env_msg').removeClass("recherche_green");
			$('#POST').addClass("recherche_red");
			$('#POST').removeClass("recherche_pink");
			$('#POST').removeClass("recherche_green");
			$('.envoyer-color').addClass("recherche_red");
			$('.envoyer-color').removeClass("recherche_pink");
			$('.envoyer-color').removeClass("recherche_green");
			$('.chat_head').addClass("recherche_red");
			$('.chat_head').removeClass("recherche_pink");
			$('.chat_head').removeClass("recherche_green");
			var s = "0";
			while ( s <= 500 ){
				s++;
				var t = '.msg_head' + s;
				$(t).addClass("recherche_red");
				$(t).removeClass("recherche_pink");
				$(t).removeClass("recherche_green");
			}
			$('.image_loupe').attr('src','../photos/recherche/b.png');
			$('.body').addClass("body_red");
			$('.body').removeClass("body_pink");
			$('.body').removeClass("body_green");
	});
	$('.button_3').click(function(){
			$('.rech').addClass("recherche_green");
			$('.rech').removeClass("recherche_pink");
			$('.rech').removeClass("recherche_red");
			$('.menu_perso').addClass("recherche_green");
			$('.menu_perso').removeClass("recherche_pink");
			$('.menu_perso').removeClass("recherche_red");
			$('.pagemenu a').addClass("recherche_green");
			$('.pagemenu a').removeClass("recherche_pink");
			$('.pagemenu a').removeClass("recherche_red");
			$('.rubrique').addClass("menu_color_green");
			$('.rubrique').removeClass("menu_color_pink");
			$('.rubrique').removeClass("menu_color_red");
			$('.pagemenu a').addClass("menu_color_green");
			$('.pagemenu a').removeClass("menu_color_pink");
			$('.pagemenu a').removeClass("menu_color_red");
			$('.sousmenu a').addClass("menu_color_green");
			$('.sousmenu a').removeClass("menu_color_pink");
			$('.sousmenu a').removeClass("menu_color_red");
			$('.menu li').addClass("menu_color_green");
			$('.menu li').removeClass("menu_color_pink");
			$('.menu li').removeClass("menu_color_red");
			$('.env_msg').addClass("recherche_green");
			$('.env_msg').removeClass("recherche_pink");
			$('.env_msg').removeClass("recherche_red");
			$('#POST').addClass("recherche_green");
			$('#POST').removeClass("recherche_red");
			$('#POST').removeClass("recherche_pink");
			$('.envoyer-color').addClass("recherche_green");
			$('.envoyer-color').removeClass("recherche_red");
			$('.envoyer-color').removeClass("recherche_pink");
			$('.chat_head').addClass("recherche_green");
			$('.chat_head').removeClass("recherche_red");
			$('.chat_head').removeClass("recherche_pink");
			var k = "0";
			while ( k <= 500 ){
				k++;
				var kt = '.msg_head' + k;
				$(kt).addClass("recherche_green");
				$(kt).removeClass("recherche_red");
				$(kt).removeClass("recherche_pink");
			}
			$('.image_loupe').attr('src','../photos/recherche/c.png');
			$('.body').addClass("body_green");
			$('.body').removeClass("body_red");
			$('.body').removeClass("body_pink");
	});
	$('.img_ajout_amis').click(function(){
				$('.img_ajout_amis').attr('src','../photos/icon/remove_user.png');
				$('.img_ajout_amis').attr('href','../ajout-amis/suppr-amis.php?id=$idlog&pseudo=$pseudo');
	});
});

//add class pour pagemenu
