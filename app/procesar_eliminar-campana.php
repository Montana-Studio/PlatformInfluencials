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
		
		//unlink("uploads/agencias/registered/$rsid/$campana/1.jpg");
		//rmdir("uploads/agencias/registered/$correo/$campana");
	}
	
	if($a == 2){
		$correo= $_SESSION['correo'];
		//unlink("uploads/agencias/registered/$correo/$campana/1.jpg");
		//rmdir("uploads/agencias/registered/$correo/$campana");
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
?>