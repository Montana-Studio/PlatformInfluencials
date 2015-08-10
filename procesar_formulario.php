<?php 
session_start();
$username =$_POST['nombre'];
$correo =$_POST['correo'];
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
//$password=MD5($_POST['pwd']);


//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","","plataforma") or die("Error " . mysqli_error($link)); 

//Consulto si existe el Base de Datos
//$query="UPDATE persona SET telefono1='$tel1', telefono2='$tel2' WHERE nombre='$username'AND correo='$correo' ";
$results = $mysqli->query("UPDATE persona SET telefono1='$tel1', telefono2='$tel2' WHERE nombre='$username'AND correo='$correo'");



?>