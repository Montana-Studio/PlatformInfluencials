<?php 
 require('conexion.php');
 if($_POST['tipo'] == 0){
echo $_POST['facebookPageName'];
}
 else{
	$username =$_POST['faceuser'];
	$correo =$_POST['facecorreo'];
	$faceId=$_POST['faceUserId'];
	$pictureUrl='//graph.facebook.com/'.$faceId.'/picture?width=800';
	$tipo = (int) $_POST['tipo'];
	//Rescato datos de persona
	$_SESSION['faceuser']=$username;
	$_SESSION['facecorreo']=$correo;
	$_SESSION['faceUserId']=$faceId;
	$_SESSION['rsid']=$faceId;

	$query="SELECT * FROM persona p WHERE p.id_estado=1 AND p.RS_id='$faceId'";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$num_row= mysqli_num_rows($result);
	$row= mysqli_fetch_array($result, MYSQLI_NUM);

	$query2="SELECT * FROM persona p WHERE p.RS_id='$faceId' AND p.id_estado=0 AND p.telefono1=0";
	$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
	$num_row2= mysqli_num_rows($result2);
	$row2= mysqli_fetch_array($result2, MYSQLI_NUM);

	$query3="SELECT * FROM persona p WHERE p.RS_id='$faceId'";
	$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
	$num_row3= mysqli_num_rows($result3);

	if ($tipo == 2 ){
	if($num_row>0){
			// en caso que ingrese con facebook y este registrado
			$_SESSION['id']=$row[0];
			$_SESSION['nombre']=$row[5];
			$_SESSION['correo']=$row[6];
			$_SESSION['telefono1']=$row[7];
			$_SESSION['telefono2']=$row[8];
			$_SESSION['empresa']=$row[13];
			$_SESSION['pictureUrl']=$row[12];
			$_SESSION['rsid']=$row[10];
			$_SESSION['descripcion']= $row[14];
			echo 'dashboard';
		}
		else if($num_row2>0){
			$_SESSION['id']=$row2[0];
			$_SESSION['nombre']=$row2[5];
			$_SESSION['correo']=$row2[6];
			echo 'formulario';
		}
		/*
		else if ($num_row3>0){
			echo 'false';
		}*/
		else{
			$results = $mysqli->query("INSERT INTO persona (nombre, correo, id_tipo, picture_url,RS_id, fecha_ingreso )VALUES ('$username', '$correo','$tipo', '$pictureUrl','$faceId', '$hoyFormatted')");
			$query="SELECT * FROM persona p WHERE p.RS_id='$faceId'";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$num_row= mysqli_num_rows($result);
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			
			$query3="SELECT * FROM persona p WHERE p.RS_id='$faceId'";
			$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
			$num_row3= mysqli_num_rows($result3);
			$_SESSION['id']=$row3[0];
			$_SESSION['nombre']=$row3[5];
			$_SESSION['correo']=$row3[6];
			foreach($_SESSION as $valor){
				//echo $valor.',';
			}
			//$_SESSION['faceuser']=$username;
			echo 'primera';
		}


	} else if ($tipo == 3 ){
		if($num_row>0){
			// en caso que ingrese con facebook y este registrado
			$_SESSION['id']=$row[0];
			$_SESSION['nombre']=$row[5];
			$_SESSION['correo']=$row[6];
			$_SESSION['telefono1']=$row[7];
			$_SESSION['telefono2']=$row[8];
			$_SESSION['empresa']=$row[13];
			$_SESSION['pictureUrl']=$row[12];
			$_SESSION['rsid']=$row[10];
			echo 'dashboard-ipe';
		}
		else if($num_row2>0){
			echo 'formulario-ipe';
		}
		else if ($num_row3>0){
			echo 'false';
		}
		else{
			$results = $mysqli->query("INSERT INTO persona (nombre, correo, id_tipo, picture_url,RS_id, fecha_ingreso)VALUES ('$username', '$correo','$tipo', '$pictureUrl','$faceId', '$hoyFormatted')");
			$query="SELECT * FROM persona p WHERE p.RS_id='$faceId'";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$num_row= mysqli_num_rows($result);
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$_SESSION['id']=$row[0];
			$_SESSION['nombre']=$row[5];
			$_SESSION['correo']=$row[6];
			echo 'primera-ipe';
		}


	}
}	

?>