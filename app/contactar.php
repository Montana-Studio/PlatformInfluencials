<?php
require('conexion.php');
if($_POST['tipo']=='perfil_publico'){

	$agencia = $_SESSION['nombre'];
	$correo_agencia = $_SESSION['correo'];
	$influenciador = $_POST['influenciador_nombre'];
	$influenciador_id = $_POST['influenciador_id'];
	$id_campana = $_POST['id_campana'];
	$id_agencia = $_SESSION['id'];
	$query_correo_influenciador='SELECT correo FROM persona WHERE id="'.$influenciador_id.'"';
    $result_correo_influenciador=mysqli_query($mysqli,$query_correo_influenciador)or die (mysqli_error($mysqli));
    $row_correo_influenciador= mysqli_fetch_array($result_correo_influenciador, MYSQLI_BOTH);
    $num_row_correo_influenciador=mysqli_num_rows($result_correo_influenciador);
    $correo_influenciador=$row_correo_influenciador[0];
    $query_nombre_influenciador='SELECT * FROM persona WHERE id="'.$influenciador_id.'"';
    $result_nombre_influenciador=mysqli_query($mysqli,$query_nombre_influenciador)or die (mysqli_error($mysqli));
    $row_nombre_influenciador= mysqli_fetch_array($result_nombre_influenciador, MYSQLI_BOTH);
    $num_row_nombre_influenciador=mysqli_num_rows($result_nombre_influenciador);
    if($num_row_nombre_influenciador>0){
    	if($id_campana=='sin_especificar'){
			$campana=$id_campana;
			$id_campana="0";
			$asunto = "Petición de contacto - Power Influencer";
			$mensaje = "La agencia : ".$agencia." quiere contactar a : ".$influenciador;
			mail('elperoy@gmail.com', $asunto , $mensaje, null, '-f'.$correo_agencia.'');
			$results = $mysqli->query("INSERT INTO solicitudes (agencia, correo_agencia, influenciador , correo_influenciador, id_influenciador, id_agencia, fecha_solicitud, id_campana, campana )VALUES ('$agencia', '$correo_agencia','$influenciador', '$correo_influenciador', '$influenciador_id', '$id_agencia', '$hoy' , '$id_campana', '$campana' )");
			echo 'exito';
		}else{
			$query_nombre_campana='SELECT * FROM campana WHERE id="'.$id_campana.'"';
		    $result_nombre_campana=mysqli_query($mysqli,$query_nombre_campana)or die (mysqli_error($mysqli));
		    $row_nombre_campana= mysqli_fetch_array($result_nombre_campana, MYSQLI_BOTH);
		    $num_row_nombre_campana=mysqli_num_rows($result_nombre_campana);
		    if($num_row_nombre_campana>0){
				$asunto = "Petición de contacto - Power Influencer";
				$mensaje = "La agencia : ".$agencia." quiere contactar a : ".$influenciador;
				mail('elperoy@gmail.com', $asunto , $mensaje, null, '-f'.$correo_agencia.'');
				$results = $mysqli->query("INSERT INTO solicitudes (agencia, correo_agencia, influenciador , correo_influenciador, id_influenciador, id_agencia, fecha_solicitud, id_campana, campana )VALUES ('$agencia', '$correo_agencia','$influenciador', '$correo_influenciador', '$influenciador_id', '$id_agencia', '$hoy' , '$id_campana', '$campana' )");
				echo 'exito';
		    }else{
		    	echo 'false';
		    }
		}
    }else{
    	echo 'false';
    }

	
}else{
	$agencia = $_POST['agencia'];
	$correo_agencia = $_POST['correo_agencia'];
	$influenciador = $_POST['influenciador'];
	$influenciador_id = $_POST['influenciador_id'];
	$campana = $_POST['campana'];
	$id_campana = $_POST['id_campana'];
	$id_agencia = $_SESSION['id'];
	$query_correo_influenciador='SELECT correo FROM persona WHERE id="'.$influenciador_id.'"';
    $result_correo_influenciador=mysqli_query($mysqli,$query_correo_influenciador)or die (mysqli_error($mysqli));
    $row_correo_influenciador= mysqli_fetch_array($result_correo_influenciador, MYSQLI_BOTH);
    $num_row_correo_influenciador=mysqli_num_rows($result_correo_influenciador);
    $correo_influenciador=$row_correo_influenciador[0];
    $query_nombre_influenciador='SELECT * FROM persona WHERE id="'.$influenciador_id.'"';
    $result_nombre_influenciador=mysqli_query($mysqli,$query_nombre_influenciador)or die (mysqli_error($mysqli));
    $row_nombre_influenciador= mysqli_fetch_array($result_nombre_influenciador, MYSQLI_BOTH);
    $num_row_nombre_influenciador=mysqli_num_rows($result_nombre_influenciador);
    if($num_row_nombre_influenciador>0){
		if($id_campana=='sin_especificar'){
			$campana=$id_campana;
			$id_campana="0";
			$asunto = "Petición de contacto - Power Influencer";
			$mensaje = "La agencia : ".$agencia." quiere contactar a : ".$influenciador;
			mail('elperoy@gmail.com', $asunto , $mensaje, null, '-f'.$correo_agencia.'');
			$results = $mysqli->query("INSERT INTO solicitudes (agencia, correo_agencia, influenciador , correo_influenciador, id_influenciador, id_agencia, fecha_solicitud, id_campana, campana )VALUES ('$agencia', '$correo_agencia','$influenciador', '$correo_influenciador', '$influenciador_id', '$id_agencia', '$hoy' , '$id_campana', '$campana' )");
			echo 'exito';
		}else{
			/*$campana_seleccionada_id
			//echo $agencia.$correo_agencia.$influenciador.$influenciador_id;$consulta = 'SELECT * FROM persona WHERE id='.$influenciador_id;
			$result= mysqli_query($mysqli,$consulta)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);*/
			// Envio a correo powerinfluencer
			$asunto = "Petición de contacto - Power Influencer";
			$mensaje = "La agencia : ".$agencia." quiere contactar a : ".$influenciador;
			mail('elperoy@gmail.com', $asunto , $mensaje, null, '-f'.$correo_agencia.'');
			$results = $mysqli->query("INSERT INTO solicitudes (agencia, correo_agencia, influenciador , correo_influenciador, id_influenciador, id_agencia, fecha_solicitud, id_campana, campana )VALUES ('$agencia', '$correo_agencia','$influenciador', '$correo_influenciador', '$influenciador_id', '$id_agencia', '$hoy' , '$id_campana', '$campana' )");
		}
	}else{
		echo 'false';
	}
	
	
}

  


?>