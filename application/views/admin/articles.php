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
    <style>
    	tr.item * {
    		border-radius:0px!important
    	}
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include_once 'includes/menu.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="    margin: 5px 0 10px;">Articulos / Publicaciones</h1>
                    <button style="margin-bottom: 10px" type="button" class="btn btn-default btn-sm" id="nuevaNP" onclick="publicaciones.nuevaPublicacion({})"> <span class="glyphicon glyphicon-plus-sign"></span> Nueva publicación</button>
                </div>
            </div>
           	<div class="portlet-body" style="font-size: 12px; padding: 0px; position: relative !important;">
					<table id="tbl_items-list" class="table-condensed table-bordered" style="width: calc(100% - 16px)">
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
					</table>
					<div id="articlesScroller" class="scroller-tbl" >
						<table id="articlesContainer" class="table-bordered table-condensed table-striped " style=" margin:0px!important;width:100% ;">
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
				<style>
					.scroller-tbl {
						overflow: hidden;
						width: auto;
						padding: 0px;
						margin: 0px;
						overflow-y: scroll;
						height: calc(100% - 27px );
					}					
				</style>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->   

	<?php include_once 'includes/footer-scripts.php'; ?>
	<script src="<?php echo base_url();?>application/views/js/publicaciones.js"></script>
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
     <script>
     	admin.init();
     	publicaciones.init();
     </script>
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
