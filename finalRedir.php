<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sid=$_GET['sid'];
$prj=$_GET['prj'];
$iid=$_GET['iid'];
$uid=$_GET['user_id'];

$numeroCaratteri=strlen($iid);
$nomeFile="";
if ($numeroCaratteri==1){$nomeFile="res000".$iid;}
if ($numeroCaratteri==2){$nomeFile="res00".$iid;}
if ($numeroCaratteri==3){$nomeFile="res0".$iid;}
if ($numeroCaratteri>=4){$nomeFile="res".$iid;}


//echo "Nome:".$nomeFile."<br>";

$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/'.$nomeFile.'.sre');

$fileTrovato = file($fl[0]);
$prima_riga=$fileTrovato[0]; 



//echo $prima_riga;

$variabili = explode(";", $prima_riga);

$count=0;
$salvaindiceCella=0;
$salvaindicePanel=0;

//Il paese lo passiamo solo a SrLabs
$salvaindicePaese=0;

//CERCO NELLA PRIMA RIGA IL PARAMETRO DELLA CELLA E QUANDO LO TROVO SALVO L'INDICE
foreach ($variabili as $value) {
    //echo $value."<br>";
    if (strpos($value, 'leg=') !== false) {
        $salvaindiceCella=$count;
    }
    if (strpos($value, 'pan=') !== false) {
        $salvaindicePanel=$count;
    }
    $count++;
 }



//LINK RITORNO NOSTRO
//AGGIUNGO CELLA
$linkReturn="http://www.primisoft.com/primis/run.do?sid=R2101010&prj=STR&uid=".$uid."&".$variabili[$salvaindiceCella];


//AGGIUNGO PANEL
$linkReturn=$linkReturn."&".$variabili[$salvaindicePanel];

$linkSrLabs="";
//CREO LINK DI SRLABS
if ($variabili[$salvaindiceCella]=="leg=1") {$linkSrLabs="https://surveys.beyondreason.eu/s/89640681?uid=".$uid;}
if ($variabili[$salvaindiceCella]=="leg=2") {$linkSrLabs="https://surveys.beyondreason.eu/s/89652681?uid=".$uid;}
if ($variabili[$salvaindiceCella]=="leg=3") {$linkSrLabs="https://surveys.beyondreason.eu/s/89664681?uid=".$uid;}
if ($variabili[$salvaindiceCella]=="leg=4") {$linkSrLabs="https://surveys.beyondreason.eu/s/89676681?uid=".$uid;}
if ($variabili[$salvaindiceCella]=="leg=5") {$linkSrLabs="https://surveys.beyondreason.eu/s/89688681?uid=".$uid;}




 
header("location: ".$linkSrLabs);
//echo $linkSrLabs;

?>