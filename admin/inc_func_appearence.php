<?php

function reqColor($status){
	switch ($status) {
	case "ricevuta":
	$color = "BEF781";
	break;

	case "aperta":
	$color = "A9E2F3";
	break;
	
	case "verifica":
	$color = "F2F5A9";
	break;
	
	case "in lavorazione":
	$color = "FE2E2E";
	break;}
	return @$color;
	
}

function reqTikColor($status){
	switch ($status) {
	case 1:
	$color = "BEF781";
	break;

	case 0:
	$color = "A9E2F3";
	break;
	
	case 2:
	$color = "F2F5A9";
	break;
	
	case 3:
	$color = "FACC2E";
	break;
	
	
	break;}
	return @$color;
	
}

function reqTikView($status){
	switch ($status) {
	case 1:
	$view="Valido";
	break;

	case 0:
	$view="Invalidato";
	break;
	
	case 2:
	$view="Perdente";
	break;
	
	case 3:
	$view="Vincente";
	break;
	
	
	break;}
	return @$view;
	
}



function prizeColor($status){
	switch ($status) {
	case "ricevuta":
	case "accreditato":
	case "spedito":
	$color = "BEF781";
	break;

	case "aperta":
	case "esaurito":
	$color = "A9E2F3";
	break;
	
	case "verifica":
	case "annullata":
	$color = "F2F5A9";
	break;
	
	case "in lavorazione":
	case "respinta":
	$color = "FE2E2E";
	break;}
	return $color;
	
}
?>