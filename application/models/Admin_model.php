<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
	function __construct(){
        parent::__construct(); 
    } 		
	function login($data){
		$res = $this->db->query("select * from t_admin where mail = '".trim($data['email'])."' ");		
		$res = $res->result_array();		
		if(empty($res[0]))
			return array('email'=>"El email capturado no existe");
		else{
			$res = $this->db->query("select * from t_admin where mail = '".trim($data['email'])."' and pass = '".trim( md5($data['key']) )."' ");		
			$res = $res->result_array();		
			if(empty($res[0]))
				return array('key'=>"La contraseña no es correcta");
			else 
				return $res[0];
		}
		
	}
}