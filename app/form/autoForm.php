<!DOCTYPE html>
<html>
<head>
	<meta  charset="UTF-8" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<title>generador de formulario</title>
	</head>
	<body>

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

		<h1>Correo</h1>
		<h2>Datos de Origen</h2>
		<input id="from">From</input>
		<h2>Datos de Destino</h2>
		<input id="to">To</input></br>
		<input id="cc">Cc</input></br>
		<input id="cco">Cco</input></br>
		
		<button id="button">agregar nuevas entradas</button>
	</form>

		<div id="resultado">
		</div> 
<script>
	$(document).ready(function(){
			$('#resultado').hide();
			$('#formulario_codigo').hide();
			

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
			var resultado="<form id='"+nombre+"' method='post'>";
			var  i;
			for( i =1; i<=inputs; i++){
				var idInputs = $('#nombre_inputs #'+i).val();
				resultado += idInputs+"<div><input id='"+idInputs+"' class='"+clase+"'></input></div>";
			}

			for( i =1; i<=textareas; i++){
				var idTextareas = $('#nombre_textarea #'+i).val();
				resultado += idTextareas+"<div><textarea id='"+idTextareas+"' class='"+clase+"'></textarea></div>";
			}
			for( i =1; i<=checkboxs; i++){
				var idCheckboxks = $('#nombre_checkbox #'+i).val();
				if(i==1) resultado +="<div>";
				resultado += idCheckboxks+"<input id='"+idCheckboxks+"' type='checkbox' class='"+clase+"'></input>";
				if(i==checkboxs) resultado +="</div>";
			}

			resultado +="<button type='text' name='email'>Enviar</button>";

			resultado += "</form>";


			$('#resultado').text(resultado);
			console.log(resultado);
		}));
	});

</script>
	</body>
</html>