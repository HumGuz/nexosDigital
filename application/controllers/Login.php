<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('articles_model');   
		$this->load->model('admin_model');		
    }
	public function login(){		
		if($this->input->is_ajax_request() && $this->input->post('request') =='login'){  			
			$data = $this->input->post();
			unset($data['request']);
			unset($data['trim']);			
            $result = $this->admin_model->login($data);
			if($result['status']==1){				
				$this->session->set_userdata('admin', $result); 
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode($result);
			}
        }
	}
	
}
