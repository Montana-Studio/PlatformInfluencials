<?php 
require('conexion.php');
$username =$_POST['nombre'];
$correo =$_POST['correo'];
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$empresa=$_POST['empresa'];
//$password=MD5($_POST['pwd']);
$results = $mysqli->query("UPDATE persona SET telefono1='$tel1', telefono2='$tel2', empresa='$empresa' WHERE nombre='$username'AND correo='$correo'");
?>