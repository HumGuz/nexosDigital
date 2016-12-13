<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital / <?php echo $title; ?></title>
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
			<div class="single-page">
				<div class="print-main">
					<h3>Printing</h3>
					<a href="single.html">Software Review: Autodesk Inventor Fusion for Mac</a>
					<p class="sub_head">Posted by <a href="#">Admin</a> on february 14,2015</p>
					<a href="single.html"><img src="images/printing.jpg" class="img-responsive" alt="" /></a>
					<p class="span"><a href="#">3D Printing, <a href="#">3D Software,</a><a href="#"> Files to Print </a> |  on february 14,2015</p>
					<p class="ptext">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the like</p>
					<p class="ptext">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the like</p>
				</div>				
			</div>
			<div class="col-md-7 single-content-left">
				<div class="features-list">
					<h3>Features</h3>
					<?php echo $features ?>
				</div>				
				<div class="single">
						<div class="leave">
							<h4>Deja un comentario</h4>
						</div>
						<form id="commentform">
							<p class="comment-form-author-name">
								<label for="author">Nombre</label>
								<input id="author" name="author" type="text" value="" size="30" aria-required="true">
							</p>
							<p class="comment-form-email">
								<label for="email">Email</label>
								<input id="email" name="email" type="text" value="" size="30" aria-required="true">
							</p>
							
							<p class="comment-form-comment">
								<label for="comment">Comentario</label>
								<textarea></textarea>
							</p>
							<div class="clearfix"></div>
							<p class="form-submit">
								<input name="submit" type="submit" id="submit" value="Send">
							</p>
							<div class="clearfix"></div>
						</form>
						
						<div class="comments1">
							<h4>COMENTARIOS</h4>
							<?php echo $comments ?>
						</div>
					</div>
			</div>			
			<div class="col-md-5 content-right content-right-top">
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
		</div>
	</div>
	<?php  include_once 'includes/footer.php'; ?>
	<?php include_once 'includes/footer-scripts.php'; ?>
</body>
</html>