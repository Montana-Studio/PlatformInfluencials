<?php
require('../conexion.php');
$nombre=$_POST['nombre'];
$correo=$_POST['correo'];
$perfil=$_POST['perfil'];
$results = $mysqli->query('INSERT INTO newsletter (nombre, correo, tipo)VALUES ("'.$nombre.'", "'.$correo.'","'.$perfil.'")');
?>