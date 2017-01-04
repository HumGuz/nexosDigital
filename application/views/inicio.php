<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital</title>
<?php  
	include_once 'includes/header-styles.php'; 
	include_once 'includes/meta.php'; 
?>
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
					<?php echo $popular; ?>
				</div>
				<div class="editors-pic-grids">						
					<?php echo $editorsPick; ?>
				</div>
				<?php  include_once 'includes/newsLetterForm.php'; ?>
			</div>
			<div class="clearfix"></div>
			 <!-- <div class="features">
				<h5>Noticias destacadas</h5>
				<h2>Nokia offering customers printable STL phone cases for the Lumia 820</h2>
			</div> 		 -->				
		</div>
	</div>
		<?php  include_once 'includes/footer.php'; ?>
		<?php include_once 'includes/footer-scripts.php'; ?>		
		<?php include_once 'admin/login.php'; ?>
		<script>
			$(document).ready(function() {  
			    app.init(1);    
			});
		</script>		
</body>
</html>