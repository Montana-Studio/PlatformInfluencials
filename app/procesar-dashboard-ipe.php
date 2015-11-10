<?php
require('conexion.php');

	$correo =$_POST['correo'];
	$empresa= $_POST['empresa'];
	$rsid= $_POST['rsid'];
	$tel1 =$_POST['tel1'];
	$tel2 =$_POST['tel2'];
	$nombre =$_POST['nombre'];
	$descripcion =$_POST['descripcion'];
	//Consulto si existe el Base de Datos
	$r1= $mysqli->query("SELECT DISTINCT p.correo FROM persona AS p, login AS l WHERE p.correo='$correo'");
	$num_row= mysqli_num_rows($r1);

	$r2= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND RS_id='$rsid'");
	$num_row2=mysqli_num_rows($r2);

	if($num_row2>0){
		$results = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo' , descripcion='$descripcion' WHERE RS_id='$rsid'");
		$_SESSION['nombre']= $nombre;
		$_SESSION['empresa']=$empresa;
		$_SESSION['correo']=$correo;
		$_SESSION['telefono1']=$tel1;
		$_SESSION['telefono2']=$tel2;
		$_SESSION['descripcion']=$descripcion;
		echo 'actualiza';
	}
	else{
		$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' , descripcion='$descripcion' WHERE correo='$correo'");
		$results2 = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");
		$_SESSION['nombre']= $nombre;
		$_SESSION['empresa']=$empresa;
		$_SESSION['correo']=$correo;
		$_SESSION['telefono1']=$tel1;
		$_SESSION['telefono2']=$tel2;
		$_SESSION['descripcion']=$descripcion;
		echo 'actualiza'; 
	}

?>