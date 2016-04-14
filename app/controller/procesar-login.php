<?php
require('../controller/conexion.php');
/*
	$username =$_POST['name'];
	//$password =$_POST['pwd'];*/
	$correo = $_POST['correo'];
	$perfil = $_POST['perfil'];
	$password=MD5($_POST['pwd']);

if(strlen($correo) == 0 || strlen($password) == 0){
	$resultado = "vacio";
	echo $resultado;
	unset($resultado);
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
	$tipo=$row2[1];
	if($tipo>'2'){
		$tipo='3';
	}
	if($perfil!=$tipo&&$tipo=='3'){
		echo 'influenciador';
	}else if($perfil!=$tipo&&$tipo=='2'){
		echo 'agencia';
	}else{
		
		$descripcion_tipo= $row2[2];
		if($row2[2]=='publicador'||$row2[2]=='editor'){
			$descripcion_tipo='influenciador';
		}
		$mensaje_query= "SELECT * FROM mensajes WHERE correo='' AND descripcion_tipo='$descripcion_tipo' ORDER BY id DESC";
		$result_mensaje= mysqli_query($mysqli,$mensaje_query)or die(mysqli_error());
		$row_mensaje= mysqli_fetch_array($result_mensaje, MYSQLI_NUM);

		$mensaje_query= "SELECT * FROM mensajes WHERE correo='$row2[6]' ORDER BY id DESC";
		$result_mensaje_personal= mysqli_query($mysqli,$mensaje_query)or die(mysqli_error());
		$row_mensaje_personal= mysqli_fetch_array($result_mensaje_personal, MYSQLI_NUM);

		if($num_row<1){
			echo 'false';
		}else if($num_row>=1&&$num_row2<1){
			echo 'inactivo';//el ingreso corresponde a un archivo de la base de datos pero no se ecnuentra activo
		}else{

			//Rescato datos de persona
			$_SESSION['id']=$row2[0];
			$_SESSION['id_tipo']= $row2[1];
			$_SESSION['nombre']=$row2[5];
			$_SESSION['correo']=$row2[6];
			$_SESSION['telefono1']=$row2[7];
			$_SESSION['telefono2']=$row2[8];
			$_SESSION['empresa']=$row2[13];
			$_SESSION['region']=$row2[15];
			$_SESSION['comuna']=$row2[16];
			$_SESSION['pictureUrl']=$row2[12];
			$_SESSION['rsid']=$row2[10];
			$_SESSION['id_estado']= $row2[3];
			$_SESSION['descripcion_tipo']= $row2[2];
			$_SESSION['descripcion']= $row2[14];
			$_SESSION['mensaje']= $row_mensaje[3];
			$_SESSION['mensaje_personal']= $row_mensaje_personal[3];
			//$_SESSION['descripcion_tipo']= $row[2];
				switch($row2[1]){
				case '1':
					echo 'admin';
				break;
				case '2':
					echo 'inicio-agencia';
				break;
				case '3':
					echo 'inicio-influencer';
				break;
				case '4':
					echo 'inicio-influencer';
				break;
				case '5':
					echo 'inicio-influencer';
				break;

				}
		}
	}

	unset($correo);
	unset($password);
	unset($resultado);
	unset($query);
	unset($result);
	unset($num_row);
	unset($query2);
	unset($result2);
	unset($num_row2);
	unset($row2);



}


?>