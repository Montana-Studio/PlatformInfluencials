<?php
require('./conexion.php');

if($_POST['tipo']=='activar'){
	$id=$_POST['id'];

	$result_activa_usuario = $mysqli->query("UPDATE persona SET id_estado='1' WHERE id='".$id."'");
	$num_row_activa_usuario= mysqli_num_rows($result_activa_usuario);
	$row_activa_usuario= mysqli_fetch_array($result_activa_usuario, MYSQLI_BOTH);
	$id=$row_activa_usuario[0];
	

	function unsetVariables(){
		unset($id);
		unset($result_activa_usuario);
		unset($num_row_activa_usuario);
		unset($row_activa_usuario);
	}
	unsetVariables();
}

if($_POST['tipo']=='editar'){
	if($_POST['id']){
		$id=$_POST['id'];
	}else{
		$id='';

	}

	if($_POST['descripcion']){
		$descripcion=$_POST['descripcion'];
	}else{
		$descripcion='';

	}
	if($_POST['region']){
		$region=$_POST['region'];
	}else{
		$region='';

	}
	if($_POST['comuna']){
		$comuna=$_POST['comuna'];
	}else{
		$comuna='';

	}
	if($_POST['estado']){
		$estado=$_POST['estado'];
	}else{
		$estado='';

	}


	if($_POST['telefono1']){
		$telefono1=$_POST['telefono1'];
	}else{
		$telefono1='';

	}
	if($_POST['telefono2']){
		$telefono2=$_POST['telefono2'];
	}else{
		$telefono2='';

	}
	if($_POST['url']){
		$url=$_POST['url'];
	}else{
		$url='';

	}
	if($_POST['fecha_ingreso']){
		$fecha_ingreso=$_POST['fecha_ingreso'];
	}else{
		$fecha_ingreso='';

	}

	if($_POST['nombre']){
		$nombre=$_POST['nombre'];
	}else{
		$nombre='';

	}

	if($_POST['region']){
		$region=$_POST['region'];
	}else{
		$region='';

	}

	if($_POST['comuna']){
		$comuna=$_POST['comuna'];
	}else{
		$comuna='';

	}

	if($_POST['correo']){
		$correo=$_POST['correo'];
	}else{
		$correo='';

	}

	if($_POST['empresa']){
		$empresa=$_POST['empresa'];
	}else{
		$empresa='';

	}


	$result_actualiza_usuario = $mysqli->query("UPDATE persona SET id_estado='".$estado."', nombre='".$nombre."',descripcion='".$descripcion."', telefono1='".$telefono1."',telefono2='".$telefono2."', fecha_ingreso='".$fecha_ingreso."',region='".$region."', comuna='".$comuna."' , empresa='".$empresa."' WHERE id='".$id."'");
	

	function unsetVariables(){
		unset($id);
		unset($result_activa_usuario);
		unset($num_row_activa_usuario);
		unset($row_activa_usuario);
	}
	unsetVariables();
}


if($_POST['tipo']=='habilitar'){
	$id=$_POST['id'];
	$result_habilita_red_social = $mysqli->query("UPDATE rrss SET cuenta='1' WHERE id='".$id."'");
	echo "UPDATE rrss SET cuenta='1' WHERE id='".$id."'";
	function unsetVariables(){
		unset($id);
		unset($result_habilita_red_social);
	}
	unsetVariables();
}

if($_POST['tipo']=='deshabilitar'){
	$id=$_POST['id'];
	$result_deshabilita_red_social = $mysqli->query("UPDATE rrss SET cuenta='0' WHERE id='".$id."'");	
	function unsetVariables(){
		unset($id);
		unset($result_deshabilita_red_social);
	}
	unsetVariables();
}

if($_POST['tipo']=='mensaje'){
	if($_POST['correo']=='0'){
		$descripcion_tipo=$_POST['descripcion_tipo'];
 		$mensaje = $_POST['mensaje'];
 		$admin = $_SESSION['user_admin'];
 		$result_mensaje=$mysqli->query('INSERT INTO mensajes SET descripcion_tipo="'.$descripcion_tipo.'", mensaje="'.$mensaje.'", admin="'.$admin.'"');
	}else{
		$descripcion_tipo=$_POST['descripcion_tipo'];
 		$mensaje = $_POST['mensaje'];
 		$correo = $_POST['correo'];
 		$admin = $_SESSION['user_admin'];
 		$result_mensaje=$mysqli->query('INSERT INTO mensajes SET descripcion_tipo="'.$descripcion_tipo.'", correo="'.$correo.'", mensaje="'.$mensaje.'", fecha="'.date("Y/m/d").'", admin="'.$admin.'"');
	}
 	
}

if($_POST['tipo']=='mensaje_personal'){
 	$id=$_POST['id'];
 	$tipo_persona= $_POST['tipo_persona'];
 	$result_mensaje_personal=$mysqli->query('SELECT mensaje FROM mensajes WHERE id_persona="'.$id.'"');
 	$row_mensaje_personal= mysqli_fetch_array($result_mensaje_personal, MYSQLI_BOTH);
 	if($row_mensaje_personal){
 		echo 	"hola";
 	}else{
 		echo 	"no hola";
 	}
}






	

?>