<?php
session_start();
?>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
<div style="text-align:right;"><a href>ayuda</a></div>
<h2>formulario de ingreso</h2>
<br/>

<div id="inicio" disabled>
<table>
<tr>
<td id="nombre"><input  placeholder="nombre" value="<?php echo $_SESSION['nombre'];?>" disabled required/></td>

</tr>

<tr>
<td id="empresa"><input placeholder="empresa a la que pertenece" disabled required/></td>
</tr>

</table>
</div>

<br/>
<br/>

<div id="facturacion">
<table>
<p> Datos de facturación </p>
<tr><td id="correo"><input placeholder="correo" value="<?php echo $_SESSION['emailAddress'];?>"  disabled required/></td></tr>
<tr><td id="tel1"><input placeholder="telefono1" size="11" maxlength="11" disabled required/></td></tr>
<tr><td id="tel2"><input placeholder="telefono2" size="11" maxlength="11" disabled required/></td></tr>
</table>
<button id="guardar">guardar</button>
</div>


<br/>
<br/>

</body>
</html>