<?php 
require('../controller/conexion.php');
$perfil= $_POST['perfil'];
$region= $_POST['region']; 
$comuna= $_POST['comuna'];
$id=$_SESSION['id'];

//if(strlen($perfil)>0&&strlen($region)>0&&strlen($comuna)>0){
	
if($perfil=='3'){
	$descripcion_tipo='influenciador';
}else if($perfil=='4'){
	$descripcion_tipo='publicador';
}else if($perfil=='5'){
	$descripcion_tipo='editor';
}

$results2 = $mysqli->query('UPDATE persona SET id_tipo="'.$perfil.'", descripcion_tipo="'.$descripcion_tipo.'", region="'.$region.'", comuna="'.$comuna.'", estado_formulario=1 WHERE id="'.$id.'"');
$resultado = 'actualizado';
echo $resultado;

unset($perfil);
unset($region);
unset($comuna);
unset($id);
unset($descripcion_tipo);
unset($results2);

 ?>