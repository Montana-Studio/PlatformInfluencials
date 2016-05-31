function agencia_ya_registrada(){
	$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("ya se encuentra registrado");
			$("#boxAlert .hrefCamp i").addClass("fa-warning");
			$("#boxAlert .hrefCamp p.messageAlert").text("Su perfil ya fue ingresado como agencia, lo contactaremos proximamente");

			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			$("#clearAlert").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#boxAlert .hrefCamp i").removeClass("fa-warning");
					$(this).hide();
					window.location.reload();
				}});
			});
	});
}

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
			url: "./controller/procesar-linkedin.php",  
			data: "id="+id+"&nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email+"&conn="+conn+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'), 
			success: function(data){ 
					switch (data){
							case "dashboard": window.location.href="./escritorio-agencia";
							break;
							case "false": 	window.location.href="./";
							break;
							case "formulario":  window.location.href="formulario-agencia";
							break;
							case "existe-agencia": agencia_ya_registrada();//alert('ya se encuentra registrado como agencia, lo contactaremos');
										  // window.location.href='./controller/logout';
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