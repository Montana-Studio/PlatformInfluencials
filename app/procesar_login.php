<?php 
require('conexion.php');
/*
	$username =$_POST['name'];
	//$password =$_POST['pwd'];*/
	$correo = $_POST['correo'];
	$password=MD5($_POST['pwd']);

	if(strlen($correo) == 0 || strlen($password) == 0){
		$resultado = "vacio";
		echo $resultado;
	}

if ($resultado != "vacio"){
		//Consulto si existe el Base de Datos
	$query="SELECT * FROM login WHERE correo='$correo' AND pass='$password'";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$num_row= mysqli_num_rows($result);//si es mayor que uno es porque hay registros

	//Consulto si es que el estado del registro es activo
	$query2="SELECT * FROM persona AS p, login AS l WHERE p.id_estado>0 AND
								( l.correo=p.correo AND p.id = (SELECT p.id FROM login AS l, persona AS p 
								WHERE p.correo='$correo' AND l.correo='$correo'))";
	$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
	$num_row2= mysqli_num_rows($result2);//si es mayor que uno es porque hay registros
	$row2= mysqli_fetch_array($result2, MYSQLI_NUM);

	if($num_row<1){
		echo 'false';
	}else if($num_row>=1&&$num_row2<1){
		echo 'inactivo';//el ingreso corresponde a un archivo de la base de datos pero no se ecnuentra activo
	}else{

	//Rescato datos de persona
	$_SESSION['id']=$row2[0];
	$_SESSION['nombre']=$row2[4];
	$_SESSION['correo']=$row2[5];
	$_SESSION['telefono1']=$row2[6];
	$_SESSION['telefono2']=$row2[7];
	$_SESSION['empresa']=$row2[12];
	$_SESSION['pictureUrl']=$row2[11];
	$_SESSION['rsid']=$row2[9];
	$_SESSION['id_estado']= $row[2];
	$_SESSION['id_tipo']= $row[1];
		switch($row2[1]){
		case '1':
			echo 'admin';
		break;
		case '2':
			echo 'agencia';
		break;
		case '3':
			echo 'ipe';
		break;
		case '4':
			echo 'ipe';
		break;
		case '5':
			echo 'ipe';
		break;

		}
	}




}


?>