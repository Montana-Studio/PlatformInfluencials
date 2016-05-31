<?php 
    include 'header-agencia.php'; 
    
    $query_campana='SELECT DISTINCT * FROM campana WHERE id="'.$_GET['id'].'" AND nombre="'.$_GET["campana"].'"';
	$result_campana=mysqli_query($mysqli,$query_campana)or die (mysqli_erroxr($mysqli));
	$row_campana= mysqli_fetch_array($result_campana, MYSQLI_BOTH);
	$num_row_campana= mysqli_num_rows($result_campana);

    if($_GET['campana']!='Sin-Especificar'){
?>
        <div id="loadBox" style="display:none;">
            <div id="campanas-postulables">
                <h2 class="sub-titulo">Selecciona una campaña</h2>
                <p class="bajadas-info">En el listado siguiente de campañas activas, podrás seleccionar al influenciador que quieres cotizar.</p>
                <select id="campana_seleccionada">
                    <option selected="selected" id="<?php echo $_GET['id_campana']; ?>" disabled><?php echo $_GET['campana']; ?></option>
                </select>
                <i class="pi pi-arrow-bottom"></i>
            </div>
    
<?php }else{ ?>
            <div id="loadBox" style="display:none;">
                <div id="campanas-postulables">
                    <div class="titles-cont">
                        <h2 class="sub-titulo">Selecciona una campaña para cotizar</h2>
                        <p class="bajadas-info">En el listado siguiente de campañas activas, podrás seleccionar al influenciador que quieres cotizar.</p>
                    </div>	
                    <select id="campana_seleccionada">
                    <option id="0">Cotizar sin campaña</option>   
<?php 
        if ($num_rows2 > 0){
            do{
                echo '<option id="'.$row2[0].'" value="'.$row2[1].'">'.$row2[1].'</option>';
			}while($row2 = mysqli_fetch_row($result2));
        }
        echo '</select><i class="pi pi-arrow-bottom"></i></div>';
    }
    
    if ($num_rows > 0){
?>
        <div class="titles-cont">
            <h2 class="sub-titulo">Influenciadores</h2>
            <p class="bajadas-info">En la siguiente  lista podrás cotizar al  influenciador  (puede ser más de uno)  que te ayudará a potenciar tu campaña.</p>
        </div>
        <div class="influenciadores">
<?php
        do{
?>
            <form id="<?php echo $row[0]; ?>" class="contactarForm" name="<?php echo $row[5]; ?>">
                <div class="img-user" style="background-image:url(<?php if(strpos($row[12],'graph')){ echo $row[12]; }else{ echo '../../'.$row[12]; } ?>);"></div>
                <div class="info-influ">
                    <h2 class="nombre"><?php echo $row[5]; ?></h2>
                    <small class="ubicacion"><i class="pi pi-marker"></i> <?php echo $row[16].','.substr($row[15],7); ?></small>
                    <small class="tipo"><i class="pi pi-user"></i> <?php echo $row[2]; ?></small> 
<?php
                    include_once('rrss/rrss_keys.php');
                    $query_rrss_ipe='SELECT * FROM rrss WHERE persona_id="'.$row[0].'" AND id_estado=1 ORDER BY descripcion_rrss';
                    $result_rrss_ipe= mysqli_query($mysqli,$query_rrss_ipe)or die(mysqli_error());
                    $row_rrss_ipe= mysqli_fetch_array($result_rrss_ipe, MYSQLI_NUM);
                    $reach=0;
                    $reach_facebook=0;
                    $reach_instagram=0;
                    $reach_twitter=0;
                    $reach_youtube=0;
                    $reach_googleplus=0;
                    $reach_analytics=0;
                    $echoContentFace=0;
                    $echoContentInsta=0;
                    $echoContentTweet=0;
                    $echoContentAnaly=0;
                    $echoContentYou=0;
                    $echoContentPlus=0;
                    do{
                        if($row_rrss_ipe[2]==='facebook'){
                            $facebookPage=$row_rrss_ipe[3];
                            $facebookKey =FACEBOOK_CONSUMER_KEY;
                            $facebookAppId = FACEBOOK_APP_ID;
                            $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
                            $json_user_url = str_replace(" ", "%20", $json_user_url1);
                            $json_user= @file_get_contents($json_user_url);
                            $links_user_url= json_decode($json_user);
                            $facebookLikes =$links_user_url->likes;
                            $reach_facebook += $facebookLikes;
                            $reach+=$facebookLikes;
                            $echoContentFace = '<div class="rrss" name="facebook"><i class="pi pi-facebook-alt"></i> Facebook <span>'.formato_numeros_reachs($reach_facebook).'</span></div>';

                        }

                        if($row_rrss_ipe[2]=='instagram'){
                          $json_user_url ="https://api.instagram.com/v1/users/".$row_rrss_ipe[3]."?access_token=".$row_rrss_ipe[6];
                          $json_user= @file_get_contents($json_user_url);
                          $links_user_url= json_decode($json_user);
                          $followers_instagram = $links_user_url->data->counts->followed_by;
                          $reach+=$followers_instagram;
                          $reach_instagram+=$followers_instagram;
                          //$echoContentInsta = "<div class='rrss' 'name='instagram'><i class='pi -pi-instagram-alt'></i> Instagram <span>".$followers_instagram."</span></div>";
                          $echoContentInsta = "<div class='rrss' 'name='instagram'><i class='pi pi-instagram-alt'></i> Instagram <span>".formato_numeros_reachs($reach_instagram)."</span></div>";

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
                            $reach_twitter+=$followers_count1;
                            $echoContentTweet = "<div class='rrss' 'name='twitter'><i class='pi pi-twitter-alt'></i> Twitter <span>".formato_numeros_reachs($reach_twitter)."</span></div>";
                        }

                        if($row_rrss_ipe[2]=='youtube'){
                            $googleplusKey =GOOGLE_CONSUMER_KEY;
                            $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row_rrss_ipe[3]."&key=".$googleplusKey;
                            $json_user= @file_get_contents($json_user_url);
                            $links_user_url= json_decode($json_user);
                            $youtubeSubscribers = $links_user_url->items[0]->statistics->subscriberCount;
                            $reach+=$youtubeSubscribers;
                            $reach_youtube+=$youtubeSubscribers;
                            $echoContentYou = "<div class='rrss' name='youtube'><i class='pi pi-youtube-alt'></i> Youtube <span>".formato_numeros_reachs($reach_youtube)."</span></div>";
                        }

                        if($row_rrss_ipe[2]=='googleplus'){
                            $googleplusKey =GOOGLE_CONSUMER_KEY;
                            $googleplusId = $row_rrss_ipe[3];
                            $json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
                            $json_user= @file_get_contents($json_user_url);
                            $links_user_url= json_decode($json_user);
                            $googleplusSubscriber =$links_user_url->circledByCount;
                            $reach+=$googleplusSubscriber;
                            $reach_googleplus+=$googleplusSubscriber;
                            $echoContentPlus = "<div class='rrss' name='gogoleplus'><i class='pi pi-googleplus-alt'></i> Google Plus<span>".formato_numeros_reachs($reach_googleplus)."</span></div>";
                        }

                        if($row_rrss_ipe[2]=='analytics'){
                            $analyticsPageViews=0;
                            $query_analytics_page_views="SELECT PVDSK+PVMBL+PVTBLT FROM Analytics WHERE persona_id='".$row[0]."' AND id_estado=1";
                            $result_analytics_page_views= mysqli_query($mysqli,$query_analytics_page_views)or die(mysqli_error());
                            $rows_analytics_page_views= mysqli_fetch_array($result_analytics_page_views, MYSQLI_NUM);
                            do{
                                $reach+=$rows_analytics_page_views[0];
                                $reach_analytics+=$rows_analytics_page_views[0];
                            }while($rows_analytics_page_views = mysqli_fetch_array($result_analytics_page_views	));
                            $echoContentAnaly = '<div class="rrss" name="analytics"><i class="pi pi-analytics-alt"></i>Analytics <span>'.formato_numeros_reachs($reach_analytics).'</span></div>';
                        }

                    }while($row_rrss_ipe = mysqli_fetch_array($result_rrss_ipe));
?>
                    <div class="rrss_reach">
                        <span>Reach<br/>total</span>
                        <span><?php echo formato_numeros_reachs($reach); ?></span>
                    </div>
                </div>

                <div class="cotizar-opt">
                    <span class="txt-cotiza">cotizar</span>
                    <div class="checkbox-cotizar">
                        <input id="<?php echo 'cotizar-'.$row[0]; ?>" class="switch-checkbox" name="<?php echo $row[5]; ?>"  value="<?php echo $row[0]; ?>" type="checkbox" />
                        <label for="<?php echo 'cotizar-'.$row[0]; ?>" class="switch-label"></label>
                    </div>
                </div>
                <div class="access-ipe">
                    <span class="ver_perfil_influenciador" name="<?php echo $row[0]; ?>">ver resumen</span>
                    <span class="volver_ver_perfil_influenciador" name="<?php echo $row[0]; ?>">ocutar resumen</span>

                    <!--div class="ver-perfil">
                        <span id="<?php echo $row[0]; ?>" class="perfil_influenciador">ver perfil</span-->
<?php
                        if(strlen($echoContentFace)>1) echo $echoContentFace;
                        if(strlen($echoContentInsta)>1) echo $echoContentInsta;
                        if(strlen($echoContentTweet)>1) echo $echoContentTweet;
                        if(strlen($echoContentAnaly)>1) echo $echoContentAnaly;
                        if(strlen($echoContentYou)>1) echo $echoContentYou;
                        if(strlen($echoContentPlus)>1) echo $echoContentPlus;
?>
                    <!--/div-->
                </div>
            </form>
<?php
        }while($row = mysqli_fetch_row($result));
?>
        </div>
        <button id="cotizar_influenciador">cotizar</button>
    </div>
    <script>
        jQuery(document).ready(function($){

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
                var agencia = "<?php echo $_SESSION["nombre"]; ?>";
                var correo_agencia = "<?php echo $_SESSION["correo"]; ?>";
                var influenciador = this.name;
                var campana = $("#campanas-postulables option:selected").val();
                var id_campana = $("#campanas-postulables option:selected").attr("id");
                var tipo ="perfiles";
                if(campana =="Seleccione campaña") campana = "Sin especificar";

                for(var i=0; i<array_id_influenciadores_seleccionados.length; i++){
                    var influenciador_id=array_id_influenciadores_seleccionados[i];
                    var influenciador= array_nombre_influenciadores_seleccionados[i];
                    $.ajax({
                        type: "POST",
                        url: "../../controller/contactar-a-influenciador-agencia.php",
                        data: "agencia="+agencia+"&correo_agencia="+correo_agencia+"&influenciador="+influenciador+"&influenciador_id="+influenciador_id+"&campana="+campana+"&id_campana="+id_campana+"&tipo="+tipo,
                        success: function(data){
                            $(".boton_cotizar").show();
                            $("input:checkbox").removeAttr("checked");
                        }
                    });

                }
                if(array_id_influenciadores_seleccionados.length == 1 ){

                    $(".alertElim").fadeIn("normal",function(){
                        $("#boxAlert .hrefCamp h2").text("Influenciador agregado");
                        $("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

                        $("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
                        $("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

                        success();

                        $("#boxAlert .hrefCamp p").text("La cotizacion ha sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");

                        $(".siElim").text("Ir a campañas");
                        $(".noElim").text("Ver Influenciadores");

                        $("#boxAlert").show().animate({
                            top:"20%",
                            opacity:1
                        },{duration:1500,easing:"easeOutBounce"});

                        $(".siElim").on("click",function(){

                            window.location.href = "../../campanas.php";
                        });

                        $(".noElim").on("click",function(){
                            $("#boxAlert").animate({
                                top:"-100px",
                                opacity:0
                            },{duration:500,easing:"easeInOutQuint",complete:function(){
                                $(".alertElim").fadeOut("fast");
                                $("#ico-handLike, .btn_crearcamp").remove();
                                $("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
                                $(this).hide();
                            }});
                        });
                    });
                }
                if(array_id_influenciadores_seleccionados.length > 1 ){

                    $(".alertElim").fadeIn("normal",function(){
                        $("#boxAlert .hrefCamp h2").text("Influenciador agregado");
                        $("#boxAlert .hrefCamp").prepend("<div id='ico-handLike'></div>");

                        $("#boxAlert .hrefCamp").append("<div class='btn_crearcamp siElim'></div>");
                        $("#boxAlert .hrefCamp").append("<div class='btn_crearcamp noElim'></div>");

                        success();

                        $("#boxAlert .hrefCamp p").text("La cotizacion ha sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");

                        $(".siElim").text("Ir a campañas");
                        $(".noElim").text("Ver Influenciadores");

                        $("#boxAlert").show().animate({
                            top:"20%",
                            opacity:1
                        },{duration:1500,easing:"easeOutBounce"});

                        $(".siElim").on("click",function(){

                            window.location.href = "../../campanas.php";
                        });

                        $(".noElim").on("click",function(){
                            $("#boxAlert").animate({
                                top:"-100px",
                                opacity:0
                            },{duration:500,easing:"easeInOutQuint",complete:function(){
                                $(".alertElim").fadeOut("fast");
                                $("#ico-handLike, .btn_crearcamp").remove();
                                $("#boxAlert .hrefCamp h2, #boxAlert .hrefCamp p.messageAlert").empty();
                                $(this).hide();
                            }});
                        });
                    });
                }
            });
        });
    </script>
<?php
    }else{
?>
    <main class="no-campana">
        <a href="#" class="hrefCamp">
            <i class="fa fa-warning"></i>
            <h2>Ups, no hay influenciadores</h2>
            <p>Puedes seguir modificando o crear nuevas campañas y cotizar, pronto agregaremos más influenciadores.</p>
        </a>
    </main>
<?php        
    }

    include 'footer-agencia.php'; 
?>
</body>
</html>