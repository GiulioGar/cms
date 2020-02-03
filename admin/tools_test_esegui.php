





<?php 







$sid = $_REQUEST['sid'];
$nrtest=$_REQUEST['nl'];
$prj = $_REQUEST['prj'];
$inizio=$_REQUEST['inizio'];



//Tutto maiuscolo//
$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);


	//recupero tutti i file sre dalla cartella e li conto
	$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
	$contatti=count($fl);
	
	
	
	
	
	if (!empty($inizio))
	{
	echo "<script type='text/javascript'>var stile = \"top=10, left=30000, width=250, height=200, status=no, menubar=no, toolbar=no scrollbars=no\"; var mia=window.open('http://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=GUEST&test=1&rst=1&miosid=".$sid."&mioprj=".$prj."&nl=".$nl."', \"\", stile); mia.moveTo(2500, 2100);     </script>";
	//echo "<script type='text/javascript'>window.open('http://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=GUEST&test=1&rst=1&miosid=".$sid."&mioprj=".$prj."&nl=".$nl."','_blank', 'toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=10000, top=10000, width=10, height=10, visible=none', '');</script>";
	touch('res/file-da-creare.txt');
	$fr = fopen("res/file-da-creare.txt", 'w');
	fwrite($fr, $contatti);
	fclose($fr);
	}
	else
	{
	$fr = fopen("res/file-da-creare.txt", 'r');
	// memorizzo in una variabile la lunghezza del file
	$bytes = filesize('res/file-da-creare.txt');
	// leggo il file per l'intera lunghezza
	$leggi=fread($fr, $bytes);
	fclose($fr);	
	
	$fatti=$contatti-$leggi;
	
	
	
	$percentuale=($fatti/$nrtest)*100;
	
	echo '<div class="progress progress-striped active"><div class="progress-bar progress-bar-success" style="width: '.$percentuale.'%;"></div></div>';
	if ($fatti<=$nrtest) {echo '<span style=font-size:50px;color:green;> '.$fatti.' di '.$nrtest.' completati</span>';}
	if ($fatti>$nrtest) {echo '<span style=font-size:50px;color:green;>TEST COMPLETATI CON SUCCESSO!!!</span>';}
	
	if ($fatti>$nrtest) {echo "<script type='text/javascript'>mia.close(); </script>";}
	}
	
	
	
	
	
	
?>

	
	 








	
