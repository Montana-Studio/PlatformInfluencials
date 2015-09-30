<?php 
require('conexion.php');

if (strlen($_SESSION['rsid'])>2){
$a=1;
}else{
	$a=2;
}

if($_POST['tipo'] == "eliminar"){
	$idEliminar=$_POST['idEliminar'];
	$rrs= $mysqli->query("DELETE FROM campana WHERE id='$idEliminar'");
	$campana=$idEliminar;
	if($a==1){
		$rsid = $_SESSION['rsid'];
		unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
	}
	
	if($a == 2){
		$correo= $_SESSION['correo'];
		unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
	}

}


echo $_POST['tipo'];


if($_POST['tipo'] == "activar"){
	$idActualizar = $_POST['idActualizar'];
	$idEstado = $_POST['idEstado'];
	$actualiza= $mysqli->query("UPDATE campana SET idEstado='$idEstado' WHERE id='$idActualizar'");

}

?>
