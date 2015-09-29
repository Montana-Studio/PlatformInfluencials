<?php 
require('conexion.php');
$id=$_POST['id'];
$campana=$_POST['campana'];
$correo=$_POST['correo'];
$rsid=$_POST['rsid'];

if (strlen($_SESSION['rsid'])>2){
$a=1;
}else{
	$a=2;
}

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
			if ($a==1){ // Create directory to save the file in case of Social Login
				if (file_exists("uploads/agencias/registered/$rsid/$campana/1.jpg")){ 
				unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
			}
			}
			else if ($a==2){// Create directory to save the file in case of Form Login
				if (file_exists("uploads/agencias/registered/$correo/$campana/1.jpg")){ 
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");		 
				echo "nuevo";
				}
			}	
		}
	}else{
	echo "invalido";
	}
	
}

?>
