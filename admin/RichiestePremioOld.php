

<?php require_once('../Connections/admin.php'); 
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
@$cifra2 = $_REQUEST['cifra2'];
@$cifra5 = $_REQUEST['cifra5'];
@$cifra9 = $_REQUEST['cifra9'];
@$cifra10 = $_REQUEST['cifra10'];
@$cifra15 = $_REQUEST['cifra15'];
@$cifra20 = $_REQUEST['cifra20'];
$data=date("Y-m-d");
mysqli_select_db($database_admin, $admin);


require_once('inc_taghead.php');
require_once('inc_tagbody.php');

//AGGIUNGO Buoni 2 euro
if($azione=="add2")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra2' WHERE type='euro2'";
$add_euro = mysqli_query($query_aggiorna, $admin) or die(mysql_error());
}

//AGGIUNGO Buoni 5 euro
if($azione=="add5")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra5' WHERE type='euro5'";
$add_euro = mysqli_query($query_aggiorna, $admin) or die(mysql_error());
}

//AGGIUNGO Buoni 9 euro
if($azione=="add9")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra9' WHERE type='euro9'";
$add_euro = mysqli_query($query_aggiorna, $admin) or die(mysql_error());
}

//AGGIUNGO Buoni 15 euro
if($azione=="add15")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE cassa_buoni SET num='$cifra15' WHERE type='euro15'";
$add_euro = mysqli_query($query_aggiorna, $admin) or die(mysql_error());
}

//COPIO HISTORY
$query_copia_history_copy="INSERT t_history_copia (user_id, event_date, event_type, event_info, prev_level, new_level)
SELECT user_id, event_date, event_type, event_info, prev_level, new_level
FROM t_user_history where event_type='withdraw' and user_id NOT IN (SELECT user_id FROM t_history_copia where t_history_copia.event_date=t_user_history.event_date)";
$query_copia_history_copy_sample = mysqli_query($query_copia_history_copy, $admin) or die(mysql_error());
$query_copia_history_copy_sample_t = mysqli_fetch_assoc($query_copia_history_copy_sample);

if(($var_pagato=="PAGA")&&($code != ""))
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE t_history_copia SET pagato=1, codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$id_utente."'";
$up_ricercha = mysqli_query($query_aggiorna, $admin) or die(mysql_error());




$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
$destinatario = $email;
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
<b>Importo: '.$importo.'</b><br>
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
}



$query_cerca = "SELECT * FROM t_history_copia,t_user_info where t_history_copia.user_id=t_user_info.user_id order by event_date desc";
$cerca = mysqli_query($query_cerca, $admin) or die(mysql_error());


?>
<div style="float:left; width:70%">
<table style="font-size:11px"  class='premiview' >
		<tr class='intesta'> <th>Uid</th><th>Premio</th><th>Prima</th><th>Dopo</th><th>Richiesta</th><th>Codice</th><th colspan='2'>Pagamento</th></tr>

<?php
$pagati=0;
$pagati2=0;
$pagati5=0;
$pagati9=0;
$pagati10=0;
$pagati15=0;
$pagati20=0;
	while ($row = mysqli_fetch_assoc($cerca))
		{
			$newdate = substr($row['event_date'],0,strlen($row['event_date'])-8);
			$paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
			$euroPaga=substr($row['event_info'], -7, 7);
		
			if (strstr($euroPaga,"2 Euro")){ $bacCol="#D1E8FC";}
			if (strstr($euroPaga,"5 Euro")) { $bacCol="#FCC4C4";}
			if (strstr($euroPaga,"9 Euro")) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"+1 Euro")) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"10 Euro")) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"+5 euro")) { $bacCol="#C4FCB0";}
			if (strstr($euroPaga,"20 euro")) { $bacCol="#C4FCB0";}
		
		  echo "<form  action=\"RichiestePremio.php\" method=\"post\"><tr><td><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
		 <td style='background:".$bacCol."'>".$euroPaga."</td><td>".$row['prev_level']."</td><td>".$row['new_level']."</td><td>".$newdate."</td>";
		  if ($row['pagato']==0){echo "<td colspan='2'><input type='text' name='code'></td><td><input type=\"hidden\" name=\"id_utente\" value=\"".$row['id']."\" />
<input  type='submit'  name='var_pagato' value='PAGA' /><input type=\"hidden\" name=\"email\" value=\"".$row['email']."\" /><input type=\"hidden\" name=\"importo\" value=\"".$row['event_info']."\" /></form></td></tr>";}
								else
								{
									echo "<td>".$row['codice']."</td><td>Pagato</td><td>".$paydate."</td></tr>"; 
									$pagati=$pagati+1;
									if( $row['event_info']=='Buono regalo da 2 Euro') { $pagati2=$pagati2+1;}
									if( $row['event_info']=='Buono regalo da 5 Euro') { $pagati5=$pagati5+1;}
									if( $row['event_info']=='Buono regalo da 15+5 euro'){ $pagati5=$pagati5+1;}
									if( $row['event_info']=='Buono regalo da 9 Euro') { $pagati9=$pagati9+1;}
									if( $row['event_info']=='Buono regalo da 9+1 Euro') { $pagati9=$pagati9+1;}
									if( $row['event_info']=='Buono regalo da 10 Euro'){ $pagati10=$pagati10+1;}
									if( $row['event_info']=='Buono regalo da 15 Euro'){ $pagati15=$pagati15+1;}
									if( $row['event_info']=='Buono regalo da 15+5 euro'){ $pagati15=$pagati15+1;}
									if( $row['event_info']=='Buono regalo da 20 euro'){ $pagati20=$pagati20+1;}
								}
								
			$montDate=date("m",strtotime($row['event_date']));
			$yearDate=date("y",strtotime($row['event_date']));
			
			if($yearDate==16)
			{	
	
			if ($montDate==01) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaGennaio2++; }}
			if ($montDate==01) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaGennaio5++; }}
			if ($montDate==01) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaGennaio10++; }}
			if ($montDate==01) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaGennaio20++; }}
			if ($montDate==02) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaFebbraio2++; }}
			if ($montDate==02) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaFebbraio5++; }}
			if ($montDate==02) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaFebbraio10++; }}
			if ($montDate==02) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaFebbraio20++; }}
			if ($montDate==03) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaMarzo2++; }}
			if ($montDate==03) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaMarzo5++; }}
			if ($montDate==03) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaMarzo10++; }}
			if ($montDate==03) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaMarzo20++; }}
			if ($montDate==04) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaAprile2++; }}
			if ($montDate==04) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaAprile5++; }}
			if ($montDate==04) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaAprile10++; }}
			if ($montDate==04) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaAprile20++; }}
			if ($montDate==05) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaMaggio2++; }}
			if ($montDate==05) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaMaggio5++; }}
			if ($montDate==05) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaMaggio10++; }}
			if ($montDate==05) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaMaggio20++; }}	
			if ($montDate==06) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaGiugno2++; }}
			if ($montDate==06) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaGiugno5++; }}
			if ($montDate==06) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaGiugno10++; }}
			if ($montDate==06) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaGiugno20++; }}
			if ($montDate==07) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaLuglio2++; }}
			if ($montDate==07) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaLuglio5++; }}
			if ($montDate==07) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaLuglio10++; }}
			if ($montDate==07) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaLuglio20++; }}		
			if ($montDate==08) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaAgosto2++; }}
			if ($montDate==08) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaAgosto5++; }}
			if ($montDate==08) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaAgosto10++; }}
			if ($montDate==08) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaSettembre5++; }}	
			if ($montDate==09) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaSettembre2++; }}
			if ($montDate==09) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaSettembre5++; }}
			if ($montDate==09) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaSettembre10++; }}
			if ($montDate==09) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaSettembre20++; }}	
			if ($montDate==10) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaOttobre2++; }}
			if ($montDate==10) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaOttobre5++; }}
			if ($montDate==10) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaOttobre10++; }}
			if ($montDate==10) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaOttobre20++; }}	
			if ($montDate==11) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaNovembre2++; }}
			if ($montDate==11) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaNovembre5++; }}
			if ($montDate==11) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaNovembre10++; }}
			if ($montDate==11) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaNovembre20++; }}
			if ($montDate==12) { if($row['event_info']=='Buono regalo da 2 Euro') { $contaDicembre2++; }}
			if ($montDate==12) { if($row['event_info']=='Buono regalo da 5 Euro') { $contaDicembre5++; }}
			if ($montDate==12) { if($row['event_info']=='Buono regalo da 10 Euro') { $contaDicembre10++; }}
			if ($montDate==12) { if($row['event_info']=='Buono regalo da 20 euro'){ $contaDicembre20++; }}			
			}
				
		}
$eu2=$pagati2*2;
$eu5=$pagati5*5;
$eu9=$pagati9*9;
$eu10=$pagati10*10;
$eu15=$pagati15*15;
$eu20=$pagati20*20;

$euTot=$eu2+$eu5+$eu9+$eu10+$eu15+$eu20;

$query_dispo = "SELECT * FROM cassa_buoni ORDER BY id";
$dispo = mysqli_query($query_dispo, $admin) or die(mysql_error());
$contaDispo=0;

	while ($row = mysqli_fetch_assoc($dispo))
		{
			if ($contaDispo==0) { $buy2=$row['num'];}
			if ($contaDispo==1) { $buy5=$row['num'];}
			if ($contaDispo==2) { $buy9=$row['num'];}
			if ($contaDispo==3) { $buy10=$row['num'];}
			if ($contaDispo==4) { $buy15=$row['num'];}
			if ($contaDispo==5) { $buy20=$row['num'];}
			$contaDispo++;
		}
		
$eurobuy2=$buy2*2;
$eurobuy5=$buy5*5;
$eurobuy9=$buy9*9;
$eurobuy10=$buy10*10;
$eurobuy15=$buy15*15;
$eurobuy20=$buy20*20;
$totbuy=$eurobuy2+$eurobuy5+$eurobuy9+$eurobuy10+$eurobuy15+$eurobuy20;
		
$dispo2=$buy2-$pagati2;
$dispo5=$buy5-$pagati5;
$dispo9=$buy9-$pagati9;
$dispo10=$buy10-$pagati10;
$dispo15=$buy15-$pagati15;
$dispo20=$buy20-$pagati20;

$euroDisp2=$dispo2*2;
$euroDisp5=$dispo5*5;
$euroDisp9=$dispo9*9;
$euroDisp10=$dispo10*10;
$euroDisp15=$dispo15*15;
$euroDisp20=$dispo20*20;
$totDisp=$euroDisp2+$euroDisp5+$euroDisp9+$euroDisp10+$euroDisp15+$euroDisp20;

/* premi in cassa */

$query_cassa = "SELECT * FROM millebytesdb.field_data_field_number_of_prizes order by entity_id ASC;";
$cassaRim = mysqli_query($query_cassa, $admin) or die(mysql_error());

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
$cassaRim = mysqli_query($query_cassa, $admin) or die(mysql_error());

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
</table>
</div>

<div style="float:left;  width:30%">
<table  style="font-size:11px" class='premistat'>
		<tr class='intesta'><th>Premio</th><th colspan="2">Pagati</th><th colspan="2">Acquistati</th><th colspan="2">Disponibili</th></tr>
		<tr>
		<td>Buoni 2 euro:</td> 
		<td><?php echo $pagati2 ?></td>
		<td><?php echo $eu2 ?>&euro;</td>
		<td>
		<?php if ($azione=="mod2")
		{
	       ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="cifra2" value="<?php echo $buy2 ?>" />
			 <input type="hidden" name="azione" value="add2" />
            <input type="submit" value="ADD" style="width:20%" />
            </form>
		<?php }
		else {
		?>
		<?php echo $buy2 ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="hidden" name="azione" value="mod2" />
            <input type="submit" value="+" style="width:20%" />
            </form>
		<?php } ?>
		</td>
			<td><?php echo $eurobuy2 ?>&euro;</td>
			<td><?php echo $dispo2 ?></td>
			<td><?php echo $euroDisp2 ?>&euro;</td>
			</tr>
			
		<tr>
		<td>Buoni 5 euro:</td> 
		<td><?php echo $pagati5 ?></td>
		<td><?php echo $eu5 ?>&euro;</td>
				<td>
		<?php if ($azione=="mod5")
		{
	       ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="cifra5" value="<?php echo $buy5 ?>" />
			 <input type="hidden" name="azione" value="add5" />
            <input type="submit" value="ADD" style="width:20%" />
            </form>
		<?php }
		else {
		?>
		<?php echo $buy5 ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="hidden" name="azione" value="mod5" />
            <input type="submit" value="+" style="width:20%" />
            </form>
		<?php } ?>
		</td>
		<td><?php echo $eurobuy5 ?>&euro;</td>
		<td><?php echo $dispo5 ?></td>
		<td><?php echo $euroDisp5 ?>&euro;</td>
		</tr>
		
		
		<tr>
		<td>Buoni 9 Euro:</td>
		<td><?php echo $pagati9 ?></td>
		<td><?php echo $eu9 ?>&euro;</td>
		<td>
		<?php echo $buy9 ?>
		</td>
		<td><?php echo $eurobuy9 ?>&euro;</td>
		<td><?php echo $dispo9 ?></td>
		<td><?php echo $euroDisp9 ?>&euro;</td>
		</tr>
		
		
		<tr>
		<td>Buoni 10 Euro:</td>
		<td><?php echo $pagati10 ?></td>
		<td><?php echo $eu10 ?>&euro;</td>
		<td>
		<?php if ($azione=="mod10")
		{
	       ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="cifra10" value="<?php echo $buy10 ?>" />
			 <input type="hidden" name="azione" value="add9" />
            <input type="submit" value="ADD" style="width:20%" />
            </form>
		<?php }
		else {
		?>
		<?php echo $buy10 ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="hidden" name="azione" value="mod10" />
            <input type="submit" value="+" style="width:20%" />
            </form>
		<?php } ?>
		</td>
		<td><?php echo $eurobuy10 ?>&euro;</td>
		<td><?php echo $dispo10 ?></td>
		<td><?php echo $euroDisp10 ?>&euro;</td>
		</tr>
		
		<tr>
		<td>Buoni 15 Euro:</td>
		<td><?php echo $pagati15 ?></td>
		<td><?php echo $eu15 ?>&euro;</td>
				<td>
		<?php echo $buy15 ?>
		</td>
			<td><?php echo $eurobuy15 ?>&euro;</td>
		<td><?php echo $dispo15 ?></td>
		<td><?php echo $euroDisp15 ?>&euro;</td>
		
		</tr>
		
		
		<tr>
		<td>Buoni 20 Euro:</td>
		<td><?php echo $pagati20 ?></td>
		<td><?php echo $eu20 ?>&euro;</td>
				<td>
		<?php if ($azione=="mod20")
		{
	       ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="cifra20" value="<?php echo $buy20 ?>" />
			 <input type="hidden" name="azione" value="add15" />
            <input type="submit" value="ADD" style="width:20%" />
            </form>
		<?php }
		else {
		?>
		<?php echo $buy20 ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="hidden" name="azione" value="mod20" />
            <input type="submit" value="+" style="width:20%" />
            </form>
		<?php } ?>
		</td>
			<td><?php echo $eurobuy20 ?>&euro;</td>
		<td><?php echo $dispo20 ?></td>
		<td><?php echo $euroDisp20 ?>&euro;</td>
		
		</tr>
		<tr><td><b>Totale Pagati:</b></td> <td><?php echo $pagati ?></td><td><?php echo $euTot ?>&euro;</td><td colspan="2" >
		<?php echo $totbuy ?>&euro;</td><td colspan="2"><?php echo $totDisp ?>&euro;</td></tr>

</table>
<p>&nbsp;</p>
<table style="font-size:11px"  class='premistat'>
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

<?php
$montepremi2=1600/12;
$montepremi5=400/12;
$montepremi10=120/12;
$montepremi20=30/12;

/*premi 2*/

$giacMarzo2=$montepremi2-$contaMarzo2;
$giacAprile2=$montepremi2+$giacMarzo2-$contaAprile2;
$giacMaggio2=$montepremi2+$giacAprile2-$contaMaggio2;
$giacGiugno2=$montepremi2+$giacMaggio2-$contaGiugno2;
$giacLuglio2=$montepremi2+$giacGiugno2-$contaLuglio2;
$giacAgosto2=$montepremi2+$giacLuglio2-$contaAgosto2;
$giacSettembre2=$montepremi2+$giacAgosto2-$contaSettembre2;
$giacOttobre2=$montepremi2+$giacSettembre2-$contaOttobre2;
$giacNovembre2=$montepremi2+$giacOttobre2-$contaNovembre2;
$giacDicembre2=$montepremi2+$giacNovembre2-$contaDicembre2;
$giacGennaio2=$montepremi2+$giacDicembre2-$contaGennaio2;
$giacFebbraio2=$montepremi2+$giacGennaio2-$contaFebbraio2;

/*premi 5*/

$giacMarzo5=$montepremi5-$contaMarzo5;
$giacAprile5=$montepremi5+$giacMarzo5-$contaAprile5;
$giacMaggio5=$montepremi5+$giacAprile5-$contaMaggio5;
$giacGiugno5=$montepremi5+$giacMaggio5-$contaGiugno5;
$giacLuglio5=$montepremi5+$giacGiugno5-$contaLuglio5;
$giacAgosto5=$montepremi5+$giacLuglio5-$contaAgosto5;
$giacSettembre5=$montepremi5+$giacAgosto5-$contaSettembre5;
$giacOttobre5=$montepremi5+$giacSettembre5-$contaOttobre5;
$giacNovembre5=$montepremi5+$giacOttobre5-$contaNovembre5;
$giacDicembre5=$montepremi5+$giacNovembre5-$contaDicembre5;
$giacGennaio5=$montepremi5+$giacDicembre5-$contaGennaio5;
$giacFebbraio5=$montepremi5+$giacGennaio5-$contaFebbraio5;

/*premi 10*/
$giacMarzo10=$montepremi10-$contaMarzo10;
$giacAprile10=$montepremi10+$giacMarzo10-$contaAprile10;
$giacMaggio10=$montepremi10+$giacAprile10-$contaMaggio10;
$giacGiugno10=$montepremi10+$giacMaggio10-$contaGiugno10;
$giacLuglio10=$montepremi10+$giacGiugno10-$contaLuglio10;
$giacAgosto10=$montepremi10+$giacLuglio10-$contaAgosto10;
$giacSettembre10=$montepremi10+$giacAgosto10-$contaSettembre10;
$giacOttobre10=$montepremi10+$giacSettembre10-$contaOttobre10;
$giacNovembre10=$montepremi10+$giacOttobre10-$contaNovembre10;
$giacDicembre10=$montepremi10+$giacNovembre10-$contaDicembre10;
$giacGennaio10=$montepremi10+$giacDicembre10-$contaGennaio10;
$giacFebbraio10=$montepremi10+$giacGennaio10-$contaFebbraio10;


/*premi 20*/
$giacMarzo20=$montepremi20-$contaMarzo20;
$giacAprile20=$montepremi20+$giacMarzo20-$contaAprile20;
$giacMaggio20=$montepremi20+$giacAprile20-$contaMaggio20;
$giacGiugno20=$montepremi20+$giacMaggio20-$contaGiugno20;
$giacLuglio20=$montepremi20+$giacGiugno20-$contaLuglio20;
$giacAgosto20=$montepremi20+$giacLuglio20-$contaAgosto20;
$giacSettembre20=$montepremi20+$giacAgosto20-$contaSettembre20;
$giacOttobre20=$montepremi20+$giacSettembre20-$contaOttobre20;
$giacNovembre20=$montepremi20+$giacOttobre20-$contaNovembre20;
$giacDicembre20=$montepremi20+$giacNovembre20-$contaDicembre20;
$giacGennaio20=$montepremi20+$giacDicembre20-$contaGennaio20;
$giacFebbraio20=$montepremi20+$giacGennaio20-$contaFebbraio20;


$now=date("m");
?>
<style>
<?php if ($now==01) {?>  .m01 { background:#EDDFAA; } <?php } ?>
<?php if ($now==02) {?>  .m02 { background:#EDDFAA; } <?php } ?>
<?php if ($now==03) {?>  .m03 { background:#EDDFAA; } <?php } ?>
<?php if ($now==04) {?>  .m04 { background:#EDDFAA; } <?php } ?>
<?php if ($now==05) {?>  .m05 { background:#EDDFAA; } <?php } ?>
<?php if ($now==06) {?>  .m06 { background:#EDDFAA; } <?php } ?>
<?php if ($now==07) {?>  .m07 { background:#EDDFAA; } <?php } ?>
<?php if ($now==08) {?>  .m08 { background:#EDDFAA; } <?php } ?>
<?php if ($now==09) {?>  .m09 { background:#EDDFAA; } <?php } ?>
<?php if ($now==10) {?>  .m10 { background:#EDDFAA; } <?php } ?>
<?php if ($now==11) {?>  .m11 { background:#EDDFAA; } <?php } ?>
<?php if ($now==12) {?>  .m12 { background:#EDDFAA; } <?php } ?>
</style>

<p>&nbsp;</p>
<table style="font-size:11px"  class='premistat'>
		<tr class='intesta'><th>Mese</th><th colspan="4" >Giacenza</th></tr>
		<tr class='intesta'><th><a target='_blank' href='http://www.millebytes.com/en/add_level_point'/>ADD</a></th><th >&euro; 2</th><th >&euro;5</th><th >&euro;10</th><th> &euro;20 </th></tr>
		<tr class='m03'>
		<td>Marzo</td> 
		<td><?php echo round($giacMarzo2); ?></td>
		<td><?php echo round($giacMarzo5); ?></td>
		<td><?php echo round($giacMarzo10); ?></td>
		<td><?php echo round($giacMarzo20); ?></td>

		</tr>
		<tr class='m04'>
		<td >Aprile</td> 
		<td><?php echo round($giacAprile2); ?></td>
		<td><?php echo round($giacAprile5); ?></td>
		<td><?php echo round($giacAprile10); ?></td>
		<td><?php echo round($giacAprile20); ?></td>
		</tr>
		<tr class='m05'>
		<td >Maggio</td> 
		<td><?php echo round($giacMaggio2); ?></td>
		<td><?php echo round($giacMaggio5); ?></td>
		<td><?php echo round($giacMaggio10); ?></td>
		<td><?php echo round($giacMaggio20); ?></td>
		</tr>
		<tr class='m06'>
		<td >Giugno</td> 
		<td><?php echo round($giacGiugno2); ?></td>
		<td><?php echo round($giacGiugno5); ?></td>
		<td><?php echo round($giacGiugno10); ?></td>
		<td><?php echo round($giacGiugno20); ?></td>
		</tr>		
		<tr class='m07'>
		<td>Luglio</td> 
		<td><?php echo round($giacLuglio2); ?></td>
		<td><?php echo round($giacLuglio5); ?></td>
		<td><?php echo round($giacLuglio10); ?></td>
		<td><?php echo round($giacLuglio20); ?></td>
		</tr>		
		<tr class='m08'>
		<td>Agosto</td> 
		<td><?php echo round($giacAgosto2); ?></td>
		<td><?php echo round($giacAgosto5); ?></td>
		<td><?php echo round($giacAgosto10); ?></td>
		<td><?php echo round($giacAgosto20); ?></td>
		</tr>	
		<tr class='m09'>
		<td>Settembre</td> 
		<td><?php echo round($giacSettembre2); ?></td>
		<td><?php echo round($giacSettembre5); ?></td>
		<td><?php echo round($giacSettembre10); ?></td>
		<td><?php echo round($giacSettembre20); ?></td>
		</tr>
		<tr class='m10'>
		<td>Ottobre</td> 
		<td><?php echo round($giacOttobre2); ?></td>
		<td><?php echo round($giacOttobre5); ?></td>
		<td><?php echo round($giacOttobre10); ?></td>
		<td><?php echo round($giacOttobre20); ?></td>
		</tr>
		<tr>
		<td class='m11'>Novembre</td> 
		<td><?php echo round($giacNovembre2); ?></td>
		<td><?php echo round($giacNovembre5); ?></td>
		<td><?php echo round($giacNovembre10); ?></td>
		<td><?php echo round($giacNovembre20); ?></td>
		</tr>
		<tr class='m12'>
		<td>Dicembre</td> 
		<td><?php echo round($giacDicembre2); ?></td>
		<td><?php echo round($giacDicembre5); ?></td>
		<td><?php echo round($giacDicembre10); ?></td>
		<td><?php echo round($giacDicembre20); ?></td>
		</tr>
		<tr class='m01'>
		<td>Gennaio</td> 
		<td><?php echo round($giacGennaio2); ?></td>
		<td><?php echo round($giacGennaio5); ?></td>
		<td><?php echo round($giacGennaio10); ?></td>
		<td><?php echo round($giacGennaio20); ?></td>
		</tr>
		<tr>
		<td class='m02'>Febbraio</td> 
		<td><?php echo round($giacFebbraio2); ?></td>
		<td><?php echo round($giacFebbraio5); ?></td>
		<td><?php echo round($giacFebbraio10); ?></td>
		<td><?php echo round($giacFebbraio20); ?></td>
		</tr>		
</table>

</div>
<?php

if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 