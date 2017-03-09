<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital | 404</title>
<?php  
	include_once 'includes/header-styles.php'; 
	include_once 'includes/meta.php'; 
?>
</head>
<body>
	<?php include_once 'includes/menu.php'; ?>
	<div class="container">
		<div class="content">
			<!--404-->
			<div class="error-404">
				<div class="error-404-head">
					<h1>4<span>0</span>4</h1>
					<h2>Perdona, la pagina solicitada no ha sido encontrada...!</h2>
					<a class="hvr-bounce-to-left button" href="<?php echo base_url(); ?>">ir al inicio</a>
				 </div>
			</div>
		</div>
	</div>
		<?php  include_once 'includes/footer.php'; ?>
		<?php include_once 'includes/footer-scripts.php'; ?>		
		<?php include_once 'admin/login.php'; ?>		
</body>
</html>