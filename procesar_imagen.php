<?php 
//session_start();

$rsid=$_POST['rsid'];
$correo=$_POST['correo'];
$a=0;



//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","","plataforma") or die("Error " . mysqli_error($link)); 
$rrs= $mysqli->query("SELECT * FROM persona WHERE RS_id!='' AND RS_id='$rsid'");
$num_row=mysqli_num_rows($rrs);

$rf=$mysqli->query("SELECT * FROM persona WHERE RS_id='' AND correo='$correo'");
$num_row2=mysqli_num_rows($rf);


if ($num_row>0){
$nuevaurl="/plataforma1.2/PlatformInfluencials/uploads/agencias/registered/$rsid/avatar.gif";
$a=1;//registrado con RS
}

if($num_row2>0){
$nuevaurl="/plataforma1.2/PlatformInfluencials/uploads/agencias/registered/$correo/avatar.gif";
$a=2; //registrado con formulario

}

if(isset($_FILES["file"]["type"]))
{
$validextensions = array("gif", "jpg", "PNG");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/PNG") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/gif")
) && ($_FILES["file"]["size"] < 100000)//Approx. 100000kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {

if ($_FILES["file"]["error"] > 0)
{

echo "error";
}
else
{

//Caso exitoso
if ($a<2){ //organizacion de directorio para RS
if (!file_exists(uploads/agencias/registered/$rsid)){
mkdir("uploads/agencias/registered/$rsid", 0777, true);
}else{

$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "uploads/agencias/registered/$rsid/".$_FILES['file']['name']; // Target path where file is to be stored
$file= $_FILES['file']['name'];
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
rename("uploads/agencias/registered/$rsid/$file", "uploads/agencias/registered/$rsid/avatar.gif");
$results2 = $mysqli->query("INSERT INTO persona (picture_url ) VALUES ('$nuevaurl')");
echo 'nuevo';
}}else if (a>1){//organizacion de directorio para usuario por formulario

$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "uploads/agencias/registered/$correo/".$_FILES['file']['name']; // Target path where file is to be stored
$file= $_FILES['file']['name'];
unlink("uploads/agencias/registered/$correo/*.*");
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
rename("uploads/agencias/registered/$correo/$file", "uploads/agencias/registered/$correo/avatar.gif");
$results2 = $mysqli->query("UPDATE persona SET picture_url='$nuevaurl' WHERE persona.correo='$correo'");
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
