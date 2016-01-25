
$(document).ready(function(){
	 
	//INICIO SCRIPTS
	var info;

	$('#facebook-name').hide();
	$('#volver').hide();

	//login de ingreso (agencia-ipe)
	$('#ingresar').click(function(){
		correo=$('#correo').val();
		password=$('#password').val();
		$.ajax({
			type: "POST",
			url: ".controller/procesar_login.php",
			data: "correo="+correo+"&pwd="+password,

			success: function(data){
					switch (data){
					case "admin": window.location.href= "./dashboard-admin";
					break;
					case "agencia": window.location.href = "./dashboard-agencia";
					break;
					case "ipe": window.location.href = "./dashboard-ipe";
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

	//perfil influenciador publico
	$('#contactar-influenciador-perfil').click(function(){
		var influenciador_id = $(this).attr('name');
		var influenciador_nombre = $('#1').attr('name');
		//var correo_agencia = "<?php echo $_SESSION['correo'];?>";
		var url = window.location.href;
		var url = url.split("campana=");
		id_campana = url[1];
		var tipo="perfil_publico";
		$.ajax({
			type: "POST",
			url: "controller/contactar.php",
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
			url: "./controller/procesar_imagen.php",
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
			url: "./controller/procesar_registro_ipe_facebook.php",
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
			url: "./controller/procesar_imagen.php",
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

	//formulario de ingreso de nueva campaña nueva-campana.php
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
		info.append('selected_rrss',val);
		$.ajax({
				type: "POST",
				url: "./controller/procesar_imagen.php",
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

	//formulario de cambio de imagen en header.php
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
				url: "./controller/procesar_imagen.php",
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
				url: "./controller/procesar_imagen.php",
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

	//formulario para agencia con registro por red social formulario-agencia.php
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
				url: "procesar_formulario.php",
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					formulario_agencia_completo();
				}
			});
		}else{
			error_numero_telefonico();
		}

	});

	//envio de formulario para envio de url a campañas desde ipe procesar_mostrar_campanas_en_ipe.php
	$('.enviar_url').click(function(){
			var rrss_id = $(this).prevAll('input').attr('id');
			var campana_id = $(this).closest(".ingresar_urls").attr('id');
			var url = $(this).prevAll('#'+rrss_id).val();
			var descripcion_rrss = $(this).prevAll('input').attr('name');

				if(descripcion_rrss=='googleplus'||descripcion_rrss=='facebook'||descripcion_rrss=='twitter'||descripcion_rrss=='youtube'||descripcion_rrss=='instagram'&&url.length>0){
					$.ajax({
						type: "POST",
						url: "./controller/procesar_url.php",
						data: "rrss_id="+rrss_id+"&campana_id="+campana_id+"&url="+url+"&descripcion_rrss="+descripcion_rrss,
						success: function(data){
							console.log(data);
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
			//console.log(rrss_id+"-"+campana_id+"-"+url+"-"+descripcion_rrss);
			
				if(url.indexOf(rrss_id)>0){
					enviar_url_verificada(rrss_id,campana_id,url,descripcion_rrss);

				}else{
					alert('la url no corresponde');
				}
			})
		}			
	});
*/
	//boton para activación de campana campana.php
	$(".activar-campana").click(function (){
		var idActualizar = this.id;
		var idEstado = this.type;
		var tipo = "activar";
		var fecha_termino = $("#"+idActualizar+" .campa-ico .fecha_termino").val();
			$.ajax({
				type: "POST",
				url: "./controller/procesar_eliminar-campana.php",
				data: "idActualizar="+idActualizar+"&idEstado="+idEstado+"&tipo="+tipo+"&fecha_termino="+fecha_termino,
				success: function(data){
					window.location.reload();
				}
			});
	});

	//boton para eliminación de campana campana.php
	$(".btneliminar").click(function (){
		var idEliminar = this.id;
		var tipo = "eliminar";
		$(".alertElim").fadeIn("normal",function(){
			$("#boxElim .hrefCamp h2").text("Estas a punto de eliminar la campaña");
			animaTrash();
			setInterval(function(){
				animaTrash();
			},2800);
			//$("#boxElim .hrefCamp i").addClass("fa-trash-o");
			$("#boxElim .hrefCamp p").text("Si eliminas tu campaña, pederas tus datos sin posibilidad de recuperarlos.");
			$(".siElim").text("eliminar campaña");
			$(".noElim").text("volver");
			$("#boxElim").show().animate({
				top:"20%",
				opacity:1
			},{duration:1500,easing:"easeOutBounce"});
			$(".siElim").on("click",function(){
				$.ajax({
					type: "POST",
					url: "./controller/procesar_eliminar-campana.php",
					data: "idEliminar="+idEliminar+"&tipo="+tipo,
					success: function(data){
						window.location.reload();
					}
				});
			});
			$(".noElim").on("click",function(){
				$("#boxElim").animate({
					top:"-100px",
					opacity:0
				},{duration:500,easing:"easeInOutQuint",complete:function(){
					$(".alertElim").fadeOut("fast");
					$(this).hide();
				}});
			});
		});
		return false;
	});
	
	//activación y desactivación de red social en procesar_mostrar_followers.php
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
	            window.location.reload("dashboard-ipe.php#fragment-2");
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
	          }
	        });
	    }

	 });
	//eliminar red social en procesar_mostrar_followers.php
    $(".elimina").click(function(){
       id_rrss = $(this).attr("name");
       tipo="desactivar";
       $.ajax({
              type: "POST",
              url: "./rrss/procesar_activar_rs.php",
              data: "id_rrss="+id_rrss+"&tipo="+tipo,
              success: function(data){
                alert("cuenta desvinculada");
                window.location.reload();
              }
            });
    });

    //controller para dashboard-agencia.php
	$(".volver, .recientes .content").hide();
	$(".recientes .content").hide();
	 if(document.documentElement.clientWidth >= 1024){
        $(".ver-mas").on("click",function(event){
            $(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
            $(".dashboard-agencia").animate({backgroundColor:"#eeeef0"},{duration:1000, 
                complete:function(){

                    $(".recientes, .cont-campana").css("width","100%");
                }
            });

            $(this).siblings(".content").delay(1005).slideToggle();
            $(this).siblings(".reach-campana, .reach-campana .sub-titulo").delay(1010).fadeIn();
        });
    }else{
        $(".ver-mas").on("click",function(event){
            $(this).siblings(".content").slideToggle();
            $(this).find("i").toggleClass("fa-angle-up fa-angle-down");
            $("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);
        });
    }

	$(".content .btn_close").on("click",function(){
			$(this).closest(".content").fadeOut();
            $(".reach-campana, .reach-campana .sub-titulo").delay(100).fadeOut();
			if(document.documentElement.clientWidth >= 1024){
				$(".dashboard-agencia").animate({backgroundColor:"#fff"},{duration:1000,complete:function(){
                
                    $(".recientes, .cont-campana").removeAttr("style","");
				    $(".bg-campana, .ver-mas, .sub-titulo").delay(800).fadeIn();
                }});
				$(".ver-mas").find("i").addClass("fa-plus");
			}
	});

	//boton cotización de influenciador en influenciador-publico.php
	$("#cotizar_influenciador").click(function(){
		var influenciadores_cotizados="";
		var influenciadores_cotizados_nombre ="";
		$("input:checked").each(function() {
			influenciadores_cotizados += this.value +",";
			influenciadores_cotizados_nombre += this.name +",";
		});
		var largo_string_influenciadores = influenciadores_cotizados.length - 1;
		var influenciadores_cotizados = influenciadores_cotizados.substring(0,largo_string_influenciadores);
		var array_id_influenciadores_seleccionados= influenciadores_cotizados.split(",");
		var array_nombre_influenciadores_seleccionados = influenciadores_cotizados_nombre.split(",");
		var agencia = "'.$_SESSION["nombre"].'";
		var correo_agencia = "'.$_SESSION["correo"].'";
		var influenciador = this.name;
		var campana = $("#campanas-postulables option:selected").val();
		var id_campana = $("#campanas-postulables option:selected").attr("value");
		var tipo ="perfiles";
		if(campana =="Seleccione campaña") campana = "Sin especificar";
		for(var i=0; i<array_id_influenciadores_seleccionados.length; i++){
			var influenciador_id=array_id_influenciadores_seleccionados[i];
			var influenciador= array_nombre_influenciadores_seleccionados[i];
			$.ajax({
				type: "POST",
				url: "controller/contactar.php",
				data: "agencia="+agencia+"&correo_agencia="+correo_agencia+"&influenciador="+influenciador+"&influenciador_id="+influenciador_id+"&campana="+campana+"&id_campana="+id_campana+"&tipo="+tipo,
				success: function(data){
					$(".boton_cotizar").show();
				$("input:checkbox").removeAttr("checked");

					
				}
			});

		}
		if(array_id_influenciadores_seleccionados.length == 1 ){
			$(".alertElim").fadeIn("normal",function(){
				$("#boxElim .hrefCamp h2").text("Influenciador agregado");
				$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
				$("#boxElim .hrefCamp p").text("La cotizacion ha sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
				$(".siElim").text("Ir a campañas");
				$(".noElim").text("Ver Influenciadores");

				$("#boxElim").show().animate({
					top:"20%",
					opacity:1
				},{duration:1500,easing:"easeOutBounce"});

				$(".siElim").on("click",function(){

					window.location.href = "campana.php";
				});

				$(".noElim").on("click",function(){
					$("#boxElim").animate({
						top:"-100px",
						opacity:0
					},{duration:500,easing:"easeInOutQuint",complete:function(){
						$(".alertElim").fadeOut("fast");
						$(this).hide();
					}});
				});
			});
		}
		if(array_id_influenciadores_seleccionados.length > 1 ){
			$(".alertElim").fadeIn("normal",function(){
				$("#boxElim .hrefCamp h2").text("Influenciador agregado");
				$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
				$("#boxElim .hrefCamp p").text("La cotizacion ha sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
				$(".siElim").text("Ir a campañas");
				$(".noElim").text("Ver Influenciadores");

				$("#boxElim").show().animate({
					top:"20%",
					opacity:1
				},{duration:1500,easing:"easeOutBounce"});

				$(".siElim").on("click",function(){

					window.location.href = "campana.php";
				});

				$(".noElim").on("click",function(){
					$("#boxElim").animate({
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

	//ver resumen de redes sociales influenciador en influenciador-publico.com
	$(".ver_perfil_influenciador").click(function(){
		var id_form=$(this).attr("name");
		$("#"+id_form+" .rrss").show();
		var a = $("#"+id_form+" .access-ipe .rrss_reach").text();
		var b = $("#"+id_form+" .access-ipe .rrss_reach span:last-child").text();
		$("#"+id_form+" .ver_perfil_influenciador").hide();
		$("#"+id_form+" .volver_ver_perfil_influenciador").show();
	});

	//volver desde resumen de redes sociales influenciador a la vista general en influenciador-publico.com
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
		var url='./controller/procesar_login.php';
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
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
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
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.es );

return datepicker.regional.es;

} ) );


$(function() {
	var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
	$( "#datepicker" ).datepicker({dateFormat: "dd MM yy", firstDay:1, minDate: tomorrow,dayNamesMin:["dom","lun","mar","mie","jue","vie","sab"]});
});

/*********************************************************************************************************
****************************************Mensajes según formularios****************************************
/*********************************************************************************************************/
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
}

function error_imagen(){
	$(".alertElim").fadeIn("normal",function(){
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

}

function error_campana(){
	$(".alertElim").fadeIn("normal",function(){
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

}
function nueva_campana(){
	$(".alertElim").fadeIn("normal",function(){
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
			window.location.href = "campana";
		});

		$(".noElim").on("click",function(){
			window.location.reload();
		});
	});
}
function url_ok(){
	$(".alertElim").fadeIn("normal",function(){
		animaMune();
		animaMano();
		setInterval(function(){
			animaMune();
			animaMano();
		},2800);
		$("#boxAlert .hrefCamp h2").text("URL agregada");
		$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxAlert .hrefCamp p.messageAlert").text("URL agregada con éxito.");

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
		animaMune();
		animaMano();
		setInterval(function(){
			animaMune();
			animaMano();
		},2800);
		$("#boxAlert .hrefCamp h2").text("Influenciador Cotizado");
		$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxAlert .hrefCamp p.messageAlert").text("Pronto nos contactaremos para entregarle más información del influenciador");

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
		animaMune();
		animaMano();
		setInterval(function(){
			animaMune();
			animaMano();
		},2800);
		$("#boxAlert .hrefCamp h2").text("Error al cotizar Influenciador");
		$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxAlert .hrefCamp p.messageAlert").text("Al parecer la campaña y/o influenciador indicada(s) no existe");

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
		$("#boxElim .hrefCamp h2").text("URL no aceptada");
		$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxElim .hrefCamp p").text("La URL no corresponde al perfil registrado en Power Influencer("+descripcion_rrss+")");
		$(".siElim").text("Ir a Escritorio");
		$(".noElim").text("Continuar en campañas");

		$("#boxElim").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			//window.location.assign("http://desarrollo.adnativo.com/pi/app/dashboard-ipe.php");
			//window.location.reload();
		});

		$(".noElim").on("click",function(){
			$("#boxElim").animate({
				top:"-100px",
				opacity:0
			},{duration:500,easing:"easeInOutQuint",complete:function(){
				$(".alertElim").fadeOut("fast");
				$(this).hide();
				//window.location.href = "http://desarrollo.adnativo.com/pi/app/campanas-ipe.php";
				
			}});
		});
	});
}

function url_error(descripcion_rrss){
	$(".alertElim").fadeIn("normal",function(){
		$("#boxElim .hrefCamp h2").text("URL no aceptada");
		$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxElim .hrefCamp p").text("La URL ya se encuentra registrada en Power Influencer ("+descripcion_rrss+")");
		$(".siElim").text("Ir a Escritorio");
		$(".noElim").text("Continuar en campañas");

		$("#boxElim").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			//window.location.assign("http://desarrollo.adnativo.com/pi/app/dashboard-ipe.php");
			//window.location.reload();
		});

		$(".noElim").on("click",function(){
			$("#boxElim").animate({
				top:"-100px",
				opacity:0
			},{duration:500,easing:"easeInOutQuint",complete:function(){
				$(".alertElim").fadeOut("fast");
				$(this).hide();
				//window.location.href = "http://desarrollo.adnativo.com/pi/app/campanas-ipe.php";
				
			}});
		});
	});
}

function url_existe(){
	$(".alertElim").fadeIn("normal",function(){
		$("#boxElim .hrefCamp h2").text("URL ya ingresada");
		$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
		$("#boxElim .hrefCamp p").text("La URL ya fue registrada en Power Influencer");
		$(".siElim").text("Ir a Escritorio");
		$(".noElim").text("Continuar en campañas");

		$("#boxElim").show().animate({
			top:"20%",
			opacity:1
		},{duration:1500,easing:"easeOutBounce"});

		$(".siElim").on("click",function(){
			//window.location.assign("http://desarrollo.adnativo.com/pi/app/dashboard-ipe.php");
			//window.location.reload();
		});

		$(".noElim").on("click",function(){
			$("#boxElim").animate({
				top:"-100px",
				opacity:0
			},{duration:500,easing:"easeInOutQuint",complete:function(){
				$(".alertElim").fadeOut("fast");
				$(this).hide();
				//window.location.href = "http://desarrollo.adnativo.com/pi/app/campanas-ipe.php";
				
			}});
		});
	});
}

function error_numero_telefonico(){
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
function formulario_agencia_completo(){
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
									window.location.href = "logout";
								}});
							});
					});
}
function inscripcion_influenciador(data){
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
												window.location.href = "logout";
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
function termina_formulario(data){
	switch (data){
				case "actualizado": alert('registro ingresado, nos contactaremos con usted');
					                window.location.href='logout';
				break;
				case "false": alert('ingrese todos los datos');
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
