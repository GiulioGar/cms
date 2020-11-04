<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
	  
$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
@$var_pagato = $_REQUEST['var_pagato'];  
@$code = $_REQUEST['code']; 
$id_utente = $_REQUEST['id_utente']; 
$importo=$_REQUEST['importo'];
$email=$_REQUEST['email'];
@$azione = $_REQUEST['azione'];
@$verifica = $_REQUEST['Verifica'];
@$cifra2 = $_REQUEST['cifra2'];
@$cifra5 = $_REQUEST['cifra5'];
@$cifra9 = $_REQUEST['cifra9'];
@$cifra10 = $_REQUEST['cifra10'];
@$cifra15 = $_REQUEST['cifra15'];
@$cifra20 = $_REQUEST['cifra20'];
$data=date("Y-m-d");

@$premi2euro=$_REQUEST["pr2euro"];
@$premi5euro=$_REQUEST["pr5euro"];
@$premi10euro=$_REQUEST["pr10euro"];
@$premi20euro=$_REQUEST["pr20euro"];

	if ($premi2euro<>"")
	{
		@$array2euro=explode("\n",$premi2euro);
	}
	
	if ($premi5euro<>"")
	{
		@$array5euro=explode("\n",$premi5euro);
	}
	
	if ($premi10euro<>"")
	{
		@$array10euro=explode("\n",$premi10euro);
	}
	
	if ($premi20euro<>"")
	{
		@$array20euro=explode("\n",$premi20euro);
	}

mysqli_select_db($admin,$database_admin);

	$cerca_progetto=$_REQUEST['typ'];
	if ($cerca_progetto==""){$cerca_progetto="0";}


require_once('inc_taghead.php');
require_once('inc_tagbody.php');

//AGGIUNGO Buoni 2 euro
if($azione=="add2")
{
mysqli_select_db($admin,$database_admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra2' WHERE type='euro2'";
$add_euro = mysqli_query($admin,$query_aggiorna) ;
}

//AGGIUNGO Buoni 5 euro
if($azione=="add5")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra5' WHERE type='euro5'";
$add_euro = mysqli_query($admin,$query_aggiorna) ;
}

//AGGIUNGO Buoni 9 euro
if($azione=="add9")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra9' WHERE type='euro9'";
$add_euro = mysqli_query($admin,$query_aggiorna) ;
}

//AGGIUNGO Buoni 15 euro
if($azione=="add15")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra15' WHERE type='euro15'";
$add_euro = mysqli_query($admin,$query_aggiorna) ;
}


	$query_conta = "SELECT COUNT(user_id) as tot FROM t_history_copia where event_type='withdraw'";
	$surClo = mysqli_query($admin,$query_conta) ;
	$cloSur = mysqli_fetch_assoc($surClo);
	
	$query_conta2 = "SELECT COUNT(user_id) as tot FROM t_user_history where event_type='withdraw'";
	$surClo2 = mysqli_query($admin,$query_conta2) ;
	$cloSur2 = mysqli_fetch_assoc($surClo2);	
	
	//echo $cloSur['tot'].' '.$cloSur2['tot'];
	$cloSurB2=$cloSur2['tot']-1;

if ($cloSur['tot'] !=$cloSurB2)
{
//COPIO HISTORY
$query_copia_history_copy="INSERT t_history_copia (user_id, event_date, event_type, event_info, prev_level, new_level)
SELECT user_id, event_date, event_type, event_info, prev_level, new_level
FROM t_user_history where event_type='withdraw' and user_id NOT IN (SELECT user_id FROM t_history_copia where t_history_copia.event_date=t_user_history.event_date)";
$query_copia_history_copy_sample = mysqli_query($admin,$query_copia_history_copy) ;
$query_copia_history_copy_sample_t = mysqli_fetch_assoc($query_copia_history_copy_sample);
}



$query_cerca = "SELECT * FROM t_history_copia,t_user_info where pagato like '$cerca_progetto' AND t_history_copia.user_id=t_user_info.user_id order by event_date asc";
//$query_cerca = "SELECT * FROM t_user_history where event_type='withdraw' and user_id NOT IN (SELECT user_id FROM t_history_copia where event_type='withdraw')";
$cerca = mysqli_query($admin,$query_cerca);

if($verifica=="verifica")
{

$query_uid = "SELECT id,user_id FROM millebytesdb.t_history_copia where pagato=0;";
$cerca_uid = mysqli_query($admin,$query_uid);

$dataevento=0;

while ($row = mysqli_fetch_assoc($cerca_uid))
	{
		$dataPre=0;

		$query_dupicato = "SELECT * FROM millebytesdb.t_user_history where user_id='".$row['user_id']."' AND event_type='interview_complete'";
		$cerca_duplicato = mysqli_query($admin,$query_dupicato);

		$contaAnomalie=0;

		while ($row2 = mysqli_fetch_assoc($cerca_duplicato))
		{
			$dataPre=$dataevento;
			$dataevento=substr($row2['event_date'],0,strlen($row2['event_date'])-6);

			if($dataPre==$dataevento){ $contaAnomalie++; }
		}	
		
		$query_aggverifica = "UPDATE t_history_copia SET verifica=".$contaAnomalie." WHERE pagato=0 and id='".$row['id']."'";
		$up_verifica = mysqli_query($admin,$query_aggverifica);

	}


}

?>

<div class="content-wrapper">
 <div class="container">



 <div class="row">
 <div class="col-md-9">
 <form role="form" name="modulo_cerca_prj" action="RichiestePremio.php" method="get">

 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button class="btn btn-outline-secondary" type="submit" value="Filtra">Filtra</button>
  </div>
  <select class="form-control" name="typ">
		 <option value="">[PAGATI/NO PAGATI]</option>
		 <option value="0" <?php if ($cerca_progetto=="0") {echo 'selected="selected"';} ?>>NO PAGATO</option>
		 <option value="1" <?php if ($cerca_progetto=="1") {echo 'selected="selected"';} ?>>PAGATO</option>
		
	 </select>
</div>

 </form>

<form  action="RichiestePremio.php" method="post">

<div class="card shadow p-8 mb-8 bg-white rounded">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RICHIESTE PREMIO</h6></span>
	<input class='btn btn-danger'  type='submit'  name='Verifica' value='verifica' />
 </div>
   

 <div class="card-body recent-users-sec">
<table id='table_sur' style="font-size:11px;"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th style="max-width:200px;">Uid</th>
	 <th>Check</th>
	 <th>Premio</th>
	 <th>Pre</th>
	 <th>Post</th>
	 <th>Richiesta</th>
	 <th>Codice</th>
	 <th>Pagamento</th>
	</tr>

</thead>	
<tbody>	
<?php
$pagati=0;
$pagati2=0;
$pagati5=0;
$pagati9=0;
$pagati10=0;
$pagati15=0;
$pagati20=0;

	$contadapagati2euro=0;
	$contadapagati5euro=0;
	$contadapagati10euro=0;
	$contadapagati20euro=0;

$contapagati2euro=0;
$contapagati5euro=0;
$contapagati10euro=0;
$contapagati20euro=0;


	while ($row = mysqli_fetch_assoc($cerca))
		{
			$newdate = substr($row['event_date'],0,strlen($row['event_date'])-8);
			$paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
			$euroPaga=substr($row['event_info'], -7, 7);
		
			if (strstr($euroPaga,"2 Euro")){ $bacCol="#D1E8FC"; $contadapagati2euro=$contadapagati2euro+1;}
			if (strstr($euroPaga,"5 Euro")) { $bacCol="#FCC4C4"; $contadapagati5euro=$contadapagati5euro+1;}
			if (strstr($euroPaga,"9 Euro")) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"+1 Euro")) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"10 Euro")) { $bacCol="#F1F9B3"; $contadapagati10euro=$contadapagati10euro+1;}
			if (strstr($euroPaga,"+5 euro")) { $bacCol="#C4FCB0";}
			if (strstr($euroPaga,"20 euro")) { $bacCol="#C4FCB0"; $contadapagati20euro=$contadapagati20euro+1;}
		
		  echo "<tr>
		  <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
		  <td>".$row['verifica']."</td>
		 <td style='background:".$bacCol."'>".$euroPaga."</td>
		 <td>".$row['prev_level']."</td>
		 <td>".$row['new_level']."</td>
		 <td>".$newdate."</td>";
		  if ($row['pagato']==0){echo "<td>n.a.</td><td>n.p.</td></tr>";}
								else
								{
									echo "<td>".$row['codice']."</td><td>".$paydate."</td></tr>"; 
									 
								}
								
			$montDate=date("m",strtotime($row['event_date']));
			$yearDate=date("y",strtotime($row['event_date']));
			
			if($yearDate==16)
			{	
	
		
			}
			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"2 Euro")))
			{
				
			$code=$array2euro[$contapagati2euro];	
				
			if ($code!="")	
				{
				
				mysqli_select_db($database_admin, $admin);
				$query_aggiorna = "UPDATE t_history_copia SET pagato=1, codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
				$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
				
				
				
				
				$header = "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
				$destinatario = $row['email'];
				$oggetto = "Club Millebytes: Ecco il tuo buono regalo!";
				$messaggio = '
				<html>
				<head>
				<title>Club Millebytes: Ecco il tuo buono regalo!</title>
				<style type="text/css">
				body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
				</style>
				</head>
				<body>
				<p>&Egrave; con grande piacere che ti inviamo il Buono Regalo* Amazon.it che potrai utilizzare per comprare milioni di articoli
				su <a href="http://www.amazon.it">www.amazon.it</a>. Non cancellare questo messaggio, avrai bisogno del codice del Buono Regalo riportato qui sotto. 
				Ti consigliamo di stampare una copia del presente messaggio per riferimenti futuri.</p><br>
				
				<p>
				<b>Codice Buono Regalo* Amazon.it: '.$code.'</b><br>
				<b>Importo: '.$row['event_info'].'</b><br>
				<b>Validità: 10 anni</b><br>
				</p>
				<br>
				
				<p>
				Per utilizzare il tuo Buono Regalo, segui questa procedura:
				<ol>
				<li>Vai su <a href="http://www.amazon.it/gp/gc/">www.amazon.it/gp/gc/</a></li>
				<li>Clicca su &quot;Aggiungi al mio Account&quot; e inserisci il codice quando richiesto.</li>
				<li>Il credito del Buono Regalo sar&agrave; aggiunto automaticamente agli ordini &quot;alla cassa&quot;.</li>
				<li>Il saldo del tuo ordine eccedente l&apos;importo del Buono Regalo va estinto con un&apos;altra modalit&agrave; di pagamento.</li>
				</ol>
				
				<br>
				
				Il codice del tuo Buono Regalo pu&ograve;  essere inserito anche quando gli ordini sono &quot;alla cassa&quot;. Per utilizzare il tuo Buono Regalo usando l&apos;opzione 1-Click&reg; di Amazon, per prima cosa inserisci il credito del Buono Regalo al tuo Account.
				
				</p>
				
				<p>
				Per informazioni su come utilizzare il tuo Buono Regalo, visita la pagina <a href="http://www.amazon.it/aiuto">www.amazon.it/aiuto</a>. Per informazioni sull&apos;offerta della societ&agrave; Millebytes, contatta la societ&agrave; Millebytes.
				</p>
				
				<p>
				Lascia un commento sulla nostra pagina facebook !<a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
				</p>
				
				<br>
				<p>
				*Amazon.it non &egrave; uno sponsor della presente promozione. I Buoni Regalo Amazon.it possono essere utilizzati sul sito Amazon.it per l&apos;acquisto di prodotti elencati nel nostro catalogo on-line e venduti da Amazon.it o da qualsiasi altro venditore attraverso Amazon.it I Buoni Regalo Amazon non possono essere ricaricati, rivenduti, convertiti in contanti, trasferiti o utilizzati in un altro account. Amazon.it non &egrave; responsabile per lo smarrimento, il furto, la distruzione o l&apos;uso non autorizzato dei Buoni Regalo. I termini e condizioni d&apos;uso sono disponibili su <a href="http://www.amazon.it/buoni-regalo-termini-condizioni">www.amazon.it/buoni-regalo-termini-condizioni</a>. I Buoni Regalo sono emessi da Amazon EU Sarl. Tutti i &reg;, TM e &copy; Amazon sono propriet&agrave; intellettuale di Amazon.com o delle sue filiali.
				</p>
				
				
				
				</body>
				</html>
				';
				mail($destinatario, $oggetto, $messaggio, $header);
				
				$contapagati2euro=$contapagati2euro+1;
			}	
			
			}
			
			
			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"5 Euro")))
			{
				
				$code=$array5euro[$contapagati5euro];	
				
				if ($code!="")	
				{
					
					mysqli_select_db($database_admin, $admin);
					$query_aggiorna = "UPDATE t_history_copia SET pagato=1, codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					
					
					
					$header = "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
					$destinatario = $row['email'];
					$oggetto = "Club Millebytes: Ecco il tuo buono regalo!";
					$messaggio = '
					<html>
					<head>
					<title>Club Millebytes: Ecco il tuo buono regalo!</title>
					<style type="text/css">
					body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
					</style>
					</head>
					<body>
					<p>&Egrave; con grande piacere che ti inviamo il Buono Regalo* Amazon.it che potrai utilizzare per comprare milioni di articoli
					su <a href="http://www.amazon.it">www.amazon.it</a>. Non cancellare questo messaggio, avrai bisogno del codice del Buono Regalo riportato qui sotto. 
					Ti consigliamo di stampare una copia del presente messaggio per riferimenti futuri.</p><br>
					
					<p>
					<b>Codice Buono Regalo* Amazon.it: '.$code.'</b><br>
					<b>Importo: '.$row['event_info'].'</b><br>
					<b>Validità: 10 anni</b><br>
					</p>
					<br>
					
					<p>
					Per utilizzare il tuo Buono Regalo, segui questa procedura:
					<ol>
					<li>Vai su <a href="http://www.amazon.it/gp/gc/">www.amazon.it/gp/gc/</a></li>
					<li>Clicca su &quot;Aggiungi al mio Account&quot; e inserisci il codice quando richiesto.</li>
					<li>Il credito del Buono Regalo sar&agrave; aggiunto automaticamente agli ordini &quot;alla cassa&quot;.</li>
					<li>Il saldo del tuo ordine eccedente l&apos;importo del Buono Regalo va estinto con un&apos;altra modalit&agrave; di pagamento.</li>
					</ol>
					
					<br>
					
					Il codice del tuo Buono Regalo pu&ograve;  essere inserito anche quando gli ordini sono &quot;alla cassa&quot;. Per utilizzare il tuo Buono Regalo usando l&apos;opzione 1-Click&reg; di Amazon, per prima cosa inserisci il credito del Buono Regalo al tuo Account.
					
					</p>
					
					<p>
					Per informazioni su come utilizzare il tuo Buono Regalo, visita la pagina <a href="http://www.amazon.it/aiuto">www.amazon.it/aiuto</a>. Per informazioni sull&apos;offerta della societ&agrave; Millebytes, contatta la societ&agrave; Millebytes.
					</p>
					
					<p>
					Lascia un commento sulla nostra pagina facebook !<a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
					</p>
					
					<br>
					<p>
					*Amazon.it non &egrave; uno sponsor della presente promozione. I Buoni Regalo Amazon.it possono essere utilizzati sul sito Amazon.it per l&apos;acquisto di prodotti elencati nel nostro catalogo on-line e venduti da Amazon.it o da qualsiasi altro venditore attraverso Amazon.it I Buoni Regalo Amazon non possono essere ricaricati, rivenduti, convertiti in contanti, trasferiti o utilizzati in un altro account. Amazon.it non &egrave; responsabile per lo smarrimento, il furto, la distruzione o l&apos;uso non autorizzato dei Buoni Regalo. I termini e condizioni d&apos;uso sono disponibili su <a href="http://www.amazon.it/buoni-regalo-termini-condizioni">www.amazon.it/buoni-regalo-termini-condizioni</a>. I Buoni Regalo sono emessi da Amazon EU Sarl. Tutti i &reg;, TM e &copy; Amazon sono propriet&agrave; intellettuale di Amazon.com o delle sue filiali.
					</p>
					
					
					
					</body>
					</html>
					';
					mail($destinatario, $oggetto, $messaggio, $header);
					
					$contapagati5euro=$contapagati5euro+1;
				}	
				
			}	
			
			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"10 Euro")))
			{
				
				$code=$array10euro[$contapagati10euro];	
				
				if ($code!="")	
				{
					
					mysqli_select_db($database_admin, $admin);
					$query_aggiorna = "UPDATE t_history_copia SET pagato=1, codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					
					
					
					$header = "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
					$destinatario = $row['email'];
					$oggetto = "Club Millebytes: Ecco il tuo buono regalo!";
					$messaggio = '
					<html>
					<head>
					<title>Club Millebytes: Ecco il tuo buono regalo!</title>
					<style type="text/css">
					body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
					</style>
					</head>
					<body>
					<p>&Egrave; con grande piacere che ti inviamo il Buono Regalo* Amazon.it che potrai utilizzare per comprare milioni di articoli
					su <a href="http://www.amazon.it">www.amazon.it</a>. Non cancellare questo messaggio, avrai bisogno del codice del Buono Regalo riportato qui sotto. 
					Ti consigliamo di stampare una copia del presente messaggio per riferimenti futuri.</p><br>
					
					<p>
					<b>Codice Buono Regalo* Amazon.it: '.$code.'</b><br>
					<b>Importo: '.$row['event_info'].'</b><br>
					<b>Validità: 10 anni</b><br>
					</p>
					<br>
					
					<p>
					Per utilizzare il tuo Buono Regalo, segui questa procedura:
					<ol>
					<li>Vai su <a href="http://www.amazon.it/gp/gc/">www.amazon.it/gp/gc/</a></li>
					<li>Clicca su &quot;Aggiungi al mio Account&quot; e inserisci il codice quando richiesto.</li>
					<li>Il credito del Buono Regalo sar&agrave; aggiunto automaticamente agli ordini &quot;alla cassa&quot;.</li>
					<li>Il saldo del tuo ordine eccedente l&apos;importo del Buono Regalo va estinto con un&apos;altra modalit&agrave; di pagamento.</li>
					</ol>
					
					<br>
					
					Il codice del tuo Buono Regalo pu&ograve;  essere inserito anche quando gli ordini sono &quot;alla cassa&quot;. Per utilizzare il tuo Buono Regalo usando l&apos;opzione 1-Click&reg; di Amazon, per prima cosa inserisci il credito del Buono Regalo al tuo Account.
					
					</p>
					
					<p>
					Per informazioni su come utilizzare il tuo Buono Regalo, visita la pagina <a href="http://www.amazon.it/aiuto">www.amazon.it/aiuto</a>. Per informazioni sull&apos;offerta della societ&agrave; Millebytes, contatta la societ&agrave; Millebytes.
					</p>
					
					<p>
					Lascia un commento sulla nostra pagina facebook !<a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
					</p>
					
					<br>
					<p>
					*Amazon.it non &egrave; uno sponsor della presente promozione. I Buoni Regalo Amazon.it possono essere utilizzati sul sito Amazon.it per l&apos;acquisto di prodotti elencati nel nostro catalogo on-line e venduti da Amazon.it o da qualsiasi altro venditore attraverso Amazon.it I Buoni Regalo Amazon non possono essere ricaricati, rivenduti, convertiti in contanti, trasferiti o utilizzati in un altro account. Amazon.it non &egrave; responsabile per lo smarrimento, il furto, la distruzione o l&apos;uso non autorizzato dei Buoni Regalo. I termini e condizioni d&apos;uso sono disponibili su <a href="http://www.amazon.it/buoni-regalo-termini-condizioni">www.amazon.it/buoni-regalo-termini-condizioni</a>. I Buoni Regalo sono emessi da Amazon EU Sarl. Tutti i &reg;, TM e &copy; Amazon sono propriet&agrave; intellettuale di Amazon.com o delle sue filiali.
					</p>
					
					
					
					</body>
					</html>
					';
					mail($destinatario, $oggetto, $messaggio, $header);
					
					$contapagati10euro=$contapagati10euro+1;
				}	
				
			}
			


			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"20 euro")))
			{
				
				$code=$array20euro[$contapagati20euro];	
				
				if ($code!="")	
				{
					
					mysqli_select_db($database_admin, $admin);
					$query_aggiorna = "UPDATE t_history_copia SET pagato=1, codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					
					
					
					$header = "MIME-Version: 1.0\r\n ";
					$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
					$destinatario = $row['email'];
					$oggetto = "Club Millebytes: Ecco il tuo buono regalo!";
					$messaggio = '
					<html>
					<head>
					<title>Club Millebytes: Ecco il tuo buono regalo!</title>
					<style type="text/css">
					body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
					</style>
					</head>
					<body>
					<p>&Egrave; con grande piacere che ti inviamo il Buono Regalo* Amazon.it che potrai utilizzare per comprare milioni di articoli
					su <a href="http://www.amazon.it">www.amazon.it</a>. Non cancellare questo messaggio, avrai bisogno del codice del Buono Regalo riportato qui sotto. 
					Ti consigliamo di stampare una copia del presente messaggio per riferimenti futuri.</p><br>
					
					<p>
					<b>Codice Buono Regalo* Amazon.it: '.$code.'</b><br>
					<b>Importo: '.$row['event_info'].'</b><br>
					<b>Validità: 10 anni</b><br>
					</p>
					<br>
					
					<p>
					Per utilizzare il tuo Buono Regalo, segui questa procedura:
					<ol>
					<li>Vai su <a href="http://www.amazon.it/gp/gc/">www.amazon.it/gp/gc/</a></li>
					<li>Clicca su &quot;Aggiungi al mio Account&quot; e inserisci il codice quando richiesto.</li>
					<li>Il credito del Buono Regalo sar&agrave; aggiunto automaticamente agli ordini &quot;alla cassa&quot;.</li>
					<li>Il saldo del tuo ordine eccedente l&apos;importo del Buono Regalo va estinto con un&apos;altra modalit&agrave; di pagamento.</li>
					</ol>
					
					<br>
					
					Il codice del tuo Buono Regalo pu&ograve;  essere inserito anche quando gli ordini sono &quot;alla cassa&quot;. Per utilizzare il tuo Buono Regalo usando l&apos;opzione 1-Click&reg; di Amazon, per prima cosa inserisci il credito del Buono Regalo al tuo Account.
					
					</p>
					
					<p>
					Per informazioni su come utilizzare il tuo Buono Regalo, visita la pagina <a href="http://www.amazon.it/aiuto">www.amazon.it/aiuto</a>. Per informazioni sull&apos;offerta della societ&agrave; Millebytes, contatta la societ&agrave; Millebytes.
					</p>
					
					<p>
					Lascia un commento sulla nostra pagina facebook !<a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
					</p>
					
					<br>
					<p>
					*Amazon.it non &egrave; uno sponsor della presente promozione. I Buoni Regalo Amazon.it possono essere utilizzati sul sito Amazon.it per l&apos;acquisto di prodotti elencati nel nostro catalogo on-line e venduti da Amazon.it o da qualsiasi altro venditore attraverso Amazon.it I Buoni Regalo Amazon non possono essere ricaricati, rivenduti, convertiti in contanti, trasferiti o utilizzati in un altro account. Amazon.it non &egrave; responsabile per lo smarrimento, il furto, la distruzione o l&apos;uso non autorizzato dei Buoni Regalo. I termini e condizioni d&apos;uso sono disponibili su <a href="http://www.amazon.it/buoni-regalo-termini-condizioni">www.amazon.it/buoni-regalo-termini-condizioni</a>. I Buoni Regalo sono emessi da Amazon EU Sarl. Tutti i &reg;, TM e &copy; Amazon sono propriet&agrave; intellettuale di Amazon.com o delle sue filiali.
					</p>
					
					
					
					</body>
					</html>
					';
					mail($destinatario, $oggetto, $messaggio, $header);
					
					$contapagati20euro=$contapagati20euro+1;
				}	
				
			}			
		}


/* premi in cassa */

$query_cassa = "SELECT * FROM millebytesdb.field_data_field_number_of_prizes order by entity_id ASC;";
$cassaRim = mysqli_query($admin,$query_cassa) ;

$cicli=0;
	while ($row = mysqli_fetch_assoc($cassaRim))
		{
		$cicli++;

		  if ($cicli==1) { $rimasti2=$row['field_number_of_prizes_value'];}	
		  if ($cicli==2) { $rimasti5=$row['field_number_of_prizes_value'];}	
		  if ($cicli==3) { $rimasti9=$row['field_number_of_prizes_value'];}	
		  if ($cicli==4) { $rimasti15=$row['field_number_of_prizes_value'];}	
		}
		
$query_cassa = "SELECT * FROM millebytesdb.field_data_field_refill_date order by entity_id ASC;";
$cassaRim = mysqli_query($admin,$query_cassa) ;

$cicli=0;
	while ($row = mysqli_fetch_assoc($cassaRim))
		{
		$cicli++;

		  if ($cicli==1) { $rimastiData2=$row['field_refill_date_value'];}	
		  if ($cicli==2) { $rimastiData5=$row['field_refill_date_value'];}	
		  if ($cicli==3) { $rimastiData9=$row['field_refill_date_value'];}	
		  if ($cicli==4) { $rimastiData15=$row['field_refill_date_value'];}	
		}		

		
?>
</tbody>
</table>
</div>


</div>

</div>

<div class="col-md-3">

<div class="row">
 
<div class="card shadow mb-12">
<div class="card-header py-6 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> STATUS PREMI </h6></span>
 </div>
   
 <div class="card-body  recent-users-sec"> 
<table style="font-size:11px; width:100%"  class="table table-striped table-bordered">
		<tr class='intesta'><th>Premio</th><th >Rimasti</th><th>Rifornimento</th></tr>
		<tr>
		<td>Buoni 2 euro:</td> 
		<td><?php echo $rimasti2  ?></td>
		<td><?php echo substr($rimastiData2,0,10) ?></td>

		</tr>
			
		<tr>
		<td>Buoni 5 euro:</td> 
		<td><?php echo $rimasti5 ?></td>
		<td><?php echo substr($rimastiData5,0,10) ?></td>
		</tr>
		
		
		<tr>
		<td>Buoni 10 Euro:</td>
		<td><?php echo $rimasti9 ?></td>
		<td><?php echo substr($rimastiData9,0,10) ?></td>
		</tr>
		
		
		<tr>
		<td>Buoni 20 Euro:</td>
		<td><?php echo $rimasti15 ?></td>
		<td><?php echo substr($rimastiData15,0,10) ?></td>
		</tr>

</table>
</div>
</div>
</div>

<?php

$cyear=date("Y");

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_history_copia where event_info='Buono regalo da 2 Euro' and event_date LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data2=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_history_copia where event_info='Buono regalo da 5 Euro' and event_date LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data5=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_history_copia where event_info='Buono regalo da 10 Euro' and event_date LIKE '".$cyear."%'";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data10=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_history_copia where event_info='Buono regalo da 20 Euro'  and event_date LIKE '".$cyear."%'";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data20=mysqli_fetch_assoc($t_PAGO);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro2'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud2=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro5'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud5=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro10'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud10=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro20'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud20=mysqli_fetch_assoc($t_bud);

$gia2=$bud2['num']-$data2['total'];
$gia5=$bud5['num']-$data5['total'];
$gia10=$bud10['num']-$data10['total'];
$gia20=$bud20['num']-$data20['total'];

$dinizio = "2017-03-01";
$dfine = date("Y-m-d");

$ts1 = strtotime($dinizio);
$ts2 = strtotime($dfine);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = 12-((($year2 - $year1) * 12) + ($month2 - $month1));


$giaM2=$gia2/$diff;
$giaM5=$gia5/$diff;
$giaM10=$gia10/$diff;
$giaM20=$gia20/$diff;

?>

<div class="row">
 
<div class="card-success shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> TOTALE PREMI </h6></span>
 </div>

   
 <div class="card-body  recent-users-sec"> 


<table style="font-size:11px"  class="table table-striped table-bordered">
		<tr class='intesta'><th><a target='_blank' href='http://www.millebytes.com/en/add_level_point'/>ADD</a></th><th >&euro; 2</th><th >&euro;5</th><th >&euro;10</th><th> &euro;20 </th></tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Budget</td><td><?php echo $bud2['num']; ?></td><td><?php echo $bud5['num']; ?></td><td><?php echo $bud10['num']; ?></td><td><?php echo $bud20['num']; ?></td>
		</tr>
		<tr class=''>
		<td><?php echo $bud2['num']*2; ?>€</td><td><?php echo $bud5['num']*5; ?>€</td><td><?php echo $bud10['num']*10; ?>€</td><td><?php echo $bud20['num']*20; ?>€</td>
		</tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Pagati</td><td><?php echo $data2['total']; ?></td><td><?php echo $data5['total']; ?></td><td><?php echo $data10['total']; ?></td><td><?php echo $data20['total']; ?></td>
		</tr>
		<tr>
		<td><?php echo $data2['total']*2; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data20['total']*20; ?>€</td>
		</tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Giacenza</td><td><?php echo $gia2; ?></td><td><?php echo $gia5; ?></td><td><?php echo $gia10; ?></td><td><?php echo $gia20; ?></td>
		</tr>
		<tr class=''>
		<td><?php echo $gia2*2; ?>€</td><td><?php echo $gia5*5; ?>€</td><td><?php echo $gia10*10; ?>€</td><td><?php echo $gia20*20; ?>€</td>
		</tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;"><b>Pagati</b></td>
		<td colspan="4">
		<?php 
		$totalone=($data2['total']*2)+($data5['total']*5)+($data10['total']*10)+($data20['total']*20);
		?>
		<b>
		<?php 
		echo $totalone;
		?>
		€</b>
		</td>
		</tr>

</table>
</div>
</div>
</div>


	 <div class="row">
		 
		 <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-primary">
		 Premi 2 euro <span class="badge badge-light"><?php echo "(".$contadapagati2euro.")";?></span>
			</button>	  
		 </div>
			 
			 <div class="card-body"> 
			 <textarea class="form-control" style="text-transform:uppercase;" name="pr2euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea> 
		 </div>
	 </div>
 </div>
 
 
 	 <div class="row">
	  <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-danger">
				 Premi 5 euro <span class="badge badge-light"><?php echo "(".$contadapagati5euro.")";?></span>
				 </button>	
			 </div>
			 
			 <div class="card-body"> 
				 
				 <textarea class="form-control" style="text-transform:uppercase;" name="pr5euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				 
			
			 
		 </div>
	 </div>
 </div>
 
 
	<div class="row">
		
	<div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-warning">
				Premi 10 euro <span class="badge badge-light"><?php echo "(".$contadapagati10euro.")";?></span>
			</div>
			
			<div class="card-body"> 
				
				<textarea class="form-control" style="text-transform:uppercase;" name="pr10euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				
			
			
		</div>
	</div>
</div>

	 <div class="row">
		 
	 <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-success">
				 Premi 20 euro  <span class="badge badge-light"><?php echo "(".$contadapagati20euro.")";?></span>
			 </div>
			 
			 <div class="card-body"> 
				 
				 <textarea class="form-control" style="text-transform:uppercase;" name="pr20euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				
				 <hr>
				<button class='btn btn-primary'  type='submit'  name='var_pagato' value='PAGA' >PAGA</button>
				
				</form>
				 
		 </div>
	 </div>
 </div>


</div>




</div>

</div>
</div>
<?php
require_once('inc_footer.php'); 
?>

<script>
$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();
    $('#table_sur').DataTable( {
        "order": [[ 5, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ richieste"
   					 },
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "pageLength": 50,
        'columnDefs': [ {

                        'targets': [0,1,3,4,6], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );
</script>