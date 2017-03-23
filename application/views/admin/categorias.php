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
                    <h1 class="page-header" style="    margin: 5px 0 10px;">Categorías</h1>
                    <button style="margin-bottom: 10px" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#nuevaN" id="btnnvac"> <span class="glyphicon glyphicon-plus-sign"></span> Nueva categoría</button>
                </div>
            </div>           
           <?php  
		    if(!empty($categorias)){            
		        ?>
		             <table id="tbl_items-list" class="table table-bordered table-condensed fix" data-set-width="false" data-fixed="false" data-height="200" data-max-width="1300" style="font-size: 12px">
		               <thead>
		                <tr class="middle" align="center">
		                	<td width="90px"><strong> Fecha </strong></td>    
		                    <td width="200px"><strong> Nombre  </strong></td>
		                    <td ><strong> Descripción </strong></td>    
		                    <td width="120px"><strong>Publicaciones</strong></td>  
		                    <td width="100px"><span class="glyphicon glyphicon-cog">  </span></td>                            
		                </tr>
		              </thead>               
		             <?php
		               	include_once 'includes/tblCategorias.php';  
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
	  <div class="modal-dialog " role="document">
	    <div class="modal-content ">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Nueva categoría</h4>
	      </div>
	      <div class="modal-body">
	       	<form id="nvaP-form">
	       		
	       		 <div class="form-group">
				    <label class="control-label"  for="nombre">Nombre</label>
				    <input type="text" class="form-control required" id="nombre" name="nombre">
				 </div>
	       		 
	       		 <div class="form-group">
				    <label class="control-label"  for="nombre">Descripción </label>
				    <input type="text" class="form-control required" id="descripcion" name="descripcion">
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
   
	<?php include_once 'includes/footer-scripts.php'; ?>
	<script src="<?php echo base_url();?>application/views/js/categorias.js"></script>
     <script>
     	categorias.initCat();
     </script>
     
</html>
