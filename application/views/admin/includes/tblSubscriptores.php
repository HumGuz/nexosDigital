<?php  
    if(!empty($subscriptores)){ 
            foreach ($subscriptores as $key => $a) {            	
				 echo '<tr class="item" >                       
                        <td >'.$a['nombre'].'</td>
                        <td width="200px">'.$a['mail'].'</td>  
					    <td width="110px" align="center"><strong> <strong>'.app::dateFormat($a['fecha'],3).'</strong>  </strong></td>
					    <td width="110px" align="center"><strong> <strong>'.app::dateFormat($a['confirm_date'],3).'</strong>  </strong></td>
                        <td   align="center" width="100px" align="center" style="padding:0px">
							<div class="btn-group-vertical btn-group-xs" data-toggle="buttons">							
							   <button type="button" class="btn btn-danger" onclick="admin.borrarSubscriptor({id_subscriber:'.$a['id_subscriber'].'})"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
							</div>							
                        </td>
                      </tr>';               
            }
   }
?>