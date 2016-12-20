<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles_model extends CI_Model {
		public function __construct(){
	    	parent::__construct();
			$this->load->library('app');
	    }	
		
		function getRecent($data){
			
			$pop = '';
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
			from t_articulos a 
			inner join t_categorias c on c.id_categoria = a.id_categoria 
			inner join t_admin u on u.id_admin = a.user ");			
			$result =  $res->result_array();
			if(!empty($result)){
				foreach ($result as $key => $r) {					
						$pop .= '			
							<div class="article">
								'.(($key==0)?'<h5 class="head">En noticias recientes</h5>':'').'
								<h6>'.$r['categoria'].'</h6>
								<a class="title" href="'.$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'" >'.$r['nombre'].'</a>
								<a href="'.$r['id_articulo'].'/'.(app::poner_guion($r['nombre'])).'"><img src="'.base_url().'application/views/images/'.$r['image'].'" alt="" /></a>
								'.$r['resumen'].'
							</div>
						';
				}
			}
	   		return $pop;
		}
		
		function getArticle($data){			
			$pop = '';
			$res = $this->db->query("select a.*,c.nombre as categoria, concat(u.nombre,' ',u.apellidos) as autor 
			from t_articulos a 
			inner join t_categorias c on c.id_categoria = a.id_categoria 
			inner join t_admin u on u.id_admin = a.user where a.id_articulo =".$data['id_articulo']);			
			
			$result =  $res->result_array();
			if(!empty($result)){
				$res = $result[0];				
				$tags = explode(',', $res['tags']);
				$t = '';
				if(count($tags)){
					for ($i=0; $i < count($tags); $i++) { 
						$t .= '<a href="tag/'.$tags[$i].'">'.$tags[$i].'</a>';
					}
					$t .= ' | ';
				}
				return array('article'=>
				 '	<h3>'.$res['categoria'].'</h3>
					<a href="'.$res['id_articulo'].'/'.(app::poner_guion($res['nombre'])).'" >'.$res['nombre'].'</a>
					<p class="sub_head">Publicado por <a href="#">'.$res['autor'].'</a> el '.(app::dateFormat($r['fecha'],5)).'</p>
					<a href="single.html"><img src="'.base_url().'application/views/images/'.$res['image'].'" class="img-responsive" alt="" /></a>
					<p class="span"> '.$t.'   el '.(app::dateFormat($r['fecha'],5)).'</p>
				 	<div class="article-content">
				 		'.$res['content'].'
				 	</div>
				 ','info'=>$res);
				
			}
	   		return $pop;
		}

		function getFeatures(){ 
			return '				
						<ul>
							<li><a href="#">Fused Filament Fabrication (FFF) using 1.75 mm filament</a></li>
							<li><a href="#">100 micron layer resolution capability</a></li>
							<li><a href="#">9″ diameter x 11″ tall build envelope (approximate)</a></li>
							<li><a href="#">Heated build platform (optional)</a></li>
							<li><a href="#">Efficient footprint to build envelope ratio</a></li>
							<li><a href="#">Printed object viewable from 360 degrees</a></li>
							<li><a href="#">Rigid aluminum extrusion construction</a></li>
							<li><a href="#">Utilizes open source software tool chain</a></li>
						</ul>
			';
		}

	   function getPopular(){
	   		return '
	   			
					<a href="article/'.str_replace(' ', '-', strtolower ('The new kid on the block An Elegant 3D Printer')).'/5521">
						<div class="editor text-center">
							<h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
							<p>A new cheap ass 3D Printer worth checking out</p>
							<label>2 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a class="active" href="article/'.str_replace(' ', '-', strtolower ('Autodesk Inventor Fusion for Mac')).'/5521">
						<div class="editor text-center">
							<h3>Software Review: Autodesk Inventor Fusion for Mac</h3>
							<p>3D Printing, 3D Software</p>
							<label>3 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a href="article/'.str_replace(' ', '-', strtolower ('A new cheap ass 3D Printer worth checking out')).'/5521">
						<div class="editor text-center">
							<h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
							<p>A new cheap ass 3D Printer worth checking out</p>
							<label>2 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a href="article/'.str_replace(' ', '-', strtolower ('3D Printing, 3D Software')).'/5521">
						<div class="editor text-center">
							<h3>Software Review: Autodesk Inventor Fusion for Mac</h3>
							<p>3D Printing, 3D Software</p>
							<label>3 Days Ago</label>
							<span></span>
						</div>
					</a>
	   		';
	   }

 		function getEditorsPick(){
			$pop = '';				
 			$res = $this->db->query("select a.nombre,a.image_min,a.fecha from t_articulos a where a.editor_selection = 1 order by a.fecha desc limit 5");			
			// $res = $this->db->query("select a.nombre,a.img_min,a.fecha from t_articulos a inner join t_categorias c on c.id_categoria = a.id_categoria inner join t_admin u on u.id_admin = a.user");			
			
			$result =  $res->result_array();
			if(!empty($result)){
				foreach ($result as $key => $r) {
					$pop .= '
						<div class="editors-pic">
							<div class="e-pic">
								<a href="single.html"><img src="'.base_url().'application/views/images/'.$r['image_min'].'" alt="" /></a>
							</div>
							<div class="e-pic-info">
								<a href="single.html">'.$r['nombre'].'</a>
								<span></span>
								<label>Hace '.(app::fulldatediff($r['fecha'],date('Y-m-d H:i'))).'</label>
							</div>
							<div class="clearfix"></div>
						</div>';
				}
			}
	   		return $pop;
	   }

}