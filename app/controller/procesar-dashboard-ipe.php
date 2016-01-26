<?php
require('../controller/conexion.php');

	$correo =$_POST['correo'];
	$nombre =$_POST['nombre'];
	$comuna= $_POST['comuna'];
	$region=$_POST['region'];
	$descripcion= $_POST['descripcion'];
	$r1= $mysqli->query("SELECT DISTINCT p.correo FROM persona AS p, login AS l WHERE p.correo='$correo'");
	$num_row= mysqli_num_rows($r1);

	$r2= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND RS_id='$rsid'");
	$num_row2=mysqli_num_rows($r2);

	if($num_row2>0){
		$results = $mysqli->query("UPDATE persona SET nombre='$nombre', comuna='$comuna', region='$region' , descripcion='$descripcion' WHERE RS_id='$rsid'");
		$_SESSION['nombre']= $nombre;
		$_SESSION['correo']=$correo;
		$_SESSION['descripcion']=$descripcion;
		echo 'actualiza';
	}
	else{
		$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', comuna='$comuna', region='$region' , descripcion='$descripcion' WHERE correo='$correo'");
		$results2 = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");
		$_SESSION['nombre']= $nombre;a;
		$_SESSION['correo']=$correo;
		$_SESSION['descripcion']=$descripcion;
		$_SESSION['comuna']=$comuna;
		$_SESSION['region']=$region;
		echo 'actualiza'; 
	}

?>