$(document).ready(function(){
		
		$('#facebook-nuevo').click(function(){
			(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/en_US/sdk.js";
									fjs.parentNode.insertBefore(js, fjs);
								  }(document, 'script', 'facebook-jssdk'));
								  facebookLogin();
		});
		
		$('#facebook-antiguo').click(function(){
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
			facebookLogin();
		});

		
		$('#salir').click( function(e) {
			e.preventDefault();
  			facebookLogout();
		});
		
		var app_id = '939225322786309';
		var scopes= 'email,user_friends';
		var name;
		var email;
	
	window.fbAsyncInit = function() {
		FB.init({
			appId      : app_id,
			cookie     : true,  
			status 	   : true,					
			xfbml      : true,  
			version    : 'v2.4' 
		});	
		
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			facebookLogin();
		FB.getLoginStatus(function(response) {
		statusChangeCallback(response, function(){
		
		});
		});
	};
	
	var statusChangeCallback = function(response, callback) {
    if (response.status === 'connected') {
	  getFacebookData();
    } else {
		callback(false);//no hace nada si no se conecta
    }
	}
	
   var checkLoginState = function(callback) {		  
    FB.getLoginStatus(function(response) {
     statusChangeCallback(response, function(data){
		callback(data);
		});
		});
	}
	
	var getFacebookData = function(){
	FB.api('/me',{ locale: 'en_US', fields: 'name, email' } 
	,function (response){
	name= response.name;
	id= response.id;
	email= response.email;
	facebookUser=name;
	facebookCorreo=email;
	$.ajax({  
            type: "POST",  
            url: "procesar_facebook.php",  
            data: "faceuser="+facebookUser+"&facecorreo="+facebookCorreo+"&faceUserId="+id, 
			
			
            success: function(html){ 
				switch (html){
				case "dashboard": window.location.href="dashboard-agencia.php";
				break;
				case "false": alert("Estimado(a) "+facebookUser+" ya se encuentra registrado nos contactaremos con usted a la brevedad");
							  window.location.href="registro.php";	
				break;
				case "primera":     
									window.location.href="formulario-agencia.php";
								alert("Por favor ingrese sus datos en el formulario");					
				break;
				}
				}
		});
	});
	}
	
	var facebookLogin= function (){
		checkLoginState(function(response){
			if(!response){ //no esta conectado callback false
			FB.login(function (response){
				if (response.status === 'connected')
				getFacebookData();
				}, {scope: scopes});
			}
			})
	}
	
	
	var facebookLogout = function() {
  		checkLoginState(function(data) {
  			if (data.status === 'connected') {
				FB.logout(function(response) {
					window.location.href="registro.php";
				})
			}
  		})

  	}
		
});

