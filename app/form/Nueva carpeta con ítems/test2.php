<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
</head>
<body>
<script>
$(document).ready(function(){
	$('#contacto').on('submit', function(){
		.ajax({
			type: 'POST',
			url: 'procesar_formulario.php',
			success: function(info){
			$('#respuesta').html('respuesta');
			}
		});
	})
})
</script>
<form id='contacto' method='post' enctype='multipart/form-data' class='contactform'>
	<div>
		<select>
			<label for='Agencia'>Agencia</label><option id='Agencia' name='Agencia' >Agencia</option>
			<label for='Influenciador'>Influenciador</label><option id='Influenciador' name='Influenciador' >Influenciador</option>
		</select>
	</div>
	<div>
		<select>
			<label for='Hombre'>Hombre</label><option id='Hombre' name='Hombre' >Hombre</option>
			<label for='Mujer'>Mujer</label><option id='Mujer' name='Mujer' >Mujer</option>
		</select>
	</div>
	<input type='submit' value='Send email'/>
</form>
<?php //El siguiente script debe ir en un archivo llamado procesar_formulario.php

		$asunto='nibaldo@perot.cl';
		if(($nombre=='')||($correo=='')){
			echo 'Recuerde ingresar todos los parametros del correo';
		}else{
			 /*
			Para dar formato al mensaje del correo, ingresar de la siguiente manera: 
			 1.- Determinar el orden de las variables
			 2.- Agregar variables ordenadamente acumulando en variable mensaje, para acumular se debe indicar un punto(.) antes de la igualdad con la variable
			 3.- Para aregar escritura entre variables, igualmente se debe indicar un punto(.) despues de la variable
			 Ejemplo:
			 Si se tiene la variable nombre y se agrega la de apellido, el mensaje del correo podría ser:
			 $mensaje.=$nombre.' '.$apellido.' quiere comunicarse con Power Influencer';
			*/
			mail('<reemplazar_por_correo_que_recibe>',$asunto, $mensaje,null,'-f'.$correo.'');
			echo '<div><p>Correo enviado con éxito</p></div>';
		}
	
?>
<div id='respuesta'></div>
</body>
</html>