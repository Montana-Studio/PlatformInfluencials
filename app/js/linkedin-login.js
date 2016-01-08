/*$(document).ready(function(){

// Setup an event listener to make an API call once auth is complete
    //function onLinkedInLoad() {
    //    IN.Event.on(IN, "auth", getProfileData);
    //}

    // Handle the successful return from the API call  
	

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }

    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        IN.API.Raw("/people/~:(id,email-address,formatted-name,num-connections,picture-url,positions:(company:(name)))").result(onSuccess).error(onError);
    }
	
	IN.Event.on(IN, "auth", getProfileData);
	
	
	function onSuccess(data) {
	$('#linkedin-nuevo').on('click',(function (){
		var nombre = data['formattedName'];
		var pictureUrl = data['pictureUrl'];
		var email = data['emailAddress'];
	
		$.ajax({  
            type: "POST",  
            url: "./procesar_linkedin.php",  
            data: "nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email, 
			
			
            success: function(data){ 
				switch (data){
							case "dashboard": window.location.href="dashboard-agencia.php";
							break;
							case "false": 	window.location.href="./";
							break;
							case "primera": window.location="formulario-agencia.php";	
							break;
							case "formulario":  window.location.href="formulario-agencia.php";
							break;
							case "existe-agencia": alert('ya se encuentra registrado como agencia, lo contactaremos');
										   window.location.href='logout.php';
							break;
						}
				}
		});
		
		}));
		}
	
});
*/