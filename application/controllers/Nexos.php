<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nexos extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($article='',$id=''){
		
		 echo "<pre>";	
		ini_set('display_errors', '1');		
		error_reporting(E_ALL ^ E_NOTICE);
		
		
		if($article=='' && $id==''){
			$this->load->view('inicio',
						 	array(
								'recent'=>$this->articles_model->getRecent(),
								'popular'=>$this->articles_model->getPopular(),
								'editorsPick'=>$this->articles_model->getEditorsPick()
						 	)
						 );
		}else{
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
