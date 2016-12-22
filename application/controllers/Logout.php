<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Logout extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		session_destroy();	
    }
	public function index(){
	   	redirect("nexos", 'refresh');
	}
}
