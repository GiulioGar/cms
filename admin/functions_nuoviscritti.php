<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php');
mysqli_select_db($admin,$database_admin);


$contaiscrittimese=0;
$contaiscrittimese1=0;
$contaiscrittimese2=0;
$contaiscrittimese3=0;
$contaiscrittimese4=0;
$contaiscrittimese5=0;
$contaiscrittimese6=0;

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

//MVF
$query_nuoviutenti1 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and  provenienza='ref3'   ";
$esegui_query_nuoviutenti1 = mysqli_query($admin,$query_nuoviutenti1);



while ($row1 = mysqli_fetch_assoc($esegui_query_nuoviutenti1))
{
	$giornoiscrizione1=$row1['reg_date'];
	$timestamp1=strtotime($giornoiscrizione1);
	$ricavamese1=date('m', $timestamp1);
	$ricavaanno1=date('Y', $timestamp1);
	
	if ($ricavamese1==$mese && $ricavaanno1==$anno){
		$contaiscrittimese1=$contaiscrittimese1+1;
		$iscritti1[$contaiscrittimese1]=$timestamp1;
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

//amici
$query_nuoviutenti6 = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and provenienza NOT LIKE 'ref%' AND provenienza NOT LIKE 'website%'  ";
$esegui_query_nuoviutenti6 = mysqli_query($admin,$query_nuoviutenti6);


while ($row6 = mysqli_fetch_assoc($esegui_query_nuoviutenti6))
{
	$giornoiscrizione6=$row6['reg_date'];
	$timestamp6=strtotime($giornoiscrizione6);
	$ricavamese6=date('m', $timestamp6);
	$ricavaanno6=date('Y', $timestamp6);
	
	if ($ricavamese6==$mese && $ricavaanno6==$anno){
		$contaiscrittimese6=$contaiscrittimese6+1;
		$iscritti6[$contaiscrittimese6]=$timestamp6;
	}
}

$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));

?>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
<tr>
<th> 
<button type="button" class="btn btn-primary">
<?php echo "Social"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese2; ?></span>
</button> 
</th>


<th> 
<button type="button" class="btn btn-light">
<?php echo "MVF"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese1; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-warning">
<?php echo "AdviceMe"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese3; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-info">
<?php echo "BigData"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese4; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-secondary">
<?php echo "Riattivazioni"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese5; ?></span>
</button> 
</th>

<th> 
<button type="button" class="btn btn-success">
<?php echo "Amici"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese6; ?></span>
</button> 
</th>

<th colspan="6"> 
<button type="button" class="btn btn-dark">
<?php echo "Totali"; ?> <span class="badge badge-light"><?php echo $contaiscrittimese; ?></span>
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