<?php
session_start();
//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","","plataforma") or die("Error " . mysqli_error($link)); 

if(isset($_SESSION['faceuser'])==false ){
echo "problema de sesion";
}else{



}
?>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/facebook-login.js"></script>
<script>
$(document).ready(function(){
		
		
		//variables globales
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
		correo=$('#correo input').val();
		telefono1=$('#tel1 input').val();
		telefono2=$('#tel2 input').val();
		console.log(nombre,correo,telefono1,telefono2);
		 $.ajax({  
            type: "POST",  
            url: "procesar_formulario.php",  
            data: "nombre="+nombre+"&correo="+correo+"&tel1="+telefono1+"&tel2="+telefono2, 
			
            success: function(html){ 
				alert("Registro de datos completo");
				window.location.href= "registro.php";
				}
		});
		});
		
});
</script>

<style>
input{
width: 250px;
border:none;
background-color:#fff;
color:#000;
background-image:url('http://www.orlybaram.com/_ee/img/icons/edit/edit-icon.gif');
background-repeat:no-repeat;
background-position:right;
cursor:pointer;
}
</style>
</head>
<body>
<div style="text-align:right;"><a id="salir" href="registro.php">salir</a> - <a href>ayuda</a></div>
<h2>formulario de ingreso</h2>
<br/>

<div id="inicio" disabled>
<table>
<tr>
<td id="nombre"><input  value="<?php echo $_SESSION['faceuser'];?>" disabled /></td>
<td><input placeholder="imagen" disabled /></td>
</tr>

<tr>
<td id="empresa"><input placeholder="Empresa a la que pertenece" disabled /></td>
</tr>

</table>
</div>

<br/>
<br/>

<div id="facturacion">
<table>
<p> Datos de facturación </p>
<tr><td id="correo"><input value="<?php echo $_SESSION['facecorreo'];?>" disabled /></td></tr>
<tr><td id="tel1"><input placeholder="telefono1" disabled /></td></tr>
<tr><td id="tel2"><input placeholder="telefono2" disabled /></td></tr>
</table>
<button id="guardar">guardar</button>
</div>


<br/>
<br/>

</body>
</html>