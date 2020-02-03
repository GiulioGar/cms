<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi3=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-3,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$conta_giorno=0;
$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");


//recupero tutti i file sre dalla cartella e li conto
$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
$contatti=count($fl);

$conta_incomplete=0;
$conta_complete=0;
$conta_filtrati=0;
$conta_quotafull=0;
$conta_incomplete_ssi=0;
$conta_complete_ssi=0;
$conta_filtrati_ssi=0;
$conta_quotafull_ssi=0;
$conta_incomplete_panel=0;
$conta_complete_panel=0;
$conta_filtrati_panel=0;
$conta_quotafull_panel=0;
$contaSospeso=0;
$contaFiltri=0;
$contaCompl=0;


for ($i = 0; $i < $contatti; $i++) 
{  

//apro il file e leggo la prima riga 
//$riga = file("ftp://primis:Imr_PrimiFields13@46.37.21.33".$contents[$i]);
//echo $fl[$i];
$riga = file($fl[$i]);
$prima_riga=$riga[0]; 
$ultima_calc=sizeof($riga) - 1 ; 
$ultima_riga=$riga[$ultima_calc]; 
//echo $contents[$i]."<br>";


//divido il testo in array stabilendo come separatore il punto e virgola
$elementi = explode(";", $prima_riga);
$elementi_ultima = explode(";",$ultima_riga);
//controllo status ricerca
$statSur=$elementi[6];
$leggi_id=$elementi[3];

//CALCOLO LOI
if ($statSur==3)
	{
	$contaCompl++;
	$startSur=substr($elementi[4],11,-4);
	$endSur=substr($elementi[5],11,-4);
	$differenza= date_diff(date_create($endSur),date_create($startSur));  
	$saveDiff=$differenza->format('%i');
	$sumDiff=$sumDiff+$saveDiff;
	
	echo "<table align='center' border='1px'>";
	echo "<tr><td>".$leggi_id."</td><td>".$saveDiff."</td></tr>";
	}
	
	
}	




