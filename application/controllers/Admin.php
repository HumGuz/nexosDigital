<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		if(!$this->session->userdata('admin')){
	        redirect('nexos', 'refresh');
	    } 
    			
    }	
	function index(){
		$this->load->view('admin/dashboard' );
	}
}
