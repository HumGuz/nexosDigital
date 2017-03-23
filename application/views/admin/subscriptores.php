<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Nexos Digital | Subscriptores</title>
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
                    <h1 class="page-header" style="    margin: 5px 0 10px;">Subscriptores</h1>
                </div>
            </div>           
           <?php  
		    if(!empty($subscriptores)){            
		        ?>
		             <table id="tbl_items-list" class="table table-bordered table-condensed fix" data-set-width="false" data-fixed="false" data-height="200" data-max-width="1300" style="font-size: 12px">
		               <thead>
		                <tr class="middle" align="center">		                	
		                    <td><strong> Nombre  </strong></td>
		                    <td width="200px" ><strong> Email </strong></td>    
		                    <td width="110px"><strong>Registro</strong></td>  
		                    <td width="110px"><strong>Confirmación</strong></td>  
		                    <td width="100px"><span class="glyphicon glyphicon-cog"></span></td>                            
		                </tr>
		              </thead>               
		             <?php
		               	include_once 'includes/tblSubscriptores.php';  
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
	<?php include_once 'includes/footer-scripts.php'; ?>
	<script src="<?php echo base_url();?>application/views/js/subscriptores.js"></script>
     <script>
     	subscriptores.initSub();
     </script>     
</html>
