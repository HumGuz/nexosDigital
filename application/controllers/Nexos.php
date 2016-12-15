<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nexos extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');
		 error_reporting(0); 
   		$old_error_handler = set_error_handler("userErrorHandler");
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


	

   function userErrorHandler ($errno, $errmsg, $filename, $linenum,  $vars) 
   {
     $time=date("d M Y H:i:s"); 
     // Get the error type from the error number 
     $errortype = array (1    => "Error",
                         2    => "Warning",
                         4    => "Parsing Error",
                         8    => "Notice",
                         16   => "Core Error",
                         32   => "Core Warning",
                         64   => "Compile Error",
                         128  => "Compile Warning",
                         256  => "User Error",
                         512  => "User Warning",
                         1024 => "User Notice");
      $errlevel=$errortype[$errno];

      //Write error to log file (CSV format) 
      $errfile=fopen("errors.csv","a"); 
      fputs($errfile,"\"$time\",\"$filename: 
      $linenum\",\"($errlevel) $errmsg\"\r\n"); 
      fclose($errfile);

      if($errno!=2 && $errno!=8) {
         //Terminate script if fatal error
         die("A fatal error has occurred. Script execution has been aborted");
      } 
   }



}
