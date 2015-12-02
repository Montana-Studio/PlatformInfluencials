<?php
 require('conexion.php');

function valida_extension(){
	if(isset($_FILES['file']['type'])){
		$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);

		if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
			) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {

				if ($_FILES["file"]["error"] > 0){
					$status = "error";
				}else{
					$status = "ok";
				}
		}else{
			$status = "invalido";
		}
	}
	return $status;
}

$rsid=$_SESSION['rsid'];
$correo =$_SESSION['correo'];
$tipo = $_POST['tipo'];
$id= $_SESSION['id'];
$sourcePath = $_FILES['file']['tmp_name'];
$file= $_FILES['file']['name'];
$a=0;


if (strlen($_SESSION['rsid'])>2){
	$a=1;
}else{
	$a=2;
}

if ($tipo == 'avatar-ipe'){
	$correo =$_POST['correo'];
	$nombre =$_POST['nombre'];
	$comuna= $_POST['comuna'];
	$region=$_POST['region'];
	$descripcion= $_POST['descripcion'];
	//$picture_url=$_SESSION['pictureUrl'];
	if(valida_extension() == "ok"){
		if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image
			if (file_exists("uploads/ipe/registered/$rsid")){ // cambio a partir de segunda vez con RS
				$targetPath = "uploads/ipe/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/ipe/registered/$rsid/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/ipe/registered/$rsid/$file", "uploads/ipe/registered/$rsid/avatar.gif");
				$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', correo='$correo', region='$region', comuna='$comuna', picture_url='uploads/ipe/registered/$rsid/avatar.gif' , descripcion='$descripcion' WHERE RS_id='$rsid'");
				$resultado = "nuevo";
			}else{
				mkdir("uploads/ipe/registered/$rsid", 0777, true);
				$targetPath = "uploads/ipe/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/ipe/registered/$rsid/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/ipe/registered/$rsid/$file", "uploads/ipe/registered/$rsid/avatar.gif");
				$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', correo='$correo',region='$region', comuna='$comuna', picture_url='uploads/ipe/registered/$rsid/avatar.gif' , descripcion='$descripcion' WHERE RS_id='$rsid'");
				$resultado = "nuevo";
			}
		}

		if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image
			//echo $comuna;
			if (file_exists("uploads/ipe/registered/$correo")){
				$targetPath = "uploads/ipe/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/ipe/registered/$correo/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/ipe/registered/$correo/$file", "uploads/ipe/registered/$correo/avatar.gif");
				$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', region='$region', comuna='$comuna', descripcion='$descripcion' WHERE correo='$correo'");
				$actualizaLogin = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");
				//echo "UPDATE persona SET nombre='$nombre', region='$region', comuna='$comuna', picture_url='uploads/ipe/registered/$rsid/avatar.gif' , descripcion='$descripcion' WHERE correo='$correo'";
				$resultado = "nuevo";
			}
		}
	}else{
		
		$resultado = valida_extension();
		
	}
	
	$_SESSION['nombre']= $nombre;
	$_SESSION['correo']=$correo;
	$_SESSION['comuna']=$comuna;
	$_SESSION['region']=$region;
	$_SESSION['descripcion']=$descripcion;
	echo $resultado;

}else if ($tipo == 'avatar'){
	$tel1 =$_POST['tel1'];
	$tel2 =$_POST['tel2'];
	$empresa= $_POST['empresa'];
	$picture_url=$_SESSION['picture_url'];
	$nombre =$_POST['nombre'];

	if(valida_extension() == "ok"){

		if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image
			if (file_exists("uploads/agencias/registered/$rsid")){ // cambio a partir de segunda vez con RS
				$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/agencias/registered/$rsid/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
				$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
				$resultado = "nuevo";
			}else{
				mkdir("uploads/agencias/registered/$rsid", 0777, true);
				$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/agencias/registered/$rsid/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
				$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
				$resultado = "nuevo";

			}
		}
		if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image
			if (file_exists("uploads/agencias/registered/$correo")){
				$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/agencias/registered/$correo/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
				$actualiza = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE correo='$correo'");
				$actualizaLogin = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");
				$resultado = "nuevo";
			}
		}
	}else{
		$resultado = valida_extension();
	}
	$_SESSION['picture_url']=$targetPath."avatar.gif";
	echo $resultado;

}else if ($tipo == 'campana'){
	$selected_rrss=$_POST['selected_rrss'];
	//echo $selected_rrss;
	$nombre =$_POST['nombre'];
	$marca = $_POST['marca'];
	$descripcion= $_POST['descripcion'];
	$fecha_termino = $_POST['fecha_termino'];
  if(strlen($nombre)*strlen($marca)*strlen($descripcion) == 0){
    $resultado = "incompleto";
  }else{
    $query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
  	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
  	$row= mysqli_fetch_array($result, MYSQLI_NUM);
  	$campana= (int)$row[0];
  	$campana = $campana +1;
  	if(valida_extension() == "ok"){
  		if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image
  			$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$rsid/$campana/1.jpg','$marca','$id')");
  			//$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,marca,idpersona, fecha_termino, redes_sociales) VALUES ('$nombre','$descripcion','$marca','$id', '$fecha_termino', '$selected_rrss')");
  			$inicio_imagenes ='uploads/agencias/registered/'.$rsid.'/';
  			$fin_imagenes = '/1.jpg';
  			$results4 = $mysqli->query("SELECT id FROM campana  WHERE nombre = '$nombre' AND descripcion = '$descripcion' AND marca = '$marca' AND idpersona = '$id'");
  			$row_results4= mysqli_fetch_array($results4, MYSQLI_NUM);
  			$numero_campana= (int)$row_results4[0];
  			$imagenes = $inicio_imagenes.$numero_campana.$fin_imagenes;
  			$results3 = $mysqli->query("UPDATE campana SET imagenes='$imagenes' WHERE id = '$numero_campana'");
  			mkdir("uploads/agencias/registered/$rsid/$numero_campana", 0777, true);
  			$targetPath = "uploads/agencias/registered/$rsid/$numero_campana/".$_FILES['file']['name']; // Target path where file is to be stored
  			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
  			rename("uploads/agencias/registered/$rsid/$numero_campana/$file", "uploads/agencias/registered/$rsid/$numero_campana/1.jpg");
  			//
  			//$resultado = $imagenes;
  		}
  		if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image
  			$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$correo/$campana/1.jpg','$marca','$id')");
  			//$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,marca,idpersona,fecha_termino,redes_sociales) VALUES ('$nombre','$descripcion','$marca','$id', '$fecha_termino', '$selected_rrss')");
  			$inicio_imagenes ='uploads/agencias/registered/'.$correo.'/';
  			$fin_imagenes = '/1.jpg';
  			$results4 = $mysqli->query("SELECT id FROM campana  WHERE nombre = '$nombre' AND descripcion = '$descripcion' AND marca = '$marca' AND idpersona = '$id'");
  			$row_results4= mysqli_fetch_array($results4, MYSQLI_NUM);
  			$numero_campana= (int)$row_results4[0];
  			$imagenes = $inicio_imagenes.$numero_campana.$fin_imagenes;
  			$results3 = $mysqli->query("UPDATE campana SET imagenes='$imagenes' WHERE id = '$numero_campana'");

  			mkdir("uploads/agencias/registered/$correo/$numero_campana", 0777, true);
  			$targetPath = "uploads/agencias/registered/$correo/$numero_campana/".$_FILES['file']['name']; // Target path where file is to be stored
  			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
  			rename("uploads/agencias/registered/$correo/$numero_campana/$file", "uploads/agencias/registered/$correo/$numero_campana/1.jpg");
  			//$resultado = "nueva";
  			//$resultado = $imagenes;
  		}
  		$resultado = "nueva";
  	}else{
  		$resultado = valida_extension();
  	}
  }

	echo $resultado;

}else if ($tipo == 'imagen'){
	$nombre =$_POST['nombre'];
	$marca =$_POST['marca'];
	$descripcion =$_POST['descripcion'];
	$idCampana =$_POST['idCampana'];
	$idpersona =$_POST['idpersona'];
	$fecha_termino = $_POST['fecha_termino'];
	if($nombre == ''){
			$results_nombre = $mysqli->query("SELECT nombre FROM campana  WHERE id='$idCampana'");
			$row_results_nombre= mysqli_fetch_array($results_nombre, MYSQLI_NUM);
			$nombre= $row_results_nombre[0];

	}
	if($marca == ''){
			$results_marca = $mysqli->query("SELECT marca FROM campana  WHERE id='$idCampana'");
			$row_results_marca= mysqli_fetch_array($results_marca, MYSQLI_NUM);
			$marca= $row_results_marca[0];
	}

	$sql = "UPDATE campana SET nombre='$nombre', marca='$marca', descripcion='$descripcion', fecha_termino='$fecha_termino' WHERE idpersona='$idpersona' AND id='$idCampana'";
	$update = $mysqli->query($sql);
	if($_POST['foto'] == 1){
		if(valida_extension() == "ok"){
			$campana=$_POST['campana'];
			//Success
			if ($a==1){ // Create directory to save the file in case of Social Login
				$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
				//$resultado = "nuevo";
				echo "nuevo";
			}
			if ($a==2){// Create directory to save the file in case of Form Login
				$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
				unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
				//$resultado = "nuevo";
				echo "nuevo";
			}
		}
		else{
			echo "false";
		}
	}else{
		echo "nuevo";
	}

	//echo $resultado;
}else if($tipo == 'agencia'){
	$nuevousuario=$_POST['nuuser'];
	$nuevocontraseña=MD5($_POST['nupass']);
	$nuevoempresa=$_POST['nuempresa'];
	$nuevocorreo=$_POST['nucorreo'];
	$nuevotelefono1=$_POST['nutel1'];
	$nuevotelefono2=$_POST['nutel2'];
	$nuevaurl="./uploads/agencias/registered/$nuevocorreo/avatar.gif";
	$ipe = $_POST['ipe'];

		$query= "SELECT DISTINCT correo FROM persona WHERE correo='$nuevocorreo'";
		$result= mysqli_query($mysqli,$query)or die(mysqli_error());
		$num_row= mysqli_num_rows($result);

		if($num_row>0){
			 echo "false";
	/*	}else if (file_exists("uploads/$nuevocorreo/test/" . $_FILES["file"]["name"])) {
			$resultado = "existe";*/
		}else if(valida_extension() == "ok"){
			mkdir("uploads/agencias/registered/$nuevocorreo", 0777, true);
			$targetPath = "uploads/agencias/registered/$nuevocorreo/".$_FILES['file']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			rename("uploads/agencias/registered/$nuevocorreo/$file", "uploads/agencias/registered/$nuevocorreo/avatar.gif");
			$results1 = $mysqli->query("INSERT INTO login (user, pass, correo) VALUES ('$nuevousuario','$nuevocontraseña','$nuevocorreo')");
			$results2 = $mysqli->query("INSERT INTO persona (nombre, correo, empresa, telefono1, telefono2, id_login, id_tipo,descripcion_tipo ,  picture_url, fecha_ingreso ) VALUES ('$nuevousuario','$nuevocorreo','$nuevoempresa','$nuevotelefono1','$nuevotelefono2', (SELECT id from login WHERE correo='$nuevocorreo'),'2','agencia','$nuevaurl', '$hoy')");
			echo "nuevo";
		}else{
			echo "invalido";
		}

	

}else if($tipo == 'influenciador'){
	$nuevocomuna=$_POST['comuna'];
	$nuevoregion=$_POST['region'];	
	$nuevousuario=$_POST['nuuser'];
	$nuevocontraseña=MD5($_POST['nupass']);
	$nuevocorreo=$_POST['nucorreo'];
	$nuevaurl="./uploads/ipe/registered/$nuevocorreo/avatar.gif";
	$ipe = $_POST['ipe'];

	if ($ipe == '3'){
		$descripciontipo= 'influenciador';
	} 
	else if ($ipe == '4'){
		$descripciontipo= 'publicador';
	} 
	else if ($ipe == '5'){
		$descripciontipo= 'editor';	
	} 

		$query= "SELECT DISTINCT correo FROM persona WHERE correo='$nuevocorreo'";
		$result= mysqli_query($mysqli,$query)or die(mysqli_error());
		$num_row= mysqli_num_rows($result);

		if($num_row>0){
			 echo "false";
	/*	}else if (file_exists("uploads/$nuevocorreo/test/" . $_FILES["file"]["name"])) {
			$resultado = "existe";*/
		}else if(valida_extension() == "ok"){
			mkdir("uploads/ipe/registered/$nuevocorreo", 0777, true);
			$targetPath = "uploads/ipe/registered/$nuevocorreo/".$_FILES['file']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			rename("uploads/ipe/registered/$nuevocorreo/$file", "uploads/ipe/registered/$nuevocorreo/avatar.gif");
			$results1 = $mysqli->query("INSERT INTO login (user, pass, correo) VALUES ('$nuevousuario','$nuevocontraseña','$nuevocorreo')");
			$results2 = $mysqli->query("INSERT INTO persona (nombre, correo, id_login, id_tipo, descripcion_tipo,  picture_url, region, comuna, fecha_ingreso ) VALUES ('$nuevousuario','$nuevocorreo', (SELECT id from login WHERE correo='$nuevocorreo'),'$ipe','$descripciontipo','$nuevaurl', '$nuevoregion', '$nuevocomuna', '$hoy')");
			echo "nuevo";
		}else{
			echo "invalido";
		}

	

}

?>
