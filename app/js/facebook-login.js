
function agencia_ya_registrada_facebook(){
	$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("ya se encuentra registrado");
			$("#boxAlert .hrefCamp i").addClass("fa-warning");
			$("#boxAlert .hrefCamp p.messageAlert").text("Su perfil ya fue ingresado como agencia, lo contactaremos proximamente");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
			$('.siElim').text('OK');
			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			$("#clearAlert").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$(this).hide();
					window.location.reload();
				}});
			});
			$(".siElim").on("click",function(){
				window.location.href='./inicio-agencia';
			});
	});
}
function agencia(){
	$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("ya se encuentra registrado");
			$("#boxAlert .hrefCamp i").addClass("fa-warning");
			$("#boxAlert .hrefCamp p.messageAlert").text("Su perfil ya fue ingresado como agencia");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");
			$('.siElim').text('ir a agencia');
			$('.noElim').text('permanecer formulario');
			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			
				
			
			$(".siElim").on("click",function(){
				window.location.href='./inicio-agencia';
			});
			$(".noElim").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$("#boxAlert .hrefCamp .siElim").remove();
					$("#boxAlert .hrefCamp .noElim").remove();
					$(this).hide();
					$("#antiguo form .btn_close").click();
					$("#inicio #registrar").click();
					$(".form_ingreso #correo").val("");
					$(".form_ingreso #password").val("");

				}});
			});
	});
}
function influenciador(){
	$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("ya se encuentra registrado");
			$("#boxAlert .hrefCamp i").addClass("fa-warning");
			$("#boxAlert .hrefCamp p.messageAlert").text("Su perfil ya fue ingresado como influenciador");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");
			$('.siElim').text('ir a influenciador');
			$('.noElim').text('permanecer formulario');
			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			$("#clearAlert").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$(this).hide();
					$("#antiguo form .btn_close").click();
				}});
			});

			$(".siElim").on("click",function(){
				window.location.href='./inicio-influencer';
			});

			$(".noElim").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$("#boxAlert .hrefCamp .siElim").remove();
					$("#boxAlert .hrefCamp .noElim").remove();
					$(this).hide();
					$("#antiguo form .btn_close").click();
					$("#inicio #registrar").click();
					$(".form_ingreso #correo").val("");
					$(".form_ingreso #password").val("");


				}});
			});
	});
}

function influenciador_ya_registrado_facebook(){
	$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("ya se encuentra registrado");
			$("#boxAlert .hrefCamp i").addClass("fa-warning");
			$("#boxAlert .hrefCamp p.messageAlert").text("Su perfil ya fue ingresado como influenciador, lo contactaremos proximamente");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
			$('.siElim').text('OK');
			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			$("#clearAlert").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$(this).hide();
					window.location.reload();
				}});
			});
	});
}

function inscripcion_influenciador(data){
	switch (data){
				case "nuevo":
								$(".alertElim").fadeIn("normal",function(){
										$("#boxAlert .hrefCamp h2").text("Gracias por registrarte en Power-Influencers");
										$("#boxAlert .hrefCamp i").append("<img src='img/logo_pi-06.svg' width='100%' height='100%'/>");
										$("#boxAlert .hrefCamp p.messageAlert").text("Tu cuenta sera activada proximamente, pronto nos contactaremos contigo.");

										$("#boxAlert").show().animate({
											top:"20%",
											opacity:1
										},{duration:1500,easing:"easeOutBounce"});

										$("#clearAlert").on("click",function(){
											$("#boxAlert").animate({
												top:"-100px",
												opacity:0
											},{duration:500,easing:"easeInOutQuint",complete:function(){
												$(".alertElim").fadeOut("fast");
												window.location.href = "logout";
												window.location.reload();
											}});
										});
								});
				break;
				case "false":$(".alertElim").fadeIn("normal",function(){
									$("#boxAlert .hrefCamp h2").text("algo anda mal");
									$("#boxAlert .hrefCamp i").addClass("fa-warning");
									$("#boxAlert .hrefCamp p.messageAlert").text("El correo "+$('.correonuevo').val()+" ya existe en la base de datos, intente con otro.");

									$("#boxAlert").show().animate({
										top:"20%",
										opacity:1
									},{duration:1500,easing:"easeOutBounce"});

									$("#clearAlert").on("click",function(){
										$("#boxAlert").animate({
											top:"-100px",
											opacity:0
										},{duration:500,easing:"easeInOutQuint",complete:function(){
											$(".alertElim").fadeOut("fast");
											$(this).hide();
											$("#boxAlert .hrefCamp i").removeClass("fa-warning");
											$('.correonuevo').val('');
											$('.correonuevo').focus();
										}});
									});
							});
				break;
				case "invalido":$(".alertElim").fadeIn("normal",function(){
										$("#boxAlert .hrefCamp h2").text("algo anda mal");
										$("#boxAlert .hrefCamp i").addClass("fa-warning");
										$("#boxAlert .hrefCamp p.messageAlert").text("Problema con el tamaño o formato de la imagen.");

										$("#boxAlert").show().animate({
											top:"20%",
											opacity:1
										},{duration:1500,easing:"easeOutBounce"});

										$("#clearAlert").on("click",function(){
											$("#boxAlert").animate({
												top:"-100px",
												opacity:0
											},{duration:500,easing:"easeInOutQuint",complete:function(){
												$(".alertElim").fadeOut("fast");
												$("#boxAlert .hrefCamp i").removeClass("fa-warning");
												$(this).hide();
											}});
										});
								});
			}
}
$(document).ready(function(){


	var app_id = '932994110103491';
	var scopes= 'email,user_friends,manage_pages';
	var name;
	var email;
	var tipo = 1; 


	function call_facebook_api(){
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}
	
	var statusChangeCallback = function(response, callback) {
	 if(tipo == 1){
	 		if (response.status === 'connected') {
		  getFacebookData();
	    } 
	    else {
			callback(false);//no hace nada si no se conecta
	    }
	 }
	 if(tipo == 0){
	 		if (response.status === 'connected') {
		  getFacebookPages();
	    } 
	    else {
			callback(false);//no hace nada si no se conecta
	    }
	 }    
	    
	}
	
    var checkLoginState = function(callback) {	
		window.fbAsyncInit = function() {
			FB.init({
				appId      : app_id,
				cookie     : true,  
				status 	   : true,					
				xfbml      : true,  
				version    : 'v2.4' 
			});	
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response, function(data){
				callback(data);
				});
			});
		};
	};
	
	var facebookLogin= function (){
		
		checkLoginState(function(response){
			if(!response){ //no esta conectado callback false
			if( navigator.userAgent.match('CriOS') ){
   			 window.open('https://www.facebook.com/dialog/oauth?client_id='+app_id+'&scope='+scopes,'', null);
   			 getFacebookData();
			}else{
					FB.login(function (response){
				if (response.status === 'connected')
				getFacebookData();
				}, {scope: scopes});
			}

		
			};
			});
	};
	
	var facebookPages= function (){
		tipo=0;
		checkLoginState(function(response){
			if(!response){ //no esta conectado callback false
			if( navigator.userAgent.match('CriOS') ){
   			 window.open('https://www.facebook.com/dialog/oauth?client_id='+app_id+'&scope='+scopes+'&redirect_uri=http://www.powerinfluencer.com/app/','', null);
   			 getFacebookPages();
			}else{
					FB.login(function (response){
				if (response.status === 'connected')
				getFacebookPages();
				}, {scope: scopes});
			}

		
			};
			});
	};

	var facebookLogout = function() {
  		checkLoginState(function(data) {
  			if (data.status === 'connected') {
				FB.logout(function(response) {
					window.location.href="./";
				});
			}
  		});

  	};


		
	var getFacebookData = function(){
		FB.api('/me',{ locale: 'en_US', fields: 'name, email' } 
		,function (response){
		id= response.id;
		facebookUser=response.name;
		facebookCorreo=response.email;
		var e = document.getElementById("perfil");
		var empresa = $('#empresa input').val();
		var perfil = e.options[e.selectedIndex].value;
			$.ajax({  
		            type: "POST",  
		            url: "./controller/procesar-facebook.php",  
		            data: "faceuser="+facebookUser+"&facecorreo="+facebookCorreo+"&faceUserId="+id+"&tipo="+perfil+"&empresa="+empresa,  
					
		            success: function(data){
		            console.log(data); 
						switch (data){
							case "dashboard": window.location.href="escritorio-agencia";
							break;
							case "false": 	window.location.href="./";
							break;
							case "primera": window.location="formulario-agencia";	
							break;
							case "formulario":  window.location.href="formulario-agencia";
							break;
							case "dashboard-ipe": window.location.href="escritorio-influencer";
							break;
							case "formulario-ipe": window.location.href="formulario-influencer";
							break;
							case "sin_opcion": alert('no se ha seleccionado opción');
							break;
							case "existe-agencia": //alert('ya se encuentra registrado como agencia, lo contactaremos');
										   //window.location.href='./controller/logout.php';
										   agencia_ya_registrada_facebook();
							break;
							case "existe-influenciador": //alert('ya se encuentra registrado como influenciador, lo contactaremos');
										   //window.location.href='./controller/logout.php';
										   influenciador_ya_registrado_facebook();
							break;
							case "agencia": //alert('ya se encuentra registrado como agencia, lo contactaremos');
										   //window.location.href='./controller/logout.php';
										   agencia();
							break;
							case "influenciador": //alert('ya se encuentra registrado como agencia, lo contactaremos');
										   //window.location.href='./controller/logout.php';
										   influenciador();
							break;

						}
					}

				});
			});
	}

	var getFacebookPages = function(){
			FB.api(
			    "/me/accounts", { locale: 'en_US', fields: 'name' },
			    function (response) {
			     // if (response && !response.error) {
			        alert(response.data[0].id);
			        var data  = "";
			        for(var i=0; i<=response.data.length-1;i++){
			        	data = data + response.data[i].id + "-";
			        	
			        }
			        $.ajax({  
		            type: "POST",  
		            url: "../controller/procesar-mostrar-followers-ipe.php",  
		            data: "data="+data,  
					
		            success: function(data){ 
					
					}

				});

			        	
			      //}

			    }
			);

		/*FB.api('/me/accounts',{ locale: 'en_US', fields: 'name, id' } 
		,function (response){
		id= response.id;
		facebookPage=response.name;


		

		$.ajax({  
		            type: "POST",  
		            url: "./controller/procesar-facebook.php",  
		            data: "facebookPageId="+id+"&facebookPageName="+facebookPage+"&tipo=0",  
					
		            success: function(data){ 
		            alert(data);
					//	switch (data){

					//	}
					}

				});
			});*/
	}



  		$('#facebook-nuevo').click(function(){
			call_facebook_api();
			facebookLogin();
		});
		
		$('#facebook-antiguo').click(function(){
			call_facebook_api();
			facebookLogin();
		});

		$('#facebook-nuevo-ipe').click(function(){
			call_facebook_api()
			facebookLogin();
		});
		
		$('#facebook-antiguo-ipe').click(function(){
			call_facebook_api();
			facebookLogin();
		});


		$('#salir').click( function(e) {
			e.preventDefault();
  			facebookLogout();
		});

	/*	$('#registra-facebook-ipe').click(function() {
			call_facebook_api();
			facebookPages();
  			
		});*/


		
		
});