<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');
		$this->load->model('comments_model');
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

}
