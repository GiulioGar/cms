<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php');
mysqli_select_db($admin,$database_admin);


$contaiscrittimese=0;
$contaiscrittimese2=0;
$contaiscrittimese3=0;

$mesecorrente=date(m);
$annocorrente=date(Y);

//echo "Giorno: ".$giorno." Mese: ".$mese." Anno: ".$anno;

$mese=$_REQUEST['mese'];
if ($mese==""){$mese=$mesecorrente;}


$anno=$_REQUEST['anno'];
if ($anno==""){$anno=$annocorrente;}




//TOTALI
$query_nuoviutenti = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' ";
$esegui_query_nuoviutenti = mysqli_query($admin,$query_nuoviutenti);


while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti))
{
	$giornoiscrizione=$row['reg_date'];
	$timestamp=strtotime($giornoiscrizione);
	$ricavamese=date('m', $timestamp);
	$ricavaanno=date('Y', $timestamp);
	
	if ($ricavamese==$mese && $ricavaanno==$anno){
		$contaiscrittimese=$contaiscrittimese+1;
		$iscritti[$contaiscrittimese]=$timestamp;
	}
}

//FACEBOOK
$query_nuoviutenti2 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref2' || provenienza='website')  ";
$esegui_query_nuoviutenti2 = mysqli_query($admin,$query_nuoviutenti2);



while ($row2 = mysqli_fetch_assoc($esegui_query_nuoviutenti2))
{
	$giornoiscrizione2=$row2['reg_date'];
	$timestamp2=strtotime($giornoiscrizione2);
	$ricavamese2=date('m', $timestamp2);
	$ricavaanno2=date('Y', $timestamp2);
	
	if ($ricavamese2==$mese && $ricavaanno2==$anno){
		$contaiscrittimese2=$contaiscrittimese2+1;
		$iscritti2[$contaiscrittimese2]=$timestamp2;
	}
}


//MVF
$query_nuoviutenti3 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and provenienza='ref3' ";
$esegui_query_nuoviutenti3 = mysqli_query($admin,$query_nuoviutenti3);


while ($row3 = mysqli_fetch_assoc($esegui_query_nuoviutenti3))
{
	$giornoiscrizione3=$row3['reg_date'];
	$timestamp3=strtotime($giornoiscrizione3);
	$ricavamese3=date('m', $timestamp3);
	$ricavaanno3=date('Y', $timestamp3);
	
	if ($ricavamese3==$mese && $ricavaanno3==$anno){
		$contaiscrittimese3=$contaiscrittimese3+1;
		$iscritti3[$contaiscrittimese3]=$timestamp3;
	}
}



$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));

$vediMese;
    
if ($mese=="01") {$vediMese='TOTALI GENNAIO:';} 
if ($mese=="02") {$vediMese='TOTALI FEBBRAIO:';} 
if ($mese=="03") {$vediMese='TOTALI MARZO:';} 
if ($mese=="04") {$vediMese='TOTALI APRILE:';} 
if ($mese=="05") {$vediMese='TOTALI MAGGIO:';} 
if ($mese=="06") {$vediMese='TOTALI GIUGNO:';} 
if ($mese=="07") {$vediMese='TOTALI LUGLIO:';} 
if ($mese=="08") {$vediMese='TOTALI AGOSTO:';} 
if ($mese=="09") {$vediMese='TOTALI SETTEMBRE:';} 
if ($mese=="10") {$vediMese='TOTALI OTTOBRE:';} 
if ($mese=="11") {$vediMese='TOTALI NOVEMBRE:';} 
if ($mese=="12") {$vediMese='TOTALI DICEMBRE:';} 


if ($mese=="01") {$vediMese2='MVF GENNAIO:';} 
if ($mese=="02") {$vediMese2='MVF FEBBRAIO:';} 
if ($mese=="03") {$vediMese2='MVF MARZO:';} 
if ($mese=="04") {$vediMese2='MVF APRILE:';} 
if ($mese=="05") {$vediMese2='MVF MAGGIO:';} 
if ($mese=="06") {$vediMese2='MVF GIUGNO:';} 
if ($mese=="07") {$vediMese2='MVF LUGLIO:';} 
if ($mese=="08") {$vediMese2='MVF AGOSTO:';} 
if ($mese=="09") {$vediMese2='MVF SETTEMBRE:';} 
if ($mese=="10") {$vediMese2='MVF OTTOBRE:';} 
if ($mese=="11") {$vediMese2='MVF NOVEMBRE:';} 
if ($mese=="12") {$vediMese2='MVF DICEMBRE:';} 

if ($mese=="01") {$vediMese3='FACEBOOK GENNAIO:';} 
if ($mese=="02") {$vediMese3='FACEBOOK FEBBRAIO:';} 
if ($mese=="03") {$vediMese3='FACEBOOK MARZO:';} 
if ($mese=="04") {$vediMese3='FACEBOOK APRILE:';} 
if ($mese=="05") {$vediMese3='FACEBOOK MAGGIO:';} 
if ($mese=="06") {$vediMese3='FACEBOOK GIUGNO:';} 
if ($mese=="07") {$vediMese3='FACEBOOK LUGLIO:';} 
if ($mese=="08") {$vediMese3='FACEBOOK AGOSTO:';} 
if ($mese=="09") {$vediMese3='FACEBOOK SETTEMBRE:';} 
if ($mese=="10") {$vediMese3='FACEBOOK OTTOBRE:';} 
if ($mese=="11") {$vediMese3='FACEBOOK NOVEMBRE:';} 
if ($mese=="12") {$vediMese3='FACEBOOK DICEMBRE:';} 

?>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
<tr>
<th> 
<button type="button" class="btn btn-success">
<?php echo $vediMese3; ?> <span class="badge badge-light"><?php echo $contaiscrittimese2; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-warning">
<?php echo $vediMese2; ?> <span class="badge badge-light"><?php echo $contaiscrittimese3; ?></span>
</button> 
</th>

<th colspan="6"> 
<button type="button" class="btn btn-allert">
<?php echo $vediMese; ?> <span class="badge badge-light"><?php echo $contaiscrittimese; ?></span>
</button> 
</th>

</tr>   
<tr><td>Lunedi'</td><td>Martedì'</td><td>Mercoledì'</td><td>Giovedì'</td><td>Venerdì'</td><td>Sabato</td><td>Domenica</td><td><b>ISCRITTI</b></td></tr>
<?php
for ($i = 1; $i <= 6; $i++) {
$iscrittisettimana=0;
if ($giorno<=$giornimese)
{
?>
<tr>
<td>
<?php 
if ($giorno_n==1 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
					                                           //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }	
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==2 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==3 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==4 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
															   
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
			 	  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
</td>
<td>
<?php 
if ($giorno_n==5 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
					                                           //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
															   
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==6 && $giorno<=$giornimese) {
			      for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
			      } 
?>
</td>
<td>
<?php 
if ($giorno_n==0 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $contaiscrittimese; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
 			      echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
			      $giorno=$giorno+1; 
			      $data = "".$anno."-".$mese."-".$giorno; 
			      $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php
echo "<b>".$iscrittisettimana."</b>"; 
?>
</td>

</tr>

<?php
}
}
?>
</table>