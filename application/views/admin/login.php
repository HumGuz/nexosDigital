<link href="<?php echo base_url();?>application/views/css/login.css" rel='stylesheet' type='text/css' /> 
<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>					
				</button>
				<h4 class="modal-title">Acceso del administrador</h4>
			</div>	
				<div class="modal-body">
					   <section id="login">
					        	    <div class="form-wrap">
					                <h1>Ingrese con su cuenta de Email</h1>
					                    <form role="form" action="javascript:;" method="post" id="login-form" autocomplete="off">
					                        <div class="form-group">
					                            <label class="control-label" for="email" >Email</label>
					                            <input type="text" name="email" id="email" class="form-control" placeholder="alguien@ejemplo.com">
					                        </div>
					                        <div class="form-group">
					                            <label class="control-label" for="key">Contraseña</label>
					                            <input type="password" name="key" id="key" class="form-control" placeholder="Contraseña">
					                        </div>
					                        <div class="checkbox">
					                            <span class="character-checkbox" onclick="login.showPassword()"></span>
					                            <span class="label">Mostrar contraseña</span>
					                        </div>
					                        <button type="submit" class="btn btn-custom btn-lg btn-block" id="btn-login" > <span class="glyphicon glyphicon-log-in"> </span> Ingresar</button>
					                        
					                    </form>					                   
					                   
					        	    </div>
					    		
					   </section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
					
				</div>			
		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
