$(document).ready(function(){

	//INICIO SCRIPTS
	var info;
	if (window.location == 'http://local.mediatrends/_InfluencialsPlatform/htdocs/app/agencia.php'){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$('#perfil').hide();
	}

	$('#alertRegistrado').hide();
	$('#facebook-name').hide();
	$('#volver').hide();
	
	$('#agencia1').click(function(){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$(".ingreso_eleccion").hide();
		$(".volverTipo").show();
		$('#perfil').hide();
	})


	$('#agencia').click(function(){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$(".ingreso_eleccion").hide();
		$(".volverTipo").show();
		$('#perfil').hide();
	})

	$('#ipebtn').click(function(){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$(".ingreso_eleccion").hide();
		$(".volverTipo").show();
		$("#perfil").show();
	})


	$('.volverTipo').click(function(){
		$('.form_agencias').hide();
		$('.ingreso_eleccion').show();	
		$(".volverTipo").hide();
		$('#ipe').hide();
	})

	$('#volver').click(function(){
		$('#registrar').show();
		$('#acceder').show();
		$('.ingreso_eleccion').show();	
		$("#volver").hide();
		$('.form_agencias').hide();
	})
	


	$('#linkedin-nuevo').click(function(){

		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
		//$("#tipoCliente").attr("value", "2");
	});
	
	$('#linkedin-antiguo').click(function(){
		
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
		//$("#tipoCliente").attr("value", "2");
		//console.log('api load linked');
	});


	$('#linkedin-nuevo-Ipe').click(function(){
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
		//$("#tipoCliente").attr("value", "3");
	});
	
	$('#linkedin-antiguo-Ipe').click(function(){
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
		//$("#tipoCliente").attr("value", "3");
		//console.log('api load linked');
	});

	$("#ver-password").keyup(checkPasswordMatch);
	$("#telefono1nuevo").keyup(phone1Length);
	$("#telefono2nuevo").keyup(phone2Length);	

	$("#ver-passwordIpe").keyup(checkPasswordMatchIpe);
	$("#telefono1nuevoIpe").keyup(phone1LengthIpe);
	$("#telefono2nuevoIpe").keyup(phone2LengthIpe);	

	//DASHBOARD SCRIPTS
	var correo,nombre,correo,tel1,tel2,empresa;
	var rsid = $('#RsId').val();
	if (rsid != ''){
	$('#correo input').removeAttr('disabled');
	}
	var foto=0;
		$('#file').click(function(){
		  foto=1; 
	});






// FUNCTIONS THAT NEED AJAX
	$('#imagenform').on('submit',(function (e){
		e.preventDefault;
		info = new FormData(this);
		info.append('correo',$('#correo input').val());
		info.append('rsid',$('#RsId').val());
		info.append('nombre',$('#nombre input').val());
		info.append('tel1',$('#tel1 input').val());
		info.append('tel2',$('#tel2 input').val());
		info.append('empresa',$('#empresa input').val());
		info.append('tipo','avatar');
		if(foto==1) {
			$.ajax({
				type: "POST",  
				url: "./procesar_imagen.php",  
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,      
				cache: false,             
				processData:false, 
				
				success: function(data){
					
					switch (data){
						case "error": 	alert("arhivo con daños");			
						break;
						case "nuevo":	alert("imagen cambiada");
										window.location.reaload();	
						break;
						case "invalido": alert('el tamaño o formato no es aceptado');
						break;
					}
				}
			})
			console.log("");
		}
		else{
			$.ajax({  
					
					type: "POST",  
					url: "./procesar-dashboard-agencia.php",  
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,      
					cache: false,             
					processData:false,

				success: function(data){	
					alert("datos actualizados");
					window.location.reaload();	
				}

			})
			console.log("");
		}
	}));	

});


$('#campanaForm-nueva-campana').on('submit',(function (e){
	e.preventDefault;
	info = new FormData(this);
	info.append('nombre',$('#nombre-nueva-campana').val());
	info.append('marca',$('#marca-nueva-campana').val());
	info.append('descripcion',$('#descripcion-nueva-campana').val());
	info.append('tipo','campana');
	$.ajax({

			type: "POST",  
			url: "./procesar_imagen.php",  
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,      
			cache: false,             
			processData:false, 
	
			success: function(info){
				alert(info);
				switch (info){
					case "error": 	alert("arhivo con daños");
					break;
					case "nueva":	if (confirm("¿desea ver la campaña?")){
										window.location.href("./campana.php");
									}
										

					break;
					case "invalido": alert('el tamaño o formato no es aceptado');
					break;
				}
			}	

				
		});
	console.log("");

}));

$('.registerForm').on('submit',(function(e){
	e.preventDefault();
	info = new FormData(this);
	info.append('nuuser',$('.usernamenuevo').val());
	info.append('nupass',$('.contraseñanuevo').val());
	info.append('nuempresa',$('.empresanuevo').val());
	info.append('nucorreo',$('.correonuevo').val());
	info.append('nutel1',$('.telefono1nuevo').val());
	info.append('nutel2',$('.telefono2nuevo').val());
	info.append('tipo','usuario');
	tipo=$('#perfil option').val();
	var e = document.getElementById("perfil");
	var perfil = e.options[e.selectedIndex].value;
	info.append('ipe',perfil);

	$.ajax({  
		type: "POST",  
		url: "./procesar_imagen.php",   
		data: info,
		enctype: 'multipart/form-data',
		contentType: false,      
		cache: false,             
		processData:false, 
		success: function(data){
			switch (data){
				case "nuevo": 	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="Registro completo, nos contactaremos con usted";					
								$('#usernamenuevo, #contraseñanuevo,#ver-password,#empresanuevo,#correonuevo,#telefono1nuevo,#telefono2nuevo').val('');
				break;
				case "false":	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="El correo ingresado ya tiene una cuenta asociada";					 
								$('.correonuevo').val('');
								;$('.correonuevo').focus();
				break;
				case "invalido":
					//console.log('formato invalido');
			}
		}
	});
	console.log("");

}));

$('#ingresar').click(function(){
	username=$('#username').val();
	password=$('#password').val();
	//console.log(username);
	$.ajax({  
		type: "POST",  
		url: "./procesar_login.php",  
		data: "name="+username+"&pwd="+password, 
		success: function(html){ 
			
			switch (html){
			case "admin": window.location.href= "./dashboard-admin.php";
			break;
			case "agencia": window.location.href = "./dashboard-agencia.php";
			break;
			case "ipe": window.location.href = "./dashboard-ipe.php";
			break;
			case "inactivo": 	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="usuario inactivo";	
									
			break;
			case "false": 		$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="usuario o password no existen";					
			break;
			case "vacio": 		$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="falta ingresar datos";					
			break;
			}
			}
	});
});

