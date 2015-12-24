<?php include 'header-ipe.php'; ?>

	<form id='imagenform-ipe' style="display:none;">

		<div class="header-ipe" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">

			<svg viewBox="0 0 140.341 133.52" class="mask-imguser">
				<defs>
					<polygon id="SVGID_1_" points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26 		"/>
				</defs>
				<clipPath id="SVGID_2_">
					<use xlink:href="#SVGID_1_"  overflow="visible"/>
				</clipPath>
				<g clip-path="url(#SVGID_2_)">
					<image overflow="visible" width="1280" height="720" xlink:href="<?php echo $_SESSION['pictureUrl'];?>" transform="matrix(0.2013 0 0 0.2013 -58.333 -5.7085)"></image>
				</g>
			</svg>

			<input id="RsId" value="<?php echo $_SESSION['rsid']; ?>" type="hidden">

			<h2><?php echo $_SESSION['nombre']?></h2>
			<div class="geo">
				<i class="pi pi-marker"></i>
				<?php echo $_SESSION['comuna'].','.$_SESSION['region'];?>
			</div>
			
			<div class="alt-perfil">
             
                <h2><?php echo $_SESSION['nombre']?></h2>
                 <div class="geo">
                    <i class="pi pi-marker"></i>
                    <?php echo $_SESSION['comuna'].','.$_SESSION['region'];?>
                </div>
			  
			</div>
			<div class="alt-data">
			    <p class="total-numbers">
			        <span>Reach Total</span>
			    </p>
                <p class="bio"><?php echo $_SESSION['descripcion']; ?></p>
			</div>
			
			<p class="bio"><?php echo $_SESSION['descripcion']; ?></p>

			<nav class="nav-ipe2">
				<ul>
					<li class="active"> Escritorio</li>
					<li><a href="campanas-ipe.php">Campañas</a></li>
				</ul>
			</nav>

		</div>

		<div id="tab-examp">
			<ul id="tabs">
				<li><a href="#fragment-1"><span>Perfil</span></a></li>
				<li><a href="#fragment-2"><span>Redes Sociales</span></a></li>
			</ul>
			<div id="tabscontent">
				<div id="fragment-1" class="tabpage">
					<div id="nombre">
						<small>Nombre</small>
						<input value="<?php echo $_SESSION['nombre']?>">
						<i class="pi pi-pencil"></i>
					</div>
					
					<div id="correo">
						<small>Correo</small>
						<input value="<?php echo $_SESSION['correo']?>" disabled>
					</div>

					<div class="selects">
						<small>Región</small>
						<select id="region">
							<option value="<?php echo $_SESSION['region']?>" disabled selected><?php echo $_SESSION['region']?></option>
							<option value="Región de Tarapacá">Región de Tarapacá</option>
							<option value="Región de Antofagasta">Región de Antofagasta</option>
							<option value="Región de Atacama">Región de Atacama</option>
							<option value="Región de Coquimbo">Región de Coquimbo</option>
							<option value="Región de Valparaíso">Región de Valparaíso</option>
							<option value="Región del Libertador Gral. Bernardo O’Higgins">Región del Libertador Gral. Bernardo O’Higgins</option>
							<option value="Región del Maule">Región del Maule</option>
							<option value="Región del Biobío">Región del Biobío</option>
							<option value="Región de la Araucanía">Región de la Araucanía</option>
							<option value="Región de Los Lagos">Región de Los Lagos</option>
							<option value="Región Aisén del Gral. Carlos Ibáñez del Campo">Región Aisén del Gral. Carlos Ibáñez del Campo</option>
							<option value="Región de Magallanes y de la Antártica Chilena">Región de Magallanes y de la Antártica Chilena</option>
							<option value="Región Metropolitana de Santiago">Región Metropolitana de Santiago</option>
							<option value="Región de Los Ríos">Región de Los Ríos</option>
							<option value="Región de Arica y Parinacota">Región de Arica y Parinacota</option>
						</select>
						<i class="pi pi-arrow-bottom"></i>
					</div>
					
					<script async type="text/javascript">
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
						<select id="comuna" >
							<option value="<?php echo $_SESSION['comuna']?>" disabled selected><?php echo $_SESSION['comuna']?></option>
						</select>
						<i class="pi pi-arrow-bottom"></i>
					</div>

					<div id="descripcion">
						<small>Biografia</small>
						<textarea placeholder="... descríbete en menos de 500 palabras"><?php echo $_SESSION['descripcion'] ?></textarea>
						<i class="pi pi-pencil"></i>
					</div>

					<input type="file" name="file" id="file" class="input-file">
					<label for="file" class="change-img">Subir imagen</label>
					
					<button id="guardarFacturacion" class="btns" type="submit">Guardar</button>

				</div>
				<div id="fragment-2" class="tabpage">
					<?php include_once('procesar_mostrar_cuentas.php');?>
				</div>
			</div>
		</div>

	</form>

	<?php include('footer-ipe.php'); ?>
</body>
</html>
