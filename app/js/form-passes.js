$(document).ready(function(){

	//INICIO SCRIPTS
	var info;
	if (window.location == 'http://local.mediatrends/_InfluencialsPlatform/htdocs/app/agencia.php'){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$('#perfil').hide();
	}

	if (window.location == 'http://local.mediatrends/_InfluencialsPlatform/htdocs/app/influenciador.php'){
		$("#tipoCliente").attr("value", "2");
		$('.form_agencias').show();
		$('#perfil').show();
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
		console.log(correo+password);
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

	$('.registerFormAgencia').on('submit',(function(e){
		e.preventDefault();
		info = new FormData(this);
		info.append('nuuser',$('.usernamenuevo').val());
		info.append('nupass',$('.contraseñanuevo').val());
		info.append('nuempresa',$('.empresanuevo').val());
		info.append('nucorreo',$('.correonuevo').val());
		info.append('nutel1',$('.telefono1nuevo').val());
		info.append('nutel2',$('.telefono2nuevo').val());
		info.append('tipo','agencia');
		console.log($('#contraseñanuevo').val());
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
											$("#boxAlert .hrefCamp i").append("<img src='img/logo_pi-06.svg' width='100%' height='100%'/>");
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
													window.location.reload();
												}});
											});
									});
					break;
					case "false":$(".alertElim").fadeIn("normal",function(){
													$("#boxAlert .hrefCamp h2").text("algo anda mal");
													$("#boxAlert .hrefCamp i").addClass("fa-warning");
													$("#boxAlert .hrefCamp p.messageAlert").text("El correo "+$('.correonuevo').val()+" ya existe en la base de datos, intente con otro.");

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
															$("#boxAlert .hrefCamp i").removeClass("fa-warning");
															$('.correonuevo').val('');
															$('.correonuevo').focus();
														}});
													});
											});
					break;
					case "invalido":$(".alertElim").fadeIn("normal",function(){
														$("#boxAlert .hrefCamp h2").text("algo anda mal");
														$("#boxAlert .hrefCamp i").addClass("fa-warning");
														$("#boxAlert .hrefCamp p.messageAlert").text("Problema con el tamaño o formato de la imagen.");

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
															}});
														});
												});
				}
			}
		});
	}));
		$('.registerFormInfluenciador').on('submit',(function(e){
		e.preventDefault();
		info = new FormData(this);
		info.append('nuuser',$('.usernamenuevo').val());
		info.append('nupass',$('.contraseña').val());
		//console.log($('.contraseña').val());
		info.append('nucorreo',$('.correonuevo').val());
		info.append('tipo','influenciador');
		tipo=$('#perfil option').val();
		var d = document.getElementById("perfil");
		var perfil = d.options[d.selectedIndex].value;
		var f = document.getElementById("region");
		var region = f.options[f.selectedIndex].value;
		var g = document.getElementById("comuna");
		var comuna = g.options[g.selectedIndex].value;
		//console.log(perfil+region+comuna+$('.usernamenuevo').val()+$('#contraseñanuevo').val()+$('.correonuevo').val());
		info.append('ipe',perfil);
		info.append('region',region);
		info.append('comuna',comuna);

		$.ajax({
			type: "POST",
			url: "./procesar_imagen.php",
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){

				console.log(data);
				switch (data){
					case "nuevo":
									$(".alertElim").fadeIn("normal",function(){
											$("#boxAlert .hrefCamp h2").text("Gracias por registrarte en Power-Influencers");
											$("#boxAlert .hrefCamp i").append("<img src='img/logo_pi-06.svg' width='100%' height='100%'/>");
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
													window.location.reload();
												}});
											});
									});
					break;
					case "false":$(".alertElim").fadeIn("normal",function(){
													$("#boxAlert .hrefCamp h2").text("algo anda mal");
													$("#boxAlert .hrefCamp i").addClass("fa-warning");
													$("#boxAlert .hrefCamp p.messageAlert").text("El correo "+$('.correonuevo').val()+" ya existe en la base de datos, intente con otro.");

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
															$("#boxAlert .hrefCamp i").removeClass("fa-warning");
															$('.correonuevo').val('');
															$('.correonuevo').focus();
														}});
													});
											});
					break;
					case "invalido":$(".alertElim").fadeIn("normal",function(){
														$("#boxAlert .hrefCamp h2").text("algo anda mal");
														$("#boxAlert .hrefCamp i").addClass("fa-warning");
														$("#boxAlert .hrefCamp p.messageAlert").text("Problema con el tamaño o formato de la imagen.");

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
															}});
														});
												});
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
		info.append('fecha_termino',$('.fecha_termino').val())
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
						case "nueva":$(".alertElim").fadeIn("normal",function(){
									$("#boxElim .hrefCamp h2").text("Campaña creada con exito");
									$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
									$("#boxElim .hrefCamp p").text("Puedes ver o seguir creando más campañas.");
									$(".siElim").text("ver campaña");
									$(".noElim").text("crear otra");

									$("#boxElim").show().animate({
										top:"20%",
										opacity:1
									},{duration:1500,easing:"easeOutBounce"});

									$(".siElim").on("click",function(){
										window.location.href = "campana.php";
									});

									$(".noElim").on("click",function(){
										window.location.reload();
									});
							});
						break;
						case "invalido" :$(".alertElim").fadeIn("normal",function(){
								$("#boxAlert .hrefCamp h2").text("algo anda mal");
								$("#boxAlert .hrefCamp i").addClass("fa-warning");
								$("#boxAlert .hrefCamp p.messageAlert").text("Tu imagen puede que supere el tamaño permitido, el formato no corresponde o no hay nada adjunto.");

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
						case "nuevo":$(".alertElim").fadeIn("normal",function(){
								$("#boxAlert .hrefCamp h2").text("imagen cambiada");
								$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
								$("#boxAlert .hrefCamp p.messageAlert").text("Imagen cambiada con exito.");

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
										window.location.reload();
									}});
								});
						});
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
						case "actualiza":$(".alertElim").fadeIn("normal",function(){
								$("#boxAlert .hrefCamp h2").text("datos actualizados");
								$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
								$("#boxAlert .hrefCamp p.messageAlert").text("Tus datos se han actualizado, la pagina se actualizara para reflejar los cambios.");

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
										window.location.reload();
									}});
								});
						});
						break;
					}
				}
			});
			//console.log('');
		};

		return false;
	}));
	
		$('#imagenform-ipe').on('submit',(function (e){
		e.preventDefault;
		info = new FormData(this);
		info.append('correo',$('#correo input').val());
		info.append('rsid',$('#RsId').val());
		info.append('nombre',$('#nombre input').val());
		var f = document.getElementById("region");
		var region = f.options[f.selectedIndex].value;
		var g = document.getElementById("comuna");
		var comuna = g.options[g.selectedIndex].value;
		info.append('descripcion',$('#descripcion textarea').val());
		console.log($('#descripcion textarea').val());
		info.append('comuna',comuna);
		info.append('region',region);
		info.append('tipo','avatar-ipe');

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
					console.log(info);
					switch (info){
						case "nuevo":$(".alertElim").fadeIn("normal",function(){
								$("#boxAlert .hrefCamp h2").text("imagen cambiada");
								$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
								$("#boxAlert .hrefCamp p.messageAlert").text("Imagen cambiada con exito.");

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
										window.location.reload();
									}});
								});
						});
						break;
						default: alert('el tamaño o formato no es aceptado');
						break;
					}
				}
			});
		}
		else{
			//console.log(region+comuna+$('#correo input').val()+$('#nombre input').val());
			$.ajax({

					type: "POST",
					url: "./procesar-dashboard-ipe.php",
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData:false,

				success: function(info){
					console.log(info);
					switch (info){
						case "actualiza":
						//console.log('actualiza');
						$(".alertElim").fadeIn("normal",function(){
								$("#boxAlert .hrefCamp h2").text("datos actualizados");
								$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
								$("#boxAlert .hrefCamp p.messageAlert").text("Tus datos se han actualizado, la pagina se actualizara para reflejar los cambios.");

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
										window.location.reload();
									}});
								});
						});
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
					$(".alertElim").fadeIn("normal",function(){
							$("#boxAlert .hrefCamp h2").text("registro completado");
							$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
							$("#boxAlert .hrefCamp p.messageAlert").text("Registro de datos completo, nos contactaremos con usted.");

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
				}
			});
		}else{
			$(".alertElim").fadeIn("normal",function(){
					$("#boxAlert .hrefCamp h2").text("algo anda mal");
					$("#boxAlert .hrefCamp i").addClass("fa-warning");
					$("#boxAlert .hrefCamp p.messageAlert").text("Debes ingresar al menos 8 digitos como número telefonico.");
					
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
		}

	});
});

//INICIO FUNCTIONS
/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define( [ "../widgets/datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {

datepicker.regional.es = {
	closeText: "Cerrar",
	prevText: "&#x3C;Ant",
	nextText: "Sig&#x3E;",
	currentText: "Hoy",
	monthNames: [ "Enero","Febrero","Marzo","Abril","Mayo","Junio",
	"Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ],
	monthNamesShort: [ "ene","feb","mar","abr","may","jun",
	"jul","ago","sep","oct","nov","dic" ],
	dayNames: [ "domingo","lunes","martes","miércoles","jueves","viernes","sábado" ],
	dayNamesShort: [ "dom","lun","mar","mié","jue","vie","sáb" ],
	dayNamesMin: [ "D","L","M","X","J","V","S" ],
	weekHeader: "Sm",
	dateFormat: "dd/mm/yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.es );

return datepicker.regional.es;

} ) );


$(function() {
	var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
	//var dateToday = new Date();
	//dateToday++;
	$( "#datepicker" ).datepicker({dateFormat: "dd MM yy", firstDay:1, minDate: tomorrow,dayNamesMin:["dom","lun","mar","mie","jue","vie","sab"]});
});



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
