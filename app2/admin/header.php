<?php
function muestra_header(){
		echo '<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<!--script type="text/javascript" src="resources/js/jquery.min.js"></script-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
			<script id="formulario" type="text/javascript" src="resources/js/formularios.js"></script>   
		</head>
		<body>
		<a href="javascript:history.back()">Volver</a>
		<a href="app_admin/http/controllers/logout.php">logout</a>';
    }
function muestra_header_subdominio(){
		echo '<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<script type="text/javascript" src="app_admin/resources/js/jquery.min.js"></script>
			<script type="text/javascript" src="app_admin/resources/js/formularios.js"></script>   
		</head>
		<body>
		<a href="javascript:history.back()">Volver</a>
		<a href="app_admin/http/controllers/logout.php">logout</a>';

    }


if(basename($_SERVER['PHP_SELF'])=='index.php'){
	muestra_header();
}
if(basename($_SERVER['PHP_SELF'])=='dashboard-admin.php'){
	muestra_header();
	echo $_SESSION['user'];
}
if(basename($_SERVER['PHP_SELF'])=='agencias.php'){
	muestra_header();
}
if(basename($_SERVER['PHP_SELF'])=='influenciadores.php'){
	muestra_header();
}
if(basename($_SERVER['PHP_SELF'])=='redes-sociales.php'){
	muestra_header_subdominio();
}
if(basename($_SERVER['PHP_SELF'])=='campanas-agencias-admin.php'){
	//muestra_header_subdominio();
}				
/*
if(basename($_SERVER['PHP_SELF'])=='dashboard-admin.php'){
	muestra_header();
	echo "<h1>Bienvenido $_SESSION['user']</h1>";
}*/

?>