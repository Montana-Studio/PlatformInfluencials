<?php
session_start();
//Conexi�n a base de datos
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
			var correo,nombre,correo,tel1,tel2,empresa;
			var rsid = $('#RsId').val();
		
		$('#guardarFacturacion').click(function () {
			
			nombre=$('#nombre input').val();
			correo=$('#correo input').val();
			tel1=$('#tel1 input').val();
			tel2=$('#tel2 input').val();
			empresa=$('#empresa input').val();
			//console.log(nombre,correo,empresa,tel1,tel2,rsid);
			$.ajax({  
            type: "POST",  
            url: "procesar-dashboard-agencia.php",  
            data: "nombre="+nombre+"&correo="+correo+"&tel1="+tel1+"&tel2="+tel2+"&empresa="+empresa+"&rsid="+rsid, 
			
			
            success: function(html){ 
				switch (html){
				case 'existe' :	$('#correo input').addClass('alert').val('el correo ya existe en la base de datos');
				break;
				case 'actualiza' : console.log('datos actualizados');
				break;
			
				
				}}
			});
		});
		
		$('#imagenform').on('submit',(function (e){
		e.preventDefault();
		info = new FormData(this);
		info.append('correo',$('#correo input').val());
		info.append('rsid',$('#RsId').val());

		
			$.ajax({
					type: "POST",  
					url: "procesar_imagen.php",  
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,      
					cache: false,             
					processData:false, 
				
				success: function(data){ 
					
					console.log(data);
						
				}
			
			});
		
		
		
		}));
		//campa�as creadas 
		$('#editaCampa�a').hide();
		$('#creadas #guardar').hide();
		//editar
		$('#creadas #editar').click (function (){
		$('#editaCampa�a').show();
		$('#creadas #guardar').show();
		$('#creadas #editar').hide();
		});
		//guardar cambios
		$('#creadas #guardar').click (function (){
		$('#editaCampa�a').hide();
		$('#creadas #guardar').hide();
		$('#creadas #editar').show();
		});
		$('#guardar').hide();
		$('#editar').show();
	
		});

</script>
<!--<script src="js/facebook-login.js"></script>-->
<title>dashboard - <?php echo $_SESSION['nombre']; ?></title>
<style>

input{
border:none;
background-color:#fff;
color:#000;
cursor:pointer;
font-family: 'Impact',Courier,Sans-Serif;
}
.alert{
	color:red;
	background-color:rose;
	border:1px solid red;
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
<td id="nombre"><input  value="<?php echo $_SESSION['nombre']; ?>"/></td>
<td rowspan="2"><img src="<?php echo $_SESSION['pictureUrl'];?>" width="100" height=auto>
<input id="RsId" style="display:none" value="<?php echo $_SESSION['RSid']; ?>"  />
</tr>

<tr>
<td id="empresa"><input value="<?php echo $_SESSION['empresa']; ?>" /></td>
</tr>

<tr>
<td>

</td>
</tr>
</table>
</div>
<form id='imagenform'>
<input type="file" name="file" id="file" required /></br>
<button type="submit" id='cambiarImagen' >cambiar imagen</button>
</form>


<br/>
<br/>

<div id="facturacion">
<table>
<p> Datos de facturaci�n </p>
<tr><td id="correo"><input value="<?php echo $_SESSION['correo']; ?>"/></td></tr>
<tr><td id="tel1"><input type="text" pattern="[0-9]{10}"  size="11" maxlength="11" value="<?php echo $_SESSION['telefono1']; ?>"/></td></tr>
<tr><td id="tel2"><input  type="text" pattern="[0-9]{10}" size="11" maxlength="11" value="<?php echo $_SESSION['telefono2']; ?>"/></td></tr>
<tr><td><button id="guardarFacturacion" type="submit">Guardar</button></tr></td>
</div>
</table>

<br/>
<br/>

<a href="campana.php">ir a campa�as</a><p>
<div id="creadas">

�tlimas campa�as creadas <p>
<?php do{

echo $row[1];


?>

<button id="guardar">guardar</button><button id="editar">editar</button> / <button>borrar</button> / <button>pausar</button>
<br/>
<?php 

}while($row = mysqli_fetch_row($result))

?>
<div id="editaCampa�a">
<input placeholder="nombre campa�a"></input><p>
<input placeholder="marca"></input><p>
<textarea placeholder="descripcion" rows=10 cols=40 ></textarea><p>
<button>Cambiar imagen</button>
</div>
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