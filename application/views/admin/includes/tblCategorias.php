<?php  
    if(!empty($categorias)){ 
            foreach ($categorias as $key => $a) {            	
				 echo '<tr class="item" >
                        <td width="90px" align="center"><strong> <strong>'.app::dateFormat($a['fecha'],3).'</strong>  </strong></td>
                        <td width="200px">[<strong> '.$a['id_categoria'].'</strong> ] '.$a['nombre'].'</td>
                        <td >'.$a['descripcion'].'</td>      
                        <td  width="120px" align="center"><strong> '.$a['publicaciones'].'</strong></td>      
                        <td   align="center" width="100px" align="center" style="padding:0px">
							<div class="btn-group-vertical btn-group-xs" data-toggle="buttons">
							   <button type="button" class="btn btn-default" onclick="categorias.editarCategoria({id_categoria:'.$a['id_categoria'].'})"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
							   '.(($a['publicaciones']==0)?'<button type="button" class="btn btn-danger" onclick="categorias.borrarCategoria({id_categoria:'.$a['id_categoria'].'})"><span class="glyphicon glyphicon-trash"></span> Borrar</button>':'').'
							</div>							
                        </td>
                      </tr>';               
            }
   }
?>