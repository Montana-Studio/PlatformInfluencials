function getProfileData() {
	IN.API.Raw("/people/~:(id,email-address,formatted-name,num-connections,picture-url,positions:(company:(name)))").result(onSuccess).error(onError);
}
function onSuccess(data) {
		var id= data['id'];
		var nombre = data['formattedName'];
		var pictureUrl = data['pictureUrl'];
		var email = data['emailAddress'];
		var conn = data['numConnections'];
		$.ajax({  
			type: "POST",  
			url: "./controller/procesar_linkedin.php",  
			data: "id="+id+"&nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email+"&conn="+conn+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'), 
			success: function(data){ 
					switch (data){
							case "dashboard": window.location.href="dashboard-agencia";
							break;
							case "false": 	window.location.href="./";
							break;
							case "formulario":  window.location.href="formulario-agencia";
							break;
							case "existe-agencia": alert('ya se encuentra registrado como agencia, lo contactaremos');
										   window.location.href='logout';
							break;
						}
			}
		});
}
function onError(error) {
	console.log(error);
}	
function LinkedINAuth(){
	IN.UI.Authorize().place();
}
function onLinkedInLoad() {
	LinkedINAuth();
	IN.Event.on(IN, "auth", function () { getProfileData(); });
	IN.Event.on(IN, "logout", function () { onLinkedInLogout(); });
}