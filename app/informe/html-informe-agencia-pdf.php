<?php require("../controller/master_key.php") ;?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="theme-color" content="#2c327c">
		<title></title>
	</head>
	<body>
	<?php
	
    $mysqli = mysqli_connect(LOCAL,USER,PASS,BD) or die("Error " . mysqli_error($link)); 
	$mysqli->set_charset('utf8_bin');
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	//$query_datos_campana = "SELECT DISTINCT *  FROM campana WHERE id='".$_GET['id']."'";
	$query_datos_campana = "SELECT DISTINCT *  FROM campana WHERE id='".$_GET['id']."'";
	$result_datos_campana=mysqli_query($mysqli,$query_datos_campana)or die (mysqli_error());
	$row_datos_campana= mysqli_fetch_array($result_datos_campana, MYSQLI_BOTH);
	$num_row_datos_campana=mysqli_num_rows($result_datos_campana);


	function red_social($descripcion_rrss,$campana,$nombre,$cuenta,$url,$likes,$comments,$shares,$followers,$favorites,$retweets,$reproducciones,$reach){
		$tituloPaginas="Metricas para ".$descripcion_rrss." - Campaña : ".$campana;

			if($descripcion_rrss=='facebook'){

					$html_facebook.='<div>';
					//$html_facebook.='<p>'.$nombre;
					$html_facebook.='<p>'.$cuenta.'</p>';
					$html_facebook.='<p>'.$url.'</p>';
					$html_facebook.='<p>	Likes:'.$likes;
					$html_facebook.='	Comments:'.$comments;
					$html_facebook.='	Shares:'.$shares;
					$html_facebook.='	Followers:'.$followers.'<p>';
					$html_facebook.='<p><b>Reach'.number_format($reach,3).'</b></p>';
					$html_facebook.='</div>';
			}

			if($descripcion_rrss=='instagram'){
					$html_instagram.='<div>';
					//$html_instagram.='<p>'.$nombre;
					$html_instagram.='<p>'.$cuenta.'</p>';
					$html_instagram.='<p>'.$url.'</p>';
					$html_instagram.='<p>Likes:'.$likes;
					$html_instagram.='	Comments:'.$comments;
					$html_instagram.='	Shares:'.$shares;
					$html_instagram.='	Followers:'.$followers.'<p>';
					$html_instagram.='<p><b>Reach'.number_format($reach,3).'</b></p>';
					$html_instagram.='</div>';
			}

			if($descripcion_rrss=='twitter'){

					$html_twitter.='<div>';
					//$html_twitter.='<p>'.$nombre;
					$html_twitter.='<p>'.$cuenta.'</p>';
					$html_twitter.='<p>'.$url.'</p>';
					$html_twitter.='<p>Favorites:'.$favorites;
					$html_twitter.='	Retweets:'.$retweets;
					$html_twitter.='	Followers:'.$followers.'<p>';
					$html_twitter.='<p><b>Reach'.number_format($reach,3).'</b></p>';
					$html_twitter.='</div>';
			}

			if($descripcion_rrss=='youtube'){

					$html_youtube.='<div>';
					//$html_youtube.='<p>'.$nombre;
					$html_youtube.='<p>'.$cuenta.'</p>';
					$html_youtube.='<p>'.$url.'</p>';
					$html_youtube.='<p>Reproducciones:'.$reproducciones;
					$html_youtube.='<p><b>Reach'.number_format($reach,3).'</b></p>';
					$html_youtube.='</div>';
			}
				$reach_total+=$reach;
			return array($html_facebook,$html_instagram,$html_twitter,$html_youtube,$reach_total);	
	}

	function reconoce_red_social($descripcion_rrss, $rrss_array){
			$largo_array=count($rrss_array);
			$contador=0;
			for($i=0;$i<=$largo_array;$i++){
				if($descripcion_rrss==$rrss_array[$i]){
					$contador++;
				}
			}
			return $contador++;
			
		}



		$suma_reach=0;
		$suma_reproducciones=0;
		$reach_facebook=0;
		$reach_instagram=0;
		$reach_twitter=0;
		$reproducciones_youtube=0;
		$fecha_inicio = date("d-m-Y", strtotime($row_datos_campana[9]));
		$fecha_termino= date("d-m-Y", strtotime($row_datos_campana[10]));
		$html_inicio='	<h2>Informe de Campaña:'.$row_datos_campana[2].'</h2>
						<img src="../'.$row_datos_campana[3].'" width="480" height="300">
						<div class="reach-campana">';
		$html_final='</div>';
		$fb_title='<h3>FACEBOOK</h3>';
		$in_title='<h3>INSTAGRAM</h3>';
		$tw_title='<h3>TWITTER</h3>';
		$yo_title='<h3>YOUTUBE</h3>';
		$query_campana="SELECT * FROM  `campana` WHERE id='".$_GET['id']."'";
		$result_campana=mysqli_query($mysqli,$query_campana)or die (mysqli_error());
		$row_campana= mysqli_fetch_array($result_campana, MYSQLI_BOTH);
		

		$html_presentacion_campana='';

		$query_urls="SELECT * FROM  `core_redes_sociales_campanas` WHERE campana_id='".$_GET['id']."' ORDER BY persona_id,url";
		$result_urls=mysqli_query($mysqli,$query_urls)or die (mysqli_error());
		$row_urls= mysqli_fetch_array($result_urls, MYSQLI_BOTH);

		
		$redes_sociales=$row_datos_campana[11];
		$rrss=explode(',', $redes_sociales);

		
		while($row_urls=mysqli_fetch_array($result_urls)){
			$query_rrss="SELECT * FROM  `campanarrss` WHERE rrss_id='".$row_urls[2]."' AND url='".$row_urls[3]."'";
			$result_rrss=mysqli_query($mysqli,$query_rrss)or die (mysqli_error());
			$row_rrss= mysqli_fetch_array($result_rrss, MYSQLI_BOTH);
			$descripcion_rrss=$row_rrss[3];

			$query_influenciador="SELECT nombre FROM  `persona` WHERE id='".$row_urls[6]."'";
			$result_influenciador=mysqli_query($mysqli,$query_influenciador)or die (mysqli_error());
			$row_influenciador= mysqli_fetch_array($result_influenciador, MYSQLI_BOTH);
			$nombre=$row_influenciador[0];

			if($descripcion_rrss=='facebook'){
				$contador=reconoce_red_social($descripcion_rrss,$rrss);
					if($contador>0){
						$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
						$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
						$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
						$html=red_social($descripcion_rrss,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$row_urls[7],$row_urls[8],$row_urls[9],$row_urls[10],$favorites,$retweet,$reproducciones,$row_urls[14]);	
						$html_facebook.=$html[0];
						$html_reach+=$html[4];				
						$reach_facebook+=$row_urls[14];
						$facebook_posts++;
					}
					
			}
			
			if($descripcion_rrss=='instagram'){
				$contador=reconoce_red_social($descripcion_rrss,$rrss);
				if(reconoce_red_social($descripcion_rrss,$rrss)>0){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					$html=red_social($descripcion_rrss,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$row_urls[7],$row_urls[8],$row_urls[9],$row_urls[10],$row_urls[11],$row_urls[12],$reproducciones,$row_urls[14]);
					$html_instagram.=$html[1];
					$html_reach+=$html[4];
					$instagram_posts++;
					$reach_instagram+=$row_urls[14];
				}
			}

			if($descripcion_rrss=='twitter'){
				$contador=reconoce_red_social($descripcion_rrss,$rrss);
				if(reconoce_red_social($descripcion_rrss,$rrss)>0){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					$html=red_social($descripcion_rrss,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$likes,$comments,$shares,$row_urls[10],$row_urls[11],$row_urls[12],$reproducciones,$row_urls[14]);
					$html_twitter.=	$html[2];
					$html_reach+=$html[4];
					$twitter_posts++;
					$reach_twitter+=$row_urls[14];
				}
			}

			if($descripcion_rrss=='youtube'){
				$contador=reconoce_red_social($descripcion_rrss,$rrss);
				if(reconoce_red_social($descripcion_rrss,$rrss)>0){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					$html=red_social($descripcion_rrss,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$likes,$comments,$shares,$row_urls[10],$favorites,$retweet,$row_urls[13],$row_urls[14]);
					$html_youtube.=$html[3];
					$html_reach+=$html[4];
					$youtube_posts++;
					$reproducciones_youtube+=$row_urls[13];
				}
			}

		}

		if($html_facebook==''){
			$fb_title='';
		}
		if($html_instagram==''){
			$in_title='';
		}
		if($html_twitter==''){
			$tw_title='';
		}
		if($html_youtube==''){
			$yo_title='';
		}

		echo $html_inicio.'<h2>REACH :'.$html_reach.'</h2>'.$fb_title.$html_facebook.$in_title.$html_instagram.$tw_title.$html_twitter.$yo_title.$html_youtube.$html_final;
			
?>
	</body>
</html>




