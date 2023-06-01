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
$query_nuoviutenti2 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref2' || provenienza='website' || provenienza='app')  ";
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


//ADVICE
$query_nuoviutenti3 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and provenienza='ref5' ";
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

//big data
$query_nuoviutenti4 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and provenienza='ref6' ";
$esegui_query_nuoviutenti4 = mysqli_query($admin,$query_nuoviutenti4);


while ($row4 = mysqli_fetch_assoc($esegui_query_nuoviutenti4))
{
	$giornoiscrizione4=$row4['reg_date'];
	$timestamp4=strtotime($giornoiscrizione4);
	$ricavamese4=date('m', $timestamp4);
	$ricavaanno4=date('Y', $timestamp4);
	
	if ($ricavamese4==$mese && $ricavaanno4==$anno){
		$contaiscrittimese4=$contaiscrittimese4+1;
		$iscritti4[$contaiscrittimese4]=$timestamp4;
	}
}

//riattivazioni
$query_nuoviutenti5 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and provenienza='react' ";
$esegui_query_nuoviutenti5 = mysqli_query($admin,$query_nuoviutenti5);


while ($row5 = mysqli_fetch_assoc($esegui_query_nuoviutenti5))
{
	$giornoiscrizione5=$row5['reg_date'];
	$timestamp5=strtotime($giornoiscrizione5);
	$ricavamese5=date('m', $timestamp5);
	$ricavaanno5=date('Y', $timestamp5);
	
	if ($ricavamese5==$mese && $ricavaanno5==$anno){
		$contaiscrittimese5=$contaiscrittimese5+1;
		$iscritti5[$contaiscrittimese5]=$timestamp5;
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
    
if ($mese=="01") {$vediMese='TOT GENNAIO:';} 
if ($mese=="02") {$vediMese='TOT FEBBRAIO:';} 
if ($mese=="03") {$vediMese='TOT MARZO:';} 
if ($mese=="04") {$vediMese='TOT APRILE:';} 
if ($mese=="05") {$vediMese='TOT MAGGIO:';} 
if ($mese=="06") {$vediMese='TOT GIUGNO:';} 
if ($mese=="07") {$vediMese='TOT LUGLIO:';} 
if ($mese=="08") {$vediMese='TOT AGOSTO:';} 
if ($mese=="09") {$vediMese='TOT SETTEMBRE:';} 
if ($mese=="10") {$vediMese='TOT OTTOBRE:';} 
if ($mese=="11") {$vediMese='TOT NOVEMBRE:';} 
if ($mese=="12") {$vediMese='TOT DICEMBRE:';} 


if ($mese=="01") {$vediMese2='ADV GENNAIO:';} 
if ($mese=="02") {$vediMese2='ADV FEBBRAIO:';} 
if ($mese=="03") {$vediMese2='ADV MARZO:';} 
if ($mese=="04") {$vediMese2='ADV APRILE:';} 
if ($mese=="05") {$vediMese2='ADV MAGGIO:';} 
if ($mese=="06") {$vediMese2='ADV GIUGNO:';} 
if ($mese=="07") {$vediMese2='ADV LUGLIO:';} 
if ($mese=="08") {$vediMese2='ADV AGOSTO:';} 
if ($mese=="09") {$vediMese2='ADV SETTEMBRE:';} 
if ($mese=="10") {$vediMese2='ADV OTTOBRE:';} 
if ($mese=="11") {$vediMese2='ADV NOVEMBRE:';} 
if ($mese=="12") {$vediMese2='ADV DICEMBRE:';} 

if ($mese=="01") {$vediMese3='FAC GENNAIO:';} 
if ($mese=="02") {$vediMese3='FAC FEBBRAIO:';} 
if ($mese=="03") {$vediMese3='FAC MARZO:';} 
if ($mese=="04") {$vediMese3='FAC APRILE:';} 
if ($mese=="05") {$vediMese3='FAC MAGGIO:';} 
if ($mese=="06") {$vediMese3='FAC GIUGNO:';} 
if ($mese=="07") {$vediMese3='FAC LUGLIO:';} 
if ($mese=="08") {$vediMese3='FAC AGOSTO:';} 
if ($mese=="09") {$vediMese3='FAC SETTEMBRE:';} 
if ($mese=="10") {$vediMese3='FAC OTTOBRE:';} 
if ($mese=="11") {$vediMese3='FAC NOVEMBRE:';} 
if ($mese=="12") {$vediMese3='FAC DICEMBRE:';} 

if ($mese=="01") {$vediMese4='BIG GENNAIO:';} 
if ($mese=="02") {$vediMese4='BIG FEBBRAIO:';} 
if ($mese=="03") {$vediMese4='BIG MARZO:';} 
if ($mese=="04") {$vediMese4='BIG APRILE:';} 
if ($mese=="05") {$vediMese4='BIG MAGGIO:';} 
if ($mese=="06") {$vediMese4='BIG GIUGNO:';} 
if ($mese=="07") {$vediMese4='BIG LUGLIO:';} 
if ($mese=="08") {$vediMese4='BIG AGOSTO:';} 
if ($mese=="09") {$vediMese4='BIG SETTEMBRE:';} 
if ($mese=="10") {$vediMese4='BIG OTTOBRE:';} 
if ($mese=="11") {$vediMese4='BIG NOVEMBRE:';} 
if ($mese=="12") {$vediMese4='BIG DICEMBRE:';} 

if ($mese=="01") {$vediMese5='REA GENNAIO:';} 
if ($mese=="02") {$vediMese5='REA FEBBRAIO:';} 
if ($mese=="03") {$vediMese5='REA MARZO:';} 
if ($mese=="04") {$vediMese5='REA APRILE:';} 
if ($mese=="05") {$vediMese5='REA MAGGIO:';} 
if ($mese=="06") {$vediMese5='REA GIUGNO:';} 
if ($mese=="07") {$vediMese5='REA LUGLIO:';} 
if ($mese=="08") {$vediMese5='REA AGOSTO:';} 
if ($mese=="09") {$vediMese5='REA SETTEMBRE:';} 
if ($mese=="10") {$vediMese5='REA OTTOBRE:';} 
if ($mese=="11") {$vediMese5='REA NOVEMBRE:';} 
if ($mese=="12") {$vediMese5='REA DICEMBRE:';} 

?>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
<tr>
<th> 
<button type="button" class="btn btn-primary">
<?php echo $vediMese3; ?> <span class="badge badge-light"><?php echo $contaiscrittimese2; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-warning">
<?php echo $vediMese2; ?> <span class="badge badge-light"><?php echo $contaiscrittimese3; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-info">
<?php echo $vediMese4; ?> <span class="badge badge-light"><?php echo $contaiscrittimese4; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-secondary">
<?php echo $vediMese5; ?> <span class="badge badge-light"><?php echo $contaiscrittimese5; ?></span>
</button> 
</th>

<th colspan="4"> 
<button type="button" class="btn btn-dark">
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