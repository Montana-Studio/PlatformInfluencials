<?php
require('./controller/conexion.php');

if(isset($_SESSION['id'])){
	$query="SELECT * FROM persona WHERE id_estado = 1 AND id= ".$_SESSION['id'];
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$row= mysqli_fetch_array($result, MYSQLI_NUM);
	if ($row[1] > '2'){
		header("Location: escritorio-ipe");
		die();
	}else{
		//echo '<script>$(document).ready(function(){alert("Su tipo de usuario es Agencia")});</script>';
		header("Location: escritorio-agencia");
		die();
	}
}
?>

<!DOCTYPE html>
<html lang="es" style="height:100%;">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#2c327c">

	<title>Power Influencer</title>

	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon-152x152.png" />

	<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />

	<meta name="application-name" content="Power Influencer"/>

	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="img/mstile-144x144.png" />

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script id="facebook-sdk" src="js/facebook-login.js"></script>

</head>

<body>
	<?php

	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		echo '';
	else
		echo '

		<script src="js/jquery.vide.min.js"></script>
		<div class="video-container" data-vide-bg="mp4: video/bg_app.mp4, webm: video/bg_app.webmv, ogv: video/bg_app.ogg" data-vide-options="posterType: none,loop: true, muted: true, position: 0% 0%"></div>';

	?>
	<main class="contAllPI" style="padding-top:30%;">
		<div style="display:none;" id="tipoCliente" value="3"></div>	
		<div class="logo_pi"><a href="/" target="_top"></a></div>
		<main class="form_agencias">
			<div id="inicio">
				<div id="acceder" class="btns_accesos">ingresar</div>
				<div id="registrar" class="btns_accesos">registrarse</div>
			</div>
		<div id="nuevo">
			<h2>Registro</h2>
				<form class="registerForm registerFormInfluenciador">
					<div class="selects">
						<small>Selecciona tu perfil</small>
						<select id="perfil">
							<option value="3" disabled selected>Influenciador - Publisher - Editor</option>
							<option value="3">Influenciador</option>
							<option value="4">Publisher</option>
							<option value="5">Editor</option>
						</select>
						<i class="pi pi-arrow-bottom"></i>
					</div>

					<div id="facebook-nuevo" class="fb_btn" value="registrarse con Facebook">
						<i class="fa fa-facebook"></i>registrarse con Facebook
					</div>

					<p>o rellena el formulario</p>

					<input placeholder="Nombre" name="username-nuevo" class="usernamenuevo" required>
					<input type="email" placeholder="Correo electrónico" class="correonuevo" required>
					<div class="selects">
						<small>Región</small>
						<select id="region" required>
							<option value="" disabled selected>selecciona tu región</option>
							<option value="Región de Tarapacá">Tarapacá</option>
							<option value="Región de Antofagasta">Antofagasta</option>
							<option value="Región de Atacama">Atacama</option>
							<option value="Región de Coquimbo">Coquimbo</option>
							<option value="Región de Valparaíso">Valparaíso</option>
							<option value="Región del Libertador Gral. Bernardo O’Higgins">Libertador Gral. Bernardo O’Higgins</option>
							<option value="Región del Maule">Maule</option>
							<option value="Región del Biobío">Biobío</option>
							<option value="Región de la Araucanía">Araucanía</option>
							<option value="Región de Los Lagos">Los Lagos</option>
							<option value="Región Aisén del Gral. Carlos Ibáñez del Campo">Gral. Carlos Ibáñez del Campo</option>
							<option value="Región de Magallanes y de la Antártica Chilena">Magallanes y de la Antártica Chilena</option>
							<option value="Región Metropolitana de Santiago">Metropolitana de Santiago</option>
							<option value="Región de Los Ríos">Los Ríos</option>
							<option value="Región de Arica y Parinacota">Arica y Parinacota</option>
						</select>
						<i class="pi pi-arrow-bottom"></i>
					</div>

					<script>
						$(document).ready(function(){
							$('#resultado').hide();
							$('#formulario_codigo').hide();


							$('#region').on('change',function(e){
								var binario = 0;
								var divComuna = document.getElementById('comuna');
								divComuna.innerHTML ='<option value="" disabled selected>selecciona tu comuna </option>';

								if(binario==0){

									var regionElements = document.getElementById("region");
									var region = regionElements.options[regionElements.selectedIndex].value;

									if (region == 'Región de Tarapacá' ){
										divComuna.innerHTML = divComuna.innerHTML +'<option value ="Alto Hospicio">Alto Hospicio</option><option value ="Camiña">Camiña</option><option value ="Colchane">Colchane</option><option value ="Huara">Huara</option><option value ="Iquique">Iquique</option><option value ="Pica">Pica</option><option value ="Pozo Almonte">Pozo Almonte</option>';
									}
									if (region == 'Región de Antofagasta' ){
									divComuna.innerHTML = divComuna.innerHTML + '<option value="Antofagasta">Antofagasta</option><option value="Calama">Calama</option><option value="María Elena">María Elena</option><option value="Mejillones">Mejillones</option><option value="Ollagüe">Ollagüe</option><option value="San Pedro de Atacama">San Pedro de Atacama</option><option value="Taltal">Taltal</option><option value="Tocopilla">Tocopilla</option>';
									}
									if (region == 'Región de Atacama' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value = "Alto del Carmen">Alto del Carmen</option><option value = "Caldera">Caldera</option><option value = "Chañaral">Chañaral</option><option value = "Copiapó">Copiapó</option><option value = "Diego de Almagro">Diego de Almagro</option><option value = "Freirina">Freirina</option><option value = "Huasco">Huasco</option><option value = "Tierra Amarilla">Tierra Amarilla</option><option value = "Vallenar">Vallenar</option>';
									}
									if (region == 'Región de Coquimbo'){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Andacollo">Andacollo</option><option value="Canela">Canela</option><option value="Combarbalá">Combarbalá</option><option value="Coquimbo">Coquimbo</option><option value="Illapel">Illapel</option><option value="La Higuera">La Higuera</option><option value="La Serena">La Serena</option><option value="Los Vilos">Los Vilos</option><option value="Monte Patria">Monte Patria</option><option value="Ovalle">Ovalle</option><option value="Paiguano">Paiguano</option><option value="Punitaqui">Punitaqui</option><option value="Río Hurtado">Río Hurtado</option><option value="Salamanca">Salamanca</option><option value="Vicuña">Vicuña</option>';
									}
									if (region == 'Región de Valparaíso'){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Algarrobo">Algarrobo</option><option value="Cabildo">Cabildo</option><option value="Calera">Calera</option><option value="Calle Larga">Calle Larga</option><option value="Cartagena">Cartagena</option><option value="Casablanca">Casablanca</option><option value="Catemu">Catemu</option><option value="Concón">Concón</option><option value="El Quisco">El Quisco</option><option value="El Tabo">El Tabo</option><option value="Hijuelas">Hijuelas</option><option value="Isla de Pascua">Isla de Pascua</option><option value="Juan Fernández">Juan Fernández</option><option value="La Cruz">La Cruz</option><option value="La Ligua">La Ligua</option><option value="Limache">Limache</option><option value="Llaillay">Llaillay</option><option value="Los Andes">Los Andes</option><option value="Nogales">Nogales</option><option value="Olmué">Olmué</option><option value="Panquehue">Panquehue</option><option value="Papudo">Papudo</option><option value="Petorca">Petorca</option><option value="Puchuncaví">Puchuncaví</option><option value="Putaendo">Putaendo</option><option value="Quillota">Quillota</option><option value="Quintero">Quintero</option><option value="Quilpué">Quilpué</option><option value="Rinconada">Rinconada</option><option value="Santa María">Santa María</option><option value="Santo Domingo">Santo Domingo</option><option value="San Antonio">San Antonio</option><option value="San Esteban">San Esteban</option><option value="San Felipe">San Felipe</option><option value="Valparaíso">Valparaíso</option><option value="Villa Alemana">Villa Alemana</option><option value="Viña del Mar">Viña del Mar</option><option value="Zapallar">Zapallar</option>';
									}
									if (region == 'Región del Libertador Gral. Bernardo O’Higgins' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value ="Chépica">Chépica</option><option value ="Chimbarongo">Chimbarongo</option><option value ="Codegua">Codegua</option><option value ="Coinco">Coinco</option><option value ="Coltauco">Coltauco</option><option value ="Doñihue">Doñihue</option><option value ="Graneros">Graneros</option><option value ="La Estrella">La Estrella</option><option value ="Las Cabras">Las Cabras</option><option value ="Litueche">Litueche</option><option value ="Lolol">Lolol</option><option value ="Machalí">Machalí</option><option value ="Malloa">Malloa</option><option value ="Marchihue">Marchihue</option><option value ="Mostazal">Mostazal</option><option value ="Nancagua">Nancagua</option><option value ="Navidad">Navidad</option><option value ="Olivar">Olivar</option><option value ="Paredones">Paredones</option><option value ="Palmilla">Palmilla</option><option value ="Peralillo">Peralillo</option><option value ="Peumo">Peumo</option><option value ="Pumanque">Pumanque</option><option value ="Placilla">Placilla</option><option value ="Pichidegua">Pichidegua</option><option value ="Pichilemu">Pichilemu</option><option value ="Quinta de Tilcoco">Quinta de Tilcoco</option><option value ="Rancagua">Rancagua</option><option value ="Rengo">Rengo</option><option value ="Requínoa">Requínoa</option><option value ="San Fernando">San Fernando</option><option value ="San Vicente">San Vicente</option><option value ="Santa Cruz">Santa Cruz</option>';
									}
									if (region == 'Región del Maule' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value=" Cauquenes">Cauquenes</option><option value=" Chanco">Chanco</option><option value=" Colbún">Colbún</option><option value=" Constitución">Constitución</option><option value=" Curepto">Curepto</option><option value=" Curicó">Curicó</option><option value=" Empedrado">Empedrado</option><option value=" Hualañé">Hualañé</option><option value=" Licantén">Licantén</option><option value=" Linares">Linares</option><option value=" Longaví">Longaví</option><option value=" Maule">Maule</option><option value=" Molina">Molina</option><option value=" Parral">Parral</option><option value=" Pelarco">Pelarco</option><option value=" Pelluhue">Pelluhue</option><option value=" Pencahue">Pencahue</option><option value=" Rauco">Rauco</option><option value=" Retiro">Retiro</option><option value=" Romeral">Romeral</option><option value=" Río Claro">Río Claro</option><option value=" Sagrada Familia">Sagrada Familia</option><option value=" San Clemente">San Clemente</option><option value=" San Javier">San Javier</option><option value=" San Rafael">San Rafael</option><option value=" Talca">Talca</option><option value=" Teno">Teno</option><option value=" Vichuquén">Vichuquén</option><option value=" Villa Alegre">Villa Alegre</option><option value=" Yerbas Buenas">Yerbas Buenas</option>';
									}
									
									if (region == 'Región del Biobío' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Alto Biobío">Alto Biobío</option><option value="Antuco">Antuco</option><option value="Arauco">Arauco</option><option value="Bulnes">Bulnes</option><option value="Cabrero">Cabrero</option><option value="Cañete">Cañete</option><option value="Chillán">Chillán</option><option value="Chillán Viejo">Chillán Viejo</option><option value="Cobquecura">Cobquecura</option><option value="Coelemu">Coelemu</option><option value="Coihueco">Coihueco</option><option value="Concepción">Concepción</option><option value="Contulmo">Contulmo</option><option value="Coronel">Coronel</option><option value="Chiguayante">Chiguayante</option><option value="Curanilahue">Curanilahue</option><option value="El Carmen">El Carmen</option><option value="Florida">Florida</option><option value="Hualpén">Hualpén</option><option value="Hualqui">Hualqui</option><option value="Laja">Laja</option><option value="Lebu">Lebu</option><option value="Los Álamos">Los Álamos</option><option value="Los Ángeles">Los Ángeles</option><option value= "Lota">Lota</option><option value= "Mulchén">Mulchén</option><option value= "Nacimiento">Nacimiento</option><option value= "Negrete">Negrete</option><option value= "Ninhue">Ninhue</option><option value= "Ñiquén">Ñiquén</option><option value= "Pemuco">Pemuco</option><option value= "Penco">Penco</option><option value= "Pinto">Pinto</option><option value= "Portezuelo">Portezuelo</option><option value= "Quilaco">Quilaco</option><option value= "Quilleco">Quilleco</option><option value= "Quillón">Quillón</option><option value= "Quirihue">Quirihue</option><option value= "Ránquil">Ránquil</option><option value="San Carlos">San Carlos</option><option value="San Fabián">San Fabián</option><option value="San Ignacio">San Ignacio</option><option value="San Nicolás">San Nicolás</option><option value="San Pedro de la Paz">San Pedro de la Paz</option><option value="San Rosendo">San Rosendo</option><option value="Santa Bárbara">Santa Bárbara</option><option value="Santa Juana">Santa Juana</option><option value="Talcahuano">Talcahuano</option><option value="Tirúa">Tirúa</option><option value="Tomé">Tomé</option><option value="Treguaco">Treguaco</option><option value="Tucapel">Tucapel</option><option value="Yumbel">Yumbel</option><option value="Yungay">Yungay</option>';
									}
									if (region == 'Región de la Araucanía' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value ="Angol">Angol</option><option value ="Carahue">Carahue</option><option value ="Cholchol">Cholchol</option><option value ="Collipulli">Collipulli</option><option value ="Cunco">Cunco</option><option value ="Curacautín">Curacautín</option><option value ="Curarrehue">Curarrehue</option><option value ="Ercilla">Ercilla</option><option value ="Freire">Freire</option><option value ="Galvarino">Galvarino</option><option value ="Gorbea">Gorbea</option><option value ="Lautaro">Lautaro</option><option value ="Loncoche">Loncoche</option><option value ="Lonquimay">Lonquimay</option><option value ="Los Sauces">Los Sauces</option><option value ="Lumaco">Lumaco</option><option value ="Melipeuco">Melipeuco</option><option value ="Nueva Imperial">Nueva Imperial</option><option value ="Padre las Casas">Padre las Casas</option><option value ="Perquenco">Perquenco</option><option value="Pitrufquén">Pitrufquén</option><option value="Pucón">Pucón</option><option value="Purén">Purén</option><option value="Renaico">Renaico</option><option value="Saavedra">Saavedra</option><option value="Teodoro Schmidt">Teodoro Schmidt</option><option value="Toltén">Toltén</option><option value="Temuco">Temuco</option><option value="Traiguén">Traiguén</option><option value="Victoria">Victoria</option><option value="Vilcún">Vilcún</option><option value="Villarrica">Villarrica</option>';
									}
									if (region == 'Región de Los Lagos' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Ancud">Ancud</option><option value="Calbuco">Calbuco</option><option value="Castro">Castro</option><option value="Cochamó">Cochamó</option><option value="Chaitén">Chaitén</option><option value="Chonchi">Chonchi</option><option value="Curaco de Vélez">Curaco de Vélez</option><option value="Dalcahue">Dalcahue</option><option value="Fresia">Fresia</option><option value="Frutillar">Frutillar</option><option value="Futaleufú">Futaleufú</option><option value="Hualaihué">Hualaihué</option><option value="Los Muermos">Los Muermos</option><option value="Llanquihue">Llanquihue</option><option value="Maullín">Maullín</option><option value="Osorno">Osorno</option><option value="Palena">Palena</option><option value="Puerto Montt">Puerto Montt</option><option value="Puerto Octay">Puerto Octay</option><option value="Puerto Varas">Puerto Varas</option><option value="Puqueldón">Puqueldón</option><option value="Puyehue">Puyehue</option><option value="Purranque">Purranque</option><option value="Río Negro">Río Negro</option><option value="Queilén">Queilén</option><option value="Quellón">Quellón</option><option value="Quemchi">Quemchi</option><option value="Quinchao">Quinchao</option><option value="San Juan de la Costa">San Juan de la Costa</option><option value="San Pablo">San Pablo</option>';
									}
									if (region == 'Región Aisén del Gral. Carlos Ibáñez del Campo' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Aisén">Aisén</option><option value="Chile Chico">Chile Chico</option><option value="Cisnes">Cisnes</option><option value="Cochrane">Cochrane</option><option value="Coihaique">Coihaique</option><option value="Lago Verde">Lago Verde</option><option value="Guaitecas">Guaitecas</option><option value="O’Higgins">O’Higgins</option><option value="Río Ibáñez">Río Ibáñez</option><option value="Tortel">Tortel</option>';
									}
									if (region == 'Región de Magallanes y de la Antártica Chilena' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Antártica">Antártica</option><option value="Cabo de Hornos">Cabo de Hornos</option><option value="Laguna Blanca">Laguna Blanca</option><option value="Natales">Natales</option><option value="Porvenir">Porvenir</option><option value="Primavera">Primavera</option><option value="Punta Arenas">Punta Arenas</option><option value="Río Verde">Río Verde</option><option value="San Gregorio">San Gregorio</option><option value="Torres del Paine">Torres del Paine</option><option value="Timaukel">Timaukel</option>';
									}

									if (region == 'Región Metropolitana de Santiago' ) {
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Alhué">Alhué</option><option value="Buin">Buin</option><option value="Calera de Tango">Calera de Tango</option><option value="Cerrillos">Cerrillos</option><option value="Cerro Navia">Cerro Navia</option><option value="Conchalí">Conchalí</option><option value="Curacaví">Curacaví</option><option value="El Bosque">El Bosque</option><option value="El Monte">El Monte</option><option value="Estación Central">Estación Central</option><option value="Colina">Colina</optio><option value="Huechuraba">Huechuraba</optio><option value="Independencia">Independencia</optio><option value="Isla de Maipo">Isla de Maipo</option><option value="La Cisterna">La Cisterna</optio><option value="La Florida">La Florida</option><option value="La Granja">La Granja</option><option value="La Pintana">La Pintana</option><option value="La Reina">La Reina</option><option value="Lampa">Lampa</option><option value="Las Condes">Las Condes</option><option value="Lo Barnechea">Lo Barnechea</option><option value="Lo Espejo">Lo Espejo</option><option value="Lo Prado">Lo Prado</option><option value="Macul">Macul</option><option value="Maipú">Maipú</option><option value="María Pinto">María Pinto</option><option value="Melipilla">Melipilla</option><option value="Ñuñoa">Ñuñoa</option><option value="Padre Hurtado">Padre Hurtado</option><option value="Paine">Paine</option><option value="Pedro Aguirre Cerda">Pedro Aguirre Cerda</option><option value="Peñaflor">Peñaflor</option><option value="Peñalolén">Peñalolén</option><option value="Pirque">Pirque</option><option value="Providencia">Providencia</option><option value="Puente Alto">Puente Alto</option><option value="Pudahuel">Pudahuel</option><option value="San Pedro">San Pedro</option><option value="Santiago">Santiago</option><option value="Quilicura">Quilicura</option><option value="Quinta Normal">Quinta Normal</option><option value="Recoleta">Recoleta</option><option value="Renca">Renca</option><option value="San Bernardo">San Bernardo</option><option value="San Joaquín">San Joaquín</option><option value="San José de Maipo">San José de Maipo</option><option value="San Miguel">San Miguel</option><option value="San Ramón">San Ramón</option><option value="Talagante">Talagante</option><option value="Tiltil">Tiltil</option><option value="Vitacura">Vitacura</option>';
									}

									if (region == 'Región de Los Ríos' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Corral">Corral</option><option value="Futrono">Futrono</option><option value="La Unión">La Unión</option><option value="Lago Ranco">Lago Ranco</option><option value="Lanco">Lanco</option><option value="Los Lagos">Los Lagos</option><option value="Máfil">Máfil</option><option value="Mariquina">Mariquina</option><option value="Paillaco">Paillaco</option><option value="Panguipulli">Panguipulli</option><option value="Río Bueno">Río Bueno</option><option value="Valdivia">Valdivia</option>';
									}

									if (region == 'Región de Arica y Parinacota' ){
										divComuna.innerHTML = divComuna.innerHTML + '<option value="Arica">Arica</option><option value="Camarones">Camarones</option><option value="Putre">Putre</option>';
									}
								}
							});
						});
					</script>

					<div class="selects">
						<small>Comuna</small>
						<select id="comuna" required>
							<option value="" disabled selected>selecciona tu comuna </option>
						</select>
						<i class="pi pi-arrow-bottom"></i>
					</div>
					
					<input class= "contraseña" type="password" placeholder="Contraseña" id="contraseñanuevo"  required>
					<input type="password" onChange="checkPasswordMatch();" placeholder="Repetir Contraseña" id="ver-password" required>
					<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
					<div id="selectImage">
						<input type="file" name="file" id="file" required>
						<label for="file" class="btns">Sube una imágen</label>
						<button id="registrarse" disabled type="submit">Registrarse</button>
					</div>
					<div class="alert-uploadready" style="display:none;"><i class="fa fa-cloud-upload"></i>Imagen seleccionada con exito!</div>
				</form>
				<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
			</div>
			<div id="antiguo" class="form-ipe">
				<h2>Ingresa con tus datos</h2>
				<form class="form_ingreso">
					<div id="facebook-antiguo" class="fb_btn" value="ingresar con Facebook">
						<i class="fa fa-facebook"></i>ingresar con Facebook
					</div>
					<p>o ingresa con tu correo</p>
					<!--input placeholder="Nombre" name="username" id="username"/-->
					<input placeholder="Correo" name="correo" id="correo"/>
					<input type="password" placeholder="Contraseña" id="password" />
					<div id="ingresar">ingresar</div>
					<div id="alertRegistrado"></div>
					<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
				</form>
				<button id="volver">volver</button>
		</div>
		<a href="#" class="ayuda_pi">¿Necesitas ayuda?</a>
	</main>
	<div class="alertElim">

		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<i class="fa"></i>
				<h2></h2>
				<p class="messageAlert"></p>
				<div class="btn_crearcamp" id="clearAlert">
					continuar
				</div>
			</div>
		</main>

	</div>

	<script type="text/javascript" async src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/linkedin-login.js"></script>

</body>
</html>