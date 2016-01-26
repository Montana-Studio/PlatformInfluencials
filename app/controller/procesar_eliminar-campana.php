<?php 
require('../controller/conexion.php');

/************************************************************************************
*************************************************************************************
***************************PROCESAMIENTO DE CAMPAÑAS ********************************
*************************************************************************************
*************************************************************************************/
function deleteDir($dir){
	$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
	$files = new RecursiveIteratorIterator($it,
	             RecursiveIteratorIterator::CHILD_FIRST);
	foreach($files as $file) {
	    if ($file->isDir()){
	        rmdir($file->getRealPath());
	    } else {
	        unlink($file->getRealPath());
	    }
	}
	rmdir($dir);
}

if (strlen($_SESSION['rsid'])>2){
$a=1;
}else{
	$a=2;
}
if($_POST['tipo'] == "eliminar"){
	$idEliminar=$_POST['idEliminar'];
	$rrs= $mysqli->query("DELETE FROM campana WHERE id=$idEliminar");
	$campana=$idEliminar;
	if($a==1){
		$rsid = $_SESSION['rsid'];
		$dir = "uploads/agencias/registered/$rsid/$idEliminar/";
		deleteDir($dir);
	}
	
	if($a == 2){
		$correo= $_SESSION['correo'];
		$dir = "uploads/agencias/registered/$correo/$idEliminar/";
		deleteDir($dir);
	}
}

echo $_POST['tipo'];
if($_POST['tipo'] == "activar"){
	$idActualizar = $_POST['idActualizar'];
	if($_POST['idEstado'] == 1){
		$idEstado =0;
		$actualiza= $mysqli->query("UPDATE campana SET idEstado='$idEstado' , fecha_inicio= '' WHERE id='$idActualizar'");
	}
	else{
		$idEstado = 1;
		$actualiza= $mysqli->query("UPDATE campana SET idEstado='$idEstado' , fecha_inicio= '$hoyFormatted' , fecha_inicio_server=date(now()) WHERE id='$idActualizar'");
	} 
	
	
}

?>