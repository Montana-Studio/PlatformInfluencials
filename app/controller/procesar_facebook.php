<?php 
 require('conexion.php');
 $tipo = (int)$_POST['tipo'];
 //$empresa = $_POST['empresa'];


	 if($_POST['tipo'] == 0){
	echo $_POST['facebookPageName'];
	}
	 else{
		$username =$_POST['faceuser'];
		$correo =$_POST['facecorreo'];
		$faceId=$_POST['faceUserId'];
		$pictureUrl='//graph.facebook.com/'.$faceId.'/picture?width=800';
		//Rescato datos de persona
		$_SESSION['faceuser']=$username;
		$_SESSION['facecorreo']=$correo;
		$_SESSION['faceUserId']=$faceId;
		$_SESSION['rsid']=$faceId;

		$query="SELECT * FROM persona WHERE id_estado='1' AND RS_id='".$faceId."'";
		$result= mysqli_query($mysqli,$query)or die(mysqli_error());
		$num_row= mysqli_num_rows($result);
		$row= mysqli_fetch_array($result, MYSQLI_NUM);

		$query2='SELECT * FROM persona WHERE RS_id="'.$faceId.'" AND id_estado="0" AND estado_formulario="0" AND (telefono1="0" OR telefono2="0" OR empresa=NULL)';
		$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
		$num_row2= mysqli_num_rows($result2);
		$row2= mysqli_fetch_array($result2, MYSQLI_NUM);

		$query3='SELECT * FROM persona WHERE RS_id="'.$faceId.'" AND id_estado="0" AND estado_formulario="1"';
		$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
		$num_row3= mysqli_num_rows($result3);
		$row3= mysqli_fetch_array($result3, MYSQLI_NUM);



		if ($tipo == '2' ){//Agencia
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
				$_SESSION['id_tipo']=$row[1];
				$_SESSION['descripcion']= $row[14];
				echo 'dashboard';
			}
			else if($num_row2>0){
				$_SESSION['id']=$row2[0];
				$_SESSION['nombre']=$row2[5];
				$_SESSION['correo']=$row2[6];
				$_SESSION['telefono1']=$row2[7];
				$_SESSION['telefono2']=$row2[8];
				$_SESSION['empresa']=$row2[13];
				$_SESSION['pictureUrl']=$row2[12];
				$_SESSION['rsid']=$row2[10];
				$_SESSION['id_tipo']=$row2[1];
				$_SESSION['descripcion']= $row2[14];
				echo 'formulario';
			}
			else if ($num_row3>0) {
				echo 'existe-agencia';
			}
			else{
				$results = $mysqli->query('INSERT INTO persona (nombre, correo, id_tipo, descripcion_tipo, picture_url,RS_id,fecha_ingreso, estado_formulario )VALUES ("'.$username.'", "'.$correo.'","'.$tipo.'","'.$agencia.'", "'.$pictureUrl.'","'.$faceId.'", "'.$hoyFormatted.'", "0")');
				$query='SELECT * FROM persona WHERE RS_id="'.$faceId.'"';
				$result= mysqli_query($mysqli,$query)or die(mysqli_error());
				$num_row= mysqli_num_rows($result);
				$row= mysqli_fetch_array($result, MYSQLI_NUM);
				$_SESSION['id']=$row[0];
				$_SESSION['nombre']=$row[5];
				$_SESSION['correo']=$row[6];
				$_SESSION['id_tipo']=$row[1];
				echo 'primera';
			}
		}
		if ($tipo == '3'){
			if($num_row>0){
				// en caso que ingrese con facebook y este registrado
				$_SESSION['id']=$row[0];
				$_SESSION['nombre']=$row[5];
				$_SESSION['correo']=$row[6];
				$_SESSION['id_tipo']=$row[1];
				$_SESSION['descripcion']=$row[14];
				$_SESSION['descripcion_tipo']=$row[2];
				$_SESSION['pictureUrl']=$row[12];
				$_SESSION['comuna']=$row[16];
				$_SESSION['region']=$row[15];
				echo 'dashboard-ipe';
			}
			else if($num_row2>0){
				$_SESSION['id']=$row2[0];
				$_SESSION['nombre']=$row2[5];
				$_SESSION['correo']=$row2[6];
				$_SESSION['id_tipo']=$row[1];
				echo 'formulario-ipe';
			}
			else if ($num_row3>0) {
				echo 'existe-influenciador';
			}
			else{
				$results = $mysqli->query('INSERT INTO persona (nombre, correo, id_tipo, descripcion_tipo, picture_url,RS_id,fecha_ingreso, estado_formulario )VALUES ("'.$username.'", "'.$correo.'","'.$tipo.'","'.$agencia.'", "'.$pictureUrl.'","'.$faceId.'", "'.$hoyFormatted.'", "0")');
				$query='SELECT * FROM persona WHERE RS_id="'.$faceId.'"';
				$result= mysqli_query($mysqli,$query)or die(mysqli_error());
				$num_row= mysqli_num_rows($result);
				$row= mysqli_fetch_array($result, MYSQLI_NUM);
				$_SESSION['id']=$row[0];
				$_SESSION['nombre']=$row[5];
				$_SESSION['correo']=$row[6];
				$_SESSION['id_tipo']=$row[1];
				echo 'formulario-ipe';
			}
		}
		unset($query);
		unset($result);
		unset($num_row);
		unset($row);
		unset($query2);
		unset($result2);
		unset($num_row2);
		unset($row2);
		unset($query3);
		unset($result3);
		unset($num_row3);
		unset($row3);
		unset($username);
		unset($correo);
		unset($faceId);
		unset($pictureUrl);
	}
		
	


?>