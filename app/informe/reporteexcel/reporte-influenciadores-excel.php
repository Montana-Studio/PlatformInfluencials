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
	$titulo_facebook=strtoupper("facebook");
	$titulo_instagram=strtoupper("instagram");
	$titulo_twitter=strtoupper("twitter");
	$titulo_youtube=strtoupper("youtube");

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
					            		->setCellValue('I'.$i,  number_format($reach,3));
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
					            		->setCellValue('I'.$i,  number_format($reach,3));
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
					            		->setCellValue('H'.$i,  number_format($reach,3));
			}

			if($descripcion_rrss=='youtube'){
					$objRedSocialSheet = $objPHPExcel->setActiveSheetIndex(4);
					$objRedSocialSheet->setCellValue('A2', $tituloPaginas)
					        		    ->setCellValue('A'.$i,  $nombre)
							            ->setCellValue('B'.$i,  $descripcion_rrss)
					        		    ->setCellValue('C'.$i,  $cuenta)
					            		->setCellValue('D'.$i,  $url)
					            		->setCellValue('E'.$i,  $reproducciones)
					            		->setCellValue('F'.$i,  number_format($reach,3));
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
					            		->setTitle($titulo_facebook);	

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
					            		->setTitle($titulo_instagram);

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
					            		->setTitle($titulo_twitter);	

        $objRedSocialSheet = $objPHPExcel->createSheet(4)
										 ->mergeCells('A2:D2');
					        $objPHPExcel->setActiveSheetIndex(4)
						   			    ->setCellValue('A3',  $titulosColumnasInfluenciadores[0])
							            ->setCellValue('B3',  $titulosColumnasInfluenciadores[1])
					        		    ->setCellValue('C3',  $titulosColumnasInfluenciadores[2])
					            		->setCellValue('D3',  $titulosColumnasInfluenciadores[3])
					            		->setCellValue('E3',  $titulosColumnasInfluenciadores[10])
					            		->setCellValue('F3',  $titulosColumnasInfluenciadores[11])
					            		->setTitle($titulo_youtube);


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
		$reproducciones_youtube=0;

		$query_campana="SELECT * FROM  `campana` WHERE id='".$_GET['id']."'";
		$result_campana=mysqli_query($mysqli,$query_campana)or die (mysqli_error());
		$row_campana= mysqli_fetch_array($result_campana, MYSQLI_BOTH);
		$redes_sociales=$row_campana[11];


		$query_urls="SELECT * FROM  `core_redes_sociales_campanas` WHERE campana_id='".$_GET['id']."' AND persona_id='".$_GET['influenciador']."' ORDER BY url";
		$result_urls=mysqli_query($mysqli,$query_urls)or die (mysqli_error());
		$row_urls= mysqli_fetch_array($result_urls, MYSQLI_BOTH);

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
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					red_social(	$objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$facebook_posts,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$row_urls[7],$row_urls[8],$row_urls[9],$row_urls[10],$favorites,$retweet,$reproducciones,$row_urls[14]);					
					$reach_facebook+=$row_urls[14];
					$facebook_posts++;
			}
			
			if($descripcion_rrss=='instagram'){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					red_social(	$objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$instagram_posts,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$row_urls[7],$row_urls[8],$row_urls[9],$row_urls[10],$row_urls[11],$row_urls[12],$reproducciones,$row_urls[14]);		
					$instagram_posts++;
					$reach_instagram+=$row_urls[14];
			}

			if($descripcion_rrss=='twitter'){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					red_social(	$objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$twitter_posts,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$likes,$comments,$shares,$row_urls[10],$row_urls[11],$row_urls[12],$reproducciones,$row_urls[14]);	
					$twitter_posts++;
					$reach_twitter+=$row_urls[14];
			}

			if($descripcion_rrss=='youtube'){
					$query_reporte_campana="SELECT * FROM core_redes_sociales_campanas WHERE url='".$row_urls[3]."'";
					$result_reporte_campana= mysqli_query($mysqli, $query_reporte_campana)or die (mysqli_error());
					$row_reporte_campana= mysqli_fetch_array($result_reporte_campana, MYSQLI_BOTH);
					red_social(	$objPHPExcel,$titulosColumnasInfluenciadores,$descripcion_rrss,$youtube_posts,$row_datos_campana[1],$nombre,$row_urls[4],$row_urls[3],$likes,$comments,$shares,$row_urls[10],$favorites,$retweet,$row_urls[13],$row_urls[14]);
					$youtube_posts++;
					$reproducciones_youtube+=$row_urls[13];
			}

		}
			$suma_reach+=$reach_facebook+$reach_instagram+$reach_twitter;
			$suma_reproducciones+=$reproducciones_youtube;

	
				$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A8', 'facebook')
        		    ->setCellValue('A9', 'instagram')
            		->setCellValue('A10','twitter')
            		->setCellValue('A11','youtube')
            		->setCellValue('A12','TOTAL')
            		->setCellValue('B8', '0')
        		    ->setCellValue('B9', '0')
            		->setCellValue('B10','0')
            		->setCellValue('B11',$reproducciones_youtube)
            		->setCellValue('B12',$suma_reproducciones)
            		->setCellValue('C8', number_format($reach_facebook,3))
        		    ->setCellValue('C9', number_format($reach_instagram,3))
            		->setCellValue('C10',number_format($reach_twitter,3))
            		->setCellValue('C11','0')
            		->setCellValue('C12',number_format($suma_reach,3))
            		->setTitle('Reporte de Campanas');

			
			if($reach_facebook>0){
				$objPHPExcel->setActiveSheetIndex(1)
        		    ->mergeCells('A'.$facebook_posts.':H'.$facebook_posts)
        		    ->setCellValue('A'.$facebook_posts, 'TOTAL')
        		    ->setCellValue('I'.$facebook_posts, $reach_facebook);
        		}else{
        			$objPHPExcel->setActiveSheetIndex(1)
        		    ->mergeCells('A1:H10')
        		    ->setCellValue('A1', 'RECUERDE INGRESAR URLS PARA ESTA CAMPAÑA');
        		}
			
			if($reach_instagram>0){
				$objPHPExcel->setActiveSheetIndex(2)
        		    ->mergeCells('A'.$instagram_posts.':H'.$instagram_posts)
        		    ->setCellValue('A'.$instagram_posts, 'TOTAL')
        		    ->setCellValue('I'.$instagram_posts, $reach_instagram);
			}else{
				$objPHPExcel->setActiveSheetIndex(2)
        		    ->mergeCells('A1:H10')
        		    ->setCellValue('A1', 'RECUERDE INGRESAR URLS PARA ESTA CAMPAÑA');
			}
        	
        	if($reach_twitter>0){
        		$objPHPExcel->setActiveSheetIndex(3)
        		    ->mergeCells('A'.$twitter_posts.':G'.$twitter_posts)
        		    ->setCellValue('G'.$twitter_posts, 'TOTAL')
        		    ->setCellValue('H'.$twitter_posts, $reach_twitter);
    		}else{
    			$objPHPExcel->setActiveSheetIndex(3)
        		    ->mergeCells('A1:H10')
        		    ->setCellValue('A1', 'RECUERDE INGRESAR URLS PARA ESTA CAMPAÑA');
    		}
        	

        	if($reproducciones_youtube>0){
        		$objPHPExcel->setActiveSheetIndex(4)
        		    ->mergeCells('A'.$youtube_posts.':E'.$youtube_posts)
        		    ->setCellValue('A'.$youtube_posts, 'TOTAL')
        		    ->setCellValue('F'.$youtube_posts, $reproducciones_youtube);
        		}else{
        			$objPHPExcel->setActiveSheetIndex(4)
        		    ->mergeCells('A1:H10')
        		    ->setCellValue('A1', 'RECUERDE INGRESAR URLS PARA ESTA CAMPAÑA');
        		}
        	

        

        /*$array_redes_sociales=explode(',',$row_datos_campana[11]);
        $cantidad_redes_sociales= count($array_redes_sociales);
        $facebook=0;
        $instagram=0;
        $twitter=0;
        $youtube=0;

        for($i=0;$i<=$cantidad_redes_sociales;$i++){
        	$sheetNames = $objPHPExcel->getSheetNames();
        	if($array_redes_sociales[$i]=='facebook'){
        		$facebook=1;
        	}else{
        		for($j=1;$j<=4;$j++){
		       		$sheetNames[$j]==$titulo_facebook;
		       	}
        	}

        	if($array_redes_sociales[$i]=='instagram'){
        		$instagram=1;
        	}

        	if($array_redes_sociales[$i]=='twitter'){
        		$twitter=1;
        	}

        	if($array_redes_sociales[$i]=='youtube'){
        		$youtube=1;
        	}
       	}

       	

       	
       	

       	if($facebook==0){
       		$objPHPExcel->getSheetByName(strtoupper("facebook"))
    					->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
       	}

   		if($instagram==0){
   			$objPHPExcel->getSheetByName(strtoupper("instagram"))
    					->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
       	}

       	if($twitter==0){
       		$objPHPExcel->getSheetByName(strtoupper("twitter"))
    					->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
       	}

       	if($youtube==0){
       		$objPHPExcel->getSheetByName(strtoupper("youtube"))
    					->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
       	}*/

       	

       	


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
		//$objPHPExcel->getActiveSheet()->setTitle('Reporte de Campanas');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre

		
		$objPHPExcel->setActiveSheetIndex(0);


		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


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