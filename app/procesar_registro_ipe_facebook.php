<?php 
 require('conexion.php');
$perfil= $_POST['perfil'];
$region= $_POST['region']; 
$comuna= $_POST['comuna'];
$id=$_SESSION['id'];

if(strlen($perfil)>0&&strlen($perfil)>0&&strlen($perfil)>0){
	
	if($perfil==3){
	$descripcion_tipo='influenciador';
	}else if($perfil==4){
	$descripcion_tipo='publicador';
	}else if($perfil==5){
	$descripcion_tipo='editor';
	}
	$results2 = $mysqli->query("UPDATE persona SET id_tipo='$perfil', descripcion_tipo='$descripcion_tipo', region='$region', comuna='$comuna' WHERE id='$id'");
	$resultado = 'actualizado';
}else{
	$resultado = 'false';
}

echo $resultado;
 ?>