$(document).ready(function(){

	$("#iniciar_sesion").click(function(){
		var user = $("#admin_user").val();
		var pass = $("#admin_pass").val();

		$.ajax({
			type: "POST",
			url: "app_admin/http/controllers/login.php",
			data: "user="+user+"&pass="+pass,
			success: function(data){
				switch (data){
					case "ok": window.location.href = "dashboard-admin.php";
					break;
					case "false": window.location.href = "./";
					break;
				}
			}
		});
	})

	$(".activar_cuenta").click(function(){
		var id = $(this).attr("id");
		var tipo ="activar";
		$.ajax({
			type: "POST",
			url: "app_admin/http/controllers/usuarios.php",
			data: "id="+id+"&tipo="+tipo,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$(".editar").click(function(){
		if($(this).attr("id")){var id = $(this).attr("id");}
		if($(".nombre-"+id).val()){var nombre= $(".nombre-"+id).val();}
		//if($(".correo-"+id).val()){var correo= $(".correo-"+id).val();}
		if($(".descripcion-"+id).val()){var descripcion= $(".descripcion-"+id).val();}
		if($(".region-"+id).val()){var region= $(".region-"+id).val();}
		if($(".comuna-"+id).val()){var comuna= $(".comuna-"+id).val();}
		if($(".telefono1-"+id).val()){var telefono1=$(".telefono1-"+id).val();}
		if($(".telefono2-"+id).val()){var telefono2=$(".telefono2-"+id).val();}
		if($(".fecha-ingreso-"+id).val()){var fecha_ingreso=$(".fecha-ingreso-"+id).val();}
		if($(".url-"+id).val()){var url_=$(".url-"+id).val();}
		if($(".estado-"+id).val()){var estado=$(".estado-"+id).val();}
		//alert("id="+id+"&tipo="+tipo+"&nombre="+nombre+"&correo="+correo+"&descripcion="+descripcion+"&region="+region+"&comuna="+comuna+"&estado="+estado+"&telefono1="+telefono1+"&telefono2="+telefono2+"&url="+url_+"&fecha_ingreso="+fecha_ingreso);
		var tipo ="editar";
		$.ajax({
			type: "POST",
			url: "app_admin/http/controllers/usuarios.php",
			//data: "id="+id+"&tipo="+tipo+"&nombre="+nombre+"&correo="+correo+"&descripcion="+descripcion+"&region="+region+"&comuna="+comuna+"&estado="+estado+"&telefono1="+telefono1+"&telefono2="+telefono2+"&url="+url_+"&fecha_ingreso="+fecha_ingreso,
			data: "id="+id+"&tipo="+tipo+"&nombre="+nombre+"&descripcion="+descripcion+"&region="+region+"&comuna="+comuna+"&estado="+estado+"&telefono1="+telefono1+"&telefono2="+telefono2+"&url="+url_+"&fecha_ingreso="+fecha_ingreso,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$(".ver_campanas").click(function(){
		var id = $(this).attr("name");
		window.location.href="campanas-agencias-admin.php?id="+id;
	})

	$(".ver_redes").click(function(){
		var id = $(this).attr("name");
		window.location.href="redes-sociales.php/?id="+id;
	})

		$(".habilitar").click(function(){
		var id = $(this).attr("id");
		var tipo ="habilitar";
		$.ajax({
			type: "POST",
			url: "../app_admin/http/controllers/usuarios.php",
			data: "id="+id+"&tipo="+tipo,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$(".deshabilitar").click(function(){
		var id = $(this).attr("id");
		var tipo ="deshabilitar";
		$.ajax({
			type: "POST",
			url: "../../../app_admin/http/controllers/usuarios.php",
			data: "id="+id+"&tipo="+tipo,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$("#btn_mensaje_agencias").click(function(){
		var tipo ="mensaje";
		var descripcion_tipo = $(this).attr("class");
		var mensaje = $('#nuevo_mensaje_agencias #mensaje_agencias').val();
		var correo = $('#correo_mensaje_agencia option:selected').val();
		$.ajax({
			type: "POST",
			url: "app_admin/http/controllers/usuarios.php",
			data: "correo="+correo+"&descripcion_tipo="+descripcion_tipo+"&tipo="+tipo+"&mensaje="+mensaje,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$("#btn_mensaje_influenciadores").click(function(){
		
		var tipo ="mensaje";
		var descripcion_tipo = $(this).attr("class");
		var mensaje = $('#nuevo_mensaje_influenciadores #mensaje_influenciadores').val();
		var correo = $('#correo_mensaje_influenciador option:selected').val();
		$.ajax({
			type: "POST",
			url: "app_admin/http/controllers/usuarios.php",
			data: "correo="+correo+"&descripcion_tipo="+descripcion_tipo+"&tipo="+tipo+"&mensaje="+mensaje,
			success: function(data){
				window.location.reload();
			}
		});
	})

	$('#tipo_mensaje_agencia').change(function(){
			if($('#tipo_mensaje_agencia option:selected').val()==0){
				$('#correo_mensaje_agencia').hide();
				
			}else{
				$('#correo_mensaje_agencia').show();
			}
		});

	$('#tipo_mensaje_influenciador').change(function(){
			if($('#tipo_mensaje_influenciador option:selected').val()==0){
				$('#correo_mensaje_influenciador').hide();
				
			}else{
				$('#correo_mensaje_influenciador').show();
			}
		});






})