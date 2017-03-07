<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Comments extends CI_Controller {
	public function __construct(){
    	parent::__construct();		
		$this->load->model('Comments_model');
		$this->load->library('app');
    }	
	
	public function guardarComentario(){
		$data = $this->input->post();
		$res = $this->filtrar($data['comentario']);			
		if(!$res)
			return array('comentario'=>'El texto no puede contener insultos o palabras altisonantes');			
			
		$res = $this->Comments_model->guardarComentario($data);		
		echo json_encode($res);		
	}
	
	 function filtrar($txt){//Funcion detectadora de insultos	 
			$ins = array(
				'cabron',
				'pinche',
				'pendejo',
				'guei',
				'buey',
				'wey',
				'buei',
				'puto',
				'puta',
				'idiota',
				'imbecil',
				'culo',
				'teta',
				'verga',
				'pito',
				'chingado',
				'coger',
				'cojer',
				'nalgas'
				);
			$i = TRUE;
			foreach ($ins as $insulto){		 
				if(preg_match("/$insulto/i",$txt))
					$i = FALSE;
			}
			return $i;
		}
}