function backHistory(){
	//HISTORY BTN
	window.history.back();
}
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
		
		$('#antiguo #username').attr('autofocus','autofocus');

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

	//MENU
	$('.menu').on('click',function(){
		$('#guardarFacturacion, #inicio .cancel-data').css('display','none');
		$('#imagenform').css('top','0').show('fast').delay(100).animate({
			top:50,
			opacity:1
		});
	});

	//EDITAR DATOS
	$('#imagenform .misdatos .datos .editar').on('click',function(){
		$('#guardarFacturacion, #inicio .cancel-data').slideDown();
		$('#inicio .tabpage div i').css('display','block').animate({
			right:'3px',
			opacity:1
		});
		$('#imagenform .misdatos .imagen .selectFile').animate({
			width:'30px',
			height:'30px'
		},{complete:function(){
			$('#imagenform .misdatos .imagen .selectFile i').animate({opacity:1});	
		}});
	});
	$('#inicio .cancel-data, #imagenform .btn_close').on('click',function(){
		$('#guardarFacturacion, #inicio .cancel-data').slideUp();

		$('#imagenform .misdatos .imagen .selectFile i').animate({
			opacity:0
		},{complete:function(){
			$('#imagenform .misdatos .imagen .selectFile').animate({
				width:0,
				height:0
			});	
		}});
		$('#inicio .tabpage div i').animate({
			right:'10px',
			opacity:0
		},{complete:function(){
			$(this).css('display','none');
		}});
	});

	//EDITAR CAMAÑAS
	$('.content .tools-campana .edit-campanas').on('click',function(){
		$('.content input, .content textarea').css({'border-bottom':'1px solid #ccc'}).removeAttr('disabled');
		$('.content .inputs-campana i').show();
	});
});