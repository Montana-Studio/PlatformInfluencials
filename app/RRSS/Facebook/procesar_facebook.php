<?php

require('../../conexion.php');
$facebook_page_id = $_POST['facebook_page_id'];
$id_persona = $_SESSION['id'];

$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$facebook_page_id' AND descripcion_rrss='facebook'");
$num_row1=mysqli_num_rows($results1);

if($num_row1 < 1){
	$results2 = $mysqli->query("INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id) VALUES ('facebook','$facebook_page_id','$id_persona')");
}



?>