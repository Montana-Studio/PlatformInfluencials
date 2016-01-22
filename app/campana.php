<?php include 'header.php'; ?>
<?php
	echo '<script>
			$(document).ready(function(){
				$(".activar-campana").click(function (){
						var idActualizar = this.id;
						var idEstado = this.type;
						var tipo = "activar";
						var fecha_termino = $("#"+idActualizar+" .campa-ico .fecha_termino").val();
							$.ajax({
								type: "POST",
								url: "procesar_eliminar-campana.php",
								data: "idActualizar="+idActualizar+"&idEstado="+idEstado+"&tipo="+tipo+"&fecha_termino="+fecha_termino,
								success: function(data){
									window.location.reload();
								}
							});
				});
				$(".btneliminar").click(function (){
					var idEliminar = this.id;
					var tipo = "eliminar";
					$(".alertElim").fadeIn("normal",function(){
							$("#boxElim .hrefCamp h2").text("Estas a punto de eliminar la campaña");
							animaTrash();
							setInterval(function(){
								animaTrash();
							},2800);
							//$("#boxElim .hrefCamp i").addClass("fa-trash-o");
							$("#boxElim .hrefCamp p").text("Si eliminas tu campaña, pederas tus datos sin posibilidad de recuperarlos.");
							$(".siElim").text("eliminar campaña");
							$(".noElim").text("volver");
							$("#boxElim").show().animate({
								top:"20%",
								opacity:1
							},{duration:1500,easing:"easeOutBounce"});
							$(".siElim").on("click",function(){
								$.ajax({
									type: "POST",
									url: "procesar_eliminar-campana.php",
									data: "idEliminar="+idEliminar+"&tipo="+tipo,
									success: function(data){
										window.location.reload();
									}
								});
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
					return false;
				});
				var foto;
				$(".file").click(function (){
					foto = "1";
				});
				var idAgencia = '.$_SESSION["id"].';
				var correo ="'.$_SESSION["correo"].'";
				var rsid ="'.$_SESSION["rsid"].'";
				var tipo ="imagen";
				$(".campanaForm").on("submit",(function (e){
					e.preventDefault();
					var info = new FormData(this);
					var id = this.id;
					var nombre = $("#"+id+" .nombre input").val();
					var marca = $("#"+id+" .marca input").val();
					var fecha_termino = $("#"+id+" .campa-ico .fecha_termino").val();
					var descripcion = $("#"+id+" #descripcion-campana-"+id+" textarea").val();					
					info.append("nombre",nombre);
					info.append("marca",marca);
					info.append("descripcion",descripcion);
					info.append("idCampana",this.id);
					info.append("idpersona",idAgencia);
					info.append("tipo",tipo);
					info.append("campana",this.id);
					info.append("id",idAgencia);
					info.append("foto",foto);
					info.append("fecha_termino", fecha_termino);
					$.ajax({
							type: "POST",
							url: "procesar_imagen.php",
							data: info,
							enctype: "multipart/form-data",
							contentType: false,
							cache: false,
							processData:false,
						success: function(data){
								switch (data){
									case "nuevo":$(".alertElim").fadeIn("normal",function(){
													$("#boxAlert .hrefCamp h2").text("Campaña editada con exito");
													animaMune();
													animaMano();
													setInterval(function(){
														animaMune();
														animaMano();
													},2800);
													//$("#boxAlert .hrefCamp i").addClass("fa-thumbs-o-up");
													$("#boxAlert .hrefCamp p.messageAlert").text("Puedes seguir editando o crear más campañas.");
													$("#boxAlert").show().animate({
														top:"20%",
														opacity:1
													},{duration:1500,easing:"easeOutBounce"});
													$("#clearAlert").on("click",function(){
														$("#boxAlert").animate({
															top:"-100px",
															opacity:0
														},{duration:500,easing:"easeInOutQuint",complete:function(){
															$(".alertElim").fadeOut("fast");
															window.location.reload();
														}});
													});
											});
									break;
									default: $(".alertElim").fadeIn("normal",function(){
													$("#boxAlert .hrefCamp h2").text("algo anda mal");
													$("#boxAlert .hrefCamp i").addClass("fa-warning");
													$("#boxAlert .hrefCamp p.messageAlert").text("Formato no corresponde o el peso supera los 200kb");
													$("#boxAlert").show().animate({
														top:"20%",
														opacity:1
													},{duration:1500,easing:"easeOutBounce"});
													$("#clearAlert").on("click",function(){
														$("#boxAlert").animate({
															top:"-100px",
															opacity:0
														},{duration:500,easing:"easeInOutQuint",complete:function(){
															$(".alertElim").fadeOut("fast");
															$(this).hide();
														}});
													});
											});
									break;
								}
						}
					});
				}));
				$(".ir_a_cotizar_influenciador").click(function(){
					var campana_seleccionada=this.id;
					var campana_seleccionada_id=this.name;
					window.location.replace("influenciador-publico.php?campana="+campana_seleccionada+"&id_campana="+campana_seleccionada_id);
				});
			});
		</script>';
	if ($num_rows > 0){
		echo '<h2 class="sub-titulo">campañas activas</h2><div class="creadas">';
	do{
		echo '
		<div class="recientes">
					<div class="cont-campana">
							<div class="bg-campana" style="background-image:url('.$row[3].');">
								<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>
								<div class="edit-campana" style="display:none;float:left;clear:both;"></div>
							</div>
							<div class="ver-mas"><span><i class="pi pi-arrow-bottom"></i><i class="pi pi-plus"></i></span></div>
							<div class="content">
								<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
								<form class="campanaForm" id="'.$row[0].'">
									<ul class="tools-campana">
										<li class="activar-campana" type="1" id="'.$row[0].'" >
											<i class="tool-ico pi pi-recived"></i><span class="tool-txt"> desactivar</span>
										</li>
										<li class="cotizar-campana" style="border-left:none;">
											<i class="tool-ico pi pi-user"></i><a class="tool-txt ir_a_cotizar_influenciador" name="'.$row[0].'" id="'.$row[1].'">cotizar</a>
										</li>
									</ul>
									<div class="inputs-campana nombre nombre-campana" id="'.$row[0].'">
										<input placeholder="'.$row[1].'" disabled />
									</div>
									<div class="inputs-campana marca marca-campana" id="'.$row[0].'">
										<input  placeholder="by '.$row[4].'" disabled />
									</div>
									<span class="campa-ico activada"><i class="pi pi-tool"></i>Activada</span>
									
									<span class="campa-ico fecha-activada">
										<i class="pi pi-calendar"></i> Inicio <span>'.$row[7].'</span> al <span>'.$row[8].'</span>
									</span>
															
									
									<div class="inputs-campana descripcion descripcion-campana" id="'.$row[0].'">
										<textarea placeholder="descripcion" disabled>'.$row[2].'</textarea>
									</div>
									<!--button class="guardar-campana" type="submit" id="guardar-campana-'.$row[0].'">Guardar Cambios en '.$row[1].'</button-->
								</form>
								<div class="img-compana-deskt hide">
									<img src="'.$row[3].'"/>
								</div>
							</div>
                            <script>
                                $(document).ready(function(){
                                    $(".ver-mas-metrics").on("click",function(event){
                                        $(this).siblings(".redes-metrics .data ul li").slideDown();
                                    });
                                });
                            </script>
                            <div id="redes_sociales_campana_'.$row[0].'" class="reach-campana">
                                <h2 class="sub-titulo">Metricas de la campaña</h2>';
                                require('procesar_mostrar_reach_campana.php');
                                
        echo '              </div>
					</div>
				</div>
		';
	}while($row = mysqli_fetch_row($result));
	echo '</div>';
	}
	if ($num_rows2 > 0){
		echo '<h2 class="sub-titulo">campañas inactivas</h2><div class="creadas">';
	do{
		echo '
			<div class="recientes">
				<div class="cont-campana">
					<div class="bg-campana" style="background-image:url('.$row2[3].');">
						<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>
					</div>
					<div class="ver-mas">
						<span>
							<i class="pi"></i>
						</span>
					</div>
					<div class="content">
						<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
						<form class="campanaForm" id="'.$row2[0].'">
							<ul class="tools-campana">
								<li class="cotizar-campana"><i class="tool-ico pi pi-user"></i><a class="tool-txt ir_a_cotizar_influenciador" name="'.$row2[0].'" id="'.$row2[1].'">cotizar</a></li>
								<li class="edit-campanas"><i class="tool-ico pi pi-pencil"></i><span class="tool-txt"> editar</span></li>
								<li class="activar-campana" id="'.$row2[0].'" name="0"><i class="tool-ico pi pi-send"></i><span class="tool-txt"> activar</span></li>
								<li class="btneliminar" id="'.$row2[0].'"><i class="tool-ico pi pi-trash"></i><span class="tool-txt"> eliminar</span></li>
							</ul>
							<div class="inputs-campana nombre" id="nombre-campana-'.$row2[0].'">
								<input placeholder="'.$row2[1].'" class="nombre-input" disabled></input>
								<i class="pi pi-pencil"></i>
							</div>
							<div class="inputs-campana marca" id="marca-campana-'.$row2[0].'">
								 <input placeholder="by '.$row2[4].'" disabled></input>
								 <i class="pi pi-pencil"></i>
							</div>
							<span class="campa-ico"><i class="pi pi-tool"></i>Desactivada</span>
							<span class="campa-ico">
								<i class="pi pi-calendar"></i>
								Fecha término 
								<input class="fecha_termino" type="text" id="datepicker" value="'.$row2[8].'">
								<i class="fecha-edit pi pi-pencil"></i>
							</span>
							<div class="inputs-campana descripcion" id="descripcion-campana-'.$row2[0].'">
								<textarea placeholder="descripcion" disabled>'.$row2[2].'</textarea>
								<i class="pi pi-pencil"></i>
							</div>
										
							<script>
								$(window).load(function(){
									$("div.jfilestyle").hide();
								});
							</script>
							<input type="file" name="file" class="jfilestyle upload-img-campana file" data-input="false" id="file'.$row2[0].'" data-buttonText="subir archivo"/>
							<button class="guardar-campana" type="submit" id="guardar-campana-'.$row2[0].'">Guardar Campaña</button>
						</form>
						<div class="img-compana-deskt hide">
							<img src="'.$row2[3].'"/>
						</div>
					</div>
				</div>
			</div>
		';
	}while($row2 = mysqli_fetch_row($result2));
	echo '</div>';
	}
?>
</div>
<?php
	if($num_rows == 0 && $num_rows2 == 0){
		echo '<main class="no-campana"><a href="nueva-campana.php" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
	}
?>
	<div id="contacto" class="hide">
		<h2>Contacto</h2>
			<input placeholder="asunto"></input>
		<div>
			<textarea  placeholder="descripcion" rows=10 cols=40></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>