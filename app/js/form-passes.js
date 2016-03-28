
$(document).ready(function(){
	 
	//INICIO SCRIPTS
	var info;

	$('#facebook-name').hide();
	$('#volver').hide();

	//login de ingreso (agencia-ipe)
	$('#ingresar').click(function(){
		var correo=$('#correo').val();
		var password=$('#password').val();
		$.ajax({
			type: "POST",
			url: "./controller/procesar-login.php",
			data: "correo="+correo+"&pwd="+password,

			success: function(data){
					switch (data){
					case "admin": window.location.href= "./dashboard-admin";
					break;
					case "agencia": window.location.href = "./escritorio-agencia";
					break;
					case "ipe": window.location.href = "./escritorio-influencer";
					break;
					case "inactivo":$('#alertRegistrado').slideDown();document.getElementById('alertRegistrado').innerHTML ="usuario inactivo";
					break;
					case "false":$('#alertRegistrado').slideDown();document.getElementById('alertRegistrado').innerHTML ="usuario o password no existen";
					break;
					case "vacio":$('#alertRegistrado').slideDown();document.getElementById('alertRegistrado').innerHTML ="falta ingresar datos";
					break;
				}
			}
		});
	});

	//perfil influenciador publico
	$('#contactar-influenciador-perfil').click(function(){
		var influenciador_id = $(this).attr('name');
		var influenciador_nombre = $('#1').attr('name');
		//var correo_agencia = "<?php echo $_SESSION['correo'];?>";
		var url = window.location.href;
		var url = url.split("/");
		var id_campana = url[5];
		var tipo="perfil_publico";
		$.ajax({
			type: "POST",
			url: "../../controller/contactar-a-influenciador-agencia.php",
			data: "influenciador_id="+influenciador_id+"&influenciador_nombre="+influenciador_nombre+"&id_campana="+id_campana+"&tipo="+tipo,

			success: function(data){
					switch (data){
						case "exito": cotizacion_personal_ok();
						break;
						case "false": cotizacion_personal_error();
						break;
					}
			}
		});
	});

	//Formulario de registro en agencia.php
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
		tipo=$('#perfil option').val();
		var e = document.getElementById("perfil");
		var perfil = e.options[e.selectedIndex].value;
		info.append('ipe',perfil);

		$.ajax({
			type: "POST",
			url: "./controller/procesar-imagen.php",
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				inscripcion_influenciador(data);
			}
		});
	}));
		
	$('.cont_formRegistro').on('submit',(function(e){
		//formulario de ipe con registro por red social
		info = new FormData(this);
		var e = document.getElementById("perfil");
		var perfil = e.options[e.selectedIndex].value;
		var f = document.getElementById("region");
		var region = f.options[f.selectedIndex].value;
		var g = document.getElementById("comuna");
		var comuna = g.options[g.selectedIndex].value;
		info.append('perfil',perfil);
		info.append('region',region);
		info.append('comuna',comuna);
		$.ajax({
			type: "POST",
			url: "./controller/procesar-registro-facebook-ipe.php",
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
			 	termina_formulario(data);
			}
		})
		return false;
	}));

	//formulario en influenciador.php
	$('.registerFormInfluenciador').on('submit',(function(e){
		e.preventDefault();
		info = new FormData(this);
		info.append('nuuser',$('.usernamenuevo').val());
		info.append('nupass',$('.contraseña').val());
		info.append('nucorreo',$('.correonuevo').val());
		info.append('tipo','influenciador');
		tipo=$('#perfil option').val();
		var d = document.getElementById("perfil");
		var perfil = d.options[d.selectedIndex].value;
		var f = document.getElementById("region");
		var region = f.options[f.selectedIndex].value;
		var g = document.getElementById("comuna");
		var comuna = g.options[g.selectedIndex].value;
		info.append('ipe',perfil);
		info.append('region',region);
		info.append('comuna',comuna);

		$.ajax({
			type: "POST",
			url: "./controller/procesar-imagen.php",
			data: info,
			enctype: 'multipart/form-data',
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				inscripcion_influenciador(data);
			}
		});
	}));
	

	//registro con linkedin en agencia.php
	$('#linkedin-nuevo').click(function(){
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	77yaxbujewtbl4\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
	});

	//ingreso con likedin en agencia.php
	$('#linkedin-antiguo').click(function(){
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.id = 'linkedinId';
		script.src = '//platform.linkedin.com/in.js';
		script.text ='\n api_key:	77yaxbujewtbl4\nauthorize:	false\nonLoad: onLinkedInLoad\n';
		head.appendChild(script);
	});

	//verificación de coincidencia de password y de ingreso de números en formulario agencia.php
	$("#ver-password").keyup(checkPasswordMatch);
	$("#telefono1nuevo").keyup(phone1Length);
	$("#telefono2nuevo").keyup(phone2Length);

	//verificaciòn de coincidencia de password en ipe influenciador.php
	$("#ver-passwordIpe").keyup(checkPasswordMatchIpe);


	//DASHBOARD SCRIPTS

	//variables globales
	var correo,nombre,correo,tel1,tel2,empresa;
	var rsid = $('#RsId').val();
	var foto=0;

	//verificación de subida de imagen de perfil en formulario en agencia.php
	$('#file').click(function(){
		foto=1;
		$("input:file").change(function (){
			$('.alert-uploadready').slideDown();
     	});
	});

	//formulario de ingreso de nueva campaña nueva-campana-agencia.php
	$('#campanaForm-nueva-campana').on('submit',(function (e){
		e.preventDefault;
		var val = [];
		info = new FormData(this);
		info.append('nombre',$('#nombre-nueva-campana').val());
		info.append('marca',$('#marca-nueva-campana').val());
		info.append('descripcion',$('#descripcion-nueva-campana').val());
		info.append('fecha_termino',$('.fecha_termino').val())
		info.append('tipo','campana');
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });

        alert(val);
		info.append('selected_rrss',val);
		$.ajax({
				type: "POST",
				url: "./controller/procesar-imagen.php",
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,

				success: function(data){
					switch (data){
						case "nueva":nueva_campana();
						break;
						case "invalido" :error_campana();
						break;
					}
				}
			});
		return false;
	}));

	//formulario de cambio de imagen en header-agencia.php
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
		if(window.location.href.split('/').length == 7){
			var url_procesar_imagen= "../../controller/procesar-imagen.php";
		}else{
			var url_procesar_imagen= "./controller/procesar-imagen.php";
		}
		if(foto==1) {
			$.ajax({
				type: "POST",
				url: url_procesar_imagen,
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,

				success: function(info){
					switch (info){
						case "nuevo":imagen_cambiada();
						break;
						default: error_imagen();
						break;
					}
				}
			});
		}
		else{
			$.ajax({

					type: "POST",
					url: "./controller/procesar-dashboard-agencia.php",
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData:false,
				success: function(info){
					switch (info){
						case "actualiza": datos_actualizados();
					}
				}
			});
		};
		return false;
	}));
	
	//formulario de cambio de imagen en header-ipe.php
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
		info.append('comuna',comuna);
		info.append('region',region);
		info.append('tipo','avatar-ipe');

		if(foto==1) {
			$.ajax({
				type: "POST",
				url: "./controller/procesar-imagen.php",
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,

				success: function(info){
					switch (info){
						case "nuevo":imagen_cambiada();
						break;
						default: error_imagen();
						break;
					}
				}
			});
		}
		else{
			$.ajax({
					type: "POST",
					url: "./controller/procesar-dashboard-ipe.php",
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData:false,

				success: function(info){
					switch (info){
						case "actualiza":datos_actualizados();
						break;
					

					}
				}
			});
		};
		return false;
	}));

	//formulario para agencia con registro por red social formulario-red-social-agencia.php
	$('#formulario_agencias_rs').on('submit',function(e){
		e.preventDefault();
		if($("#telefono1nuevo").val().length > 7 && $("#telefono2nuevo").val().length > 7){
				info = new FormData(this);
				info.append('nombre',$('#nombre input').val());
				info.append('empresa',$('#empresanueva').val());
				info.append('correo',$('#correo input').val());
				info.append('tel1',$('#telefono1nuevo').val());
				info.append('tel2',$('#telefono2nuevo').val());

			$.ajax({
				type: "POST",
				url: "./controller/procesar-formulario.php",
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					formulario_completo();
				}
			});
		}else{
			error_numero_telefonico();
		}

	});

	//envio de formulario para envio de url a campañas desde ipe controller/procesar-mostrar-campanas-ipe.php
	$('.enviar_url').click(function(){
			var rrss_id = $(this).prevAll('input').attr('id');
			var campana_id = $(this).closest(".ingresar_urls").attr('id');
			var link = $(this).prevAll('#'+rrss_id).val();
			var descripcion_rrss = $(this).prevAll('input').attr('name');
			alert("rrss_id:"+rrss_id+"-campana_id:"+campana_id+"-link:"+link+"-descripcion_rrss:"+descripcion_rrss);

				if(descripcion_rrss=='googleplus'||descripcion_rrss=='facebook'||descripcion_rrss=='twitter'||descripcion_rrss=='youtube'||descripcion_rrss=='instagram'&&link.length>0){
					$.ajax({
						type: "POST",
						url: "./controller/procesar-url.php",
						data: "rrss_id="+rrss_id+"&campana_id="+campana_id+"&url="+link+"&descripcion_rrss="+descripcion_rrss,
						success: function(data){
							switch (data){
								case 'exito':  	url_ok();
								break;
								case 'false' :  url_error(descripcion_rrss);			
								break;
								case 'existe' :  url_existe(descripcion_rrss);			
								break;

							}
						}
					});	
				}
		//})
	});
/*
		$('#enviar_url').click(function(){
		if(descripcion_rrss='googleplus'){
			var resultado;
			$('.rrss input').each(function(){
			var rrss_id = $(this).attr('id');
			var campana_id = $(this).closest(".ingresar_urls").attr("id");
			var url = $(this).val();
			var descripcion_rrss=$(this).closest(".rrss").attr("name");
				if(url.indexOf(rrss_id)>0){
					enviar_url_verificada(rrss_id,campana_id,url,descripcion_rrss);

				}else{
					alert('la url no corresponde');
				}
			})
		}			
	});
*/
	//boton para activación de campana campana-agencia.php
	$(".activar-campana").click(function (){
		var idActualizar = this.id;
		var idEstado = this.type;
		var tipo = "activar";
		var fecha_termino = $("#"+idActualizar+" .campa-ico .fecha_termino").val();
			$.ajax({
				type: "POST",
				url: "./controller/procesar-eliminar-campana-agencia.php",
				data: "idActualizar="+idActualizar+"&idEstado="+idEstado+"&tipo="+tipo+"&fecha_termino="+fecha_termino,
				success: function(data){
					window.location.reload();
				}
			});
	});

	//boton para eliminación de campana campana-agencia.php
	$(".btneliminar").click(function (){
		var idEliminar = this.id;
		var tipo = "eliminar";

		$(".alertElim").fadeIn("normal",function(){
			$("#boxAlert .hrefCamp h2").text("Estas a punto de eliminar la campaña");
			$("#boxAlert .hrefCamp").prepend("<div id='ico-trash'></div>");

			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
			$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

			deleteElem();

			$("#boxAlert .hrefCamp p").text("Si eliminas tu campaña, pederas tus datos sin posibilidad de recuperarlos.");

			$(".siElim").text("eliminar campaña");
			$(".noElim").text("volver");

			$("#boxAlert").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});

			$(".siElim").on("click",function(){
				$.ajax({
					type: "POST",
					url: "./controller/procesar-eliminar-campana-agencia.php",
					data: "idEliminar="+idEliminar+"&tipo="+tipo,
					success: function(data){
						window.location.reload();
					}
				});
			});
			$(".noElim").on("click",function(){
				$("#boxAlert").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$("#icon-warning, #clearAlert").remove();
					$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
					$(this).hide();
				}});
			});
		});

		return false;
	});
	
	//activación y desactivación de red social en controller/procesar-mostrar-followers-ipe.php
	$(".estado_rs").click(function(){
	    if(this.value == "analytics"){
	        var id_activar_rs = this.id;
	        var tipo = "activar_rs2";
	        var estado =parseInt(this.name);
	        $.ajax({
	          type: "POST",
	          url: "./rrss/procesar_activar_rs.php",
	          data: "id_activar_rs="+id_activar_rs+"&estado="+estado+"&tipo="+tipo,
	          success: function(data){
	            window.location.reload("escritorio-influencer.php#fragment-2");
	          }
	        });

	    }else{
	        var id_activar_rs = this.id;
	        var tipo = "activar_rs";
	        var estado =parseInt(this.name);
	        $.ajax({
	          type: "POST",
	          url: "./rrss/procesar_activar_rs.php",
	          data: "id_activar_rs="+id_activar_rs+"&estado="+estado+"&tipo="+tipo,
	          success: function(data){
	            window.location.reload();
	            //alert(data);
	          }
	        });
	    }

	 });
	//eliminar red social en controller/procesar-mostrar-followers-ipe.php
    $(".elimina").click(function(){
       var id_rrss = $(this).attr("name");
       var tipo="desactivar";
       $.ajax({
              type: "POST",
              url: "./rrss/procesar_activar_rs.php",
              data: "id_rrss="+id_rrss+"&tipo="+tipo,
              success: function(data){
                alert(data);
                window.location.reload();
              }
            });
    });

	//ver resumen de redes sociales influenciador en influenciador-publico-agencia.com
	$(".ver_perfil_influenciador").click(function(){
		var id_form=$(this).attr("name");
		$("#"+id_form+" .rrss").show();
		var a = $("#"+id_form+" .access-ipe .rrss_reach").text();
		var b = $("#"+id_form+" .access-ipe .rrss_reach span:last-child").text();
		$("#"+id_form+" .ver_perfil_influenciador").hide();
		$("#"+id_form+" .volver_ver_perfil_influenciador").show();
	});

	//volver desde resumen de redes sociales influenciador a la vista general en influenciador-publico-agencia.com
	$(".volver_ver_perfil_influenciador").click(function(){
		var id_form=$(this).attr("name");
		$("#"+id_form+" .rrss").hide();
		$("#"+id_form+" .access-ipe div:first-child").remove();
		$("#"+id_form+" .access-ipe .rrss_reach").show();
		$("#"+id_form+" .ver_perfil_influenciador").show();
		$("#"+id_form+" .volver_ver_perfil_influenciador").hide();
	});

	/*
	$('#ingresar').on('click', function(){
		var usu= $('#usu').val();
		var pass= $('#pass').val();
		var url='./controller/procesar-login.php';
		var total = usu.length*pass.length;
		if (total>0){
			$.ajax({
			type: 'POST',
			url: url,
			data: 'usu='+usu+'&pass='+pass,

			
			 success:function(valor){
				if(valor == 'usuario'){
					$('#mensaje').html('La contraseña o usuario ingresados no existe');
					$('#username-antiguo').focus();
					return false;
				}else if (valor == 'password'){
					$('#mensaje').html('La contraseña o usuario ingresados no existe');
					$('#contraseña-antiguo').focus();
					return false;
				}else if(valor == 'activo'){
				$('#mensaje').html('Usuario inactivo');
				$('#username-antiguo').focus();

				}else {
				//redireccionar según idTipo de usuario
				$('#mensaje').html('paso por todas las validaciones');
				}
			 },
			 
			 error: function(xhr, textStatus, error){
			 }
			

			});
			}else{
			$('#mensaje').html('Complete todos los campos');
			}

		})*/



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
			yearSuffix: "" 
		};
		datepicker.setDefaults( datepicker.regional.es );

		return datepicker.regional.es;

	})
);


$(function() {
	var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
	$( "#datepicker" ).datepicker({dateFormat: "dd MM yy", firstDay:1, minDate: tomorrow,dayNamesMin:["dom","lun","mar","mie","jue","vie","sab"]});
});

/*********************************************************************************************************
****************************************Mensajes según formularios****************************************
/*********************************************************************************************************/
function inscripcion_influenciador(data){
	switch (data){
		case "nuevo":$(".alertElim").fadeIn("normal",function(){
						$("#boxAlert .hrefCamp h2").text("Gracias por registrarte en Power-Influencers");
						$("#boxAlert .hrefCamp").prepend("<div id='icon-pi-animado'></div>");

						$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

						powerinfluencer();

						$("#boxAlert .hrefCamp p.messageAlert").text("Tu cuenta sera activada proximamente, pronto nos contactaremos contigo.");

						$("#clearAlert").text("continuar");

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
								window.location.href = "./controller/logout";
								window.location.reload();
							}});
						});
					});
		break;
		case "false":$(".alertElim").fadeIn("normal",function(){

						$("#boxAlert .hrefCamp h2").text("algo anda mal");
						$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");
						
						$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

						$('#clearAlert').text('continuar');

						warning();

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
								$("#icon-warning, #clearAlert").remove();
								$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
								$(this).hide();
								$('.correonuevo').val('');
								$('.correonuevo').focus();
							}});
						});
					});
		break;
		case "invalido":$(".alertElim").fadeIn("normal",function(){

							$("#boxAlert .hrefCamp h2").text("algo anda mal");
							$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");
							
							$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

							$('#clearAlert').text('continuar');

							warning();

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
									$("#icon-warning, #clearAlert").remove();
									$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
									$(this).hide();
								}});
							});
						});
	}
}
function datos_actualizados(){
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
}
function imagen_cambiada(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("imagen cambiada");
		$("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		success();

		$("#boxAlert .hrefCamp p.messageAlert").text("Imagen cambiada con exito.");
		$("#clearAlert").text("continuar");

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
}
function error_imagen(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("algo anda mal");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");
		
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		$('#clearAlert').text('continuar');

		warning();

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
				$(".alertElim").hide("fast");
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function error_campana(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("algo anda mal");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");
		
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		$('#clearAlert').text('continuar');

		warning();

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
				$(".alertElim").hide("fast");
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function nueva_campana(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("Campaña creada con éxito");
		$("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

		success();

		$("#boxAlert .hrefCamp p.messageAlert").text("Puedes ver o seguir creando más campañas.");
		$(".siElim").text("ver campaña");
		$(".noElim").text("crear otra");

		$("#boxAlert").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			window.location.href = "./campanas";
		});

		$(".noElim").on("click",function(){
			window.location.reload();
		});
	});
}
function url_ok(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("URL agregada");
		$("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		success();

		$("#boxAlert .hrefCamp p.messageAlert").text("URL agregada con éxito.");
		$("#clearAlert").text("continuar");

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
}
function cotizacion_personal_ok(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("Influenciador Cotizado");
		$("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		success();

		$("#boxAlert .hrefCamp p.messageAlert").text("Pronto nos contactaremos para entregarle más información del influenciador");
		$("#clearAlert").text("continuar");

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
}
function cotizacion_personal_error(){
	
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("Error al cotizar Influenciador");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");
		
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		$('#clearAlert').text('continuar');

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("Al parecer la campaña y/o influenciador indicada(s) no existe.");

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
}
function url_error(descripcion_rrss){

	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("URL no aceptada");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("La URL no corresponde al perfil registrado en Power Influencer("+descripcion_rrss+")");
		$(".siElim").text("Ir a Escritorio");
		$(".noElim").text("Continuar en campañas");

		$("#boxAlert").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			window.location.href = "./escritorio-influencer";
		});

		$(".noElim").on("click",function(){
			$("#boxAlert").animate({
				top:"-100px",
				opacity:0
			},{duration:500,easing:"easeInOutQuint",complete:function(){
				$(".alertElim").fadeOut("fast");
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function url_existe(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("URL ya ingresada");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("La URL ya fue registrada en Power Influencer.");
		$(".siElim").text("Ir a Escritorio");
		$(".noElim").text("Continuar en campañas");

		$("#boxAlert").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			window.location.href = "./escritorio-influencer";
		});

		$(".noElim").on("click",function(){
			$("#boxAlert").animate({
				top:"-100px",
				opacity:0
			},{duration:500,easing:"easeInOutQuint",complete:function(){
				$(".alertElim").fadeOut("fast");
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function error_numero_telefonico(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("algo anda mal");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("Debes ingresar al menos 8 digitos como número telefonico.");
		$("#clearAlert").text("continuar");

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
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function formulario_completo(){
	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("registro completado");
		$("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		success();

		$("#boxAlert .hrefCamp p.messageAlert").text("Registro de datos completo, nos contactaremos con usted.");
		$("#clearAlert").text("continuar");

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
				window.location.href = "./controller/logout";
			}});
		});
	});

	$(".alertElim").fadeIn("normal",function(){
		$("#boxAlert .hrefCamp h2").text("Gracias por registrarte en Power-Influencers");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-pi-animado'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		powerinfluencer();

		$("#boxAlert .hrefCamp p.messageAlert").text("Tu cuenta sera activada proximamente, pronto nos contactaremos contigo.");

		$("#clearAlert").text("continuar");

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
				window.location.href = "./controller/logout";
				window.location.reload();
			}});
		});
	});
}
function formulario_incompleto(){

	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("Ingrese todos los campos");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("Por favor ingrese todos los datos en el formulario.");
		$("#clearAlert").text("continuar");

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
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function error_numero_telefonico(){

	$(".alertElim").fadeIn("normal",function(){

		$("#boxAlert .hrefCamp h2").text("algo anda mal");
		$("#boxAlert .hrefCamp").prepend("<div id='icon-warning'></div>");

		$("#boxAlert .hrefCamp").append("<div class='btn_crearcamp' id='clearAlert'></div>");

		warning();

		$("#boxAlert .hrefCamp p.messageAlert").text("Debes ingresar al menos 8 digitos como número telefonico.");
		$("#clearAlert").text("continuar");

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
				$("#icon-warning, #clearAlert").remove();
				$("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
				$(this).hide();
			}});
		});
	});
}
function termina_formulario(data){
	switch (data){
		case "actualizado": formulario_completo();
		break;
		case "false": formulario_incompleto();
		break;
	}
}
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


