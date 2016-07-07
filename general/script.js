/* jquery en cours de modification pour permettre d'afficher tous les amis et 
de pouvoir ouvrir les conversation quand on clic sur le pseudo actuellements réussi mais pas optimiser */

$(document).ready(function(){

	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
		$('.chat_body1').slideToggle('slow');
		$('.chat_body2').slideToggle('slow');
	});
	
	$('.msg_head').click(function(){
		$('.msg_body').slideToggle('slow');
	});

	$('.msg_head1').click(function(){
		$('.msg_body1').slideToggle('slow');
	});

	$('.msg_head2').click(function(){
		$('.msg_body2').slideToggle('slow');
	});

	$('.close').click(function(){
		$('.msg_box').hide();
	});

	$('.close1').click(function(){
		$('.msg_box1').hide();
	});

	$('.close2').click(function(){
		$('.msg_box2').hide();
	});

	$('.user').click(function(){

		$('.msg_wrap').show();
		$('.msg_box').show();
	});

	$('.user1').click(function(){

		$('.msg_wrap').show();
		$('.msg_box1').show();
	});

	$('.user2').click(function(){

		$('.msg_wrap').show();
		$('.msg_box2').show();
	});

	$('textarea').keypress(
		
    	function(e){
        	if (e.keyCode == 13) {
            	e.preventDefault();
            	var msg = $(this).val();
			$(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');

        }
    });

});
