<?php

require('../conexion.php');

if($_POST['tipo'] == "activar_rs"){
	$id = (int)$_POST['id'];
	if($_POST['estado'] == 1) $estado =0;
	else $estado = 1;
	$actualiza= $mysqli->query("UPDATE rrss SET id_estado='$estado' WHERE rrss_id='$id'");
	//echo $idRS;
	echo "UPDATE rrss SET id_estado=".$estado." WHERE id=".$id;
}



?>