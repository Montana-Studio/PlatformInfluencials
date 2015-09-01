<?php
 require('conexion.php');
if(isset($_SESSION['faceuser'])==false ){
echo "problema de sesion";
}
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/facebook-login.js"></script>
	<script>
	$(document).ready(function(){

			var $envnom=0;
			var nombre;
			var correo;
			var telefono1;
			var telefono2;	
			
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
			
			$('#tel1'). click(function(){
				$('#tel1 input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				
				if ($envnom == 1){
					$('#tel1 input').keypress(function (e) {
						if (e.which == 13) {
							$('#tel1 input')	.attr('disabled','disabled')
												.css({'background-image':'none','background-color':'transparent'});
							$envnom=0;
						}
					});
				}
			});
			
			$('#tel2'). click(function(){
				$('#tel2 input')	.removeAttr('disabled','disabled')
									.css({'background-image':'none','background-color':'#ccc'})
									.attr('placeholder','por favor escriba');
				$envnom=1;
				if ($envnom == 1){
					$('#tel2 input').keypress(function (e) {
						if (e.which == 13) {
							$('#tel2 input')	.attr('disabled','disabled')
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
				telefono1=$('#tel1 input').val();
				telefono2=$('#tel2 input').val();
				console.log(nombre,correo,telefono1,telefono2);
				$.ajax({  
					type: "POST",  
					url: "procesar_formulario.php",  
					data: "nombre="+nombre+"&empresa="+empresa+"&correo="+correo+"&tel1="+telefono1+"&tel2="+telefono2, 
					
					success: function(html){ 
						alert("Registro de datos completo");
						window.location.href= "registro.php";
						}
				});
			});
			
			function valida(e){
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla==8){
					return true;
				};
				// Patron de entrada, en este caso solo acepta numeros
				patron =/[0-9]/;
				tecla_final = String.fromCharCode(tecla);
				return patron.test(tecla_final);
			};
			
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
	});
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
		<div style="text-align:right;"><a href>ayuda</a></div>
			<h2>formulario de ingreso</h2>
			<div id="inicio" disabled>
			<div id="nombre">
				<input  value="<?php echo $_SESSION['faceuser'];?>" disabled required>
			</div>
			<div id="empresa">
				<input placeholder="Empresa a la que pertenece" disabled required>
			</div>
			</div>
			<div id="facturacion">
				<h2>datos de facturación</h2>
				<div id="correo">
					<input value="<?php echo $_SESSION['facecorreo'];?>" disabled required>
				</div>
				<div id="tel1">
					<input placeholder="telefono 1" type="text"  onkeypress="return valida(event)" disabled required>
				</div>
				<div id="tel2">
					<input placeholder="telefono 2" type="text"  onkeypress="return valida(event)" disabled required>
				</div>
			<button id="guardar">guardar</button>
		</div>
	</body>
</html>