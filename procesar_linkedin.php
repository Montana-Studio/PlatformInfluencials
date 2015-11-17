<?php 
 require('conexion.php');

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

	$query="SELECT * FROM persona p WHERE p.RS_id='$rsid' AND p.id_estado=1";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$num_row= mysqli_num_rows($result);
	$row= mysqli_fetch_array($result, MYSQLI_NUM);

	$query2="SELECT * FROM persona p WHERE p.RS_id='$rsid' AND p.id_estado=0 AND telefono1=0";
	$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
	$num_row2= mysqli_num_rows($result2);

	$query3="SELECT * FROM persona p WHERE p.RS_id='$rsid'";
	$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
	$num_row3= mysqli_num_rows($result3);

	if ($tipo == 2 )
	{
		if($num_row>0){
		// en caso que ingrese con linkedin y este registrado
		$_SESSION['id']=$row[0];
		$_SESSION['nombre']=$row[4];
		$_SESSION['correo']=$row[5];
		$_SESSION['telefono1']=$row[6];
		$_SESSION['telefono2']=$row[7];
		$_SESSION['empresa']=$row[12];
		$_SESSION['pictureUrl']=$row[11];
		$_SESSION['rsid']=$row[9];
		$_SESSION['descripcion']= $row[13];

		echo 'dashboard';
		}else if($num_row2>0){
		echo 'formulario';
		}else if ($num_row3>0)
		{
		echo 'false';
		}else{
		$results = $mysqli->query("INSERT INTO persona (nombre, correo, id_tipo, picture_url, RS_id, oauth_id )VALUES ('$nombre', '$correo','$tipo', '$pictureUrl', '$rsid' , '$conn')");
		echo 'primera';
		}

	} else if ($tipo == 3){

		if($num_row>0){
		// en caso que ingrese con linkedin y este registrado
		$_SESSION['id']=$row[0];
		$_SESSION['nombre']=$row[4];
		$_SESSION['correo']=$row[5];
		$_SESSION['telefono1']=$row[6];
		$_SESSION['telefono2']=$row[7];
		$_SESSION['empresa']=$row[12];
		$_SESSION['pictureUrl']=$row[11];
		$_SESSION['rsid']=$row[9];

		echo 'dashboard-ipe';
		}else if($num_row2>0){
		echo 'formulario-ipe';
		}else if ($num_row3>0)
		{
		echo 'false';
		}else{
		$results = $mysqli->query("INSERT INTO persona (nombre, correo, id_tipo, picture_url, RS_id, oauth_id )VALUES ('$nombre', '$correo','$tipo', '$pictureUrl', '$rsid' , '$conn')");
		echo 'primera-ipe';
		}
	}

?>