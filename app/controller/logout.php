<?php  
session_start();  
unset($_SESSION['id']);
$_SESSION['id']=$row2[0];
	unset($_SESSION['id_tipo']);
	unset($_SESSION['nombre']);
	unset($_SESSION['correo']);
	unset($_SESSION['telefono1']);
	unset($_SESSION['telefono2']);
	unset($_SESSION['empresa']);
	unset($_SESSION['region']);
	unset($_SESSION['comuna']);
	unset($_SESSION['pictureUrl']);
	unset($_SESSION['rsid']);
	unset($_SESSION['id_estado']);
	unset($_SESSION['descripcion_tipo']);
	unset($_SESSION['descripcion']);
	unset($_SESSION['mensaje']);
	unset($_SESSION['facebook']);
	unset($_SESSION['instagram']);
	unset($_SESSION['twitter']);
	unset($_SESSION['youtube']);

session_destroy();
header('Location: ./../../'); 
?> 
