<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Nexos Digital | Administración del sitio</title>
    <?php include_once 'includes/header-styles.php'; ?>    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include_once 'includes/menu.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="    margin: 5px 0 10px;">Articulos / Publicaciones</h1>
                    <button style="margin-bottom: 10px" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#nuevaN"> <span class="glyphicon glyphicon-plus-sign"></span> Nueva publicación</button>
                </div>
            </div>           
           <?php  
		    if(!empty($articulos)){            
		        ?>
		             <table id="tbl_items-list" class="table table-bordered table-condensed fix" data-set-width="false" data-fixed="false" data-height="200" data-max-width="1300" style="font-size: 12px">
		               <thead>
		                <tr class="middle" align="center">
		                	<td width="90px"><strong> Fecha </strong></td>    
		                    <td width="200px"><strong> [ ID ] Titulo  </strong></td>
		                    <td ><strong> Descripción </strong></td>
		                    <td width="40px"><strong> Cat. </strong></td>      
		                    <td width="120px"><strong>Autor</strong></td>  
		                    <td width="60px"><strong> Vistas </strong></td>        
		                    <td width="100px"><span class="glyphicon glyphicon-cog">  </span></td>                            
		                </tr>
		              </thead>               
		             <?php
		               	include_once 'includes/tblArticles.php';  
		             ?>
		        </table>
		<?php      
		     }else{
		        echo '<div class="alert alert-warning" role="alert"><strong><span class="glyphicon glyphicon-exclamation-sign"></span> No hay información para mostrar</strong>
		                <br>
		                <p style="font-size:12px">
		                Compruebe lo siguiente:<br>
		                - Comprueba que este modulo ya cuente con registros.<br>
		                - Asegúrate de que todas las palabras en el filtro estén escritas correctamente.<br>
		                </p>        
		             </div>';
		    }
		?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    
    <div id="nuevaN" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content ">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Nueva publicación</h4>
	      </div>
	      <div class="modal-body">
	       	<form id="nvaP-form">
	       		
	       		 <div class="form-group">
				    <label class="control-label"  for="nombre">Titulo</label>
				    <input type="text" class="form-control required" id="nombre" name="nombre">
				 </div>
	       		 
	       		 <div class="form-group">
				    <label class="control-label"  for="nombre">Descripción del contenido</label>
				    <input type="text" class="form-control required" id="descripcion" name="descripcion">
				 </div>			 
				 
				 <div class="row">				 	
				 	<div class="col-sm-4">
				 		<div class="form-group">
						    <label class="control-label"  for="nombre">Fecha y hora de publicación</label>
						    <input type="text" class="form-control required" id="fecha" name="fecha" style="text-align: center">
						</div>
				 	</div>
				 	<div class="col-sm-4">
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
				 	</div>
				 	<div class="col-sm-4">
				 		<div class="form-group">
						    <label class="control-label"  for="nombre">Imagen [png,jpeg,jpg]</label>
						    <input type="file" class="form-control required" id="imagen" name="imagen" style="text-align: center">
						</div>
				 	</div>
				 </div>
	       		
	       		
	       		 <div class="row">				 	
				 	<div class="col-sm-12" id="imgContainer">
				 		
				 		
				 	</div>
				 </div>
	       		
	       		
	       		 <div class="form-group">
				    <label class="control-label"  for="nombre">Tags</label>
				    <input  class=" required" type="text" id="tags" name="tags" data-role="tagsinput">
				 </div>
				 
	       	</form> 	
	       		
	       		<label for="resumen">Resumen de la publicación</label>
	       		<div id="resumen" class="summernote"></div>	       		
	       		
	       		<label for="content">Contenido de la publicación</label>
	       		<div id="content" class="summernote"></div>
	       		
	       		
				 
	       		
	       	
	      </div>
	      <div class="modal-footer">
	      	 <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    
  
<div id="preview" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Vista previa de la publicación</h4>
      </div>
      <div class="modal-body">
         <div class="single-page">
			<div class="print-main">
					
					
					
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
	<?php include_once 'includes/footer-scripts.php'; ?>
	<script src="<?php echo base_url();?>application/third_party/summernote/summernote.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/summernote/summernote.css">
    
    
    <script src="<?php echo base_url();?>application/third_party/bootstrap-select/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap-select/css/bootstrap-select.min.css">
    
    
     <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap-tagsinput/bootstrap-tagsinput.css">
     <script src="<?php echo base_url();?>application/third_party/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    
    
     <script src="<?php echo base_url();?>application/third_party/bootstrap-datetimepicker/js/moments.min.js" type="text/javascript"> </script>
	 <script src="<?php echo base_url();?>application/third_party/bootstrap-datetimepicker/js/es.js" type="text/javascript"> </script>  
	 <script src="<?php echo base_url();?>application/third_party/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"> </script>  
	 <link href="<?php echo base_url();?>application/third_party/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    
    
     <style>
     	.bootstrap-tagsinput{
     		display:block!important;
     	}
     	
     	.bootstrap-tagsinput .label-info {
		    background-color: #333!important;
		}
     	.bootstrap-tagsinput .label {
		    font-size: 13px!important;
		}
		
		/* Important part */
		.modal-dialog{
		    overflow-y: initial !important
		}
		.modal-body{
		    height: calc(100% - 300px);
		    overflow-y: auto;
		}
		
     </style>
    
    
</body>
</html>
