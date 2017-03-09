<?php  
    if(!empty($mensajes)){
    	
		
		// <td width="90px"><strong> Fecha </strong></td>    
		                    // <td width="200px"><strong> Nombre  </strong></td>
		                    // <td width="200px">Email</td> 
		                    // <td width="50px">Edad</td>   
		                    // <td width="50px">Sexo</td>    
		                    // <td width="150px">Asunto</td>    
		                    // <td ><strong>Comentario</strong></td>  
		
		 
            foreach ($mensajes as $key => $a) {            	
				 echo '<tr class="item" >
                        <td width="90px" align="center"><strong> <strong>'.app::dateFormat($a['fecha'],3).'</strong>  </strong></td>
                        <td width="200px">'.$a['nombre'].'</td>
                        <td width="200px">'.$a['mail'].'</td>      
                        <td width="50px" align="center"><strong> '.$a['edad'].'</strong></td>      
                        <td width="100px" align="center">'.($a['sexo']=='m'?'Hombre':'Mujer' ).'</td>   
                        <td  width="150px">'.$a['asunto'].'</td>      
                        <td >'.$a['comentario'].'</td>   
                      </tr>';               
            }
   }
?>