 <div id="nuevaN" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
	  	<div id="imgContainer" style="width: 100%;height: 100%;position: absolute;top:0px;left: 0px;opacity: 0"></div>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content ">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Nueva publicación</h4>
	      </div>
	      <div class="modal-body">
	       	<form id="nvaP-form">	       		
	       		 
				 <div class="row">					 				 	
				 	<div class="col-sm-6">
				 		
				 		<div class="form-group">
						    <label class="control-label"  for="nombre">Titulo</label>
						    <input type="text" class="form-control required" id="nombre" name="nombre">
						 </div>
				 		
				 		<div class="form-group">
						    <label class="control-label"  for="nombre">Categoría</label>
						   <select class="form-control selectpicker required" data-live-search="true" data-container="body" id="id_categoria" name="id_categoria">
						   		<option value="">-- seleccione --</option>
						   		<?php							
									if(!empty($categorias)){							
										foreach ($categorias as $key => $c) {
											echo ' <option value="'.$c['id_categoria'].'">[ '.$c['id_categoria'].' ] '.$c['nombre'].'</option>';
										}						
									}		
								?> 
						   </select>
						 </div>
						 
						 <div class="form-group">
						    <label class="control-label"  for="nombre">Fecha y hora</label>
						    <input type="text" class="form-control required" id="fecha" name="fecha" style="text-align: center">
						 </div>	
						 
				 		 <div class="form-group">
						    <label class="control-label"  for="nombre">Descripción del contenido</label>
						    <textarea id="descripcion" name="descripcion" class="form-control required" rows="3" style="resize: none"></textarea>				    
						 </div>	
						 
						 <div class="form-group">
						    <label class="control-label"  for="nombre">Hastags</label>
						    <input  class=" required" type="text" id="tags" name="tags" data-role="tagsinput">
						 </div>
				 	</div>
				 	<div class="col-sm-6">	
				 		<div class="form-group">
						    <label class="control-label"  for="nombre">Imagen [png,jpeg,jpg]</label>
						    <input type="file" class="form-control" id="imagen" name="imagen" style="text-align: center">
						</div>					 		
						<div class="row">				 	
				 			<div class="col-sm-12" id="imgContainer2" style="height: 140px;width:100%"></div>	
				 		</div>							
				 	</div>
				 </div>	       		 
	       		 
	       		 <div class="form-group">
		       		<label for="resumen">Resumen de la publicación</label>
		       		<textarea id="resumen" name="resumen" class="summernote required"></textarea>	       		
	       		  </div>
	       		 <div class="form-group">
		       		<label for="content">Contenido de la publicación</label>
		       		<textarea id="content" name="content" class="summernote required"></textarea>
	       		</div>
	       	 	</form> 	
	      </div>
	      <div class="modal-footer">
	      	 <button type="submit" class="btn btn-success" id="btn-save" onclick="$('#nvaP-form').submit()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
		publicaciones.initNuevaPublicacion(<?php echo json_encode($post) ?>,<?php echo json_encode($article) ?>)
	</script>