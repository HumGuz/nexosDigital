<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles_model extends CI_Model {
		public $path;
		public function __construct(){
			date_default_timezone_set("America/Mexico_City");
	    	parent::__construct();
			$this->load->library('app');
			$this->load->helper('file');	
			$this->path = 'C:/xamp/xampp/htdocs/nexosDigital/application/views/articles/';
	  	 // $this->path = '/homepages/13/d656598473/htdocs/nexosDigital/application/views/articles/';	
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
		
		function getRecent($data,$page=0){			
			$pop = '';
			$condition = '';			
			if($data['id_categoria'])
				$condition .= " and c.id_categoria = ".$data['id_categoria'];			
			$perPage = 5;
			
			$limit = " limit ".( $page>0 ?($perPage * $page) - $perPage:0).",".$perPage;			
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
									 from t_articulos a 
									 inner join t_categorias c on c.id_categoria = a.id_categoria 
									 inner join t_admin u on u.id_admin = a.user 									 
									 where a.status =1 ".$condition." ".$limit);			
			$result =  $res->result_array();
			if(!empty($result)){
				foreach ($result as $key => $r) {
						$resument = read_file($this->path.$r['resumen']);					
						$pop .= '			
							<div class="article">
								'.(($key==0)?'<h5 class="head">En noticias recientes</h5>':'').'
								<h6>'.$r['categoria'].'</h6>
								<a class="title" href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'" >'.$r['nombre'].'</a>
								<a href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.(app::encodeImg(base_url().'application/views/images/'.$r['imagen'])).'" alt="" /></a>
								'.$resument.'
							</div>
						';
				}
			}else{
				$pop =( '<div class="mnr-c"> <div class="med card-section">  <p style="padding-top:.33em"> No se han encontrado resultados para tu búsqueda.  </p>  <p style="margin-top:1em">Sugerencias:</p> <ul style="margin-left:1.3em;margin-bottom:2em"><li>Asegúrate de que todas las palabras están escritas correctamente.</li><li>Prueba diferentes palabras clave.</li><li>Prueba palabras clave más generales.</li></ul> </div> </div>');
			}
	   		return $pop;
		}
		
		function paginar($page,$cat,$caturl){								
				$condition = '';				
				//paginacion con categorias
				//$route['cat/(:num)/(:any)/p/(:num)'] = 'nexos/index/catp/$1/$3/$2';
				//paginacion normal
				// $route['p/(:num)'] = 'nexos/index/p/0/$1';				
				$base_url_clean =  base_url().( ($cat)?'cat/'.$cat.'/'.$caturl.'/':'' ); 					
				$base_url = base_url().( ($cat)?'cat/'.$cat.'/'.$caturl.'/p/':'p/' ); 	
				$perPage = 5;				
				if($cat)
					$condition .= ' and id_categoria = '.$cat;					
				$sql = "select count(a.id_articulo) as todos from t_articulos a where 1=1 ".$condition;
					// return $sql;			
				$res = $this->db->query($sql);		
				$result =  $res->result_array();				
				$todos = $result[0]['todos'];		
				 $paginator = '';									
				if( $todos > 5 ){					
					$paginas = ceil($todos / $perPage);	
					$paginasFaltantes = $paginas - $page;						
					$paginator = '';
					if($paginas>=2){
						$paginator .= '<div class="paginator">
											<ul class="pager">';
						if($page>1 && $paginas>=6)
							$paginator .= '  <li><a href="'.$base_url.($page-1).'" class="btn "><span class="glyphicon glyphicon-chevron-left"></span> Anterior</a></li>';
						if($page!=$paginas && $paginas>=6)	
							$paginator .= '   <li><a href="'.$base_url.($page+1).'" class="btn ">Siguiente <span class="glyphicon glyphicon-chevron-right"></span> </a></li> ';
						$paginator .= '</ul>
									<nav aria-label="Page navigation" id="div1">
										<ul class="pager">	';
								if($page>1  && $paginas>=6)
									$paginator .= '<li><a href="'.$base_url_clean.'" class="btn ">« 1 ...</a></li>';	
								$page =  $page==0 ? 1 : $page ;	
								$pageNow = $page;
								if($paginasFaltantes>=6){
									$paginator .= '<li><a href="#" class="btn disabled">'.$page.'</a></li>';	
									$page ++;
									for ($i=0; ($i < 4 && $i < $paginasFaltantes ); $i++) { 									
										$paginator .= '<li><a href="'.$base_url.($page).'" class="btn ">'.$page.'</a></li>';									
										$page ++;
									}								
									if(($page - $paginasFaltantes)>1)
										$paginator .= '<li><a href="'.$base_url.($paginas).'" class="btn ">... '.$paginas.' »</a></li>';
								}else{																		
									$page = ( $paginas - 5 > 0 ? $paginas - 5 : 1 );					
									for($i= $paginas; $i>($paginas - 5 ) && $page <= $paginas;$i--){
										$paginator .= '<li><a href="'.$base_url.($page).'" class="btn '.($pageNow == $page?'disabled':'').'">'.$page.'</a></li>';									
										$page ++;
									}
									if(($i==($paginas - 5 )))
										$paginator .= '<li><a href="'.$base_url.($paginas).'" class="btn '.($pageNow == $page?'disabled':'').' ">... '.$paginas.' »</a></li>';
								}							
								$paginator .="</ul></nav></div>";
					}
				}				
				return $paginator;
		}
		
		
		
		function getArticle($data){			
			$pop = '';			
			$condition .= ($data['admin'])?'':' and a.status = 1';
			
			$this->db->query("update t_articulos set views_count = (views_count  + 1) where id_articulo =".$data['id_articulo']);
			
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
				
				$content = read_file($this->path.$r['content']);
				
				return array('article'=>
				 '	<h3>'.$r['categoria'].'</h3>
					<a '.$data['target'].' href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'" >'.$r['nombre'].'</a>
					<p class="sub_head">Publicado por '.$r['autor'].' el '.(app::dateFormat($r['fecha'],5)).'</p>
					<a '.$data['target'].' href="'.base_url().$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.(app::encodeImg(base_url().'application/views/images/'.$r['imagen'])).'" class="img-responsive" alt="" /></a>
					<p class="span"> '.$t.'   el '.(app::dateFormat($r['fecha'],5)).'</p>
				 	<div class="article-content">
				 		'.$content.'
				 	</div>
				 ','info'=>$r);
				
			}else{
				return array('article'=> '<div class="mnr-c"> <div class="med card-section">  <p style="padding-top:.33em"> No se han encontrado resultados para tu búsqueda.  </p>  <p style="margin-top:1em">Sugerencias:</p> <ul style="margin-left:1.3em;margin-bottom:2em"><li>Asegúrate de que todas las palabras están escritas correctamente.</li><li>Prueba diferentes palabras clave.</li><li>Prueba palabras clave más generales.</li></ul> </div> </div>');
			}	   		
		}

		function getCategorias($data){
			$condition .= ($data['id_categoria'])?' and c.id_categoria = '.$data['id_categoria']:'';				
			$res = $this->db->query("select c.*,count(a.id_articulo) as publicaciones from t_categorias c 
									 left join t_articulos a on a.id_categoria = c.id_categoria
									 where 1=1 ".$condition." group by c.id_categoria order by c.id_categoria");			
			$result =  $res->result_array();			
	   		return $result;
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
	  	$code = $this->getCode();	  	
	  	$content = 'content-'.$code.'.txt';
	  	$resumen = 'resumen-'.$code.'.txt';	  	
	  	if(!write_file($this->path.$content,$data['content'],'x'))
				return array('status'=>2,'file'=>$content);
	  	if(!write_file($this->path.$resumen,$data['resumen'],'x'))
				return array('status'=>2,'file'=>$resumen);
		$data['content'] = $content;
		$data['resumen'] = $resumen;
	  	if(empty($data['id_articulo'])){
            $this->db->insert('t_articulos', $data);
        }else{
            $this->db->where('id_articulo', $data['id_articulo']);
			unset($data['id_articulo']);
            $this->db->update('t_articulos', $data);
        }		
		return array('status'=>1);
	  }
	  
	  function getCode($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
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
	  
	  /* categorias */
	  function guardarCategoria($data){	  	
	  	unset($data['request']);	
	  	if(empty($data['id_categoria'])){
            $this->db->insert('t_categorias', $data);
        }else{
            $this->db->where('id_categoria', $data['id_categoria']);
			unset($data['id_categoria']);
            $this->db->update('t_categorias', $data);
        }
	  }
	  function deleteCategoria($data){ 
    		return $this->db->delete('t_categorias', $data);
	  } 
		function infoCliente($data){ 	
	        $this->db->insert('t_info_visitantes', $data);
		}
	  
}