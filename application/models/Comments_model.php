<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments_model extends CI_Model {
		public function __construct(){
			date_default_timezone_set("America/Mexico_City");
	    	parent::__construct();	
			$this->load->library('app');		
	    }
		
		function guardarComentario($data){	
		  	unset($data['request']);
			unset($data['newsletter']);
			$data['fecha'] = date('Y-m-d H:i:s');
		  	$this->db->insert('t_comentarios', $data);
			return array('status' => 1,'comentario'=>$this->getComments(array('id_comentario'=>$this->db->insert_id())));
		}
		
		
		function getComments($data){			
			$condition = '';
			if($data['id_comentario'])
				$condition .= " and id_comentario = ".$data['id_comentario'];			
			if($data['id_articulo'])
				$condition .= " and id_articulo = ".$data['id_articulo'];			
			$pop = '';			
			$res = $this->db->query("select * from t_comentarios where 1=1 ".$condition." order by fecha desc");			
			$result =  $res->result_array();
			if(!empty($result)){
				foreach ($result as $key => $r) {										
						$pop .= '
							<div class="comments-main">
								<div class="col-md-3 cmts-main-left">
									<img src="'.base_url().'application/views/images/avatar.jpg" alt="">
								</div>
								<div class="col-md-9 cmts-main-right">
									<h5>'.$r['nombre'].'</h5>
									<p>'.$r['comentario'].'</p>
									<div class="cmts">
										<div class="col-md-6 cmnts-left">
											<p> el '.(app::dateFormat($r['fecha'],5)).'</p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						';
				}
			}
	   		return $pop;
		}
	
	
		

}