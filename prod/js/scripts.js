jQuery(document).ready(function($){
	//PARA CERRAR
	$('.btn_close').click(function(){
		$('#antiguo').fadeOut(100).animate({
			opacity:0,
			width:0,
		},{duration:1000,complete:function(){
			$('#antiguo h2, #antiguo a, #antiguo .form_ingreso, #antiguo .btn_close').hide();
		}});
	});

	$('#acceder').on('click',function(){
		
		$('#antiguo a').hide();
		$('#antiguo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'70%'
		},{duration:1000, complete:function(){

				$('#antiguo a,#antiguo h2, #antiguo .form_ingreso, #antiguo .btn_close').delay(1800).fadeIn(500);	
			}
		});

	});

	$('#registrar').on('click',function(){
		
		$(this).fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'70%'
		},{duration:1000, complete:function(){

				$('#nuevo a,#nuevo h2, #nuevo .form_ingreso, #nuevo .btn_close').delay(1800).fadeIn(500);	
			}
		});
		
	});
});