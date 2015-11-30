<?php

		$query="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."'";
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);

		$query2="SELECT DISTINCT * FROM campana WHERE id= (SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."') AND idEstado='1'";
		$result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
		$row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
		$num_row2=mysqli_num_rows($result2);

		$query3="SELECT DISTINCT descripcion_rrss FROM rrss WHERE persona_id= '".$_SESSION['id']."'";
		$result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
		$row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
		$num_row3=mysqli_num_rows($result3);

		$query4="SELECT DISTINCT * FROM campana WHERE id= (SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."') AND idEstado='0'";
		$result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
		$ro4= mysqli_fetch_array($result4, MYSQLI_BOTH);
		$num_row4=mysqli_num_rows($result4);


	if ($num_row2 > 0){
		$campanas_activas .= '<div class="creadas">';
		do{
			$campanas_activas .= '
			<div class="recientes">
						<div class="cont-campana">
							<div class="bg-campana" style="background-image:url('.$row2[3].');">
								<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>
								<div class="edit-campana" style="display:none;float:left;clear:both;"></div>
							</div>
							<div class="ver-mas"><span><i class="fa fa-angle-down"></i><i class="fa fa-plus"></i></span></div>

							<div class="content">
								<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
								<form class="campanaForm" id="'.$row2[0].'">

									<div class="inputs-campana nombre nombre-campana" id="'.$row2[0].'">
										<input placeholder="'.$row2[1].'" disabled />
									</div>

									<div class="inputs-campana marca marca-campana" id="'.$row2[0].'">
										<input  placeholder="by '.$row2[4].'" disabled />
									</div>

									<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row2[7].'- Término '.$row2[8].'</i></span>
									<div class="inputs-campana descripcion descripcion-campana" id="'.$row2[0].'">
										<textarea placeholder="descripcion" disabled>'.$row2[2].'</textarea>
									</div>

									<div id="ingresar_urls">
									<h3>Ingresa tus URLs marcadas</h3>';
									do{
									$campanas_activas .='
										<h3>'.$row3[0].'</h3>
										<input></input>';
									}while($row3 = mysqli_fetch_row($result3));
									$campanas_activas .= '
									<button class="btns" type="submit" id="enviar_url">Enviar URLs</button>
									</div>
								</form>
								<div class="img-compana-deskt hide">
										<img src="'.$row2[3].'"/>
								</div>
							</div>
						</div>
					</div>
			';
		}while($row2 = mysqli_fetch_row($result2));
		$campanas_activas .= '
		</div>';
	}else{
		$campanas_activas = '
		<div class="recientes">
						<div class="cont-campana">
						No registra campañas asociadas
						</div>
		</div>';
	}

		if ($num_row2 > 0){
		$campanas_activas .= '<div class="creadas">';
		do{
			$campanas_activas .= '
			<div class="recientes">
						<div class="cont-campana">
							<div class="bg-campana" style="background-image:url('.$row2[3].');">
								<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>
								<div class="edit-campana" style="display:none;float:left;clear:both;"></div>
							</div>
							<div class="ver-mas"><span><i class="fa fa-angle-down"></i><i class="fa fa-plus"></i></span></div>

							<div class="content">
								<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
								<form class="campanaForm" id="'.$row2[0].'">

									<div class="inputs-campana nombre nombre-campana" id="'.$row2[0].'">
										<input placeholder="'.$row2[1].'" disabled />
									</div>

									<div class="inputs-campana marca marca-campana" id="'.$row2[0].'">
										<input  placeholder="by '.$row2[4].'" disabled />
									</div>

									<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row2[7].'- Término '.$row2[8].'</i></span>
									<div class="inputs-campana descripcion descripcion-campana" id="'.$row2[0].'">
										<textarea placeholder="descripcion" disabled>'.$row2[2].'</textarea>
									</div>

									<div id="ingresar_urls">
									<h3>Ingresa tus URLs marcadas</h3>';
									do{
									$campanas_activas .='
										<h3>'.$row3[0].'</h3>
										<input></input>';
									}while($row3 = mysqli_fetch_row($result3));
									$campanas_activas .= '
									<button class="btns" type="submit" id="enviar_url">Enviar URLs</button>
									</div>
								</form>
								<div class="img-compana-deskt hide">
										<img src="'.$row2[3].'"/>
								</div>
							</div>
						</div>
					</div>
			';
		}while($row2 = mysqli_fetch_row($result2));
		$campanas_activas .= '
		</div>';
	}else{
		$campanas_historial = '
		<div class="recientes">
						<div class="cont-campana">
						No registra campañas asociadas
						</div>
		</div>';
	}
?>