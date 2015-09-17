<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
header('Location:registro.php');
die();
}
?>
<html>
<head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title>formulario de registro</title>
	<script>
		$(document).ready(function(){
			var $envnom=0;
			var nombre;
			var correo;
			var telefono1;
			var telefono2;
			$("#telefono1nuevo").keyup(phone1Length);
			$("#telefono2nuevo").keyup(phone2Length);
			$('#nombre'). click(function(){
				$('#nombre input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				if ($envnom == 1){ 	
					$('#nombre input').keypress(function (e) {
						if (e.which == 13) {
							$('#nombre input')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
					});
				}
			});
			
			$('#empresa'). click(function(){
				$('#empresa input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');;
				$envnom=1;
				if ($envnom == 1){
					$('#empresa input').keypress(function (e) {
						if (e.which == 13) {
							$('#empresa input')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
						});
					}
			});
			
			$('#correo'). click(function(){
				$('#correo input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				
				if ($envnom == 1){
					$('#correo input').keypress(function (e) {
						if (e.which == 13) {
							$('#correo input')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
						});
				}
			});
			
			$('#telefono1nuevo'). click(function(){
				$('#telefono1nuevo')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				
				if ($envnom == 1){
					$('#telefono1nuevo').keypress(function (e) {
						if (e.which == 13) {
							$('#telefono1nuevo')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
						});
				}
			});
			
			$('#telefono2nuevo'). click(function(){
				$('#tel2 input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				
				if ($envnom == 1){
					$('#telefono2nuevo').keypress(function (e) {
						if (e.which == 13) {
							$('#telefono2nuevo')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
					});
				}
			});
			
			$('#guardar').click(function(){

				nombre=$('#nombre input').val();
				empresa=$('#empresa input').val();
				correo=$('#correo input').val();
				telefono1=$('#telefono1nuevo').val();
				telefono2=$('#telefono2nuevo').val();
				
				
					 $.ajax({  
						type: "POST",  
						url: "procesar_formulario.php",  
						data: "nombre="+nombre+"&empresa="+empresa+"&correo="+correo+"&tel1="+telefono1+"&tel2="+telefono2, 
						
						success: function(html){ 
							alert("Registro de datos completo, nos contactaremos con usted");
							window.location.href= "registro.php";
							}
					});
				
				
			});	
			
		});
		function phone1Length(){
			var tel1 = $('#telefono1nuevo').val();
			var tel2 = $('#telefono2nuevo').val();
			if (tel1.length > 7 && tel2.length > 7)
				$('#guardar').removeAttr('disabled');
		}
		function phone2Length(){
			var tel1 = $('#telefono1nuevo').val();
			var tel2 = $('#telefono2nuevo').val();
			if (tel1.length > 7 && tel2.length > 7)
				$('#guardar').removeAttr('disabled');
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
	</script>

	<style>
	input{
	width: 250px;
	border:none;
	background-color:#fff;
	color:#000;
	cursor:pointer;
	}
	</style>
</head>
<body>
	<div style="text-align:right;">
		<a href>ayuda</a>
	</div>
	<h2>formulario de ingreso</h2>
	<div id="inicio" disabled>
		<div id="nombre">
			<input  placeholder="nombre" value="<?php echo $_SESSION['nombre'];?>" disabled required>
		</div>
		<div id="empresa">
			<input placeholder="empresa a la que pertenece" disabled required>
		</div>
	</div>
	<div id="facturacion">
		<h2>datos de facturación</h2>
		<div id="correo">
			<input placeholder="correo" value="<?php echo $_SESSION['emailAddress'];?>"  disabled required>
		<div>
		<div>
			<input placeholder="telefono1" onkeypress="return valida(event)" name='telefono1-nuevo' id="telefono1nuevo" maxlength="11" required>
		</div>
		<div>
			<input placeholder="telefono2" onkeypress="return valida(event)" name='telefono2-nuevo' id="telefono2nuevo" maxlength="11" required>
		<div>
		<div>
			<input vaue="<?php echo $_SESSION['conn'];?>">
		<div>

		<button id="guardar" disabled>guardar</button>
	</div>
</body>
</html>