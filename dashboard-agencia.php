<?php
session_start();
//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","","plataforma") or die("Error " . mysqli_error($link)); 

if(isset($_SESSION['id'])==false){

}else{
//$nombre = mysql_query("SELECT * FROM usuarios WHERE id_usu = '".$_SESSION['id_usu']."'");
$query="SELECT * FROM campana AS c WHERE c.idpersona=".$_SESSION['id']."";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);


}
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){

		//variables globales
		var $envnom=0;
		
		$('#nombre'). click(function(){
		$('#nombre input')	.removeAttr('disabled','disabled')
							.css({'background-image':'none','background-color':'#ccc'})
		//					.attr('placeholder','por favor escriba');
		$envnom=1;
		if ($envnom == 1){ 	
		$('#nombre input').keypress(function (e) {
			if (e.which == 13) {
				$('#nombre input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
		});
		}
		});
		

		$('#empresa'). click(function(){
		$('#empresa input')	.removeAttr('disabled','disabled')
							.css({'background-image':'none','background-color':'#ccc'})
							//.attr('placeholder','por favor escriba');;
		//Proceso para enviar con enter
		$envnom=1;
		if ($envnom == 1){
		$('#empresa input').keypress(function (e) {
			if (e.which == 13) {
				$('#empresa input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
			});
			}
		});
		
		$('#correo'). click(function(){
		$('#correo input')	.removeAttr('disabled','disabled')
							.css({'background-image':'none','background-color':'#ccc'})
							//.attr('placeholder','por favor escriba');
		//Proceso para enviar con enter
		$envnom=1;
		if ($envnom == 1){
		$('#correo input').keypress(function (e) {
			if (e.which == 13) {
				$('#correo input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
			});
			}
		});
		
		$('#tel1'). click(function(){
		$('#tel1 input')	.removeAttr('disabled','disabled')
							.css({'background-image':'none','background-color':'#ccc'})
							//.attr('placeholder','por favor escriba');
		//Proceso para enviar con enter
		$envnom=1;
		if ($envnom == 1){
		$('#tel1 input').keypress(function (e) {
			if (e.which == 13) {
				$('#tel1 input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
			});
			}
		});
		
		$('#tel2'). click(function(){
		$('#tel2 input')	.removeAttr('disabled','disabled')
							.css({'background-image':'none','background-color':'#ccc'})
							//.attr('placeholder','por favor escriba');
		//Proceso para enviar con enter
		$envnom=1;
		
		if ($envnom == 1){
		$('#tel2 input').keypress(function (e) {
			if (e.which == 13) {
				$('#tel2 input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
			});
			}
		});
		
		if ($envnom == 1){
		console.log('estoy aqui');
		$('#tel2 input').keypress(function (e) {
			if (e.which == 13) {
				$('#tel2 input')	.attr('disabled','disabled')
									.css({'background-image':'none','background-color':'transparent'});
				//guardar con AJAX
				$envnom=0;
			}
			});
		}
	
		//campañas creadas 
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
		$('#editar').hide();
		
});
</script>
<!--<script src="js/facebook-login.js"></script>-->
<style>
input{
border:none;
background-color:#fff;
color:#000;
background-image:url('http://www.orlybaram.com/_ee/img/icons/edit/edit-icon.gif');
background-repeat:no-repeat;
background-position:right;
cursor:pointer;
font-family: 'Impact',Courier,Sans-Serif;
}
</style>
</head>
<body>
<div style="text-align:right;"><a href="logout.php">cerrar sesion</a> - <a href>ayuda</a></div>
<h2>dashboard</h2>
<br/>

<div id="inicio" disabled>
<table>
<tr>
<td id="nombre"><input  value="<?php echo $_SESSION['nombre']; ?>" disabled /></td>
<td><input value="imagen" disabled /></td>
</tr>

<tr>
<td id="empresa"><input value="Empresa a la que pertenece" disabled /></td>
</tr>

</table>
</div>

<br/>
<br/>

<div id="facturacion">
<table>
<p> Datos de facturación </p>
<tr><td id="correo"><input   value="<?php echo $_SESSION['correo']; ?>" disabled /></td></tr>
<tr><td id="tel1"><input   value="<?php echo $_SESSION['telefono1']; ?>" disabled /></td></tr>
<tr><td id="tel2"><input   value="<?php echo $_SESSION['telefono2']; ?>" disabled /></td></tr>
</table>
<button id="editar" >Editar</button>
<button id="guardar" type="submit">Guardar</button>
</div>


<br/>
<br/>

<a href="">Crear campaña</a><p>
<div id="creadas">

Campañas --- <p>
<?php do{

echo $row[1];


?>

<button id="guardar">guardar</button><button id="editar">editar</button> / <button>borrar</button> / <button>pausar</button>
<br/>
<?php 

}while($row = mysqli_fetch_row($result))

?>
<div id="editaCampaña">
<input placeholder="nombre campaña"></input><p>
<input placeholder="marca"></input><p>
<textarea placeholder="descripcion" rows=10 cols=40 ></textarea><p>
<button>Cambiar imagen</button>
</div>
</div>


<div id="aceptadas">
Campañas aceptadas<p>
<a href="">imagen campaña</a>
<a align="right" href="">ver usuario<a> / <a href="">aceptar<a> / <a href="">responder<a>
</div>


<br/><br/>

<div id="contacto">
Contacto<p>
<input placeholder="asunto"></input><p>
<textarea  placeholder="descripcion" rows=10 cols=40></textarea><p>
<button>Enviar</button>
</div>

</body>
</html>