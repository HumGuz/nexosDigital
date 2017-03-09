<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital / <?php echo $article['info']['nombre']  ?></title>
<?php  
	include_once 'includes/header-styles.php'; 
	include_once 'includes/meta.php'; 
?>
</head>
<body>
	<?php include_once 'includes/menu.php'; ?>	
	<div class="container">
		<div class="content">
			<div class="single-page">
				<div class="print-main">
					<?php echo $article['article'] ?>
				</div>				
			</div>
			<div class="col-md-7 single-content-left">						
				<?php if($article['info']['comments']): ?>
				<div class="single">
						<div class="leave">
							<h4>Deja un comentario</h4>
						</div>
						<form id="commentform">		
							  <input type="hidden"  id="id_articulo" name="id_articulo" value="<?php echo $article['info']['id_articulo'] ?>">					
							<div class="form-group">
							    <label for="nombre"  class="control-label">Nombre</label>
							    <input type="text" class="form-control" id="nombre" name="nombre" >
							</div>
							<div class="form-group ">
							    <label for="nombre"  class="control-label">Email</label>
							    <input type="text" class="form-control" id="mail" name="mail" >
							</div>								
							<div class="form-group">
								<label for="comentario" class="control-label" >Comentarios</label>
								 <textarea placeholder="Captura aqui tus comentarios..." class="form-control required"  id="comentario"  name="comentario" ></textarea>
							 </div>
							
							
							<div class="checkbox">
							    <label>
							      <input type="checkbox" name="newsletter" id="newsletter" value="1" checked="checked"> Subscribirme al boletín de noticias
							    </label>
							  </div>
							<div class="clearfix"></div>
							<p class="form-submit">
								 <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Enviar</button>
							</p>
							<div class="clearfix"></div>
						</form>
						<div class="comments1">
							<h4>COMENTARIOS</h4>
							<?php echo (!empty($comments))?$comments:'<p class="empty-comments">No se han escrito comentarios</p>' ?>
						</div>
				</div>
				<?php else: echo "Los comentarios esta desactivados para este post."; endif; ?>
			</div>			
			<div class="col-md-5 content-right content-right-top">
				<div class="content-right-top">
					<?php echo $popular; ?>
				</div>
				<div class="editors-pic-grids">
					<?php echo $editorsPick; ?>
				</div>
			</div>			
			<div class="clearfix"></div>
		</div>
	</div>
	<?php include_once 'includes/footer.php'; ?>
	<?php include_once 'includes/footer-scripts.php'; ?>
	<?php include_once 'admin/login.php'; ?>		
	<script>
		$(document).ready(function() {  
		    app.init(2);    
		});
	</script>
</body>
</html>