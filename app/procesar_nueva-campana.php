<?php 
 require('conexion.php');

$nombre =$_POST['nombre'];
$marca = $_POST['marca'];
$descripcion= $_POST['descripcion'];
$campana= $_POST['campana'];
$id= $_SESSION['id'];
$rsid=$_SESSION['rsid'];
$correo=$_SESSION['correo'];

$query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);

$campana = (int)$row[0]+1;
//Consultas a la BD
if (strlen($rsid)>2){
$a=1;
}else{
$a=2;
}

if(isset($_FILES["file"]["type"]))
{	
	mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);	
	$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);

	if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
	) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
				
				//Success
				if ($a==1){ // Create directory to save the file in case of Social Login and first change on avatar image 
					mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
					/*$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
					$query4 ="INSERT INTO campana (nombre,descripcion,imagenes,idpersona,idEstado)VALUES ($nombre,$descripcion,'uploads/agencias/registered/$rsid/$campana/1.jpg',$id,0)";
					$results4 = $mysqli_query($mysqli,$query);*/
					echo "nueva";
					
				}
				else if ($a==2){// Create directory to save the file in case of Form Login and first change on avatar image 
					mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$correo/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");
					$query4 ="INSERT INTO campana (nombre,descripcion,imagenes,idpersona,idEstado)VALUES ($nombre,$descripcion,'uploads/agencias/registered/$rsid/$campana/1.jpg',$id,0)";
					$results4 = $mysqli_query($mysqli,$query);	
					echo "nueva";
				}	
		
	}
	else{
	echo "invalido";
	}
}

?>