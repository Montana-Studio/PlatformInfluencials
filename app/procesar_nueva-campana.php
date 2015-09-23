<?php 
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
header('Location:./');
die();
}
else{
	$id=$_POST['id'];
	$campana=$_POST['campana'];
	$correo=$_POST['correo'];
	$rsid=$_POST['rsid'];
	$nombre=$_POST['nombre'];
	$marca=$_POST['marca'];
	$descripcion=$_POST['descripcion'];

	//Consultas a la BD
	$rrs= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND id='$id'");
	$num_row=mysqli_num_rows($rrs);

	$rf=$mysqli->query("SELECT * FROM persona WHERE RS_id='' AND id='$id'");
	$num_row2=mysqli_num_rows($rf);

	if ($num_row>0){
		$nuevaurl="./uploads/agencias/registered/$rsid/$campana/1.jpg";
		$a=1;//registrado con RS
		$row= mysqli_fetch_array($rrs, MYSQLI_NUM);
	}

	if($num_row2>0){
		$nuevaurl="./uploads/agencias/registered/$correo/$campana/1.jpg";
		$a=2; //registrado con formulario
		$row= mysqli_fetch_array($rf, MYSQLI_NUM);
	}

	if(isset($_FILES["file"]["type"]))
	{	
		$validextensions = array("jpeg", "jpg", "png","gif");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);

		if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
		) && ($_FILES["file"]["size"] < 200000)//Approx. 100000kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
		
			if ($_FILES["file"]["error"] > 0){
			echo "error";
			}
			else{
					
				//Caso exitoso
				if ($a==1){ //organizacion de directorio para RS
					if (file_exists('uploads/agencias/registered/$rsid/$campana/1.jpg')){ // cambio a partir de segunda vez con RS
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
					$_SESSION['imagen']="uploads/agencias/registered/$rsid/$campana/1.jpg";			
					echo "nuevo";
					}
					else{//primer cambio con RS
					mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
					$_SESSION['imagen']="uploads/agencias/registered/$rsid/$campana/1.jpg";			
					$mysqli->set_charset('utf8');
					$results2 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona,idestado) VALUES ('$nombre','$descripcion','$nuevaurl','$marca',$id,0)");
					echo "nuevo";
					
					}
				}
				else if ($a==2){//organizacion de directorio para usuario por formulario
					
					if (file_exists("uploads/agencias/registered/$correo/$campana/1.jpg")){ // cambio a partir de segunda vez con FORMULARIO
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
					$_SESSION['imagen']="uploads/agencias/registered/$correo/$campana/1.jpg";			
					$mysqli->set_charset('utf8');
					$results2 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona,idestado) VALUES ('$nombre','$descripcion','$nuevaurl','$marca',$id,0)");
					echo "nuevo";
					}
					else{
					mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
					$_SESSION['imagen']="uploads/agencias/registered/$correo/$campana/1.jpg";			
					$mysqli->set_charset('utf8');
					$results2 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona,idestado) VALUES ('$nombre','$descripcion','$nuevaurl','$marca',$id,0)");
					echo "nuevo";
					}

/*
								if (file_exists("uploads/$nuevocorreo/test/" . $_FILES["file"]["name"])) {
			echo "existe";
			}
			else{
			mkdir("uploads/agencias/registered/$nuevocorreo", 0777, true);
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "uploads/agencias/registered/$nuevocorreo/".$_FILES['file']['name']; // Target path where file is to be stored
			$file= $_FILES['file']['name'];
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			rename("uploads/agencias/registered/$nuevocorreo/$file", "uploads/agencias/registered/$nuevocorreo/avatar.gif");
			$results1 = $mysqli->query("INSERT INTO login (user, pass, correo) VALUES ('$nuevousuario','$nuevocontraseña','$nuevocorreo')");
			$results2 = $mysqli->query("INSERT INTO persona (nombre, correo, empresa, telefono1, telefono2, id_login, id_tipo, picture_url ) VALUES ('$nuevousuario','$nuevocorreo','$nuevoempresa','$nuevotelefono1','$nuevotelefono2', (SELECT id from login WHERE correo='$nuevocorreo'),'2','$nuevaurl')");
			echo "nuevo";
*/


				}
			}
		}
		else{
		echo "invalido";
		}
	}
}
?>
