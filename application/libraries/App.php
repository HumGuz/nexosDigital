<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class App {
// 	
	// public static function titleToURL($title){
		// $title = utf8_decode(trim($title));
		// $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		// $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		// $title = str_replace($no_permitidas, $permitidas ,$title);
// 		
		// $larCharsNoAble = array("¡","¢","£","¤","¥","§","¨","©","ª","«","¬","®","¯","°","±","´","µ","¶","·","¸","º","»","¿","À","Á","Â","Ã","Ä","Å","Æ","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ñ","Ò","Ó","Ô","Õ","Ö","Ø","Ù","Ú","Û","Ü","ß","à","á","â","ã","ä","å","æ","ç","è","é","ê","ë","ì","í","î","ï","ñ","ò","ó","ô","õ","ö","÷","ø","ù","ú","û","ü","ÿ","—",'”', "/");
		// $larCharsAble = array("","","","","","","","","","","","","","","","","","","","","","","","A","A","A","A","A","A","A","C","E","E","E","E","I","I","I","I","N","O","O","O","O","O","O","U","U","U","U","B","a","a","a","a","a","a","a","c","e","e","e","e","i","i","i","i","n","o","o","o","o","o","","o","u","u","u","u","y","—",'', "");
		// $title = str_replace($larCharsNoAble, $larCharsAble ,$title);
// 		
// 		
// 		
		// $title = str_replace(array(' ','  ','   ','	'), "-", $title);
// 		
		// return $texto;
	// }
	
	public static function poner_guion($url){
		 $url = strtolower($url);
		 //Reemplazamos caracteres especiales latinos
		 $find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç','ñ');
		 $repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c','n');
		 $url = str_replace($find, $repl, $url);
		 //Añadimos los guiones
		 $find = array(' ', '&amp;', '\r\n', '\n','+');
		 $url = str_replace($find, '-', $url);
		 //Eliminamos y Reemplazamos los demas caracteres especiales
		 $find = array('/[^a-z0-9\-&lt;&gt;]/', '/[\-]+/', '/&lt;{^&gt;*&gt;/');
		 $repl = array('', '-', '');
		 $url = preg_replace($find, $repl, $url);
		 return $url;
	}
	
	
	   
	public static function dateFormat($date,$op=0){
		if(date('Y-m-d',strtotime($date)) == '1969-12-31' ||  $date =='')    
                return "";			
			$dias =  array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado');
			$dias_short =  array('Dom','Lun','Mar','Mié','Jue','Vie','Sab');
			$meses_short = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
			$meses_Long = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$dia = date("d", strtotime($date));
			$mes = $meses_short[intval(date("m", strtotime($date)))];
			$mesL = $meses_Long[intval(date("m", strtotime($date)))];
			$ano = date("Y", strtotime($date));
			if($op==0)
				return $dia.' '.$mes.' '.$ano;			
			if($op==1)
				return $dia.' '.$mes;			
			if($op==2)
				return $dia.' '.$mes.' '.$ano.' '.date('H:i',strtotime($date));						
			if($op==3)
				return $dia.' '.$mes.' '.date('H:i',strtotime($date));
			if($op==4)
				return $dia.' '.$mes.' '.date('y',strtotime($date));
			if($op==5)
				return $dia.' de '.$mesL.' del '.$ano;
	}	
	
	public static function fulldatediff($datefrom, $dateto,$op=0){
        $return="";     
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
        $timestamp = $dateto - $datefrom;
        $monts= floor($timestamp / 2678400);
        if($monts>0){            
            $timestamp-=$monts*2678400;
            $return.=$monts." meses ";
        }        
        # Obtenemos el numero de dias
        $days=floor((($timestamp/60)/60)/24);
        if($days>0){
            $timestamp-=$days*24*60*60;
            $return.=$days." días ";
        }        
        if($op==0){
            # Obtenemos el numero de horas
            $hours=floor(($timestamp/60)/60);
            if($hours>0){
                $timestamp-=$hours*60*60;
                $return.=str_pad($hours, 2, "0", STR_PAD_LEFT)." hrs ";
            }
            // $minutes=floor($timestamp/60);
            // if($minutes>0){
                // $timestamp-=$minutes*60;
                // $return.=str_pad($minutes, 2, "0", STR_PAD_LEFT)." min ";
            // }
        }
        return $return;
    }
	
	
}
?> 
