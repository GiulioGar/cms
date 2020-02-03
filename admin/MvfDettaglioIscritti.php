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

$tipocampagna=$_REQUEST['tipocampagna'];
if ($tipocampagna==""){$tipocampagna=1;}


require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

if ($tipocampagna==0)
{
$query_nuoviutenti = "SELECT created FROM referral where referral_uid=63388";
$esegui_query_nuoviutenti = mysqli_query($admin,$query_nuoviutenti) or die(mysql_error());


while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti))
{
	$timestamp=$row['created'];
	$ricavamese=date('m', $timestamp);
	$ricavaanno=date('Y', $timestamp);
	
	if ($ricavamese==$mese && $ricavaanno==$anno){
						   $contaiscrittimese=$contaiscrittimese+1;
						   $iscritti[$contaiscrittimese]=$timestamp;
						   }
}

}

if ($tipocampagna==1)
{

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

}



$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));




?>

<div class="content-wrapper">
<div class="container">

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-warning">	
	                        <div class="panel-heading">
                        UTENTE
                        </div>

		<div class="panel-body text-center recent-users-sec">	

<form role="form" name="modulo_cerca_mese" action="MvfDettaglioIscritti.php" method="get">
	<select class="form-control" name="mese">
	<option value="">[MESE]</option>
	<option value="01" <?php if ($mese=="01") {echo 'selected="selected"';} ?>>Gennaio</option>
	<option value="02" <?php if ($mese=="02") {echo 'selected="selected"';} ?>>Febbraio</option>
	<option value="03" <?php if ($mese=="03") {echo 'selected="selected"';} ?>>Marzo</option>
	<option value="04" <?php if ($mese=="04") {echo 'selected="selected"';} ?>>Aprile</option>
	<option value="05" <?php if ($mese=="05") {echo 'selected="selected"';} ?>>Maggio</option>
	<option value="06" <?php if ($mese=="06") {echo 'selected="selected"';} ?>>Giugno</option>
	<option value="07" <?php if ($mese=="07") {echo 'selected="selected"';} ?>>Luglio</option>
	<option value="08" <?php if ($mese=="08") {echo 'selected="selected"';} ?>>Agosto</option>
	<option value="09" <?php if ($mese=="09") {echo 'selected="selected"';} ?>>Settembre</option>
	<option value="10" <?php if ($mese=="10") {echo 'selected="selected"';} ?>>Ottobre</option>
	<option value="11" <?php if ($mese=="11") {echo 'selected="selected"';} ?>>Novembre</option>
	<option value="12" <?php if ($mese=="12") {echo 'selected="selected"';} ?>>Dicembre</option>
	</select>
	
	
	<select class="form-control" name="anno">
		<option value="">[ANNO]</option>
		<option value="2015" <?php if ($anno=="2015") {echo 'selected="selected"';} ?>>2015</option>
		<option value="2016" <?php if ($anno=="2016") {echo 'selected="selected"';} ?>>2016</option>
		<option value="2017" <?php if ($anno=="2017") {echo 'selected="selected"';} ?>>2017</option>
		<option value="2018" <?php if ($anno=="2018") {echo 'selected="selected"';} ?>>2018</option>
	</select>
	
	<select class="form-control" name="tipocampagna">
		<option value="">[CAMPAGNA]</option>
		<option value="0" <?php if ($tipocampagna=="0") {echo 'selected="selected"';} ?>>MagicViral/Facebook</option>
		<option value="1" <?php if ($tipocampagna=="1") {echo 'selected="selected"';} ?>>Totale</option>
	</select>	
	
	<input class="btn btn-danger" type="submit" value="Seleziona"></td>
	</form>
</div>


<div style="height:60px;">

</div>

<div style="width:250px;">
<b>
<?php
     
	
	 if ($mese=="01") {echo 'ISCRITTI GENNAIO:';} 
	 if ($mese=="02") {echo 'ISCRITTI FEBBRAIO:';} 
	 if ($mese=="03") {echo 'ISCRITTI MARZO:';} 
	 if ($mese=="04") {echo 'ISCRITTI APRILE:';} 
	 if ($mese=="05") {echo 'ISCRITTI MAGGIO:';} 
	 if ($mese=="06") {echo 'ISCRITTI GIUGNO:';} 
	 if ($mese=="07") {echo 'ISCRITTI LUGLIO:';} 
	 if ($mese=="08") {echo 'ISCRITTI AGOSTO:';} 
	 if ($mese=="09") {echo 'ISCRITTI SETTEMBRE:';} 
	 if ($mese=="10") {echo 'ISCRITTI OTTOBRE:';} 
	 if ($mese=="11") {echo 'ISCRITTI NOVEMBRE:';} 
	 if ($mese=="12") {echo 'ISCRITTI DICEMBRE:';} 
	 
	 
	 echo $contaiscrittimese;
?>
</b>
</div>

<table align="center" style="width:90%" class='table table-striped table-bordered table-hover' cellpadding="5">
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
<table>

</div>
</div>
</div>
</div>
</div>
