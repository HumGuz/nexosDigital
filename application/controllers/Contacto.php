<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
date_default_timezone_set('America/Mexico_City');	
class Contacto extends CI_Controller {
	function __construct(){
    	parent::__construct();	
		$this->load->library('app');	
    }	
	function index(){
		$this->load->view('contacto');	
	}
}
