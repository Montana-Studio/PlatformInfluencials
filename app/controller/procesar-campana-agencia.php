<?php 
require('../controller/conexion.php');
$nombre =$_POST['nombre'];
$marca =$_POST['marca'];
$descripcion =$_POST['descripcion'];
$id =$_POST['id'];
$idpersona =$_POST['idpersona'];
$sql = "UPDATE campana SET nombre='$nombre', marca='$marca', descripcion='$descripcion' WHERE idpersona='$idpersona' AND id='$id'";
$update = $mysqli->query($sql);
echo "actualizado";
?>
