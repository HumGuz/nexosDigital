<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Newsletter_model extends CI_Model {
	function __construct(){
        parent::__construct(); 
		date_default_timezone_set('America/Mexico_City');	
    } 		
	function signup($data){
		$res = $this->db->query("select * from t_newsletter_subscribers where mail = '".trim($data['mail'])."' ");		
		$res = $res->result_array();		
		if(!empty($res)){
			return array('mail'=>"El Email capturado ya esta subscrito");
			die();
		}else{
			  unset($data['request']);	
			  $data['fecha'] = date('Y-m-d H:i:s');
			  $this->db->insert('t_newsletter_subscribers', $data);
		}
		return array('status'=>1,'res'=>$res);
	}
	
	function confirm($code){
		$this->db->query("update t_newsletter_subscribers set status = 1,confirm_date = now() where confirm_code = '".trim($code)."' ");		
	}
	
	
	function getSubscriptores($data){
		$res = $this->db->query("select * from t_newsletter_subscribers ");		
		$res = $res->result_array();
		return $res;
	}
	
	
}