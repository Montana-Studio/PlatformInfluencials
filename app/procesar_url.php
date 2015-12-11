<?php
require('conexion.php');
$rrss_id = $_POST['rrss_id'];
$campana_id = $_POST['campana_id'];
$url = $_POST['url'];
$descripcion_rrss = $_POST['descripcion_rrss'];
$result_url = $mysqli->query("SELECT DISTINCT * FROM campanarrss WHERE url='$url'");
//$row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
$num_rows_url= mysqli_num_rows($result_url);
if(strlen($url)>0){
	if($num_rows_url>0){
	$resultado="ingresada";
	}else{
	$result_url = $mysqli->query("INSERT INTO campanarrss SET campana_id='$campana_id', rrss_id='$rrss_id', url='$url', descripcion_rrss='$descripcion_rrss'");
	$resultado = "nuevo";	
	}
	
}


echo $resultado;

?>
