<?php
require('../../conexion.php');
$googlePlusId = $_POST['googlePlusId'];
$id_persona = $_SESSION['id'];

$results1 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='$googlePlusId' AND descripcion_rrss='googleplus'");
$num_row1=mysqli_num_rows($results1);

if($num_row1 < 1){
	$results2 = $mysqli->query("INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id) VALUES ('googleplus','$googlePlusId','$id_persona')");
	echo 'exito';
}
else{
	$results2 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='$googlePlusId' AND descripcion_rrss='googleplus' AND persona_id='$id_persona'");
	$num_row2=mysqli_num_rows($results2);
	if($num_row2>0)echo 'existe';
	else echo 'otro';
}
?>