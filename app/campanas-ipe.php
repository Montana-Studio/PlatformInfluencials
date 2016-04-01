<?php include 'header-ipe.php';
//require("./controller/procesar-mostrar-campanas-ipe2.php");
require("./controller/procesar-mostrar-campanas-ipe3.php");
?>
		
<div id="imagenform-ipe2">
    
    <div id="tab-examp">
			<ul id="tabs">
				<li><a href="#activas">Actuales</a></li>
				<li><a href="#historia">Finalizadas</a></li>
			</ul>
			<div id="tabscontent">
				<div id="activas" class="tabpage">
					<?php echo muestra_campanas($_SESSION['id']);?>
						
				</div>
				<div id="historia" class="tabpage">
					<?php echo muestra_finalizadas($_SESSION['id']);?>
					
			    </div>
		    </div>
    
    </div>
</div>
<?php include ('footer-ipe.php'); ?>
</body>
</html>