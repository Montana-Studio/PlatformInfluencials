<?php 
require('../controller/conexion.php');

if (isset($_POST['tipo'])){
	$username =$_POST['nombre'];
	$correo =$_POST['correo'];
	$tel1 =$_POST['tel1'];
	$tel2 =$_POST['tel2'];
	$empresa=$_POST['empresa'];
	$tipo = (int)$_POST['tipo'];
	//$password=MD5($_POST['pwd']);
	$results = $mysqli->query('UPDATE persona SET telefono1="'.$tel1.'", telefono2="'.$tel2.'", empresa="'.$empresa.'", id_tipo="'.$tipo.'", descripcion_tipo= "agencia", estado_formulario=1 WHERE correo="'.$correo.'"');
}else{
	$username =$_POST['nombre'];
	$correo =$_POST['correo'];
	$tel1 =$_POST['tel1'];
	$tel2 =$_POST['tel2'];
	$empresa=$_POST['empresa'];
	//echo $correo.$username.$tel1.$tel2.$empresa;
	//$password=MD5($_POST['pwd']);
	$results = $mysqli->query('UPDATE persona SET nombre="'.$username.'", telefono1="'.$tel1.'", telefono2="'.$tel2.'", empresa="'.$empresa.'", descripcion_tipo= "agencia" , estado_formulario=1 WHERE  correo="'.$correo.'"');
	$results2 = $mysqli->query('UPDATE login SET user="'.$username.'"');
}

unset($username);
unset($correo);
unset($tel1);
unset($tel2);
unset($empresa);
unset($results);
unset($results2);
unset($mysqli);
?>