<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Nexos Digital | Contacto </title>
<?php  
	include_once 'includes/header-styles.php'; 
	include_once 'includes/meta.php'; 
?>
</head>
<body>
	<?php include_once 'includes/menu.php'; ?>
	<div class="container">
		<div class="content">
			<div class="contact-section">
					<h3 class="c-head">Contactanos</h3>
					<div class="singel_right">
						<div class="lcontact span_1_of_contact">
							<div class="contact-form" style="padding: 0px 15px">
								<form id="contacto-Form">
									 <div class="form-group">
									    <label for="nombre" class="control-label" >Nombre</label>
									    <input type="text" class="form-control required" id="nombre"  name="nombre" >
									  </div>
									 <div class="form-group">
									    <label for="mail" class="control-label" >Correo electrónico</label>
									    <input type="text" class="form-control required"  id="mail"  name="mail" >
									  </div>
									  
									  <div class="row">									  
									  	<div class="col-sm-4">
									  		 <div class="form-group">
											    <label for="edad" class="control-label" >Edad</label>
											    <input type="text" class="form-control required number"  id="edad"  name="edad" >
											 </div>
									  	</div>
									  	<div class="col-sm-8">									  		
									  		 <label for="sexo" class="control-label" >Sexo</label>
									  		<div class="col-sm-6">
									  			<div class="radio">
												  <label>
												    <input type="radio" name="sexo" id="masculino" value="m" checked>
												    Masculino
												  </label>
												</div>
									  		</div>
									  		<div class="col-sm-6">
									  			<div class="radio">
												  <label>
												    <input type="radio" name="sexo" id="femenino" value="f">
												    Femenino
												  </label>
												</div>
									  		</div>
									  	</div>
									  </div>
									 	
									 <div class="form-group">
									    <label for="asunto" class="control-label" >Asunto</label>
									    <input type="text" class="form-control required"  id="asunto"  name="asunto" >
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
									 <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Enviar</button>
									 <button onclick="$('#contacto-Form').resetForm()" type="button" class="btn btn-default">Limpiar</button>
								</form>
							</div>
						</div>
						<div class="contact_grid span_2_of_contact_right">
							<h3>Dirección</h3>
							<iframe width="100%" height="400px" frameborder="0" style="border:0"src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJERXX1XhVKIQRyH15i5n_iSM&key=AIzaSyAlKD1xLAm_0fsJRHbr-AZyjfxvNoiV8rM" allowfullscreen></iframe>
							<h3 style="margin: 0px">Celular</h3>
							<p class="text-danger bold">346-102-0780</p>
						</div>
						<div class="clearfix"></div>
					</div>					
				</div>
		</div>
	</div>
		<?php  include_once 'includes/footer.php'; ?>
		<?php include_once 'includes/footer-scripts.php'; ?>		
		<?php include_once 'admin/login.php'; ?>	
		<script>
			$(document).ready(function() {  
			    app.init(3);    
			});
		</script>		
</body>
</html>