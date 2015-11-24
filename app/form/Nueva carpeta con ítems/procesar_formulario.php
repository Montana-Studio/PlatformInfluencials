<?php
	$action=$_REQUEST['action'];
	if($action!=''){
		$nombre=$_REQUEST['nombre'];
		$apellido=$_REQUEST['apellido'];
		$descripcion=$_REQUEST['descripcion'];
		$sexo=$_POST['sexo'];
		$tipo=$_POST['tipo'];
		$asunto='Power Influencer Newsletter';
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
	}
?>