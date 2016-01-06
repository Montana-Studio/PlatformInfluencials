function getProfileData() {
	IN.API.Raw("/people/~:(id,email-address,formatted-name,num-connections,picture-url,positions:(company:(name)))").result(onSuccess).error(onError);
}
function onSuccess(data) {
		var id= data ['id'];
		var nombre = data['formattedName'];
		var pictureUrl = data['pictureUrl'];
		var email = data['emailAddress'];
		var conn = data['numConnections'];

		$.ajax({  
			type: "POST",  
			url: "procesar_linkedin.php",  
			data: "id="+id+"&nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email+"&conn="+conn+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'), 
			success: function(html){ 
				console.log(html);
				
				switch (html){
				case "dashboard": window.location.href="dashboard-agencia.php";
				break;
				case "false": 	$('#alertRegistrado').slideDown();
								document.getElementById('alertRegistrado').innerHTML = "Estimado(a) "+nombre+" ya se encuentra registrado nos contactaremos con usted a la brevedad";
				break;
				case "primera": document.getElementById('alertRegistrado').innerHTML = "Por favor ingrese sus datos en el formulario";	    
								window.location.href="formulario-agencia3.php";			
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