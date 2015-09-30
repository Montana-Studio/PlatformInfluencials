<?php 
 require('conexion.php');

$rsid=$_SESSION['rsid'];
$correo =$_POST['correo'];
$tipo = $_POST['tipo'];
$a=0;

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


if (strlen($_SESSION['rsid'])>2){
$a=1;
}else{
	$a=2;
}
if ($tipo == 'avatar'){
	$tel1 =$_POST['tel1'];
	$tel2 =$_POST['tel2'];
	$empresa= $_POST['empresa'];
	$picture_url=$_POST['picture_url'];
	$nombre =$_POST['nombre'];
	$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
	$file= $_FILES['file']['name'];
	if(valida_extension() == "ok"){
				if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image 
						if (file_exists("uploads/agencias/registered/$rsid")){ // cambio a partir de segunda vez con RS
							$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
							unlink("uploads/agencias/registered/$rsid/avatar.gif");
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
							$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
							$_SESSION['id']=$row[0];
							$_SESSION['nombre']=$nombre;
							$_SESSION['correo']=$correo;
							$_SESSION['telefono1']=$tel1;
							$_SESSION['telefono2']=$tel2;
							$_SESSION['empresa']=$empresa;
							$_SESSION['rsid']=$rsid;
							$_SESSION['pictureUrl']="uploads/agencias/registered/$rsid/avatar.gif";			
							//echo "nuevo";
							$resultado = "nuevo";
						}
						else{	//change on avatar image 
							mkdir("uploads/agencias/registered/$rsid", 0777, true);
							$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
							$results3 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
							$_SESSION['id']=$row[0];
							$_SESSION['nombre']=$nombre;
							$_SESSION['correo']=$correo;
							$_SESSION['telefono1']=$tel1;
							$_SESSION['telefono2']=$tel2;
							$_SESSION['empresa']=$empresa;
							$_SESSION['pictureUrl']="uploads/agencias/registered/$rsid/avatar.gif";			
							//echo "nuevo";
							$resultado = "nuevo";
						}
					}
					if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
						if (file_exists("uploads/agencias/registered/$correo")){
							$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
							unlink("uploads/agencias/registered/$correo/avatar.gif");
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
							$mysqli->set_charset('utf8');
							$actualiza = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE correo='$correo'");			
							$actualizaLogin = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");			 
							$_SESSION['id']=$row[0];
							$_SESSION['nombre']=$nombre;
							$_SESSION['correo']=$correo;
							$_SESSION['telefono1']=$tel1;
							$_SESSION['telefono2']=$tel2;
							$_SESSION['empresa']=$empresa;
							$_SESSION['pictureUrl']="uploads/agencias/registered/$correo/avatar.gif";			
							//echo "nuevo";
							$resultado = "nuevo";
						}
						else{
							mkdir("uploads/agencias/registered/$correo", 0777, true);
							$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
							$results3 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$correo/avatar.gif' WHERE correo='$correo'");
							$_SESSION['id']=$row[0];
							$_SESSION['nombre']=$nombre;
							$_SESSION['correo']=$correo;
							$_SESSION['telefono1']=$tel1;
							$_SESSION['telefono2']=$tel2;
							$_SESSION['empresa']=$empresa;
							$_SESSION['pictureUrl']="uploads/agencias/registered/$correo/avatar.gif";			
							//echo "nuevo";
							$resultado = "nuevo";
						}
				}


	}else{
		//echo valida_extension();
		$resultado = "nuevo";
	}



/*
	if(isset($_FILES["file"]["type"]))
	{	
		$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);

		if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
		) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
		
			if ($_FILES["file"]["error"] > 0){
				echo "error";
				}
				else{
					
					//Success
					if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image 
						if (file_exists("uploads/agencias/registered/$rsid")){ // cambio a partir de segunda vez con RS
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
						$file= $_FILES['file']['name'];
						unlink("uploads/agencias/registered/$rsid/avatar.gif");
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
						$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
						$_SESSION['id']=$row[0];
						$_SESSION['nombre']=$nombre;
						$_SESSION['correo']=$correo;
						$_SESSION['telefono1']=$tel1;
						$_SESSION['telefono2']=$tel2;
						$_SESSION['empresa']=$empresa;
						$_SESSION['rsid']=$rsid;
						$_SESSION['pictureUrl']="uploads/agencias/registered/$rsid/avatar.gif";			
						echo "nuevo";
						}
						else{	//change on avatar image 
						mkdir("uploads/agencias/registered/$rsid", 0777, true);
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
						$file= $_FILES['file']['name'];
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
						$results3 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
						$_SESSION['id']=$row[0];
						$_SESSION['nombre']=$nombre;
						$_SESSION['correo']=$correo;
						$_SESSION['telefono1']=$tel1;
						$_SESSION['telefono2']=$tel2;
						$_SESSION['empresa']=$empresa;
						$_SESSION['pictureUrl']="uploads/agencias/registered/$rsid/avatar.gif";			
						echo "nuevo";
						}
					}
					else if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
						$file= $_FILES['file']['name'];
						unlink("uploads/agencias/registered/$correo/avatar.gif");
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
						$mysqli->set_charset('utf8');
						$actualiza = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE correo='$correo'");			
						$actualizaLogin = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");			 
						$_SESSION['id']=$row[0];
						$_SESSION['nombre']=$nombre;
						$_SESSION['correo']=$correo;
						$_SESSION['telefono1']=$tel1;
						$_SESSION['telefono2']=$tel2;
						$_SESSION['empresa']=$empresa;
						$_SESSION['pictureUrl']="uploads/agencias/registered/$correo/avatar.gif";			
						echo "nuevo";
					}else{
						mkdir("uploads/agencias/registered/$correo", 0777, true);
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
						$file= $_FILES['file']['name'];
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
						$results3 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$correo/avatar.gif' WHERE correo='$correo'");
						$_SESSION['id']=$row[0];
						$_SESSION['nombre']=$nombre;
						$_SESSION['correo']=$correo;
						$_SESSION['telefono1']=$tel1;
						$_SESSION['telefono2']=$tel2;
						$_SESSION['empresa']=$empresa;
						$_SESSION['pictureUrl']="uploads/agencias/registered/$correo/avatar.gif";			
						echo "nuevo";
					}	
			}
		}
		else{
		echo "invalido";
		}
	}
*/
}else if ($tipo == 'campana'){
	$nombre =$_POST['nombre'];
	$marca = $_POST['marca'];
	$descripcion= $_POST['descripcion'];
	$id= $_SESSION['id'];

	$query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$row= mysqli_fetch_array($result, MYSQLI_NUM);
	$campana= (int)$row[0];
	$campana = $campana +1;
	if(valida_extension() == "ok"){
		if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image  
			$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$rsid/$campana/1.jpg','$marca','$id')");		
			mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
			$file= $_FILES['file']['name'];
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
			//echo "nueva";
			$resultado = "nueva";
		}
		
		if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
			$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$correo/$campana/1.jpg','$marca','$id')");		
			mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
			$file= $_FILES['file']['name'];
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
			//echo "nueva";
			$resultado = "nueva";
		}
	}else{
		$resultado = valida_extension();
	}

	echo $resultado;
/*

	if(isset($_FILES["file"]["type"]))
	{	
		$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);

			if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
			) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
			
				if ($_FILES["file"]["error"] > 0){
					//echo "error";
					$resultado = "error";
					}
					else{
						//Success
						if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image  
							$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$rsid/$campana/1.jpg','$marca','$id')");		
							mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
							$file= $_FILES['file']['name'];
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
							//echo "nueva";
							$resultado = "nueva";
						}
						else if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
							$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$correo/$campana/1.jpg','$marca','$id')");		
							mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
							$file= $_FILES['file']['name'];
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
							//echo "nueva";
							$resultado = "nueva";
						}	
					}
				}else{
			//echo "invalido";
			$resultado = "invalido";
		}
	}
	
	echo $resultado; 
*/



}else if ($tipo == 'imagen'){
	$nombre =$_POST['nombre'];
	$marca =$_POST['marca'];
	$descripcion =$_POST['descripcion'];
	$idCampana =$_POST['idCampana'];
	$idpersona =$_POST['idpersona'];
	$sql = "UPDATE campana SET nombre='$nombre', marca='$marca', descripcion='$descripcion' WHERE idpersona='$idpersona' AND id='$idCampana'";
	$update = $mysqli->query($sql);
	if($_POST['foto'] == 1){
		if(valida_extension() == "ok"){
			$campana=$_POST['campana'];
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			//Success
			if ($a==1){ // Create directory to save the file in case of Social Login
				$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
				$resultado = "nuevo";
			}
			if ($a==2){// Create directory to save the file in case of Form Login
				unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
				$targetPath = "uploads/agencias/registered/$correo/$campana".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");		
				$resultado = "nuevo";
			}
		}
		else{
			$resultado = valida_extension();
		}

	}
	echo $resultado;

/*
		if($_POST['foto'] == 1){

			if(isset($_FILES["file"]["type"]))
			{	
				$id=$_POST['id'];
				$campana=$_POST['campana'];
				$nombre =$_POST['nombre'];
				$marca =$_POST['marca'];
				$descripcion =$_POST['descripcion'];
				$id =$_POST['idCampana'];
				$idpersona =$_POST['idpersona'];

				$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);
				if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
				) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					
					if ($_FILES["file"]["error"] > 0){
					echo "error";
					}
					else{	
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						echo "campaña =".$campana." - rsid = ".$rsid." sourcePath =".$sourcePath;
						//Success
						if ($a==1){ // Create directory to save the file in case of Social Login
								$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
								$file= $_FILES['file']['name'];
								unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
								move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
								rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
								echo "nuevo";
						}
						if ($a==2){// Create directory to save the file in case of Form Login
								unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
								$targetPath = "uploads/agencias/registered/$correo/$campana".$_FILES['file']['name']; // Target path where file is to be stored
								$file= $_FILES['file']['name'];
								
								move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
								rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");		
								echo "nuevo";
						}	
					}
				}else{
				echo "invalido";
				
				}
			}

		}
*/

}

?>