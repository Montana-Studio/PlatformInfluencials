jQuery(document).ready(function($){

	//PARA CERRAR
	$('.btn_close').click(function(){
		$('#antiguo, #nuevo').fadeOut(100).animate({
			opacity:0,
			width:0,
			height:0
		},{duration:1000,complete:function(){
			$('#antiguo h2, #antiguo a, #antiguo .form_ingreso, #antiguo .btn_close, #nuevo a,#nuevo h2, #nuevo .registerForm, #nuevo .btn_close').hide();
		}});

		$('#imagenform').animate({
			top:0,
			opacity:0
		},{complete:function(){
			$(this).hide().css('top','-100%');
		}});
	});

	$('#acceder').on('click',function(){
		
		$('#antiguo a').hide();
		$('#antiguo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'357px'
		},{duration:500, easing:'easeInOutCirc', complete:function(){

				$('#antiguo a,#antiguo h2, #antiguo .form_ingreso, #antiguo .btn_close').delay(800).fadeIn(500);	
			}
		});

	});

	$('#registrar').on('click',function(){
		
		$('#nuevo').fadeIn(100).animate({
			opacity:1,
			width:'85%',
			height:'357px'
		},{duration:500, easing:'easeInOutCirc', complete:function(){

				$('#nuevo a,#nuevo h2, #nuevo .registerForm, #nuevo .btn_close').delay(800).fadeIn(500);	
			}
		});
		
	});

	//BTN Upload IMG
	$('#searchImg').on('click', function(e){
        e.preventDefault();
        alert('clicked');
        $('#file').trigger('click');
    });
    $('#searchImg2').on('click', function(e){
        e.preventDefault();
        alert('clicked');
        $('#file2').trigger('click');
    });

	//MENU
	$('.menu').on('click',function(){
		$('#imagenform').css('top','0').show('fast').delay(100).animate({
			top:50,
			opacity:1
		});
	});

});