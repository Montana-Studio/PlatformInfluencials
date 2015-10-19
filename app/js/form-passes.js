$(document).ready(function(){

	//INICIO SCRIPTS
	var info;
	if (window.location == 'http://local.mediatrends/_InfluencialsPlatform/htdocs/app/agencia.php'){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$('#perfil').hide();
	}

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

	$('#ingresar').click(function(){
		correo=$('#correo').val();
		password=$('#password').val();
		//console.log(username);
		$.ajax({
			type: "POST",
			url: "./procesar_login.php",
			data: "correo="+correo+"&pwd="+password,
			success: function(html){
				console.log(html);
				switch (html){
				case "admin": window.location.href= "./dashboard-admin.php";
				break;
				case "agencia": window.location.href = "./dashboard-agencia.php";
				break;
				case "ipe": window.location.href = "./dashboard-ipe.php";
				break;
				case "inactivo": 	$('#alertRegistrado').slideDown();
									document.getElementById('alertRegistrado').innerHTML ="usuario inactivo";

				break;
				case "false": 		$('#alertRegistrado').slideDown();
									document.getElementById('alertRegistrado').innerHTML ="usuario o password no existen";
				break;
				case "vacio": 		$('#alertRegistrado').slideDown();
									document.getElementById('alertRegistrado').innerHTML ="falta ingresar datos";
				break;
				}
				}
		});
	});

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
				//alert(data);
				switch (data){
					case "nuevo":
									$(".alertElim").fadeIn("normal",function(){
											$("#boxAlert .hrefCamp h2").text("Gracias por registrarte en Power-Influencers");
											$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
											$("#boxAlert .hrefCamp p.messageAlert").text("Tu cuenta sera activada proximamente, pronto nos contactaremos contigo.");

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
													window.location.href = "logout.php";
												}});
											});
									});
					break;
					case "false":	//$('#alertRegistrado').show();
									//document.getElementById('alertRegistrado').innerHTML ="El correo ingresado ya tiene una cuenta asociada";
									alert('el correo '+$('.correonuevo').val()+' ya existe en la base de datos, intente con otro');
									$('.correonuevo').val('');
									$('.correonuevo').focus();
					break;
					case "invalido": alert('problema con el tamaño o formato de la imagen');
						//console.log('formato invalido');
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
	/*if (rsid != ''){
		$('#correo input').removeAttr('disabled');
	}*/
	var foto=0;
		//$('#file').click(function(){
	$('#file').click(function(){
		foto=1;
		$("input:file").change(function (){
			$('.alert-uploadready').slideDown();
     	});
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

				success: function(data){
					//alert(data);
					switch (data){
						case "nueva":
							$(".alertElim").fadeIn("normal",function(){
								$("#boxElim").show().animate({
									top:"20%",
									opacity:1
								},{duration:1500,easing:"easeOutBounce"});

								$(".siElim").on("click",function(){
									window.location.href = "campana.php";
								});

								$(".noElim").on("click",function(){
									window.location.reload();
								})

							});
						break;
						case "invalido" :
									$(".alertElim").fadeIn("normal",function(){

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
													$(this).hide();
												}});
											});
									});
						break;
					}
				}
			});

		return false;

	}));

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

				success: function(info){
					switch (info){
						case "nuevo":	alert("imagen cambiada");
										window.location.reload();
						break;
						default: alert('el tamaño o formato no es aceptado');
						break;
					}
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

				success: function(info){
					switch (info){
						case "actualiza": 	alert("datos actualizados");
											window.location.reload();
						break;
					}
				}
			});
			//console.log('');
		};

		return false;
	}));

	//FORMULARIO DE AGENCIAS
	$('#formulario_agencias_rs').on('submit',function(e){

		e.preventDefault();

		if($("#telefono1nuevo").val().length > 7 && $("#telefono2nuevo").val().length > 7 ){
				info = new FormData(this);
				info.append('nombre',$('#nombre input').val());
				info.append('empresa',$('#empresa input').val());
				info.append('correo',$('#correo input').val());
				info.append('tel1',$('#telefono1nuevo').val());
				info.append('tel2',$('#telefono2nuevo').val());

			$.ajax({
				type: "POST",
				url: "procesar_formulario.php",
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					alert("Registro de datos completo, nos contactaremos con usted");
					window.location.href = "logout.php";
				}
			});
		}else{

			alert("ingrese telefonos de al menos 8 cifras");
		}

	});
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
	if (password != confirmPassword || password == ''|| confirmPassword =='' ){
		$('#divCheckPasswordMatch').slideDown();
	}
	else{
		$('#divCheckPasswordMatch').slideUp();
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
