<?php 

require('conexion.php');
$id=$_POST['id'];
$campana=$_POST['campana'];
$correo=$_POST['correo'];
$rsid=$_POST['rsid'];

//Consultas a la BD
$rrs= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND id=$id");
$num_row=mysqli_num_rows($rrs);

$rf=$mysqli->query("SELECT * FROM persona WHERE RS_id='' AND id=$id");
$num_row2=mysqli_num_rows($rf);

	if ($num_row>0){
		//$pictureUrl="uploads/agencias/registered/$id/$campana/1.jpg";
		$a=1;//registrado con RS
		$row= mysqli_fetch_array($rrs, MYSQLI_NUM);
	}

	if($num_row2>0){
		//$nuevaurl="uploads/agencias/registered/$correo/$campana/1.jpg";
		$a=2; //registrado con formulario
		$row= mysqli_fetch_array($rf, MYSQLI_NUM);
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
					mkdir("uploads/agencias/registered/$rsid/$campana", 0777, true);
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "uploads/agencias/registered/$rsid/$campana/".$_FILES['file']['name']; // Target path where file is to be stored
					$file= $_FILES['file']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					rename("uploads/agencias/registered/$rsid/$campana/$file", "uploads/agencias/registered/$rsid/$campana/1.jpg");
					$results2 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona,idestado) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$rsid/$campana/1.jpg','$marca',$id,0)");
					echo "nueva-campana";
				}
			else if ($a==2){// Create directory to save the file in case of Form Login
						mkdir("uploads/agencias/registered/$correo/$campana", 0777, true);
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
						$file= $_FILES['file']['name'];
						unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						rename("uploads/agencias/registered/$correo/$campana/$file", "uploads/agencias/registered/$correo/$campana/1.jpg");		
						$results2 = $mysqli->query("INSERT INTO campana (nombre,descripcion,imagenes,marca,idpersona,idestado) VALUES ('$nombre','$descripcion','uploads/agencias/registered/$correo/$campana/1.jpg','$marca',$id,0)");
						echo "nueva-campaña";
			}	
		}
	}else{
		echo "invalido";
	}
}
?>