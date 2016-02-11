<?php include 'header-ipe.php'; ?>
		
<div id="imagenform-ipe2">
    
    <div id="tab-examp">
			<ul id="tabs">
				<li><a href="#activas">Actuales</a></li>
				<li><a href="#historia">Finalizadas</a></li>
			</ul>
			<div id="tabscontent">
				<div id="activas" class="tabpage">

					<?php
						require("./controller/procesar-mostrar-campanas-ipe2.php");
						echo $campanas_activas;
						//echo $campanas_activas_urls_ingresadas;
						echo $campanas_inactivas;
					?>
						
				</div>
				<div id="historia" class="tabpage">
					
					<?php echo $campanas_historial; ?>
				
			    </div>
		    </div>
    
    </div>
</div>
<?php include ('footer-ipe.php'); ?>
</body>
</html>