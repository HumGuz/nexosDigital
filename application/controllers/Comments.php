<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Comments extends CI_Controller {
	public function __construct(){
    	parent::__construct();		
		$this->load->model('Comments_model');
		$this->load->library('app');
    }
}