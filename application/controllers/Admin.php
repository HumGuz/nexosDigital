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
		$this->load->model('Newsletter_model');		
		$this->load->model('Comments_model');		
    }	
	function dashboard(){
		$this->load->view('admin/dashboard' );
	}	
	function articles(){
		$this->load->view('admin/articles',array('categorias'=>$this->articles_model->getCategorias()) );
	}	
	function categorias(){
		$this->load->view('admin/categorias',array('categorias'=>$this->articles_model->getCategorias()) );
	}	
	function subscriptores(){
		$this->load->view('admin/subscriptores',array('subscriptores'=>$this->Newsletter_model->getSubscriptores()) );
	}
	function mensajes(){
		$this->load->view('admin/mensajes',array('mensajes'=>$this->Comments_model->getMensajes()) );
	}
	
	
}
