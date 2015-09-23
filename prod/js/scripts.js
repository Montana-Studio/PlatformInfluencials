jQuery(document).ready(function($){
	//PARA CERRAR
	$('.btn_close').click(function(){
		$('#antiguo, #nuevo').fadeOut(100).animate({
			opacity:0,
			width:0,
		},{duration:1000,complete:function(){
			$('#antiguo h2, #antiguo a, #antiguo .form_ingreso, #antiguo .btn_close, #nuevo a,#nuevo h2, #nuevo .registerForm, #nuevo .btn_close').hide();
		}});
	});

	$('#acceder').on('click',function(){
		
		$('#antiguo a').hide();
		$('#antiguo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'70%'
		},{duration:1000, complete:function(){

				$('#antiguo a,#antiguo h2, #antiguo .form_ingreso, #antiguo .btn_close').delay(800).fadeIn(500);	
			}
		});

	});

	$('#registrar').on('click',function(){
		
		$('#nuevo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'100%'
		},{duration:1000, complete:function(){

				$('#nuevo a,#nuevo h2, #nuevo .registerForm, #nuevo .btn_close').delay(800).fadeIn(500);	
			}
		});
		
	});

	//BTN Upload IMG
	$('#searchImg').on('click', function(e){
        e.preventDefault();
        $('#file').trigger('click');
    });

	//MENU
	$('.menu').on('click',function(){
		$('#imagenform').show('fast').delay(100).animate({
			top:50,
			opacity:1
		});
	});

});