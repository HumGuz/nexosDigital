<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		if(!$this->session->userdata('admin')){
	        redirect('nexos', 'refresh');
	    }
    	$this->load->model('articles_model');				
    }	
	function dashboard(){
		$this->load->view('admin/dashboard' );
	}
	
	function articles(){
		$this->load->view('admin/articles',array('articulos'=>$this->articles_model->listArticles(),'categorias'=>$this->articles_model->getCategorias()) );
	}
	
	
	
	
	
	
}
