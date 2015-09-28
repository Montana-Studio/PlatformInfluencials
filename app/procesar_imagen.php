<?php 
 require('conexion.php');

$rsid=$_SESSION['rsid'];
$correo =$_POST['correo'];
$tipo = $_POST['tipo'];
$a=0;

/*
//Consultas a la BD
$rrs= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND RS_id='$rsid'");
$num_row=mysqli_num_rows($rrs);

$rf=$mysqli->query("SELECT * FROM persona WHERE RS_id='' AND correo='$correo'");
$num_row2=mysqli_num_rows($rf);


if ($num_row>0){
$a=1;//registrado con RS

$row= mysqli_fetch_array($rrs, MYSQLI_NUM);
}


if($num_row2>0){
$a=2; //registrado con formulario
$row= mysqli_fetch_array($rf, MYSQLI_NUM);
}
*/
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

}else if ($tipo == 'campana'){

	$nombre =$_POST['nombre'];
	$marca = $_POST['marca'];
	$descripcion= $_POST['descripcion'];
	$id= $_SESSION['id'];
	$correo=$_SESSION['correo'];

	$query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$row= mysqli_fetch_array($result, MYSQLI_NUM);
	$campana= (int)$row[0];
	$campana = $campana + 1;

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
							if (file_exists("uploads/agencias/registered/$rsid/$campana")){ // cambio a partir de segunda vez con RS
									 
									echo "uploads/agencias/registered/$rsid/$campana existe";
							}
							else{	//change on avatar image 
							$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$rsid/$campana/1.jpg','$marca','$id')");		
							mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
							$file= $_FILES['file']['name'];
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
							echo "nueva";
							}
						}
						else if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
							if (file_exists("uploads/agencias/registered/$correo/$campana")){ // cambio a partir de segunda vez con RS
									echo "existe";
							}
							else{
							$results3 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$correo/$campana/1.jpg','$marca','$id')");		
							mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
							$file= $_FILES['file']['name'];
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
							echo "nueva";
						}	
					}
				}
			
		}else{
			echo "invalido";
			}
	}
}

?>
