<?php

		$query="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."'";
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);

		$query2="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."' AND estado_solicitud='1'";
		$result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
		$row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
		$num_row2=mysqli_num_rows($result2);

		$query_rrss="SELECT DISTINCT * FROM rrss WHERE persona_id='".$_SESSION['id']."' ";
		$results_rrss=mysqli_query($mysqli,$query_rrss)or die (mysqli_error());
		$row_rrss= mysqli_fetch_array($results_rrss, MYSQLI_BOTH);
		$num_rows_rrss=mysqli_num_rows($results_rrss);


if($num_row2>0){
	
	$query3="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_inicio_server <= now()";
	$result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
	$row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
	$num_row3=mysqli_num_rows($result3);
	if ($num_row3 > 0){
		$campanas_activas .= '<div class="creadas">';
		do{
			$campanas_activas .= '
			<div class="recientes">
				<div class="cont-campana">
					<div class="bg-campana" style="background-image:url('.$row3[3].');">
						<h3>'.$row3[1].'<span>by '.$row3[4].'</span></h3>
						<div class="edit-campana" style="display:none;float:left;clear:both;"></div>
					</div>
					<div class="ver-mas"><span><i class="fa fa-angle-down"></i><i class="fa fa-plus"></i></span></div>

					<div class="content">
						<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
						<form class="campanaForm" id="'.$row3[0].'">

							<div class="inputs-campana nombre nombre-campana" id="'.$row3[0].'">
								<input placeholder="'.$row3[1].'" disabled />
							</div>

							<div class="inputs-campana marca marca-campana" id="'.$row3[0].'">
								<input  placeholder="by '.$row3[4].'" disabled />
							</div>

							<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row3[7].'- Término '.$row3[8].'</i></span>
							<div class="inputs-campana descripcion descripcion-campana" id="'.$row3[0].'">
								<textarea placeholder="descripcion" disabled>'.$row3[2].'</textarea>
							</div>

							<div id="ingresar_urls">
							<h3>Ingresa tus URLs marcadas</h3>';
							do{
							$campanas_activas .='
								<h3>'.$row_rrss[2].'</h3>
								<input></input>';
							}while($row_rrss = mysqli_fetch_row($results_rrss));
							$campanas_activas .= '
							<button class="btns" type="submit" id="enviar_url">Enviar URLs</button>
							</div>
						</form>
						<div class="img-compana-deskt hide">
								<img src="'.$row3[3].'"/>
						</div>
					</div>
				</div>
			</div>
			';
		}while($row3 = mysqli_fetch_row($result3));
		$campanas_activas .= '
		</div>';
	}else{
		$campanas_activas = '
		<div class="recientes">
						<div class="cont-campana">
						No registra campañas asociadas actualmente
						</div>
		</div>';

	}

	$query4="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_inicio_server > now()";
	$result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
	$row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
	$num_row4=mysqli_num_rows($result4);
	if ($num_row4 > 0){
		$campanas_inactivas .= '<div class="creadas">';
		do{
			$campanas_inactivas .= '
			<div class="recientes">
						<div class="cont-campana">
							<div class="bg-campana" style="background-image:url('.$row4[3].');">
								<h3>'.$row4[1].'<span>by '.$row4[4].'</span></h3>
								<div class="edit-campana" style="display:none;float:left;clear:both;"></div>
							</div>
							<div class="ver-mas"><span><i class="fa fa-angle-down"></i><i class="fa fa-plus"></i></span></div>

							<div class="content">
								<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
								<form class="campanaForm" id="'.$row4[0].'">

									<div class="inputs-campana nombre nombre-campana" id="'.$row4[0].'">
										<input placeholder="'.$row4[1].'" disabled />
									</div>

									<div class="inputs-campana marca marca-campana" id="'.$row4[0].'">
										<input  placeholder="by '.$row4[4].'" disabled />
									</div>

									<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row4[7].'- Término '.$row4[8].'</i></span>
									<div class="inputs-campana descripcion descripcion-campana" id="'.$row4[0].'">
										<textarea placeholder="descripcion" disabled>'.$row4[2].'</textarea>
									</div>

									<div id="ingresar_urls">
									<h3>Ingresa tus URLs marcadas</h3>';
									/*do{
									$campanas_inactivas .='
										<h3>'.$row4[0].'</h3>
										<input></input>';
									}while($row4 = mysqli_fetch_row($result3));*/
									$campanas_inactivas .= '
									<button class="btns" type="submit" id="enviar_url">Enviar URLs</button>
									</div>
								</form>
								<div class="img-compana-deskt hide">
										<img src="'.$row4[3].'"/>
								</div>
							</div>
						</div>
					</div>
			';
		}while($row4 = mysqli_fetch_row($result4));
		$campanas_inactivas .= '
		</div>';
	}else{
		$campanas_inactivas = '
		<div class="recientes">
						<div class="cont-campana">
						No tiene campañas pendientes por iniciar
						</div>
		</div>';
	}

}else{

	$campanas_activas = '
		<div class="recientes">
						<div class="cont-campana">
						No tiene campañas pendientes
						</div>
		</div>';

	$campanas_inactivas = '
		<div class="recientes">
						<div class="cont-campana">
						No tiene campañas pendientes por iniciar
						</div>
		</div>';

}
	

?>