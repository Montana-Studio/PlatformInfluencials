<?php
require('../controller/conexion.php');

if($_POST['tipo'] == "activar_rs"){
	$id_activar_rs = $_POST['id_activar_rs'];
	if($_POST['estado'] == 1) {
		$estado =0;
		echo "cuenta desactivada";}
	else {
		$estado = 1;
		echo "cuenta activa";
	}
	$actualiza= $mysqli->query("UPDATE rrss SET id_estado='$estado' WHERE rrss_id='$id_activar_rs'");
	//echo "UPDATE rrss SET id_estado=".$estado." WHERE id=".$id_activar_rs;
}

/*
if($_POST['tipo'] == "activar_rs2"){
	$id_activar_rs = $_POST['id_activar_rs'];
	if($_POST['estado'] == 1) {
		$estado =0;
		echo "cuenta desactivada";}
	else {
		$estado = 1;
		echo "cuenta activa";
	}
	$actualiza= $mysqli->query("UPDATE rrss SET id_estado='$estado' WHERE analytics_page='$id_activar_rs'");
	$actualiza= $mysqli->query("UPDATE Analytics SET id_estado='$estado' WHERE profile_id='$id_activar_rs'");
	//echo "UPDATE rrss SET id_estado=".$estado." WHERE id=".$id_activar_rs;
}*/

if($_POST['tipo'] == "desactivar"){
	$id_eliminar_rs = $_POST['id_rrss'];
	$actualiza= $mysqli->query("UPDATE rrss SET cuenta='0' WHERE id='$id_eliminar_rs'");
	//$actualiza= $mysqli->query("UPDATE Analytics SET id_estado='$estado' WHERE profile_id='$id_activar_rs'");
	//echo "UPDATE rrss SET id_estado=".$estado." WHERE id=".$id_activar_rs;
}





?>	