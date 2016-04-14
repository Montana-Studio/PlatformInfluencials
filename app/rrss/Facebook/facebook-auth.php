
<script async type="text/javascript">
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
			$.ajax({
		            type: "POST",
		            url: "./controller/procesar-facebook.php",
		            data: "faceuser="+facebookUser+"&facecorreo="+facebookCorreo+"&faceUserId="+id+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'),

		            success: function(data){

					}

				});
			});
	}

	function giveLikeFacebook(){
		call_facebook_api();
		FB.api(
		    "/1074329775959309/likes",
		    "POST",
		    function (response) {
		      if (response && !response.error) {
		        /* handle the result */
		      }
		    }
		);	
	}


	var getFacebookPages = function(){
		FB.api(
		    "/me/accounts", { locale: 'en_US', fields: 'name' },
		    function (response) {
		        for(var i=0; i<=response.data.length-1;i++){
		        	if(i==response.data.length-1){
		        		var facebook_page_id = response.data[i].id;
		        		facebookUser=response.data[i].name;
		        		if(facebookUser.length>0){
		        			$.ajax({
					            type: "POST",
					            url: "./rrss/facebook/procesar-facebook.php",
					            data: "faceuser="+facebookUser+"&facebook_page_id="+facebook_page_id,
					            success: function(data){
					            	<?php //inscripcion_facebook();?>
					            	//alert(facebookUser);
									alert('Sus páginas han sido agregadas al perfil');
									location.reload();
								}
							});	
		        		}

		        	  
		        	}else{
		        		facebookUser=response.data[i].name;
		        		if(facebookUser.length>0){
		        		    var facebook_page_id = response.data[i].id;
			        	    $.ajax({
					            type: "POST",
					            url: "./rrss/facebook/procesar-facebook.php",
					            data: "facebook_page_id="+facebook_page_id,
					            success: function(data){
					            	//alert(facebookUser);
					            	
								}
							});
		        		}
			        }
		        }
		    }
		);
	}

	function checkAuthFacebookPages(){
		call_facebook_api();
		facebookPages();
	}

</script>