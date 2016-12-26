<?php  
    if(!empty($articulos)){ 
            foreach ($articulos as $key => $a) {            	
				 echo '<tr class="item" >
                        <td width="90px" align="center"><strong> <strong>'.app::dateFormat($a['fecha'],3).'</strong>  </strong></td>
                        <td width="200px">[<strong> '.$a['id_articulo'].'</strong> ] '.$a['nombre'].'</td>
                        <td >'.$a['descripcion'].'</td>      
                        <td width="40px" align="center" ><span  data-toggle="tooltip" data-placement="top" title="'.$a['categoria'].'">[ <strong>'.$a['id_categoria'].'</strong> ] </span></td>                    
                        <td  width="120px">'.$a['autor'].'</td>      
                        <td  align="right" width="60px"><strong>'.$a['views_count'].'</strong></td>
                        <td   align="center" width="100px" align="center" style="padding:0px">
							<div class="btn-group-vertical btn-group-xs" data-toggle="buttons">
							  <button type="button" class="btn btn-info" onclick="admin.preview({id_articulo:'.$a['id_articulo'].'})"><span class="glyphicon glyphicon-exclamation-sign"></span> Ver</button>
							   <button type="button" class="btn btn-default" onclick="admin.editarArticulo({id_articulo:'.$a['id_articulo'].'})"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
							  <label class="btn '.(($a['editor_selection'])?'btn-primary':'btn-default').' togle" data-col="editor_selection"  data-id_articulo="'.$a['id_articulo'].'">
							    <input type="checkbox" autocomplete="off" '.(($a['editor_selection'])?'checked="checked"':'').'><span class="glyphicon '.(($a['editor_selection'])?'glyphicon-ok':'').'"></span> Sel. editor
							  </label>
							  <label class="btn '.(($a['relevant'])?'btn-primary':'btn-default').' togle" data-col="relevant" data-id_articulo="'.$a['id_articulo'].'">
							    <input type="checkbox" autocomplete="off" '.(($a['relevant'])?'checked="checked"':'').'><span class="glyphicon '.(($a['relevant'])?'glyphicon-ok':'').'"></span> Destacada
							  </label>
							  <label class="btn '.(($a['status'])?'btn-default':'btn-warning').' watch togle" data-col="status" data-id_articulo="'.$a['id_articulo'].'">
							    <input type="checkbox" autocomplete="off" '.(($a['status'])?'checked="checked"':'').'><span class="glyphicon '.(($a['status'])?'glyphicon-eye-open':'glyphicon-eye-close').'"></span> <span> '.(($a['status'])?'Visible':'Oculto').'</span>
							  </label>
							  <button type="button" class="btn btn-danger" onclick="admin.borrarArticulo({id_articulo:'.$a['id_articulo'].'})"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
							</div>							
                        </td>
                      </tr>';               
            }
   }
?>