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
						require("procesar_mostrar_campanas_en_ipe.php");
						echo $campanas_activas;
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