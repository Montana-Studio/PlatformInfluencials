<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">

		var accessToken = null; //the access token is required to make any endpoint calls, http://instagram.com/developer/endpoints/
		
		var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {

			//the pop-up window size, change if you want
			var popupWidth = 700,
				popupHeight = 500,
				popupLeft = (window.screen.width - popupWidth) / 2,
				popupTop = (window.screen.height - popupHeight) / 2;

			//the url needs to point to instagram_auth.php
			var popup = window.open('instagram_auth.php', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');

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
			alert(instagramId);
			$.ajax({  
            type: "POST",  
            url: "procesar_instagram.php",  
            data: "instagramId="+instagramId+"&accessToken="+accessToken,
			
            success: function(html){ 
            	console.log(html);
				}
			});
		}

		function login() {
			authenticateInstagram(
			    '4c1a45981cee4ec5b742e05ebb8b00b8', //instagram client ID
			    'http://local.mediatrends/_InfluencialsPlatform/htdocs/app/RRSS/Instagram/procesar_instagram.php', //instagram redirect URI
			    login_callback  //optional - a callback function
			);
			return false;
		}

	</script>
</head>
<body>
	<a href="#" onclick="login()">Log into Instagram</a>


</body>

</html>
