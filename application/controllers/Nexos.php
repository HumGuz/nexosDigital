<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nexos extends CI_Controller {
	function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');		
    }	
	function index($article='',$id=''){
		if(($article=='' && $id=='') || ($article!='' && $id=='')){
			$this->load->view('inicio',
						 	array(
								'recent'=>$this->articles_model->getRecent(($article!='')?array('id_categoria'=>$article):array()),
								'popular'=>$this->articles_model->getPopular(),
								'editorsPick'=>$this->articles_model->getEditorsPick(),
								'categorias'=>$this->articles_model->getCategorias()
						 	)
						 );
		}else{
					$this->load->model('comments_model');
					$this->load->view('article',
						 	array(
								'article'=>$this->articles_model->getArticle(array('id_articulo'=>$id)),
								'popular'=>$this->articles_model->getPopular(),
								'features'=>$this->articles_model->getfeatures(),
								'comments'=>$this->comments_model->getComments(),
								'editorsPick'=>$this->articles_model->getEditorsPick(),
								'categorias'=>$this->articles_model->getCategorias()
						 	)
						 );
			
			
		}			
	}
	
}
