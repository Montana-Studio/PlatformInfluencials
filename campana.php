<?php

?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<title>campañas</title>
<style>

input{
border:none;
background-color:#fff;
color:#000;
background-image:url('http://www.orlybaram.com/_ee/img/icons/edit/edit-icon.gif');
background-repeat:no-repeat;
background-position:right;
cursor:pointer;
font-family: 'Impact',Courier,Sans-Serif;
}
</style>

</head>
<body>
<div style="text-align:right;"><a href="logout.php">cerrar sesion</a> - <a href>ayuda</a></div>
<h2>campañas</h2>
<br/>
<br/>
<br/>

<a href="dashboard-agencia.php">volver a dashboard</a><p>
<div id="creadas">

útlimas campañas creadas <p>
<?php //do{echo $row[1];?>

<button id="guardar">guardar</button><button id="editar">editar</button> / <button>borrar</button> / <button>pausar</button>
<br/>
<?php //}while($row = mysqli_fetch_row($result))?>
<div id="editaCampaña">
<input placeholder="nombre campaña"></input><p>
<input placeholder="marca"></input><p>
<textarea placeholder="descripcion" rows=10 cols=40 ></textarea><p>
<button>Cambiar imagen</button>
</div>
</div>


<br/><br/>

<div id="contacto">
Contacto<p>
<input placeholder="asunto"></input><p>
<textarea  placeholder="descripcion" rows=10 cols=40></textarea><p>
<button>Enviar</button>
</div>

</body>
</html>