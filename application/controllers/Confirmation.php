<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Confirmation extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		if(!$this->input->get('confirmation_code')){
	        redirect('nexos', 'refresh');
	    }
    	$this->load->model('Newsletter_model');
		$this -> load -> model('articles_model');
		
		
    }	
	
	function index(){
		$confirm_code = $this->input->get('confirmation_code');
		$result = $this->Newsletter_model->confirm($confirm_code);			
		$this->load->view('confirmation',array( 'categorias' => $this -> articles_model -> getCategorias()));
	}
	
		
}
