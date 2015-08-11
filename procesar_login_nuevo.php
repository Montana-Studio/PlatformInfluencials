<?php 
session_start();

$nuevousuario=$_POST['nuuser'];
$nuevocontraseña=$_POST['nupass'];
$nuevoempresa=$_POST['nuempresa'];
$nuevocorreo=$_POST['nucorreo'];
$nuevotelefono1=$_POST['nutel1'];
$nuevotelefono2=$_POST['nutel2'];

//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","","plataforma") or die("Error " . mysqli_error($link)); 

//Verifico que exista el correo en la base de datos
$query= "SELECT DISTINCT p.correo FROM persona AS p, login AS l WHERE p.correo=l.correo AND p.correo='$nuevocorreo'";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$num_row= mysqli_num_rows($result);

if($num_row>0){
echo 'false';
}else{
$results1 = $mysqli->query("INSERT INTO login (user, pass, correo) VALUES ('$nuevousuario','$nuevocontraseña','$nuevocorreo')");
$results2 = $mysqli->query("INSERT INTO persona (nombre, correo, empresa, telefono1, telefono2, id_login, id_tipo ) VALUES ('$nuevousuario','$nuevocorreo','$nuevoempresa','$nuevotelefono1','$nuevotelefono2', (SELECT id from login WHERE correo='$nuevocorreo'),'2')");
echo 'nuevo';
}

?>