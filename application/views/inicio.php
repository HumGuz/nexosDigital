<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital</title>
<?php  
include_once 'includes/header-styles.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Nexos digital, nexosdigital, ITSN, Presidencial municipal de Nochistlán, Presidencial municipal Apulco. Publicidad, ventas, anuncios, compras, al cambio, comercio,Noticias en Nochistlán, noticias en Apulco, entretenimiento Nochistlán, entretenimiento Apulco, deportes Nochistlán, deportes Apulco, Tecnología,Compra y venta en Nochistlán, compra venta en Apulco, lotes, carros, casas, motos, camionetas, ropa, zapatos" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
</head>
<body>
	<?php include_once 'includes/menu.php'; ?>
	<div class="container">
		<div class="content">
			<div class="col-md-7 content-left">
				<?php echo $recent; ?>
			</div>
			<div class="col-md-5 content-right">
				<div class="content-right-top">
					<h5 class="head">Populares</h5>	
					<?php echo $popular; ?>
				</div>
				<div class="editors-pic-grids">
						<h5>Selección del editor</h5>
					<?php echo $editorsPick; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			 <div class="features">
				<h5>Noticias destacadas</h5>
				<h2>Nokia offering customers printable STL phone cases for the Lumia 820</h2>
			</div> 						
		</div>
	</div>
		<?php  include_once 'includes/footer.php'; ?>
		<?php include_once 'includes/footer-scripts.php'; ?>
</body>
</html>