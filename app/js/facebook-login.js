$(document).ready(function(){

		function call_facebook_api(){
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}

		
		
		var app_id = '973652052702468';
		//var app_id = '962955813772092';
		var scopes= 'email,user_friends';
		var name;
		var email;
		
	var getFacebookData = function(){
	FB.api('/me',{ locale: 'en_US', fields: 'name, email' } 
	,function (response){
	name= response.name;
	id= response.id;
	email= response.email;
	facebookUser=name;
	facebookCorreo=email;
	console.log(facebookUser,facebookCorreo);
	alert("56");
	$.ajax({  
            type: "POST",  
            url: "./procesar_facebook.php",  
            data: "faceuser="+facebookUser+"&facecorreo="+facebookCorreo+"&faceUserId="+id+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'),  
			
			
            success: function(html){ 
				switch (html){
				case "dashboard": window.location.href="./dashboard-agencia.php";
				break;
				case "false": 	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML = "Estimado(a) "+facebookUser+" ya se encuentra registrado nos contactaremos con usted a la brevedad";
				break;
				case "primera": window.location.href="./formulario-agencia.php";
								document.getElementById('alertRegistrado').innerHTML ="Por favor ingrese sus datos en el formulario";					
				break;
				case "dashboard-ipe": window.location.href="./dashboard-ipe.php";
				break;
				case "primera-ipe": window.location.href="./formulario-agencia3.php";
								document.getElementById('alertRegistrado').innerHTML ="Por favor ingrese sus datos en el formulario";					
				break;
				};
				}
		});
	});
	}


	var getFacebook 
	
	var statusChangeCallback = function(response, callback) {
    if (response.status === 'connected') {
	  getFacebookData();
    } else {
		callback(false);//no hace nada si no se conecta
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
			FB.login(function (response){
				if (response.status === 'connected')
				getFacebookData();
				}, {scope: scopes});
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

  	$('#facebook-nuevo').click(function(){
			call_facebook_api()
			facebookLogin();
		});
		
		$('#facebook-antiguo').click(function(){
			call_facebook_api()
			facebookLogin();
		});

		$('#facebook-nuevo-ipe').click(function(){
			call_facebook_api()
			facebookLogin();
		});
		
		$('#facebook-antiguo-ipe').click(function(){
			call_facebook_api()
			facebookLogin();
		});


		$('#salir').click( function(e) {
			e.preventDefault();
  			facebookLogout();
		});

		
		
});

