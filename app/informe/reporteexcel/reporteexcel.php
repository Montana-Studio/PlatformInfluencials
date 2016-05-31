<?php
    $mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
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




	function red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$i,$campana,$nombre,$cuenta,$url,$likes,$comments,$shares,$followers,$favorites,$retweets,$reproducciones,$reach){
		$tituloPaginas="Metricas para ".$descripcion_rrss." - Campaña : ".$campana;

			if($descripcion_rrss=='facebook'){
					$objRedSocialSheet = $objPHPExcel->setActiveSheetIndex(1);
					$objRedSocialSheet->setCellValue('A2', $tituloPaginas)
					        		    ->setCellValue('A'.$i,  $nombre)
							            ->setCellValue('B'.$i,  $descripcion_rrss)
					        		    ->setCellValue('C'.$i,  $cuenta)
					            		->setCellValue('D'.$i,  $url)
					            		->setCellValue('E'.$i,  $likes)
							            ->setCellValue('F'.$i,  $comments)
					        		    ->setCellValue('G'.$i,  $shares)
					            		->setCellValue('H'.$i,  $followers)
					            		->setCellValue('I'.$i,  number_format($reach,2));
										
			}

			if($descripcion_rrss=='instagram'){
					$objRedSocialSheet = $objPHPExcel->setActiveSheetIndex(2);
					$objRedSocialSheet->setCellValue('A2', $tituloPaginas)
					        		    ->setCellValue('A'.$i,  $nombre)
							            ->setCellValue('B'.$i,  $descripcion_rrss)
					        		    ->setCellValue('C'.$i,  $cuenta)
					            		->setCellValue('D'.$i,  $url)
					            		->setCellValue('E'.$i,  $likes)
							            ->setCellValue('F'.$i,  $comments)
					        		    ->setCellValue('G'.$i,  $shares)
					            		->setCellValue('H'.$i,  $followers)
					            		->setCellValue('I'.$i,  number_format($reach,2));
										
				
			}

			if($descripcion_rrss=='twitter'){
					$objRedSocialSheet = $objPHPExcel->setActiveSheetIndex(3);
					$objRedSocialSheet->setCellValue('A2', $tituloPaginas)
					        		    ->setCellValue('A'.$i,  $nombre)
							            ->setCellValue('B'.$i,  $descripcion_rrss)
					        		    ->setCellValue('C'.$i,  $cuenta)
					            		->setCellValue('D'.$i,  $url)
							            ->setCellValue('E'.$i,  $favorites)
					        		    ->setCellValue('F'.$i,  $retweets)
					            		->setCellValue('G'.$i,  $followers)
					            		->setCellValue('H'.$i,  number_format($reach,2));
										
			}

			if($descripcion_rrss=='youtube'){
					$objRedSocialSheet = $objPHPExcel->setActiveSheetIndex(4);
					$objRedSocialSheet->setCellValue('A2', $tituloPaginas)
					        		    ->setCellValue('A'.$i,  $nombre)
							            ->setCellValue('B'.$i,  $descripcion_rrss)
					        		    ->setCellValue('C'.$i,  $cuenta)
					            		->setCellValue('D'.$i,  $url)
					            		->setCellValue('E'.$i,  $reproducciones)
					            		->setCellValue('F'.$i,  number_format($reach,2));
										
			}


				
						
					  


										
		}





	//$consulta = "SELECT concat(paterno,' ', materno, ' ' , nombre) AS alumno, fechanac, sexo, carrera FROM alumno INNER JOIN carrera ON alumno.idcarrera = carrera.idcarrera ORDER BY carrera, nombre";
	//$resultado = $conexion->query($consulta);
	if($num_row_datos_campana > 0 ){
						
		//date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();



		
		//$objDrawing->setWorksheet($excel->getActiveSheet());

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Mediatrends") //Autor
							 ->setLastModifiedBy("Mediatrends") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Campaña")
							// ->setSubject("Reporte Excel con PHP y MySQL")
							// ->setDescription("Reporte de alumnos")
							// ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Agencias");

		$tituloReporte = "Campaña";
		$titulosColumnas = array('MARCA', 'DESCRIPCION', 'FECHA INICIO', 'FECHA TERMINO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A2:D2');
	    
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A2',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3]);




		
		//Se agregan los datos de la campana
		//$i = 4;
		$objPHPExcel->setActiveSheetIndex(0)
    		    ->setCellValue('A4',  $row_datos_campana[4])
	            ->setCellValue('B4',  $row_datos_campana[2])
    		    ->setCellValue('C4',  $row_datos_campana[9])
        		->setCellValue('D4',  $row_datos_campana[10]);


		$tituloInfluenciadores = "Informe de Influenciadores";
		$titulosColumnasInfluenciadores = array('NOMBRE', 'RED SOCIAL', 'CUENTA', 'URL', 'LIKES', 'COMMENTS', 'SHARES', 'FOLLOWERS', 'FAVORITES', 'RETWEET', 'REPRODUCCIONES', 'REACH');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A6:C6');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A6',$tituloInfluenciadores)
        		    ->setCellValue('A7',  $titulosColumnasInfluenciadores[1])
            		->setCellValue('B7',  $titulosColumnasInfluenciadores[10])
            		->setCellValue('C7',  $titulosColumnasInfluenciadores[11]);

        $objRedSocialSheet = $objPHPExcel->createSheet(1)
									 	 ->mergeCells('A2:D2');
							$objPHPExcel->setActiveSheetIndex(1)
									 	->setCellValue('A3',  $titulosColumnasInfluenciadores[0])
							            ->setCellValue('B3',  $titulosColumnasInfluenciadores[1])
					        		    ->setCellValue('C3',  $titulosColumnasInfluenciadores[2])
					            		->setCellValue('D3',  $titulosColumnasInfluenciadores[3])
					            		->setCellValue('E3',  $titulosColumnasInfluenciadores[4])
					            		->setCellValue('F3',  $titulosColumnasInfluenciadores[5])
					            		->setCellValue('G3',  $titulosColumnasInfluenciadores[6])
					            		->setCellValue('H3',  $titulosColumnasInfluenciadores[7])
					            		->setCellValue('I3',  $titulosColumnasInfluenciadores[11])
					            		->setTitle("Resultados Facebook");	

		$objRedSocialSheet = $objPHPExcel->createSheet(2)
										 ->mergeCells('A2:D2');
						    $objPHPExcel->setActiveSheetIndex(2)
						    			->setCellValue('A3',  $titulosColumnasInfluenciadores[0])
							            ->setCellValue('B3',  $titulosColumnasInfluenciadores[1])
					        		    ->setCellValue('C3',  $titulosColumnasInfluenciadores[2])
					            		->setCellValue('D3',  $titulosColumnasInfluenciadores[3])
					            		->setCellValue('E3',  $titulosColumnasInfluenciadores[4])
					            		->setCellValue('F3',  $titulosColumnasInfluenciadores[5])
					            		->setCellValue('G3',  $titulosColumnasInfluenciadores[6])
					            		->setCellValue('H3',  $titulosColumnasInfluenciadores[7])
					            		->setCellValue('I3',  $titulosColumnasInfluenciadores[11])
					            		->setTitle("Resultados Instagram");

        $objRedSocialSheet = $objPHPExcel->createSheet(3)
										 ->mergeCells('A2:D2');
				            $objPHPExcel->setActiveSheetIndex(3)
										->setCellValue('A3',  $titulosColumnasInfluenciadores[0])
							            ->setCellValue('B3',  $titulosColumnasInfluenciadores[1])
					        		    ->setCellValue('C3',  $titulosColumnasInfluenciadores[2])
					            		->setCellValue('D3',  $titulosColumnasInfluenciadores[3])
					            		->setCellValue('E3',  $titulosColumnasInfluenciadores[8])
					            		->setCellValue('F3',  $titulosColumnasInfluenciadores[9])
					            		->setCellValue('G3',  $titulosColumnasInfluenciadores[7])
					            		->setCellValue('H3',  $titulosColumnasInfluenciadores[11])
					            		->setTitle("Resultados Twitter");	

        $objRedSocialSheet = $objPHPExcel->createSheet(4)
										 ->mergeCells('A2:D2');
					        $objPHPExcel->setActiveSheetIndex(4)
						   			    ->setCellValue('A3',  $titulosColumnasInfluenciadores[0])
							            ->setCellValue('B3',  $titulosColumnasInfluenciadores[1])
					        		    ->setCellValue('C3',  $titulosColumnasInfluenciadores[2])
					            		->setCellValue('D3',  $titulosColumnasInfluenciadores[3])
					            		->setCellValue('E3',  $titulosColumnasInfluenciadores[10])
					            		->setCellValue('F3',  $titulosColumnasInfluenciadores[11])
					            		->setTitle("Resultados Youtube");



		
		/*Se agregan los datos de los alumnos
		
		while ($row_datos_campana = mysqli_fetch_array($result_datos_campana)) {
			
		}
		/****************
		****************/
		
		


		$i = 8;
		include('../../rrss/rrss_keys.php');
		$facebook_posts=4;
		$instagram_posts=4;
		$twitter_posts=4;
		$youtube_posts=4;
		$suma_reach=0;
		$suma_reproducciones=0;
		$reach_facebook=0;
		$reach_instagram=0;
		$reach_twitter=0;

		$query_urls="SELECT * FROM  `campanarrss` WHERE campana_id='".$_GET['id']."' ORDER BY persona_id DESC , descripcion_rrss";
		$result_urls=mysqli_query($mysqli,$query_urls)or die (mysqli_error());
		$row_urls= mysqli_fetch_array($result_urls, MYSQLI_BOTH);

		while($row_urls = mysqli_fetch_array($result_urls)){
				$id_campana= $row_urls['campana_id'];
				$id_influenciador = $row_urls['persona_id'];
				$descripcion_rrss= $row_urls['descripcion_rrss'];
				$rrss_id= $row_urls['rrss_id'];
				$url= $row_urls['url'];
				$query_influenciadores="SELECT nombre FROM  `persona` WHERE id='$id_influenciador'";
				$result_influenciadores=mysqli_query($mysqli,$query_influenciadores)or die (mysqli_error());
				$row_influenciadores= mysqli_fetch_array($result_influenciadores, MYSQLI_BOTH);
				$nombre=$row_influenciadores['nombre'];
				$cuenta='';
				$likes=0;
				$comments=0;
				$shares=0;
				$followers=0;
				$reach=0;
				$favorites=0;
				$retweet=0;
				$reproducciones=0;
				
				
				if($descripcion_rrss=='facebook'){
					$query_reporte_campana="SELECT * FROM core_redes_sociales WHERE campana_id=$id_campana AND rrss_id='".$rrss_id."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_urls= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);

					//encuentro el nombre de usuario
					$facebookPage=$rrss_id;
                    $facebookKey =FACEBOOK_CONSUMER_KEY;
                    $facebookAppId = FACEBOOK_APP_ID;
                    $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
                    $json_user_url = str_replace(" ", "%20", $json_user_url1);
                    $json_user= @file_get_contents($json_user_url);
                    $links_user_url= json_decode($json_user);
                    $cuenta =$links_user_url->name;
                    $followers = $links_user_url->likes;


                    //encuentro los likes de su paginas
                    $facebook_post_id=explode("/",$url);
                    $json_user_url2="https://graph.facebook.com/".$rrss_id."_".trim(end($facebook_post_id))."?fields=likes.limit(0).summary(true),comments.limit(0).summary(true),shares";
                    $json_user_url2 = str_replace(" ", "%20", $json_user_url2);
                    $json_user2= @file_get_contents($json_user_url2);
                    $links_user_url2= json_decode($json_user2);
                    $likes+= $links_user_url2->likes->summary->total_count;
                    $comments += $links_user_url2->comments->summary->total_count;
                    $shares+= $links_user_url2->shares->count; 
                    $reach = ($likes+$comments+$shares)/$followers;
                    $reach_facebook+=$reach;
                    
                    //Reporte de Facebook
					red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$facebook_posts,$row_datos_campana[1],$nombre,$row_urls[2],$url,$nombre,$row_urls[5],$nombre,$row_urls[6],$nombre,$row_urls[7],$nombre,$row_urls[8],$favorites,$retweet,$reproducciones,$$nombre,$row_urls[12]);
					$facebook_posts++;


				}
				if($descripcion_rrss=='instagram'){
				  $query_access_token="SELECT access_token FROM  `rrss` WHERE rrss_id='$rrss_id'";
				  $result_access_token=mysqli_query($mysqli,$query_access_token)or die (mysqli_error());
				  $row_access_token= mysqli_fetch_array($result_access_token, MYSQLI_BOTH);
				  $json_user_url ="https://api.instagram.com/v1/users/".$rrss_id."?access_token=".$row_access_token['access_token'];
                  $json_user= @file_get_contents($json_user_url);
                  $links_user_url= json_decode($json_user);
                  $cuenta = $links_user_url->data->username;
                  $followers = $links_user_url->data->counts->followed_by;
                  $api = @file_get_contents("http://api.instagram.com/oembed?url=".$url);  
	              $apiObj = json_decode($api,true);  
	              $media_id = $apiObj['media_id']; 
	              //$instagram_id = $row_url_instagram['rrss_id'];
	              $query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$rrss_id;
	              $result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error($link));
	              $row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
	              $access_token = $row_instagram_rrss['access_token'];
	              $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
	              $instagram_post_json = json_decode($instagram_post_query,true); 
	              $comments = intval($instagram_post_json['data']['comments']['count']);
	              $likes = intval($instagram_post_json['data']['likes']['count']);
	              $reach = (($likes+$comments)/$followers);
	              red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$instagram_posts,$row_datos_campana[1],$nombre,$cuenta,$url,$likes,$comments,$shares,$followers,$favorites,$retweet,$reproducciones,$reach);
	              $query_reporte_campana="SELECT * FROM core_redes_sociales WHERE rrss_id='".$rrss_id."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_urls= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
	              red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$facebook_posts,$row_datos_campana[1],$nombre,$row_urls[2],$url,$nombre,$row_urls[5],$nombre,$row_urls[6],$nombre,$row_urls[7],$nombre,$row_urls[8],$favorites,$retweet,$reproducciones,$$nombre,$row_urls[12]);
	              $instagram_posts++;
	              $reach_instagram+=$reach;
				}

				if($descripcion_rrss=='twitter'){
					include_once("../../rrss/twitter/inc/twitteroauth.php");
                    include_once('../../rrss/twitter/inc/TwitterAPIExchange.php');
					$settings = array(
                    'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
                    'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
                    'consumer_key' => TWITTER_CONSUMER_KEY,
                    'consumer_secret' => TWITTER_CONSUMER_SECRET
                    );
                    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                    $requestMethod = 'GET';
                    $usuario1 = $rrss_id;
                    $getfield1 = '?id='.$usuario1;
                    $twitter1 = new TwitterAPIExchange($settings);
                    $follow_count1=$twitter1->setGetfield($getfield1)
                    ->buildOauth($ta_url, $requestMethod)
                    ->performRequest();
                    $data1 = json_decode($follow_count1, true);
                    $cuenta=$data1[0]['user']['screen_name'];
                    

                    $twitter_post_id_array= explode('/', $url);
                    $string_post_id= end($twitter_post_id_array);                   
                    $ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
                    $twitter2 = new TwitterAPIExchange($settings);
                    $twitter_show=$twitter2->setGetfield($getfield1)
                    ->buildOauth($ta_url, $requestMethod)
                    ->performRequest();
                    $data_url = json_decode($twitter_show, true);
                    $followers=$data_url["user"]["followers_count"];
                    $retweet=$data_url["retweet_count"];
                    $favorites+=$data_url["favorite_count"];
                    $reach = (($retweet+$favorites)/$followers);
                    red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$twitter_posts,$row_datos_campana[1],$nombre,$cuenta,$url,$likes,$comments,$shares,$followers,$favorites,$retweet,$reproducciones,$reach);
                    $twitter_posts++;
                    $reach_twitter+=$reach;
				}
				if($descripcion_rrss=='youtube'){
					$googleplusKey =GOOGLE_CONSUMER_KEY;
                    $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$rrss_id."&key=".$googleplusKey;
                    $json_user= file_get_contents($json_user_url);
                    $links_user_url= json_decode($json_user);
                    $cuenta = $links_user_url->items[0]->snippet->title;
                    $reproducciones = $links_user_url->items[0]->statistics->viewCount;
                    red_social($objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$youtube_posts,$row_datos_campana[1],$nombre,$cuenta,$url,$likes,$comments,$shares,$followers,$favorites,$retweet,$reproducciones,$reach);
					$youtube_posts++;	

				}


				/*$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $nombre)
        		    ->setCellValue('B'.$i,  $reproducciones)
            		->setCellValue('C'.$i,  number_format($reach,2));
					$i++;*/

				$suma_reach+=$reach;
				$suma_reproducciones+=$reproducciones;

		}
				$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A8', 'facebook')
        		    ->setCellValue('A9', 'instagram')
            		->setCellValue('A10','twitter')
            		->setCellValue('A11','youtube')
            		->setCellValue('A12','TOTAL')
            		->setCellValue('B8', '0')
        		    ->setCellValue('B9', '0')
            		->setCellValue('B10','0')
            		->setCellValue('B11',$suma_reproducciones)
            		->setCellValue('B12',$suma_reproducciones)
            		->setCellValue('C8', number_format($reach_facebook,3))
        		    ->setCellValue('C9', number_format($reach_instagram,3))
            		->setCellValue('C10',number_format($reach_twitter,3))
            		->setCellValue('C11','0')
            		->setCellValue('C12',number_format($suma_reach,3));

				/*$objPHPExcel->setActiveSheetIndex(0)
							->mergeCells('A'.$i.':J'.$i)
							->setCellValue('A'.$i ,  'TOTAL')
							->setCellValue('K'.$i ,  $suma_reproducciones)
							->setCellValue('L'.$i , number_format($suma_reach,2));*/








		
		
		/** estilos del reporte
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '3a2a47'
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));
				
		for($i = 'A'; $i <= 'D'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		*/
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Campanas');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


		



       /* $objWorkSheet = $objPHPExcel->createSheet(3);
		$objWorkSheet->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
        $objWorkSheet->setTitle("Resultados Instagram");



        $objWorkSheet = $objPHPExcel->createSheet(4);
		$objWorkSheet->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
        $objWorkSheet->setTitle("Resultados Twitter");



        $objWorkSheet = $objPHPExcel->createSheet(5);
		$objWorkSheet->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
        $objWorkSheet->setTitle("Resultados Youtube");*/


		



		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte-campanas.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>