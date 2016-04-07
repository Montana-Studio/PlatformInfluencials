<?php
require('../../controller/conexion.php');

$instagramId =$_POST['instagramId'];
$accessToken = $_POST['accessToken'];
$id_persona = $_SESSION['id'];
$json_user_url ="https://api.instagram.com/v1/users/".$instagramId."?access_token=".$accessToken;
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers_instagram = $links_user_url->data->counts->followed_by;

$query_existe_otro_perfil="SELECT rrss_id FROM rrss WHERE rrss_id=".$instagramId." AND descripcion_rrss='instagram'";
$results_existe_otro_prefil = $mysqli->query($query_existe_otro_perfil);
$num_row_existe_otro_perfil=mysqli_num_rows($results_existe_otro_prefil);

if(intval($num_row_existe_otro_perfil) > 1){
	echo 'existe';
}else{
	$query="SELECT rrss_id FROM rrss WHERE rrss_id=".$instagramId." AND persona_id=".$_SESSION['id']."  AND descripcion_rrss='instagram'";
	$results1 = $mysqli->query($query);
	$num_row1=mysqli_num_rows($results1);
	if(intval($num_row1) < 1){
	  $query2="INSERT INTO rrss (rrss,descripcion_rrss,rrss_id,persona_id,access_token,cuenta) VALUES ('$nombre','instagram','$instagramId','$id_persona','$accessToken','1')";
		$results2 = $mysqli->query($query2);
		echo 'exito';
	}else{
		$results2 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='$instagramId' AND descripcion_rrss='instagram' AND persona_id='$id_persona'");
		$num_row2=mysqli_num_rows($results2);
		if($num_row2>0)echo 'existe';
		else echo 'otro';
	}

}




?>