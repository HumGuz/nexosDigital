<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!session_id())
session_start();
class Newsletter extends CI_Controller {
	public function __construct(){		
		// ini_set('display_errors', '1');		
		// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    	parent::__construct();
		$this->load->library('Mailer_class');
		$this->load->model('Newsletter_model');
		$this->load->model('Comments_model');
		
    }
	function signup(){		
		$data = $this->input->post();
		$result = $this->Newsletter_model->signup($data);
		echo json_encode($result);				
	}

	public function guardarComentario(){
		$data = $this->input->post();
		$resc =  app::filtrar($data['comentario']);			
		if(!$resc){
			echo json_encode(array('comentario'=>'El texto no puede contener insultos o palabras altisonantes'));	
			die();
		}			
		// if($data['newsletter']==1){
			// $res = $this->signup(array('nombre'=>$data['nombre'],'mail'=>$data['mail']));
			// return $res;
		// } 			
		$res = $this->Comments_model->guardarComentario($data);	
		echo json_encode($res);		
	}

}




