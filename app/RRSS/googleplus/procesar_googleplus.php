<?php

require('../../conexion.php');
$googlePlusId = $_POST['googlePlusId'];
$id_persona = $_SESSION['id'];

$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$googlePlusId' AND descripcion_rrss='googleplus'");
$num_row1=mysqli_num_rows($results1);

if($num_row1 < 1){
	$results2 = $mysqli->query("INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id) VALUES ('googleplus','$googlePlusId','$id_persona')");
}



?>