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
}
