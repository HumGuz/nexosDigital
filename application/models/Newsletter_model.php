<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Newsletter_model extends CI_Model {
	function __construct(){
        parent::__construct(); 
		date_default_timezone_set('America/Mexico_City');	
    } 		
	function signupRegister($data){
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
	
	
	function signup($data){						
			$data['confirm_code'] = $this->getCode();	
			$result = $this->signupRegister($data);	
			if($result['status']==1){				
				$_SESSION['register_mail'] = $data['mail'];				
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "tsl";
			  	$mail->Host = "smtp.1and1.es";
				$mail->Port = 25;
				$mail->Username = "newsletter@nexosdigital.mx";
				$mail->Password = "test123test";
				$mail->From = "newsletter@nexosdigital.mx";
				$mail->FromName = "NexosDigital";
				$mail->AddAddress($data['mail'],$data['nombre']);
				$mail->IsHTML(true);
				$mail->SMTPDebug = 0;
				$mail->Subject = "Confirmación de subscripción";
				$body = '<div>
								<table cellspacing="0" cellpadding="0" border="0" style="color:#333; background:#fff; padding:0; margin:0; width:100%; font:15px \'Helvetica Neue\',Arial,Helvetica">
									<tbody>
										<tr width="100%">
											<td valign="top" align="left" style="background:#f0f0f0; font:15px \'Helvetica Neue\',Arial,Helvetica">
											<table style="border:none; padding:0 18px; margin:50px auto; width:500px">
												<tbody>
													<tr width="100%">
														<td valign="top" align="left" style="border-top-left-radius:4px; border-top-right-radius:4px; background:#fff; padding:0px; text-align:center"><img src="http://nexosdigital.mx/application/views/images/a2.jpeg" width="230" title="NexosDigital" style="font-weight:bold; font-size:18px; color:#fff; vertical-align:top"></td>
													</tr>
													<tr width="100%">
														<td valign="top" align="left" style="border-bottom-left-radius:4px; border-bottom-right-radius:4px; background:#fff; padding:18px"><h1 style="font-size:20px; margin:0; color:#333">Hola '.($this->replace($data['nombre'])).': </h1>
														<p style="font:15px/1.25em \'Helvetica Neue\',Arial,Helvetica; color:#333">
															Ya puedes recibir las ultimas publicaciones de Nexos digital en tu correo. Lo &uacute;nico que nos falta es confirmar que esta es su direcci&oacute;n de correo electr&oacute;nico.
														</p>
														<p style="font:15px/1.25em \'Helvetica Neue\',Arial,Helvetica; color:#333">
															<a href="'.base_url().'Confirmation?confirmation_code='.$data['confirm_code'].'" target="_blank" style="border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; background:#3AA54C; color:#fff; display:block; font-weight:700; font-size:16px; line-height:1.25em; margin:24px auto 24px; padding:10px 18px; text-decoration:none; width:180px; text-align:center">Verificar direcci&oacute;n </a>
														</p>
														<p style="font:15px/1.25em \'Helvetica Neue\',Arial,Helvetica; color:#939393; margin-bottom:0">
															Si no has solicitado la subscripcion, elimina este correo electr&oacute;nico y todo volver&aacute; a ser como antes.
														</p></td>
													</tr>
												</tbody>
											</table></td>
										</tr>
									</tbody>
								</table>
							</div>';
				$mail->MsgHTML($body);	
				if(!$mail->Send()){	
					$result = array('error'=>$mail->ErrorInfo);
				}else{
					$result = array('status'=>1);
				}
			}				
			return $result;	
	}
	
	function getCode($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
	}

	function replace($str){
		return str_replace(array('á','é','í','ó','ú','Á','É','Í','Ó','Ú'), array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;'), $str);
	}


	  function deleteSubscriptor($data){ 
    		return $this->db->delete('t_newsletter_subscribers', $data);
	  }
}