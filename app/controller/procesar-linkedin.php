<?php 
require('../controller/conexion.php');

	$rsid =$_POST['id'];
	$nombre =$_POST['nombre'];
	$correo =$_POST['email'];
	$pictureUrl=$_POST['pictureUrl'];
	$conn=$_POST['conn'];
	$tipo = (int) $_POST['tipo'];

	//Rescato datos de persona
	$_SESSION['nombre']=$nombre;
	$_SESSION['emailAddress']=$correo;
	$_SESSION['pictureUrl']=$pictureUrl;
	$_SESSION['id']=$rsid;
	$_SESSION['conn']= $connections;

	$query='SELECT * FROM persona WHERE RS_id="'.$rsid.'" AND id_estado=1';
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$num_row= mysqli_num_rows($result);
	$row= mysqli_fetch_array($result, MYSQLI_NUM);

	$query2='SELECT * FROM persona WHERE RS_id="'.$rsid.'" AND id_estado=0 AND estado_formulario=0 AND (telefono1="0" OR telefono2="0" OR empresa=NULL)';
	$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
	$num_row2= mysqli_num_rows($result2);

	$query3='SELECT * FROM persona WHERE RS_id="'.$rsid.'" AND id_estado="0" AND estado_formulario="1"';
	$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
	$num_row3= mysqli_num_rows($result3);
	$row3= mysqli_fetch_array($result3, MYSQLI_NUM);

	$mensaje_query= "SELECT * FROM mensajes WHERE correo='' AND id_tipo=2 ORDER BY id DESC";
	$result_mensaje= mysqli_query($mysqli,$mensaje_query)or die(mysqli_error());
	$row_mensaje= mysqli_fetch_array($result_mensaje, MYSQLI_NUM);

	$mensaje_query= "SELECT * FROM mensajes WHERE correo='".$row[6]."' AND id_tipo=2 ORDER BY id DESC";
	$result_mensaje_personal= mysqli_query($mysqli,$mensaje_query)or die(mysqli_error());
	$row_mensaje_personal= mysqli_fetch_array($result_mensaje_personal, MYSQLI_NUM);


	if ($tipo == 2 )
	{
		if($num_row>0){
			$_SESSION['id']=$row[0];
			$_SESSION['nombre']=$row[5];
			$_SESSION['correo']=$row[6];
			$_SESSION['telefono1']=$row[7];
			$_SESSION['telefono2']=$row[8];
			$_SESSION['empresa']=$row[13];
			$_SESSION['pictureUrl']=$row[12];
			$_SESSION['rsid']=$row[10];
			$_SESSION['descripcion']= $row[14];
			$_SESSION['mensaje']=$row_mensaje[3];
			$_SESSION['mensaje_personal']=$row_mensaje_personal[3];
			echo 'dashboard';
		}else if($num_row2>0){
			$_SESSION['id']=$row2[0];
			$_SESSION['nombre']=$row2[5];
			$_SESSION['correo']=$row2[6];
			$_SESSION['telefono1']=$row2[7];
			$_SESSION['telefono2']=$row2[8];
			$_SESSION['empresa']=$row2[13];
			$_SESSION['pictureUrl']=$row2[12];
			$_SESSION['rsid']=$row2[10];
			$_SESSION['descripcion']= $row2[14];
			echo 'formulario';
		}else if ($num_row3>0) {
				echo 'existe-agencia';
		}else{
			$results = $mysqli->query('INSERT INTO persona (nombre, correo, id_tipo, picture_url, RS_id, oauth_id, fecha_ingreso, estado_formulario )VALUES ("'.$nombre.'", "'.$correo.'","'.$tipo.'", "'.$pictureUrl.'", "'.$rsid.'" , "'.$conn.'" , "'.$hoyFormatted.'", "0")');
			$_SESSION['id']=$rsid;
			$_SESSION['nombre']=$nombre;
			$_SESSION['correo']=$correo;
			$_SESSION['pictureUrl']=$pictureUrl;
			$_SESSION['rsid']=$rsid;
			echo 'formulario';
		}

		unset($query);
		unset($result);
		unset($row);
		unset($num_row);
		unset($query2);
		unset($result2);
		unset($row2);
		unset($num_row2);
		unset($query3);
		unset($result3);
		unset($row3);
		unset($num_row3);
		unset($rsid);
		unset($nombre);
		unset($correo);
		unset($pictureUrl);
		unset($conn);
		unset($tipo);


	}

	
?>