<?php 
require('conexion.php');

if (isset($_POST['tipo'])){
$username =$_POST['nombre'];
$correo =$_POST['correo'];
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$empresa=$_POST['empresa'];
$tipo = $_SESSION['id_tipo'];
//$password=MD5($_POST['pwd']);
$results = $mysqli->query("UPDATE persona SET telefono1='$tel1', telefono2='$tel2', empresa='$empresa', id_tipo='$tipo' WHERE correo='$correo'");
}else{
$username =$_POST['nombre'];
$correo =$_POST['correo'];
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$empresa=$_POST['empresa'];
//echo $correo.$username.$tel1.$tel2.$empresa;
//$password=MD5($_POST['pwd']);
$results = $mysqli->query("UPDATE persona SET nombre='$username', telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE  correo='$correo'");
$results2 = $mysqli->query("UPDATE login SET user='$username'");
}
?>