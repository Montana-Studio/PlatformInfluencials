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
	$id_campana= $_GET['id'];
	$id_influenciador= $_GET['influenciador'];
	$mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
	$mysqli->set_charset('utf8_bin');
	$query_datos_influenciador="SELECT DISTINCT * FROM persona WHERE id='$id_influenciador'";
	$result_datos_influenciador=mysqli_query($mysqli,$query_datos_influenciador)or die (mysqli_error());
	$row_datos_influenciador= mysqli_fetch_array($result_datos_influenciador, MYSQLI_BOTH);

	$query_datos_campana="SELECT DISTINCT * FROM campana WHERE id='$id_campana'";
	$result_datos_campana=mysqli_query($mysqli,$query_datos_campana)or die (mysqli_error());
	$row_datos_campana= mysqli_fetch_array($result_datos_campana, MYSQLI_BOTH);


	$query_datos_informe="SELECT DISTINCT * FROM core_redes_sociales_campanas WHERE campana_id='$id_campana' AND persona_id='$id_influenciador'";
	$result_datos_informe=mysqli_query($mysqli,$query_datos_informe)or die (mysqli_error());
	$row_datos_informe= mysqli_fetch_array($result_datos_informe, MYSQLI_BOTH);

	$query_reach_total_campana="SELECT SUM(reach) FROM core_redes_sociales_campanas WHERE persona_id=".$id_influenciador." AND campana_id='".$id_campana."'";
	$result_reach_total_campana=mysqli_query($mysqli,$query_reach_total_campana)or die (mysqli_error());
	$row_reach_total_campana= mysqli_fetch_array($result_reach_total_campana, MYSQLI_BOTH);

    $i=0;
    $j=0;
    $k=0;
    $l=0;
    do{
    	if(strpos($row_datos_informe[3],'facebook')!==false){
    		$facebook_rrss_url[$i]=$row_datos_informe[3];
    		$facebook_rrss_name[$i]=$row_datos_informe[4];
    		$facebook_rrss_img[$i]=$row_datos_informe[5];
    		$facebook_likes[$i]=$row_datos_informe[7];
    		$facebook_comments[$i]=$row_datos_informe[8];
    		$facebook_shares[$i]=$row_datos_informe[9];
    		$facebook_followers[$i]=$row_datos_informe[10];
    		$facebook_reach[$i]=$row_datos_informe[14];
        	$reach_facebook_total+=$row_datos_informe[14];
        	$i++;
        }

        if(strpos($row_datos_informe[3],'instagram')!==false){
        	$instagram_rrss_url[$j]=$row_datos_informe[3];
    		$instagram_rrss_name[$j]=$row_datos_informe[4];
    		$instagram_rrss_img[$j]=$row_datos_informe[5];
        	$instagram_likes[$j]=$row_datos_informe[7];
    		$instagram_comments[$j]=$row_datos_informe[8];
    		$instagram_shares[$j]=$row_datos_informe[9];
    		$instagram_followers[$j]=$row_datos_informe[10];
    		$instagram_reach[$j]=$row_datos_informe[14];
        	$reach_instagram_total+=$row_datos_informe[14];
        	$j++;
        }

        if(strpos($row_datos_informe[3],'twitter')!==false){
        	$twitter_rrss_url[$k]=$row_datos_informe[3];
    		$twitter_rrss_name[$k]=$row_datos_informe[4];
    		$twitter_rrss_img[$k]=$row_datos_informe[5];
        	$twitter_favorites[$k]=$row_datos_informe[11];
    		$twitter_retweet[$k]=$row_datos_informe[12];
    		$twitter_followers[$k]=$row_datos_informe[10];
    		$twitter_reach[$k]=$row_datos_informe[14];
        	$reach_twitter_total+=$row_datos_informe[14];
        	$k++;
        }

        if(strpos($row_datos_informe[3],'youtube')!==false){
        	$youtube_rrss_url[$l]=$row_datos_informe[3];
    		$youtube_rrss_name[$l]=$row_datos_informe[4];
    		$youtube_rrss_img[$l]=$row_datos_informe[5];
    		$youtube_reach[$l]=$row_datos_informe[14];
        	$suma_youtube_total+=$row_datos_informe[14];
        	$l++;
        }

    }while($row_datos_informe= mysqli_fetch_array($result_datos_informe));


echo "
	<h2>Informe de Campaña : ".$row_datos_campana[2]." by ".$row_datos_campana[4]."</h2>
			<img src='../".$row_datos_campana[3]."' width='480' height='300>
	<div class='reach-campana'>
	    <h3 class='sub-titulo'>Datos de la Campaña</h3>
	    <ul>
	    <li>Fecha de inicio : ".$fecha_inicio."</li>
	    <li>Fecha de termino : ".$fecha_termino."</li>
	    </ul>
	    <h3>Métricas Asociadas a ".$row_datos_influenciador[5]."</h3>";
	    echo "<p> Reach Actual : ".$row_reach_total_campana[0]."</p>";

	    	//if($reach_total_facebook>0 && $rrss_list[$k]=='facebook'){
				$i=0;
				$total_registros_facebook = count($facebook_rrss_url);
				if($total_registros_facebook>0){
					echo "<p><b>Reach Facebook : ".$reach_facebook_total."</b></p>";
					while($i<$total_registros_facebook){
						echo "<ul>";
			    		echo "<img src='".$facebook_rrss_img[$i]."'/>";
			    		echo "<li>Cuenta : ".$facebook_rrss_name[$i]."</li>";
			    		echo "<li>URL : ".$facebook_rrss_url[$i]."</li>";
			    		echo "<li>Likes : ".$facebook_likes[$i]."</li>";
			    		echo "<li>Comments : ".$facebook_comments[$i]."</li>";
			    		echo "<li>Shares : ".$facebook_shares[$i]."</li>";
			    		echo "<li>Page Followers : ".$facebook_followers[$i]."</li>";
			    		echo "<li>Reach Post : ".$facebook_reach[$i]."</li>";
			    		echo "</ul>";
			    		$i++;
					}
				}

	    		$j=0;
				$total_registros_instagram = count($instagram_rrss_url);
				echo $total_registros_instagram;
				if($total_registros_instagram>0){
					
					echo "<h3>Reach Instagram : ".$reach_instagram_total."</h3>";
					while($j<$total_registros_instagram){
						echo var_dump($instagram_rrss_url);
			    		//echo "<img src='".$instagram_rrss_img[$j]."'/>";
			    		echo "<h4>".strtoupper($instagram_rrss_name[$j])."</h4>";
			    		do{
				    		echo "<p style='line-height:10px; text-decoration:underline;'>".$instagram_rrss_url[$j]."</p>";
				    		echo "<p style='line-height:10px'>Likes : ".$instagram_pkes[$j]."   ";
				    		echo "Comments : ".$instagram_comments[$j]."   ";
				    		echo "Shares : ".$instagram_shares[$j]."   ";
				    		echo "Followers : ".$instagram_followers[$j]."</p>";
				    		echo "<p style='line-height:10px'><b>Reach Post : ".$instagram_reach[$j]."</b></p>";
				    		$j++;
				    		if($j>0){
				    			$cuenta_actual=$instagram_rrss_name[$j-1];
				    			$cuenta_siguiente= $instagram_rrss_name[$j];
				    		}else{
				    			//echo "<br/>";
				    		}
			    		}while($cuenta_actual==$cuenta_siguiente);
					}
				}
	    		
				$k=0;
				$total_registros_twitter = count($twitter_rrss_url);
				if($total_registros_twitter>0){
					echo "<h3>Reach twitter : ".$reach_twitter_total."</h3>";
					do{
			    		//echo "<img src='".$twitter_rrss_img[$k]."'/>";
			    		echo "<h4>".strtoupper($twitter_rrss_name[$k])."</h4>";
			    		do{
			    			echo "<p style='line-height:10px;text-decoration:underline;'>".$twitter_rrss_url[$k]."</p>";
				    		echo "Favorites : ".$twitter_favorites[$k]."   ";
				    		echo "Retweet : ".$twitter_retweet[$k]."   ";
				    		echo "Followers : ".$twitter_followers[$k]."</p>";
				    		echo "<p style='line-height:10px'><b>Reach Post : ".$twitter_reach[$k]."</b></p>";
			    		}while($cuenta_actual==$cuenta_siguiente);
			    		$k++;
				    		if($k>0){
				    			$cuenta_actual=$instagram_rrss_name[$k-1];
				    			$cuenta_siguiente= $instagram_rrss_name[$j];
				    		}else{
				    			echo "<br/>";
				    		}
					}while($cuenta_actual==$cuenta_siguiente);
				}

	    		$l=0;
				$total_registros_youtube = count($youtube_rrss_url);
				if($total_registros_youtube>0){
					echo "<p><b>Reach youtube : ".$suma_youtube_total."</b></p>";
					while($l<$total_registros_youtube){	
						echo "<ul>";
			    		echo "<img src='".$youtube_rrss_img[$l]."'/>";
			    		echo "<li>Cuenta : ".$youtube_rrss_name[$l]."</li>";
			    		echo "<li>URL : ".$youtube_rrss_url[$l]."</li>";
		    			echo "<p><b>Reproducciones Youtube : ".$youtube_reach[$l]."<b></p>";
		    			$l++;
		    		}
				}
	echo	"</div>";
	?>

	</body>
	</html>