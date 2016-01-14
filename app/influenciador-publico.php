<?php include 'header.php'; ?>
<?php 
	$query_campana='SELECT DISTINCT * FROM campana WHERE id="'.$_GET['id'].'" AND nombre="'.$_GET["campana"].'"';
	$result_campana=mysqli_query($mysqli,$query_campana)or die (mysqli_erroxr($mysqli));
	$row_campana= mysqli_fetch_array($result_campana, MYSQLI_BOTH);
	$num_row_campana= mysqli_num_rows($result_campana);
//if($row_campana){	
	if($_GET['campana']){
		echo '<h2 class="sub-titulo">Selecciona una campaña</h2>
            <div id="campanas-postulables">
				<select>
					<option selected="selected" id="'.$_GET["id"].'" disabled>'.$_GET["campana"].'</option>
				</select>
				<i class="pi pi-arrow-bottom"></i>
			</div>';

	}else{
			//echo $hoyFormatted;
		echo '<!--button id="opc_cot">Campañas para cotizar</button-->';
			//mostrar campañas
		if ($num_rows2 > 0){
			echo '<h2 class="sub-titulo">Selecciona una campaña para cotizar</h2>
                    <div id="campanas-postulables">
					<select>
					<option selected="selected" disabled>Seleccione campaña</option>';
			do{
				echo '<option>'.$row2[0].'</option>';
			}while($row2 = mysqli_fetch_row($result2));
				echo '</select>
					<i class="pi pi-arrow-bottom"></i>
					</div>';
		}
	}	
	
	//mostrar influenciadores
	if ($num_rows > 0){
		//echo  $_GET['campana'].$_GET['id'];
		echo '<h2 class="sub-titulo">Influenciadores</h2>
				<div class="influenciadores">';
		do{
			echo '<form id="'.$row[0].'"class="contactarForm" name="'.$row[5].'">
					<svg viewBox="0 0 140.341 133.52" class="mask-imguser">
						<defs>
							<polygon id="SVGID_1_" points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26 		"/>
						</defs>
						<clipPath id="SVGID_2_">
							<use xlink:href="#SVGID_1_"  overflow="visible"/>
						</clipPath>
						<g clip-path="url(#SVGID_2_)">
							<image overflow="visible" width="1280" height="720" xlink:href="'.$row[12].'" transform="matrix(0.2013 0 0 0.2013 -58.333 -5.7085)"></image>
						</g>
					</svg>
					<div class="info-influ">
						<h2 class="nombre">'.$row[5].'</h2>
						<small class="ubicacion"><i class="pi pi-marker"></i> '.$row[16].','.substr($row[15],7).'</small>
						<small class="tipo"><i class="pi pi-user"></i> '.$row[2].'</small>
					';
					?>
					<?php
					include_once('rrss/rrss_keys.php');
					$query_rrss_ipe='SELECT * FROM rrss WHERE persona_id="'.$row[0].'" AND id_estado=1 ORDER BY descripcion_rrss';
					$result_rrss_ipe= mysqli_query($mysqli,$query_rrss_ipe)or die(mysqli_error());
					$row_rrss_ipe= mysqli_fetch_array($result_rrss_ipe, MYSQLI_NUM);
					// $num_rows3= mysqli_num_rows($result_rrss_ipe);
					$reach=0;
					$echoContentFace=0;
					$echoContentInsta=0;
					$echoContentTweet=0;
					$echoContentAnaly=0;
					$echoContentYou=0;
					$echoContentPlus=0;
					do{
						//echo $row_rrss_ipe[2];
						if($row_rrss_ipe[2]==='facebook'){
							$facebookPage=$row_rrss_ipe[3];
							$facebookKey =FACEBOOK_CONSUMER_KEY;
							$facebookAppId = FACEBOOK_APP_ID;
							$json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
					        $json_user_url = str_replace(" ", "%20", $json_user_url1);
					        $json_user= file_get_contents($json_user_url);
					        $links_user_url= json_decode($json_user);
					        $facebookLikes =$links_user_url->likes;
					        $reach+=$facebookLikes;
					        $echoContentFace = '<div class="rrss" name="facebook"><i class="pi pi-facebook-alt"></i> Facebook <span>'.formato_numeros_reachs($facebookLikes).'</span></div>';

						}

						if($row_rrss_ipe[2]=='instagram'){
						  $json_user_url ="https://api.instagram.com/v1/users/".$row_rrss_ipe[3]."?access_token=".$row_rrss_ipe[6];
					      $json_user= file_get_contents($json_user_url);
					      $links_user_url= json_decode($json_user);
					      $followers_instagram = $links_user_url->data->counts->followed_by;
					      $reach+=$followers_instagram;
					      //$echoContentInsta = "<div class='rrss' 'name='instagram'><i class='pi -pi-instagram-alt'></i> Instagram <span>".$followers_instagram."</span></div>";
						  $echoContentInsta = "<div class='rrss' 'name='instagram'><i class='pi -pi-instagram-alt'></i> Instagram <span>".formato_numeros_reachs($followers_instagram)."</span></div>";

						}
						
						if($row_rrss_ipe[2]=='twitter'){
						    $settings = array(
						      'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
						      'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
						      'consumer_key' => TWITTER_CONSUMER_KEY,
						      'consumer_secret' => TWITTER_CONSUMER_SECRET
						    );
						    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
						    $requestMethod = 'GET';
						        $usuario1 = $row_rrss_ipe[3];
						        $getfield1 = '?id='.$usuario1;
						        $twitter1 = new TwitterAPIExchange($settings);
						        $follow_count1=$twitter1->setGetfield($getfield1)
						        ->buildOauth($ta_url, $requestMethod)
						        ->performRequest();
						        $data1 = json_decode($follow_count1, true);
						        $followers_count1=$data1[0]['user']['followers_count'];
						        $username=$data1[0]['user']['screen_name'];
						        $avatar= $data1[0]['user']['profile_image_url'];
						        $reach+=$followers_count1;	
								$echoContentTweet = "<div class='rrss' 'name='twitter'><i class='pi pi-twitter-alt'></i> Twitter <span>".formato_numeros_reachs($followers_count1)."</span></div>";
						}

						if($row_rrss_ipe[2]=='youtube'){
							$googleplusKey =GOOGLE_CONSUMER_KEY;
							$json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row_rrss_ipe[3]."&key=".$googleplusKey;
					        $json_user= file_get_contents($json_user_url);
					        $links_user_url= json_decode($json_user);
					        $youtubeSubscribers = $links_user_url->items[0]->statistics->subscriberCount;
							$reach+=$youtubeSubscribers;
							$echoContentYou = "<div class='rrss' name='youtube'>Youtube <span>".formato_numeros_reachs($youtubeSubscribers)."</span></div>";

						}

						if($row_rrss_ipe[2]=='googleplus'){
							$googleplusKey =GOOGLE_CONSUMER_KEY;
							$googleplusId = $row_rrss_ipe[3];
        					$json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
        					$json_user= file_get_contents($json_user_url);
					        $links_user_url= json_decode($json_user);
					        $googleplusSubscriber =$links_user_url->circledByCount;
							$reach+=$googleplusSubscriber;
							$echoContentPlus = "<div class='rrss' name='gogoleplus'><i class='pi pi-googleplus-alt'></i> Google Plus<span>".formato_numeros_reachs($googleplusSubscriber)."</span></div>";
						}
						
						if($row_rrss_ipe[2]=='analytics'){
							$analyticsPageViews=0;
							$query_analytics_page_views="SELECT PVDSK+PVMBL+PVTBLT FROM Analytics WHERE persona_id='".$row[0]."' AND id_estado=1";
							$result_analytics_page_views= mysqli_query($mysqli,$query_analytics_page_views)or die(mysqli_error());
							$rows_analytics_page_views= mysqli_fetch_array($result_analytics_page_views, MYSQLI_NUM);
							do{
								$reach+=$rows_analytics_page_views[0];
								$analyticsPageViews+=$rows_analytics_page_views[0];
							}while($rows_analytics_page_views = mysqli_fetch_array($result_analytics_page_views	));
						  	$echoContentAnaly = '<div class="rrss" name="analytics"><i class="pi pi-analytics-alt"></i>Analytics <span>'.formato_numeros_reachs($analyticsPageViews).'</span></div>';
						}


					}while($row_rrss_ipe = mysqli_fetch_array($result_rrss_ipe));
					echo '
						<div class="rrss_reach">
							<span>Reach<br/>total</span>
							<span>'.formato_numeros_reachs($reach).'</span>
						</div>
					</div>

					<div class="cotizar-opt">
						<span class="txt-cotiza">cotizar</span>
						<div class="checkbox-cotizar">
							<input id="cotizar-'.$row[0].'" class="switch-checkbox" name="'.$row[5].'"  value="'.$row[0].'" type="checkbox" />
							<label for="cotizar-'.$row[0].'" class="switch-label"></label>
						</div>
					</div>
					<div class="access-ipe">
						<span class="ver_perfil_influenciador" name="'.$row[0].'">ver resumen</span>
						<span class="volver_ver_perfil_influenciador" name="'.$row[0].'">ocutar resumen</span>

						<div class="ver-perfil"><span id="'.$row[0].'" class="perfil_influenciador">ver perfil</span>';
						if(strlen($echoContentFace)>1) echo $echoContentFace;
						if(strlen($echoContentInsta)>1) echo $echoContentInsta;
						if(strlen($echoContentTweet)>1) echo $echoContentTweet;
						if(strlen($echoContentAnaly)>1) echo $echoContentAnaly;
						if(strlen($echoContentYou)>1) echo $echoContentYou;
						if(strlen($echoContentPlus)>1) echo $echoContentPlus;						
				echo	'</div>
					</div>
				</form>';


		}while($row = mysqli_fetch_row($result));

		echo '</div><button id="cotizar_influenciador">cotizar</button>
		<script>
			$(document).ready(function(){
					
				$("#cotizar_influenciador").click(function(){
					var influenciadores_cotizados="";
					var influenciadores_cotizados_nombre ="";
					$("input:checked").each(function() {
						influenciadores_cotizados += this.value +",";
						influenciadores_cotizados_nombre += this.name +",";
					});
					var largo_string_influenciadores = influenciadores_cotizados.length - 1;
					var influenciadores_cotizados = influenciadores_cotizados.substring(0,largo_string_influenciadores);
					var array_id_influenciadores_seleccionados= influenciadores_cotizados.split(",");
					var array_nombre_influenciadores_seleccionados = influenciadores_cotizados_nombre.split(",");
					var agencia = "'.$_SESSION["nombre"].'";
					var correo_agencia = "'.$_SESSION["correo"].'";
					var influenciador = this.name;
					var campana = $("#campanas-postulables option:selected").val();
					var id_campana = $("#campanas-postulables option:selected").attr("id");
					if(campana =="Seleccione campaña") campana = "Sin especificar";
					for(var i=0; i<array_id_influenciadores_seleccionados.length; i++){
						var influenciador_id=array_id_influenciadores_seleccionados[i];
						var influenciador= array_nombre_influenciadores_seleccionados[i];
						$.ajax({
							type: "POST",
							url: "contactar.php",
							data: "agencia="+agencia+"&correo_agencia="+correo_agencia+"&influenciador="+influenciador+"&influenciador_id="+influenciador_id+"&campana="+campana+"&id_campana="+id_campana,
							success: function(data){
								//$("#campanas-postulables").hide();
								//$("#campanas-postulables").show();
								//$("#opc_cot").show();
								$(".boton_cotizar").show();
								//$("#campanas-postulables").hide();
							$("input:checkbox").removeAttr("checked");

								
							}
						});

					}
					if(array_id_influenciadores_seleccionados.length == 1 ){
						$(".alertElim").fadeIn("normal",function(){
							$("#boxElim .hrefCamp h2").text("Influenciador agregado");
							$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
							$("#boxElim .hrefCamp p").text("La cotizacion a sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
							$(".siElim").text("Ir a campañas");
							$(".noElim").text("Ver Influenciadores");

							$("#boxElim").show().animate({
								top:"20%",
								opacity:1
							},{duration:1500,easing:"easeOutBounce"});

							$(".siElim").on("click",function(){

								window.location.href = "campana.php";
							});

							$(".noElim").on("click",function(){
								$("#boxElim").animate({
									top:"-100px",
									opacity:0
								},{duration:500,easing:"easeInOutQuint",complete:function(){
									$(".alertElim").fadeOut("fast");
									$(this).hide();
								}});
							});
						});
					}
					if(array_id_influenciadores_seleccionados.length > 1 ){
						$(".alertElim").fadeIn("normal",function(){
							$("#boxElim .hrefCamp h2").text("Influenciador agregado");
							$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
							$("#boxElim .hrefCamp p").text("La cotizacion a sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
							$(".siElim").text("Ir a campañas");
							$(".noElim").text("Ver Influenciadores");

							$("#boxElim").show().animate({
								top:"20%",
								opacity:1
							},{duration:1500,easing:"easeOutBounce"});

							$(".siElim").on("click",function(){

								window.location.href = "campana.php";
							});

							$(".noElim").on("click",function(){
								$("#boxElim").animate({
									top:"-100px",
									opacity:0
								},{duration:500,easing:"easeInOutQuint",complete:function(){
									$(".alertElim").fadeOut("fast");
									$(this).hide();
								}});
							});
						});
					}
				});

				$(".ver_perfil_influenciador").click(function(){

					var id_form=$(this).attr("name");

					$("#"+id_form+" .rrss").show();
	
					var a = $("#"+id_form+" .access-ipe .rrss_reach").text();
					var b = $("#"+id_form+" .access-ipe .rrss_reach span:last-child").text();
					
					//$("#"+id_form+" .rrss").show();

					//$("#"+id_form+" .access-ipe ").prepend("<div><span>Reach total </span> <span>"+b+"</span></div>");
					//$("#"+id_form+" .access-ipe div:first-child").addClass("rrss_reachs");
					//$("#"+id_form+" .access-ipe .rrss_reach").hide();
					$("#"+id_form+" .ver_perfil_influenciador").hide();
					$("#"+id_form+" .volver_ver_perfil_influenciador").show();
				});

				$(".volver_ver_perfil_influenciador").click(function(){
					
					var id_form=$(this).attr("name");
					$("#"+id_form+" .rrss").hide();
					$("#"+id_form+" .access-ipe div:first-child").remove();
					$("#"+id_form+" .access-ipe .rrss_reach").show();
					$("#"+id_form+" .ver_perfil_influenciador").show();
					$("#"+id_form+" .volver_ver_perfil_influenciador").hide();
				});
			});
		</script>';
	}else{
		echo '<main class="no-campana">
						<a href="nueva-campana.php" class="hrefCamp">
							<i class="fa fa-warning"></i>
							<h2>Ups, no hay influenciadores</h2>
							<p>Puedes seguir modificando o crear nuevas campañas y cotizar, pronto agregaremos más influenciadores.</p>
						</a>
					</main>';
	}
//}



?>

<?php include 'footer.php'; ?>

</body>
</html>