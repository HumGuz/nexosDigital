<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class App {   
	public static function dateFormat($date,$op=0){
		if(date('Y-m-d',strtotime($date)) == '1969-12-31' ||  $date =='')    
                return "";			
			$dias =  array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado');
			$dias_short =  array('Dom','Lun','Mar','Mié','Jue','Vie','Sab');
			$meses_short = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
			$dia = date("d", strtotime($date));
			$mes = $meses_short[intval(date("m", strtotime($date)))];
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
