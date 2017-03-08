<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mailer_class {
    public function __construct() {
        require_once('C:/xampp/htdocs/nexosDigital/application/third_party/PHPMailer/class.phpmailer.php');
		require_once('C:/xampp/htdocs/nexosDigital/application/third_party/PHPMailer/class.smtp.php');
    }
}