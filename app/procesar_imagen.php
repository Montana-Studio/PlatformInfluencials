<?php 
 require('conexion.php');

$rsid=$_POST['rsid'];
$correo=$_POST['correo'];
$nombre =$_POST['nombre'];
$correo =$_POST['correo'];
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$empresa= $_POST['empresa'];
$picture_url=$_POST['picture_url'];
$a=0;


//Consultas a la BD
$rrs= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND RS_id='$rsid'");
$num_row=mysqli_num_rows($rrs);

$rf=$mysqli->query("SELECT * FROM persona WHERE RS_id='' AND correo='$correo'");
$num_row2=mysqli_num_rows($rf);

/*

if ($num_row>0){
$nuevaurl="/plataforma1.2/PlatformInfluencials/uploads/agencias/registered/$rsid/avatar.gif";
$a=1;//registrado con RS

$row= mysqli_fetch_array($rrs, MYSQLI_NUM);
}


if($num_row2>0){
$nuevaurl="/plataforma1.2/PlatformInfluencials/uploads/agencias/registered/$correo/avatar.gif";
$a=2; //registrado con formulario
$row= mysqli_fetch_array($rf, MYSQLI_NUM);
}*/

if(isset($_FILES["file"]["type"]))
{	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);

	if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif")
	) && ($_FILES["file"]["size"] < 100000)//Approx. 100000kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
	
		if ($_FILES["file"]["error"] > 0){
		echo "error";
		}
		else{
			
			//Caso exitoso
			if ($a==1){ //organizacion de directorio para RS
				if (file_exists(uploads/agencias/registered/$rsid)){ // cambio a partir de segunda vez con RS
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				unlink("uploads/agencias/registered/$rsid/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
				//$mysqli->set_charset('utf8');
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
				else{//primer cambio con RS
				mkdir("uploads/agencias/registered/$rsid", 0777, true);
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
				//$mysqli->set_charset('utf8');
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
			else if ($a==2){//organizacion de directorio para usuario por formulario
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
				$file= $_FILES['file']['name'];
				unlink("uploads/agencias/registered/$correo/avatar.gif");
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
				$mysqli->set_charset('utf8');
				$actualiza = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE correo='$correo'");			
				//$mysqli->set_charset('utf8');
				$actualizaLogin = $mysqli->query("UPDATE login SET user='$nombre' WHERE correo='$correo'");			 
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
else{
$results2 = $mysqli->query("UPDATE persona SET nombre='$nombre', telefono1='$tel1', telefono2='$tel2', empresa='$empresa', correo='$correo', picture_url='uploads/agencias/registered/$rsid/avatar.gif' WHERE RS_id='$rsid'");
				$_SESSION['id']=$row[0];
				$_SESSION['nombre']=$nombre;
				$_SESSION['correo']=$correo;
				$_SESSION['telefono1']=$tel1;
				$_SESSION['telefono2']=$tel2;
				$_SESSION['empresa']=$empresa;
				$_SESSION['rsid']=$rsid;
				$_SESSION['pictureUrl']="uploads/agencias/registered/$rsid/avatar.gif";	

}
?>
