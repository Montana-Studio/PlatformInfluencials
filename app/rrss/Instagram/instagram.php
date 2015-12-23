	<script async type="text/javascript">
		var accessToken = null; //the access token is required to make any endpoint calls, http://instagram.com/developer/endpoints/
		var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {
			//the pop-up window size, change if you want
			var popupWidth = 700,
				popupHeight = 500,
				popupLeft = (window.screen.width - popupWidth) / 2,
				popupTop = (window.screen.height - popupHeight) / 2;
			//the url needs to point to instagram_auth.php
			var popup = window.open('rrss/instagram/instagram_auth.php', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');
			popup.onload = function() {
				//open authorize url in pop-up
				if(window.location.hash.length == 0) {
					popup.open('https://instagram.com/oauth/authorize/?client_id='+instagramClientId+'&redirect_uri='+instagramRedirectUri+'&response_type=token', '_self');
				}
				//an interval runs to get the access token from the pop-up
				var interval = setInterval(function() {
					try {
						//check if hash exists
						if(popup.location.hash.length) {
							//hash found, that includes the access token
							clearInterval(interval);
							accessToken = popup.location.hash.slice(14); //slice #access_token= from string
							popup.close();
							if(callback != undefined && typeof callback == 'function') callback();
						}
					}
					catch(evt) {
						//permission denied
					}
				}, 100);
			}
		};
		function login_callback() {
			var instagramId = accessToken.split(".").shift();
			var followers_instagram;
			//alert(instagramId);
			$.ajax({
            type: "POST",
            url: "rrss/instagram/procesar_instagram.php",
            data: "instagramId="+instagramId+"&accessToken="+accessToken,
            success: function(data){
            	 if(data == 'exito'){
                  alert("gracias por registrar su cuenta");
                  window.location.reload();
                }
                else if(data == 'existe') alert('La cuenta ya está asociada, intente con una cuenta diferente')
                else if(data == 'otro') alert('La cuenta está asociada a otro usuario');
                //else window.reload();
			}
			});
		}
		function login() {
			authenticateInstagram(
			    'd9e010f47eef4f21a289bd5d46a60e25', //instagram client ID
			   // 'http://desarrollo.adnativo.com/pi/app/rrss/instagram/instagram_auth.php', //instagram redirect URI
			    'http://desarrollo.adnativo.com/pi/app/rrss/Instagram/instagram_auth.php', //instagram redirect URI
			    login_callback  //optional - a callback function
			);
			return false;
		}
	</script>
