<?php 
require('conexion.php');
$id=$_POST['id'];
//Consultas a la BD
$rrs= $mysqli->query("DELETE FROM campana WHERE id='$id'");
?>
