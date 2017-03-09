<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nosotros extends CI_Controller {
	function __construct(){
    	parent::__construct();
		$this->load->library('app');			
    }	
	function index(){
		$this->load->view('nosotros');	
	}
}
