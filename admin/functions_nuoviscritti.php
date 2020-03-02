<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php');
mysqli_select_db($database_admin, $admin);


$contaiscrittimese=0;

$mesecorrente=date(m);


$annocorrente=date(Y);

//echo "Giorno: ".$giorno." Mese: ".$mese." Anno: ".$anno;

$mese=$_REQUEST['mese'];
if ($mese==""){$mese=$mesecorrente;}


$anno=$_REQUEST['anno'];
if ($anno==""){$anno=$annocorrente;}





$query_nuoviutenti = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' ";
$esegui_query_nuoviutenti = mysqli_query($admin,$query_nuoviutenti) or die(mysql_error());


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





$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));

$vediMese;
    
if ($mese=="01") {$vediMese='ISCRITTI GENNAIO:';} 
if ($mese=="02") {$vediMese='ISCRITTI FEBBRAIO:';} 
if ($mese=="03") {$vediMese='ISCRITTI MARZO:';} 
if ($mese=="04") {$vediMese='ISCRITTI APRILE:';} 
if ($mese=="05") {$vediMese='ISCRITTI MAGGIO:';} 
if ($mese=="06") {$vediMese='ISCRITTI GIUGNO:';} 
if ($mese=="07") {$vediMese='ISCRITTI LUGLIO:';} 
if ($mese=="08") {$vediMese='ISCRITTI AGOSTO:';} 
if ($mese=="09") {$vediMese='ISCRITTI SETTEMBRE:';} 
if ($mese=="10") {$vediMese='ISCRITTI OTTOBRE:';} 
if ($mese=="11") {$vediMese='ISCRITTI NOVEMBRE:';} 
if ($mese=="12") {$vediMese='ISCRITTI DICEMBRE:';} 

?>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
<tr><th colspan="8"> 
<button type="button" class="btn btn-success">
<?php echo $vediMese; ?> <span class="badge badge-light"><?php echo $contaiscrittimese; ?></span>
</button> 
</th></tr>   
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