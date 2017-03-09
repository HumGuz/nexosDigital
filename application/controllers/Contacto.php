<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
date_default_timezone_set('America/Mexico_City');	
class Contacto extends CI_Controller {
	function __construct(){
    	parent::__construct();	
		$this->load->library('app');	
		$this->load->model('Newsletter_model');
		$this->load->model('Comments_model');
    }	
	function index(){
		$this->load->view('contacto');	
	}
	function guardarComentarios(){
		$data = $this->input->post();		
		$resc =  app::filtrar($data['comentario']);			
		if(!$resc){
			echo json_encode(array('comentario'=>'El texto no puede contener insultos o palabras altisonantes'));	
			die();
		}	
		$resc = app::filtrar($data['asunto']);			
		if(!$resc){
			echo json_encode(array('asunto'=>'El texto no puede contener insultos o palabras altisonantes'));	
			die();
		}		
		// if($data['newsletter']==1){
			// $res = $this->Newsletter_model->signup(array('nombre'=>$data['nombre'],'mail'=>$data['mail']));
			// return $res;
		// } 	
		$res = $this->Comments_model->guardarComentarios($data);	
		echo json_encode($res);		
	}
}
