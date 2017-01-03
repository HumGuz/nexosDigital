<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Not_found_404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
		$this -> load -> model('articles_model');
    } 

    public function index() 
    { 
        $this->output->set_status_header('404');       
        $this->load->view('404.php',array( 'categorias' => $this -> articles_model -> getCategorias()));
				
    } 
} 
?> 