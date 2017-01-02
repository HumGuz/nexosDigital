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
</body>
</html>