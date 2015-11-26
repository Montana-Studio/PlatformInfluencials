<?php
require('conexion.php');

$agencia = $_POST['agencia'];
$correo_agencia = $_POST['correo_agencia'];
$influenciador = $_POST['influenciador'];
$influenciador_id = $_POST['influenciador_id'];
$campana = $_POST['campana'];

//echo $agencia.$correo_agencia.$influenciador.$influenciador_id;




$consulta = 'SELECT correo FROM persona WHERE id='.$influenciador_id;
$result= mysqli_query($mysqli,$consulta)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);



// Envio a correo powerinfluencer
$asunto = "Petición de contacto - Power Influencer";
$mensaje = "La agencia : ".$agencia." quiere contactar a : ".$influenciador;
mail('elperoy@gmail.com', $asunto , $mensaje, null, '-f'.$correo_agencia.'');




$results = $mysqli->query("INSERT INTO solicitudes (agencia, correo_agencia,influenciador , correo_influenciador, fecha_solicitud, campana )VALUES ('$agencia', '$correo_agencia','$influenciador', '$row[0]', '$hoy' , '$campana' )");



  


?>