<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Articles extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');
		$this->load->model('comments_model');
		$this->load->library('app');
    }	
	public function index($article='',$id=''){		
		if($article!='' && $id!=''){
					$this->load->model('comments_model');
					$this->load->view('article',
						 	array(
								'article'=>$this->articles_model->getArticle($id),
								'popular'=>$this->articles_model->getPopular(),
								'features'=>$this->articles_model->getfeatures(),
								'comments'=>$this->comments_model->getComments(),
								'editorsPick'=>$this->articles_model->getEditorsPick()
						 	)
						 );
		}				
	}	
	public function getArticle(){
		$data = $this->input->post();
		$data['admin'] = 1;
		$res = $this->articles_model->getArticle($data);
		// print_r($data);
		echo $res['article'];
	}
	public function updateOption(){
		$data = $this->input->post();
		$res = $this->articles_model->updateOption($data);
		echo json_encode($res);
	}
	public function guardarArticulo(){
		$data = $this->input->post();	
		$data = app::upload($data,$_FILES);
		if($data['status']==1){			
			$us = $this->session->userdata('admin'); 	
			$data['user'] = $us['id_admin'];			
			$res = $this->articles_model->guardarArticulo($data);
			echo json_encode($res);
		}else 
			echo json_encode($data);
	}
	
	 function deleteArticulo(){	  	
	  		$data = $this->input->post();
			unset($data['request']);
			$result = $this->articles_model->deleteArticulo($data);
			echo json_encode(array('status'=>1));		
	 }
	 
	 public function getArticulo(){
		$data = $this->input->post();		
		$res = $this->articles_model->getArticulo($data);
		echo json_encode($res);
	}
	 
	 // categorias 
	 public function guardarCategoria(){
		$data = $this->input->post();	
		$data['fecha'] = date('Y-m-d H:i:s');
		$data['status'] = 1;
		$res = $this->articles_model->guardarCategoria($data);
		echo json_encode($res);
	}
	
	
	 public function getCategoria(){
		$data = $this->input->post();		
		$res = $this->articles_model->getCategorias($data);
		echo json_encode($res[0]);
	}
	
	
	function deleteCategoria(){	  	
	  		$data = $this->input->post();
			unset($data['request']);
			$result = $this->articles_model->deleteCategoria($data);
			echo json_encode(array('status'=>1));		
	}
	 
}