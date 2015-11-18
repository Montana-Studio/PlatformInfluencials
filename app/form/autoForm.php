<!DOCTYPE html>
<html>
<head>
	<meta  charset="UTF-8" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<title>generador de formulario</title>
	</head>
	<body>
	<h1>El Formulario contempla por defecto los campos:</h1> <li>nombre</li><li>correo</li><li>mensaje</li><li>asunto</li>
	<form id="formulario_cantidades">
		<h1>Formulario de Cantidades</h1>
			<div id="cantidad_inputs" >cantidad de inputs
			 	<select id="inputs">
			 			<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
				</select> 
			</div>

			<div>cantidad de textarea
			 	<select id="textarea">
			 			<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
				</select>
				Cols<input id="cols">
				Rows<input id="rows"> 
			</div>


			<div>cantidad de checkbox
			 	<select id="checkbox">
			 			<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
				</select> 
			</div>
			<button id="button">agregar nuevas entradas</button>
	</form>


	<form class="form" id="formulario_codigo">
	<h1>Formato del Formulario</h1>
		id del formulario<input id="nombreForm"></input>
		<div id="nombre_inputs">
		</div>
		<div id="nombre_textarea">
		</div>
		<div id="nombre_checkbox">
		</div>
		<div>
			clase del formulario<input id="class"></input>
		</div>
		<button id="button">agregar nuevas entradas</button>
	</form>

		<pre id="resultado">
		</pre> 

		<pre id="php">
		</pre>



<script>
<?php
$variable_num = 1;
//$code1 = '<?php ';


?>	
	$(document).ready(function(){
		$('#resultado').hide();
		$('#formulario_codigo').hide();
		var cols,rows;

		$('#formulario_cantidades').on('submit',function(e){
			$('#formulario_codigo').show();
			e.preventDefault();
			var can_items = document.getElementById("inputs");
			var inputs = can_items.options[can_items.selectedIndex].value;
			var can_textarea = document.getElementById("textarea");
			var textareas = can_textarea.options[can_textarea.selectedIndex].value;
			var cant_checkbox = document.getElementById("checkbox");
			var checkboxs = cant_checkbox.options[cant_checkbox.selectedIndex].value;	
			var divInputs = document.getElementById('nombre_inputs');
			var divCheckboxs = document.getElementById('nombre_checkbox');
			var divTextareas = document.getElementById('nombre_textarea');
			cols= $('#cols').val();
			rows= $('#rows').val();
			alert(cols+rows);
			var a;

			$('#formulario_cantidades').hide();
			for( a =1; a<=inputs; a++){
				divInputs.innerHTML = divInputs.innerHTML + '<br/>id del input '+a+' : <input id='+a+'></input>';
			}
			for( a =1; a<=checkboxs; a++){
				divCheckboxs.innerHTML = divCheckboxs.innerHTML + '<br/>id del checkbox '+a+' : <input id='+a+'></input>';
			}
			for( a =1; a<=textareas; a++){
				divTextareas.innerHTML = divTextareas.innerHTML + '<br/>id del textarea '+a+' : <input id='+a+'></input>';
			}
		});

		$('.form').on('submit',(function(e){
			$('#resultado').show();
			//$('#formulario_codigo').hide();
			e.preventDefault();
			var can_items = document.getElementById("inputs");
			var inputs = can_items.options[can_items.selectedIndex].value;
			var can_textarea = document.getElementById("textarea");
			var textareas = can_textarea.options[can_textarea.selectedIndex].value;
			var cant_checkbox = document.getElementById("checkbox");
			var checkboxs = cant_checkbox.options[cant_checkbox.selectedIndex].value;
			var clase = $('#class').val();
			var nombre = $('#nombreForm').val();
			var resultado="<form id='"+nombre+"' method='post' enctype='multipart/form-data'>\n\t<input type='hidden' name='action' value='submit'>";
			var  i;
			var arregloInputs = "";
			var arregloTextareas = "";
			var arregloCheckboxs = "";
			var hola;

			for( i =1; i<=inputs; i++){
				var idInputs = $('#nombre_inputs #'+i).val();
				resultado += "\n\t<div>\n\t\t "+idInputs+"<input id='"+idInputs+"' name='"+idInputs+"' class='"+clase+"'>\n\t</div>";
				arregloInputs += idInputs+",";
			}

			for( j =1; j<=textareas; j++){
				var idTextareas = $('#nombre_textarea #'+j).val();
				resultado += "\n\t<div>\n\t\t "+idTextareas+"<textarea cols='"+cols+"' rows='"+rows+"' id='"+idTextareas+"'  name='"+idTextareas+"' class='"+clase+"'>\n\t\t</textarea>\n\t</div>";
				arregloTextareas += idTextareas+",";
			}

			for( k =1; k<=checkboxs; k++){
				var idCheckboxks = $('#nombre_checkbox #'+k).val();
				if(k==1) resultado +="\n\t<div>";
				resultado += idCheckboxks+" \n\t\t<input id='"+idCheckboxks+"' name='"+idCheckboxks+"' type='checkbox' class='"+clase+"'>";
				if(k==checkboxs) resultado +="\n\t</div>";
				arregloCheckboxs += idCheckboxks+",";
			}

			//console.log(arregloInputs+arregloTextareas+arregloCheckboxs);
			//resultado +="\n\t<button type='text' name='email'>Enviar</button>\n";
			//resultado +="\n\t<input type='hidden' name='action' value='submit'>"; 
			resultado +="\n\tNombre:<br/><input name='nombre' type='text' value='' size='30'/><br>";
			resultado +="\n\tCorreo:<br/><input name='correo' type='text' value=''size='30'/><br> ";
			resultado +="\n\tAsunto:<br/><input name='asunto' type='text' value='' size='30'/><br> ";
			resultado +="\n\tMensaje:<br><textarea name='mensaje' rows='7' cols='30'></textarea></br>";
			resultado +="\n\t<input type='submit' value='Send email'/>";
			resultado +="\n</form>";
			$.ajax({
				type: "POST",
				url: "procesar_codigo.php",
				data: "resultado="+resultado+"&inputs="+arregloInputs+"&largoinputs="+inputs+"&textareas="+arregloTextareas+"&largotextareas="+textareas+"&checkboxs="+arregloCheckboxs+"&largocheckboxs="+checkboxs,

				success: function(data){
					console.log(data);
					hola = data;
					console.log(hola);
					$('#php').text(hola);
				}
			});

			
			//resultado += "<code><?php $php_string='<?php codigo $hola en php ?>';echo htmlspecialchars($php_string);?></code>";
			//$('#resultado').text(resultado);
			
			//console.log(hola);
		}));
	});

<?php
/*$code1.=' $_POST["holi"]=" dasdsada"?>';*/
?>

</script>
<?php

/*
echo '<pre>' . htmlspecialchars($code1) . '</pre>';
echo $largo;
*/
?>	

	</body>
</html>