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




?>

<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-md-12 ">
<div class="card shadow mb-12">

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> ISCRITTI PER SETTIMANA </h6></span>
 </div>


<div class="card-body">	

<form role="form" name="modulo_cerca_mese">

<div class="input-group">
	<select class="form-control custom-select meseSel" name="mese" id="inputGroupSelect04">
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
	<select class="form-control custom-select annoSel" name="anno" id="inputGroupSelect04">
		<option value="">[ANNO]</option>
		<option value="2020" <?php if ($anno=="2020") {echo 'selected="selected"';} ?>>2020</option>
		<option value="2019" <?php if ($anno=="2019") {echo 'selected="selected"';} ?>>2019</option>
		<option value="2018" <?php if ($anno=="2018") {echo 'selected="selected"';} ?>>2018</option>
	</select>
</div>
</form>



<?php
     
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
<hr>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
<tr><th colspan="8"> 
<button type="button" class="btn btn-success">
<?php echo $vediMese; ?> <span class="badge badge-light"><?php echo $contaiscrittimese; ?></span>
</button> 
</th></tr>   
<tr><td>Lunedi'</td><td>Martedì'</td><td>Mercoledì'</td><td>Giovedì'</td><td>Venerdì'</td><td>Sabato</td><td>Domenica</td><td><b>ISCRITTI</b></td></tr>
</thead>
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
</div>

</div>

</div>


</div>



</div>
</div>


<script>

//al click dei disponibili
  $("select").on('change', function() {


let meseSel= $("select.meseSel").val();
let annoSel= $("select.annoSel").val();
let tabtot;
let tabField;

$('.mess2').fadeIn();

  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "functions_nuoviscritti.php",

      //Quali dati devo inviare?
      data: "mese="+meseSel+"&anno="+annoSel, 
      dataType: "html",
	  success: function(data) 
	  					{ 
							$('.mess2').fadeOut(); 
							tabField=$(data).filter("#tabIscritti");
							$("#tabIscritti").html(tabField);

						}

    });
  });

</script>



<?php

require_once('inc_footer.php'); 

?>
