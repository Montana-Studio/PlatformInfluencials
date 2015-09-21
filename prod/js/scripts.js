jQuery(document).ready(function($){
	//PARA CERRAR
	$('.btn_close').click(function(){
		$('#antiguo').fadeOut(100).animate({
			opacity:0,
			width:0,
		},{duration:1000,complete:function(){
			$('#antiguo h2').remove();
			$('#antiguo a, #antiguo .form_ingreso, #antiguo .btn_close').hide();
		}});
	});

	$('#acceder').click(function(){
		$('#antiguo a').hide();
		$('#antiguo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'70%'
		},{duration:1000, complete:function(){
				/*$('#antiguo h2').show().delay(100).typewriter({
					'speed':200
				});*/
				var typeContainer = '#antiguo h2';
				function typeWriter(text, n) {
				  if (n < (text.length)) {
				    $('#antiguo h2').html(text.substring(0, n+1));
				    n++;
				    setTimeout(function() {
				      typeWriter(text, n);
				    }, 100);
				  }
				}

				//e.stopPropagation();  
				var text = $('#antiguo h2').data('text');
				typeWriter(text, 0);

				$('#antiguo a, #antiguo .form_ingreso, #antiguo .btn_close').delay(1800).fadeIn(500);	
			}
		});
	});
});