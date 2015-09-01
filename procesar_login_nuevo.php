<?php 
require('conexion.php');

$nuevousuario=$_POST['nuuser'];
$nuevocontraseña=MD5($_POST['nupass']);
$nuevoempresa=$_POST['nuempresa'];
$nuevocorreo=$_POST['nucorreo'];
$nuevotelefono1=$_POST['nutel1'];
$nuevotelefono2=$_POST['nutel2'];
$nuevaurl="/plataforma1.2/PlatformInfluencials/uploads/agencias/registered/$nuevocorreo/avatar.gif";


//Verifico que exista el correo en la base de datos
$query= "SELECT DISTINCT p.correo FROM persona AS p WHERE p.correo='$nuevocorreo'";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$num_row= mysqli_num_rows($result);

if($num_row>0){
echo 'false';
}else if(isset($_FILES["file"]["type"])){
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif")
		) && ($_FILES["file"]["size"] < 10000000)//Approx. 100000kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0){
		echo "error";
		}
		else{
			if (file_exists("uploads/$nuevocorreo/test/" . $_FILES["file"]["name"])) {
			echo 'existe';
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
			echo 'nuevo';
			}
		}
	}
	else
	{
	echo "invalido";
	}
}


?>