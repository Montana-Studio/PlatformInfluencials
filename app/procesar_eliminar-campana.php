<?php 
require('conexion.php');

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
	$idEstado = $_POST['idEstado'];
	$actualiza= $mysqli->query("UPDATE campana SET idEstado='$idEstado' WHERE id='$idActualizar'");
}

if($_POST['tipo'] == "activar_rs"){
	$idTwitter = $_POST['idRs'];
	if($_POST['idEstado'] == 1) $idEstado =0;
	else $idEstado = 1;
	$actualiza= $mysqli->query("UPDATE rrss SET id_estado='$idEstado' WHERE id='$idTwitter'");
}


?>