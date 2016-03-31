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
	//echo $actualiza;

	/*
	//identificar red social asociada
	$query_identifica_red_social="SELECT DISTINCT * FROM rrss WHERE rrss_id='".$id_activar_rs."'";
	$result_identifica_red_social=mysqli_query($mysqli,$query_identifica_red_social)or die (mysqli_error());
	$row_identifica_red_social= mysqli_fetch_array($result_identifica_red_social, MYSQLI_BOTH);
	$persona_id= $row_identifica_red_social[4];
	$red_social= $row_identifica_red_social[2];
	$red_social_id= $row_identifica_red_social[3];
	$estado_antiguo=$row_identifica_red_social[5];
	$texto_base_onoffswitch= "<input type='checkbox' name='".$estado_antiguo."' class='btndesactivar estado_rs switch-checkbox' id='".$red_social_id."'>";
	$texto_nuevo_onoffswitch="<input type='checkbox' name='".$estado."' class='btndesactivar estado_rs switch-checkbox' id='".$red_social_id."'>";


	$query_inserta_datos="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."'";
	$result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
	$row_inserta_datos= mysqli_fetch_array($result_inserta_datos, MYSQLI_BOTH);

	do{
		$newphrase = str_replace($texto_base_onoffswitch, $texto_nuevo_onoffswitch, $row_inserta_datos[8]);
	}while($row_inserta_datos = mysqli_fetch_array($result_inserta_datos));


	
	return htmlspecialchars_decode($row_inserta_datos['sesion_texto'])

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
}


if($_POST['tipo'] == "desactivar"){

	$id_eliminar_rs = $_POST['id_rrss'];
	$actualiza= $mysqli->query("UPDATE rrss SET cuenta='0' WHERE id='$id_eliminar_rs'");
	
	//$actualiza= $mysqli->query("UPDATE Analytics SET id_estado='$estado' WHERE profile_id='$id_activar_rs'");
	//echo "UPDATE rrss SET id_estado=".$estado." WHERE id=".$id_activar_rs;
}





?>	