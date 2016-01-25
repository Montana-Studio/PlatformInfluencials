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
		facebookUser=response.name;;
		facebookCorreo=response.email;
		var e = document.getElementById("perfil");
		var empresa = $('#empresa input').val();
		var perfil = e.options[e.selectedIndex].value;
			$.ajax({  
		            type: "POST",  
		            url: "./controller/procesar_facebook.php",  
		            data: "faceuser="+facebookUser+"&facecorreo="+facebookCorreo+"&faceUserId="+id+"&tipo="+perfil+"&empresa="+empresa,  
					
		            success: function(data){ 
						switch (data){
							case "dashboard": window.location.href="dashboard-agencia";
							break;
							case "false": 	window.location.href="./";
							break;
							case "primera": window.location="formulario-agencia";	
							break;
							case "formulario":  window.location.href="formulario-agencia";
							break;
							case "dashboard-ipe": window.location.href="dashboard-ipe";
							break;
							case "formulario-ipe": window.location.href="formulario-agencia3";
							break;
							case "sin_opcion": alert('no se ha seleccionado opción');
							break;
							case "existe-agencia": alert('ya se encuentra registrado como agencia, lo contactaremos');
										   window.location.href='./controller/logout.php';
							break;
							case "existe-influenciador": alert('ya se encuentra registrado como influenciador, lo contactaremos');
										   window.location.href='./controller/logout.php';
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
		            url: "./procesar_mostrar_followers.php",  
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
		            url: "./controller/procesar_facebook.php",  
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