<?php

date_default_timezone_set('Europe/Rome');

function isEmail($string)
					{	
	/* Confronta la stringa con il pattern RegEx */
	if(!eregi("[a-zA-Z0-9]+(\.?[a-zA-Z0-9\-\_]+)*\@[a-zA-Z]+(\.?[a-zA-Z0-9\-\_]+)*\.[a-zA-Z]{2,}$",$string))
	return false;

	/* Divide l'indirizzo in due parti: "local part" e "domain name" */
	$parts = explode("@",$string);

	/* Controlla se "local part" supera i 64 caratteri */
	if(strlen($parts[0])>64) return false;

	/* Controlla se "local part" supera i 255 caratteri */
	if(strlen($parts[1])>255) return false;

	return true;
}

function ControlloData($data){	
	if(!ereg("^[0-9]{2}/[0-9]{2}/[0-9]{4}$", $data)){		
	return false;	
	}else{		
	$arrayData = explode("/", $data);		
	$Giorno = $arrayData[0];		
	$Mese = $arrayData[1];		
	$Anno = $arrayData[2];		
	if(!checkdate($Mese, $Giorno, $Anno)){			
	return false;		
	}else{			
	return true;		
	}	
	}}

function convert_time($indate){     
list($giorno, $mese, $anno) = explode('/', $indate);     
//$timestamp = mktime(0,0,0,$mese,$giorno,$anno);
$timestamp = $anno."-".$mese."-".$giorno;
return $timestamp; }

function read_time($indate){     
list($anno, $mese, $giornoM) = explode('-', $indate);
$ora=$ora-6;
if (strstr ($giornoM, ' ')) {list($giorno, $ora) = explode(' ', $giornoM);} else {$giorno = $giornoM; $ora = "";}
//$timestamp = mktime(0,0,0,$mese,$giorno,$anno);
$timestamp = $giorno."/".$mese."/".$anno." ".$ora;
return $timestamp; }

function fissaTesto($text){
	$text = trim($text);
	$caratteri = array(chr(149),chr(133),chr(96),chr (145),chr(146),chr(147),chr(148),chr(150),"\n"); 
	$cambio = array(chr(42),"...",chr(39),chr(39),chr(39),chr(34), chr(34),chr(45),"<br />");
	$text = str_replace( $caratteri, $cambio, $text); 
	return $text;
}
function age($birth_date){
list($annon,$mesen,$giornon)=explode('-',$birth_date); 
list($annoo,$meseo,$giornoo)=explode('-',date("Y-n-j")); 
$result=$annoo-$annon; 
if($mesen>$meseo or ($mesen==$meseo and $giornon>$giornoo)) 
    $result-=1; 
	return $result;
}
function date_from_age($years){
list($anno,$mese,$giorno)=explode('-',date("Y-n-j")); 
$anno = $anno-$years; 
$result = $anno."-".$mese."-".$giorno; 
return $result;
}

?>
<?php require_once('inc_func_array.php'); ?>
<?php require_once('inc_func_appearence.php'); ?>

