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
		
		error_reporting(0); 
        $old_error_handler = set_error_handler(&amp;quot;userErrorHandler&amp;quot;); 
		
		
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
	
	
	

     function userErrorHandler ($errno, $errmsg, $filename, $linenum, $vars) 
     { 
       $time=date(&amp;quot;d M Y H:i:s&amp;quot;);
       // Get the error type from the error number 
       $errortype = array (1 =&gt; &amp;quot;Error&amp;quot;, 
                           2 =&gt; &amp;quot;Warning&amp;quot;, 
                           4 =&gt; &amp;quot;Parsing Error&amp;quot;, 
                           8 =&gt; &amp;quot;Notice&amp;quot;, 
                           16 =&gt; &amp;quot;Core Error&amp;quot;, 
                           32 =&gt; &amp;quot;Core Warning&amp;quot;, 
                           64 =&gt; &amp;quot;Compile Error&amp;quot;, 
                           128 =&gt; &amp;quot;Compile Warning&amp;quot;, 
                           256 =&gt; &amp;quot;User Error&amp;quot;, 
                           512 =&gt; &amp;quot;User Warning&amp;quot;, 
                           1024 =&gt; &amp;quot;User Notice&amp;quot;); 
       $errlevel=$errortype[$errno]; 

       //Write error to log file (CSV format) 
       $errfile=fopen(&amp;quot;errors.csv&amp;quot;,&amp;quot;a&amp;quot;); 
       fputs($errfile,&amp;quot;&amp;quot;$time&amp;quot;,&amp;quot;$filename: 
       $linenum&amp;quot;,&amp;quot;($errlevel) $errmsg&amp;quot;rn&amp;quot;);
       fclose($errfile); 

       if($errno!=2 &amp;amp;&amp;amp; $errno!=8) {
          //Terminate script if fatal error 
          die(&amp;quot;A fatal error has occurred. Script execution has been aborted&amp;quot;); 
       } 
     }
	
}
