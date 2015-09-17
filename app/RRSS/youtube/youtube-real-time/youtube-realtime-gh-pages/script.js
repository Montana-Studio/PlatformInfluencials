	var username;
	$(document).ready(function(){
	    $("#calcular").click(function(){
	        username = $("#user").val();
	        console.log(username);
	    });

	});
	if (username != ''){
		//	console.log(username);
	var getText = function (url, callback) {
		var request = new XMLHttpRequest();
		request.onreadystatechange = function () {
			if(request.readyState == 4 && request.status == 200) {
				callback(request.responseText);
			}
		};
		request.open('GET', url);
		request.send();
	}


	var update = {};
	update.isNameSet = 0;
	update.name = function() {
		if(this.isNameSet)
			return;
	}
	update.isLive = 0;
	update.live = function() {
		// Cambiar Api_Key aquí
			if (username!='undefined'){	
			//	var url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername="+username+"&fields=items/statistics&key=AIzaSyC7WF2_-G6XOXXAt8bNyBCDStnfbi1JvYI";
			var url = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id="+username+"&fields=items/snippet&key=AIzaSyC7WF2_-G6XOXXAt8bNyBCDStnfbi1JvYI";
				getText(url, function(e) {
					e = JSON.parse(e);
					//var sub_count = e.items[0].statistics.subscriberCount;
					var sub_count = e.items[0].snippet.tittle;
					if(!update.isLive && username) {
						el: document.querySelector(".count_live"),
						update.isLive = 1;
					} else {
						document.querySelector(".count_live").innerText = sub_count;
						
					}	
				})
			}	
	}

	update.all = function() {
		update.name();
		update.live();
	}

	window.onload = function() {
		var te = location.hash.split("!/")[1];
		if(te)
			username = te.trim();
		else {
			location.replace("#!/" + username);
			document.querySelector(".notice").style.visibility = "visible";
			setTimeout(function(){
				document.querySelector(".notice").className += " notice-hidden";
			}, 3000);
		}
		update.all();
		if(location.hostname != "localhost") {
			setInterval(update.live, 1*1000);
			setInterval(update.yt, 60*1000);
		}

	}
}



