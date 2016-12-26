<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles_model extends CI_Model {
		public function __construct(){
			date_default_timezone_set("America/Mexico_City");
	    	parent::__construct();
			$this->load->library('app');
	    }	
		
		function listArticles($data=''){
			$condition = '';
			if($data['id_categoria'])
				$condition .= " and c.id_categoria = ".$data['id_categoria'];
			
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
									 from t_articulos a 
									 inner join t_categorias c on c.id_categoria = a.id_categoria 
									 inner join t_admin u on u.id_admin = a.user 									 
									 where 1=1 ".$condition." order by a.fecha desc");			
			$result =  $res->result_array();
			return $result;
		}
		
		
		function getRecent($data){
			
			$pop = '';
			$condition = '';
			if($data['id_categoria'])
				$condition .= " and c.id_categoria = ".$data['id_categoria'];
			
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
									 from t_articulos a 
									 inner join t_categorias c on c.id_categoria = a.id_categoria 
									 inner join t_admin u on u.id_admin = a.user 									 
									 where a.status =1 ".$condition." order by a.fecha desc");			
			$result =  $res->result_array();
			if(!empty($result)){
				foreach ($result as $key => $r) {					
						$pop .= '			
							<div class="article">
								'.(($key==0)?'<h5 class="head">En noticias recientes</h5>':'').'
								<h6>'.$r['categoria'].'</h6>
								<a class="title" href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'" >'.$r['nombre'].'</a>
								<a href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.(app::encodeImg(base_url().'application/views/images/'.$r['imagen'])).'" alt="" /></a>
								'.$r['resumen'].'
							</div>
						';
				}
			}else{
				$pop =( '<div class="mnr-c"> <div class="med card-section">  <p style="padding-top:.33em"> No se han encontrado resultados para tu búsqueda.  </p>  <p style="margin-top:1em">Sugerencias:</p> <ul style="margin-left:1.3em;margin-bottom:2em"><li>Asegúrate de que todas las palabras están escritas correctamente.</li><li>Prueba diferentes palabras clave.</li><li>Prueba palabras clave más generales.</li></ul> </div> </div>');
			}
	   		return $pop;
		}
		
		function getArticle($data){			
			$pop = '';
			
			$condition .= ($data['admin'])?'':' and a.status = 1';
			
			
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
			from t_articulos a 
			inner join t_categorias c on c.id_categoria = a.id_categoria 
			inner join t_admin u on u.id_admin = a.user where a.id_articulo =".$data['id_articulo']." ".$condition);			
			
			$result =  $res->result_array();
			if(!empty($result)){
				$r = $result[0];				
				$tags = explode(',', $r['tags']);
				$t = '';
				if(count($tags)){
					for ($i=0; $i < count($tags); $i++) { 
						$t .= '<a '.$data['target'].' href="tag/'.$tags[$i].'">'.$tags[$i].'</a>';
					}
					$t .= ' | ';
				}
				return array('article'=>
				 '	<h3>'.$r['categoria'].'</h3>
					<a '.$data['target'].' href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'" >'.$r['nombre'].'</a>
					<p class="sub_head">Publicado por '.$r['autor'].' el '.(app::dateFormat($r['fecha'],5)).'</p>
					<a '.$data['target'].' href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.(app::encodeImg(base_url().'application/views/images/'.$r['imagen'])).'" class="img-responsive" alt="" /></a>
					<p class="span"> '.$t.'   el '.(app::dateFormat($r['fecha'],5)).'</p>
				 	<div class="article-content">
				 		'.$r['content'].'
				 	</div>
				 ','info'=>$r);
				
			}else{
				return array('article'=> '<div class="mnr-c"> <div class="med card-section">  <p style="padding-top:.33em"> No se han encontrado resultados para tu búsqueda.  </p>  <p style="margin-top:1em">Sugerencias:</p> <ul style="margin-left:1.3em;margin-bottom:2em"><li>Asegúrate de que todas las palabras están escritas correctamente.</li><li>Prueba diferentes palabras clave.</li><li>Prueba palabras clave más generales.</li></ul> </div> </div>');
			}
	   		
		}

		function getCategorias($data){	
			$res = $this->db->query("select * from t_categorias c order by nombre asc");			
			$result =  $res->result_array();			
	   		return $result;
		}


		function getFeatures(){ 
			return '				
						<ul>
							<li><a href="#">Fused Filament Fabrication (FFF) using 1.75 mm filament</a></li>
							<li><a href="#">100 micron layer resolution capability</a></li>
							<li><a href="#">9? diameter x 11? tall build envelope (approximate)</a></li>
							<li><a href="#">Heated build platform (optional)</a></li>
							<li><a href="#">Efficient footprint to build envelope ratio</a></li>
							<li><a href="#">Printed object viewable from 360 degrees</a></li>
							<li><a href="#">Rigid aluminum extrusion construction</a></li>
							<li><a href="#">Utilizes open source software tool chain</a></li>
						</ul>
			';
		}

	   function getPopular(){
			$pop = '';
			$res = $this->db->query("select a.* from t_articulos a 													 
									 where a.status = 1 ".$condition." order by views_count desc limit 4");			
			$result =  $res->result_array();
			if(!empty($result)){
				$pop .= '<h5 class="head">Populares</h5>	';
				foreach ($result as $key => $r) {					
						$pop .= '
							<a href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'">
								<div class="editor text-center">
									<h3>'.$r['nombre'].'</h3>
									<p>'.$r['descripcion'].'</p>
									<label>Hace '.(app::fulldatediff($r['fecha'],date('Y-m-d H:i'))).'</label>
									<span></span>
								</div>
							</a>
						';
				}
			}
	   		return $pop;
	   }


		function updateOption($data){		
			$res = $this->db->query("update t_articulos a set a.".$data['col']." = if(a.".$data['col']."=0,1,0)	 where a.id_articulo =".$data['id_articulo']);			
			if($res)
				return array('status'=>1);
			else
				return array('status'=>2);
	   }



 		function getEditorsPick(){
			$pop = '';				
 			$res = $this->db->query("select a.id_articulo,a.nombre,a.imagen,a.fecha from t_articulos a where a.editor_selection = 1 and a.status = 1 order by a.fecha desc limit 5");			
			$result =  $res->result_array();
			if(!empty($result)){
					$pop .= '<h5>Selección del editor</h5>';
					
				foreach ($result as $key => $r) {
					$pop .= '
						<div class="editors-pic">
							<div class="e-pic">
								<a href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.(app::encodeImg(base_url().'application/views/images/'.$r['imagen'])).'" alt="" /></a>
							</div>
							<div class="e-pic-info">
								<a href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'">'.$r['nombre'].'</a>
								<span></span>
								<label>Hace '.(app::fulldatediff($r['fecha'],date('Y-m-d H:i'))).'</label>
							</div>
							<div class="clearfix"></div>
						</div>';
				}
			}
	   		return $pop;
	   }
	   
	  function guardarArticulo($data){	  	
	  	unset($data['request']);	
	  	if(empty($data['id_articulo'])){
            $this->db->insert('t_articulos', $data);
        }else{
            $this->db->where('id_articulo', $data['id_articulo']);
			unset($data['id_articulo']);
            $this->db->update('t_articulos', $data);
        }
	  }

	  function deleteArticulo($data){ 
    		return $this->db->delete('t_articulos', $data);
	  } 
	  
	  
	  function getArticulo($data){				
			$res = $this->db->query("select a.id_articulo,a.nombre,a.descripcion,a.id_categoria,a.tags,a.content,a.resumen,a.imagen,a.fecha
									 from t_articulos a  
									 where a.id_articulo =".$data['id_articulo']);	
			$result =  $res->result_array();
			return $result[0];
	   		
		}
	  
	  
}