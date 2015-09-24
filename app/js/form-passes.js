$(document).ready(function(){

	//INICIO SCRIPTS
	var info;
	$('#alertRegistrado').hide();
	$('#facebook-name').hide();
	$('#volver').hide();
	$('#ipe').hide();

	$('#ipebtn').click(function(){
		$('#ipe').show();
		$('#ipebtn').hide();
		$('#agencia').hide();
		$('#nuevoipe').hide();
		$('#antiguoIpe').hide();
		$('.volverTipo').hide();
		$("#tipoCliente").attr("value", "3");
	});

	$('#accederIpe').click(function(){
		$('#antiguoIpe').show();
		$('#nuevoipe').hide();
		$('.volverTipo').hide();
	});

	$('#registrarIpe').click(function(){
		$('#antiguoIpe').hide();
		$('#nuevoipe').show();
		$('.volverTipo').hide();
	});

	$('#volverIpe').click(function(){
		$('#ipe').hide();
		$('#ipebtn').show();
		$('#agencia').show();
	});

	$('#agencia').click(function(){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$(".ingreso_eleccion").hide();
		$(".volverTipo").show();
	})

	$('.volverTipo').click(function(){
		$('.form_agencias').hide();
		$('.ingreso_eleccion').show();	
		$(".volverTipo").hide();	
	})

	$('#volver').click(function(){
		$('#registrar').show();
		$('#acceder').show();
		$('.ingreso_eleccion').show();	
		$("#volver").hide();
		$('.form_agencias').hide();
	})
	
	$('#ingresar').click(function(){
		username=$('#username').val();
		password=$('#password').val();
		//console.log(username);
		$.ajax({  
			type: "POST",  
			url: "./procesar_login.php",  
			data: "name="+username+"&pwd="+password, 
			success: function(html){ 
				console.log(html);
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
				}
				}
		});
	});

	$('#agenciaform').on('submit',(function(e){
		e.preventDefault();
		info = new FormData(this);
		info.append('nuuser',$('#usernamenuevo').val());
		info.append('nupass',$('#contraseñanuevo').val());
		info.append('nuempresa',$('#empresanuevo').val());
		info.append('nucorreo',$('#correonuevo').val());
		info.append('nutel1',$('#telefono1nuevo').val());
		info.append('nutel2',$('#telefono2nuevo').val());
		$.ajax({  
			type: "POST",  
			url: "procesar_login_nuevo.php",  
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
								$('#correonuevo').val('');
								;$('#correonuevo').focus();
				break;
				case "invalido":
					console.log('formato invalido');
				}
				}
		});

	}));

	$('.registerForm').on('submit',(function(e){
		e.preventDefault();
		info = new FormData(this);
		info.append('nuuser',$('#usuarionuevoIpe').val());
		info.append('nupass',$('#contraseñanuevoIpe').val());
		info.append('nuempresa',$('#empresanuevoIpe').val());
		info.append('nucorreo',$('#correonuevoIpe').val());
		info.append('nutel1',$('#telefono1nuevoIpe').val());
		info.append('nutel2',$('#telefono2nuevoIpe').val());
		tipo=$('#perfil option').val();
		var e = document.getElementById("perfil");
		var perfil = e.options[e.selectedIndex].value;
		info.append('ipe',perfil);

		$.ajax({  
			type: "POST",  
			url: "./procesar_login_nuevo.php",  
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,      
			cache: false,             
			processData:false, 
			success: function(data){
				console.log(data);
				switch (data){
				case "nuevo": 	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="Registro completo, nos contactaremos con usted";					
								$('#usernamenuevo, #contraseñanuevo,#ver-password,#empresanuevo,#correonuevo,#telefono1nuevo,#telefono2nuevo').val('');
				break;
				case "false":	$('#alertRegistrado').show();
								document.getElementById('alertRegistrado').innerHTML ="El correo ingresado ya tiene una cuenta asociada";					 
								$('#correonuevo').val('');
								;$('#correonuevo').focus();
				break;
				case "invalido":
					console.log('formato invalido');
				}
				}
		});

	}));

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

	//variables globales
	var correo,nombre,correo,tel1,tel2,empresa;
	var rsid = $('#RsId').val();
	if (rsid != ''){
	$('#correo input').removeAttr('disabled');
	}
	var foto=0;
		$('#file').click(function(){
		  foto=1; 
	});
		
	$('#imagenform').on('submit',(function (e){
		e.preventDefault;
		info = new FormData(this);
		info.append('correo',$('#correo input').val());
		info.append('rsid',$('#RsId').val());
		info.append('nombre',$('#nombre input').val());
		info.append('tel1',$('#tel1 input').val());
		info.append('tel2',$('#tel2 input').val());
		info.append('empresa',$('#empresa input').val());
		info.append('picture_url', '<?php echo $_SESSION["pictureUrl"];?>');
	
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
				window.location.reload();
			}
			});
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
					console.log(data);
					window.location.reload();
				}
			});
		};
	}));	

	/*//campañas creadas 
	$('#editaCampaña').hide();
	$('#creadas #guardar').hide();

	//editar
	$('#creadas #editar').click (function (){
		$('#editaCampaña').show();
		$('#creadas #guardar').show();
		$('#creadas #editar').hide();
	});

	//guardar cambios
	$('#creadas #guardar').click (function (){
		$('#editaCampaña').hide();
		$('#creadas #guardar').hide();
		$('#creadas #editar').show();
	});

	$('#guardar').hide();
	$('#editar').show();*/

	//CREAR CAMPAÑAS SCRIPT
	var aa= '<?php echo (int)$row[0];?>';
	var idActual = aa+1;
	var info;
	$('#campanaForm').on('submit',(function (e){
		e.preventDefault;
		info = new FormData(this);	
		info.append('nombre',$('#nombre').val());
		info.append('marca',$('#marca').val());
		info.append('descripcion',$('#descripcion').val());
		info.append('campana',idActual);
		info.append('id','<?php echo $_SESSION["id"];?>');
		info.append('correo','<?php echo $_SESSION["correo"];?>');
		info.append('rsid','<?php echo $_SESSION["rsid"];?>');
		$.ajax({
			type: 'POST',  
			url: './procesar_nueva-campana.php',  
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,      
			cache: false,             
			processData:false, 
		
			success: function(data){ 
			}
		});
	}));
});

//INICIO FUNCTIONS
function valida(e){
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8){
		return true;
	};
	patron =/[0-9]/;
	tecla_final = String.fromCharCode(tecla);
	return patron.test(tecla_final);
};		
function checkPasswordMatch() {
	var password = $('#contraseñanuevo').val();
	var confirmPassword = $('#ver-password').val();
	$('#registrarse').attr('disabled', 'disabled');
	if (password != confirmPassword || password == ''|| confirmPassword ==''){
		$('#divCheckPasswordMatch').html('Las contraseñas no coinciden');
	}
	else{
		$('#divCheckPasswordMatch').html('');
		$('#registrarse').removeAttr('disabled');
	}
}
function phone1Length(){
	var tel1 = $('#telefono1nuevo').val();
	var tel2 = $('#telefono2nuevo').val();
	$('#registrarse').attr('disabled','disabled');
	if (tel1.length > 7 && tel2.length > 7)
		$('#registrarse').removeAttr('disabled');
	else
		$('#registrarse').attr('disabled','disabled');
}
function phone2Length(){
	var tel1 = $('#telefono1nuevo').val();
	var tel2 = $('#telefono2nuevo').val();
	$('#registrarse').attr('disabled','disabled');
	if (tel1.length > 7 && tel2.length > 7)
		$('#registrarse').removeAttr('disabled');
	else
		$('#registrarse').attr('disabled','disabled');
}
function validaIpe(e){
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8){
		return true;
	};
	patron =/[0-9]/;
	tecla_final = String.fromCharCode(tecla);
	return patron.test(tecla_final);
};
function checkPasswordMatchIpe() {
	var password = $('#contraseñanuevoIpe').val();
	var confirmPassword = $('#ver-passwordIpe').val();
	$('#registrarseIpe').attr('disabled', 'disabled');
	if (password != confirmPassword || password == ''|| confirmPassword ==''){
		$('#divCheckPasswordMatchIpe').html('las contraseñas no coinciden');
	}
	else{
		$('#divCheckPasswordMatchIpe').html('');
		$('#registrarse').removeAttr('disabled');
	}
}
function phone1LengthIpe(){
	var tel1 = $('#telefono1nuevoIpe').val();
	var tel2 = $('#telefono2nuevoIpe').val();
	$('#registrarseIpe').attr('disabled','disabled');
	if (tel1.length > 7 && tel2.length > 7)
		$('#registrarseIpe').removeAttr('disabled');
	else
		$('#registrarseIpe').attr('disabled','disabled');
}
function phone2LengthIpe(){
	var tel1 = $('#telefono1nuevoIpe').val();
	var tel2 = $('#telefono2nuevoIpe').val();
	$('#registrarseIpe').attr('disabled','disabled');
	if (tel1.length > 7 && tel2.length > 7)
		$('#registrarseIpe').removeAttr('disabled');
	else
		$('#registrarseIpe').attr('disabled','disabled');
}