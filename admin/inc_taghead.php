<!DOCTYPE html> 

<head>


<?php


// Disabilita la visualizzazione degli errori non fatali
ini_set('display_errors', 0);

// Abilita la visualizzazione degli errori durante l'avvio (utile per il debug)
ini_set('display_startup_errors', 1);

// Imposta il livello di error_reporting per visualizzare solo errori fatali
error_reporting(E_ERROR);

// Registra una funzione di gestione degli errori personalizzata per gestire solo errori fatali
function handleFatalError() {
    $error = error_get_last();
    if ($error !== null) {
        // Controlla se l'errore è di tipo E_ERROR (errore fatale)
        if ($error['type'] === E_ERROR) {
            echo "Fatal error: {$error['message']} in {$error['file']} on line {$error['line']}";
        }
    }
}

// Registra la funzione di gestione degli errori per eseguire alla fine dello script
register_shutdown_function('handleFatalError');

// Ulteriore codice PHP
 

header("Cache-Control: no-cache, must-revalidate");

?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
	
	    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
		
  <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
  <!-- DATA TABLES  -->
   
 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />		

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    
  
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/all.css" rel="stylesheet" />

<title><?php echo $titolo ?></title>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />-->
<script type="text/javascript">

function confermaCancella() {
  return confirm("ATTENZIONE!!! \n Cancellando questo elemento potresti alterare le statistiche correlate");
}
 
</script>
<script type="text/javascript">

function confermaAzione() {
  return confirm("ATTENZIONE!!! \n Procedere con l'azione richiesta?");
}
 
</script>
<script type="text/javascript" language="JavaScript"> 
function campirichiesti(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("ATTENZIONE!!! \n COMPILARE TUTTI I CAMPI")
return false
}
else
return true
}
 
//-->
</script>



<?php



$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";

//funzione data
     
    function delta_tempo ($data_iniziale,$data_finale,$unita) {
     
    $data1 = strtotime($data_iniziale);
    $data2 = strtotime($data_finale);
     
    switch($unita) {
    case "m": $unita = 1/60; break; //MINUTI
    case "h": $unita = 1; break;	//ORE
    case "g": $unita = 24; break;	//GIORNI
    case "a": $unita = 8760; break; //ANNI
    }
     
    $differenza = (($data2-$data1)/3600)/$unita;
    return floor($differenza);
    }
	
?>	


<!--[if lte IE 6.0]>
<style type="text/css">
#container {width: 1072px;}
#bigbox_right{margin-right: 5px;}
#bigbox_left{margin-left: 5px;}
#bigbox{background-color: #ffffff;}
#bigbox_top_left{background-image: none;}
#bigbox_down_left{background-image: none;}
#bigbox_top_right{background-image: none;}
#bigbox_down_right{background-image: none;}
#main{ margin-right:5px;} 

</style>

<![endif]-->	

</head>
<?php
require_once('inc_auth.php'); 