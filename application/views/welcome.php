<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital | Bienvenido</title>
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
			<div class="error">
				<div class="error-head">
					<h1 style="    font-size: 3em;"><span>¡Bienvenido a Nexos Digital!</span></h1>
					<h2 style="    font-size: 1.2em;">Se ha enviado un correo de confirmaicón a <strong style="    font-weight: 700;"><?php echo $_SESSION['register_mail'] ?></strong>, una vez confirmada tu cuenta, podras recibir las publicaciones mas importantes de Nexos Digital.</h2>
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